<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Models\Catalogo;
use App\Models\Categoria;
use App\Models\Pastelpersonalizado;
use App\Models\Pedido;
use App\Models\Postreemergente;
use App\Models\Postrefijo;
use App\Models\PostreFijoUnidad;
use App\Models\usuario;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class ControladorCatalogo extends Controller
{

    public function mostrar($categoria = null){
        $categorias = Cache::remember('categorias', 30, function () {
            return Categoria::all();
        });

        if ($categorias->isNotEmpty()) {
            if ($categoria === null) {
                $categoriaPorDefecto = $categorias->first()->id_cat;
                $catalogo = Cache::remember('catalogofijoCatNula', 30, function () use ($categoriaPorDefecto) {
                    return Catalogo::select('id_postre', 'id_tipo_postre', 'id_categoria', 'imagen', 'nombre', 'descripcion')
                        ->where('id_tipo_postre', 'fijo')
                        ->where('id_categoria', $categoriaPorDefecto)
                        ->get();
                });
            } else {
                $cacheKey = "catalogofijoCat{$categoria}";
                $catalogo = Cache::remember($cacheKey, 30, function () use ($categoria) {
                    return Catalogo::select('id_postre', 'id_tipo_postre', 'id_categoria', 'imagen', 'nombre', 'descripcion')
                        ->where('id_tipo_postre', 'fijo')
                        ->where('id_categoria', $categoria)
                        ->get();
                });
            }

            if ($catalogo->isEmpty()) {
                abort(404, 'Catálogo no encontrado');
            }

            return view('catalogo', compact('categorias', 'catalogo'))
                ->with('categoriaSeleccionada', $categoria);
        } else {
            abort(500, 'No hay categorías disponibles');
        }
    }

    
    public function mostrarCalendario($mes = null, $anio = null){
        $fecha = Carbon::now();
        if($mes && $anio){
            $fecha = Carbon::createFromDate($anio, $mes, 1);
        }
        
        $primerDiaDelMes = $fecha->copy()->startOfMonth();
        $ultimoDiaDelMes = $fecha->copy()->endOfMonth();
        
        $pedidos = Cache::remember('pedidos', 30, function () use ($primerDiaDelMes, $ultimoDiaDelMes){
            return Pedido:: select('id_ped', 'fecha_hora_entrega', 'porcionespedidas')
                            ->whereBetween('fecha_hora_entrega', [$primerDiaDelMes, $ultimoDiaDelMes])
                            ->get();
            });

        $diasDelMes = [];
        $diaActual = $primerDiaDelMes->copy();
                    
        while ($diaActual->lte($ultimoDiaDelMes)) {
            $diasDelMes[] = [
                'fecha' => $diaActual->toDateString(), // Solo la fecha
                'porciones' => 0,
            ];
            $diaActual->addDay();
        }

        foreach ($pedidos as $pedido) {
            $fechaPedido = Carbon::parse($pedido->fecha_hora_entrega)->toDateString();
            $indice = array_search($fechaPedido, array_column($diasDelMes, 'fecha'));
            if ($indice !== false) {
                $diasDelMes[$indice]['porciones'] += $pedido->porcionespedidas;
            }
        }
        return view('calendario', compact('diasDelMes'));
    }

    public function seleccionarFecha(Request $request)
    {
        $fechaEscogida = $request->input('fecha');
        $postre = $request->input('id_postre');
    
        $pedidos_dia = Cache::remember('pedidosdia', 30, function () use ($fechaEscogida) {
            return Pedido::select('id_postre', 'fecha_hora_entrega', 'porcionespedidas')
                ->whereIn('id_tipopostre', ['fijo', 'personalizado'])
                ->whereDate('fecha_hora_entrega', $fechaEscogida)
                ->get();
        });
    

        $porciones_dia = $pedidos_dia->sum('porcionespedidas');
        $porciones_unidad_minima = Cache::remember('porcionesunidadminima', 30, function () use ($postre) {
            return PostreFijoUnidad::select('cantidad')
                ->where('id_pf', $postre)
                ->orderBy('cantidad', 'desc')
                ->first();
        });
    
        $cantidad_minima = $porciones_unidad_minima ? $porciones_unidad_minima->cantidad : 0;
    
        $request->validate([
            'fecha' => [
                'required',
                'date',
                'after_or_equal:today',
                function ($attribute, $value, $fail) use ($porciones_dia, $cantidad_minima) {
                    if (($porciones_dia + $cantidad_minima) >= 100) {
                        $fail('No se puede seleccionar esta fecha, el límite de porciones diarias es de 100.');
                    }
                },
            ],
        ]);

        session([
            'fecha' => $fechaEscogida,
            'postre' => $postre,
            'porciones_dia' => $porciones_dia,
            'cantidad_minima' => $cantidad_minima,
        ]);

        
        /* return view('fechaSeleccionada', [
            'fecha' => $fechaEscogida,
            'postre' => $postre,
            'porciones_dia' => $porciones_dia,
            'cantidad_minima' => $cantidad_minima,
        ]); */
        return redirect()->route('fechaSelecionada');
    }

    public function mostrarDireccion(){
        //AQUI DEBERIA JALAR EL ID DEL USUARIO DE ALGUN ALMACEN LOCAL PERO ESTO ES UNA PRUEBA

        $id_usuario = session('id_u');
        
        $usuario = usuario::where('id_u', $id_usuario)
                            ->first();
        return view('direccion', compact('usuario'));
    }

    public function seleccionarDireccion(Request $request){

        $ubicacion = $request->input('ubicacion');
        $id_usuario = $request->input('id_usuario');
        //por defecto cargamos la ubicacion del usuario predeterminado
        $user = usuario::where('id_u', $id_usuario)->first();
        $codigo_postal = $user->Codigo_postal_u;
        $estado = $user->estado_u;
        $ciudad = $user->ciudad_u;
        $colonia = $user->colonia_u;
        $calle = $user->calle_u;
        $numero = $user->num_exterior_u;

        //si elige otra entocnes sobreescribimos los valores
        if($ubicacion=='otra'){
            $codigo_postal = $request->input('codigo_postal');
            $estado = $request->input('estado');
            $ciudad = $request->input('ciudad');
            $colonia = $request->input('colonia');
            $calle = $request->input('calle');
            $numero = $request->input('numero');

            //si elige volverla su ubicacion predeterminada entonces lo actualizamos en el perfil del usuario
            if($request->has('predeterminado')){
                $user = usuario::where('id_u', $id_usuario)->first();
                $user->Codigo_postal_u = $codigo_postal;
                $user->estado_u = $estado;
                $user->ciudad_u = $ciudad;
                $user->colonia_u = $colonia;
                $user->calle_u = $calle;
                $user->num_exterior_u = $numero;
                $user->save();
            }

        }

        session([
            'codigo_postal' => $codigo_postal,
            'estado' => $estado,
            'ciudad' => $ciudad,
            'colonia' => $colonia,
            'calle' => $calle,
            'numero' => $numero,
        ]);
        
        return redirect()->route('pedido.resumen');

    }

    public function mostrarDetalles(){

    }

    public function seleccionarDetalles(){

    }

    public function mostrarDetallesEntrega(){

    }

    public function seleccionarDetallesEntrega(Request $request){
        $pedido = new Pedido;

        $pedido->id_ped = $request->id_ped;
        $pedido->id_usuario = $request->id_usuario;
        $pedido->id_tipopostre = $request->id_tipopostre;
        $pedido->id_categoria_postre = $request->id_categoria_postre;
        $pedido->estado_e = $request->estado_e;
        $pedido->Codigo_postal_e = $request->Codigo_postal_e;
        $pedido->ciudad_e = $request->ciudad_e;
        $pedido->colonia_e = $request->colonia_e;
        $pedido->calle_e = $request->calle_e;
        $pedido->num_exterior_e = $request->num_exterior_e;
        $pedido->num_interior_e = $request->num_interior_e;
        $pedido->referencia_e = $request->referencia_e;
        $pedido->porcionespedidas = $request->porcionespedidas;
        $pedido->fecha_hora_registro = $request->fecha_hora_registro;
        $pedido->fecha_hora_entrega = $request->fecha_hora_entrega;
        $pedido->status = $request->status;
        $pedido->precio_final = $request->precio_final;

        $pedido->save();

        return $pedido;
    }
    
    public function mostrarTicket(){
        $pedido = Pedido::find(session('folio'));

        $fechaHoraEntrega = $pedido->fecha_hora_entrega;

        list($fecha, $hora) = explode(' ', $fechaHoraEntrega);

        $usuario = Usuario::find($pedido->id_usuario); 

        return view('pedido', compact('pedido', 'usuario', 'fecha', 'hora'));
    }
}

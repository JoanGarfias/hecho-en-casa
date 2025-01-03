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
        $horaEscogida = $request->input('hora');
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
            'hora_entrega'=> $horaEscogida,
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

    public function mostrarDetalles(){
        session([
            'id_u' => "1",
            'fecha' => "2025-01-07",
            'hora_entrega' => "01:03:33",
            'postre' => "4",
            'cantidad_minima' => "15",
        ]);

        //COMO SON DATOS DIRECTOS NO ES NECESARIO ESTO
        //if (!session('postre') || !session('fecha')) {
        //    return redirect()->route('seleccionarFecha')->with('error', 'No se ha seleccionado un postre o fecha.');
        //}

        $postre = Catalogo::where('id_postre', session('postre'))->first();

        if ($postre) {
            session([
                'sabor_postre' => $postre->nombre,
                'id_cat' => $postre->id_categoria,
            ]);   
            // Buscar el nombre de la categoría
            $categoria = Categoria::where('id_cat', $postre->id_categoria)->first();
            if ($categoria) {
                session(['nombre_categoria' => $categoria->nombre]);
            } else {
                session(['nombre_categoria' => 'Categoría no encontrada']);
            }
        } else {
            return redirect()->route('seleccionarFecha')->with('error', 'Postre no encontrado.');
        }

        $fecha = session('fecha');
        $sabor_postre = session('sabor_postre');
        $hora_entrega = session('hora_entrega');
        $nombre_categoria = session('nombre_categoria');

        return view('detallesFijo', compact('fecha', 'sabor_postre', 'hora_entrega', 'nombre_categoria'));
    }


    public function seleccionarDetalles(){
        
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

    public function mostrarDetallesEntrega(){

    }

    public function seleccionarDetallesEntrega(Request $request){
        
    }
    
    public function mostrarTicket(){
        $id_postre = session('postre');
        $postre = Catalogo::where('id_postre', $id_postre)
                            ->first();
        $tipo = $postre->id_tipo_postre;
        $categoria_postre = null;
        $total = null;
        //AQUI LES TOCA PONER SU LOGICA PARA LOS FIJOS

        if($tipo == 'fijo'){
            $fijo = new Postrefijo;
            
        }

        //AQUI VA LA LOGICA PARA LOS PERSONALIZADOS
        elseif ($tipo == 'personalizado'){
            $personalizado = new Pastelpersonalizado;
        }
        
        //AQUI VA LA LOGICA PARA LOS DE TEMPORADA Y EMERGENTES
        elseif($tipo == 'pop-up' || $tipo == 'temporada'){
            $emergente = new Postreemergente;
            $emergente->id_postre_elegido = $postre->id_postre;
            try{
                $emergente->save();
            }catch(\Exception $e){
                dd("Error al guardar el postre emergente: ".$e->getMessage());
            }
            
            $categoria_postre = $emergente->id_pt;//este es el id de la tabla postre emergente que se guardara en pedido
            $total = $postre->precio_emergentes;
        }
        
        $pedido = new Pedido;
        $pedido->id_usuario = session('id_u');
        $pedido->id_tipopostre = "temporada";
        $pedido->id_categoria_postre = $categoria_postre;
        $pedido->estado_e = session('estado');
        $pedido->Codigo_postal_e = session('codigo_postal');
        $pedido->ciudad_e = session('ciudad');
        $pedido->colonia_e = session('colonia');   
        $pedido->calle_e = session('calle');
        $pedido->num_exterior_e = session('numero');
        //$pedido->referencia_e = session('referencia'); ESTO EN UN FUTURO ESTARA DESCOMENTADO
        $pedido->porcionespedidas = "100";
        $pedido->fecha_hora_entrega = "2025-12-31 23:59:59"; 
        $pedido->fecha_hora_registro = now();
        $pedido->status = "pendiente";
        $pedido->precio_final = $total;
        
        try {
            $pedido->save();
        } catch (\Exception $e) {
            dd("Error al guardar el pedido: " . $e->getMessage());
        }

        $fechaHoraEntrega = $pedido->fecha_hora_entrega;

        list($fecha, $hora) = explode(' ', $fechaHoraEntrega);

        $usuario = Usuario::find($pedido->id_usuario); 

        return view('pedido', compact('pedido', 'usuario', 'fecha', 'hora'));
    }
}

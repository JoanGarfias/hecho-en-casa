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

class ControladorCatalogo extends Controller
{
    public function mostrar($categoria = null)
    {
        $categorias = Categoria::all();

        if ($categorias->isNotEmpty()) {
            if ($categoria === null) {
                $catalogo = Catalogo::select('id_postre', 'id_tipo_postre', 'id_categoria', 'imagen', 'nombre', 'descripcion')
                    ->where('id_tipo_postre', 'fijo')
                    ->where('id_categoria', $categorias[0]->id_cat)
                    ->get();
            }
            else {
                $catalogo = Catalogo::select('id_postre', 'id_tipo_postre', 'id_categoria', 'imagen', 'nombre', 'descripcion')
                    ->where('id_tipo_postre', 'fijo')
                    ->where('id_categoria', $categoria)
                    ->get();
            }
            if ($catalogo->isEmpty()) {
                abort(404, 'Catálogo no encontrado');
            }

            return view('catalogo', compact('categorias', 'catalogo'))
            ->with('categoriaSeleccionada', $categoria);
        }
        else {
            abort(500, 'Error interno del servidor');
        }
    }
    
    public function mostrarCalendario($mes = null, $anio = null){
        $fecha = Carbon::now();
        if($mes && $anio){
            $fecha = Carbon::createFromDate($anio, $mes, 1);
        }
        
        $primerDiaDelMes = $fecha->copy()->startOfMonth();
        $ultimoDiaDelMes = $fecha->copy()->endOfMonth();
        
        $pedidos = Pedido:: select('id_ped', 'fecha_hora_entrega', 'porcionespedidas')
                            ->whereBetween('fecha_hora_entrega', [$primerDiaDelMes, $ultimoDiaDelMes])
                            ->get();
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

    public function seleccionarFecha(Request $request){
        $fechaEscogida = $request->input('fecha');
        $postre = $request->input('id_postre');

        $pedidos_dia = Pedido::select('id_postre', 'fecha_hora_entrega', 'porcionespedidas')
            ->whereIn('id_tipopostre', ['fijo', 'personalizado'])
            ->whereDate('fecha_hora_entrega', $fechaEscogida)
            ->get();

        //Consigo la suma de las porciones pedidas
        $porciones_dia = $pedidos_dia->sum('porcionespedidas');

        //Obtengo las porciones de la presentación minima
        $porciones_unidad_minima = PostreFijoUnidad::select('cantidad')
            ->where('id_pf', $postre)
            ->orderBy('cantidad', 'desc')
            ->first();

        $cantidad_minima = $porciones_unidad_minima ? $porciones_unidad_minima->cantidad : 0;


        $request->validate([
            'fecha' => [
                'required',
                'date',
                'after_or_equal:today',
                function ($attribute, $value, $fail) use ($porciones_dia, $cantidad_minima) {
                    if (($porciones_dia+$cantidad_minima) >= 100) {
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

    public function seleccionarDetallesEntrega(){

    }

    public function mostrarTicket(){
        $id_postre = session('postre');
        $postre = Catalogo::where('id_postre', $id_postre)
                            ->first();

        $categoria_postre = null;
        $total = null;
        //AQUI LES TOCA PONER SU LOGICA PARA LOS FIJOS

        if($postre->id_tipo_postre == 'fijo'){
            $fijo = new Postrefijo;
            
        }

        //AQUI VA LA LOGICA PARA LOS PERSONALIZADOS
        elseif ($postre->id_tipo_postre == 'personalizado'){
            $personalizado = new Pastelpersonalizado;
        }
        
        //AQUI VA LA LOGICA PARA LOS DE TEMPORADA Y EMERGENTES
        elseif($postre->id_tipo_postre == 'pop-up' || $postre->id_tipo_postre == 'temporada'){
            $emergente = new Postreemergente;
            $emergente->id_postre_elegido = $postre->id_postre;
            $emergente->save();
            $categoria_postre = $emergente->id_pt;//este es el id de la tabla postre emergente que se guardara en pedido
            $total = $postre->precio_emergentes;
        }

        $pedido = new Pedido;
        $pedido->id_usuario = session('id_u');
        $pedido->id_tipopostre = $postre->id_tipo_postre;
        $pedido->id_categoria_postre = $categoria_postre;
        $pedido->estado_e = session('estado');
        $pedido->Codigo_postal_e = session('codigo_postal');
        $pedido->ciudad_e = session('ciudad');
        $pedido->colonia_e = session('colonia');   
        $pedido->calle_e = session('calle');
        $pedido->num_exterior_e = session('numero');
        $pedido->fecha_hora_entrega = "2025-12-31 23:59:59";
        $pedido->status = "pendiente";
        $pedido->precio_final = $total;
        $pedido->save();
    }
}

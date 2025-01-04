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
use App\Models\UnidadMedida;
use App\Models\usuario;
use App\Models\AtributosExtra;
use App\Models\TipoAtributo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class ControladorCatalogo extends Controller
{

    public function mostrarCatalogo($categoria = null){ //GET: Muestra los productos
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

    public function guardarSeleccionCatalogo(Request $request){ //POST: guarda la selección en session 
        $id_postre = $request->input('id_postre');
        $nombre_postre = $request->input('nombre_postre');

        $datos = $request->validate([
            'id_postre' => 'required|integer',
            'id_tipopostre' => 'required|integer',
            'nombre_postre' => 'required|string|min:3|max:255',
        ]);

        session([
            'id_postre' => $datos['id_postre'],
            'id_tipopostre' => 'required|integer',
            'nombre_postre' => $datos['nombre_postre'],
        ]);

        return redirect()->route('calendario.get');
    }

    
    public function mostrarCalendario($mes = null, $anio = null){ //GET: Mostrar calendario
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

        $fechaEscogida = "2025-01-08";
        $horaEntrega = "12:00";
        $postre = session('id_postre');
        $tipopostre = session('id_tipopostre');
    
        session(['fecha_entrega' => $fechaEscogida]);
        session(['hora_entrega' => $horaEntrega]);


        $pedidos_dia = Cache::remember('pedidosdia', 30, function () use ($fechaEscogida) {
            return Pedido::select('fecha_hora_entrega', 'porcionespedidas')
                ->whereIn('id_tipopostre', ['fijo', 'personalizado'])
                ->whereDate('fecha_hora_entrega', $fechaEscogida)
                ->get();
        });
    

        $porciones_dia = $pedidos_dia->sum('porcionespedidas');

        switch($tipopostre){
            case "fijo":
                $porciones_unidad_minima = Cache::remember('porcionesunidadminima', 30, function () use ($postre) {
                    return PostreFijoUnidad::with('unidadMedida')
                    ->where('id_pf', $postre)
                    ->orderBy('unidadMedida.cantidad', 'asc')
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
                    'postre' => $postre,
                    'porciones_dia' => $porciones_dia,
                    'cantidad_minima' => $cantidad_minima,
                ]);

                return redirect()->route('fijo.detallesPedido.get');
                break;
            case "personalizado":
                session([
                    'fecha' => $fechaEscogida,
                    'postre' => $postre,
                    'porciones_dia' => $porciones_dia,
                ]);

                return redirect()->route('personalizado.detallesPedido.get');
                break;
            case "temporada": case "pop-up":
                session([
                    'fecha' => $fechaEscogida,
                    'postre' => $postre,
                    'porciones_dia' => $porciones_dia,
                ]);

                return redirect()->route('emergente.pedido');
                break;
        }
        /* return view('fechaSeleccionada', [
            'fecha' => $fechaEscogida,
            'postre' => $postre,
            'porciones_dia' => $porciones_dia,
            'cantidad_minima' => $cantidad_minima,
        ]); */
    }

    public function mostrarDetalles(){
        session([
            'id_u' => "1",
            'fecha' => "2025-01-07",
            'hora_entrega' => "01:03:33",
            'postre' => "27",
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

            //$listaunidad = PostreFijoUnidad::where('id_pf', $postre->id_postre)->get();
            $listaunidad = PostreFijoUnidad::where('id_pf', $postre->id_postre)->pluck('id_um'); // Obtener solo la columna 'id_um'
            if ($listaunidad->isNotEmpty()) {
                $unidades = []; 
                foreach ($listaunidad as $id_um) {  // Ahora recorro la lista de 'id_um'
                    $nombreunidad = UnidadMedida::where('id_um', $id_um)->first();  //'UnidadMedida' usando 'id_um'
                    
                    if ($nombreunidad) {
                        $unidades[] = [
                            'nombreunidad' => $nombreunidad->nombre_unidad,  // 'nombre_unidad' de la tabla 'UnidadMedida'
                            'cantidadporciones' => $nombreunidad->cantidad,  // 'cantidad' está en 'UnidadMedida'
                        ];
                    }
                }

                session(['lista_unidad' => $unidades]);  
            } else {
                session(['lista_unidad' => 'No encontrado']); 
            }
            
            $tiposAtributo = TipoAtributo::all();
            $personalizaciones = AtributosExtra::where('id_tipo_postre', $categoria->id_cat)->get();
            $atributosSesion = [];

            foreach ($tiposAtributo as $tipo) {
                $atributos = $personalizaciones->where('id_tipo_atributo', $tipo->idtipo_atributo)->pluck('nom_atributo')->toArray();
                if (!empty($atributos)) {
                    $atributosSesion[$tipo->nombre_atributo] = $atributos;
                }
            }

            session(['atributosSesion' => $atributosSesion]);
            
        } else {
            return redirect()->route('seleccionarFecha')->with('error', 'Postre no encontrado.');
        }

        $fecha = session('fecha');
        $sabor_postre = session('sabor_postre');
        $hora_entrega = session('hora_entrega');
        $nombre_categoria = session('nombre_categoria');
        $lista_unidad = session('lista_unidad'); 
        $atributosSesion = session('atributosSesion');

        return view('detallesFijo', compact('fecha', 'sabor_postre', 'hora_entrega', 'nombre_categoria', 'lista_unidad', 'atributosSesion'));
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

    public function seleccionarDireccion(Request $request){ //POST: Mandamos a la ruta del ticket

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
        $pedido = Pedido::find(session('folio'));

        $fechaHoraEntrega = $pedido->fecha_hora_entrega;

        list($fecha, $hora) = explode(' ', $fechaHoraEntrega);

        $usuario = Usuario::find($pedido->id_usuario); 

        return view('pedido', compact('pedido', 'usuario', 'fecha', 'hora'));
    }
}

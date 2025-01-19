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
use Illuminate\Support\Facades\Cookie;
use InvalidArgumentException;

class ControladorCatalogo extends Controller
{

    public function mostrarCatalogo(Request $request, $categoria = null){ //GET: Muestra los productos
        /* ENLAZADOR : NO TOCAR O JOAN TE MANDA A LA LUNA */
        session()->put('id_tipopostre', 'fijo');
        session()->put('proceso_compra', $request->route()->getName());
        /* ENLAZADOR : NO TOCAR O JOAN TE MANDA A LA LUNA */

        $categorias = Cache::remember('categorias', 30, function () {
            return Categoria::all();
        });

        if ($categorias->isNotEmpty()) {
            if ($categoria === null) {
                $categoriaPorDefecto = $categorias->first()->id_cat;
                $catalogo = Cache::remember('catalogofijoCatNulaFull', 30, function () use ($categoriaPorDefecto) {
                    return Catalogo::select('id_postre', 'id_tipo_postre', 'id_categoria', 'imagen', 'nombre', 'descripcion')
                        ->where('id_tipo_postre', 'fijo')
                        ->where('id_categoria', $categoriaPorDefecto)
                        ->get();
                        });
                
                foreach ($catalogo as $object) {
                    $newObjectsArray =  Catalogo::join('postre_fijo_unidad_medidas', 'postre_fijo_unidad_medidas.id_pf', '=', 'catalogo.id_postre' )
                        ->join('unidad_medida', 'unidad_medida.id_um', '=', 'postre_fijo_unidad_medidas.id_um' )
                        ->select('precio_um', 'cantidad', 'nombre_unidad')
                        ->where('id_tipo_postre', 'fijo')
                        ->where('id_postre', $object->id_postre)
                        ->where('id_categoria', $categoriaPorDefecto)
                        ->get();
                    
                    $object->Presentaciones  = $newObjectsArray;
                    
                }
                
            } else {
                $cacheKey = "catalogofijoCat{$categoria}";
                $catalogo = Cache::remember($cacheKey, 30, function () use ($categoria) {
                    return Catalogo::select('id_postre', 'id_tipo_postre', 'id_categoria', 'imagen', 'nombre', 'descripcion')
                        ->where('id_tipo_postre', 'fijo')
                        ->where('id_categoria', $categoria)
                        ->get();
                });

                foreach ($catalogo as $object) {
                    $newObjectsArray =  Catalogo::join('postre_fijo_unidad_medidas', 'postre_fijo_unidad_medidas.id_pf', '=', 'catalogo.id_postre' )
                        ->join('unidad_medida', 'unidad_medida.id_um', '=', 'postre_fijo_unidad_medidas.id_um' )
                        ->select('precio_um', 'cantidad', 'nombre_unidad')
                        ->where('id_tipo_postre', 'fijo')
                        ->where('id_postre', $object->id_postre)
                        ->where('id_categoria', $categoria)
                        ->get();
                    
                    $object->Presentaciones  = $newObjectsArray;
                    
                }

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
        /* ENLAZADOR : NO TOCAR O JOAN TE MANDA A LA LUNA */
        session()->put('id_tipopostre', 'fijo');
        session()->put('proceso_compra', $request->route()->getName());
        /* ENLAZADOR : NO TOCAR O JOAN TE MANDA A LA LUNA */

        $id_postre = $request->input('id_postre');
        $id_tipopostre = "fijo";
        $nombre_postre = $request->input('nombre_postre');
        
        session([
            'id_postre' => $id_postre,
            'id_tipopostre' => $id_tipopostre,
            'nombre_postre' => $nombre_postre,
        ]);

        return redirect()->route('fijo.calendario.get');
    }

    
    public function mostrarCalendario(Request $request, $mes = null, $anio = null){ //GET: Mostrar calendario
        /* ENLAZADOR : NO TOCAR O JOAN TE MANDA A LA LUNA */
        $error = session('error'); // Recuperar el mensaje de error
        session()->put('proceso_compra', $request->route()->getName()); //con esto sabemos el nombre de la ruta de la que viene
        /* ENLAZADOR : NO TOCAR O JOAN TE MANDA A LA LUNA */
        
        $ruta = $request->route()->getName();
        $metodo = null;
        
        if($ruta == "personalizado.calendario.get"){
            $metodo = "personalizado.calendario.post";
        }elseif($ruta == "emergente.calendario.get"){
            $metodo = "emergente.calendario.post";
        }elseif($ruta == "fijo.calendario.get"){
            $metodo = "fijo.calendario.post";
        }
    
        $fecha = Carbon::now();
        if($mes && $anio){
            if (!is_numeric($mes) || !is_numeric($anio)) {
                throw new InvalidArgumentException('El mes y el año deben ser números enteros.');
            }
            
            $mes = (int) $mes;
            $anio = (int) $anio;

            if ($mes < 1 || $mes > 12) {
                throw new InvalidArgumentException('El mes debe estar entre 1 y 12.');
            }

            if ($anio < 2024 || $anio > Carbon::now()->year + 1) {
                throw new InvalidArgumentException('El año no es válido.');
            }
            
            $fecha = Carbon::createFromDate($anio, $mes, 1);
        }

        $primerDiaDelMes = $fecha->copy()->startOfMonth();
        $diaSemana = $primerDiaDelMes->dayOfWeek;
        $ultimoDiaDelMes = $fecha->copy()->endOfMonth();
        
        $pedidos = Cache::remember('pedidos', 30, function () use ($primerDiaDelMes, $ultimoDiaDelMes){
            return Pedido:: select('id_ped', 'fecha_hora_entrega', 'porcionespedidas')
                            ->whereBetween('fecha_hora_entrega', [$primerDiaDelMes, $ultimoDiaDelMes])
                            ->where('status', 'aceptado')
                            ->get();
            });

        $diasDelMes = [];
        $diaActual = $primerDiaDelMes->copy();
        $diaSiguiente = $diaActual->copy()->addDay();
                    
        //obtencion de los dias del calendario
        while ($diaActual->lte($ultimoDiaDelMes)) {
            $diasDelMes[] = [
                'fecha' => $diaActual->toDateString(), // Solo la fecha
                'porciones' => $pedidos->whereBetween('fecha_hora_entrega', [$diaActual, $diaSiguiente])->sum('porcionespedidas'),
            ];
            $diaActual->addDay();
            $diaSiguiente->addDay();
        }
        
        $calendarioJson = json_encode([
            'diasDelMes' => $diasDelMes,
            'diaSemana' => $diaSemana,
        ]);

        return view('calEdit', compact('calendarioJson', 'error', 'metodo'));
    }

    public function seleccionarFecha(Request $request)
    {
        $ruta = $request->route()->getName();
        $botonPresionado = $request->input('botonPress');
        if($botonPresionado=="Mover"){
            $mes = $request->input('mes');
            $anio = $request->input('anio');
            switch($ruta){
                case "fijo.calendario.post":
                    return redirect()->route('fijo.calendario.get',['mes' => $mes, 'anio' => $anio]);
                case "emergente.calendario.post":
                    return redirect()->route('emergente.calendario.get',['mes' => $mes, 'anio' => $anio]);
                case "personalizado.calendario.post":
                    return redirect()->route('personalizado.calendario.get',['mes' => $mes, 'anio' => $anio]);
            }
            
        }
        $fechaEscogida = $request->input('fechaSeleccionada');
        $horaEntrega = $request->input('horaEntrega');
        $postre = session('id_postre');
        $tipopostre = session('id_tipopostre');
        session(['id_usuario' => Cookie::get('user_id')]);
        session(['fecha_entrega' => $fechaEscogida]);
        session(['hora_entrega' => $horaEntrega]);

        $pedidos_dia = Cache::remember('pedidosdia', 30, function () use ($fechaEscogida) {
            return Pedido::select('fecha_hora_entrega', 'porcionespedidas')
                ->whereIn('id_tipopostre', ['fijo', 'personalizado'])
                ->whereDate('fecha_hora_entrega', $fechaEscogida)
                ->get();
        });
    

        $porciones_dia = $pedidos_dia->sum('porcionespedidas');
        $porciones_unidad_minima = Cache::remember('porcionesunidadminima', 30, function () use ($postre) {
            return PostreFijoUnidad::join('unidad_medida', 'postre_fijo_unidad_medidas.id_um', '=', 'unidad_medida.id_um')
            ->where('id_pf', $postre)
            ->orderBy('unidad_medida.cantidad', 'asc')
            ->select('unidad_medida.cantidad')
            ->first();
        });

        $cantidad_minima = $porciones_unidad_minima ? $porciones_unidad_minima->cantidad : 0;
        
        //$tipopostre = session('id_tipopostre')
        switch($tipopostre){
            case "fijo":
                /* ENLAZADOR : NO TOCAR O JOAN TE MANDA A LA LUNA */
                session()->put('proceso_compra', 'fijo.calendario.post');
                /* ENLAZADOR : NO TOCAR O JOAN TE MANDA A LA LUNA */

                if($porciones_dia + $cantidad_minima >= 1000000){
                    //dd($porciones_dia + $cantidad_minima);
                    return redirect()->route('fijo.calendario.get'); //Aqui se le tiene que mandar un mensaje de error
                }

                session([
                    'porciones_dia' => $porciones_dia,
                    'cantidad_minima' => $cantidad_minima,
                ]);

                return redirect()->route('fijo.detallesPedido.get');
                //break;
            case "personalizado":
                /* ENLAZADOR : NO TOCAR O JOAN TE MANDA A LA LUNA */
                session()->put('proceso_compra', 'personalizado.calendario.post');
                /* ENLAZADOR : NO TOCAR O JOAN TE MANDA A LA LUNA */

                if($porciones_dia + $cantidad_minima >= 10000000){
                    /* ENLAZADOR : NO TOCAR O JOAN TE MANDA A LA LUNA */
                    session()->put('proceso_compra', 'personalizado.catalogo.post');
                    /* ENLAZADOR : NO TOCAR O JOAN TE MANDA A LA LUNA */
                    return redirect()->route('personalizado.calendario.get')
                    ->with('error', 'Las porciones superan el límite, ya no se puede pedir');                    
                }
                else{
                    session([
                        'fecha' => $fechaEscogida,
                        'postre' => $postre,
                        'porciones_dia' => $porciones_dia,
                        'hora' => $horaEntrega,
                    ]);
    
                    return redirect()->route('personalizado.detallesPedido.get');
                }
                //break;
            case "emergentes":                
                /* ENLAZADOR : NO TOCAR O JOAN TE MANDA A LA LUNA */
                session()->put('proceso_compra', 'emergente.calendario.post');
                /* ENLAZADOR : NO TOCAR O JOAN TE MANDA A LA LUNA */

                session([
                    'porciones_dia' => $porciones_dia,
                ]);

                return redirect()->route('emergente.detallesPedido.get');
                //break;
                // return ERROR;
        }
        /* return view('fechaSeleccionada', [
            'fecha' => $fechaEscogida,
            'postre' => $postre,
            'porciones_dia' => $porciones_dia,
            'cantidad_minima' => $cantidad_minima,
        ]); */
    }

    public function mostrarDetalles(Request $request){
        /* ENLAZADOR : NO TOCAR O JOAN TE MANDA A LA LUNA */
        session()->put('proceso_compra', $request->route()->getName());
        /* ENLAZADOR : NO TOCAR O JOAN TE MANDA A LA LUNA */

        //COMO SON DATOS DIRECTOS NO ES NECESARIO ESTO
        //if (!session('postre') || !session('fecha')) {
        //    return redirect()->route('seleccionarFecha')->with('error', 'No se ha seleccionado un postre o fecha.');
        //}
                                                                //session('postre')
        $postre = Catalogo::where('id_postre', session('id_postre'))->first();
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
            /*$listaunidad = PostreFijoUnidad::where('id_pf', $postre->id_postre)->pluck('id_um'); // Obtener solo la columna 'id_um'
            if ($listaunidad->isNotEmpty()) {
                $unidades = []; 
                foreach ($listaunidad as $id_um) {  // Ahora recorro la lista de 'id_um'
                    $nombreunidad = UnidadMedida::where('id_um', $id_um)->first();  //'UnidadMedida' usando 'id_um'
                    
                    if ($nombreunidad) {
                        $unidades[] = [
                            'nombreunidad' => $nombreunidad->nombre_unidad,  // 'nombre_unidad' de la tabla 'UnidadMedida'
                            'cantidadporciones' => $nombreunidad->cantidad, 
                        ];
                    }
                }*/
            $listaunidad = PostreFijoUnidad::where('id_pf', $postre->id_postre)->pluck('id_um'); // Obtener solo la columna 'id_um'

            if ($listaunidad->isNotEmpty()) {
                    $unidades = []; 
                    foreach ($listaunidad as $id_um) {  // Ahora recorro la lista de 'id_um'
                        $nombreunidad = UnidadMedida::where('id_um', $id_um)->first();  //'UnidadMedida' usando 'id_um'
                        
                        if ($nombreunidad) {
                            // Obtener el precio directamente de PostreFijoUnidad utilizando el id_um
                            $precio = PostreFijoUnidad::where('id_um', $id_um)->where('id_pf', $postre->id_postre)->first(); 
                            
                            if ($precio) {
                                $unidades[] = [
                                    'nombreunidad' => $nombreunidad->nombre_unidad,  // 'nombre_unidad' de la tabla 'UnidadMedida'
                                    'cantidadporciones' => $nombreunidad->cantidad,  // 'cantidad' de 'UnidadMedida'
                                    'precio' => $precio->precio_um,  // 'precio_um' de 'PostreFijoUnidad'
                                ];
                            }
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
                //$atributos = $personalizaciones->where('id_tipo_atributo', $tipo->idtipo_atributo)->pluck('nom_atributo')->toArray();
                $atributos = $personalizaciones
                ->where('id_tipo_atributo', $tipo->idtipo_atributo)
                ->map(function ($item) {
                    return [
                        'nom_atributo' => $item->nom_atributo,
                        'precio_a' => $item->precio_a,
                    ];
                })->toArray();

                if (!empty($atributos)) {
                    $atributosSesion[$tipo->nombre_atributo] = $atributos;
                }
            }
            //dd($atributosSesion);
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
        $porciones_dia = session('porciones_dia');
        session()->put('porciones', 100 - $porciones_dia);

        return view('pedidos', compact('fecha', 'sabor_postre', 'hora_entrega', 'nombre_categoria', 'lista_unidad', 'atributosSesion'));
    }


    public function seleccionarDetalles(Request $request){
        
        /* ENLAZADOR : NO TOCAR O JOAN TE MANDA A LA LUNA */
        $tipo_entrega = $request->input('tipoEntrega');
        session()->put('proceso_compra', $request->route()->getName());
        session()->put('opcion_envio', $tipo_entrega);
        /* ENLAZADOR : NO TOCAR O JOAN TE MANDA A LA LUNA */

        $id_postre = session('id_postre');
        $postre = Catalogo::where('id_postre', $id_postre)
                            ->first();
        //$costo = intval($request->input('costo'));
        $costoUM = PostreFijoUnidad::where('id_pf', $id_postre)->first();
        $costo = $costoUM->precio_um;
        $id_usuario = session('id_usuario');
        session(['tipo_entrega'=> $tipo_entrega]);

        $fechaEscogida = session('fecha_entrega');
        $horaEntrega = session('hora_entrega');
        $fecha_hora_entrega = Carbon::parse($fechaEscogida . ' ' . $horaEntrega);
        $fecha_hora_registro = now();
        $id_tipopostre = 'fijo'; 


        $sabor = session('sabor_postre');
        $unidadm = intval($request->input('porciones'));
        $unidadSeleccionada = $request->input('porciones');  // "5|kilogramo"
        list($cantidadPorciones, $nombreUnidad) = explode('|', $unidadSeleccionada);
        //Obtener id_um 
        $id_um = UnidadMedida::where('cantidad', $cantidadPorciones)
                    ->where('nombre_unidad', $nombreUnidad)
                    ->first(['id_um']);  

        
        session(['nombre_unidad'=> $nombreUnidad]);
        $cantidad = intval($request->input('cantidad'));
        session(['porcionespedidas'=> $unidadm * $cantidad]);

        $valoresSeleccionados = session('atributosSesion');
        session(['id_um' => $id_um->id_um]);
        //NO QUITAR EL IF ELSE, ES DE SUMA IMPORTANCIA... CUALQUIER DUDA DEL FUNCIONAMIENTO PREGUNTARLE A JEOVANI.....
        if (!empty($valoresSeleccionados)) {
            foreach (session('atributosSesion', []) as $nombreTipo => $atributos) { //$valoresSeleccionados as $nombreTipo
                $campo = strtolower($nombreTipo);  // Usamos el mismo nombre dinámico que en la vista
                $valor = $request->input($campo);  // Capturamos el valor enviado
                $valoresSeleccionados[$campo] = $valor;
            }
            list($nombre, $precio) = explode('|', $valor);
            
            $id_tipoatributo = TipoAtributo::where('nombre_atributo', $campo)->first();
                $id_atributo = AtributosExtra::where('id_tipo_atributo', $id_tipoatributo->idtipo_atributo)
                ->where('nom_atributo', $nombre)
                ->first(['id_atributo']);
                session(['id_atributo'=> $id_atributo->id_atributo]);
            
                $costo = $costo + $id_atributo->precio_a;
        } else {
            session(['id_atributo' => null]); 
        }    

        // Ahora se puede usar los valores capturados
        session(['valoresSeleccionados' => $valoresSeleccionados, 'costo' => $costo]); 
        $usuario = Cache::remember('usuario', 30, function () {
            return usuario::where('id_u', session('id_usuario'))->first();
        });

        $direccion = $usuario->calle_u . " " . $usuario->num_exterior_u . ", " . $usuario->colonia_u . ", " .
                    $usuario->ciudad_u . ", ". $usuario->estado_u;
        session([
            'telefono' => $usuario->telefono,
            'direccion' => $direccion,
        ]);

        if ($tipo_entrega == "Domicilio") {
            $datos = [
                'id_sabor' => $sabor,
                'id_tipopostre' => $id_tipopostre,
                'unidadm' => $unidadm,
                'valoresSeleccionados' => $valoresSeleccionados,  
                'costo' => $costo * $cantidad,
                'tipo_entrega' => $tipo_entrega,
                'fecha_hora_registro' => $fecha_hora_registro,
                'fecha_hora_entrega' => $fecha_hora_entrega
            ];
            session()->put('datos_pedido', $datos);


            return redirect()->route('fijo.direccion.get');      
        }
        else if ($tipo_entrega == "Sucursal"){
            // Instanciación de postrefijo  

            $fijo = new Postrefijo;
            $fijo->id_atributo= session("id_atributo");;
            $fijo->id_um = $id_um->id_um;  //1
            $fijo->id_postre_elegido = $id_postre;  //1 NUEVO
            $fijo->save();  

            // Obtenemos el ID del postre creado
            $id_nuevo_postre = $fijo->id_pf;

            // Instanciación de Pedido
            $pedido = new Pedido;
            $pedido->id_usuario = session('id_usuario');
            $pedido->id_tipopostre = $id_tipopostre;
            $pedido->id_seleccion_usuario = $id_nuevo_postre; 
            $pedido->porcionespedidas = $unidadm * $cantidad; 
            $pedido->status = 'pendiente';
            $pedido->precio_final = $costo * $cantidad;
            $pedido->fecha_hora_registro = $fecha_hora_registro;
            $pedido->fecha_hora_entrega = $fecha_hora_entrega;
            $pedido->save();  // Guardamos el pedido

            $id_pedido = $pedido->id_ped;
            session([
                'folio' => $id_pedido,
            ]);
            
            return redirect()->route('fijo.ticket.get', ['folio' => $id_pedido]);            
        }
    }
    
    public function mostrarDireccion(Request $request){
        /* ENLAZADOR : NO TOCAR O JOAN TE MANDA A LA LUNA */
        session()->put('proceso_compra', $request->route()->getName());
        /* ENLAZADOR : NO TOCAR O JOAN TE MANDA A LA LUNA */
        $rutaPost = "fijo.direccion.post";
        
        //ANEXAR LÓGICA PARA OBTENER LA DIRECCIÓN DEL USUARIO

        $datos = session('datos_pedido');
        return view('ConfirmaDato', compact('datos', 'rutaPost'));
    }

    public function guardarDireccion(Request $request){ //POST: Mandamos a la ruta del ticket
        /* ENLAZADOR : NO TOCAR O JOAN TE MANDA A LA LUNA */
        session()->put('proceso_compra', $request->route()->getName());
        /* ENLAZADOR : NO TOCAR O JOAN TE MANDA A LA LUNA */

        $tipo_domicilio = $request->input('ubicacion'); 
        //ACÁ SE DEBERÍA JALAR LA UBICACIÓN DEL FORMULARIO
        //dd($tipo_domicilio);
        $id_usuario = session('id_usuario');
        //por defecto cargamos la ubicacion del usuario predeterminado
        $user = usuario::where('id_u', $id_usuario)->first();
        $datos = session('datos_pedido'); 
        $codigo_postal = $user->Codigo_postal_u;
        $estado = $user->estado_u;
        $ciudad = $user->ciudad_u;
        $colonia = $user->colonia_u;
        $calle = $user->calle_u;
        $numeroInterior = $user->num_interior_u;
        $numeroExterior = $user->num_exterior_u;
        $referencia = $user->referencia_u;


        if($tipo_domicilio==='otra'){ 
            $codigo_postal = $request->input('codigo_postal');
            $estado = $request->input('estado');
            $ciudad = $request->input('ciudad');
            $colonia = $request->input('asentamiento');
            $calle = $request->input('calle');
            $numero = $request->input('numero');
            $numeroInterior = $request->input('numeroI');
            $numeroExterior = $request->input('numeroE');
            $referencia = $request->input('referencia');
            //$referencia = $request->input('referencia');

            //Si elige volverla su ubicacion predeterminada entonces lo actualizamos en el perfil del usuario
            if($request->has('opciones')){
                $user->Codigo_postal_u = $codigo_postal;
                $user->estado_u = $estado;
                $user->ciudad_u = $ciudad;
                $user->colonia_u = $colonia;
                $user->calle_u = $calle;
                $user->num_exterior_u = $numeroExterior;
                $user->num_interior_u = $numeroInterior;
                $user->referencia_u = $referencia;
                $user->save();
            }

        }


        $fijo = new Postrefijo;
        $fijo->id_atributo = session('id_atributo');
        $fijo->id_um = session('id_um'); //$unidadm;
        $fijo->id_postre_elegido = session("id_postre");//1;
        $fijo->save();  

        // Obtenemos el ID del postre creado
        $id_nuevo_postre = $fijo->id_pf;
        
        // Instanciación de Pedido
        $pedido = new Pedido;
        $pedido->id_usuario = session('id_usuario');
        $pedido->id_tipopostre = session('id_tipopostre');
        $pedido->id_seleccion_usuario = $id_nuevo_postre;
        $pedido->estado_e = $estado;
        $pedido->Codigo_postal_e = $codigo_postal;
        $pedido->ciudad_e = $ciudad;
        $pedido->colonia_e = $colonia;
        $pedido->calle_e = $calle;
        $pedido->num_exterior_e = $numeroExterior; 
        $pedido->num_interior_e = $numeroInterior; 
        $pedido->referencia_e = $referencia;
        $pedido->porcionespedidas = session("porcionespedidas");
        $pedido->fecha_hora_entrega =  session('fecha_entrega') . " " . session('hora_entrega'); 
        $pedido->fecha_hora_registro = now();
        $pedido->status = "pendiente";
        $pedido->precio_final = session("costo");
        $pedido->save();

        $id_pedido = $pedido->id_ped;
        session([
            'folio' => $id_pedido,
        ]);

        return redirect()->route('fijo.ticket.get',['folio' => $id_pedido]);

    }
    
    public function mostrarTicket(){
        /* ENLAZADOR : NO TOCAR O JOAN TE MANDA A LA LUNA */
        session()->forget('proceso_compra');
        /* ENLAZADOR : NO TOCAR O JOAN TE MANDA A LA LUNA */
        $pedido = Pedido::find(session("folio"));
        $fechaHoraEntrega = $pedido->fecha_hora_entrega;
        $costo = $pedido->precio_final;

        list($fecha, $hora) = explode(' ', $fechaHoraEntrega);
        $usuario = Usuario::find($pedido->id_usuario); 
        
        $nombre = $usuario->nombre;
        $telefono = $usuario->telefono;
        
        $tipo_entrega = session('tipo_entrega');

        return view('ResumenPedFij', compact('costo', 'nombre', 'telefono', 'fecha', 'hora', 'tipo_entrega'));
    }
}

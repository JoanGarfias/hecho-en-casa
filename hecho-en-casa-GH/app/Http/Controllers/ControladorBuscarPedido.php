<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use App\Models\Postrefijo;
use App\Models\Postreemergente;
use App\Models\Catalogo;
use App\Models\Categoria;
use App\Models\UnidadMedida;
use App\Models\usuario;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cookie;

class ControladorBuscarPedido extends Controller{
    public function ObtenerFolio()
    {
        return view('buscadorpedido');
    }

    public function MostrarPedido(Request $request)
    {
        $folio = $request->input('folio');
        $id_u = Cookie::get('user_id');
        $pedido = Pedido::where('id_ped', $folio)
                        ->where('id_usuario', $id_u) //para solo mostrar tus ticket y no de nadie mas
                        ->first(); // Reemplaza con tu campo correcto

        if ($pedido) {
            $id_pf = $pedido->id_seleccion_usuario;

            if($pedido->id_tipopostre === "fijo"){
                $id_postre_elegido = Postrefijo::where("id_pf", $id_pf)->first(); 
                $nombre_sabor = Catalogo::where("id_postre", $id_postre_elegido->id_postre_elegido)->first(); 
                session()->put("nombre_sabor", $nombre_sabor->nombre);
                $nombre_categoria = Categoria::where("id_cat", $nombre_sabor->id_categoria)->first(); 
                session()->put("nombre_categoria", $nombre_categoria->nombre);
                $resultado = $nombre_categoria->nombre . ' (' . $nombre_sabor->nombre . ')';
                session()->put("nombre_completo", $resultado);


                $id_um =  $id_postre_elegido->id_um;
                $nombre_unidad_t = UnidadMedida::where("id_um", $id_um)->first(); 
                $nombre_unidad = $nombre_unidad_t->nombre_unidad;
            }

            if($pedido->id_tipopostre === "personalizado"){
                $resultado = "personalizado";
                session()->put("nombre_completo", $resultado);
                $nombre_unidad = "Porciones";
            }

            if(($pedido->id_tipopostre === "temporada") || ($pedido->id_tipopostre === "pop-up")){
                $id_postre_elegido = Postreemergente::where("id_pt", $id_pf)->first();
                $nombre = Catalogo::where("id_postre", $id_postre_elegido->id_postre_elegido)->first(); 
                $resultado = $nombre->nombre;
                session()->put("nombre_completo", $resultado); 
                $nombre_unidad = "Piezas";
            }

            $id_usuario = usuario::where("id_u", $pedido->id_usuario)->first(); 
            $nombre_completo = $id_usuario->nombre . " " .$id_usuario->apellido_paterno . " " .$id_usuario->apellido_materno;
            $telefono = $id_usuario->telefono;

            $fecha_hora_entrega = $pedido->fecha_hora_entrega;
            $fecha_hora_entrega_obj = Carbon::parse($fecha_hora_entrega);
            $fecha_entrega = $fecha_hora_entrega_obj->toDateString(); // 'YYYY-MM-DD'
            $hora_entrega = $fecha_hora_entrega_obj->toTimeString();  // 'HH:MM:SS'

            if($pedido->Codigo_postal_e === null){
                $tipo_entrega = "Sucursal";
            }else{
                $tipo_entrega = "Domicilio";
            }
            $precio_final = $pedido->precio_final;


            return view('buscadorpedido', ['pedido' => $pedido, 'tipopostre' => $resultado, 'nombre_completo' => $nombre_completo, 'telefono' => $telefono, 'fecha_entrega' => $fecha_entrega, 'hora_entrega' => $hora_entrega, 'precio_final' => $precio_final, 'tipo_entrega' => $tipo_entrega, 'nombre_unidad' => $nombre_unidad]);
        } else {
            return view('buscadorpedido', ['error' => 'Folio no encontrado']);
        }
    }
}
//a

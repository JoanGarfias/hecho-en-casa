<?php

namespace App\Http\Controllers;

use App\Models\Catalogo;
use App\Models\Pedido;
use App\Models\Postreemergente;
use App\Models\usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ControladorCatalogoEmergente extends Controller
{
    public function mostrar(){
        $emergentes = [
            //consulta para obtener todos los postres de temporada disponibles en el catalogo
            'temporada' => Catalogo::select('id_postre', 'imagen','id_tipo_postre')
                                    ->where('id_tipo_postre', 'temporada')
                                    ->where('disponible', '1')
                                    ->get(),
            //consulta para obtener todos los postres pop-up disponibles en el catalogo
            'pop-up' =>    Catalogo::select('id_postre', 'imagen', 'id_tipo_postre', 'nombre', 'descripcion', 'stock')
                                    ->where('id_tipo_postre', 'pop-up')
                                    ->where('stock', '>', 0)
                                    ->get(),
        ];

            $emergentes = Cache::remember('catalogoemergentes', 600, function () {
                return [
                    'temporada' => Catalogo::select('id_postre', 'imagen', 'id_tipo_postre')
                                        ->where('id_tipo_postre', 'temporada')
                                        ->where('disponible', '1')
                                        ->get(),
    
                    'pop-up' => Catalogo::select('id_postre', 'imagen', 'id_tipo_postre', 'nombre', 'descripcion', 'stock')
                                        ->where('id_tipo_postre', 'pop-up')
                                        ->where('stock', '>', 0)
                                        ->get(),
                ];
            });
    
                if (!$emergentes) {
                    Log::info('Cache is empty or expired.');
                    return response()->json([]);
                }
        
      
    }

    public function mostrarDetalles(){
        //ESTO DEBERIA JALARSE DE LA VISTA ANTERIOR AQUI SOLO VA UN EJEMP
        session([
            'id_u' => "1",
            'fecha' => "2025-01-03",
            'postre' => "30",
            'cantidad_minima' => "4",
        ]);

        //ESTO ES LA CONSULTA A PARTIR DEL ID QUE ME LLEGO DE LA VISTA ANTERIOR
        $postre = Catalogo::where('id_postre', session('postre'))
                            ->first();

        session([   
            'nombre_postre' => $postre->nombre,
        ]);

        return view('detalles');
    }

    public function seleccionarDetalles(Request $request){
        $validated = $request->validate([
            'cantidad' => 'required|integer',
            'tipo_entrega' => 'required',
        ]);

        $tipo_entrega = $validated['tipo_entrega'];

        session([
            'cantidad_pedida' => $validated['cantidad'],
            'tipo_entrega' => $validated['tipo_entrega'],
        ]);

        if($tipo_entrega == 'domicilio'){
            return redirect()->route('pedido.direccion');
        }

        $id_postre = session('postre');
        $postre = Catalogo::where('id_postre', $id_postre)
                            ->first();
        $emergente = new Postreemergente;
        $emergente->id_postre_elegido = $postre->id_postre;
        try{
            $emergente->save();
        }catch(\Exception $e){
            dd("Error al guardar el postre emergente: ".$e->getMessage());
        }
        
        $total = $postre->precio_emergentes;
        
        $pedido = new Pedido;
        $pedido->id_usuario = session('id_u');
        $pedido->id_tipopostre = $postre->id_tipo_postre;
        $pedido->id_categoria_postre = $emergente->id_pt;//este es el id de la tabla postre emergente que se guardara en pedido
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

        return redirect()->route('pedido.resumen');   
    }
}

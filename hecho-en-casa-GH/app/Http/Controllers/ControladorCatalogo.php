<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Models\Catalogo;
use App\Models\Categoria;
use App\Models\Pedido;
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

            // Si no es una solicitud AJAX, renderizar la vista normalmente
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

        return response()->json($diasDelMes);
    }

    public function mostrarFecha(){
        
    }

    public function seleccionarFecha(){

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

    }
}

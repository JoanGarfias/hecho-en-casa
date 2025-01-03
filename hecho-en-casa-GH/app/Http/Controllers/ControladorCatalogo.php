<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Models\Catalogo;
use App\Models\Categoria;
use App\Models\Pedido;
use App\Models\PostreFijoUnidad;
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

        return view('fechaSeleccionada', [
            'fecha' => $fechaEscogida,
            'postre' => $postre,
            'porciones_dia' => $porciones_dia,
            'cantidad_minima' => $cantidad_minima,
        ]);
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

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ControladorCalendario extends Controller
{
    public function index($mes = null, $anio = null){
        $fecha = Carbon::now();
        if($mes && $anio){
            $fecha = Carbon::createFromDate($anio, $mes, 1);
        }
        
        $primerDiaDelMes = $fecha->copy()->startOfMonth();
        $diaSemana = $primerDiaDelMes->dayName;
        $ultimoDiaDelMes = $fecha->copy()->endOfMonth();
        
        $pedidos = Cache::remember('pedidos', 30, function () use ($primerDiaDelMes, $ultimoDiaDelMes){
            return Pedido:: select('id_ped', 'fecha_hora_entrega', 'porcionespedidas')
                            ->whereBetween('fecha_hora_entrega', [$primerDiaDelMes, $ultimoDiaDelMes])
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

        return view('calFijo', compact('calendarioJson'));
    }
}

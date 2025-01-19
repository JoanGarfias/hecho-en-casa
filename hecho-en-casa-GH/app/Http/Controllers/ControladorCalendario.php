<?php

namespace App\Http\Controllers;

use App\Exceptions\CalendarioException;
use App\Http\Controllers\Controller;
use App\Models\Pedido;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use InvalidArgumentException;

class ControladorCalendario extends Controller
{
    public function index($mes = null, $anio = null){
        $fecha = Carbon::now();
        if($mes && $anio){
            if (!is_numeric($mes) || !is_numeric($anio)) {
                throw new CalendarioException('El mes y el año deben ser números enteros.');
            }
            
            $mes = (int) $mes;
            $anio = (int) $anio;

            if ($mes < 1 || $mes > 12) {
                throw new CalendarioException('El mes debe estar entre 1 y 12.');
            }

            if ($anio < 2024 || $anio > Carbon::now()->year + 1) {
                throw new CalendarioException('El año no es válido.');
            }

            $fecha = Carbon::createFromDate($anio, $mes, 1);
        }else{
            if (($mes === null && $anio !== null) || ($mes !== null && $anio === null)) {
                throw new CalendarioException('Faltó ingresar mes o año');
            }
        }
        
        $primerDiaDelMes = $fecha->copy()->startOfMonth();
        $diaSemana = $primerDiaDelMes->dayOfWeek;
        $ultimoDiaDelMes = $fecha->copy()->endOfMonth();
        
        $pedidos = Cache::remember('pedidos', 30, function () use ($primerDiaDelMes, $ultimoDiaDelMes){
            return Pedido:: select('id_ped', 'fecha_hora_entrega', 'porcionespedidas')
                            ->whereBetween('fecha_hora_entrega', [$primerDiaDelMes, $ultimoDiaDelMes])
                            ->where('status', 'aceptado')
                            ->whereIn('id_tipopostre', ['fijo', 'personalizado'])
                            ->get();
            });

        $diasDelMes = [];
        $diaActual = $primerDiaDelMes->copy();
        $diaSiguiente = $diaActual->copy()->addDay();
                        
            //obtencion de los dias del calendario
     
        while ($diaActual->lte($ultimoDiaDelMes)) {
            if($pedidos){
                $diasDelMes[] = [
                    'fecha' => $diaActual->toDateString(), // Solo la fecha
                    'porciones' => $pedidos->whereBetween('fecha_hora_entrega', [$diaActual, $diaSiguiente])->sum('porcionespedidas'),
                ];
            }else{
                $diasDelMes[] = [
                    'fecha' => $diaActual->toDateString(), // Solo la fecha
                    'porciones' => 0,
                ];
            }
            
            $diaActual->addDay();
            $diaSiguiente->addDay();
        }
        

        $calendarioJson = json_encode([
            'diasDelMes' => $diasDelMes,
            'diaSemana' => $diaSemana,
        ]);

        return view('calFijo', compact('calendarioJson'));
    }

    public function actualizar(Request $request){
        $mes = $request->input('mes');
        $anio = $request->input('anio');
        return redirect()->route('calendario.get',['mes' => $mes, 'anio' => $anio]);
    }
}

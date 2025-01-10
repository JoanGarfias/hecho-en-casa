<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ControladorCP extends Controller
{
    public function buscar(Request $request)
    {
        $codigoPostal = $request->input('codigo_postal');
    
        // API para obtener el estado
        $estadoResponse = Http::withHeaders([
            'X-CSRFToken' => 'dMeZYCWDp06yZgUwgSsDvRMyDAWyNaFMDac192rtjuQi4C9v1JC3ShHf5xKK0i92',
            'accept' => '*/*',
        ])->get("https://apicp.softfortoday.com/api/v1/estados/codigo_postal/{$codigoPostal}");

        // API para obtener el municipio
        $municipioResponse = Http::withHeaders([
            'X-CSRFToken' => 'dMeZYCWDp06yZgUwgSsDvRMyDAWyNaFMDac192rtjuQi4C9v1JC3ShHf5xKK0i92',
            'accept' => '*/*',
        ])->get("https://apicp.softfortoday.com/api/v1/municipios/codigo_postal/{$codigoPostal}");

        // API para obtener los asentamientos
        $asentamientosResponse = Http::withHeaders([
            'X-CSRFToken' => 'dMeZYCWDp06yZgUwgSsDvRMyDAWyNaFMDac192rtjuQi4C9v1JC3ShHf5xKK0i92',
            'accept' => '*/*',
        ])->get("https://apicp.softfortoday.com/api/v1/asentamientos/codigo_postal/{$codigoPostal}");


        if ($estadoResponse->successful() && $municipioResponse->successful() && $asentamientosResponse->successful()) {
            $estadoDatos = $estadoResponse->json('respuesta');
            $municipioDatos = $municipioResponse->json('respuesta.municipios')[0] ?? null;
            $asentamientosDatos = $asentamientosResponse->json('respuesta.asentamiento') ?? [];
    
            $estado = $estadoDatos['codigo_estado'] ?? 'Desconocido';
            $municipio = $municipioDatos['municipio'] ?? 'Desconocido';

            // Devolver los datos a la vista
            return response()->json([
                'estado' => $estado,
                'municipio' => $municipio,
                'asentamientos' => $asentamientosDatos
            ]);
        } else {
            return response()->json(['error' => 'No se pudo obtener la información para el código postal.'], 500);
        }
    }
}

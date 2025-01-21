<?php
namespace Tests\Feature;

use Tests\TestCase;

class PruebaCatalogoCategorias extends TestCase
{
    public function testGuardarSeleccionCatalogoGuardaDatosCorrectamenteEnSesion()
    {
        // Datos de prueba para la solicitud POST
        $data = [
            'id_postre' => 1,
            'nombre_postre' => 'Pastel de Chocolate',
        ];

        // Realiza la solicitud POST al controlador que guarda la selección
        $response = $this->post(route('guardar.seleccion.catalogo'), $data);

        $response->assertSessionHas('id_postre', 1);
        $response->assertSessionHas('id_tipopostre', 'fijo');
        $response->assertSessionHas('proceso_compra', 'guardar.seleccion.catalogo');

        // Verifica que la respuesta sea una redirección a la ruta correctas
        $response->assertRedirect(route('fijo.calendario.get'));
    }
}

<?php
namespace Tests\Feature;

use Tests\TestCase;

class PruebaCatalogoCategorias extends TestCase
{
    public function testGuardarSeleccionCatalogoGuardaDatosCorrectamenteEnSesion()
    {
        // Datos de prueba para la solicitud POST
        $data = [
            'id_postre' => 123,
            'nombre_postre' => 'Pastel de Chocolate',
        ];

        // Realiza la solicitud POST al controlador que guarda la selección
        $response = $this->post(route('guardar.seleccion.catalogo'), $data);

        // Verifica que los datos se guardaron correctamente en la sesión
        $response->assertSessionHas('id_postre', 123);
        $response->assertSessionHas('id_tipopostre', 'fijo');
        $response->assertSessionHas('nombre_postre', 'Pastel de Chocolate');
        $response->assertSessionHas('proceso_compra', 'guardar.seleccion.catalogo');

        // Verifica que la respuesta sea una redirección a la ruta correcta
        $response->assertRedirect(route('fijo.calendario.get'));
    }
}

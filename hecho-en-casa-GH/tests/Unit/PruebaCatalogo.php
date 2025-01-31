<?php
namespace Tests\Unit;
use Tests\TestCase;

class PruebaCatalogo extends TestCase
{
    public function test_cargar_catalogo_get()
    {
        $response = $this->get('fijo/catalogo/1');

        $response->assertStatus(200);
    }

    public function test_guardar_catalogo_post()
    {
        $data = [
            'id_postre' => 1,
        ];

        // Realiza una solicitud POST al endpoint del catálogo con los datos
        $response = $this->post('fijo/catalogo/1', $data);
        $response->assertStatus(200);

        // Opcionalmente, puedes verificar que el servidor redirija a una página correcta
        $response->assertRedirect('fijo/seleccionar-fecha/{mes?}/{anio?}');
    }
}

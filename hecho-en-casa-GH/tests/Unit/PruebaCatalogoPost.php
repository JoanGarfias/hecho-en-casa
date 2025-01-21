<?php

namespace Tests\Unit;

use Tests\TestCase;

class PruebaCatalogoPost extends TestCase
{
    public function test_catalogo_post_redirige_a_login_sin_sesion()
    {
        $data = [
            'id_postre' => 1,
            //'nombre_postre' => 'Pay de platano',
        ];

        // Realiza la solicitud POST al endpoint del catálogo sin estar autenticado
        $response = $this->post('fijo/catalogo', $data);

        // Verifica que la respuesta redirija al login
        $response->assertRedirect("/login"); 
    }
}

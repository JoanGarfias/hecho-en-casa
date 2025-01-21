<?php

namespace Tests\Unit;

use Tests\TestCase;

class PruebaLogeo extends TestCase
{
    public function test_cargar_login()
    {
        // Realiza una solicitud GET a la página de inicio
        $response = $this->get('/login');

        // Verifica que la respuesta tenga el status 200 (OK)
        $response->assertStatus(200);
    }

    public function test_ingresar_datos_fallidos()
    {
        $correo = "joanpagarf09@gmail.com";
        $password = "Password1";
    
        $response = $this->post('/login', [
            'action' => 'login',
            'email' => $correo, 
            'password' => $password,
        ]);
    
        // Verifica que la respuesta haya sido una redirección o un error de validación
        $response->assertSessionHasErrors(); 
    
        $this->assertGuest();  // Esto asegura que el usuario no esté autenticado
    }

}

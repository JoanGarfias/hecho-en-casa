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
        // Datos con credenciales incorrectas
        $datos_fallidos = [
            ['email' => 'joanpagarf@gmail.com', 'password' => 'wrongpassword1'],
            ['email' => 'joanpagarf@gmail.com', 'password' => 'wrongpassword2'],
            ['email' => 'joanpagarf@gmail.com', 'password' => 'wrongpassword3'],
            ['email' => 'joanpagarf@gmail.com', 'password' => 'wrongpassword1'],
        ];

        // Recorre cada combinación de datos fallidos y prueba el login
        foreach ($datos_fallidos as $datos) {
            // Realiza la solicitud POST con los datos incorrectos
            $response = $this->generar_post_logeo($datos['email'], $datos['password']);
            $response->assertSessionHasErrors(['error']);
        }
    }

    public function test_ingresar_datos_correctos()
    {
        // Envia una solicitud POST al endpoint de login con credenciales incorrectas
        $response = $this->generar_post_logeo("joanpagarf09@gmail.com", "Password1!");
        $response->assertSessionHasNoErrors();
    }

    private function generar_post_logeo($correo, $password)
    {
        // Envia una solicitud POST al endpoint de login con las credenciales
        return $this->post('/login', [
            'action' => 'login',
            'email' => $correo,
            'password' => $password,
        ]);
    }

}

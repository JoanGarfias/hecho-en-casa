<?php

namespace Tests\Unit;
use Tests\TestCase;
use App\Models\usuario;

class PruebaMiddleware extends TestCase
{
     public function test_iniciar_sesion(){
        //Ingreso de datos para iniciar sesion
        $response = $this->generar_post_logeo("jemmanuelbn2@gmail.com", "12345678Ab");
        //Checa si el usuario esta de vuelta en inicio tras iniciar sesion
        $this->assertEquals(route('inicio.get'), $response->getTargetUrl());
     }

    public function test_ver_perfil_sin_sesion(){
        //Intento de acceso a perfil sin sesion
        $response = $this->get('/perfil');
        //Regreso a login
        $this->assertEquals(route('login.get'), $response->getTargetUrl());
    }

    public function test_ir_a_calendario_pedido_sin_sesion(){
        //Usuario intenta acceder al calendario sin sesion activa
        $response = $this->get('/fijo/seleccionar-fecha');
        //Regreso a login
        $this->assertEquals(route('login.get'), $response->getTargetUrl());
    }

    public function test_ir_a_detalles_pedido_sin_sesion(){
        //Usuario intenta acceder al calendario sin sesion activa
        $response = $this->get('/fijo/detalles-pedido');
        //Regreso a login
        $this->assertEquals(route('login.get'), $response->getTargetUrl());
    }

private function generar_post_logeo($correo, $password) //Funcion para iniciar sesion, obtenida de PruebaLogeo, créditos a Joan Pablo
    {
        // Envia una solicitud POST al endpoint de login con las credenciales
        return $this->post('/login', [
            'action' => 'login',
            'email' => $correo,
            'password' => $password,
        ]);
    }

}
?>
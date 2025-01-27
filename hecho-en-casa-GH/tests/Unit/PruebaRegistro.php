<?php

namespace Test\Unit;

use App\Http\Controllers\ControladorRegistro;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Mockery;
use Tests\TestCase;

class RegistroTest extends TestCase{
    public function test_validacion_con_datos_invalidos()
    {
        $this->expectException(ValidationException::class);
        //1. Instanciamos el control
        $controlador = new ControladorRegistro;
        
        //2. Creacion de una solicitud simulando los campos del formulario
        $pruebaIncorrecta = new Request([
            'name' => '',
            'email' => 'invalid-email',
            'phone' => '',
            'apellidoP' => '',
            'apellidoM' => '',
        ]);

        //3. Se realiza la validación de las reglas
        $pruebaIncorrecta->validate($controlador->reglasValidacion());
    }

    public function test_validacion_con_datos_validos()
    {
        //1. Instancia del controlador de registro
        $controlador = new ControladorRegistro;

        //2. Creacion de una solicitud simulando los campos del formulario
        $pruebaCorrecta = new Request([
            'name' => 'Jeycson Gabriel',
            'email' => 'jeycsonlopez@gmail.com',
            'phone' => '9711393821',
            'apellidoP' => 'Lopez',
            'apellidoM' => 'Hernandez',
        ]);

        //3. Se realiza la validación de las reglas
        $pruebaCorrecta->validate($controlador->reglasValidacion());
    }

    public function test_correo_ya_registrado(){
        //1. Crear un usuario ficticio en la base de datos
        Usuario::create([
            'nombre' => 'Jeycson Gabriel',
            'correo_electronico' => 'test@gmail.com',
            'telefono' => '9248332211',
            'Codigo_postal_u' => '23940',
            'estado_u' => 'Oaxaca',
            'ciudad_u' => 'Tehuantepec',
            'colonia_u' => 'Seccion 3',
            'calle_u' => 'Rio Bravo',
            'contraseña' => 'contraseña'
        ]);
        
        //2. Simular una respuesta del campo email
        $request = new Request([
            'email' => 'test@gmail.com'
        ]);

        //3. Almacenar el correo capturado en el input email
        $correo = $request->input('email');

        // 4. Consulta la base de datos para verificar si el correo existe
        $usuario = Usuario::where('correo_electronico', $correo)->first();

        // 5. Asegura que el usuario se encontró
        $this->assertNotNull($usuario);
        $this->assertEquals('test@gmail.com', $usuario->correo_electronico);
    }

    public function test_correo_no_registrado(){
         // 1. Crea un objeto Request simulado con un correo que no existe
         $request = new Request([
            'email' => 'noexiste@ejemplo.com',
        ]);

        // 2. Recupera el correo del request
        $correo = $request->input('email');

        // 3. Consulta la base de datos para verificar si el correo existe
        $usuario = Usuario::where('correo_electronico', $correo)->first();

        // 4. Asegura que no se encontró ningún usuario
        $this->assertNull($usuario);
    }

    public function test_datos_se_guardan_en_la_sesion()
    {
        //1. Se crea una respuesta simulando datos de entrada validados del usuario
        $request = new Request([
            'name' => 'John',
            'email' => 'john@example.com',
            'phone' => '1234567890',
            'apellidoP' => 'Doe',
            'apellidoM' => 'Smith',
        ]);

        //2. Se almacenan en la sesión del usuario
        session([
            'nombre' => $request->input('name'),
            'apellido_paterno' => $request->input('apellidoP'),
            'apellido_materno' => $request->input('apellidoM'),
            'telefono' => $request->input('phone'),
            'correo' => $request->input('email'),
        ]);

        //3. Se realiza la revision de que la sesión guarde correctamente los datos
        $this->assertEquals('John', session('nombre'));
        $this->assertEquals('Doe', session('apellido_paterno'));
        $this->assertEquals('Smith', session('apellido_materno'));
        $this->assertEquals('1234567890', session('telefono'));
        $this->assertEquals('john@example.com', session('correo'));
    }

    public function test_redireccion_a_login()
    {
        $request = new Request(['action' => 'login']);

        $response = redirect()->route('login.get');

        $this->assertEquals(route('login.get'), $response->getTargetUrl());
    }

    public function test_redireccion_a_registrar_contrasena()
    {
        $request = new Request(['action' => 'register']);

        $response = redirect()->route('registrar.contrasena.get');

        $this->assertEquals(route('registrar.contrasena.get'), $response->getTargetUrl());
    }
}
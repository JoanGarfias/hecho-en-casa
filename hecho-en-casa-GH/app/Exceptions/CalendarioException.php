<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

class CalendarioException extends Exception
{
    public function __construct($message, $code = 404)
    {
        parent::__construct($message, $code);
    }

    public function report()
    {
        Log::error('Excepción capturada: ' . $this->getMessage());
        
    }

    public function render($request)
    {
        // Devuelve una respuesta personalizada.
        return response()->view('errors.calendario', ['message' => $this->getMessage()], $this->code);
    }
}

<?php

namespace App\Exceptions\Traits;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Validation\ValidationException;

/**
 * 
 */
trait ApiException
{
    /**
     * Trata as exceções da API
     */
    protected function getJsonException($request, $e)
    {
        if($e instanceof ModelNotFoundException){
            return $this->notFoundException();
        }

        if($e instanceof HttpException){
            return $this->httpException($e);
        }

        if($e instanceof ValidationException){
            return $this->validationException($e);
        }

        return $this->genericException();
    }

    /**
     * Retorna o Erro 404
     */
    protected function notFoundException()
    {
        return $this->getResponse(
            "Recurso não encontrado",
            "01",
            404
        );
    }

    /**
     * Retorna o Erro de http
     */
    protected function httpException($e)
    {
        //Não usar desse modo em produçao
        $messages = [
            405 => [
                "code" => "03",
                "message" => "Verbo Http não permitido"
            ]
        ];
        
        return $this->getResponse(
            $messages[$e->getStatusCode()]["message"],
            $messages[$e->getStatusCode()]["code"],
            $e->getStatusCode()
        );
    }

    /**
     * Retorna o Erro 500
     */
    protected function genericException()
    {
        return $this->getResponse(
            "Erro interno no servidor",
            "02",
            500
        );
    }

    /**
     * Retorna o Erro de validação
     */
    public function validationException($e)
    {
        return response()->json($e->errors(), $e->status);
    }

    /**
     * Mostra a resposta em json
     */

    protected function getResponse(String $message, String $code, int $status)
    {
        return response()->json([
            "errors" => [
                "status" => $status,
                "code" => $code,
                "message" => $message
            ]
            ], $status);
    }
    
}


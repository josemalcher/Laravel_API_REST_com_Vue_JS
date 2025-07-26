<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ApiRuleException extends Exception
{
    /**
     * Renderiza a exceção como uma resposta HTTP.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function render(Request $request): JsonResponse
    {
        return response()->json(
            [
                'error' => true,
                'message' => "ERROR...!!!"
            ],
            // Se o código da exceção for 0 ou inválido, use 422 por padrão
            $this->getCode() ?: 422
        );
        /*$this->renderable(function (Throwable $e) {
            if($e instanceof NotFoundHttpException) {}
            return response()->json(
                [
                    'message' => 'Product not found',
                ]
            );
        });*/
    }
}

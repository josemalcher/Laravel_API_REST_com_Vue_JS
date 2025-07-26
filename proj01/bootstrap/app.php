<?php

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {

        // dd('O código chegou aqui!'); // ADICIONE ESTA LINHA DE TESTE
        $exceptions->render(function (Throwable $e, Request $request) {

            // Verifica se a requisição é para a API e se a exceção é do tipo NotFoundHttpException
            if ($request->is('api/*') && $e instanceof NotFoundHttpException) {
                return response()->json([
                    'error' => true,
                    'message' => 'O registro solicitado não foi encontrado.'
                ], 404);
            }

            // Para todas as outras exceções, continua o comportamento padrão
            return parent::render($request, $e);
        });

    })->create();

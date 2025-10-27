<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Exceptions\PostTooLargeException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;

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
        $exceptions->renderable(function (AuthenticationException $e) {
            return response()->json([
                'message' => $e->getMessage() != '' ? $e->getMessage() : 'Authentication required',
            ], Response::HTTP_UNAUTHORIZED, [], JSON_UNESCAPED_UNICODE);
        });

        $exceptions->renderable(function (AuthorizationException|AccessDeniedHttpException $e) {
            return response()->json([
                'message' => 'Access denied',
            ], Response::HTTP_FORBIDDEN, [], JSON_UNESCAPED_UNICODE);
        });

        $exceptions->renderable(function (BadRequestHttpException $e) {
            return response()->json([
                'message' => $e->getMessage() != '' ? $e->getMessage() : 'Invalid request. Please check your request parameters.',
            ], Response::HTTP_BAD_REQUEST, [], JSON_UNESCAPED_UNICODE);
        });

        $exceptions->renderable(function (NotFoundHttpException $e) {
            return response()->json([
                'message' => $e->getMessage() != '' ? $e->getMessage() : 'Resource not found. Please check your request parameters.',
            ], Response::HTTP_NOT_FOUND, [], JSON_UNESCAPED_UNICODE);
        });

        $exceptions->renderable(function (PostTooLargeException $e) {
            return response()->json([
                'message' => 'Uploaded file size limit exceeded.',
            ], Response::HTTP_INTERNAL_SERVER_ERROR, [], JSON_UNESCAPED_UNICODE);
        });

        $exceptions->renderable(function (TooManyRequestsHttpException $e) {
            return response()->json([
                'message' => $e->getMessage() != '' ? $e->getMessage() : 'Too many requests. Please try again later.',
            ], Response::HTTP_TOO_MANY_REQUESTS, [], JSON_UNESCAPED_UNICODE);
        });

        $exceptions->renderable(function (QueryException $e) {
            return response()->json([
                'message' => __('messages.server_error'),
            ], Response::HTTP_INTERNAL_SERVER_ERROR, [], JSON_UNESCAPED_UNICODE);
        });
    })->create();

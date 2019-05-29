<?php

namespace Minishop\Controllers;

use Symfony\Component\HttpFoundation\JsonResponse;

abstract class BaseController
{
    /**
     * For responding with error message
     */
    public function respondWithError(int $status_code, string $error_code, string $error_message)
    {
        $data = ['error' => $error_code, 'message' => $error_message];

        $response = new JsonResponse($data);
        $response->setStatusCode($status_code);

        return $response;
    }

    /**
     * For responding with success message
     */
    public function respondWithSuccess(int $status_code, string $success_message)
    {
        $data = ['message' => $success_message];

        $response = new JsonResponse($data);
        $response->setStatusCode($status_code);

        return $response;
    }
}
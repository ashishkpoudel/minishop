<?php

namespace Minishop\Controllers;

use Symfony\Component\HttpFoundation\JsonResponse;
use Minishop\Domain\Products\{ Product, Exceptions\ProductNotFoundException };

class ProductController extends BaseController
{
    public function index()
    {
        return new JsonResponse([
            'data' => Product::all()
        ]);
    }

    public function get($id)
    {
        try
        {
            $product = Product::find($id);

            return new JsonResponse([
                'data' => $product
            ]);
        }
        catch (ProductNotFoundException $ex)
        {
            return $this->respondWithError(JsonResponse::HTTP_NOT_FOUND, 'product_not_found_error', $ex->getMessage());
        }
    }
}
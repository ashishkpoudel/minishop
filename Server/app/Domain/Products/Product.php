<?php

namespace Minishop\Domain\Products;

use Minishop\Domain\Products\Exceptions\ProductNotFoundError;

class Product
{
    public static function all()
    {
        return json_decode(file_get_contents(sprintf("%s/data/products.json", $_SERVER['DOCUMENT_ROOT'])), true);
    }

    public static function find(int $id)
    {
        $product = array_filter(self::all(), function($product) use ($id) {
            return $product['id'] === $id;
        });

        if (empty($product)) {
            throw new ProductNotFoundError('Unable to find product with an id of ' . $id);
        }

        return array_values($product)[0]; // using array_values because array_filter preserves index number
    }
}
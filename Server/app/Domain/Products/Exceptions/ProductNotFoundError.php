<?php

namespace Minishop\Domain\Products\Exceptions;

class ProductNotFoundError extends \RuntimeException 
{
    protected $code = 'product_not_found_error';
}
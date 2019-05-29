<?php

namespace Minishop\Domain\Payments\Exceptions;

class PaymentMethodInvalidError extends \RuntimeException
{
    protected $code = 'payment_method_invalid_error';
}
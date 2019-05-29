<?php

namespace Minishop\Domain\Payments;

use Minishop\Domain\Payments\Contracts\PaymentMethod;

class Stripe implements PaymentMethod
{
    public function __construct()
    {
        // some initialization here
    }

    public function process(int $amount): bool
    {
        return true;
    }

    public function __toString()
    {
        return "Stripe";
    }
}
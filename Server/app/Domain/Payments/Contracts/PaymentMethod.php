<?php

namespace Minishop\Domain\Payments\Contracts;

interface PaymentMethod
{
    public function process(int $amount): bool;
}
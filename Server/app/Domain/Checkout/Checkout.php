<?php

namespace Minishop\Domain\Checkout;

use Minishop\Domain\Payments\Contracts\PaymentMethod;

class Checkout
{
    private $items = [];

    public function addItem($product, $quantity = 1)
    {
        for ($x = 1; $x <= $quantity; $x++) {
            array_push($this->items, $product);
        }
    }

    public function chargableAmount()
    {
        $total = 0;

        foreach ($this->items as $item) {
            $total = $total + $item['price'];
        }

        return $total;
    }

    public function process(PaymentMethod $payment_method): bool
    {
        return $payment_method->process($this->chargableAmount());
    }
}
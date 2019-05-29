<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

use Minishop\Domain\Products\Product;
use Minishop\Domain\Payments\Stripe;
use Minishop\Domain\Payments\CashOnDelivery;
use Minishop\Domain\Checkout\Checkout;

class CheckoutTest extends TestCase
{
    public function test_checkout_can_be_done_using_stripe()
    {
        $product = Product::find(1);
        $stripe = new Stripe();

        $checkout = new Checkout();
        $checkout->addItem($product, 1);

        $this->assertEquals(true, $checkout->process($stripe));
    }

    public function test_checkout_can_be_done_using_cash_on_delivery()
    {
        $product = Product::find(1);
        $cash_on_delivery = new CashOnDelivery();

        $checkout = new Checkout();
        $checkout->addItem($product, 1);

        $this->assertEquals(true, $checkout->process($cash_on_delivery));
    }
}
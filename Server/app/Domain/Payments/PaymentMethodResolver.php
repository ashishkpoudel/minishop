<?php

namespace Minishop\Domain\Payments;

use Symfony\Component\HttpFoundation\Request;

use Minishop\Domain\Payments\Contracts\PaymentMethod;
use Minishop\Domain\Payments\Stripe;
use Minishop\Domain\Payments\CashOnDelivery;
use Minishop\Domain\Payments\Exceptions\PaymentMethodInvalidError;

class PaymentMethodResolver
{
    public static function fromRequest(Request $request): PaymentMethod
    {
        switch(strtolower($request->get('payment_method')))
        {
            case 'stripe':
            return new Stripe();
            break;

            case 'cash_on_delivery':
            return new CashOnDelivery();
            break;

            default:
            throw new PaymentMethodInvalidError('Selected payment method not found');
            break;
        }
    }
}
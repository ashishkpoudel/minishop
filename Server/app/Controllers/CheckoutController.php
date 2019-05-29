<?php

namespace Minishop\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use Minishop\Domain\Products\Product;
use Minishop\Domain\Checkout\Checkout;
use Minishop\Domain\Payments\PaymentMethodResolver;
use Minishop\Domain\Payments\Exceptions\PaymentMethodInvalidError;

class CheckoutController extends BaseController
{
    public function create(Request $request)
    {
        try
        {
            // get user selected payment method
            $payment_method = PaymentMethodResolver::fromRequest($request);

            // prepare selected product for checkout and charge
            $checkout = new Checkout();
            $checkout->addItem(Product::find($request->get('product_id')), $request->get('quantity'));
            
            if ($checkout->process($payment_method)) {
                return $this->respondWithSuccess (
                    JsonResponse::HTTP_OK, sprintf("Your purchase of total $%s has been successfully completed using payment method %s", $checkout->chargableAmount(), $payment_method)
                );
            }

            return $this->respondWithError (
                JsonResponse::HTTP_BAD_REQUEST, 'checkout_error', 'Unable to process your purchase'
            );
        }
        catch (PaymentMethodInvalidError $ex)
        {
            return $this->respondWithError (
                JsonResponse::HTTP_BAD_REQUEST, $ex->getCode(), $ex->getMessage()
            );
        }
    }
}
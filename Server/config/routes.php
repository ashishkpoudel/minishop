<?php

/**
 * Routes file for minishop app
 */

use Symfony\Component\Routing\Route;

use Minishop\Controllers\ProductController;
use Minishop\Controllers\CheckoutController;

$routes->add('products#all', new Route('/products', [
    '_controller' => [ProductController::class, 'index']
],[],[],null,[],['GET']));

$routes->add('products#get', new Route('/products/{id}', [
    '_controller' => [ProductController::class, 'get']
],[],[],null,[],['GET']));

$routes->add('checkout', new Route('/checkout', [
    '_controller' => [CheckoutController::class, 'create']
],[],[],null,[],['POST', 'OPTIONS']));
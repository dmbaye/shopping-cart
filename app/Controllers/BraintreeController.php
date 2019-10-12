<?php

namespace App\Controllers;

use Braintree_ClientToken;
use Psr\Http\Message\ResponseInterface as Response;

class BraintreeController extends Controller
{
    public function token(Response $response)
    {
        $gateway = new \Braintree_Gateway([
            'environment' => 'sandbox',
            'merchantId' => env('BRAINTREE_MERCHANT_ID'),
            'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
            'privateKey' => env('BRAINTREE_PRIVATE_KEY'),
        ]);

        return $response->withJson([
            'token' => $gateway->clientToken()->generate(),
        ], 200);
    }
}

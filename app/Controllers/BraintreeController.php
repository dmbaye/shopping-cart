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
            'merchantId' => 'tjqqhnjp9xjzzqjs',
            'publicKey' => 'mdhttdmztzpbrpqm',
            'privateKey' => '19db488a83b3ef94bb405018f67dd1e7',
        ]);

        return $response->withJson([
            'token' => $gateway->clientToken()->generate(),
        ], 200);
    }
}

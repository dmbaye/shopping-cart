<?php

namespace App\Middlewares;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class OldInputMiddleware extends Middleware
{
    public function __invoke(Request $request, Response $response, Callable $next)
    {
        if (isset($_SESSION['old'])) {
            // unset($_SESSION['old']);
            $this->view->getEnvironment()->addGlobal('old', $_SESSION['old']);
        }

        $_SESSION['old'] = $request->getParams();

        $response = $next($request, $response);
        return $response;
    }
}

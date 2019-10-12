<?php

namespace App\Middlewares;

use App\Auth\Auth;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class GuestMiddleware extends Middleware
{
    public function __invoke(Request $request, Response $response, Callable $next)
    {
        if (Auth::check()) {
            return $response->withRedirect($this->router->pathFor('home'));
        }

        $response = $next($request, $response);
        return $response;
    }
}

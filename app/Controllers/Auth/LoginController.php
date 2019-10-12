<?php

namespace App\Controllers\Auth;

use App\Auth\Auth;
use App\Validation\Forms\LoginForm;
use App\Controllers\Controller;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class LoginController extends Controller
{
    public function showLogin(Request $request, Response $response)
    {
        return $this->view->render($response, 'auth/login.twig');
    }

    public function login(Request $request, Response $response)
    {
        $validation = $this->validator->validate($request, LoginForm::rules());

        if ($validation->fails()) {
            $this->flash->addMessage('error', 'Please enter valid data.');
            return $response->withRedirect($this->router->pathFor('auth.login'));
        }

        if (!Auth::attempt($request->getParams())) {
            $this->flash->addMessage('error', 'Please enter valid data.');
            return $response->withRedirect($this->router->pathFor('auth.login'));
        }

        $this->flash->addMessage('succes', 'You are successfully logged in.');
        return $response->withRedirect($this->router->pathFor('home'));
    }

    public function logout(Request $request, Response $response)
    {
        Auth::logout();

        $this->flash->addMessage('succes', 'You are successfully logged out.');
        return $response->withRedirect($this->router->pathFor('home'));
    }
}

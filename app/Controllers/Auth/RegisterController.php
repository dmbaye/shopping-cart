<?php

namespace App\Controllers\Auth;

use App\Models\User;
use App\Controllers\Controller;
use App\Validation\Forms\RegisterForm;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class RegisterController extends Controller
{
    public function showRegister(Request $request, Response $response)
    {
        return $this->view->render($response, 'auth/register.twig');
    }

    public function register(Request $request, Response $response)
    {
        // Validate input
        $validation = $this->validator->validate($request, RegisterForm::rules());

        if ($validation->fails()) {
            $this->flash->addMessage('error', 'Please enter valid data.');
            return $response->withRedirect($this->router->pathFor('auth.register'));
        }

        $user = new User();
        $user->name = $request->getParam('name');
        $user->email = $request->getParam('email');
        $user->password = password_hash($request->getParam('password'), PASSWORD_DEFAULT);

        if (!$user->save()) {
            $this->flash->addMessage('error', 'Please enter valid data.');
            return $response->withRedirect($this->router->pathFor('auth.register'));
        }

        $this->flash->addMessage('success', 'Your account was created successfully.');
        return $response->withRedirect($this->router->pathFor('home'));
    }
}

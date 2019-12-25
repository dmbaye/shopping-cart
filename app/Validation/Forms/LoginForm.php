<?php

namespace App\Validation\Forms;

use Respect\Validation\Validator as v;

class LoginForm
{
    public static function rules()
    {
        return [
            'email' => v::notEmpty()->email(),
            'password' => v::notEmpty()
        ];
    }
}

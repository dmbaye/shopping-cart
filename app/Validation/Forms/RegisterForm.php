<?php

namespace App\Validation\Forms;

use Respect\Validation\Validator as v;

class RegisterForm
{
    public static function rules()
    {
        return [
            'name' => v::notEmpty()->alpha(' \' '),
            'email' => v::notEmpty()->email(),
            'password' => v::notEmpty()
        ];
    }
}

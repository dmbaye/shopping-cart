<?php

namespace App\Validation\Forms;

use Respect\Validation\Validator as v;

class OrderForm
{
    public static function rules()
    {
        return [
            'name' => v::notEmpty()->alpha(' \' '),
            'email' => v::notEmpty()->email(),
            'address1' => v::notEmpty()->alnum(' -'),
            'address2' => v::optional(v::alnum(' -')),
            'city' => v::notEmpty()->alnum(' '),
            'postal_code' => v::notEmpty()->alnum(' '),
        ];
    }
}

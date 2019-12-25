<?php

namespace App\Validation\Forms;

use Respect\Validation\Validator as v;

class ProductForm
{
    public static function rules()
    {
        return [
            'name' => v::notEmpty(),
            'slug' => v::notEmpty(),
            'description' => v::notEmpty(),
            'price' => v::notEmpty(),
            'stock' => v::notEmpty(),
        ];
    }
}

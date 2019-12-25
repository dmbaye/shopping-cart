<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Auth\Auth;

class AuthTest extends TestCase
{
    public function testAttemptMethod()
    {
        $login = Auth::attempt([
            'email' => 'dmbaye@app.com',
            'password' => 'password'
        ]);

        var_dump($login);
        die();
    }
}

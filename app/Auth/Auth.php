<?php

namespace App\Auth;

use App\Models\User;

class Auth
{
    public static function attempt(array $credentials): bool
    {
        $user = User::where('email', $credentials['email'])->first();

        if (!$user) return false;

        if (password_verify($credentials['password'], $user->password)) {
            $_SESSION['user'] = $user->id;
            return true;
        }

        return false;
    }

    public function check(): bool
    {
        return isset($_SESSION['user']);
    }

    public static function admin(): bool
    {
        $user = User::findOrFail($_SESSION['user']);

        return $user->is_admin === 1;
    }

    public function user(): User
    {
        return User::findOrFail($_SESSION['user']);
    }

    public static function logout()
    {
        unset($_SESSION['user']);
    }
}

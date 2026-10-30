<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Куда перенаправлять пользователя после входа.
     */
    protected $redirectTo = '/';

    

    /**
     * Использовать имя пользователя (username) вместо email для входа.
     */
    public function username()
    {
        return 'username';
    }
}
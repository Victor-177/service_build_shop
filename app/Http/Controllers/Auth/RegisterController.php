<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Куда перенаправлять пользователя после регистрации.
     */
    protected $redirectTo = '/';

    

    /**
     * Получение валидатора для входящего запроса на регистрацию.
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:255', 'unique:users'], // Проверка логина
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Создание нового пользователя после успешной валидации.
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'], // Сохраняем логин
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'client', // По умолчанию даем роль клиента
        ]);
    }
}
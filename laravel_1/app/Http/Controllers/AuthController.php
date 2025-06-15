<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Страница регистрации пользователя
     */
    public function createform()
    {
        return view('auth.create');
    }

    /**
     * Запрос регистрации пользователя
     */
    public function loginform()
    {
        return view('auth.login');
    }

    /**
     * Запрос регистрации пользователя
     * 
     * Параметры метода:
     * 
     * $request - коллекция данных пользователя
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['regex:/^[А-Яа-я\- ]{1,}$/u', 'required'],
            'phone' => ['required','regex:^\+7\(\d{3}\)-\d{3}\-\d{2}\-\d{2}$'],
            'login' => ['regex:/^[0-9A-Za-z\-]+$/', 'unique:users', 'required'],
            'email' => ['email', 'unique:users', 'required'],
            'password' => ['confirmed', 'min:4', 'required'],
            // И иные данные для валидации
        ]);

        $user = User::create([
            'name' => $request->name,
            'login' => $request->login,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
            // И иные данные для валидации
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect('/')->with('info', 'Вы успешно зарегистрировались!');
    }

    /**
     * Страница авторизации пользователя
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (Auth::user()->is_admin) {
                return redirect('/')->with('info', 'Вы зашли как администратор');
            } else {
                return redirect('/')->with('info', 'Вход выполнен!');
            }
        }

        return back()->withErrors(['Данные не соответствуют!']);
    }

    /**
     * Запрос авторизации пользователя
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('info', 'Выход выполнен!');
    }
}

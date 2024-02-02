<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRegisterRequest;
use App\Http\Requests\StoreUserRegisterRequest;
use App\Models\User;
use Doctrine\DBAL\Exception;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function storeUserRegistration(StoreUserRegisterRequest $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        try {
            $request->validated();
            $user = User::createFromRegisterForm($request);
            Auth::login($user, true);
            return redirect(route('client'));
        } catch (\Exception $exception) {
            return back()->withErrors([
                'email' => $exception->getMessage(),
            ])->onlyInput('email');
        }
    }

    public function checkFromLoginForm(LoginRegisterRequest $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect(route('client'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
}

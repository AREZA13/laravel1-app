<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRegisterRequest;
use App\Models\User;
use Doctrine\DBAL\Exception;

class UserController extends Controller
{
    /**
     * @throws Exception
     */
    public function storeUserRegistration(StoreUserRegisterRequest $request)
    {
        $request->validated();
        User::createFromRegisterForm($request);
        return redirect(route('client'));
    }
}

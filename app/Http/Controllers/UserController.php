<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Show the profile for a given user.
     */
    public function show(Request $request, string $id)
    {
//        $apiT = new ApiLayer($token, $domain);
//        $pets = $apiT->getAllPetsForUser($userId);
//        return \view('pet/huy', ['pets' => $pets]);


//        return \view('haha', $pets);

        $user = User::findOrFail($id);

          return view('user.profile', [
            'user' => User::findOrFail($id)

        ]);

//        return 'Hello User #' . $id;
    }
}

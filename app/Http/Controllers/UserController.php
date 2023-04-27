<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function create(): View
    {
        return view('auth.register');
    }


    public function store(Request $request, User $user)
    {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', 'min:6']
        ]);

        $formFields['password'] = bcrypt($formFields['password']);

        $user->create($formFields);

        auth()->login($user);

        return redirect('/')->with('message', 'User Created Sucessfully and logged in');
    }
}

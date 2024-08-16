<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
        ]);

        User::create($validatedData);

    }
}

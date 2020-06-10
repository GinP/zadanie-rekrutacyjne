<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit()
    {
        return view('users.password');
    }

    public function update()
    {
        $user = Auth::user();
        request()->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $user->update(['password' => Hash::make(request()->password)]);
        return view('users.edit', compact('user'))->with('success', 'Saved succesfully');
    }

}

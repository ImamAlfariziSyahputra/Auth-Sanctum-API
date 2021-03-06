<?php

namespace App\Http\Controllers;

use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
  public function login(Request $request)
  {
    $request->validate([
      'email' => ['required'],
      'password' => ['required'],
    ]);

    if(Auth::attempt($request->only('email', 'password'))) {
      return response()->json(Auth::user(), 200);
    }

    throw ValidationException::withMessages([
      'email' => ['The Provided Credentials are Incorrect.']
    ]);
  }
  
  public function logout()
  {
    Auth::logout();
  }
}

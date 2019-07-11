<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;

class AuthUserController extends Controller
{
  public function register(Request $request){
    $this->validate($request, [
      'name' => 'required|string|min:5|max:20',
      'email' => 'required|string|email|unique:users',
      'password' => 'required|min:6'
    ]);

    $user = User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => bcrypt($request->password),
      'api_token' => bcrypt($request->email)
    ]);

    return response()->json([
      'message' => 'Register Success',
      'status' => true,
      'data' => $user
    ], 201);
  }

  public function login(Request $request){
    $this->validate($request, [
      'email' => 'required|email',
      'password' => 'required'
    ]);

    $credential = [
      'email' => $request->email,
      'password' => $request->password
    ];

    if (!Auth::attempt($credential, $request->member)) {
      return response()->json([
        'message' => 'Login Failed',
        'status' => False,
      ]);
    }
    $user = User::find(Auth::user()->id);
    return response()->json([
      'message' => 'Login Success',
      'status' => true,
      'data' => $user
    ]);
  }
}

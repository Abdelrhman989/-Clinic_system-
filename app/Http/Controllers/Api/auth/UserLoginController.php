<?php

namespace App\Http\Controllers\api\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserLoginController extends Controller
{
  public function login(Request $request)
  {
      $request->validate([
          'email' => 'required|email',
          'password' => 'required|min:8',
      ]);

      if (Auth::attempt($request->only('email', 'password'))) {
          $user = Auth::user();
          $token = $user->createToken('auth_token')->plainTextToken;

          return response()->json([
              'access_token' => $token,
              'message' => 'User logged in successfully',
              'user' => $user
          ]);
      }

      return response()->json(['message' => 'Invalid login details'], 401);
  }
  public function logout(Request $request)
  {
      $request->user()->tokens()->delete();

      return response()->json([
          'message' => 'Successfully logged out',
      ]);
  }
}

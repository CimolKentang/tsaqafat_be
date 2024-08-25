<?php

namespace App\Http\Controllers;

use App\Http\Resources\DataResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
  public function register(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required',
      'email' => 'required|unique:users',
      'password' => 'required|min:5'
    ]);

    if ($validator->fails()) {
      return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
    }

    $user = User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => bcrypt($request->password)
    ]);

    $token = $user->createToken('auth_token')->plainTextToken;

    $data = [
      'user' => $user,
      'token' => $token
    ];

    return new DataResource(Response::HTTP_OK, 'User added!', $data);
  }

  public function login(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'email' => 'required',
      'password' => 'required'
    ]);

    if ($validator->fails()) {
      return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
    }

    if (!Auth::attempt($request->only('email', 'password'))) {
      return response()->json(['message' => 'Invalid credential'], Response::HTTP_UNAUTHORIZED);
    }

    $user = User::where('email', $request->email)->first();
    $token = $user->createToken('auth_token')->plainTextToken;

    $data = [
      'user' => $user,
      'token' => $token
    ];

    return new DataResource(Response::HTTP_OK, 'Logged successfully!', $data);
  }
}

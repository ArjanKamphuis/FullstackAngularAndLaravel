<?php

namespace App\Http\Controllers\API;

use Validator;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Register a new user.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * 
     * @SWG\Post(
     * path="/api/register",
     * tags={"Users"},
     * summary="Create new User",
     * @SWG\Parameter(
     * name="body",
     * in="body",
     * required=true,
     * @SWG\Schema(ref="#/definitions/User"),
     * description="Json format"
     * ),
     * @SWG\Response(
     * response=201,
     * description="Success: operation Successfully"
     * ),
     * @SWG\Response(
     * response=401,
     * description="Refused: Unauthenticated"
     * ),
     * @SWG\Response(
     * response=422,
     * description="Missing mandatory field"
     * ),
     * @SWG\Response(
     * response=404,
     * description="Not Found"
     * )
     * )
     */
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|unique:users',
            'name' => 'required',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        $token = auth()->login($user);

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ], 201);
    }

    /**
     * Log in a user.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * 
     * @SWG\Post(
     * path="/api/login",
     * tags={"Users"},
     * summary="loggin a user",
     * @SWG\Parameter(
     * name="body",
     * in="body",
     * required=true,
     * @SWG\Schema(ref="#/definitions/User"),
     * description="Json format"
     * ),
     * @SWG\Response(
     * response=200,
     * description="Success: operation Successfully"
     * ),
     * @SWG\Response(
     * response=401,
     * description="Refused: Unauthenticated"
     * ),
     * @SWG\Response(
     * response=422,
     * description="Missing mandatory field"
     * ),
     * @SWG\Response(
     * response=404,
     * description="Not Found"
     * )
     * )
     */
    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $credentials = $request->only(['email', 'password']);
        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Invalid Credentials'], 400);
        }

        $current_user = $request->email;
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'current_user' => $current_user,
            'expires_in' => auth()->factory()->getTTL() * 60
        ], 200);
    }

    /**
     * Logout a user.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * 
     * @SWG\Post(
     * path="/api/logout",
     * tags={"Users"},
     * summary="Logout a User",
     * @SWG\Parameter(
     * name="body",
     * in="body",
     * required=true,
     * @SWG\Schema(ref="#/definitions/User"),
     * description="Json format"
     * ),
     * @SWG\Response(
     * response=200,
     * description="Success: operation Successfully"
     * ),
     * @SWG\Response(
     * response=401,
     * description="Refused: Unauthenticated"
     * ),
     * @SWG\Response(
     * response=422,
     * description="Missing mandatory field"
     * ),
     * @SWG\Response(
     * response=404,
     * description="Not Found"
     * ),
     * @SWG\Response(
     * response=405,
     * description="Invalid Input"
     * ),
     * security={
     * { "api_key": {} }
     * }
     * )
     */
    public function logout(Request $request) {
        auth()->logout(true);
        return response()->json(['success' => 'Logged out Successfully'], 200);
    }
}

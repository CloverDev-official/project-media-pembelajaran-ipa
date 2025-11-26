<?php

namespace App\Http\Controllers\API;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class GuruAuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     */
    public function __construct()
    {
        // Gunakan guard 'guru' dan kecualikan login
        $this->middleware('auth:guru', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Gunakan guard 'guru' untuk login
        if (!($token = auth('guru')->attempt($credentials))) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     */
    public function me()
    {
        return response()->json(auth('guru')->user());
    }

    /**
     * Log the user out (Invalidate the token).
     */
    public function logout()
    {
        auth('guru')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('guru')->refresh());
    }

    /**
     * Get the token array structure.
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('guru')->factory()->getTTL() * 60,
        ]);
    }
}

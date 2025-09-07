<?php
namespace App\Http\Controllers\Api;

use App\Helpers\HelperFunc;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Register a new user
     */
    public function register(RegisterRequest $request)
    {

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return HelperFunc::sendResponse(201, 'Account created successfully', [
            'access_token' => $token,
            'token_type'   => 'Bearer',
            'user'         => $user,
        ]);
    }

    /**
     * Login user and create token
     */
    public function login(LoginRequest $request)
    {

        if (! Auth::attempt($request->only('email', 'password'))) {
            return HelperFunc::sendResponse(401, 'Invalid credentials', []);
        }

        $user  = User::where('email', $request->email)->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        return HelperFunc::sendResponse(200, 'Login successful', [
            'access_token' => $token,
            'token_type'   => 'Bearer',
            'user'         => $user,
        ]);
    }

    /**
     * Logout user (revoke token)
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return HelperFunc::sendResponse(200, 'Logout successful', []);
    }

    /**
     * Get authenticated user
     */
    public function me(Request $request)
    {
        return HelperFunc::sendResponse(200, 'User data retrieved successfully', $request->user());
    }
}

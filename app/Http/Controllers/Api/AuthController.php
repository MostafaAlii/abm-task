<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Api\{LoginRequest, RegisterRequest};
use App\Models\User;
use Illuminate\Support\Facades\{Auth,Hash};
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
class AuthController extends Controller {

    public function register(RegisterRequest $request): JsonResponse {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $token = $user->createToken('auth_token')->plainTextToken;
        return $this->successResponse([
            'user' => new UserResource($user),
            'token' => $token
        ], 'User registered successfully', 201);
    }

    public function login(LoginRequest $request): JsonResponse {
        try {
            if (!Auth::attempt($request->only('email', 'password'))) 
                return $this->errorResponse('Invalid credentials', 401);
            
            $user = User::where('email', $request->email)->first();
            $token = $user->createToken('auth_token')->plainTextToken;

            return $this->successResponse([
                'user' => new UserResource($user),
                'token' => $token
            ], "logged in successfully");
        } catch (\Throwable $e) {
            return $this->exceptionResponse($e);
        }
    }

    public function logout(): JsonResponse {
        Auth::user()->tokens()->delete();
        return $this->successResponse(null, 'logged out successfully');
    }
}

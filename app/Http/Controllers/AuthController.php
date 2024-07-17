<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(StoreUserRequest $request)
    {
        if(Auth::attempt($request->validated())) {
            $user = $this->userService->createUser($request->validated());

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([$token, $user],  200);
        }

        return response()->json(['message' => 'Unauthorized'], 400);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(Auth::attempt($credentials)) {
            $user = User::where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                throw ValidationException::withMessages([
                    'email' => ['The provided credentials are incorrect.'],
                ]);
            }

            $token = $user->createToken('auth_token')->plainTextToken;
            // return response()->json(([$token, $user]), 200);
            if($user->hasMedia('avatars')) {
                return redirect()->to('videos/create');
            } else {
                return redirect()->to('profile');
            }
        }

        return response()->json(['message' => 'Unauthorized'], 400);
    }

    public function updateProfile(UpdateUserRequest $request)
    {
        $user = User::find($request->id);

        if(!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $data = $request->validated();
        $updatedUser = $this->userService->updateUser($user, $data);

        // return response()->json(new UserResource($updatedUser), 200);
        return redirect()->to('videos/create');
    }

    public function logout(Request $request)
    {
        // $request->user()->currentAccessToken()->delete();

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // return response()->json(['message' => 'Successfully logged out'], 200);
        return redirect()->to('login');
    }

}

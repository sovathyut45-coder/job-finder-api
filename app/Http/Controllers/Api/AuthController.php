<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function test(){
       return response()->json(
        ['message' => 'Hello Controller']
       );
    }

    public function users(){
        $users = User::all();
        return response()->json($users);
    }

    public function user($id)
    {
        $user = User::find($id);

        return response()->json($user);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => 'User Registered Successfully',
            'user' => $user
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where(
            'email',
            $request->email
        )->first();

        if (!$user || !Hash::check(
                $request->password,
                $user->password
            )
        ) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        $token = $user
            ->createToken('flutter-app')
            ->plainTextToken;

        return response()->json([
            'message' => 'Login Success',
            'token' => $token,
            'user' => $user,
        ]);
    }

    public function profile(Request $request)
    {
        $user = $request->user();

        if ($user->avatar) {
            $user->avatar =
                asset('storage/' . $user->avatar);
        }

        return response()->json([
            'user' => $user
        ]);
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout Success'
        ]);
    }

    public function updateProfile(
        Request $request
    ) {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
        ]);

        $user = $request->user();

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return response()->json([
            'message' => 'Profile updated',
            'user' => $user,
        ]);
    }

    public function uploadAvatar(
        Request $request
    ) {

        $request->validate([
            'avatar' => 'required|image|max:2048',
        ]);

        $user = $request->user();

        if ($user->avatar) {

            Storage::disk('public')
                ->delete(
                    $user->avatar
                );
        }

        $path = $request
            ->file('avatar')
            ->store(
                'avatars',
                'public'
            );

        $user->update([
            'avatar' => $path,
        ]);

        return response()->json([
            'message' => 'Avatar uploaded',
            'avatar' =>
                asset(
                    'storage/' . $path
                ),
        ]);
    }
}

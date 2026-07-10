<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\ResetPasswordMail;

class ForgotPasswordController extends Controller
{
    public function sendResetLink(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ] , 422);
        }

        $user = User::where(
            'email' , $request->email
        )->first();

        if(!$user){
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ]);
        }

        $token = Str::random(64);
        DB::table('password_reset_tokens')->updateOrInsert(

            [
                'email' => $request->email
            ],

            [
                'token' => bcrypt($token),
                'created_at' => now()
            ]
        );

        $url = env('APP_URL')
            . '/reset-password?token='
            . $token . '&email='
            . urlencode($request->email);

        Mail::to($request->email)->send(new ResetPasswordMail($url));

        return response()->json([
            'success' => true,
            'message' => 'Password reset link sent successfully.'
        ]);
    }
}

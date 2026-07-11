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
use Illuminate\Support\Facades\Http;

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

        // Mail::to($request->email)->send(new ResetPasswordMail($url));
        $response = Http::withHeaders([
            'accept' => 'application/json',
            'api-key' => env('BREVO_API_KEY'),
            'content-type' => 'application/json',
        ])->post(
            'https://api.brevo.com/v3/smtp/email',
            [
                'sender' => [
                    'name' => env('MAIL_FROM_NAME'),
                    'email' => env('MAIL_FROM_ADDRESS'),
                ],

                'to' => [
                    [
                        'email' => $request->email,
                        'name' => $user->name,
                    ]
                ],

                'subject' => 'Reset Your Password',

                'htmlContent' => "
                    <h2>Job Finder</h2>

                    <p>Hello {$user->name},</p>

                    <p>Click the button below to reset your password.</p>

                    <a href='{$url}'
                       style='
                            background:#2563eb;
                            color:white;
                            padding:12px 20px;
                            text-decoration:none;
                            border-radius:6px;
                       '>
                        Reset Password
                    </a>

                    <p>This link expires in 60 minutes.</p>
                "
            ]
        );

        if (!$response->successful()) {

            return response()->json([
                'success' => false,
                'brevo' => $response->json(),
            ], 500);

        }

        return response()->json([
            'success' => true,
            'message' => 'Password reset link sent successfully.'
        ]);
    }
}

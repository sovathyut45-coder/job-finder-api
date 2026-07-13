<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;

class ResetPasswordController extends Controller
{
    public function resetPassword(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
            'token' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'error' => $validator->errors()
            ] , 422);
        }
        $reset = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        if(!$reset || !Hash::check($request->token, $reset->token)){
            return response()->json([
                'success' => false,
                'error' => 'Invalid token'
            ] , 400);
        }

        if (Carbon::parse($reset->created_at)->diffInMinutes(now()) > 60) {

            DB::table('password_reset_tokens')
                ->where('email', $reset->email)
                ->delete();

            return response()->json([
                'success' => false,
                'error' => 'Token expired'
            ], 400);
        }

        $user = User::where(
            'email' , $reset->email
        )->first();

        if(!$user){
            return response()->json([
                'success' => false,
                'error' => 'User not found'
            ] , 404);
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        DB::table('password_reset_tokens')
            ->where('email', $reset->email)
            ->delete();

        return redirect('/login-success')
            ->with('success', 'Password reset successfully.');
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ChangePasswordController extends Controller
{
    public function changePassword(Request $request){
        $validator= Validator::make($request->all(), [
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ] , 422);
        }

        $user = $request->user();
        if(!Hash::check($request->current_password, $user->password)){
            return response()->json([
                'success' => false,
                'errors' => 'Current password is incorrect'
            ] , 400);
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        // option 2
        //$user->password = Hash::make($request->password);
        //$user->save();

        $user->tokens()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Password changed successfully. Please login again.'
        ]);
    }
}

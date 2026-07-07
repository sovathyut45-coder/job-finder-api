<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AppliedJob;
use App\Models\SavedJob;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function stats(Request $request){
        $user = $request->user();
        return response()->json([
            'saved_jobs' => SavedJob::where('user_id', $user->id)->count(),
            'applied_jobs' => AppliedJob::where('user_id', $user->id)->count(),
            'pending' => AppliedJob::where('user_id', $user->id)->where('status', 'pending')->count(),
            'interview' => AppliedJob::where('user_id', $user->id)->where('status', 'Interview')->count(),
            'accepted' => AppliedJob::where('user_id', $user->id)->where('status', 'Accepted')->count(),
            'rejected' => AppliedJob::where('user_id', $user->id)->where('status', 'Rejected')->count(),
        ]);
    }
}

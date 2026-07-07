<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\SavedJob;

class SavedJobController extends Controller
{
    public function toggle(Request $request)
    {
        $request->validate([
            'job_id'   => 'required|string|max:100',
            'title'    => 'nullable',
            'company'  => 'nullable',
            'location' => 'nullable',
            //'job_type' => 'required|string',
            'logo'     => 'nullable',
            'url'      => 'nullable',
        ]);

        $user = $request->user();

        $savedJob = SavedJob::where('user_id', $user->id)
            ->where('job_id', $request->job_id)
            ->first();

        // If already saved, remove it
        if ($savedJob) {
            $savedJob->delete();

            return response()->json([
                'message' => 'Job unsaved successfully.',
                'saved'   => false,
            ]);
        }
        Log::info($request->all());
        // Otherwise save it
        SavedJob::create([
            'user_id'  => $user->id,
            'job_id'   => $request->job_id,
            'title'    => $request->title,
            'company'  => $request->company,
            'location' => $request->location,
            //'job_type' => $request->job_type,
            'url'      => $request->url,
            'logo'     => $request->logo,
        ]);

        return response()->json([
            'message' => 'Job saved successfully.',
            'saved'   => true,
        ]);
    }

    public function index(Request $request)
    {
        $user = $request->user();

        $savedJobs = SavedJob::where('user_id', $user->id)
            ->latest()
            ->get();

        return response()->json([
            'message' => 'Saved jobs fetched successfully',
            'saved_jobs' => $savedJobs,
        ]);
    }

    public function destroy(Request $request,$id) {

        $savedJob = SavedJob::where(
                'id',
                $id
            )
            ->where(
                'user_id',
                $request->user()->id
            )
            ->first();

        if (!$savedJob) {

            return response()->json([
                'message' => 'Saved job not found.',
            ], 404);

        }

        $savedJob->delete();

        return response()->json([
            'message' => 'Job unsaved successfully.',
            'saved' => false,
        ]);
    }

    public function clear(Request $request){
        SavedJob::where('user_id', $request->user()->id)->delete();

        return response()->json([
            'message' => 'All saved jobs cleared successfully',
        ]);
    }
}

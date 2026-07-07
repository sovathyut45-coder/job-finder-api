<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AppliedJob;
use Illuminate\Http\Request;

class AppliedJobController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'job_id'   => 'required|string|max:100',
            'title'    => 'nullable',
            'company'  => 'nullable',
            'location' => 'nullable',
            'logo'     => 'nullable',
            'url'      => 'nullable',
        ]);
        $user = $request->user();

        $appliedJob = AppliedJob::where('user_id', $user->id)
            ->where('job_id', $request->job_id)
            ->first();

        if($appliedJob){
           return response()->json([
            'message' => 'You have already applied.',
           ],409);
        }
        AppliedJob::create([
            'user_id' => $user->id,
            'job_id' => $request->job_id,
            'title' => $request->title,
            'company' => $request->company,
            'location' => $request->location,
            'logo' => $request->logo,
            'url' => $request->url,
            'status' => 'pending',
        ]);
        return response()->json([
            'message' => 'Job Applied Successfully',
            'applied' => true
        ]);
    }

    public function index(Request $request){
        $user = $request->user();
        $appliedJob = AppliedJob::where('user_id', $user->id)
            ->latest()
            ->get();
        return response()->json([
            'message' => 'Applied jobs fetched successfully',
            'applied_jobs' => $appliedJob,
        ]);
    }

    public function destroy(Request $request,$id){
        $appliedJob = AppliedJob::where(
            'id',$id)->where('user_id',$request->user()->id)
        ->first();

        if (!$appliedJob) {
            return response()->json([
                'message' => 'Applied job not found.',
            ], 404);
        }

        $appliedJob->delete();

        return response()->json([
            'message' => 'Job unapplied successfully.',
            'applied' => false,
        ]);
    }

    public function updateStatus(Request $request, $id){
        $request->validate([
            'status' => 'required|in:pending,Interview,Accepted,Rejected',
        ]);
        $user = $request->user();

        $appliedJob = AppliedJob::where('id', $id)
            ->where('user_id', $user->id)->first();

        if (!$appliedJob) {
            return response()->json([
                'message' => 'Applied job not found.',
            ], 404);
        }
        $appliedJob->update([
            'status' => $request->status
        ]);

        return response()->json([
            'message' => 'Status updated successfully',
            'applied_job' => $appliedJob,
        ]);
    }

    public function updateNotes(Request $request, $id)
    {
        $request->validate([
            'notes' => 'nullable|string|max:1000',
        ]);

        $user = $request->user();

        $appliedJob = AppliedJob::where('id', $id)
            ->where('user_id', $user->id)
            ->first();

        if (!$appliedJob) {
            return response()->json([
                'message' => 'Applied job not found.',
            ], 404);
        }

        $appliedJob->update([
            'notes' => $request->notes,
        ]);

        return response()->json([
            'message' => 'Notes updated successfully.',
            'applied_job' => $appliedJob,
        ]);
    }

    public function clear(Request $request){
        AppliedJob::where('user_id', $request->user()->id)->delete();

        return response()->json([
            'message' => 'All applied jobs cleared successfully',
        ]);
    }
}

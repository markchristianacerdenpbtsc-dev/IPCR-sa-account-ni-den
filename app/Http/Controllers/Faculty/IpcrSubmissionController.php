<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use App\Models\IpcrSubmission;
use Illuminate\Http\Request;

class IpcrSubmissionController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'school_year' => ['required', 'string', 'max:20'],
            'semester' => ['required', 'string', 'max:50'],
            'table_body_html' => ['required', 'string'],
        ]);

        $submission = IpcrSubmission::create([
            'user_id' => $request->user()->id,
            'title' => $validated['title'],
            'school_year' => $validated['school_year'],
            'semester' => $validated['semester'],
            'table_body_html' => $validated['table_body_html'],
            'status' => 'submitted',
            'submitted_at' => now(),
        ]);

        return response()->json([
            'message' => 'IPCR submitted successfully',
            'id' => $submission->id,
        ]);
    }
}

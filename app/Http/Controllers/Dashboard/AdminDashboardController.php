<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\IpcrSubmission;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function index(Request $request): View
    {
        $departmentId = $request->get('department_id');

        $departments = Department::orderBy('name')->get();
        $submissions = IpcrSubmission::with(['user.department'])
            ->when($departmentId, function ($query) use ($departmentId) {
                $query->whereHas('user', function ($userQuery) use ($departmentId) {
                    $userQuery->where('department_id', $departmentId);
                });
            })
            ->orderByDesc('submitted_at')
            ->get();

        return view('dashboard.admin.index', [
            'departments' => $departments,
            'submissions' => $submissions,
            'selectedDepartmentId' => $departmentId,
        ]);
    }
}
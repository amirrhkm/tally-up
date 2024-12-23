<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Leave;
use App\Models\Staff;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    public function index($staff_id)
    {
        $staff = Staff::findOrFail($staff_id);
        $leaveApplications = $staff->leaves;

        $mc_used = $leaveApplications->where('leave_type', 'MC')->sum('total_days');
        $al_used = $leaveApplications->where('leave_type', 'AL')->sum('total_days');
        $ul_used = $leaveApplications->where('leave_type', 'UL')->sum('total_days');

        return view('staff.leave', compact('staff', 'leaveApplications', 'mc_used', 'al_used', 'ul_used'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'staff_id' => 'required|exists:staff,id',
            'leave_type' => 'required|in:MC,AL,UL',
        ]);

        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);
        $totalDays = $startDate->diffInDays($endDate) + 1;

        Leave::create($validatedData + ['total_days' => $totalDays] + ['start_date' => $startDate] + ['end_date' => $endDate]);

        return redirect()->route('staff.leave', $validatedData['staff_id'])->with('success', 'Leave application submitted successfully.');
    }

    public function destroy(Leave $leave)
    {
        $leave->delete();
        return redirect()->route('staff.leave', $leave->staff_id)->with('success', 'Leaves deleted successfully.');
    }
}

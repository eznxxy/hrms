<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLeaveRequest;
use App\Http\Requests\StoreResignationRequest;
use App\Models\Leave;
use App\Models\LeaveCategory;
use App\Models\Resignation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    public function index()
    {
        return view('pages.leave.index');
    }

    public function create()
    {
        return view('pages.leave.create');
    }

    public function show(Leave $leave)
    {
        if ((Auth::user()->role->name == 'admin' || (Auth::user()->role->name == 'hr' && Auth::user()->employee->id != $leave->employee_id)) && $leave->status == 'sent') {
            $leave->status = 'in review';
            $leave->save();
        }

        return view('pages.leave.show')->with(compact('leave'));
    }

    public function store(StoreLeaveRequest $request)
    {
        $data = $request->validated();

        if ($data['start_at'] <= Carbon::now()) {
            return redirect()->back()->with('error', __('Start date cant be less then today.'));
        }

        if ($data['start_at'] >= $data['end_at']) {
            return redirect()->back()->with('error', __('Start date cant greater than end date'));
        }

        $data['status'] = 'sent';

        $leave = Leave::create($data);

        return redirect()->route('leaves.index')->with('success', __('Success, your leave successfully submitted at ' . Carbon::parse($leave->created_at)->format('d M Y') . ' - '. Carbon::parse($leave->created_at)->format('d M Y')));
    }

    public function edit(Leave $leave)
    {
        $leave_categories = LeaveCategory::get();
        return view('pages.leave.edit')->with(compact('leave', 'leave_categories'));
    }
}

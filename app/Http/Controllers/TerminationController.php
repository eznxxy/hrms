<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTerminationRequest;
use App\Models\Structural;
use App\Models\Termination;
use App\Models\TerminationCategory;
use Carbon\Carbon;

class TerminationController extends Controller
{
    public function index()
    {
        return view('pages.termination.index');
    }

    public function create()
    {
        return view('pages.termination.create');
    }

    public function show(Termination $termination)
    {
        return view('pages.termination.show')->with(compact('termination'));
    }

    public function store(StoreTerminationRequest $request)
    {
        $data = $request->validated();

        $terminatedEmployee = Termination::where('employee_id', $data['employee_id'])->first();

        if ($data['noticed_at'] > $data['terminated_at']) {
            return redirect()->back()->with('error', __('Notice date cant greater than terminated date'));
        }

        if ($terminatedEmployee != null) {
            return redirect()->back()->with('error', __($terminatedEmployee->employee->full_name . ' already terminated at ' . Carbon::parse($terminatedEmployee->terminated_at)->format('d M Y')));
        }

        Structural::where('employee_id', $data['employee_id'])->where('status', 'active')->update(['status' => 'inactive']);

        $termination = Termination::create($data);

        return redirect()->route('terminations.index')->with('success', __('Success, ' . $termination->employee->full_name . ' has been terminated and will be noticed at ' . Carbon::parse($termination->noticed_at)->format('d M Y')));
    }

    public function edit(Termination $termination)
    {
        $termination_categories = TerminationCategory::get();
        return view('pages.termination.edit')->with(compact('termination', 'termination_categories'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIncentiveRequest;
use App\Models\Employee;
use App\Models\Incentive;
use Illuminate\Support\Facades\Auth;

class IncentiveController extends Controller
{
    public function index()
    {
        return view('pages.incentive.index');
    }

    public function create()
    {
        $employees = Employee::where('id', '!=', Auth::user()->employee->id ?? 0)->get();
        return view('pages.incentive.create')->with(compact('employees'));
    }

    public function store(StoreIncentiveRequest $request)
    {
        $data = $request->validated();

        $incentive = Incentive::create($data);

        return redirect()->route('incentives.index')->with('success', __('A new incentive has been successfully added'));
    }

    public function edit(Incentive $incentive)
    {
        return view('pages.incentive.edit')->with(compact('incentive'));
    }
}

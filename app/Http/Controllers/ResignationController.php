<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreResignationRequest;
use App\Http\Requests\StoreTerminationRequest;
use App\Models\Resignation;
use App\Models\Termination;
use App\Models\TerminationCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResignationController extends Controller
{
    public function index()
    {
        return view('pages.resignation.index');
    }

    public function create()
    {
        return view('pages.resignation.create');
    }

    public function show(Resignation $resignation)
    {
        if ((Auth::user()->role->name == 'admin' || (Auth::user()->role->name == 'hr' && Auth::user()->employee->id != $resignation->employee_id)) && $resignation->status == 'sent') {
            $resignation->status = 'in review';
            $resignation->save();
        }

        return view('pages.resignation.show')->with(compact('resignation'));
    }

    public function store(StoreResignationRequest $request)
    {
        $data = $request->validated();

        $dataResign = Resignation::where('employee_id', $data['employee_id'])->first();

        if ($data['noticed_at'] >= $data['resigned_at']) {
            return redirect()->back()->with('error', __('Notice date cant greater than resigned date'));
        }

        if ($dataResign != null) {
            return redirect()->back()->with('error', __('You have submitted your resignation at ' . Carbon::parse($dataResign->created_at)->format('d M Y')));
        }

        $data['status'] = 'sent';

        $resignation = Resignation::create($data);

        return redirect()->route('resignations.index')->with('success', __('Success, your resignation successfully submitted at ' . Carbon::parse($resignation->created_at)->format('d M Y')));
    }

    public function edit(Resignation $resignation)
    {
        return view('pages.resignation.edit')->with(compact('resignation'));
    }
}

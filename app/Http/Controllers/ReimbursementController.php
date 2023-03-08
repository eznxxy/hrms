<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReimbursementRequest;
use App\Http\Requests\UpdateReimbursementRequest;
use App\Models\Employee;
use App\Models\Reimbursement;
use Illuminate\Support\Facades\Auth;

class ReimbursementController extends Controller
{
    public function index()
    {
        return view('pages.reimbursement.index');
    }

    public function create()
    {
        return view('pages.reimbursement.create');
    }

    public function show(Reimbursement $reimbursement)
    {
        return view('pages.reimbursement.show')->with(compact('reimbursement'));
    }

    public function store(StoreReimbursementRequest $request)
    {
        $data = $request->validated();
        $data['employee_id'] = Auth::user()->employee->id;

        $reimbursement = new Reimbursement();

        if ($request->has('image')) {
            if (!$request->file('image')->storePublicly($reimbursement->getImagePath(), ['disk' => 'public'])) {
                abort(500, __("Image couldn't be saved, please try again"));
            }

            $data['image'] = $request->file('image')->hashName();
        }

        $reimbursement = Reimbursement::create($data);

        return redirect()->route('reimbursements.index')->with('success', __('A new reimbursement has been successfully added'));
    }

    public function edit(Reimbursement $reimbursement)
    {
        return view('pages.reimbursement.edit')->with(compact('reimbursement'));
    }

    public function update(Reimbursement $reimbursement, UpdateReimbursementRequest $request)
    {
        $data = $request->validated();

        if ($request->has('image')) {
            if (!$request->file('image')->storePublicly($reimbursement->getImagePath(), ['disk' => 'public'])) {
                abort(500, __("Image couldn't be saved, please try again"));
            }

            $data['image'] = $request->file('image')->hashName();
        }

        $reimbursement->update($data);

        return redirect()->route('reimbursements.index')->with('success', __('Reimbursement has been successfully edited'));
    }
}

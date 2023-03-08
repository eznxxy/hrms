<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStructuralRequest;
use App\Models\Division;
use App\Models\Structural;

class StructuralController extends Controller
{
    public function create()
    {
        $divisions = Division::get();
        $structurals = Structural::orderByDesc('created_at')->get();
        return view('pages.structural.create')->with(compact(['divisions', 'structurals']));
    }

    public function store(StoreStructuralRequest $request)
    {
        $data = $request->validated();

        $structural = new Structural();

        $oldStructural = $structural->where('employee_id', $data['employee_id'])->where('status', 'active')->update(['status' => 'not active']);

        $structural->create([
            'employee_id' => $data['employee_id'],
            'position_id' => $data['position_id'],
            'code' => $data['code'],
            'status' => 'active',
        ]);

        return redirect()->route('structurals.create')->with('success', __('Position has been assigned.'));
    }
}

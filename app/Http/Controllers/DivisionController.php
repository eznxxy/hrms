<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDivisionRequest;
use App\Models\Division;

class DivisionController extends Controller
{
    public function index()
    {
        return view('pages.division.index');
    }

    public function create()
    {
        return view('pages.division.create');
    }

    public function store(StoreDivisionRequest $request)
    {
        $data = $request->validated();

        $division = Division::create([
            'code' => $data['code'],
            'name' => $data['name'],
        ]);

        return redirect()->route('divisions.index')->with('success', __('A new division has been successfully added'));
    }

    public function edit(Division $division)
    {
        return view('pages.division.edit')->with(compact('division'));
    }
}

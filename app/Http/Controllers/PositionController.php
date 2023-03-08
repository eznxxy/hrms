<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePositionRequest;
use App\Models\Division;
use App\Models\Position;

class PositionController extends Controller
{
    public function index()
    {
        return view('pages.position.index');
    }

    public function create()
    {
        $divisions = Division::get();
        return view('pages.position.create')->with(compact('divisions'));
    }

    public function store(StorePositionRequest $request)
    {
        $data = $request->validated();

        $lastCode = Position::select('code')->latest('id')->first();

        $position = Position::create([
            'division_id' => $data['division_id'],
            'code' => 'PS-0'.explode("-",$lastCode->code)[1] + 1,
            'name' => $data['name'],
        ]);

        return redirect()->route('positions.index')->with('success', __('A new division has been successfully added'));
    }

    public function edit(Position $position)
    {
        $divisions = Division::get();
        return view('pages.position.edit')->with(compact('position', 'divisions'));
    }
}

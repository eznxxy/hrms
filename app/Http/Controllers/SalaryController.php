<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSalaryRequest;
use App\Models\Position;
use App\Models\Salary;

class SalaryController extends Controller
{
    public function index()
    {
        return view('pages.salary.index');
    }

    public function create()
    {
        $positions = Position::doesntHave('salary')->get();
        return view('pages.salary.create')->with(compact('positions'));
    }

    public function store(StoreSalaryRequest $request)
    {
        $data = $request->validated();

        $salary = Salary::create($data);

        return redirect()->route('salaries.index')->with('success', __('A new salary has been successfully added'));
    }

    public function edit(Salary $salary)
    {
        return view('pages.salary.edit')->with(compact('salary'));
    }
}

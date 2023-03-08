<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSalaryRequest;
use App\Models\Salary;
use App\Transformers\SalaryTransformer;
use Yajra\DataTables\Facades\DataTables;

class SalaryController extends Controller
{
    public function index()
    {
        $salaries = Salary::join('positions', 'positions.id', '=', 'salaries.position_id')
            ->select(['salaries.*', 'positions.name as position_name'])
            ->orderBy('created_at', 'desc');

        return DataTables::of($salaries)
            ->filter(function ($query) {
                if (!empty(request('search.value'))) {
                    $term = request('search.value');

                    $query->where('positions.name', 'ilike', "%{$term}%");
                }
            })
            ->setTransformer(new SalaryTransformer)
            ->make(true);
    }

    public function update(Salary $salary, UpdateSalaryRequest $request)
    {
        $data = $request->validated();

        $salary->update($data);

        return response()->json([
            'message' => __('Success, data salary has been updated.')
        ]);
    }
}

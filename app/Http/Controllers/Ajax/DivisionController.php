<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateDivisionRequest;
use App\Models\Division;
use App\Models\Employee;
use App\Transformers\DivisionTransformer;
use Yajra\DataTables\Facades\DataTables;

class DivisionController extends Controller
{
    public function index()
    {
        $divisions = Division::orderByDesc('created_at');

        return DataTables::of($divisions)
            ->setTransformer(new DivisionTransformer)
            ->make(true);
    }

    public function update(Division $division, UpdateDivisionRequest $request)
    {
        $data = $request->validated();

        $division->update($data);

        return response()->json([
            'message' => __('Success, data ' . $division->name . ' has been updated.')
        ]);
    }

    public function destroy(Division $division)
    {
        $positions = $division->positions->pluck('id');
        $employee = Employee::whereHas('structurals', function ($query) use ($positions) {
            $query->whereIn('position_id', $positions);
        })->count();

        if ($employee != 0) {
            return response()->json([
                'errors' => [
                    'message' => [
                        0 => __('Error, there are employees who are in this division. Please assign to another division first!')
                    ]
                ]
            ], 422);
        }

        $division->delete();

        return response()->json([
            'message' => __('Success, ' . $division->name . ' has been deleted.')
        ]);
    }
}

<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStructuralRequest;
use App\Models\Structural;

class StructuralController extends Controller
{
    public function store(StoreStructuralRequest $request)
    {
        $data = $request->validated();

        Structural::create([
            'employee_id' => $data['employee_id'],
            'position_id' => $data['position_id'],
            'code' => 'new',
            'status' => 'active',
        ]);

        return response()->json([
            'message' => __('Success, position has been assigned.')
        ]);
    }
}

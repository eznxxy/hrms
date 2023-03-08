<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFamilyRequest;
use App\Models\Family;

class FamilyController extends Controller
{
    public function store(StoreFamilyRequest $request)
    {
        $data = $request->validated();
        $data['phonecode'] = 62;

        Family::create($data);

        return response()->json([
            'message' => __('Success, family has been added.')
        ]);
    }
}

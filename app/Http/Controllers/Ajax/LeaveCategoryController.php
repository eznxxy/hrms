<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLeaveCategoryRequest;
use App\Models\LeaveCategory;
use App\Transformers\LeaveCategoryTransformer;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LeaveCategoryController extends Controller
{
    public function index()
    {
        $leave_category = LeaveCategory::orderByDesc('created_at');

        return DataTables::of($leave_category)
            ->setTransformer(new LeaveCategoryTransformer)
            ->addIndexColumn()
            ->make(true);
    }

    public function getLeaveCategories(Request $request)
    {
        $term = trim($request->term);

        $leave_category = LeaveCategory::select(['id', 'name as text'])
            ->where(function ($query) use ($term) {
                $query->where('name', 'ilike',  "%{$term}%");
            })
            ->orderBy('name', 'asc')
            ->simplePaginate(10);

        $morePages = true;

        if (empty($leave_category->nextPageUrl())) {
            $morePages = false;
        }

        $results = array(
            "results" => $leave_category->items(),
            "pagination" => array(
                "more" => $morePages
            )
        );

        return response()->json($results);
    }

    public function store(StoreLeaveCategoryRequest $request)
    {
        $data = $request->validated();

        LeaveCategory::create($data);

        return response()->json([
            'message' => __('Success, a new leave category has been successfully added')
        ]);
    }

    public function destroy(LeaveCategory $leave_category)
    {
        $leave_category->delete();

        return response()->json([
            'message' => __('Success, ' . $leave_category->name . ' has been deleted.')
        ]);
    }
}

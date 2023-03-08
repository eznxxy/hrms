<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTerminationCategoryRequest;
use App\Models\TerminationCategory;
use App\Transformers\TerminationCategoryTransformer;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TerminationCategoryController extends Controller
{
    public function index()
    {
        $termination_category = TerminationCategory::orderByDesc('created_at');

        return DataTables::of($termination_category)
            ->setTransformer(new TerminationCategoryTransformer)
            ->addIndexColumn()
            ->make(true);
    }

    public function getTerminationCategories(Request $request)
    {
        $term = trim($request->term);

        $termination_category = TerminationCategory::select(['id', 'name as text'])
            ->where(function ($query) use ($term) {
                $query->where('name', 'ilike',  "%{$term}%");
            })
            ->orderBy('name', 'asc')
            ->simplePaginate(10);

        $morePages = true;

        if (empty($termination_category->nextPageUrl())) {
            $morePages = false;
        }

        $results = array(
            "results" => $termination_category->items(),
            "pagination" => array(
                "more" => $morePages
            )
        );

        return response()->json($results);
    }

    public function store(StoreTerminationCategoryRequest $request)
    {
        $data = $request->validated();

        TerminationCategory::create($data);

        return response()->json([
            'message' => __('Success, a new termination category has been successfully added')
        ]);
    }

    public function destroy(TerminationCategory $termination_category)
    {
        $termination_category->delete();

        return response()->json([
            'message' => __('Success, ' . $termination_category->name . ' has been deleted.')
        ]);
    }
}

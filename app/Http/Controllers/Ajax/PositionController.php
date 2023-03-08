<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePositionRequest;
use App\Models\Position;
use App\Transformers\PositionTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PositionController extends Controller
{
    public function index()
    {
        // $positions = Position::with('division')
        // ->orderByDesc('created_at')->get();

        $positions = Position::join('divisions', 'divisions.id', '=', 'positions.division_id')
            ->select(['positions.*', 'divisions.name as division_name'])
            ->orderBy('created_at', 'desc');

        return DataTables::of($positions)
            ->filter(function ($query) {
                if (!empty(request('search.value'))) {
                    $term = request('search.value');

                    $query->where('positions.name', 'ilike', "%{$term}%")
                        ->orWhere('divisions.name', 'ilike', "%{$term}%");
                }
            })
            ->orderColumn('division_name', function ($query, $order) {
                $query->orderBy('divisions.name', $order);
            })
            ->setTransformer(new PositionTransformer)
            ->make(true);
    }

    public function getPositionByDivision(Request $request)
    {
        $term = trim($request->term);
        $positions = Position::query();
        $positions->select('id', 'name as text')
            ->where('division_id', $request->divisionId)
            ->where('name', 'ilike',  "%{$term}%");

        if (Auth::user()->role->name != 'admin') {
            $positions->where('name', '!=',  'HR');
        }

        $resultPositions = $positions->orderBy('name', 'asc')->simplePaginate(10);

        $morePages = true;

        if (empty($resultPositions->nextPageUrl())) {
            $morePages = false;
        }

        $results = array(
            "results" => $resultPositions->items(),
            "pagination" => array(
                "more" => $morePages
            )
        );

        return response()->json($results);
    }

    public function update(Position $position, UpdatePositionRequest $request)
    {
        $data = $request->validated();

        $position->update($data);

        return response()->json([
            'message' => __('Success, data ' . $position->name . ' has been updated.')
        ]);
    }

    public function destroy(Position $position)
    {
        $position->delete();

        return response()->json([
            'message' => __('Success, ' . $position->name . ' has been deleted.')
        ]);
    }
}

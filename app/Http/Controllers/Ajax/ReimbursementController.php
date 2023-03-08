<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Reimbursement;
use App\Transformers\ReimbursementTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ReimbursementController extends Controller
{
    public function index()
    {
        $reimbursements = Reimbursement::query();

        $reimbursements->join('employees', 'employees.id', '=', 'reimbursements.employee_id')
            ->select(['reimbursements.*', DB::raw("CONCAT(employees.first_name, ' ', employees.last_name) as employee_name")]);

        if (Auth::user()->role->id == 3) {
            $reimbursements->where('reimbursements.employee_id', Auth::user()->employee->id);
        }

        $resultReimbursement = $reimbursements->orderBy('created_at', 'desc');

        return DataTables::of($resultReimbursement)
            ->filter(function ($query) {
                if (!empty(request('search.value'))) {
                    $term = request('search.value');

                    $query->where('first_name', 'ilike', "%{$term}%")
                        ->orWhere('last_name', 'ilike', "%{$term}%")
                        ->orWhere('reimbursements.name', 'ilike', "%{$term}%");
                }
            })
            ->setTransformer(new ReimbursementTransformer)
            ->make(true);
    }

    public function updateStatus(Reimbursement $reimbursement, Request $request)
    {
        if ($reimbursement->status != 'pending') {
            return response()->json([
                'errors' => [
                    'message' => [
                        0 => __('Failed, You cant update status reimbursement if status not pending')
                    ]
                ]
            ], 409);
        }
        $reimbursement->status = $request->status;
        $reimbursement->save();

        return response()->json([
            'message' => __('Success, reimbursement submission has been '. $request->status)
        ]);
    }

    public function destroy(Reimbursement $reimbursement)
    {
        $reimbursement->deleteImage();
        $reimbursement->delete();

        return response()->json([
            'message' => __('Success, reimbursement has been deleted.')
        ]);
    }
}

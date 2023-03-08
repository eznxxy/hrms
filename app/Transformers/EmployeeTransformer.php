<?php

namespace App\Transformers;

use App\Models\Employee;
use League\Fractal\TransformerAbstract;

class EmployeeTransformer extends TransformerAbstract
{
    /**
     * @return  array
     */
    public function transform(Employee $employee)
    {
        return [
            'code' => $employee->code,
            'full_name' => $employee->full_name,
            'date_of_birth' => $employee->age(),
            'gender' => $employee->gender,
            'address' => $employee->address,
            'phone' => $employee->phone,
            'religion' => $employee->religion,
            'actions' => view('partials.employee.table-action', compact('employee'))->render(),
        ];
    }
}

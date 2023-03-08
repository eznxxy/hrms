<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Models\Division;
use App\Models\Employee;
use App\Models\Family;
use App\Models\Structural;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('pages.employee.index');
    }

    public function show(Employee $employee)
    {
        $structurals = Structural::where('employee_id', $employee->id)->orderBy('created_at', 'DESC')->get();
        $structural = $structurals->where('status', 'active')->first();
        $divisions = Division::get();

        return view('pages.employee.show')->with(compact(['employee', 'structurals', 'structural', 'divisions']));
    }

    public function create()
    {
        $divisions = Division::get();
        return view('pages.employee.create')->with(compact('divisions'));
    }

    public function store(StoreEmployeeRequest $request)
    {
        $role = 3;
        $timestamp = Carbon::now();
        $employee = new Employee();

        $lastCodeEmployee = (int)explode("-",$employee->orderBy('id', 'desc')->first()->code)[1];

        $data = $request->validated();

        if ($request->has('avatar')) {
            if (!$request->file('avatar')->storePublicly($employee->getAvatarPath(), ['disk' => 'public'])) {
                abort(500, __("Image couldn't be saved, please try again"));
            }

            $data['avatar'] = $request->file('avatar')->hashName();
        }

        if (isset($data['position_id']) && $data['position_id'] == 3) {
            $role = 2;
        }

        $user = User::create([
            'role_id' => $role, // 3 = Employee
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $employee = Employee::create([
            'user_id' => $user->id,
            'code' => 'ECQA-'.$lastCodeEmployee +1 .'-'. $timestamp->format('myHi'),
            'nik' => $data['nik'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'date_of_birth' => $data['date_of_birth'],
            'place_of_birth' => $data['place_of_birth'],
            'gender' => $data['gender'],
            'address' => $data['address'],
            'phonecode' => 62,
            'phone' => str_replace(' ', '', $data['phone']),
            'religion' => $data['religion'],
            'avatar' => $data['avatar'] ?? null,
            'status' => 'active',
        ]);

        if (isset($data['position_id'])) {
            Structural::create([
                'employee_id' => $employee->id,
                'position_id' => $data['position_id'],
                'code' => 'new',
                'status' => 'active',
            ]);
        }

        return redirect()->route('employees.index')->with('success', __('A new employee has been successfully added'));
    }

    public function edit(Employee $employee)
    {
        return view('pages.employee.edit')->with(compact('employee'));
    }
}

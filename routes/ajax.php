<?php

use App\Http\Controllers\Ajax\AnnouncementController;
use App\Http\Controllers\Ajax\EmployeeController;
use App\Http\Controllers\Ajax\DivisionController;
use App\Http\Controllers\Ajax\DocumentController;
use App\Http\Controllers\Ajax\FamilyController;
use App\Http\Controllers\Ajax\IncentiveController;
use App\Http\Controllers\Ajax\LeaveCategoryController;
use App\Http\Controllers\Ajax\LeaveController;
use App\Http\Controllers\Ajax\PayrollController;
use App\Http\Controllers\Ajax\PositionController;
use App\Http\Controllers\Ajax\ProfileController;
use App\Http\Controllers\Ajax\ReimbursementController;
use App\Http\Controllers\Ajax\ResignationController;
use App\Http\Controllers\Ajax\SalaryController;
use App\Http\Controllers\Ajax\StructuralController;
use App\Http\Controllers\Ajax\TerminationCategoryController;
use App\Http\Controllers\Ajax\TerminationController;
use App\Models\TerminationCategory;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth', 'role:admin,hr'])->group(function () {
    //Structurals
    Route::post('/structurals/store', [StructuralController::class, 'store'])->name('structurals.store');

    //Announcements
    Route::post('/announcements/store', [AnnouncementController::class, 'store'])->name('announcements.store');
    Route::post('/announcements/{announcement}/update', [AnnouncementController::class, 'update'])->name('announcements.update');
    Route::delete('/announcements/{announcement}/destroy', [AnnouncementController::class, 'destroy'])->name('announcements.destroy');

    //Documents
    Route::delete('/documents/{document}/destroy', [DocumentController::class, 'destroy'])->name('documents.destroy');

    // Employees
    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
    Route::get('/employees/get-employees', [EmployeeController::class, 'getEmployees'])->name('employees.getEmployees');
    Route::post('/employees/{employee}/update', [EmployeeController::class, 'update'])->name('employees.update');

    //Termination
    Route::get('/terminations', [TerminationController::class, 'index'])->name('terminations.index');
    Route::post('/terminations/{termination}/update', [TerminationController::class, 'update'])->name('terminations.update');

    //Resignation
    Route::post('/resignations/{resignation}/update', [ResignationController::class, 'update'])->name('resignations.update');
    Route::post('/resignations/{resignation}/update-status', [ResignationController::class, 'updateStatus'])->name('resignations.update_status');

    //Leave
    Route::post('/leaves/{leave}/update-status', [LeaveController::class, 'updateStatus'])->name('leaves.update_status');

    //Salary
    Route::get('/salaries', [SalaryController::class, 'index'])->name('salaries.index');
    Route::post('/salaries/{salary}/update', [SalaryController::class, 'update'])->name('salaries.update');

    //Incentive
    Route::post('/incentives/{incentive}/update', [IncentiveController::class, 'update'])->name('incentives.update');
    Route::delete('/incentives/{incentive}/destroy', [IncentiveController::class, 'destroy'])->name('incentives.destroy');

    //Payroll
    Route::post('/payrolls/generate', [PayrollController::class, 'generate'])->name('payrolls.generate');
    Route::post('/payrolls/pay', [PayrollController::class, 'pay'])->name('payrolls.pay');

    //Profile
    Route::post('/profiles/{profile}/update', [ProfileController::class, 'update'])->name('profiles.update');
    Route::post('/profiles/{profile}/update-logo', [ProfileController::class, 'updateLogo'])->name('profiles.update_logo');

    //Position
    Route::get('/positions/getPositionByDivision', [PositionController::class, 'getPositionByDivision'])->name('positions.getPositionByDivision');

    //Reimbursement
    Route::post('/reimbursements/{reimbursement}/update-status', [ReimbursementController::class, 'updateStatus'])->name('reimbursements.update_status');

    //Termination Category
    Route::get('/termination-categories/get-categories', [TerminationCategoryController::class, 'getTerminationCategories'])->name('termination_categories.get_categories');

    //Leave Category
    Route::get('/leave-categories/get-categories', [LeaveCategoryController::class, 'getTerminationCategories'])->name('leave_categories.get_categories');
});

Route::middleware(['auth', 'role:hr'])->group(function () {
    //
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    //Termination Category
    Route::get('/termination-categories', [TerminationCategoryController::class, 'index'])->name('termination_categories.index');
    Route::post('/termination-categories/store', [TerminationCategoryController::class, 'store'])->name('termination_categories.store');
    Route::delete('/termination-categories/{termination_category}/destroy', [TerminationCategoryController::class, 'destroy'])->name('termination_categories.destroy');

    //Leave Category
    Route::get('/leave-categories', [LeaveCategoryController::class, 'index'])->name('leave_categories.index');
    Route::post('/leave-categories/store', [LeaveCategoryController::class, 'store'])->name('leave_categories.store');
    Route::delete('/leave-categories/{leave_category}/destroy', [LeaveCategoryController::class, 'destroy'])->name('leave_categories.destroy');

    //Divisions
    Route::get('/divisions', [DivisionController::class, 'index'])->name('divisions.index');
    Route::post('/divisions/{division}/update', [DivisionController::class, 'update'])->name('divisions.update');
    Route::delete('/divisions/{division}/destroy', [DivisionController::class, 'destroy'])->name('divisions.destroy');

    //Positions
    Route::get('/positions', [PositionController::class, 'index'])->name('positions.index');
    Route::post('/positions/{position}/update', [PositionController::class, 'update'])->name('positions.update');
    Route::delete('/positions/{position}/destroy', [PositionController::class, 'destroy'])->name('positions.destroy');

    // Employees
    Route::delete('/employees/{employee}/destroy', [EmployeeController::class, 'destroy'])->name('employees.destroy');

    //Resignation
    Route::delete('/resignations/{resignation}/destroy', [ResignationController::class, 'destroy'])->name('resignations.destroy');

    //Leave
    Route::delete('/leaves/{leave}/destroy', [LeaveController::class, 'destroy'])->name('leaves.destroy');

    //Termination
    Route::delete('/terminations/{termination}/destroy', [TerminationController::class, 'destroy'])->name('terminations.destroy');

    //Reimbursement
    Route::delete('/reimbursements/{reimbursement}/destroy', [ReimbursementController::class, 'destroy'])->name('reimbursements.destroy');
});

Route::middleware(['auth'])->group(function () {
    //Announcements
    Route::get('/announcements', [AnnouncementController::class, 'index'])->name('announcements.index');
    Route::get('/announcements/{announcement}', [AnnouncementController::class, 'getAnnouncement'])->name('announcements.getAnnouncement');

    //Documents
    Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');

    //Families
    Route::post('/families/store', [FamilyController::class, 'store'])->name('families.store');

    //Incentive
    Route::get('/incentives', [IncentiveController::class, 'index'])->name('incentives.index');

    //Reimbursement
    Route::get('/reimbursements', [ReimbursementController::class, 'index'])->name('reimbursements.index');

    //Resignation
    Route::get('/resignations', [ResignationController::class, 'index'])->name('resignations.index');

    //Leave Category
    Route::get('/leave-categories/get-categories', [LeaveCategoryController::class, 'getLeaveCategories'])->name('leave_categories.get_categories');

    //Leave
    Route::get('/leaves', [LeaveController::class, 'index'])->name('leaves.index');
    Route::post('/leaves/{leave}/update', [LeaveController::class, 'update'])->name('leaves.update');

    //Payroll
    Route::get('/payrolls', [PayrollController::class, 'index'])->name('payrolls.index');
});

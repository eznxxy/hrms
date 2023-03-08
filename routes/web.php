<?php

use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\IncentiveController;
use App\Http\Controllers\LeaveCategoryController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ReimbursementController;
use App\Http\Controllers\ResignationController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\StructuralController;
use App\Http\Controllers\TerminationCategoryController;
use App\Http\Controllers\TerminationController;
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

Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'create'])->name('login');
    Route::post('login', [LoginController::class, 'store']);
});

Route::get('logout', LogoutController::class)->name('logout')->middleware(['auth']);

Route::middleware(['auth', 'role:admin,hr'])->group(function () {
    // Employee
    // Route::resource('employees', EmployeeController::class)->except(['destroy', 'update']);
    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
    Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
    Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
    Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');

    // Structural
    // Route::resource('structurals', StructuralController::class)->only(['create', 'store']);
    Route::post('/structurals', [StructuralController::class, 'store'])->name('structurals.store');
    Route::get('/structurals/create', [StructuralController::class, 'create'])->name('structurals.create');

    // Document
    // Route::resource('documents', DocumentController::class)->except(['destroy', 'update']);
    Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');
    Route::post('/documents', [DocumentController::class, 'store'])->name('documents.store');
    Route::get('/documents/create', [DocumentController::class, 'create'])->name('documents.create');
    Route::get('/documents/{document}', [DocumentController::class, 'show'])->name('documents.show');
    Route::get('/documents/{document}/edit', [DocumentController::class, 'edit'])->name('documents.edit');

    // Termination
    Route::resource('terminations', TerminationController::class)->except(['destroy', 'update']);

    // Salary
    // Route::resource('salaries', SalaryController::class)->except(['destroy', 'update', 'show']);
    Route::get('/salaries', [SalaryController::class, 'index'])->name('salaries.index');
    Route::post('/salaries', [SalaryController::class, 'store'])->name('salaries.store');
    Route::get('/salaries/create', [SalaryController::class, 'create'])->name('salaries.create');
    Route::get('/salaries/{salary}/edit', [SalaryController::class, 'edit'])->name('salaries.edit');

    // Incentive
    Route::post('/incentives', [IncentiveController::class, 'store'])->name('incentives.store');
    Route::get('/incentives/create', [IncentiveController::class, 'create'])->name('incentives.create');
    Route::get('/incentives/{incentive}/edit', [IncentiveController::class, 'edit'])->name('incentives.edit');

    // Announcement
    Route::post('/announcements', [AnnouncementController::class, 'store'])->name('announcements.store');
    Route::get('/announcements/create', [AnnouncementController::class, 'create'])->name('announcements.create');
    Route::get('/announcements/{announcement}/edit', [AnnouncementController::class, 'edit'])->name('announcements.edit');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    // Division
    // Route::resource('divisions', DivisionController::class)->except(['destroy', 'update']);
    Route::get('/divisions', [DivisionController::class, 'index'])->name('divisions.index');
    Route::post('/divisions', [DivisionController::class, 'store'])->name('divisions.store');
    Route::get('/divisions/create', [DivisionController::class, 'create'])->name('divisions.create');
    Route::get('/divisions/{division}', [DivisionController::class, 'show'])->name('divisions.show');
    Route::get('/divisions/{division}/edit', [DivisionController::class, 'edit'])->name('divisions.edit');

    // Position
    // Route::resource('positions', PositionController::class)->except(['destroy', 'update']);
    Route::get('/positions', [PositionController::class, 'index'])->name('positions.index');
    Route::post('/positions', [PositionController::class, 'store'])->name('positions.store');
    Route::get('/positions/create', [PositionController::class, 'create'])->name('positions.create');
    Route::get('/positions/{position}', [PositionController::class, 'show'])->name('positions.show');
    Route::get('/positions/{position}/edit', [PositionController::class, 'edit'])->name('positions.edit');

    // Termination Category
    // Route::resource('termination_categories', TerminationCategoryController::class)->only(['index']);
    Route::get('/termination-categories', [TerminationCategoryController::class, 'index'])->name('termination_categories.index');

    // Leave Category
    Route::get('/leave-categories', [LeaveCategoryController::class, 'index'])->name('leave_categories.index');
});

Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Employee
    Route::get('/employees/{employee}', [EmployeeController::class, 'show'])->name('employees.show');

    // Announcement
    // Route::resource('announcements', AnnouncementController::class)->except(['destroy', 'update']);
    Route::get('/announcements', [AnnouncementController::class, 'index'])->name('announcements.index');

    // Resignation
    // Route::resource('resignations', ResignationController::class)->except(['destroy', 'update']);
    Route::get('/resignations', [ResignationController::class, 'index'])->name('resignations.index');
    Route::post('/resignations', [ResignationController::class, 'store'])->name('resignations.store');
    Route::get('/resignations/create', [ResignationController::class, 'create'])->name('resignations.create');
    Route::get('/resignations/{resignation}', [ResignationController::class, 'show'])->name('resignations.show');
    Route::get('/resignations/{resignation}/edit', [ResignationController::class, 'edit'])->name('resignations.edit');

    // Leave
    Route::get('/leaves', [LeaveController::class, 'index'])->name('leaves.index');
    Route::post('/leaves', [LeaveController::class, 'store'])->name('leaves.store');
    Route::get('/leaves/create', [LeaveController::class, 'create'])->name('leaves.create');
    Route::get('/leaves/{leave}', [LeaveController::class, 'show'])->name('leaves.show');
    Route::get('/leaves/{leave}/edit', [LeaveController::class, 'edit'])->name('leaves.edit');

    // Payroll
    // Route::resource('payrolls', PayrollController::class)->only('index');
    Route::get('payrolls', [PayrollController::class, 'index'])->name('payrolls.index');
    Route::get('payrolls/{payroll}/invoice', [PayrollController::class, 'invoice'])->name('payrolls.invoice');
    Route::get('payrolls/{payroll}/invoice/print', [PayrollController::class, 'printInvoice'])->name('payrolls.print_invoice');

    // Incentive
    // Route::resource('incentives', IncentiveController::class)->except(['destroy', 'update', 'show']);
    Route::get('/incentives', [IncentiveController::class, 'index'])->name('incentives.index');

    // Reimbursement
    // Route::resource('incentives', IncentiveController::class)->except(['destroy', 'update', 'show']);
    Route::get('/reimbursements', [ReimbursementController::class, 'index'])->name('reimbursements.index');
    Route::post('/reimbursements', [ReimbursementController::class, 'store'])->name('reimbursements.store');
    Route::get('/reimbursements/create', [ReimbursementController::class, 'create'])->name('reimbursements.create');
    Route::get('/reimbursements/{reimbursement}', [ReimbursementController::class, 'show'])->name('reimbursements.show');
    Route::get('/reimbursements/{reimbursement}/edit', [ReimbursementController::class, 'edit'])->name('reimbursements.edit');
    Route::post('/reimbursements/{reimbursement}/update', [ReimbursementController::class, 'update'])->name('reimbursements.update');
});

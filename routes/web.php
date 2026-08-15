<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PayslipController;
use App\Http\Controllers\PurchaseRequestController;

// Auth Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/debug-attendance', function() {
    $selectedDate = request('date', now()->format('Y-m-d'));
    $output = [];
    $output['app_timezone'] = config('app.timezone');
    $output['php_timezone'] = date_default_timezone_get();
    $output['now'] = now()->toIso8601String();
    
    $employees = \App\Models\Employee::with(['attendances'])->get();
    foreach ($employees as $emp) {
        $empData = ['name' => $emp->name, 'attendances' => []];
        foreach ($emp->attendances as $att) {
            $empData['attendances'][] = [
                'id' => $att->id,
                'raw_date' => $att->getRawOriginal('date'),
                'carbon_date' => $att->date instanceof \Carbon\Carbon ? $att->date->toIso8601String() : 'not carbon',
                'formatted' => \Carbon\Carbon::parse($att->date)->format('Y-m-d'),
                'matches' => \Carbon\Carbon::parse($att->date)->format('Y-m-d') === $selectedDate,
                'status' => $att->status
            ];
        }
        $output['employees'][] = $empData;
    }
    return response()->json($output);
});

// Authenticated Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/dashboard/export-report', [DashboardController::class, 'exportReport'])->name('dashboard.export');

    // Purchase Requests (Access rules: all roles can view/create; approval limited in controller)
    Route::get('/purchase-requests', [PurchaseRequestController::class, 'index'])->name('purchase_requests.index');
    Route::post('/purchase-requests', [PurchaseRequestController::class, 'store'])->name('purchase_requests.store');
    
    Route::middleware(['role:owner,finance'])->group(function () {
        Route::post('/purchase-requests/{purchaseRequest}/approve', [PurchaseRequestController::class, 'approve'])->name('purchase_requests.approve');
        Route::post('/purchase-requests/{purchaseRequest}/reject', [PurchaseRequestController::class, 'reject'])->name('purchase_requests.reject');
    });

    // Payslips (Individual viewing)
    Route::get('/payslips/{payslip}', [PayslipController::class, 'show'])->name('payslips.show');

    // Employee self check-in
    Route::post('/attendance/check-in', [EmployeeController::class, 'checkIn'])->name('attendance.check_in');

    // Admin & Finance Only Routes
    Route::middleware(['role:owner,finance'])->group(function () {
        // Transactions & Categories
        Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
        
        Route::middleware(['role:finance'])->group(function () {
            Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
            Route::post('/categories', [TransactionController::class, 'storeCategory'])->name('categories.store');
            Route::delete('/transactions/{transaction}', [TransactionController::class, 'destroy'])->name('transactions.destroy');
        });

        // Payslips Management
        Route::get('/payslips', [PayslipController::class, 'index'])->name('payslips.index');
        Route::post('/payslips/{payslip}/pay', [PayslipController::class, 'pay'])->name('payslips.pay');

        Route::middleware(['role:finance'])->group(function () {
            Route::post('/payslips/generate', [PayslipController::class, 'generate'])->name('payslips.generate');
        });
    });

    // HR Management (Viewing open to Owner and Finance, modifying restricted to Finance)
    Route::middleware(['role:owner,finance'])->group(function () {
        Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
    });

    Route::middleware(['role:finance'])->group(function () {
        Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
        Route::post('/attendance/log', [EmployeeController::class, 'logAttendance'])->name('attendance.log');
    });
});

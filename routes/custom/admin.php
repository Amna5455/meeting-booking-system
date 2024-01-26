<?php

use App\Http\Controllers\Admin\CalendarViewController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard.index')->middleware(['permission:admin-dashboard']);
    Route::prefix('permission')->group(function () {
        Route::get('/', [PermissionController::class,'index'])->name('permission.index')->middleware(['permission:permission-list']);
        Route::get('/create', [PermissionController::class,'create'])->name('permission.create')->middleware(['permission:permission-create']);
        Route::post('/', [PermissionController::class,'store'])->name('permission.store');
        Route::get('/edit/{id}', [PermissionController::class,'edit'])->name('permission.edit')->middleware(['permission:permission-edit']);
        Route::put('/edit/{id}', [PermissionController::class,'update'])->name('permission.update');
        // Route::delete('/{id}', [PermissionController::class,'destroy'])->name('permission.destroy')->middleware(['permission:permission-delete']);
    });

    Route::prefix('role')->group(function () {
        Route::get('/', [RoleController::class,'index'])->name('role.index')->middleware(['permission:role-list']);
        Route::get('/create', [RoleController::class,'create'])->name('role.create')->middleware(['permission:role-list']);
        Route::post('/', [RoleController::class,'store'])->name('role.store');
        Route::get('/{id}', [RoleController::class,'show']);
        Route::get('/edit/{id}', [RoleController::class,'edit'])->name('role.edit')->middleware(['permission:role-list']);
        Route::put('/edit/{id}', [RoleController::class,'update'])->name('role.update');
        // Route::delete('/{id}', [RoleController::class,'destroy'])->name('role.destroy');
    });

    Route::prefix('employee')->group(function () {
        Route::get('/', [EmployeeController::class,'index'])->name('employee.index')->middleware(['permission:employee-list']);
        Route::get('/create', [EmployeeController::class,'create'])->name('employee.create')->middleware(['permission:employee-list']);
        Route::post('/', [EmployeeController::class,'store'])->name('employee.store');
        Route::get('/{id}', [EmployeeController::class,'show']);
        Route::get('/edit/{id}', [EmployeeController::class,'edit'])->name('employee.edit')->middleware(['permission:employee-list']);
        Route::put('/edit/{id}', [EmployeeController::class,'update'])->name('employee.update');
        Route::get('delete/{id}', [EmployeeController::class,'destroy'])->name('employee.destroy')->middleware(['permission:employee-list']);
    });

    Route::get('/calendar', [CalendarViewController::class,'index'])->name('calendar.index');
?>
<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return "Hello World";
});

// Employee web routes
Route::resource('employees', EmployeeController::class);

// Export routes
Route::get('/employees/export/{format}', [EmployeeController::class, 'export'])->name('employees.export');
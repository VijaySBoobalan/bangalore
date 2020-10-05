<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/employee', [App\Http\Controllers\EmployeeController::class, 'index'])->name('employee.index');

Route::get('/employee/create', [App\Http\Controllers\EmployeeController::class, 'create'])->name('employee.create');

Route::POST('/employee/store', [App\Http\Controllers\EmployeeController::class, 'store'])->name('employee.store');

Route::get('/employee/edit', [App\Http\Controllers\EmployeeController::class, 'edit'])->name('employee.edit');

Route::POST('/employee/update', [App\Http\Controllers\EmployeeController::class, 'update'])->name('employee.update');

Route::delete('/employee/delete', [App\Http\Controllers\EmployeeController::class, 'delete'])->name('employee.delete');

Route::get('/employee/massremove', [App\Http\Controllers\EmployeeController::class, 'massremove'])->name('employee.massremove');

Route::POST('/employee/add/salary', [App\Http\Controllers\EmployeeController::class, 'addsalary'])->name('employee.add.salary');

Route::get('/employee/view/salary', [App\Http\Controllers\EmployeeController::class, 'viewsalary'])->name('employee.view.salary');

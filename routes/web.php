<?php

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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/leave', [\App\Http\Controllers\LeaveController::class, 'listLeave']);
Route::get('/makeleave', [\App\Http\Controllers\LeaveController::class, 'index'])->name('index');
Route::post('makeleave', [\App\Http\Controllers\LeaveController::class, 'saveData'])->name('makeleave');

Route::get('/project', [\App\Http\Controllers\ProjectController::class, 'listProject']);
Route::get('/makeproject', [\App\Http\Controllers\ProjectController::class, 'makeProject'])->middleware('can:manager');
Route::get('/task/{task}', [\App\Http\Controllers\TaskController::class, 'edit']);
Route::post('/task/{task}', [\App\Http\Controllers\TaskController::class, 'update']);
Route::delete('/task/{task}', [\App\Http\Controllers\TaskController::class, 'delete']);
Route::get('/manager', [\App\Http\Controllers\ManagerController::class, 'showStatistics'])->middleware('can:manager');

Route::get('/admin', [\App\Http\Controllers\AdminController::class, 'showStatistics'])->middleware('can:admin');
Route::get('/admin/users', [\App\Http\Controllers\AdminController::class, 'showUsers'])->middleware('can:admin');
Route::get('/admin/user/{user}', [\App\Http\Controllers\AdminController::class, 'editUser'])->middleware('can:admin');
Route::post('/admin/user/{user}', [\App\Http\Controllers\AdminController::class, 'updateUser'])->middleware('can:admin');
Route::delete('/admin/user/{user}', [\App\Http\Controllers\AdminController::class, 'deleteUser'])->middleware('can:admin');
Route::get('/admin/projects', [\App\Http\Controllers\AdminController::class, 'showProjects'])->middleware('can:admin');
Route::get('/admin/project/{project}', [\App\Http\Controllers\AdminController::class, 'editProject'])->middleware('can:manager');
Route::post('/admin/project/{project}', [\App\Http\Controllers\AdminController::class, 'updateProject'])->middleware('can:manager');
Route::delete('/admin/project/{project}', [\App\Http\Controllers\AdminController::class, 'deleteProject'])->middleware('can:manager');
Route::get('/admin/leaves', [\App\Http\Controllers\AdminController::class, 'showLeaves'])->middleware('can:admin');
Route::get('/admin/leave/{leave}', [\App\Http\Controllers\AdminController::class, 'editLeave'])->middleware('can:admin');
Route::post('/admin/leave/{leave}', [\App\Http\Controllers\AdminController::class, 'updateLeave'])->middleware('can:admin');
Route::delete('/admin/leave/{leave}', [\App\Http\Controllers\AdminController::class, 'deleteLeave'])->middleware('can:admin');


Route::get('/layout', function () {
    return view('layouts.app1');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

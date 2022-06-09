<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AutosController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\GroupsController;
use App\Http\Controllers\SchedulesController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\TopicsController;
use App\Http\Controllers\UsersController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Login

Route::get('login', [LoginController::class, 'create'])->name('login');
Route::post('login', [LoginController::class, 'store']);
Route::post('logout', [LoginController::class, 'destroy'])->middleware('auth');

// Users

Route::get('users', [UsersController::class, 'index'])
    ->name('users')
    ->middleware('auth');

Route::get('users/create', [UsersController::class, 'create'])
    ->name('users.create')
    ->middleware('auth');

Route::post('users', [UsersController::class, 'store'])
    ->name('users.store')
    ->middleware('auth');

Route::get('users/{user}/edit', [UsersController::class, 'edit'])
    ->name('users.edit')
    ->middleware('auth');

Route::put('users/{user}', [UsersController::class, 'update'])
    ->name('users.update')
    ->middleware('auth');

Route::delete('users/{user}/delete', [UsersController::class, 'destroy'])
    ->name('users.destroy')
    ->middleware('auth');

// Categories

Route::get('categories', [CategoriesController::class, 'index'])
    ->name('categories')
    ->middleware('auth');

// Autos

Route::get('autos', [AutosController::class, 'index'])
    ->name('autos')
    ->middleware('auth');

Route::get('autos/create', [AutosController::class, 'create'])
    ->name('autos.create')
    ->middleware('auth');

Route::post('autos', [AutosController::class, 'store'])
    ->name('autos.store')
    ->middleware('auth');

Route::get('autos/{auto}/edit', [AutosController::class, 'edit'])
    ->name('autos.edit')
    ->middleware('auth');

Route::put('autos/{auto}', [AutosController::class, 'update'])
    ->name('autos.update')
    ->middleware('auth');

Route::delete('autos/{auto}/delete', [AutosController::class, 'destroy'])
    ->name('autos.destroy')
    ->middleware('auth');

// Groups

Route::get('groups', [GroupsController::class, 'index'])
    ->name('groups')
    ->middleware('auth');

Route::get('groups/create', [GroupsController::class, 'create'])
    ->name('groups.create')
    ->middleware('auth');

Route::post('groups', [GroupsController::class, 'store'])
    ->name('groups.store')
    ->middleware('auth');

Route::get('groups/{group}/edit', [GroupsController::class, 'edit'])
    ->name('groups.edit')
    ->middleware('auth');

Route::put('groups/{group}', [GroupsController::class, 'update'])
    ->name('groups.update')
    ->middleware('auth');

Route::delete('groups/{group}/delete', [GroupsController::class, 'destroy'])
    ->name('groups.destroy')
    ->middleware('auth');

// Students

Route::get('students', [StudentsController::class, 'index'])
    ->name('students')
    ->middleware('auth');

Route::get('students/create', [StudentsController::class, 'create'])
    ->name('students.create')
    ->middleware('auth');

Route::post('students', [StudentsController::class, 'store'])
    ->name('students.store')
    ->middleware('auth');

Route::get('students/{student}/edit', [StudentsController::class, 'edit'])
    ->name('students.edit')
    ->middleware('auth');

Route::put('students/{student}', [StudentsController::class, 'update'])
    ->name('students.update')
    ->middleware('auth');

Route::delete('students/{student}/delete', [StudentsController::class, 'destroy'])
    ->name('students.destroy')
    ->middleware('auth');

// Schedules

Route::get('schedules', [SchedulesController::class, 'index'])
    ->name('schedules')
    ->middleware('auth');

Route::get('schedules/create', [SchedulesController::class, 'create'])
    ->name('schedules.create')
    ->middleware('auth');

Route::post('schedules', [SchedulesController::class, 'store'])
    ->name('schedules.store')
    ->middleware('auth');

Route::get('schedules/{schedule}/edit', [SchedulesController::class, 'edit'])
    ->name('schedules.edit')
    ->middleware('auth');

Route::put('schedules/{schedule}', [SchedulesController::class, 'update'])
    ->name('schedules.update')
    ->middleware('auth');

Route::delete('schedules/{schedule}/delete', [SchedulesController::class, 'destroy'])
    ->name('schedules.destroy')
    ->middleware('auth');

// Topics

Route::get('topics', [TopicsController::class, 'index'])
    ->name('topics')
    ->middleware('auth');

Route::get('topics/create', [TopicsController::class, 'create'])
    ->name('topics.create')
    ->middleware('auth');

Route::post('topics', [TopicsController::class, 'store'])
    ->name('topics.store')
    ->middleware('auth');

Route::get('topics/{topic}/edit', [TopicsController::class, 'edit'])
    ->name('topics.edit')
    ->middleware('auth');

Route::put('topics/{topic}', [TopicsController::class, 'update'])
    ->name('topics.update')
    ->middleware('auth');

Route::delete('topics/{topic}/delete', [TopicsController::class, 'destroy'])
    ->name('topics.destroy')
    ->middleware('auth');

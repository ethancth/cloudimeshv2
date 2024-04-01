<?php

use App\Http\Controllers\ProjectsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Management\UserManagement;
use App\Http\Controllers\dashboard\Analytics;
use App\Http\Controllers\dashboard\Crm;
use App\Http\Controllers\language\LanguageController;
require __DIR__.'/jetstream.php';
require __DIR__.'/fortity.php';

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {


// Main Page Route
  Route::get('/', [ProjectsController::class, 'Index'])->name('laravel-example-user-management');
  Route::get('/project', [ProjectsController::class, 'Index'])->name('project');
    Route::get('/project/detail/{id}/{slug?}', \App\Livewire\Project\ProjectDetail::class)->name('project.detail');

  Route::get('/dashboard/analytics', [Analytics::class, 'index'])->name('dashboard-analytics');
  Route::get('/dashboard/crm', [Crm::class, 'index'])->name('dashboard-crm');
// locale
  Route::get('lang/{locale}', [LanguageController::class, 'swap']);


// laravel example
  Route::get('/user-management', [UserManagement::class, 'UserManagement'])->name('user-management');
  Route::get('/d2', \App\Livewire\Department\DepartmentList::class)->name('departments');
  Route::get('/service-application', \App\Livewire\Management\ServiceApplication::class)->name('service-application');
  Route::get('/environment', \App\Livewire\Management\Environment::class)->name('environment');
  Route::resource('/user-list', UserManagement::class);

    Route::get('/departments', function () {
        return view('content.department');
    })->name('departments');


  Route::get('/users', function () {
    return view('components.welcome');
  });

});

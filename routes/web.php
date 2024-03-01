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
  Route::get('/dashboard/analytics', [Analytics::class, 'index'])->name('dashboard-analytics');
  Route::get('/dashboard/crm', [Crm::class, 'index'])->name('dashboard-crm');
// locale
  Route::get('lang/{locale}', [LanguageController::class, 'swap']);


// laravel example
  Route::get('/user-management', [UserManagement::class, 'UserManagement'])->name('user-management');
  Route::resource('/user-list', UserManagement::class);

});

<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\laravel_example\UserManagement;
use App\Http\Controllers\dashboard\Analytics;
use App\Http\Controllers\dashboard\Crm;
use App\Http\Controllers\language\LanguageController;
require_once __DIR__ . '/jetstream.php';
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {


// Main Page Route
  Route::get('/', [UserManagement::class, 'UserManagement'])->name('laravel-example-user-management');
  Route::get('/dashboard/analytics', [Analytics::class, 'index'])->name('dashboard-analytics');
  Route::get('/dashboard/crm', [Crm::class, 'index'])->name('dashboard-crm');
// locale
  Route::get('lang/{locale}', [LanguageController::class, 'swap']);


// laravel example
  Route::get('/user-management', [UserManagement::class, 'UserManagement'])->name('laravel-example-user-management');
  Route::resource('/user-list', UserManagement::class);

});

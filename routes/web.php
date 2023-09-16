<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\CountryProfileController;
use App\Http\Controllers\UserManagementController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('admin.admin_login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');


//admin middleware
Route::middleware(['auth','role:admin'])->group(function(){
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/body/header', [AdminController::class, 'UserName'])->name('admin.username');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/geochart', [AdminController::class, 'GeoChart'])->name('admin.geochart');
    Route::get('/admin/datastudio_gdp', [AdminController::class, 'DataStudioGDP'])->name('admin.datastudiogdp');
    Route::get('/admin/datastudio_edu', [AdminController::class, 'DataStudioEDU'])->name('admin.datastudioedu');
    Route::get('/admin/datastudio_crime', [AdminController::class, 'DataStudioCRIME'])->name('admin.datastudiocrime');
    Route::get('/admin/countryprofile/{countryCode}', [CountryProfileController::class, 'show'])->name('admin.countryprofile');
    Route::get('/admin/user_management', [UserManagementController::class, 'UserManagement'])->name('admin.usermanagement');
}); // End Group Admin Middleware


//agent middleware
Route::middleware(['auth','role:agent'])->group(function(){
    Route::get('/agent/dashboard', [AgentController::class, 'AgentDashboard'])->name('agent.dashboard');
}); // End Group Agent Middleware




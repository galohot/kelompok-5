<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\CountryProfileController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\DataManagementController;
use App\Http\Controllers\IndexDataController;

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

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');

    Route::get('/geochart', [AdminController::class, 'GeoChart'])->name('geochart');
    Route::get('/countryprofile/{countryCode}', [CountryProfileController::class, 'show'])->name('countryprofile');
    Route::get('/dashboard', [IndexDataController::class, 'getIndex'])->name('index.dashboard');
    

    Route::middleware('role:admin')->group(function () {
        Route::prefix('admin')->group(function () {
            Route::get('/login', [AdminController::class, 'AdminLogin'])->name('admin.login');
            Route::get('/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
            Route::post('/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
            Route::get('/geochart', [AdminController::class, 'GeoChart'])->name('admin.geochart');
            Route::get('/countryprofile/{countryCode}', [CountryProfileController::class, 'show'])->name('admin.countryprofile');
            Route::get('/datastudio_gdp', [AdminController::class, 'DataStudioGDP'])->name('admin.datastudiogdp');
            Route::get('/datastudio_edu', [AdminController::class, 'DataStudioEDU'])->name('admin.datastudioedu');
            Route::get('/datastudio_crime', [AdminController::class, 'DataStudioCRIME'])->name('admin.datastudiocrime');
            Route::resource('/user_management', UserManagementController::class)->names([
                'index' => 'admin.usermanagement.index',
                'create' => 'admin.usermanagement.create',
                'store' => 'admin.usermanagement.store',
                'edit' => 'admin.usermanagement.edit',
                'update' => 'admin.usermanagement.update',
                'destroy' => 'admin.usermanagement.destroy',
            ]);
            // Route::get('/data_management/{countryCode}', [DataManagementController::class, 'show'])->name('admin.datamanagement');
            // Route::post('/data_management/{countryCode}/add_perwakilan', [DataManagementController::class, 'addPerwakilan'])->name('admin.add_perwakilan');
            // Route::post('/data_management/{countryCode}/add_belanja', [DataManagementController::class, 'addBelanja'])->name('admin.add_belanja');
            // Route::get('/data_management/{countryCode}/edit_perwakilan/{id}', [DataManagementController::class, 'editPerwakilan'])->name('admin.edit_perwakilan');
            // Route::post('/data_management/{countryCode}/update_perwakilan/{id}', [DataManagementController::class, 'updatePerwakilan'])->name('admin.update_perwakilan');
            // Route::get('/data_management/{countryCode}/edit_belanja/{id}', [DataManagementController::class, 'editBelanja'])->name('admin.edit_belanja');
            // Route::post('/data_management/{countryCode}/update_belanja/{id}', [DataManagementController::class, 'updateBelanja'])->name('admin.update_belanja');
            // Route::delete('/data_management/{countryCode}/delete_perwakilan/{id}', [DataManagementController::class, 'destroyPerwakilan'])->name('admin.destroy_perwakilan');
            // Route::delete('/data_management/{countryCode}/delete_belanja/{id}', [DataManagementController::class, 'destroyBelanja'])->name('admin.destroy_belanja');
    
        });
    });

    Route::middleware(['role:admin,agent'])->group(function () {
        Route::get('/data_management/{countryCode}', [DataManagementController::class, 'show'])->name('admin.datamanagement');
        Route::post('/data_management/{countryCode}/add_perwakilan', [DataManagementController::class, 'addPerwakilan'])->name('admin.add_perwakilan');
        Route::post('/data_management/{countryCode}/add_belanja', [DataManagementController::class, 'addBelanja'])->name('admin.add_belanja');
        Route::get('/data_management/{countryCode}/edit_perwakilan/{id}', [DataManagementController::class, 'editPerwakilan'])->name('admin.edit_perwakilan');
        Route::post('/data_management/{countryCode}/update_perwakilan/{id}', [DataManagementController::class, 'updatePerwakilan'])->name('admin.update_perwakilan');
        Route::get('/data_management/{countryCode}/edit_belanja/{id}', [DataManagementController::class, 'editBelanja'])->name('admin.edit_belanja');
        Route::post('/data_management/{countryCode}/update_belanja/{id}', [DataManagementController::class, 'updateBelanja'])->name('admin.update_belanja');
        Route::delete('/data_management/{countryCode}/delete_perwakilan/{id}', [DataManagementController::class, 'destroyPerwakilan'])->name('admin.destroy_perwakilan');
        Route::delete('/data_management/{countryCode}/delete_belanja/{id}', [DataManagementController::class, 'destroyBelanja'])->name('admin.destroy_belanja');
    });
});

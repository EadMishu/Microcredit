<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\DepositCollectionController;
use App\Http\Controllers\Backend\DepositController;
use App\Http\Controllers\Backend\DepositTypeController;
use App\Http\Controllers\Backend\DpsController;
use App\Http\Controllers\Backend\DpsTypeController;
use App\Http\Controllers\Backend\TestController;
use App\Http\Controllers\Backend\UsersController;
use App\Http\Controllers\Backend\LoanController;
use App\Http\Controllers\Backend\LoanTypeController;
use App\Http\Controllers\Backend\DpsCollectionController;
use App\Http\Controllers\Backend\LoanCollectionController;
use PHPUnit\Event\Code\Test;

Route::get('/', function () {     // Public route
    return view('welcome');
});
Route::get('/dashboard', [DashboardController::class, 'index'])   // Dashboard (requires authentication)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {     // Authenticated Routes
        // --- Users Management ---
    Route::prefix('users')->name('users.')->group(function () {
    Route::get('/create', [UsersController::class, 'create'])->name('create');
    Route::post('/', [UsersController::class, 'store'])->name('store');
    Route::get('/{user}/edit', [UsersController::class, 'edit'])->name('edit'); 
    Route::put('/{user}', [UsersController::class, 'update'])->name('update');
    Route::delete('/{user}', [UsersController::class, 'destroy'])->name('destroy');
    Route::get('/list', [UsersController::class, 'index'])->name('index');
    });
        // --- Dynamic Location Fetching (Divisions > Districts > Police Stations) ---
    Route::get('/locations/districts/{division}', [UsersController::class, 'getDistricts']);
    Route::get('/locations/police-stations/{district}', [UsersController::class, 'getPoliceStations']);
        // You can organize other modules like Employees, Products, etc., similarly
    Route::resource('/admin', AdminController::class);
            // --- Dynamic Location Fetching (Divisions > Districts > Police Stations) ---
    Route::get('/locations/districts/{division}', [AdminController::class, 'getDistricts']);
    Route::get('/locations/police-stations/{district}', [AdminController::class, 'getPoliceStations']);
        // --- loans Management ---
    Route::resource('loans',LoanController ::class);
    Route::post('/time-extension/store', [LoanController::class, 'extensionstore'])->name('time-extension.store');
    Route::resource('loan-types', LoanTypeController::class);
    Route::patch('/loan-types/{id}/toggle-status', [LoanTypeController::class, 'toggleStatus'])->name('loan-types.toggle-status');
    Route::patch('/loans/{id}/update-status', [LoanController::class, 'updateStatus'])->name('loans.updateStatus');
        // --- dps Management ---
    Route::resource('dps',DpsController ::class)->parameters(['dps' => 'dps' // Force the route parameter to be {dps} not {dp};
    ]);
    Route::patch('/dps/{id}/update-status', [DpsController::class, 'updateStatus'])->name('dps.updateStatus');
    Route::resource('dps-types', DpsTypeController::class);
    Route::patch('/dps-types/{id}/toggle-status', [DpsTypeController::class, 'toggleStatus'])->name('dps-types.toggle-status');
        // --- deposit Management ---
    Route::resource('deposit',DepositController ::class);
   Route::patch('/deposit/{id}/update-status', [DepositController::class, 'updateStatus'])->name('deposit.updateStatus');
        // --- depositType Management ---
    Route::resource('deposit-types',DepositTypeController ::class);
    Route::patch('/deposit-types/{id}/toggle-status', [DepositTypeController::class, 'toggleStatus'])->name('deposit-types.toggle-status');
        // --- depositType Management ---
    Route::resource('loan_collections', LoanCollectionController::class);
    Route::resource('dps_collections', DpsCollectionController::class);
    Route::resource('deposit_collections', DepositCollectionController::class);
    Route::post('/loan-collections/store-bulk', [LoanCollectionController::class, 'storeBulk'])->name('loan_collections.store_bulk');

       
    
        // --- test parpus ---
    Route::resource('test', TestController::class);
});

require __DIR__ . '/auth.php';
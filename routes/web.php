<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AmountController;
use App\Http\Controllers\Backend\BalanceController;
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
use App\Http\Controllers\Backend\ExpenseController;
use App\Http\Controllers\Backend\ExpenseTypeController;
use App\Http\Controllers\Backend\IncomeController;
use App\Http\Controllers\Backend\LoanCollectionController;
use App\Http\Controllers\Backend\OwnerController;
use App\Http\Controllers\Backend\SavingsController;
use App\Http\Controllers\Backend\TransactionController;

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
    Route::get('/locations/districts/{division}', [UsersController::class, 'getDistricts']);
    Route::get('/locations/police-stations/{district}', [UsersController::class, 'getPoliceStations']);
    Route::patch('/user/{id}/update-status', [UsersController::class, 'updateStatus'])->name('user.updateStatus');
    Route::post('/user/deposit-interest', [UsersController::class, 'interestStore'])->name('users.interest.store');
    Route::post('/user/cash-withdraw', [UsersController::class, 'cashwithdraw'])->name('users.cash.withdraw.store');
        // --- Admin Management ---
    Route::resource('/admin', AdminController::class);
    Route::get('/locations/districts/{division}', [AdminController::class, 'getDistricts']);
    Route::get('/locations/police-stations/{district}', [AdminController::class, 'getPoliceStations']);
        // --- loans Management ---
    Route::resource('loans',LoanController ::class);
    Route::post('/time-extension/store', [LoanController::class, 'extensionstore'])->name('time-extension.store');
    Route::patch('/loans/{id}/update-status', [LoanController::class, 'updateStatus'])->name('loans.updateStatus');
    Route::resource('loan-types', LoanTypeController::class);
    Route::patch('/loan-types/{id}/toggle-status', [LoanTypeController::class, 'toggleStatus'])->name('loan-types.toggle-status');
    Route::get('loan_collections/edit_date/{date}', [LoanCollectionController::class, 'editDate'])->name('loan_collections.edit_date');
    Route::patch('loan_collections/update_date/{date}', [LoanCollectionController::class, 'updateDate'])->name('loan_collections.update_date');
    Route::resource('loan_collections', LoanCollectionController::class);
    Route::post('/loan-collections/store-bulk', [LoanCollectionController::class, 'storeBulk'])->name('loan_collections.store_bulk');
    Route::delete('loan_collections/destroy_date/{date}', [LoanCollectionController::class, 'destroyDate'])->name('loan_collections.destroy_date');
        // --- dps Management ---
    Route::resource('dps',DpsController ::class)->parameters(['dps' => 'dps' ]);
    Route::patch('/dps/{id}/update-status', [DpsController::class, 'updateStatus'])->name('dps.updateStatus');
    Route::post('/dps/deposit-interest', [DpsController::class, 'interestStore'])->name('dps.interest.store');
    Route::post('/dps/cash-withdraw', [DpsController::class, 'cashwithdraw'])->name('dps.cash.withdraw.store');
    Route::resource('dps-types', DpsTypeController::class);
    Route::patch('/dps-types/{id}/toggle-status', [DpsTypeController::class, 'toggleStatus'])->name('dps-types.toggle-status');
    Route::resource('dps_collections', DpsCollectionController::class);
    Route::post('/dps_collections/edit_date', [DpsCollectionController::class, 'editDate'])->name('dps_collections.edit_date');
    Route::delete('/dps_collections/destroy_date/{date}', [DpsCollectionController::class, 'destroyDate'])->name('dps_collections.destroy_date');
        // --- deposit Management ---
    Route::resource('deposit',DepositController ::class);
    Route::patch('/deposit/{id}/update-status', [DepositController::class, 'updateStatus'])->name('deposit.updateStatus');
    Route::post('/deposit/deposit-interest', [DepositController::class, 'interestStore'])->name('deposit.interest.store');
    Route::post('/deposit/cash-withdraw', [DepositController::class, 'cashwithdraw'])->name('deposit.cash.withdraw.store');
    Route::resource('deposit-types',DepositTypeController ::class);
    Route::patch('/deposit-types/{id}/toggle-status', [DepositTypeController::class, 'toggleStatus'])->name('deposit-types.toggle-status');
    Route::resource('deposit_collections', DepositCollectionController::class);
    Route::post('/deposit_collections/edit_date', [DepositCollectionController::class, 'editDate'])->name('deposit_collections.edit_date');
    Route::delete('/deposit_collections/destroy_date/{date}', [DepositCollectionController::class, 'destroyDate'])->name('deposit_collections.destroy_date');
        // --- owner Management ---
    Route::resource('owner', OwnerController::class);
    Route::patch('/owner/{id}/update-status', [OwnerController::class, 'updateStatus'])->name('owner.updateStatus');
    Route::post('/owner/add-balance', [OwnerController::class, 'addBalance'])->name('add-balance.store');
        // --- savings Management ---
    Route::resource('savings', SavingsController::class);
    Route::get('/savings/edit_date/{date}', [SavingsController::class, 'editDate'])->name('savings.edit_date');
    Route::get('/savings/destroy_date/{date}', [SavingsController::class, 'destroyDate'])->name('savings.destroy_date');
        // --- others Management ---
    Route::resource('expense', ExpenseController::class);
    Route::resource('expense-types', ExpenseTypeController::class);
        // --- others Management ---
    Route::resource('transaction', TransactionController::class);
    Route::resource('income', IncomeController::class);
    Route::resource('balance', BalanceController::class);
    Route::resource('amount', AmountController::class);
   
   
    
 
    
    
    
    
    





    


       
    
        // --- test parpus ---
    Route::resource('test', TestController::class);
});

require __DIR__ . '/auth.php';

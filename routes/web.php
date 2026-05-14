<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\BloodInventoryController;
use App\Http\Controllers\DonationController;

// ── Auth Routes ───────────────────────────────────────────
Auth::routes();

// ── Home (redirects by role) ──────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index']);

// ── Admin Routes ──────────────────────────────────────────
Route::prefix('admin')->name('admin.')->middleware(['auth','role:admin'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Users
    Route::get('/users',               [AdminController::class, 'users'])->name('users');
    Route::get('/users/{user}/edit',   [AdminController::class, 'editUser'])->name('users.edit');
    Route::put('/users/{user}',        [AdminController::class, 'updateUser'])->name('users.update');
    Route::delete('/users/{user}',     [AdminController::class, 'destroyUser'])->name('users.destroy');

    // Donors
    Route::get('/donors',              [AdminController::class, 'donors'])->name('donors');
    Route::get('/donors/{donor}/edit', [AdminController::class, 'editDonor'])->name('donors.edit');
    Route::put('/donors/{donor}',      [AdminController::class, 'updateDonor'])->name('donors.update');
    Route::delete('/donors/{donor}',   [AdminController::class, 'destroyDonor'])->name('donors.destroy');

    // Hospitals
    Route::get('/hospitals',               [AdminController::class, 'hospitals'])->name('hospitals');
    Route::delete('/hospitals/{hospital}', [AdminController::class, 'destroyHospital'])->name('hospitals.destroy');

    // Blood Requests
    Route::get('/requests',                          [AdminController::class, 'requests'])->name('requests');
    Route::patch('/requests/{bloodRequest}/approve', [AdminController::class, 'approveRequest'])->name('requests.approve');
    Route::patch('/requests/{bloodRequest}/reject',  [AdminController::class, 'rejectRequest'])->name('requests.reject');
    Route::patch('/requests/{bloodRequest}/fulfill', [AdminController::class, 'fulfillRequest'])->name('requests.fulfill');

    // Inventory
    Route::get('/inventory',                       [BloodInventoryController::class, 'index'])->name('inventory');
    Route::get('/inventory/{bloodInventory}/edit', [BloodInventoryController::class, 'edit'])->name('inventory.edit');
    Route::put('/inventory/{bloodInventory}',      [BloodInventoryController::class, 'update'])->name('inventory.update');

    // Donations
    Route::get('/donations',                     [DonationController::class, 'adminIndex'])->name('donations');
    Route::patch('/donations/{donation}/verify', [DonationController::class, 'verify'])->name('donations.verify');
    Route::patch('/donations/{donation}/reject', [DonationController::class, 'reject'])->name('donations.reject');
});

// ── Donor Routes ──────────────────────────────────────────
Route::prefix('donor')->name('donor.')->middleware(['auth','role:donor'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DonorController::class, 'dashboard'])->name('dashboard');

    // Profile
    Route::get('/profile',  [DonorController::class, 'profile'])->name('profile');
    Route::post('/profile', [DonorController::class, 'updateProfile'])->name('profile.update');

    // Blood Availability
    Route::get('/inventory', [DonorController::class, 'inventory'])->name('inventory');

    // Donations
    Route::get('/donations',        [DonationController::class, 'myDonations'])->name('donations');
    Route::get('/donations/record', [DonationController::class, 'create'])->name('donations.create');
    Route::post('/donations',       [DonationController::class, 'store'])->name('donations.store');
});

// ── Hospital Routes ───────────────────────────────────────
Route::prefix('hospital')->name('hospital.')->middleware(['auth','role:hospital'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [HospitalController::class, 'dashboard'])->name('dashboard');

    // Profile
    Route::get('/profile',  [HospitalController::class, 'profile'])->name('profile');
    Route::post('/profile', [HospitalController::class, 'updateProfile'])->name('profile.update');

    // Blood Availability
    Route::get('/inventory', [HospitalController::class, 'inventory'])->name('inventory');

    // Blood Requests
    Route::get('/requests',        [HospitalController::class, 'myRequests'])->name('requests');
    Route::get('/requests/create', [HospitalController::class, 'createRequest'])->name('requests.create');
    Route::post('/requests',       [HospitalController::class, 'storeRequest'])->name('requests.store');
});

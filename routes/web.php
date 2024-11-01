<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProjectOwnerController;
use App\Http\Controllers\ContributorController;
use App\Http\Controllers\ContributionController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\HomeController;

use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('welcome');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Route::get('admin/dashboard', [AdminController::class, 'index'])->middleware(['auth', 'admin']);
// Route::get('project_owner/dashboard', [ProjectOwnerController::class, 'index'])->middleware(['auth', 'project_owner']);



// Admin routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('admin/manage-campaigns', [AdminController::class, 'manageCampaigns'])->name('admin.manage-campaigns');
    Route::delete('admin/delete-campaign/{id}', [AdminController::class, 'deleteCampaign'])->name('admin.delete-campaign');
    Route::get('admin/manage-users', [AdminController::class, 'manageUsers'])->name('admin.manage-users');
    Route::delete('admin/delete-user/{id}', [AdminController::class, 'deleteUser'])->name('admin.delete-user');
});

// Project Owner routes
Route::middleware(['auth', 'project_owner'])->group(function () {
    Route::get('project_owner/dashboard', [ProjectOwnerController::class, 'index'])->name('project_owner.dashboard');
    Route::get('project_owner/my-campaigns', [ProjectOwnerController::class, 'myCampaigns'])->name('project_owner.my-campaigns');
    Route::get('project_owner/create-campaign', [ProjectOwnerController::class, 'createCampaign'])->name('project_owner.create-campaign');
    Route::post('project_owner/store-campaign', [ProjectOwnerController::class, 'storeCampaign'])->name('project_owner.store-campaign');
    Route::get('project_owner/edit-campaign/{id}', [ProjectOwnerController::class, 'editCampaign'])->name('project_owner.edit-campaign');
    Route::patch('project_owner/update-campaign/{id}', [ProjectOwnerController::class, 'updateCampaign'])->name('project_owner.update-campaign');
    Route::delete('project_owner/delete-campaign/{id}', [ProjectOwnerController::class, 'deleteCampaign'])->name('project_owner.delete-campaign');

});

// Contributor routes
Route::middleware(['auth', 'contributor'])->group(function () {
    Route::get('contributor/dashboard', [ContributorController::class, 'index'])->name('contributor.dashboard');
    Route::get('contributor/contributions', [ContributionController::class, 'index'])->name('contributor.contributions');
    Route::get('campaigns/{campaign}/contribute', [ContributionController::class, 'create'])->name('contributions.create');
    Route::post('campaigns/{campaign}/contribute', [ContributionController::class, 'store'])->name('contributions.store');
    Route::get('/campaigns/{campaign}/contributions/success', [ContributionController::class, 'success'])->name('contributions.success');
    Route::get('/campaigns/{campaign}/contributions/cancel', [ContributionController::class, 'cancel'])->name('contributions.cancel');
    Route::get('campaigns/{campaign}/capture-order', [ContributionController::class, 'captureOrder'])->name('contributions.capture');

});

 // Public routes
 Route::get('/campaigns', [CampaignController::class, 'index'])->name('campaigns');
 Route::get('/campaigns/{id}', [CampaignController::class, 'show'])->name('campaigns.show');

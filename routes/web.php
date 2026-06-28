<?php

use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\CmsController;

Route::get('/', [PortfolioController::class, 'index'])->name('home');
Route::get('/commission', [PortfolioController::class, 'commission'])->name('commission');
Route::post('/feedback', [PortfolioController::class, 'storeFeedback'])->name('feedback.store');

Route::prefix('cms')->group(function () {
    Route::get('/login', [CmsController::class, 'showLogin'])->name('login');
    Route::post('/login', [CmsController::class, 'login'])->middleware('throttle:5,1');
    
    Route::middleware('auth')->group(function () {
        Route::get('/', [CmsController::class, 'index'])->name('cms.dashboard');
        Route::post('/logout', [CmsController::class, 'logout'])->name('logout');
        Route::post('/items', [CmsController::class, 'store'])->name('cms.items.store');
        Route::post('/items/{id}', [CmsController::class, 'update'])->name('cms.items.update');
        Route::post('/items/{id}/toggle-direction', [CmsController::class, 'toggleDirection'])->name('cms.items.toggle-direction');
        Route::post('/illustrations/reorder', [CmsController::class, 'reorderIllustrations'])->name('cms.illustrations.reorder');
        Route::delete('/items/{id}', [CmsController::class, 'destroy'])->name('cms.items.destroy');
        Route::post('/about', [CmsController::class, 'updateAbout'])->name('cms.about.update');
        Route::post('/about/reset', [CmsController::class, 'resetAbout'])->name('cms.about.reset');
        Route::post('/settings', [CmsController::class, 'updateSettings'])->name('cms.settings.update');
        Route::post('/commissions/settings', [CmsController::class, 'updateCommissionSettings'])->name('cms.commissions.settings.update');
        Route::post('/commissions/slots', [CmsController::class, 'updateCommissionSlots'])->name('cms.commissions.slots.update');
        Route::post('/commissions/{id}', [CmsController::class, 'updateCommission'])->name('cms.commissions.update');
        Route::post('/socials', [CmsController::class, 'storeSocialLink'])->name('cms.socials.store');
        Route::post('/socials/reorder', [CmsController::class, 'reorderSocialLinks'])->name('cms.socials.reorder');
        Route::post('/socials/{id}', [CmsController::class, 'updateSocialLink'])->name('cms.socials.update');
        Route::delete('/socials/{id}', [CmsController::class, 'destroySocialLink'])->name('cms.socials.destroy');
        Route::delete('/feedback/{id}', [CmsController::class, 'destroyFeedback'])->name('cms.feedback.destroy');
    });
});

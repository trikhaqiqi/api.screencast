<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Screencast\{TagController, VideoController, PlaylistController};

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function() {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::prefix('playlists')->middleware('permission:create playlists')->group(function () {
        Route::get('create', [PlaylistController::class, 'create'])->name('playlists.create');
        Route::post('create', [PlaylistController::class, 'store']);
        Route::get('table', [PlaylistController::class, 'table'])->name('playlists.table');
        Route::get('{playlist:slug}/edit', [PlaylistController::class, 'edit'])->name('playlists.edit');
        Route::put('{playlist:slug}/edit', [PlaylistController::class, 'update']);
        Route::delete('{playlist:slug}/delete', [PlaylistController::class, 'destroy'])->name('playlists.delete');
    });

    Route::prefix('videos')->middleware('permission:create playlists')->group(function () {
        Route::get('table/{playlist:slug}', [VideoController::class, 'table'])->name('videos.table');
        Route::get('create/into/{playlist:slug}', [VideoController::class, 'create'])->name('videos.create');
        Route::post('create/into/{playlist:slug}', [VideoController::class, 'store']);
        Route::get('edit/{playlist:slug}/{video:unique_video_id}', [VideoController::class, 'edit'])->name('videos.edit');
        Route::put('edit/{playlist:slug}/{video:unique_video_id}', [VideoController::class, 'update']);
        Route::delete('delete/{playlist:slug}/{video:unique_video_id}', [VideoController::class, 'destroy'])->name('videos.delete');
    });

    Route::prefix('tags')->group(function () {
        Route::middleware('permission:create tags')->group(function() {
            Route::get('table', [TagController::class, 'table'])->name('tags.table');
            Route::get('create', [TagController::class, 'create'])->name('tags.create');
            Route::post('create', [TagController::class, 'store']);
        });

        Route::middleware(['permission::delete tags', 'permission: edit tags'])->group(function () {
            Route::get('{tag:slug}/edit', [TagController::class, 'edit'])->name('tags.edit');
            Route::put('{tag:slug}/edit', [TagController::class, 'update']);
            Route::delete('{tag:slug}/delete', [TagController::class, 'destroy'])->middleware('permission:delete tags')->name('tags.delete'); 
        });
    });
});

require __DIR__.'/auth.php';

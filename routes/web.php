<?php

use App\Http\Controllers\Admin\PanelController;
use App\Http\Controllers\Site\PagesController;
use Illuminate\Support\Facades\Route;


// For Site
Route::get('/', [PagesController::class, 'index'])->name('pages.index');

// For Panal Admin
Route::get('/paneladmin', [PanelController::class, 'panel'])->name('admin.panel');


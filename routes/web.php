<?php

use App\Http\Controllers\Admin\PanelController;
use App\Http\Controllers\Site\PagesController;
use Illuminate\Support\Facades\Route;


// For Site
Route::get('/', [PagesController::class, 'index'])->name('pages.index');

// For Panal Admin
Route::get('/paneladmin', [PanelController::class, 'login'])->name('admin.login');
Route::post('/paneladmin/efetua-login', [panelController::class, 'efetlogin'])->name('login');
Route::get('/paneladmin/homeadmin', [panelController::class, 'homeadmin'])->name('admin.home');

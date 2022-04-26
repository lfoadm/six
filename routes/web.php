<?php

use App\Http\Controllers\Admin\panelController;
use App\Http\Controllers\Auth\usuariosController;
use App\Http\Controllers\Site\pagesController;
use Illuminate\Support\Facades\Route;


// Gestão do Site
Route::get('/', [pagesController::class, 'index'])->name('pages.index');

// Administração painel
Route::get('/paneladmin', [panelController::class, 'login'])->name('admin.login');
Route::post('/paneladmin/efetua-login', [panelController::class, 'efetlogin'])->name('login');
Route::get('/paneladmin/homeadmin', [panelController::class, 'homeadmin'])->name('admin.home');

//Administração de usuários
Route::get('/paneladmin/p-usuarios', [usuariosController::class, 'index'])->name('usuarios.index');

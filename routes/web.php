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
Route::get('/paneladmin/p-usuarios-incluir', [usuariosController::class, 'create'])->name('usuarios.create');
Route::post('/paneladmin/p-usuarios-salva-inclusao', [usuariosController::class, 'store'])->name('usuarios.store');
Route::get('/paneladmin/p-usuarios-editar/{id}', [usuariosController::class, 'edit'])->name('usuarios.edit');
Route::post('/paneladmin/p-usuarios-salva-alteracao', [usuariosController::class, 'update'])->name('usuarios.update');
Route::get('/paneladmin/p-usuarios-excluir/{id}', [usuariosController::class, 'show'])->name('usuarios.show');
Route::post('/paneladmin/p-usuarios-salva-exclusao', [usuariosController::class, 'destroy'])->name('usuarios.destroy');

//Permissões de usuários
Route::get('/paneladmin/p-usuarios-permissoes/{id}', [usuariosController::class, 'frm_usuarios_permissoes'])->name('usuarios.permissoes.show');
Route::post('/paneladmin/p-usuarios-salva-permissoes', [usuariosController::class, 'frm_usuarios_permissoes_salva'])->name('usuarios.permissoes.store');

//Status de usuários
Route::get('/paneladmin/p-usuarios-desativar/{id}', [usuariosController::class, 'frm_usuarios_desativar'])->name('usuarios.desativar');
Route::get('/paneladmin/p-usuarios-ativar/{id}', [usuariosController::class, 'frm_usuarios_ativar'])->name('usuarios.ativar');

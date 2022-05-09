<?php

use App\Http\Controllers\Admin\menusController;
use App\Http\Controllers\Admin\panelController;
use App\Http\Controllers\Admin\profileController;
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

//Perfil de usuários
Route::get('paneladmin/p-usuarios-profile', [profileController::class, 'frm_usuarios_profile'])->name('usuarios.profile');
Route::post('paneladmin/p-usuarios-profile-salva-dados', [profileController::class, 'frm_usuarios_profile_salva_dados'])->name('profile.salvaDados');
Route::post('paneladmin/p-usuarios-profile-salva-senha', [profileController::class, 'frm_usuarios_profile_salva_senha'])->name('profile.salvaSenha');
Route::get('paneladmin/p-usuarios-profile-profile-foto', [profileController::class, 'frm_usuarios_profile_profile_foto'])->name('profile.profileFoto');
Route::post('paneladmin/p-usuarios-profile-salva-foto', [profileController::class, 'frm_usuarios_profile_picture_salva'])->name('profile.pictureSalva');
Route::get('paneladmin/p-usuarios-profile-exclui-foto', [profileController::class, 'frm_usuarios_profile_picture_exclui'])->name('profile.pictureExclui');

//Administração de menus
Route::get('/paneladmin/p-menus', [menusController::class, 'index'])->name('menus.index');
Route::get('/paneladmin/p-menus-incluir', [menusController::class, 'create'])->name('menus.create');
Route::post('/paneladmin/p-menus-salva-inclusao', [menusController::class, 'store'])->name('menus.store');
Route::get('/paneladmin/p-menus-ativar/{id}', [menusController::class, 'frm_menus_ativar'])->name('menus.ativar');
Route::get('/paneladmin/p-menus-desativar/{id}', [menusController::class, 'frm_menus_desativar'])->name('menus.desativar');
Route::get('/paneladmin/p-menus-principal-salva/{id}', [menusController::class, 'frm_menus_principal_salva'])->name('menus.principal');
Route::post('/paneladmin/p-menus-ordenar-salva', [menusController::class, 'frm_menus_ordenar_salva']);
Route::get('/paneladmin/p-menus-alterar/{id}', [menusController::class, 'edit'])->name('menus.edit');
Route::post('/paneladmin/p-menus-salva-alteracao', [menusController::class, 'update'])->name('menus.update');
Route::get('/paneladmin/p-menus-excluir/{id}', [menusController::class, 'destroy'])->name('menus.destroy');
Route::post('/paneladmin/p-menus-salva-exclusao', [menusController::class, 'destroy_salva'])->name('menus.delete');

//Conteudos dos menus
Route::get('/paneladmin/p-menus-conteudos/{id}', [menusController::class, 'indexConteudos'])->name('menus.conteudos.index');
Route::get('/paneladmin/p-menus-conteudos-incluir/{id}', [menusController::class, 'createConteudos'])->name('menus.conteudos.create');
Route::post('/paneladmin/p-menus-conteudos-salva-inclusao', [menusController::class, 'storeConteudos'])->name('menus.conteudos.store');
Route::get('/paneladmin/p-menus-conteudos-alterar/{id}', [menusController::class, 'editConteudos'])->name('menus.conteudos.edit');
Route::post('/paneladmin/p-menus-conteudos-salva-alteracao', [menusController::class, 'updateConteudos'])->name('menus.conteudos.update');
Route::get('/paneladmin/p-menus-conteudos-excluir/{id}', [menusController::class, 'showConteudos'])->name('menus.conteudos.show');
Route::post('/paneladmin/p-menus-conteudos-salva-exclusao', [menusController::class, 'destroyConteudos'])->name('menus.conteudos.destroy');
Route::get('/paneladmin/p-menus-conteudos-ativar/{id}', [menusController::class, 'frm_menus_conteudos_ativar'])->name('menus.conteudos.ativar');
Route::get('/paneladmin/p-menus-conteudos-desativar/{id}', [menusController::class, 'frm_menus_conteudos_desativar'])->name('menus.conteudos.desativar');
Route::post('/paneladmin/p-menus-conteudos-ordenar-salva', [menusController::class, 'frm_menus_conteudos_ordenar_salva']);

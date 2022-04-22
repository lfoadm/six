<?php

use App\Http\Controllers\Site\PagesController;
use Illuminate\Support\Facades\Route;


// For Site
Route::get('/', [PagesController::class, 'index'])->name('pages.index');


<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;

Route::get('usuarios', [UsuariosController::class, 'index'])->name('usuarios.index');
Route::post('usuarios/post', [UsuariosController::class, 'store'])->name('usuarios.store');
Route::get('usuarios/{id}', [UsuariosController::class, 'show'])->name('usuarios.show');
Route::put('usuarios/{id}', [UsuariosController::class, 'update'])->name('usuarios.update');
Route::delete('usuarios/{id}', [UsuariosController::class, 'destroy'])->name('usuarios.destroy');


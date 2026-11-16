<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Middleware\CheckIsLogged;
use App\Http\Middleware\CheckIsNotLogged;
use Illuminate\Support\Facades\Route;

//Rotas para Auth - verificação de não logado
Route::middleware([CheckIsNotLogged::class])->group(function () {
    //auth routes
    Route::get('/login', [AuthController::class, 'login']);
    Route::post('/loginSubmit', [AuthController::class, 'loginSubmit']);
});
//Rotas para verificação de logado
Route::middleware([CheckIsLogged::class])->group(function () {
    //main routes
    Route::get('/', [MainController::class, 'index'])->name('home');
    Route::get('/nova-nota', [MainController::class, 'novaNota'])->name('new');
    Route::post('/nota-submit', [MainController::class, 'criarNota'])->name('nova-nota-submit');
    //editar e deletar notas
    Route::get('/editar/{id}', [MainController::class, 'editarNota'])->name('edit');
    Route::post('/editar-submit', [MainController::class, 'editarNotaSubmit'])->name('editar-nota-submit');

    //deletar nota
    Route::get('/deletar/{id}', [MainController::class, 'deletarNota'])->name('del');
    Route::get('/deletar-nota-confirma/{id}', [MainController::class, 'deletarNotaConfirma'])->name('del-nota-confirma');
    //logout route
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

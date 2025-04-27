<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\TipoDespesaController;
use App\Http\Controllers\TipoRendaController;
use App\Http\Controllers\BancoController;
use App\Http\Controllers\CartaoController;
use App\Http\Controllers\DespesaController;
use App\Http\Controllers\MensalidadeCartaoController;
use App\Http\Controllers\RendaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', [IndexController::class, 'index'])->name('home');

/*Route::get('/tiporenda', [TipoRendaController::class, 'iniciar'])->name('tiporenda');

Route::post('/tiporenda', [TipoRendaController::class, 'salvar'])->name('fonterenda.salvar');*/

/*Route::prefix('tiporenda')->name('tiporenda.')->group(function () {
    Route::get('/', [TipoRendaController::class, 'iniciar'])->name('index');
    Route::post('/', [TipoRendaController::class, 'salvar'])->name('salvar');
});*/

Route::prefix('tiporenda')->name('tiporenda.')->group(function () {
    Route::get('/', [TipoRendaController::class, 'iniciar'])->name('index');
    Route::post('/', [TipoRendaController::class, 'salvar'])->name('salvar');
    Route::put('/{id}', [TipoRendaController::class, 'atualizar'])->name('atualizar');
});

Route::prefix('tipodespesa')->name('tipodespesa.')->group(function () {
    Route::get('/', [TipoDespesaController::class, 'iniciar'])->name('index');
    Route::post('/', [TipoDespesaController::class, 'salvar'])->name('salvar');
    Route::put('/{id}', [TipoDespesaController::class, 'atualizar'])->name('atualizar');
});

Route::prefix('banco')->name('banco.')->group(function () {
    Route::get('/', [BancoController::class, 'iniciar'])->name('index');
    Route::post('/', [BancoController::class, 'salvar'])->name('salvar');
    Route::put('/{id}', [BancoController::class, 'atualizar'])->name('atualizar');
});

Route::prefix('cartao')->name('cartao.')->group(function() {
    Route::get('/', [CartaoController::class, 'iniciar'])->name('index');
    Route::post('/', [CartaoController::class, 'salvar'])->name('salvar');
});

Route::prefix('mensalidadecartao')->name('mensalidadecartao.')->group(function() {
    Route::get('/', [MensalidadeCartaoController::class, 'iniciar'])->name('index');
    Route::post('/', [MensalidadeCartaoController::class, 'salvar'])->name('salvar');
});

Route::prefix('despesa')->name('despesa.')->group(function(){
    Route::get('/', [DespesaController::class, 'iniciar'])->name('index');
    Route::post('/', [DespesaController::class, 'salvar'])->name('salvar');
    Route::put('/{id}', [DespesaController::class, 'atualizar'])->name('atualizar');
});

Route::prefix('renda')->name('renda.')->group(function(){
    Route::get('/', [RendaController::class, 'iniciar'])->name('index');
    Route::post('/', [RendaController::class, 'salvar'])->name('salvar');
    Route::put('/{id}', [RendaController::class, 'atualizar'])->name('atualizar');

    //Route::put('/{id}', [TipoRendaController::class, 'atualizar'])->name('atualizar');
});
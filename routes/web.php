<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AulaController;
use App\Http\Controllers\UserController;
use App\Models\Aula;
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


//Lista de Aulas
Route::get('/', [AulaController::class, 'listarAulas'])->name('aula.listagem');

//Login
Route::get('/login', [UserController::class, 'showFormLogin'])->name('login');
Route::post('/login', [UserController::class, 'showFormLoginAction'])->name('login.autenticar');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

//Login Novo Usuário
Route::get('/login/usuario', [UserController::class, 'showFormNovoUsuario'])->name('login.novo.usuario');
Route::post('/login/usuario', [UserController::class, 'showFormNovoUsuarioAction'])->name('login.novo.usuario.salvar');


//Admin Dashboard
Route::get('/painel',  [AdminController::class, 'dashboard'])->name('painel.dashboard');

//Admin Dashboard Nova Aula
Route::get('/painel/novaaula',[AdminController::class, 'showFormNovaAula'])->name('painel.novaaula.form');
Route::post('/painel/novaaula',[AdminController::class, 'showFormNovaAulaAction'])->name('painel.novaaula.salvar');

//Admin Dashboard Editar Aula
Route::get('/painel/editaraula/{id}',[AdminController::class, 'showFormEditaAula'])->name('painel.editaaula.form');
Route::post('/painel/editaraula/{id}',[AdminController::class, 'showFormEditaAulaAction'])->name('painel.editaaula.salvar');

//Exibir Alunos Inscritos na Aula
Route::get('/painel/inscritosaula/{id}',[AdminController::class, 'showFormAlunosInscritosAula'])->name('painel.inscritosaula.form');


//Fazer Inscrição e Cancelar Inscrição
Route::get('/painel/cancelarinscricao/{id}',[AdminController::class, 'showCancelarInscricaoAula'])->name('painel.cancelarinscricao.form');
Route::get('/painel/fazerinscricao/{id}',[AdminController::class, 'showFazerInscricaoAula'])->name('painel.fazerinscricao.form');

//Admin Dashboard Remover Aula
Route::get('/painel/removeraula/{id}',[AdminController::class, 'showRemoverAulaAction'])->name('painel.removeraula');

//Admin Dashboard Editar Usuario Logado
Route::get('/login/usuario/editar', [AdminController::class,'showFormEditarUsuario'])->name('usuario.editar.form');
Route::post('/login/usuario/editar',[AdminController::class,'showFormEditarUsuarioAction'])->name('usuario.editar.salvar');
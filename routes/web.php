<?php

use App\Http\Controllers\ProjetosController;
use App\Http\Controllers\TarefasController;
use App\Http\Controllers\FuncionariosController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\ZettawireController;
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

Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/auth.php';

//Projeto - Em andamento
Route::post('/projeto/adiciona',[ProjetosController::class, 'adiciona'])->name('add_projeto')->middleware('auth');//funciona
Route::get('/projeto/novo', [ProjetosController::class,'formAdicionaProjeto'])->name('novo_projeto')->middleware('auth');//funciona

Route::get('/projeto/liberados', [ProjetosController::class, 'liberado'])->name('liberado')->middleware('auth');//funciona
Route::put('/projeto/moverparateste/{id}', [ProjetosController::class, 'moverParaTeste'])->name('moverParaTeste')->middleware('auth');//funciona

Route::get('/projeto/teste', [ProjetosController::class, 'teste'])->name('teste')->middleware('auth');//funciona
Route::put('/projeto/devolverTeste/{id}', [ProjetosController::class, 'devolverParaTeste'])->name('devolverParaTeste')->middleware('auth');

Route::get('/projeto/encerrados', [ProjetosController::class, 'encerrado'])->name('encerrado')->middleware('auth');//funciona
Route::put('/projeto/concluir/{id}', [ProjetosController::class, 'moverParaEncerrados'])->name('encerrarProjeto')->middleware('auth');//funciona

Route::get('/projeto/mostra/{id}', [ProjetosController::class, 'mostra'])->name('mostra_projeto')->middleware('auth');//funciona
Route::delete('/projeto/remove/{id}', [ProjetosController::class, 'remove'])->name('remover_projeto')->middleware('auth');//funciona

Route::get('/projeto/export/{id}', [ExcelController::class, 'export'])->name('excel');

//Rotas Métodos / Tarefas - Feito
Route::post('/tarefa/adiciona', [TarefasController::class, 'adiciona'])->name('add_tarefa')->middleware('auth');//funciona
Route::post('/tarefas/adiciona_conjunto', [TarefasController::class, 'adicionaConjunto'])->name('add_conjunto')->middleware('auth');//funciona
Route::get('/tarefas/filtrar/{id}', [TarefasController::class, 'filtrar'])->name('filtrar_tarefa')->middleware('auth'); //funciona
Route::get('/tarefas/mostra/{id}', [TarefasController::class, 'mostra'])->name('mostra_tarefa')->middleware('auth');//funciona
Route::get('/tarefas/index', [TarefasController::class, 'index'])->name('index_tarefas')->middleware('auth');//funciona
Route::get('/tarefas/lista/{id}', [TarefasController::class, 'lista'])->name('lista_tarefas')->middleware('auth');//funciona
Route::get('/tarefas/novo/{id}', [TarefasController::class, 'nova_tarefa'])->name('nova_tarefa')->middleware('auth');//funciona
Route::get('/tarefas/conjunto/{id}', [TarefasController::class, 'novo_conjunto'])->name('nova_tarefa')->middleware('auth');
Route::get('/tarefas/editar/{id}', [TarefasController::class, 'editar'])->name('editar_tarefa')->middleware('auth');//funciona
Route::put('/tarefas/atualizar/{id}', [TarefasController::class, 'atualizar'])->name('atualizar_tarefa')->middleware('auth');//funciona
Route::put('/tarefas/retrabalho/{id}', [TarefasController::class, 'retrabalho'])->name('retrabalho')->middleware('auth');
Route::get('/tarefas/concluir/{id}', [TarefasController::class, 'concluir'])->name('concluir_tarefa')->middleware('auth');//funciona
Route::delete('/tarefas/remove/{id}', [TarefasController::class, 'remove'])->name('remover_tarefa')->middleware('auth');//funciona

//Rotas Zettawire Cable Routing
Route::get('/zettawire/index', [ZettawireController::class, 'index'])->name('index_zettawire')->middleware('auth');
Route::get('/zettawire/roteamento/{id}', [ZettawireController::class, 'roteamento'])->name('roteamento')->middleware('auth');
Route::get('/upload', [ZettawireController::class, 'form']);
Route::post('/upload/{id}', [zettawireController::class, 'upload'])->name('upload');
Route::post('/zettawire/roteamento/origem/{id}', [ZettawireController::class, 'origem'])->name('origem')->middleware('auth');
Route::post('/zettawire/roteamento/destino/{id}', [ZettawireController::class, 'destino'])->name('destino')->middleware('auth');
Route::post('/zettawire/roteamento/finalizaCabo/{id}', [ZettawireController::class, 'finalizaCabo'])->name('finaliza')->middleware('auth');
Route::get('/zettawire/buscar/{id}', [ZettawireController::class, 'buscar'])->name('buscar');
Route::get('/zettawire/buttons/{id}', [ZettawireController::class, 'getButtons'])->name('zettawire.buttons');
Route::post('/zettawire/roteamento/alterarStatus/{id}', [ZettawireController::class, 'alterarStatus'])->name('alterarStatus');
Route::delete('/zettawire/finish-project/{id}', [ZettawireController::class, 'finishProject'])->name('finish-project')->middleware('auth');//funciona

// Rotas Zettawire Cable Confeccion
Route::get('/zettawire/confeccion/index', [ZettawireController::class, 'confeccionIndex'])->name('index_confeccion')->middleware('auth');
Route::get('/zettawire/confeccion/{id}', [ZettawireController::class, 'confeccao'])->name('confeccion')->middleware('auth');
Route::post('/zettawire/confeccion/cableDone/{id}', [ZettawireController::class, 'cableDone'])->name('cableDone')->middleware('auth');

//Rotas Funcionarios
Route::get('/funcionarios/index', [FuncionariosController::class, 'index'])->name('index_funcionario')->middleware('auth');//funciona
Route::get('/funcionarios/lista/{id}', [FuncionariosController::class, 'lista'])->name('lista_tarefas_funcionario')->middleware('auth');//funciona
Route::post('/funcionarios/inicio/{id}', [FuncionariosController::class, 'inicio'])->name('inicio_tarefa')->middleware('auth');//funciona
Route::post('/funcionarios/termino/{id}', [FuncionariosController::class, 'termino'])->name('termino_tarefa')->middleware('auth');//funciona
Route::post('/funcionarios/inicioPausa/{id}', [FuncionariosController::class, 'inicioPausa'])->name('inicio_pausa')->middleware('auth');//funciona
Route::post('/funcionarios/terminoPausa/{id}', [FuncionariosController::class, 'terminoPausa'])->name('termino_pausa')->middleware('auth');//funciona

//Logout
Route::get('/sair', [UserController::class, 'sair'])->name('sair');

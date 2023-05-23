<?php

use App\Http\Controllers\ProjetosController;
use App\Http\Controllers\TarefasController;
use App\Http\Controllers\FuncionariosController;
use App\Http\Controllers\AjudaController;
use App\Http\Controllers\ChamadosController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DiretoriaController;
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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::post('/projeto/adiciona',[ProjetosController::class, 'adiciona'])->name('add_projeto')->middleware('auth');//funciona
Route::post('/projeto/add_comentario/{id}',[ProjetosController::class, 'add_comentario'])->name('add_comentario')->middleware('auth');//funciona
Route::get('/projeto/andamento', [ProjetosController::class, 'andamento'])->name('controle')->middleware('auth');//funciona
Route::get('/projeto/encerrados', [ProjetosController::class, 'encerrado'])->name('encerrado')->middleware('auth');//funciona
Route::get('/projeto/liberados', [ProjetosController::class, 'liberado'])->name('liberado')->middleware('auth');//funciona
Route::get('/projeto/teste', [ProjetosController::class, 'teste'])->name('teste')->middleware('auth');//funciona
Route::get('/projeto/novo', [ProjetosController::class,'novo_registro'])->name('novo_projeto')->middleware('auth');//funciona
Route::get('/projeto/mostra/{id}', [ProjetosController::class, 'mostra'])->name('mostra_projeto')->middleware('auth');//funciona
Route::get('/projeto/editar/{id}', [ProjetosController::class, 'editar'])->name('editar_projeto')->middleware('auth');//funciona
Route::get('/projeto/responsavel/{id}', [ProjetosController::class, 'responsavel'])->name('responsavel')->middleware('auth');//funciona
Route::put('/projeto/concluir/{id}', [ProjetosController::class, 'concluir'])->name('concluir_projeto')->middleware('auth');//funciona
Route::put('/projeto/moverparateste/{id}', [ProjetosController::class, 'para_teste'])->name('para_teste')->middleware('auth');//funciona
Route::put('/projeto/libera/{id}', [ProjetosController::class, 'liberar'])->name('liberar_projeto')->middleware('auth');//funciona
Route::put('/projeto/devolverLiberado/{id}', [ProjetosController::class, 'devolverLiberado'])->name('devolver_liberado')->middleware('auth');//funciona
Route::put('/projeto/devolverTeste/{id}', [ProjetosController::class, 'devolverTeste'])->name('devolver_teste')->middleware('auth');
Route::put('/projeto/atualizar/{id}', [ProjetosController::class, 'atualizar'])->name('atualizar')->middleware('auth');//funciona
Route::put('/projeto/atualizarProjeto/{id}', [ProjetosController::class, 'atualizarProjeto'])->name('atualizar_projeto')->middleware('auth');
Route::delete('/projeto/remove/{id}', [ProjetosController::class, 'remove'])->name('remover_projeto')->middleware('auth');//funciona

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

//Rotas Funcionarios - Em andamento
Route::get('/funcionarios/index', [FuncionariosController::class, 'index'])->name('index_funcionario')->middleware('auth');//funciona
Route::get('/funcionarios/lista/{id}', [FuncionariosController::class, 'lista'])->name('lista_tarefas_funcionario')->middleware('auth');//funciona
Route::post('/funcionarios/inicio/{id}', [FuncionariosController::class, 'inicio'])->name('inicio_tarefa')->middleware('auth');//funciona
Route::post('/funcionarios/termino/{id}', [FuncionariosController::class, 'termino'])->name('termino_tarefa')->middleware('auth');//funciona
Route::post('/funcionarios/inicioPausa/{id}', [FuncionariosController::class, 'inicioPausa'])->name('inicio_pausa')->middleware('auth');//funciona
Route::post('/funcionarios/terminoPausa/{id}', [FuncionariosController::class, 'terminoPausa'])->name('termino_pausa')->middleware('auth');//funciona

//Rotas Ajuda/Fit
Route::get('/ajuda/lista', [AjudaController::class, 'lista'])->name('ajuda_lista')->middleware('auth');//funciona
Route::get('/ajuda/{id}', [AjudaController::class, 'mostra'])->name('index_ajuda')->middleware('auth');//funciona

//Diretoria
Route::get('/diretoria/index', [DiretoriaController::class, 'index'])->name('index_diretoria')->middleware('auth');
ROute::get('/diretoria/lista/{id}', [DiretoriaController::class, 'lista'])->name('lista_diretoria')->middleware('auth');

//Chamados
Route::get('/chamados/lista', [ChamadosController::class, 'lista'])->name('lista_chamados')->middleware('auth');//funciona
Route::get('/chamados/mostra/{id}', [ChamadosController::class, 'mostra'])->name('mostra_chamados')->middleware('auth');
Route::get('/chamados/novo', [ChamadosController::class, 'novo'])->name('novo_chamado')->middleware('auth');//funciona
Route::post('/chamados/adiciona', [ChamadosController::class, 'adiciona'])->name('adiciona_chamados')->middleware('auth');//funciona
Route::put('/chamados/concluir/{id}', [ChamadosController::class, 'concluir'])->name('concluir_chamado')->middleware('auth');//funciona

//Logout
Route::get('/sair', [UserController::class, 'sair'])->name('sair');

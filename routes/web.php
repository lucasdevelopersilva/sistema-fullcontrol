<?php

use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\Backend\DashController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\ProgramaController;
use App\Http\Controllers\Backend\EquipeController;
use App\Http\Controllers\Backend\PromocaoController;
use App\Http\Controllers\Backend\RecadoController;
use App\Http\Controllers\Backend\PushController;
use App\Http\Controllers\Backend\ConfigController;
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
Route::namespace("Frontend")->group(function(){
    Route::get("/", [HomeController::class,"index"])->name('login'); 
});

Route::namespace("Backend")->group(function(){
    Route::get("/dashboard",[DashController::class,"index"])->name('dashboard'); 
    //noticias
    Route::get("/noticias",[PostController::class,"index"])->name('noticia'); 
    Route::get("/addnoticia",[PostController::class,"edit"])->name('editar');  
    Route::post("/addnoticia/{id}",[PostController::class,"save"]); 
    //programação
    Route::get("/programacao",[ProgramaController::class,"index"]);
    Route::get("/addprogramacao/{id}",[ProgramaController::class,"edit"]);
    Route::post("/addprogramacao/{id}",[ProgramaController::class,"save"]);
    //  Equipe
    Route::get("/equipe",[EquipeController::class,"index"]);
    Route::get("/addequipe/{id}",[EquipeController::class,"edit"]);
    Route::post("/addequipe/{id}",[EquipeController::class,"save"]);
    //  Promoção
    Route::get("/promocao",[PromocaoController::class,"index"]);
    Route::get("/addpromocao/{id}",[PromocaoController::class,"edit"]);
    Route::post("/addpromocao/{id}",[PromocaoController::class,"save"]);
    
    Route::get("/recados",[RecadoController::class,"index"]);
    Route::get("/push",[PushController::class,"index"])->name('notificacao');
    Route::get("/config",[ConfigController::class,"index"])->name('config');
    Route::get("/condig-logotipo",[ConfigController::class,"logotipo"])->name('logotipo');
    Route::get("/condig-bg",[ConfigController::class,"background"])->name('background');
    
});

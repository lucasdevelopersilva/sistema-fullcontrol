<?php

use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\HomeController;
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
    Route::get("/", [HomeController::class,"index"]); 
});

Route::namespace("Backend")->group(function(){
    Route::get("/dashboard",[DashController::class,"index"]);
    //noticias
    Route::get("/noticias",[PostController::class,"index"]);
    Route::get("/addnoticia",[PostController::class,"edit"]);
    Route::post("/addnoticia",[PostController::class,"save"]);
    //programação
    Route::get("/programacao",[ProgramaController::class,"index"]);
    Route::get("/addprogramacao",[ProgramaController::class,"edit"]);
    Route::post("/addprogramacao",[ProgramaController::class,"save"]);
    //  Equipe
    Route::get("/equipe",[EquipeController::class,"index"]);
    Route::get("/addequipe",[EquipeController::class,"edit"]);
    Route::post("/addequipe",[EquipeController::class,"save"]);
    //  Promoção
    Route::get("/promocao",[PromocaoController::class,"index"]);
    Route::get("/addpromocao",[PromocaoController::class,"edit"]);
    Route::post("/addpromocao",[PromocaoController::class,"save"]);
    
    Route::get("/recados",[RecadoController,"index"]);
    Route::get("/push",[PushController,"index"]);
    Route::get("/config",[ConfigController,"index"]);
    
});

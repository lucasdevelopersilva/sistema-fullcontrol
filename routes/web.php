<?php

use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\Backend\DashController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\ProgramaController;
use App\Http\Controllers\Backend\EquipeController;
use App\Http\Controllers\Backend\PromocaoController;
use App\Http\Controllers\Backend\RecadoController;
use App\Http\Controllers\Backend\PushController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\ConfigController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Backend\gerarApp;
use App\Http\Controllers\Api\ApiController;
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
//Route::namespace("Api")->group(function(){
//   
//});

Route::namespace("Backend")->group(function(){
    
    Route::get("/", [AuthController::class,"index"])->name('login');
    Route::post("/do", [AuthController::class,"login"])->name('user.formlogin'); 
    Route::get("/logout", [AuthController::class,"logout"])->name('user.logout'); 
    
    Route::get("/dashboard",[DashController::class,"index"])->name('dashboard'); 
    //noticias
    Route::get("/noticias",[PostController::class,"index"])->name('noticia.index'); 
    Route::get("/addnoticia",[PostController::class,"create"])->name('noticia.create');   
    Route::get("/addnoticia/{id}",[PostController::class,"edit"])->name("noticia.save"); 
    Route::post("/addnoticia/{id}",[PostController::class,"update"])->name("noticia.update"); 
    Route::get("/noticias/{id}",[PostController::class,"destroy"])->name("noticia.delete"); 
    //programação
    Route::get("/programacao",[ProgramaController::class,"index"])->name("programacao.index");
    Route::get("/addprogramacao",[ProgramaController::class,"create"])->name("programacao.create");
    Route::get("/addprogramacao/{id}",[ProgramaController::class,"edit"])->name("programacao.save");
    Route::post("/addprogramacao/{id}",[ProgramaController::class,"update"])->name("programacao.update");
    Route::post("/programacao/{id}",[ProgramaController::class,"destroy"])->name("programacao.delete");
    //  Equipe
    Route::get("/equipe",[EquipeController::class,"index"])->name("equipe.index");
    Route::get("/addequipe",[EquipeController::class,"create"])->name("equipe.create");
    Route::get("/addequipe/{id}",[EquipeController::class,"edit"])->name("equipe.save");
    Route::post("/addequipe/{id}",[EquipeController::class,"update"])->name("equipe.update");
    Route::post("/equipe/{id}",[EquipeController::class,"destroy"])->name("equipe.delete");
    //  Promoção
    Route::get("/promocao",[PromocaoController::class,"index"])->name("promocao.index");
    Route::get("/addpromocao",[PromocaoController::class,"create"])->name("promocao.create");
    Route::get("/addpromocao/{id}",[PromocaoController::class,"edit"])->name("promocao.save");
    Route::post("/addpromocao/{id}",[PromocaoController::class,"update"])->name("promocao.update");
    Route::post("/promocao/{id}",[PromocaoController::class,"destroy"])->name("promocao.delete");
    //  Usuários
    Route::get("/users",[UserController::class,"index"])->name("users.index");
    Route::post("/users",[UserController::class,"index"])->name("users.index");
    Route::get("/addusers",[UserController::class,"create"])->name("users.create");
    Route::get("/loginid/{id}",[UserController::class,"loginId"])->name("users.loginid");
    Route::get("/adminloginid/{id}",[UserController::class,"loginIdAdmin"])->name("login.admin");
    Route::get("/addusers/{id}",[UserController::class,"edit"])->name("users.save");
    Route::post("/addusers/{id}",[UserController::class,"update"])->name("users.update");
    Route::get("/users/{id}",[UserController::class,"destroy"])->name("users.delete");
    
    Route::get("/radio",[UserController::class,"editprofile"])->name("radio.save");
    Route::post("/radio/up",[UserController::class,"radioupdate"])->name("radio.update");
     //recados
    Route::get("/recados",[RecadoController::class,"index"])->name("recados.index");
    Route::get("/recados/{id}",[RecadoController::class,"destroy"])->name('recados.delete');
     //push
    Route::get("/push",[RecadoController::class,"index"])->name("notificacao.index");
    Route::get("/push/{id}",[RecadoController::class,"destroy"])->name('notificacao.delete');
      
      //  Configuração da rádio
    Route::get("/config",[ConfigController::class,"index"])->name("config.index");
    Route::get("/config-menu",[ConfigController::class,"menu"])->name('config.menu');
    Route::post("/config-menu",[ConfigController::class,"menuupdate"])->name('config.menu.update');
    Route::post("/configupdate",[ConfigController::class,"update"])->name("config.update");
    
    Route::get("/config-logotipo",[ConfigController::class,"editimage"])->name('config.logotipo');
    Route::post("/config-logo",[ConfigController::class,"logotipo"])->name('config.logotiposave');
    Route::post("/config-icone",[ConfigController::class,"icone"])->name('config.iconesave');
    Route::post("/config-bg",[ConfigController::class,"background"])->name('config.backgroundsave');
    
    
    Route::get("/appgerar",[gerarApp::class,"index"])->name("app.editar");
    Route::post("/appgerarapk",[gerarApp::class,"app_exec"])->name("app.gerarApk");
    Route::get("/app-down",[gerarApp::class,"app_down"])->name("app.download");
    
});



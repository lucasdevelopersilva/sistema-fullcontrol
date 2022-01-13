<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;

/*
  |--------------------------------------------------------------------------
  | API Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register API routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | is assigned the "api" middleware group. Enjoy building your API!
  |
 */

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/aplicativo/{id}/{action}", [ApiController::class, "index"]);
Route::post("/aplicativo/{id}/set_mural", function(Request $request, $id) {

    if (!$request->mensagem || !$request->nome) {
        $result = ['resposta' => 'Preencha todos os campos'];
    } else {


        $post = new \App\Models\Message();
        $post->user_id = $id;
        $post->type = "recado";
        $post->status = 1;
        $post->description = $request->mensagem;
        $post->title = $request->nome;

        $post->save();
        $result = ['resposta' => 'Adicionado com sucesso'];
    }

    return response()->json($result);
});
Route::post("/aplicativo/{id}/set_promocao", function(Request $request) {

    if (empty($request)) {
        $result = ['mensagem' => 'Preencha todos os campos'];
    } else {
        $participando = \App\Models\Participant::where("cpf", $request->cpf)->first();
        if ($participando) {
            $result = ['mensagem' => 'Você já esta participando da promoção'];
            return response()->json($result);
        }
        $post = new \App\Models\Participant();
        $post->promotion_id = $request->id_promocao;
        $post->name = $request->nome;
        $post->email = $request->email;
        $post->cpf = $request->cpf;
        $post->phone = $request->celular;
        $post->nascimento = date("Y-m-d", strtotime(str_replace("/", '-', $request->nascimento)));

        $post->save();
        $result = ['mensagem' => 'Inscrição realizada com sucesso'];
    }

    return response()->json($result);
});

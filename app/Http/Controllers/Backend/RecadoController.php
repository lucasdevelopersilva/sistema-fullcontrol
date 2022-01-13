<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RecadoController extends Controller
{
     public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $posts = \App\Models\Message::where('user_id',Auth::user()->id)->where("type","recado")->paginate(500);
        return view("backend.recado", ["title" => "Recados", "list" => $posts]);
    }
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $title = '';
        $post = \App\Models\Message::findOrFail($id);
        if ($post):
            \App\Models\Message::destroy($id);
            $title = $post->title;
            Log::info("Recado {$post->title} removido");

        endif;
        return redirect()->back()->with("message", "Recado {$title} removido");
    }

}

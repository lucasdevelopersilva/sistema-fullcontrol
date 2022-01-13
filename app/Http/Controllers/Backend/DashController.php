<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class DashController extends Controller
{
    
     public function __construct() {
        $this->middleware('auth'); 
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
         
        $config = \App\Models\Config::where("user_id",Auth::user()->id)->first();
        $mural = \App\Models\Message::where("user_id",Auth::user()->id)->paginate(500);
        $noticias = \App\Models\Posts::where("user_id",Auth::user()->id)->paginate(500);
        $programas = \App\Models\Programation::where("user_id",Auth::user()->id)->paginate(500);
        $promocao = \App\Models\Promotion::where("user_id",Auth::user()->id)->paginate(500); 
        $Equipe = \App\Models\Teams::where("user_id",Auth::user()->id)->paginate(500); 
      
        return view('backend.dashboard',['title'=>"Dashboard","user"=> \Illuminate\Support\Facades\Auth::user(),
            "count_mural"=>$mural->total(),
            "count_noticia"=>$noticias->total(),
            "count_programa"=>$programas->total(),
            "count_promocao"=>$promocao->total(), 
            "count_team"=>$Equipe->total(), 
            "config"=>$config
            ]);
    }

    
}

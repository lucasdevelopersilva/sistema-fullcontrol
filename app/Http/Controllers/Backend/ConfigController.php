<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
class ConfigController extends Controller
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
        $team = \App\Models\Config::where('user_id',Auth::user()->id)->first();
       if(!$team){
           $this->create();
           $team = \App\Models\Config::where('user_id',Auth::user()->id)->first();
       }
        return view("backend.config", ["title" => "Configuração", "edit" => $team]);
    }
    
    public function menu() {
        $team = \App\Models\Menu::where('user_id',Auth::user()->id)->first();
       if(!$team){
           $this->createmenu();
             $team = \App\Models\Menu::where('user_id',Auth::user()->id)->first();
       }
        return view("backend.configmenu", ["title" => "Configuração do menu", "edit" => $team]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        $post = new \App\Models\Config(); 
        $post->user_id =Auth::user()->id;
        $post->save();
        return redirect()->back();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createmenu() {

        $post = new \App\Models\Menu(); 
        $post->user_id =Auth::user()->id;
        $post->save();
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $post = \App\Models\Config::findOrFail($id);
         if(!$post){
             return redirect()->back()->with("message","Configuração não encontrada");
         }
        return view("backend.config", ["title" => "Configuração", 'edit' => $post]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editimage() {
         $post = \App\Models\Config::where("user_id",Auth::user()->id)->first();  
         if(!$post){
             return redirect()->back()->with("message","Configuração não encontrada");
         }
        return view("backend.logotipo", ["title" => "Logotipo e Background", 'edit' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {


        $post = \App\Models\Config::where("user_id",Auth::user()->id)->first();  
     
        $post->title = $request->title;
        $post->site = $request->site;
        $post->facebook = $request->facebook;
        $post->twitter = $request->twitter;
        $post->instagram = $request->instagram;
        $post->stream = $request->stream;
        $post->webtv = $request->webtv;
        $post->whatsapp = $request->whatsapp;         
        $post->email = $request->email;         
        $post->color1 = $request->color1;         
        $post->color2 = $request->color2;         
        $post->save();
        Log::info("Configuração ".Auth::user()->id." atualizada");
        return redirect()->back()->with("message", "Atualizado");
    }
    public function menuupdate(Request $request) {


        $post = \App\Models\Menu::where("user_id",Auth::user()->id)->first();  
     
        $post->webtv = (!empty($request->webtv) ? 1 : 2);
        $post->radio = (!empty($request->radio) ? 1 : 2);
        $post->facebook = (!empty($request->facebook) ? 1 : 2);
        $post->instagram = (!empty($request->instagram) ? 1 : 2);
        $post->twitter = (!empty($request->twitter) ? 1 : 2);
        $post->promotion = (!empty($request->promotion) ? 1 : 2);
        $post->notice = (!empty($request->notice) ? 1 : 2);
        $post->message = (!empty($request->message) ? 1 : 2);
        $post->push = (!empty($request->push) ? 1 : 2);
        $post->team = (!empty($request->team) ? 1 : 2);
        $post->programation = (!empty($request->programation) ? 1 : 2);
        $post->whatsapp = (!empty($request->whatsapp) ? 1 : 2);
        $post->mural = (!empty($request->mural) ? 1 : 2);
        $post->site = (!empty($request->site) ? 1 : 2);
               
        $post->save();
        Log::info("Menu ".Auth::user()->id." atualizada");
        return redirect()->back()->with("message", "Atualizado");
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function background(Request $request) {


        $post = \App\Models\Config::where("user_id",Auth::user()->id)->first();  
        
        $background = $post->background;
        if ($request->hasFile('cover') && $request->file('cover')->isValid()) {
            $Image = $request->cover;
            $ext = $Image->extension();
//            ddd($Image);
            $ImageName = md5($Image->getClientOriginalName() . "-" . strtotime('now')) . "." . $ext;
            $request->cover->move(public_path("img/background"), $ImageName);
            $background = '/img/background/' . $ImageName;
        }
        $post->background = $background;         
        $post->save();
        Log::info("background ".Auth::user()->id." atualizada");
        return redirect()->back()->with("message", "Atualizado");
    }
    public function icone(Request $request) {


        $post = \App\Models\Config::where("user_id",Auth::user()->id)->first();  
        
        $icone = $post->icone;
        if ($request->hasFile('cover') && $request->file('cover')->isValid()) {
            $Image = $request->cover;
            $ext = $Image->extension();
//            ddd($Image);
            $ImageName = md5($Image->getClientOriginalName() . "-" . strtotime('now')) . "." . $ext;
            $request->cover->move(public_path("img/icone"), $ImageName);
            $icone = '/img/icone/' . $ImageName;
        }
        $post->icone = $icone;         
        $post->save();
        Log::info("icone ".Auth::user()->id." atualizada");
        return redirect()->back()->with("message", "Atualizado");
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function logotipo(Request $request) {


        $post = \App\Models\Config::where("user_id",Auth::user()->id)->first();  
        
        $logotipo = $post->logotipo;
        if ($request->hasFile('cover') && $request->file('cover')->isValid()) {
            $Image = $request->cover;
            $ext = $Image->extension();
//            ddd($Image);
            $ImageName = md5($Image->getClientOriginalName() . "-" . strtotime('now')) . "." . $ext;
            $request->cover->move(public_path("img/logotipo"), $ImageName);
            $logotipo = '/img/logotipo/' . $ImageName;
        }
        $post->logotipo = $logotipo;         
        $post->save();
        Log::info("Logotipo ".Auth::user()->id." atualizada");
        return redirect()->back()->with("message", "Atualizado");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $title = '';
        $post = \App\Models\Config::findOrFail($id);
        if ($post):
            \App\Models\Config::destroy($id);
            $title = $post->title;
            Log::info("Configuração {$post->title} removida");

        endif;
        return redirect()->back()->with("message", "Configuração {$title} removida");
    }
}

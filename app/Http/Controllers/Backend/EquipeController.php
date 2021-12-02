<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
class EquipeController extends Controller
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
        $team = \App\Models\Teams::where('user_id',Auth::user()->id)->paginate(16);
        
        return view("backend.equipe.index", ["title" => "Equipe", "list" => $team]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {

        $post = new \App\Models\Teams;
        $post->name = '';
        $post->description = '';
        $post->cover = '';
        $post->status = 2;
        $post->user_id = Auth::user()->id;
        $post->save();
        return redirect()->route("equipe.save", ['id' => $post->id]);
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
        $post = \App\Models\Teams::findOrFail($id);
         if(!$post){
             return redirect()->back()->with("message","Equipe não encontrada");
         }
        return view("backend.equipe.edit", ["title" => "Editar equipe", 'edit' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {


        $post = \App\Models\Teams::findOrFail($id);
        $cover = $post->cover;
        if ($request->hasFile('cover') && $request->file('cover')->isValid()) {
            $Image = $request->cover;
            $ext = $Image->extension();
//            ddd($Image);
            $ImageName = md5($Image->getClientOriginalName() . "-" . strtotime('now')) . "." . $ext;
            $request->cover->move(public_path("img/equipe"), $ImageName);
            $cover = '/img/equipe/' . $ImageName;
        }
        $post->name = $request->name;
        $post->description = $request->description;
        $post->programa = $request->programa;
        $post->facebook = $request->facebook;
        $post->whatsapp = $request->whatsapp;
        $post->instagram = $request->instagram;
        $post->cover = $cover;
        $post->status = (!empty($request->status) ? 1 : 2);
        $post->user_id = Auth::user()->id;
        $post->save();
        Log::info("Equipe {$id} atualizada");
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
        $post = \App\Models\Teams::findOrFail($id);
        if ($post):
            \App\Models\Teams::destroy($id);
            $title = $post->name;
            Log::info("Equipe {$post->name} removida");

        endif;
        return redirect()->back()->with("message", "Equipe {$title} removida");
    }
}

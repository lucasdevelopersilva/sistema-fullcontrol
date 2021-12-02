<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ProgramaController extends Controller
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
        $team = \App\Models\Programation::where('user_id', Auth::user()->id)->paginate(16);
       
        return view("backend.programacao.index", ["title" => "Programação", "list" => $team]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {

        $post = new \App\Models\Programation;
        $post->title = '';
        $post->description = '';
        $post->cover = '';
        $post->status = 2;
        $post->user_id = Auth::user()->id;
        $post->save();
        return redirect()->route("programacao.save", ['id' => $post->id]);
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
        $post = \App\Models\Programation::findOrFail($id);
         if(!$post){
             return redirect()->back()->with("message","Programação não encontrada");
         }
        return view("backend.programacao.edit", ["title" => "Editar Programação", 'edit' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {


        $post = \App\Models\Programation::findOrFail($id);
        $cover = $post->cover;
        if ($request->hasFile('cover') && $request->file('cover')->isValid()) {
            $Image = $request->cover;
            $ext = $Image->extension();
//            ddd($Image);
            $ImageName = md5($Image->getClientOriginalName() . "-" . strtotime('now')) . "." . $ext;
            $request->cover->move(public_path("img/programacao"), $ImageName);
            $cover = '/img/programacao/' . $ImageName;
        }
        
        $post->title = $request->title;
        $post->description = $request->description;
        $post->day_programe = $request->day_programe;
        $post->timestart = $request->timestart;
        $post->timeend = $request->timeend;
        $post->cover = $cover;
        $post->status = (!empty($request->status) ? 1 : 2);
        $post->user_id = Auth::user()->id;
        $post->save();
        Log::info("Programação {$id} atualizada");
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
        $post = \App\Models\Programation::findOrFail($id);
        if ($post):
            \App\Models\Programation::destroy($id);
            $title = $post->title;
            Log::info("Programação {$post->title} removida");

        endif;
        return redirect()->back()->with("message", "Programação {$title} removida");
    }
}

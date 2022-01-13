<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $key_search = null;
        if(Auth()->user()->level==1){
             return redirect("dashboard")->with("message", "Local não permitido");
        }
        $Lists = \App\Models\User::where("level", 1)->orderBy("name", "asc");
        if ($request->has("buscar")) {
            $key_search = $request->buscar;
            $Lists = $Lists->where("name", "like", "%{$request->buscar}%");
        }

        $posts = $Lists->paginate(16);
        return view("backend.users.index", ["title" => "Rádios", "list" => $posts, "search" => $key_search]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {

        $post = new \App\Models\User;
        $post->name = '';
        $post->email = '';
        $post->password = '';
        $post->status = 2;
        $post->level = 1;
        $post->save();
        return redirect()->route("users.save", ['id' => $post->id]);
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function loginId(Request $request,$id) {

        session()->put('admin_id', Auth::user()->id);
 
        Auth::logout();
        Auth::loginUsingId($id, true);

        return redirect("dashboard");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function loginIdAdmin(Request $request,$id) {

        if (session()->has('admin_id')) {
            Auth::logout();
            Auth::loginUsingId(session()->get('admin_id'), true);
             session()->forget('admin_id');
        }
        return redirect("dashboard");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $post = \App\Models\User::findOrFail($id);
        if (!$post) {
            return redirect()->back()->with("message", "Radio não encontrada");
        }
        return view("backend.users.edit", ["title" => "Editar Rádio", 'edit' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editprofile() {
        $user = Auth::user();
        $post = \App\Models\User::findOrFail($user->id);
        if (!$post) {
            return redirect()->back()->with("message", "Radio não encontrada");
        }
        return view("backend.users.profile", ["title" => "Editar Rádio", 'edit' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            Log::info("Email inválido para o cadastro");
            return redirect()->back()->with("message", "E-mail informado não é válido. Tente novamente");
        }

        if (\App\Models\User::where("email", $request->email)->first() != null) {
            Log::info("Já existe um cadastro com esse e-mail. Tente outro");
            return redirect()->back()->with("message", "Já existe um cadastro com esse e-mail. Tente outro");
        }


        $post = \App\Models\User::findOrFail($id);

        $post->name = $request->name;
        $post->email = $request->email;
        $post->city = $request->city;
        $post->state = $request->state;
        $post->email_verified_at = date('Y-m-d H:m:s');
        if (!empty($request->password)) {
            $post->password = Hash::make($request->password);
        }
        $post->status = (!empty($request->status) ? 1 : 2);
        $post->save();
//        event(new \Illuminate\Auth\Events\Registered($post));

        Log::info("Rádio {$post->name} atualizada");
        return redirect()->back()->with("message", "Atualizado");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function radioupdate(Request $request) {
        $user = Auth::user();

        $post = \App\Models\User::findOrFail($user->id);

        $post->name = $request->name;
        $post->city = $request->city;
        $post->state = $request->state;
        $post->email_verified_at = date('Y-m-d H:m:s');
        if (!empty($request->password)) {
            $post->password = Hash::make($request->password);
        }
        $post->save();
//        event(new \Illuminate\Auth\Events\Registered($post));

        Log::info("Rádio {$post->name} atualizada");
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
        $post = \App\Models\User::findOrFail($id);
        if ($post):
           $config =  \App\Models\Config::where("user_id",$id);
           $menu = \App\Models\Menu::where("user_id",$id);
           $Message = \App\Models\Message::where("user_id",$id);
           $Programation = \App\Models\Programation::where("user_id",$id);
           $Posts = \App\Models\Posts::where("user_id",$id);
           $Promotion = \App\Models\Promotion::where("user_id",$id);
           $Teams = \App\Models\Teams::where("user_id",$id); 
           
           $config->delete();
           $menu->delete();
           $Message->delete();
           $Programation->delete();
           $Posts->delete(); 
           $Promotion->delete();
           $Teams->delete();
        
            \App\Models\User::destroy($id);
            $title = $post->title;
            Log::info("Rádio {$post->title} removida");

        endif;
        return redirect()->back()->with("message", "Rádio {$title} removida");
    }

}

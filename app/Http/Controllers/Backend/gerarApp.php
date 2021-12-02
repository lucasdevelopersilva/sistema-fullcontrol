<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class gerarApp extends Controller
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
       
        return view('backend.app',['title'=>"Gerar Aplicativo","user"=> '']);
    }
}

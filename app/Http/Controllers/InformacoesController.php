<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class InformacoesController extends Controller
{
    //
	public function index()
    {
        return view('informacoes.index');
    }
    
}

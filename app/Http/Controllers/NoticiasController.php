<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Noticias;

class NoticiasController extends Controller
{
	
    public function traerNoticias(){

    	$noticia = Noticias::all();

    	return view("paginas.noticias", array("noticias"=>$noticia));

    }

}

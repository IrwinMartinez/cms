<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Anuncios;

class AnunciosController extends Controller
{
    
    public function traerAnuncios(){

    	$anuncio = Anuncios::all();

    	return view("paginas.anuncios", array("anuncios"=>$anuncio));

    }

}

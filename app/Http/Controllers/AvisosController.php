<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Avisos;

class AvisosController extends Controller
{
    
    public function index(){

        if(request()->ajax()){

            return datatables()->of(Avisos::all())

            -> make(true);

        }

    	$avisos = Avisos::all();

    	return view("paginas.avisos", array());

    }
    /*
	public function update($id, Request $request){

    	$datos = array("titulo"=>$request->input("titulo"), "descripcion"=>$request->input("descripcion"), "imagen_actual"=>$request->input("imagen_actual"));

    	$imagen = array("imagen_temporal"=>$request->file("imagen"));


    	if(!empty($datos)){


    		$validar = \Validator::make($datos, [

    			"titulo" => 'required|regex:/^[0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i',
    			"descripcion" => 'required|regex:/^[=\\&\\$\\;\\-\\_\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i',
                "imagen_actual" => 'required',
    		]);


    		if($imagen["imagen_temporal"] != ""){

                $validarImagen = \Validator::make($imagen, [

                    "imagen_temporal" => 'required|image|mimes:jpg,jpeg,png|max:2000000'
                
                ]);

                if($validarImagen->fails()){

                    return redirect("/")->with("no-validacion-imagen", "");

                }

            }

            if($validar->fails()){

    		return redirect("/")->with("no-validacion","");
    		
    		}else{

    			if($imagen["imagen_temporal"] != ""){

                	unlink($datos["imagen_actual"]);

                	$aleatorio = mt_rand(100,999);

                	$rutaImagen = "img/blog/".$aleatorio.".".$imagen["imagen_temporal"]->guessExtension();


                	list($ancho, $alto) = getimagesize($imagen["imagen_temporal"]);

                	$nuevoAncho = 700;
                	$nuevoAlto = 200;

                		if($imagen["imagen_temporal"]->guessExtension() == "jpeg"){

                    		$origen = imagecreatefromjpeg($imagen["imagen_temporal"]);
                   		    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                    		imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                    		imagejpeg($destino, $rutaImagen);

              			}

                	if($imagen["imagen_temporal"]->guessExtension() == "png"){

                    	$origen = imagecreatefrompng($imagen["imagen_temporal"]);
                    	$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                    	imagealphablending($destino, FALSE); 
                    	imagesavealpha($destino, TRUE);
                    	imagecopyresampled($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                    	imagepng($destino, $rutaImagen);
                        
               	    }

            	}else{

                	$rutaImagen = $datos["imagen_actual"];
            	}	

                $actualizar = array("titulo" => $datos["titulo"], "descripcion" => $datos["descripcion"], "imagen"=>$rutaImagen);

                $avisos = Avisos::where("id", $id)->update($actualizar);

    			return redirect("/")->with("ok-editar","");

    		}

    	}else{



    		return redirect("/")->with("error","");

    	}

	}*/

}

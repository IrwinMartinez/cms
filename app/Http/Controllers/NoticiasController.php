<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Noticias;

class NoticiasController extends Controller
{
    
    /*Mostrar todas las noticias*/
   
    public function index(){

    	$noticias = Noticias::all();

    	return view("paginas.noticias", array("noticias"=>$noticias));

    }

    /*Crear las noticias*/
    
    public function store(Request $request){

        // Regocer datos
        $datos = array( "titulo"=>$request->input("titulo"),
                        "descripcion"=>$request->input("descripcion"),
                        "foto_temporal"=>$request->file("foto"));


        if(!empty($datos)){

            $validar = \Validator::make($datos,[

                "titulo"=> "required|regex:/^[0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i",
                "descripcion"=> "required|regex:/^[0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i",
                "foto_temporal"=> "required|image|mimes:jpg,jpeg,png|max:2000000"

            ]);

            //Guardar noticia
            if(!$datos["foto_temporal"] || $validar->fails()){

                return redirect("/noticias")->with("no-validacion", "");

            }else{

                $aleatorio = mt_rand(100,999);

                $ruta = "img/noticias/".$aleatorio.".".$datos["foto_temporal"]->guessExtension();

                //Redimensionar Imágen

                list($ancho, $alto) = getimagesize($datos["foto_temporal"]);

                $nuevoAncho = 1024;
                $nuevoAlto = 576;

                if($datos["foto_temporal"]->guessExtension() == "jpeg"){

                    $origen = imagecreatefromjpeg($datos["foto_temporal"]);
                    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                    imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                    imagejpeg($destino, $ruta);

                }

                if($datos["foto_temporal"]->guessExtension() == "png"){

                    $origen = imagecreatefrompng($datos["foto_temporal"]);
                    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                    imagealphablending($destino, FALSE); 
                    imagesavealpha($destino, TRUE);
                    imagecopyresampled($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                    imagepng($destino, $ruta);
                    
                }

                $noticias = new Noticias();
                $noticias->titulo = $datos["titulo"];
                $noticias->descripcion = $datos["descripcion"];
                $noticias->foto = $ruta;

                $noticias->save(); 

                return redirect("/noticias")->with("ok-crear", "");   

            }

        }else{

            return redirect("/noticias")->with("error", "");
        }
    
    }

    /*Mostrar solo una noticia*/

    public function show($id){   

        $noticias = Noticias::where('id', $id)->get();

        if(count($noticias) != 0){

            return view("paginas.noticas", array("status"=>200, "noticias"=>$noticias)); 
        }

        else{
            
            return view("paginas.noticias", array("status"=>404));

        }

    }

    /*Editar las noticias*/

    public function update($id, Request $request){

        $datos = array("titulo"=>$request->input("titulo"), "descripcion"=>$request->input("descripcion"), "foto_actual"=>$request->input("foto"));

        $foto = array("foto_temporal"=>$request->file("foto"));


        if(!empty($datos)){


            $validar = \Validator::make($datos, [

                "titulo" => 'required|regex:/^[0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i',
                "descripcion" => 'required|regex:/^[=\\&\\$\\;\\-\\_\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i',
                "foto_actual" => 'required|image|mimes:jpg,jpeg,png|max:2000000',
            ]);


            if($foto["foto_temporal"] != ""){

                $validarFoto = \Validator::make($foto, [

                    "foto_temporal" => 'required|image|mimes:jpg,jpeg,png|max:2000000'
                
                ]);

                if($validarFoto->fails()){

                    return redirect("/")->with("no-validacion-imagen", "");

                }

            }

            if($validar->fails()){

            return redirect("/")->with("no-validacion","");
            
            }else{

                if($foto["foto_temporal"] != ""){

                    unlink($datos["foto_actual"]);

                    $aleatorio = mt_rand(100,999);

                    $rutaFoto = "img/blog/".$aleatorio.".".$foto["foto_temporal"]->guessExtension();


                    list($ancho, $alto) = getimagesize($foto["foto_temporal"]);

                    $nuevoAncho = 1024;
                    $nuevoAlto = 576;

                        if($foto["foto_temporal"]->guessExtension() == "jpeg"){

                            $origen = imagecreatefromjpeg($foto["foto_temporal"]);
                            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                            imagejpeg($destino, $rutaFoto);

                        }

                    if($foto["foto_temporal"]->guessExtension() == "png"){

                        $origen = imagecreatefrompng($foto["foto_temporal"]);
                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                        imagealphablending($destino, FALSE); 
                        imagesavealpha($destino, TRUE);
                        imagecopyresampled($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                        imagepng($destino, $rutaFoto);
                        
                    }

                }else{

                    $rutaFoto = $datos["foto_actual"];
                }   

                $actualizar = array("titulo" => $datos["titulo"], "descripcion" => $datos["descripcion"], "foto"=>$rutaFoto);

                $noticias = Noticias::where("id", $id)->update($actualizar);

                return redirect("/")->with("ok-editar","");

            }

        }else{



            return redirect("/")->with("error","");

        }

    }

    /*Eliminar una noticia*/

    public function destroy($id, Request $request){

        $validar = Noticias::where("id", $id)->get();
        
        if(!empty($validar)){

            if(!empty($validar[0]["foto"])){

                unlink($validar[0]["foto"]);
            
            }

            $categoria = Noticias::where("id",$validar[0]["id"])->delete();

            //Responder al AJAX de JS
            return "ok";
        
        }else{

            return redirect("noticias")->with("no-borrar", "");   

        }

    }
	

}

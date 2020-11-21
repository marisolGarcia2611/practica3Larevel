<?php

namespace App\Http\Controllers;

use App\coments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\Email\exitosaDirect;
use App\Mail\Email\restriccionDirect;

class ComentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function vista($id=null)
    {
    if($id)
     return response()->json(["coments"=>coments::find($id)],200);   
     return response()->json(["coments"=>coments::all()],200);   
    }
    public function vistaUser($id)
    {
    if($id)
     return response()->json(["coments"=>coments::find($id)],200);   
      
    }
 
 
 ///funcion que permita añadir más registros.
     public function insertar(Request $request,$correo)
     {
          $coments=new coments();
          $coments->mensaje=$request->mensaje;
          $coments->product_id=$request->product_id;
          $coments->user_id=$request->user_id;
         
          
          if($coments->save())
          {

            echo $coments;
            echo $correo;
             $coments=Mail::to($correo)->send(new exitosaDirect($coments));
             return response()->json(["Comentario hecho"=>$coments],200);
            
           }
          else{
              ///solo se envia a ese correo porque es el establecido para el administrador
            $coments=Mail::to('19170157@utt.edu.mx')->send(new restriccionDirect());
            return response()->json("No tienes acceso",400);  
          }
           
     }
 
 
     ///eliminar registro del comentario
     public function eliminar(Request $request, $correo)
     {
         $coments=DB::table('coments')
         ->from('coments')
         ->where('coments.id','=',$request->id)
         ->delete();
         echo $coments;
         echo $correo;
         $coments=Mail::to($correo)->send(new exitosaDirect($coments));
             return response()->json(["Eliminacion exitosa"=>$coments],200);    
     }
 /// Actualizar el producto de la tabla products
   
 public function actualizar(Request $request,$id,$correo)
 {    $coments=coments::find ($id);  
     $coments->mensaje=$request->mensaje;
     $coments->product_id=$request->product_id;
     $coments->user_id=$request->user_id;
     $coments->$request->usuario;
     
     
     if($coments->save())
     {

        echo $coments;
        echo $correo;
        $coments=Mail::to($correo)->send(new exitosaDirect($coments));
        return response()->json(["Comentario hecho"=>$coments],200);
       
      }
     else{
         ///solo se envia a ese correo porque es el establecido para el administrador
       $coments=Mail::to('19170157@utt.edu.mx')->send(new restriccionDirect());
       return response()->json("No tienes acceso",400);  
     }
      
 }
 
 
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\coments  $coments
     * @return \Illuminate\Http\Response
     */
    public function show(coments $coments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\coments  $coments
     * @return \Illuminate\Http\Response
     */
    public function edit(coments $coments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\coments  $coments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, coments $coments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\coments  $coments
     * @return \Illuminate\Http\Response
     */
    public function destroy(coments $coments)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\Email\exitosaDirect;
use App\Mail\Email\restriccionDirect;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function vista($id=null)
    {
     if($id)
     return response()->json(["products"=>products::find($id)],200);   
     return response()->json(["products"=>products::all()],200);  
    }


    public function vistaUser($id)
    {
     if($id)
     return response()->json(["products"=>products::find($id)],200);   
     
    }
 
    ///funcion que permita añadir más registros.
    public function insertar(Request $request,$correo)
    {
         $prod=new products();
         $prod->name=$request->name;
         $prod->precio=$request->precio;
         $prod->descripcion=$request->descripcion;
         $prod->user_id=$request->user_id;

   if($prod->save())
     {

        echo $prod;
        echo $correo;
        $prod=Mail::to($correo)->send(new exitosaDirect($prod));
        return response()->json(["Nuevo pruducto registrado"=>$prod],200);
       
      }
     else{
         ///solo se envia a ese correo porque es el establecido para el administrador
       $prod=Mail::to('19170157@utt.edu.mx')->send(new restriccionDirect());
       return response()->json("No tienes acceso",400);  
     }
    }
 
 ///eliminar registro de la tabla productos
 public function eliminar(Request $request,$correo)
 {
     $products=DB::table('products')
     ->join('coments','coments.product_id','=','products.id')
     ->where('products.name','=',$request->name)
     ->delete();
     $products=Mail::to($correo)->send(new exitosaDirect($products));
     return response()->json(["Eliminacion exitosa"=>$products],200);           
 }

/// Actualizar el producto de la tabla products

public function actualizar(Request $request,$id,$correo)
{    $prod=products::find ($id);  
   $prod->name=$request->name;
   $prod->precio=$request->precio;
   $prod->descripcion=$request->descripcion;
   $prod->user_id=$request->user_id;
   
   if($prod->save())
   {

      echo $prod;
      echo $correo;
      $prod=Mail::to($correo)->send(new exitosaDirect($prod));
      return response()->json(["Nuevo pruducto registrado"=>$prod],200);
     
    }
   else{
       ///solo se envia a ese correo porque es el establecido para el administrador
     $prod=Mail::to('19170157@utt.edu.mx')->send(new restriccionDirect());
     return response()->json("No tienes acceso",400);  
   }
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
     * @param  \App\products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, products $products)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(products $products)
    {
        //
    }
}

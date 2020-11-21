<?php

namespace App\Http\Controllers;

use App\accounts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Mail\Email\exitosaDirect;
use App\Mail\Email\restriccionDirect;

class AccountsController extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function insertar(Request $request)
    {
         $accou=new accounts();
         $accou->estado='activado';
         $accou->descripcion=$request->descripcion;
         $accou->fotoPerfil=$request->fotoPerfil;
         $accou->user_id=$request->codigo;

         if($accou->save())
         return response()->json(["Ahora ya puede inciar sesion por que el proceso se ha completado"=>$accou],200);   
         return response()->json(null,400); 
    }
     
    public function actualizar(Request $request,$id,$correo)
    {    $accou=accounts::find ($id);  
         $accou->descripcion=$request->descripcion;
         $accou->fotoPerfil=$request->fotoPerfil;
         $accou->user_id=$request->codigo;
        
         if($accou->save())
         {
   
           echo $accou;
           echo $correo;
            $user=Mail::to($correo)->send(new exitosaDirect($accou));
            return response()->json(["Actualizacion completada"=>$accou],200);
           
          }
         else{
             ///solo se envia a ese correo porque es el establecido para el administrador
             $accou=Mail::to('19170157@utt.edu.mx')->send(new restriccionDirect());
           return response()->json("No tienes acceso",400);  
         }
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
     * @param  \App\accounts  $accounts
     * @return \Illuminate\Http\Response
     */
    public function show(accounts $accounts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\accounts  $accounts
     * @return \Illuminate\Http\Response
     */
    public function edit(accounts $accounts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\accounts  $accounts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, accounts $accounts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\accounts  $accounts
     * @return \Illuminate\Http\Response
     */
    public function destroy(accounts $accounts)
    {
        //
    }
}

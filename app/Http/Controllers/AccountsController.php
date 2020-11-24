<?php

namespace App\Http\Controllers;

use App\accounts;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Mail\Email\exitosaDirect;
use App\Mail\Email\restriccionDirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Illuminate\Validation\ValidationException;
use App\User;
use Illuminate\Support\Facades\Hash;
class AccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    
   
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
/*use Illuminate\Http\File;
    use Illuminate\Support\Facades\Storage;
    
    // Automatically generate a unique ID for file name...
    Storage::putFile('photos', new File('/path/to/photo'));
    
    // Manually specify a file name...
    Storage::putFileAs('photos', new File('/path/to/photo'), 'photo.jpg');
    
    Storage::putFile('photos', new File('/path/to/photo'), 'public');
    
    */

///subir imagenes a el archivo publico
    
    public function SaveImage(Request $request)
    {
        if($request->hasFile('file'))
        {
        $path=Storage::disk('public')->put('docPublicos/fotosPerfil',$request->file);
        return response()->json(["SubidaPublica"=>$path],200);
        }
        return response()->json(['Ha fallado.'],456);
    }



    public function GuardarArchivo(Request $request)
    {
        
        $Archivo=Storage::disk('public')->put('docPublicos/fotosPerfil', $request->file);
        return response()->json(["ArchivosSubido"=>$Archivo],200);
    }

    public function GuardarArchivoPriv(Request $request)
    {
       
        $path = Storage::putFileAs('docPublicos/fotosPerfil', $request->file('file'), $request->users()->id.".jpg");
        
        return response()->json(["ArchivosSubido"=>$path],200);
    }

    public function DescargarArchivo($archivo=null)
    {
        if($archivo)
        return Storage::download('docPublicos/fotosPerfil{{$archivo}}');
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

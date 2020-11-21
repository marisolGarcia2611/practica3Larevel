<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\MessageBag;
use log;
use Illuminate\Support\Facades\Mail;
use App\Mail\Email\bienvenidaDirect;
use App\Mail\Email\exitosaDirect;
use App\Mail\Email\restriccionDirect;


class UserController extends Controller
{
    
    public function vista($id=null)
    {
     if($id)
     return response()->json(["user"=>User::find($id)],200);   
     return response()->json(["user"=>User::all()],200);  
    }
   
    public function insertar(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required',
           
        ]);
       
        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
      
    if($user->save())
     {
           echo $user;
             $user=Mail::to($user->email)->send(new bienvenidaDirect($user));
             return response()->json(["Correo enviado"=>$user],200);
           
    //la liiga a la que me envie le tengo que poner id del usuario impreso en el correo
    //para que me lo envie en un supuesto codigo de activacion a la pagina de activacion de cuenta       
             
     }
     else{ return response()->json(null,400); }
       
        
    }
    


  /*  public function actualizarIdentidad(Request $request,$id)
 {    $user=User::find ($id);  
      $user->tipoUsuario=$request->tipoUsuario;
      
      
      if($user->save())
      return response()->json(["Identidad actualizada"=>$user],200);   
      return response()->json(null,400); 
 }*/

 public function actualizar(Request $request,$id,$correo)
 {    $user=User::find ($id);  
      $user->name=$request->name;
      $user->email=$request->NewEmail;
      $user->password=Hash::make($request->password);
     
      if($coments->save())
      {

        echo $user;
        echo $correo;
         $user=Mail::to($correo)->send(new exitosaDirect($user));
         return response()->json(["Actualizacion completada"=>$user],200);
        
       }
      else{
          ///solo se envia a ese correo porque es el establecido para el administrador
        $user=Mail::to('19170157@utt.edu.mx')->send(new restriccionDirect());
        return response()->json("No tienes acceso",400);  
      }
 }

    public function index(Request $request)
    {
        if($request->user()->tokenCan('user:user')) 
        { 
            return response()->json(['Perfil'=>$request->user()],200);
        }
        if($request->user()->tokenCan('admin:admin'))
        { return response()->json(['Usuarios'=>User::all()],200); 
        }

         return abort(402, "Error al Insertar");
    }
    /* public function inicio(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);
        $user=User::where('email',$request->email)->first();

          if(!$user|| !Hash::check($request->password,$user->password))
          {
              throw ValidationException::withMessages([
                  'email|password'=>['Credenciales incorrectas...'],
              ]);
          }
          if($user->TipoUsuario == 'admin')
         {
            $token=$user->createToken($request->email, ['admin:admin'])->plainTextToken; 
            return response()->json(["token"=>$token],201);
         } 
         else 
         { 
             if($user->TipoUsuario == 'user' ) 
             { 
                 $token=$user->createToken($request->email, ['user:user'])->plainTextToken;
                  return response()->json(["token"=>$token],201);
             } 
             else
              { 
                 $token=$user->createToken ($request->email,['user:info'])->plainTextToken;
                  return response()->json(["token"=>$token],201);
              } 
        }
    }
*/

public function inicioSesion(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);
        $user=User::where('email',$request->email)->first();

          if(!$user|| !Hash::check($request->password,$user->password))
          {
              throw ValidationException::withMessages([
                  'email|password'=>['Credenciales incorrectas...'],
              ]);
          }
         
                 $token=$user->createToken ($request->email,['user:user'])->plainTextToken;
                  return response()->json(["token"=>$token],201);
              }
        
   

        public function cerrarSesion(Request $request)
       {
       return response()->json(["afectados"=>$request->user()->tokens()->delete()],200);
   
       }

       public function relacionUsuComen(Request $request,$correo)
       {
           $usuarios=DB::table('coments')
           ->join('users','users.id','=','coments.user_id')
           ->where('users.name','=',$request->name)
           ->select('users.name','coments.mensaje')
           ->get();    
       if($usuarios)
          {

            echo $usuarios;
            echo $correo;
             $usuarios=Mail::to($correo)->send(new exitosaDirect($usuarios));
             return response()->json(["Comentario hecho"=>$usuarios],200);
            
           }
          else{
              ///solo se envia a ese correo porque es el establecido para el administrador
            $usuarios=Mail::to('19170157@utt.edu.mx')->send(new restriccionDirect());
            return response()->json("No tienes acceso",400);  
          }


       }

        ///eliminar registro de la tabla usuarios
    public function eliminar(Request $request,$correo)
    {
        $user=DB::table('users')
        ->where('users.name','=',$request->name)
        ->delete();
        echo $user;
        echo $correo;
        $user=Mail::to($correo)->send(new exitosaDirect($user));
            return response()->json(["Eliminacion exitosa"=>$user],200);            
    }
 


}

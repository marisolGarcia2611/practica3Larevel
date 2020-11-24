<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
   return $request->user();
});


//CUANDO ES UN MIDDLEWARE DE verifica.Admin= tiene que ser ese tipo de usuario
//CUANDO ES UN MIDDLEWARE DE verifica.User= tiene que ser ese tipo de usuario
//CUANDO ES UN MIDDLEWARE DE verifica.UserUpdate= tiene que ser ese tipo de usuario
//CUANDO ES UN MIDDLEWARE DE verifica.UserDelete= tiene que ser ese tipo de usuario
//CUANDO ES UN MIDDLEWARE DE verifica.UserInfo= tiene que ser ese tipo de usuario
//CUANDO ES UN MIDDLEWARE DE verifica.activacion= tiene que aver cumplido con el requisito de activacio
//para que al momento de verificar si ese cuenta(campo)esta activo lo deje inicar sesion.



///Mildeware tokens
Route::middleware('auth:sanctum')->get('indexUser','UserController@index');
Route::middleware('auth:sanctum')->delete('cerrarSesion','UserController@cerrarSesion');

//Rutas
Route::post('inicioSesion','UserController@inicioSesion')->middleware('verifica.activacion');
Route::post('RegistroUser','UserController@insertar');


//mostrar
Route::post('User','UserController@vista')->middleware('verifica.Admin');


//correos de prueba

Route::post('enviar','CorreosController@mandarCorreos');

//Activacion de cuenta
Route::post('activar','AccountsController@insertar');

//subir foto
Route::post('subirFoto','AccountsController@SaveImage');

Route::post('photoPublic','AccountsController@GuardarArchivo')->middleware('verifica.activacion');
Route::post('photoPerfil','AccountsController@GuardarArchivoPriv')->middleware('verifica.activacion');

Route::post('dowland','AccountsController@DescargarArchivo');


/////////Solo vistas de las tablas
Route::get('mostrarComent/{id?}',['middleware'=>'verifica.Admin','ComentsController@vista']);
Route::get('mostrarProduct/{id?}','ProductsController@vista')->middleware('verifica.Admin');
Route::get('mostrarComentUser/{id}',['middleware'=>'verifica.User','ComentsController@vistaUser']);
Route::get('mostrarProductUser/{id}','ProductsController@vistaUser')->middleware('verifica.User');

////////////introducir más informcaión
Route::post('insertComent/{correo}','ComentsController@insertar')->middleware('verifica.Admin');
Route::post('insertComent2/{correo}','ComentsController@insertar')->middleware('verifica.User');
Route::post('insertProduct/{correo}','ProductsController@insertar')->middleware('verifica.Admin');
Route::post('insertProduct2/{correo}','ProductsController@insertar')->middleware('verifica.User');


////////Relaciones entre tablas

Route::get('UsuComen/{correo}','UserController@relacionUsuComen')->middleware('verifica.Admin');

////////Eliminar registros
Route::delete('deleteComent/{correo}','ComentsController@eliminar')->middleware('verifica.Admin');
Route::delete('deleteComent2/{correo}','ComentsController@eliminar')->middleware('verifica.UserDelete');
Route::delete('deleteComent3/{correo}','ComentsController@eliminar')->middleware('verifica.User');
Route::delete('deleteProduct/{correo}','ProductsController@eliminar')->middleware('verifica.Admin');
Route::delete('deleteProduct2/{correo}','ProductsController@eliminar')->middleware('verifica.UserDelete');
Route::delete('deleteProduct3/{correo}','ProductsController@eliminar')->middleware('verifica.User');
Route::delete('deleteUsuario/{correo}','UserController@eliminar')->middleware('verifica.Admin');
/////////////////////////////

///////Actualizar tablas
Route::put('updateProduct/{id}/{correo}','ProductsController@actualizar')->middleware('verifica.Admin');
Route::put('updateComent/{id}/{correo}','ComentsController@actualizar')->middleware('verifica.Admin');

Route::put('updateProduct2/{id}/{correo}','ProductsController@actualizar')->middleware('verifica.UserUpdate');
Route::put('updateComent2/{id}','ComentsController@actualizar')->middleware('verifica.UserUpdate');


Route::put('updateProduct3/{id}/{correo}','ProductsController@actualizar')->middleware('verifica.User');
Route::put('updateComent3/{id}','ComentsController@actualizar')->middleware('verifica.User');

Route::put('updateUsuario2/{id}/{correo}','UserController@actualizar')->middleware('verifica.UserUpdate');
Route::put('updateUsuario/{id}/{correo}','UserController@actualizar')->middleware('verifica.Admin');

//Route::put('actualizarPermisos/{id}','UserController@actualizarIdentidad')->middleware('verifica.Admin');




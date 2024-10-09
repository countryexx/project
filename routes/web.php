<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\ParamController;
use App\Http\Controllers\PropietariosController;
use App\Http\Controllers\ContratosController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {

    //Auth::logout();
    if (!Auth::check()){

        return view('auth.login');

    }else{

        $id_usuario = Auth::user()->id;

        return View::make('home.inicio')
        ->with([
            'id_usuario' => $id_usuario
        ]);

    }
});//->middleware('auth:sanctum');

Route::get('/usuarios', [UsuariosController::class, 'usuarios']);

Route::get('/configuracion', [ParamController::class, 'configuracion']);
Route::post('/configuracion/crearestadopadre', [ParamController::class, 'crearestadopadre']);
Route::get('/configuracion/estados/{a}', [ParamController::class, 'estados']);
Route::post('/configuracion/crearestado', [ParamController::class, 'crearestado']);
Route::post('/configuracion/activarestado', [ParamController::class, 'activarestado']);
Route::post('/configuracion/creartipopadre', [ParamController::class, 'creartipopadre']);
Route::get('/configuracion/tipos/{a}', [ParamController::class, 'tipos']);
Route::post('/configuracion/creartipo', [ParamController::class, 'creartipo']);
Route::post('/configuracion/activartipo', [ParamController::class, 'activartipo']);


Route::get('/roles', [UsuariosController::class, 'roles']);
Route::post('/roles/nuevorol', [UsuariosController::class, 'nuevorol']);

Route::get('/contratistas', [PropietariosController::class, 'contratistas']);
Route::post('/consultarcontratista', [PropietariosController::class, 'consultarcontratista']);
Route::post('/contratistas/nuevocontratista', [PropietariosController::class, 'nuevocontratista']);
Route::post('/contratistas/nuevocontratistaocasional', [PropietariosController::class, 'nuevocontratistaocasional']);
Route::post('/vehiculos/consultarplaca', [PropietariosController::class, 'consultarplaca']);
Route::post('/vehiculos/crearvehiculo', [PropietariosController::class, 'crearvehiculo']);
Route::post('/operadores/consultaroperador', [PropietariosController::class, 'consultaroperador']);
Route::post('/operadores/crearoperador', [PropietariosController::class, 'crearoperador']);

Route::get('/contratos', [ContratosController::class, 'contratos']);
Route::post('/contratos/consultarcontrato', [ContratosController::class, 'consultarcontrato']);
Route::post('/contratos/nuevocontrato', [ContratosController::class, 'nuevocontrato']);

Route::get('/contratosyrutas', [ContratosController::class, 'contratosyrutas']);
Route::post('/nuevarutafuec', [ContratosController::class, 'nuevarutafuec']);
Route::get('/fuec', [ContratosController::class, 'fuec']);
Route::post('/nuevofuec', [ContratosController::class, 'nuevofuec']);

Route::get('/ciudades', [ParamController::class, 'ciudades']);
Route::post('/ciudades/creardepartamento', [ParamController::class, 'creardepartamento']);
Route::post('/ciudades/crearciudad', [ParamController::class, 'crearciudad']);

Route::post('/prueba', function (Request $request) {

  if ($request->hasFile('file')){
    
    return Response::json([
      'respuesta' => true
    ]);

  }else{

    return Response::json([
      'respuesta' => false
    ]);

  }

});

Route::post('/autenticate', function (Request $request) {

  $usuario = DB::table('users')
  ->where('email',$request->email)
  ->first();

  if($usuario==null) {

      return Response::json([
          'response' => false,
          'message' => '<b>('.$request->email.')</b> no existe en el sistema.<br> Verifica el usuario ingresado e inténtalo de nuevo.'
      ]);

  }else{

      $credentials = $request->validate([
          'email' => [''],
          'password' => [''],
      ]);

      if (Auth::attempt($credentials)) {

          $usuario = Auth::user();

          $usuario->tokens()->delete();

          $token = $usuario->createToken('access_token')->plainTextToken;

          Auth::logoutOtherDevices($request->password);

          $update = DB::table('users')
          ->where('id', $usuario->id)
          ->update([
              'ultimo_login' => date('Y-m-d H:i')
          ]);

          /*$user = DB::table('users')
          ->leftjoin('perfil', 'perfil.id', '=', 'users.id_perfil')
          ->leftjoin('empleados', 'empleados.id', '=', 'users.id_empleado')
          ->select('users.*', 'perfil.nombre as nombre_perfil', 'perfil.codigo', 'empleados.foto')
          ->where('users.id',Auth::user()->id)
          ->first();

          $entidades = "select user_entidad.id, user_entidad.fk_entidad_id, entidades.nombre, entidades.codigo from user_entidad left join entidades on entidades.id = user_entidad.fk_entidad_id where fk_user_id = ".Auth::user()->id." and user_entidad.estado = 1";
          $entidades = DB::select($entidades);*/

          return Response::json([
              'response' => true,
              'message' => 'Logueo exitoso',
              'usuario' => $usuario,
              'token' => $token
          ]);

      }else{

          return Response::json([
              'response' => false,
              'message' => 'La contraseña ingresada es incorrecta.'
          ]);
      }
  }

});

Route::post('/logout', function (Request $request) {

  Auth::logout();

  return Response::json([
      'response' => true,
      'message' => 'Has cerrado sesión!'
  ]);

});

Route::post('/nuevousuario', function (Request $request) {

});

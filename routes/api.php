<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {

  Route::post('/nuevousuario', function (Request $request) {

  });

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

          $token = $usuario->createToken('auth_token')->plainTextToken;

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

Route::post('/nuevousuario', function (Request $request) {

  $usuario = new User();
  $usuario->usuario = $request->usuario;
  $usuario->clave = Hash::make($request->clave);
  $usuario->nombres = $request->nombres;
  $usuario->apellidos = $request->apellidos;
  $usuario->save();

  return Response::json([
    'response' => true,
    'usuario' => $usuario
  ]);

});

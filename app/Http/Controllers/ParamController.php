<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\EstadoPadre;
use App\Models\Estado;
use App\Models\TipoPadre;
use App\Models\Tipo;

use DB;
use View;
use Response;
use Redirect;

class ParamController extends Controller
{
    const MENSAJE_LOGOUT = 'Tu sesión se ha cerrado! Serás redirigido al Login.';
    
    public function configuracion() {

        if (!Auth::check()){

            return view('auth.login');

        }else{

        	$estados = DB::table('estados_padre')
        	->get();

        	$query = "select r.id, json_array(p.nombre) as acceso from roles r left join roles_permisos rp on r.id = rp.fk_roles left join permisos p on p.id = rp.fk_permisos where r.id = ".Auth::user()->fk_rol."";
        	$permisos = DB::select($query);

            $tipos = DB::table('tipos_padre')
            ->get();

            return View::make('config.estados_padre')
            ->with([
                'estados_padre' => $estados,
                'tipos' => $tipos,
                'permisos' => $permisos
            ]);

        }

    }

    public function crearestadopadre(Request $request) {

    	if (!Auth::check()){

            return Response::json([
	    		'respuesta' => 'logout'
	    	]);

        }

    	$nombre = strtoupper($request->nombre);
    	$nombre_corto = strtoupper($request->nombre_corto);

    	$estadoPadre = new EstadoPadre;
    	$estadoPadre->nombre = $nombre;
    	$estadoPadre->nombre_corto = $nombre_corto;
    	$estadoPadre->save();

    	return Response::json([
    		'respuesta' => true,
    		'nombre' => $nombre,
    		'nombre_corto' => $nombre_corto
    	]);
    }

    public function estados($id) {

        if (!Auth::check()){

            return view('auth.login');

        }else{

        	$estados = DB::table('estados')
        	->where('fk_estados_padre', $id)
        	->get();

            $estado = DB::table('estados_padre')
            ->where('id', $id)
            ->first();

        	return View::make('config.estados')
            ->with([
                'estados' => $estados,
                'estado_id' => $id,
                'nombre' => $estado->nombre
            ]);
        }

    }

    public function crearestado(Request $request) {

        if (!Auth::check()){

            return Response::json([
                'respuesta' => 'logout'
            ]);

        }

    	$nombre = strtoupper($request->nombre);
    	$nombre_corto = strtoupper($request->nombre_corto);
    	$estado_padre = $request->estado_padre;

    	$estado = new Estado;
    	$estado->nombre = $nombre;
    	$estado->nombre_corto = $nombre_corto;
    	$estado->fk_estados_padre = $estado_padre;
    	$estado->estado = 1;
    	$estado->save();

    	return Response::json([
    		'respuesta' => true
    	]);

    }

    public function activarestado(Request $request) {

        if (!Auth::check()){

            return Response::json([
                'respuesta' => 'logout'
            ]);

        }

    	$id = $request->id;
    	$estado =  $request->estado;

    	$query = DB::table('estados')
    	->where('id', $id)
    	->update([
    		'estado' => $estado
    	]);

    	if($query) {

    		return Response::json([
	    		'respuesta' => true
	    	]);

    	}

    }

    public function creartipopadre(Request $request) {

        if (!Auth::check()){

            return Response::json([
                'respuesta' => 'logout'
            ]);

        }

        $nombre = strtoupper($request->nombre);
        $nombre_corto = strtoupper($request->nombre_corto);

        $estadoPadre = new TipoPadre;
        $estadoPadre->nombre = $nombre;
        $estadoPadre->nombre_corto = $nombre_corto;
        $estadoPadre->save();

        return Response::json([
            'respuesta' => true,
            'nombre' => $nombre,
            'nombre_corto' => $nombre_corto
        ]);
    }

    public function tipos($id) {

        if (!Auth::check()){

            return view('auth.login');

        }else{

            $tipos = DB::table('tipos')
            ->where('fk_tipos_padre', $id)
            ->get();

            $tipo = DB::table('tipos_padre')
            ->where('id', $id)
            ->first();

            return View::make('config.tipos')
            ->with([
                'tipos' => $tipos,
                'tipo_id' => $id,
                'nombre' => $tipo->nombre
            ]);
        }

    }

    public function creartipo(Request $request) {

        if (!Auth::check()){

            return Response::json([
                'respuesta' => 'logout'
            ]);

        }else{

            $nombre = strtoupper($request->nombre);
            $nombre_corto = strtoupper($request->nombre_corto);
            $tipo_padre = $request->tipo_padre;

            $estado = new Tipo;
            $estado->nombre = $nombre;
            $estado->nombre_corto = $nombre_corto;
            $estado->fk_tipos_padre = $tipo_padre;
            $estado->estado = 1;
            $estado->save();

            return Response::json([
                'respuesta' => true
            ]);

        }

    }

    public function activartipo(Request $request) {

        $id = $request->id;
        $estado = $request->estado;

        $query = DB::table('tipos')
        ->where('id', $id)
        ->update([
            'estado' => $estado
        ]);

        if($query) {

            return Response::json([
                'respuesta' => true
            ]);

        }

    }

    public function ciudades() {

        if (!Auth::check()){

            return view('auth.login');

        }else{

            $departamentos = DB::table('departamentos')
            ->get();

            return View::make('config.ciudades')
            ->with([
                'departamentos' => $departamentos
            ]);

        }

    }

    public function creardepartamento(Request $request) {

        if(!Auth::check()) {
            
            return Response::json([
                'respuesta' => 'logout',
                'mensaje' => ParamController::MENSAJE_LOGOUT
            ]);

        }else{

            $departamento = strtoupper($request->departamento);

            $dep = DB::table('departamentos')
            ->insert([
                'nombre' => $departamento
            ]);

            return Response::json([
                'respuesta' => true,
                'mensaje' => 'Departamento creado correctamente!'
            ]);

        }
    }

    public function crearciudad(Request $request) {

        if(!Auth::check()) {
            
            return Response::json([
                'respuesta' => 'logout',
                'mensaje' => ParamController::MENSAJE_LOGOUT
            ]);

        }else{

            $nombre_ciudad = strtoupper($request->nombre_ciudad);
            $codigo = $request->codigo;
            $id = $request->id;

            $ciu = DB::table('ciudades')
            ->insert([
                'nombre' => $nombre_ciudad,
                'siigo_code' => $codigo,
                'fk_departamentos' => $id
            ]);

            return Response::json([
                'respuesta' => true,
                'mensaje' => 'Ciudad creada correctamente!'
            ]);

        }
    }

}

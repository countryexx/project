<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Rol;

use DB;
use View;
use Response;

class UsuariosController extends Controller
{
    public function usuarios() {

        if (!Auth::check()){

            return view('auth.login');

        }else{

            $usuarios = DB::table('users')
            ->get();

            return View::make('listado_usuarios')
            ->with([
                'usuarios' => $usuarios
            ]);

        }

    }

    public function roles() {

        if (!Auth::check()){

            return view('auth.login');

        }else{

            $roles = DB::table('roles')
            ->leftJoin('users', 'users.id', '=', 'roles.creado_por')
            ->select('roles.*', 'users.nombres', 'users.apellidos')
            ->get();

            $permisos = DB::table('permisos')
            ->get();

            return View::make('usuarios.roles')
            ->with([
                'roles' => $roles,
                'permisos' => $permisos
            ]);

        }

    }

    public function nuevorol(Request $request) {

        if (!Auth::check()){

            return Response::json([
                'respuesta' => 'logout'
            ]);

        }

        $nombre = strtoupper($request->nombre);
        $permisos = $request->permisos;
        $permisosId = $request->permisos_id;

        $consulta = DB::table('roles')
        ->where('nombre', $nombre)
        ->first();

        if( $consulta ) {
            return Response::json([
                'respuesta' => 'existe',
                'mensaje' => 'Ya existe el rol -'.$nombre.'-'

            ]);
        }

        $rol = new Rol;
        $rol->nombre = $nombre;
        $rol->creado_por = Auth::user()->id;
        $rol->save();

        for ($i=0; $i <count($permisos) ; $i++) { 

            if($permisos[$i]=='true') {

                $nuevo_permiso_rol = DB::table('roles_permisos')
                ->insert([
                    'fk_permisos' => $permisosId[$i],
                    'fk_roles' => $rol->id
                ]);

            }

        }

        return Response::json([
            'respuesta' => true,
            'mensaje' => 'Nuevo rol creado!'
        ]);

    }

}

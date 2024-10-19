<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Rol;
use App\Models\Contratista;
use App\Models\Vehiculo;
use App\Models\Operador;

use DB;
use View;
use Response;

class PropietariosController extends Controller
{
    const MENSAJE_LOGOUT = 'Tu sesión se ha cerrado! Serás redirigido al Login.';

    public function contratistas(Request $request) {

    	if (!Auth::check()){

            return view('auth.login');

        }else{

            $contratistas = DB::table('contratistas')
            ->get();

            $tipos = Contratista::tiposSelect(7); //vinculación

            $sedes = DB::table('sedes')
            ->where('estado', 1)
            ->get();

            $bancos = Contratista::tiposSelect(5); //vinculación

            $tipos_cuenta = Contratista::tiposSelect(6); //vinculación

            $tiposv = Contratista::tiposSelect(8); //vinculación

            $marcas = Contratista::tiposSelect(9); //vinculación

            $organismos = Contratista::tiposSelect(10); //vinculación

            $seguros = Contratista::tiposSelect(11); //vinculación

            $estadoc = Contratista::tiposSelect(12); //vinculación

            $genero = Contratista::tiposSelect(13); //vinculación

            $sangre = Contratista::tiposSelect(14); //vinculación

            $ciudades = DB::table('ciudades')
            ->select('ciudades.*', 'departamentos.nombre as nombre_departamento')
            ->leftjoin('departamentos', 'departamentos.id', '=', 'ciudades.fk_departamentos')
            ->orderBy('departamentos.nombre', 'asc')
            ->get();

            return View::make('contratistas.listado_contratistas')
            ->with([
                'contratistas' => $contratistas,
                'tipos' => $tipos,
                'sedes' => $sedes,
                'bancos' => $bancos,
                'tipos_cuenta' => $tipos_cuenta,
                'ciudades' => $ciudades,
                'tiposv' => $tiposv,
                'marcas' => $marcas,
                'organismos' => $organismos,
                'seguros' => $seguros,
                'estadoc' => $estadoc,
                'genero' => $genero,
                'sangre' => $sangre
            ]);

        }

    }

    public function consultarcontratista(Request $request) {

        if (!Auth::check()){

            return Response::json([
                'respuesta' => 'logout',
                'mensaje' => PropietariosController::MENSAJE_LOGOUT
            ]);

        }else{

            $identificacion = $request->identificacion;

            $know = DB::table('contratistas')
            ->where('identificacion', $identificacion)
            ->first();

            if( $know ) {

                return Response::json([
                    'respuesta' => false,
                    'mensaje' => 'Ya existe un contratista con la identificacion '.$identificacion
                ]);

            }else{

                return Response::json([
                    'respuesta' => true
                ]);

            }
        }
    }

    public function nuevocontratista(Request $request) {

        if (!Auth::check()){

            return Response::json([
                'respuesta' => 'logout',
                'mensaje' => PropietariosController::MENSAJE_LOGOUT
            ]);

        }else{

            $identificacion = $request->identificacion;

            $know = DB::table('contratistas')
            ->where('identificacion', $identificacion)
            ->first();

            if( $know ) {

                return Response::json([
                    'respuesta' => false,
                    'mensaje' => 'Ya existe un contratista con la identificacion '.$identificacion
                ]);

            }else{

                $tipo_vinculacion = $request->tipo_vinculacion;
                $sede = $request->sede;
                $nombre = strtoupper($request->nombre);
                $correo = strtoupper($request->correo);
                $direccion = strtoupper($request->direccion);
                $contacto = $request->contacto;
                $ciudad = $request->ciudad;
                $banco = $request->banco;
                $tipo_cuenta = $request->tipo_cuenta;
                $numero_cuenta = $request->numero_cuenta;

                $contratista = new Contratista;
                $contratista->identificacion = $identificacion;
                $contratista->tipo_vinculacion = $tipo_vinculacion;
                $contratista->fk_sede = $sede;
                $contratista->nombre = $nombre;
                $contratista->correo = $correo;
                $contratista->contacto = $contacto;
                $contratista->direccion = $direccion;
                $contratista->fk_ciudad = $ciudad;
                $contratista->fk_banco = $banco;
                $contratista->fk_tipo_cuenta = $tipo_cuenta;
                $contratista->numero_cuenta = $numero_cuenta;
                $contratista->fk_estado = 1;

                if ($request->hasFile('certificado_pdf')){

                    $file_pdf = $request->file('certificado_pdf');
                    $name_pdf = str_replace(' ', '', $file_pdf->getClientOriginalName());

                    $ubicacion_pdf = 'files/documentacion/contratistas/certificados_bancarios/';
                    $file_pdf->move($ubicacion_pdf, $name_pdf);
                    $contratista->certificado_bancario_pdf = $ubicacion_pdf.$name_pdf;

                }

                if ($request->hasFile('rut_pdf')){

                    $file_pdf = $request->file('rut_pdf');
                    $name_pdf = str_replace(' ', '', $file_pdf->getClientOriginalName());

                    $ubicacion_pdf = 'files/documentacion/contratistas/rut/';
                    $file_pdf->move($ubicacion_pdf, $name_pdf);
                    $contratista->rut_pdf = $ubicacion_pdf.$name_pdf;

                }

                if ($request->hasFile('identificacion_pdf')){

                    $file_pdf = $request->file('identificacion_pdf');
                    $name_pdf = str_replace(' ', '', $file_pdf->getClientOriginalName());

                    $ubicacion_pdf = 'files/documentacion/contratistas/identificacion/';
                    $file_pdf->move($ubicacion_pdf, $name_pdf);
                    $contratista->identificacion_pdf = $ubicacion_pdf.$name_pdf;

                }

                if( $contratista->save() ) {

                    return Response::json([
                        'respuesta' => true,
                        'mensaje' => 'Contratista creado correctamente!'
                    ]);

                }else{
                    
                    return Response::json([
                        'respuesta' => false,
                        'mensaje' => 'Error al crear. Comunícate con el administrador.'
                    ]);

                }

            }

        }

    }

    public function nuevocontratistaocasional(Request $request) {

        if (!Auth::check()){

            return Response::json([
                'respuesta' => 'logout',
                'mensaje' => PropietariosController::MENSAJE_LOGOUT
            ]);

        }else{

            $identificacion = $request->identificacion;

            $know = DB::table('contratistas')
            ->where('identificacion', $identificacion)
            ->first();

            if( $know ) {

                return Response::json([
                    'respuesta' => false,
                    'mensaje' => 'Ya existe un contratista con la identificacion '.$identificacion
                ]);

            }else{

                $tipo_vinculacion = $request->tipo_vinculacion;
                $sede = $request->sede;
                $nombre = strtoupper($request->nombre);
                $correo = strtoupper($request->correo);
                $direccion = strtoupper($request->direccion);
                $contacto = $request->contacto;
                $ciudad = $request->ciudad;
                $placa = strtoupper($request->placa);
                $clase_vehiculo = $request->clase_vehiculo;

                $contratista = new Contratista;
                $contratista->identificacion = $identificacion;
                $contratista->tipo_vinculacion = $tipo_vinculacion;
                $contratista->fk_sede = $sede;
                $contratista->nombre = $nombre;
                $contratista->correo = $correo;
                $contratista->contacto = $contacto;
                $contratista->direccion = $direccion;
                $contratista->fk_ciudad = $ciudad;
                $contratista->fk_estado = 1;

                if( $contratista->save() ) {

                    $know = DB::table('vehiculos')
                    ->where('placa', $placa)
                    ->first();

                    $mensajeComplement = '';

                    if( $know ) {

                        $mensajeComplement .= '<br> No se pudo crear el vehículo. Ya existe la placa -'.$placa.'-';

                    }else{
                        $vehiculo = new Vehiculo;
                        $vehiculo->placa = $placa;
                        $vehiculo->fk_clase_vehiculo = $clase_vehiculo;
                        $vehiculo->fk_contratista = $contratista->id;
                        $vehiculo->fk_estado = 1;
                        $vehiculo->save();
                        $mensajeComplement .= '<br> El vehículo -'.$placa.'- fue creado correctamente!';
                    }

                    $know = DB::table('operadores')
                    ->where('identificacion', $identificacion)
                    ->first();

                    if( $know ) {

                        $mensajeComplement .= '<br> No se pudo crear el operador. Ya existe la cc: -'.$identificacion.'-';

                    }else{

                        $razons = $nombre;
                        $razons = explode(' ',$razons);
                        $total = count($razons);

                        $nombre = null;
                        $apellido = null;

                        if($total===3){
                            $nombre = $razons[0];
                            $apellido = $razons[1].' '.$razons[2];
                        }else if($total>=4){
                            $nombre = $razons[0].' '.$razons[1];
                            $apellido = $razons[2].' '.$razons[3];
                        }else{
                            $nombre = $razons[0];
                            if(isset($razons[1])){
                                $apellido = $razons[1];
                            }
                        }

                        $operador = new Operador;
                        $operador->identificacion = $identificacion;
                        $operador->nombres = $nombre;
                        $operador->apellidos = $apellido;
                        $operador->correo = $correo;
                        $operador->celular = $contacto;
                        $operador->direccion = $direccion;
                        $operador->ciudad = $ciudad;
                        $operador->fk_contratista = $contratista->id;
                        $operador->fk_estado = 1;
                        $operador->save();
                        $mensajeComplement .= '<br> El operador -'.$identificacion.'- fue creado correctamente!';
                    }

                    return Response::json([
                        'respuesta' => true,
                        'mensaje' => 'Contratista creado correctamente!'.$mensajeComplement
                    ]);

                }else{
                    
                    return Response::json([
                        'respuesta' => false,
                        'mensaje' => 'Error al crear. Comunícate con el administrador.'
                    ]);

                }

            }

        }

    }

    public function consultarplaca(Request $request) {

        if (!Auth::check()){

            return Response::json([
                'respuesta' => 'logout',
                'mensaje' => PropietariosController::MENSAJE_LOGOUT
            ]);

        }

        $placa = $request->placa;

        $know = DB::table('vehiculos')
        ->where('placa', $placa)
        ->first();

        if( $know ) {

            return Response::json([
                'respuesta' => false,
                'mensaje' => 'Ya existe un vehículo con la placa '.$placa
            ]);

        }else{

            return Response::json([
                'respuesta' => true
            ]);

        }
    }

    public function crearvehiculo(Request $request) {

        if (!Auth::check()){

            return Response::json([
                'respuesta' => 'logout',
                'mensaje' => PropietariosController::MENSAJE_LOGOUT
            ]);

        }else{

            $id = $request->id;

            $placa = $request->placa;

            $know = DB::table('vehiculos')
            ->where('placa', $placa)
            ->first();

            if( $know ) {

                return Response::json([
                    'respuesta' => false,
                    'mensaje' => 'Ya existe un vehículo con la placa '.strtoupper($placa)
                ]);

            }else{

                $placa = strtoupper($request->placa);
                $clase = $request->clase;
                $marca = $request->marca;
                $color = strtoupper($request->color);
                $modelo = $request->modelo;
                $pasajeros = $request->pasajeros;
                $cilindraje = $request->cilindraje;
                $numero_motor = $request->numero_motor;
                $serie_motor = $request->serie_motor;
                $chasis = $request->chasis;
                $linea = strtoupper($request->linea);
                $fecha_matricula = $request->fecha_matricula;
                $numero_matricula = $request->numero_matricula;
                $organismo_transito = $request->organismo_transito;
                $codigo_interno = $request->codigo_interno;
                $empresa_afiliada = strtoupper($request->empresa_afiliada);
                $vigencia_tarjeta_operacion = $request->vigencia_tarjeta_operacion;
                $numero_tarjeta_operacion = $request->numero_tarjeta_operacion;
                $tarjeta_operacion_pdf = $request->tarjeta_operacion_pdf;
                $fecha_vigencia_soat = $request->fecha_vigencia_soat;
                $numero_soat = $request->numero_soat;
                $aseguradora_soat = $request->aseguradora_soat;
                $soat_pdf = $request->soat_pdf;
                $fecha_poliza_contractual = $request->fecha_poliza_contractual;
                $numero_poliza_contractual = $request->numero_poliza_contractual;
                $aseguradora_poliza_contractual = $request->aseguradora_poliza_contractual;
                $poliza_contractual_pdf = $request->poliza_contractual_pdf;
                $fecha_poliza_extra_contractual = $request->fecha_poliza_extra_contractual;
                $numero_poliza_extra_contractual = $request->numero_poliza_extra_contractual;
                $aseguradora_poliza_extra_contractual = $request->aseguradora_poliza_extra_contractual;
                $poliza_extra_contractual_pdf = $request->poliza_extra_contractual_pdf;
                $fecha_tecnomecanica = $request->fecha_tecnomecanica;
                $fecha_preventiva = $request->fecha_preventiva;
                $preventiva_pdf = $request->preventiva_pdf;
                $tecnomecanica_pdf = $request->tecnomecanica_pdf;

                $vehiculo = new Vehiculo;
                $vehiculo->placa = $placa;
                $vehiculo->fk_clase_vehiculo = $clase;
                $vehiculo->marca = $marca;
                $vehiculo->color = $color;
                $vehiculo->modelo = $modelo;
                $vehiculo->pasajeros = $pasajeros;
                $vehiculo->cilindraje = $cilindraje;
                $vehiculo->numero_motor = $numero_motor;
                $vehiculo->serie_motor = $serie_motor; 
                $vehiculo->chasis = $chasis;
                $vehiculo->linea = $linea;
                $vehiculo->fecha_matricula = $fecha_matricula;
                $vehiculo->numero_matricula = $numero_matricula;
                $vehiculo->organismo_transito = $organismo_transito;
                $vehiculo->codigo_interno = $codigo_interno;
                $vehiculo->empresa_afiliada = $empresa_afiliada;
                $vehiculo->vigencia_tarjeta_operacion = $vigencia_tarjeta_operacion;
                $vehiculo->numero_tarjeta_operacion = $numero_tarjeta_operacion;

                if ($request->hasFile('tarjeta_operacion_pdf')){

                    $file_pdf = $request->file('tarjeta_operacion_pdf');
                    $name_pdf = str_replace(' ', '', $file_pdf->getClientOriginalName());

                    $ubicacion_pdf = 'files/documentacion/vehiculos/tarjeta_operacion/';
                    $file_pdf->move($ubicacion_pdf, $name_pdf);
                    $vehiculo->tarjeta_operacion_pdf = $ubicacion_pdf.$name_pdf;

                }

                $vehiculo->vigencia_soat = $fecha_vigencia_soat;
                $vehiculo->numero_soat = $numero_soat;
                $vehiculo->aseguradora_soat = $aseguradora_soat;
                
                if ($request->hasFile('soat_pdf')){

                    $file_pdf = $request->file('soat_pdf');
                    $name_pdf = str_replace(' ', '', $file_pdf->getClientOriginalName());

                    $ubicacion_pdf = 'files/documentacion/vehiculos/soat/';
                    $file_pdf->move($ubicacion_pdf, $name_pdf);
                    $vehiculo->soat_pdf = $ubicacion_pdf.$name_pdf;

                }

                $vehiculo->vigencia_poliza_contractual = $fecha_poliza_contractual;
                $vehiculo->numero_poliza_contractual = $numero_poliza_contractual;
                $vehiculo->aseguradora_poliza_contractual = $aseguradora_poliza_contractual;
                
                if ($request->hasFile('poliza_contractual_pdf')){

                    $file_pdf = $request->file('poliza_contractual_pdf');
                    $name_pdf = str_replace(' ', '', $file_pdf->getClientOriginalName());

                    $ubicacion_pdf = 'files/documentacion/vehiculos/poliza_contractual/';
                    $file_pdf->move($ubicacion_pdf, $name_pdf);
                    $vehiculo->poliza_contractual_pdf = $ubicacion_pdf.$name_pdf;

                }

                $vehiculo->vigencia_poliza_extracontractual = $fecha_poliza_extra_contractual;
                $vehiculo->numero_poliza_extracontractual = $numero_poliza_extra_contractual;
                $vehiculo->aseguradora_poliza_extracontractual = $aseguradora_poliza_extra_contractual;
                
                if ($request->hasFile('poliza_extra_contractual_pdf')){

                    $file_pdf = $request->file('poliza_extra_contractual_pdf');
                    $name_pdf = str_replace(' ', '', $file_pdf->getClientOriginalName());

                    $ubicacion_pdf = 'files/documentacion/vehiculos/poliza_extracontractual/';
                    $file_pdf->move($ubicacion_pdf, $name_pdf);
                    $vehiculo->poliza_extra_contractual_pdf = $ubicacion_pdf.$name_pdf;

                }

                $vehiculo->vigencia_tecnomecanica = $fecha_tecnomecanica;
                $vehiculo->vigencia_revision_preventiva = $fecha_preventiva;
                
                if ($request->hasFile('preventiva_pdf')){

                    $file_pdf = $request->file('preventiva_pdf');
                    $name_pdf = str_replace(' ', '', $file_pdf->getClientOriginalName());

                    $ubicacion_pdf = 'files/documentacion/vehiculos/preventiva/';
                    $file_pdf->move($ubicacion_pdf, $name_pdf);
                    $vehiculo->preventiva_pdf = $ubicacion_pdf.$name_pdf;

                }

                if ($request->hasFile('tecnomecanica_pdf')){

                    $file_pdf = $request->file('tecnomecanica_pdf');
                    $name_pdf = str_replace(' ', '', $file_pdf->getClientOriginalName());

                    $ubicacion_pdf = 'files/documentacion/vehiculos/tecnomecanica/';
                    $file_pdf->move($ubicacion_pdf, $name_pdf);
                    $vehiculo->tecnomecanica_pdf = $ubicacion_pdf.$name_pdf;

                }

                $vehiculo->fk_contratista = $id;
                $vehiculo->fk_estado = 1;
                $vehiculo->save();

                return Response::json([
                    'respuesta' => true,
                    'mensaje' => 'Vehículo creado correctamente!'
                ]);

            }

        }

    }

    public function consultaroperador(Request $request) {

        if (!Auth::check()){

            return Response::json([
                'respuesta' => 'logout',
                'mensaje' => PropietariosController::MENSAJE_LOGOUT
            ]);

        }else{

            $identificacion = $request->identificacion;

            $know = DB::table('operadores')
            ->where('identificacion', $identificacion)
            ->first();

            if( $know ) {

                return Response::json([
                    'respuesta' => false,
                    'mensaje' => 'Ya existe un operador con la identificacion '.$identificacion
                ]);

            }else{

                return Response::json([
                    'respuesta' => true
                ]);

            }

        }

    }

    public function crearoperador(Request $request) {

        if (!Auth::check()){

            return Response::json([
                'respuesta' => 'logout',
                'mensaje' => PropietariosController::MENSAJE_LOGOUT
            ]);

        }else{

            $id = $request->id;

            $identificacion = $request->identificacion;

            $know = DB::table('operadores')
            ->where('identificacion', $identificacion)
            ->first();

            if( $know ) {

                return Response::json([
                    'respuesta' => false,
                    'mensaje' => 'Ya existe un operador con la identificacion '.$identificacion
                ]);

            }else{

                $nombre = strtoupper($request->nombre);
                $apellido = strtoupper($request->apellido);
                $correo = strtoupper($request->correo);
                $celular = $request->celular;
                $fecha_nacimiento = $request->fecha_nacimiento;
                $estado_civil = $request->estado_civil;
                $genero = $request->genero;
                $tipo_sangre = $request->tipo_sangre;
                $hijos = $request->hijos;
                $direccion = strtoupper($request->direccion);
                $ciudad = $request->ciudad;
                $fecha_licencia = $request->fecha_licencia;
                $fecha_seguridad_social = $request->fecha_seguridad_social;
                $eps_pdf = $request->eps_pdf;
                $arl_pdf = $request->arl_pdf;
                $pension_pdf = $request->pension_pdf;
                $compensacion_pdf = $request->compensacion_pdf;

                $arreglo = [
                    'proceso' => 'OPERADOR CREADO',
                    'usuario' => Auth::user()->nombres.' '.Auth::user()->apellidos,
                    'fecha' => date('Y-m-d H:i:s'),
                ];
                

                $operador = new Operador;
                $operador->identificacion = $identificacion;
                $operador->nombres = $nombre;
                $operador->apellidos = $apellido;
                $operador->correo = $correo;
                $operador->fecha_nacimiento = $fecha_nacimiento;
                $operador->estado_civil = $estado_civil;
                $operador->genero = $genero;
                $operador->tipo_sangre = $tipo_sangre;
                $operador->celular = $celular;
                $operador->direccion = $direccion;
                $operador->ciudad = $ciudad;
                $operador->cantidad_hijos = $hijos;
                $operador->vigencia_licencia = $fecha_licencia;
                $operador->vigencia_seguridad_social = $fecha_seguridad_social;
                $operador->historico = '['.json_encode($arreglo).']';
                
                if ($request->hasFile('eps_pdf')){

                    $file_pdf = $request->file('eps_pdf');
                    $name_pdf = str_replace(' ', '', $file_pdf->getClientOriginalName());

                    $ubicacion_pdf = 'files/documentacion/operadores/eps/';
                    $file_pdf->move($ubicacion_pdf, $name_pdf);
                    $operador->eps = $ubicacion_pdf.$name_pdf;

                }

                if ($request->hasFile('arl_pdf')){

                    $file_pdf = $request->file('arl_pdf');
                    $name_pdf = str_replace(' ', '', $file_pdf->getClientOriginalName());

                    $ubicacion_pdf = 'files/documentacion/operadores/arl/';
                    $file_pdf->move($ubicacion_pdf, $name_pdf);
                    $operador->arl = $ubicacion_pdf.$name_pdf;

                }

                if ($request->hasFile('pension_pdf')){

                    $file_pdf = $request->file('pension_pdf');
                    $name_pdf = str_replace(' ', '', $file_pdf->getClientOriginalName());

                    $ubicacion_pdf = 'files/documentacion/operadores/pension/';
                    $file_pdf->move($ubicacion_pdf, $name_pdf);
                    $operador->fondo_pension_cesantias = $ubicacion_pdf.$name_pdf;

                }

                if ($request->hasFile('compensacion_pdf')){

                    $file_pdf = $request->file('compensacion_pdf');
                    $name_pdf = str_replace(' ', '', $file_pdf->getClientOriginalName());

                    $ubicacion_pdf = 'files/documentacion/operadores/caja_compesacion/';
                    $file_pdf->move($ubicacion_pdf, $name_pdf);
                    $operador->caja_compensacion = $ubicacion_pdf.$name_pdf;

                }

                $operador->fk_contratista = $id;
                $operador->fk_estado = 1;
                $operador->save();

                return Response::json([
                    'respuesta' => true,
                    'mensaje' => 'Operador creado correctamente!'
                ]);

            }

        }

    }

    public function listadodeopradores() {

        if (!Auth::check()){

            return view('auth.login');

        }else{

            $query = "select o.id, o.fk_estado, o.nombres, o.apellidos, o.celular, o.identificacion, o.vigencia_licencia, datediff(o.vigencia_licencia, now()) as diff_licencia, o.vigencia_seguridad_social, datediff(o.vigencia_seguridad_social, now()) as diff_ss, e.nombre as nombre_estado, c.nombre as contratista, c.id as id_contratista from operadores o left join contratistas c on c.id = o.fk_contratista left join estados e on e.id = o.fk_estado ";

            $operadores = DB::select($query);

            $tipos = Contratista::tiposSelect(7); //vinculación

            $estados = Contratista::estadosSelect(1);

            return View::make('contratistas.operadores.listado_operadores')
            ->with([
                'operadores' => $operadores,
                'estados' => $estados
            ]);

        }

    }

    public function filtraropradores(Request $request) {

        if (!Auth::check()){

            return Response::json([
                'respuesta' => 'logout',
                'mensaje' => PropietariosController::MENSAJE_LOGOUT
            ]);

        }else{

            $id = $request->id;
            $complement = '';

            if( !intval($id)==0 ) {
                $complement = ' where o.fk_estado = '.$id.'';
            }

            $query = "select o.id, o.fk_estado, o.nombres, o.apellidos, o.celular, o.identificacion, o.vigencia_licencia, datediff(o.vigencia_licencia, now()) as diff_licencia, o.vigencia_seguridad_social, datediff(o.vigencia_seguridad_social, now()) as diff_ss, e.nombre as nombre_estado, c.nombre as contratista, c.id as id_contratista from operadores o left join contratistas c on c.id = o.fk_contratista left join estados e on e.id = o.fk_estado".$complement."";

            $operadores = DB::select($query);

            return Response::json([
                'respuesta' => true,
                'operadores' => $operadores,
                'query' => $query
            ]);

        }

    }

    public function listarproveedores(Request $request) {

        if (!Auth::check()){

            return Response::json([
                'respuesta' => 'logout',
                'mensaje' => PropietariosController::MENSAJE_LOGOUT
            ]);

        }else{

            $id = $request->id;

            $query = "select id, nombre, identificacion from contratistas where id <> ".$id." ";
            $contratistas = DB::select($query);

            return Response::json([
                'respuesta' => true,
                'contratistas' => $contratistas
            ]);

        }

    }

    public function asignarcontratista(Request $request) {

        if (!Auth::check()){

            return Response::json([
                'respuesta' => 'logout',
                'mensaje' => PropietariosController::MENSAJE_LOGOUT
            ]);

        }else{

            $id = $request->id;
            $operador = $request->operador;

            $operator = Operador::find($operador);
            $idOld = $operator->fk_contratista;

            $update = DB::table('operadores')
            ->where('id', $operador)
            ->update([
                'fk_contratista' => $id
            ]);

            if($update) {

                $nombreOld = DB::table('contratistas')
                ->select('id', 'nombre')
                ->where('id', $idOld)
                ->first();

                $nombreNew = DB::table('contratistas')
                ->select('id', 'nombre')
                ->where('id', $id)
                ->first();

                if ($operator->historico!=null) {

                    $cambios = json_decode($operator->historico);

                    $arreglo = [
                        'proceso' => 'OPERADOR CAMBIADO DE <b>'.$nombreOld->nombre.'</b> A <b>'.$nombreNew->nombre.'</b>',
                        'usuario' => Auth::user()->nombres.' '.Auth::user()->apellidos,
                        'fecha' => date('Y-m-d H:i:s')
                    ];

                    array_push($cambios, $arreglo);

                    $operator->historico = $cambios;
                    $operator->save();

                    json_encode($cambios);

                }else{

                    $arreglo = [
                        'proceso' => 'OPERADOR CAMBIADO DE <b>'.$nombreOld->nombre.'</b> A <b>'.$nombreNew->nombre.'</b>',
                        'usuario' => Auth::user()->nombres.' '.Auth::user()->apellidos,
                        'fecha' => date('Y-m-d H:i:s')
                    ];

                    $operator->historico = '['.json_encode($arreglo).']';
                    $operator->save();

                }


                return Response::json([
                    'respuesta' => true,
                    'mensaje' => 'Contratista asignado correctamente!'
                ]);

            }else{

                return Response::json([
                    'respuesta' => false,
                    'mensaje' => 'Error al asignar. Inténtalo de nuevo o Comunícate con el administrador del sistema!'
                ]);

            }

        }

    }

    public function activacionoperadores(Request $request) {

        if (!Auth::check()){

            return Response::json([
                'respuesta' => 'logout',
                'mensaje' => PropietariosController::MENSAJE_LOGOUT
            ]);

        }else{

            $id = $request->id;
            $value = $request->value;
            $motivo = strtoupper($request->motivo);

            $text = "ACTIVADO";

            if($motivo!=null) {
                $text = "INACTIVADO POR MOTIVO: <b>".$motivo.'</b>';
            }

            $operator = Operador::find($id);

            if ($operator->historico!=null) {

                $cambios = json_decode($operator->historico);

                $arreglo = [
                    'proceso' => 'OPERADOR '.$text.'',
                    'usuario' => Auth::user()->nombres.' '.Auth::user()->apellidos,
                    'fecha' => date('Y-m-d H:i:s')
                ];

                array_push($cambios, $arreglo);

                $operator->historico = $cambios;
                $operator->fk_estado = intval($value);
                if($motivo!=null) {
                    $operator->motivo_bloqueado = $motivo;
                }
                $operator->save();

                json_encode($cambios);

            }else{

                $arreglo = [
                    'proceso' => 'OPERADOR '.$text.'',
                    'usuario' => Auth::user()->nombres.' '.Auth::user()->apellidos,
                    'fecha' => date('Y-m-d H:i:s')
                ];

                $operator->historico = '['.json_encode($arreglo).']';
                $operator->fk_estado = intval($value);
                if($motivo!=null) {
                    $operator->motivo_bloqueado = $motivo;
                }
                $operator->save();

            }

            return Response::json([
                'respuesta' => true,
                'mensaje' => 'Proceso realizado correctamente!',
                'value' => intval($id)
            ]);

        }

    }

    public function historicooperador(Request $request) {

        if (!Auth::check()){

            return Response::json([
                'respuesta' => 'logout',
                'mensaje' => PropietariosController::MENSAJE_LOGOUT
            ]);

        }else{

            $id = $request->id;

            $operador = DB::table('operadores')
            ->select('id', 'historico')
            ->where('id', $id)
            ->first();

            return Response::json([
                'respuesta' => true,
                'operador' => $operador
            ]);

        }
    }
}

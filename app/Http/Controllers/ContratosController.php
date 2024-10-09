<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\PropietariosController;

use App\Models\EstadoPadre;
use App\Models\Estado;
use App\Models\TipoPadre;
use App\Models\Tipo;
use App\Models\Contratista;
use App\Models\Contrato;
use App\Models\ContratoFuec;
use App\Models\Fuec;

use DB;
use View;
use Response;
use Redirect;

class ContratosController extends Controller
{
    public function contratos(Request $request) {

    	if (!Auth::check()){

            return view('auth.login');

        }else{

        	$contratos = DB::table('contratos')
        	->where('fk_estado', 7)
        	->get();

        	$sedes = DB::table('sedes')
            ->where('estado', 1)
            ->get();

            $ciudades = DB::table('ciudades')
            ->select('ciudades.*', 'departamentos.nombre as nombre_departamento')
            ->leftjoin('departamentos', 'departamentos.id', '=', 'ciudades.fk_departamentos')
            ->orderBy('departamentos.nombre', 'asc')
            ->get();

        	$objeto_contratos = Contratista::tiposSelect(15); //Tipos de objeto de contrato

        	$empresas = Contratista::tiposSelect(4); //Tipos de empresas

            return View::make('contratos.contratos')
            ->with([
                'contratos' => $contratos,
                'objeto_contratos' => $objeto_contratos,
                'sedes' => $sedes,
                'ciudades' => $ciudades,
                'empresas' => $empresas
            ]);

        }

    }

    public function consultarcontrato(Request $request) {

    	if (!Auth::check()){

            return Response::json([
                'respuesta' => 'logout',
                'mensaje' => PropietariosController::MENSAJE_LOGOUT
            ]);

        }else{

        	$nit = $request->nit;

            $know = DB::table('contratos')
            ->where('nit', $nit)
            ->first();

            if( $know ) {

                return Response::json([
                    'respuesta' => false,
                    'mensaje' => 'Ya existe un contrato con el nit -'.$identificacion.'-'
                ]);

            }else{

            	return Response::json([
                    'respuesta' => true
                ]);

            }
        }
    }

    public function nuevocontrato(Request $request) {

    	if (!Auth::check()){

            return Response::json([
                'respuesta' => 'logout',
                'mensaje' => PropietariosController::MENSAJE_LOGOUT
            ]);

        }else{

        	$nit = $request->nit;

            $know = DB::table('contratos')
            ->where('nit', $nit)
            ->first();

            if( $know ) {

                return Response::json([
                    'respuesta' => false,
                    'mensaje' => 'Ya existe un contrato con el nit -'.$identificacion.'-'
                ]);

            }else{

                $nit = $request->nit;
                $objeto_contrato = $request->objeto_contrato;
                $razon_social = strtoupper($request->razon_social);
                $direccion = strtoupper($request->direccion);
                $telefono = $request->telefono;
                $tipo_de_empresa = $request->tipo_de_empresa;
                $sede = $request->sede;
                $ciudad = $request->ciudad;
                $fecha_inicio = $request->fecha_inicio;
                $fecha_vencimiento = $request->fecha_vencimiento;
                $nombre_responsable = strtoupper($request->nombre_responsable);
                $identificacion_responsable = $request->identificacion_responsable;
                $telefono_responsable = $request->telefono_responsable;
                $direccion_responsable = strtoupper($request->direccion_responsable);
                $nombre_encargado = strtoupper($request->nombre_encargado);
                $telefono_encargado = $request->telefono_encargado;
                $correo_encargado = strtoupper($request->correo_encargado);
                $titular_facturacion = strtoupper($request->titular_facturacion);
                $correo_facturacion = strtoupper($request->correo_facturacion);

                $contrato = new Contrato;
                $contrato->razonsocial = $razon_social;
                $contrato->nit = $nit;
                $contrato->direccion = $direccion;
                $contrato->telefono = $telefono;
                $contrato->fk_tipoempresa = $tipo_de_empresa;
                $contrato->fecha_inicio = $fecha_inicio;
                $contrato->fecha_vencimiento = $fecha_vencimiento;
                $contrato->fk_objeto_contrato = $objeto_contrato;
                $contrato->nombre_responsable = $nombre_responsable;
                $contrato->identificacion_responsable = $identificacion_responsable;
                $contrato->telefono_responsable = $telefono_responsable;
                $contrato->direccion_responsable = $direccion_responsable;
                $contrato->nombre_encargado = $nombre_encargado;
                $contrato->telefono_encargado = $telefono_encargado;
                $contrato->correo_encargado = $correo_encargado;
                $contrato->titular_facturacion = $titular_facturacion;
                $contrato->correo_facturacion = $correo_facturacion;
                $contrato->fk_sede = $sede;
                $contrato->fk_ciudad = $ciudad;
                $contrato->fk_estado = 7;

                if ($request->hasFile('camara_comercio_pdf')){

                    $file_pdf = $request->file('camara_comercio_pdf');
                    $name_pdf = str_replace(' ', '', $file_pdf->getClientOriginalName());

                    $ubicacion_pdf = 'files/documentacion/contratos/camara_comercio/';
                    $file_pdf->move($ubicacion_pdf, $name_pdf);
                    $contrato->camara_comercio_pdf = $ubicacion_pdf.$name_pdf;

                }

                if ($request->hasFile('rut_pdf')){

                    $file_pdf = $request->file('rut_pdf');
                    $name_pdf = str_replace(' ', '', $file_pdf->getClientOriginalName());

                    $ubicacion_pdf = 'files/documentacion/contratos/rut/';
                    $file_pdf->move($ubicacion_pdf, $name_pdf);
                    $contrato->rut_pdf = $ubicacion_pdf.$name_pdf;

                }

                if( $contrato->save() ) {

                	$contratoFuec = new ContratoFuec;
                	$contratoFuec->nombre = $razon_social;
                	$contratoFuec->identificacion = $nit;
                	$contratoFuec->fk_contrato = $contrato->id;
                	$contratoFuec->fk_objeto_contrato = $objeto_contrato;
                	$contratoFuec->save();

                    return Response::json([
                        'respuesta' => true,
                        'mensaje' => 'Contrato creado correctamente!'
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

    //Contratos FUEC

    public function contratosyrutas(Request $request) {

    	if (!Auth::check()){

            return view('auth.login');

        }else{

        	$contratos = DB::table('contratos_fuec')
        	->get();

        	$rutas = DB::table('rutas_fuec')
        	->leftjoin('sedes', 'rutas_fuec.fk_sede', '=', 'sedes.id')
        	->select('rutas_fuec.*', 'sedes.nombre')
        	->get();

        	$sedes = DB::table('sedes')
        	->get();

        	return View::make('contratos.fuec.gestion_fuec')
            ->with([
                'contratos' => $contratos,
                'rutas' => $rutas,
                'sedes' => $sedes
            ]);

        }
    }

    public function nuevarutafuec(Request $request) {

    	if (!Auth::check()){

            return Response::json([
                'respuesta' => 'logout',
                'mensaje' => PropietariosController::MENSAJE_LOGOUT
            ]);

        }else{

        	$origen = strtoupper($request->origen);
        	$destino = strtoupper($request->destino);
        	$sede = $request->sede;

        	$ruta_fuec = DB::table('rutas_fuec')
            ->insert([
                'origen' => $origen,
                'destino' => $destino,
                'fk_sede' => $sede
            ]);

            return Response::json([
            	'respuesta' => true,
            	'mensaje' => 'Ruta creada correctamente!'
            ]);

        }

    }

    public function fuec(Request $request) {

    	if (!Auth::check()){

            return view('auth.login');

        }else{

        	$vehiculos = DB::table('vehiculos')
        	->get();

        	$operadores = DB::table('operadores')
        	->get();

        	$contratos = DB::table('contratos_fuec')
        	//->leftjoin('tipos', 'tipos.id', '=', 'contratos_fuec')
        	//->select('contratos_fuec.*', 'tipos.')
        	->get();

        	$rutas = DB::table('rutas_fuec')
        	->leftjoin('sedes', 'rutas_fuec.fk_sede', '=', 'sedes.id')
        	->select('rutas_fuec.*', 'sedes.nombre')
        	->get();

        	$fuecs = DB::table('fuecs')
        	->leftjoin('operadores', 'operadores.id', '=', 'fuecs.fk_operador')
        	->leftjoin('vehiculos', 'vehiculos.id', '=', 'fuecs.fk_vehiculo')
        	->leftjoin('rutas_fuec', 'rutas_fuec.id', '=', 'fuecs.fk_rutas_fuec')
        	->leftjoin('contratos_fuec', 'contratos_fuec.id', '=', 'fuecs.fk_contratos')
        	->leftjoin('tipos', 'tipos.id', '=', 'contratos_fuec.fk_objeto_contrato')
        	->select('fuecs.*', 'vehiculos.placa', 'operadores.nombres', 'operadores.apellidos', 'rutas_fuec.origen', 'rutas_fuec.destino', 'contratos_fuec.id as contrato', 'contratos_fuec.nombre as razonsocial', 'contratos_fuec.identificacion', 'tipos.nombre as objeto_contrato')
        	->get();

        	return View::make('contratos.fuec.creacion_fuec')
            ->with([
            	'vehiculos' => $vehiculos,
            	'operadores' => $operadores,
                'contratos' => $contratos,
                'rutas' => $rutas,
                'fuecs' => $fuecs
            ]);

        }
    }

    public function nuevofuec(Request $request) {

    	if (!Auth::check()){

            return Response::json([
                'respuesta' => 'logout',
                'mensaje' => PropietariosController::MENSAJE_LOGOUT
            ]);

        }else{

        	$objeto_contrato = $request->objeto_contrato;
        	$contrato = $request->contrato;
        	$ruta = $request->ruta;
        	$operador = $request->operador;
        	$vehiculo = $request->vehiculo;

        	$fuec = new Fuec;
        	$fuec->fk_operador = $operador;
        	$fuec->fk_vehiculo = $vehiculo;
        	$fuec->fk_rutas_fuec = $ruta;
        	$fuec->fk_contratos = $contrato;
        	$fuec->fecha_inicio = '2024-10-08';
        	$fuec->fecha_fin = '2024-10-31';
        	$fuec->save();


        	return Response::json([
        		'respuesta' => true,
        		'mensaje' => 'Fuec creado correctamente!'
        	]);

        	/*//$proveedores = $request->proveedores;
			$conductores = $request->operador;
			$vehiculos = $request->vehiculo;
			$rutas = $request->ruta;
			$clientes = $request->contrato;

			$objeto_contrato = $request->objeto_contrato;

			$arrayRutas = explode(',' , $rutas);
			$arrayClientes = explode(',' , $clientes);

			//$arrayProveedores = explode(',' , $proveedores);
			$arrayConductores = explode(',' , $conductores);
			$arrayVehiculos = explode(',' , $vehiculos);

			$cantidad_de_rutas = count($arrayRutas);
			$cantidad_proveedores = count($arrayProveedores);

			for ($b=0; $b<count($arrayClientes); $b++) {

		 	 	$contrato = DB::table('contratos')
			  	->where('centrodecosto_id', $arrayClientes[$b])
			  	->first();

				for ($c=0; $c<count($arrayProveedores); $c++) {

					//TODOS LOS REGISTROS Y SE TOMA EL ULTIMO REGISTRO GUARDADO
					$fuec_ultimo = Fuec::all();
					$ultimo = $fuec_ultimo->last();

					if ($ultimo!=null) {

					  $ultimo_ano = intval($ultimo->ano);
					  $ultimo = intval($ultimo->consecutivo);

					}else if($ultimo===null) {

					  $ultimo = intval($ultimo);
					  $ultimo_ano = 0;

					}

					$documentos = DB::table('vehiculos')
					->where('id', $arrayVehiculos[$c])
					->first();

					$date = date('Y-m-d');

					$ss = DB::table('seguridad_social')
					->where('conductor_id',$arrayConductores[$c])
					->where('fecha_inicial', '<=', $date)
					->where('fecha_final', '>=', $date)
					->orderBy('fecha_final', 'desc')
					->first();

					if($ss!=null){
					  $fecha_seguridad = $ss->fecha_final;
					}else{
					  $fecha_seguridad = 0;
					}

					$soat = $documentos->fecha_vigencia_soat;
					$poliza_contractual = $documentos->poliza_contractual;
					$poliza_extracontractual = $documentos->poliza_extracontractual;
					$mantenimiento_preventivo = $documentos->mantenimiento_preventivo;
					$tecnomecanica = $documentos->fecha_vigencia_tecnomecanica;
					$tarjeta_operacion = $documentos->fecha_vigencia_operacion;

					$fecha_final = $soat;
					if($poliza_contractual<$fecha_final){
					  $fecha_final = $poliza_contractual;
					}
					if($poliza_extracontractual<$fecha_final){
					  $fecha_final = $poliza_extracontractual;
					}
					if($mantenimiento_preventivo<$fecha_final){
					  $fecha_final = $mantenimiento_preventivo;
					}
					if($tecnomecanica<$fecha_final){
					  $fecha_final = $tecnomecanica;
					}
					if($tarjeta_operacion<$fecha_final){
					  $fecha_final = $tarjeta_operacion;
					}

					if($fecha_seguridad!=0){
					  if($fecha_seguridad<$fecha_final){
					    $fecha_final = $fecha_seguridad;
					  }
					}

					//$fecha_final = $documentos->soat

					$fuec = new Fuec;
					$fuec->ano = date('Y');
					$fuec->contrato_id = $contrato->id;
					$fuec->ruta_id = $arrayRutas[$a];
					$fuec->objeto_contrato = $objeto_contrato;
					//$fuec->colegio = Input::get('colegio');
					$fuec->fecha_inicial = date('Y-m-d');
					$fuec->fecha_final = $fecha_final;
					$fuec->proveedor = $arrayProveedores[$c];
					$fuec->vehiculo = $arrayVehiculos[$c];
					$fuec->conductor = $arrayConductores[$c];
					$fuec->creado_por = Sentry::getUser()->id;

					if ($fuec->save()) {
					  $contador_fuec = $contador_fuec+1;
					  //TOMAR ID PARA BUSCAR EL ULTIMO REGISTRO GUARDADO
					  $id = $fuec->id;
					  $ano = intval($fuec->ano);
					  $f = Fuec::find($id);

					  //SI ESTA VACIO ENTONCES ES IGUAL A CERO
					  if ($ultimo===0 or (intval($ultimo_ano)!=intval($ano))) {
					    $f->consecutivo = '0001';
					  //SI NO ESTA VACIO ENTONCES
					  }else if ($ultimo!=0){

					      if (strlen($ultimo+1)===1) {

					        $f->consecutivo = '000'.($ultimo+1);

					      }else if (strlen($ultimo+1)===2) {

					        $f->consecutivo = '00'.($ultimo+1);

					      }else if (strlen($ultimo+1)===3) {

					        $f->consecutivo = '0'.($ultimo+1);

					      }else if (strlen($ultimo+1)===4) {

					        $f->consecutivo = $ultimo+1;

					      }
					  }

					$f->save();

					}

				}

			}

			if($contador==($cantidad_de_rutas-1)){

				return Response::json([
				  'response'=>false,
				  'contador_fuec' => $contador_fuec,
				  'cantidad_proveedores' => $cantidad_proveedores
				]);

			}else{

				return Response::json([
				  'response'=>true,
				  'proveedores' => $proveedores,
				  'conductores' => $conductores,
				  'vehiculos' => $vehiculos,
				  'rutas' => $rutas,
				  'clientes' => $clientes,
				  'contador_fuec' => $contador_fuec,
				  'contador' => $contador,
				  'cantidad_de_rutas' => $cantidad_de_rutas
				]);

			}*/

        }

    }
}

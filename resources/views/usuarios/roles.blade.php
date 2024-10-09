<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Roles</title>
    <link href="{{url('images/logo.png')}}" rel="icon" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
      
    </style>
</head>
<body>

    <div class="container-fluid">

        <div class="row flex-nowrap">
            
            @include('home.menu')

            <div class="col py-3">
                
            	<div class="container-fluid">
				  	
				  	<form class="form-control">

				  		<h5>Configuración de Roles</h5>

				  		<!-- Button trigger modal -->
						<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
						  Nuevo Rol <i class="bi bi-plus-circle"></i>
						</button>

				  	</form>

					<form class="form-control" style="margin-top: 30px">
						
						<table class="table table-striped">
					  		<thead>
		                        <tr>
		                            <th>
		                                N°
		                            </th>
		                            <th>
		                                Id
		                            </th>
		                            <th>
		                                Nombre
		                            </th>
		                            <th>
		                                Fecha de Creación
		                            </th>
		                            <th>
		                                Usuario creador
		                            </th>
		                            <th>
		                            	Opciones
		                            </th>
		                        </tr>
		                    </thead>
		                    <tbody>
		                        <?php $cont = 1; ?>
		                        @foreach($roles as $rol)
		                            <tr>
		                                <td>
		                                    {{$cont}}
		                                </td>
		                                <td>
		                                    {{$rol->id}}
		                                </td>
		                                <td>
		                                    {{$rol->nombre}}
		                                </td>
		                                <td>
		                                    {{$rol->created_at}}
		                                </td>
		                                <td>
		                                    {{$rol->nombres.' '.$rol->apellidos}}
		                                </td>
		                                <td>
		                                	<i class="fs-5 bi-trash3"></i> <i class="fs-5 bi-pencil-square"></i>
		                                </td>
		                            </tr>
		                            <?php $cont++; ?>
		                        @endforeach
		                    </tbody>
						</table>

						<!-- Modal -->
						<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
						  <div class="modal-dialog modal-xl">
						    <div class="modal-content">
						      <div class="modal-header">
						        <h1 class="modal-title fs-5" id="staticBackdropLabel">Nuevo Rol</h1>
						        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						      </div>
						      <div class="modal-body">
						        <div class="form-control">
						        	<input id="nombre_rol" class="form-control form-control-lg" type="text" placeholder="Escribe el nombre del rol" aria-label=".form-control-lg example">
						        	<hr>
						        	<div id="message" class="toast align-items-right text-bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
									  <div class="d-flex">
									    <div class="toast-body">
									      <span id="text"></span>
									    </div>
									    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
									  </div>
									</div>
						        	<table class="table table-striped" id="tabla_permisos">
						        		<thead>
						        			<tr>
							        			<th>
							        				Nombre
							        			</th>
							        			<th>
							        				Descripcion
							        			</th>
							        			<th>
							        				Otorgar
							        			</th>
							        		</tr>
						        		</thead>
						        		<tbody>
						        			@foreach($permisos as $permiso)
							        			<tr>
							        				<td>
							        					{{$permiso->nombre}}
							        				</td>
							        				<td>
							        					{{$permiso->descripcion}}
							        				</td>
							        				<td>
							        					<div class="form-check form-switch">
														  <input data-id="{{$permiso->id}}" class="form-check-input permission" type="checkbox" role="switch" id="flexSwitchCheckChecked">
														</div>
							        				</td>
							        			</tr>
						        			@endforeach
						        		</tbody>
						        	</table>
						        </div>
						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar esta ventana <i class="bi bi-x-lg"></i></button>
						        <button id="guardar_rol" type="button" class="btn btn-success">Guardar Rol <i class="bi bi-floppy2-fill"></i></button>
						      </div>
						    </div>
						  </div>
						</div>

					</form>
				</div>

            </div>

        </div>

    </div>

<script type="text/javascript" src="{{url('public/js/plugins/jquery-3.7.1.js')}}"></script>
<script src="{{url('public/js/plugins/jquery-ui.min.js')}}"></script>
<script type="text/javascript" src="{{url('public/js/bootstrap/js/bootstrap.js')}}"></script>
<script type="text/javascript" src="{{url('public/js/plugins/util.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

<script type="text/javascript">
	
	$('#guardar_rol').click(function() {
		
		var nombre = $('#nombre_rol').val().trim()

		const toastLiveExample = document.getElementById('message')
      	const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)

      	var permissions = []
      	var permissionsId = []

		if( nombre=='' ) {

			$('#text').html('El campo nombre es obligatorio.')
        	toastBootstrap.show()

		}else{

			var sw = false

			$('#tabla_permisos tbody tr').each(function(index) {

				var perm = $(this).find('.permission').is(':checked')
				var permId = $(this).find('.permission').attr('data-id')

				permissions.push( perm )
				permissionsId.push( permId )

				if( perm==true ) {
					sw = true
				}

		    });

		    if( sw==false ) {

		    	$('#text').html('No has habilitado ningún permiso para este rol.')
        		toastBootstrap.show()

		    }else{

		    	$.ajax({
		            url: 'roles/nuevorol',
		            method: 'post',
		            data: {nombre: nombre, permisos: permissions, permisos_id: permissionsId, "_token": "{{ csrf_token() }}"}
		        }).done(function(data){

		            if(data.respuesta==true){

		              	alert(data.mensaje)

		            }else if(data.respuesta=='existe'){

		              	$('#text').html(data.mensaje)
        				toastBootstrap.show()

		            }

		        });

		    }

		}

	});

</script>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ciudades</title>
    <link href="{{url('images/logo.png')}}" rel="icon" type="image/x-icon" />
    @include('config.estilos')
    <style>
      
    </style>
</head>
<body>

    <div class="container-fluid">

        <div class="row flex-nowrap">
            
            @include('home.menu')

            <div class="col py-3">
                
                <div class="container">
                    
                    <form class="form-control">

                      <h5>Departamentos</h5>

                      <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Nuevo Departamento <i class="fs-5 bi-plus-circle"></i>
                      </button>

                    </form>

                    <form class="form-control" style="margin-top: 30px">
                        
                        <table class="table table-striped" id="departamentos">
                            <thead>
                                <tr>
                                    <th>
                                        N°
                                    </th>
                                    <th>
                                        Nombre
                                    </th>
                                    <th>
                                        Ciudades
                                    </th>
                                    <th>
                                        Opciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $cont = 1; ?>
                                @foreach($departamentos as $departamento)
                                    <tr>
                                        <td>
                                            {{$cont}}
                                        </td>
                                        <td>
                                            {{$departamento->nombre}}
                                        </td>
                                        <td>
                                        	<?php 
                                        	
                                        	$ciudades = DB::table('ciudades')
                                        	->where('fk_departamentos', $departamento->id)
                                        	->get();

                                        	foreach ($ciudades as $ciudad) {
                                        		echo $ciudad->nombre.', ';
                                        	}

                                        	?>
                                        </td>
                                        <td>
                                            <i data-id="{{$departamento->id}}" data-nombre="{{$departamento->nombre}}" class="fs-5 bi-plus-circle-fill nueva_ciudad"></i> <i class="fs-5 bi-pencil-square"></i>
                                        </td>
                                    </tr>
                                    <?php $cont++; ?>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                          <div class="modal-dialog modal-md">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Nuevo Departamento</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <div class="form-control">
                                    <div id="message" class="toast align-items-right text-bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
                                      <div class="d-flex">
                                        <div class="toast-body">
                                          <span id="text"></span>
                                        </div>
                                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                                      </div>
                                    </div>

                                    <div class="container text-center">
                                       
                                        <div class="row align-items-center" style="margin-top: 10">
                                          <div class="col-lg-12">
                                            <b class="etiqueta">Nombre</b>
                                            <input id="departamento" class="form-control form-control-md" type="text" placeholder="Escribe el nombre del departamento" aria-label=".form-control-lg example">
                                          </div>
                                        </div>
                            
                                    </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button id="guardar" type="button" class="btn btn-success">Guardar <i class="bi bi-floppy2-fill"></i></button>
                              </div>
                            </div>
                          </div>
                        </div>

                        <!-- Modal nueva ciudad -->
                        <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                          <div class="modal-dialog modal-md">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Nueva Ciudad - <span class="part2"></span></h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <div class="form-control">
                                    <div id="message" class="toast align-items-right text-bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
                                      <div class="d-flex">
                                        <div class="toast-body">
                                          <span id="text"></span>
                                        </div>
                                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                                      </div>
                                    </div>

                                    <div class="container text-center">
                                       
                                        <div class="row align-items-center" style="margin-top: 10px">
                                          <div class="col-lg-7">
                                            <b class="etiqueta">Nombre</b>
                                            <input id="nombre_ciudad" class="form-control form-control-md" type="text" placeholder="Escribe aquí" aria-label=".form-control-lg example">
                                          </div>
                                          <div class="col-lg-5">
                                            <b class="etiqueta">Código Siigo</b>
                                            <input id="codigo" class="form-control form-control-md" type="number" placeholder="Escribe aquí" aria-label=".form-control-lg example">
                                          </div>
                                        </div>
                            
                                    </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button id="guardar_ciudad" type="button" class="btn btn-success">Guardar <i class="bi bi-floppy2-fill"></i></button>
                              </div>
                            </div>
                          </div>
                        </div>

                    </form>
                </div>

            </div>

        </div>

    </div>

	@include('config.dependencias')

</body>

<script type="text/javascript">
    
    $tabla_departamentos = $('#departamentos').DataTable( {
        "order": [[ 0, "asc" ]],
        paging: false,

        language: {
          processing:     "Procesando...",
          lengthMenu:    "Mostrar _MENU_ Registros",
          info:           "Mostrando _START_ de _END_ de _TOTAL_ Registros",
          infoEmpty:      "Mostrando 0 de 0 de 0 Registros",
          infoFiltered:   "(Filtrando de _MAX_ registros en total)",
          infoPostFix:    "",
          loadingRecords: "Cargando...",
          zeroRecords:    "NINGUN REGISTRO ENCONTRADO",
          emptyTable:     "No se encontró ningún registro",
          paginate: {
            first:      "Primer",
            previous:   "Antes",
            next:       "Siguiente",
            last:       "Ultimo"
          },
          aria: {
            sortAscending:  ": activer pour trier la colonne par ordre croissant",
            sortDescending: ": activer pour trier la colonne par ordre décroissant"
          }
        },
        'bAutoWidth': false,
        'aoColumns' : [
          { 'sWidth': '3%' },
          { 'sWidth': '3%' },
          { 'sWidth': '3%' },
          { 'sWidth': '3%' },
        ],
  	});

    $('#guardar').click(function() {

        var departamento = $('#departamento').val().trim()

        if(departamento=='') {

          errorAlert('Campos Vacíos!', 'No has ingresado el nombre')

        }else{

        	$.ajax({
	            url: 'ciudades/creardepartamento',
	            method: 'post',
	            data: {departamento: departamento, "_token": "{{ csrf_token() }}"}
	        }).done(function(data){

	            if(data.respuesta==true){
	              
                responseTrue('Realizado!', data.mensaje)

	            }else if(data.respuesta=='logout') {
	                
                logoutAlert('Sesión Caducada!', data.mensaje)

	            }

	        });

        }

    });

    $('.nueva_ciudad').click(function() {

    	var name = $(this).attr('data-nombre')
    	var id = $(this).attr('data-id')

    	$('.part2').html(name)
    	$('#guardar_ciudad').attr('data-departamento', id)
    	$('#staticBackdrop2').modal('show')

    })

    $('#guardar_ciudad').click(function() {

    	var id = $(this).attr('data-departamento')
    	var nombre_ciudad = $('#nombre_ciudad').val()
      var codigo = $('#codigo').val()

    	if(nombre_ciudad=='' || codigo=='') {

        var text = '';
        if(nombre_ciudad=='') {
          text += 'No has ingresado el nombre<br>'
        }
        if(codigo=='') {
          text += 'No has ingresado el código<br>'
        }

        errorAlert('Campos Vacíos!', text)

    	}else{

    		$.ajax({
	            url: 'ciudades/crearciudad',
	            method: 'post',
	            data: {id: id, nombre_ciudad: nombre_ciudad, codigo: codigo, "_token": "{{ csrf_token() }}"}
	        }).done(function(data){

	            if(data.respuesta==true){
	              
                responseTrue('Realizado!', data.mensaje)

	            }else if(data.respuesta=='logout') {
	                
                logoutAlert('Sesión Caducada!', data.mensaje)

	            }

	        });

    	}

    })

    function errorAlert(titulo, body) {

      $.confirm({
        title: titulo,
        content: body,
        type: 'red',
        typeAnimated: true,
        buttons: {
            tryAgain: {
                text: 'Cerrar',
                btnClass: 'btn-red',
                action: function(){
                }
            }
        }
      });

    }

    function responseTrue(titulo, body) {

      $.confirm({
        title: titulo,
        content: body,
        type: 'green',
        typeAnimated: true,
        buttons: {
            tryAgain: {
                text: 'Cerrar',
                btnClass: 'btn-green',
                action: function(){
                  location.reload()
                }
            }
        }
      });

    }

    function logoutAlert(titulo, body) {

      $.confirm({
        title: titulo,
        content: body,
        type: 'red',
        typeAnimated: true,
        buttons: {
            tryAgain: {
                text: 'OK',
                btnClass: 'btn-red',
                action: function(){
                  location.reload()
                }
            }
        }
      });

    }

</script>
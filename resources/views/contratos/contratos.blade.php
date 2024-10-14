<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Contratos</title>
    <link href="{{url('images/logo.png')}}" rel="icon" type="image/x-icon" />
    
    @include('config.estilos')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="{{url('bootstrap-datetimepicker\css\bootstrap-datetimepicker.min.css')}}">

    <style type="text/css">
      .etiqueta {
        float: left;
      }
    </style>

    <link href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css" rel="stylesheet"/>
    
    
</head>
<body>

    <div class="container-fluid">

        <div class="row flex-nowrap">
            
            @include('home.menu')

            <div class="col py-3">
                
                <div class="container-fluid">
                    
                    <form class="form-control">

                      <h5>Gestión de Contratos</h5>

                      <button type="button" class="btn btn-success nuevo_contrato">
                        Nuevo Contrato <i class="fs-5 bi-plus-circle"></i>
                      </button>

                    </form>

                    <form class="form-control" style="margin-top: 30px">
                        
                        <table class="table table-striped" id="contratos">
                            <thead>
                                <tr>
                                    <th>
                                        N°
                                    </th>
                                    <th>
                                        Id
                                    </th>
                                    <th>
                                        Nit
                                    </th>
                                    <th>
                                        Razón Social
                                    </th>
                                    <th>
                                        Nombre Encargado
                                    </th>
                                    <th>
                                        Teléfono Encargado
                                    </th>
                                    <th>
                                        Dirección
                                    </th>
                                    <th>
                                        Agregar CC
                                    </th>
                                    <th>
                                        Docs
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $cont = 1; ?>
                                @foreach($contratos as $contrato)
                                    <tr>
                                        <td>
                                            {{$cont}}
                                        </td>
                                        <td>
                                            {{$contrato->id}}
                                        </td>
                                        <td>
                                            {{$contrato->nit}}
                                        </td>
                                        <td>
                                            {{$contrato->razonsocial}}
                                        </td>
                                        <td>
                                            {{$contrato->nombre_encargado}}
                                        </td>
                                        <td>
                                        	{{$contrato->telefono_encargado}}
                                        </td>
                                        <td>
                                          	{{$contrato->direccion}}
                                        </td>
                                        <td>

                                            <button data-id="{{$contrato->id}}" data-razon="{{$contrato->razonsocial}}" type="button" class="btn btn-primary btn-sm nuevo_centro" title="Crear o Ver centros de costo">Centros de Costo</button>

                                        </td>
                                        <td>
                                            <a target="_blank" title="Cámara de comercio" href="{{url('/'.$contrato->camara_comercio_pdf)}}"><i class="fs-4 bi-file-earmark-pdf"></i></a> 

                                            <a target="_blank" title="Rut" href="{{url('/'.$contrato->rut_pdf)}}"><i class="fs-4 bi-file-earmark-pdf"></i></a>
                                        </td>
                                    </tr>
                                    <?php $cont++; ?>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Modales -->
                        @include('contratos.modales.nuevo_contrato')

                    </form>

                    <div class="modal fade" id="modal_nuevo_centro" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                      <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Nuevo Centro de Costo - <span id="name"></span></h1>
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

                                <div class="container text-center formulario">
                                   
                                    <div class="row align-items-center" style="margin-top: 10px">
                                      <div class="col">
                                        <b class="etiqueta">Nombre</b>
                                        <input id="nombre" class="form-control form-control-md" type="text" placeholder="Escribe aquí" aria-label=".form-control-lg example">
                                      </div>
                                    </div>

                                    <div class="row align-items-center pn" style="margin-top: 10px">

                                	  <div class="col">
                                        <b class="etiqueta">Identificación</b>
                                        <input id="identificacion" class="form-control form-control-md" type="number" placeholder="Escribe aquí" aria-label=".form-control-lg example">
                                      </div>

                                      <div class="col">
                                        <b class="etiqueta">Dirección</b>
                                        <input id="direccionn" class="form-control form-control-md" type="text" placeholder="Escribe aquí" aria-label=".form-control-lg example">
                                      </div>

                                    </div>

                                    <div class="row align-items-center pn" style="margin-top: 10px">

                                      <div class="col">
                                        <b class="etiqueta">Correo</b>
                                        <input id="correo" class="form-control form-control-md" type="text" placeholder="Escribe aquí" aria-label=".form-control-lg example">
                                      </div>

                                      <div class="col">
                                        <b class="etiqueta">Celular</b>
                                        <input id="celular" class="form-control form-control-md" type="number" placeholder="Escribe aquí" aria-label=".form-control-lg example">
                                      </div>

                                    </div>
                        
                                </div>
                                <hr>
                                <div class="container text-center lista">
                                	<table class="table table-striped" id="centrosdecosto">
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
			                                        Identificación
			                                    </th>
			                                    <th>
			                                        Dirección
			                                    </th>
			                                    <th>
			                                        Correo
			                                    </th>
			                                    <th>
			                                        Celular
			                                    </th>
			                                    <th>
			                                        Creado
			                                    </th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                                
			                            </tbody>
			                        </table>
                                </div>

                            </div>
                          </div>
                          <div class="modal-footer">
                            <button id="guardar_centro" type="button" class="btn btn-success">Guardar <i class="bi bi-floppy2-fill"></i></button>
                          </div>
                        </div>
                      </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

  @include('config.dependencias')

  <script src="{{url('bootstrap-datetimepicker\js\moment.js')}}"></script>
  <script src="{{url('bootstrap-datetimepicker\js\moment-with-locales.js')}}"></script>
  <script src="{{url('bootstrap-datetimepicker\js\bootstrap-datetimepicker.js')}}"></script>
  
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</body>

<script type="text/javascript">

    $(document).ready(function() {
      $("#fecha_inicio, #fecha_vencimiento").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd'
      });
    });

    $tabla_contratos = $('#contratos').DataTable( {
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
          { 'sWidth': '1%' },
          { 'sWidth': '1%' },
          { 'sWidth': '2%' },
          { 'sWidth': '4%' },
          { 'sWidth': '4%' },
          { 'sWidth': '4%' },
          { 'sWidth': '2%' },
          { 'sWidth': '3%' },
          { 'sWidth': '1%' },
        ],
      });

    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

    $('.nuevo_contrato').click(function() {

      $('#modal_nuevo_contrato').modal('show');

    })

    $('#continuar').click(function() {

      const toastLiveExample = document.getElementById('message')
      const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)

      var nit = $('#nit').val();

      if(nit=='') {

        errorAlert('Campos Vacíos','* Debes ingresar el nit')

      }else{

        $.ajax({
          url: 'contratos/consultarcontrato',
          method: 'post',
          data: {nit: nit, "_token": "{{ csrf_token() }}"}
        }).done(function(data){

          if(data.respuesta==true){

            $('.campos').removeClass('visually-hidden');
            $('#nit').attr('disabled', 'disabled');
            $('#continuar').addClass('visually-hidden');
            $('#guardar').removeClass('visually-hidden');

            $('#atras_contrato').removeClass('visually-hidden')

          }else if(data.respuesta==false) {

            errorAlert('Atención!', data.mensaje)

          }else if(data.respuesta=='logout') {
            
            logoutAlert('Sesión Caducada!',data.mensaje)

          }

        });

      }

    });

    $('#guardar').click(function() {

      const toastLiveExample = document.getElementById('message')
      const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)

      var nit = $('#nit').val();

      var objeto_contrato = $('#objeto_contrato').val(); //df = 0
      var razon_social = $('#razon_social').val(); //df = 0
      var direccion = $('#direccion').val();
      var telefono = $('#telefono').val();
      var tipo_de_empresa = $('#tipo_de_empresa').val();
      var sede = $('#sede').val();
      var ciudad = $('#ciudad').val();
      var fecha_inicio = $('#fecha_inicio').val(); //df = 0
      var fecha_vencimiento = $('#fecha_vencimiento').val(); //df = 0
      var nombre_responsable = $('#nombre_responsable').val(); //df = 0
      var identificacion_responsable = $('#identificacion_responsable').val();
      var telefono_responsable = $('#telefono_responsable').val();
      var direccion_responsable = $('#direccion_responsable').val();
      var nombre_encargado = $('#nombre_encargado').val();
      var telefono_encargado = $('#telefono_encargado').val();
      var correo_encargado = $('#correo_encargado').val();
      var titular_facturacion = $('#titular_facturacion').val();
      var correo_facturacion = $('#correo_facturacion').val();
      
      var camara_comercio_pdf = $('#camara_comercio_pdf').val();
      var rut_pdf = $('#rut_pdf').val();

      if(objeto_contrato=='0' || razon_social=='' || direccion=='' || telefono=='' || tipo_de_empresa=='0' || sede=='0' || ciudad=='0' || fecha_inicio=='' || fecha_vencimiento=='' || nombre_responsable=='' || identificacion_responsable=='' || telefono_responsable=='' || direccion_responsable=='' || nombre_encargado=='' || telefono_encargado=='' || correo_encargado=='' || !validateEmail(correo_encargado) || titular_facturacion=='' || correo_facturacion=='' || !validateEmail(correo_facturacion) || camara_comercio_pdf=='' || rut_pdf=='') {
        
        var text = '';

        if(objeto_contrato=='0') {
          text +='Debes seleccionar el objeto de contrato<br>'
        }
        if(razon_social=='') {
          text +='Debes ingresar la razón social<br>'
        }
        if(direccion=='') {
          text +='Debes ingresar la dirección<br>'
        }
        if(telefono=='') {
          text +='Debes ingresar el teléfono<br>'
        }
        if(tipo_de_empresa=='0') {
          text +='Debes seleccionar el tipo de empresa<br>'
        }
        if(sede=='0') {
          text +='Debes seleccionar la sede<br>'
        }
        if(ciudad=='0') {
          text +='Debes seleccionar la ciudad<br>'
        }
        if(fecha_inicio=='') {
          text +='Debes seleccionar la fecha de inicio<br>'
        }
        if(fecha_vencimiento=='') {
          text +='Debes seleccionar la fecha de vencimiento<br>'
        }
        if(nombre_responsable=='') {
          text +='Debes ingresar el nombre del responsable<br>'
        }
        if(identificacion_responsable=='') {
          text +='Debes ingresar la identificación del responsable<br>'
        }
        if(telefono_responsable=='') {
          text +='Debes ingresar el teléfono del responsable<br>'
        }
        if(direccion_responsable=='') {
          text +='Debes ingresar la dirección del responsable<br>'
        }
        if(nombre_encargado=='') {
          text +='Debes ingresar el nombre del encargado<br>'
        }
        if(telefono_encargado=='') {
          text +='Debes ingresar el teléfono del encargado<br>'
        }
        if(correo_encargado=='') {
          text +='Debes ingresar el correo del encargado<br>'
        }
        if( !validateEmail(correo_encargado) ) {
          text +='Debes ingresar un correo de encargado válido<br>'
        }
        if(titular_facturacion=='') {
          text +='Debes ingresar el nombre del titular de facturación<br>'
        }
        if(correo_facturacion=='') {
          text +='Debes ingresar el correo de facturación<br>'
        }
        if( !validateEmail(correo_facturacion) ) {
          text +='Debes ingresar un correo de facturación válido<br>'
        }

        if(camara_comercio_pdf=='') {
          text +='Debes adjuntar la cámara de comercio<br>'
        }
        if(rut_pdf=='') {
          text +='Debes adjuntar el rut<br>'
        }

        errorAlert('Campos vacíos!', text)

      }else{

        var camara_comercio_pdf = $('#camara_comercio_pdf').prop('files')[0];
        var rut_pdf = $('#rut_pdf').prop('files')[0];

        var formData = new FormData();

        formData.append('nit', nit);
        formData.append('objeto_contrato', objeto_contrato);
        formData.append('razon_social', razon_social);
        formData.append('direccion', direccion);
        formData.append('telefono', telefono);
        formData.append('tipo_de_empresa', tipo_de_empresa);
        formData.append('sede', sede);
        formData.append('ciudad', ciudad);
        formData.append('fecha_inicio', fecha_inicio);
        formData.append('fecha_vencimiento', fecha_vencimiento);
        formData.append('nombre_responsable', nombre_responsable);
        formData.append('identificacion_responsable', identificacion_responsable);
        formData.append('telefono_responsable', telefono_responsable);
        formData.append('direccion_responsable', direccion_responsable);
        formData.append('nombre_encargado', nombre_encargado);
        formData.append('telefono_encargado', telefono_encargado);
        formData.append('correo_encargado', correo_encargado);
        formData.append('titular_facturacion', titular_facturacion);
        formData.append('correo_facturacion', correo_facturacion);
        formData.append('camara_comercio_pdf', camara_comercio_pdf);
        formData.append('rut_pdf', rut_pdf);
        formData.append("_token",  "{{ csrf_token() }}");

        $.ajax({
          url: 'contratos/nuevocontrato',
          method: 'post',
          data: formData,
          processData: false,
          contentType: false,
        }).done(function(data){

          if(data.respuesta==true){

            $('.campos').removeClass('visually-hidden');
            $('#identificacion').attr('disabled', 'disabled');

            responseTrue('Realizado!',data.mensaje)

          }else if(data.respuesta==false) {

            errorAlert('Error!',data.mensaje)

          }else if(data.respuesta=='logout') {
            
            logoutAlert('Sesión Caducada!', data.mensaje)

          }

        });

      }

    });

    $('#atras_contrato').click(function() {

      $('.campos').addClass('visually-hidden')
      $('#nit').removeAttr('disabled')
      $(this).addClass('visually-hidden')

      $('#guardar').addClass('visually-hidden')
      $('#continuar').removeClass('visually-hidden')

    });

    $('.nuevo_centro').click(function() {

    	var nombre = $(this).attr('data-razon')
    	var id = $(this).attr('data-id')

    	if(id == 2) {
    		$('.pn').removeClass('visually-hidden')
    	}else{
    		
    		$('#nombre').val('')
	    	$('#identificacion').val('')
	    	$('#direccionn').val('')
	    	$('#correo').val('')
	    	$('#celular').val('')

    		$('.pn').addClass('visually-hidden')

    	}

    	$('#name').html(nombre)
    	$('#guardar_centro').attr('data-id', id)

    	$tabla_centros.clear().draw();

    	//listar
    	$.ajax({
          url: 'contratos/listarcentros',
          method: 'post',
          data: {id: id, "_token": "{{ csrf_token() }}"}
        }).done(function(data){

          if(data.respuesta==true){

            var j = 1;

            for(i in data.centros) {
            	
	            $tabla_centros.row.add([
			        j,
			        data.centros[i].id,
			        data.centros[i].nombre,                    
			        data.centros[i].identificacion,
			        data.centros[i].direccion,
			        data.centros[i].correo,
			        data.centros[i].celular,
			        data.centros[i].created_at,
			    ]).draw();

			    j++;

			}

          }else if(data.respuesta==false) {

            errorAlert('Atención!', data.mensaje)

          }else if(data.respuesta=='logout') {
            
            logoutAlert('Sesión Caducada!',data.mensaje)

          }

        });

    	$('#modal_nuevo_centro').modal('show')

    })

    $('#guardar_centro').click(function() {

    	var id = $(this).attr('data-id')

    	var nombre = $('#nombre').val()
    	var identificacion = $('#identificacion').val()
    	var direccion = $('#direccionn').val()
    	var correo = $('#correo').val()
    	var celular = $('#celular').val()

    	var sw = 0

    	if(id != 2) {

    		if(nombre=='') {
    			sw = 1
    			errorAlert('Campos vacíos!', 'Debes ingresar el nombre')
    		}

    	}else{

    		if(nombre=='' || identificacion=='' || direccion=='' || correo=='' || !validateEmail(correo) || celular=='') {
    			
    			var text = ''

    			if(nombre=='') {
    				text += 'Debes ingresar el nombre<br>'
    			}
    			if(identificacion=='') {
    				text += 'Debes ingresar la identificación<br>'
    			}
    			if(direccion=='') {
    				text += 'Debes ingresar la dirección<br>'
    			}
    			if(correo=='') {
    				text += 'Debes ingresar el correo<br>'
    			}
    			if(!validateEmail(correo)) {
    				text += 'Debes ingresar un correo válido<br>'
    			}
    			if(celular=='') {
    				text += 'Debes ingresar el celular<br>'
    			}
    			
    			sw = 1

    			errorAlert('Campos vacíos!', text)

    		}

    	}

    	if(sw==0) {

    		$.ajax({
	          url: 'contratos/nuevocentro',
	          method: 'post',
	          data: {nombre: nombre, identificacion: identificacion, direccion: direccion, correo: correo, celular: celular, id: id, "_token": "{{ csrf_token() }}"}
	        }).done(function(data){

	          if(data.respuesta==true){

	            responseTrue('Realizado!', data.mensaje)

	          }else if(data.respuesta==false) {

	            errorAlert('Atención!', data.mensaje)

	          }else if(data.respuesta=='logout') {
	            
	            logoutAlert('Sesión Caducada!',data.mensaje)

	          }

	        });

    	}
    })

    $('.ver_centros').click(function() {

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

    $tabla_centros = $('#centrosdecosto').DataTable( {
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
          { 'sWidth': '1%' },
          { 'sWidth': '1%' },
          { 'sWidth': '2%' },
          { 'sWidth': '4%' },
          { 'sWidth': '4%' },
          { 'sWidth': '4%' },
          { 'sWidth': '4%' },
          { 'sWidth': '1%' },
        ],
      });

    //END CONTRATOS

    function handleFileSelect (event) {
        var selectedFile = event.target.files[0];
        if (selectedFile) {
            var reader = new FileReader();
            reader.onload = function (event) {
            
                    var selectedFile = selectedFile;
                    // Convert the file to Base64
                    var selectedFileBase64 = event.target.result.split(',')[1];
                    console.log(selectedFileBase64);
                    document.getElementById('certificado_pdf').value(selectedFileBase64)
               
            };
            reader.readAsDataURL(selectedFile);
        }
    };

    function validateEmail($email) {
      var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
      return emailReg.test( $email );
    }

</script>
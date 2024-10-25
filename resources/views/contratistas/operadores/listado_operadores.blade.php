<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Operadores</title>
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

                    <h5>Gestión de Operadores</h5>

                  </form>

                    <form class="form-control" style="margin-top: 30px">
                        
                        <select class="form-select" aria-label="Default select example" id="estado_operador">
                          <option value="0" selected>Estado de Operador</option>
                          @foreach($estados as $estado)
                            <option value="{{$estado->id}}">{{$estado->nombre}}</option>
                          @endforeach
                        </select>

                        <table class="table table-hover" id="operadores">
                            <thead>
                                <tr>
                                    <th>
                                        N°
                                    </th>
                                    <th>
                                        Id
                                    </th>
                                    <th>
                                        Identificación
                                    </th>
                                    <th>
                                        Nombre
                                    </th>
                                    <th>
                                        Celular
                                    </th>
                                    <th>
                                        Lic. Vigencia
                                    </th>
                                    <th>
                                        Estado
                                    </th>
                                    <th>
                                        Estado SS
                                    </th>
                                    <th>
                                        Estado 
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $cont = 1; ?>
                                @foreach($operadores as $operador)
                                    <tr>
                                        <td>
                                          {{$cont}}
                                        </td>
                                        <td>
                                          {{$operador->id}}
                                        </td>
                                        <td>
                                          {{$operador->identificacion}}
                                        </td>
                                        <td>
                                          {{$operador->nombres.' '.$operador->apellidos}} <br> <b style="font-size: 10px">{{$operador->contratista}}</b>
                                        </td>
                                        <td>
                                          {{$operador->celular}}
                                        </td>
                                        <td>
                                          @if($operador->diff_licencia<0)
                                            
                                            <button type="button" class="btn btn-danger btn-sm">
                                              {{$operador->vigencia_licencia}}
                                            </button>

                                            <button type="button" class="btn btn-danger btn-sm">
                                              {{$operador->diff_licencia}} <i class="bi bi-exclamation-octagon"></i>
                                            </button>

                                          @else

                                            <button type="button" class="btn btn-success btn-sm">
                                              {{$operador->vigencia_licencia}} 
                                            </button>

                                            <button type="button" class="btn btn-success btn-sm">
                                              {{$operador->diff_licencia}} <i class="bi bi-calendar-check"></i>
                                            </button>

                                          @endif
                                        </td>
                                        <td>
                                          @if($operador->fk_estado==1)

                                            <button data-value="1" data-id="{{$operador->id}}" data-nombre="{{$operador->nombres.' '.$operador->apellidos}}" type="button" class="btn btn-success btn-sm estado">
                                              {{$operador->nombre_estado}} <i class="bi bi-person-check-fill"></i>
                                            </button>

                                          @elseif($operador->fk_estado==2)

                                            <button data-value="2" data-id="{{$operador->id}}" data-nombre="{{$operador->nombres.' '.$operador->apellidos}}" type="button" class="btn btn-danger btn-sm estado">
                                              {{$operador->nombre_estado}} <i class="bi bi-person-fill-slash"></i>
                                            </button>

                                          @endif
                                        </td>
                                        <td>

                                          @if($operador->diff_ss<0)
                                            
                                            <button type="button" class="btn btn-danger btn-sm">
                                              {{$operador->vigencia_seguridad_social}}
                                            </button>

                                            <button type="button" class="btn btn-danger btn-sm">
                                              {{$operador->diff_ss}} <i class="bi bi-exclamation-octagon"></i>
                                            </button>

                                          @else

                                            <button type="button" class="btn btn-success btn-sm">
                                              {{$operador->vigencia_seguridad_social}} 
                                            </button>

                                            <button type="button" class="btn btn-success btn-sm">
                                              {{$operador->diff_ss}} <i class="bi bi-calendar-check"></i>
                                            </button>

                                          @endif

                                        </td>
                                        <td>
                                          
                                          <i title="Editar Operador" class="fs-5 bi-pencil-square"></i> 

                                          <a target="_blank" href="{{url('hv')}}"><i title="Hoja de Vida" class="fs-5 bi-file-earmark-pdf"></i></a>

                                          <i title="Cambiar de Proveedor" class="fs-5 bi-arrow-left-right cambiar_proveedor" id-contratista="{{$operador->id_contratista}}" nombre-contratista="{{$operador->contratista}}" id-operador="{{$operador->id}}"></i>

                                          <i data-nombre="{{$operador->nombres.' '.$operador->apellidos}}" data-id="{{$operador->id}}" class="fs-5 bi-eye historico"></i>

                                        </td>
                                    </tr>
                                    <?php $cont++; ?>
                                @endforeach
                            </tbody>
                        </table>

                    </form>

                    <div class="modal fade" id="modal_seleccionar_contratista" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="staticBackdropLabel">Seleccionar Contratista</h1>
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

                              <div class="container text-left">
                                  
                                  <div class="row align-items-center" style="margin-top: 10px">
                                    <div class="col">
                                      <span>
                                        Contratista actual: <b class="nombre_contratista"></b>
                                      </span>
                                    </div>
                                  </div>

                                  <div class="row align-items-center" style="margin-top: 10px">
                                    <div class="col">
                                      
                                      <table class="table table-hover" id="contratistas">
                                        <thead>
                                            <tr>
                                                <th>
                                                  N°
                                                </th>
                                                <th>
                                                  Id
                                                </th>
                                                <th>
                                                  Identificación
                                                </th>
                                                <th>
                                                  Nombre
                                                </th>
                                                <th>
                                                  Seleccionar
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                        
                                    </div>
                                    
                                  </div>
                      
                              </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button id="asignar" type="button" class="btn btn-success">Guardar <i class="bi bi-floppy2-fill"></i></button>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="modal fade" id="modal_historico" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="staticBackdropLabel">Histórico de Operador: <span class="nombre_operador"></span></h1>
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

                              <div class="container text-left">
                                  
                                  <div class="row align-items-center" style="margin-top: 10px">
                                    <div class="col">
                                      <table class="table table-hover" id="tabla_historico">
                                        <thead>
                                          <th>#</th>
                                          <th>Proceso</th>
                                          <th>Fecha</th>
                                          <th>Usuario</th>
                                        </thead>
                                        <tbody>
                                          
                                        </tbody>
                                      </table>
                                    </div>
                                  </div>
                      
                              </div>
                          </div>
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
      $("#fecha_matricula, #fecha_vigencia_operacion, #fecha_vigencia_soat, #fecha_poliza_contractual, #fecha_poliza_extra_contractual, #fecha_tecnomecanica, #fecha_preventiva, #fecha_nacimiento_opr, #fecha_licencia, #fecha_seguridad_social").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd'
      });
    });

    $tabla_operadores = $('#operadores').DataTable( {
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
          { 'sWidth': '1%' },
          { 'sWidth': '6%' },
          { 'sWidth': '2%' },
          { 'sWidth': '2%' },
          { 'sWidth': '2%' },
          { 'sWidth': '3%' },
          { 'sWidth': '1%' },
        ],
    });

    $tabla_contratistas = $('#contratistas').DataTable( {
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
          { 'sWidth': '1%' },
          { 'sWidth': '6%' },
          { 'sWidth': '2%' },
        ],
    });

    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

    $('#estado_operador').change(function() {

      var id = $(this).val()

      $tabla_operadores.clear().draw();

      $.ajax({
        url: 'filtraropradores',
        method: 'post',
        data: {id: id, "_token": "{{ csrf_token() }}"}
      }).done(function(data){

        if(data.respuesta==true){

          var j = 1;

          for(i in data.operadores) {

            var licencia = ''

            if(data.operadores[i].diff_licencia<0){
                                          
               licencia += '<button type="button" class="btn btn-danger btn-sm">'+
                data.operadores[i].vigencia_licencia+
              '</button>';

              licencia += ' <button type="button" class="btn btn-danger btn-sm">'+
                data.operadores[i].diff_licencia+ ' <i class="bi bi-exclamation-octagon"></i>'+
              '</button>';

            }else{

              licencia += '<button type="button" class="btn btn-success btn-sm">'+
                data.operadores[i].vigencia_licencia+
              '</button>';

              licencia += ' <button type="button" class="btn btn-success btn-sm">'+
                data.operadores[i].diff_licencia+ ' <i class="bi bi-calendar-check"></i>'+
              '</button>';

            }

            var estado = ''

            if(data.operadores[i].fk_estado==1){

              estado += '<button data-value="1" data-id="'+data.operadores[i].id+'" data-nombre="'+data.operadores[i].nombres+' '+data.operadores[i].apellidos+'" type="button" class="btn btn-success btn-sm estado">'+
                data.operadores[i].nombre_estado+ ' <i class="bi bi-person-check-fill"></i>'+
              '</button>';

            }else if(data.operadores[i].fk_estado==2){

              estado += '<button data-value="2" data-id="'+data.operadores[i].id+'" data-nombre="'+data.operadores[i].nombres+' '+data.operadores[i].apellidos+'" type="button" class="btn btn-danger btn-sm estado">'+
                data.operadores[i].nombre_estado+ ' <i class="bi bi-person-fill-slash"></i>'+
              '</button>';

            }

            var ss = ''

            if(data.operadores[i].diff_ss<0) {
                                          
              ss += '<button type="button" class="btn btn-danger btn-sm">'+
                data.operadores[i].vigencia_seguridad_social+
              '</button>';

              ss += ' <button type="button" class="btn btn-danger btn-sm">'+
                data.operadores[i].diff_ss+ ' <i class="bi bi-exclamation-octagon"></i>'+
              '</button>';

            }else{

              ss += '<button type="button" class="btn btn-success btn-sm">'+
                data.operadores[i].vigencia_seguridad_social+
              '</button>';

              ss += ' <button type="button" class="btn btn-success btn-sm">'+
                data.operadores[i].diff_ss+ ' <i class="bi bi-calendar-check"></i>'+
              '</button>';

            }

            var opciones = ''

            opciones += '<i title="Editar Operador" class="fs-5 bi-pencil-square"></i>';

            opciones += ' <i title="Hoja de Vida" class="fs-5 bi-file-earmark-pdf"></i>';

            opciones += ' <i class=" cambiar_proveedor fs-5 bi-arrow-left-right" title="Cambiar de Contratista" id-contratista="'+data.operadores[i].id_contratista+'" nombre-contratista="'+data.operadores[i].contratista+'" id-operador="'+data.operadores[i].id+'"></i>';

            opciones += ' <i data-nombre="'+data.operadores[i].nombres+'" data-id="'+data.operadores[i].id+'" class="fs-5 bi-eye historico"></i>';

            $tabla_operadores.row.add([
              j,
              data.operadores[i].id,
              data.operadores[i].identificacion,                    
              data.operadores[i].nombres+' '+data.operadores[i].apellidos+' <br> <b style="font-size: 10px">'+data.operadores[i].contratista+'</b>',
              data.operadores[i].celular,
              licencia,
              estado,
              ss,
              opciones,
            ]).draw();

            j++;

          }

        }else if(data.respuesta==false) {

          errorAlert('Atención!', data.mensaje)

        }else if(data.respuesta=='logout') {
          
          logoutAlert('Sesión Caducada!',data.mensaje)

        }

      });

    })

    $('#operadores').on('click', '.cambiar_proveedor', function(event) {
      
      var id = $(this).attr('id-contratista')
      var contratista = $(this).attr('nombre-contratista')
      var operador = $(this).attr('id-operador')

      $('#asignar').attr('id-operador', operador)

      $tabla_contratistas.clear().draw();

      $.ajax({
        url: 'listarproveedores',
        method: 'post',
        data: {id: id, "_token": "{{ csrf_token() }}"}
      }).done(function(data){

        if(data.respuesta==true){

          var j = 1;

          for(i in data.contratistas) {

            var opciones = '<div class="form-check">'+
                              '<input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" id-contratista="'+data.contratistas[i].id+'">'+
                              '<label class="form-check-label" for="flexRadioDefault1">'+
                                'Asignar Contratista'+
                              '</label>'+
                            '</div>';

            $tabla_contratistas.row.add([
              j,
              data.contratistas[i].id,
              data.contratistas[i].identificacion,                    
              data.contratistas[i].nombre,
              opciones,
            ]).draw();

            j++;

          }

          $('.nombre_contratista').html(contratista)

          $('#modal_seleccionar_contratista').modal('show')

        }else if(data.respuesta==false) {

          errorAlert('Atención!', data.mensaje)

        }else if(data.respuesta=='logout') {
          
          logoutAlert('Sesión Caducada!',data.mensaje)

        }

      });

    })

    $('#asignar').click(function() {

      var sw = 0
      var id = null
      var operador = $(this).attr('id-operador')

      $('#contratistas tbody tr').each(function(index){

        $(this).children("td").each(function (index2){

            switch (index2){

              case 4:
                
                if( $(this).find('input[type="radio"]').is(':checked')==true ) {

                  var value = $(this).find('input[type="radio"]').is(':checked')
                  id = $(this).find('input[type="radio"]').attr('id-contratista')
                  
                  if(value==true) {
                    sw = 1
                  }

                }
                
              break;
            }
        });
        
      });

      if(sw==0) {
        
        errorAlert('Atención!', 'Debes seleccionar un contratista!')

      }else{
        
        $.ajax({
          url: 'asignarcontratista',
          method: 'post',
          data: {operador: operador, id: id, "_token": "{{ csrf_token() }}"}
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

    $('#operadores').on('click', '.estado', function(event) {

      var id = $(this).attr('data-id')
      var value = $(this).attr('data-value')
      var nombre = $(this).attr('data-nombre')

      if(value==1) {
        var color = 'red'
        var titulo = 'Inactivar'
        var body = 'Quieres Inactivar a <b>'+nombre+'</b>?'
        value = 2

        $.confirm({
          title: titulo,
          content: '' +
          '<form action="" class="formName">' +
          '<label>'+body+'</label>' +
          '<div class="form-group">' +
          '<label>Escribe el motivo</label>' +
          '<input type="text" placeholder="..." class="motivo form-control" required />' +
          '</div>' +
          '</form>',
          buttons: {
              formSubmit: {
                  text: 'Inactivar',
                  btnClass: 'btn-danger',
                  action: function () {

                      var motivo = this.$content.find('.motivo').val();

                      if(!motivo){
                          $.alert('Ingresa el motivo...');
                          return false;
                      }


                      $.ajax({
                        url: 'activacionoperadores',
                        method: 'post',
                        data: {id: id, value: value, motivo: motivo, "_token": "{{ csrf_token() }}"}
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
              },
              cancelar: function () {
                  //close
              },
          },
          onContentReady: function () {
              // bind to events
              var jc = this;
              this.$content.find('form').on('submit', function (e) {
                  // if the user submits the form by pressing enter in the field.
                  e.preventDefault();
                  jc.$$formSubmit.trigger('click'); // reference the button and click it
              });
          }
        });

      }else{
        var color = 'green'
        var titulo = 'Activar'
        var body = 'Quieres activar a <b>'+nombre+'</b>?'
        value = 1

        $.confirm({
          title: titulo,
          content: body,
          type: color,
          typeAnimated: true,
          buttons: {
              tryAgain: {
                  text: titulo,
                  btnClass: 'btn-'+color+'',
                  action: function(){

                    $.ajax({
                      url: 'activacionoperadores',
                      method: 'post',
                      data: {id: id, value: value, motivo: null, "_token": "{{ csrf_token() }}"}
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
              },
              cancelar: function () {
              }
          }
        });

      }

    })

    $('#operadores').on('click', '.historico', function(event) {

      var nombre = $(this).attr('data-nombre')
      var id = $(this).attr('data-id')

      $('.nombre_operador').html(nombre)

      $.ajax({
        url: 'historicooperador',
        method: 'post',
        data: {id: id, "_token": "{{ csrf_token() }}"}
      }).done(function(data){

        if(data.respuesta==true){

          var $json = JSON.parse(data.operador.historico);

          var html;
          var contador = 1;

          for(i in $json){

            html += '<tr>'+
                            '<td>'+contador+'</td>'+
                            '<td>'+$json[i].proceso+'</td>'+
                            '<td>'+$json[i].fecha+'</td>'+
                            '<td>'+$json[i].usuario+'</td>'+
                          '</tr>';
                          contador++;
          }

          $('#tabla_historico tbody').html('').append(html);

          $('#modal_historico').modal('show')

        }else if(data.respuesta=='logout') {
          
          logoutAlert('Sesión Caducada!',data.mensaje)

        }

      });

    })


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

    function validateEmail($email) {
      var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
      return emailReg.test( $email );
    }

    //binds to onchange event of your input field
    $('#certificado_pdf, #rut_pdf, #identificacion_pdf').bind('change', function() {

      var fileSize = this.files[0];
      var sizeInMb = fileSize.size/1024;
      var sizeLimit= 1024*10;
      if (sizeInMb > sizeLimit) {

        $(this).val('')

        alert('archivo muy grande')

      }

    });


</script>
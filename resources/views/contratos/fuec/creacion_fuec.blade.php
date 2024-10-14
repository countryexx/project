<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Fuec</title>
    
    @include('config.estilos')

    <style>
      
    </style>
</head>
<body>

    <div class="container-fluid">

        <div class="row flex-nowrap">
            
            @include('home.menu')

            <div class="col py-3">
                <div class="row">
                    <div class="col-md-12">

                        <form class="form-control">

                          <h5>Fuec</h5>

                        </form>

                        <button type="button" class="btn btn-primary btn-sm nuevo_fuec" style="margin-top: 30px">Nuevo Fuec <i class="bi bi-plus-lg"></i></button>

                        <form class="form-control" style="margin-top: 30px">
                            
                            <table class="table table-hover" id="contratos">
                                <thead>
                                    <tr>
                                        <th>
                                          N°
                                        </th>
                                        <th>
                                          Consecutivo
                                        </th>
                                        <th>
                                          Contrato
                                        </th>
                                        <th>
                                          Operador - Vehículo
                                        </th>
                                        <th>
                                          Ruta
                                        </th>
                                        <th>
                                          Vigencia
                                        </th>
                                        <th>
                                          Documento
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $cont = 1; ?>
                                    @foreach($fuecs as $fuec)
                                        <tr>
                                            <td>
                                              {{$cont}}
                                            </td>
                                            <td>
                                              {{$fuec->id}}
                                            </td>
                                            <td>
                                              {{$fuec->razonsocial}}
                                            </td>
                                            <td>
                                              {{$fuec->nombres.' '.$fuec->apellidos}} - {{$fuec->placa}}
                                            </td>
                                            <td>
                                              {{$fuec->origen}} - {{$fuec->destino}}
                                            </td>
                                            <td>
                                              {{$fuec->fecha_inicio}} - {{$fuec->fecha_fin}}
                                            </td>
                                            <td>
                                              
                                              <a href="{{url('prueba')}}"><i class="fs-3 bi-arrow-down-circle-fill download" ></i></a>
                                              

                                              <i style="margin-left: 10px" class="fs-3 bi-send-check"></i> 

                                              <a href="{{url('stream')}}" target="_blank"><i style="margin-left: 10px" class="fs-3 bi-eye"></i></a>
                                              
                                            </td>
                                        </tr>
                                        <?php $cont++; ?>
                                    @endforeach
                                </tbody>
                            </table>

                        </form>

                    </div>

                </div>
                
                <div class="modal fade" id="modal_nuevo_fuec" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="staticBackdropLabel">Nuevo Fuec</h1>
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
                                    <div class="col">
                                      <b class="etiqueta">Vehículo</b>
                                      <select class="form-select" aria-label="Default select example" id="vehiculo">
                                        <option value="0" selected>Seleccionar</option>
                                        @foreach($vehiculos as $vehiculo)
                                          <option value="{{$vehiculo->id}}">{{$vehiculo->placa}}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                    <div class="col">
                                      <b class="etiqueta">Operador</b>
                                      <select class="form-select" aria-label="Default select example" id="operador">
                                        <option value="0" selected>Seleccionar</option>
                                        @foreach($operadores as $operador)
                                          <option value="{{$operador->id}}">{{$operador->nombres.' '.$operador->apellidos}}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                  </div>

                                  <div class="row align-items-center" style="margin-top: 10px">
                                    <div class="col">
                                      <b class="etiqueta">Contrato</b>
                                      <select class="form-select" aria-label="Default select example" id="contrato">
                                        <option value="0" selected>Seleccionar</option>
                                        @foreach($contratos as $contrato)
                                          <option data-objeto-contrato="{{$contrato->fk_objeto_contrato}}" value="{{$contrato->id}}">{{$contrato->nombre}}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                    <div class="col">
                                      <b class="etiqueta">Rutas</b>
                                      <select class="form-select" aria-label="Default select example" id="ruta">
                                        <option value="0" selected>Seleccionar</option>
                                        @foreach($rutas as $ruta)
                                          <option value="{{$ruta->id}}">{{$ruta->origen.' '.$ruta->destino}}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                  </div>
                      
                              </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button id="guardar_fuec" type="button" class="btn btn-success">Guardar <i class="bi bi-floppy2-fill"></i></button>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>

        </div>

    </div>

	@include('config.dependencias')

</body>

<script type="text/javascript">
    
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
          { 'sWidth': '1%' },
          { 'sWidth': '3%' },
          { 'sWidth': '7%' },
          { 'sWidth': '3%' },
          { 'sWidth': '1%' },
        ],
    });

    $('.nuevo_fuec').click(function() {

      $('#modal_nuevo_fuec').modal('show');

    })

    $('#guardar_fuec').click(function() {

      var objeto_contrato = $('#contrato option:selected').attr('data-objeto-contrato')
      var contrato = $('#contrato').val()
      var ruta = $('#ruta').val()
      var operador = $('#operador').val()
      var vehiculo = $('#vehiculo').val()

      if(contrato=='0' || ruta=='0' || operador=='0' || vehiculo=='0') {

        var text = ''

        if(vehiculo=='0') {
          text += 'Debes seleccionar el vehículo<br>'
        }
        if(operador=='0') {
          text += 'Debes seleccionar el operador<br>'
        }
        if(contrato=='0') {
          text += 'Debes seleccionar el contrato<br>'
        }
        if(ruta=='0') {
          text += 'Debes seleccionar la ruta<br>'
        }

        errorAlert('Hay campos vacíos!', text)

      }else{

        $.ajax({
          url: 'nuevofuec',
          method: 'post',
          data: {objeto_contrato: objeto_contrato, contrato: contrato, ruta: ruta, operador: operador, vehiculo: vehiculo, "_token": "{{ csrf_token() }}"}
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

    $('.download').click(function() {

      $.ajax({
        url: 'prueba',
        method: 'post',
        data: {"_token": "{{ csrf_token() }}"}
      }).done(function(data){

        

      });

    })

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

</script>
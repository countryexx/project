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
                    <div class="col-md-6">

                        <form class="form-control">

                          <h5>Contratos de Fuec</h5>

                        </form>

                        <form class="form-control" style="margin-top: 30px">
                            
                            <table class="table table-hover" id="contratos">
                                <thead>
                                    <tr>
                                        <th>
                                          N°
                                        </th>
                                        <th>
                                          ID
                                        </th>
                                        <th>
                                          Nombre
                                        </th>
                                        <th>
                                          Indentificación
                                        </th>
                                        <th>
                                          Fecha creación
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
                                              {{$contrato->nombre}}
                                            </td>
                                            <td>
                                              {{$contrato->identificacion}}
                                            </td>
                                            <td>
                                              {{$contrato->created_at}}
                                            </td>
                                        </tr>
                                        <?php $cont++; ?>
                                    @endforeach
                                </tbody>
                            </table>

                        </form>

                    </div>
                    <div class="col-md-6">
                        
                        <form class="form-control">

                          <h5>Rutas de Fuec</h5>

                        </form>

                        <i class="fs-4 bi-plus-lg nueva_ruta" style="float: right;"></i>

                        <form class="form-control" style="margin-top: 30px">
                          <table class="table table-hover" id="rutas_fuec">
                            <thead>
                              <tr>
                                  <th>
                                    N°
                                  </th>
                                  <th>
                                    ID
                                  </th>
                                  <th>
                                    Origen
                                  </th>
                                  <th>
                                    Destino
                                  </th>
                                  <th>
                                    Sede
                                  </th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php $cont = 1; ?>
                              @foreach($rutas as $ruta)
                                <tr>
                                  <td>
                                    {{$cont}}
                                  </td>
                                  <td>
                                    {{$ruta->id}}
                                  </td>
                                  <td>
                                    {{$ruta->origen}}
                                  </td>
                                  <td>
                                    {{$ruta->destino}}  
                                  </td>
                                  <td>
                                    {{$ruta->nombre}}  
                                  </td>
                                </tr>
                                  <?php $cont++; ?>
                              @endforeach
                            </tbody>
                          </table>
                        </form>
                    </div>
                </div>
                
                <div class="modal fade" id="modal_nueva_ruta" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="staticBackdropLabel">Nueva Ruta</h1>
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
                                    <div class="col-lg-4">
                                      <b class="etiqueta">Origen</b>
                                      <input id="origen" class="form-control form-control-md" type="text" placeholder="Escribe aquí" aria-label=".form-control-lg example">
                                    </div>
                                    <div class="col-lg-4">
                                      <b class="etiqueta">Destino</b>
                                      <input id="destino" class="form-control form-control-md" type="text" placeholder="Escribe aquí" aria-label=".form-control-lg example">
                                    </div>
                                    <div class="col-lg-4">
                                      <b class="etiqueta">Sede</b>
                                      <select class="form-select" aria-label="Default select example" id="sede">
                                        <option value="0" selected>Seleccionar</option>
                                        @foreach($sedes as $sede)
                                          <option value="{{$sede->id}}">{{$sede->nombre}}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                  </div>
                      
                              </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button id="guardar_ruta" type="button" class="btn btn-success">Guardar <i class="bi bi-floppy2-fill"></i></button>
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
          { 'sWidth': '5%' },
          { 'sWidth': '2%' },
          { 'sWidth': '4%' },
        ],
    });

    $tabla_rutas_fuec = $('#rutas_fuec').DataTable( {
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
          { 'sWidth': '5%' },
          { 'sWidth': '3%' },
          { 'sWidth': '3%' },
        ],
    });

    $('.nueva_ruta').click(function() {

      $('#modal_nueva_ruta').modal('show');

    })

    $('#guardar_ruta').click(function() {

      var origen = $('#origen').val()
      var destino = $('#destino').val()
      var sede = $('#sede').val()

      if(origen=='' || destino=='' || sede=='0') {

        var text = ''

        if(origen=='') {
          text += 'Debes ingresar el origen<br>'
        }
        if(destino=='') {
          text += 'Debes ingresar el destino<br>'
        }
        if(sede=='0') {
          text += 'Debes seleccionar la sede<br>'
        }

        errorAlert('Hay campos vacíos!', text)

      }else{

        $.ajax({
          url: 'nuevarutafuec',
          method: 'post',
          data: {origen: origen, destino: destino, sede: sede, "_token": "{{ csrf_token() }}"}
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
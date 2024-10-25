<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarifas</title>
    
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
                    <div class="col">

                        <form class="form-control">

                          <h5>Gestión de Trayectos</h5>

                        </form>

                        <i class="fs-4 bi-plus-lg nuevo_trayecto" style="float: left;"></i>

                        <form class="form-control" style="margin-top: 30px">
                            
                            <table class="table table-hover" id="trayectos">
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
                                          Creado
                                        </th>
                                        <th>
                                          Sede
                                        </th>
                                        <th>
                                          Fecha creación
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $cont = 1; ?>
                                    @foreach($trayectos as $trayecto)
                                        <tr>
                                            <td>
                                              {{$cont}}
                                            </td>
                                            <td>
                                              {{$trayecto->id}}
                                            </td>
                                            <td>
                                              {{$trayecto->nombre}}
                                            </td>
                                            <td>
                                              {{$trayecto->nombres.' '.$trayecto->apellidos}}
                                            </td>
                                            <td>
                                              {{$trayecto->sede}}
                                            </td>
                                            <td>
                                              {{$trayecto->created_at}}
                                            </td>
                                        </tr>
                                        <?php $cont++; ?>
                                    @endforeach
                                </tbody>
                            </table>

                        </form>

                    </div>
                    
                </div>
                
                <div class="modal fade" id="modal_nuevo_trayecto" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="staticBackdropLabel">Nuevo Trayecto</h1>
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
                                      <b class="etiqueta">Nombre</b>
                                      <input id="nombre" class="form-control form-control-md" type="text" placeholder="Escribe aquí" aria-label=".form-control-lg example">
                                    </div>
                                    
                                    <div class="col">
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
                          <button id="guardar_trayecto" type="button" class="btn btn-success">Guardar <i class="bi bi-floppy2-fill"></i></button>
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
    
    $tabla_trayectos = $('#trayectos').DataTable( {
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
          { 'sWidth': '2%' },
          { 'sWidth': '4%' },
        ],
    });

    $('.nuevo_trayecto').click(function() {

      $('#modal_nuevo_trayecto').modal('show');

    })

    $('#guardar_trayecto').click(function() {

      var nombre = $('#nombre').val()
      var sede = $('#sede').val()

      if(nombre=='' || sede=='0') {

        var text = ''

        if(nombre=='') {
          text += 'Debes ingresar el nombre<br>'
        }
        if(sede=='0') {
          text += 'Debes seleccionar la sede<br>'
        }

        errorAlert('Hay campos vacíos!', text)

      }else{

        $.ajax({
          url: 'nuevotrayecto',
          method: 'post',
          data: {nombre: nombre, sede: sede, "_token": "{{ csrf_token() }}"}
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
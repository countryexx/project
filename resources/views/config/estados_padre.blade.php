<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estados Padre</title>
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
                <div class="row">
                    <div class="col-md-6">

                        <form class="form-control">

                          <h5>Gestión de Tipos</h5>

                        </form>

                        <div class="row align-items-end" style="margin-top: 30px">

                          <div class="col">
                            <b class="etiqueta">Nombre</b>
                            <input id="nombre_tipo" class="form-control form-control-md" type="text" placeholder="Escribe aquí" aria-label=".form-control-lg example">
                          </div>

                          <div class="col">
                            <b class="etiqueta">Código</b>
                            <input id="nombre_corto_tipo" class="form-control form-control-md" type="text" placeholder="Escribe aquí" aria-label=".form-control-lg example">
                          </div>
                          
                          <div class="col">
                              <button type="button" class="btn btn-info guardar_tipo">Guardar <i class="bi bi-arrow-return-right"></i></button>
                          </div>
                        </div>

                        <form class="form-control" style="margin-top: 30px">
                            
                            <table class="table table-hover" id="tipos">
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
                                            Opciones
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $cont = 1; ?>
                                    @foreach($tipos as $tipo)
                                        <tr>
                                            <td>
                                                {{$cont}}
                                            </td>
                                            <td>
                                                {{$tipo->id}}
                                            </td>
                                            <td>
                                                {{$tipo->nombre}}
                                            </td>
                                            <td>
                                                <!--<i data-id="{{$tipo->id}}" data-nombre="{{$tipo->nombre}}" class="fs-5 bi-plus-circle-fill nueva_ciudad"></i> <i class="fs-5 bi-pencil-square"></i>-->

                                                <a href="{{url('configuracion/tipos/'.$tipo->id)}}" target="_blank" type="button" class="btn btn-secondary">Ver tipos <i class="bi bi-arrow-right-circle"></i></a>

                                            </td>
                                        </tr>
                                        <?php $cont++; ?>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Modal -->

                            <!-- Modal nueva ciudad -->

                        </form>

                    </div>
                    <div class="col-md-6">
                        
                        <form class="form-control">

                          <h5>Gestión de Estados</h5>

                        </form>

                        <div class="row align-items-end" style="margin-top: 30px">

                          <div class="col">
                            <b class="etiqueta">Nombre</b>
                            <input id="nombre" class="form-control form-control-md" type="text" placeholder="Escribe aquí" aria-label=".form-control-lg example">
                          </div>

                          <div class="col">
                            <b class="etiqueta">Código</b>
                            <input id="nombre_corto" class="form-control form-control-md" type="text" placeholder="Escribe aquí" aria-label=".form-control-lg example">
                          </div>
                          
                          <div class="col">
                              <button id="guardar" type="button" class="btn btn-info">Guardar <i class="bi bi-arrow-return-right"></i></button>
                          </div>
                        </div>

                        <form class="form-control" style="margin-top: 30px">
                            <table class="table table-hover" id="estados">
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
                                            Opciones
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $cont = 1; ?>
                                    @foreach($estados_padre as $estado)
                                        <tr>
                                            <td>
                                                {{$cont}}
                                            </td>
                                            <td>
                                                {{$estado->id}}
                                            </td>
                                            <td>
                                                {{$estado->nombre}}
                                            </td>
                                            <td>
                                                <a href="{{url('configuracion/estados/'.$estado->id)}}" target="_blank" type="button" class="btn btn-secondary">Ver estados <i class="bi bi-arrow-right-circle"></i></a>
                                            </td>
                                        </tr>
                                        <?php $cont++; ?>
                                    @endforeach
                                </tbody>
                              
                            </table>
                        </form>
                    </div>
                </div>
                

            </div>

        </div>

    </div>

    @include('config.dependencias')

</body>

<script type="text/javascript">
    
    $tabla_tipos = $('#tipos').DataTable( {
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
          { 'sWidth': '1%' },
        ],
    });

    $tabla_estados = $('#estados').DataTable( {
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
          { 'sWidth': '1%' },
        ],
    });

    $('#guardar').click(function() {

        var nombre = $('#nombre').val().trim()
        var nombre_corto = $('#nombre_corto').val().trim()

        if(nombre=='' || nombre_corto=='') {

            var text = '';

            if(nombre=='') {
                text += 'Debes ingresar el nombre<br>';
            }
            if(nombre_corto=='') {
                text += 'Debes ingresar el código';
            }

            errorAlert(1, text)

        }else{

            $.ajax({
                url: 'configuracion/crearestadopadre',
                method: 'post',
                data: {nombre: nombre, nombre_corto: nombre_corto, "_token": "{{ csrf_token() }}"}
            }).done(function(data){

                if(data.respuesta==true){
                  location.reload();
                }else if(data.respuesta=='logout') {
                    location.reload()
                }

            });
        }

    });

    $('.guardar_tipo').click(function() {

        var nombre = $('#nombre_tipo').val().trim()
        var nombre_corto = $('#nombre_corto_tipo').val().trim()

        if(nombre=='' || nombre_corto=='') {

            var text = '';

            if(nombre=='') {
                text += 'Debes ingresar el nombre<br>';
            }
            if(nombre_corto=='') {
                text += 'Debes ingresar el código';
            }

            errorAlert(1, text)

        }else{

            $.ajax({
                url: 'configuracion/creartipo',
                method: 'post',
                data: {nombre: nombre, nombre_corto: nombre_corto, "_token": "{{ csrf_token() }}"}
            }).done(function(data){

                if(data.respuesta==true){
                  location.reload();
                }else if(data.respuesta=='logout') {
                    location.reload()
                }

            });
        }

    });

    function errorAlert(titulo, body) {

      $.confirm({
        title: 'Hay campos vacíos!',
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
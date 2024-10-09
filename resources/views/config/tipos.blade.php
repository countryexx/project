<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tipos</title>
    
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

                          <h5>Tipo: <b>{{$nombre}}</b></h5>

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
                              <button data-id="{{$tipo_id}}" id="guardar" type="button" class="btn btn-info">Guardar <i class="bi bi-arrow-return-right"></i></button>
                          </div>
                        </div>

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
	                                Id
	                            </th>
	                            <th>
	                                Nombre
	                            </th>
	                            <th>
	                                Código
	                            </th>
	                            <th>
	                                Estado
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
	                                    {{$tipo->nombre_corto}}
	                                </td>
	                                <td>
	                                    <div class="form-check form-switch">
	                                      <input class="form-check-input status" data-id="{{$tipo->id}}" type="checkbox" role="switch" id="flexSwitchCheckDefault" @if($tipo->estado==1){{'checked'}}@endif >
	                                      <label class="form-check-label" for="flexSwitchCheckDefault">Activo</label>
	                                    </div>
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
          { 'sWidth': '3%' },
          { 'sWidth': '1%' },
        ],
    });

    $('#guardar').click(function() {

        var nombre = $('#nombre').val().trim()
        var nombre_corto = $('#nombre_corto').val().trim()
        var tipo_padre = $('#guardar').attr('data-id')

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
	            url: '../creartipo',
	            method: 'post',
	            data: {nombre: nombre, nombre_corto: nombre_corto, tipo_padre: tipo_padre, "_token": "{{ csrf_token() }}"}
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

    $('.status').change(function() {

        var id = $(this).attr('data-id')
        var checked = $(this).is(':checked')
        var estado = null;

        if(checked==true) {
            estado = 1;
        }

        $.ajax({
            url: '../activartipo',
            method: 'post',
            data: {id: id, estado: estado, "_token": "{{ csrf_token() }}"}
        }).done(function(data){

            if(data.respuesta==true){
              
            }else if(data.respuesta=='logout') {
                location.reload()
            }

        });

    });

</script>
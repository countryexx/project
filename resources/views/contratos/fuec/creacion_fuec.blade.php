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
                                      <small role="alert" class="text-danger veh_text"></small>
                                      <select class="form-select" aria-label="Default select example" id="vehiculo">
                                        <option value="0" selected>Seleccionar</option>
                                        @foreach($vehiculos as $vehiculo)
                                          <option value="{{$vehiculo->id}}">{{$vehiculo->placa}}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                    <div class="col">
                                      <b class="etiqueta">Operador</b>
                                      <small role="alert" class="text-danger opr_text visually-hidden"></small>
                                      <select class="form-select" aria-label="Default select example" id="operador">
                                        <option>-</option>
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

                  @include('contratos.modales.documentacion_vencida_vehiculo')

                  @include('contratos.modales.documentacion_vencida_operador')

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

    $('#vehiculo').change(function () {

        var vehiculo = $(this).val();

        if(vehiculo==='0'){

            $('#operador').attr('disabled','disabled').val(0);

        }else{

          $.ajax({
              method: 'post',
              url: 'vehiculosoperadores',
              data: {vehiculo: vehiculo, "_token": "{{ csrf_token() }}"},
              dataType: 'json',
              success: function (data) {

                if(data.respuesta == true){

                  var operators = '';
                  var vehiculosHtml = '';
                  var telefono = '';

                  for(i in data.operadores) {

                    if(data.operadores[i].celular!='' && data.operadores[i].celular!=null){
                      telefono = data.operadores[i].celular;
                    }else{
                      telefono = 'NO REGISTRADO';
                    }

                    if(i==0) {
                      var selected = 'selected'
                    }else{
                      var selected = ''
                    }

                    operators += '<option value="'+data.operadores[i].id+'">'+data.operadores[i].nombres+' '+data.operadores[i].apellidos+' / '+telefono+'</option>';
                  }

                  $('#operador').removeAttr('disabled');

                  $('#operador').html('').append('<option value="0">Seleccionar</option>'+operators);

                  var switchs = 0

                  var classOperacion = 'btn btn-success btn-sm'
                  var iconOperacion = '<i class="bi bi-calendar-check"></i>'
                  if(data.vehiculo.tarjeta_operacion<1) {
                    classOperacion = 'btn btn-danger btn-sm'
                    iconOperacion = '<i class="bi bi-exclamation-octagon"></i>'
                    switchs = 1
                  }
                  $('.fecha_tarjeta_operacion').html(data.vehiculo.vigencia_tarjeta_operacion).removeClass('btn btn-danger btn-sm').addClass(classOperacion)
                  $('.dias_tarjeta_operacion').html(data.vehiculo.tarjeta_operacion+' '+iconOperacion).removeClass('btn btn-danger btn-sm').addClass(classOperacion)

                  var classSoat = 'btn btn-success btn-sm'
                  var iconSoat = '<i class="bi bi-calendar-check"></i>'
                  if(data.vehiculo.soat<1) {
                    classSoat = 'btn btn-danger btn-sm'
                    iconSoat = '<i class="bi bi-exclamation-octagon"></i>'
                    switchs = 1
                  }
                  $('.fecha_soat').html(data.vehiculo.vigencia_soat).removeClass('btn btn-danger btn-sm').addClass(classSoat)
                  $('.dias_soat').html(data.vehiculo.soat+' '+iconSoat).removeClass('btn btn-danger btn-sm').addClass(classSoat)

                  var classTecno = 'btn btn-success btn-sm'
                  var iconTecno = '<i class="bi bi-calendar-check"></i>'
                  if(data.vehiculo.tecnomecanica<1) {
                    classTecno = 'btn btn-danger btn-sm'
                    iconTecno = '<i class="bi bi-exclamation-octagon"></i>'
                    switchs = 1
                  }
                  $('.fecha_tecno').html(data.vehiculo.vigencia_tecnomecanica).removeClass('btn btn-danger btn-sm').addClass(classTecno)
                  $('.dias_tecno').html(data.vehiculo.tecnomecanica+' '+iconTecno).removeClass('btn btn-danger btn-sm').addClass(classTecno)

                  var classContra = 'btn btn-success btn-sm'
                  var iconContra = '<i class="bi bi-calendar-check"></i>'
                  if(data.vehiculo.poliza_contractual<1) {
                    classContra = 'btn btn-danger btn-sm'
                    iconContra = '<i class="bi bi-exclamation-octagon"></i>'
                    switchs = 1
                  }
                  $('.fecha_contra').html(data.vehiculo.vigencia_poliza_contractual).removeClass('btn btn-danger btn-sm').addClass(classContra)
                  $('.dias_contra').html(data.vehiculo.poliza_contractual+' '+iconContra).removeClass('btn btn-danger btn-sm').addClass(classContra)

                  var classExtra = 'btn btn-success btn-sm'
                  var iconExtra = '<i class="bi bi-calendar-check"></i>'
                  if(data.vehiculo.poliza_extra_contractual<1) {
                    classExtra = 'btn btn-danger btn-sm'
                    iconExtra = '<i class="bi bi-exclamation-octagon"></i>'
                    switchs = 1
                  }
                  $('.fecha_extra').html(data.vehiculo.vigencia_poliza_extracontractual).removeClass('btn btn-danger btn-sm').addClass(classExtra)
                  $('.dias_extra').html(data.vehiculo.poliza_extra_contractual+' '+iconExtra).removeClass('btn btn-danger btn-sm').addClass(classExtra)

                  var classPreventiva = 'btn btn-success btn-sm'
                  var iconPreventiva = '<i class="bi bi-calendar-check"></i>'
                  if(data.vehiculo.preventiva<1) {
                    classPreventiva = 'btn btn-danger btn-sm'
                    iconPreventiva = '<i class="bi bi-exclamation-octagon"></i>'
                    switchs = 1
                  }
                  $('.fecha_preventiva').html(data.vehiculo.vigencia_revision_preventiva).removeClass('btn btn-danger btn-sm').addClass(classPreventiva)
                  $('.dias_preventiva').html(data.vehiculo.preventiva+' '+iconPreventiva).removeClass('btn btn-danger btn-sm').addClass(classPreventiva)

                  if(switchs == 1) {
                    $('.veh_text').removeClass('visually-hidden').html('Documentos vencidos...')
                    $('#modal_documentacion_vehiculo').modal('show')
                  }else{
                    $('.veh_text').addClass('visually-hidden').html('')
                  }

                }else if(data.respuesta == false){

                  $('#operador').attr('disabled','disabled');

                }

              }
          });
        }
        
    });

    $('#operador').change(function () {

        var operador = $(this).val();

        if(operador==='0'){
            

        }else{

          $.ajax({
              method: 'post',
              url: 'operadoresdocs',
              data: {operador: operador, "_token": "{{ csrf_token() }}"},
              dataType: 'json',
              success: function (data) {

                if(data.respuesta == true){

                  //$('#operador').removeAttr('disabled');

                  var switchs = 0

                  var classLicencia = 'btn btn-success btn-sm'
                  var iconLicencia = '<i class="bi bi-calendar-check"></i>'
                  if(data.operador.licencia<1) {
                    classLicencia = 'btn btn-danger btn-sm'
                    iconLicencia = '<i class="bi bi-exclamation-octagon"></i>'
                    switchs = 1
                  }
                  $('.fecha_licencia').html(data.operador.vigencia_licencia).removeClass('btn btn-danger btn-sm').addClass(classLicencia)
                  $('.dias_licencia').html(data.operador.licencia+' '+iconLicencia).removeClass('btn btn-danger btn-sm').addClass(classLicencia)

                  var classSs = 'btn btn-success btn-sm'
                  var iconSs = '<i class="bi bi-calendar-check"></i>'
                  if(data.operador.seguridad_social<1) {
                    classSs = 'btn btn-danger btn-sm'
                    iconSs = '<i class="bi bi-exclamation-octagon"></i>'
                    switchs = 1
                  }
                  $('.fecha_ss').html(data.operador.vigencia_seguridad_social).removeClass('btn btn-danger btn-sm').addClass(classSs)
                  $('.dias_ss').html(data.operador.seguridad_social+' '+iconSs).removeClass('btn btn-danger btn-sm').addClass(classSs)

                  if(switchs == 1) {
                    $('.opr_text').removeClass('visually-hidden').html('Documentos vencidos...')
                    $('#modal_documentacion_operador').modal('show')
                  }else{
                    $('.opr_text').addClass('visually-hidden').html('')
                  }

                }else if(data.respuesta == false){

                  $('#operador').attr('disabled','disabled');

                }

              }
          });
        }
        
    });

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
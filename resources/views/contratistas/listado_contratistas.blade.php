<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Contratistas</title>
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

                      <h5>Gestión de Contratistas</h5>

                      <button type="button" class="btn btn-success nuevo_contratista">
                        Nuevo Contratista <i class="fs-5 bi-plus-circle"></i>
                      </button>

                    </form>

                    <form class="form-control" style="margin-top: 30px">
                        
                        <table class="table table-striped" id="propietarios">
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
                                        Vehículos
                                    </th>
                                    <th>
                                        Agregar
                                    </th>
                                    <th>
                                        Operadores
                                    </th>
                                    <th>
                                        Agregar
                                    </th>
                                    <th>
                                        Opciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $cont = 1; ?>
                                @foreach($contratistas as $contratista)
                                    <tr>
                                        <td>
                                            {{$cont}}
                                        </td>
                                        <td>
                                            {{$contratista->id}}
                                        </td>
                                        <td>
                                            {{$contratista->identificacion}}
                                        </td>
                                        <td>
                                            {{$contratista->nombre}}
                                        </td>
                                        <td>
                                            
                                            <?php
                                            
                                            $vehiculos = DB::table('vehiculos')
                                            ->select('id', 'placa', 'vigencia_tarjeta_operacion', 'vigencia_soat', 'vigencia_tecnomecanica', 'vigencia_poliza_contractual', 'vigencia_poliza_extracontractual', 'vigencia_revision_preventiva')
                                            ->where('fk_contratista', $contratista->id)
                                            ->get();

                                            ?>

                                            @foreach ($vehiculos as $vehiculo)
                                              
                                              <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                              data-bs-title="Tarj. Operación: {{$vehiculo->vigencia_tarjeta_operacion}}

                                              Soat: {{$vehiculo->vigencia_soat}}

                                              Tecnomecánica: {{$vehiculo->vigencia_tecnomecanica}}

                                              Póliza. Contract: {{$vehiculo->vigencia_poliza_contractual}}

                                              P. Extr. Contract: {{$vehiculo->vigencia_poliza_extracontractual}} 

                                              Preventiva: {{$vehiculo->vigencia_revision_preventiva}}">
                                                {{$vehiculo->placa}}
                                              </button>
                                            
                                            @endforeach
                                            
                                        </td>
                                        <td>
                                            <i data-id="{{$contratista->id}}" data-nombre="{{$contratista->nombre}}" class="fs-5 bi-plus-circle-fill nuevo_vehiculo" title="Nuevo vehículo"></i>
                                        </td>
                                        <td>
                                          <?php

                                            $operadores = DB::table('operadores')
                                            ->select('id', 'nombres', 'apellidos')
                                            ->where('fk_contratista', $contratista->id)
                                            ->get();

                                            ?>

                                            @foreach ($operadores as $operador)
                                              
                                              <button type="button" class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" 
                                              data-bs-title="Aquí se mostrará la documentación de operadores">
                                                {{$operador->nombres.' '.$operador->apellidos}}
                                              </button>
                                            
                                            @endforeach
                                        </td>
                                        <td>
                                            <i data-id="{{$contratista->id}}" data-nombre="{{$contratista->nombre}}" class="fs-5 bi-plus-circle-fill nuevo_operador" title="Nuevo Operador"></i>
                                        </td>
                                        <td>
                                            <i class="fs-5 bi-pencil-square"></i>
                                        </td>
                                    </tr>
                                    <?php $cont++; ?>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Modal -->
                        @include('contratistas.modales.nuevo_propietario')

                        @include('contratistas.modales.nuevo_propietario_ocasional')

                        @include('contratistas.modales.nuevo_operador')

                        @include('contratistas.modales.nuevo_vehiculo')

                    </form>
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

    $tabla_propietarios = $('#propietarios').DataTable( {
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
          { 'sWidth': '4%' },
          { 'sWidth': '5%' },
          { 'sWidth': '1%' },
          { 'sWidth': '8%' },
          { 'sWidth': '1%' },
          { 'sWidth': '1%' },
        ],
      });

    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

    $('#continuar').click(function() {

      const toastLiveExample = document.getElementById('message')
      const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)

      var identificacion = $('#identificacion').val();

      if(identificacion=='') {

        errorAlert('Campos Vacíos','* Debes ingresar el número de identificación')

      }else{

        $.ajax({
          url: 'consultarcontratista',
          method: 'post',
          data: {identificacion: identificacion, "_token": "{{ csrf_token() }}"}
        }).done(function(data){

          if(data.respuesta==true){

            $('.campos').removeClass('visually-hidden');
            $('#identificacion').attr('disabled', 'disabled');
            $('#continuar').addClass('visually-hidden');
            $('#guardar').removeClass('visually-hidden');

            $('#atras_contratista').removeClass('visually-hidden')

          }else if(data.respuesta==false) {

            errorAlert('Atención!', data.mensaje)

          }else if(data.respuesta=='logout') {
            
            logoutAlert('Sesión Caducada!',data.mensaje)

          }

        });

      }

    });

    $('#atras_contratista').click(function() {

      $('.campos').addClass('visually-hidden')
      $('#identificacion').removeAttr('disabled')
      $(this).addClass('visually-hidden')

      $('#guardar').addClass('visually-hidden')
      $('#continuar').removeClass('visually-hidden')

    });

    $('#guardar').click(function() { //Guardar contratista

      const toastLiveExample = document.getElementById('message')
      const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)

      var identificacion = $('#identificacion').val();

      var tipo_vinculacion = $('#tipo_vinculacion').val(); //df = 0
      var sede = $('#sede').val(); //df = 0
      var nombre = $('#nombre').val();
      var correo = $('#correo').val();
      var direccion = $('#direccion').val();
      var contacto = $('#contacto').val();
      var ciudad = $('#ciudad').val(); //df = 0
      var banco = $('#banco').val(); //df = 0
      var tipo_cuenta = $('#tipo_cuenta').val(); //df = 0
      var numero_cuenta = $('#numero_cuenta').val();

      //var certificado_pdf = $('#certificado_pdf1').val();
      
      var certificado_pdf = $('#certificado_pdf').val();
      var rut_pdf = $('#rut_pdf').val();
      var identificacion_pdf = $('#identificacion_pdf').val();

      if(tipo_vinculacion=='0' || sede=='0' || nombre=='' || correo=='' || !validateEmail(correo) || direccion=='' || contacto=='' || ciudad=='0' || banco=='0' || tipo_cuenta=='0' || numero_cuenta=='' || certificado_pdf=='' || rut_pdf=='' || identificacion_pdf=='') {
        
        var text = '';

        if(tipo_vinculacion=='0') {
          text +='Debes seleccionar el tipo de vinculación<br>'
        }
        if(sede=='0') {
          text +='Debes seleccionar la sede<br>'
        }
        if(nombre=='') {
          text +='Debes ingresar el nombre<br>'
        }
        if(correo=='') {
          text +='Debes ingresar el correo<br>'
        }
        if( !validateEmail(correo) ) {
          text +='Debes ingresar un correo válido<br>'
        }
        if(direccion=='') {
          text +='Debes ingresar la dirección<br>'
        }
        if(contacto=='') {
          text +='Debes ingresar el contacto<br>'
        }
        if(ciudad=='0') {
          text +='Debes seleccionar la ciudad<br>'
        }
        if(banco=='0') {
          text +='Debes seleccionar la entidad bancaria<br>'
        }
        if(tipo_cuenta=='0') {
          text +='Debes seleccionar el tipo de cuenta<br>'
        }
        if(numero_cuenta=='') {
          text +='Debes ingresar el número de cuenta<br>'
        }
        if(certificado_pdf=='') {
          text +='Debes adjuntar el certificado bancario<br>'
        }
        if(rut_pdf=='') {
          text +='Debes adjuntar el rut del contratista<br>'
        }
        if(identificacion_pdf=='') {
          text +='Debes adjuntar una copia de la cc<br>'
        }

        errorAlert('Campos vacíos!', text)

      }else{

        var certificado_pdf = $('#certificado_pdf').prop('files')[0];
        var identificacion_pdf = $('#identificacion_pdf').prop('files')[0];
        var rut_pdf = $('#rut_pdf').prop('files')[0];

        var formData = new FormData();

        formData.append('identificacion', identificacion);
        formData.append('tipo_vinculacion', tipo_vinculacion);
        formData.append('sede', sede);
        formData.append('nombre', nombre);
        formData.append('correo', correo);
        formData.append('direccion', direccion);
        formData.append('contacto', contacto);
        formData.append('ciudad', ciudad);
        formData.append('banco', banco);
        formData.append('tipo_cuenta', tipo_cuenta);
        formData.append('numero_cuenta', numero_cuenta);
        formData.append('certificado_pdf', certificado_pdf);
        formData.append('rut_pdf', rut_pdf);
        formData.append('identificacion_pdf', identificacion_pdf);
        formData.append("_token",  "{{ csrf_token() }}");

        $.ajax({
          url: 'contratistas/nuevocontratista',
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

    $('#guardar_ocasional').click(function() { //Guardar contratista ocasional

      const toastLiveExample = document.getElementById('message')
      const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)

      var identificacion = $('#identificacion_ocasional').val();

      var tipo_vinculacion = $('#tipo_vinculacion_ocasional').val(); //df = 0
      var sede = $('#sede_ocasional').val(); //df = 0
      var nombre = $('#nombre_ocasional').val();
      var correo = $('#correo_ocasional').val();
      var direccion = $('#direccion_ocasional').val();
      var contacto = $('#contacto_ocasional').val();
      var ciudad = $('#ciudad_ocasional').val(); //df = 0
      var placa = $('#placa_ocasional').val(); //df = 0
      var clase_vehiculo = $('#clase_vehiculo_ocasional').val(); //df = 0

      if(tipo_vinculacion=='0' || sede=='0' || nombre=='' || correo=='' || !validateEmail(correo) || direccion=='' || contacto=='' || ciudad=='0' || placa=='' || clase_vehiculo=='0') {
        
        var text = '';

        if(tipo_vinculacion=='0') {
          text +='Debes seleccionar el tipo de vinculación<br>'
        }
        if(sede=='0') {
          text +='Debes seleccionar la sede<br>'
        }
        if(nombre=='') {
          text +='Debes ingresar el nombre<br>'
        }
        if(correo=='') {
          text +='Debes ingresar el correo<br>'
        }
        if( !validateEmail(correo) ) {
          text +='Debes ingresar un correo válido<br>'
        }
        if(direccion=='') {
          text +='Debes ingresar la dirección<br>'
        }
        if(contacto=='') {
          text +='Debes ingresar el contacto<br>'
        }
        if(ciudad=='0') {
          text +='Debes seleccionar la ciudad<br>'
        }
        if(placa=='') {
          text +='Debes ingresar la placa<br>'
        }
        if(clase_vehiculo=='0') {
          text +='Debes seleccionar la clase del vehículo<br>'
        }

        errorAlert('Campos vacíos!', text)

      }else{

        var formData = new FormData();

        formData.append('identificacion', identificacion);
        formData.append('tipo_vinculacion', tipo_vinculacion);
        formData.append('sede', sede);
        formData.append('nombre', nombre);
        formData.append('correo', correo);
        formData.append('direccion', direccion);
        formData.append('contacto', contacto);
        formData.append('ciudad', ciudad);
        formData.append('placa', placa);
        formData.append('clase_vehiculo', clase_vehiculo);
        formData.append("_token",  "{{ csrf_token() }}");

        $.ajax({
          url: 'contratistas/nuevocontratistaocasional',
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

    $('#continuar_vehiculo').click(function() {

      var id = $(this).attr('data-contratista');

      //Parte1
      var placa = $('#placa').val();

      //Parte2
      var clase = $('#clase_vehiculo').val();
      var marca = $('#marca').val();
      var color = $('#color').val();
      var modelo = $('#modelo').val();
      var pasajeros = $('#pasajeros').val();
      var cilindraje = $('#cilindraje').val();
      var numero_motor = $('#numero_motor').val();
      var serie_motor = $('#serie_motor').val();
      var chasis = $('#chasis').val();
      var linea = $('#linea').val();
      var fecha_matricula = $('#fecha_matricula').val();
      var numero_matricula = $('#numero_matricula').val();
      var organismo_transito = $('#organismo_transito').val();
      var codigo_interno = $('#codigo_interno').val();
      var empresa_afiliada = $('#empresa_afiliada').val();

      //Parte3
      var vigencia_tarjeta_operacion = $('#fecha_vigencia_operacion').val();
      var numero_tarjeta_operacion = $('#numero_tarjeta_operacion').val();
      var tarjeta_operacion_pdf = $('#tarjeta_operacion_pdf').val();
      var fecha_vigencia_soat = $('#fecha_vigencia_soat').val();
      var numero_soat = $('#numero_soat').val();
      var aseguradora_soat = $('#aseguradora_soat').val();
      var soat_pdf = $('#soat_pdf').val();
      var fecha_poliza_contractual = $('#fecha_poliza_contractual').val();
      var numero_poliza_contractual = $('#numero_poliza_contractual').val();
      var aseguradora_poliza_contractual = $('#aseguradora_poliza_contractual').val();
      var poliza_contractual_pdf = $('#poliza_contractual_pdf').val();
      var fecha_poliza_extra_contractual = $('#fecha_poliza_extra_contractual').val();
      var numero_poliza_extra_contractual = $('#numero_poliza_extra_contractual').val();
      var aseguradora_poliza_extra_contractual = $('#aseguradora_poliza_extra_contractual').val();
      var poliza_extra_contractual_pdf = $('#poliza_extra_contractual_pdf').val();
      var fecha_tecnomecanica = $('#fecha_tecnomecanica').val();
      var fecha_preventiva = $('#fecha_preventiva').val();
      var preventiva_pdf = $('#preventiva_pdf').val();
      var tecnomecanica_pdf = $('#tecnomecanica_pdf').val();

      var sw = $(this).attr('data-sw');

      if( sw==1 ) { //paso 1 = placa

        if(placa=='') {
          errorAlert('Campos vacíos!', 'No has ingresado la placa')
        }else{

          $.ajax({
            url: 'vehiculos/consultarplaca',
            method: 'post',
            data: {placa: placa, "_token": "{{ csrf_token() }}"}
          }).done(function(data){

            if(data.respuesta==true){

              $('#continuar_vehiculo').attr('data-sw', 2)

              $('.campos_veh').removeClass('visually-hidden');
              $('#placa').attr('disabled', 'disabled');

              $('#atras_vehiculo').removeClass('visually-hidden')

            }else if(data.respuesta==false) {

              errorAlert('Atención!', data.mensaje)

            }else if(data.respuesta=='logout') {
              logoutAlert('Sesión Caducada!',data.mensaje)
            }

          });

        }

      }else if( sw==2 ){ //paso 2 = textos

        if( clase=='0' || marca=='0' || color=='' || modelo=='' || pasajeros=='' || cilindraje=='' || numero_motor=='' || serie_motor=='' || chasis=='' || linea=='' || fecha_matricula=='' || numero_matricula=='' || organismo_transito=='0' || codigo_interno=='' || empresa_afiliada=='' ) {

          var text = '';

          if(clase=='0') {
            text +='Debes seleccionar la clase<br>'
          }
          if(marca=='0') {
            text +='Debes seleccionar la marca<br>'
          }
          if(linea=='') {
            text +='Debes ingresar la línea<br>'
          }
          if(color=='') {
            text +='Debes ingresar el color<br>'
          }
          if(modelo=='') {
            text +='Debes ingresar el modelo<br>'
          }
          if(pasajeros=='') {
            text +='Debes ingresar la capacidad<br>'
          }
          if(cilindraje=='') {
            text +='Debes ingresar el cilindraje<br>'
          }
          if(numero_motor=='') {
            text +='Debes ingresar el número del motor<br>'
          }
          if(serie_motor=='') {
            text +='Debes ingresar la serie del motor<br>'
          }
          if(chasis=='') {
            text +='Debes ingresar el chasis<br>'
          }
          if(fecha_matricula=='') {
            text +='Debes ingresar la fecha de matrícula<br>'
          }
          if(numero_matricula=='') {
            text +='Debes ingresar el número de matrícula<br>'
          }
          if(organismo_transito=='0') {
            text +='Debes seleccionar el organismo de tránsito<br>'
          }
          if(codigo_interno=='') {
            text +='Debes ingresar el código interno<br>'
          }
          if(empresa_afiliada=='') {
            text +='Debes ingresar la empresa afiliadora<br>'
          }

          errorAlert('Campos vacíos!', text)

        }else{

          $('#continuar_vehiculo').attr('data-sw', 3)

          $('.campos_veh').addClass('visually-hidden')
          $('.docs').removeClass('visually-hidden')

        }

      }else if( sw==3 ) { // paso 3 = docs

        if( vigencia_tarjeta_operacion=='' || numero_tarjeta_operacion=='' || tarjeta_operacion_pdf=='' || fecha_vigencia_soat=='' || numero_soat=='' || aseguradora_soat=='0' || soat_pdf=='' || fecha_poliza_contractual=='' || numero_poliza_contractual=='' || aseguradora_poliza_contractual=='0' || poliza_contractual_pdf=='' || fecha_poliza_extra_contractual=='' || numero_poliza_extra_contractual=='' || aseguradora_poliza_extra_contractual=='0' || poliza_extra_contractual_pdf=='' || fecha_tecnomecanica=='' || fecha_preventiva=='' || (preventiva_pdf=='' && !$('#preventiva_pdf').hasClass('disabled')) || (tecnomecanica_pdf=='' && !$('#tecnomecanica_pdf').hasClass('disabled')) ) {

          var text = '';

          if(vigencia_tarjeta_operacion=='') {
            text += 'Debes seleccionar la fecha de tarjeta operación<br>'
          }
          if(numero_tarjeta_operacion=='') {
            text += 'Debes ingresar la tarjeta de operación<br>'
          }
          if(tarjeta_operacion_pdf=='') {
            text += 'Debes adjuntar la tarjeta operación<br>'
          }
          if(fecha_vigencia_soat=='') {
            text += 'Debes seleccionar la fecha de soat<br>'
          }
          if(numero_soat=='') {
            text += 'Debes ingresar el número de soat<br>'
          }
          if(aseguradora_soat=='0') {
            text += 'Debes selecionar la seguradora de soat<br>'
          }
          if(soat_pdf=='') {
            text += 'Debes adjuntar el Soat<br>'
          }
          if(fecha_poliza_contractual=='') {
            text += 'Debes seleccionar la fecha de la póliza contractual<br>'
          }
          if(numero_poliza_contractual=='') {
            text += 'Debes ingresar el número de póliza contractual<br>'
          }
          if(aseguradora_poliza_contractual=='0') {
            text += 'Debes seleccionar la aseguradora de la póliza contractual<br>'
          }
          if(poliza_contractual_pdf=='') {
            text += 'Debes adjuntar la póliza contractual<br>'
          }
          if(fecha_poliza_extra_contractual=='') {
            text += 'Debes ingresar la fecha de la póliza extra contractual<br>'
          }
          if(numero_poliza_extra_contractual=='') {
            text += 'Debes ingresar el número de la póliza extra contractual<br>'
          }
          if(aseguradora_poliza_extra_contractual=='0') {
            text += 'Debes seleccionar la aseguradora de la póliza extra contractual<br>'
          }
          if(poliza_extra_contractual_pdf=='') {
            text += 'Debes adjuntar la póliza extra contractual<br>'
          }
          if(fecha_tecnomecanica=='') {
            text += 'Debes seleccionar la fecha de la tecnomecánica<br>'
          }
          if(fecha_preventiva=='') {
            text += 'Debes seleccionar la fecha de la preventiva<br>'
          }
          if(preventiva_pdf=='' && !$('#preventiva_pdf').hasClass('disabled')) {
            text += 'Debes adjuntar la preventiva<br>'
          }
          if(tecnomecanica_pdf=='' && !$('#tecnomecanica_pdf').hasClass('disabled')) {
            text += 'Debes adjuntar la tecnomecánica<br>'
          }

          errorAlert('Campos vacíos!', text)

        }else{

          tarjeta_operacion_pdf = $('#tarjeta_operacion_pdf').prop('files')[0];
          soat_pdf = $('#soat_pdf').prop('files')[0];
          poliza_contractual_pdf = $('#poliza_contractual_pdf').prop('files')[0];
          poliza_extra_contractual_pdf = $('#poliza_extra_contractual_pdf').prop('files')[0];
          preventiva_pdf = $('#preventiva_pdf').prop('files')[0];
          tecnomecanica_pdf = $('#tecnomecanica_pdf').prop('files')[0];

          var formData = new FormData();

          formData.append('placa', placa);
          formData.append('clase', clase);
          formData.append('marca', marca);
          formData.append('color', color);
          formData.append('pasajeros', pasajeros);
          formData.append('cilindraje', cilindraje);
          formData.append('numero_motor', numero_motor);
          formData.append('serie_motor', serie_motor);
          formData.append('chasis', chasis);
          formData.append('linea', linea);
          formData.append('modelo', modelo);
          formData.append('fecha_matricula', fecha_matricula);
          formData.append('numero_matricula', numero_matricula);
          formData.append('organismo_transito', organismo_transito);
          formData.append('codigo_interno', codigo_interno);
          formData.append('empresa_afiliada', empresa_afiliada);
          formData.append('vigencia_tarjeta_operacion', vigencia_tarjeta_operacion);
          formData.append('numero_tarjeta_operacion', numero_tarjeta_operacion);
          formData.append('tarjeta_operacion_pdf', tarjeta_operacion_pdf);
          formData.append('fecha_vigencia_soat', fecha_vigencia_soat);
          formData.append('numero_soat', numero_soat);
          formData.append('aseguradora_soat', aseguradora_soat);
          formData.append('soat_pdf', soat_pdf);
          formData.append('fecha_poliza_contractual', fecha_poliza_contractual);
          formData.append('numero_poliza_contractual', numero_poliza_contractual);
          formData.append('aseguradora_poliza_contractual', aseguradora_poliza_contractual);
          formData.append('poliza_contractual_pdf', poliza_contractual_pdf);
          formData.append('fecha_poliza_extra_contractual', fecha_poliza_extra_contractual);
          formData.append('numero_poliza_extra_contractual', numero_poliza_extra_contractual);
          formData.append('aseguradora_poliza_extra_contractual', aseguradora_poliza_extra_contractual);
          formData.append('poliza_extra_contractual_pdf', poliza_extra_contractual_pdf);
          formData.append('fecha_tecnomecanica', fecha_tecnomecanica);
          formData.append('fecha_preventiva', fecha_preventiva);
          formData.append('preventiva_pdf', preventiva_pdf);
          formData.append('tecnomecanica_pdf', tecnomecanica_pdf);
          formData.append('id', id);
          formData.append("_token",  "{{ csrf_token() }}");

          $.ajax({
            url: 'vehiculos/crearvehiculo',
            method: 'post',
            data: formData,
            processData: false,
            contentType: false,
          }).done(function(data){

            if(data.respuesta==true){

              responseTrue('Realizado!',data.mensaje)

            }else if(data.respuesta==false) {

              errorAlert('Atención!', data.mensaje)

            }else if(data.respuesta=='logout') {
              
              logoutAlert('Sesión Caducada!',data.mensaje)

            }

          });

        }

      }

      /**/

    });

    $('#fecha_matricula').change(function() {

      var fechaString = $(this).val();
      var d = new Date(fechaString);
      var d2 = new Date(fechaString);

      d.setDate(d.getDate() + 61);  
      d2.setDate(d2.getDate() + 730);  

      var day = d.getDate();
      var month = d.getMonth() + 1;
      var year = d.getFullYear();
      if (day < 10) {
        day = "0" + day;
      }
      if (month < 10) {
        month = "0" + month;
      }
      var fecha_vigencia = year + "-" + month + "-" + day;

      //dos años
      var day = d2.getDate();
      var month = d2.getMonth() + 1;
      var year = d2.getFullYear();
      if (day < 10) {
        day = "0" + day;
      }
      if (month < 10) {
        month = "0" + month;
      }
      var fecha_vigencia_tecnomecanica = year + "-" + month + "-" + day;
      //dos años end

      var d = new Date();

      var curr_day = d.getDate();
      var curr_month = d.getMonth() + 1;
      var curr_year = d.getFullYear();

      if (curr_day < 10) {
        curr_day = "0" + curr_day;
      }
      if (curr_month < 10) {
        curr_month = "0" + curr_month;
      }

      var fecha_actual = curr_year + '-' + curr_month + '-' + curr_day;

      if(fecha_vigencia>=fecha_actual) {
        $('#fecha_preventiva').val(fecha_vigencia).attr('disabled', 'disabled')
        $('#preventiva_pdf').attr('disabled', 'disabled').addClass('disabled')
      }else{
        $('#fecha_preventiva').val('').removeAttr('disabled', 'disabled')
        $('#preventiva_pdf').removeAttr('disabled').removeClass('disabled')
      }

      if(fecha_vigencia_tecnomecanica>=fecha_actual) {
        $('#fecha_tecnomecanica').val(fecha_vigencia_tecnomecanica).attr('disabled', 'disabled')
        $('#tecnomecanica_pdf').attr('disabled', 'disabled').addClass('disabled')
      }else{
        $('#fecha_tecnomecanica').val('').removeAttr('disabled', 'disabled')
        $('#tecnomecanica_pdf').removeAttr('disabled').removeClass('disabled')
      }

    });

    $('#atras_vehiculo').click(function() {

      var sw = $('#continuar_vehiculo').attr('data-sw');

      if(sw==3) {
        
        $('#continuar_vehiculo').attr('data-sw',2);
        $('.campos_veh').removeClass('visually-hidden');
        $('.docs').addClass('visually-hidden');

        $('#continuar_vehiculo').html('Continuar <i class="bi bi-arrow-right-circle"></i>')

      }else if(sw==2) {
        
        $('#continuar_vehiculo').attr('data-sw',1).html('Continuar <i class="bi bi-arrow-right-circle"></i>');

        $(this).addClass('visually-hidden')

        $('#placa').removeAttr('disabled');

        $('.campos_veh').addClass('visually-hidden');
        $('.docs').addClass('visually-hidden');
      }

    });

    $('#continuar_operador').click(function() {

      var id = $(this).attr('data-contratista');

      //Parte1
      var identificacion = $('#identificacion_opr').val();

      //Parte2
      var nombre = $('#nombre_opr').val();
      var apellido = $('#apellido_opr').val();
      var correo = $('#correo_opr').val();
      var celular = $('#celular_opr').val();
      var fecha_nacimiento = $('#fecha_nacimiento_opr').val();
      var estado_civil = $('#estado_civil_opr').val();
      var genero = $('#genero_opr').val();
      var tipo_sangre = $('#tipo_sangre_opr').val();
      var hijos = $('#hijos_opr').val();
      var direccion = $('#direccion_opr').val();
      var ciudad = $('#ciudad_opr').val();
      var fecha_licencia = $('#fecha_licencia').val();
      var fecha_seguridad_social = $('#fecha_seguridad_social').val();

      //Parte3
      var eps_pdf = $('#eps_pdf').val();
      var arl_pdf = $('#arl_pdf').val();
      var pension_pdf = $('#pension_pdf').val();
      var compensacion_pdf = $('#compensacion_pdf').val();
      

      var sw = $(this).attr('data-sw');

      console.log(sw)

      if( sw==1 ) {

        if(identificacion=='') {
          errorAlert('Campos vacíos!', 'No has ingresado la identificación')
        }else{

          $.ajax({
            url: 'operadores/consultaroperador',
            method: 'post',
            data: {identificacion: identificacion, "_token": "{{ csrf_token() }}"}
          }).done(function(data){

            if(data.respuesta==true){

              $('#continuar_operador').attr('data-sw', 2)

              $('.campos_opr').removeClass('visually-hidden');
              $('#identificacion_opr').attr('disabled', 'disabled');

              $('#atras_operador').removeClass('visually-hidden');

            }else if(data.respuesta==false) {

              errorAlert('Atención!', data.mensaje)

            }else if(data.respuesta=='logout') {
              
              logoutAlert('Sesión Caducada!',data.mensaje)
            }

          });

        }

      }else if( sw==2 ) {
        
        if( nombre=='' || apellido=='' || correo=='' || !validateEmail(correo) || celular=='' || fecha_nacimiento=='' || estado_civil=='0' || genero=='0' || tipo_sangre=='0' || hijos=='0' || direccion=='' || ciudad=='0' || fecha_licencia=='' || fecha_seguridad_social=='') {

          var text = '';

          if(nombre=='') {
            text += 'Debes ingresar el nombre<br>';
          }
          if(apellido=='') {
            text += 'Debes ingresar el apellido<br>';
          }
          if(correo=='') {
            text += 'Debes ingresar el correo<br>';
          }
          if( !validateEmail(correo)) { 
            text += 'Debes ingresar un correo válido<br>';
          }
          if(celular=='') {
            text += 'Debes ingresar el celular<br>';
          }
          if(fecha_nacimiento=='') {
            text += 'Debes seleccionar la fecha de nacimiento<br>';
          }
          if(estado_civil=='0') {
            text += 'Debes seleccionar estado civil<br>';
          }
          if(genero=='0') {
            text += 'Debes seleccionar género<br>';
          }
          if(tipo_sangre=='0') {
            text += 'Debes ingresar tipo de sangre<br>';
          }
          if(hijos=='0') {
            text += 'Debes seleccionar la cantidad de hijos<br>';
          }
          if(direccion=='') {
            text += 'Debes ingresar la dirección<br>';
          }
          if(ciudad=='0') {
            text += 'Debes seleccionar la ciudad<br>';
          }
          if(fecha_licencia=='') {
            text += 'Debes seleccionar la vigencia de la licencia<br>';
          }
          if(fecha_seguridad_social=='') {
            text += 'Debes seleccionar la vigencia de la seguridad social<br>';
          }

          errorAlert('Campos vacíos!', text)

        }else{

          $('#continuar_operador').attr('data-sw', 3)

          $('.campos_opr').addClass('visually-hidden')
          $('.doc_opr').removeClass('visually-hidden')

          $('#continuar_operador').html('Guadrar Operador <i class="bi bi-cloud-arrow-up"></i>')

        }

      }else if( sw==3 ) {

        if(eps_pdf=='' || arl_pdf=='' || pension_pdf=='') {

          var text = '';

          if(eps_pdf=='') {
            text += 'Debes adjuntar la eps<br>';
          }
          if(arl_pdf=='') {
            text += 'Debes adjuntar la arl<br>';
          }
          if(pension_pdf=='') {
            text += 'Debes adjuntar el fondo de pensión y cesantías<br>';
          }

          errorAlert('Campos vacíos!', text)

        }else{

          compensacion_pdf = $('#compensacion_pdf').prop('files')[0];
          pension_pdf = $('#pension_pdf').prop('files')[0];
          arl_pdf = $('#arl_pdf').prop('files')[0];
          eps_pdf = $('#eps_pdf').prop('files')[0];

          var formData = new FormData();

          formData.append('identificacion', identificacion);
          formData.append('nombre', nombre);
          formData.append('apellido', apellido);
          formData.append('correo', correo);
          formData.append('celular', celular);
          formData.append('fecha_nacimiento', fecha_nacimiento);
          formData.append('estado_civil', estado_civil);
          formData.append('genero', genero);
          formData.append('tipo_sangre', tipo_sangre);
          formData.append('hijos', hijos);
          formData.append('direccion', direccion);
          formData.append('ciudad', ciudad);
          formData.append('fecha_licencia', fecha_licencia);
          formData.append('fecha_seguridad_social', fecha_seguridad_social);
          formData.append('eps_pdf', eps_pdf);
          formData.append('arl_pdf', arl_pdf);
          formData.append('pension_pdf', pension_pdf);
          formData.append('compensacion_pdf', compensacion_pdf);
          formData.append('id', id);
          formData.append("_token",  "{{ csrf_token() }}");

          $.ajax({
            url: 'operadores/crearoperador',
            method: 'post',
            data: formData,
            processData: false,
            contentType: false,
          }).done(function(data){

            if(data.respuesta==true){

              responseTrue('Realizado!',data.mensaje)

            }else if(data.respuesta==false) {

              errorAlert('Atención!', data.mensaje)

            }else if(data.respuesta=='logout') {
              
              logoutAlert('Sesión Caducada!',data.mensaje)

            }

          });

        }

      }

    });

    $('#atras_operador').click(function() {

      var sw = $('#continuar_operador').attr('data-sw');

      if(sw==3) {
        
        $('#continuar_operador').attr('data-sw',2);
        $('.campos_opr').removeClass('visually-hidden');
        $('.doc_opr').addClass('visually-hidden');

        $('#continuar_operador').html('Continuar <i class="bi bi-arrow-right-circle"></i>')

      }else if(sw==2) {
        
        $('#continuar_operador').attr('data-sw',1).html('Continuar <i class="bi bi-arrow-right-circle"></i>');

        $(this).addClass('visually-hidden')

        $('#identificacion_opr').removeAttr('disabled');

        $('.campos_opr').addClass('visually-hidden');
        $('.doc_opr').addClass('visually-hidden');
      }

    });

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

    //document.getElementById('certificado_pdf').addEventListener('change', handleFileSelect);

    $('.nuevo_operador').click(function() {
      
      var name = $(this).attr('data-nombre')
      var id = $(this).attr('data-id')

      $('.part2').html(name)
      $('#guardar_operador').attr('data-contratista', id)
      $('#continuar_operador').attr('data-contratista', id)

      $('#modal_nuevo_operador').modal('show');

    })

    $('.nuevo_vehiculo').click(function() {
      
      var name = $(this).attr('data-nombre')
      var id = $(this).attr('data-id')

      $('.part2').html(name)
      $('#guardar_vehiculo').attr('data-contratista', id)
      $('#continuar_vehiculo').attr('data-contratista', id)

      $('#modal_nuevo_vehiculo').modal('show');

    })

    $('.nuevo_contratista').click(function() {

      $('#modal_nuevo_contratista').modal('show');

    })

    $('#tipo_vinculacion').change(function() {

      var valor = $('#tipo_vinculacion option:selected').attr('data-codigo')
      var id = $('#tipo_vinculacion option:selected').val()
      
      if(valor=='OCASNL') {

        $('#identificacion_ocasional').val($('#identificacion').val()).attr('disabled', 'disabled')
        $('#tipo_vinculacion').val(0)
        $('#tipo_vinculacion_ocasional').val(id)

        $('#modal_nuevo_contratista').modal('hide');
        $('#modal_nuevo_contratista_ocasional').modal('show');

      }else if(valor!='0'){
        
      }

    });

    $('#tipo_vinculacion_ocasional').change(function() {

      var valor = $('#tipo_vinculacion_ocasional option:selected').attr('data-codigo')
      var id = $('#tipo_vinculacion_ocasional option:selected').val()
        
      if(valor!=undefined && valor!='OCASNL') {

        $('#identificacion_ocasional').val($('#identificacion').val())
        $('#tipo_vinculacion').val(id)
        $('#tipo_vinculacion_ocasional').val(0)

        $('#modal_nuevo_contratista_ocasional').modal('hide');
        $('#modal_nuevo_contratista').modal('show');

      }

    });

</script>
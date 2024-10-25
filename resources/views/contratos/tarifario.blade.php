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

                          <h5>Tarifario: {{$razonsocial}}</h5>

                        </form>

                        <form class="form-control" style="margin-top: 30px">
                            
                            <table class="table table-hover" id="tarifas">
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
                                        <th style="text-align: center;">
                                          Cliente SUV
                                        </th>
                                        <th style="text-align: center;">
                                          Cliente VAN
                                        </th>
                                        <th style="text-align: center;">
                                          Proveedor SUV
                                        </th>
                                        <th style="text-align: center;">
                                          Proveedor VAN
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $cont = 1; ?>
                                    @foreach($tarifas as $tarifa)
                                        <tr>
                                            <td>
                                              {{$cont}}
                                            </td>
                                            <td>
                                              {{$tarifa->id_trayecto}}
                                            </td>
                                            <td>
                                              {{$tarifa->nombre_trayecto}}
                                            </td>
                                            <td>
                                                
                                                @if($tarifa->valor_suv_cliente!=null)
                                                  
                                                  <center>
                                                    $ {{number_format($tarifa->valor_suv_cliente)}}
                                                  </center>

                                                @else

                                                  <center>
                                                    <i data-id="{{$tarifa->id_trayecto}}" data-cliente="{{$id}}" class="fs-5 bi-plus-circle-dotted nueva_tarifa"></i>
                                                  </center>
                                                  
                                                @endif

                                            </td>
                                            <td>
                                              
                                              @if($tarifa->valor_van_cliente!=null)
                                                  
                                                <center>
                                                  $ {{number_format($tarifa->valor_van_cliente)}}
                                                </center>

                                              @else

                                                <center>
                                                  <i data-id="{{$tarifa->id_trayecto}}" data-cliente="{{$id}}" class="fs-5 bi-plus-circle-dotted nueva_tarifa"></i>
                                                </center>
                                                
                                              @endif

                                            </td>
                                            <td>
                                              
                                              @if($tarifa->valor_suv_proveedor!=null)
                                                  
                                                <center>
                                                  $ {{number_format($tarifa->valor_suv_proveedor)}}
                                                </center>

                                              @else

                                                <center>
                                                  <i data-id="{{$tarifa->id_trayecto}}" data-cliente="{{$id}}" class="fs-5 bi-plus-circle-dotted nueva_tarifa"></i>
                                                </center>
                                                
                                              @endif

                                            </td>
                                            <td>
                                              
                                              @if($tarifa->valor_van_proveedor!=null)
                                                  
                                                <center>
                                                  $ {{number_format($tarifa->valor_van_proveedor)}}
                                                </center>

                                              @else

                                                <center>
                                                  <i data-id="{{$tarifa->id_trayecto}}" data-cliente="{{$id}}" class="fs-5 bi-plus-circle-dotted nueva_tarifa"></i>
                                                </center>
                                                
                                              @endif

                                            </td>
                                        </tr>
                                        <?php $cont++; ?>
                                    @endforeach
                                </tbody>
                            </table>

                        </form>

                    </div>
                    
                </div>
                
                <div class="modal fade" id="modal_nueva_tarifa" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="staticBackdropLabel">Nueva Tarifa</h1>
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
                                      <b class="etiqueta">Valor SUV cliente</b>
                                      <input id="suv_cliente" class="form-control form-control-md" type="number" placeholder="Escribe aquí" aria-label=".form-control-lg example">
                                    </div>
                                    <div class="col">
                                      <b class="etiqueta">Valor VAN cliente</b>
                                      <input id="van_cliente" class="form-control form-control-md" type="number" placeholder="Escribe aquí" aria-label=".form-control-lg example">
                                    </div>
                                    <div class="col">
                                      <b class="etiqueta">Valor SUV contratista</b>
                                      <input id="suv_contratista" class="form-control form-control-md" type="number" placeholder="Escribe aquí" aria-label=".form-control-lg example">
                                    </div>
                                    <div class="col">
                                      <b class="etiqueta">Valor VAN contratista</b>
                                      <input id="van_contratista" class="form-control form-control-md" type="number" placeholder="Escribe aquí" aria-label=".form-control-lg example">
                                    </div>
                                  </div>
                      
                              </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button id="guardar_tarifa" type="button" class="btn btn-success">Guardar <i class="bi bi-floppy2-fill"></i></button>
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
    
    $tabla_tarifas = $('#tarifas').DataTable( {
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
          { 'sWidth': '4%' },
          { 'sWidth': '2%' },
          { 'sWidth': '2%' },
          { 'sWidth': '2%' },
          { 'sWidth': '2%' },
        ],
    });














    $('.nueva_tarifa').click(function() {

      var id = $(this).attr('data-id')
      var cliente = $(this).attr('data-cliente')

      $('#guardar_tarifa').attr('data-id', id)
      $('#guardar_tarifa').attr('data-cliente', cliente)
      $('#modal_nueva_tarifa').modal('show');

    })

    $('#guardar_tarifa').click(function() {

      var id = $(this).attr('data-id')
      var cliente = $(this).attr('data-cliente')
      var suv_cliente = $('#suv_cliente').val()
      var van_cliente = $('#van_cliente').val()
      var suv_contratista = $('#suv_contratista').val()
      var van_contratista = $('#van_contratista').val()

      if(suv_cliente=='' && van_cliente=='' && suv_contratista=='' && van_contratista=='') {

        var text = ''

        if(suv_cliente=='') {
          text += 'Debes ingresar alguno de los valores<br>'
        }

        errorAlert('Hay campos vacíos!', text)

      }else{

        $.ajax({
          url: '../../tarifas/nuevatarifa',
          method: 'post',
          data: {id: id, suv_cliente: suv_cliente, van_cliente: van_cliente, suv_contratista: suv_contratista, van_contratista: van_contratista, fk_cliente: cliente, "_token": "{{ csrf_token() }}"}
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

    $('#suv_cliente').keyup(function() {
      
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

    function number_format(number, decimals, dec_point, thousands_sep) {

      number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
      var n = !isFinite(+number) ? 0 : +number,
      prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
      sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
      dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
      s = '',
      toFixedFix = function(n, prec) {
        var k = Math.pow(10, prec);
        return '' + (Math.round(n * k) / k)
          .toFixed(prec);
      };
      // Fix for IE parseFloat(0.55).toFixed(0) = 0;
      s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
      if (s[0].length > 3) {
           s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
      }
      if ((s[1] || '')
          .length < prec) {
          s[1] = s[1] || '';
          s[1] += new Array(prec - s[1].length + 1).join('0');
      }
      return s.join(dec);
    }

</script>
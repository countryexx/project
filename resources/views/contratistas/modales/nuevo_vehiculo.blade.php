<!-- Modal -->
<div class="modal fade" id="modal_nuevo_vehiculo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Nuevo Vehículo - <span class="part2"></span></h1>
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
              <div class="row align-items-start">
                <div class="col-lg-2">
                  <b class="etiqueta">Placa</b>
                    <input id="placa" class="form-control form-control-md" type="text" placeholder="Escribe aquí" aria-label=".form-control-lg example">
                </div>
              </div>
              <div class="campos_veh visually-hidden">
              
                <div class="row align-items-start" style="margin-top: 30px">
                  <div class="col">
                    <b class="etiqueta">Clase de Vehículo</b>
                      <select class="form-select" aria-label="Default select example" id="clase_vehiculo">
                          <option value="0" selected>Seleccionar</option>
                          @foreach($tiposv as $tipo)
                            <option value="{{$tipo->id}}">{{$tipo->nombre}}</option>
                          @endforeach
                      </select>
                    
                  </div>
                  <div class="col">
                    <b class="etiqueta">Marca</b>
                    <select class="form-select" aria-label="Default select example" id="marca">
                      <option value="0" selected>Seleccionar</option>
                      @foreach($marcas as $marca)
                        <option value="{{$marca->id}}">{{$marca->nombre}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col">
                    <b class="etiqueta">Línea</b>
                    <input id="linea" class="form-control form-control-md" type="text" placeholder="Escribe aquí" aria-label=".form-control-lg example">
                  </div>
                  <div class="col">
                    <b class="etiqueta">Color</b>
                    <input id="color" class="form-control form-control-md" type="text" placeholder="Escribe aquí" aria-label=".form-control-lg example">
                  </div>
                  
                  <div class="col">
                    <b class="etiqueta">Modelo</b>
                    <input id="modelo" class="form-control form-control-md" type="number" placeholder="Escribe aquí" aria-label=".form-control-lg example">
                  </div>
                  
                </div>
                <div class="row align-items-center" style="margin-top: 30px">
                  <div class="col">
                    <b class="etiqueta">Cantidad Pasajeros</b>
                    <input id="pasajeros" class="form-control form-control-md" type="number" placeholder="Escribe aquí" aria-label=".form-control-lg example">
                  </div>
                  <div class="col">
                    <b class="etiqueta">Cilindraje</b>
                    <input id="cilindraje" class="form-control form-control-md" type="text" placeholder="Escribe aquí" aria-label=".form-control-lg example">
                  </div>
                  <div class="col">
                    <b class="etiqueta">Número motor</b>
                    <input id="numero_motor" class="form-control form-control-md" type="text" placeholder="Escribe aquí" aria-label=".form-control-lg example">
                  </div>
                  <div class="col">
                    <b class="etiqueta">Serie motor</b>
                    <input id="serie_motor" class="form-control form-control-md" type="text" placeholder="Escribe aquí" aria-label=".form-control-lg example">
                  </div>
                  <div class="col">
                    <b class="etiqueta">Chasis</b>
                    <input id="chasis" class="form-control form-control-md" type="text" placeholder="Escribe aquí" aria-label=".form-control-lg example">
                  </div>
                  
                </div>
                <div class="row align-items-end" style="margin-top: 30px">
                  <div class="col">
                    <b class="etiqueta">Fecha Matrícula</b>
                    <div class='input-group date' id='datetime_fecha'>
                      <input type="text" id="fecha_matricula" size="30" autocomplete="off">
                      <span class="input-group-addon">
                          <span class="fa fa-calendar">
                          </span>
                      </span>
                    </div>
                  </div>
                  <div class="col">
                    <b class="etiqueta">Número matrícula</b>
                    <input id="numero_matricula" class="form-control form-control-md" type="number" placeholder="Escribe aquí" aria-label=".form-control-lg example">
                  </div>
                  <div class="col">
                    <b class="etiqueta">Organismo de tránsito</b>
                    <select class="form-select" aria-label="Default select example" id="organismo_transito">
                      <option value="0" selected>Seleccionar</option>
                      @foreach($organismos as $organismo)
                        <option value="{{$organismo->id}}">{{$organismo->nombre}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col">
                    <b class="etiqueta">Código Interno</b>
                    <input id="codigo_interno" class="form-control form-control-md" type="number" placeholder="Escribe aquí" aria-label=".form-control-lg example">
                  </div>
                  <div class="col">
                    <b class="etiqueta">Empresa Afiliada</b>
                    <input id="empresa_afiliada" class="form-control form-control-md" type="text" placeholder="Escribe aquí" aria-label=".form-control-lg example">
                  </div>
                </div>
                
              </div>

              <div class="docs visually-hidden">
                
                <div class="row align-items-end" style="margin-top: 30px">

                  <div class="col">
                    <b class="etiqueta">Vig. Tarjeta operación</b>
                    <div class='input-group date' id='datetime_fecha'>
                      <input type="text" id="fecha_vigencia_operacion" size="30" autocomplete="off">
                      <span class="input-group-addon">
                          <span class="fa fa-calendar">
                          </span>
                      </span>
                    </div>
                  </div>
                  <div class="col">
                    <b class="etiqueta">Núm. tarjeta operación</b>
                    <input id="numero_tarjeta_operacion" class="form-control form-control-md" type="text" placeholder="Escribe aquí" aria-label=".form-control-lg example">
                  </div>

                  <div class="col">
                    <b class="etiqueta">PDF Tarjeta Operación</b>
                    <input type="file" class="form-control" id="tarjeta_operacion_pdf">
                  </div>

                </div>

                <div class="row align-items-end" style="margin-top: 30px">
                  <div class="col">
                    <b class="etiqueta">Vig. Soat</b>
                    <div class='input-group date' id='datetime_fecha'>
                      <input type="text" id="fecha_vigencia_soat" size="30" autocomplete="off">
                      <span class="input-group-addon">
                          <span class="fa fa-calendar">
                          </span>
                      </span>
                    </div>
                  </div>
                  <div class="col">
                    <b class="etiqueta">Núm. Soat</b>
                    <input id="numero_soat" class="form-control form-control-md" type="text" placeholder="Escribe aquí" aria-label=".form-control-lg example">
                  </div>
                  <div class="col">
                    <b class="etiqueta">Aseg. Soat</b>
                    <select class="form-select" aria-label="Default select example" id="aseguradora_soat">
                      <option value="0" selected>Seleccionar</option>
                      @foreach($seguros as $seguro)
                        <option value="{{$seguro->id}}">{{$seguro->nombre}}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="col">
                    <b class="etiqueta">PDF Soat</b>
                    <input type="file" class="form-control" id="soat_pdf">
                  </div>
                </div>

                <div class="row align-items-end" style="margin-top: 30px">
                  <div class="col">
                    <b class="etiqueta">Vig. Poliza Contractual</b>
                    <div class='input-group date' id='datetime_fecha'>
                      <input type="text" id="fecha_poliza_contractual" size="30" autocomplete="off">
                      <span class="input-group-addon">
                          <span class="fa fa-calendar">
                          </span>
                      </span>
                    </div>
                  </div>
                  <div class="col">
                    <b class="etiqueta">Núm. Poliza Contractual</b>
                    <input id="numero_poliza_contractual" class="form-control form-control-md" type="text" placeholder="Escribe aquí" aria-label=".form-control-lg example">
                  </div>
                  <div class="col">
                    <b class="etiqueta">Aseg. Poliza Contractual</b>
                    <select class="form-select" aria-label="Default select example" id="aseguradora_poliza_contractual">
                      <option value="0" selected>Seleccionar</option>
                      @foreach($seguros as $seguro)
                        <option value="{{$seguro->id}}">{{$seguro->nombre}}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="col">
                    <b class="etiqueta">PDF Póliza Contractual</b>
                    <input type="file" class="form-control" id="poliza_contractual_pdf">
                  </div>
                </div>

                <div class="row align-items-end" style="margin-top: 30px">
                  <div class="col">
                    <b class="etiqueta">Vig. Poliza Extra-Contractual</b>
                    <div class='input-group date' id='datetime_fecha'>
                      <input type="text" id="fecha_poliza_extra_contractual" size="30" autocomplete="off">
                      <span class="input-group-addon">
                          <span class="fa fa-calendar">
                          </span>
                      </span>
                    </div>
                  </div>
                  <div class="col">
                    <b class="etiqueta">Núm. Poliza Extra-Contractual</b>
                    <input id="numero_poliza_extra_contractual" class="form-control form-control-md" type="text" placeholder="Escribe aquí" aria-label=".form-control-lg example">
                  </div>
                  <div class="col">
                    <b class="etiqueta">Aseg. Poliza Extra-Contractual</b>
                    <select class="form-select" aria-label="Default select example" id="aseguradora_poliza_extra_contractual">
                      <option value="0" selected>Seleccionar</option>
                      @foreach($seguros as $seguro)
                        <option value="{{$seguro->id}}">{{$seguro->nombre}}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="col">
                    <b class="etiqueta">PDF Póliza Extra-Contractual</b>
                    <input type="file" class="form-control" id="poliza_extra_contractual_pdf">
                  </div>
                </div>

                <div class="row align-items-end" style="margin-top: 30px">
                  <div class="col">
                    <b class="etiqueta">Vig. Tecnomecánica</b>
                      <input type="text" id="fecha_tecnomecanica" size="30" autocomplete="off">
                  </div>
                  <div class="col">
                    <b class="etiqueta">PDF Tecnomecánica</b>
                    <input type="file" class="form-control" id="tecnomecanica_pdf">
                  </div>
                  <div class="col">
                    <b class="etiqueta">Vig. Preventiva</b>
                    <div class='input-group date' id='datetime_fecha'>
                      <input type="text" id="fecha_preventiva" size="30" autocomplete="off">
                    </div>
                  </div>
                  <div class="col">
                    <b class="etiqueta">PDF Preventiva</b>
                    <input type="file" class="form-control" id="preventiva_pdf">
                  </div>

                </div>

              </div>
            </div>
        </div>
        
      </div>
      <div class="modal-footer">
        <button data-sw="1"  id="atras_vehiculo" type="button" class="btn btn-danger visually-hidden">Atrás <i class="bi bi-arrow-left-circle"></i></button>
        <button data-sw="1" id="continuar_vehiculo" type="button" class="btn btn-primary">Continuar <i class="bi bi-arrow-right-circle"></i></button>
      </div>
    </div>
  </div>
</div>
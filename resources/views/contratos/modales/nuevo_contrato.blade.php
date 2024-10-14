<div class="modal fade" id="modal_nuevo_contrato" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Nuevo Contrato</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

        </div>
        <div class="modal-body">
          
          <div class="form-control">
            <div class="container text-center">
              <div class="row align-items-start">
                <div class="col-lg-3">
                  <b class="etiqueta">Nit</b>
                    <input id="nit" class="form-control form-control-md" type="number" placeholder="Escribe aquí" aria-label=".form-control-lg example">
                </div>
              </div>
              <div class="campos visually-hidden">
              
                <div class="row align-items-start" style="margin-top: 30px">

                  <div class="col">
                    <b class="etiqueta">Razón Social</b>
                    <input id="razon_social" class="form-control form-control-md" type="text" placeholder="Escribe aquí" aria-label=".form-control-lg example">
                  </div>

                  <div class="col">
                    <b class="etiqueta">Tipo de Empresa</b>
                    <select class="form-select" aria-label="Default select example" id="tipo_de_empresa">
                        <option value="0" selected>Seleccionar</option>
                        @foreach($empresas as $empresa)
                          <option value="{{$empresa->id}}">{{$empresa->nombre}}</option>
                        @endforeach
                    </select>
                  </div>
                  
                  <div class="col">
                    <b class="etiqueta">Dirección</b>
                    <input id="direccion" class="form-control form-control-md" type="text" placeholder="Escribe aquí" aria-label=".form-control-lg example">
                  </div>

                  <div class="col">
                    <b class="etiqueta">Teléfono</b>
                    <input id="telefono" class="form-control form-control-md" type="number" placeholder="Escribe aquí" aria-label=".form-control-lg example">
                  </div>
                  
                </div>
                <div class="row align-items-center" style="margin-top: 30px">
                  
                  <div class="col">
                    <b class="etiqueta">Objeto del Contrato</b>
                    <select class="form-select" aria-label="Default select example" id="objeto_contrato">
                        <option value="0" selected>Seleccionar</option>
                        @foreach($objeto_contratos as $objeto)
                          <option value="{{$objeto->id}}">{{$objeto->nombre}}</option>
                        @endforeach
                    </select>
                  </div>

                  <div class="col">
                    <b class="etiqueta">Ciudad</b>
                    <select class="form-select" aria-label="Default select example" id="ciudad">
                          <option value="0" selected>Ciudad</option>
                          @foreach($ciudades as $ciudad)
                            <option value="{{$ciudad->id}}">{{$ciudad->nombre}} - {{$ciudad->nombre_departamento}}</option>
                          @endforeach
                      </select>
                  </div>

                  <div class="col">
                    <b class="etiqueta">Fecha Inicio</b>
                    <div class='input-group date' id='datetime_fecha'>
                      <input type="text" id="fecha_inicio" size="30" autocomplete="off">
                      <span class="input-group-addon">
                          <span class="fa fa-calendar">
                          </span>
                      </span>
                    </div>
                  </div>

                  <div class="col">
                    <b class="etiqueta">Fecha Vencimiento</b>
                    <div class='input-group date' id='datetime_fecha'>
                      <input type="text" id="fecha_vencimiento" size="30" autocomplete="off">
                      <span class="input-group-addon">
                          <span class="fa fa-calendar">
                          </span>
                      </span>
                    </div>
                  </div>
                  
                </div>
                <div class="row align-items-end" style="margin-top: 30px">
                  
                  <div class="col">
                    <b class="etiqueta">Nombre Responsable</b>
                    <input id="nombre_responsable" class="form-control form-control-md" type="email" placeholder="Escribe aquí" aria-label=".form-control-lg example">
                  </div>

                  <div class="col">
                    <b class="etiqueta">Identificación Responsable</b>
                    <input id="identificacion_responsable" class="form-control form-control-md" type="number" placeholder="Escribe aquí" aria-label=".form-control-lg example">
                  </div>

                  <div class="col">
                    <b class="etiqueta">Teléfono Responsable</b>
                    <input id="telefono_responsable" class="form-control form-control-md" type="number" placeholder="Escribe aquí" aria-label=".form-control-lg example">
                  </div>

                  <div class="col">
                    <b class="etiqueta">Dirección Responsable</b>
                    <input id="direccion_responsable" class="form-control form-control-md" type="text" placeholder="Escribe aquí" aria-label=".form-control-lg example">
                  </div>

                </div>

                <div class="row align-items-end" style="margin-top: 30px">
                  
                  <div class="col">
                    <b class="etiqueta">Sede</b>
                      <select class="form-select" aria-label="Default select example" id="sede">
                          <option value="0" selected>Seleccionar</option>
                          @foreach($sedes as $sede)
                            <option value="{{$sede->id}}">{{$sede->nombre}}</option>
                          @endforeach
                      </select>
                  </div>

                  <div class="col">
                    <b class="etiqueta">Nombre Encargado</b>
                    <input id="nombre_encargado" class="form-control form-control-md" type="email" placeholder="Escribe aquí" aria-label=".form-control-lg example">
                  </div>

                  <div class="col">
                    <b class="etiqueta">Teléfono Encargado</b>
                    <input id="telefono_encargado" class="form-control form-control-md" type="number" placeholder="Escribe aquí" aria-label=".form-control-lg example">
                  </div>

                  <div class="col">
                    <b class="etiqueta">Correo Encargado</b>
                    <input id="correo_encargado" class="form-control form-control-md" type="text" placeholder="Escribe aquí" aria-label=".form-control-lg example">
                  </div>

                </div>

                <div class="row align-items-end" style="margin-top: 30px">
                  
                  <div class="col">
                    <b class="etiqueta">Titular Facturación</b>
                    <input id="titular_facturacion" class="form-control form-control-md" type="email" placeholder="Escribe aquí" aria-label=".form-control-lg example">
                  </div>

                  <div class="col">
                    <b class="etiqueta">Correo Facturación</b>
                    <input id="correo_facturacion" class="form-control form-control-md" type="text" placeholder="Escribe aquí" aria-label=".form-control-lg example">
                  </div>

                  <div class="col">
                    <b class="etiqueta">Cámara de Comercio</b>
                      <input type="file" class="form-control" id="camara_comercio_pdf">
                  </div>

                  <div class="col">
                    <b class="etiqueta">Rut</b>
                      <input type="file" class="form-control" id="rut_pdf">
                  </div>

                </div>

              </div>

              <div class="row align-items-end" style="margin-top: 30px">
                <div id="message" class="toast align-items-center text-white bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
                  <div class="d-flex">
                    <div class="toast-body">
                      <span class="cuerpo">
                        
                      </span>
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                  </div>
                </div>
              </div>

            </div>
          </div>
          
        </div>
        <div class="modal-footer">
          <button data-sw="1"  id="atras_contrato" type="button" class="btn btn-danger visually-hidden">Atrás <i class="bi bi-arrow-left-circle"></i></button>
          <button id="continuar" type="button" class="btn btn-primary">Continuar <i class="bi bi-arrow-right-circle"></i></button>
          <button id="guardar" type="button" class="btn btn-success visually-hidden">Guardar Contrato <i class="bi bi-floppy2-fill"></i></button>
        </div>
      </div>
    </div>
  </div>
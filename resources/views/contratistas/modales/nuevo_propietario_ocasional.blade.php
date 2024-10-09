<div class="modal fade" id="modal_nuevo_contratista_ocasional" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Nuevo Contratista Ocasional</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

        </div>
        <div class="modal-body">
          
          <div class="form-control">
            <div class="container text-center">
              <div class="row align-items-start">
                <div class="col-lg-3">
                  <b class="etiqueta"># de identificación</b>
                    <input id="identificacion_ocasional" class="form-control form-control-md" type="number" placeholder="Escribe aquí" aria-label=".form-control-lg example">
                </div>
              </div>
              <div class="campos visually-hidden">
              
                <div class="row align-items-start" style="margin-top: 30px">
                  <div class="col">
                    <b class="etiqueta">Tipo de Vinculación</b>
                      <select class="form-select" aria-label="Default select example" id="tipo_vinculacion_ocasional">
                          <option value="0" selected>Tipo Vinculación</option>
                          @foreach($tipos as $tipo)
                            <option data-codigo="{{$tipo->nombre_corto}}" value="{{$tipo->id}}">{{$tipo->nombre}}</option>
                          @endforeach
                      </select>
                    
                  </div>
                  <div class="col">
                    <b class="etiqueta">Sede</b>
                      <select class="form-select" aria-label="Default select example" id="sede_ocasional">
                          <option value="0" selected>Sede</option>
                          @foreach($sedes as $sede)
                            <option value="{{$sede->id}}">{{$sede->nombre}}</option>
                          @endforeach
                      </select>
                  </div>
                  
                  <div class="col">
                    <b class="etiqueta">Nombre del Contratista</b>
                    <input id="nombre_ocasional" class="form-control form-control-md" type="text" placeholder="Escribe aquí" aria-label=".form-control-lg example">
                  </div>
                </div>
                <div class="row align-items-center" style="margin-top: 30px">
                  <div class="col">
                    <b class="etiqueta">Correo</b>
                    <input id="correo_ocasional" class="form-control form-control-md" type="email" placeholder="Escribe aquí" aria-label=".form-control-lg example">
                  </div>
                  <div class="col">
                    <b class="etiqueta">Dirección</b>
                    <input id="direccion_ocasional" class="form-control form-control-md" type="text" placeholder="Escribe aquí" aria-label=".form-control-lg example">
                  </div>
                  <div class="col">
                    <b class="etiqueta">Contacto</b>
                    <input id="contacto_ocasional" class="form-control form-control-md" type="number" placeholder="Escribe aquí" aria-label=".form-control-lg example">
                  </div>
                  <div class="col">
                    <b class="etiqueta">Ciudad</b>
                    <select class="form-select" aria-label="Default select example" id="ciudad_ocasional">
                          <option value="0" selected>Ciudad</option>
                          @foreach($ciudades as $ciudad)
                            <option value="{{$ciudad->id}}">{{$ciudad->nombre}} - {{$ciudad->nombre_departamento}}</option>
                          @endforeach
                      </select>
                  </div>
                </div>
                <div class="row align-items-end" style="margin-top: 30px">
                  <div class="col">
                    <b class="etiqueta">Clase de Vehículo</b>
                    <select class="form-select" aria-label="Default select example" id="clase_vehiculo_ocasional">
                          <option value="0" selected>Seleccionar</option>
                          @foreach($tiposv as $veh)
                            <option value="{{$veh->id}}">{{$veh->nombre}}</option>
                          @endforeach
                      </select>
                  </div>
                  <div class="col">
                    <b class="etiqueta">Placa</b>
                      <input id="placa_ocasional" class="form-control form-control-md" type="text" placeholder="Escribe aquí" aria-label=".form-control-lg example">
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
          <button data-sw="1"  id="atras_contratista_ocasional" type="button" class="btn btn-danger visually-hidden">Atrás <i class="bi bi-arrow-left-circle"></i></button>
          <!--<button id="continuar_ocasional" type="button" class="btn btn-primary">Continuar <i class="bi bi-arrow-right-circle"></i></button>-->
          <button id="guardar_ocasional" type="button" class="btn btn-success">Guardar Contratista Ocasional <i class="bi bi-floppy2-fill"></i></button>
        </div>
      </div>
    </div>
  </div>
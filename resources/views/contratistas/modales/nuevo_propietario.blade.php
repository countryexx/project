<div class="modal fade" id="modal_nuevo_contratista" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Nuevo Contratista</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

        </div>
        <div class="modal-body">
          
          <div class="form-control">
            <div class="container text-center">
              <div class="row align-items-start">
                <div class="col-lg-3">
                  <b class="etiqueta"># de identificación</b>
                    <input id="identificacion" class="form-control form-control-md" type="number" placeholder="Escribe la identificación" aria-label=".form-control-lg example">
                </div>
              </div>
              <div class="campos visually-hidden">
              
                <div class="row align-items-start" style="margin-top: 30px">
                  <div class="col">
                    <b class="etiqueta">Tipo de Vinculación</b>
                      <select class="form-select" aria-label="Default select example" id="tipo_vinculacion">
                          <option value="0" selected>Tipo Vinculación</option>
                          @foreach($tipos as $tipo)
                            <option data-codigo="{{$tipo->nombre_corto}}" value="{{$tipo->id}}">{{$tipo->nombre}}</option>
                          @endforeach
                      </select>
                    
                  </div>
                  <div class="col">
                    <b class="etiqueta">Sede</b>
                      <select class="form-select" aria-label="Default select example" id="sede">
                          <option value="0" selected>Sede</option>
                          @foreach($sedes as $sede)
                            <option value="{{$sede->id}}">{{$sede->nombre}}</option>
                          @endforeach
                      </select>
                  </div>
                  
                  <div class="col">
                    <b class="etiqueta">Nombre del Contratista</b>
                    <input id="nombre" class="form-control form-control-md" type="text" placeholder="Escribe el nombre" aria-label=".form-control-lg example">
                  </div>
                </div>
                <div class="row align-items-center" style="margin-top: 30px">
                  <div class="col">
                    <b class="etiqueta">Correo</b>
                    <input id="correo" class="form-control form-control-md" type="email" placeholder="Escribe el correo" aria-label=".form-control-lg example">
                  </div>
                  <div class="col">
                    <b class="etiqueta">Dirección</b>
                    <input id="direccion" class="form-control form-control-md" type="text" placeholder="Escribe la dirección" aria-label=".form-control-lg example">
                  </div>
                  <div class="col">
                    <b class="etiqueta">Contacto</b>
                    <input id="contacto" class="form-control form-control-md" type="number" placeholder="Escribe el contacto" aria-label=".form-control-lg example">
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
                </div>
                <div class="row align-items-end" style="margin-top: 30px">
                  <div class="col">
                    <b class="etiqueta">Entidad Bancaria</b>
                    <select class="form-select" aria-label="Default select example" id="banco">
                          <option value="0" selected>Banco</option>
                          @foreach($bancos as $banco)
                            <option value="{{$banco->id}}">{{$banco->nombre}}</option>
                          @endforeach
                      </select>
                  </div>
                  <div class="col">
                    <b class="etiqueta">Tipo de Cuenta</b>
                    <select class="form-select" aria-label="Default select example" id="tipo_cuenta">
                          <option value="0" selected>Tipo de Cuenta</option>
                          @foreach($tipos_cuenta as $tipo)
                            <option value="{{$tipo->id}}">{{$tipo->nombre}}</option>
                          @endforeach
                      </select>
                  </div>
                  <div class="col">
                    <b class="etiqueta">Número de Cuenta</b>
                      <input id="numero_cuenta" class="form-control form-control-md" type="number" placeholder="Escribe # de cuenta" aria-label=".form-control-lg example">
                  </div>
                </div>

                <!-- Files -->
                <div class="row align-items-end" style="margin-top: 30px">
                  <div class="col">
                    <b class="etiqueta">Certificado Bancario</b>
                      <input type="file" class="form-control" id="certificado_pdf">
                  </div>
                  <div class="col">
                    <b class="etiqueta">Rut</b>
                      <input type="file" class="form-control" id="rut_pdf">
                  </div>
                  <div class="col">
                    <b class="etiqueta">Copia de cc</b>
                      <input type="file" class="form-control" id="identificacion_pdf">
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
          <button data-sw="1"  id="atras_contratista" type="button" class="btn btn-danger visually-hidden">Atrás <i class="bi bi-arrow-left-circle"></i></button>
          <button id="continuar" type="button" class="btn btn-primary">Continuar <i class="bi bi-arrow-right-circle"></i></button>
          <button id="guardar" type="button" class="btn btn-success visually-hidden">Guardar Contratista <i class="bi bi-floppy2-fill"></i></button>
        </div>
      </div>
    </div>
  </div>
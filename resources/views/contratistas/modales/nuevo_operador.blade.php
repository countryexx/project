<!-- Modal -->
<div class="modal fade" id="modal_nuevo_operador" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Nuevo Operador - <span class="part2"></span></h1>
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
                <div class="col-lg-3">
                  <b class="etiqueta"># de identificación</b>
                    <input id="identificacion_opr" class="form-control form-control-md" type="number" placeholder="Escribe aquí" aria-label=".form-control-lg example">
                </div>
              </div>
              <div class="campos_opr visually-hidden">
              
                <div class="row align-items-start" style="margin-top: 30px">
                  
                  <div class="col">
                    <b class="etiqueta">Nombre</b>
                    <input id="nombre_opr" class="form-control form-control-md" type="text" placeholder="Escribe aquí" aria-label=".form-control-lg example">
                  </div>
                  <div class="col">
                    <b class="etiqueta">Apellido</b>
                    <input id="apellido_opr" class="form-control form-control-md" type="text" placeholder="Escribe aquí" aria-label=".form-control-lg example">
                  </div>

                  <div class="col">
                    <b class="etiqueta">Correo</b>
                    <input id="correo_opr" class="form-control form-control-md" type="email" placeholder="Escribe aquí" aria-label=".form-control-lg example">
                  </div>

                  <div class="col">
                    <b class="etiqueta">Celular</b>
                    <input id="celular_opr" class="form-control form-control-md" type="number" placeholder="Escribe aquí" aria-label=".form-control-lg example">
                  </div>

                </div>
                <div class="row align-items-center" style="margin-top: 30px">
                  
                  <div class="col">
                    <b class="etiqueta">Fecha Nacimiento</b>
                    <div class='input-group date' id='datetime_fecha'>
                      <input type="text" id="fecha_nacimiento_opr" size="30" autocomplete="off">
                      <span class="input-group-addon">
                          <span class="fa fa-calendar">
                          </span>
                      </span>
                    </div>
                  </div>

                  <div class="col">
                    <b class="etiqueta">Estado Civil</b>
                    <select class="form-select" aria-label="Default select example" id="estado_civil_opr">
                        <option value="0" selected>Seleccionar</option>
                        @foreach($estadoc as $estado)
                          <option value="{{$estado->id}}">{{$estado->nombre}}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="col">
                    <b class="etiqueta">Género</b>
                    <select class="form-select" aria-label="Default select example" id="genero_opr">
                        <option value="0" selected>Seleccionar</option>
                        @foreach($genero as $gen)
                          <option value="{{$gen->id}}">{{$gen->nombre}}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="col">
                    <b class="etiqueta">Tipo de Sangre</b>
                    <select class="form-select" aria-label="Default select example" id="tipo_sangre_opr">
                        <option value="0" selected>Seleccionar</option>
                        @foreach($sangre as $sang)
                          <option value="{{$sang->id}}">{{$sang->nombre}}</option>
                        @endforeach
                    </select>
                  </div>

                  <div class="col">
                    <b class="etiqueta">Cant. Hijos</b>
                    <select class="form-select" aria-label="Default select example" id="hijos_opr">
                        <option value="0" selected>Seleccionar</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                    </select>
                  </div>
                  
                </div>
                <div class="row align-items-end" style="margin-top: 30px">

                  <div class="col">
                    <b class="etiqueta">Dirección</b>
                    <input id="direccion_opr" class="form-control form-control-md" type="text" placeholder="Escribe la dirección" aria-label=".form-control-lg example">
                  </div>

                  <div class="col">
                    <b class="etiqueta">Ciudad</b>
                    <select class="form-select" aria-label="Default select example" id="ciudad_opr">
                          <option value="0" selected>Seleccionar</option>
                          @foreach($ciudades as $ciudad)
                            <option value="{{$ciudad->id}}">{{$ciudad->nombre}} - {{$ciudad->nombre_departamento}}</option>
                          @endforeach
                      </select>
                  </div>

                  <div class="col">
                    <b class="etiqueta">Vigencia Licencia</b>
                    <div class='input-group date' id='datetime_fecha'>
                      <input type="text" id="fecha_licencia" size="30" autocomplete="off">
                      <span class="input-group-addon">
                          <span class="fa fa-calendar">
                          </span>
                      </span>
                    </div>
                  </div>

                  <div class="col">
                    <b class="etiqueta">Vigencia Seguridad Social</b>
                    <div class='input-group date' id='datetime_fecha'>
                      <input type="text" id="fecha_seguridad_social" size="30" autocomplete="off">
                      <span class="input-group-addon">
                          <span class="fa fa-calendar">
                          </span>
                      </span>
                    </div>
                  </div>
                  
                </div>
                
              </div>

              <div class="doc_opr visually-hidden">
                  
                <div class="row align-items-end" style="margin-top: 30px">
                  <div class="col">
                    <b class="etiqueta">Eps PDF</b>
                      <input type="file" class="form-control" id="eps_pdf">
                  </div>
                  <div class="col">
                    <b class="etiqueta">Arl PDF</b>
                      <input type="file" class="form-control" id="arl_pdf">
                  </div>
                </div>

                <div class="row align-items-end" style="margin-top: 30px">
                  <div class="col">
                    <b class="etiqueta">Fondo de Pens. y Cesan PDF</b>
                      <input type="file" class="form-control" id="pension_pdf">
                  </div>
                  <div class="col">
                    <b class="etiqueta">Caja de compensación PDF</b>
                      <input type="file" class="form-control" id="compensacion_pdf">
                  </div>
                </div>

              </div>

            </div>
        </div>
        
      </div>
      <div class="modal-footer">
        <button data-sw="1"  id="atras_operador" type="button" class="btn btn-danger visually-hidden">Atrás <i class="bi bi-arrow-left-circle"></i></button>
        <button data-sw="1"  id="continuar_operador" type="button" class="btn btn-primary">Continuar <i class="bi bi-arrow-right-circle"></i></button>
      </div>
    </div>
  </div>
</div>
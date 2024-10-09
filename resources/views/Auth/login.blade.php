<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elite</title>
    <link href="{{url('images/logo.png')}}" rel="icon" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
      .divider:after,
      .divider:before {
        content: "";
        flex: 1;
        height: 1px;
        background: #eee;
      }
      .h-custom {
        height: calc(100% - 73px);
      }
      @media (max-width: 450px) {
        .h-custom {
        height: 100%;
        }
      }
    </style>
</head>
<body>


  <div aria-live="polite" aria-atomic="true" class="position-relative">
    <div class="toast-container top-0 end-0 p-3">

    <!-- Then put toasts within -->
    <div id="message" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header">
        <img src="..." class="rounded me-2" alt="...">
        <strong class="me-auto">Mensaje de alerta</strong>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">
        <span id="text"></span>
      </div>
    </div>
  </div>
</div>

  <section class="vh-100">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <center><img src="{{url('/images/upnet.png')}}"
          class="img-fluid" alt="Sample image"></center>
      </div>



      <div class="col-md-6 col-lg-4 col-xl-4 offset-xl-1">
        <form>
          <!-- Email input -->
          <div class="form-outline mb-4">
            <input type="email" id="username" class="form-control form-control-lg"
              placeholder="Escribe tu usuario" />
            <label class="form-label" for="form3Example3">Usuario</label>
          </div>

          <!-- Password input -->
          <div class="form-outline mb-3">
            <input type="password" id="password" class="form-control form-control-lg"
              placeholder="Escribe tu contraseña" />
            <label class="form-label" for="form3Example4">Clave</label>
          </div>

          <div class="text-center text-lg-start mt-4 pt-2">
            <center>
            <button id="login" type="button" class="btn btn-primary btn-lg"
              style="padding-left: 2.5rem; padding-right: 2.5rem;">Ingresar</button>

              <div class="spinner-border spin visually-hidden" role="status">
                <span class="visually-hidden">Loading...</span>
              </div>
            </center>
          </div>

        </form>
      </div>

    </div>
  </div>

</section>


<script type="text/javascript" src="{{url('public/js/plugins/jquery-3.7.1.js')}}"></script>
<script src="{{url('public/js/plugins/jquery-ui.min.js')}}"></script>
<script type="text/javascript" src="{{url('public/js/bootstrap/js/bootstrap.js')}}"></script>
<script type="text/javascript" src="{{url('public/js/plugins/util.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

<script type="text/javascript">

    $('#login').click(function() {


      const toastLiveExample = document.getElementById('message')
      const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)

        $('.spin').removeClass('visually-hidden');
        $('#login').addClass('visually-hidden');

        var username = $('#username').val();
        var password = $('#password').val();

        $.ajax({
            url: 'autenticate',
            method: 'post',
            data: {email: username, password: password}
        }).done(function(data){

            if(data.response==true){

              location.reload();

            }else if(data.response==false){

              $('.spin').addClass('visually-hidden');
              $('#login').removeClass('visually-hidden');

              $('#text').html(data.message)
              toastBootstrap.show()

            }else if(data.response=='false'){
              alert('El usuario no existe')
            }else{

              $('#text').html('Error al ingresar')
              toastBootstrap.show()

            }

        });

    });

        $('#cerrar_sesion').click(function() {

          $.ajax({
            url: 'logout',
            method: 'post',
            data: {_token: "{{ csrf_token() }}",}
          }).done(function(data){

            if(data.respuesta==true){
              location.reload();
            }else if(data.respuesta==false){

            }

          });

        });

    </script>

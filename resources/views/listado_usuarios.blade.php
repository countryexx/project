<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elite - Home</title>
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

      #myInput {
        background-image: url('/css/searchicon.png'); /* Add a search icon to input */
        background-position: 10px 12px; /* Position the search icon */
        background-repeat: no-repeat; /* Do not repeat the icon image */
        width: 100%; /* Full-width */
        font-size: 16px; /* Increase font-size */
        padding: 12px 20px 12px 40px; /* Add some padding */
        border: 1px solid #ddd; /* Add a grey border */
        margin-bottom: 12px; /* Add some space below the input */
      }

      #myTable {
        border-collapse: collapse; /* Collapse borders */
        width: 100%; /* Full-width */
        border: 1px solid #ddd; /* Add a grey border */
        font-size: 18px; /* Increase font-size */
      }

      #myTable th, #myTable td {
        text-align: left; /* Left-align text */
        padding: 12px; /* Add padding */
      }

      #myTable tr {
        /* Add a bottom border to all table rows */
        border-bottom: 1px solid #ddd;
      }

      #myTable tr.header, #myTable tr:hover {
        /* Add a grey background color to the table header and on hover */
        background-color: #f1f1f1;
      }
    </style>
</head>
<body>

  <div class="container-fluid">
      <div class="row flex-nowrap">
          @include('home.menu')
          
          <div class="col py-3">
            <div class="card">
              <div class="card-body">
                Lista de Usuarios
                <button style="float: right" type="button" class="btn btn-primary show_modal">Crear Usuario <i class="fa fa-plus" aria-hidden="true"></i></button>
              </div>
            </div>

            <div class="card">
              <div class="card-body">
                <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Buscar">
              </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Creación de nuevo Usuario</h5>
                  </div>
                  <div class="modal-body">
                    ...
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary">Guardar</button>
                  </div>
                </div>
              </div>
            </div>

            <table class="table" id="myTable">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Usuario</th>
                  <th scope="col">Acciones</th>
                </tr>
              </thead>
                <tbody>
                  @foreach($usuarios as $user)
                  <tr>
                    <th scope="row">{{$user->id}}</th>
                    <td>{{$user->nombres.' '.$user->apellidos}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                      <button type="button" class="btn btn-primary">Editar</button>
                      <button type="button" class="btn btn-danger">Bloquear</button>
                    </td>
                  </tr>
                  @endforeach

                </tbody>
              </table>

              <!-- Modal -->


          </div>
      </div>
  </div>


<script type="text/javascript" src="{{url('public/js/plugins/jquery-3.7.1.js')}}"></script>
<script src="{{url('public/js/plugins/jquery-ui.min.js')}}"></script>
<script type="text/javascript" src="{{url('public/js/bootstrap/js/bootstrap.js')}}"></script>
<script type="text/javascript" src="{{url('public/js/plugins/util.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

<script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>

<script type="text/javascript">

  $('#cerrar_sesion').click(function() {

    $.ajax({
        url: 'logout',
        method: 'post',
        data: {"_token": "{{ csrf_token() }}"}
    }).done(function(data){

        if(data.response==true){

          location.reload();

        }

    });

  });

  $('.show_modal').click(function() {
    $('#exampleModal').modal('show');
  });

</script>

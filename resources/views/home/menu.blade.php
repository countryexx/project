<div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
        <a href="{{url('/')}}" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <span class="fs-5 d-none d-sm-inline">Home</span>
        </a>
        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
            <li class="nav-item">

                <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                    <i class="fs-4 bi-people-fill"></i> <span class="ms-1 d-none d-sm-inline">Roles Usuarios</span></a>
                <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                    <li class="w-100">
                        <a href="{{url('roles')}}" class="nav-link px-0"> <span class="d-none d-sm-inline">Roles</span></a>
                    </li>
                    <li>
                        <a href="{{url('usuarios')}}" class="nav-link px-0"> <span class="d-none d-sm-inline">Usuarios</span></a>
                    </li>
                </ul>

            </li>
            <li class="nav-item">
                <a href="{{url('contratos')}}" class="nav-link align-middle px-0">
                    <i class="fs-4 bi-briefcase"></i> <span class="ms-1 d-none d-sm-inline">Contratos</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('tarifas')}}" class="nav-link align-middle px-0">
                    <i class="fs-4 bi-card-list"></i> <span class="ms-1 d-none d-sm-inline">Tarifas</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('ciudades')}}" class="nav-link align-middle px-0">
                    <i class="fs-4 bi-flag"></i> <span class="ms-1 d-none d-sm-inline">Ciudades</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('contratistas')}}" class="nav-link align-middle px-0">
                    <i class="fs-4 bi-person-raised-hand"></i> <span class="ms-1 d-none d-sm-inline">Contratistas</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('listadodeopradores')}}" class="nav-link align-middle px-0">
                    <i class="fs-4 bi-person-raised-hand"></i> <span class="ms-1 d-none d-sm-inline">Operadores</span>
                </a>
            </li>

            <li class="nav-item">

                <a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                    <i class="fs-4 bi-file-earmark-pdf-fill"></i> <span class="ms-1 d-none d-sm-inline">Fuec</span></a>
                <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                    <li class="w-100">
                        <a href="{{url('contratosyrutas')}}" class="nav-link px-0"> <span class="d-none d-sm-inline">Contratos y Rutas</span></a>
                    </li>
                    <li>
                        <a href="{{url('fuec')}}" class="nav-link px-0"> <span class="d-none d-sm-inline">Fuec</span></a>
                    </li>
                </ul>

            </li>

            <!--<li class="nav-item">
                <a href="#" class="nav-link align-middle px-0">
                    <i class="fs-4 bi-car-front"></i> <span class="ms-1 d-none d-sm-inline">Vehículos</span>
                </a>
            </li>
            
            <li>
                <a href="#" class="nav-link px-0 align-middle">
                    <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">Rutas de Fuec</span></a>
            </li>-->
            
            <li>
                <a href="{{url('configuracion')}}" class="nav-link px-0 align-middle">
                    <i class="fs-4 bi-sliders"></i> <span class="ms-1 d-none d-sm-inline">Tipos y Estados</span></a>
                
            </li>
            
        </ul>
        <hr>
        <div class="dropdown pb-4">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{url('public/imagenes/profile.png')}}" alt="hugenerd" width="30" height="30" class="rounded-circle">
                <span class="d-none d-sm-inline mx-1">{{Auth::user()->nombres.' '.Auth::user()->apellidos}}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                <li><a class="dropdown-item" href="#">Cambiar mi Clave</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" id="cerrar_sesion">Cerrar Sesión</a></li>
            </ul>
        </div>
    </div>
</div>

<div class="container-fluid align-content-center " style="background-color: #30448C;">
    <nav class="navbar navbar-light navbar-expand-xl " style="background-color: #30448C;">
        <div class="container-fluid" style="background-color: #30448C">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent" style="background-color:#30448C;" >
            <ul class="navbar-nav mx-auto mb-1 mb-lg-0" style="background-color:#30448C;">
                <li class="nav-item" style="padding-right: 60px; padding-left:60px">
                    <a class="nav-link" aria-current="page" href="{{route('inicio')}}" style="color:white; font-weight:bold; padding: 0px">Inicio</a>
                </li>
                <li class="nav-item" style="padding-right: 60px; padding-left:60px">
                    <a class="nav-link" aria-current="page" href="{{route('nuevo-reporte')}}" style="color:white;  font-weight:bold; padding: 0px">Registro</a>
                </li>
                <li class="nav-item"  style="padding-right: 60px; padding-left:60px">
                    @if(substr($usuario['staff_atrib'],0,1) < 3)
                    <a class="nav-link" href="{{route('consulta-reporte')}}" style="color:white; font-weight:bold; padding: 0px">Consulta</a>
                    @else
                        <a class="nav-link" href="{{route('consulta-reporte')}}" style="color:white; font-weight:bold; padding: 0px">En proceso</a>
                    @endif
                </li>
                @if(substr($usuario['staff_atrib'],0,1) == 4 )
                    <li class="nav-item"  style="padding-right: 60px; padding-left:60px">
                        <a class="nav-link" href="{{route('admin-reporte')}}" style="color:white; font-weight:bold; padding: 0px">Administrador</a>
                    </li>
                @endif
                <li  style="padding-right: 60px; padding-left:60px">
                    <a class="nav-link" aria-current="page" href="{{route('logout')}}" style="color:white; font-weight:bold; padding: 0px">Cerrar Sesión</a>
                </li>
            </ul>

        </div>
        </div>
    </nav>
</div>

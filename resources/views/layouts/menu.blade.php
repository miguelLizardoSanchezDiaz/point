<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('home')}}" class="brand-link">
      
      {!! HTML::image('/adminlte/dist/img/AdminLTELogo.png','AdminLTE Logo',array('class'=>'brand-image img-circle elevation-3','style'=>'opacity: .8')) !!}

      <span class="brand-text font-weight-light">Medida Perú</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          {!! HTML::image('/adminlte/dist/img/user2-160x160.jpg','User Image',array('class'=>'img-circle elevation-2')) !!}
        </div>
        <div class="info">
          <a href="{{url('home')}}" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Configuración
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('usuario')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Usuarios</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('rol')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Rol</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('permisos-por-rol')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Permisos por rol</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Maestros
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">

              <li class="nav-item has-treeview">

              <a href="#" class="nav-link ">
                <i class="far fa-circle nav-icon"></i>
                <p>
                  Productos
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>

              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{url('producto')}}" class="nav-link">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>Productos</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{url('categorias')}}" class="nav-link">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>Categorias</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{url('marcas')}}" class="nav-link">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>Marcas</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{url('modelos')}}" class="nav-link">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>Modelos</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{url('unidad-medida')}}" class="nav-link">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>Unidades de Medida</p>
                  </a>
                </li>

              </ul>
              </li>

              
              
              <li class="nav-item">
                <a href="{{url('tercero')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Terceros</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="./index3.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Almacenes</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="pages/calendar.html" class="nav-link">
              <i class="nav-icon fas fa-boxes"></i>
              <p>
                Almacén
                <!--<span class="badge badge-info right">2</span>-->
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="pages/calendar.html" class="nav-link">
              <i class="nav-icon fas fa-shopping-bag"></i>
              <p>
                Ventas
                <!--<span class="badge badge-info right">2</span>-->
              </p>
            </a>
          </li>
          


          <li class="nav-item">
            <a href="pages/calendar.html" class="nav-link">
              <i class="nav-icon fas fa-file-invoice-dollar"></i>
              <p>
                Documentos Electrónicos
                <!--<span class="badge badge-info right">2</span>-->
              </p>
            </a>
          </li>




          <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
              <i class="nav-icon fas fa-power-off"></i>
              <p>
                Salir
              </p>

            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </li>

          <li class="nav-header">OTROS RECURSOS</li>
          <li class="nav-item">
            <a href="https://adminlte.io/docs/3.0" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>Documentación</p>
            </a>
          </li>


          <li class="nav-item">
            <a href="{{url('punto')}}" class="nav-link">
              <i class="nav-icon fas fa-store"></i>
              <p>Punto de venta</p>
            </a>
          </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
 <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
          
        <a class="user-panel pb-3" data-toggle="dropdown" href="#">
            <img class="img-circle elevation-2 " alt="User Image" src="/storage/profile_images/{{ Auth::user()->foto }}">
        <span class="badge"></span>      
         
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">Accesos Rapidos</span>
          <div class="dropdown-divider"></div>
          <a href="{{ route('ventas.create') }}" class="dropdown-item">
            <i class="fas fa-shopping-basket mr-2"></i> Nueva Venta
            <span class="float-right text-muted text-sm"></span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="{{ route('clientes.index') }}" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> Clientes
            <span class="float-right text-muted text-sm"></span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="{{ route('productos.index') }}" class="dropdown-item">
            <i class="fas fa-shopping-cart mr-2"></i> Productos
            <span class="float-right text-muted text-sm"></span>
          </a>
          <div class="dropdown-divider"></div>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                     <!-- Authentication Links -->
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->username }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                  </div>
                    </li>
  
                      </div>
          </div>
          
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
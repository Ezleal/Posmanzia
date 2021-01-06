 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('home')}}"class="brand-link navbar-daRK">
      <img src="/img/plantilla/n.png"
           alt="Nielsen Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light"> Nielsen CCA </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/storage/profile_images/{{ Auth::user()->foto }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
        {{-- <a href="#" class="d-block">{{Auth::user()->name}}</a> --}}
         <a href="/home" class="d-block">{{ Auth::user()->name }}</a>

        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <a href="{{route('home') }}" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Inicio
              </p>
            </a>
            
          </li>
          @if (Auth::user()->perfil === 1 || Auth::user()->perfil === 2 )
          <li class="nav-item">
            <a href="{{ route('usuarios.index') }}" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Usuarios
              </p>
            </a>
          </li>

         
          
    
          <li class="nav-item has-treeview">
            <a href="{{ route('categorias.index') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Categorias
              </p>
            </a>
          </li>
           @endif
            <li class="nav-item">
            <a href="{{ route('productos.index') }}" class="nav-link">
              <i class="nav-icon fab fa-product-hunt"></i>
              <p>
                Productos
              </p>
            </a>
          </li>
           <li class="nav-item">
            <a href="{{ route('clientes.index') }}" class="nav-link">
              <i class="nav-icon fa fa-users"></i>
              <p>
                Clientes
              </p>
            </a>
          </li>

          {{-- Menu en arbol --}}
             <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-store"></i>
              <p>
                Ventas
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('ventas.index') }}" class="nav-link">
                  <i class="fas fa-cart-arrow-down nav-icon"></i>
                  <p>Administrar Ventas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('ventas.create') }}" class="nav-link">
                  <i class="fas fa-cash-register nav-icon"></i>
                  <p>Crear Venta</p>
                </a>
              </li>
          @if (Auth::user()->perfil === 1)
              <li class="nav-item">
                <a href="{{ route('ventas.reportes') }}" class="nav-link">
                  <i class="fas fa-chart-pie nav-icon"></i>
                  <p>Reporte de Ventas</p>
                </a>
              </li>
          @endif
            </ul>
          </li>
          {{-- Fin de Menu en arbol --}}
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                @isset($totalVentas)
                    <h3>${{ $totalVentas }}</h3>
                @endisset
                <p>Ventas</p>
              </div>
              <div class="icon">
                <i class="fas fa-file-invoice-dollar"></i>
              </div>
              <a href="/ventas" class="small-box-footer">Más info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                @isset($totalClientes)
                <h3>{{ $totalClientes }}</h3>
               @endisset
                <p>Clientes</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-plus"></i>
              </div>
              <a href="/clientes" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                 @isset($totalProductos)
                <h3>{{ $totalProductos }}</h3>
               @endisset
                <p>Productos</p>
              </div>
                <div class="icon">
               <i class="fas fa-shopping-cart"></i>
              </div>
              <a href="/productos" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                @isset($totalCategorias)
                <h3>{{ $totalCategorias }}</h3>
                @endisset
                <p>Categorias</p>
              </div>
              <div class="icon">
                <i class="fas fa-clipboard-list"></i>
              </div>
              <a href="/categorias" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
            
          <!-- ./col -->

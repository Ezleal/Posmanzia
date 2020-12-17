<div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title  mb-0">Productos Agregados Recientemente</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <ul class="products-list product-list-in-card pl-2 pr-2">
                  @foreach ($productosAgregados as $item)
                       <li class="item">
                    <div class="product-img">
                      <img src="/storage/products/{{ $item->imagen }}" alt="Product Image" class="img-size-50">
                    </div>
                    <div class="product-info">
                      <a href="javascript:void(0)" class="product-title">{{ $item->descripcion }}
                        <span class="badge badge-warning float-right">${{ $item->precio_venta }}</span></a>
                        @if ($item->stock == 0)
                            <span class="product-description text-center bg-danger">
                              AGOTADO!!!
                            </span>
                        @else
                          <span class="product-description"></span>
                        Stock: {{ $item->stock }} unidades
                        </span>
                        @endif
                        
                    </div>
                  </li>
                  <!-- /.item -->
                  @endforeach
                 
                 
                </ul>
              </div>
              <!-- /.card-body -->
              <div class="card-footer text-center">
                <a href="/productos" class="uppercase">Ver todos los Productos</a>
              </div>
              <!-- /.card-footer -->
            </div>
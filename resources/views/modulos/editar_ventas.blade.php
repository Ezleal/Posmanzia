@extends('layouts.plantilla')

@section('content')


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 d-inline">
            <h1 class="inline">Editar Venta</h1>
            <small> Nielsen CCA</small>
          </div>

          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('ventas.index')}}">Ventas</a></li>
              <li class="breadcrumb-item active">Editar Venta</li>
            </ol>
          </div>

        </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        {{-- FORMULARIO --}}
        <div class="col-md-5 col-xs-12 col-sm-12">
            <div class="card card-primary card-outline">
            <form method="post" action="{{ route('ventas.update') }}" class="formularioVenta">
              @csrf
              <div class="card-body with-border">
               
                  <div class="box">
                    {{-- ENTRADA PARA EL VENDEDOR --}}
                    <div class="form-group">
                      {{-- <label for="vendedor">VENDEDOR</label> --}}
                      <div class="input-group">
                        <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-address-card"></span>
                      </div>
                      </div>
                      <input type="text" class="form-control" name="vendedor" value="{{ $ventas->vendedor->name }}"  id="vendedor" autocomplete="vendedor" autofocus placeholder="Vendedor" readonly>
                      <input type="hidden" id="id_vendedor" name="id_vendedor" value="{{$ventas->id_vendedor}}">
                    </div>
                    </div>
                    {{-- ENTRADA PARA EL CODIGO --}}
                     <div class="form-group">
                      {{-- <label for="codigo">CODIGO</label> --}}
                      <div class="input-group">
                        <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-barcode"></span>
                      </div>
                      </div>
                      {{-- SE BUSCA EL ULTIMO CODIGO DE VENTA Y SE SUMA 1 AL FINAL --}}
  
                      <input type="text" class="form-control pl-2" name="codigo" value="{{ $ventas->codigo}}"  id="codigo" autocomplete="codigo" autofocus placeholder="codigo" readonly>

                    </div>
                    </div>
                     {{-- ENTRADA PARA EL CLIENTE --}}
                     <div class="form-group">
                      {{-- <label for="codigo">CLIENTE</label> --}}
                      <div class="input-group">
                        <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-users"></span>
                      </div>
                      </div>
                      {{-- <input type="text" class="form-control pl-2" name="id_cliente" value="{{ $ventas->cliente->name}}"  id="id_cliente" autocomplete="id_cliente" autofocus placeholder="id_cliente" readonly> --}}
                   <select class="form-control input-lg" type="text" name="id_cliente" id="id_cliente">
                {{-- Se busca la información desde la bd prioridad para el select --}}
                     <option selected value="{{ $ventas->id_cliente }}">{{ $ventas->cliente->name}}</option>
                    @if (!empty($clientes))
                      @foreach ($clientes as $cliente)
                      @if ($cliente->id != $ventas->id_cliente)
                        <option   value="{{ $cliente->id }}">{{ $cliente->name}}</option>      
                      @endif    
                      @endforeach
                    @endif
                       </select>
                    </div>
                      </div>
                
                    {{-- ENTRADA PARA AGREGAR PRODUCTO --}}
                     <div class="form-group nuevoProducto ">
                        @php
                        $impuestoPorcentaje = ($ventas->impuesto * 100) / $ventas->neto;
                       
                        // dd(count($list));
                      
                        foreach ($list as $value) { 
                          foreach ($producto as $key => $prod) {
                              
                            if ($value['id'] == $prod->id){
                                $stockAntiguo = $prod->stock + $value['cantidad'];
                                $stockNuevo = $prod->stock;
                          echo '<div class="row">
                          <div class="col-6 col-sm-6 pr-0 mt-1"> 
                            <div class="input"> 
                              <div class="input-group-append p-0"> 
                                <span>
                                  <button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="">
                                    <i class="fas fa-times"></i></button>
                                    </span> 
                                    <input type="text" class="form-control pl-2 nuevaDescripcionProducto" name="agregarProducto" idProducto="'.$value['id'].'" id="agregarProducto" title="" value="'.$value['descripcion'].'"  autocomplete="agregarProducto" autofocus readonly> 
                                    </div> 
                                    </div> 
                                    </div>
                                    <div class="col-2 col-sm-2 pl-1 pr-1 mt-1"> 
                                      <input type="number"  class="form-control p-1 nuevaCantidadProducto" min="1" value="'.$value['cantidad'].'" stock="'.$stockAntiguo.'" nuevoStock="'.$stockNuevo.'" required> 
                                      </div> <div class="col-4 col-sm-4 pl-0 mt-1 divPrecioProd"> <div class="input-group"> <div class="input-group-append"> 
                                        <div class="input-group-text p-1">$ </div> </div> 
                                        <input type="text" class="form-control pl-2 nuevoPrecio" name="nuevoPrecio" value="'.$value['total'].'" precioReal="'.$prod['precio_venta'].'" id="nuevoPrecio" autofocus readonly>
                                    </div> 
                                    </div> 
                                    </div>';
                         } }   }
                        @endphp
                      
 
                    </div>
                  {{-- ENTRADA PARA AGREGAR PRODUCTO --}}
                  <input type="hidden" id="listaProductos" name="listaProductos" value="{{ $ventas->productos }}">

                  
                <!--=====================================
                BOTÓN PARA AGREGAR PRODUCTO
                ======================================-->
                  <div class="justify-content-center">
                <button type="button" class="d-md-none d-lg-none btn btn-primary mt-2 mbAgregarProducto">Agregar producto</button>
                  </div>
  
                <div class="row mt-2">
                  <div class="col-md-12 col-md-offset-4">
                    <table class="table mb-0">
                      <thead class="p-0">
                        <tr>
                          <th class="pb-1 p-1">Impuestos</th>
                           <th class="pb-1 pt-1">Total a Pagar</th>
                        </tr>
                      </thead>
                      <tbody >
                        <tr>
                          <td style="width: 40%" class="p-1">
                             <div class="form-group">
                                 <div class="input-group">
                                   <input type="text" class="form-control impuestoVenta" name="impuestoVenta" value="{{$impuestoPorcentaje}}"  id="impuestoVenta" autocomplete="impuestoVenta" autofocus placeholder="Iva 21%">
                                  {{-- Input oculto de impuesto --}}
                                   <input type="hidden"  name="nuevoPrecioImpuesto"  id="nuevoPrecioImpuesto" value="{{ $ventas->impuesto }}" required>
                                   <input type="hidden"  name="nuevoPrecioNeto"  id="nuevoPrecioNeto" value="{{ $ventas->neto }}"  required>      
                                  
                                   <div class="input-group-append">
                                   <div class="input-group-text">
                                   <span class="fas fa-percent"></span>
                                   </div>
                                 </div>
                               </div>
                           </div>
                          
                          </td>
                           <td style="width: 60%"  class="p-1">
                              <div class="form-group">
                               <div class="input-group">
                                 <div class="input-group-append">
                                         <div class="input-group-text">
                                             <i class="fas fa-money-bill"></i>
                                         </div>
                                     </div>
                                  <input type="text" class="form-control nuevoTotalVenta" name="nuevoTotalVenta" total="{{ $ventas->total }}" value="$ {{ $ventas->total }}"  id="nuevoTotalVenta"  readonly>
                                     <input type="hidden" name="totalVenta" id="totalVenta" value="{{ $ventas->total }}">
                                  </div>
                             </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
            
               <!--=====================================
                ENTRADA MÉTODO DE PAGO
                ======================================-->
                 <!--=====================================
                ENTRADA MÉTODO DE PAGO
                ======================================-->
                {{-----  Metodo de Pago -------}}
    <div class="mb-1">
          <div class="input-group">
              <select class="form-control mr-1 col-xs-2" id="nuevoMetodoPago" name="nuevoMetodoPago" required>
                <option value="" selected disabled>Método de pago</option>
                <option value="Efectivo">Efectivo</option>
                <option value="TC">Tarjeta Crédito</option>
                <option value="TD">Tarjeta Débito</option>                  
              </select>           
            {{-----  N° de transaccion tarjeta -------}}   
          <input  type="hidden" class="form-control" name="nro_transaccion" id="nro_transaccion" value="" min="0" step="any" autocomplete="nro_transaccion" autofocus placeholder="N° de Transacción">
          <div class="input-group-append  d-none divefectivo">
            <div class="input-group-text">
              <span class="fas fa-receipt"></span>
            </div>
          </div>
      </div>
    </div>
    {{-----  N° de transaccion EFECTIVO -------}}   
     <div class="mb-1 mt-2 transaccionEfectivo">
          
    </div>
   <input type="hidden" id="listaMetodoPago" name="listaMetodoPago">
            </div>
                
              </div>
              <div class="card-footer">
                <input name="idEditarVenta" id="idEditarVentA" type="hidden" value="{{ $ventas->id }}">
                <input name="editarVenta" id="editarVenta" class="btn btn-primary float-right" type="submit" value="Editar Venta">
              </div>
              </form>
            </div>

        </div>  
        {{-- LA TABLA DE PRODUCTOS --}}
        <div class="col-md-7 d-none d-sm-none d-md-block d-lg-block">
        <div class="card card-danger card-outline">
              <div class="card-body with-border">
                <div class="box">
         <table id="ventas_table" class="table table-bordered table-striped dataTable dtr-inline tablas">
        <thead>
          <tr>
            {{-- <th style="width: 10px">#</th> --}}
            <th>Codigo</th>
            <th>Imagen</th>
            <th>Descripción</th>
            <th>Stock</th>
            <th>Precio</th>
            <th>Acción</th>
          </tr>
          </thead>
          <tbody>
                {{-- ACA DATATABLE SE ENCARGA DE LA CARGA DE DATOS --}}
              </tbody>
        </table>
                </div>
                
              </div>
               {{-- <div class="card-footer">
              
              </div> --}}
           
        </div>
        </div>  
        </div> 
            

      </div>
     

    </section>
    <!-- /.content -->

@endsection
@section('scripts')
<script src="{{ asset('/js/editar_ventas.js') }}"></script>

@endsection
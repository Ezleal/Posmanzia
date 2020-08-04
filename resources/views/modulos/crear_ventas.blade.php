@extends('layouts.plantilla')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 d-inline">
            <h1 class="inline">Nueva Venta</h1>
            <small> Nielsen CCA</small>
          </div>

          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('ventas.index')}}">Ventas</a></li>
              <li class="breadcrumb-item active">Crear Venta</li>
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
            <form action="post">
              <div class="card-body with-border">
               
                  <div class="box">
                    {{-- ENTRADA PARA EL VENDEDOR --}}
                    <div class="form-group">
                      {{-- <label for="vendedor">VENDEDOR</label> --}}
                      <div class="input-group">
                        <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-user"></span>
                      </div>
                      </div>
                      <input type="text" class="form-control" name="vendedor" value="{{ Auth::user()->name }}"  id="vendedor" autocomplete="vendedor" autofocus placeholder="Vendedor" readonly>
                    </div>
                    </div>
                    {{-- ENTRADA PARA EL CODIGO --}}
                     <div class="form-group">
                      {{-- <label for="codigo">CODIGO</label> --}}
                      <div class="input-group">
                        <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-key"></span>
                      </div>
                      </div>
                      <input type="text" class="form-control" name="codigo" value="1223242342"  id="codigo" autocomplete="codigo" autofocus placeholder="codigo" readonly>
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
                        <select class="form-control" name="" id="">
                          <option value="">Seleccionar Cliente</option>
                        </select>  
                        <button type="button" class="btn btn-danger ml-2" data-toggle="modal" data-target="#agregarCliente" name="create_record" id="create_record">
                               Nuevo Cliente
                        </button>                  
                      </div>
                    </div>
                    {{-- ENTRADA PARA EL CODIGO --}}
                     <div class="form-group row nuevoProducto">
                    <div class="col-6 col-sm-6 pr-0">
                      <div class="input">
                        
                        <div class="input-group-append p-0">
                        <span><button type="button" class="btn btn-danger btn-xs"><i class="fas fa-times"></i></button></span>
                        <input type="text" class="form-control pl-2" name="codigo" value="1223242342"  id="codigo" autocomplete="codigo" autofocus placeholder="codigo">
                      </div>
                      
                    </div>
                    </div>
                    <div class="col-2 col-sm-2">
                      <input type="number" class="form-control p-1" min="1" placeholder="0" required>
                    </div>
                    <div class="col-4 col-sm-4 pl-0"> 
                        <div class="input-group">
                          <div class="input-group-append">
                        <div class="input-group-text p-1">$
                        </div>
                      </div>
                      <input type="text" class="form-control pl-2" name="codigo" value="1223242342"  id="codigo" autocomplete="codigo" autofocus placeholder="codigo">
                          
                    </div>
                      
                    </div>
                  </div>
                <!--=====================================
                BOTÓN PARA AGREGAR PRODUCTO
                ======================================-->
                  <div class="justify-content-center">
                <button type="button" class="d-md-none d-lg-none btn btn-primary mt-2 btnAgregarProducto">Agregar producto</button>
                  </div>
  
                <div class="row mt-2">
                  <div class="col-md-12">
                    <table class="table mb-0">
                      <thead class="p-0">
                        <tr>
                          <th class="pb-1 p-1">Impuestos</th>
                           <th class="pb-1 pt-1">Total</th>
                        </tr>
                      </thead>
                      <tbody >
                        <tr>
                          <td style="width: 50%" class="p-1">
                             <div class="form-group">
                                 <div class="input-group">
                                   <input type="text" class="form-control" name="codigo" value="1223242342"  id="codigo" autocomplete="codigo" autofocus placeholder="codigo">
                                 <div class="input-group-append">
                                   <div class="input-group-text">
                                   <span class="fas fa-percent"></span>
                                   </div>
                                 </div>
                               </div>
                           </div>
                          
                          </td>
                           <td style="width: 50%"  class="p-1">
                              <div class="form-group">
                               <div class="input-group">
                                 <div class="input-group-append">
                                         <div class="input-group-text">
                                             <ion-icon name="logo-usd"></ion-icon>
                                         </div>
                                     </div>
                                  <input type="text" class="form-control" name="codigo" value="1223242342"  id="codigo" autocomplete="codigo" autofocus placeholder="codigo">

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

                <div class="form-group row">
                  
                  <div class="col-md-6" style="padding-right:0px">
                    
                     <div class="input-group">
                  
                      <select class="form-control" id="nuevoMetodoPago" name="nuevoMetodoPago" required>
                        <option value="">Seleccione método de pago</option>
                        <option value="Efectivo">Efectivo</option>
                        <option value="TC">Tarjeta Crédito</option>
                        <option value="TD">Tarjeta Débito</option>                  
                      </select>    

                    </div>

                  </div>

                  <div class="cajasMetodoPago"></div>

                  <input type="hidden" id="listaMetodoPago" name="listaMetodoPago">

                </div>
                  </div>
                
              </div>
              <div class="card-footer">
                <input name="" id="" class="btn btn-primary float-right" type="submit" value="Guardar Venta">
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
            <th>Código</th>
            <th>Imagen</th>
            <th>Descripción</th>
            <th>Stock</th>
            <th>Precio</th>
            <th>Acciones</th>
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
 
{{-- Modal Agregar Cliente --}}
<!-- Modal -->
<div class="modal fade" id="agregarCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form  method="post" id="sample_form">
        @csrf
      <div class="modal-header" style="background: #343a40; color: white">
        <h5 class="modal-title" id="exampleModalLongTitle">Nuevo Cliente</h5>
        <button style="color:#ffffff" type="button" class="close btn btn-primary" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <span id="form_result"></span>
        <div class="box-body">
       {{-- Entrada para el Nombre de la Cliente --}}
       <div class="mb-3">
          <div class="input-group">
            <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
          <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  id="name" autocomplete="name" autofocus placeholder="Nombre del Cliente">
        </div>
        <div>
            <span id="nameError" role="alert">
            </span>
        </div>   
      </div> 
       {{-- Entrada para el Documento --}}
       <div class="mb-3">
          <div class="input-group">
            <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-id-card"></span>
            </div>
          </div>
          <input type="number" min="0" class="form-control @error('documento') is-invalid @enderror" name="documento" value="{{ old('documento') }}"  id="documento" autocomplete="documento" autofocus placeholder="Documento">
        </div>
        <div>
            <span id="documentoError" role="alert">
            </span>
        </div>   
      </div>
      {{-- Entrada para la Fecha de Nacimiento --}}
       <div class="mb-3">
          <div class="input-group">
            <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-calendar-alt"></span>
            </div>
          </div>
          <input type="text" class="form-control @error('fecha_nacimiento') is-invalid @enderror" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}"  id="fecha_nacimiento" autocomplete="fecha_nacimiento" autofocus placeholder="Fecha de nacimiento" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy/mm/dd" data-mask="" im-insert="false">
        </div>
        <div>
            <span id="fecha_nacimientoError" role="alert">
            </span>
        </div>   
      </div>
        {{-- Entrada para el Email --}}
       <div class="mb-3">
          <div class="input-group">
            <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  id="email" autocomplete="email" autofocus placeholder="Email">
        </div>
        <div>
            <span id="emailError" role="alert">
            </span>
        </div>   
      </div>
      {{-- Entrada para el Telefono --}}
       <div class="mb-3">
          <div class="input-group">
            <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phone"></span>
            </div>
          </div>
          <input type="text" class="form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{ old('telefono') }}"  id="telefono" autocomplete="telefono" autofocus placeholder="Telefono" data-inputmask='"mask": "(999) 9999-9999"' data-mask>
        </div>
        <div>
            <span id="telefonoError" role="alert">
            </span>
        </div>   
      </div>
       {{-- Entrada para la Dirección --}}
       <div class="mb-3">
          <div class="input-group">
            <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-map-marker-alt"></span>
            </div>
          </div>
          <input type="text" class="form-control @error('direccion') is-invalid @enderror" name="direccion" value="{{ old('direccion') }}"  id="direccion" autocomplete="direccion" autofocus placeholder="Dirección">
        </div>
        <div>
            <span id="direccionError" role="alert">
            </span>
        </div>   
      </div>
             
        </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="action" id="action" />
        <input type="hidden" name="hidden_id" id="hidden_id" />
        <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Salir</button>
        <input type="submit" name="action_button" id="action_button" value="Add Cliente" class="btn btn-primary"/>
      </div>
    </div>
    </form>
  </div>
</div>
{{-- FIN MODAL AGREGAR CLIENTES --}}


@endsection
@section('scripts')
<script src="{{ asset('/js/crear_ventas.js') }}"></script>    
@endsection
@extends('layouts.plantilla')

@section('content')

  @if(session('info'))
  <script>
    swal ( "Venta Creada Correctamente!" ,  "Verifica en la lista de Ventas" ,  "success" )
  </script>        
  @endif
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
            <form method="post" action="{{ route('ventas.store') }}" class="formularioVenta" id="formCrearVenta">
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
                      <input type="text" class="form-control  @error('id_vendedor') is-invalid @enderror" name="vendedor" value="{{ Auth::user()->name }}"  id="vendedor" autocomplete="vendedor" autofocus placeholder="Vendedor" readonly>
                      <input type="hidden" id="id_vendedor" name="id_vendedor" value="{{ Auth::user()->id }}">
                    </div>
                       @error('id_vendedor')
                          <span class="invalid text-danger" id="id_vendedorError" role="alert">{{ "Seleccione un Vendedor Valido" }}</span>
                      @enderror
                    </div>
                    {{-- ENTRADA PARA EL CODIGO --}}
                     <div class="form-group" id="grupo__codigo">
                      {{-- <label for="codigo">CODIGO</label> --}}
                      <div class="input-group">
                        <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-barcode"></span>
                      </div>
                      </div>
                      {{-- SE BUSCA EL ULTIMO CODIGO DE VENTA Y SE SUMA 1 AL FINAL --}}
                      @foreach ($ventas as $venta)    
                      @endforeach
                      @if (isset($venta)) 
                      <input type="text" class="form-control pl-2 @error('codigo') is-invalid @enderror" name="codigo" value="{{ $venta->codigo + 1 }}"  id="codigo" autocomplete="codigo" autofocus placeholder="Codigo" >
                        
                      @else
                      {{-- EN CASO DE QUE NO EXISTA EN VALUE SE ESTABLECE EL NRO DE INICIO DE FACTURACIÓN --}}
                         <input type="text" class="form-control @error('codigo') is-invalid @enderror" name="codigo" value="10000"  id="codigo" autocomplete="codigo" autofocus placeholder="codigo" readonly>
                      @endif
                    
                      
                    </div>
                          @error('codigo')
                            <span class="invalid text-danger" id="codigoError" role="alert">{{ "El Codigo de Venta no puede estar vacio" }}</span>
                          @enderror
                            <p class="invalid text-danger formulario_input-error" id="codigoError" role="alert"></p>

                    </div>
                   
                        
                     {{-- ENTRADA PARA EL CLIENTE --}}
                     <div class="form-group" id="grupo__cliente">
                      {{-- <label for="codigo">CLIENTE</label> --}}
                      <div class="input-group">
                        <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-users"></span>
                      </div>
                      </div>
                         <select class="form-control input-lg @error('id_cliente') is-invalid @enderror" type="text" name="id_cliente" id="id_cliente">
                {{-- Se busca la información desde la bd prioridad para el select --}}
                     <option selected  id="editarCliente" value="">Seleccionar Cliente </option>
                     @if (!empty($clientes))
                      @foreach ($clientes as $cliente)    
                    <option   value="{{ $cliente->id }}">{{ $cliente->name}}</option>      
                      @endforeach
                      @endif
                       </select>
                        <button type="button" class="btn btn-danger ml-2" data-toggle="modal" data-target="#agregarCliente" name="create_record" id="create_record">
                               Nuevo Cliente
                        </button>                  
                      </div>
                      @error('id_cliente')
                            <span class="invalid text-danger" id="id_clienteError" role="alert">{{ "Selecciona un cliente o agrega uno nuevo" }}</span>
                      @enderror
                          <p class="invalid text-danger formulario_input-error" id="clienteError" role="alert"></p>

                    </div>
                    {{-- ENTRADA PARA AGREGAR PRODUCTO --}}
                     <div class="form-group nuevoProducto ">

                    </div>
                      @error('listaProductos')
                          <span class="invalid text-danger" id="listaProductosError" role="alert">{{ "No hay ningun producto en la Compra" }}</span>
                      @enderror
                  {{-- ENTRADA PARA AGREGAR PRODUCTO --}}
                  <div id="grupo__listaProductos">
                    <input type="hidden" id="listaProductos" name="listaProductos">
                    <p class="invalid text-danger formulario_input-error" id="listaProductosError" role="alert"></p>

                  </div>

                  
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
                             <div class="form-group" id="grupo__impuestoVenta">
                                 <div class="input-group">
                                   <input type="text" class="form-control impuestoVenta" name="impuestoVenta" value="21"  id="impuestoVenta" autocomplete="impuestoVenta" autofocus placeholder="Iva 21%">
                                  {{-- Input oculto de impuesto --}}
                                   <input type="hidden"  name="nuevoPrecioImpuesto"  id="nuevoPrecioImpuesto" required>
                                   <input type="hidden"  name="nuevoPrecioNeto"  id="nuevoPrecioNeto" required>      
                                  
                                   <div class="input-group-append">
                                   <div class="input-group-text">
                                   <span class="fas fa-percent"></span>
                                   </div>
                                 </div>
                               </div>
                         <p class="invalid text-danger formulario_input-error" id="impuestoVentaError" role="alert"></p>

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
                                  <input type="text" class="form-control nuevoTotalVenta" name="nuevoTotalVenta" total="" value=""  id="nuevoTotalVenta"  readonly>
                                     <input type="hidden" name="totalVenta" id="totalVenta">
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
          <input  type="hidden" class="form-control" name="nro_transaccion" id="nro_transaccion" value="{{old('nro_transaccion')}}" min="0" step="any" autocomplete="nro_transaccion" autofocus placeholder="N° de Transacción" required>
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
      @error('listaMetodoPago')
          <span class="invalid text-danger" id="listaMetodoPagoError" role="alert">{{ "Ingrese el numero de transaccion de la venta" }}</span>
      @enderror
            </div>
                
              </div>
              <div class="card-footer ">
                <input name="crearVenta" id="crearVenta" class="btn btn-primary float-right mt-2" type="submit" value="Crear Venta" >
                <a class="btn">
                  <img src="/img/qr/QRMODAL.jpg" class="float-left" id="qr" name="qr" alt="QR MercadoPago" width="50" height="50"  data-toggle="modal" data-target="#modalQr">
                </a>
                  

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

          {{-- Modal QR --}}

<div class="modal fade" id="modalQr" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
         <img src="/img/qr/QR.png" class="" id="qr" name="qr" alt="QR MercadoPago" width="500" height="500" >

  </div>
</div>
{{-- FIN MODAL QR --}}


<script>
 $('#create_record').click(function(){
  $('.modal-title').text("Nuevo Cliente");
  $('.invalid').html('');
     $('#action_button').val("Add Cliente");
     $('#action').val("Add Cliente");
     $('#agregarCliente').modal('show');
     $('#sample_form')[0].reset();
 });
  $('#sample_form').on('submit', function(event){
   event.preventDefault();
  if($('#action').val() == 'Add Cliente')
  {
   $.ajax({
    url:"{{ route('clientes.store') }}",
    method:"POST",
    data: new FormData(this),
    contentType: false,
    cache:false,
    processData: false,
    dataType:"json",
    success:function(data)
    {console.log(data);
     var html = '';
     
     if(data.errors)
     {
      $('.invalid').html('');
     var html = "";
     let regexName = /(the name|el nombre)/i;
     let regexDocumento = /(the documento|el documento)/i;
     let regexDireccion = /(the direccion|el direccion)/i;
     let regexTelefono = /(the telefono|el telefono)/i;
     let regexNacimiento = /(the fecha nacimiento|el fecha nacimiento)/i;
     let regexEmail = /(the email|el email)/i;
       data.errors.forEach(element => {
         
        if(element.match(regexName)){$('#nameError').html('<strong class="invalid text-danger">'+element+'</strong>');}
        if(element.match(regexDocumento)){$('#documentoError').html('<strong class="invalid text-danger">'+element+'</strong>');}
        if(element.match(regexDireccion)){$('#direccionError').html('<strong class="invalid text-danger">'+element+'</strong>');}
        if(element.match(regexTelefono)){$('#telefonoError').html('<strong class="invalid text-danger">'+element+'</strong>');}
        if(element.match(regexNacimiento)){$('#fecha_nacimientoError').html('<strong class="invalid text-danger">'+element+'</strong>');}
        if(element.match(regexEmail)){$('#emailError').html('<strong class="invalid text-danger">'+element+'</strong>');}
        else{
          //  swal ( "Error al Editar Cliente!" ,  "Cliente o Email" ,  "error" )
          console.log(element);
        }

         });
     }
     if(data.success)
     {
        $('#agregarCliente').html('');
           swal({
                title: "Cliente Creade Correctamente!",
                text: "Verifica en la lista de clientes",
                icon: "success"
            }).then(function() {
                // window.location = "/clientes";
                    window.location.reload();

            });
      // html = '<div class="alert alert-success">' + data.success + '</div>';
      // $('#sample_form')[0].reset();
      // $('#user_table').DataTable().ajax.reload();
     }
     $('#form_result').html(html);
    }
   })
  }
 
 });
</script>

@endsection
@section('scripts')
<script src="{{ asset('/js/crear_ventas.js') }}"></script>
<script src="{{ asset('/js/validaciones.js') }}"></script>
@endsection
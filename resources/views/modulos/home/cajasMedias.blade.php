
          <div class="col-lg-6 offset-lg-3 col-12">
            <!-- nueva venta -->
            <a href="{{route('ventas.create')}}">
            <button type="button" class="btn btn-dark btn-lg btn-block mb-4">Cargar Nueva Venta
            
          
          <i class="fas fa-arrow-circle-right pl-2"></i>
          </button>
          </a>
          </div>

          <!-- ./col -->
        <div class="col-lg-6 offset-lg-3 col-12">
            <button type="button"  class="btn btn-dark btn-lg btn-block mb-4" data-toggle="modal" data-target="#aperturaCaja" name="create_caja" id="create_caja">
              Apertura de Caja
                <i class="fas fa-cash-register nav-icon  pl-3"></i>
            </button>
          
         </div>
          <!-- ./col -->


          {{-- Modal Apertura de Caja --}}

<div class="modal fade" id="aperturaCaja" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form  method="post" id="sample_form" enctype="multipart/form-data">
        @csrf
      <div class="modal-header" style="background: #343a40; color: white">
        <h5 class="modal-title" id="exampleModalLongTitle">Agregar Producto</h5>
        <button style="color:#ffffff" type="button" class="close btn btn-primary" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <span id="form_result"></span>
        <div class="box-body">
          
            {{-- Entrada para cambio Inicial de la caja --}}
       <div class="mb-3">
          <div class="input-group">
            <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-barcode"></span>
            </div>
          </div>
          <input  type="text" class="form-control @error('codigo') is-invalid @enderror" name="codigo" id="codigo" value="{{ old('codigo') }}"  autocomplete="codigo" autofocus placeholder="Codigo del Producto">  
        </div>
        <div>
            <span  role="alert" id="codigoError">
            </span>
        </div> 
      </div> 
       {{-- Entrada para la Descripcion del Producto --}}
       <div class="mb-3">
          <div class="input-group">
            <div class="input-group-append">
            <div class="input-group-text">
              <span class="fab fa-product-hunt"></span>
            </div>
          </div>
          <input type="text" class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" value="{{ old('descripcion') }}"  id="descripcion" autocomplete="descripcion" autofocus placeholder="Descripción del Producto">
        </div>
        <div>
            <span id="descripcionError" role="alert">
            </span>
        </div>   
      </div> 
            

        {{-----  Precio de Compra -------}}
    <div class="mb-3">
          <div class="input-group">
            <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-dollar-sign"></span>
            </div>
          </div>
          <input  type="text" class="form-control @error('precio_compra') is-invalid @enderror" name="precio_compra" id="precio_compra" value="{{ old('precio_compra') }}"  autocomplete="precio_compra" min="0" step="any" autofocus placeholder="Precio de Compra">
        
          {{-----  Precio de Venta -------}} 
            <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-hand-holding-usd"></span>
            </div>
          </div>
          <input  type="number" class="form-control @error('precio_venta') is-invalid @enderror" name="precio_venta" id="precio_venta" value="{{ old('precio_venta') }}" min="0" step="any"autocomplete="precio_venta" autofocus placeholder="Precio de Venta">
          
      </div>
    </div>
     <div>
          <span  role="alert" id="precio_compraError"> </span>
    </div>
     <div>
            <span  role="alert" id="precio_ventaError"> </span>
          </div> 
          
          {{-----  Check Porcentaje -------}} 
        {{-- <label class="mr-2 icheck-danger">     
          <input type="checkbox" class="minimal inputporcentaje" checked>
            Utilizar porcentaje
           </label>    --}}
      <div class="mb-3">
          <div class="input-group ">
        
        {{-----  Input Porcentaje -------}} 
             <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-percentage"></span>
            </div>
          </div>
          <input  type="number" class="form-control @error('porcentaje') is-invalid @enderror" name="porcentaje" id="porcentaje" autocomplete="porcentaje" autofocus placeholder="Porcentaje" min="0" value="40"> 
            <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-check"></span>
            </div>
          </div>
          {{-----  Input Stock Disponible -------}} 
          <input  type="number" class="form-control @error('stock') is-invalid @enderror" name="stock" id="stock" value="{{ old('stock') }}"  autocomplete="stock" autofocus placeholder="Stock">
     
      </div>
         <div>
          <span  role="alert" id="stockError"> </span>
        </div>
    </div>
  

        </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="action" id="action" />
        <input type="hidden" name="hidden_id" id="hidden_id" />
        <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Salir</button>
        <input type="submit" name="action_button" id="action_button" value="Add" class="btn btn-primary"/>
      </div>
    </div>
    </form>
  </div>
</div>
{{-- FIN MODAL APERTURA DE CAJA --}}

     <script>
  $('#create_caja').click(function(){
  $('.modal-title').text("Apertura de Caja");
  $('.invalid').html('');
  $("#editarCategoria").prop('disabled', true);
  $("#editarCategoria").val('');
  $("#editarCategoria").html('Seleccionar Categoria');
  $('#action_button').val("Apertura");
  $('#action').val("Apertura");
  $('#aperturaCaja').modal('show');
  // $('#precio_venta').prop('readonly', true);
  $('#sample_form')[0].reset();
 });
     </script>
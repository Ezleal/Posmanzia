@extends('layouts.plantilla')

@section('content')
@section('scripts')
<script src="{{ asset('/js/productos.js') }}"></script>    
@endsection


{{-- Sweet alert el registro de producto --}}
 {{-- @if (count($errors->all())>0)
          <script>
				  swal ( "Error al Crear producto!" ,  "Verifica el Formulario de registro" ,  "error" )
        </script>
        {{ $errors }}
  @endif --}}
  {{-- @if(session('info'))
  <script>
    swal ( "producto Creado Correctamente!" ,  "Verifica en la lista de productos" ,  "success" )
  </script>        
  @endif --}}
  
{{-- Fin de alertas en el registro de producto --}}
     
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 d-inline">
            <h1 class="inline">Administrar Productos</h1>
            <small> Nielsen CCA</small>
          </div>

          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Inicio</a></li>
              <li class="breadcrumb-item active">Producto</li>
            </ol>
          </div>

        </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Modal Agregar Producto -->
      <div class="card">
       @if (Auth::user()->perfil === 1)

        <div class="card-header">
           <button class="btn btn-primary" data-toggle="modal" data-target="#agregarProducto" name="create_record" id="create_record">
            Agregar Producto
          </button>

        </div>

      @endif
        {{-- TABLA DE PRODUCTOS --}}
        <div class="card-body">
      <table id="product_table" class="table table-bordered table-striped dataTable dtr-inline tablas">
        <thead>
          <tr>
            <th style="width: 10px">#</th>
            <th>Imagen</th>
            <th>Código</th>
            <th>Descripción</th>
            <th>Categoría</th>
            <th>Stock</th>
            <th>Precio de Compra</th>
            <th>Precio de Venta</th>
            <th>Agregado</th>
            <th>Acciones</th>
  
          </tr>
          </thead>
          <tbody>
                {{-- ACA DATATABLE SE ENCARGA DE LA CARGA DE DATOS --}}
              </tbody>
        </table>

        </div>
        <!-- /.card-body -->
        
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->

{{-- Modal Agregar Producto --}}

<div class="modal fade" id="agregarProducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
           {{-- Entrada para la Categoria --}}
       <div class="mb-1">
          <div class="form-group">
            <div class="input-group-prepend">
              <div class="input-group-text">
              <span class="fa fa-users"></span>
              </div>
              <select class="form-control input-lg" type="text" name="id_categoria" id="id_categoria">
                {{-- Se busca la información desde la bd prioridad para el select --}}
                <option selected disabled id="editarCategoria">Seleccionar Categoria </option>
              @if (!empty($categorias))
                  @foreach ($categorias as $categoria)    
          <option   value="{{ $categoria->id }}">{{ $categoria->name}}</option>      
                @endforeach
                 @endif
              </select>
            </div>
             <div>
          <span  role="alert" id="id_categoriaError"> </span>
        </div>
          </div>
         
        </div> 
            {{-- Entrada para Codigo del Producto --}}
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
    <div class="mb-1">
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
        <label class="mr-2 icheck-danger">     
          <input type="checkbox" class="minimal inputporcentaje" checked>
            Utilizar porcentaje
           </label>   
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
  
                 {{-- Entrada para Foto --}}
          <div class="form-group row">
            <div class="col-sm-12 col-md-6">
           <div class="panel">
              <label class="control-label">Seleccionar imagen del Producto</label>
          {{-- <div class="panel text-uppercase">SUBIR FOTO</div> --}}
          </div>
            <input type="file" class="foto" name="imagen" >
            <p class="help-block">Peso maximo de la imagen 2 MB</p>
          </div>
          <div class="col-sm-12	col-md-4 ml-5" id="foto">
            <img src="{{ Storage::url('products/default.jpg') }}" class="img-thumbnail previzualizar" alt="pic" width="80px">
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
{{-- FIN MODAL AGREGAR Producto --}}

<script>
  $('#create_record').click(function(){
  $('.modal-title').text("Nuevo Producto");
  $('.invalid').html('');
  $("#editarCategoria").prop('disabled', true);
  $("#editarCategoria").val('');
  $("#editarCategoria").html('Seleccionar Categoria');
  $('#foto').html('');
  $('#foto').html("<img src={{ URL::to('/storage') }}/products/default.jpg class='img-thumbnail previzualizar' alt='pic' width='80px'/>");
  $('#action_button').val("Add");
  $('#action').val("Add");
  $('#agregarProducto').modal('show');
  // $('#precio_venta').prop('readonly', true);
  $('#sample_form')[0].reset();
 });
  $('#sample_form').on('submit', function(event){
   event.preventDefault();
  if($('#action').val() == 'Add')
  {
   $.ajax({
    url:"{{ route('productos.store') }}",
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
     let regexCodigo = /(the codigo|el codigo)/i;
     let regexDescripcion = /(the descripcion|el descripcion)/i;
     let regexCategoria = /(the id categoria|el id categoria)/i;
     let regexPrecio_compra = /(the precio compra|el precio compra)/i;
     let regexPrecio_venta = /(the precio venta|el precio venta)/i;
     let regexStock = /(the stock|el stock)/i;
       data.errors.forEach(element => {
         
        if(element.match(regexCodigo)){$('#codigoError').html('<strong class="invalid text-danger">'+element+'</strong>');}
        if(element.match(regexDescripcion)){$('#descripcionError').html('<strong class="invalid text-danger">'+element+'</strong>');}
        if(element.match(regexCategoria)){$('#id_categoriaError').html('<strong class="invalid text-danger">'+element+'</strong>');}
        if(element.match(regexPrecio_compra)){$('#precio_compraError').html('<strong class="invalid text-danger">'+element+'</strong>');}
        if(element.match(regexPrecio_venta)){$('#precio_ventaError').html('<strong class="invalid text-danger">'+element+'</strong>');}
        if(element.match(regexStock)){$('#stockError').html('<strong class="invalid text-danger">'+element+'</strong>');}

        else{
          //  swal ( "Error al Editar Producto!" ,  "Producto o Email" ,  "error" )
          console.log(element);
        }

         });
     }
     if(data.success)
     {
        $('#agregarProducto').html('');
           swal({
                title: "Producto Creado Correctamente!",
                text: "Verifica en la lista de productos",
                icon: "success"
            }).then(function() {
                // window.location = "/productos";
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
  if($('#action').val() == "Edit")
  {
   $.ajax({
    url:"{{ route('productos.update') }}",
    method:"POST",
    data:new FormData(this),
    contentType: false,
    cache: false,
    processData: false,
    dataType:"json",
    success:function(data)
    {
    $('.invalid').html('');
    var html = "";
     let regexCodigo = /(the codigo|el codigo)/i;
     let regexDescripcion = /(the descripcion|el descripcion)/i;
     let regexCategoria = /(the id categoria|el id categoria)/i;
     let regexPrecio_compra = /(the precio compra|el precio compra)/i;
     let regexPrecio_venta = /(the precio venta|el precio venta)/i;
     let regexStock = /(the stock|el stock)/i;
     if(data.errors)
     { 
      data.errors.forEach(element => {
        if(element.match(regexCodigo)){$('#codigoError').html('<strong class="invalid text-danger">'+element+'</strong>');}
        if(element.match(regexDescripcion)){$('#descripcionError').html('<strong class="invalid text-danger">'+element+'</strong>');}
        if(element.match(regexCategoria)){$('#id_categoriaError').html('<strong class="invalid text-danger">'+element+'</strong>');}
        if(element.match(regexPrecio_compra)){$('#precio_compraError').html('<strong class="invalid text-danger">'+element+'</strong>');}
        if(element.match(regexPrecio_venta)){$('#precio_ventaError').html('<strong class="invalid text-danger">'+element+'</strong>');}
        if(element.match(regexStock)){$('#stockError').html('<strong class="invalid text-danger">'+element+'</strong>');}

        else{
          //  swal ( "Error al Editar Producto!" ,  "Producto o Email" ,  "error" )
          console.log(element);
        }

         });
     }
     if(data.success)
     {
       $('#agregarProducto').html('');
swal({
    title: "Producto Editado Correctamente!",
    text: "Verifica en la lista de productos",
    icon: "success"
}).then(function() {
    window.location.reload();
});  // html = '<div class="alert alert-success">' + data.success + '</div>';
      // $('#sample_form')[0].reset();
      // $('#store_image').html('');
      // window.location.reload();
      // window.location.href = "/productos";
     }
     $('#form_result').html(html);
    }
   });
  }
 });
 
   $(document).on('click', '.edit', function(){
      var id = $(this).attr('id');
      $('#form_result').html('');
      $('.invalid').html('');
  $.ajax({
   url:"/productos/"+id+"/edit",
   dataType:"json",
   success:function(html){
     console.log(html);
    $('#id_categoria').val(html.data.id_categoria);
    $('#descripcion').val(html.data.descripcion);
    $('#codigo').val(html.data.codigo);
    $('#stock').val(html.data.stock);
    $('#foto').html("<img src={{ URL::to('/storage') }}/products/" + html.data.imagen + " class='img-thumbnail previzualizar' alt='pic' width='80px'/>");
    $('#foto').append("<input type='hidden' name='hidden_image' value='"+html.data.imagen+"' />");
    $('#precio_compra').val(html.data.precio_compra);
    $('#precio_venta').val(html.data.precio_venta);
    $('#hidden_id').val(html.data.id);
    $('.modal-title').text("Editar Producto");
    $('#action_button').val("Edit");
    $('#action').val("Edit");
    $('#agregarProducto').modal('show');
   }
  })
 });    
  var product_id;

 $(document).on('click', '.delete', function(){
  product_id = $(this).attr('id');
  swal({
  title: "Estas seguro de eliminar el producto?",
  text: "Una vez eliminado, el producto no se puede recuperar!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
      $.ajax({
   url:"productos/destroy/"+product_id,
   success:function(data)
   {
    swal("Poof! El Producto fue eliminado con exito!", {
      icon: "success",
    }).then(function() {
    // window.location = "/productos";
        window.location.reload();

});
  
   }
    
  })
  } 
  else {
    swal("EL PRODUCTO NO FUE BORRADO!");
  }
        

});
 });
 
       
</script>

@endsection

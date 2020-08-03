@extends('layouts.plantilla')

@section('content')

{{-- Sweet alert el registro de cliente --}}
 {{-- @if (count($errors->all())>0)
          <script>
				  swal ( "Error al Crear cliente!" ,  "Verifica el Formulario de registro" ,  "error" )
        </script>
        {{ $errors }}
  @endif --}}
  {{-- @if(session('info'))
  <script>
    swal ( "Cliente Creado Correctamente!" ,  "Verifica en la lista de Clientess" ,  "success" )
  </script>        
  @endif --}}
  
{{-- Fin de alertas en el registro de Clientes --}}
     
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 d-inline">
            <h1 class="inline">Administrar Clientes</h1>
            <small> Nielsen CCA</small>
          </div>

          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Inicio</a></li>
              <li class="breadcrumb-item active">Clientes</li>
            </ol>
          </div>

        </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Modal Agregar Cliente -->
      <div class="card">
        <div class="card-header">
           <button class="btn btn-primary" data-toggle="modal" data-target="#agregarCliente" name="create_record" id="create_record">
            Agregar Cliente
          </button>
        </div>
        {{-- TABLA DE CLIENTESS --}}
        <div class="card-body">
      <table id="client_table" class="table table-bordered table-striped dataTable dtr-inline tablas">
        <thead>
          <tr>
            <th style="width: 10px">#</th>
            <th>Cliente</th>
            <th>Documento</th>
            <th>Email</th>
            <th>Telefono</th>
            <th>Dirección</th>
            <th>Fecha de Nacimiento</th>
            <th>Total Compras</th>
            <th>Ultima Compra</th>
            <th>Agregado al sistema</th>
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
  if($('#action').val() == "Edit Cliente")
  {
   $.ajax({
    url:"{{ route('clientes.update') }}",
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
     let regexName = /(the name|el nombre)/i;
     let regexDocumento = /(the documento|el documento)/i;
     let regexDireccion = /(the direccion|el direccion)/i;
     let regexTelefono = /(the telefono|el telefono)/i;
     let regexNacimiento = /(the fecha nacimiento|el fecha nacimiento)/i;
     let regexEmail = /(the email|el email)/i;

     if(data.errors)
     { 
      data.errors.forEach(element => {
        if(element.match(regexName)){$('#nameError').html('<strong class="invalid text-danger">'+element+'</strong>');}
        if(element.match(regexDocumento)){$('#documentoError').html('<strong class="invalid text-danger">'+element+'</strong>');}
        if(element.match(regexDireccion)){$('#direccionError').html('<strong class="invalid text-danger">'+element+'</strong>');}
        if(element.match(regexTelefono)){$('#telefonoError').html('<strong class="invalid text-danger">'+element+'</strong>');}
        if(element.match(regexNacimiento)){$('#fecha_nacimientoError').html('<strong class="invalid text-danger">'+element+'</strong>');}
        if(element.match(regexEmail)){$('#emailError').html('<strong class="invalid text-danger">'+element+'</strong>');}

        else{
          console.log(element)
        }
         });
    
     }
     if(data.success)
     {
       $('#agregarCliente').html('');
swal({
    title: "Cliente Editade Correctamente!",
    text: "Verifica en la lista de clientes",
    icon: "success"
}).then(function() {
    window.location.reload();
});  // html = '<div class="alert alert-success">' + data.success + '</div>';
      // $('#sample_form')[0].reset();
      // $('#store_image').html('');
      // window.location.reload();
      // window.location.href = "/clientes";
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
   url:"/clientes/"+id+"/edit",
   dataType:"json",
   success:function(html){
     console.log(html);
   
    $('#name').val(html.data.name);
    $('#documento').val(html.data.documento);
    $('#fecha_nacimiento').val(html.data.fecha_nacimiento);
    $('#email').val(html.data.email);
    $('#telefono').val(html.data.telefono);
    $('#direccion').val(html.data.direccion);
    $('#hidden_id').val(html.data.id);
    $('.modal-title').text("Editar Cliente");
    $('#action_button').val("Edit Cliente");
    $('#action').val("Edit Cliente");
    $('#agregarCliente').modal('show');
   }
  })
 });    
  var cliente_id;

 $(document).on('click', '.delete', function(){
  cliente_id = $(this).attr('id');
  swal({
  title: "Estas segure de eliminar al cliente?",
  text: "Una vez eliminade, no se puede recuperar!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
      $.ajax({
   url:"clientes/destroy/"+cliente_id,
   success:function(data)
   {
    swal("Poof! Le Cliente fue eliminade con exito!", {
      icon: "success",
    }).then(function() {
    
        window.location.reload();

});
  
   }
    
  })
  } 
  else {
    swal("LE CLIENTE NO FUE BORRADE!");
  }
        

});
 });
 
       
</script>

@endsection
@section('scripts')
<script src="{{ asset('/js/clientes.js') }}"></script>
@endsection
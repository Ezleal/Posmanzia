@extends('layouts.plantilla')

@section('content')


{{-- Sweet alert el registro de venta --}}
 {{-- @if (count($errors->all())>0)
          <script>
				  swal ( "Error al Crear venta!" ,  "Verifica el Formulario de registro" ,  "error" )
        </script>
        {{ $errors }}
  @endif --}}
  {{-- @if(session('info'))
  <script>
    swal ( "Venta Creado Correctamente!" ,  "Verifica en la lista de Ventas" ,  "success" )
  </script>        
  @endif --}}
  
{{-- Fin de alertas en el registro de Venta --}}
     
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 d-inline">
            <h1 class="inline">Administrar Ventas</h1>
            <small> Nielsen CCA</small>
          </div>

          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Inicio</a></li>
              <li class="breadcrumb-item active">Ventas</li>
            </ol>
          </div>

        </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Modal Agregar Venta -->
      <div class="card">
        <div class="card-header">
           <button class="btn btn-primary" data-toggle="modal" data-target="#agregarVenta" name="create_record" id="create_record">
            Agregar Venta
          </button>
    
        </div>
        {{-- TABLA DE VENTAS --}}
        <div class="card-body">
      <table id="ventas_table" class="table table-bordered table-striped dataTable dtr-inline tablas">
        <thead>
          <tr>
            <th style="width: 10px">#</th>
            <th>Venta</th>
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

{{-- Modal Agregar Venta --}}
<!-- Modal -->
<div class="modal fade" id="agregarVenta" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form  method="post" id="sample_form">
        @csrf
      <div class="modal-header" style="background: #343a40; color: white">
        <h5 class="modal-title" id="exampleModalLongTitle">Nueva Venta</h5>
        <button style="color:#ffffff" type="button" class="close btn btn-primary" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <span id="form_result"></span>
        <div class="box-body">
       {{-- Entrada para el Nombre de la Venta --}}
       <div class="mb-3">
          <div class="input-group">
            <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-th"></span>
            </div>
          </div>
          <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  id="name" autocomplete="name" autofocus placeholder="Ingrese el Nombre de la Venta">
        </div>
        <div>
            <span id="nameError" role="alert">
            </span>
        </div>   
      </div>       
        </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="action" id="action" />
        <input type="hidden" name="hidden_id" id="hidden_id" />
        <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Salir</button>
        <input type="submit" name="action_button" id="action_button" value="Add Venta" class="btn btn-primary"/>
      </div>
    </div>
    </form>
  </div>
</div>
{{-- FIN MODAL AGREGAR VENTA --}}

<script>
 $('#create_record').click(function(){
  $('.modal-title').text("Nueva Venta");
  $('.invalid').html('');
     $('#action_button').val("Add Venta");
     $('#action').val("Add Venta");
     $('#agregarVenta').modal('show');
     $('#sample_form')[0].reset();
 });
  $('#sample_form').on('submit', function(event){
   event.preventDefault();
  if($('#action').val() == 'Add Venta')
  {
   $.ajax({
    url:"{{ route('ventas.store') }}",
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
       data.errors.forEach(element => {
         
        if(element.match(regexName)){$('#nameError').html('<strong class="invalid text-danger">'+element+'</strong>');}
        else{
          //  swal ( "Error al Editar Venta!" ,  "Venta o Email" ,  "error" )
          console.log(element);
        }

         });
     }
     if(data.success)
     {
        $('#agregarVenta').html('');
           swal({
                title: "Venta Creada Correctamente!",
                text: "Verifica en la lista de ventas",
                icon: "success"
            }).then(function() {
                // window.location = "/ventas";
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
  if($('#action').val() == "Edit Venta")
  {
   $.ajax({
    url:"{{ route('ventas.update') }}",
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
     if(data.errors)
     { 
      data.errors.forEach(element => {
        if(element.match(regexName)){$('#nameError').html('<strong class="invalid text-danger">'+element+'</strong>');}
        else{
          console.log(element)
        }
         });
    
     }
     if(data.success)
     {
       $('#agregarVenta').html('');
swal({
    title: "Venta Editada Correctamente!",
    text: "Verifica en la lista de ventas",
    icon: "success"
}).then(function() {
    window.location.reload();
});  // html = '<div class="alert alert-success">' + data.success + '</div>';
      // $('#sample_form')[0].reset();
      // $('#store_image').html('');
      // window.location.reload();
      // window.location.href = "/ventas";
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
   url:"/ventas/"+id+"/edit",
   dataType:"json",
   success:function(html){
     console.log(html);
   
    $('#name').val(html.data.name);

    $('#hidden_id').val(html.data.id);
    $('.modal-title').text("Editar Venta");
    $('#action_button').val("Edit Venta");
    $('#action').val("Edit Venta");
    $('#agregarVenta').modal('show');
   }
  })
 });    
  var venta_id;

 $(document).on('click', '.delete', function(){
  venta_id = $(this).attr('id');
  swal({
  title: "Estas seguro de eliminar la venta?",
  text: "Una vez eliminado, no se puede recuperar!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
      $.ajax({
   url:"ventas/destroy/"+venta_id,
   success:function(data)
   {
    swal("Poof! La Venta fue eliminada con exito!", {
      icon: "success",
    }).then(function() {
    
        window.location.reload();

});
  
   }
    
  })
  } 
  else {
    swal("LA VENTA NO FUE BORRADO!");
  }
        

});
 });
 
       
</script>

@endsection
@section('scripts')
<script src="{{ asset('/js/ventas.js') }}"></script>    
@endsection
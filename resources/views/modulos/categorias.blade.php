@extends('layouts.plantilla')

@section('content')
@section('scripts')
<script src="{{ asset('/js/categorias.js') }}"></script>    
@endsection

{{-- Sweet alert el registro de usuario --}}
 {{-- @if (count($errors->all())>0)
          <script>
				  swal ( "Error al Crear Usuario!" ,  "Verifica el Formulario de registro" ,  "error" )
        </script>
        {{ $errors }}
  @endif --}}
  {{-- @if(session('info'))
  <script>
    swal ( "Usuario Creado Correctamente!" ,  "Verifica en la lista de usuarios" ,  "success" )
  </script>        
  @endif --}}
  
{{-- Fin de alertas en el registro de usuario --}}
     
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 d-inline">
            <h1 class="inline">Administrar Categorías</h1>
            <small> Nielsen CCA</small>
          </div>

          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Inicio</a></li>
              <li class="breadcrumb-item active">Categorias</li>
            </ol>
          </div>

        </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Modal Agregar Categoria -->
      <div class="card">
        <div class="card-header">
           <button class="btn btn-primary" data-toggle="modal" data-target="#agregarCategoria" name="create_record" id="create_record">
            Agregar Categoria
          </button>
    
        </div>
        {{-- TABLA DE CATEGORIAS --}}
        <div class="card-body">
      <table id="category_table" class="table table-bordered table-striped dataTable dtr-inline tablas">
        <thead>
          <tr>
            <th style="width: 10px">#</th>
            <th>Categoria</th>
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

{{-- Modal Agregar Usuario --}}
<!-- Modal -->
<div class="modal fade" id="agregarCategoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form  method="post" id="sample_form">
        @csrf
      <div class="modal-header" style="background: #343a40; color: white">
        <h5 class="modal-title" id="exampleModalLongTitle">Nueva Categoria</h5>
        <button style="color:#ffffff" type="button" class="close btn btn-primary" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <span id="form_result"></span>
        <div class="box-body">
       {{-- Entrada para el Nombre de la Categoria --}}
       <div class="mb-3">
          <div class="input-group">
            <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-th"></span>
            </div>
          </div>
          <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  id="name" autocomplete="name" autofocus placeholder="Ingrese el Nombre de la Categoria">
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
        <input type="submit" name="action_button" id="action_button" value="Add Categoria" class="btn btn-primary"/>
      </div>
    </div>
    </form>
  </div>
</div>
{{-- FIN MODAL AGREGAR CATEGORIA --}}

<script>
 $('#create_record').click(function(){
  $('.modal-title').text("Nueva Categoria");
  $('.invalid').html('');
     $('#action_button').val("Add Categoria");
     $('#action').val("Add Categoria");
     $('#agregarCategoria').modal('show');
     $('#sample_form')[0].reset();
 });
  $('#sample_form').on('submit', function(event){
   event.preventDefault();
  if($('#action').val() == 'Add Categoria')
  {
   $.ajax({
    url:"{{ route('categorias.store') }}",
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
          //  swal ( "Error al Editar Usuario!" ,  "Usuario o Email" ,  "error" )
          console.log(element);
        }

         });
     }
     if(data.success)
     {
        $('#agregarCategoria').html('');
           swal({
                title: "Categoria Creada Correctamente!",
                text: "Verifica en la lista de categorias",
                icon: "success"
            }).then(function() {
                // window.location = "/usuarios";
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
  if($('#action').val() == "Edit Categoria")
  {
   $.ajax({
    url:"{{ route('categorias.update') }}",
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
       $('#agregarCategoria').html('');
swal({
    title: "Categoria Editada Correctamente!",
    text: "Verifica en la lista de categorias",
    icon: "success"
}).then(function() {
    window.location.reload();
});  // html = '<div class="alert alert-success">' + data.success + '</div>';
      // $('#sample_form')[0].reset();
      // $('#store_image').html('');
      // window.location.reload();
      // window.location.href = "/usuarios";
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
   url:"/categorias/"+id+"/edit",
   dataType:"json",
   success:function(html){
     console.log(html);
   
    $('#name').val(html.data.name);

    $('#hidden_id').val(html.data.id);
    $('.modal-title').text("Editar Categoria");
    $('#action_button').val("Edit Categoria");
    $('#action').val("Edit Categoria");
    $('#agregarCategoria').modal('show');
   }
  })
 });    
  var category_id;

 $(document).on('click', '.delete', function(){
  category_id = $(this).attr('id');
  swal({
  title: "Estas seguro de eliminar la categoria?",
  text: "Una vez eliminado, no se puede recuperar!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
      $.ajax({
   url:"categorias/destroy/"+category_id,
   success:function(data)
   {
    swal("Poof! La Categoria fue eliminada con exito!", {
      icon: "success",
    }).then(function() {
    
        window.location.reload();

});
  
   }
    
  })
  } 
  else {
    swal("LA CATEGORIA NO FUE BORRADO!");
  }
        

});
 });
 
       
</script>

@endsection

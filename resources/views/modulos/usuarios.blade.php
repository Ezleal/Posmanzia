@extends('layouts.plantilla')

@section('content')

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
            <h1 class="inline">Administrar Usuarios</h1>
            <small> Nielsen CCA</small>
          </div>

          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Inicio</a></li>
              <li class="breadcrumb-item active">Usuario</li>
            </ol>
          </div>

        </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Modal Agregar Usuario -->
      <div class="card">
        <div class="card-header">
           <button class="btn btn-primary" data-toggle="modal" data-target="#agregarUsuario" name="create_record" id="create_record">
            Agregar Usuario
          </button>
    
        </div>
        {{-- TABLA DE USUARIOS --}}
        <div class="card-body">
      <table id="user_table" class="table table-bordered table-striped dataTable dtr-inline tablas">
        <thead>
          <tr>
            <th style="width: 10px">#</th>
            <th>Nombre</th>
            <th>Usuario</th>
            <th>Foto</th>
            <th>Email</th>
            <th>Perfil</th>
            <th>Estado</th>
            <th>Último Login</th>
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
<div class="modal fade" id="agregarUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form  method="post" id="sample_form" enctype="multipart/form-data">
        @csrf
      <div class="modal-header" style="background: #343a40; color: white">
        <h5 class="modal-title" id="exampleModalLongTitle">Agregar Usuario</h5>
        <button style="color:#ffffff" type="button" class="close btn btn-primary" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <span id="form_result"></span>
        <div class="box-body">
       {{-- Entrada para el Nombre --}}
       <div class="mb-3">
          <div class="input-group">
            <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user-tie"></span>
            </div>
          </div>
          <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  id="name" autocomplete="name" autofocus placeholder="Ingrese Nombre Completo">
        </div>
        <div>
            <span id="nameError" role="alert">
            </span>
        </div>   
      </div>  
       {{-- Entrada para el Usuario --}}
       <div class="mb-3">
          <div class="input-group">
            <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
          <input  type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username" value="{{ old('username') }}"  autocomplete="username" autofocus placeholder="Ingrese Nombre de Usuario">  
        </div>
        <div>
            <span  role="alert" id="usernameError">
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
          <input  type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}"  autocomplete="email" autofocus placeholder="Ingrese Correo">
        </div>
        <div>
          <span  role="alert" id="emailError"> </span>
        </div>
    </div>
           {{-- Entrada para el Password --}}
      <div class="mb-3">
          <div class="input-group">
            <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          <input  type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" value="{{ old('password') }}"  autocomplete="password" autofocus placeholder="Ingrese Nueva Contraseña">
        </div>
        <div>
          <span  role="alert" id="passwordError"> </span>
        </div>
    </div>
         {{-- Entrada para el Re-Password --}}
              <div class="input-group mb-3">
            <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" autocomplete="new-password" placeholder="Confirme Nueva Contraseña">          
        </div>
          
            {{-- Entrada para el Perfil --}}
       <div class="mb-3">
          <div class="form-group">
            <div class="input-group-prepend">
              <div class="input-group-text">
              <span class="fa fa-users"></span>
              </div>
              <select class="form-control input-lg" type="text" name="perfil">
                <option selected disabled>Seleccionar Perfil </option>
     {{-- Se busca la información desde la bd prioridad para el select --}}
                 @if (!empty($perfiles))
                      @foreach ($perfiles as $perfil)
                <option value="{{ $perfil->id }}">{{ $perfil->name }}</option>
                  @endforeach
                 @endif
              </select>
            </div>
          </div>
          <div>
          <span  role="alert" id="perfilError"> </span>
        </div>
        </div>
                 {{-- Entrada para Foto --}}
          <div class="form-group row">
            <div class="col-sm-12 col-md-6">
           <div class="panel">
              <label class="control-label">Seleccionar imagen de perfil</label>
          {{-- <div class="panel text-uppercase">SUBIR FOTO</div> --}}
          </div>
            <input type="file" class="foto" name="foto" >
            <p class="help-block">Peso maximo de la foto 2 MB</p>
          </div>
          <div class="col-sm-12	col-md-4 ml-5" id="foto">
            <img src="{{ Storage::url('profile_images/default.jpg') }}" class="img-thumbnail previzualizar" alt="pic" width="80px">
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
{{-- FIN MODAL AGREGAR USUARIO --}}

<script>
 $('#create_record').click(function(){
  $('.modal-title').text("Add New Record");
  $('.invalid').html('');
  $('#foto').html('');
  $('#foto').html("<img src={{ URL::to('/storage') }}/profile_images/default.jpg class='img-thumbnail previzualizar' alt='pic' width='80px'/>");
     $('#action_button').val("Add");
     $('#action').val("Add");
     $('#agregarUsuario').modal('show');
     $('#sample_form')[0].reset();
 });
  $('#sample_form').on('submit', function(event){
   event.preventDefault();
  if($('#action').val() == 'Add')
  {
   $.ajax({
    url:"{{ route('usuarios.store') }}",
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
     let regexUsername = /(the username|el username)/i;
     let regexEmail = /(the email|el email)/i;
     let regexPassword = /(the password|el password)/i;
     let regexPerfil = /(the perfil|el perfil)/i;
       data.errors.forEach(element => {
         
        if(element.match(regexName)){$('#nameError').html('<strong class="invalid text-danger">'+element+'</strong>');}
        if(element.match(regexUsername)){$('#usernameError').html('<strong class="invalid text-danger">'+element+'</strong>');}
        if(element.match(regexEmail)){$('#emailError').html('<strong class="invalid text-danger">'+element+'</strong>');}
        if(element.match(regexPassword)){$('#passwordError').html('<strong class="invalid text-danger">'+element+'</strong>');}
        if(element.match(regexPerfil)){$('#perfilError').html('<strong class="invalid text-danger">'+element+'</strong>');}
        else{
          //  swal ( "Error al Editar Usuario!" ,  "Usuario o Email" ,  "error" )
          console.log(element);
        }

         });
     }
     if(data.success)
     {
        $('#agregarUsuario').html('');
           swal({
                title: "Usuario Creado Correctamente!",
                text: "Verifica en la lista de usuarios",
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
  if($('#action').val() == "Edit")
  {
   $.ajax({
    url:"{{ route('usuarios.update') }}",
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
     let regexUsername = /(the username|el username)/i;
     let regexEmail = /(the email|el email)/i;
     let regexPassword = /(the password|el password)/i;
     let regexPerfil = /(the perfil|el perfil)/i;
     if(data.errors)
     { 
      data.errors.forEach(element => {
        if(element.match(regexName)){$('#nameError').html('<strong class="invalid text-danger">'+element+'</strong>');}
        if(element.match(regexUsername)){$('#usernameError').html('<strong class="invalid text-danger">'+element+'</strong>');}
        if(element.match(regexEmail)){$('#emailError').html('<strong class="invalid text-danger">'+element+'</strong>');}
        if(element.match(regexPassword)){$('#passwordError').html('<strong class="invalid text-danger">'+element+'</strong>');}
        if(element.match(regexPerfil)){$('#perfilError').html('<strong class="invalid text-danger">'+element+'</strong>');}
        else{
          console.log(element)
        }
        
       

         });
    
     }
     if(data.success)
     {
       $('#agregarUsuario').html('');
swal({
    title: "Usuario Editado Correctamente!",
    text: "Verifica en la lista de usuarios",
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
   url:"/usuarios/"+id+"/edit",
   dataType:"json",
   success:function(html){
     console.log(html);
    $('#name').val(html.data.name);
    $('#username').val(html.data.username);
    $('#email').val(html.data.email);
    $('#foto').html("<img src={{ URL::to('/storage') }}/profile_images/" + html.data.foto + " class='img-thumbnail previzualizar' alt='pic' width='80px'/>");
    $('#foto').append("<input type='hidden' name='hidden_image' value='"+html.data.foto+"' />");
    $('#hidden_id').val(html.data.id);
    $('.modal-title').text("Edit New Record");
    $('#action_button').val("Edit");
    $('#action').val("Edit");
    $('#agregarUsuario').modal('show');
   }
  })
 });    
  var user_id;

 $(document).on('click', '.delete', function(){
  user_id = $(this).attr('id');
  swal({
  title: "Estas seguro de eliminar al usuario?",
  text: "Una vez eliminado, el usuario no se puede recuperar!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
      $.ajax({
   url:"usuarios/destroy/"+user_id,
   success:function(data)
   {
    swal("Poof! El usuario fue eliminado con exito!", {
      icon: "success",
    }).then(function() {
    // window.location = "/usuarios";
        window.location.reload();

});
  
   }
    
  })
  } 
  else {
    swal("EL USUARIO NO FUE BORRADO!");
  }
        

});
 });
       
</script>

@endsection

@extends('layouts.plantilla')

@section('content')

{{-- Sweet alert el registro de usuario --}}
 @if (count($errors->all())>0)
          <script>
				  swal ( "Error al Crear Usuario!" ,  "Verifica el Formulario de registro" ,  "error" )
        </script>
        {{ $errors }}
  @endif
  @if(session('info'))
  <script>
    swal ( "Usuario Creado Correctamente!" ,  "Verifica en la lista de usuarios" ,  "success" )
  </script>        
  @endif
    @if(session('updateuser'))
  <script>
    swal ( "Usuario Creado Correctamente!" ,  "Verifica en la lista de usuarios" ,  "success" )
  </script>        
  @endif
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
           {{-- <tr>
             @foreach($users as $user)
              <td>{{ $user->id }}</td>
              <td>{{ $user->name }}</td>
              <td>{{ $user->username }}</td>
              <td><img style="width: 40px" src="/storage/profile_images/{{ $user->foto }}" alt=""></td>
              <td>{{ $user->email }}</td>
              <td>
                  @if ($user->perfil == 1)
                       Administrador
                  @endif
                  @if ($user->perfil == 2)
                        Especial
                  @endif
                  @if ($user->perfil == 3)
                        Vendedor
                  @endif
               
              </td>
              <td>
              @if (($user->estado == 1))
              <button class="btn btn-success btn-sm">
                Activado
              </button></td>
              @else
              <button class="btn btn-danger btn-sm">
                Desactivado
              </button></td>
              @endif
              
              <td>{{ $user->ultima_login }}</td>
              <td> 
                <div class="btn-group">
                  <button class="btn btn-primary btnEditar" idUsuario="{{ $user->id }}" data-toggle="modal" data-target="#modalEditarUsuario"><i class="fas fa-pencil-alt"></i></button>
                  <button class="btn btn-danger"><i class="fas fa-times"></i></button>
                </div>
              </td>
           </tr>
            @endforeach --}}
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
      <form  action="{{ route('usuarios.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
      <div class="modal-header" style="background: #343a40; color: white">
        <h5 class="modal-title" id="exampleModalLongTitle">Agregar Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="box-body">
       {{-- Entrada para el Nombre --}}
          <div class="input-group mb-3">
            <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user-tie"></span>
            </div>
          </div>
          <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus placeholder="Ingrese Nombre Completo">
          @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
          
        </div>
       {{-- Entrada para el Usuario --}}
          <div class="input-group mb-3">
            <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
          <input  type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}"  autocomplete="username" autofocus placeholder="Ingrese Nombre de Usuario">
          @error('username')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
          
        </div>
           {{-- Entrada para el Email --}}
          <div class="input-group mb-3">
            <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          <input  type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" autofocus placeholder="Ingrese Correo">
          @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
          
        </div>
           {{-- Entrada para el Password --}}
          <div class="input-group mb-3">
            <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          <input  type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}"  autocomplete="password" autofocus placeholder="Ingrese Nueva Contraseña">
          @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
          
        </div>
         {{-- Entrada para el Re-Password --}}
              <div class="input-group mb-3">
            <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
            <input type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirme Nueva Contraseña">          
        </div>
          
            {{-- Entrada para el Perfil --}}
          <div class="form-group">
            <div class="input-group-prepend">
              <div class="input-group-text">
              <span class="fa fa-users"></span>
              </div>
              <select class="form-control input-lg" type="text" name="perfil">
                <option selected disabled>Seleccionar Perfil </option>
                <option value="1">Administrador </option>
                <option value="2">Especial </option>
                <option value="3">Vendedor </option>
              </select>
            </div>
          </div>
                 {{-- Entrada para Foto --}}
          <div class="form-group row">
            <div class="col-sm-12 col-md-6">
            <div class="panel text-uppercase">SUBIR FOTO</div>
            <input type="file" class="foto" name="foto">
            <p class="help-block">Peso maximo de la foto 2 MB</p>
          </div>
          <div class="col-sm-12	col-md-4 ml-5">
            <img src="{{ Storage::url('profile_images/default.jpg') }}" class="img-thumbnail previzualizar" alt="pic" width="80px">
          </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Salir</button>
        <button type="submit" class="btn btn-primary"> {{ __('Guardar Usuario') }}</button>
      </div>
    </div>
    </form>
  </div>
</div>
{{-- FIN MODAL AGREGAR USUARIO --}}

<!----------------------------------------
            Modal Editar Usuario
----------------------------------------->
<div id="formModal" class="modal fade" role="dialog">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar Usuario</h4>
        </div>
        <div class="modal-body">
         <span id="form_result"></span>
         <form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data" >
          @csrf
          <div class="form-group">
            <label class="control-label col-md-4" >Name : </label>
            <div class="col-md-8">
             <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" />
             @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            </div>
           </div>
           <div class="form-group">
            <label class="control-label col-md-4">Username : </label>
            <div class="col-md-8">
             <input type="text" name="username" id="username" class="form-control" />
            </div>
           </div>
           <div class="form-group">
            <label class="control-label col-md-4">Email : </label>
            <div class="col-md-8">
             <input type="text" name="email" id="email" class="form-control" />
            </div>
           </div>
             
           <div class="form-group">
            <label class="control-label col-md-4">Select Profile Image : </label>
            <div class="col-md-8">
             <input type="file" name="foto" id="foto" />
             <span id="store_image"></span>
            </div>
           </div>
           <br />
           <div class="form-group" align="center">
            <input type="hidden" name="action" id="action" />
            <input type="hidden" name="hidden_id" id="hidden_id" />
            <input type="submit" name="action_button" id="action_button" class="btn btn-warning" value="Add" />
           </div>
         </form>
        </div>
     </div>
    </div>
</div>

<div id="confirmModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 class="modal-title">Confirmation</h2>
            </div>
            <div class="modal-body">
                <h4 align="center" style="margin:0;">Are you sure you want to remove this data?</h4>
            </div>
            <div class="modal-footer">
             <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<script>
  $('#sample_form').on('submit', function(event){
  event.preventDefault()
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
     var html = '';
     if(data.errors)
     {
      html = '<div class="alert alert-danger">';
      for(var count = 0; count < data.errors.length; count++)
      {
       html += '<p>' + data.errors[count] + '</p>';
      }
      html += '</div>';
     }
     if(data.success)
     {
      html = '<div class="alert alert-success">' + data.success + '</div>';
      $('#sample_form')[0].reset();
      $('#store_image').html('');
     }
     $('#form_result').html(html);
    }
   });
  }
 });
   $(document).on('click', '.edit', function(){
  var id = $(this).attr('id');
  $('#form_result').html('');
  $.ajax({
   url:"/usuarios/"+id+"/edit",
   dataType:"json",
   success:function(html){
     console.log(html);
    $('#name').val(html.data.name);
    $('#username').val(html.data.username);
    $('#email').val(html.data.email);
    $('#store_image').html("<img src={{ URL::to('/storage') }}/profile_images/" + html.data.foto + " width='70' class='img-thumbnail' />");
    $('#store_image').append("<input type='hidden' name='hidden_image' value='"+html.data.foto+"' />");
    $('#hidden_id').val(html.data.id);
    $('.modal-title').text("Edit New Record");
    $('#action_button').val("Edit");
    $('#action').val("Edit");
    $('#formModal').modal('show');
   }
  })
 });               
	
</script>

@endsection

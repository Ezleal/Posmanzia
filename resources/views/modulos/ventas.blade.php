@extends('layouts.plantilla')

@section('content')

@if(session('info'))
  <script>
    swal ( "Venta Editada Correctamente!" ,  "Verifica en la lista de Ventas" ,  "success" )
  </script>        
  @endif'

{{-- Sweet alert el registro de venta --}}
 {{-- @if (count($errors->all())>0)
          <script>
				  swal ( "Error al Crear venta!" ,  "Verifica el Formulario de registro" ,  "error" )
        </script>
        {{ $errors }}
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
          <a href="{{route('ventas.create')}}">
           <button  class="btn btn-primary" name="create_record" id="create_record">
            Crear Venta
          </button>
          </a>
        </div>
        {{-- TABLA DE VENTAS --}}
        <div class="card-body">
      <table id="ventas_table" class="table table-bordered table-striped dataTable dtr-inline tablas">
        <thead>
          <tr>
            <th style="width: 10px">#</th>
            <th>Codigo Factura</th>
            <th>Cliente</th>
            <th>Vendedor</th>
            <th>Forma de Pago</th>
            <th>Neto</th>
            <th>Total</th>
            <th>Fecha</th>
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



<script>

     /* Borrado de Ventas */    
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
 
         /* Fin de Borrado de Ventas */ 
</script>

@endsection
@section('scripts')
<script src="{{ asset('/js/ventas.js') }}"></script>    
@endsection
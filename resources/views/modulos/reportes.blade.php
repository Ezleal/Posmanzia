@extends('layouts.plantillaReportes')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 d-inline">
            <h1 class="inline">Reportes de Ventas</h1>
            <small> Nielsen CCA</small>
          </div>

          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Inicio</a></li>
              <li class="breadcrumb-item active">Reportes</li>
            </ol>
          </div>

        </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

     @include('../reportes.graficoVentas')
          <div class="row">
          <div class="col-md-6 col-xs-12">
            @include('../reportes.graficoVendedores')
          </div>
          <div class="col-md-6 col-xs-12 float-right">
            @include('../reportes.graficoCompradores')
          </div>
          <div class="col-md-6 offset-md-3 col-xs-12">
              @include('../reportes.graficoCircular')
            </div>
         </div>
 


    </section>
@endsection
@section('scripts')
  <script src="{{ asset('/js/reportes.js') }}"></script>  
@endsection
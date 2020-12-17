@extends('layouts.plantillaReportes')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 d-inline">
            <h1 class="inline">Contenido Principal</h1>
            <small> Nielsen CCA</small>
          </div>

          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Inicio</a></li>
              <li class="breadcrumb-item active">Panel</li>
            </ol>
          </div>

        </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="row">

       @include('modulos/home/cajasSuperiores')

    </div>
     <div class="row">

       @include('modulos/home/cajasMedias')

    </div>
    <div class="row">
      <div class="col-lg-6 col-12">

        @include('reportes/graficoCircular')

      </div>
      <div class="col-lg-6 col-12">

        @include('modulos/home/cajasReportes')

      </div>
    </div>
  

    </section>
    <!-- /.content -->
 

@endsection
@section('scripts')
  <script src="{{ asset('/js/reportes.js') }}"></script>  
@endsection
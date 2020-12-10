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

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <div class="card-tools float-left">
             <input value="" type="hidden" name="from_date" id="from_date" class="form-control" placeholder="From Date" readonly />
                    <input value="" type="hidden" name="to_date" id="to_date" class="form-control" placeholder="To Date" readonly />
             {{-- RANGOS DE FECHAS CON DATAPICKER PLUGIN --}}
          <button type="button" class="btn btn-primary float-left" id="daterange-rpt">
            <span>
              <i class="fas fa-calendar-alt pr-2"></i>Fechas
            </span>
            <i class="fa fa-caret-down"></i>
          </button>
          <button type="button" name="filter" id="filter" class="btn btn-outline-success float-right">Filtrar</button>
          <button type="button" name="refresh" id="refresh" class="btn btn-outline-dark float-right">Limpiar</button>
    
          </div>

          
        </div>

        <div class="card-body">
            <div class="box box-solid d-inline ">
              <div class="box-header bg-gradient-danger p-2">
                <i class="fas fa-th fa-2x"></i>             
                <h3 class="box-title d-inline pl-1">Grafico de Ventas</h3>
              
              <div class="box-body border-radius-none nuevoGraficoVentas">
                <div class="chart" id="line-chart-ventas" style="height: 250px"></div>
              </div>
              </div>
            </div>
        </div>
        <!-- /.card-body -->
       
      </div>
      <!-- /.card -->
<?php
        error_reporting(0);

        $arrayFechas = array();
        $arrayVentas = array();
        $sumaTotalMes = array();

        foreach ($todos as $value) {
          // capturamos solo el año y el mes
          $fecha = substr($value["fecha"],0,7  );
          // Introducimos cada fecha en un array
          array_push($arrayFechas, $fecha);
          // capturamos solo el año y el mes
          $arrayVentas = array($fecha => $value["total"]);
          // Sumamos las ventas por mes
          foreach($arrayVentas as $key => $value)
          {
             $sumaTotalMes[$key] += $value;
          }
        
        }
         
        // TOMAMOS EL ARRAY DE FECHAS Y SOLO SELECCIONAMOS LAS NO REPETIDAS

      $fechasSinRepetir = array_unique($arrayFechas);

        ?>
      {{-- Grafico Cirular Inicio --}}
    <div class="col-md-6 col-xs-12">
      <div class="card">
        <div class="card-header">
           <h3 class="card-title mb-0">Productos Mas Vendidos</h3>
              </div>
              <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                  <div class="col-md-7">
                    <div class="chart-responsive">
                      <canvas id="pieChart" height="150"></canvas>
                    </div>
                    <!-- ./chart-responsive -->
              </div>
                  <!-- /.col -->
              <div class="col-md-5">
                    <ul class="chart-legend clearfix">
                    <?php
                       for ($i = 0; $i < 6; $i++){

                         echo '<li><i class="fas fa-circle-notch text-'.$colores[$i].'"></i> '.$productos[$i]["descripcion"].'</li>';
                       }
                    ?>
                    </ul>
              </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer bg-white p-0">
                <ul class="nav nav-pills flex-column">
                  <?php
                       for ($i = 0; $i < 3; $i++){

                       echo '<li class="nav-item">
                          <a href="#" class="nav-link">
                           '.$productos[$i]["descripcion"].'
                          <span class="float-right text-'.$colores[$i].'">
                        <i class="fas fa-arrow-down text-sm"></i>
                            12%</span>
                        </a>
                         </li>';

                        //  echo '<li><i class="fas fa-circle-notch text-'.$colores[$i].'"></i> '.$productos[$i]["descripcion"].'</li>';
                       }
                    ?>
                  

                </ul>
              </div>
              <!-- /.footer -->
            </div>
            <!-- /.card -->
    </div>
      <script>
      //-------------
  //- PIE CHART -
  //-------------
  // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData        = {
      labels: [
        // <?php
        // echo "$productos[0]['descripcion']";
        
        // ?>
          'Chrome', 
          'IE',
          'FireFox', 
          'Safari', 
          'Opera', 
          'Navigator', 
      ],
      datasets: [
        {
          data: [700,500,400,600,300,100],
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }
      ]
    }
    var pieOptions     = {
      legend: {
        display: false
      }
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var pieChart = new Chart(pieChartCanvas, {
      type: 'doughnut',
      data: pieData,
      options: pieOptions      
    })

  //-----------------
  //- END PIE CHART -
  //-----------------
    </script>
        <!-- /.Grafico Circular Fin -->

    </section>
  

    <!-- /.content -->


@endsection
@section('scripts')
     <script>
      
       var line = new Morris.Line({
    element          : 'line-chart-ventas',
    resize           : true,
    data             : [
      // CAPTURAMOS LAS FECHAS SELECCIONADAS EN EL RANGO
      <?php
      if($fechasSinRepetir != null)
      {
        foreach($fechasSinRepetir as $key)
      {
        // capturamos solo el año y el mes
        echo "{ y: '".$key."', ventas: '".$sumaTotalMes[$key]."'},";
      }
      }
      // SI NO HAY VENTAS PONE EN CERO (0) EL MES
      else
      {
        echo "{ y: '0', ventas: '0'},";
      }
      
      ?>
    ],
    xkey             : 'y',
    ykeys            : ['ventas'],
    labels           : ['Ventas'],
    lineColors       : ['#efefef'],
    lineWidth        : 2,
    hideHover        : 'auto',
    gridTextColor    : '#fff',
    gridStrokeWidth  : 0.4,
    pointSize        : 4,
    pointStrokeColors: ['#efefef'],
    gridLineColor    : '#efefef',
    gridTextFamily   : 'Open Sans',
    gridTextSize     : 10
  });
  
</script>
  <script src="{{ asset('/js/reportes.js') }}"></script>  
@endsection
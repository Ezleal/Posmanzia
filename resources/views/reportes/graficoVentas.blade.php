
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
 {{-- Grafico Cirular Inicio --}}
      <div class="card card-danger">
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
                   if ($total > 0) {
                      for ($i = 0; $i < 6; $i++){
                      $porcentaje = ceil($productos[$i]["ventas"] * 100 / $total);
                       echo '<li class="nav-item">
                          <a href="#" class="nav-link">
                           '.$productos[$i]["descripcion"].'
                          <span class="float-right text-'.$colores[$i].'">
                        <i class="fas fa-arrow-down text-sm"></i>
                            '.$porcentaje.'%</span>
                        </a>
                         </li>';

                       }
                   }
                     
                    ?>
                  

                </ul>
              </div>
              <!-- /.footer -->
            </div>
            <!-- /.card -->
    
     
        <!-- /.Grafico Circular Fin -->


        {{-- Scripts de Gracfico Circular --}}
 <script>
  //-------------
  //- PIE CHART -
  //-------------
  // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData        = {
      labels: [
        <?php
          for ($i = 0; $i < 6; $i++)
          {

              echo '"'.$productos[$i]["descripcion"].'",';   

          }

        ?>
      ],
      datasets: [
        {
          <?php
          
          echo "data: [".$productos[0]["ventas"].",".$productos[1]["ventas"].",".$productos[2]["ventas"].",".$productos[3]["ventas"].",".$productos[4]["ventas"].",".$productos[5]["ventas"]."], backgroundColor : ['".$colores[0]."', '".$colores[1]."', '".$colores[2]."', '".$colores[3]."', '".$colores[4]."', '".$colores[5]."'],"
          
          ?>
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
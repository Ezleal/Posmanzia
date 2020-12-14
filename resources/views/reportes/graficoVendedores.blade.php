 <?php
  error_reporting(0);
  $arrayVendedores = array();
  $arrayListaVendedores = array();
  $sumaTotalVendedores = array();
  foreach ($todos as $key => $valueVentas) {
            foreach ($usuarios as $key => $valueUsuarios) {
                if ( $valueVentas->id_vendedor == $valueUsuarios->id) {
                    // CAPTURAMOS NOMBRE DE LOS VENDEDORES EN UN ARRAY
                   array_push($arrayVendedores, $valueUsuarios->name);
                 // CAPTURAMOS NOMBRE DE LOS VENDEDORES Y VALORES NETOS EN UN ARRAY
                 $arrayListaVendedores = array($valueUsuarios->name => $valueVentas->neto);
                }
                
            }
            // Sumamos los netos de cada vendedor
        foreach ($arrayListaVendedores as $key => $value) {
            $sumaTotalVendedores[$key] += $value;
        }
        }
        
       
        $nombresSinRepetir = array_unique($arrayVendedores);
 ?>
 
 {{-- Grafico Vendedores Inicio --}}
      <div class="card card-danger">
        <div class="card-header">
           <h3 class="card-title mb-0">Ranking de Vendedores</h3>
          </div>
              <!-- /.card-header -->
            <div class="card-body">
                
                    <div class="chart-responsive">

                      <div class="chart" id="bar-chart-vendedores" style="height:300px;"></div>

                    </div>
                    <!-- ./chart-responsive -->
              </div>

          </div>
                  <!-- /.col -->
            
        <!-- /.Grafico Vendedores Fin -->

<script>
    //BAR CHART
    var bar = new Morris.Bar({
      element: 'bar-chart-vendedores',
      resize: true,
      data: [

        <?php 
      foreach($nombresSinRepetir as $value){
        echo "{y: '".$value."', a:".$sumaTotalVendedores[$value]."},";
      }
      ?>  
        // {y: 'Ezequiel', a: 12000},
        // {y: 'Roberto', a: 12332},
        // {y: 'Lautaro', a: 54333},
       
      ],
      barColors: ['#f00'],
      xkey: 'y',
      ykeys: ['a'],
      labels: ['Ventas'],
      preUnits: '$',
      hideHover: 'auto'
    });

</script>
     
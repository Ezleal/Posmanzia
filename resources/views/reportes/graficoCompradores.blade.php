  <?php
  error_reporting(0);
  $arrayCompradores = array();
  $arrayListaCompradores = array();
  $sumaTotalCompradores = array();
  foreach ($todos as $key => $valueCompras) {
            foreach ($clientes as $key => $valueClientes) {
                if ( $valueCompras->id_cliente == $valueClientes->id) {
                    // CAPTURAMOS NOMBRE DE LOS CLIENTES EN UN ARRAY
                   array_push($arrayCompradores, $valueClientes->name);
                 // CAPTURAMOS NOMBRE DE LOS CLIENTES Y VALORES NETOS EN UN ARRAY
                 $arrayListaCompradores = array($valueClientes->name => $valueCompras->neto);
                }
                
            }
            // Sumamos los netos de cada CLIENTE
        foreach ($arrayListaCompradores as $key => $value) {
            $sumaTotalCompradores[$key] += $value;
        }
        }
        
       
        $nombresSinRepetir = array_unique($arrayCompradores);
 ?>
 {{-- Grafico Vendedores Inicio --}}
      <div class="card card-primary">
        <div class="card-header">
           <h3 class="card-title mb-0">Ranking de Compradores</h3>
          </div>
              <!-- /.card-header -->
            <div class="card-body">
                
                    <div class="chart-responsive">

                      <div class="chart" id="bar-chart-compradores" style="height:300px;"></div>

                    </div>
                    <!-- ./chart-responsive -->
              </div>

          </div>
                  <!-- /.col -->
            
        <!-- /.Grafico Vendedores Fin -->

<script>
    //BAR CHART
    var bar = new Morris.Bar({
      element: 'bar-chart-compradores',
      resize: true,
      data: [
        <?php 
      foreach($nombresSinRepetir as $value){
        echo "{y: '".$value."', a:".$sumaTotalCompradores[$value]."},";
      }
      ?>   
       
      ],
      barColors: ['#0af'],
      xkey: 'y',
      ykeys: ['a'],
      labels: ['Compras'],
      preUnits: '$',
      hideHover: 'auto'
    });

</script>
     
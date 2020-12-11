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
        {y: 'Ezequiel', a: 12000},
        {y: 'Roberto', a: 12332},
        {y: 'Lautaro', a: 54333},
       
      ],
      barColors: ['#0af'],
      xkey: 'y',
      ykeys: ['a'],
      labels: ['Compras'],
      preUnits: '$',
      hideHover: 'auto'
    });

</script>
     
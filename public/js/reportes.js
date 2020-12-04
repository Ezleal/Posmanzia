
/*=============================================
LOCAL STORAGE -- CAPTURA RANGO DE FECHAS
=============================================*/
// if(localStorage.getItem("capturarRango") != null)
// {

//     $("#daterange-btn span").html(localStorage.getItem("capturarRango"));

// }
// else 
// {
//     $("#daterange-btn span").html('<i class="fas fa-calendar-alt pr-2"></i>Fechas');
// }
/*=============================================
        Edicion de Carga de fechas
=============================================*/

  //Datemask dd/mm/yyyy
  $('#datemask').inputmask('dd/mm/yyyy', {
      'placeholder': 'dd/mm/yyyy'
  })
  //Datemask2 mm/dd/yyyy
  $('#datemask2').inputmask('mm/dd/yyyy', {
      'placeholder': 'mm/dd/yyyy'
  })
  //Money Euro
  $('[data-mask]').inputmask()
                            
/*=============================================
Rango de fechas para la ordenacion de fechas
=============================================*/

    $('#daterange-rpt').daterangepicker(
      {
        ranges   : {
          'Hoy'       : [moment().subtract(0, 'days'), moment().subtract(-1, 'days')],
          'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(0, 'days')],
          'Ultimos 7 Dias' : [moment().subtract(6, 'days'), moment().subtract(-1, 'days')],
          'Ultimos 30 Dias': [moment().subtract(29, 'days'), moment().subtract(-1, 'days')],
          'Este Mes'  : [moment().startOf('month'), moment().endOf('month').subtract(-1, 'days')],
          'Ultimo Mes'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month').subtract(-1, 'days')]
        },
        // startDate: moment().subtract(29, 'days'),
        startDate: moment(),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-rpt span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      
        var fechaInicial = start.format('YYYY-MM-DD');
        var fechaFinal = end.format('YYYY-MM-DD');
        $('#from_date').val(fechaInicial);
        $('#to_date').val(fechaFinal);
       
        var capturarRango = $("#daterange-btn span").html();
        
        localStorage.setItem("capturarRango", capturarRango);
           
        // window.location = "/reportes/"+fechaInicial+"/"+fechaFinal;

    }
    )

/*=============================================
LLAMADA AJAX PARA TRAER VENTAS POR FECHAS
=============================================*/
 $('.drp-buttons button.applyBtn').click(function(){
  var from_date = $('#from_date').val();
  var to_date = $('#to_date').val();
  if(from_date != '' &&  to_date != '')
  {
          $.ajax({
        url: "traerReportes/"+from_date+"/"+to_date,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            // console.log(respuesta.data);            
            respuesta.data.forEach(element => {

                if (element != 0) {

                    // $("#producto" + numProducto).append(

                    //     '<option idProducto="' + element.id + '" value="' + element.descripcion + '">' + element.descripcion + '</option>'
                    // )
                    console.log(element);

                }
                else{
                    console.log(element);
                }
               

             });

               
        }
    })
  
  }
  else
  {
        swal("Debe seleccionar un rango de fechas");  }
 });


  $('#filter').click(function(){
  var from_date = $('#from_date').val();
  var to_date = $('#to_date').val();
  if(from_date != '' &&  to_date != '')
  {
    $.ajax({
        url: "traerReportes/"+from_date+"/"+to_date,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            // console.log(respuesta.data);            
            respuesta.data.forEach(element => {

                if (element != 0) {

                    // $("#producto" + numProducto).append(

                    //     '<option idProducto="' + element.id + '" value="' + element.descripcion + '">' + element.descripcion + '</option>'
                    // )
                    console.log(element);

                }
                else{
                    console.log(element);
                }
               

             });

               
        }
    })
  }
  else
  {
   swal('Debe seleccionar un rango de fechas');
  }
 });

 /**********************************************
 LIMPIAR TABLA DE FECHAS
 ***********************************************/

 $('#refresh').click(function(){
  $('#from_date').val('');
  $('#to_date').val('');

  $("#daterange-rpt span").html('<i class="fas fa-calendar-alt pr-2"></i>Fechas');

 });

$('.drp-buttons button.cancelBtn').click(function(){
  $('#from_date').val('');
  $('#to_date').val('');
  
  $("#daterange-btn span").html('<i class="fas fa-calendar-alt pr-2"></i>Fechas');

 });

 var line = new Morris.Line({
    element          : 'line-chart-ventas',
    resize           : true,
    data             : [
      { y: '2011 Q1', item1: 2666 },
      { y: '2011 Q2', item1: 2778 },
      { y: '2011 Q3', item1: 4912 },
      { y: '2011 Q4', item1: 3767 },
      { y: '2012 Q1', item1: 6810 },
      { y: '2012 Q2', item1: 5670 },
      { y: '2012 Q3', item1: 4820 },
      { y: '2012 Q4', item1: 15073 },
      { y: '2013 Q1', item1: 10687 },
      { y: '2013 Q2', item1: 8432 }
    ],
    xkey             : 'y',
    ykeys            : ['item1'],
    labels           : ['Item 1'],
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
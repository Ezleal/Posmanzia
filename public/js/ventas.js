
load_data();
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

    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Hoy'       : [moment(), moment()],
          'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Ultimos 7 Dias' : [moment().subtract(6, 'days'), moment()],
          'Ultimos 30 Dias': [moment().subtract(29, 'days'), moment()],
          'Este Mes'  : [moment().startOf('month'), moment().endOf('month')],
          'Ultimo Mes'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        // startDate: moment().subtract(29, 'days'),
        startDate: moment(),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      
        var fechaInicial = start.format('YYYY-M-D');
        var fechaFinal = end.format('YYYY-M-D');
        $('#from_date').val(fechaInicial);
        $('#to_date').val(fechaFinal);
       
        var capturarRango = $("#daterange-btn span").html();
        
        localStorage.setItem("capturarRango", capturarRango);

        // window.location = "ventas/"+fechaInicial+"/"+fechaFinal;

    }
    )

/*=============================================
LOCAL STORAGE -- CANCELAR RANGO DE FECHAS
=============================================*/
 $('.drp-buttons button.applyBtn').click(function(){
  var from_date = $('#from_date').val();
  var to_date = $('#to_date').val();
  if(from_date != '' &&  to_date != '')
  {
   $('#ventas_table').DataTable().destroy();
   load_data(from_date, to_date);
  }
  else
  {
        swal("Debe seleccionar un rango de fechas");  }
 });

$('.drp-buttons button.cancelBtn').click(function(){
  $('#from_date').val('');
  $('#to_date').val('');
  $('#ventas_table').DataTable().destroy();
  load_data();
  $("#daterange-btn span").html('<i class="fas fa-calendar-alt pr-2"></i>Fechas');

 });

  $('#filter').click(function(){
  var from_date = $('#from_date').val();
  var to_date = $('#to_date').val();
  if(from_date != '' &&  to_date != '')
  {
   $('#ventas_table').DataTable().destroy();
   load_data(from_date, to_date);
  }
  else
  {
   swal('Debe seleccionar un rango de fechas');
  }
 });

 $('#refresh').click(function(){
  $('#from_date').val('');
  $('#to_date').val('');
  $('#ventas_table').DataTable().destroy();
  load_data();
  $("#daterange-btn span").html('<i class="fas fa-calendar-alt pr-2"></i>Fechas');

 });
/*=============================================
Data Table de Clientes
=============================================*/
function load_data(from_date = '', to_date = '')
 {
$("#ventas_table").DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": {
    url:'/ventas',
    data:{from_date:from_date, to_date:to_date}
   },
    "columns": [{
            data: 'id',
            name: 'id'
        },
        {
            data: 'codigo',
            name: 'codigo'

        },
        {
            data: 'cliente',
            name: 'cliente'
        },
        {
            data: 'vendedor',
            name: 'vendedor'
        }, {
            data: 'metodo_pago',
            name: 'metodo_pago'

        },
        {
            data: 'neto',
            name: 'neto',
             render: function (data, type, full, meta) {
                    return new Intl.NumberFormat('es-AR', {
                        style: 'currency',
                        currency: 'ARS'
                    }).format(data);
             }
        }, 
        {
            data: 'total',
            name: 'total',
             render: function (data, type, full, meta) {
                return new Intl.NumberFormat('es-AR', {
                    style: 'currency',
                    currency: 'ARS'
                }).format(data);
             }

        },
        {
            data: 'fecha',
            name: 'fecha'

        },

        {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false
        },
    ],
    "paging": true,
    "lengthChange": true,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": false,
    "responsive": true,
    "language": {

        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ Registros",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ningún dato disponible en esta tabla",
        "sInfo": "Mostrando registros del _START_ al _END_ total: _TOTAL_",
        "sInfoEmpty": "Mostrando registros del 0 al 0 total: 0",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix": "",
        "sSearch": "Buscar:",
        "sUrl": "",
        "sInfoThousands": ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Último",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }

    }

});
}
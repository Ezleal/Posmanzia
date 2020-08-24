/*=============================================
Data Table de Clientes
=============================================*/
$("#client_table").DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": "/clientes",
    "columns": [{
            data: 'id',
            name: 'id'
        },
        {
            data: 'name',
            name: 'name'

        },
        {
            data: 'documento',
            name: 'documento'
        },
        {
            data: 'email',
            name: 'email'
        }, {
            data: 'telefono',
            name: 'telefono'

        },
        {
            data: 'direccion',
            name: 'direccion'
        }, 
        {
            data: 'fecha_nacimiento',
            name: 'fecha_nacimiento'

        },
        {
            data: 'compras',
            name: 'compras'

        },
        {
            data: 'ultima_compra',
            name: 'ultima_compra'

        },
         {
             data: 'agregado',
             name: 'agregado'

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
                            

/*=============================================
Data Table de Clientes
=============================================*/
$("#ventas_table").DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": "/productos",
    "columns": [{
            data: 'codigo',
            name: 'codigo'
        },
        {
            data: 'imagen',
            name: 'imagen',
            render: function (data, type, full, meta) {
                return "<img style='width: 60px;max-height:60px' src='/storage/products/" + data + " 'alt='Product-img'>"
            },
            orderable: false,
            cache: false
            // El Cache: false permite la actualización en el listado al editar
        },
        
        {
            data: 'descripcion',
            name: 'descripcion'
        },
       {
           data: 'stock',
           name: 'stock',
           render: function (data, type, full, meta) {
               if (data <= 10)
                   return "<button class='btn btn-danger'>" + data + "</button>"
               if (data >= 10 && data <= 20)
                   return "<button class='btn btn-warning'>" + data + "</button>"
               else {
                   return "<button class='btn btn-success'>" + data + "</button>"
               }
           }
       },

        {
            data: 'precio_venta',
            name: 'precio_venta',
            render: function (data, type, full, meta) {

                return "$" + data
            }
        },

        {
            data: 'agregar',
            name: 'agregar',
            orderable: false,
            searchable: false
        },
    ],
    // "deferRender": true,
    // "retrieve": true,
    // "processing": true,
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


/*=============================================
        Edicion de Carga de fechas
=============================================*/
idAgregarProducto = [];
localStorage.removeItem("agregarProducto");

$("#ventas_table").on('click','.btnAgregarProducto',function () {
    var idProducto = $(this).attr('id');
    
    /* Local Storage almacena id del producto */
    if (localStorage.getItem("agregarProducto") == null) {
        idAgregarProducto = [];
    } else {
        idAgregarProducto.concat(localStorage.getItem("agregarProducto"))
    }
    idAgregarProducto.push({ "id": idProducto });
    localStorage.setItem("agregarProducto", JSON.stringify(idAgregarProducto));
    /* Local Storage almacena id del producto */
   
    $(this).removeClass('btnAgregarProducto');
    $(this).addClass('btn-warning disabled');
    $(this).html('Cargado');


    $.ajax({
    url: "/productos/" + idProducto + "/edit",
    dataType: "json",
    success: function (respuesta) {
    console.log(respuesta);
    var descripcion = respuesta.data.descripcion;
    var stock = respuesta.data.stock;
    var precio_venta = respuesta.data.precio_venta;

        if (stock == 0) {

            swal("Oops", "No hay Stock disponible!", "error")
            $("button.recuperarBoton[id='" + idProducto + "']").removeClass('btn-warning disabled');
            $("button.recuperarBoton[id='" + idProducto + "']").addClass('btnAgregarProducto btn-primary');
            $("button.recuperarBoton[id='" + idProducto + "']").html('Agregar');

            return;

        }
  

    $('.nuevoProducto').append('<div class="row"><div class="col-6 col-sm-6 pr-0 mt-1"> <div class="input"> <div class="input-group-append p-0"> <span><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="'+idProducto+'"><i class="fas fa-times"></i></button></span> <input type="text" class="form-control pl-2" name="agregarProducto" id="agregarProducto" title="' + descripcion + '" value="' + descripcion + '"  autocomplete="agregarProducto" autofocus readonly> </div> </div> </div><div class="col-2 col-sm-2 pl-1 pr-1 mt-1"> <input type="number" class="form-control p-1" min="1" value="1" stock="' + stock + '" required> </div> <div class="col-4 col-sm-4 pl-0 mt-1"> <div class="input-group"> <div class="input-group-append"> <div class="input-group-text p-1">$ </div> </div> <input type="text" class="form-control pl-2" name="precio" value="' + precio_venta + '"  id="precio" autocomplete="producto" autofocus readonly> </div> </div> </div></div>')
}
})
});

/*=============================================
CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA
=============================================*/

$("#ventas_table").on("draw.dt", function () {

    if (localStorage.getItem("agregarProducto") != null) {

        var listaIdProductos = JSON.parse(localStorage.getItem("agregarProducto"));

        for (var i = 0; i < listaIdProductos.length; i++) {

            $("button.recuperarBoton[id='" + listaIdProductos[i]["id"] + "']").removeClass('btn-primary btnAgregarProducto');
            $("button.recuperarBoton[id='" + listaIdProductos[i]["id"] + "']").addClass('btn-warning disabled');
            $("button.recuperarBoton[id='" + listaIdProductos[i]["id"] + "']").html('Cargado');

        }
       
    }
  


})


/*=============================================
        Eliminar producto cargado
=============================================*/
// idQuitarProducto = [];

$(".formularioVenta").on('click', '.quitarProducto', function () {
    $(this).parent().parent().parent().parent().parent().remove();

    var idProducto = $(this).attr('idProducto');
    var idProductos = $(this).attr('idProducto');
    // var idProductos = $(this).attr('idProducto');
    /* Local Storage almacena id del producto */
    // if (localStorage.getItem("quitarProducto") == null) {
    //     idQuitarProducto = [];
    // } else {
    //     idQuitarProducto.concat(localStorage.getItem("quitarProducto"))
    // }
    // agregarProducto.pull({
    //     "id": idProducto
    // });
    // localStorage.setItem("quitarProducto", JSON.stringify(idQuitarProducto));
    /* Local Storage almacena id del producto */

    
    $("button.recuperarBoton[id='" + idProducto + "']").removeClass('btn-warning disabled');
    $("button.recuperarBoton[id='" + idProducto + "']").addClass('btnAgregarProducto btn-primary');
    $("button.recuperarBoton[id='" + idProducto + "']").html('Agregar');
    
    localStorage.removeItem("agregarProducto", JSON.stringify(idProductos));
  
    
});



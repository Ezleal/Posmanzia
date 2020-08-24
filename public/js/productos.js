/*=============================================
Data Table de Usuarios
=============================================*/
$("#product_table").DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": "/productos",
    "columns": [{
            data: 'id',
            name: 'id'
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
            data: 'codigo',
            name: 'codigo'
        },
        {
            data: 'descripcion',
            name: 'descripcion'
        },
          {
              data: 'category',
              name:'category'
          },
         {
             data: 'stock',
             name: 'stock',
             render: function (data, type, full, meta) {
                if (data <= 10)
                      return "<button class='btn btn-danger'>" + data + "</button>"
                if (data >= 10 && data <= 20)
                     return "<button class='btn btn-warning'>" + data + "</button>"
                else{
                    return "<button class='btn btn-success'>" + data + "</button>"
                }
             }
         },
        {
            data: 'precio_compra',
            name: 'precio_compra',
             render: function (data, type, full, meta) {
                 return new Intl.NumberFormat('es-AR', {
                     style: 'currency',
                     currency: 'ARS'
                 }).format(data);
             }
             
        },
        {
            data: 'precio_venta',
            name: 'precio_venta',
            render: function (data, type, full, meta) {
                return new Intl.NumberFormat('es-AR', {
                    style: 'currency',
                    currency: 'ARS'
                }).format(data);
            }
        },
        {
            data: 'agregado',
            name: 'agregado',
           
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
/* +++++++++++++++++++++++++++++++++++++++++
      MODIFICACION DE IMAGEN  DE PRODUCTO
++++++++++++++++++++++++++++++++++++++++++++ */

$(".foto").change(function(){

var imagen = this.files[0];

    if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/jpg" && imagen["type"] != "image/png" && imagen["type"] != "image/gif" ){
        $(".foto").val("");
        swal("Oops", "La imagen deber ser en formato JPG/JPEG/PNG o GIF", "error")
    }
    else if (imagen["size"] > 2000000){
        $(".foto").val("");
        swal("Uups", "La imagen no puede superar los 2 MB", "error")
    }
    else{
        var datosImagen = new FileReader;
        datosImagen.readAsDataURL(imagen);
        
        $(datosImagen).on("load", function(event){
            var rutaImagen = event.target.result;
            
        $(".previzualizar").attr("src", rutaImagen);
        })
    }
})

/*=============================================
      AGREGANDO EL PRECIO DE VENTA (%)
=============================================*/
$("#precio_compra").change(function () {

    if($(".inputporcentaje").prop("checked")){
     var valorPorcentaje = $("#porcentaje").val();
     // ACA CAPTURAMOS EL PORCENTAJE A PONER EN PRECIO VENTA
    var porcentaje = Number(($("#precio_compra").val() * valorPorcentaje / 100)) + Number($("#precio_compra").val());

          $("#precio_venta").val(porcentaje)
          $("#precio_venta").prop("readonly", true)
    }
    })

/*=============================================
CAMBIO DE PORCENTAJE
=============================================*/
$("#porcentaje").change(function () {

    if ($(".inputporcentaje").prop("checked")) {

        var valorPorcentaje = $(this).val();

        var porcentaje = Number(($("#precio_compra").val() * valorPorcentaje / 100)) + Number($("#precio_compra").val());

        $("#precio_venta").val(porcentaje);
        $("#precio_venta").prop("readonly", true);
    }
})

$(".inputporcentaje").on("ifUnchecked", function () {

    $("#precio_venta").prop("readonly", false);

})

$(".inputporcentaje").on("ifChecked", function () {

    $("#precio_venta").prop("readonly", true);

})

/*=============================================
VALIDACION DE PRECIO-COMPRA y PRECIO-VENTA
=============================================*/

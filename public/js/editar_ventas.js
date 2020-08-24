
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
                    return new Intl.NumberFormat('es-AR', {
                        style: 'currency',
                        currency: 'ARS'
                    }).format(data);
            }
        },

        {
            data: 'agregar',
            name: 'agregar',
            orderable: false,
            searchable: false,

        },
    ],
    "deferRender": true,
    "retrieve": true,
    "processing": true,
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
    Edicion de Carga de Productos Tabla
=============================================*/
idAgregarProducto = [];
localStorage.removeItem("agregarProducto");

$("#ventas_table").on('click','.btnAgregarProducto',function () {
    var idProducto = $(this).attr('id');
    /* Local Storage almacena id del producto */
    // if (localStorage.getItem("agregarProducto") == null) {
    //     idAgregarProducto = [];
    // } else {
    //     idAgregarProducto.concat(localStorage.getItem("agregarProducto"))
    // }
    // idAgregarProducto.push({ "id": idProducto });
    // localStorage.setItem("agregarProducto", JSON.stringify(idAgregarProducto));
    /* Local Storage almacena id del producto */
   
    $(this).removeClass('btnAgregarProducto');
    $(this).addClass('btn-warning disabled');
    $(this).html('Cargado');
    // $(this).parent().remove();

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
  

        $('.nuevoProducto').append('<div class="row"><div class="col-6 col-sm-6 pr-0 mt-1"> <div class="input"> <div class="input-group-append p-0"> <span><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="' + idProducto + '"><i class="fas fa-times"></i></button></span> <input type="text" class="form-control pl-2 nuevaDescripcionProducto" name="agregarProducto" idProducto="' + idProducto + '" id="agregarProducto" title="' + descripcion + '" value="' + descripcion + '"  autocomplete="agregarProducto" autofocus readonly> </div> </div> </div><div class="col-2 col-sm-2 pl-1 pr-1 mt-1"> <input type="number"  class="form-control p-1 nuevaCantidadProducto" min="1" value="1" stock="' + stock + '" nuevoStock="' + Number(stock - 1)+'" required> </div> <div class="col-4 col-sm-4 pl-0 mt-1 divPrecioProd"> <div class="input-group"> <div class="input-group-append"> <div class="input-group-text p-1">$ </div> </div> <input type="text" class="form-control pl-2 nuevoPrecio" name="nuevoPrecio" value="' + precio_venta + '" precioReal="' + precio_venta + '" id="nuevoPrecio" autofocus readonly> </div> </div> </div></div>');
        
        // SUMAR TOTAL DE PRECIOS
        sumarTotalPrecios();
        // AGREGAR IMPUESTO
        agregarImpuesto();
        // AGRUPAR PRODUCTOS EN FORMATO JSON
        listarProductos()
       

        

       

}
})
});


/*=============================================
CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA
=============================================*/

// $("#ventas_table").on("draw.dt", function () {

//     if (localStorage.getItem("agregarProducto") != null) {

//         var listaIdProductos = JSON.parse(localStorage.getItem("agregarProducto"));

//         for (var i = 0; i < listaIdProductos.length; i++) {

//             $("button.recuperarBoton[id='" + listaIdProductos[i]["id"] + "']").removeClass('btn-primary btnAgregarProducto');
//             $("button.recuperarBoton[id='" + listaIdProductos[i]["id"] + "']").addClass('btn-warning disabled');
//             $("button.recuperarBoton[id='" + listaIdProductos[i]["id"] + "']").html('Cargado');

//         }
       
//     }

// })

// idQuitarProducto = [];
$(".formularioVenta").on('click', '.quitarProducto', function () {
    $(this).parent().parent().parent().parent().parent().remove();
    var idProducto = $(this).attr('idProducto');
    const num = 0;
  
    $("button.recuperarBoton[id='" + idProducto + "']").removeClass('btn-warning disabled');
    $("button.recuperarBoton[id='" + idProducto + "']").addClass('btnAgregarProducto btn-primary');
    $("button.recuperarBoton[id='" + idProducto + "']").html('Agregar');
    
    // localStorage.removeItem("agregarProducto", JSON.stringify(idProductos));
    
    //SI LO PRODUCTOS QUEDAN VACIOS SE ESTABLECE EL TOTAL EN 0 (CERO)
    if($('.nuevoProducto').children().length <= 0 ){
 
        $('.nuevoTotalVenta').val(0);
        $('#nuevoPrecioImpuesto').val(0);
        $('#nuevoPrecioNeto').val(0);
        $('#totalVenta').val(0);
        $('.nuevoTotalVenta').attr('total', 0);
        $('.nuevoTotalVenta').attr('value', 0);
    
}
    else{
        // SUMAR TOTAL DE PRECIOS
        sumarTotalPrecios()
        // AGREGAR IMPUESTO
        agregarImpuesto()
        // AGRUPAR PRODUCTOS EN FORMATO JSON
        listarProductos()
    }
   
    
});

/*=============================================
BOTON PARA DISPOSITIVOS MOVILES AGREGAR
=============================================*/
var numProducto = 0;
$(".mbAgregarProducto").click(function () {
    numProducto++;
    $.ajax({
        url: "/productosTraer",
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            // console.log(respuesta.data);
            $('.nuevoProducto').append('<div class="row"><div class="col-6 col-sm-6 pr-0 mt-1"> <div class="input"> <div class="input-group-append p-0"> <span><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto=""><i class="fas fa-times"></i></button></span> <select type="text" class="form-control pl-2 nuevaDescripcionProducto" name="nuevaDescripcionProducto" id="producto' + numProducto + '" title="" idProducto="' + numProducto +'" value=""  autocomplete="nuevaDescripcionProducto" autofocus required><option selected disabled>Seleccionar Producto</option></select> </div> </div> </div><div class="col-2 col-sm-2 pl-1 pr-1 mt-1"> <input type="number" class="form-control p-1 nuevaCantidadProducto ingresoCantidad" min="1" value="" name="nuevaCantidadProducto" id="nuevaCantidadProducto" nuevoStock stock="" required readonly> </div> <div class="col-4 col-sm-4 pl-0 mt-1"> <div class="input-group"> <div class="input-group-append divPrecioProd"> <div class="input-group-text p-1">$ </div> </div> <input type="text" class="form-control pl-2 nuevoPrecio ingresoPrecio" precioReal name="nuevoPrecio" value=""  id="nuevoPrecio" autocomplete="producto" autofocus readonly> </div> </div> </div></div>')
            
            respuesta.data.forEach(element => {

                if (element.stock != 0) {

                    $("#producto" + numProducto).append(

                        '<option idProducto="' + element.id + '" value="' + element.descripcion + '">' + element.descripcion + '</option>'
                    )

                }
               

             });
            // SUMAR TOTAL DE PRECIOS
            sumarTotalPrecios()
            // AGREGAR IMPUESTO
            agregarImpuesto()
          
            
            
        }
        
    })
});

/*=============================================
SELECCIONAR PRODUCTO
=============================================*/

$(".formularioVenta").on("change", "select.nuevaDescripcionProducto", function () {
    var nombreProducto = $(this).val();
    var nuevaCantidadProducto = $(this).parent().parent().parent().parent().children().children(".nuevaCantidadProducto");
    var nuevoPrecioProducto = $(this).parent().parent().parent().parent().children().children().children(".nuevoPrecio");
    // console.log(nuevoPrecioProducto);
    nuevaCantidadProducto.attr("readonly", false);
    nuevaCantidadProducto.val(1);
    $.ajax({
        url: "/traerPorNombre/"+nombreProducto,
        dataType: "json",
        success: function (respuesta) {
           
            if (nombreProducto == "Seleccionar Producto") {
                nuevoPrecioProducto.val('');
                nuevaCantidadProducto.val('');
                $(nuevoPrecioProducto).attr("precioReal", 0);
                $(nuevaCantidadProducto).attr("stock", 0);

            }
            resultP = respuesta.data[0];
            // console.log(respuesta.data[0].stock);
             if (nombreProducto != "Seleccionar Producto") {
             $(nuevaCantidadProducto).attr("stock", resultP.stock);
             $(nuevaCantidadProducto).attr("nuevoStock", Number(resultP.stock)-1);
             $(nuevoPrecioProducto).val(resultP.precio_venta);
             $(nuevoPrecioProducto).attr("precioReal", resultP.precio_venta);
                 // FORMATO A LOS PRECIOS CON JQUERY NUMBER
                 // AGRUPAR PRODUCTOS EN FORMATO JSON
                 listarProductos()
            }
      	    
            // SUMAR TOTAL DE PRECIOS
            sumarTotalPrecios()
            // AGREGAR IMPUESTO
            agregarImpuesto()
          
            
           
        }
    })
    
    // var nuevoPrecioProducto = $(this).parent().parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");

    // var nuevaCantidadProducto = $(this).parent().parent().parent().children(".ingresoCantidad").children(".nuevaCantidadProducto");

    // var datos = new FormData();
    // datos.append("nombreProducto", nombreProducto);


    // $.ajax({

    //     url: "ajax/productos.ajax.php",
    //     method: "POST",
    //     data: datos,
    //     cache: false,
    //     contentType: false,
    //     processData: false,
    //     dataType: "json",
    //     success: function (respuesta) {

    //         $(nuevaDescripcionProducto).attr("idProducto", respuesta["id"]);
    //         $(nuevaCantidadProducto).attr("stock", respuesta["stock"]);
    //         $(nuevaCantidadProducto).attr("nuevoStock", Number(respuesta["stock"]) - 1);
    //         $(nuevoPrecioProducto).val(respuesta["precio_venta"]);
    //         $(nuevoPrecioProducto).attr("precioReal", respuesta["precio_venta"]);

    //         // AGRUPAR PRODUCTOS EN FORMATO JSON

    //         listarProductos()

    //     }

    // })
})

/*=============================================
MODIFICAR LA CANTIDAD
=============================================*/

$(".formularioVenta").on("change", "input.nuevaCantidadProducto", function () {
    // var descripcion = $('.nuevaDescripcionProducto').val();
    // console.log(descripcion);

    var precio = $(this).parent().parent().children().children().children(".nuevoPrecio");

    var precioFinal = $(this).val() * precio.attr("precioReal");
    
    precio.val(precioFinal);

    var nuevoStock = Number($(this).attr("stock")) - $(this).val();

    $(this).attr("nuevoStock", nuevoStock);

    if (Number($(this).val()) > Number($(this).attr("stock"))) {
       
/*=================================================================
SI LA CANTIDAD ES SUPERIOR AL STOCK REGRESAR VALORES INICIALES
==================================================================*/

        $(this).val(1);

        var precioFinal = $(this).val() * precio.attr("precioReal");

        precio.val(precioFinal);

        swal("La cantidad supera el Stock", "¡Sólo hay " + $(this).attr("stock") + " unidades!", "error")
        sumarTotalPrecios()
        agregarImpuesto()
        return;

    }

    // SUMAR TOTAL DE PRECIOS

    sumarTotalPrecios()

    // AGREGAR IMPUESTO

    agregarImpuesto()


    // AGRUPAR PRODUCTOS EN FORMATO JSON

    listarProductos()
   

    

})
/*=============================================
         SUMAR TOTAL PRECIOS
=============================================*/
function formatearMoneda($valor) {
    var number = $($valor).val();
    number = new Intl.NumberFormat('es-AR', { style: 'currency', currency: 'ARS' }).format(number);
    $($valor).val(number);
  

}
function formatearValor($valor) {
    var number = $($valor).val();
    number = new Intl.NumberFormat().format(number)
    $($valor).val(number);


}

function sumarTotalPrecios(){
    // var descripcion = $('.nuevaDescripcionProducto').val();
    var precioItem = $('.nuevoPrecio');
    var arraySumaPrecio = [];

    for(var i = 0; i < precioItem.length; i++){

        arraySumaPrecio.push(Number($(precioItem[i]).val()));  
        
    }
    function sumaArrayPrecios(total, numero) {

        return total + numero;
    }

    var sumaTotalPrecios = arraySumaPrecio.reduce(sumaArrayPrecios);
    $('#nuevoTotalVenta').val(sumaTotalPrecios);
    $('#totalVenta').val(sumaTotalPrecios);
    $('#nuevoTotalVenta').attr('total', sumaTotalPrecios);

}

/*=============================================
         SUMAR TOTAL PRECIOS
=============================================*/
function agregarImpuesto() {

    var impuesto = $('#impuestoVenta').val();
    var precioTotal = $('#nuevoTotalVenta').attr("total");
    var precioImpuesto = Number(precioTotal * impuesto / 100);
    var totalConImpuesto = Number(precioImpuesto) + Number(precioTotal);

    $('#nuevoTotalVenta').val(totalConImpuesto);
    $('#totalVenta').val(totalConImpuesto);
    $('#nuevoPrecioImpuesto').val(precioImpuesto);
    $('#nuevoPrecioNeto').val(precioTotal);
    formatearMoneda('#nuevoTotalVenta');
    
}

/*=============================================
     CUANDO CAMBIE INPUT IMPUESTO 
=============================================*/

$('#impuestoVenta').change(function(){
    agregarImpuesto()
});

/*=============================================
        SELECCIONAR METODO DE PAGO
=============================================*/
$('#nuevoMetodoPago').change(function(){
    var metodo = $(this).val();
   
    if(metodo == "Efectivo"){
        $('#nro_transaccion').val('');
        $('#nro_transaccion').attr('type', 'hidden');
        $('.divefectivo').addClass('d-none');

       $(this).parent().parent().parent().children('.transaccionEfectivo').html(
           '<div class="input-group">'+
        '<div class="input-group-append">'+
            '<div class="input-group-text">'+
                '<span class="fas fa-cash-register"></span></div></div>'+
            '<input type="text" class="form-control nuevoEfectivo" name="nuevoEfectivo" id="nuevoEfectivo" value="" min="0" step="any" autocomplete="nuevoEfectivo" autofocus placeholder="Efectivo" required>'+
            '<div class="input-group-append">'+
                '<div class="input-group-text">'+
                    '<span class="fas fa-hand-holding-usd"></span></div></div>'+
           '<input type="text" class="form-control nuevoCambio" name="nuevoCambio" id="nuevoCambio" value="" min="0" step="any" autocomplete="nuevoCambio" autofocus placeholder="Cambio" readonly required></div>'
           )
        formatearMoneda('#nuevoCambio');
        listarMetodos()

    }
    else{

        $(".transaccionEfectivo").empty();
        $('#nro_transaccion').attr('type', 'text');
        $('.divefectivo').removeClass('d-none');
    }

});


/*=============================================
            CAMBIO EN EFECTIVO
=============================================*/
$(".formularioVenta").on("change", "input#nuevoEfectivo", function () {
    var impuesto = $('#nuevoPrecioImpuesto').val();
    var precioTotal = $('#nuevoTotalVenta').attr("total");
    var totalConImpuesto = Number(impuesto) + Number(precioTotal);
    var efectivo = $(this).val();
    var cambio = Number(efectivo) - Number(totalConImpuesto);
    var nuevoCambioEfectivo = $(this).parent().children('.nuevoCambio');

    nuevoCambioEfectivo.val(cambio); 
    formatearMoneda('#nuevoCambio');
    formatearValor('.nuevoEfectivo');

})

/*=============================================
            CAMBIO EN EFECTIVO
=============================================*/
$(".formularioVenta").on("change", "input#nro_transaccion", function () {
listarMetodos()
})

/*=============================================
            LISTAR PRODUCTOS
=============================================*/

function listarProductos(){
var listaProductos = [];

var cantidad = $('.nuevaCantidadProducto');
var descripcion = $('.nuevaDescripcionProducto');
var precio = $('.nuevoPrecio');

for (let i = 0; i < descripcion.length; i++) {
    listaProductos.push({
        "id": $(descripcion[i]).attr("idProducto"),
        "descripcion": $(descripcion[i]).val(),
        "cantidad": $(cantidad[i]).val(),
        "stock": $(cantidad[i]).attr("nuevoStock"),
        "precio": $(precio[i]).attr("precioReal"),
        "total": $(precio[i]).val()
    })

    $("#listaProductos").val(JSON.stringify(listaProductos));
    
}
}

/*=============================================
LISTAR MÉTODO DE PAGO
=============================================*/

function listarMetodos() {

    var listaMetodos = "";

    if ($("#nuevoMetodoPago").val() == "Efectivo") {

        $("#listaMetodoPago").val("Efectivo");

    } else {

        $("#listaMetodoPago").val($("#nuevoMetodoPago").val() + "-" + $("#nro_transaccion").val());

    }

}
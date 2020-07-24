/*=============================================
Data Table de Usuarios
=============================================*/
$("#user_table").DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": "/usuarios",
    "columns": [{
            data: 'id',
            name: 'id'
        },
        {
            data: 'name',
            name: 'name'

        },
        {
            data: 'username',
            name: 'username'
        },
        {
            data: 'foto',
            name: 'foto',
            render: function (data, type, full, meta) {
                return "<img style='width: 40px;max-height:40px' src='/storage/profile_images/" + data + " 'alt='avatar'>"
            },
            orderable: false,
            cache: false
            // El Cache: false permite la actualización en el listado al editar

        },
        {
            data: 'email',
            name: 'email'
        },
        {
            data: 'perfil',
            name: 'perfil',
            render: function (data, type, full, meta) {
                if (data == 1)
                    return "Administrador"
                if (data == 2)
                    return "Especial"
                if (data == 3)
                    return "Vendedor"

            }
        },
        {
            data: 'estado',
            name: 'estado',
            render: function (data, type, full, meta) {
                if (data == 1)
                    return "<button class='btn btn-success btn-sm' id='" + data + "'>Activado</button>"
                else {
                    return "<button class='btn btn-danger btn-sm' id='" + data + "'>Desactivado</button>"
                }
            }
        },
        {
            data: 'ultima_login',
            name: 'ultima_login',
            orderable: false,
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
        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
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
        MODIFICACION DE FOTOS DE USUARIO 
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
/* +++++++++++++++++++++++++++++++++++++++++
      ACTIVAR O DESACTIVAR USUARIO
++++++++++++++++++++++++++++++++++++++++++++ */

$(".btnActivar").click(function () {
    var estadoUsuario = $(this).attr('estadoUsuario');

 if (estadoUsuario == 1) {

     $(this).removeClass('btn-success');
     $(this).addClass('btn-danger');
     $(this).val('Desactivado');
     $('#estado_hidden').val('0');
     $(this).attr('estadousuario', 0);

 } else {

     $(this).addClass('btn-success');
     $(this).removeClass('btn-danger');
     $(this).val('Activado');
     $('#estado_hidden').val('1');
     $(this).attr('estadousuario', 1);

 }

 })

                            

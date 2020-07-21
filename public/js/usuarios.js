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

                            

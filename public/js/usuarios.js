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
              CREAR USUARIO 
++++++++++++++++++++++++++++++++++++++++++++ */
//  $('#crearUser').click(function () {
//      $('#formModal').modal('show');
//  });

// $('#sample_form').on('submit', function (event) {
//             event.preventDefault();
//             if ($('#action').val() == 'Guardar Usuario') {
//                 $.ajax({
//                             url: "{{ route('usuarios.store') }}",
//                             method: "POST",
//                             data: new FormData(this),
//                             contentType: false,
//                             cache: false,
//                             processData: false,
//                             dataType: "json",
//                             success: function (data)
//                             {
//                                 var html = '';
//                                 if (data.errors) {
//                                     html = '<div class="alert alert-danger">';
//                                     for (var count = 0; count < data.errors.length; count++) {
//                                         html += '<p>' + data.errors[count] + '</p>';
//                                     }
//                                     html += '</div>';
//                                 }
//                                 if (data.success) {
//                                     html = '<div class="alert alert-success">' + data.success + '</div>';
//                                     $('#sample_form')[0].reset();
//                                     $('#user_table').DataTable().ajax.reload();
//                                 }
//                                 $('#form_result').html(html);
//                             }
//                             })
//                         }
//                     });
                            

  
  @if(session('apertura'))
  <script>
    swal ( "La Caja se inicio correctamente" ,  "Recuerde realizar el cierre al finalizar" ,  "success" )
  </script>        
@endif
 @if(session('cierre'))
  <script>
    swal ( "Caja Cerrada Correctamente" ,  "Para vender nuevamente debera reabrir la caja" ,  "success" )
  </script>        
@endif
@if(session('cashClose'))
  <script>
    swal ( "Debe Realizar la Apertura de Caja para poder Vender" ,  "Boton ubicado en la pagina de inicio del Sistema" ,  "error" )
  </script>        
@endif
          <div class="col-lg-6 offset-lg-3 col-12">
            <!-- nueva venta -->
            <a href="{{route('ventas.create')}}">
            <button type="button" class="btn btn-dark btn-lg btn-block mb-4">Cargar Nueva Venta
            
          <i class="fas fa-arrow-circle-right pl-2"></i>
          </button>
          </a>
          </div>

          <!-- ./col -->
        <div class="col-lg-6 offset-lg-3 col-12">
             
              @foreach ($ultimoArqueo as $item)
              @if($item->estado_caja == 1 && $item->fecha_inicio == $fechaNow )
                  
                <button type="button"  class="btn btn-dark btn-lg btn-block mb-4" data-toggle="modal" data-target="#cierreCaja" name="close_caja" id="close_caja">
                  Cierre de Caja {{ $ultimoArqueo[0]->id_caja }}
                  <i class="fas fa-cash-register nav-icon  pl-3"></i>
                </button>
          
              @else
                 <button type="button"  class="btn btn-dark btn-lg btn-block mb-4" data-toggle="modal" data-target="#aperturaCaja" name="create_caja" id="create_caja">
                  Apertura de Caja 
                  <i class="fas fa-cash-register nav-icon  pl-3"></i>
                </button>
              @endif
              @endforeach

         </div>

          <!-- ./col -->
        

          {{-- Modal Cierre de Caja --}}
@foreach ($ultimoArqueo as $item)

     @if($item->estado_caja == 1 && $item->fecha_inicio == $fechaNow )

<div class="modal fade" id="aperturaCaja" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form  method="POST" action="{{ route('arqueo.update' , $idArqueo)}}" id="sample_form_caja" enctype="multipart/form-data">
        @csrf
        @method('put')

      <div class="modal-header" style="background: #343a40; color: white">
        <h5 class="modal-title" id="exampleModalLongTitle">Apertura de Caja</h5>
        <button style="color:#ffffff" type="button" class="close btn btn-primary" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <span id="form_result"></span>
        <div class="box-body">
          
          <input type="hidden" name="id_arqueo" id="id_arqueo" value="">
            {{-- Entrada para cambio Inicial de la caja --}}
       <div class="mb-3">
          <div class="input-group">
            <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-cash-register"></span>
            </div>
          </div>
             <input type="hidden"  name="caja" value="{{$ultimoArqueo[0]->monto_inicio}}" id="caja" readonly>
            <input type="text" class="form-control" name="caja_nro" value="Caja N° {{$ultimoArqueo[0]->id_caja}}" id="caja_nro" readonly >

        </div>
        <div>
            <span  role="alert" id="cajaError">
            </span>
        </div> 
      </div> 
       {{-- Entrada para el usuario --}}
       <div class="mb-3">
          <div class="input-group">
            <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
          <input type="hidden" name="id_user" value="{{ Auth::user()->id }}"  id="id_user" readonly>
          <input type="text" class="form-control @error('usuario_caja') is-invalid @enderror" name="usuario_caja" value="{{ Auth::user()->name }}"  id="usuario_caja" autocomplete="usuario_caja" autofocus placeholder="Vendedor" readonly>
        </div>
        <div>
            <span id="usuario_cajaError" role="alert">
            </span>
        </div>   
      </div> 
            

        {{-----  Fecha de apertura -------}}
    <div class="mb-3">
          <div class="input-group">
            <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-calendar"></span>
            </div>
          </div>
          <input  type="text" class="form-control @error('fecha_inicio') is-invalid @enderror" name="fecha_inicio" id="fecha_inicio" value="{{$ultimoArqueo[0]->fecha_inicio}}"  autocomplete="fecha_inicio"  autofocus placeholder="Fecha Apertura" readonly>
        
          {{-----  Fecha de cierre -------}} 
            <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-clock"></span>
            </div>
          </div>
          <input  type="text" class="form-control @error('hora_inicio') is-invalid @enderror" name="hora_inicio" id="hora_inicio" value="{{$ultimoArqueo[0]->hora_inicio}}"  autocomplete="hora_inicio" autofocus placeholder="Hora Apertura" readonly>
          
      </div>
    </div>
     <div>
          <span  role="alert" id="aperturaError"> </span>
    </div>
     <div>
            <span  role="alert" id="cierreError"> </span>
      </div> 
          
          {{-----  Check Porcentaje -------}} 
        {{-- <label class="mr-2 icheck-danger">     
          <input type="checkbox" class="minimal inputporcentaje" checked>
            Utilizar porcentaje
           </label>    --}}
      <div class="mb-3">
          <div class="input-group ">
        
        {{-----  Input Monto Inicial -------}} 
             <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-dollar-sign"></span>
              
            </div>
          </div>
          <input  type="number" class="form-control @error('monto_inicial') is-invalid @enderror" name="monto_inicial" id="monto_inicial" autocomplete="monto_inicial" autofocus placeholder="Monto Inicial" value="{{$ultimoArqueo[0]->monto_inicio}}"> 
            <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-hand-holding-usd"></span>
              
            </div>
             
          </div>
        
          {{-- ---  Input Monto Final ------ --}}
           <input  type="number" class="form-control @error('monto_cierre') is-invalid @enderror" name="monto_cierre" id="monto_cierre" value="{{ $monFin }}"  autocomplete="monto_cierre" autofocus placeholder="Monto Final" readonly>
     
             </div>
         <div>
          <span  role="alert" id="monto_cierreError"> </span>
        </div>
        </div>

         <div class="mb-3">
          <div class="input-group ">
        
        {{-----  Input Saldo Cierre REAL -------}} 
        
             <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-dollar-sign"></span>
              
            </div>
          </div>
          <input  type="number" class="form-control @error('saldo_cierre') is-invalid @enderror" name="saldo_cierre" id="saldo_cierre" autocomplete="saldo_cierre" autofocus placeholder="Saldo en Caja" value="{{ old('saldo_cierre') }}" required> 
            <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-hand-holding-usd"></span>
              
            </div>
          </div>
           
          {{-- ---  Saldo Cierre Caja REAL ------ --}}
           <input  type="number" class="form-control @error('cierre_caja') is-invalid @enderror" name="cierre_caja" id="cierre_caja" value=""  autocomplete="cierre_caja" autofocus placeholder="Monto Final" readonly>
          
             </div>
         <div>
            @error('saldo_cierre')
              <small class="text-danger" role="alert">*{{ $message }}</small>
             @enderror
             @error('cierre_caja')
              <br><small class="text-danger" role="alert">*{{ $message }}</small>
             @enderror
        </div>
        </div>
        <div class="mb-3">
        <label for="observaciones" class="form-label">Observaciones del Cierre de Caja</label>
            <textarea class="form-control" name="observaciones" id="observaciones" rows="3">{{ old('observaciones') }}</textarea>
        </div>
  
        <input type="hidden" name="estado_caja" id="estado_caja" value="0" />
        <input type="hidden" name="action" id="action" />
        <input type="hidden" name="hidden_id" id="hidden_id"/>
        <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Salir</button>
        <input type="submit" name="action_button" id="action_button" value="Cierre" class="btn btn-primary"/>
      
    </form>
    </div>

        </div>
      </div>

  
    
  </div>
</div>
  {{-- CON APERTURA DE CAJA --}}
              @else

<div class="modal fade" id="aperturaCaja" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form  method="POST"  action="{{ route('arqueo.store') }}" id="sample_form_caja" enctype="multipart/form-data">
        @csrf
      <div class="modal-header" style="background: #343a40; color: white">
        <h5 class="modal-title" id="exampleModalLongTitle">Apertura de Caja</h5>
        <button style="color:#ffffff" type="button" class="close btn btn-primary" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <span id="form_result"></span>
        <div class="box-body">
          
            {{-- Entrada para cambio Inicial de la caja --}}
       <div class="mb-3">
          <div class="input-group">
            <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-cash-register"></span>
            </div>
          </div>
               <select class="form-control input-lg" type="text" name="caja" id="caja" required>
                {{-- Se busca la información desde la bd prioridad para el select --}}
                <option selected disabled>Seleccione Caja </option>
                <option   value="1">Caja N° 1</option>      
                <option   value="2">Caja N° 2</option>   
                <option   value="3">Caja N° 3</option> 

              </select>

        </div>
        <div>
            @error('caja')
              <small class="text-danger" role="alert">*{{ $message }}</small>
             @enderror
        </div> 
      </div> 
       {{-- Entrada para el usuario --}}
       <div class="mb-3">
          <div class="input-group">
            <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
          <input type="hidden" name="id_user" value="{{ Auth::user()->id }}"  id="id_user" readonly>
          <input type="text" class="form-control @error('usuario_caja') is-invalid @enderror" name="usuario_caja" value="{{ Auth::user()->name }}"  id="usuario_caja" autocomplete="usuario_caja" autofocus placeholder="Vendedor" readonly>
        </div>
        <div>
             @error('usuario_caja')
              <small class="text-danger" role="alert">*{{ $message }}</small>
             @enderror
        </div>   
      </div> 
            

        {{-----  Fecha de apertura -------}}
    <div class="mb-3">
          <div class="input-group">
            <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-calendar"></span>
            </div>
          </div>
          <input  type="text" class="form-control @error('fecha_inicio') is-invalid @enderror" name="fecha_inicio" id="fecha_inicio" value="{{$fechaNow}}"  autocomplete="fecha_inicio"  autofocus placeholder="Fecha Apertura" readonly>
        
          {{-----  Fecha de cierre -------}} 
            <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-clock"></span>
            </div>
          </div>
          <input  type="text" class="form-control @error('hora_inicio') is-invalid @enderror" name="hora_inicio" id="hora_inicio" value="{{$hora}}"  autocomplete="hora_inicio" autofocus placeholder="Hora Apertura" readonly>
          
      </div>
    </div>
     <div>
          <span  role="alert" id="aperturaError"> </span>
    </div>
     <div>
            <span  role="alert" id="cierreError"> </span>
      </div> 
          
          {{-----  Check Porcentaje -------}} 
        {{-- <label class="mr-2 icheck-danger">     
          <input type="checkbox" class="minimal inputporcentaje" checked>
            Utilizar porcentaje
           </label>    --}}
      <div class="mb-3">
          <div class="input-group ">
        
        {{-----  Input Monto Inicial -------}} 
             <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-dollar-sign"></span>
            </div>
          </div>
          <input  type="number" class="form-control @error('monto_inicial') is-invalid @enderror" name="monto_inicial" id="monto_inicial" autocomplete="monto_inicial" autofocus placeholder="Monto Inicial" value="{{ old('monto_inicial') }}"> 
            {{-- <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-window-close"></span>
            </div>
          </div> --}}
          {{-----  Input Monto Final -------}} 
          {{-- <input  type="number" class="form-control @error('monto_final') is-invalid @enderror" name="monto_final" id="monto_final" value="{{ old('monto_final') }}"  autocomplete="monto_final" autofocus placeholder="Monto Final"> --}}
     
             </div>
          @error('monto_inicial')
              <small class="text-danger" role="alert">*{{ $message }}</small>
          @enderror
         {{-- <div>
          <span  role="alert" id="monto_finalError"> </span>
        </div> --}}
        </div>
  
        <input type="hidden" name="estado_caja" id="estado_caja" value="1" />
        <input type="hidden" name="action" id="action" />
        <input type="hidden" name="hidden_id" id="hidden_id" />
        <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Salir</button>
        <input type="submit" name="action_button" id="action_button" value="Apertura" class="btn btn-primary"/>
      
    </form>
    </div>

        </div>
      </div>
     
    
  </div>
</div>
 @endif
  @endforeach
{{-- FIN MODAL APERTURA DE CAJA --}}

     <script>
  $('#create_caja').click(function(){
  $('.modal-title').text("Apertura de Caja");
  $('.invalid').html('');
  $("#editarCategoria").prop('disabled', true);
  $("#editarCategoria").val('');
  $("#editarCategoria").html('Seleccionar Categoria');
  $('#action_button').val("Apertura");
  $('#action').val("Apertura");
  $('#aperturaCaja').modal('show');
  // $('#monto_inicial').prop('readonly', true);
  $('#sample_form_caja')[0].reset();
 });

$('#close_caja').click(function(){
  $('.modal-title').text("Cierre de Caja");
  $('.invalid').html('');
  $("#editarCategoria").prop('disabled', true);
  $("#editarCategoria").val('');
  $("#editarCategoria").html('Seleccionar Categoria');
  $('#action_button').val("Cerrar");
  $('#action').val("Cerrar");
  $('#aperturaCaja').modal('show');
  $('#monto_inicial').prop('readonly', true);
  $('#sample_form_caja')[0].reset();
 });


/*=============================================
            CAMBIAR SALDO FINAL ARQUEO
=============================================*/
$("#aperturaCaja").on("change", "input#saldo_cierre", function () {
    let saldo_cierre = $('#saldo_cierre').val();
    let monto_cierre = $('#monto_cierre').val();
    let cierre_caja = Number(saldo_cierre) - Number(monto_cierre);
    console.log(cierre_caja)
    let cierre = $(this).parent().children('#cierre_caja');
    cierre.val(cierre_caja);

});


//VALIDACION DE APERTURA DE CAJA
//  let editarInformacion = document.querySelector('#aperturaCaja');
//     //console.log(editarInformacion);

//     editarInformacion.onsubmit = function (evento) {
      
//         if (!validateCaja()) {
//             evento.preventDefault()
//         } else {
//             editarInformacion.submit()
//         }
//     }
//  function validateCaja() {
//         //Esta manera de programarlo en ECMA6, se llama destructuración de código.
//         let {caja, caja_nro} = editarInformacion.elements
			
//         if (!validateId_caja(caja)) return false;
      
//         return true;
//     }

if($('#action_button').val() == "Apertura")
{
    let editarCaja = document.querySelector('#action_button');
    var cajaVal = document.getElementById('caja');
    var montoInicial = document.getElementById('monto_inicial');

    console.log(montoInicial.value);

    editarCaja.onclick = function (evento) {
      
        if (cajaVal.value == 1 || cajaVal.value == 2  || cajaVal.value == 3 && editar_Caja.value != "Cerrar") {
          
              editarCaja.submit()


        } 
        else {
          evento.preventDefault()
            swal ( "Debe Seleccionar un Numero de Caja y Monto Inicial" ,  "Cargue ambos datos para continuar" ,  "error" )

        }
    }
  }
// ABRIR CAJA

//   if($('#action').val() == "Edit")
//   {
//    $.ajax({
//     url:"{{ route('productos.update') }}",
//     method:"POST",
//     data:new FormData(this),
//     contentType: false,
//     cache: false,
//     processData: false,
//     dataType:"json",
//     success:function(data)
//     {
//     $('.invalid').html('');
//     var html = "";
//      let regexCodigo = /(the codigo|el codigo)/i;
//      let regexDescripcion = /(the descripcion|el descripcion)/i;
//      let regexCategoria = /(the id categoria|el id categoria)/i;
//      let regexPrecio_compra = /(the precio compra|el precio compra)/i;
//      let regexPrecio_venta = /(the precio venta|el precio venta)/i;
//      let regexStock = /(the stock|el stock)/i;
//      if(data.errors)
//      { 
//       data.errors.forEach(element => {
//         if(element.match(regexCodigo)){$('#codigoError').html('<strong class="invalid text-danger">'+element+'</strong>');}
//         if(element.match(regexDescripcion)){$('#descripcionError').html('<strong class="invalid text-danger">'+element+'</strong>');}
//         if(element.match(regexCategoria)){$('#id_categoriaError').html('<strong class="invalid text-danger">'+element+'</strong>');}
//         if(element.match(regexPrecio_compra)){$('#precio_compraError').html('<strong class="invalid text-danger">'+element+'</strong>');}
//         if(element.match(regexPrecio_venta)){$('#precio_ventaError').html('<strong class="invalid text-danger">'+element+'</strong>');}
//         if(element.match(regexStock)){$('#stockError').html('<strong class="invalid text-danger">'+element+'</strong>');}

//         else{
//           //  swal ( "Error al Editar Producto!" ,  "Producto o Email" ,  "error" )
//           console.log(element);
//         }

//          });
//      }
//      if(data.success)
//      {
//        $('#agregarProducto').html('');
// swal({
//     title: "Producto Editado Correctamente!",
//     text: "Verifica en la lista de productos",
//     icon: "success"
// }).then(function() {
//     window.location.reload();
// });  // html = '<div class="alert alert-success">' + data.success + '</div>';
//       // $('#sample_form')[0].reset();
//       // $('#store_image').html('');
//       // window.location.reload();
//       // window.location.href = "/productos";
//      }
//      $('#form_result').html(html);
//     }
//    });
//   }
//  });
 


     </script>
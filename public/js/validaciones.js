window.addEventListener('load', function () {


    let editarInformacion = document.querySelector('#formCrearVenta');
    //console.log(editarInformacion);

    editarInformacion.onsubmit = function (evento) {
        if (!validateRegisterForm()) {
            evento.preventDefault()
        } else {
            editarInformacion.submit()
        }
    }
//   console.log(editarInformacion.elements)
    //Esta es la función que valida todos los campos del formulario
    function validateRegisterForm() {
        //Esta manera de programarlo en ECMA6, se llama destructuración de código.
        let {codigo, id_cliente, listaProductos,
			impuestoVenta, nuevoCambio, nuevoEfectivo, totalVenta} = editarInformacion.elements
			
        if (!validateCodigo(codigo)) return false;
        if (!validateId_cliente(id_cliente)) return false;
        if (!validateListaProductos(listaProductos)) return false;
		if (!validateImpuestoVenta(impuestoVenta)) return false;
		// if (!validateNuevoEfectivo(nuevoEfectivo)) return false;

        return true;
    }


    //Aca empiezan las correspondientes validaciones

    function validateCodigo(codigo) {
        let codigoError = document.getElementById('codigoError');
        if (codigo.value.trim() == '' || codigo.value.trim().length < 4 || isNaN(codigo.value)) {
            codigoError.innerHTML = "Codigo no puede estar vacío o tener menos de 4 caracteres (numericos)";
            codigoError.classList.add('text-danger');
            codigo.classList.add('is-invalid');
            editarInformacion.elements.codigo.focus()

            return false;
        } else {
            codigoError.innerHTML = "";
            codigoError.classList.remove('text-danger');
            codigo.classList.remove('is-invalid');
            // codigo.classList.add('is-valid');

            return true;
        }
    }

    function validateId_cliente(id_cliente) {
		let clienteError = document.getElementById('clienteError');
        if (id_cliente.value == "") {
            clienteError.innerHTML = "Debe Seleccionar un Cliente para continuar";
            clienteError.classList.add('text-danger');
            id_cliente.classList.add('is-invalid');
            editarInformacion.elements.id_cliente.focus()

            return false;
        } else {
            clienteError.innerHTML = "";
            clienteError.classList.remove('text-danger');
            id_cliente.classList.remove('is-invalid');
            // id_cliente.classList.add('is-valid');

            return true;
        }
    }
    function validateListaProductos(listaProductos) {
        if (listaProductos.value == '') {
          
        swal("No hay productos seleccionados", "Por favor ingresa productos a la venta", "error")
            return false;
        } else {

            return true;
        }
    }

    function validateImpuestoVenta(impuestoVenta) {
        let impuestoVentaError = document.getElementById('impuestoVentaError');
        if (impuestoVenta.value == '' || impuestoVenta.value.trim().length > 4 || isNaN(impuestoVenta.value) || impuestoVenta.value < 0) {
            impuestoVentaError.innerHTML = "El impuesto debe ser numerico y positivo";
            impuestoVentaError.classList.add('text-danger');
            impuestoVenta.classList.add('is-invalid');
            editarInformacion.elements.impuestoVenta.focus()

            return false;
        }
    
        else {
            impuestoVentaError.innerHTML = "";
            impuestoVentaError.classList.remove('text-danger');
            impuestoVenta.classList.remove('is-invalid');
            // impuestoVenta.classList.add('is-valid');

            return true;
        }
    }

    // function validateNuevoCambio(nuevoCambio) {
	// 	    number = new Intl.NumberFormat().format(nuevoCambio.value);

	// 	// nuevoEfectivo =  nuevoEfectivo.value.replace(/,/g,'');
	// 	if (nuevoEfectivo.value != '' &&  number < 0) {

	// 	swal("Verifique el cambio Cargado", "No puede ser menor al total de la compra (solo numerico)", "error")
    //         // editarInformacion.elements.nuevoEfectivo.focus()
    //         return false;
	// 	} 
	// 	else{
	// 		return true;
	// 	}
    // }
    // function validatePresHabNombre(presHabNombre) {
    //     let errorPresHabNombre = document.getElementById('errorPresHabNombre');
    //     if (presHabNombre.value == '' || presHabNombre.value.trim().length > 30) {
    //         errorPresHabNombre.innerHTML = "Nombre no puede estar vacio ni tener mas de 30 caracteres";
    //         errorPresHabNombre.classList.add('text-danger');
    //         presHabNombre.classList.add('is-invalid');
    //         editarInformacion.elements.presHabNombre.focus()

    //         return false;
    //     } 
    //     else {
    //         errorPresHabNombre.innerHTML = "";
    //         errorPresHabNombre.classList.remove('text-danger');
    //         presHabNombre.classList.remove('is-invalid');
    //         presHabNombre.classList.add('is-valid');

    //         return true;
    //     }
    // }

});

// const formulario = document.getElementById('formCrearVenta');
// const inputs = document.querySelectorAll('#formCrearVenta input');
// const selects = document.querySelectorAll('#formCrearVenta select');
   

// const expresiones = {
// 	usuario: /^[a-zA-Z0-9\_\-]{4,16}$/, // Letras, numeros, guion y guion_bajo
// 	nombre: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
// 	password: /^.{4,12}$/, // 4 a 12 digitos.
// 	correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
//     telefono: /^\d{7,14}$/, // 7 a 14 numeros.
//     codigo: /^\d{5,15}$/, // 5 a 15 numeros.
//     impuestoVenta: /^\d{0,4}$/, // 0 a 1000 numeros.
//     nro_transaccion:/^\d{0,10}$/, // 0 a 10 numeros.
    

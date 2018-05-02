/* --- Inicio --- */
$(document).ready(function(){
	
	//alert("Se cargo el documento");
		
	//cargarListaClientes();
	cargarClientesNuevo();

	//alert("Se termino de cargar");

});
/* --- Fin --- */

function cargarClientesNuevo(){

	$('#tabla-informacion').DataTable({
    "processing": true,
    "paging": true,
    "lengthChange": true,
    "searching": true,
    "ordering": true,
    "info": false,
    "responsive": true,
    "autoWidth": false,
    "pageLength": 10,
    
    "ajax": {
      "url": "../ajax/get-info.php?accion=obtener-clientes2",
      "type": "POST"
    },
    "columns": [
      { "data": "idCliente" },
      { "data": "primerNombre" },
      { "data": "primerApellido" },
      { "data": "email" },
      { "data": "fechaNacimiento" },
      { "data": "fechaRegistro" },
      { "data": "estado" },
      { "data": "direccion" },
      { "data": "opciones" }
    ]
	});
}

// -- Funcion que Obtiene la lista de Clientes -- 
function cargarListaClientes(){
	
	//alert("Entra en la funcion");

	$.ajax({
		url: "../ajax/get-info.php?accion=obtener-clientes",
		data: "",
		method: "POST",
		success: function(resultado){
			//console.log(respuesta);
			$("#div-informacion").html(resultado);
		},
		error: function(e){
			alert ("Error: " + e);
		}
	});
}

function registrarCliente(){
	//alert("Entra en la funcion");

	// encodeURIComponent() function encodes special characters. In addition, it encodes the 
	// following characters: , / ? : @ & = + $ #
	// Es decir, si el Numero de Telefono inicia con un signo "+" este se reemplaza con "%2B"
	// para que pueda ser enviado
	var uri = $("#txtreg-telefono").val();
	var resultado = encodeURIComponent(uri);

	var parametros = 
			"txtreg-primer-nombre="+$("#txtreg-primer-nombre").val()+"&"+
			"txtreg-segundo-nombre="+$("#txtreg-segundo-nombre").val()+"&"+
			"txtreg-primer-apellido="+$("#txtreg-primer-apellido").val()+"&"+
			"txtreg-segundo-apellido="+$("#txtreg-segundo-apellido").val()+"&"+
			"txtreg-email="+$("#txtreg-email").val()+"&"+
			"txtreg-password="+$("#txtreg-password").val()+"&"+
			"slcreg-genero="+$("#slcreg-genero").val()+"&"+
			"txtreg-direccion="+$("#txtreg-direccion").val()+"&"+
			"txtreg-fecha-nacimiento="+$("#txtreg-fecha-nacimiento").val()+"&"+
			"txtreg-telefono="+ resultado +"&"+
			"slcreg-estado="+$("#slcreg-estado").val();
	
	//console.log(parametros);
	//alert(parametros);
	
	$.ajax({
		url: "../ajax/gestion-info-cliente.php?accion=registrar-cliente",
		method: "POST",
		data: parametros,
		success: function(resultado){
			//alert(resultado);
			$("#div-resultado-mensaje").html(resultado);
			$("#div-resultado").show();
			//$("#div-resultado").fadeOut(4500);
			//cargarListaClientes();
		},
		error:function(){
			alert("error");
		}
	});

}

// -- Función que Selecciona la Informacion de un cliente
function obtenerDetalleCliente(idCliente){

	$.ajax({
		url: "../ajax/get-info.php?accion=obtener-detalle-cliente",
		data: "idCliente=" + idCliente,
		method: "POST",
		dataType: "json",
		success: function(respuesta){

			//console.log(respuesta);
			//alert(respuesta);

			$("#txt-idcliente").val(respuesta.idCliente);
			$("#txt-primer-nombre").val(respuesta.primerNombre);
			$("#txt-segundo-nombre").val(respuesta.segundoNombre);
			$("#txt-primer-apellido").val(respuesta.primerApellido);
			$("#txt-segundo-apellido").val(respuesta.segundoApellido);
			$("#txt-email").val(respuesta.email);
			$("#txt-telefono").val(respuesta.numeroTelefono);
			$("#txt-fecha-nacimiento").val(respuesta.fechaNacimiento);
			$("#slc-estado").val(respuesta.estado);
			$("#txt-direccion").val(respuesta.direccion);
			
		},
		error: function(err){
			alert("Error: " + err);
		}
	});
}

// -- Función que Actualiza la informacion de un Cliente
function actualizarCliente(idCliente){
	
	// encodeURIComponent() function encodes special characters. In addition, it encodes the 
	// following characters: , / ? : @ & = + $ #
	// Es decir, si el Numero de Telefono inicia con un signo "+" este se reemplaza con "%2B"
	// para que pueda ser enviado
	var uri = $("#txt-telefono").val();
	var resultado = encodeURIComponent(uri);

	var parametros = "idCliente=" + idCliente +"&"+
			"txt-idcliente="+$("#txt-idcliente").val()+"&"+
			"txt-primer-nombre="+$("#txt-primer-nombre").val()+"&"+
			"txt-segundo-nombre="+$("#txt-segundo-nombre").val()+"&"+
			"txt-primer-apellido="+$("#txt-primer-apellido").val()+"&"+
			"txt-segundo-apellido="+$("#txt-segundo-apellido").val()+"&"+
			"txt-email="+$("#txt-email").val()+"&"+
			//"txt-telefono="+$("#txt-telefono").val()+"&"+
			"txt-telefono="+ resultado +"&"+
			"txt-fecha-nacimiento="+$("#txt-fecha-nacimiento").val()+"&"+
			"slc-estado="+$("#slc-estado").val()+"&"+
			"txt-direccion="+$("#txt-direccion").val();
	
	//console.log(parametros);
	//alert(parametros);
	
	$.ajax({
		url: "../ajax/gestion-info-cliente.php?accion=actualizar-cliente",
		method: "POST",
		data: parametros,
		success:function(resultado){
			//alert(resultado);
			$("#div-resultado-mensaje").html(resultado);
			$("#div-resultado").show();
			//cargarListaClientes();
		},
		error:function(){
			alert("error");
		}
	});
}

// -- Función que Elimina un Cliente usando el idCliente
function eliminarCliente(idCliente){
	
	//alert("Entra en la funcion");
	$.ajax({
		url: "../ajax/gestion-info-cliente.php?accion=eliminar-cliente",
		data: "idCliente=" + idCliente,
		method: "POST",
		success: function(resultado){
			//alert(resultado);
			$("#ddiv-resultado-mensaje").html(resultado);
			$("#div-resultado").show();
			//cargarListaClientes();

		},
		error: function(err){
			alert("Error: " + err);
		}
	});
}


$("#btn-cerrar-mensaje").click(function(){
	$("#div-resultado-mensaje").empty();
	$("#div-resultado").hide();
});



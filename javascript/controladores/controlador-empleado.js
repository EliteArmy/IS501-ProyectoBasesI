/* --- Inicio --- */
$(document).ready(function(){
	
	//alert("Se cargo el documento");
		
	$.ajax({
		url: "../ajax/get-info.php?accion=obtener-sucursales-empleado",
		data: "",
		method: "POST",
		success: function(resultado){
			//alert(resultado);
			$("#slcreg-sucursal").html(resultado);
			$("#slc-sucursal").html(resultado);
			
		},
		error: function(e){
			//$("#reporte-error").html(e);
			alert ("Error: " + e);
		}
	});	

	cargarEmpleadosNuevo();
	
	//alert("Se termino de cargar");

});
/* --- Fin --- */

// Nueva Forma de Mostrar la lista de Empleados
function cargarEmpleadosNuevo(){
	
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
        "url": "../ajax/get-info.php?accion=obtener-empleados2",
        "type": "POST"
      },
      "columns": [
        { "data": "idEmpleado" },
        { "data": "primerNombre" },
        { "data": "primerApellido" },
        { "data": "email" },
        { "data": "fechaNacimiento" },
        { "data": "fechaIngreso" },
        { "data": "estado" },
        { "data": "direccion" },
        { "data": "opciones" }
      ]
  	});
}

// -- Funcion que obtiene la lista de Empleados -- 
function cargarListaEmpleados(){
	
	//alert("Entra en la funcion Ajax");
	$.ajax({
		url: "../ajax/get-info.php?accion=obtener-empleados",
		data: "",
		method: "POST",
		success: function(resultado){
			//alert("cargo los empleados");
			$("#div-informacion").html(resultado);
		},
		error: function(e){
			alert ("Error: " + e);
		}
	});
}

function registrarEmpleado(){
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
			"txtreg-cod-empleado="+$("#txtreg-cod-empleado").val()+"&"+
			"slcreg-estado="+$("#slcreg-estado").val()+"&"+
			"slcreg-sucursal="+$("#slcreg-sucursal").val()+"&"+
			"txtreg-id-empleado="+$("#txtreg-id-empleado").val();
	
	//console.log(parametros);
	//alert(parametros);
	
	$.ajax({
		url: "../ajax/gestion-info-empleado.php?accion=registrar-empleado",
		method: "POST",
		data: parametros,
		success: function(resultado){
			//alert(resultado);
			$("#div-resultado-mensaje").html(resultado);
			$("#div-resultado").show();
			//$("#div-resultado").fadeOut(4500);
			//cargarEmpleadosNuevo();
		},
		error:function(){
			alert("error");
		}
	});

}

// -- Función que Selecciona la Informacion de un Empleado
function obtenerDetalleEmpleado(idEmpleado){
	//alert("Entra en la funcion");

	$.ajax({
		url: "../ajax/get-info.php?accion=obtener-detalle-empleado",
		data: "idEmpleado=" + idEmpleado,
		method: "POST",
		dataType: "json",
		success: function(respuesta){

			//console.log(respuesta);
			//alert(respuesta);

			$("#txt-idempleado").val(respuesta.idEmpleado);
			$("#txt-primer-nombre").val(respuesta.primerNombre);
			$("#txt-segundo-nombre").val(respuesta.segundoNombre);
			$("#txt-primer-apellido").val(respuesta.primerApellido);
			$("#txt-segundo-apellido").val(respuesta.segundoApellido);
			$("#txt-email").val(respuesta.email);
			$("#txt-telefono").val(respuesta.numeroTelefono);
			$("#txt-fecha-nacimiento").val(respuesta.fechaNacimiento);
			$("#slc-estado").val(respuesta.estado);
			$("#txt-direccion").val(respuesta.direccion);
			$("#slc-sucursal").val(respuesta.idSucursal);
			$("#txt-id-empleado").val(respuesta.idEmpleadoSuperior);
			
		},
		error: function(err){
			alert("Error: " + err);
		}
	});
}

// -- Función que Actualiza la informacion de un Empleado
function actualizarEmpleado(idEmpleado){
	
	// encodeURIComponent() function encodes special characters. In addition, it encodes the 
	// following characters: , / ? : @ & = + $ #
	// Es decir, si el Numero de Telefono inicia con un signo "+" este se reemplaza con "%2B"
	// para que pueda ser enviado
	var uri = $("#txt-telefono").val();
	var resultado = encodeURIComponent(uri);

	var parametros = "idEmpleado=" + idEmpleado +"&"+
			"txt-idempleado="+$("#txt-idempleado").val()+"&"+
			"txt-primer-nombre="+$("#txt-primer-nombre").val()+"&"+
			"txt-segundo-nombre="+$("#txt-segundo-nombre").val()+"&"+
			"txt-primer-apellido="+$("#txt-primer-apellido").val()+"&"+
			"txt-segundo-apellido="+$("#txt-segundo-apellido").val()+"&"+
			"txt-email="+$("#txt-email").val()+"&"+
			"slc-genero="+$("#slc-genero").val()+"&"+
			//"txt-telefono="+$("#txt-telefono").val()+"&"+
			"txt-telefono="+ resultado +"&"+
			"txt-fecha-nacimiento="+$("#txt-fecha-nacimiento").val()+"&"+
			"slc-estado="+$("#slc-estado").val()+"&"+
			"slc-sucursal="+$("#slc-sucursal").val()+"&"+
			"txt-id-empleado="+$("#txt-id-empleado").val()+"&"+
			"txt-direccion="+$("#txt-direccion").val();
	
	//console.log(parametros);
	//alert(parametros);
	
	$.ajax({
		url: "../ajax/gestion-info-empleado.php?accion=actualizar-empleado",
		method: "POST",
		data: parametros,
		success:function(resultado){
			//alert(resultado);
			$("#div-resultado-mensaje").html(resultado);
			$("#div-resultado").show();
			//$("#div-resultado").fadeOut(4500);
			//cargarEmpleadosNuevo();
		},
		error:function(err){
			alert("Error: " + err);
		}
	});
}


// Funcion que Elimina un Empleado usando el idEmpleado
function eliminarEmpleado(idEmpleado){
	
	//alert("Entra en la funcion");
	$.ajax({
		url: "../ajax/gestion-info-empleado.php?accion=eliminar-empleado",
		data: "idEmpleado=" + idEmpleado,
		method: "POST",
		success: function(resultado){
			//alert(resultado);
			$("#div-resultado-mensaje").html(resultado);
			$("#div-resultado").show();
			//cargarEmpleadosNuevo();
		},
		error: function(err){
			alert("Error: " + err);
		}
	});
}

// Gestiona el div que muestra mensajes o errores
$("#btn-cerrar-mensaje").click(function(){
	$("#div-resultado-mensaje").empty();
	$("#div-resultado").hide();
});



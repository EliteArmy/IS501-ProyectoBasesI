/* --- Inicio - Esto se ejecuta al final de la Pagina --- */
$(document).ready(function(){
	
	//alert("Se cargo el documento");

		/*$.ajax({
		url: "../ajax/get-info.php?accion=obtener-sucursales",
		data: "",
		method: "POST",
		success: function(resultado){
			//alert(resultado)
			$("#div-informacion").html(resultado);
		},
		error: function(e){
			alert ("Error: " + e);
		}
	});*/
		
	cargarListaSucursales();

	//alert("Se termino de cargar");

});
/* --- Fin --- */

/* -- Función que obtiene la lista de sucursales -- */
function cargarListaSucursales(){

	//alert("Entra en la funcion");
	$.ajax({
		url: "../ajax/get-info.php?accion=obtener-sucursales",
		data: "",
		method: "POST",
		success: function(resultado){
			//alert(resultado)
			$("#div-informacion").html(resultado);
		},
		error: function(e){
			alert ("Error: " + e);
		}
	});
	
	
}

function registrarSucursal(){

	var parametros =
			"txtreg-nombre="+$("#txtreg-nombre").val()+"&"+
			"txtreg-cantidad-hab="+$("#txtreg-cantidad-hab").val()+"&"+
			"txtreg-telefono="+$("#txtreg-telefono").val()+"&"+
			"txtreg-email="+$("#txtreg-email").val()+"&"+
			"txtreg-direccion="+$("#txtreg-direccion").val()+"&"+
			"txtreg-descripcion="+$("#txtreg-descripcion").val()+"&"+
			"txtreg-id-restaurante="+$("#txtreg-id-restaurante").val()+"&"+
			"txtreg-hotel="+$("#txtreg-hotel").val();
	$.ajax({
		url: "../ajax/gestion-info-sucursal.php?accion=registrar-sucursal",
		method: "POST",
		data: parametros,
		success: function(resultado){
			//alert(resultado);
			$("#div-resultado-mensaje").html(resultado);
			$("#div-resultado").show();
			cargarListaSucursales();
		},
		error:function(){
			alert("error");
		}
	});

}

/* Función que Selecciona la Informacion de una sucursal*/
function obtenerDetalleSucursal(idSucursal){

	$.ajax({
		url: "../ajax/get-info.php?accion=obtener-detalle-sucursal",
		data: "idSucursal=" + idSucursal,
		method: "POST",
		dataType: "json",
		success: function(respuesta){

			//console.log(respuesta);
			//alert(respuesta);

			$("#txt-idSucursal").val(respuesta.idSucursal);
			$("#txt-nombre").val(respuesta.nombre);
			$("#txt-cantidad-hab").val(respuesta.cantidadHabitaciones);
			$("#txt-telefono").val(respuesta.telefono);
			$("#txt-email").val(respuesta.email);
			$("#txt-direccion").val(respuesta.direccion);
			$("#txt-descripcion").val(respuesta.descripcion);
			$("#txt-id-restaurante").val(respuesta.idRestaurante);
			$("#txt-id-hotel").val(respuesta.idHotel);
			
			// Falta Implementar:
			//$("#btn-guardar").hide();
			//$("#btn-actualizar").show();
		},
		error: function(err){
			alert("Error: " + err);
		}
	});
}

/*función para actualizar la sucursal*/
function actualizarSucursal(idSucursal){
	

	var parametros = "idSucursal=" + idSucursal +"&"+
			"txt-idSucursal="+$("#txt-idSucursal").val()+"&"+
			"txt-nombre="+$("#txt-nombre").val()+"&"+
			"txt-cantidad-hab="+$("#txt-cantidad-hab").val()+"&"+
			"txt-telefono="+$("#txt-telefono").val()+"&"+
			"txt-email="+$("#txt-email").val()+"&"+
			"txt-direccion="+$("#txt-direccion").val()+"&"+
			"txt-fecha-nacimiento="+$("#txt-fecha-nacimiento").val()+"&"+
			"txt-descripcion="+$("#txt-descripcion").val()+"&"+
			"txt-id-restaurante="+$("#txt-id-restaurante").val();
	
	//console.log(parametros);
	alert(parametros);
	
	$.ajax({
		url: "../ajax/gestion-info-sucursal.php?accion=actualizar-sucursal",
		method: "POST",
		data: parametros,
		success:function(resultado){
			//alert(resultado);
			$("#div-resultado-mensaje").html(resultado);
			$("#div-resultado").show();
			cargarListaSucursales();
		},
		error:function(){
			alert("error");
		}
	});
}


/*Función para eliminar la sucursal*/
function eliminarSucursal(idSucursal){
	
	//alert("Entra en la funcion");
	$.ajax({
		url: "../ajax/gestion-info-sucursal.php?accion=eliminar-sucursal",
		data: "idSucursal=" + idSucursal,
		method: "POST",
		success: function(resultado){
			//alert(resultado);
			$("#div-resultado-mensaje").html(resultado);
			$("#div-resultado").show();
			cargarListaSucursales();

		},
		error: function(err){
			alert("Error: " + err);
		}
	});
}

$("#btn-cerrar-mensaje").click(function(){
	$("#div-resultado").empty();
	$("#div-resultado").hide();
});





// --- --- --- ---

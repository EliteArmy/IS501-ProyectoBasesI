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

	$.ajax({
		url: "../ajax/get-info.php?accion=obtener-restaurantes-sucursal",
		data: "",
		method: "POST",
		success: function(resultado){
			//alert(resultado);
			$("#slcreg-restaurante").html(resultado);
		},
		error: function(e){
			//$("#reporte-error").html(e);
			alert ("Error: " + e);
		}
	});	

	$.ajax({
		url: "../ajax/get-info.php?accion=obtener-restaurantes-sucursal2",
		data: "",
		method: "POST",
		success: function(resultado){
			//alert(resultado);
			$("#slc-restaurante").html(resultado);
		},
		error: function(e){
			//$("#reporte-error").html(e);
			alert ("Error: " + e);
		}
	});	

	$.ajax({
		url: "../ajax/get-info.php?accion=obtener-hotel-sucursal",
		data: "",
		method: "POST",
		success: function(resultado){
			//alert(resultado);
			$("#slc-hotel").html(resultado);
		},
		error: function(e){
			//$("#reporte-error").html(e);
			alert ("Error: " + e);
		}
	});	
		
	cargarListaSucursales();

	//alert("Se termino de cargar");

});
/* --- Fin --- */


function cargarSucursalNueva(){

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
        "url": "../ajax/get-info.php?accion=obtener-sucursales2",
        "type": "POST"
      },
      "columns": [
        { "data": "idSucursal" },
        { "data": "nombre" },
        { "data": "habitacionesDisponibles" },
        { "data": "telefono" },
        { "data": "direccion" },
        { "data": "descripcion" },
        { "data": "opciones" }
      ]
  });
}

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
			$("#slc-restaurante").val(respuesta.idRestaurante);
			$("#slc-hotel").val(respuesta.idHotel);
			$("#txt-hotel").val(respuesta.descripcionHotel);
			
			// Falta Implementar:
			//$("#btn-guardar").hide();
			//$("#btn-actualizar").show();
		},
		error: function(err){
			alert("Error: " + err);
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
			"slcreg-restaurante="+$("#slcreg-restaurante").val()+"&"+
			"txtreg-hotel="+$("#txtreg-hotel").val();
	
	$.ajax({
		url: "../ajax/gestion-info-sucursal.php?accion=registrar-sucursal",
		method: "POST",
		data: parametros,
		success: function(resultado){
			//alert(resultado);
			$("#div-resultado-mensaje").html(resultado);
			$("#div-resultado").show();
			$("#div-resultado").fadeOut(4500);
			cargarSucursalNueva();
		},
		error:function(){
			alert("error");
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
			"txt-descripcion="+$("#txt-descripcion").val()+"&"+
			"slc-restaurante="+$("#slc-restauranten").val()+"&"+
			"slc-hotel="+$("#slc-hotel").val()+"&"+
			"txt-hotel="+$("#txt-hotel").val();
	
	//console.log(parametros);
	//alert(parametros);
	
	$.ajax({
		url: "../ajax/gestion-info-sucursal.php?accion=actualizar-sucursal",
		method: "POST",
		data: parametros,
		success:function(resultado){
			//alert(resultado);
			$("#div-resultado-mensaje").html(resultado);
			$("#div-resultado").show();
			$("#div-resultado").fadeOut(4500);
			cargarSucursalNueva();
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
			cargarSucursalNueva();

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

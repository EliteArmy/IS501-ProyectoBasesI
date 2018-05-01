/* --- Inicio - Esto se ejecuta al final de la Pagina --- */
$(document).ready(function(){
	
	//alert("Se cargo el documento");
		$.ajax({
		url: "../ajax/get-info.php?accion=obtener-sucursales-habitacion",
		data: "",
		method: "POST",
		success: function(resultado){
			//alert(resultado);
			$("#slcreg-sucursal").html(resultado);
		},
		error: function(e){
			//$("#reporte-error").html(e);
			alert ("Error: " + e);
		}
	});	

	$.ajax({
		url: "../ajax/get-info.php?accion=obtener-tipoCategoria-habitacion",
		data: "",
		method: "POST",
		success: function(resultado){
			//alert(resultado);
			$("#slcreg-tipoCategoria").html(resultado);
		},
		error: function(e){
			//$("#reporte-error").html(e);
			alert ("Error: " + e);
		}
	});	

	$.ajax({
		url: "../ajax/get-info.php?accion=obtener-tipoHabitacion-habitacion",
		data: "",
		method: "POST",
		success: function(resultado){
			//alert(resultado);
			$("#slcreg-tipoHabitacion").html(resultado);
		},
		error: function(e){
			//$("#reporte-error").html(e);
			alert ("Error: " + e);
		}
	});	


		/*$.ajax({
		url: "../ajax/get-info.php?accion=obtener-habitaciones",
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
		
	cargarListaHabitaciones();

	//alert("Se termino de cargar");

});
/* --- Fin --- */

function cargarHabitacionNueva(){

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
        "url": "../ajax/get-info.php?accion=obtener-habitaciones2",
        "type": "POST"
      },
      "columns": [
        { "data": "idHabitacion" },
        { "data": "numeroHabitacion" },
        { "data": "numeroPiso" },
        { "data": "estado" },
        { "data": "descripcion" },
        { "data": "tipoCategoria" },
        { "data": "tipoHabitacion" },
        { "data": "opciones" }
      ]
  });
}

/* -- Función Cargar Lista -- */
function cargarListaHabitaciones(){
	
	//alert("Entra en la funcion");
	
	$.ajax({
		url: "../ajax/get-info.php?accion=obtener-habitaciones",
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

function obtenerDetalleHabitacion(idHabitacion){
	//alert("Entra en la funcion");

	$.ajax({
		url: "../ajax/get-info.php?accion=obtener-detalle-habitacion",
		data: "idHabitacion=" + idHabitacion,
		method: "POST",
		dataType: "json",
		success: function(respuesta){

			//console.log(respuesta);
			//alert(respuesta);

			$("#txt-idHabitacion").val(respuesta.idHabitacion);
			$("#txt-numero-hab").val(respuesta.numeroHabitacion);
			$("#txt-numero-piso").val(respuesta.numeroPiso);
			$("#txt-estado").val(respuesta.estado);
			$("#txt-descripcion").val(respuesta.descripcion);
			$("#slc-tipoCategoria").val(respuesta.tipoCategoria);;
			$("#slc-tipoHabitacion").val(respuesta.tipoHabitacion);
			$("#slc-sucursal").val(respuesta.sucursal);
			// Falta Implementar:
			//$("#btn-guardar").hide();
			//$("#btn-actualizar").show();
		},
		error: function(err){
			alert("Error: " + err);
		}
	});
}

function registrarHabitacion(){
	//alert("Entra en la funcion");

	var parametros = 
			"txtreg-numero-hab="+$("#txtreg-numero-hab").val()+"&"+
			"txtreg-numero-piso="+$("#txtreg-numero-piso").val()+"&"+
			"txtreg-estado="+$("#txtreg-estado").val()+"&"+
			"txtreg-descripcion="+$("#txtreg-descripcion").val()+"&"+
			"slcreg-tipoCategoria="+$("#slcreg-tipoCategoria").val()+"&"+
			"slcreg-tipoHabitacion="+$("#slcreg-tipoHabitacion").val()+"&"+
			"slcreg-sucursal="+$("#slcreg-sucursal").val();
	
	//console.log(parametros);
	//alert(parametros);
	
	$.ajax({
		url: "../ajax/gestion-info-habitacion.php?accion=registrar-habitacion",
		method: "POST",
		data: parametros,
		success: function(resultado){
			//alert(resultado);
			$("#div-resultado-mensaje").html(resultado);
			$("#div-resultado").show();
			$("#div-resultado").fadeOut(4500);
			cargarHabitacionNueva();
		},
		error:function(){
			alert("error");
		}
	});

}

function actualizarHabitacion(idHabitacion){

	//alert("Entra en la funcion");

	var parametros = 
			"idHabitacion=" + idHabitacion +"&"+
			"txt-idHabitacion="+$("#txt-idHabitacion").val()+"&"+
			"txt-numero-hab="+$("#txt-numero-hab").val()+"&"+
			"txt-numero-piso="+$("#txt-numero-piso").val()+"&"+
			"txt-estado="+$("#txt-estado").val()+"&"+
			"txt-descripcion="+$("#txt-descripcion").val()+"&"+
			"slc-tipoCategoria="+$("#slc-tipoCategoria").val()+"&"+
			"slc-tipoHabitacion="+$("#slc-tipoHabitacion").val()+"&"+
			"slc-sucursal="+$("#slc-sucursal").val();

			$.ajax({
		url: "../ajax/gestion-info-habitacion.php?accion=actualizar-habitacion",
		method: "POST",
		data: parametros,
		success:function(resultado){
			//alert(resultado);
			$("#div-resultado-mensaje").html(resultado);
			$("#div-resultado").show();
			$("#div-resultado").fadeOut(4500);
			cargarHabitacionNueva();
		},
		error:function(err){
			alert("Error: " + err);
		}
	});
}

// Funcion que Elimina una habitación
function eliminarHabitacion(idHabitacion){
	
	//alert("Entra en la funcion");
	$.ajax({
		url: "../ajax/gestion-info-habitacion.php?accion=eliminar-habitacion",
		data: "idHabitacion=" + idHabitacion,
		method: "POST",
		success: function(resultado){
			//alert(resultado);
			$("#div-resultado-mensaje").html(resultado);
			$("#div-resultado").show();
			cargarHabitacionNueva();
		},
		error: function(err){
			alert("Error: " + err);
		}
	});
}




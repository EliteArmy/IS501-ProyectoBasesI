/* --- Inicio - Esto se ejecuta al final de la Pagina --- */
$(document).ready(function(){
	
	//alert("Se cargo el documento");

		/*$.ajax({
		url: "../ajax/get-info.php?accion=obtener-facturas",
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
		url: "../ajax/get-info.php?accion=obtener-cliente-factura",
		data: "",
		method: "POST",
		success: function(resultado){
			//alert(resultado);
			$("#slcreg-cliente").html(resultado);
		},
		error: function(e){
			//$("#reporte-error").html(e);
			alert ("Error: " + e);
		}
	});	

	$.ajax({
		url: "../ajax/get-info.php?accion=obtener-empleado-factura",
		data: "",
		method: "POST",
		success: function(resultado){
			//alert(resultado);
			$("#slcreg-empleado").html(resultado);
		},
		error: function(e){
			//$("#reporte-error").html(e);
			alert ("Error: " + e);
		}
	});	

	$.ajax({
		url: "../ajax/get-info.php?accion=obtener-tipoFactura-factura",
		data: "",
		method: "POST",
		success: function(resultado){
			//alert(resultado);
			$("#slcreg-tipofactura").html(resultado);
		},
		error: function(e){
			//$("#reporte-error").html(e);
			alert ("Error: " + e);
		}
	});	

	$.ajax({
		url: "../ajax/get-info.php?accion=obtener-modoPago-factura",
		data: "",
		method: "POST",
		success: function(resultado){
			//alert(resultado);
			$("#slcreg-modoPago").html(resultado);
		},
		error: function(e){
			//$("#reporte-error").html(e);
			alert ("Error: " + e);
		}
	});	
		
	cargarListaFacturas();

	//alert("Se termino de cargar");


});
/* --- Fin --- */

/* -- Obtener Personas -- */
function cargarListaFacturas(){
	
	//alert("Entra en la funcion");
	$.ajax({
		url: "../ajax/get-info.php?accion=obtener-facturas",
		data: "",
		method: "POST",
		success: function(resultado){
			//alert(resultado)
			$("#div-informacion").html(resultado);
		},
		error: function(e){
			alert ("Error: " + e);
		}
	})
	
	
}


/* --- Inicio - Esto se ejecuta al final de la Pagina --- */
$(document).ready(function(){
	
	//alert("Se cargo el documento");

	$.ajax({
		url: "../ajax/get-info-reservacion.php?accion=obtener-categorias",
		data: "",
		method: "POST",
		success: function(resultado){
			//alert(resultado)
			$("#slc-categoria").html(resultado);
		},
		error: function(e){
			//$("#reporte-error").html(e);
			//alert ("Error: " + e);
		}
	});

	$.ajax({
		url: "../ajax/get-info-reservacion.php?accion=obtener-tipos",
		data: "",
		method: "POST",
		success: function(resultado){
			//alert(resultado)
			$("#slc-tipo").html(resultado);
		},
		error: function(e){
			//alert ("Error: " + e);
			//$("#reporte-error").html(e);
		}
	});
		
	cargarLista();

	//alert("Se termino de cargar");

});
/* --- Fin --- */

/* -- Función Cargar Lista -- */
function cargarLista(){
	
	//alert("Entra en la funcion");
	
}



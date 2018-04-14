/* --- Inicio - Esto se ejecuta al final de la Pagina --- */
$(document).ready(function(){
	
	//alert("Se cargo el documento");

		$.ajax({
		url: "../ajax/get-info.php?accion=obtener-habitaciones",
		data: "",
		method: "POST",
		success: function(resultado){
			alert(resultado)
			$("#div-informacion").html(resultado);
		},
		error: function(e){
			alert ("Error: " + e);
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



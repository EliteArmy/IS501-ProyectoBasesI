/* --- Inicio --- */
$(document).ready(function(){
	
	//alert("Se cargo el documento");
		
	/*
	$.ajax({
		url:"ajax/get-info.php?accion=obtener_categorias",
		data:"",
		method:"POST",
		success:function(resultado){
			$("#div-categorias").html(resultado);
		},
		error:function(){

		}
	});	

	$.ajax({
		url:"ajax/get-info.php?accion=obtener_empresas",
		data:"",
		method:"POST",
		success:function(resultado){
			$("#slc-empresa").html(resultado);
		},
		error:function(e){
			alert("Error: " + e);
		}
	});	

	$.ajax({
		url:"ajax/get-info.php?accion=obtener_tipos_calificaciones",
		data:"",
		method:"POST",
		success:function(resultado){
			$("#slc-tipos-calificaciones").html(resultado);
		},
		error:function(e){
			alert("Error: " + e);
		}
	});	

	$.ajax({
		url:"ajax/get-info.php?accion=obtener_tipos_contenidos",
		data:"",
		method:"POST",
		success:function(resultado){
			$("#slc-tipos-contenidos").html(resultado);
		},
		error:function(e){
			alert("Error: " + e);
		}
	});	
*/
	cargarListaClientes();

	//alert("Se termino de cargar");

});
/* --- Fin --- */

// -- Funcion que Obtiene la lista de Clientes -- 
function cargarListaClientes(){
	
	//alert("Entra en la funcion Ajax");
	$.ajax({
		url: "../ajax/get-info.php?accion=obtener-clientes",
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

// Funcion que Elimina un Cliente usando el idCliente
function eliminarCliente(idCliente){
	
	//alert("Entra en la funcion");
	$.ajax({
		url: "../ajax/gestion-info-cliente.php?accion=eliminar-cliente",
		data: "idPersona="+idCliente,
		method: "POST",
		success: function(resultado){
			//$("#div-resultado-insert").html(respuesta);
			//alert(resultado);
			cargarListaClientes();
		},
		error: function(err){
			alert("Error: " + err);
		}
	});
}

function seleccionarCliente(idCliente){
	//alert("Selecciono la cliente " + idCliente + ", hay que obtener la informacion del servidor");
	$.ajax({
		url: "../ajax/get-info.php?accion=obtener-cliente",
		data: "idPersona="+idCliente,
		method: "POST",
		dataType: "json",
		success: function(respuesta){

			console.log(respuesta);
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
			
			// Falta Implementar
			//$("#btn-guardar").hide();
			//$("#btn-actualizar").show();
		},
		error: function(err){
			alert("Error: " + err);
		}
	});
}


function editarCliente(idCliente){
	var parametros = "idPersona="+idCliente;
	$.ajax({
		url:"../ajax/gestion-info-cliente.php?accion=editar-cliente",
		method: "POST",
		data:parametros,
		dataType:"json",
		success:function(resultado){		 

		},
		error:function(){
			alert("error");
		}
	});
}


$("#btn-guardar").click(function(){
	var categorias = "";
	//categorias[]=1&lista[]=2&lista[]=3&

	$("input[name='categorias[]']:checked").map(function(){
		categorias += "categorias[]="+$(this).val()+"&";
	});
	alert(categorias);

	var parametros= categorias + "txt-nombre-aplicacion="+$("#txt-nombre-aplicacion").val()+"&"+
					"txt-descripcion="+$("#txt-descripcion").val()+"&"+
					"txt-fecha-publicacion="+$("#txt-fecha-publicacion").val()+"&"+
					"txt-calificacion="+$("#txt-calificacion").val()+"&"+
					"slc-url-icono="+$("#slc-url-icono").val()+"&"+
					"txt-version="+$("#txt-version").val()+"&"+
					"slc-empresa="+$("#slc-empresa").val()+"&"+
					"slc-tipos-calificaciones="+$("#slc-tipos-calificaciones").val()+"&"+
					"slc-tipos-contenidos="+$("#slc-tipos-contenidos").val();
	alert(parametros);
	
	$.ajax({
		url:"ajax/gestion-aplicaciones.php?accion=guardar",
		data:parametros,
		method:"POST",
		success:function(respuesta){
			$("#div-resultado-insert").html(respuesta);
			cargarListaAplicaciones();
		},
		error:function(err){
			alert("Error: " + err);
		}
	});
});


function eliminarAplicacion(codigoAplicacion){
	$.ajax({
		url:"ajax/gestion-aplicaciones.php?accion=eliminar",
		data:"codigo-aplicacion="+codigoAplicacion,
		method:"POST",
		success:function(respuesta){
			//$("#div-resultado-insert").html(respuesta);
			cargarListaAplicaciones();
		},
		error:function(err){
			alert("Error: " + err);
		}
	});
}


$("#btn-limpiar").click(function(){
		$("#txt-nombre-aplicacion").val(null);
		$("#txt-descripcion").val(null);
		$("#txt-fecha-publicacion").val(null);
		$("#txt-version").val(null);
		$("#txt-calificacion").val(null);
		$("#slc-empresa").val(null);
		$("#slc-tipos-contenidos").val(null);
		$("#slc-tipos-calificaciones").val(null);
		$("#slc-url-icono").val(null);

		$("#btn-guardar").show();
		$("#btn-actualizar").hide();
});


$("#btn-actualizar").click(function(){
	var categorias = "";
	//categorias[]=1&lista[]=2&lista[]=3&

	$("input[name='categorias[]']:checked").map(function(){
		categorias += "categorias[]="+$(this).val()+"&";
	});
	//alert(categorias);

	var parametros= categorias + "txt-codigo-aplicacion="+$("#txt-codigo-aplicacion").val()+"&"+
					"txt-nombre-aplicacion="+$("#txt-nombre-aplicacion").val()+"&"+
					"txt-descripcion="+$("#txt-descripcion").val()+"&"+
					"txt-fecha-publicacion="+$("#txt-fecha-publicacion").val()+"&"+
					"txt-calificacion="+$("#txt-calificacion").val()+"&"+
					"slc-url-icono="+$("#slc-url-icono").val()+"&"+
					"txt-version="+$("#txt-version").val()+"&"+
					"slc-empresa="+$("#slc-empresa").val()+"&"+
					"slc-tipos-calificaciones="+$("#slc-tipos-calificaciones").val()+"&"+
					"slc-tipos-contenidos="+$("#slc-tipos-contenidos").val();
	alert(parametros);
	$.ajax({
		url:"ajax/gestion-aplicaciones.php?accion=actualizar",
		data:parametros,
		method:"POST",
		success:function(respuesta){
			$("#div-resultado-insert").html(respuesta);
			cargarListaAplicaciones();
		},
		error:function(err){
			alert("Error: " + err);
		}
	});
});


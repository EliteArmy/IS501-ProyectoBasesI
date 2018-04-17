/* --- Inicio --- */
$(document).ready(function(){
	
	//alert("Se cargo el documento");
<<<<<<< HEAD

		/*$.ajax({
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
	});*/
=======
>>>>>>> d1926eb86475f58bc6bc06287eb9b85a8f7f7eb7
		
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

<<<<<<< HEAD
//Funcion que obtiene la lista de clientes 
function cargarListaClientes(){
	
	//alert("Entra en la funcion");
=======
// -- Funcion que Obtiene la lista de Clientes -- 
function cargarListaClientes(){
	
	//alert("Entra en la funcion Ajax");
>>>>>>> d1926eb86475f58bc6bc06287eb9b85a8f7f7eb7
	$.ajax({
		url: "../ajax/get-info.php?accion=obtener-clientes",
		data: "",
		method: "POST",
		success: function(resultado){
			//alert(resultado)
<<<<<<< HEAD
			//alert("cargo los empleados");
=======
>>>>>>> d1926eb86475f58bc6bc06287eb9b85a8f7f7eb7
			$("#div-informacion").html(resultado);
		},
		error: function(e){
			alert ("Error: " + e);
		}
	});
}

<<<<<<< HEAD
// Funcion que cliente un cliente usando el idCliente
=======
// Funcion que Elimina un Cliente usando el idCliente
>>>>>>> d1926eb86475f58bc6bc06287eb9b85a8f7f7eb7
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


function seleccionarAplicacion(codigoAplicacion){
	//alert("Selecciono la aplicacion " + codigoAplicacion + ", hay que obtener la informacion del servidor");
	$.ajax({
		url:"ajax/get-info.php?accion=obtener-aplicacion",
		data:"codigo-aplicacion="+codigoAplicacion,
		method:"POST",
		dataType:"json",
		success:function(respuesta){
			console.log(respuesta);
			$("#txt-codigo-aplicacion").val(respuesta.codigo_aplicacion);
			$("#txt-nombre-aplicacion").val(respuesta.nombre_aplicacion);
			$("#txt-descripcion").val(respuesta.descripcion);
			$("#txt-fecha-publicacion").val(respuesta.fecha_publicacion);
			$("#txt-version").val(respuesta.version);
			$("#txt-calificacion").val(respuesta.calificacion);
			$("#slc-empresa").val(respuesta.codigo_empresa);
			$("#slc-tipos-contenidos").val(respuesta.codigo_tipo_contenido);
			$("#slc-tipos-calificaciones").val(respuesta.codigo_tipo_calificacion);
			$("#slc-url-icono").val(respuesta.url_icono);
			

			//Almacenar en un arreglo temporal los valores de la categoria, no
			//se puede utilizar el arreglo directo del JSON porque cada elemento es un objeto.
			var categorias=[];
			for (var i =0;i<respuesta.categorias.length;i++){
				categorias[i]=respuesta.categorias[i].codigo_categoria;
			}


			//Buscar todos los elementos html en el cual el nombre sea categorias[] y para cada 
			//elemento verificar si el valor esta dentro de la lista retornada por el json
			//en caso de si estar agregar el atributo checked="checked"
			$("input[name='categorias[]']").map(function(){
				var indice = categorias.indexOf($(this).val());
				if (indice>=0){
					$(this).attr("checked","checked");

				}
			});
			$("#btn-guardar").hide();
			$("#btn-actualizar").show();
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


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
			$("#div-resultado").fadeOut(4500);
			cargarEmpleadosNuevo();
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
			
			// Falta Implementar:
			//$("#btn-guardar").hide();
			//$("#btn-actualizar").show();
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
			$("#div-resultado").fadeOut(4500);
			cargarEmpleadosNuevo();
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
			cargarEmpleadosNuevo();
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



// --- --- --- ---
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


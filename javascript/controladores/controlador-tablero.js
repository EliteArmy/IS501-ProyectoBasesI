/* --- Inicio - Esto se ejecuta al final de la Pagina --- */
$(document).ready(function(){
	
	//alert("Se cargo el documento");

	// Carga las opciones de Registro de Reservacion
	$.ajax({
		url: "../ajax/get-info-reservacion.php?accion=obtener-categorias",
		data: "",
		method: "POST",
		success: function(resultado){
			//alert(resultado);
			$("#slc-categoria").html(resultado);
		},
		error: function(e){
			//$("#reporte-error").html(e);
			//alert ("Error: " + e);
		}
	});

	// Carga las opciones de Registro de Reservacion
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

	// Carga las opciones de Registro de Reservacion
	$.ajax({
		url: "../ajax/get-info-reservacion.php?accion=obtener-sucursal",
		data: "",
		method: "POST",
		success: function(resultado){
			//alert(resultado)
			$("#slc-sucursal").html(resultado);
		},
		error: function(e){
			//alert ("Error: " + e);
			//$("#reporte-error").html(e);
		}
	});

	$.ajax({
		url: "../ajax/get-info-reservacion.php?accion=obtener-pago",
		data: "",
		method: "POST",
		success: function(resultado){
			//alert(resultado)
			$("#slc-modo-pago").html(resultado);
		},
		error: function(e){
			//alert ("Error: " + e);
			//$("#reporte-error").html(e);
		}
	});

	$.ajax({
		url: "../ajax/get-info-reservacion.php?accion=obtener-factura",
		data: "",
		method: "POST",
		success: function(resultado){
			//alert(resultado)
			$("#slc-tipo-factura").html(resultado);
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
	//cambiosPrecio();
	//cambiosHabitacion();
}

// Cada que este select cambie, ocurrira un update el slc-precio
$('#slc-categoria').change(function() {
	cambiosPrecio();
});

$('#slc-tipo').change(function() {
	cambiosPrecio();
});

function cambiosPrecio(){

  var parametros = "slc-categoria=" + $("#slc-categoria").val() +"&"+
  "slc-tipo=" + $("#slc-tipo").val();
	//alert(parametros);

	if ($("#slc-categoria").val() && $("#slc-tipo").val()){
	   $.ajax({
  	  url: "../ajax/get-info-reservacion.php?accion=obtener-precio",
      method: "POST",
      data: parametros,
      success: function(resultado){
         $("#slc-precio").html(resultado);
         //$("#div-resultado-mensaje").html(resultado);
         //$("#div-resultado").show();
      },
      error:function(err){
				alert("Error: " + err);
			}
    });
	}    
}

// Cada que este select cambie, ocurrira un update el slc-habitacion
$('#slc-sucursal').change(function() {
	cambiosHabitacion();
});

function cambiosHabitacion(){
	var parametros = "slc-sucursal=" + $("#slc-sucursal").val();
	//alert(parametros);
	$.ajax({
	  url: "../ajax/get-info-reservacion.php?accion=obtener-habitacion",
    method: "POST",
    data: parametros,
    success: function(resultado){
       $("#slc-habitacion").html(resultado);
       //$("#div-resultado-mensaje").html(resultado);
       //$("#div-resultado").show();
    },
    error:function(err){
			alert("Error: " + err);
		}
  });
}

// Función para Registrar una Reservación
function registrarReservacion(){

	var parametros = "txt-idcliente="+$("#txt-idcliente").val()+"&"+
		"txt-primer-nombre="+$("#txt-primer-nombre").val()+"&"+
		"txt-primer-apellido="+$("#txt-primer-apellido").val()+"&"+
		"txt-fecha-entrada="+$("#txt-fecha-entrada").val()+"&"+
		"txt-fecha-salida="+$("#txt-fecha-salida").val()+"&"+
		"slc-supletoria="+$("#slc-supletoria").val()+"&"+
		"slc-estado="+$("#slc-estado").val()+"&"+
		"txt-observacion="+$("#txt-observacion").val()+"&"+
		"slc-adultos="+$("#slc-adultos").val()+"&"+
		"slc-ninos="+$("#slc-ninos").val();

		//var parametros2 = 

	$.ajax({
		url: "../ajax/get-info-reservacion.php?accion=registrar-reservacion",
		method: "POST",
		data: parametros,
		success:function(resultado){
			//alert(resultado);
			$("#div-resultado-mensaje").html(resultado);
			$("#div-resultado").show();
		},
		error:function(){
			alert("error");
		}
	});
}

// -- Función que Selecciona la Informacion de un Cliente
function obtenerDetalleCliente(correo){
	//alert("Entra en la funcion " + correo);

	$.ajax({
		url: "../ajax/get-info-reservacion.php?accion=obtener-detalle-cliente",
		data: "correoCliente=" + correo,
		method: "POST",
		dataType: "json",
		success: function(respuesta){
			console.log(respuesta);

			if(respuesta.mensaje == "No Existe Registro"){
				$("#txt-respuesta").html(respuesta.mensaje);
				$("#box-respuesta").show();

				$("#box-primer-nombre").hide();
				$("#box-primer-apellido").hide();
			} else {

				//console.log(respuesta);
				$("#txt-idcliente").val(respuesta.idCliente);

				//document.getElementById('txt-idcliente').value=respuesta.idCliente;
				
				$("#txt-primer-nombre").val(respuesta.primerNombre);
				$("#box-primer-nombre").show();
				
				$("#txt-segundo-nombre").html(respuesta.segundoNombre);
				
				$("#txt-primer-apellido").val(respuesta.primerApellido);
				$("#box-primer-apellido").show();
				
				$("#txt-segundo-apellido").html(respuesta.segundoApellido);
				$("#txt-email").html(respuesta.email);
				$("#txt-telefono").html(respuesta.numeroTelefono);
				$("#txt-fecha-nacimiento").html(respuesta.fechaNacimiento);

				$("#box-respuesta").hide();
			}

			// Falta Implementar:
			//$("#btn-guardar").hide();
			//$("#btn-actualizar").show();
		},
		error: function(err){
			alert("Error: " + err);
			console.log(err);
		}
	});
}


// Gestiona el div que muestra mensajes o errores
$("#btn-cerrar-mensaje").click(function(){
	$("#div-resultado-mensaje").empty();
	$("#div-resultado").hide();
});

/*
$('#slc-categoria').change(function() {
    var id = $(this).val() +"&"+
    ; //get the current value's option
    
    $.ajax({
    	  url: "../ajax/get-info-reservacion.php?accion=obtener-categorias",
        type: 'POST',
        data: {'id': id},
        success: function(data){
           $("#txt-precio").html(data);
        },
        error:function(err){
					alert("Error: " + err);
				}
    });
});
*/
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
		
	cargarLista();

	//alert("Se termino de cargar");
});
/* --- Fin --- */

/* -- Función Cargar Lista -- */
function cargarLista(){
	
	//alert("Entra en la funcion");
	
}

function cambiosPrecio(){
	
  var parametros = "slc-categoria=" + $("#slc-categoria").val() +"&"+
  "slc-tipo=" + $("#slc-tipo").val();
	
	if( $("#slc-categoria").val() && $("#slc-tipo").val() ){
	   //alert("IF");
	   $.ajax({
  	  url: "../ajax/get-info-reservacion.php?accion=obtener-precio",
      method: "POST",
      data: parametros,
      success: function(resultado){
         $("#slc-precio").html(resultado);
         //$("#div-resultado-mensaje").html(resultado);
         //$("#div-resultado").show();
         //alert("Success");
      },
      error:function(err){
				alert("Error: " + err);
			}
    });
	}    
}

// Cada que este select cambie, ocurrira un update en el alert
$('#slc-categoria').change(function() {
	cambiosPrecio();
});

$('#slc-tipo').change(function() {
	cambiosPrecio();
});

function registrarCliente(){
	// encodeURIComponent() function encodes special characters. In addition, it encodes the 
	// following characters: , / ? : @ & = + $ #
	// Es decir, si el Numero de Telefono inicia con un signo "+" este se reemplaza con "%2B"
	// para que pueda ser enviado

	var uri = $("#txt-telefono").val();
	var resultadoTel = encodeURIComponent(uri);

	var parametros = "idCliente=" + idCliente +"&"+
			"txt-idcliente="+$("#txt-idcliente").val()+"&"+
			
			"txt-primer-nombre="+$("#txt-primer-nombre").val()+"&"+
			"txt-segundo-nombre="+$("#txt-segundo-nombre").val()+"&"+
			"txt-primer-apellido="+$("#txt-primer-apellido").val()+"&"+
			"txt-segundo-apellido="+$("#txt-segundo-apellido").val()+"&"+
			"txt-email="+$("#txt-email").val()+"&"+
			//"txt-telefono="+$("#txt-telefono").val()+"&"+
			"txt-telefono="+ resultadoTel +"&"+
			"txt-fecha-nacimiento="+$("#txt-fecha-nacimiento").val()+"&"+
			"slc-estado="+$("#slc-estado").val()+"&"+
			"txt-direccion="+$("#txt-direccion").val();

	//alert(parametros);

		$.ajax({
		url: "../ajax/gestion-info-tablero.php?accion=",
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

function registrarReservacion(){
	
	$.ajax({
		url: "../ajax/gestion-info-tablero.php?accion=",
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


$("#btn-cerrar-mensaje").click(function(){
	$("#div-resultado-mensaje").empty();
	$("#div-resultado").hide();
});

/*$('#slc-categoria').change(function() {
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
});*/
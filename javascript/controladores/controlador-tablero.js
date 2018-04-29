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

	cargarLista();

	//alert("Se termino de cargar");
});
/* --- Fin --- */

/* -- Función Cargar Lista -- */
function cargarLista(){
	
	//alert("Entra en la funcion");
	
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
	
	if ($("#slc-categoria").val() && $("#slc-tipo").val()){
	   //alert("IF");
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
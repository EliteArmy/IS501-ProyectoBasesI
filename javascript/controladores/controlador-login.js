$(document).ready(function () {
	
	$("#btn-iniciar").click(function () {
		
		var parametros = "email=" + $("#txt-correo").val() + 
						"&password=" + $("#txt-contrasena").val();
		 alert(parametros);
		
		$.ajax({
				url:"../ajax/gestion-login.php?accion=login",
				method: "POST",
				data: parametros,
				dataType: 'json',
				success: function(respuesta){
					
					if (respuesta.status == 1) {

						//alert("Opcion1");
						window.location = "../02. admin/administracionTablero.php";

					} else if (respuesta.status == 2){
						//alert("Opcion2");
						window.location = "../06. cliente/cuentaCliente.php";

					} else {
						
						$("#div-error-login").show();
					}

				},
				error: function(){

			}
		});

	});
	
});
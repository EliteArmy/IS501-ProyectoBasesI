<!DOCTYPE html>
<html lang="en">
  
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="Coffee Icon" href="../img/ico.ico">
		
		<title>Registrarse en [PlaceHolder]</title>
    
    <!-- CSS -->
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    
    <link rel="stylesheet" href="../fontawesome-5.0.9/web-fonts/css/fontawesome-all.min.css">
		<link rel="stylesheet" href="../css/ariel-custom.css">
 
    <!-- Custom styles for Navbar -->
    <!--<link href="navbar-top.css" rel="stylesheet">-->

  </head>

  <body>

  	<nav class="navbar navbar-expand-md navbar-light bg-light mb-4">
      <a class="navbar-brand" href="#">[Placeholder]</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#">Disabled</a>
          </li>
        </ul>
        
        <form class="form-inline mt-2 mt-md-0">
          <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>

      </div>
    </nav>

		<div class="envoltorio-total">

			<div class="container-fluid">
	      <div class="row justify-content-md-center">
		  		<div class="col-xs-12 col-sm-12 col-md-10 col-lg-8">

			  			<div class="text-left parrafo-con-margin">
			  				<h3>
					  			<strong>Crea una cuenta para tener más opciones en [Placeholder]. ¡Es gratis!</strong>
					  		</h3>
			  			</div>

			  			<div class="container-fluid">
	          		<div class="row">

							  	<div class="envoltura-caja-registro col-xs-12 col-sm-12 col-md-6 col-lg-6">
							  		<div class="caja-registro">

							  			<h2 class="titulo-caja-registro">
												Regístrate con una red social
											</h2>
											<form method="POST">
												<table class="tamanio-botones-sociales">

													<tr>
														<td>
															<button id="" class="btn boton-color-azul envoltura-botones-sociales " type="button" value="">
																<span class="boton-letras-interior">
																	Registrate con Facebook
																</span>
															</button>
														</td>
													</tr>

													<tr>
														<td>
															<button id="" class="btn boton-color-rojo envoltura-botones-sociales" type="button" value="">
																<span class="boton-letras-interior">
																	Registrate con Google+
																</span>
															</button>
														</td>
													</tr>

												</table>

											</form>
											<p class="text-left">
												* No publicaremos nada en tu Facebook o Google+ sin consultarte primero.
											</p>
										</div>
									</div>

									<div class="envoltura-caja-registro col-xs-12 col-sm-12 col-md-6 col-lg-6">
										<div class="caja-registro">
											<h2 class="titulo-caja-registro">
												Regístrate con tu e-mail
											</h2>

									  	<form method="POST">
									  		<table class="table table-hover tamanio-botones-sociales">

									  			<tr>
									  				<td colspan="2" class="subtitulos-caja-registro">
									  					<b>Correo Electronico:</b>
									  				</td>
									  			</tr>

									  			<tr>
										  			<td colspan="2" id="div-correo" class="">
										  				<input id="txt-correo" name="txt-correo" class="form-control" type="email" minlength="5"  placeholder="Ingrese su correo electronico" required><label class="letras-rojas" id="txt-correo-error"></label>
										  			</td>
									  			</tr>

									  			<tr>
									  				<td colspan="2" class="subtitulos-caja-registro">
									  					<b>Contraseña:</b>
									  				</td>
									  			</tr>
									  			<!--
								  				<tr>
							        			<td colspan="2">
							        				<input class="form-control" type="password" name="validar-contrasena"
							        			id="validar-contrasena">
							        			</td>
							      			</tr>
							      			<tr>
							      				<td colspan="2" class="subtitulos-caja-registro">
							      					<b>Validar Contraseña:</b>
							      				</td>
							      			</tr>
													-->
							      			<tr>
							        			<td>
							        				<input id="txt-contrasena" name="txt-contrasena"  class="form-control" type="password" placeholder="Ingrese su contraseña" minlength="6" maxlength="20" required><label class="letras-rojas" id="txt-contrasena-error"></label>
							        			</td>
							      			</tr>

									      	<tr>
									      		<td colspan="2">
									      			<!-- Value="1" indica usuario normal -->
									      			<button id="btn-registrar-usuario" class="btn boton-color-azul" value="1" type="button">
									      				<span class="boton-letras-interior-dos">
																	Registrarse
																</span>
									      			</button>

									      			<button class="btn boton-color-rojo" type="reset" value="">
									      				<span class="boton-letras-interior-dos">
																	Reestablecer
																</span>
									      			</button>

									      		</td>
									      	</tr>

									      	<tr>
							        			<td>
							        				<div id="error" class="letras-rojas" id="txt-contrasena-error"></div>
							        			</td>
							      			</tr>

									  		</table>
									  	</form>
										</div>
									</div>

								</div>
							</div>

							<div class="text-left parrafo-con-margin">
								<p >
									¿Ya tienes cuenta? <a href="login.html">Inicia sesión </a>
								</p>

									<p class="barrita-top">	Al hacer clic en «Registrarse», estás aceptando <a href="#">los términos y condiciones</a> y la <a href="#">política de privacidad </a>  de [Placeholder].
								</p>
							</div>

							<div class="envoltura-caja-registro">
							  <div class="caja-registro">
							  	<p class="parrafo-footer2 text-left">¿Es usted un administrador y desea iniciar sesión?
								  	<a href="#">Inicie sesión </a>
							  	</p>
							  </div>
							</div>

						</div>

				</div>
			</div>
		</div>

	  <!-- ========================================================== -->
	  <!-- jQuery Primero -->
	  <script src="../javascript/jquery-3.3.1.min.js"></script>

	  <!-- Bootstrap Core JavaScript -->
	  <script src="../javascript/bootstrap.min.js"></script>

	  <!-- Custom JavaScript -->
	  <script src="../javascript/usuario/controlador-usuario.js"></script>
	  <!--<script src="../..js/funcionalidades.js"></script>-->

  </body>

</html>

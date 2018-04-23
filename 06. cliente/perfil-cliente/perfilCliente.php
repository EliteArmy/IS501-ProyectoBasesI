<?php
  session_start();
  // Si no se ha declarado esta variable es porque no se ha iniciado sesion.
  if (!isset($_SESSION["permiso"])){ 
    header("Location: ../../01. login_signup/login.html");
    // Si se inicio pero el permiso no es correcto. 
  } else if (!($_SESSION["permiso"] == "cliente"))
    header("Location: ../../01. login_signup/login.html");
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="">

    <title>Perfil Cliente</title>

    <!-- Bootstrap core CSS -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="form-validation.css" rel="stylesheet">
  </head>

  <body class="bg-light">

    <div class="container">
      <div class="py-5 text-center">
        <img class="d-block mx-auto mb-4" src="../../img/perfil.jpg" alt="" width="72" height="72">
        <h2>Perfil de 
          <?php
            echo $_SESSION["primerNombre"] . " ";
            echo $_SESSION["primerApellido"];
            ?>
        </h2>
      </div>

        <div class="order-md-1">
          <h4 class="mb-3">Configuración de información</h4>
          <form class="needs-validation" novalidate>
            <div class="row">
              <div style="display: none" class="form-group">
                <label for="idcliente">Id</label>
                <input type="text" class="form-control" id="idcliente">
              </div>
              <div class="col-md-6 mb-3">
                <label for="primerNombre">Primer Nombre</label>
                <input type="text" class="form-control" id="primerNombre" placeholder="Ingrese su primer nombre" value=""  required>
                <div class="invalid-feedback">
                  Se requiere un dato válido.
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="segundoNombre">Segundo Nombre</label>
                <input type="text" class="form-control" id="segundoNombre" placeholder="Ingrese su segundo nombre" value="" required>
                <div class="invalid-feedback">
                  Se requiere un dato válido.
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="primerApellido">Primer Apellido</label>
                <input type="text" class="form-control" id="primerApellido" placeholder="Ingrese su primer apellido" value=""  required>
                <div class="invalid-feedback">
                  Se requiere un dato válido.
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="segundoApellido">Segundo Apellido</label>
                <input type="text" class="form-control" id="segundoApellido" placeholder="Ingrese su segundo apellido" value="" required>
                <div class="invalid-feedback">
                  Se requiere un dato válido.
                </div>
              </div>
            </div>

            <div class="mb-3">
              <label for="email">Email</label>
                <input type="text" class="form-control" id="email" placeholder="Ingrese su correo eléctronico" required>
                <div class="invalid-feedback" style="width: 100%;">
                  Se requiere un dato válido.
                </div>
            </div>

            <div class="mb-3">
              <label for="email">Fecha de Nacimiento</label>
              <input type="date" class="form-control" id="fechaNacimiento" placeholder="">
              <div class="invalid-feedback">
                Se requiere un dato válido.
              </div>
            </div>

            <div class="mb-3">
              <label for="address">Fecha de Registro</label>
              <input type="date" class="form-control" id="fechaRegistro" placeholder="" required>
              <div class="invalid-feedback">
                Se requiere un dato válido.
              </div>
            </div>

            <div class="mb-3">
              <label for="address2">Estado</label>
              <select id="slc-estado" class="form-control">
                <option>--Seleccione un Estado--</option>
                <option value="1">Activo</option>
                <option value="2">Inactivo</option>
              </select>
            </div>

              <div class="mb-3">
                <label for="country">Direccón</label>
                <input type="address" class="form-control" id="direccion" placeholder="Ingrese su dirección" required>
                <div class="invalid-feedback">
                  Se requiere un dato válido.
                </div>
              </div>

            
            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit"onclick="actualizarCliente(document.getElementById('idcliente').value)">Guardar</button>
          </form>
        </div>
      </div>

      <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy; 2017-2018 Company Name</p>
        <ul class="list-inline">
          <li class="list-inline-item"><a href="#">Privacy</a></li>
          <li class="list-inline-item"><a href="#">Terms</a></li>
          <li class="list-inline-item"><a href="#">Support</a></li>
        </ul>
      </footer>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>

     <script src="../javascript/controladores/controlador-cliente.js"></script>
    <script>
      // Example starter JavaScript for disabling form submissions if there are invalid fields
      (function() {
        'use strict';

        window.addEventListener('load', function() {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName('needs-validation');

          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();
    </script>
  </body>
</html>

<?php
  session_start();
  // Si no se ha declarado esta variable es porque no se ha iniciado sesion.
  if (!isset($_SESSION["permiso"])){ 
    header("Location: ../01. login_signup/login.html");
    // Si se inicio pero el permiso no es correcto. 
  } else if (!($_SESSION["permiso"] == "trabajador"))
    header("Location: ../01. login_signup/login.html");
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../img/favicon.ico">

    <title>Tablero para Administradores</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="../fontawesome-5.0.9/web-fonts/css/fontawesome-all.min.css">

    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">

  </head>

  <body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">[Nombre del Hotel]</a>
      <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">

      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="#">Bienvenido
            <?php
            echo $_SESSION["primerNombre"] . " ";
            echo $_SESSION["primerApellido"] . ".";
            ?>
          </a>
        </li>
      </ul>

      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="../01. login_signup/login.html">Sign out</a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            
            <ul class="nav flex-column">
              
              <li class="nav-item">
                <a class="nav-link" href="administracionTablero.php">
                  <!--<span data-feather="home"></span>-->
                  <i class="far fa-clipboard"></i>
                  Tablero 
                </a>
              </li>
              
              <li class="nav-item">
                <a class="nav-link" href="administracionSucursales.php">
                  <!--<span data-feather="file"></span>-->
                  <i class="far fa-building"></i>
                  Sucursales
                </a>
              </li>
              
              <li class="nav-item">
                <a class="nav-link" href="administracionEmpleados.php">
                  <!--<span data-feather="shopping-cart"></span>-->
                  <i class="far fa-user"></i>
                  Empleados
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="administracionClientes.php">
                  <!--<span data-feather="users"></span>-->
                  <i class="far fa-user-circle"></i>
                  Clientes
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="administracionFacturas.php">
                  <!--<span data-feather="bar-chart-2"></span>-->
                  <i class="far fa-money-bill-alt"></i>
                  Facturas
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="administracionHabitaciones.php">
                  <!--<span data-feather="layers"></span>-->
                  <i class="fas fa-bed"></i>
                  Habitaciones <span class="sr-only">(current)</span>
                </a>
              </li>
            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Reportes</span>
              <a class="d-flex align-items-center text-muted" href="#">
                <span data-feather="plus-circle"></span>
              </a>
            </h6>

            <ul class="nav flex-column mb-2">
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="file-text"></span>
                  Mes
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="file-text"></span>
                  Último Periodo
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="file-text"></span>
                  Year-end sale
                </a>
              </li>
            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Tablero</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
                <button class="btn btn-sm btn-outline-secondary">
                  <a href="../07. archivos/Manual de Usuario.docx">Descargar Manual</a>
                </button>
                <button class="btn btn-sm btn-outline-secondary">Opción</button>
              </div>
              
              <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar"></span>
                Esta Semana
              </button>
            </div>
          </div>

          <!--<canvas class="my-4" id="myChart" width="900" height="380"></canvas>-->

          <!--para registrar una habitación-->
          <div id="div-resultado" style="display: none;" class="alert alert-success fade show alert-dismissible " role="alert">
            <div id="div-resultado-mensaje">
            </div>
            <button type="button" class="btn btn-default btn-sm close" aria-label="Close">
              <span id="btn-cerrar-mensaje" class="fas fa-times" aria-hidden="true"></span>
            </button>
          </div>

            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalRegistroHabitacion">Registrar habitación  
            </button>

          <h2>Lista de Habitaciones</h2>
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              
              <thead>
                <tr>
                  <th>IdHabitacion</th>
                  <th>Numero Habitacion</th>
                  <th>Numero Piso</th>
                  <th>Estado</th>
                  <th>Descripcion</th>
                  <th>Tipo Categoria</th>
                  <th>Tipo Habitación</th>
                  <th>Opciones</th>
                </tr>
              </thead>

              <tbody id="div-informacion">
                <!--
                <tr>
                  <td>1,001</td>
                  <td>Lorem</td>
                  <td>ipsum</td>
                  <td>dolor</td>
                  <td>sit</td>
                  <td>Lorem</td>
                  <td>ipsum</td>
                </tr>
                <tr>
                  <td>1,002</td>
                  <td>amet</td>
                  <td>consectetur</td>
                  <td>adipiscing</td>
                  <td>elit</td>
                  <td>adipiscing</td>
                  <td>adipiscing</td>
                </tr>
                <tr>
                  <td>1,003</td>
                  <td>Integer</td>
                  <td>nec</td>
                  <td>odio</td>
                  <td>Praesent</td>
                  <td>Lorem</td>
                  <td>ipsum</td>
                </tr>
                -->
              </tbody>

            </table>

          </div>

          <!-- Modal para Registrar Habitación -->
          <div class="modal fade" id="modalRegistroHabitacion" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
                  
                <!-- Modal Header -->
                <div class="modal-header">
                  <h5 class="modal-title" id="myModalLabel">
                  Información sobre la Habitación</h5>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                  <form role="form">


                    <div class="form-group">
                      <label for="txtreg-numero-hab">Número de habitación</label>
                      <input type="number" class="form-control" id="txtreg-numero-hab" placeholder="Ingrese el Número de habitación">
                    </div>

                    <div class="form-group">
                      <label for="txtreg-numero-piso">Número de piso</label>
                      <input type="number" class="form-control" id="txtreg-numero-piso" placeholder="Ingrese el Número de piso">
                    </div>
                    
                     <div class="form-group">
                      <label for="txtreg-estado">Estado</label>
                      <input type="text" class="form-control" id="txtreg-estado" placeholder="Ingrese el estado">
                    </div>

                    <div class="form-group">
                      <label for="txtreg-descripcion">Descripción</label>
                      <textarea class="form-control" id="txtreg-descripcion" placeholder="Ingrese la descripción"></textarea>
                    </div>                  
                    
                    <div class="form-group">
                      <label for="slcreg-tipoCategoria">Tipo de Categoría</label>
                      <select id="slcreg-tipoCategoria" class="form-control">
                          <!--Informacion generada por la Base -->
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="slcreg-tipoHabitacion">Tipo de Habitación</label>
                      <select id="slcreg-tipoHabitacion" class="form-control">
                          <!--Informacion generada por la Base -->
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="slcreg-sucursal">Sucursal</label>
                      <select id="slcreg-sucursal" class="form-control">
                          <!--Informacion generada por la Base -->
                      </select>
                    </div>

                    <button type="button" class="btn btn-primary submitBtn" onclick="registrarHabitacion()">Guardar</button>

                    <button type="reset" value="Reset" class="btn btn-warning">Limpiar Formulario</button>
                    
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

                  </form>
                </div>
                
                <!-- Modal Footer -->
                <div class="modal-footer">
                  
                </div>

              </div>
            </div>
          </div>

          <!-- Modal para actualizar habitación -->
          <div class="modal fade" id="modalForm" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
                  
                <!-- Modal Header -->
                <div class="modal-header">
                  <h5 class="modal-title" id="myModalLabel">
                  Información sobre la Habitación</h5>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                  <form role="form">
                    
                    <div style="display: none" class="form-group">
                      <label for="txt-idHabitacion">Id</label>
                      <input type="text" class="form-control" id="txt-idHabitacion">
                    </div>

                    <div class="form-group">
                      <label for="txt-numero-hab">Número de habitación</label>
                      <input type="number" class="form-control" id="txt-numero-hab" placeholder="Ingrese el Número de habitación">
                    </div>

                    <div class="form-group">
                      <label for="txt-numero-piso">Número de piso</label>
                      <input type="number" class="form-control" id="txt-numero-piso" placeholder="Ingrese el Número de piso">
                    </div>
                    
                     <div class="form-group">
                      <label for="txt-estado">Estado</label>
                      <input type="text" class="form-control" id="txt-estado" placeholder="Ingrese el estado">
                    </div>

                    <div class="form-group">
                      <label for="txt-descripcion">Descripción</label>
                      <textarea class="form-control" id="txt-descripcion" placeholder="Ingrese la descripción"></textarea>
                    </div>                  
                    
                    <div class="form-group">
                      <label for="slc-tipoCategoria">ID del Tipo de Categoría</label>
                      <input type="number" class="form-control" id="slc-tipoCategoria" placeholder="Ingrese el Id del Tipo de Categoría">
                          <!--Informacion generada por la Base -->
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="slc-tipoHabitacion">ID del Tipo de Habitación</label>
                      <input type="number" class="form-control" id="slc-tipoHabitacion" placeholder="Ingrese el Id del Tipo de Habitación">
                          <!--Informacion generada por la Base -->
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="slc-sucursal">ID de la Sucursal</label>
                      <input type="number" class="form-control" id="slc-sucursal" placeholder="Ingrese el Id de la Sucursal">
                    </div>


                    <button type="button" class="btn btn-primary submitBtn" onclick="actualizarHabitacion(document.getElementById('txt-idHabitacion').value)">Actualizar</button>

                    <button type="reset" value="Reset" class="btn btn-warning">Limpiar Formulario</button>
                    
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

                  </form>
                </div>
                
                <!-- Modal Footer -->
                <div class="modal-footer">
                  
                </div>

              </div>
            </div>
          </div>

        </main>
      </div>
    </div>

    <!-- ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    
    <script src="../assets/js/vendor/popper.min.js"></script>
    
    <!-- JQuery core Javascript -->
    <script src="../javascript/jquery-3.3.1.min.js"></script>

    <!-- Bootstrap core JavaScript -->
    <script src="../javascript/bootstrap.min.js"></script>
    
    <!-- DataTables core Javascript -->
    <script src="../javascript/datatables.js"></script>
    
    <!-- DataTables Style Javascript -->
    <script src="../javascript/dataTables.bootstrap4.js"></script> 
    

    <!-- Custom Javascript -->
    <script src="../javascript/controladores/controlador-habitacion.js"></script>

  </body>
</html>

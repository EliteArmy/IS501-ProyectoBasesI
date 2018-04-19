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
                <a class="nav-link active" active href="administracionEmpleados.php">
                  <!--<span data-feather="shopping-cart"></span>-->
                  <i class="far fa-user"></i>
                  Empleados <span class="sr-only">(current)</span>
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
                <a class="nav-link" href="administracionHabitaciones.php">
                  <!--<span data-feather="layers"></span>-->
                  <i class="fas fa-bed"></i>
                  Habitaciones
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
                <button class="btn btn-sm btn-outline-secondary">Compartir</button>
                <button class="btn btn-sm btn-outline-secondary">Exportar</button>
              </div>
              <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar"></span>
                Esta Semana
              </button>
            </div>
          </div>

          <!--<canvas class="my-4" id="myChart" width="900" height="380"></canvas>-->
          <h2>Lista de Empleados</h2>
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Nombre</th>
                  <th>Apellido</th>
                  <th>Email</th>
                  <th>Fecha Nac.</th>
                  <th>Fecha Ing.</th>
                  <th>Estado</th>
                  <th>Direccion</th>
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
                <tr>
                  <td>1,003</td>
                  <td>libero</td>
                  <td>Lorem</td>
                  <td>ipsum</td>
                  <td>Sed</td>
                  <td>cursus</td>
                  <td>ante</td>
                </tr>
                <tr>
                  <td>1,004</td>
                  <td>dapibus</td>
                  <td>diam</td>
                  <td>Sed</td>
                  <td>Lorem</td>
                  <td>ipsum</td>
                  <td>nisi</td>
                </tr>
                <tr>
                  <td>1,005</td>
                  <td>Nulla</td>
                  <td>quis</td>
                  <td>Lorem</td>
                  <td>ipsum</td>
                  <td>sem</td>
                  <td>at</td>
                </tr>
                -->
              </tbody>

            </table>

          </div>

          <!-- Modal -->
          <div class="modal fade" id="modalForm" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
                
                <!-- Modal Header -->
                <div class="modal-header">
                  <h5 class="modal-title" id="myModalLabel">
                  Información sobre el Empleado</h5>
                </div>
              
                <!-- Modal Body -->
                <div class="modal-body">
                  <form role="form">

                    <div class="form-group">
                      <label for="txt-idcliente">Id</label>
                      <input type="hidden" class="form-control" id="txt-idempleado">
                    </div>

                    <div class="form-group">
                      <label for="txt-primer-nombre">Primer Nombre</label>
                      <input type="text" class="form-control" id="txt-primer-nombre" placeholder="Ingrese el Primer Nombre">
                    </div>

                    <div class="form-group">
                      <label for="txt-segundo-nombre">Segundo Nombre</label>
                      <input type="text" class="form-control" id="txt-segundo-nombre" placeholder="Ingrese el Segundo Nombre">
                    </div>
                    
                    <div class="form-group">
                      <label for="txt-primer-apellido">Primer Apellido</label>
                      <input type="text" class="form-control" id="txt-primer-apellido" placeholder="Ingrese el Primer Apellido">
                    </div>

                    <div class="form-group">
                      <label for="txt-segundo-apellido">Segundo Apellido</label>
                      <input type="text" class="form-control" id="txt-segundo-apellido" placeholder="Ingrese el Segundo Apellido">
                    </div>
                    
                    <div class="form-group">
                      <label for="txt-email">Email</label>
                      <input type="email" class="form-control" id="txt-email" placeholder="Ingrese el correo electrónico">
                    </div>

                    <div class="form-group">
                      <label for="txt-telefono">Telefono</label>
                      <input type="text" class="form-control" id="txt-telefono" placeholder="Ingrese el Telefono">
                    </div>
                    
                    <div class="form-group">
                      <label for="txt-fecha-nacimiento">Fecha Nacimiento</label>
                      <input type="date" class="form-control" id="txt-fecha-nacimiento">
                    </div>

                    <div class="form-group">
                      <label for="slc-estado">Estado</label>
                        <select name="slc-estado" id="slc-estado" class="form-control">
                        <option>---Seleccione un Estado---</option>
                        <option value="1">Activo</option>
                        <option value="2">Inactivo</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="txt-direccion">Dirección</label>
                      <textarea class="form-control" id="txt-direccion" placeholder="Ingrese la dirección"></textarea>
                    </div>

                  </form>
                </div>
              
                <!-- Modal Footer -->
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                  <button type="button" class="btn btn-primary submitBtn" onclick="submitContactForm()">Guardar</button>
                </div>

              </div>
            </div>
          </div>

        </main>
      </div>
    </div>

    <!-- ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    
    <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    
    <script src="../assets/js/vendor/popper.min.js"></script>
    
    <!-- JQuery core Javascript -->
    <script src="../javascript/jquery-3.3.1.min.js"></script>

    <!-- Bootstrap core JavaScript -->
    <script src="../javascript/bootstrap.min.js"></script>

    <!-- Custom Javascript -->
    <script src="../javascript/controladores/controlador-empleado.js"></script>

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    
    <script>
      feather.replace()
    </script>

  </body>
</html>

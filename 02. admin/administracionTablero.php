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
    <link href="../css/factura-custom.css" rel="stylesheet">

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
          <a class="nav-link" href="../01. login_signup/login.html">Bienvenido!<span id='lbl-usuario'></span></a>
        </li>
      </ul>

      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="cerrar_sesion.php">Sign out</a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            
            <ul class="nav flex-column">
              
              <li class="nav-item">
                <a class="nav-link active" href="administracionTablero.php">
                  <!--<span data-feather="home"></span>-->
                  <i class="far fa-clipboard"></i>
                  Tablero <span class="sr-only">(current)</span>
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

        <div id="reporte-error">
          
        </div>

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

          <div id="div-resultado" style="display: none;" class="alert alert-success fade show alert-dismissible " role="alert">
            <div id="div-resultado-mensaje">

            </div>

            <button type="button" class="btn btn-default btn-sm close" aria-label="Close">
              <span id="btn-cerrar-mensaje" class="fas fa-times" aria-hidden="true"></span>
            </button>
          </div>

          <h2>Lista de Información</h2>
          
          <!-- <div class="table-responsive">
            <table class="table table-striped table-sm">
              
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Nombre</th>
                  <th>FechaIngreso</th>
                  <th>FechaSalida</th>
                  <th>Estado</th>
                  <th>Sucursal</th>
                  <th>Superior</th>
                </tr>
              </thead>

              <tbody id="div-informacion">
                <!- -
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
                - ->
              </tbody>

            </table> 

          </div> -->

          <div>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalReservacion">Registrar Una Reservacion  
            </button>
          </div>

          <!-- Modal de Reservación -->
          <div class="modal fade" id="modalReservacion" role="dialog">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                  
                <!-- Modal Header -->
                <div class="modal-header">
                  <h5 class="modal-title" id="myModalLabel">
                  Información sobre Reservación
                  </h5>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                  <form role="form">
                    <div class="form-group">
                      <label for="div-previo-registro"></label>
                      <div id="div-previo-registro" class="alert alert-primary" role="alert">
                        El Cliente debde estar Previamente Registrado.
                      </div>
                    </div>

                    <div style="display: none;" id="box-respuesta" class="form-group">
                      <label for="txt-respuesta">Respuesta: </label>
                      <div class="form-control alert alert-warning" id="txt-respuesta">
                        
                      </div>
                    </div>

                    <div style="display: none;" id="box-idCliente" class="form-group">
                      <label for="txt-idcliente">Id Cliente</label>
                      <input type="text" class="form-control" id="txt-idcliente" placeholder="Ingrese el Primer Nombre">
                    </div>

                    <div style="display: none;" id="box-primer-nombre" class="form-group">
                      <label for="txt-primer-nombre">Primer Nombre</label>
                      <input type="text" class="form-control" id="txt-primer-nombre" placeholder="" disabled>
                    </div>

                    <div style="display: none;" id="box-primer-apellido" class="form-group">
                      <label for="txt-primer-apellido">Primer Apellido</label>
                      <input type="text" class="form-control" id="txt-primer-apellido" placeholder="" disabled>
                    </div>

                    <div class="form-group">
                      <label for="txt-email">Email del Cliente</label>
                      <input type="email" class="form-control" id="txt-email" placeholder="">
                    </div>

                    <button type="button" class="btn btn-primary submitBtn" onclick="obtenerDetalleCliente(document.getElementById('txt-email').value)">Buscar Cliente</button>

                    <br>

                    <div style="display: none;" class="form-group">
                      <label for="txt-fecha-reservacion">Fecha Reservacion</label>
                      <input type="date" class="form-control" id="txt-fecha-reservacion">
                    </div>

                    <div class="form-group">
                      <div style="width: 49%; display: inline-block">
                        <label for="txt-fecha-entrada">Fecha Entrada</label>
                        <input type="date" class="form-control" id="txt-fecha-entrada">
                      </div>
                      
                      <div style="width: 49%; display: inline-block">
                        <label for="txt-fecha-salida">Fecha Salida</label>
                        <input type="date" class="form-control" id="txt-fecha-salida">
                      </div>
                      
                    </div>

                    <div class="form-group">
                      <div style="width: 49%; display: inline-block">
                        <label for="slc-categoria">Tipo Categoria</label>
                        <select id="slc-categoria" class="form-control">
                          <!--Informacion generada por la Base -->
                        </select>
                      </div>

                      <div style="width: 49%; display: inline-block">
                        <label for="slc-tipo">Tipo Habitación</label>
                        <select id="slc-tipo" class="form-control">
                        <!--Informacion generada por la Base -->
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="slc-tipo">Precios Disponibles</label>
                      <div id="" class="alert alert-primary" role="alert">
                        <select id="slc-precio" class="form-control">
                          <!--Informacion generada por la Base -->
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <div style="width: 49%; display: inline-block">
                        <label for="slc-sucursal">Sucursal</label>
                        <select id="slc-sucursal" class="form-control">
                          <!--Informacion generada por la Base -->
                        </select>
                      </div>

                      <div style="width: 49%; display: inline-block">
                        <label for="slc-habitacion">Habitacion</label>
                        <select id="slc-habitacion" class="form-control">
                          <!--Informacion generada por la Base -->
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <div style="width: 49%; display: inline-block">
                        <label for="slc-adultos">Cantidad de Adultos</label>
                        <select id="slc-adultos" class="form-control">
                          <option value="1">Un Adulto</option>
                          <option value="2">Dos Adultos</option>
                          <option value="3">Tres Adultos</option>
                          <option value="4">Cuatro Adultos</option>
                          <option value="5">Cuatro Adultos</option>
                          <option value="6">Cuatro Adultos</option>
                        </select>
                      </div>

                      <div style="width: 49%; display: inline-block;">
                        <label for="slc-ninos">Cantidad de Niños</label>
                        <select id="slc-ninos" class="form-control">
                          <option value="1">Un Niño(a)</option>
                          <option value="2">Dos Niño(a)</option>
                          <option value="3">Tres Niño(a)</option>
                          <option value="4">Cuatro Niño(a)</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <div style="width: 49%; display: inline-block">
                        <label for="slc-supletoria">Cama Supletoria</label>
                      <select id="slc-supletoria" class="form-control">
                        <option value="0">Sin Cama Extra</option>
                        <option value="1">Una Cama Extra</option>
                        <option value="2">Dos Camas Extra</option>
                      </select>
                      </div>

                      <div style="width: 49%; display: inline-block">
                        <label for="slc-estado">Estado</label>
                        <select id="slc-estado" class="form-control">
                        <option value="Activo">Activo</option>
                        <option value="Resevado">Resevado</option>
                      </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="txt-observacion">Observación</label>
                      <textarea class="form-control" id="txt-observacion" placeholder="Ingrese alguna Observación del cliente"></textarea>
                    </div>

                    <div class="form-group">
                      <label for="div-factura"></label>
                      <div id="div-factura" class="alert alert-primary" role="alert">
                        Parte de Facturacion.
                      </div>
                    </div>

                    <div class="form-group">
                      <div style="width: 49%; display: inline-block">
                        <label for="slc-modo-pago">Modo de Pago</label>
                        <select id="slc-modo-pago" class="form-control">
                          <!--Informacion generada por la Base -->
                        </select>
                      </div>

                      <div style="width: 49%; display: inline-block">
                        <label for="slc-tipo-factura">Tipo de Factura</label>
                        <select id="slc-tipo-factura" class="form-control">
                          <!--Informacion generada por la Base -->
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <div style="width: 49%; display: inline-block">
                        <label for="txt-cambio">Cantidad Pagada</label>
                        <input type="text" class="form-control" id="txt-cambio" placeholder="">
                      </div>

                      <div style="width: 49%; display: inline-block">
                        <label for="slc-tipo-factura">Factura</label>
                        <select id="slc-tipo-factura" class="form-control">
                          <!--Informacion generada por la Base -->
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="txt-observacion-factura">Observación</label>
                      <textarea class="form-control" id="txt-observacion-factura" placeholder="Ingrese alguna Observación acerca de la Factura"></textarea>
                    </div>

                    <button type="button" class="btn btn-primary submitBtn" onclick="registrarReservacion()">Reservar</button>

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


          <div id="factura-cliente" style="display: none;" class="container">
            <div class="row">
              <div class="col-md-12">
                <div class="text-center">
                  <i class="fa fa-search-plus pull-left icon"></i>
                  <h2>Factura</h2>
                </div>
                <hr>
              
                <div class="row">
                  <div class="col-xs-12 col-md-3 col-lg-3 pull-left">
                    <div class="panel panel-default height">
                      <div class="panel-heading">Detalles de Fatura</div>
                      <div class="panel-body">
                        <strong>David Peere:</strong><br>
                        1111 Army Navy Drive<br>
                        Arlington<br>
                        VA<br>
                        <strong>22 203</strong><br>
                      </div>
                    </div>
                  </div>
                  
                  <div class="col-xs-12 col-md-3 col-lg-3">
                    <div class="panel panel-default height">
                      <div class="panel-heading">Payment Information</div>
                      <div class="panel-body">
                          <strong>Card Name:</strong> Visa<br>
                          <strong>Card Number:</strong> ***** 332<br>
                          <strong>Exp Date:</strong> 09/2020<br>
                      </div>
                    </div>
                  </div>
                  
                  <div class="col-xs-12 col-md-3 col-lg-3">
                    <div class="panel panel-default height">
                      <div class="panel-heading">Order Preferences</div>
                      <div class="panel-body">
                          <strong>Gift:</strong> No<br>
                          <strong>Express Delivery:</strong> Yes<br>
                          <strong>Insurance:</strong> No<br>
                          <strong>Coupon:</strong> No<br>
                      </div>
                    </div>
                  </div>
                  
                  <div class="col-xs-12 col-md-3 col-lg-3 pull-right">
                    <div class="panel panel-default height">
                      <div class="panel-heading">Shipping Address</div>
                      <div class="panel-body">
                          <strong>David Peere:</strong><br>
                          1111 Army Navy Drive<br>
                          Arlington<br>
                          VA<br>
                          <strong>22 203</strong><br>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
      
            <div class="row">
              <div class="col-md-12">
                <div class="panel panel-default">
                  <div class="panel-heading">
                      <h3 class="text-center"><strong>Order summary</strong></h3>
                  </div>
                  <div class="panel-body">
                    <div class="table-responsive">
                      <table class="table table-condensed">
                        <thead>
                          <tr>
                            <td><strong>Item Name</strong></td>
                            <td class="text-center"><strong>Item Price</strong></td>
                            <td class="text-center"><strong>Item Quantity</strong></td>
                            <td class="text-right"><strong>Total</strong></td>
                          </tr>
                        </thead>
                        
                        <tbody>
                          <tr>
                            <td>Samsung Galaxy S5</td>
                            <td class="text-center">$900</td>
                            <td class="text-center">1</td>
                            <td class="text-right">$900</td>
                          </tr>
                          <tr>
                            <td>Samsung Galaxy S5 Extra Battery</td>
                            <td class="text-center">$30.00</td>
                            <td class="text-center">1</td>
                            <td class="text-right">$30.00</td>
                          </tr>
                          <tr>
                            <td>Screen protector</td>
                            <td class="text-center">$7</td>
                            <td class="text-center">4</td>
                            <td class="text-right">$28</td>
                          </tr>
                          <tr>
                            <td class="highrow"></td>
                            <td class="highrow"></td>
                            <td class="highrow text-center"><strong>Subtotal</strong></td>
                            <td class="highrow text-right">$958.00</td>
                          </tr>
                          <tr>
                            <td class="emptyrow"></td>
                            <td class="emptyrow"></td>
                            <td class="emptyrow text-center"><strong>Shipping</strong></td>
                            <td class="emptyrow text-right">$20</td>
                          </tr>
                          <tr>
                            <td class="emptyrow"><i class="fa fa-barcode iconbig"></i></td>
                            <td class="emptyrow"></td>
                            <td class="emptyrow text-center"><strong>Total</strong></td>
                            <td class="emptyrow text-right">$978.00</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
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

    <!-- Custom Javascript -->
    <script src="../javascript/controladores/controlador-tablero.js"></script>

  </body>
</html>

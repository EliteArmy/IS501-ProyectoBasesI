SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema basedatoshotel
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema basedatoshotel
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS basedatoshotel DEFAULT CHARACTER SET utf8 ;
USE basedatoshotel ;

-- -----------------------------------------------------
-- Table basedatoshotel.Persona
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS basedatoshotel.Persona (
  idPersona INT NOT NULL,
  primerNombre VARCHAR(20) NOT NULL,
  segundoNombre VARCHAR(20) NULL,
  primerApellido VARCHAR(20) NOT NULL,
  segundoApellido VARCHAR(20) NULL,
  email VARCHAR(50) NOT NULL,
  password VARCHAR(45) NOT NULL,
  genero VARCHAR(1) NULL,
  direccion VARCHAR(100) NOT NULL,
  fechaNacimiento DATE NULL,
  imagenIdentificacion VARCHAR(255) NULL,
  PRIMARY KEY (idPersona),
  UNIQUE INDEX email_UNIQUE (email ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table basedatoshotel.Menu
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS basedatoshotel.Menu (
  idMenu INT NOT NULL,
  descripcion VARCHAR(100) NULL,
  PRIMARY KEY (idMenu))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table basedatoshotel.Restaurante
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS basedatoshotel.Restaurante (
  idRestaurante INT NOT NULL,
  horaApertura DATETIME NOT NULL,
  horaCierre DATETIME NOT NULL,
  telefono VARCHAR(15) NOT NULL,
  idMenu INT NOT NULL,
  PRIMARY KEY (idRestaurante),
  INDEX fk_Restaurante_Menu1_idx (idMenu ASC),
  CONSTRAINT fk_Restaurante_Menu1
    FOREIGN KEY (idMenu)
    REFERENCES basedatoshotel.Menu (idMenu)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table basedatoshotel.Hotel
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS basedatoshotel.Hotel (
  idHotel INT NOT NULL,
  descripcion VARCHAR(100) NULL,
  PRIMARY KEY (idHotel))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table basedatoshotel.Sucursal
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS basedatoshotel.Sucursal (
  idSucursal INT NOT NULL,
  nombre VARCHAR(45) NOT NULL,
  cantidadHabitaciones INT NOT NULL COMMENT 'Indica el Numero de Habitaciones del Hotel',
  telefono VARCHAR(15) NOT NULL,
  email VARCHAR(50) NULL COMMENT 'hotel1@gmail.com\nhotel2@gmail.com\nhotel3@gmail.com',
  direccion VARCHAR(100) NOT NULL,
  descripcion VARCHAR(100) NULL,
  idRestaurante INT NOT NULL,
  idHotel INT NOT NULL,
  PRIMARY KEY (idSucursal),
  INDEX fk_Hotel_Restaurante1_idx (idRestaurante ASC),
  UNIQUE INDEX nombre_UNIQUE (nombre ASC),
  INDEX fk_Sucursal_Hotel1_idx (idHotel ASC),
  UNIQUE INDEX telefono_UNIQUE (telefono ASC),
  CONSTRAINT fk_Hotel_Restaurante1
    FOREIGN KEY (idRestaurante)
    REFERENCES basedatoshotel.Restaurante (idRestaurante)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT fk_Sucursal_Hotel1
    FOREIGN KEY (idHotel)
    REFERENCES basedatoshotel.Hotel (idHotel)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table basedatoshotel.Empleado
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS basedatoshotel.Empleado (
  idEmpleado INT NOT NULL,
  codigoEmpleado INT(11) NOT NULL COMMENT 'Numero Unico para identificar a un empleado',
  fechaIngreso DATE NOT NULL COMMENT 'Fecha en la que el empleado Ingreso a la Empresa',
  fechaSalida DATE NULL,
  estado VARCHAR(15) NOT NULL,
  idPersona INT NOT NULL,
  idSucursal INT NOT NULL,
  idEmpleadoSuperior INT NOT NULL,
  PRIMARY KEY (idEmpleado),
  INDEX fk_Estudiante_Persona1_idx (idPersona ASC),
  INDEX fk_Empleado_Sucursal1_idx (idSucursal ASC),
  INDEX fk_Empleado_Empleado1_idx (idEmpleadoSuperior ASC),
  UNIQUE INDEX codigoEmpleado_UNIQUE (codigoEmpleado ASC),
  UNIQUE INDEX idEmpleado_UNIQUE (idEmpleado ASC),
  CONSTRAINT fk_Estudiante_Persona1
    FOREIGN KEY (idPersona)
    REFERENCES basedatoshotel.Persona (idPersona)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT fk_Empleado_Sucursal1
    FOREIGN KEY (idSucursal)
    REFERENCES basedatoshotel.Sucursal (idSucursal)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT fk_Empleado_Empleado1
    FOREIGN KEY (idEmpleadoSuperior)
    REFERENCES basedatoshotel.Empleado (idEmpleado)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table basedatoshotel.Telefono
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS basedatoshotel.Telefono (
  idTelefono INT NOT NULL,
  numeroTelefono VARCHAR(15) NOT NULL,
  idPersona INT NOT NULL,
  PRIMARY KEY (idTelefono),
  INDEX fk_Telefono_Persona_idx (idPersona ASC),
  UNIQUE INDEX numeroTelefono_UNIQUE (numeroTelefono ASC),
  CONSTRAINT fk_Telefono_Persona
    FOREIGN KEY (idPersona)
    REFERENCES basedatoshotel.Persona (idPersona)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table basedatoshotel.Cliente
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS basedatoshotel.Cliente (
  idCliente INT NOT NULL,
  fechaRegistro DATE NOT NULL COMMENT 'Fecha en la que el Cliente creo la cuenta en el Sitio',
  estado VARCHAR(15) NULL,
  idPersona INT NOT NULL,
  PRIMARY KEY (idCliente),
  INDEX fk_Profesor_Persona1_idx (idPersona ASC),
  CONSTRAINT fk_Profesor_Persona1
    FOREIGN KEY (idPersona)
    REFERENCES basedatoshotel.Persona (idPersona)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table basedatoshotel.TipoCategoria
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS basedatoshotel.TipoCategoria (
  idTipoCategoria INT NOT NULL,
  tipoCategoria VARCHAR(30) NOT NULL COMMENT 'Datos a Guardar:\nBasica\nStandard\nPremium\nTerceraEdad\nCoorporativa\n',
  descripcion VARCHAR(100) NULL,
  PRIMARY KEY (idTipoCategoria))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table basedatoshotel.TipoHabitacion
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS basedatoshotel.TipoHabitacion (
  idTipoHabitacion INT NOT NULL,
  tipoHabitacion VARCHAR(30) NOT NULL COMMENT 'Personal\nDoble Cama\nTriple Cama\n',
  descripcion VARCHAR(100) NULL,
  PRIMARY KEY (idTipoHabitacion))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table basedatoshotel.Habitacion
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS basedatoshotel.Habitacion (
  idHabitacion INT NOT NULL,
  numeroHabitacion VARCHAR(5) NOT NULL,
  numeroPiso INT NOT NULL,
  estado VARCHAR(15) NOT NULL COMMENT 'Si esta disponible o no',
  descripcion VARCHAR(100) NULL,
  idTipoCategoria INT NOT NULL,
  idTipoHabitacion INT NOT NULL,
  idSucursal INT NOT NULL,
  PRIMARY KEY (idHabitacion),
  INDEX fk_Habitacion_TipoServicio1_idx (idTipoCategoria ASC),
  INDEX fk_Habitacion_TipoHabitacion1_idx (idTipoHabitacion ASC),
  INDEX fk_Habitacion_Hotel1_idx (idSucursal ASC),
  CONSTRAINT fk_Habitacion_TipoServicio1
    FOREIGN KEY (idTipoCategoria)
    REFERENCES basedatoshotel.TipoCategoria (idTipoCategoria)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT fk_Habitacion_TipoHabitacion1
    FOREIGN KEY (idTipoHabitacion)
    REFERENCES basedatoshotel.TipoHabitacion (idTipoHabitacion)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT fk_Habitacion_Hotel1
    FOREIGN KEY (idSucursal)
    REFERENCES basedatoshotel.Sucursal (idSucursal)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table basedatoshotel.ModoPago
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS basedatoshotel.ModoPago (
  idModoPago INT NOT NULL,
  modoPago VARCHAR(45) NOT NULL COMMENT 'Tarjeta de Credito\nEfectivo\nCheques',
  descripcion VARCHAR(100) NULL,
  PRIMARY KEY (idModoPago),
  UNIQUE INDEX modoPago_UNIQUE (modoPago ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table basedatoshotel.TipoFactura
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS basedatoshotel.TipoFactura (
  idTipoFactura INT NOT NULL,
  nombre VARCHAR(30) NOT NULL COMMENT 'Si es Factura del Hotel o Factura del Restaurante',
  descripcion VARCHAR(100) NULL,
  PRIMARY KEY (idTipoFactura),
  UNIQUE INDEX nombre_UNIQUE (nombre ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table basedatoshotel.Factura
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS basedatoshotel.Factura (
  idFactura INT NOT NULL,
  numFactura VARCHAR(45) NOT NULL,
  fechaEmision DATETIME NOT NULL COMMENT 'Fecha en la que se hizo el cobro al cliente',
  costeReservacion DOUBLE NULL,
  costePedido DOUBLE NULL,
  costeProducto DOUBLE NULL,
  costeTotal DOUBLE NOT NULL,
  cambio DOUBLE NOT NULL,
  observacion VARCHAR(100) NULL,
  idCliente INT NOT NULL,
  idEmpleado INT NOT NULL,
  idTipoFactura INT NOT NULL,
  idModoPago INT NOT NULL,
  PRIMARY KEY (idFactura),
  INDEX fk_Factura_Cliente1_idx (idCliente ASC),
  INDEX fk_Factura_ModoPago1_idx (idModoPago ASC),
  INDEX fk_Factura_Empleado1_idx (idEmpleado ASC),
  INDEX fk_Factura_TipoFactura1_idx (idTipoFactura ASC),
  CONSTRAINT fk_Factura_Cliente1
    FOREIGN KEY (idCliente)
    REFERENCES basedatoshotel.Cliente (idCliente)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT fk_Factura_ModoPago1
    FOREIGN KEY (idModoPago)
    REFERENCES basedatoshotel.ModoPago (idModoPago)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT fk_Factura_Empleado1
    FOREIGN KEY (idEmpleado)
    REFERENCES basedatoshotel.Empleado (idEmpleado)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT fk_Factura_TipoFactura1
    FOREIGN KEY (idTipoFactura)
    REFERENCES basedatoshotel.TipoFactura (idTipoFactura)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table basedatoshotel.Descuento
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS basedatoshotel.Descuento (
  idDescuento INT NOT NULL,
  porcentaje DOUBLE NOT NULL COMMENT 'Porcentajes dependiendo al tipo Empleado',
  estado VARCHAR(15) NOT NULL,
  fechaInicio DATETIME NOT NULL,
  fechaFin DATETIME NULL,
  descripcion VARCHAR(100) NULL COMMENT 'Tercera Edad\nNiños\nDescuento Empleados\n',
  PRIMARY KEY (idDescuento))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table basedatoshotel.Servicio
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS basedatoshotel.Servicio (
  idServicio INT NOT NULL,
  tipoServicio VARCHAR(30) NOT NULL COMMENT 'Piscina\nEstacionamiento\nWifi\nAlberca\nAireAcondicionado\nGimnasio\nBar',
  descripcion VARCHAR(100) NULL,
  PRIMARY KEY (idServicio))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table basedatoshotel.Reservacion
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS basedatoshotel.Reservacion (
  idReservacion INT NOT NULL,
  fechaReservacion DATETIME NOT NULL,
  fechaEntrada DATETIME NOT NULL,
  fechaSalida DATETIME NOT NULL,
  camaSupletoria INT NULL,
  estado VARCHAR(15) NOT NULL,
  observacion VARCHAR(100) NULL COMMENT 'Si el cliente tiene algun pedido al llegar a su habitacion',
  idCliente INT NOT NULL,
  PRIMARY KEY (idReservacion),
  INDEX fk_Reservacion_Cliente1_idx (idCliente ASC),
  CONSTRAINT fk_Reservacion_Cliente1
    FOREIGN KEY (idCliente)
    REFERENCES basedatoshotel.Cliente (idCliente)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table basedatoshotel.Habitacion_Reservacion
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS basedatoshotel.Habitacion_Reservacion (
  idHabitacion INT NOT NULL COMMENT 'Una Habitacion se puede Reservar muchas veces',
  idReservacion INT NOT NULL COMMENT 'Una Reservacion se puede hacer para muchas habitaciones',
  INDEX fk_Habitacion_has_Reservacion_Reservacion1_idx (idReservacion ASC),
  INDEX fk_Habitacion_has_Reservacion_Habitacion1_idx (idHabitacion ASC),
  PRIMARY KEY (idReservacion, idHabitacion),
  CONSTRAINT fk_Habitacion_has_Reservacion_Habitacion1
    FOREIGN KEY (idHabitacion)
    REFERENCES basedatoshotel.Habitacion (idHabitacion)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT fk_Habitacion_has_Reservacion_Reservacion1
    FOREIGN KEY (idReservacion)
    REFERENCES basedatoshotel.Reservacion (idReservacion)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table basedatoshotel.CategoriaProducto
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS basedatoshotel.CategoriaProducto (
  idCategoriaProducto INT NOT NULL,
  nombre VARCHAR(45) NOT NULL,
  descripcion VARCHAR(100) NULL,
  PRIMARY KEY (idCategoriaProducto),
  UNIQUE INDEX nombre_UNIQUE (nombre ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table basedatoshotel.Bodega
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS basedatoshotel.Bodega (
  idBodega INT NOT NULL,
  nombre VARCHAR(50) NOT NULL,
  ubicacion VARCHAR(45) NOT NULL,
  descripcion VARCHAR(100) NULL,
  idSucursal INT NOT NULL,
  PRIMARY KEY (idBodega),
  INDEX fk_Bodega_Hotel1_idx (idSucursal ASC),
  CONSTRAINT fk_Bodega_Hotel1
    FOREIGN KEY (idSucursal)
    REFERENCES basedatoshotel.Sucursal (idSucursal)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table basedatoshotel.Producto
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS basedatoshotel.Producto (
  idProducto INT NOT NULL,
  nombre VARCHAR(45) NOT NULL,
  codigoBarra VARCHAR(100) NOT NULL,
  precioCompra DOUBLE NOT NULL,
  precioVenta DOUBLE NOT NULL,
  fechaIngreso DATETIME NOT NULL,
  fechaVencimiento DATETIME NOT NULL,
  existencia INT NOT NULL,
  marca VARCHAR(30) NULL,
  descripcion VARCHAR(100) NULL,
  idCategoriaProducto INT NOT NULL,
  idBodega INT NOT NULL,
  PRIMARY KEY (idProducto),
  INDEX fk_producto_CategoriaProducto1_idx (idCategoriaProducto ASC),
  INDEX fk_Producto_Bodega1_idx (idBodega ASC),
  UNIQUE INDEX codigoBarra_UNIQUE (codigoBarra ASC),
  CONSTRAINT fk_producto_CategoriaProducto1
    FOREIGN KEY (idCategoriaProducto)
    REFERENCES basedatoshotel.CategoriaProducto (idCategoriaProducto)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT fk_Producto_Bodega1
    FOREIGN KEY (idBodega)
    REFERENCES basedatoshotel.Bodega (idBodega)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table basedatoshotel.Proveedor
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS basedatoshotel.Proveedor (
  idProveedor INT NOT NULL,
  nombre VARCHAR(30) NOT NULL,
  telefono VARCHAR(15) NOT NULL,
  direccion VARCHAR(100) NOT NULL,
  email VARCHAR(50) NULL,
  descripcion VARCHAR(100) NULL,
  PRIMARY KEY (idProveedor))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table basedatoshotel.Sucursal_Servicio
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS basedatoshotel.Sucursal_Servicio (
  idSucursal INT NOT NULL,
  idServicio INT NOT NULL,
  PRIMARY KEY (idSucursal, idServicio),
  INDEX fk_Hotel_has_Servicio_Servicio1_idx (idServicio ASC),
  INDEX fk_Hotel_has_Servicio_Hotel1_idx (idSucursal ASC),
  CONSTRAINT fk_Hotel_has_Servicio_Hotel1
    FOREIGN KEY (idSucursal)
    REFERENCES basedatoshotel.Sucursal (idSucursal)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT fk_Hotel_has_Servicio_Servicio1
    FOREIGN KEY (idServicio)
    REFERENCES basedatoshotel.Servicio (idServicio)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table basedatoshotel.Impuesto
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS basedatoshotel.Impuesto (
  idImpuesto INT NOT NULL,
  porcentaje DOUBLE NOT NULL,
  estado VARCHAR(15) NOT NULL,
  fechaInicio DATETIME NOT NULL,
  fechaFin DATETIME NULL,
  descripcion VARCHAR(100) NULL,
  PRIMARY KEY (idImpuesto))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table basedatoshotel.Cargo
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS basedatoshotel.Cargo (
  idCargo INT NOT NULL,
  nombreCargo VARCHAR(30) NOT NULL,
  salarioMinimo DOUBLE NOT NULL,
  salarioMaximo DOUBLE NOT NULL,
  estado VARCHAR(15) NOT NULL,
  PRIMARY KEY (idCargo),
  UNIQUE INDEX nombreCargo_UNIQUE (nombreCargo ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table basedatoshotel.Cargo_Empleado
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS basedatoshotel.Cargo_Empleado (
  idCargo INT NOT NULL,
  idEmpleado INT NOT NULL,
  PRIMARY KEY (idCargo, idEmpleado),
  INDEX fk_Cargo_has_Empleado_Empleado1_idx (idEmpleado ASC),
  INDEX fk_Cargo_has_Empleado_Cargo1_idx (idCargo ASC),
  CONSTRAINT fk_Cargo_has_Empleado_Cargo1
    FOREIGN KEY (idCargo)
    REFERENCES basedatoshotel.Cargo (idCargo)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT fk_Cargo_has_Empleado_Empleado1
    FOREIGN KEY (idEmpleado)
    REFERENCES basedatoshotel.Empleado (idEmpleado)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table basedatoshotel.Factura_Impuesto
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS basedatoshotel.Factura_Impuesto (
  idFactura INT NOT NULL,
  idImpuesto INT NOT NULL,
  PRIMARY KEY (idFactura, idImpuesto),
  INDEX fk_Factura_has_Impuesto_Impuesto1_idx (idImpuesto ASC),
  INDEX fk_Factura_has_Impuesto_Factura1_idx (idFactura ASC),
  CONSTRAINT fk_Factura_has_Impuesto_Factura1
    FOREIGN KEY (idFactura)
    REFERENCES basedatoshotel.Factura (idFactura)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT fk_Factura_has_Impuesto_Impuesto1
    FOREIGN KEY (idImpuesto)
    REFERENCES basedatoshotel.Impuesto (idImpuesto)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table basedatoshotel.Factura_Descuento
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS basedatoshotel.Factura_Descuento (
  idFactura INT NOT NULL,
  idDescuento INT NOT NULL,
  PRIMARY KEY (idFactura, idDescuento),
  INDEX fk_Factura_has_Descuento_Descuento1_idx (idDescuento ASC),
  INDEX fk_Factura_has_Descuento_Factura1_idx (idFactura ASC),
  CONSTRAINT fk_Factura_has_Descuento_Factura1
    FOREIGN KEY (idFactura)
    REFERENCES basedatoshotel.Factura (idFactura)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT fk_Factura_has_Descuento_Descuento1
    FOREIGN KEY (idDescuento)
    REFERENCES basedatoshotel.Descuento (idDescuento)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table basedatoshotel.EncabezadoPlanilla
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS basedatoshotel.EncabezadoPlanilla (
  idEncabezadoPlanilla INT NOT NULL,
  fechaInicio DATE NOT NULL,
  fechaFin DATE NOT NULL,
  observacion VARCHAR(100) NULL,
  idEmpleado INT NOT NULL,
  PRIMARY KEY (idEncabezadoPlanilla),
  INDEX fk_EncabezadoPlanilla_Empleado1_idx (idEmpleado ASC),
  CONSTRAINT fk_EncabezadoPlanilla_Empleado1
    FOREIGN KEY (idEmpleado)
    REFERENCES basedatoshotel.Empleado (idEmpleado)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table basedatoshotel.PagoPlanilla
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS basedatoshotel.PagoPlanilla (
  idPagoPlanilla INT NOT NULL,
  montoPagado DOUBLE NOT NULL,
  valorBonificacion DOUBLE NOT NULL,
  valorImpuesto DOUBLE NOT NULL,
  valorDeduccion DOUBLE NOT NULL,
  observacion VARCHAR(100) NULL,
  idEmpleado INT NOT NULL,
  idEncabezadoPlanilla INT NOT NULL,
  PRIMARY KEY (idPagoPlanilla),
  INDEX fk_PagoPlanilla_Empleado1_idx (idEmpleado ASC),
  INDEX fk_PagoPlanilla_EncabezadoPlanilla1_idx (idEncabezadoPlanilla ASC),
  CONSTRAINT fk_PagoPlanilla_Empleado1
    FOREIGN KEY (idEmpleado)
    REFERENCES basedatoshotel.Empleado (idEmpleado)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT fk_PagoPlanilla_EncabezadoPlanilla1
    FOREIGN KEY (idEncabezadoPlanilla)
    REFERENCES basedatoshotel.EncabezadoPlanilla (idEncabezadoPlanilla)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table basedatoshotel.Banco
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS basedatoshotel.Banco (
  idBanco INT NOT NULL,
  nombreBanco VARCHAR(45) NOT NULL,
  PRIMARY KEY (idBanco),
  UNIQUE INDEX nombreBanco_UNIQUE (nombreBanco ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table basedatoshotel.TipoCuenta
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS basedatoshotel.TipoCuenta (
  idTipoCuenta INT NOT NULL,
  tipoCuenta VARCHAR(30) NOT NULL,
  descripcion VARCHAR(100) NULL,
  PRIMARY KEY (idTipoCuenta))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table basedatoshotel.CuentaBancaria
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS basedatoshotel.CuentaBancaria (
  idCuentaBancaria INT NOT NULL,
  numeroCuenta VARCHAR(20) NOT NULL,
  idBanco INT NOT NULL,
  idTipoCuenta INT NOT NULL,
  idEmpleado INT NOT NULL,
  PRIMARY KEY (idCuentaBancaria),
  INDEX fk_CuentaBancaria_Banco1_idx (idBanco ASC),
  INDEX fk_CuentaBancaria_TipoCuenta1_idx (idTipoCuenta ASC),
  UNIQUE INDEX numeroCuenta_UNIQUE (numeroCuenta ASC),
  INDEX fk_CuentaBancaria_Empleado1_idx (idEmpleado ASC),
  CONSTRAINT fk_CuentaBancaria_Banco1
    FOREIGN KEY (idBanco)
    REFERENCES basedatoshotel.Banco (idBanco)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT fk_CuentaBancaria_TipoCuenta1
    FOREIGN KEY (idTipoCuenta)
    REFERENCES basedatoshotel.TipoCuenta (idTipoCuenta)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT fk_CuentaBancaria_Empleado1
    FOREIGN KEY (idEmpleado)
    REFERENCES basedatoshotel.Empleado (idEmpleado)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table basedatoshotel.ExperienciaLaboral
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS basedatoshotel.ExperienciaLaboral (
  idExperienciaLaboral INT NOT NULL,
  titulo VARCHAR(20) NOT NULL COMMENT 'Titulo de Universidad/Colegio',
  fechaIncio DATE NOT NULL,
  fechaFin DATE NOT NULL,
  descripcion VARCHAR(100) NULL,
  idEmpleado INT NOT NULL,
  PRIMARY KEY (idExperienciaLaboral),
  INDEX fk_ExperienciaLaboral_Empleado1_idx (idEmpleado ASC),
  CONSTRAINT fk_ExperienciaLaboral_Empleado1
    FOREIGN KEY (idEmpleado)
    REFERENCES basedatoshotel.Empleado (idEmpleado)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table basedatoshotel.Mesa
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS basedatoshotel.Mesa (
  idMesa INT NOT NULL,
  capacidad INT NOT NULL,
  numeroMesa INT NOT NULL,
  PRIMARY KEY (idMesa))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table basedatoshotel.Pedido
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS basedatoshotel.Pedido (
  idPedido INT NOT NULL,
  fechaPedido DATETIME NOT NULL,
  idMesa INT NOT NULL,
  PRIMARY KEY (idPedido),
  INDEX fk_Pedido_Mesa1_idx (idMesa ASC),
  CONSTRAINT fk_Pedido_Mesa1
    FOREIGN KEY (idMesa)
    REFERENCES basedatoshotel.Mesa (idMesa)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table basedatoshotel.DetalleFactura
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS basedatoshotel.DetalleFactura (
  idDetalleFactura INT NOT NULL,
  cantidad DOUBLE NOT NULL,
  descripcionReser VARCHAR(100) NULL,
  idFactura INT NOT NULL,
  idProducto INT NULL,
  idPedido INT NULL,
  idReservacion INT NULL,
  PRIMARY KEY (idDetalleFactura),
  INDEX fk_DetalleFacturaRestaurante_Factura1_idx (idFactura ASC),
  INDEX fk_DetalleFactura_Producto1_idx (idProducto ASC),
  INDEX fk_DetalleFactura_Pedido1_idx (idPedido ASC),
  INDEX fk_DetalleFactura_Reservacion1_idx (idReservacion ASC),
  CONSTRAINT fk_DetalleFacturaRestaurante_Factura1
    FOREIGN KEY (idFactura)
    REFERENCES basedatoshotel.Factura (idFactura)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT fk_DetalleFactura_Producto1
    FOREIGN KEY (idProducto)
    REFERENCES basedatoshotel.Producto (idProducto)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT fk_DetalleFactura_Pedido1
    FOREIGN KEY (idPedido)
    REFERENCES basedatoshotel.Pedido (idPedido)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT fk_DetalleFactura_Reservacion1
    FOREIGN KEY (idReservacion)
    REFERENCES basedatoshotel.Reservacion (idReservacion)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table basedatoshotel.Plato
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS basedatoshotel.Plato (
  idPlato INT NOT NULL,
  nombre VARCHAR(50) NOT NULL,
  precio DOUBLE NOT NULL,
  bebida VARCHAR(40) NULL,
  imagen VARCHAR(255) NOT NULL,
  estado VARCHAR(15) NOT NULL,
  descripcion VARCHAR(100) NULL,
  idMenu INT NOT NULL,
  PRIMARY KEY (idPlato),
  INDEX fk_Plato_Menu1_idx (idMenu ASC),
  UNIQUE INDEX nombre_UNIQUE (nombre ASC),
  CONSTRAINT fk_Plato_Menu1
    FOREIGN KEY (idMenu)
    REFERENCES basedatoshotel.Menu (idMenu)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table basedatoshotel.TipoRecargo
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS basedatoshotel.TipoRecargo (
  idTipoRecargo INT NOT NULL,
  porcentaje DOUBLE NOT NULL,
  descripcion VARCHAR(100) NULL,
  idFactura INT NOT NULL,
  PRIMARY KEY (idTipoRecargo),
  INDEX fk_TipoRecargo_Factura1_idx (idFactura ASC),
  CONSTRAINT fk_TipoRecargo_Factura1
    FOREIGN KEY (idFactura)
    REFERENCES basedatoshotel.Factura (idFactura)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table basedatoshotel.Producto_Proveedor
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS basedatoshotel.Producto_Proveedor (
  idProducto INT NOT NULL,
  idProveedor INT NOT NULL,
  PRIMARY KEY (idProducto, idProveedor),
  INDEX fk_Producto_has_Proveedor_Proveedor1_idx (idProveedor ASC),
  INDEX fk_Producto_has_Proveedor_Producto1_idx (idProducto ASC),
  CONSTRAINT fk_Producto_has_Proveedor_Producto1
    FOREIGN KEY (idProducto)
    REFERENCES basedatoshotel.Producto (idProducto)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT fk_Producto_has_Proveedor_Proveedor1
    FOREIGN KEY (idProveedor)
    REFERENCES basedatoshotel.Proveedor (idProveedor)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table basedatoshotel.Plato_Pedido
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS basedatoshotel.Plato_Pedido (
  idPlato INT NOT NULL,
  idPedido INT NOT NULL,
  cantidadPedido INT NOT NULL,
  PRIMARY KEY (idPlato, idPedido),
  INDEX fk_Plato_has_Pedido_Pedido1_idx (idPedido ASC),
  INDEX fk_Plato_has_Pedido_Plato1_idx (idPlato ASC),
  CONSTRAINT fk_Plato_has_Pedido_Plato1
    FOREIGN KEY (idPlato)
    REFERENCES basedatoshotel.Plato (idPlato)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT fk_Plato_has_Pedido_Pedido1
    FOREIGN KEY (idPedido)
    REFERENCES basedatoshotel.Pedido (idPedido)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table basedatoshotel.Plato_Producto
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS basedatoshotel.Plato_Producto (
  idPlato INT NOT NULL,
  idProducto INT NOT NULL,
  cantidadUsada DOUBLE NOT NULL,
  PRIMARY KEY (idPlato, idProducto),
  INDEX fk_Plato_has_Producto_Producto1_idx (idProducto ASC),
  INDEX fk_Plato_has_Producto_Plato1_idx (idPlato ASC),
  CONSTRAINT fk_Plato_has_Producto_Plato1
    FOREIGN KEY (idPlato)
    REFERENCES basedatoshotel.Plato (idPlato)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT fk_Plato_has_Producto_Producto1
    FOREIGN KEY (idProducto)
    REFERENCES basedatoshotel.Producto (idProducto)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table basedatoshotel.Precio
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS basedatoshotel.Precio (
  idPrecio INT NOT NULL,
  precio DOUBLE NOT NULL,
  fechaInicio DATE NOT NULL,
  fechaFin DATE NULL,
  descripcion VARCHAR(100) NULL,
  idTipoHabitacion INT NOT NULL,
  idTipoCategoria INT NOT NULL,
  INDEX fk_TipoCategoria_has_TipoHabitacion_TipoHabitacion1_idx (idTipoHabitacion ASC),
  INDEX fk_TipoCategoria_has_TipoHabitacion_TipoCategoria1_idx (idTipoCategoria ASC),
  PRIMARY KEY (idPrecio),
  CONSTRAINT fk_TipoCategoria_has_TipoHabitacion_TipoCategoria1
    FOREIGN KEY (idTipoCategoria)
    REFERENCES basedatoshotel.TipoCategoria (idTipoCategoria)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT fk_TipoCategoria_has_TipoHabitacion_TipoHabitacion1
    FOREIGN KEY (idTipoHabitacion)
    REFERENCES basedatoshotel.TipoHabitacion (idTipoHabitacion)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

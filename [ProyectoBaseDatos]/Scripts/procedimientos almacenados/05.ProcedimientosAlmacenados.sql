/*-- Procedimiento 01:
-- Obtiene la Lista de Empleados de la Base
DROP PROCEDURE IF EXISTS SP_ObtenerEmpleados;
 
DELIMITER $$
CREATE PROCEDURE SP_ObtenerEmpleados()

BEGIN

  SELECT per.idPersona, per.primerNombre, per.primerApellido, per.email, per.fechaNacimiento,
		emp.fechaIngreso, emp.estado, per.direccion, TIMESTAMPDIFF(YEAR, fechaNacimiento, CURDATE()) AS edad
	FROM Persona per 
	INNER JOIN Empleado emp ON (per.idPersona = emp.idPersona)
	WHERE TIMESTAMPDIFF(YEAR, fechaNacimiento, CURDATE()) >= "18";

END $$
DELIMITER ;

-- CALL SP_ObtenerEmpleados;
-- El comando CALL invoca un procedimiento definido préviamente con CREATE PROCEDURE.


-- -------------------------------
-- Procedimiento 02:
-- Obtiene la Lista de Clientes de la Base
DROP PROCEDURE IF EXISTS SP_ObtenerClientes;

DELIMITER $$
CREATE PROCEDURE SP_ObtenerClientes()

BEGIN

		SELECT per.idPersona, per.primerNombre, per.primerApellido, per.email, per.fechaNacimiento, 
				cli.fechaRegistro, cli.estado, per.direccion, TIMESTAMPDIFF(YEAR, fechaNacimiento, CURDATE()) AS edad
			FROM Persona per
			INNER JOIN Cliente cli ON (per.idPersona = cli.idPersona)
			WHERE TIMESTAMPDIFF(YEAR, fechaNacimiento, CURDATE()) >= '18';

END $$
DELIMITER ;

-- CALL SP_ObtenerClientes;


-- -------------------------------
-- Procedimiento 03:
-- Calcula las ganancias por año
DROP PROCEDURE IF EXISTS SP_GananciaAnual;

DELIMITER $$
CREATE PROCEDURE SP_GananciaAnual()

BEGIN

	SELECT YEAR(fac.fechaEmision) Año, SUM(fac.costeTotal) AS Ganancias 
	FROM factura fac
	GROUP BY Año;

END $$
DELIMITER ;

-- CALL SP_GananciaAnual;*/

-- -------------------------------
-- Procedimiento 04:

/*DROP PROCEDURE IF EXISTS SP_RegistrarCliente;

DELIMITER $$
CREATE PROCEDURE SP_RegistrarCliente(
						IN primerNombre VARCHAR(20),
						IN segundoNombre VARCHAR(20),
						IN primerApellido VARCHAR(20),
						IN segundoApellido VARCHAR(20),
						IN email VARCHAR(50),
						IN password VARCHAR(45),
						IN genero VARCHAR(1),
						IN direccion VARCHAR(100),
						IN fechaNacimiento DATE,
						IN telefono VARCHAR(15),
						IN pnEdad INT;
						OUT mensaje VARCHAR(200),
						OUT ocurrioError BOOLEAN)

SP:BEGIN

	DECLARE tempMensaje VARCHAR(200);

	START TRANSACTION;

	SET tempMensaje = '';
	SET mensaje = '';
	SET ocurrioError = TRUE;


		IF primerNombre = '' THEN
			SET mensaje='Nombre de usuario es un campo requerido';
			LEAVE SP;
		END IF;

		IF primerApellido = '' THEN
			SET mensaje='Apellido de usuario es un campo requerido';
			LEAVE SP;
		END IF;

		IF email = '' THEN
			SET mensaje='El Correo de usuario es un campo requerido';
			LEAVE SP;
		END IF;

		IF password = '' THEN
			SET mensaje='La password de usuario es un campo requerido';
			LEAVE SP;
		END IF;

		IF direccion = '' THEN
			SET mensaje='La direccion de usuario es un campo requerido';
			LEAVE SP;
		END IF;

		INSERT INTO persona (idPersona, primerNombre, segundoNombre, primerApellido, segundoApellido, email, password,
		 genero, direccion, fechaNacimiento, imagenIdentificacion) 
		VALUES (NULL, primerNombre, segundoNombre, primerApellido, segundoApellido, email, password,
		 genero, direccion, fechaNacimiento, NULL);

		INSERT INTO cliente (idCliente, fechaRegistro, estado, idPersona) 
		VALUES (NULL, NOW(), 'Activo', LAST_INSERT_ID());

		SET ocurrioError = FALSE;
		SET mensaje = "Cliente Registrado Exitosamente";
		COMMIT;

END $$ 
DELIMITER ;

-- -------------------------------
-- Procedimiento 05:
DROP PROCEDURE IF EXISTS SP_RegistrarEmpleado;

DELIMITER $$
CREATE PROCEDURE SP_RegistrarEmpleado(
						IN primerNombre VARCHAR(20),
						IN segundoNombre VARCHAR(20),
						IN primerApellido VARCHAR(20),
						IN segundoApellido VARCHAR(20),
						IN email VARCHAR(50),
						IN password VARCHAR(45),
						IN genero VARCHAR(1),
						IN direccion VARCHAR(100),
						IN fechaNacimiento DATE,
						IN telefono VARCHAR(15),
						OUT mensaje VARCHAR(200),
						OUT ocurrioError BOOLEAN)

SP:BEGIN

	DECLARE tempMensaje VARCHAR(200);

	START TRANSACTION;

	SET tempMensaje = '';
	SET mensaje = '';
	SET ocurrioError = TRUE;

END $$
DELIMITER ;*/


-- -------------------------------
-- Procedimiento 06:

/*DROP PROCEDURE IF EXISTS SP_SucursalReservacion;

DELIMITER $$
CREATE PROCEDURE SP_SucursalReservacion(
						IN pcSucursal VARCHAR(100),
						OUT pcMensaje VARCHAR(200),
						OUT pbOcurrioError BOOLEAN)

SP:BEGIN

		DECLARE temMensaje VARCHAR(2000);
		DECLARE vnConteo INT;

		START TRANSACTION;
		SET temMensaje='';
		SET pbOcurrioError=TRUE;
			SELECT COUNT(*) AS 'cantidad reservaciones' INTO vnConteo, s.nombre INTO pcSucursal FROM reservacion r
			INNER JOIN habitacion_reservacion hr ON (r.idReservacion = hr.idReservacion)
			INNER JOIN habitacion h ON (h.idHabitacion = hr.idHabitacion)
			INNER JOIN sucursal s ON (s.idSucursal = h.idSucursal)
            GROUP BY s.nombre
		IF vnConteo=0 THEN
			SET pcMensaje=CONCAT('La sucursal',pcSucursal,' no tiene reservaciones confirmadas');
			LEAVE SP;
		END IF;
		


END $$
DELIMITER ;*/


-- -------------------------------
-- Procedimiento 01: Registrar personas
DROP PROCEDURE IF EXISTS SP_RegistrarPersona;

DELIMITER $$
CREATE PROCEDURE SP_RegistrarPersona(
						IN pnIdPersona INT,
						IN pcPrimerNombre VARCHAR(20),
						IN pcSegundoNombre VARCHAR(20),
						IN pcPrimerApellido VARCHAR(20),
						IN pcSegundoApellido VARCHAR(20),
						IN pcEmail VARCHAR(50),
						IN pcPassword VARCHAR(45),
						IN pcGenero VARCHAR(1),
						IN pcDireccion VARCHAR(100),
						IN pfFechaNacimiento DATE,
    					IN pcImagenIdentificacion VARCHAR(200),
						IN pcTelefono VARCHAR(15),
						OUT pcMensaje VARCHAR(200),
						OUT pbOcurrioError BOOLEAN)

SP:BEGIN

	DECLARE temMensaje VARCHAR(200);
	DECLARE vnConteo INT;
	DECLARE vcValidarCorreo VARCHAR(50);
	
	SET autocommit=0;
	START TRANSACTION;

	SET temMensaje = '';
	SET pcMensaje = '';
	SET pbOcurrioError = TRUE;

		/*verifica que no existan campos nulos.*/
		IF pcPrimerNombre='' or pcPrimerNombre IS NULL THEN
			SET temMensaje=CONCAT(temMensaje,'primer Nombre, ');
		END IF;

		IF pcPrimerApellido='' or pcPrimerApellido IS NULL THEN
			SET temMensaje=CONCAT(temMensaje,'primer Apellido, ');
		END IF;

		IF pcEmail='' or pcEmail IS NULL THEN
			SET temMensaje=CONCAT(temMensaje,'Correo, ');
		END IF;

		IF pcPassword='' or pcPassword IS NULL THEN
			SET temMensaje=CONCAT(temMensaje,'Contraseña, ');
		END IF;

		IF pcDireccion='' or pcDireccion IS NULL THEN
			SET temMensaje=CONCAT(temMensaje,'Dirección, ');
		END IF;

		IF pfFechaNacimiento='' or pfFechaNacimiento IS NULL THEN
			SET temMensaje=CONCAT(temMensaje,'Fecha de nacimiento, ');
		END IF;

		/*verifica que no exista ninguna persona con ese Id.*/
		SELECT COUNT(*) INTO vnConteo FROM persona
		WHERE idPersona = pnIdPersona;
		IF vnConteo > 0 THEN
			SET pcMensaje = CONCAT('Esta persona ya esta registrada, ');
			LEAVE SP;
		END IF;

		/*SELECT email INTO vcValidarCorreo FROM persona
		WHERE email REGEXP '(.*)@(.*)\.(.*)'
		IF pbOcurrioError THEN
			SET pcMensaje = CONCAT ('El correo', vcValidarCorreo, 'no es válido');
			LEAVE SP;
		END IF;*/

		/*compara si temMensaje es diferente de vacio.*/
		IF temMensaje<>'' THEN
			SET pcMensaje = CONCAT('Campos requeridos para poder registrar la Persona: ', temMensaje);
			SET pbOcurrioError = TRUE;
			LEAVE SP;
		END IF;
		
		/*si no hay ninguna persona con ese id, se inserta en la tabla persona.*/
		IF vnConteo = 0 THEN
			INSERT INTO persona 
			VALUES (null,
					pcPrimerNombre,
					pcSegundoNombre,
					pcPrimerApellido,
					pcSegundoApellido,
					pcEmail,
					pcPassword,
					pcGenero,
					pcDireccion,
					pfFechaNacimiento,
	        		pcImagenIdentificacion);

			SET pcMensaje = 'Persona registrada correctamente';
			COMMIT;
			SET pbOcurrioError = FALSE;
		ELSE 
			SET pcMensaje = 'Error al registrar persona.';
		END IF;

END $$
DELIMITER ;

-- -------------------------------
-- Procedimiento 02: Registrar clientes

DROP PROCEDURE IF EXISTS SP_RegistrarCliente;

DELIMITER $$
CREATE PROCEDURE SP_RegistrarCliente(
						IN pnIdCliente INT,
						IN pcPrimerNombre VARCHAR(20),
						IN pcSegundoNombre VARCHAR(20),
						IN pcPrimerApellido VARCHAR(20),
						IN pcSegundoApellido VARCHAR(20),
						IN pcEmail VARCHAR(50),
						IN pcPassword VARCHAR(45),
						IN pcGenero VARCHAR(1),
						IN pcDireccion VARCHAR(100),
						IN pfFechaNacimiento DATE,
    					IN pcImagenIdentificacion VARCHAR(200),
						IN pcTelefono VARCHAR(15),
						IN pfFechaRegistro DATE,
						IN pcEstado VARCHAR(15),
						IN pnIdPersona INT,
						OUT pcMensaje VARCHAR(200),
						OUT pbOcurrioError BOOLEAN)

SP:BEGIN
	DECLARE temMensaje VARCHAR(2000);
	DECLARE vnConteo,
			vnEdad,
			vnIdCliente INT;
	SET autocommit=0;
	START TRANSACTION;		
	SET temMensaje='';
	SET pbOcurrioError=TRUE;

	/*verifica que los campos no sea  nulos.*/

	/*IF pnIdPersona='' or pnIdPersona IS NULL THEN
		SET temMensaje=CONCAT(temMensaje,'Id de la persona, ');
	END IF;*/

	IF pcEstado='' or pcEstado IS NULL THEN
		SET temMensaje=CONCAT(temMensaje,'estado del cliente, ');
	END IF;

	/*compara si temMensaje es diferente de vacío.*/
	IF temMensaje<>'' THEN
		SET pcMensaje = CONCAT('Campos requeridos para poder registrar el Cliente: ', temMensaje);
		SET pbOcurrioError = TRUE;
		LEAVE SP;
	END IF;

	/*si la fecha de registro es distinta a la fecha actual, no se podrá registrar.*/
	/*SELECT fechaRegistro INTO pfFechaRegistro FROM cliente
	WHERE fechaRegistro = pfFechaRegistro;
	IF pfFechaRegistro != CURDATE() THEN 
		SET pcMensaje = CONCAT('Esta fecha de registro: ',pfFechaRegistro,' no es válida.');
		LEAVE SP;
	END IF;*/

	/*busca si el cliente es mayor de edad para poder registrarlo.*/
	SELECT TIMESTAMPDIFF(MONTH, fechaNacimiento, CURDATE()) INTO vnEdad FROM persona
	WHERE idPersona = pnIdPersona;
	IF vnEdad<216 THEN
		SET pcMensaje =('No pueden existir clientes menores de edad.');
		LEAVE SP;
	END IF;

	/*busca si existe una persona con ese id.*/
	SELECT COUNT(*) INTO vnConteo FROM cliente 
	WHERE idPersona = pnIdPersona;
	IF vnConteo>0 THEN
		SET pcMensaje=CONCAT('Persona con id: ',pnIdPersona,' ya está registrada como empleado.');
		LEAVE SP;
	END IF;
	
	/*busca si existe un cliente con ese id.*/
	SELECT COUNT(*) INTO vnConteo FROM cliente 
	WHERE idCliente = pnIdCliente;
	IF vnConteo>0 THEN
		SET pcMensaje=CONCAT('Cliente con id: ',pnIdEmpleado,' ya existe.');
		LEAVE SP;
	END IF;	

	/*manda a llamar al procedimiento SP_RegistrarPersona.*/
	CALL SP_RegistrarPersona(
					null,
					pcPrimerNombre,
					pcSegundoNombre,
					pcPrimerApellido,
					pcSegundoApellido,
					pcEmail,
					pcPassword,
					pcGenero,
					pcDireccion,
					pfFechaNacimiento,
	               	pcImagenIdentificacion,
	               	pcTelefono,
	               	pcMensaje,
					pbOcurrioError);
	IF pbOcurrioError=TRUE THEN
		LEAVE SP;
	END IF;
	
	/*si el estado del cliente es activo, registra el cliente.*/
	SELECT idCliente INTO vnIdCliente FROM cliente 
	WHERE idCliente = pnIdCliente;
	IF pcEstado = 'Activo' THEN
	INSERT INTO cliente
			VALUES (null,
					CURDATE(),
					pcEstado,
					LAST_INSERT_ID());

		SET pcMensaje=CONCAT('Cliente registrado correctamente.');

		COMMIT;
		SET pbOcurrioError=FALSE;
	/*si el estado no es activo, no puede registrar el cliente.*/
	ELSE 
		SET pcMensaje='El cliente no puede ser registrado.';
		SET pbOcurrioError=TRUE;
	END IF;	


END$$
DELIMITER ;

-- -------------------------------
-- Procedimiento 03: Registrar empleados
DROP PROCEDURE IF EXISTS SP_RegistrarEmpleado;

DELIMITER $$
CREATE PROCEDURE SP_RegistrarEmpleado(
						IN pnIdEmpleado INT,
						IN pnCodigoEmpleado INT, 
						IN pcPrimerNombre VARCHAR(20),
						IN pcSegundoNombre VARCHAR(20),
						IN pcPrimerApellido VARCHAR(20),
						IN pcSegundoApellido VARCHAR(20),
						IN pcEmail VARCHAR(50),
						IN pcPassword VARCHAR(45),
						IN pcGenero VARCHAR(1),
						IN pcDireccion VARCHAR(100),
						IN pfFechaNacimiento DATE,
    					IN pcImagenIdentificacion VARCHAR(200),
						IN pcTelefono VARCHAR(15),
						IN pfFechaIngreso DATE,
						IN pfFechaSalida DATE,
						IN pcEstado VARCHAR(15),
						IN pnIdPersona INT,
						IN pnIdSucursal INT,
						IN pnIdEmpleadoSuperior INT,
						OUT pcMensaje VARCHAR(200),
						OUT pbOcurrioError BOOLEAN)

SP:BEGIN
	DECLARE temMensaje VARCHAR(2000);
	DECLARE vnConteo,
			vnEdad,
			vnIdEmpleado INT;
	SET autocommit=0;
	START TRANSACTION;		
	SET temMensaje='';
	SET pbOcurrioError=TRUE;

	/*verifica que los campos no sean nulos.*/

	IF pnCodigoEmpleado='' or pnCodigoEmpleado IS NULL THEN
		SET temMensaje=CONCAT(temMensaje,'Código de empleado, ');
	END IF;

	IF pcEstado='' or pcEstado IS NULL THEN
		SET temMensaje=CONCAT(temMensaje,'estado, ');
	END IF;


	IF pnIdSucursal='' or pnIdSucursal IS NULL THEN
		SET temMensaje=CONCAT(temMensaje,'Id de sucursal, ');
	END IF;

	IF pnIdEmpleadoSuperior='' or pnIdEmpleadoSuperior IS NULL THEN
		SET temMensaje=CONCAT(temMensaje,'Id del empleado superior, ');
	END IF;

	/*compara si temMensaje es diferente de vacío.*/
	IF temMensaje<>'' THEN
		SET pcMensaje = CONCAT('Campos requeridos para poder registrar el Empleado: ', temMensaje);
		SET pbOcurrioError = TRUE;
		LEAVE SP;
	END IF;

	/*si la fecha de ingreso es distinta a la fecha actual, no se podrá registrar.*/
	/*SELECT fechaIngreso INTO pfFechaIngreso FROM empleado
	WHERE fechaIngreso = pfFechaIngreso;
	IF pfFechaIngreso != CURDATE() THEN 
		SET pcMensaje = CONCAT('Esta fecha de ingreso: ',pfFechaIngreso,' no es válida.');
		LEAVE SP;
	END IF;*/

	/*busca si existe una persona con ese id.*/
	SELECT COUNT(*) INTO vnConteo FROM empleado 
	WHERE idPersona = pnIdPersona;
	IF vnConteo>0 THEN
		SET pcMensaje=CONCAT('Persona con id: ',pnIdPersona,' ya está registrada como empleado.');
		LEAVE SP;
	END IF;

	/*busca si existe un empleado con ese id.*/
	SELECT COUNT(*) INTO vnConteo FROM empleado 
	WHERE idEmpleado = pnIdEmpleado;
	IF vnConteo>0 THEN
		SET pcMensaje=CONCAT('Empleado con id: ',pnIdEmpleado,' ya existe.');
		LEAVE SP;
	END IF;	

	/*busca si esa sucursal existe.*/
	SELECT COUNT(*) INTO vnConteo FROM sucursal
	WHERE idSucursal = pnIdSucursal;
	IF vnConteo=0 THEN
		SET pcMensaje=CONCAT('Sucursal con id: ', pnIdSucursal, 'no existe.');
		LEAVE SP;
	END IF;

	/*busca si ya existe un empleado con ese codigo de empleado.*/
	SELECT COUNT(*) INTO vnConteo FROM empleado
	WHERE codigoEmpleado = pnCodigoEmpleado;
	IF vnConteo>0 THEN
		SET pcMensaje=('Ya existe un empleado con ese código.');
		LEAVE SP;
	END IF;

	/*busca si el empleado es mayor de edad para poder registrarlo.*/
	SELECT TIMESTAMPDIFF(MONTH, fechaNacimiento, CURDATE()) INTO vnEdad FROM persona
	WHERE idPersona = pnIdPersona;
	IF vnEdad<216 THEN
		SET pcMensaje =('No pueden existir empleados menores de edad.');
		LEAVE SP;
	END IF;

	/*manda a llamar al procedimiento SP_RegistrarPersona.*/
	CALL SP_RegistrarPersona(
					null,
					pcPrimerNombre,
					pcSegundoNombre,
					pcPrimerApellido,
					pcSegundoApellido,
					pcEmail,
					pcPassword,
					pcGenero,
					pcDireccion,
					pfFechaNacimiento,
	               	pcImagenIdentificacion,
	               	pcTelefono,
	               	pcMensaje,
					pbOcurrioError);
	IF pbOcurrioError=TRUE THEN
		LEAVE SP;
	END IF;
	
	/*si el estado del empleado es activo, registra el empleado.*/
	SELECT idEmpleado into vnIdEmpleado FROM empleado 
	WHERE idEmpleado = pnIdEmpleado;
	IF pcEstado = 'Activo' THEN
	INSERT INTO empleado
			VALUES (null,
					pnCodigoEmpleado,
			 		CURDATE(),
			 		null,
			 		pcEstado,
			 		LAST_INSERT_ID(),
			 		pnIdSucursal,
			 		pnIdEmpleadoSuperior);

		SET pcMensaje=CONCAT('Empleado registrado correctamente.');

		COMMIT;
		SET pbOcurrioError=FALSE;
	/*si el estado no es activo, no puede registrar el empleado.*/
	ELSE
		SET pcMensaje='El empleado no puede ser registrado.';
		SET pbOcurrioError=TRUE;
	END IF;	


END$$
DELIMITER ;

-- -------------------------------
-- Procedimiento 04: Registrar reservaciones
DROP PROCEDURE IF EXISTS SP_RegistrarReservaciones;

DELIMITER $$
CREATE PROCEDURE SP_RegistrarReservaciones(
							IN pnIdReservacion INT,
							IN pfFechaReservacion DATE,
							IN pfFechaEntrada DATE,
							IN pfFechaSalida DATE,
							IN pnCamaSupletoria INT,
							IN pcEstado VARCHAR(50),
							IN pcObservacion VARCHAR(1000),
							IN pnTipoHabitacion INT,
							IN pnTipoCategoria INT,
							IN pnNoAdultos INT,
							IN pnNoNinos INT,
							IN pnIdCliente INT,
							OUT pcMensaje VARCHAR(200),
							OUT pbOcurrioError BOOLEAN)

SP:BEGIN
	DECLARE temMensaje VARCHAR(2000);
	DECLARE vcAccion VARCHAR(30);
	DECLARE vnConteo, 
			vnIdReservacion INT;
	DECLARE vnEstadoHab VARCHAR(100);
	SET autocommit=0;
	START TRANSACTION;		
	SET temMensaje='';

	SET pbOcurrioError=TRUE;

	/*verifica que los campos no sean nulos.*/
	IF pfFechaReservacion='' or pfFechaReservacion IS NULL THEN
		SET temMensaje=CONCAT(temMensaje,'Fecha de reservación,  ');
	END IF;

	IF pfFechaEntrada='' or pfFechaEntrada IS NULL THEN
		SET temMensaje=CONCAT(temMensaje,'Fecha de entrada,  ');
	END IF;

	IF pfFechaSalida='' or pfFechaSalida IS NULL THEN
		SET temMensaje=CONCAT(temMensaje,'Fecha de salida,  ');
	END IF;

	IF pcEstado='' or pcEstado IS NULL THEN
		SET temMensaje=CONCAT(temMensaje,'Estado,  ');
	END IF;

	IF pnTipoHabitacion='' or pnTipoHabitacion IS NULL THEN
		SET temMensaje=CONCAT(temMensaje,'tipo habitación,  ');
	END IF;

	IF pnTipoCategoria='' or pnTipoCategoria IS NULL THEN
		SET temMensaje=CONCAT(temMensaje,'tipo categoría,  ');
	END IF;

	IF pnNoAdultos='' or pnNoAdultos IS NULL THEN
		SET temMensaje=CONCAT(temMensaje,'Número de adultos,  ');
	END IF;

	IF pnIdCliente='' or pnIdCliente IS NULL THEN
		SET temMensaje=CONCAT(temMensaje,'id del Cliente,  ');
	END IF;

		/*busca si ya existe una reservación con ese id.*/
		SELECT COUNT(*) INTO vnConteo 
		FROM reservacion
		WHERE idReservacion = pnIdReservacion;
		IF vnConteo > 0 THEN
			SET pcMensaje = CONCAT('Esta reservación ya esta registrada.');
			LEAVE SP;
		END IF;

		/*busca si existe ese tipo de habitación.*/
		SELECT COUNT(*) INTO vnConteo FROM tipoHabitacion
		WHERE idTipoHabitacion = pnTipoHabitacion;
		IF pnTipoHabitacion>vnConteo THEN 
			SET pcMensaje = CONCAT('Este tipo de habitación: ',pnTipoHabitacion,' no existe.');
			LEAVE SP;
		END IF;

		/*busca si existe ese tipo de categoría.*/
		SELECT COUNT(*) INTO vnConteo FROM TipoCategoria
		WHERE idTipoCategoria = pnTipoCategoria;
		IF pnTipoCategoria>vnConteo THEN 
			SET pcMensaje = CONCAT('Este tipo de categoría: ',pnTipoCategoria,' no existe.');
			LEAVE SP;
		END IF;

		/*verifica que la fecha de reservación sea válida.*/
		SELECT fechaReservacion INTO pfFechaReservacion FROM reservacion
		WHERE fechaReservacion = pfFechaReservacion;
		IF pfFechaReservacion < CURDATE() THEN 
			SET pcMensaje = CONCAT('Esta fecha de reservación: ',pfFechaReservacion,' no es válida.');
			LEAVE SP;
		END IF;

		/*verifica que la fecha de entrada sea válida.*/
		SELECT fechaEntrada INTO pfFechaEntrada FROM reservacion
		WHERE fechaEntrada = pfFechaEntrada;
		IF pfFechaEntrada < CURDATE() THEN
			SET pcMensaje = CONCAT('Esta fecha de entrada: ',pfFechaEntrada,' no es válida.');
			LEAVE SP;
		END IF;

		/*verifica que la fecha de salida sea después de la fecha de entrada.*/
		SELECT fechaSalida INTO pfFechaSalida FROM reservacion
		WHERE fechaSalida = pfFechaSalida;
		IF pfFechaSalida <= pfFechaEntrada THEN
			SET pcMensaje = CONCAT('Esta fecha de salida: ',pfFechaSalida,' no es válida.');
			LEAVE SP;
		END IF;

		/*verifica que la habitación no esté ocupada.*/
		SELECT estado INTO vnEstadoHab FROM habitacion h
		INNER JOIN tipoHabitacion th ON (th.idTipoHabitacion = h.idTipoHabitacion)
		WHERE estado = vnEstadoHab;
		IF vnEstadoHab = 'ocupada' THEN
			SET pcMensaje = 'Esta habitación está ocupada.';
			LEAVE SP;
		END IF;

		/*compara si el temMensaje es diferente a vacío.*/
		IF temMensaje<>'' THEN
			SET pcMensaje = CONCAT('Campos requeridos para poder registrar la reservación: ', temMensaje);
			SET pbOcurrioError = TRUE;
			LEAVE SP;
		END IF;

		/*si no existe ninguna reservación con ese id, la registra.*/
		IF vnConteo = 0 THEN
			INSERT INTO reservacion
			VALUES(
					pnIdReservacion,
					pfFechaReservacion,
					pfFechaEntrada,
					pfFechaSalida,
					pnCamaSupletoria,
					pcEstado,
					pcObservacion,
					pnNoAdultos,
					pnNoNinos,
					pnIdCliente);

		SET pcMensaje = 'Reservación registrada correctamente';
			COMMIT;
			SET pbOcurrioError = FALSE;
		END IF;


END$$
DELIMITER ;


-- -------------------------------
-- Procedimiento 07: Eliminar reservaciones
DROP PROCEDURE IF EXISTS SP_EliminarReservaciones;

DELIMITER $$
CREATE PROCEDURE SP_EliminarReservaciones(
							IN pnIdReservacion INT,
							IN pfFechaEntrada DATE,
							OUT pcMensaje VARCHAR(200),
							OUT pbOcurrioError BOOLEAN)

SP:BEGIN
	DECLARE vcAccion VARCHAR(30);
	DECLARE vnConteo INT;
	SET autocommit=0;
	START TRANSACTION;		

	SET pbOcurrioError=TRUE;

		/*busca si existe la reservación.*/
		SELECT COUNT(*) INTO vnConteo FROM reservacion
		WHERE idReservacion = pnIdReservacion;
		IF vnConteo = 0 THEN
			SET pcMensaje = CONCAT('No existe la reservación.');
			LEAVE SP;
		END IF;

		/*verifica que la fecha de entrada no haya pasado.*/
		SELECT fechaEntrada INTO pfFechaEntrada FROM reservacion
		WHERE fechaEntrada = pfFechaEntrada;
		IF pfFechaEntrada < CURDATE() THEN
			SET pcMensaje = CONCAT('La reservación con fecha: ',pfFechaEntrada,' ya no se puede cancelar.');
			LEAVE SP;
		END IF;

		/*si la fecha de entrada no ha pasado, elimina la reservación*/
		IF pfFechaEntrada > CURDATE() THEN
			DELETE FROM reservacion
			WHERE idReservacion= pnIdReservacion;
		SET pcMensaje = 'Reservación eliminada correctamente';
			COMMIT;
			SET pbOcurrioError = FALSE;
		END IF;


END$$

DELIMITER ;

-- -------------------------------
-- Procedimiento 05: Registrar hoteles

DROP PROCEDURE IF EXISTS SP_RegistrarHoteles;

DELIMITER $$
CREATE PROCEDURE SP_RegistrarHoteles(
						IN pnIdHotel INT,
						IN pcDescripcionHotel VARCHAR(100),
						OUT pcMensaje VARCHAR(1000),
						OUT pbOcurrioError BOOLEAN)

SP:BEGIN
	DECLARE vnConteo INT;
	SET autocommit=0;
	START TRANSACTION;		

	SET pbOcurrioError=TRUE;

	/*Busca si existe ya un hotel*/
	SELECT COUNT(*) INTO vnConteo FROM hotel
	WHERE idHotel = pnIdHotel;
	IF vnConteo>0 THEN
		SET pcMensaje=CONCAT('Ya existe hotel con id: ', pnIdHotel);
		LEAVE SP;
	/*Registra el hotel*/
	ELSE
		INSERT INTO hotel
				VALUES(null,
					   pcDescripcionHotel);
		SET pcMensaje = 'Hotel registrado correctamente';
		COMMIT;
		SET pbOcurrioError = FALSE;
	END IF;

END$$

DELIMITER ;

-- -------------------------------
-- Procedimiento 06: Registrar sucursales

DROP PROCEDURE IF EXISTS SP_RegistrarSucursales;

DELIMITER $$
CREATE PROCEDURE SP_RegistrarSucursales(
						IN pnIdSucursal INT,
						IN pcNombre VARCHAR(100),
						IN pnCantidadHabitaciones INT,
						IN pcTelefono VARCHAR(20),
						IN pcEmail VARCHAR(50),
						IN pcDireccion VARCHAR(100),
						IN pcDescripcion VARCHAR(100),
						IN pnIdRestaurante INT,
						IN pnIdHotel INT,
						IN pcDescripcionHotel VARCHAR(100),
						OUT pcMensaje VARCHAR(1000),
						OUT pbOcurrioError BOOLEAN)

SP:BEGIN
	DECLARE temMensaje VARCHAR(2000);
	DECLARE vnConteo,
			vnIdSucursal INT;
	SET autocommit=0;
	START TRANSACTION;		

	SET pbOcurrioError=TRUE;

	/*Valida que los campos no sean nulos*/
	IF pcNombre='' or pcNombre IS NULL THEN
		SET temMensaje=CONCAT(temMensaje,'Nombre de la sucursal, ');
	END IF;

	IF pnCantidadHabitaciones='' or pnCantidadHabitaciones IS NULL THEN
		SET temMensaje=CONCAT(temMensaje,'Cantidad de habitaciones, ');
	END IF;

	IF pcTelefono='' or pcTelefono IS NULL THEN
		SET temMensaje=CONCAT(temMensaje,'Teléfono, ');
	END IF;

	IF pcDireccion='' or pcDireccion IS NULL THEN
		SET temMensaje=CONCAT(temMensaje,'Dirección de la sucursal, ');
	END IF;

	IF pnIdRestaurante='' or pnIdRestaurante IS NULL THEN
		SET temMensaje=CONCAT(temMensaje,'Id del restaurante, ');
	END IF;


	/*compara si el temMensaje es diferente a vacío.*/
	IF temMensaje<>'' THEN
		SET pcMensaje=CONCAT('Campos requeridos para poder registrar la Sucursal:',temMensaje);
		LEAVE SP;
	END IF;

	/*Busca si existe el restaurante*/
	SELECT COUNT(*) INTO vnConteo FROM restaurante
	WHERE idRestaurante = pnIdRestaurante;
	IF vnConteo=0 THEN
		SET pcMensaje = ('El restaurante no existe.');
		LEAVE SP;
	END IF;

	/*Busca si ya existe una sucursal con ese id*/
	SELECT COUNT(*) INTO vnConteo FROM sucursal
	WHERE idSucursal = pnIdSucursal;
	IF vnConteo>0 THEN
		SET pcMensaje = ('Ya existe una sucursal con este id.');
		LEAVE SP;
	END IF;

	/*manda a llamar al procedimiento SP_RegistrarHoteles*/
	CALL SP_RegistrarHoteles(
							 null,
							 pcDescripcionHotel,
	               			 pcMensaje,
							 pbOcurrioError);
	IF pbOcurrioError=TRUE THEN
		LEAVE SP;
	END IF;


	/*Agrega la nueva sucursal*/
	SELECT idSucursal INTO vnIdSucursal FROM sucursal
	WHERE idSucursal = pnIdSucursal;
	IF pcNombre!='' THEN
		INSERT INTO sucursal
				VALUES(null,
					   pcNombre,
					   pnCantidadHabitaciones,
					   pcTelefono,
					   pcEmail,
					   pcDireccion,
					   pcDescripcion,
					   pnIdRestaurante,
					   LAST_INSERT_ID());

		SET pcMensaje = 'Sucursal registrada correctamente';
		COMMIT;
		SET pbOcurrioError = FALSE;
	ELSE
		SET pcMensaje='El empleado no puede ser registrado ';
		SET pbOcurrioError=TRUE;
	END IF;


END$$
DELIMITER ;

-- -------------------------------
-- Procedimiento 06: Registrar facturas


DROP PROCEDURE IF EXISTS SP_RegistrarFacturas;

DELIMITER $$
CREATE PROCEDURE SP_RegistrarFacturas(
						IN pnIdFactura INT,
						IN pnNumFactura INT,
						IN pfFechaEmision DATETIME,
						IN pdCosteReservacion DOUBLE,
						IN pdCostePedido DOUBLE,
						IN pdCosteProducto DOUBLE,
						IN pdCosteTotal DOUBLE,
						IN pdCambio DOUBLE,
						IN pcObservacion VARCHAR(100),
						IN pnIdCliente INT,
						IN pnIdEmpleado INT,
						IN pnIdTipoFactura INT,
						IN pnIdModoPago INT,
						OUT pcMensaje VARCHAR(1000),
						OUT pbOcurrioError BOOLEAN)

SP:BEGIN
	DECLARE temMensaje VARCHAR(2000);
	DECLARE vnConteo,
			vnIdSucursal INT;
	SET autocommit=0;
	START TRANSACTION;		
	SET temMensaje='';
	SET pcMensaje='';
	SET pbOcurrioError=TRUE;


	/*Valida que los campos no sean nulos*/
	IF pnNumFactura='' or pnNumFactura IS NULL THEN
		SET temMensaje=CONCAT(temMensaje,'Número de factura, ');
	END IF;

	IF pfFechaEmision='' or pfFechaEmision IS NULL THEN
		SET temMensaje=CONCAT(temMensaje,'Fecha de emisión, ');
	END IF;

	IF pdCambio='' or pdCambio IS NULL THEN
		SET temMensaje=CONCAT(temMensaje,'Cambio, ');
	END IF;

	IF pnIdCliente='' or pnIdCliente IS NULL THEN
		SET temMensaje=CONCAT(temMensaje,'Id del cliente, ');
	END IF;

	IF pnIdEmpleado='' or pnIdEmpleado IS NULL THEN
		SET temMensaje=CONCAT(temMensaje,'Id del empleado, ');
	END IF;

	IF pnIdTipoFactura='' or pnIdTipoFactura IS NULL THEN
		SET temMensaje=CONCAT(temMensaje,'Id del tipo de factura, ');
	END IF;

	IF pnIdModoPago='' or pnIdModoPago IS NULL THEN
		SET temMensaje=CONCAT(temMensaje,'Id del modo de pago, ');
	END IF;


	/*Busca si existe una factura con el numero de factura*/
	SELECT COUNT(numFactura) INTO vnConteo FROM factura 
	WHERE numFactura = pnNumFactura;
	IF vnConteo>0 THEN
		SET pcMensaje=CONCAT('Factura con el número: ',pnNumFactura,' ya esta registrada.');
		LEAVE SP;
	END IF;

	/*Verifica que el coste total sea el correcto*/
	SELECT costeTotal INTO pdCosteTotal FROM factura
	WHERE costeTotal = pdCosteTotal;
	IF pdCosteTotal<0 THEN
		SET pcMensaje=CONCAT('El coste total: ',pdCosteTotal,' no es correcto.');
		LEAVE SP;
	END IF;

	/*Busca si existe el cliente*/
	SELECT COUNT(*) INTO vnConteo FROM cliente
	WHERE idCliente = pnIdCliente;
	IF vnConteo=0 THEN
		SET pcMensaje = ('El cliente no existe');
		LEAVE SP;
	END IF;

	/*Busca si existe el empleado*/
	SELECT COUNT(*) INTO vnConteo FROM empleado
	WHERE idEmpleado = pnIdEmpleado;
	IF vnConteo=0 THEN
		SET pcMensaje = ('El empleado no existe');
		LEAVE SP;
	END IF;

	/*Busca si existe el tipo de factura*/
	SELECT COUNT(*) INTO vnConteo FROM tipoFactura
	WHERE idTipoFactura = pnIdTipoFactura;
	IF vnConteo=0 THEN
		SET pcMensaje = ('El tipo de factura no existe');
		LEAVE SP;
	END IF;

	/*Busca si existe el modo de pago*/
	SELECT COUNT(*) INTO vnConteo FROM modoPago
	WHERE idModoPago = pnIdModoPago;
	IF vnConteo=0 THEN
		SET pcMensaje = ('El modo de pago no existe');
		LEAVE SP;
	END IF;

	/*Verifica que los costes sean válidos de acuerdo al tipo de factura*/
	SELECT idTipoFactura INTO pnIdTipoFactura FROM tipoFactura
	WHERE idTipoFactura = pnIdTipoFactura;
	IF pnIdTipoFactura=1 AND pdCosteReservacion='' or pdCosteReservacion IS NULL THEN
		SET pcMensaje = ('El coste de reservación no puede ir nulo');
		LEAVE SP;
	END IF;

	IF pnIdTipoFactura=2
	 		AND pdCostePedido='' or pdCosteReservacion IS NULL 
	 		AND pdCosteProducto='' or pdCosteProducto IS NULL
	 		AND pdCosteReservacion!='' or pdCosteReservacion IS NOT NULL THEN
		SET pcMensaje = ('El coste de pedido y coste de producto no pueden ir nulos y el coste de reservación debe de ir nulo');
		LEAVE SP;
	END IF;


	/*Busca si existe una factura con ese id*/
	SELECT COUNT(*) INTO vnConteo FROM factura 
	WHERE idFactura = pnIdFactura;
	IF vnConteo>0 THEN
		SET pcMensaje=CONCAT('Factura con id: ',pnIdFactura,' ya esta registrada.');
		LEAVE SP;
	/*Registra la factura*/
	ELSE
		INSERT INTO factura
				VALUES(null,
					   pnNumFactura,
					   CURDATE(),
					   pdCosteReservacion,
					   pdCostePedido,
					   pdCosteProducto,
					   (pdCosteReservacion + pdCostePedido + pdCosteProducto),
					   pdCambio,
					   pcObservacion,
					   pnIdCliente,
					   pnIdEmpleado,
					   pnIdTipoFactura,
					   pnIdModoPago);
                       
		SET pcMensaje='Factura registrada correctamente.';

			COMMIT;
			SET pbOcurrioError=FALSE;
	END IF;


		

END$$
DELIMITER ;
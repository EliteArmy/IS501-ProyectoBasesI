-- Procedimiento 01:
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

-- CALL SP_GananciaAnual;

-- -------------------------------
-- Procedimiento 04:
DROP PROCEDURE IF EXISTS SP_RegistrarCliente;

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

-- CALL SP_RegistrarCliente('Claudy', 'Emily', 'Klulisekes', 'Bartlomie', 'ebartlomfhfieczak5j@ask.com', '03c345ae8bd4c13f4eb2eb6dde0a92e0', 'F', '6 Westridge Drive', '1966-07-13', '50495203354', @mensaje, @ocurrioError);
-- SELECT @mensaje;

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
DELIMITER ;


-- -------------------------------
-- Procedimiento 06:

DROP PROCEDURE IF EXISTS SP_SucursalReservacion;

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
DELIMITER ;


-- -------------------------------
-- Procedimiento 07:
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
						IN pcTelefono VARCHAR(15),
						OUT pcMensaje VARCHAR(200),
						OUT pbOcurrioError BOOLEAN)

SP:BEGIN

	DECLARE temMensaje VARCHAR(200);
	DECLARE vnConteo,
			vnpersonaMax INT;
	SET autocommit=0;
	START TRANSACTION;

	SET temMensaje = '';
	SET pcMensaje = '';

	

	SET pbOcurrioError = TRUE;

		IF pcPrimerNombre IS NULL THEN
			SET temMensaje=CONCAT(temMensaje,'primer Nombre');
			LEAVE SP;
		END IF;

		IF pcPrimerApellido IS NULL THEN
			SET temMensaje=CONCAT(temMensaje,'primer Apellido');
			LEAVE SP;
		END IF;


		IF pcEmail IS NULL THEN
			SET temMensaje=CONCAT(temMensaje,'Correo');
			LEAVE SP;
		END IF;

		IF pcPassword IS NULL THEN
			SET temMensaje=CONCAT(temMensaje,'Contraseña');
			LEAVE SP;
		END IF;

		IF pcDireccion IS NULL THEN
			SET temMensaje=CONCAT(temMensaje,'Dirección');
			LEAVE SP;
		END IF;

		IF pfFechaNacimiento IS NULL THEN
			SET temMensaje=CONCAT(temMensaje,'Fecha de nacimiento');
			LEAVE SP;
		END IF;

		IF temMensaje<>'' THEN
			SET pcMensaje=CONCAT('Campos requeridos para poder registrar la persona:',temMensaje);
			LEAVE SP;
		END IF;


		SELECT COUNT(*) INTO vnConteo FROM 
		persona WHERE idPersona=pnIdPersona;
		IF vnConteo>0 THEN
			SET pcMensaje=CONCAT('Esta persona ya esta registrada');
			LEAVE SP;
		END IF;


END $$
DELIMITER ;
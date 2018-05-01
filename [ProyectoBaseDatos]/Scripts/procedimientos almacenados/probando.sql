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
							IN pcAccion VARCHAR(50),
						OUT pcMensaje VARCHAR(200),
						OUT pbOcurrioError BOOLEAN)

SP:BEGIN

	/*Declaracion de Variables.*/
	DECLARE temMensaje VARCHAR(200);
	DECLARE vnConteo INT;
	DECLARE vcValidarCorreo VARCHAR(50);
	
	SET autocommit=0;
	START TRANSACTION;

	/*Asignacion de Variables*/
	SET temMensaje = '';
	SET pcMensaje = '';
	SET pbOcurrioError = TRUE;

		/*verifica que no existan campos nulos.*/
		IF pcPrimerNombre ='' or pcPrimerNombre IS NULL THEN
			SET temMensaje = CONCAT(temMensaje, 'primer Nombre, ');
		END IF;

		IF pcPrimerApellido ='' or pcPrimerApellido IS NULL THEN
			SET temMensaje = CONCAT(temMensaje, 'primer Apellido, ');
		END IF;

		IF pcEmail ='' or pcEmail IS NULL THEN
			SET temMensaje = CONCAT(temMensaje, 'Correo, ');
		END IF;

		IF pcPassword ='' or pcPassword IS NULL THEN
			SET temMensaje = CONCAT(temMensaje, 'Contraseña, ');
		END IF;

		IF pcDireccion ='' or pcDireccion IS NULL THEN
			SET temMensaje = CONCAT(temMensaje, 'Dirección, ');
		END IF;
	
		IF pfFechaNacimiento ='' or pfFechaNacimiento IS NULL THEN
			SET temMensaje = CONCAT(temMensaje, 'Fecha de nacimiento, ');
		END IF;

		/*compara si temMensaje es diferente de vacio.*/
		IF temMensaje<>'' THEN
			SET pcMensaje = CONCAT('Campos requeridos para poder registrar la Persona: ', temMensaje);
			SET pbOcurrioError = TRUE;
		END IF;
		
		CASE
			/*registra la persona*/
			WHEN pcAccion = 'Agregar' THEN
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
					SET pbOcurrioError = FALSE;
					COMMIT;

			/*Edita la persona*/
			WHEN pcAccion = 'Editar' THEN
					UPDATE persona SET
							idPersona = pnIdPersona,
							primerNombre = pcPrimerNombre,
							segundoNombre = pcSegundoNombre,
							primerApellido = pcPrimerApellido,
							segundoApellido = pcSegundoApellido,
							email = pcEmail,
							password = pcPassword,
							genero = pcGenero,
							direccion = pcDireccion,
							fechaNacimiento = pfFechaNacimiento,
							imagenIdentificacion = pcImagenIdentificacion
					WHERE idPersona = pnIdPersona;
					IF pbOcurrioError THEN
						SET pcMensaje = CONCAT('Error al actualizar persona.', pcMensaje);
						SET pbOcurrioError = TRUE;
					ELSE 
						SET pcMensaje = 'Persona actualizada correctamente';
						COMMIT;
						SET pbOcurrioError = FALSE;
					END IF;

			/*Elimina la persona*/
			WHEN pcAccion = 'Eliminar' THEN
					DELETE FROM persona
					WHERE idPersona = pnIdPersona;
					
					IF pbOcurrioError THEN
						SET pcMensaje = CONCAT('La persona no se pudo eliminar.',pcMensaje);
						SET pbOcurrioError = TRUE;
					ELSE
						SET pcMensaje = 'Persona eliminada correctamente.';
						SET pbOcurrioError = FALSE;
						COMMIT;
					END IF;

			ELSE 
    		SET pcMensaje='No se selecciono Agregar, Editar ni Eliminar ';
		END CASE;

END $$

DELIMITER ;

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
							IN pcAccion VARCHAR(50),
						OUT pcMensaje VARCHAR(200),
						OUT pbOcurrioError BOOLEAN)

SP:BEGIN

	/*Declaracion de Variables.*/
	DECLARE temMensaje VARCHAR(2000);
	DECLARE vnConteo, vnEdad INT;
	
	SET autocommit = 0;
	START TRANSACTION;

	SET temMensaje = '';
	SET pbOcurrioError = FALSE;

	/*verifica que los campos no sean nulos.*/
	IF pnCodigoEmpleado ='' or pnCodigoEmpleado IS NULL THEN
		SET temMensaje = CONCAT(temMensaje, 'Código de empleado, ');
	END IF;

	IF pnIdSucursal ='' or pnIdSucursal IS NULL THEN
		SET temMensaje=CONCAT(temMensaje, 'Id de sucursal, ');
	END IF;

	IF pnIdEmpleadoSuperior ='' or pnIdEmpleadoSuperior IS NULL THEN
		SET temMensaje = CONCAT(temMensaje, 'Id del empleado superior, ');
	END IF;

	/*compara si temMensaje es diferente de vacío.*/
	IF temMensaje<>'' THEN
		SET pcMensaje = CONCAT('Campos requeridos para poder registrar el Empleado: ', temMensaje);
		SET pbOcurrioError = TRUE;
		/*LEAVE SP;*/
	END IF;

	/*busca si esa sucursal existe.*/
	SELECT COUNT(*) INTO vnConteo FROM sucursal
	WHERE idSucursal = pnIdSucursal;
	
	IF vnConteo = 0 THEN
		SET pcMensaje = CONCAT('Sucursal con id: ', pnIdSucursal, 'no existe.');
		LEAVE SP;
	END IF;

		/*manda a llamar al procedimiento SP_RegistrarPersona.*/
		CALL SP_RegistrarPersona(
						pnIdPersona,
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
		         	pcAccion,
		       	pcMensaje,
						pbOcurrioError);

			/*Valida si hubo error en Registrar Persona*/
			IF pbOcurrioError = TRUE THEN
				LEAVE SP;
			END IF;

	/* -- Inicio del Case. -- */
	CASE 
		
		/*Registra el Empleado.*/
		WHEN pcAccion = 'Agregar' THEN
				INSERT INTO empleado
						VALUES (null,
								pnCodigoEmpleado,
						 		CURDATE(),
						 		null,
						 		'Activo',
						 		LAST_INSERT_ID(),
						 		pnIdSucursal,
						 		pnIdEmpleadoSuperior);

				IF pbOcurrioError THEN
					SET pcMensaje = CONCAT('El empleado no se pudo registrar', pcMensaje);
					SET pbOcurrioError = TRUE;
				ELSE 
					SET pcMensaje = 'Empleado registrado correctamente.';
					COMMIT;
					SET pbOcurrioError=FALSE;
				END IF;

		/*Edita el Empleado.*/
		WHEN pcAccion = 'Editar' THEN
			UPDATE empleado SET 
					idEmpleado = pnIdEmpleado,
					codigoEmpleado = pnCodigoEmpleado,
					fechaIngreso = pfFechaIngreso,
					fechaSalida = pfFechaSalida,
					estado = pcEstado,
					idPersona = pnIdPersona,
					idSucursal = pnIdSucursal,
					idEmpleadoSuperior = pnIdEmpleadoSuperior
			WHERE idEmpleado = pnIdEmpleado;
			
			IF pbOcurrioError THEN
				SET pcMensaje = CONCAT('El empleado no se pudo actualizar',pcMensaje);
				SET pbOcurrioError = TRUE;
			ELSE
				SET pcMensaje = 'Datos del empleado actualizados satisfactorimente.';
				COMMIT;
				SET pbOcurrioError = FALSE;
			END IF;	

		/*Elimina el Empleado.*/
		WHEN pcAccion = 'Eliminar' THEN
			DELETE FROM empleado
			WHERE idEmpleado = pnIdEmpleado;
			IF pbOcurrioError THEN
				SET pcMensaje = CONCAT('El empleado no se pudo eliminar.',pcMensaje);
				SET pbOcurrioError = TRUE;
			ELSE
				SET pcMensaje = 'Empleado eliminado correctamente.';
				COMMIT;
				SET pbOcurrioError = FALSE;
			END IF;
		ELSE 
    		SET pcMensaje = 'No se selecciono Agregar, Editar ni Eliminar ';
	END CASE;
	/* -- Cierre del Case. -- */

END$$

DELIMITER ;
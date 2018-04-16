-- Procedimiento 01:
--Obtiene la Lista de Empleados de la Base
DROP PROCEDURE IF EXISTS SP_ObtenerEmpleados;
 
DELIMITER $$
CREATE PROCEDURE SP_ObtenerEmpleados()

BEGIN

  SELECT per.idPersona, per.primerNombre, per.primerApellido, per.email, per.fechaNacimiento,
          emp.fechaIngreso, emp.estado, per.direccion
    FROM Persona per 
    INNER JOIN Empleado emp ON (per.idPersona = emp.idPersona);

END $$
DELIMITER ;

-- CALL SP_ObtenerEmpleados;
-- El comando CALL invoca un procedimiento definido préviamente con CREATE PROCEDURE.

-- -------------------------------
-- Procedimiento 02:
-- Calcula las ganancias por año
DROP PROCEDURE IF EXISTS SP_GananciaAnual;

DELIMITER $$
CREATE PROCEDURE SP_GananciaAnual()

BEGIN

	SELECT YEAR(fac.fechaEmision) Año, fac.fechaEmision, SUM(fac.costeTotal) AS Ganancias 
	FROM factura fac
	GROUP BY Año;

END $$
DELIMITER ;

-- CALL SP_GananciaAnual;

-- -------------------------------
-- Procedimiento 03:
DROP PROCEDURA IF EXISTS SP_RegistrarCliente;

DELIMITER $$
CREATE PROCEDURE SP_RegistrarCliente()

BEGIN

	SELECT

END $$ 
DELIMITER ;


-- -------------------------------
-- Procedimiento 04:



-- -------------------------------
-- Procedimiento 05:



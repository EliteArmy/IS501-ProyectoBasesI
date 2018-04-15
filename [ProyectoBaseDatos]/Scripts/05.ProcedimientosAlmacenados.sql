-- Procedimiento 01: 
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

-- CALL SP_ObtenerEmpleados()
-- El comando CALL invoca un procedimiento definido préviamente con CREATE PROCEDURE.
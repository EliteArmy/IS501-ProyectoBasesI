DROP PROCEDURE IF EXISTS SP_FechaEmision;

DELIMITER $$
CREATE PROCEDURE SP_FechaEmision()

BEGIN

	SELECT YEAR(fac.fechaEmision) Año, fac.fechaEmision, SUM(fac.costeTotal) AS Ganancias 
	FROM factura fac
	WHERE MAX(Ganancias);
	GROUP BY Año;

END $$
DELIMITER ;
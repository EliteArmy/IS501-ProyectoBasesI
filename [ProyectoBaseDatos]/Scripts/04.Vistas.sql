-- 01. Vista que muestra primer nombre y primer apellido de todos los clientes con estado = activo:
CREATE VIEW vw_clientes
AS (
SELECT p.primerNombre, p.primerApellido, c.estado 
FROM persona p 
INNER JOIN cliente c ON c.idPersona = p.idPersona
WHERE c.estado = 'Activo');

SELECT * FROM vw_clientes;

-- -------------------------------
-- 02. Vista que muestra número de habitación, tipo de habitación y precio únicamente de habitaciones cuyo estado = disponible:
CREATE VIEW vw_habitacion
AS (
SELECT h.idHabitacion, h.numeroHabitacion, th.descripcion, p.precio 
FROM habitacion h 
INNER JOIN tipohabitacion th ON th.idTipoHabitacion = h.idTipoHabitacion
INNER JOIN precio p ON p.idTipoHabitacion = th.idTipoHabitacion
WHERE h.estado = 'disponible');

SELECT * FROM vw_habitacion;

-- -------------------------------
-- 03. Vista que muestra número de habitación, tipo de habitación y precio únicamente de habitaciones cuyo estado = ocupado:
CREATE VIEW vw_habitacion_nodisponible
AS (
SELECT h.numeroHabitacion, th.tipoHabitacion, p.precio 
FROM habitacion h 
INNER JOIN tipohabitacion th ON th.idTipoHabitacion = h.idTipoHabitacion
INNER JOIN precio p ON p.idTipoHabitacion = th.idTipoHabitacion
WHERE h.estado = 'ocupada');

SELECT * FROM vw_habitacion_nodisponible;

-- -------------------------------
-- 04. Vista que muestra número de factura, fecha de emisión, coste total, primer nombre y primer apellido del cliente, tipo de factura y modo de pago solo de:
CREATE VIEW vw_facturaHotel
AS (
SELECT f.numFactura, f.fechaEmision, f.costeTotal, p.primerNombre, p.primerApellido, tf.nombre, mp.modoPago FROM factura f 
INNER JOIN tipofactura tf ON tf.idTipoFactura = f.idTipoFactura
INNER JOIN modopago mp ON mp.idModoPago = f.idModoPago
INNER JOIN cliente c ON c.idCliente = f.idCliente
INNER JOIN persona p ON p.idPersona = c.idPersona
WHERE tf.nombre = 'factura hotel' AND mp.modoPago = 'efectivo');

SELECT * FROM vw_facturaHotel;

-- -------------------------------
-- 05. Vista que muestra el número de veces que un cliente ha reservado una habitación (más de 2):
CREATE VIEW vw_reservaciones
AS (
SELECT p.primerNombre, p.segundoNombre, COUNT(*) "Número de reservaciones" FROM reservacion r 
INNER JOIN cliente c ON c.idCliente = r.idCliente
INNER JOIN persona p ON p.idPersona = c.idPersona
HAVING COUNT(*) > 2);

SELECT * FROM vw_reservaciones;

-- -------------------------------
-- 06. Vista para todos los precios de temporada alta activos:
CREATE VIEW vw_precios
AS (
SELECT * FROM precio p 
WHERE p.descripcion = 'Temporada Alta' AND p.fechaFin);

SELECT * FROM vw_precios;

-- -------------------------------
-- 07. Vista que muestre la descripción del menú, el nombre y precio de los platos para cada menú en orden ascendente 
CREATE VIEW vw_platos
AS (
SELECT m.descripcion, p.nombre, p.precio FROM plato p 
INNER JOIN menu m ON m.idMenu = p.idMenu
WHERE p.estado = 'A'
ORDER BY m.descripcion ASC);

SELECT * FROM vw_platos;

-- -------------------------------
-- 08. Vista que muestra el tipo de habitación, precio, nombre de sucursal y fecha de reservación en la sucursal choluteca, estado de habitación = disponible y 
--la fecha de registro = 28/2/2016
CREATE VIEW vw_habdisponibles
AS (
SELECT th.tipoHabitacion, p.precio, s.nombre, r.fechaReservacion FROM habitacion h 
INNER JOIN tipohabitacion th ON th.idTipoHabitacion = h.idTipoHabitacion
INNER JOIN precio p ON p.idTipoHabitacion = th.idTipoHabitacion
INNER JOIN sucursal s ON s.idSucursal = h.idSucursal
INNER JOIN habitacion_reservacion hr ON hr.idHabitacion = h.idHabitacion
INNER JOIN reservacion r ON r.idReservacion = hr.idReservacion
WHERE s.nombre = 'sucursal Choluteca' AND h.estado = 'disponible' AND r.fechaReservacion = '2016-02-28');

SELECT * FROM vw_habdisponibles;

-- -------------------------------
-- 09. Vista que Muestra los empleados que son clientes
CREATE VIEW wv_EmpleadoCliente AS (
SELECT per.primerNombre, per.primerApellido 
FROM persona per
INNER JOIN empleado emp ON per.idPersona = emp.idPersona
INNER JOIN cliente cli ON per.idPersona = cli.idPersona);

SELECT * FROM wv_EmpleadoCliente;

-- -------------------------------
--10. Obtiene la informacion del cliente y la ultima Fecha que registro Factura:
CREATE VIEW vw_ultimaFactura
AS (
	SELECT c.idCliente, p.primerNombre, p.primerApellido, (
	SELECT MAX(f.fechaEmision) 
	FROM factura f
	WHERE f.idCliente = c.idCliente
	) UltimaFechaFactura
FROM persona p
INNER JOIN cliente c ON c.idPersona = p.idPersona);

SELECT * FROM vw_ultimaFactura;

-- -------------------------------
--11. Obtiene la edad de las personas

CREATE VIEW vw_edad AS(
SELECT p.primerNombre, p.primerApellido, TIMESTAMPDIFF(YEAR, fechaNacimiento, CURDATE()) edad FROM persona p);
SELECT * FROM vw_edad;



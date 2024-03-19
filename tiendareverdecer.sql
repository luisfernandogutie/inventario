-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-12-2021 a las 08:01:14
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tiendareverdecer`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ACTUALIZAR_CLIENTE` (IN `ID` INT, IN `NOMBRE` VARCHAR(100), IN `TELEFONO` VARCHAR(15), IN `DIRECCION` VARCHAR(45), IN `EMAIL` VARCHAR(45), IN `ESTADO` BOOLEAN, IN `IDANTIGUO` INT)  UPDATE Cliente SET IdCliente=ID, Nombre=NOMBRE, Telefono=TELEFONO,Direccion=DIRECCION,Email=EMAIL, EstadoCliente=ESTADO WHERE IdCliente = IDANTIGUO$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ACTUALIZAR_EMPLEADO` (IN `ID` INT, IN `NOMBRE` VARCHAR(100), IN `TELEFONO` VARCHAR(15), IN `CARGO` INT, IN `CORREO` VARCHAR(45), IN `CONTRASEÑA` VARCHAR(45), IN `IDANTIGUO` INT)  UPDATE Empleado SET IdEmpleado=ID, Nombre=NOMBRE,Telefono=TELEFONO,Cargo_IdCargo=CARGO,Correo=CORREO, Contraseña=md5(CONTRASEÑA) WHERE IdEmpleado=IDANTIGUO$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ACTUALIZAR_MEDIO_PAGO` (IN `ID` INT, IN `DESCRIPCION` VARCHAR(45), IN `IDANTIGUO` INT)  UPDATE Tpago SET IdTpago=ID, descripcion=DESCRIPCION
WHERE IdTpago=IDANTIGUO$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ACTUALIZAR_PRODUCTO` (IN `IDNUEVO` INT, IN `PROVEEDOR` INT, IN `NOMBRE` VARCHAR(45), IN `EMPAQUE` VARCHAR(45), IN `PRECIOU` DECIMAL, IN `CANTIDAD` INT, IN `PRECIOV` DECIMAL, IN `FECHAVENC` DATE, IN `LOTE` VARCHAR(45), IN `IVA` INT, IN `IDANTIGUO` INT)  UPDATE Producto SET IdProducto=IDNUEVO,Proveedor_IdProveedor=PROVEEDOR,Nombre=NOMBRE,Empaque=EMPAQUE,PrecioUnitario=PRECIOU, cantSistema=CANTIDAD,FechaVencimiento=FECHAVENC,NumeroLote=LOTE,ProcentajeIVA=IVA WHERE IdProducto=IDANTIGUO$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ACTUALIZAR_PROVEEDOR` (IN `ID` INT, IN `NOMBRE` VARCHAR(100), IN `TELEFONO` VARCHAR(45), IN `EMAIL` VARCHAR(45), IN `ESTADO` BOOLEAN, IN `IDANTIGUO` INT)  UPDATE Proveedor SET IdProveedor=ID, Nombre=NOMBRE, Telefono=TELEFONO, EmailProveedor=EMAIL,EstadoProveedor=ESTADO WHERE IdProveedor= IDANTIGUO$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ACTUALIZAR_ROL` (IN `ID` INT(11), IN `NOMBRE` VARCHAR(45))  UPDATE Cargo SET Nombre=NOMBRE WHERE IdCargo = ID$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_BORRAR_ROL` (IN `ID` INT(11))  DELETE FROM Cargo where IdCargo = ID$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_CAMBIAR_ESTADO_CLIENTE` (IN `ID` INT)  UPDATE Cliente SET EstadoCliente=0 WHERE IdCliente=ID$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_CAMBIAR_ESTADO_PROVEEDOR` (IN `ID` INT)  UPDATE Proveedor SET EstadoProveedor=false WHERE IdProveedor=ID$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_CONSULTAR_INVENTARIO_CODIGO` (IN `ID` INT)  SELECT * FROM Producto WHERE IdProducto=ID$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_CONSULTAR_INVENTARIO_FECHA_VENC` (IN `FECHAINI` DATE, IN `FECHAFIN` DATE)  SELECT * FROM Producto WHERE FechaVencimiento BETWEEN FECHAINI AND FECHAFIN$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_CONSULTAR_INVENTARIO_NOMBRE` (IN `NOMBRE` VARCHAR(45))  SELECT * FROM Producto WHERE Nombre=NOMBRE$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_CONSULTAR_INVENTARIO_PROVEEDOR` (IN `ID` INT)  SELECT * FROM Producto WHERE Proveedor_IdProveedor=ID$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_CONSULTAR_VENTA_CLIENTE` (IN `ID` INT)  SELECT * FROM Venta AS V INNER JOIN Producto_has_Venta AS PV ON V.IdVenta=PV.Venta_IdVenta WHERE V.Cliente_IdCliente=ID$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_CONSULTAR_VENTA_EMPLEADO` (IN `ID` INT)  SELECT * FROM Venta AS V INNER JOIN Producto_has_Venta AS PV ON V.IdVenta=PV.Venta_IdVenta WHERE V.Empleado_IdEmpleado=ID$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_CONSULTAR_VENTA_FACTURA` (IN `ID` INT)  SELECT * FROM Venta inner JOIN Producto_has_Venta ON Venta.IdVenta=Producto_has_Venta.Venta_IdVenta WHERE Venta.IdVenta=ID$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_CONSULTAR_VENTA_FECHA` (IN `FECHAVENTA` DATE)  SELECT * FROM Venta AS V INNER JOIN Producto_has_Venta AS PV ON V.IdVenta=PV.Venta_IdVenta WHERE V.FechaVenta=FECHAVENTA$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_CONSULTAR_VENTA_PRODUCTO` (IN `ID` INT)  SELECT * FROM Venta AS V INNER JOIN Producto_has_Venta AS PV ON V.IdVenta=PV.Venta_IdVenta WHERE PV.Producto_idProducto=ID$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_CREAR_ROL` (IN `ID` INT(11), IN `NOMBRE` VARCHAR(45))  INSERT INTO Cargo VALUES (ID,NOMBRE)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ELIMINAR_CLIENTE` (IN `ID` INT)  DELETE FROM Cliente WHERE IdCliente=ID$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ELIMINAR_EMPLEADO` (IN `ID` INT)  DELETE FROM Empleado WHERE IdEmpleado=ID$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ELIMINAR_MEDIO_PAGO` (IN `ID` INT)  DELETE FROM Tpago WHERE IdTpago=ID$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ELIMINAR_PRODUCTO` (IN `ID` INT)  DELETE FROM Producto WHERE IdProducto=ID$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ELIMINAR_PROVEEDOR` (IN `ID` INT)  DELETE FROM Proveedor WHERE IdProveedor=ID$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GENERAR_INFORME_INVENTARIOS` ()  SELECT * FROM Producto$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_CLIENTE` (IN `ID` INT, IN `NOMBRE` VARCHAR(100), IN `TELEFONO` VARCHAR(15), IN `DIRECCION` VARCHAR(45), IN `EMAIL` VARCHAR(45), IN `ESTADO` BOOLEAN)  INSERT INTO Cliente VALUES (ID,NOMBRE,TELEFONO,DIRECCION,EMAIL,ESTADO)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_EMPLEADO` (IN `ID` INT, IN `NOMBRE` VARCHAR(100), IN `TELEFONO` VARCHAR(15), IN `CARGO` INT, IN `CORREO` VARCHAR(45), IN `CONTRASEÑA` VARCHAR(45))  INSERT INTO Empleado VALUES (ID,NOMBRE,TELEFONO,CARGO,CORREO,md5(CONTRASEÑA))$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_MEDIO_PAGO` (IN `ID` INT, IN `DESCRIPCION` VARCHAR(45))  INSERT INTO Tpago VALUES (ID,DESCRIPCION)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_PRODUCTO` (IN `ID` INT, IN `PROVEEDOR` INT, IN `NOMBRE` VARCHAR(45), IN `EMPAQUE` VARCHAR(45), IN `PRECIOU` DECIMAL, IN `CANTIDAD` INT, IN `PRECIOV` DECIMAL, IN `FECHAVENC` DATE, IN `LOTE` VARCHAR(45), IN `IVA` INT)  INSERT INTO Producto VALUES (ID,PROVEEDOR,NOMBRE,EMPAQUE,PRECIOU,CANTIDAD,PRECIOV,FECHAVENC,LOTE,IVA)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_PRODUCTO_VENTA` (IN `IDVENTA` INT, IN `PRODUCTO` INT, IN `CANTIDAD` DECIMAL, IN `VALORU` DECIMAL, IN `IVA` DECIMAL, IN `TOTAL` DECIMAL)  INSERT INTO Producto_has_Venta VALUES (IDVENTA,PRODUCTO,CANTIDAD,VALORU,IVA,TOTAL)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_PROVEEDOR` (IN `ID` INT, IN `NOMBRE` VARCHAR(100), IN `TELEFONO` VARCHAR(45), IN `EMAIL` VARCHAR(45), IN `ESTADO` BOOLEAN)  INSERT INTO Proveedor VALUES(ID,NOMBRE,TELEFONO,EMAIL,ESTADO)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_REGISTRAR_VENTA` (IN `IDVENTA` INT, IN `CLIENTE` INT, IN `EMPLEADO` INT, IN `TPAGO` INT)  INSERT INTO Venta VALUES (IDVENTA,NOW(),CLIENTE,EMPLEADO,TPAGO)$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE `cargo` (
  `idCargo` int(11) NOT NULL,
  `Nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`idCargo`, `Nombre`) VALUES
(1, 'Administrador '),
(2, 'Vendedor'),
(3, 'Cajero');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `IdCategoria` int(11) NOT NULL,
  `NombreCategoria` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`IdCategoria`, `NombreCategoria`) VALUES
(1, 'Perecedero'),
(2, 'Productos de aseo'),
(3, 'Carnes'),
(4, 'Miselaneas'),
(5, 'No perecederos'),
(7, 'Papeleria'),
(8, 'Bebidas embriagantes'),
(10, 'lacteos y bebidas'),
(11, 'Cigarrillos y abarrotes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `IdCliente` int(11) NOT NULL,
  `Nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `Telefono` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `Direccion` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `Email` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `EstadoCliente` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`IdCliente`, `Nombre`, `Telefono`, `Direccion`, `Email`, `EstadoCliente`) VALUES
(678943, 'Milena Sandoval', '6789064', 'call 45 # 40-23 piso 2', 'milena@gmail.com', 1),
(3456712, 'Eduardo Santoniño', '2870077', 'carre34#43-23', 'elsantoniño@oucloock', 1),
(23456789, 'Jorge Suaza', '3215064878', 'apartamento zurich', 'jorge@zurich.com', 1),
(1023456789, 'Sandra Loaiza', '2345678', 'casa23surD', 'correodeprueba@gmail.com', 1),
(1152711725, 'Camila Ledesma Jimenez', '3205490294', 'Carre56Dsur-112', 'Camila@gmail.com', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `IdEmpleado` int(11) NOT NULL,
  `Nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `Telefono` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `Cargo_idCargo` int(11) NOT NULL,
  `Usuario` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `Contrasena` varchar(45) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`IdEmpleado`, `Nombre`, `Telefono`, `Cargo_idCargo`, `Usuario`, `Contrasena`) VALUES
(12382991, 'Emanual Loaiza', '98764521', 2, 'ema', '123'),
(23455766, 'Juan Pablo Sanchez', '23355767', 1, 'pablo', '123'),
(34680865, 'Elkin stiven Medoza', '23469942', 2, 'stiven', '123'),
(43814012, 'Estafania Raigoza', '6042870077', 3, 'Estefa', '123'),
(1214728606, 'Juan Camilo ', '3134457889', 1, 'juan', '123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `idProducto` int(11) NOT NULL,
  `Proveedor_IdProveedor` int(11) NOT NULL,
  `Nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `PrecioUnitario` decimal(10,2) NOT NULL,
  `CantSistema` int(11) NOT NULL,
  `ventasActuales` int(11) NOT NULL DEFAULT 0,
  `PrecioVenta` decimal(10,2) NOT NULL,
  `FechaVencimiento` date DEFAULT NULL,
  `NumeroLote` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `Categoria_IdCatedoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idProducto`, `Proveedor_IdProveedor`, `Nombre`, `PrecioUnitario`, `CantSistema`, `ventasActuales`, `PrecioVenta`, `FechaVencimiento`, `NumeroLote`, `Categoria_IdCatedoria`) VALUES
(12378, 345679, 'chocolate en barraX2Uni', '450.00', 71, 11, '535.50', '2012-12-12', '12345', 5),
(78907, 3450335, 'MayonesaX800gr', '890.00', 29, 6, '1246.00', '0000-00-00', '345678lL', 5),
(124794, 345679, 'NutellaX340gr', '3200.00', 7, 5, '4480.00', '2021-12-13', '21334AMX23', 4),
(245675, 567543, 'QuesitoX40gr', '3000.00', 4, 8, '4200.00', '2021-12-04', '23456LX3', 1),
(454679, 3450335, 'SalsaTomateX500gr', '700.00', 36, 0, '1000.00', '2022-04-25', '23454GB', 1),
(849545, 7890987, 'PapelHijienicoFamiliaXrollo', '3000.00', 36, 4, '4500.00', '2021-11-21', '2323ed', 2),
(3456788, 456713, 'Arroz Roax500gr', '2000.00', 91, 10, '2800.00', '2012-03-21', '2917831AR', 1),
(39465776, 456713, 'ArrozX5libras', '7800.00', 8, 5, '10920.00', '2022-03-12', 'FA34578', 1),
(56808985, 567543, 'Lecha enteraX900ml', '2000.00', 8, 7, '2800.00', '2021-12-23', '9087aM', 10),
(98234245, 923213, 'ChocolatinajetX250gr', '300.00', 46, 4, '500.00', '2022-03-12', '21334AMX23', 4),
(390455434, 987612, 'AceiteX1000ml', '1800.00', 15, 9, '2520.00', '2025-01-23', 'LK56789', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `IdProveedor` int(11) NOT NULL,
  `Nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `Telefono` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `EmailProveedor` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `EstadoProveedor` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`IdProveedor`, `Nombre`, `Telefono`, `EmailProveedor`, `EstadoProveedor`) VALUES
(345679, 'Nutresa', '2323545', 'atencionproveedor@chocolatesjet.com', 0),
(456713, 'Arrocera Colombiana', '01800067789', 'arroceracolombiana@une.com.co', 1),
(567543, 'Lacteos Montealegre SA', '2345678', 'lacteossur@hotmail.com', 1),
(923213, 'Chocolatinas jet', '2345679', 'choclatejet@gmail.com', 1),
(987612, 'Aceites Naturales de Colombia S.A.S', '3609847', 'aceitescolombia@gmail.com', 1),
(3450335, 'Salsa barry SA', '2345678', 'salasa@bary.com', 1),
(7890987, 'Productos Familia SAS', '34576876', 'lineae@grupofamilia.com', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tpago`
--

CREATE TABLE `tpago` (
  `idTpago` int(11) NOT NULL,
  `descripcion` varchar(45) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tpago`
--

INSERT INTO `tpago` (`idTpago`, `descripcion`) VALUES
(1, 'Efectivo'),
(2, 'Tárjeta Debito'),
(3, 'Tarjeta Credito'),
(4, 'Bonos Sodexo'),
(5, 'Bonos Éxito');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `id` int(11) NOT NULL,
  `codigoVenta` int(11) NOT NULL,
  `IdCliente` int(11) NOT NULL,
  `IdEmpleado` int(11) NOT NULL,
  `Productos` text COLLATE utf8_spanish_ci NOT NULL,
  `Impuesto` decimal(10,2) NOT NULL,
  `Neto` decimal(10,2) NOT NULL,
  `Total` decimal(10,2) NOT NULL,
  `MetodoPago` int(11) NOT NULL,
  `FechaCompra` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`id`, `codigoVenta`, `IdCliente`, `IdEmpleado`, `Productos`, `Impuesto`, `Neto`, `Total`, `MetodoPago`, `FechaCompra`) VALUES
(32, 3, 23456789, 1214728606, '[{\"idProducto\":\"390455434\",\"nombre\":\"AceiteX1000ml\",\"cantidad\":\"1\",\"stock\":\"18\",\"precio\":\"2520.00\",\"total\":\"2520\"},{\"idProducto\":\"98234245\",\"nombre\":\"ChocolatinajetX250gr\",\"cantidad\":\"1\",\"stock\":\"47\",\"precio\":\"500.00\",\"total\":\"500\"},{\"idProducto\":\"39465776\",\"nombre\":\"ArrozX5libras\",\"cantidad\":\"1\",\"stock\":\"10\",\"precio\":\"10920.00\",\"total\":\"10920\"},{\"idProducto\":\"3456788\",\"nombre\":\"Arroz Roax500gr\",\"cantidad\":\"1\",\"stock\":\"73\",\"precio\":\"2800.00\",\"total\":\"2800\"},{\"idProducto\":\"12378\",\"nombre\":\"chocolate en barraX2Uni\",\"cantidad\":\"1\",\"stock\":\"75\",\"precio\":\"535.50\",\"total\":\"535.5\"},{\"idProducto\":\"78907\",\"nombre\":\"MayonesaX800gr\",\"cantidad\":\"1\",\"stock\":\"31\",\"precio\":\"1246.00\",\"total\":\"1246\"},{\"idProducto\":\"124794\",\"nombre\":\"NutellaX340gr\",\"cantidad\":\"1\",\"stock\":\"9\",\"precio\":\"4480.00\",\"total\":\"4480.00\"}]', '4370.29', '23001.50', '27371.79', 1, '2021-10-01 00:12:57'),
(33, 4, 1023456789, 1214728606, '[{\"idProducto\":\"390455434\",\"nombre\":\"AceiteX1000ml\",\"cantidad\":\"1\",\"stock\":\"17\",\"precio\":\"2520.00\",\"total\":\"2520\"},{\"idProducto\":\"849545\",\"nombre\":\"PapelHijienicoFamiliaXrollo\",\"cantidad\":\"1\",\"stock\":\"37\",\"precio\":\"4500.00\",\"total\":\"4500\"},{\"idProducto\":\"3456788\",\"nombre\":\"Arroz Roax500gr\",\"cantidad\":\"1\",\"stock\":\"72\",\"precio\":\"2800.00\",\"total\":\"2800\"},{\"idProducto\":\"12378\",\"nombre\":\"chocolate en barraX2Uni\",\"cantidad\":\"1\",\"stock\":\"74\",\"precio\":\"535.50\",\"total\":\"535.50\"}]', '1967.55', '10355.50', '12323.05', 1, '2021-11-01 00:14:07'),
(34, 5, 3456712, 1214728606, '[{\"idProducto\":\"3456788\",\"nombre\":\"Arroz Roax500gr\",\"cantidad\":\"4\",\"stock\":\"68\",\"precio\":\"2800.00\",\"total\":\"11200\"},{\"idProducto\":\"245675\",\"nombre\":\"QuesitoX40gr\",\"cantidad\":\"4\",\"stock\":\"6\",\"precio\":\"4200.00\",\"total\":\"16800\"},{\"idProducto\":\"56808985\",\"nombre\":\"Lecha enteraX900ml\",\"cantidad\":\"3\",\"stock\":\"10\",\"precio\":\"2800.00\",\"total\":\"8400\"},{\"idProducto\":\"12378\",\"nombre\":\"chocolate en barraX2Uni\",\"cantidad\":\"4\",\"stock\":\"70\",\"precio\":\"535.50\",\"total\":\"2142\"}]', '7322.98', '38542.00', '45864.98', 1, '2021-11-26 00:15:24'),
(37, 6, 1023456789, 1214728606, '[{\"idProducto\":\"3456788\",\"nombre\":\"Arroz Roax500gr\",\"cantidad\":\"1\",\"stock\":\"92\",\"precio\":\"2800.00\",\"total\":\"2800\"},{\"idProducto\":\"39465776\",\"nombre\":\"ArrozX5libras\",\"cantidad\":\"1\",\"stock\":\"9\",\"precio\":\"10920.00\",\"total\":\"10920\"},{\"idProducto\":\"78907\",\"nombre\":\"MayonesaX800gr\",\"cantidad\":\"1\",\"stock\":\"30\",\"precio\":\"1246.00\",\"total\":\"1246\"},{\"idProducto\":\"124794\",\"nombre\":\"NutellaX340gr\",\"cantidad\":\"1\",\"stock\":\"7\",\"precio\":\"4480.00\",\"total\":\"4480\"},{\"idProducto\":\"245675\",\"nombre\":\"QuesitoX40gr\",\"cantidad\":\"1\",\"stock\":\"5\",\"precio\":\"4200.00\",\"total\":\"4200\"},{\"idProducto\":\"390455434\",\"nombre\":\"AceiteX1000ml\",\"cantidad\":\"1\",\"stock\":\"18\",\"precio\":\"2520.00\",\"total\":\"2520.00\"}]', '4971.54', '26166.00', '31137.54', 1, '2021-11-27 00:24:04'),
(38, 7, 678943, 23455766, '[{\"idProducto\":\"98234245\",\"nombre\":\"ChocolatinajetX250gr\",\"cantidad\":\"1\",\"stock\":\"46\",\"precio\":\"500.00\",\"total\":\"500\"},{\"idProducto\":\"39465776\",\"nombre\":\"ArrozX5libras\",\"cantidad\":\"1\",\"stock\":\"8\",\"precio\":\"10920.00\",\"total\":\"10920\"}]', '2169.80', '11420.00', '13589.80', 1, '2021-11-28 01:00:39'),
(39, 8, 678943, 23455766, '[{\"idProducto\":\"12378\",\"nombre\":\"chocolate en barraX2Uni\",\"cantidad\":\"1\",\"stock\":\"72\",\"precio\":\"535.50\",\"total\":\"535.50\"}]', '101.75', '535.50', '637.25', 1, '2021-11-02 01:01:06'),
(40, 9, 3456712, 23455766, '[{\"idProducto\":\"390455434\",\"nombre\":\"AceiteX1000ml\",\"cantidad\":\"1\",\"stock\":\"17\",\"precio\":\"2520.00\",\"total\":\"2520.00\"}]', '478.80', '2520.00', '2998.80', 1, '2021-11-29 01:01:30'),
(41, 10, 1152711725, 23455766, '[{\"idProducto\":\"390455434\",\"nombre\":\"AceiteX1000ml\",\"cantidad\":\"1\",\"stock\":\"16\",\"precio\":\"2520.00\",\"total\":\"2520\"},{\"idProducto\":\"56808985\",\"nombre\":\"Lecha enteraX900ml\",\"cantidad\":\"1\",\"stock\":\"8\",\"precio\":\"2800.00\",\"total\":\"2800\"},{\"idProducto\":\"3456788\",\"nombre\":\"Arroz Roax500gr\",\"cantidad\":\"1\",\"stock\":\"91\",\"precio\":\"2800.00\",\"total\":\"2800\"},{\"idProducto\":\"245675\",\"nombre\":\"QuesitoX40gr\",\"cantidad\":\"1\",\"stock\":\"4\",\"precio\":\"4200.00\",\"total\":\"4200.00\"}]', '2340.80', '12320.00', '14660.80', 1, '2021-11-30 01:02:09'),
(42, 11, 1023456789, 23455766, '[{\"idProducto\":\"12378\",\"nombre\":\"chocolate en barraX2Uni\",\"cantidad\":\"1\",\"stock\":\"71\",\"precio\":\"535.50\",\"total\":\"535.5\"},{\"idProducto\":\"78907\",\"nombre\":\"MayonesaX800gr\",\"cantidad\":\"1\",\"stock\":\"29\",\"precio\":\"1246.00\",\"total\":\"1246\"},{\"idProducto\":\"124794\",\"nombre\":\"NutellaX340gr\",\"cantidad\":\"1\",\"stock\":\"6\",\"precio\":\"4480.00\",\"total\":\"4480\"},{\"idProducto\":\"245675\",\"nombre\":\"QuesitoX40gr\",\"cantidad\":\"1\",\"stock\":\"3\",\"precio\":\"4200.00\",\"total\":\"4200\"},{\"idProducto\":\"849545\",\"nombre\":\"PapelHijienicoFamiliaXrollo\",\"cantidad\":\"1\",\"stock\":\"36\",\"precio\":\"4500.00\",\"total\":\"4500\"},{\"idProducto\":\"3456788\",\"nombre\":\"Arroz Roax500gr\",\"cantidad\":\"1\",\"stock\":\"90\",\"precio\":\"2800.00\",\"total\":\"2800\"},{\"idProducto\":\"56808985\",\"nombre\":\"Lecha enteraX900ml\",\"cantidad\":\"1\",\"stock\":\"7\",\"precio\":\"2800.00\",\"total\":\"2800\"},{\"idProducto\":\"39465776\",\"nombre\":\"ArrozX5libras\",\"cantidad\":\"1\",\"stock\":\"7\",\"precio\":\"10920.00\",\"total\":\"10920\"},{\"idProducto\":\"98234245\",\"nombre\":\"ChocolatinajetX250gr\",\"cantidad\":\"1\",\"stock\":\"45\",\"precio\":\"500.00\",\"total\":\"500\"},{\"idProducto\":\"390455434\",\"nombre\":\"AceiteX1000ml\",\"cantidad\":\"1\",\"stock\":\"15\",\"precio\":\"2520.00\",\"total\":\"2520.00\"}]', '6555.29', '34501.50', '41056.79', 1, '2021-12-01 01:03:03'),
(43, 12, 3456712, 23455766, '[{\"idProducto\":\"12378\",\"nombre\":\"chocolate en barraX2Uni\",\"cantidad\":\"1\",\"stock\":\"70\",\"precio\":\"535.50\",\"total\":\"535.5\"},{\"idProducto\":\"78907\",\"nombre\":\"MayonesaX800gr\",\"cantidad\":\"1\",\"stock\":\"28\",\"precio\":\"1246.00\",\"total\":\"1246\"},{\"idProducto\":\"849545\",\"nombre\":\"PapelHijienicoFamiliaXrollo\",\"cantidad\":\"1\",\"stock\":\"35\",\"precio\":\"4500.00\",\"total\":\"4500\"},{\"idProducto\":\"390455434\",\"nombre\":\"AceiteX1000ml\",\"cantidad\":\"1\",\"stock\":\"14\",\"precio\":\"2520.00\",\"total\":\"2520.00\"}]', '1672.29', '8801.50', '10473.79', 1, '2021-12-02 01:03:25');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`idCargo`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`IdCategoria`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`IdCliente`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`IdEmpleado`) USING BTREE,
  ADD UNIQUE KEY `Usuario` (`Usuario`),
  ADD KEY `fk_Empleado_Cargo1` (`Cargo_idCargo`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idProducto`,`Proveedor_IdProveedor`),
  ADD KEY `fk_Producto_Proveedor1_idx` (`Proveedor_IdProveedor`),
  ADD KEY `fk_categoria_producto` (`Categoria_IdCatedoria`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`IdProveedor`);

--
-- Indices de la tabla `tpago`
--
ALTER TABLE `tpago`
  ADD PRIMARY KEY (`idTpago`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigoVenta` (`codigoVenta`),
  ADD KEY `fk_Cliente_Venta` (`IdCliente`),
  ADD KEY `fk_Empleado_venta` (`IdEmpleado`),
  ADD KEY `fk_Tpago_Venta` (`MetodoPago`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `IdCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `fk_Empleado_Cargo1` FOREIGN KEY (`Cargo_idCargo`) REFERENCES `cargo` (`idCargo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `fk_Producto_Proveedor1` FOREIGN KEY (`Proveedor_IdProveedor`) REFERENCES `proveedor` (`IdProveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_categoria_producto` FOREIGN KEY (`Categoria_IdCatedoria`) REFERENCES `categoria` (`IdCategoria`);

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `fk_Cliente_Venta` FOREIGN KEY (`IdCliente`) REFERENCES `cliente` (`IdCliente`),
  ADD CONSTRAINT `fk_Empleado_venta` FOREIGN KEY (`IdEmpleado`) REFERENCES `empleado` (`IdEmpleado`),
  ADD CONSTRAINT `fk_Tpago_Venta` FOREIGN KEY (`MetodoPago`) REFERENCES `tpago` (`idTpago`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

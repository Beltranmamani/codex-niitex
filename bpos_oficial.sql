-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-09-2024 a las 10:46:47
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bpos_git_oficial_7precios`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ajuste_inventario`
--

CREATE TABLE `ajuste_inventario` (
  `ID_AJUSTE` varchar(20) NOT NULL,
  `ID_SUCURSAL` varchar(20) DEFAULT NULL,
  `FECHA_REGISTRO` datetime DEFAULT NULL,
  `ID_USUARIO` varchar(20) DEFAULT NULL,
  `MOTIVO` longtext DEFAULT NULL
) ;

--
-- Volcado de datos para la tabla `ajuste_inventario`
--

INSERT INTO `ajuste_inventario` (`ID_AJUSTE`, `ID_SUCURSAL`, `FECHA_REGISTRO`, `ID_USUARIO`, `MOTIVO`) VALUES
('1', '4', '2024-08-20 23:58:19', 'ADMIN01', 'gfg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacen`
--

CREATE TABLE `almacen` (
  `ID_ALMACEN` varchar(20) NOT NULL,
  `NOMBRE` varchar(50) NOT NULL,
  `DIRECCION` varchar(100) NOT NULL,
  `ID_SUCURSAL` varchar(20) NOT NULL,
  `ESTADO` int(1) DEFAULT NULL
) ;

--
-- Volcado de datos para la tabla `almacen`
--

INSERT INTO `almacen` (`ID_ALMACEN`, `NOMBRE`, `DIRECCION`, `ID_SUCURSAL`, `ESTADO`) VALUES
('4', '1', '1', '4', 1),
('ALMACEN2551674', 'ALMACEN BOLIVIA', '', 'SUCURSAL9403882', 1),
('ALMACEN3325123', 'ALMACEN PRINCIPAL', 'SN', 'SUCURSAL2206381', 1),
('ALMACEN3660342', 'ALMACEN BOLIVIA', '', 'SUCURSAL1428567', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `arqueocaja`
--

CREATE TABLE `arqueocaja` (
  `ID_ARQUEO` varchar(20) NOT NULL,
  `ID_CAJA` varchar(20) NOT NULL,
  `MONTOINICIAL` decimal(40,2) NOT NULL,
  `INGRESOS` decimal(40,2) NOT NULL,
  `EGRESOS` decimal(40,2) NOT NULL,
  `CREDITOS` decimal(40,2) NOT NULL,
  `ABONOS` decimal(40,2) NOT NULL,
  `DINEROEFECTIVO` decimal(40,2) NOT NULL,
  `DIFERENCIA` decimal(40,2) NOT NULL,
  `COMENTARIOS` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `FECHAAPERTURA` datetime NOT NULL,
  `FECHACIERRE` datetime DEFAULT NULL,
  `STATUSARQUEO` int(2) NOT NULL
) ;

--
-- Volcado de datos para la tabla `arqueocaja`
--

INSERT INTO `arqueocaja` (`ID_ARQUEO`, `ID_CAJA`, `MONTOINICIAL`, `INGRESOS`, `EGRESOS`, `CREDITOS`, `ABONOS`, `DINEROEFECTIVO`, `DIFERENCIA`, `COMENTARIOS`, `FECHAAPERTURA`, `FECHACIERRE`, `STATUSARQUEO`) VALUES
('1', '1', '100.00', '250.00', '0.00', '0.00', '0.00', '350.00', '0.00', '', '2023-10-21 23:39:48', '2023-10-22 00:13:05', 0),
('2', '1', '100.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', '2023-10-22 00:18:46', '0000-00-00 00:00:00', 1),
('3', '2', '10.00', '0.00', '0.00', '0.00', '0.00', '100.00', '100.00', '', '2023-11-02 12:15:09', '2023-11-02 14:43:02', 0),
('4', '2', '10.00', '0.00', '0.00', '0.00', '0.00', '10.00', '0.00', '', '2023-11-02 14:43:29', '2023-11-02 22:46:59', 0),
('5', '2', '100.00', '1719.30', '0.00', '0.00', '89.90', '0.00', '0.00', '', '2023-11-02 22:47:03', '0000-00-00 00:00:00', 1),
('6', '3', '100.00', '23351.00', '0.00', '0.00', '0.00', '23451.00', '0.00', '', '2024-06-12 04:54:00', '2024-08-11 00:39:11', 0),
('7', '3', '0.00', '6353.00', '0.00', '0.00', '0.00', '6353.00', '0.00', '', '2024-08-11 00:43:14', '2024-08-12 17:15:28', 0),
('8', '3', '0.00', '10578.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', '2024-08-12 17:15:31', '0000-00-00 00:00:00', 1),
('9', '4', '100.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '', '2024-08-14 20:58:40', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora`
--

CREATE TABLE `bitacora` (
  `ID_BITACORA` varchar(20) NOT NULL,
  `ID_USUARIO` varchar(20) NOT NULL,
  `ID_SUCURSAL` varchar(20) NOT NULL,
  `FECHA` datetime DEFAULT NULL,
  `IP_PC` varchar(100) DEFAULT NULL,
  `NAVEGADOR` varchar(100) DEFAULT NULL
) ;

--
-- Volcado de datos para la tabla `bitacora`
--

INSERT INTO `bitacora` (`ID_BITACORA`, `ID_USUARIO`, `ID_SUCURSAL`, `FECHA`, `IP_PC`, `NAVEGADOR`) VALUES
('28', 'ADMIN01', '4', '2023-10-20 18:18:31', '::1', 'Opera'),
('29', 'ADMIN01', '4', '2023-10-21 22:26:53', '::1', 'Opera'),
('30', 'ADMIN01', 'SUCURSAL1428567', '2023-10-21 22:27:00', '::1', 'Opera'),
('31', 'USUARIO4785330399', 'SUCURSAL1428567', '2023-10-21 23:16:24', '::1', 'Opera'),
('32', 'USUARIO4785330399', 'SUCURSAL1428567', '2023-10-21 23:29:12', '::1', 'Opera'),
('33', 'ADMIN01', '4', '2023-10-22 20:09:07', '::1', 'Opera'),
('34', 'ADMIN01', 'SUCURSAL1428567', '2023-10-22 22:19:44', '::1', 'Opera'),
('35', 'ADMIN01', 'SUCURSAL1428567', '2023-11-02 12:14:31', '::1', 'Opera'),
('36', 'ADMIN01', 'SUCURSAL1428567', '2023-11-02 14:37:19', '::1', 'Opera'),
('37', 'ADMIN01', 'SUCURSAL1428567', '2023-11-02 14:43:12', '::1', 'Opera'),
('38', 'ADMIN01', '4', '2024-06-12 01:44:39', '127.0.0.1', 'Opera'),
('39', 'ADMIN01', '4', '2024-06-12 06:20:34', '127.0.0.1', 'Opera'),
('40', 'ADMIN01', '4', '2024-06-13 11:22:47', '127.0.0.1', 'Opera'),
('41', 'ADMIN01', '4', '2024-08-08 20:11:29', '::1', 'Opera'),
('42', 'ADMIN01', '4', '2024-08-11 02:28:52', '::1', 'Google Chrome'),
('43', 'ADMIN01', '4', '2024-08-12 16:24:18', '::1', 'Opera'),
('44', 'ADMIN01', '4', '2024-08-13 20:36:49', '::1', 'Opera'),
('45', 'ADMIN01', '4', '2024-08-14 20:44:26', '::1', 'Opera'),
('46', 'USUARIO8526052992', '4', '2024-08-14 20:49:57', '::1', 'Opera'),
('47', 'ADMIN01', '4', '2024-08-14 23:22:34', '::1', 'Opera'),
('48', 'ADMIN01', '4', '2024-08-19 22:59:13', '::1', 'Opera'),
('49', 'ADMIN01', '4', '2024-08-31 15:54:07', '::1', 'Opera'),
('50', 'ADMIN01', 'SUCURSAL1428567', '2024-08-31 15:57:31', '::1', 'Opera'),
('51', 'ADMIN01', '4', '2024-09-04 06:14:14', '::1', 'Opera'),
('52', 'ADMIN01', '4', '2024-09-04 07:09:42', '::1', 'Opera'),
('53', 'ADMIN01', 'SUCURSAL1428567', '2024-09-04 07:44:46', '::1', 'Opera'),
('54', 'ADMIN01', '4', '2024-09-04 07:50:23', '::1', 'Opera'),
('55', 'ADMIN01', '4', '2024-09-18 03:30:30', '::1', 'Opera'),
('BITA03287212', 'ADMIN01', 'SUCURSAL1428567', '2023-08-03 20:14:50', '177.222.115.102', 'Google Chrome'),
('BITA03513614', 'ADMIN01', 'SUCURSAL1428567', '2023-09-18 12:11:46', '::1', 'Opera'),
('BITA0394185', 'USUARIO4785330399', 'SUCURSAL2206381', '2023-02-22 11:31:58', '186.121.194.144', 'Google Chrome'),
('BITA0721563', 'USUARIO4785330399', 'SUCURSAL1428567', '2023-02-06 17:44:03', '186.121.194.249', 'Google Chrome'),
('BITA14710126', 'ADMIN01', 'SUCURSAL2206381', '2023-10-19 14:22:06', '::1', 'Opera'),
('BITA1901402', 'USUARIO4785330399', 'SUCURSAL1428567', '2023-02-06 16:50:12', '186.121.194.249', 'Google Chrome'),
('BITA19289915', 'ADMIN01', 'SUCURSAL1428567', '2023-09-18 13:42:47', '::1', 'Opera'),
('BITA21459019', 'ADMIN01', 'SUCURSAL1428567', '2023-09-23 12:07:31', '::1', 'Opera'),
('BITA24516711', 'ADMIN01', 'SUCURSAL1428567', '2023-08-03 20:14:11', '177.222.115.102', 'Google Chrome'),
('BITA24582323', 'ADMIN01', 'SUCURSAL1428567', '2023-10-06 10:18:29', '::1', 'Opera'),
('BITA35673213', 'ADMIN01', 'SUCURSAL2206381', '2023-09-18 12:11:20', '::1', 'Opera'),
('BITA37468222', 'ADMIN01', 'SUCURSAL1428567', '2023-10-05 17:44:33', '::1', 'Opera'),
('BITA37534110', 'USUARIO4785330399', 'SUCURSAL1428567', '2023-02-25 18:02:32', '186.121.194.8', 'Safari'),
('BITA3855288', 'USUARIO4785330399', 'SUCURSAL1428567', '2023-02-23 10:56:36', '186.121.194.33', 'Google Chrome'),
('BITA40445925', 'ADMIN01', 'SUCURSAL1428567', '2023-10-13 12:49:22', '::1', 'Opera'),
('BITA44484024', 'ADMIN01', 'SUCURSAL1428567', '2023-10-07 22:37:30', '::1', 'Opera'),
('BITA47474221', 'ADMIN01', 'SUCURSAL1428567', '2023-09-25 22:19:52', '::1', 'Opera'),
('BITA4954070', 'ADMIN01', 'SUCURSAL1428567', '2023-02-06 14:30:11', '181.114.127.233', 'Google Chrome'),
('BITA5210117', 'USUARIO4785330399', 'SUCURSAL1428567', '2023-02-22 11:35:51', '186.121.194.144', 'Google Chrome'),
('BITA5578631', 'USUARIO4785330399', 'SUCURSAL1428567', '2023-02-06 16:07:40', '186.121.194.249', 'Google Chrome'),
('BITA58631820', 'ADMIN01', 'SUCURSAL1428567', '2023-09-25 18:41:57', '::1', 'Opera'),
('BITA5939924', 'USUARIO4785330399', 'SUCURSAL1428567', '2023-02-22 10:34:59', '186.121.194.144', 'Google Chrome'),
('BITA80790816', 'ADMIN01', 'SUCURSAL1428567', '2023-09-19 11:37:13', '::1', 'Opera'),
('BITA90846917', 'ADMIN01', 'SUCURSAL1428567', '2023-09-22 09:06:05', '::1', 'Opera'),
('BITA91182018', 'ADMIN01', 'SUCURSAL1428567', '2023-09-22 11:01:22', '::1', 'Opera'),
('BITA9302929', 'USUARIO4785330399', 'SUCURSAL1428567', '2023-02-25 16:21:24', '186.121.194.8', 'Google Chrome'),
('BITA9920236', 'USUARIO4785330399', 'SUCURSAL2206381', '2023-02-22 11:32:20', '186.121.194.144', 'Google Chrome');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja`
--

CREATE TABLE `caja` (
  `ID_CAJA` varchar(20) NOT NULL,
  `ID_USUARIO` varchar(20) DEFAULT NULL,
  `NRO_CAJA` varchar(20) DEFAULT NULL,
  `NOMBRE_CAJA` text DEFAULT NULL,
  `ID_SUCURSAL` varchar(20) DEFAULT NULL
) ;

--
-- Volcado de datos para la tabla `caja`
--

INSERT INTO `caja` (`ID_CAJA`, `ID_USUARIO`, `NRO_CAJA`, `NOMBRE_CAJA`, `ID_SUCURSAL`) VALUES
('1', 'USUARIO4785330399', '1', '1', 'SUCURSAL1428567'),
('2', 'ADMIN01', '2', 'CAJA PRINCIPAL', 'SUCURSAL1428567'),
('3', 'ADMIN01', '1', 'CAJA PRINCIPAL', '4'),
('4', 'USUARIO8526052992', '2', '2', '4');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chat`
--

CREATE TABLE `chat` (
  `ID_MENSAJE` varchar(20) NOT NULL,
  `ID_ME` varchar(20) DEFAULT NULL,
  `ID_YOU` varchar(20) DEFAULT NULL,
  `FECHA_REGISTRO` datetime DEFAULT NULL,
  `MENSAJE` longtext DEFAULT NULL
) ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `ID_CLIENTE` varchar(20) NOT NULL,
  `RAZON` varchar(100) NOT NULL,
  `TIPO_DOCUMENTO` varchar(20) NOT NULL,
  `N_DOCUMENTO` varchar(20) NOT NULL,
  `LIMITE_CREDITICIO` double(40,2) DEFAULT NULL,
  `N_CREDITO` int(11) DEFAULT NULL,
  `DIRECCION` varchar(100) DEFAULT NULL,
  `TELEFONO` varchar(20) DEFAULT NULL,
  `CORREO` varchar(100) DEFAULT NULL,
  `ESTADO` int(11) DEFAULT NULL,
  `NOMBRE` text DEFAULT NULL
) ;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`ID_CLIENTE`, `RAZON`, `TIPO_DOCUMENTO`, `N_DOCUMENTO`, `LIMITE_CREDITICIO`, `N_CREDITO`, `DIRECCION`, `TELEFONO`, `CORREO`, `ESTADO`, `NOMBRE`) VALUES
('1', 'JOSE BLANCO 3', 'DOCUMENTO2696581', '1032032', 1000.00, 1, '00.', '00', '00', 1, 'ENRIQUE MONTEJO'),
('2', 'JHONATAN', 'DOCUMENTO2696581', '154165', 120.00, 1, '---', '1221', 'jhonycreativo.code@gmail.com', 1, 'JHONATAN');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cobros_credito`
--

CREATE TABLE `cobros_credito` (
  `ID_COBRO` varchar(20) NOT NULL,
  `ID_CREDITO` varchar(20) DEFAULT NULL,
  `ID_CAJA` varchar(20) DEFAULT NULL,
  `ID_USUARIO` varchar(20) DEFAULT NULL,
  `ID_SUCURSAL` varchar(20) DEFAULT NULL,
  `MONTO` decimal(40,2) DEFAULT NULL,
  `PAGO_CON` decimal(40,2) DEFAULT NULL,
  `CAMBIO` decimal(40,2) DEFAULT NULL,
  `FECHA_REGISTRO` datetime DEFAULT NULL,
  `ESTADO` int(11) DEFAULT NULL,
  `PENDIENTE_AC` decimal(40,2) NOT NULL
) ;

--
-- Volcado de datos para la tabla `cobros_credito`
--

INSERT INTO `cobros_credito` (`ID_COBRO`, `ID_CREDITO`, `ID_CAJA`, `ID_USUARIO`, `ID_SUCURSAL`, `MONTO`, `PAGO_CON`, `CAMBIO`, `FECHA_REGISTRO`, `ESTADO`, `PENDIENTE_AC`) VALUES
('1', '1', '5', 'ADMIN01', 'SUCURSAL1428567', '53.00', '100.00', '47.00', '2023-11-03 22:26:34', 1, '0.00'),
('15', '4', '5', 'ADMIN01', 'SUCURSAL1428567', '10.00', '100.00', '90.00', '2023-11-03 22:47:34', 1, '11.20'),
('16', '4', '5', 'ADMIN01', 'SUCURSAL1428567', '11.00', '50.00', '39.00', '2023-11-03 22:47:49', 1, '0.20'),
('COBRO0054500', 'CREDITO140659812', 'AREQUEO49941', 'ADMIN01', 'SUCURSAL1428567', '230.00', '500.00', '270.00', '2023-09-22 09:15:52', 1, '0.00'),
('COBRO0956360', 'CREDITO542751810', 'AREQUEO20470', 'USUARIO4785330399', 'SUCURSAL1428567', '8120.00', '8120.00', '0.00', '2023-02-25 17:44:26', 1, '0.00'),
('COBRO1405400', 'CREDITO76396449', 'AREQUEO20470', 'USUARIO4785330399', 'SUCURSAL1428567', '7550.00', '7550.00', '0.00', '2023-02-25 17:43:28', 1, '0.00'),
('COBRO1416450', 'CREDITO53669762', 'AREQUEO20470', 'USUARIO4785330399', 'SUCURSAL1428567', '49150.00', '49150.00', '0.00', '2023-02-25 17:27:36', 1, '0.00'),
('COBRO2769650', 'CREDITO83092003', 'AREQUEO20470', 'USUARIO4785330399', 'SUCURSAL1428567', '7550.00', '7550.00', '0.00', '2023-02-25 16:43:34', 1, '0.00'),
('COBRO2918890', 'CREDITO67694934', 'AREQUEO20470', 'USUARIO4785330399', 'SUCURSAL1428567', '8120.00', '8120.00', '0.00', '2023-02-25 16:45:06', 1, '0.00'),
('COBRO3108840', 'CREDITO395107613', 'AREQUEO49941', 'ADMIN01', 'SUCURSAL1428567', '214.00', '230.00', '16.00', '2023-10-06 11:27:12', 1, '0.00'),
('COBRO4183350', 'CREDITO507313411', 'AREQUEO20470', 'USUARIO4785330399', 'SUCURSAL1428567', '46830.00', '46830.00', '0.00', '2023-02-25 17:46:09', 1, '57270.00'),
('COBRO5023930', 'CREDITO30957335', 'AREQUEO20470', 'USUARIO4785330399', 'SUCURSAL1428567', '57270.00', '57270.00', '0.00', '2023-02-25 17:11:36', 1, '0.00'),
('COBRO6107210', 'CREDITO40108230', 'AREQUEO20470', 'USUARIO4785330399', 'SUCURSAL1428567', '7550.00', '7550.00', '0.00', '2023-02-25 16:32:04', 1, '0.00'),
('COBRO6837570', 'CREDITO54826741', 'AREQUEO20470', 'USUARIO4785330399', 'SUCURSAL1428567', '8120.00', '8120.00', '0.00', '2023-02-25 17:26:55', 1, '0.00'),
('COBRO7214220', 'CREDITO30957335', 'AREQUEO20470', 'USUARIO4785330399', 'SUCURSAL1428567', '46830.00', '46830.00', '0.00', '2023-02-25 16:46:19', 1, '57270.00'),
('COBRO8659760', 'CREDITO53669762', 'AREQUEO20470', 'USUARIO4785330399', 'SUCURSAL1428567', '54950.00', '54950.00', '0.00', '2023-02-25 16:34:16', 1, '49150.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `ID_COMPRA` varchar(20) NOT NULL,
  `FECHA_COMPRA` datetime NOT NULL,
  `ID_PROVEEDOR` varchar(20) NOT NULL,
  `ID_ALMACEN` varchar(20) NOT NULL,
  `TIPO_PAGO` varchar(11) NOT NULL,
  `ID_COMPROBANTE` varchar(20) NOT NULL,
  `N_COMPROBANTE` varchar(60) DEFAULT NULL,
  `FECHA_COMPROBANTE` date DEFAULT NULL,
  `SUMAS` decimal(40,2) DEFAULT NULL,
  `IVA` decimal(40,2) DEFAULT NULL,
  `SUBTOTAL` decimal(40,2) NOT NULL,
  `EXENTO` decimal(40,2) DEFAULT NULL,
  `RETENIDO` decimal(40,2) DEFAULT NULL,
  `TOTAL_EXENTOS` int(11) DEFAULT NULL,
  `TOTAL` decimal(40,2) DEFAULT NULL,
  `ID_USUARIO` varchar(20) NOT NULL,
  `ID_LOTE` varchar(20) NOT NULL,
  `ESTADO` int(11) DEFAULT NULL,
  `N_COMPRA` varchar(20) NOT NULL,
  `ID_ARQUEO` varchar(20) NOT NULL
) ;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`ID_COMPRA`, `FECHA_COMPRA`, `ID_PROVEEDOR`, `ID_ALMACEN`, `TIPO_PAGO`, `ID_COMPROBANTE`, `N_COMPROBANTE`, `FECHA_COMPROBANTE`, `SUMAS`, `IVA`, `SUBTOTAL`, `EXENTO`, `RETENIDO`, `TOTAL_EXENTOS`, `TOTAL`, `ID_USUARIO`, `ID_LOTE`, `ESTADO`, `N_COMPRA`, `ID_ARQUEO`) VALUES
('1', '2024-08-20 02:46:18', '1', '4', '1', 'COMPRO2437293', '10', '2024-08-19', '0.00', '0.00', '0.00', '4.00', '0.00', 1, '4.00', 'ADMIN01', '4', 1, '1', '8');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comprobante`
--

CREATE TABLE `comprobante` (
  `ID_COMPROBANTE` varchar(20) NOT NULL,
  `COMPROBANTE` varchar(50) NOT NULL,
  `ESTADO` int(11) DEFAULT NULL
) ;

--
-- Volcado de datos para la tabla `comprobante`
--

INSERT INTO `comprobante` (`ID_COMPROBANTE`, `COMPROBANTE`, `ESTADO`) VALUES
('COMPRO2437293', 'FACTURA', 1),
('COMPRO4259314', 'NOTA DE VENTA', 1),
('COMPRO4550132', 'NOTA DE REMISION', 1),
('COMPRO5907071', 'TICKET', 1),
('COMPRO6436800', 'BOLETA', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizacion`
--

CREATE TABLE `cotizacion` (
  `ID_COTIZACION` varchar(20) NOT NULL,
  `CODIGO_COTIZACION` varchar(20) NOT NULL,
  `FECHA` datetime DEFAULT NULL,
  `TIPO_PAGO` int(11) DEFAULT NULL,
  `TIPO_ENTREGA` int(11) DEFAULT NULL,
  `SUMAS` decimal(40,2) DEFAULT NULL,
  `IVA` decimal(40,2) DEFAULT NULL,
  `EXENTO` decimal(40,2) DEFAULT NULL,
  `SUBTOTAL` decimal(40,2) DEFAULT NULL,
  `RETENIDO` decimal(40,2) DEFAULT NULL,
  `DESCUENTO` decimal(40,2) DEFAULT NULL,
  `DESCUENTO_PERCENT` varchar(20) DEFAULT NULL,
  `TOTAL` decimal(40,2) DEFAULT NULL,
  `PROD_EXENTOS` int(1) DEFAULT NULL,
  `ESTADO` int(1) DEFAULT NULL,
  `ID_CLIENTE` varchar(20) DEFAULT NULL,
  `ID_USUARIO` varchar(20) DEFAULT NULL,
  `ID_SUCURSAL` varchar(20) DEFAULT NULL,
  `PRECIO_RADIO` int(11) NOT NULL,
  `NRO_FACTURA` text DEFAULT NULL,
  `NOMBRE_PROMOTOR` text DEFAULT NULL
) ;

--
-- Volcado de datos para la tabla `cotizacion`
--

INSERT INTO `cotizacion` (`ID_COTIZACION`, `CODIGO_COTIZACION`, `FECHA`, `TIPO_PAGO`, `TIPO_ENTREGA`, `SUMAS`, `IVA`, `EXENTO`, `SUBTOTAL`, `RETENIDO`, `DESCUENTO`, `DESCUENTO_PERCENT`, `TOTAL`, `PROD_EXENTOS`, `ESTADO`, `ID_CLIENTE`, `ID_USUARIO`, `ID_SUCURSAL`, `PRECIO_RADIO`, `NRO_FACTURA`, `NOMBRE_PROMOTOR`) VALUES
('1', '1', '2023-10-21 23:56:57', 1, 1, '0.00', '0.00', '3400.00', '0.00', '0.00', '0.00', '0', '3400.00', 1, 1, '1', 'USUARIO4785330399', 'SUCURSAL1428567', 4, '1', 'SIN DATO'),
('2', '2', '2023-10-22 00:03:57', 1, 1, '0.00', '0.00', '17000.00', '0.00', '0.00', '0.00', '0', '17000.00', 1, 1, '2', 'USUARIO4785330399', 'SUCURSAL1428567', 4, '1', 'SIN DATO'),
('3', '3', '2023-11-02 12:18:35', 1, 1, '0.00', '0.00', '3400.00', '0.00', '0.00', '0.00', '0', '3400.00', 1, 1, '2', 'ADMIN01', 'SUCURSAL1428567', 4, '1', 'SIN DATO'),
('4', '4', '2023-11-02 22:59:37', 1, 1, '0.00', '0.00', '1700.00', '0.00', '0.00', '0.00', '0', '1700.00', 1, 2, '1', 'ADMIN01', 'SUCURSAL1428567', 4, '1', 'SIN DATO'),
('5', '1', '2024-08-20 03:50:37', 1, 1, '0.00', '0.00', '12.02', '0.00', '0.00', '0.00', '0.00', '12.02', 2, 2, '1', 'ADMIN01', '4', 7, '1', 'SIN DATO'),
('6', '2', '2024-08-20 21:12:02', 1, 1, '0.00', '0.00', '7.00', '0.00', '0.00', '0.00', '0', '7.00', 1, 1, '2', 'ADMIN01', '4', 7, '1', 'SIN DATO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `credito`
--

CREATE TABLE `credito` (
  `ID_CREDITO` varchar(20) NOT NULL,
  `ID_VENTA` varchar(20) DEFAULT NULL,
  `ID_SUCURSAL` varchar(20) DEFAULT NULL,
  `ID_CLIENTE` varchar(20) DEFAULT NULL,
  `ID_USUARIO` varchar(20) NOT NULL,
  `CODIGO_CREDITO` varchar(20) NOT NULL,
  `NOMBRE_CREDITO` varchar(100) DEFAULT NULL,
  `FECHA_CREDITO` datetime DEFAULT NULL,
  `FECHA_LIMITE` date DEFAULT NULL,
  `MONTO_CREDITO` decimal(40,2) DEFAULT NULL,
  `MONTO_ABONADO` decimal(40,2) DEFAULT NULL,
  `MONTO_RESTANTE` decimal(40,2) DEFAULT NULL,
  `ESTADO` int(1) DEFAULT NULL
) ;

--
-- Volcado de datos para la tabla `credito`
--

INSERT INTO `credito` (`ID_CREDITO`, `ID_VENTA`, `ID_SUCURSAL`, `ID_CLIENTE`, `ID_USUARIO`, `CODIGO_CREDITO`, `NOMBRE_CREDITO`, `FECHA_CREDITO`, `FECHA_LIMITE`, `MONTO_CREDITO`, `MONTO_ABONADO`, `MONTO_RESTANTE`, `ESTADO`) VALUES
('1', '4', 'SUCURSAL1428567', '1', 'ADMIN01', '1', 'POR VENTA #4', '2023-11-03 22:26:07', '2023-11-02', '53.00', '53.00', '0.00', 0),
('2', '5', 'SUCURSAL1428567', '1', 'ADMIN01', '2', 'POR VENTA #5', '2023-11-03 22:37:49', '2023-11-29', '5.30', '5.30', '0.00', 0),
('3', '6', 'SUCURSAL1428567', '2', 'ADMIN01', '3', 'POR VENTA #6', '2023-11-03 22:41:40', '2023-12-01', '10.60', '10.60', '0.00', 0),
('4', '7', 'SUCURSAL1428567', '1', 'ADMIN01', '4', 'POR VENTA #7', '2023-11-03 22:47:17', '2023-12-01', '21.20', '21.00', '0.20', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `creditos_compra`
--

CREATE TABLE `creditos_compra` (
  `ID_CREDITO` varchar(20) NOT NULL,
  `ID_COMPRA` varchar(20) DEFAULT NULL,
  `TOTAL` decimal(40,2) NOT NULL,
  `PAGADO` decimal(40,2) NOT NULL,
  `PENDIENTE` decimal(40,2) NOT NULL,
  `FECHA_PAGO` datetime DEFAULT NULL,
  `ESTADO` int(11) NOT NULL,
  `N_COTIZACION` varchar(20) NOT NULL
) ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuenta_bancaria`
--

CREATE TABLE `cuenta_bancaria` (
  `ID` varchar(20) DEFAULT NULL,
  `NRO_CUENTA` varchar(100) DEFAULT NULL,
  `BANCO` varchar(100) DEFAULT NULL,
  `TITULAR` varchar(100) DEFAULT NULL,
  `TELEFONO` varchar(50) DEFAULT NULL,
  `CORREO` varchar(50) DEFAULT NULL
) ;

--
-- Volcado de datos para la tabla `cuenta_bancaria`
--

INSERT INTO `cuenta_bancaria` (`ID`, `NRO_CUENTA`, `BANCO`, `TITULAR`, `TELEFONO`, `CORREO`) VALUES
('1', '12345678901234567890', 'BCP', 'PRUEBA TITUTAR', '123456789', 'prueba@demo.com'),
('1', '12345678901234567890', 'BCP', 'PRUEBA TITUTAR', '123456789', 'prueba@demo.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `ID_DEPARTAMENTO` varchar(20) NOT NULL,
  `DEPARTAMENTO` varchar(50) DEFAULT NULL
) ;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`ID_DEPARTAMENTO`, `DEPARTAMENTO`) VALUES
('2', 'CUZCO'),
('DEPARTAMENTO7545050', 'LIMA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ajuste`
--

CREATE TABLE `detalle_ajuste` (
  `ID_DETALLE` varchar(20) NOT NULL,
  `ID_AJUSTE` varchar(20) DEFAULT NULL,
  `ID_ITEM` varchar(20) DEFAULT NULL,
  `STOCK_A` int(11) DEFAULT NULL,
  `STOCK_N` int(11) DEFAULT NULL
) ;

--
-- Volcado de datos para la tabla `detalle_ajuste`
--

INSERT INTO `detalle_ajuste` (`ID_DETALLE`, `ID_AJUSTE`, `ID_ITEM`, `STOCK_A`, `STOCK_N`) VALUES
('1', '1', '25', 10544, 10543);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_cotizacion`
--

CREATE TABLE `detalle_cotizacion` (
  `ID_DETALLE` varchar(20) NOT NULL,
  `ID_ITEM` varchar(20) DEFAULT NULL,
  `ID_COTIZACION` varchar(20) DEFAULT NULL,
  `CANTIDAD` int(1) DEFAULT NULL,
  `PRECIO` decimal(40,2) DEFAULT NULL,
  `DESCUENTO` decimal(40,2) DEFAULT NULL,
  `SUBTOTAL` decimal(40,2) DEFAULT NULL,
  `TOTAL` decimal(40,2) DEFAULT NULL,
  `PERCENT_DESC` decimal(40,2) NOT NULL,
  `PRECIO_1` decimal(40,2) NOT NULL,
  `PRECIO_2` decimal(40,2) NOT NULL,
  `PRECIO_3` decimal(40,2) NOT NULL,
  `PRECIO_4` decimal(40,2) NOT NULL,
  `MEDIDA` varchar(200) NOT NULL,
  `PRECIO_RADIO` int(11) NOT NULL DEFAULT 1,
  `PRECIO_5` decimal(10,2) DEFAULT 0.00,
  `PRECIO_6` decimal(10,2) DEFAULT 0.00,
  `PRECIO_7` decimal(10,2) NOT NULL DEFAULT 0.00
) ;

--
-- Volcado de datos para la tabla `detalle_cotizacion`
--

INSERT INTO `detalle_cotizacion` (`ID_DETALLE`, `ID_ITEM`, `ID_COTIZACION`, `CANTIDAD`, `PRECIO`, `DESCUENTO`, `SUBTOTAL`, `TOTAL`, `PERCENT_DESC`, `PRECIO_1`, `PRECIO_2`, `PRECIO_3`, `PRECIO_4`, `MEDIDA`, `PRECIO_RADIO`, `PRECIO_5`, `PRECIO_6`, `PRECIO_7`) VALUES
('1', 'ITEM6601243', '1', 640, '5.30', '0.00', '3400.00', '3400.00', '0.00', '1700.00', '850.00', '230.00', '5.30', 'CAJA', 1, '0.00', '0.00', '0.00'),
('2', 'ITEM6601243', '2', 3200, '5.30', '0.00', '17000.00', '17000.00', '0.00', '1700.00', '850.00', '230.00', '5.30', 'CAJA', 1, '0.00', '0.00', '0.00'),
('3', 'ITEM6601243', '3', 640, '5.30', '0.00', '3400.00', '3400.00', '0.00', '1700.00', '850.00', '230.00', '5.30', 'CAJA', 1, '0.00', '0.00', '0.00'),
('4', 'ITEM6601243', '4', 320, '5.30', '0.00', '1700.00', '1700.00', '0.00', '1700.00', '850.00', '230.00', '5.30', 'CAJA', 1, '0.00', '0.00', '0.00'),
('5', '25', '5', 1, '6.01', '0.00', '6.01', '6.01', '0.00', '1.00', '2.00', '3.00', '4.00', '1', 4, '5.01', '6.01', '7.00'),
('6', '27', '5', 71, '1.00', '0.00', '5.02', '5.02', '0.00', '1.00', '2.00', '3.00', '4.00', '51', 5, '5.02', '6.20', '7.02'),
('7', '25', '6', 71, '7.00', '0.00', '7.00', '7.00', '0.00', '1.00', '2.00', '3.00', '4.00', '71', 7, '5.01', '6.01', '7.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_devolucion_preventa`
--

CREATE TABLE `detalle_devolucion_preventa` (
  `ID_DETALLE` varchar(20) NOT NULL,
  `ID_PREVENTA` varchar(20) DEFAULT NULL,
  `ID_ITEM` varchar(20) DEFAULT NULL,
  `ID_PRODUCTO` varchar(20) DEFAULT NULL,
  `PRECIO_1` decimal(40,2) DEFAULT NULL,
  `PRECIO_2` decimal(40,2) DEFAULT NULL,
  `PRECIO_3` decimal(40,2) DEFAULT NULL,
  `PRECIO_4` decimal(40,2) DEFAULT NULL,
  `CANTIDAD` int(1) DEFAULT NULL,
  `PERCENT_DESC` decimal(40,2) DEFAULT NULL,
  `DESCUENTO` decimal(40,2) DEFAULT NULL,
  `SUBTOTAL` decimal(40,2) DEFAULT NULL,
  `TOTAL` decimal(40,2) DEFAULT NULL,
  `FECHA_REGISTRO` datetime DEFAULT NULL,
  `ESTADO` int(11) DEFAULT NULL,
  `DETALLE` text DEFAULT NULL,
  `ID_USUARIO` text NOT NULL
) ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_invoice`
--

CREATE TABLE `detalle_invoice` (
  `ID_DETALLE` varchar(20) NOT NULL,
  `ID_INVOICE` varchar(20) NOT NULL,
  `ID_ITEM` varchar(20) NOT NULL,
  `CANTIDAD` int(2) NOT NULL,
  `PRECIO` decimal(40,2) DEFAULT NULL
) ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_preventa`
--

CREATE TABLE `detalle_preventa` (
  `ID_DETALLE` varchar(20) NOT NULL,
  `ID_PREVENTA` varchar(20) DEFAULT NULL,
  `ID_ITEM` varchar(20) DEFAULT NULL,
  `ID_PRODUCTO` varchar(20) DEFAULT NULL,
  `PRECIO_1` decimal(40,2) DEFAULT NULL,
  `PRECIO_2` decimal(40,2) DEFAULT NULL,
  `PRECIO_3` decimal(40,2) DEFAULT NULL,
  `PRECIO_4` decimal(40,2) DEFAULT NULL,
  `CANTIDAD` int(1) DEFAULT NULL,
  `PERCENT_DESC` decimal(40,2) DEFAULT NULL,
  `DESCUENTO` decimal(40,2) DEFAULT NULL,
  `SUBTOTAL` decimal(40,2) DEFAULT NULL,
  `TOTAL` decimal(40,2) DEFAULT NULL,
  `FECHA_REGISTRO` datetime DEFAULT NULL,
  `ESTADO` int(11) DEFAULT NULL,
  `PRECIO_5` decimal(10,2) DEFAULT 0.00,
  `PRECIO_6` decimal(10,2) DEFAULT 0.00,
  `PRECIO_7` decimal(10,2) DEFAULT 0.00
) ;

--
-- Volcado de datos para la tabla `detalle_preventa`
--

INSERT INTO `detalle_preventa` (`ID_DETALLE`, `ID_PREVENTA`, `ID_ITEM`, `ID_PRODUCTO`, `PRECIO_1`, `PRECIO_2`, `PRECIO_3`, `PRECIO_4`, `CANTIDAD`, `PERCENT_DESC`, `DESCUENTO`, `SUBTOTAL`, `TOTAL`, `FECHA_REGISTRO`, `ESTADO`, `PRECIO_5`, `PRECIO_6`, `PRECIO_7`) VALUES
('1', '1', '20', '10', '212.00', '12.00', '12.00', '2121.00', 1, '0.00', '0.00', '2121.00', '2121.00', '2024-06-12 07:21:32', 1, '0.00', '0.00', '0.00'),
('2', '2', '26', '12', '1.00', '2.00', '3.00', '4.00', 4, '0.00', '0.00', '4.00', '4.00', '2024-08-20 04:22:27', 1, '5.00', '6.00', '7.00'),
('3', '3', '25', '12', '1.00', '2.00', '3.00', '4.00', 71, '0.00', '0.00', '7.00', '7.00', '2024-08-20 10:42:25', 1, '5.00', '6.00', '7.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_transferencia`
--

CREATE TABLE `detalle_transferencia` (
  `ID_DETALLE` varchar(20) NOT NULL,
  `ID_TRANSFERENCIA` varchar(20) NOT NULL,
  `ID_PRODUCTO` varchar(20) NOT NULL,
  `CANTIDAD` int(11) NOT NULL,
  `STOCK` int(11) NOT NULL,
  `ESTADO` int(11) DEFAULT NULL
) ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_traspasos`
--

CREATE TABLE `detalle_traspasos` (
  `ID_DETALLE` varchar(20) NOT NULL,
  `ID_ITEM` varchar(20) DEFAULT NULL,
  `FECHA_REGISTRO` datetime DEFAULT NULL,
  `ID_TRASPASO` varchar(20) DEFAULT NULL,
  `CANTIDAD` int(11) DEFAULT NULL
) ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `ID_DETALLE` varchar(20) NOT NULL,
  `ID_ITEM` varchar(20) DEFAULT NULL,
  `ID_VENTA` varchar(20) DEFAULT NULL,
  `CANTIDAD` int(1) DEFAULT NULL,
  `PRECIO` decimal(40,2) DEFAULT NULL,
  `DESCUENTO` decimal(40,2) DEFAULT NULL,
  `SUBTOTAL` decimal(40,2) DEFAULT NULL,
  `TOTAL` decimal(40,2) DEFAULT NULL,
  `STOCK` int(11) NOT NULL,
  `MEDIDA` text DEFAULT NULL
) ;

--
-- Volcado de datos para la tabla `detalle_venta`
--

INSERT INTO `detalle_venta` (`ID_DETALLE`, `ID_ITEM`, `ID_VENTA`, `CANTIDAD`, `PRECIO`, `DESCUENTO`, `SUBTOTAL`, `TOTAL`, `STOCK`, `MEDIDA`) VALUES
('1', 'ITEM02765413', '1', 12, '50.00', '0.00', '50.00', '50.00', 383, 'DOCENA'),
('10', '19', '8', 1, '2121.00', '0.00', '2121.00', '2121.00', 1, '2121'),
('11', '20', '9', 1, '2121.00', '0.00', '2121.00', '2121.00', 99, ''),
('12', '20', '10', 1, '2121.00', '0.00', '2121.00', '2121.00', 99, ''),
('13', '20', '11', 1, '2121.00', '0.00', '2121.00', '2121.00', 99, ''),
('14', '20', '12', 1, '2121.00', '0.00', '2121.00', '2121.00', 96, '2121'),
('15', '20', '13', 1, '2121.00', '0.00', '2121.00', '2121.00', 95, ''),
('16', '20', '14', 1, '2121.00', '0.00', '2121.00', '2121.00', 94, '2121'),
('17', '20', '15', 1, '2121.00', '0.00', '2121.00', '2121.00', 93, '2121'),
('18', '20', '16', 1, '2121.00', '0.00', '2121.00', '2121.00', 92, '2121'),
('19', '20', '17', 1, '2121.00', '0.00', '2121.00', '2121.00', 91, '2121'),
('2', 'ITEM24650514', '1', 12, '200.00', '0.00', '200.00', '200.00', 397, 'DOCENA'),
('20', '20', '18', 1, '2121.00', '0.00', '2121.00', '2121.00', 90, '2121'),
('21', '20', '19', 1, '2121.00', '0.00', '2121.00', '2121.00', 89, '2121'),
('22', '20', '20', 1, '2121.00', '0.00', '2121.00', '2121.00', 88, '2121'),
('23', '20', '21', 1, '12.00', '0.00', '12.00', '12.00', 87, 'KILO'),
('24', '20', '22', 1, '2121.00', '0.00', '2121.00', '2121.00', 86, 'GRAMO'),
('25', '20', '23', 1, '2121.00', '0.00', '2121.00', '2121.00', 85, 'GRAMO'),
('26', '20', '24', 1, '2121.00', '0.00', '2121.00', '2121.00', 84, ''),
('27', '22', '25', 8, '20.00', '0.00', '40.00', '40.00', 10, 'GRAMO'),
('28', '24', '26', 1, '5.30', '0.00', '5.30', '5.30', 5000, ''),
('29', '24', '27', 320, '1700.00', '0.00', '1700.00', '1700.00', 4999, 'CAJA'),
('3', 'ITEM65055711', '1', 1, '14.00', '0.00', '14.00', '14.00', 912, ''),
('30', '24', '28', 1, '5.30', '0.00', '5.30', '5.30', 4679, 'UNIDAD'),
('31', '24', '29', 1, '5.30', '0.00', '5.30', '5.30', 4678, 'UNIDAD'),
('32', '24', '30', 1, '5.30', '0.00', '5.30', '5.30', 4677, 'UNIDAD'),
('33', '25', '31', 71, '7.00', '0.00', '7.00', '7.00', 1, '71'),
('34', '25', '32', 4, '4.00', '0.00', '4.00', '4.00', 40, '4'),
('35', '27', '32', 51, '5.00', '0.00', '5.00', '5.00', 4, '51'),
('36', '27', '33', 71, '7.02', '0.00', '7.02', '7.02', 45545454, '71'),
('4', 'ITEM6601243', '2', 320, '1700.00', '0.00', '1700.00', '1700.00', 377, 'CAJA'),
('5', 'ITEM28525316', '3', 1, '5.30', '0.00', '5.30', '5.30', 29840, 'UNIDAD'),
('6', 'ITEM6601243', '4', 10, '5.30', '0.00', '53.00', '53.00', 57, 'UNIDAD'),
('7', 'ITEM6601243', '5', 1, '5.30', '0.00', '5.30', '5.30', 47, 'UNIDAD'),
('8', 'ITEM6601243', '6', 2, '5.30', '0.00', '10.60', '10.60', 46, 'UNIDAD'),
('9', 'ITEM6601243', '7', 4, '5.30', '0.00', '21.20', '21.20', 44, 'UNIDAD');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion_cliente`
--

CREATE TABLE `direccion_cliente` (
  `ID_DIRECCION` varchar(20) NOT NULL,
  `ID_CLIENTE` varchar(20) NOT NULL,
  `DIRECCION` varchar(100) NOT NULL
) ;

--
-- Volcado de datos para la tabla `direccion_cliente`
--

INSERT INTO `direccion_cliente` (`ID_DIRECCION`, `ID_CLIENTE`, `DIRECCION`) VALUES
('1', '1', '---2'),
('2', '1', 'asasd21'),
('3', '1', 'assadasd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento`
--

CREATE TABLE `documento` (
  `ID_DOCUMENTO` varchar(20) NOT NULL,
  `DOCUMENTO` varchar(50) DEFAULT NULL,
  `ESTADO` int(11) DEFAULT NULL
) ;

--
-- Volcado de datos para la tabla `documento`
--

INSERT INTO `documento` (`ID_DOCUMENTO`, `DOCUMENTO`, `ESTADO`) VALUES
('DOCUMENTO2696581', 'NIT', 1),
('DOCUMENTO9795051', 'CI', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dosificacion`
--

CREATE TABLE `dosificacion` (
  `ID_DOSIFICACION` varchar(20) NOT NULL,
  `LLAVE` text NOT NULL,
  `FECHA` text NOT NULL,
  `NUMERO` text NOT NULL,
  `L1` text NOT NULL,
  `L2` text NOT NULL,
  `L3` text NOT NULL,
  `L4` text NOT NULL,
  `ID_SUCURSAL` varchar(20) NOT NULL
) ;

--
-- Volcado de datos para la tabla `dosificacion`
--

INSERT INTO `dosificacion` (`ID_DOSIFICACION`, `LLAVE`, `FECHA`, `NUMERO`, `L1`, `L2`, `L3`, `L4`, `ID_SUCURSAL`) VALUES
('', '', '', '', '', '', '', '', ''),
('DOSIFICACION0804251', '9xP6(Npd{KZZ*MmYi9e3gc@n7cGGPy5CBWJ2PqhPkszH-pHyL[$Lj}FEJdKD5rq7', '16/03/2007', '3004009385010', 'LEYENDA 1 UNO', 'LEYENDA 2 DOS', 'LEYENDA 3 TRES', 'LEYENDA 4 TRES', 'SUCURSAL1428567'),
('DOSIFICACION8410632', 'm2vp]Y6HIS_bRIT3AfJX$]{ZwpRW9(kU#T)fBK)V)++5vf]q7}RMEC6xT%Pg[+k', '09/08/2007', '4004007169128', 'LEYENDA UNO', 'LEYENDA DOS', 'LEYENDA TRES', 'LEYENDA CUATROo', 'SUCURSAL2206381');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrada`
--

CREATE TABLE `entrada` (
  `ID_ENTRADA` varchar(20) NOT NULL,
  `MES_INVENTARIO` varchar(20) NOT NULL,
  `FECHA` date NOT NULL,
  `DESCRIPCION` varchar(100) NOT NULL,
  `CANTIDAD` int(11) DEFAULT NULL,
  `PRECIO_COSTO` double(40,2) DEFAULT NULL,
  `PRECIO_VENTA_1` double(40,2) DEFAULT NULL,
  `PRECIO_VENTA_2` double(40,2) DEFAULT NULL,
  `PRECIO_VENTA_3` double(40,2) DEFAULT NULL,
  `PRECIO_VENTA_4` double(40,2) DEFAULT NULL,
  `ID_PRODUCTO` varchar(20) NOT NULL,
  `ID_COMPRA` varchar(20) DEFAULT NULL
) ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrada_salida`
--

CREATE TABLE `entrada_salida` (
  `ID_KARDEX` varchar(20) NOT NULL,
  `ID_CAJA` varchar(20) DEFAULT NULL,
  `ID_SUCURSAL` varchar(20) DEFAULT NULL,
  `ID_USUARIO` varchar(20) DEFAULT NULL,
  `ID_ITEM` varchar(20) NOT NULL,
  `PRECIO_MOVIMIENTO` decimal(40,2) NOT NULL,
  `FECHA` datetime NOT NULL,
  `MOVIMIENTO` int(2) NOT NULL,
  `ENTRADAS` int(11) NOT NULL,
  `SALIDAS` int(11) NOT NULL,
  `STOCK_LOTE` int(11) NOT NULL,
  `STOCK_GLOBAL` int(11) NOT NULL,
  `DETALLE` text NOT NULL,
  `ID_VENTA` varchar(20) NOT NULL
) ;

--
-- Volcado de datos para la tabla `entrada_salida`
--

INSERT INTO `entrada_salida` (`ID_KARDEX`, `ID_CAJA`, `ID_SUCURSAL`, `ID_USUARIO`, `ID_ITEM`, `PRECIO_MOVIMIENTO`, `FECHA`, `MOVIMIENTO`, `ENTRADAS`, `SALIDAS`, `STOCK_LOTE`, `STOCK_GLOBAL`, `DETALLE`, `ID_VENTA`) VALUES
('1', '1', 'SUCURSAL1428567', 'USUARIO4785330399', 'ITEM02765413', '50.00', '2023-10-21 23:48:23', 1, 0, 12, 371, 2244, 'POR VENTA #1', '1'),
('10', '5', 'SUCURSAL1428567', 'ADMIN01', 'ITEM6601243', '1700.00', '2023-11-02 23:00:12', 1, 0, 320, 57, -665, 'POR VENTA #2', '2'),
('11', '5', 'SUCURSAL1428567', 'ADMIN01', 'ITEM28525316', '5.30', '2023-11-03 21:31:52', 1, 0, 1, 29839, 29839, 'POR VENTA #3', '3'),
('12', '5', 'SUCURSAL1428567', 'ADMIN01', 'ITEM6601243', '53.00', '2023-11-03 22:26:07', 1, 0, 10, 47, -675, 'POR VENTA #4', '4'),
('13', '5', 'SUCURSAL1428567', 'ADMIN01', 'ITEM6601243', '5.30', '2023-11-03 22:37:49', 1, 0, 1, 46, -676, 'POR VENTA #5', '5'),
('14', '5', 'SUCURSAL1428567', 'ADMIN01', 'ITEM6601243', '10.60', '2023-11-03 22:41:40', 1, 0, 2, 44, -678, 'POR VENTA #6', '6'),
('15', '5', 'SUCURSAL1428567', 'ADMIN01', 'ITEM6601243', '21.20', '2023-11-03 22:47:17', 1, 0, 4, 40, -682, 'POR VENTA #7', '7'),
('16', '', '4', 'ADMIN01', '19', '10.00', '2024-06-12 06:20:45', 2, 1, 0, 1, 1, 'INVENTARIO INICIAL', ''),
('17', '6', '4', 'ADMIN01', '19', '2121.00', '2024-06-12 06:21:12', 1, 0, 1, 0, 0, 'POR VENTA #1', '8'),
('18', '', '4', 'ADMIN01', '20', '1000.00', '2024-06-12 13:21:15', 2, 100, 0, 100, 100, 'INVENTARIO INICIAL', ''),
('19', '6', '4', 'ADMIN01', '20', '2121.00', '2024-08-08 22:14:06', 1, 0, 1, 98, 98, 'POR VENTA #2', '9'),
('2', '1', 'SUCURSAL1428567', 'USUARIO4785330399', 'ITEM24650514', '200.00', '2023-10-21 23:48:23', 1, 0, 12, 385, 482, 'POR VENTA #1', '1'),
('20', '6', '4', 'ADMIN01', '20', '2121.00', '2024-08-08 22:14:17', 1, 0, 1, 98, 97, 'POR VENTA #3', '10'),
('21', '6', '4', 'ADMIN01', '20', '2121.00', '2024-08-08 22:14:32', 1, 0, 1, 98, 96, 'POR VENTA #4', '11'),
('22', '6', '4', 'ADMIN01', '20', '2121.00', '2024-08-10 11:13:51', 1, 0, 1, 95, 95, 'POR VENTA #5', '12'),
('23', '6', '4', 'ADMIN01', '20', '2121.00', '2024-08-10 11:15:13', 1, 0, 1, 94, 94, 'POR VENTA #6', '13'),
('24', '6', '4', 'ADMIN01', '20', '2121.00', '2024-08-10 11:18:35', 1, 0, 1, 93, 93, 'POR VENTA #7', '14'),
('25', '6', '4', 'ADMIN01', '20', '2121.00', '2024-08-10 11:36:39', 1, 0, 1, 92, 92, 'POR VENTA #8', '15'),
('26', '6', '4', 'ADMIN01', '20', '2121.00', '2024-08-10 11:40:17', 1, 0, 1, 91, 91, 'POR VENTA #9', '16'),
('27', '6', '4', 'ADMIN01', '20', '2121.00', '2024-08-10 11:45:19', 1, 0, 1, 90, 90, 'POR VENTA #10', '17'),
('28', '7', '4', 'ADMIN01', '20', '2121.00', '2024-08-11 02:03:48', 1, 0, 1, 89, 89, 'POR VENTA #11', '18'),
('29', '8', '4', 'ADMIN01', '20', '2121.00', '2024-08-12 17:22:35', 1, 0, 1, 88, 88, 'POR VENTA #12', '19'),
('30', '8', '4', 'ADMIN01', '20', '2121.00', '2024-08-13 21:05:59', 1, 0, 1, 87, 87, 'POR VENTA #13', '20'),
('31', '8', '4', 'ADMIN01', '20', '12.00', '2024-08-14 01:23:18', 1, 0, 1, 86, 86, 'POR VENTA #14', '21'),
('32', '8', '4', 'ADMIN01', '20', '2121.00', '2024-08-14 01:25:43', 1, 0, 1, 85, 85, 'POR VENTA #15', '22'),
('33', '8', '4', 'ADMIN01', '20', '2121.00', '2024-08-14 01:26:37', 1, 0, 1, 84, 84, 'POR VENTA #16', '23'),
('34', '8', '4', 'ADMIN01', '20', '2121.00', '2024-08-14 01:27:41', 1, 0, 1, 83, 83, 'POR VENTA #17', '24'),
('35', '', '4', 'USUARIO8526052992', '21', '10.00', '2024-08-15 03:07:55', 2, 1, 0, 1, 84, 'INVENTARIO INICIAL', ''),
('36', '', '4', 'USUARIO8526052992', '22', '100.00', '2024-08-15 03:08:02', 2, 10, 0, 10, 94, 'INVENTARIO INICIAL', ''),
('37', '', '4', 'USUARIO8526052992', '23', '60.00', '2024-08-15 03:08:08', 2, 6, 0, 6, 100, 'INVENTARIO INICIAL', ''),
('38', '9', '4', 'USUARIO8526052992', '22', '40.00', '2024-08-14 22:20:19', 1, 0, 8, 2, 92, 'POR VENTA #18', '25'),
('39', '', '4', 'ADMIN01', '24', '7500000.00', '2024-08-16 01:36:23', 2, 5000, 0, 5000, 5000, 'INVENTARIO INICIAL', ''),
('40', '8', '4', 'ADMIN01', '24', '5.30', '2024-08-15 19:36:49', 1, 0, 1, 4999, 4999, 'POR VENTA #19', '26'),
('41', '8', '4', 'ADMIN01', '24', '1700.00', '2024-08-15 19:37:15', 1, 0, 320, 4679, 4679, 'POR VENTA #20', '27'),
('42', '8', '4', 'ADMIN01', '24', '5.30', '2024-08-15 20:47:21', 1, 0, 1, 4678, 4678, 'POR VENTA #21', '28'),
('43', '8', '4', 'ADMIN01', '24', '5.30', '2024-08-15 20:53:09', 1, 0, 1, 4677, 4677, 'POR VENTA #22', '29'),
('44', '8', '4', 'ADMIN01', '24', '5.30', '2024-08-15 20:56:18', 1, 0, 1, 4676, 4676, 'POR VENTA #23', '30'),
('45', '', '4', 'ADMIN01', '25', '1.00', '2024-08-20 01:42:57', 2, 1, 0, 1, 1, 'INVENTARIO INICIAL', ''),
('46', '', '4', 'ADMIN01', '26', '4.00', '2024-08-20 01:43:06', 2, 4, 0, 4, 5, 'INVENTARIO INICIAL', ''),
('47', '8', '4', 'ADMIN01', '27', '4.00', '2024-08-20 02:46:18', 2, 4, 0, 4, 9, 'POR COMPRA #1', '1'),
('48', '8', '4', 'ADMIN01', '25', '7.00', '2024-08-20 04:38:43', 1, 0, 71, -70, -66, 'POR VENTA #24', '31'),
('49', '8', '4', 'ADMIN01', '25', '4.00', '2024-08-20 21:00:47', 1, 0, 4, 36, 40, 'POR VENTA #25', '32'),
('50', '8', '4', 'ADMIN01', '27', '5.00', '2024-08-20 21:00:47', 1, 0, 51, -47, -11, 'POR VENTA #25', '32'),
('51', '8', '4', 'ADMIN01', '27', '7.02', '2024-08-20 23:35:31', 1, 0, 71, 45545383, 45555927, 'POR VENTA #26', '33'),
('52', '', '4', 'ADMIN01', '25', '10543.00', '2024-08-20 23:58:19', 2, 10543, 0, 10543, 45555926, 'AJUSTE DE INVANTARIO', ''),
('53', '', '4', 'ADMIN01', '28', '10.00', '2024-09-04 07:49:18', 2, 1, 0, 1, 1, 'POR PEDIDO TRASPASO #1', ''),
('54', '', 'SUCURSAL1428567', 'ADMIN01', 'ITEM65055711', '10.00', '2024-09-04 07:49:18', 1, 0, 1, 910, -1, 'POR PEDIDO TRASPASO #1', ''),
('55', '', '4', 'ADMIN01', '29', '10.00', '2024-09-04 07:49:28', 2, 1, 0, 1, 2, 'POR PEDIDO TRASPASO #2', ''),
('56', '', 'SUCURSAL1428567', 'ADMIN01', 'ITEM37611412', '10.00', '2024-09-04 07:49:28', 1, 0, 1, 960, 0, 'POR PEDIDO TRASPASO #2', ''),
('7', '', 'SUCURSAL1428567', 'ADMIN01', 'ITEM6601243', '10.60', '2023-11-02 13:15:21', 1, 0, 2, 0, -305, 'POR PEDIDO #10', ''),
('8', '', 'SUCURSAL1428567', 'ADMIN01', 'ITEM6601243', '212.00', '2023-11-02 13:25:16', 1, 0, 40, 0, -345, 'POR PEDIDO #11', ''),
('9', '5', 'SUCURSAL1428567', 'ADMIN01', 'ITEM65055711', '14.00', '2023-11-02 22:58:50', 1, 0, 1, 911, 2243, 'POR VENTA #1', '1'),
('KARDEX0631562', '', 'SUCURSAL1428567', 'ADMIN01', 'ITEM6601243', '5.30', '2023-10-22 22:23:17', 1, 0, 1, 0, -300, 'POR PEDIDO #1', ''),
('KARDEX1337604', '', 'SUCURSAL1428567', 'ADMIN01', 'ITEM6601243', '5.30', '2023-10-22 22:23:37', 1, 0, 1, 0, -302, 'POR PEDIDO #1', ''),
('KARDEX3231163', '', 'SUCURSAL1428567', 'ADMIN01', 'ITEM6601243', '5.30', '2023-10-22 22:23:19', 1, 0, 1, 0, -301, 'POR PEDIDO #1', ''),
('KARDEX4767325', '', 'SUCURSAL1428567', 'ADMIN01', 'ITEM6601243', '5.30', '2023-10-22 22:23:52', 1, 0, 1, 0, -303, 'POR PEDIDO #2', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen_producto`
--

CREATE TABLE `imagen_producto` (
  `ID_IMAGEN` varchar(20) NOT NULL,
  `ID_PRODUCTO` varchar(20) NOT NULL,
  `IMAGEN` varchar(200) DEFAULT NULL,
  `ESTADO` int(11) DEFAULT NULL
) ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invoice`
--

CREATE TABLE `invoice` (
  `ID_INVOICE` varchar(20) NOT NULL,
  `ID_CLIENTE` varchar(20) NOT NULL,
  `ID_PROVINCIA` varchar(20) NOT NULL,
  `N_INVOICE` varchar(20) NOT NULL,
  `ID_DIRECCION` varchar(20) NOT NULL,
  `TITULO` varchar(200) NOT NULL,
  `FECHA` datetime NOT NULL,
  `SUBTOTAL` decimal(40,2) DEFAULT NULL,
  `TARIFA` decimal(40,2) DEFAULT NULL,
  `TOTAL` decimal(40,2) DEFAULT NULL,
  `ADICIONAL` longtext DEFAULT NULL,
  `ESTADO` int(1) DEFAULT NULL,
  `PAGO` int(1) NOT NULL
) ;

--
-- Volcado de datos para la tabla `invoice`
--

INSERT INTO `invoice` (`ID_INVOICE`, `ID_CLIENTE`, `ID_PROVINCIA`, `N_INVOICE`, `ID_DIRECCION`, `TITULO`, `FECHA`, `SUBTOTAL`, `TARIFA`, `TOTAL`, `ADICIONAL`, `ESTADO`, `PAGO`) VALUES
('1', '1', 'PROVINCIA0847500', '1', '1', 'COHETILLO BIG TOM THUMS', '2023-10-22 22:11:25', '1700.00', '12.00', '1712.00', 'SSASA', 2, 1),
('10', '1', '2', '10', '1', 'COHETILLO BIG TOM THUMS', '2023-11-02 13:14:48', '10.60', '11.00', '21.60', 'SSASA', 1, 1),
('11', '1', 'PROVINCIA0847500', '11', '1', 'COHETILLO BIG TOM THUMS', '2023-11-02 13:24:00', '230.00', '12.00', '242.00', 'SSASA', 1, 1),
('12', '1', '2', '12', '1', 'COHETILLO BIG TOM THUMS', '2023-11-05 21:21:31', '230.00', '11.00', '241.00', 'SSASA', 1, 1),
('2', '1', 'PROVINCIA0847500', '2', '1', 'COHETILLO BIG TOM THUMS', '2023-10-22 22:13:48', '1700.00', '12.00', '1712.00', 'SSASA', 1, 1),
('3', '1', 'PROVINCIA0847500', '3', '1', 'PRIMERA PARTIDA', '2023-10-22 22:20:20', '2.00', '12.00', '14.00', 'SSASA', 1, 1),
('4', '1', 'PROVINCIA0847500', '4', '1', 'COHETILLO BIG TOM THUMS', '2023-10-22 22:22:15', '5.30', '12.00', '17.30', 'SSASA', 1, 1),
('5', '1', 'PROVINCIA0847500', '5', '1', 'COHETILLO BIG TOM THUMS', '2023-11-02 12:21:58', '1700.00', '12.00', '1712.00', 'SSASA', 1, 1),
('6', '1', '2', '6', '1', 'COHETILLO BIG TOM THUMS', '2023-11-02 12:39:14', '15.90', '11.00', '26.90', 'SSASA', 1, 1),
('7', '1', '2', '7', '1', 'COHETILLO BIG TOM THUMS', '2023-11-02 12:47:48', '1700.00', '11.00', '1711.00', 'SSASA', 1, 1),
('8', '1', 'PROVINCIA0847500', '8', '1', 'COHETILLO BIG TOM THUMS', '2023-11-02 12:48:55', '5.30', '12.00', '17.30', 'SSASA', 1, 1),
('9', '1', '2', '9', '1', 'COHETILLO BIG TOM THUMS', '2023-11-02 13:09:03', '850.00', '11.00', '861.00', 'SSASA', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invoice_producto`
--

CREATE TABLE `invoice_producto` (
  `ID_ITEMS` varchar(20) NOT NULL,
  `ID_ITEM` varchar(20) NOT NULL,
  `ID_INVOICE` varchar(20) NOT NULL,
  `CANTIDAD` int(11) NOT NULL,
  `PRECIO` decimal(40,2) NOT NULL,
  `PRECIO_RADIO` int(11) NOT NULL DEFAULT 4
) ;

--
-- Volcado de datos para la tabla `invoice_producto`
--

INSERT INTO `invoice_producto` (`ID_ITEMS`, `ID_ITEM`, `ID_INVOICE`, `CANTIDAD`, `PRECIO`, `PRECIO_RADIO`) VALUES
('1', 'ITEM6601243', '1', 1, '1700.00', 4),
('10', 'ITEM6601243', '9', 1, '850.00', 4),
('11', 'ITEM6601243', '10', 2, '5.30', 4),
('12', 'ITEM6601243', '11', 40, '230.00', 4),
('13', 'ITEM6601243', '12', 40, '230.00', 3),
('2', 'ITEM6601243', '2', 1, '1700.00', 4),
('3', 'ITEM6749698', '3', 2, '1.00', 4),
('4', 'ITEM6601243', '4', 1, '5.30', 4),
('5', 'ITEM6749698', '5', 1, '0.00', 4),
('6', 'ITEM6601243', '5', 1, '1700.00', 4),
('7', 'ITEM6601243', '6', 3, '5.30', 4),
('8', 'ITEM6601243', '7', 1, '1700.00', 4),
('9', 'ITEM6601243', '8', 1, '5.30', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invoice_usuario`
--

CREATE TABLE `invoice_usuario` (
  `ID_INVOICE_U` varchar(20) NOT NULL,
  `ID_INVOICE` varchar(20) NOT NULL,
  `ID_USUARIO` varchar(20) NOT NULL,
  `FECHA` datetime DEFAULT NULL
) ;

--
-- Volcado de datos para la tabla `invoice_usuario`
--

INSERT INTO `invoice_usuario` (`ID_INVOICE_U`, `ID_INVOICE`, `ID_USUARIO`, `FECHA`) VALUES
('INV1762881', '1', 'ADMIN01', '2023-10-22 22:23:19'),
('INV1852975', '11', 'ADMIN01', '2023-11-02 13:25:16'),
('INV2616073', '2', 'ADMIN01', '2023-10-22 22:23:52'),
('INV4310404', '10', 'ADMIN01', '2023-11-02 13:15:21'),
('INV5503460', '1', 'ADMIN01', '2023-10-22 22:23:17'),
('INV8470202', '1', 'ADMIN01', '2023-10-22 22:23:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invoice_usuario_notificacion`
--

CREATE TABLE `invoice_usuario_notificacion` (
  `ID_NOTIFICACION` varchar(20) NOT NULL,
  `DESCRIPCION` text NOT NULL,
  `ID_INVOICE` varchar(20) NOT NULL,
  `ID_USUARIO` varchar(20) NOT NULL,
  `ESTADO` int(11) DEFAULT NULL,
  `FECHA` datetime DEFAULT NULL
) ;

--
-- Volcado de datos para la tabla `invoice_usuario_notificacion`
--

INSERT INTO `invoice_usuario_notificacion` (`ID_NOTIFICACION`, `DESCRIPCION`, `ID_INVOICE`, `ID_USUARIO`, `ESTADO`, `FECHA`) VALUES
('NOTI0008071', 'ha actualizado el estado de su pedido  ', '1', 'ADMIN01', 2, '2023-10-22 22:23:19'),
('NOTI0669062', 'ha actualizado el estado de su pedido  ', '1', 'ADMIN01', 1, '2023-10-22 22:23:32'),
('NOTI2437636', 'ha actualizado el estado de su pedido  ', '2', 'ADMIN01', 2, '2023-10-22 22:23:52'),
('NOTI3605304', 'ha actualizado el estado de su pedido  ', '2', 'ADMIN01', 1, '2023-10-22 22:23:44'),
('NOTI3752880', 'ha actualizado el estado de su pedido  ', '1', 'ADMIN01', 2, '2023-10-22 22:23:17'),
('NOTI44298812', 'ha actualizado el estado de su pedido  ', '11', 'ADMIN01', 1, '2023-11-02 13:25:18'),
('NOTI50954011', 'ha actualizado el estado de su pedido  ', '11', 'ADMIN01', 2, '2023-11-02 13:25:16'),
('NOTI57648310', 'ha actualizado el estado de su pedido  ', '11', 'ADMIN01', 1, '2023-11-02 13:25:02'),
('NOTI6366418', 'ha actualizado el estado de su pedido  ', '10', 'ADMIN01', 2, '2023-11-02 13:15:21'),
('NOTI7707087', 'ha actualizado el estado de su pedido  ', '2', 'ADMIN01', 1, '2023-10-22 22:23:53'),
('NOTI8395255', 'ha actualizado el estado de su pedido  ', '2', 'ADMIN01', 1, '2023-10-22 22:23:47'),
('NOTI8638159', 'ha actualizado el estado de su pedido  ', '10', 'ADMIN01', 1, '2023-11-02 13:15:23'),
('NOTI9606213', 'ha actualizado el estado de su pedido  ', '1', 'ADMIN01', 2, '2023-10-22 22:23:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items_compra`
--

CREATE TABLE `items_compra` (
  `ID_ITEM` varchar(20) NOT NULL,
  `ID_ALMACEN` varchar(20) NOT NULL,
  `ID_LOTE` varchar(20) NOT NULL,
  `ID_PRODUCTO` varchar(20) NOT NULL,
  `PRECIO_COSTO` double(40,2) DEFAULT NULL,
  `PRECIO_VENTA_1` double(40,2) DEFAULT NULL,
  `PRECIO_VENTA_2` double(40,2) DEFAULT NULL,
  `PRECIO_VENTA_3` double(40,2) DEFAULT NULL,
  `PRECIO_VENTA_4` double(40,2) DEFAULT NULL,
  `CANTIDAD` int(11) DEFAULT NULL,
  `PERECEDERO` int(11) DEFAULT NULL,
  `ID_COMPRA` varchar(20) DEFAULT NULL,
  `FECHA_VENCIMIENTO` date NOT NULL,
  `PRECIO_VENTA_5` decimal(10,2) DEFAULT 0.00,
  `PRECIO_VENTA_6` decimal(10,2) DEFAULT 0.00,
  `PRECIO_VENTA_7` decimal(10,2) DEFAULT 0.00
) ;

--
-- Volcado de datos para la tabla `items_compra`
--

INSERT INTO `items_compra` (`ID_ITEM`, `ID_ALMACEN`, `ID_LOTE`, `ID_PRODUCTO`, `PRECIO_COSTO`, `PRECIO_VENTA_1`, `PRECIO_VENTA_2`, `PRECIO_VENTA_3`, `PRECIO_VENTA_4`, `CANTIDAD`, `PERECEDERO`, `ID_COMPRA`, `FECHA_VENCIMIENTO`, `PRECIO_VENTA_5`, `PRECIO_VENTA_6`, `PRECIO_VENTA_7`) VALUES
('27', '4', '5', '12', 1.00, 1.00, 2.00, 3.00, 4.00, 4, 0, '1', '0000-00-00', '5.02', '6.20', '7.02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items_lote`
--

CREATE TABLE `items_lote` (
  `ID_ITEM` varchar(20) NOT NULL,
  `ID_ALMACEN` varchar(20) NOT NULL,
  `ID_LOTE` varchar(20) NOT NULL,
  `ID_PRODUCTO` varchar(20) NOT NULL,
  `PRECIO_COSTO` double(40,2) DEFAULT NULL,
  `PRECIO_VENTA_1` double(40,2) DEFAULT NULL,
  `PRECIO_VENTA_2` double(40,2) DEFAULT NULL,
  `PRECIO_VENTA_3` double(40,2) DEFAULT NULL,
  `PRECIO_VENTA_4` double(40,2) DEFAULT NULL,
  `CANTIDAD` int(11) DEFAULT NULL,
  `PERECEDERO` int(11) DEFAULT NULL,
  `FECHA_VEN` date DEFAULT NULL,
  `ID_USUARIO` varchar(20) DEFAULT NULL,
  `PRECIO_VENTA_5` decimal(10,2) DEFAULT 0.00,
  `PRECIO_VENTA_6` decimal(10,2) DEFAULT 0.00,
  `PRECIO_VENTA_7` decimal(8,2) DEFAULT 0.00
) ;

--
-- Volcado de datos para la tabla `items_lote`
--

INSERT INTO `items_lote` (`ID_ITEM`, `ID_ALMACEN`, `ID_LOTE`, `ID_PRODUCTO`, `PRECIO_COSTO`, `PRECIO_VENTA_1`, `PRECIO_VENTA_2`, `PRECIO_VENTA_3`, `PRECIO_VENTA_4`, `CANTIDAD`, `PERECEDERO`, `FECHA_VEN`, `ID_USUARIO`, `PRECIO_VENTA_5`, `PRECIO_VENTA_6`, `PRECIO_VENTA_7`) VALUES
('19', '4', '3', '10', 10.00, 212.00, 12.00, 12.00, 2121.00, 0, 0, '0000-00-00', 'ADMIN01', '5.00', '6.00', '7.00'),
('20', '4', '3', '10', 10.00, 212.00, 12.00, 12.00, 2121.00, 83, 0, '0000-00-00', 'ADMIN01', '5.00', '6.00', '7.00'),
('21', '4', '3', '10', 10.00, 1.00, 12.00, 120.00, 20.00, 1, 0, '0000-00-00', 'USUARIO8526052992', '5.00', '6.00', '7.00'),
('22', '4', '3', '10', 10.00, 1.00, 12.00, 120.00, 20.00, 2, 0, '0000-00-00', 'USUARIO8526052992', '5.00', '6.00', '7.00'),
('23', '4', '3', '10', 10.00, 1.00, 12.00, 120.00, 20.00, 6, 0, '0000-00-00', 'USUARIO8526052992', '5.00', '6.00', '7.00'),
('24', '4', '3', 'PRODUC2945171', 1500.00, 1700.00, 850.00, 230.00, 5.30, 4676, 0, '0000-00-00', 'ADMIN01', '5.00', '6.00', '7.00'),
('25', '4', '3', '12', 1.00, 1.00, 2.00, 3.00, 4.00, 10543, 0, '0000-00-00', 'ADMIN01', '5.00', '6.00', '7.00'),
('26', '4', '3', '12', 1.00, 1.00, 2.00, 3.00, 4.00, 0, 0, '0000-00-00', 'ADMIN01', '5.00', '6.00', '7.00'),
('27', '4', '5', '12', 1.00, 1.00, 2.00, 3.00, 4.00, 45545383, 0, '0000-00-00', 'ADMIN01', '5.00', '6.00', '7.00'),
('28', '4', '3', 'PRODUC0765985', 10.00, 10.00, 11.00, 12.00, 14.00, 1, 0, '0000-00-00', 'ADMIN01', '5.00', '6.00', '7.00'),
('29', '4', '3', 'PRODUC0765985', 10.00, 20.00, 30.00, 40.00, 40.00, 1, 0, '0000-00-00', 'ADMIN01', '5.00', '6.00', '7.00'),
('ITEM02765413', 'ALMACEN3660342', 'LOTE1827110', 'PRODUC0765985', 10.00, 20.00, 30.00, 40.00, 50.00, 371, 0, '0000-00-00', 'ADMIN01', '5.00', '6.00', '7.00'),
('ITEM1256224', 'ALMACEN3325123', 'LOTE5084631', 'PRODUC2945171', 1500.00, 1700.00, 850.00, 230.00, 5.30, 5, 0, '0000-00-00', 'USUARIO4785330399', '5.00', '6.00', '7.00'),
('ITEM24177815', 'ALMACEN3660342', 'LOTE1827110', 'PRODUC6642236', 10.00, 20.00, 50.00, 100.00, 200.00, 97, 0, '0000-00-00', 'ADMIN01', '5.00', '6.00', '7.00'),
('ITEM24650514', 'ALMACEN3660342', 'LOTE1827110', 'PRODUC6642236', 10.00, 20.00, 50.00, 100.00, 200.00, 385, 0, '0000-00-00', 'ADMIN01', '5.00', '6.00', '7.00'),
('ITEM28525316', 'ALMACEN3660342', 'LOTE1827110', 'PRODUC7583107', 5.00, 1700.00, 850.00, 230.00, 5.30, 29839, 0, '0000-00-00', 'ADMIN01', '5.00', '6.00', '7.00'),
('ITEM37611412', 'ALMACEN3660342', 'LOTE1827110', 'PRODUC0765985', 10.00, 20.00, 30.00, 40.00, 40.00, 959, 0, '0000-00-00', 'ADMIN01', '5.00', '6.00', '7.00'),
('ITEM4763767', 'ALMACEN3325123', 'LOTE5084631', 'PRODUC2945171', 1500.00, 1700.00, 850.00, 230.00, 5.30, 1600, 0, '0000-00-00', 'USUARIO4785330399', '5.00', '6.00', '7.00'),
('ITEM48211410', 'ALMACEN3660342', 'LOTE1827110', 'PRODUC5518583', 3.00, 4.00, 3.00, 2.00, 1.00, 999994, 0, '0000-00-00', 'USUARIO4785330399', '5.00', '6.00', '7.00'),
('ITEM4948586', 'ALMACEN3660342', 'LOTE1827110', 'PRODUC2945171', 1500.00, 1700.00, 850.00, 230.00, 5.30, -92, 0, '0000-00-00', 'USUARIO4785330399', '5.00', '6.00', '7.00'),
('ITEM5417871', 'ALMACEN3660342', 'LOTE1827110', 'PRODUC2945171', 1500.00, 1500.00, 750.00, 230.00, 4.00, -630, 0, '0000-00-00', 'USUARIO4785330399', '5.00', '6.00', '7.00'),
('ITEM5523662', 'ALMACEN3660342', 'LOTE1827110', 'PRODUC2945171', 1500.00, 1700.00, 850.00, 230.00, 5.30, 0, 0, '0000-00-00', 'USUARIO4785330399', '5.00', '6.00', '7.00'),
('ITEM5627180', 'ALMACEN3660342', 'LOTE1827110', 'PRODUC4892630', 170.00, 3500.00, 1750.00, 0.00, 350.00, -1, 0, '0000-00-00', 'USUARIO4785330399', '5.00', '6.00', '7.00'),
('ITEM65055711', 'ALMACEN3660342', 'LOTE1827110', 'PRODUC0765985', 10.00, 10.00, 11.00, 12.00, 14.00, 910, 0, '0000-00-00', 'ADMIN01', '5.00', '6.00', '7.00'),
('ITEM6601243', 'ALMACEN3660342', 'LOTE1827110', 'PRODUC2945171', 1500.00, 1700.00, 850.00, 230.00, 5.30, 40, 0, '0000-00-00', 'USUARIO4785330399', '5.00', '6.00', '7.00'),
('ITEM6749698', 'ALMACEN3660342', 'LOTE1827110', 'PRODUC7039504', 10.00, 0.00, 0.00, 0.00, 1.00, 99996, 0, '0000-00-00', 'USUARIO4785330399', '5.00', '6.00', '7.00'),
('ITEM7510445', 'ALMACEN3325123', 'LOTE5084631', 'PRODUC2945171', 1500.00, 1700.00, 850.00, 230.00, 5.30, 1600, 0, '0000-00-00', 'USUARIO4785330399', '5.00', '6.00', '7.00'),
('ITEM77866317', 'ALMACEN3325123', 'LOTE5084631', 'PRODUC0765985', 10.00, 20.00, 30.00, 40.00, 50.00, 10, 0, '0000-00-00', 'ADMIN01', '5.00', '6.00', '7.00'),
('ITEM7967389', 'ALMACEN3660342', 'LOTE1827110', 'PRODUC7677642', 2.00, 4.00, 3.00, 2.00, 1.00, 999989, 0, '0000-00-00', 'USUARIO4785330399', '5.00', '6.00', '7.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items_tienda`
--

CREATE TABLE `items_tienda` (
  `ID_ITEMS` varchar(20) NOT NULL,
  `ID_ITEM` varchar(20) NOT NULL
) ;

--
-- Volcado de datos para la tabla `items_tienda`
--

INSERT INTO `items_tienda` (`ID_ITEMS`, `ID_ITEM`) VALUES
('1', 'ITEM6601243'),
('2', 'ITEM6749698'),
('3', 'ITEM48211410');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro_compras`
--

CREATE TABLE `libro_compras` (
  `ID` varchar(20) DEFAULT NULL,
  `NRO` int(11) DEFAULT NULL,
  `FECHA_LIMITE` varchar(100) DEFAULT NULL,
  `NRO_AUTORIZACION` text DEFAULT NULL,
  `LLAVE` text DEFAULT NULL,
  `FECHA_EMISION` text DEFAULT NULL,
  `ID_COMPRA` varchar(20) DEFAULT NULL,
  `NRO_FACTURA` text DEFAULT NULL,
  `TOTAL` text DEFAULT NULL,
  `CODIGO_CONTROL` text DEFAULT NULL,
  `ID_SUCURSAL` varchar(20) DEFAULT NULL,
  `DESCUENTO` text DEFAULT NULL
) ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro_ventas`
--

CREATE TABLE `libro_ventas` (
  `ID` varchar(20) DEFAULT NULL,
  `NRO` int(11) DEFAULT NULL,
  `FECHA_LIMITE` varchar(100) DEFAULT NULL,
  `NRO_AUTORIZACION` text DEFAULT NULL,
  `LLAVE` text DEFAULT NULL,
  `FECHA_EMISION` text DEFAULT NULL,
  `ID_VENTA` varchar(20) DEFAULT NULL,
  `NRO_FACTURA` text DEFAULT NULL,
  `TOTAL` text DEFAULT NULL,
  `CODIGO_CONTROL` text DEFAULT NULL,
  `ID_SUCURSAL` varchar(20) DEFAULT NULL
) ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `linea`
--

CREATE TABLE `linea` (
  `ID_LINEA` varchar(20) NOT NULL,
  `LINEA` varchar(50) DEFAULT NULL,
  `ESTADO` int(11) DEFAULT NULL
) ;

--
-- Volcado de datos para la tabla `linea`
--

INSERT INTO `linea` (`ID_LINEA`, `LINEA`, `ESTADO`) VALUES
('LIN0610260', 'FLAMINGO', 1),
('LIN0842182', 'CBBA', 1),
('LIN5688763', 'FLAMINGOLIM', 1),
('LIN8169881', 'FLAMINGODAV', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista_deseos`
--

CREATE TABLE `lista_deseos` (
  `ID_DESEO` varchar(20) NOT NULL,
  `ID_ITEM` varchar(20) NOT NULL,
  `ID_CLIENTE` varchar(20) NOT NULL
) ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lote`
--

CREATE TABLE `lote` (
  `ID_LOTE` varchar(20) NOT NULL,
  `NOMBRE` varchar(30) NOT NULL,
  `ID_ALMACEN` varchar(20) NOT NULL,
  `FECHA_REGISTRO` date NOT NULL,
  `ESTADO` int(11) DEFAULT NULL
) ;

--
-- Volcado de datos para la tabla `lote`
--

INSERT INTO `lote` (`ID_LOTE`, `NOMBRE`, `ID_ALMACEN`, `FECHA_REGISTRO`, `ESTADO`) VALUES
('3', 'INVENTARIO INICIAL', '4', '2024-06-12', 1),
('4', '12', '4', '2024-08-20', 1),
('5', '--12', '4', '2024-08-20', 1),
('LOTE1827110', 'INVENTARIO INICIAL', 'ALMACEN3660342', '2023-02-06', 1),
('LOTE5084631', 'INVENTARIO INICIAL', 'ALMACEN3325123', '2023-02-22', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metodopagos`
--

CREATE TABLE `metodopagos` (
  `ID` int(11) NOT NULL,
  `NAME` text DEFAULT NULL,
  `ESTADO` int(11) NOT NULL DEFAULT 1
) ;

--
-- Volcado de datos para la tabla `metodopagos`
--

INSERT INTO `metodopagos` (`ID`, `NAME`, `ESTADO`) VALUES
(1, 'EFECTIVO', 1),
(2, 'QR', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientoscajas`
--

CREATE TABLE `movimientoscajas` (
  `ID_MOVIMIENTO` varchar(20) NOT NULL,
  `ID_ARQUEO` varchar(20) DEFAULT NULL,
  `TIPOMOVIMIENTO` varchar(10) DEFAULT NULL,
  `DESCRIPCIONMOVIMIENTO` text DEFAULT NULL,
  `MONTOMOVIMIENTO` decimal(40,2) NOT NULL,
  `CODMEDIOPAGO` int(11) NOT NULL,
  `FECHAMOVIMIENTO` datetime NOT NULL
) ;

--
-- Volcado de datos para la tabla `movimientoscajas`
--

INSERT INTO `movimientoscajas` (`ID_MOVIMIENTO`, `ID_ARQUEO`, `TIPOMOVIMIENTO`, `DESCRIPCIONMOVIMIENTO`, `MONTOMOVIMIENTO`, `CODMEDIOPAGO`, `FECHAMOVIMIENTO`) VALUES
('1', '5', 'ABONO', 'PAGO DE CREDITO 1', '53.00', 1, '2023-11-03 22:26:34'),
('10', '7', 'INGRESO', 'PAGO DE VENTA', '1000.00', 1, '2024-08-12 17:13:04'),
('11', '7', 'INGRESO', 'PAGO DE VENTA', '100.00', 1, '2024-08-12 17:13:14'),
('12', '7', 'INGRESO', 'PAGO DE VENTA', '11.00', 1, '2024-08-12 17:13:24'),
('13', '7', 'INGRESO', 'PAGO DE VENTA', '1000.00', 1, '2024-08-12 17:14:08'),
('14', '7', 'INGRESO', 'PAGO DE VENTA', '1121.00', 1, '2024-08-12 17:14:19'),
('15', '7', 'INGRESO', 'PAGO DE VENTA', '2121.00', 1, '2024-08-12 17:14:41'),
('16', '8', 'INGRESO', 'PAGO DE VENTA', '2121.00', 1, '2024-08-12 17:15:56'),
('17', '8', 'INGRESO', 'PAGO DE VENTA', '2121.00', 1, '2024-08-12 17:16:40'),
('18', '8', 'INGRESO', 'PAGO DE VENTA', '10.00', 1, '2024-08-12 17:23:17'),
('19', '8', 'INGRESO', 'fff', '10.00', 2, '2024-08-12 21:29:03'),
('2', '5', 'ABONO', 'PAGO DE CREDITO 2', '1.30', 1, '2023-11-03 22:40:19'),
('20', '8', 'INGRESO', 'PAGO DE VENTA', '15.00', 1, '2024-08-12 23:03:36'),
('21', '8', 'INGRESO', 'PAGO DE VENTA', '10.00', 1, '2024-08-12 23:05:20'),
('22', '8', 'INGRESO', 'PAGO DE VENTA', '30.00', 1, '2024-08-12 23:07:55'),
('23', '8', 'INGRESO', 'PAGO DE VENTA', '2056.00', 1, '2024-08-13 20:42:45'),
('24', '8', 'INGRESO', 'PAGO DE VENTA', '1000.00', 1, '2024-08-13 21:06:12'),
('25', '8', 'INGRESO', 'fdg', '10.00', 2, '2024-08-14 00:04:42'),
('26', '8', 'INGRESO', 'PAGO DE VENTA', '10.00', 2, '2024-08-14 02:17:07'),
('27', '8', 'INGRESO', 'PAGO DE VENTA', '1000.00', 1, '2024-08-14 02:17:28'),
('28', '8', 'INGRESO', 'PAGO DE VENTA', '10.00', 1, '2024-08-14 02:17:44'),
('29', '8', 'INGRESO', 'PAGO DE VENTA', '12.00', 2, '2024-08-14 02:18:03'),
('3', '5', 'ABONO', 'PAGO DE CREDITO 2', '4.00', 1, '2023-11-03 22:40:50'),
('30', '8', 'INGRESO', 'PAGO DE VENTA', '12.00', 2, '2024-08-14 02:18:18'),
('4', '5', 'ABONO', 'PAGO DE CREDITO 3', '10.60', 1, '2023-11-03 22:42:03'),
('5', '5', 'ABONO', 'PAGO DE CREDITO 4', '10.00', 1, '2023-11-03 22:47:34'),
('6', '5', 'ABONO', 'PAGO DE CREDITO 4', '11.00', 1, '2023-11-03 22:47:49'),
('7', '6', 'INGRESO', 'fd', '10.00', 1, '2024-06-12 04:54:13'),
('8', '6', 'INGRESO', 'PAGO DE VENTA', '10.00', 1, '2024-08-10 14:12:38'),
('9', '7', 'INGRESO', 'PAGO DE VENTA', '1000.00', 1, '2024-08-12 17:12:47'),
('MOVI22508', 'AREQUEO20470', 'ABONO', 'PAGO DE CREDITO CRE0000010', '7550.00', 1, '2023-02-25 17:43:28'),
('MOVI27425', 'AREQUEO20470', 'ABONO', 'PAGO DE CREDITO CRE0000006', '57270.00', 1, '2023-02-25 17:11:36'),
('MOVI307210', 'AREQUEO20470', 'ABONO', 'PAGO DE CREDITO CRE0000012', '46830.00', 1, '2023-02-25 17:46:09'),
('MOVI343911', 'AREQUEO49941', 'ABONO', 'PAGO DE CREDITO CRE0000013', '230.00', 1, '2023-09-22 09:15:52'),
('MOVI34869', 'AREQUEO20470', 'ABONO', 'PAGO DE CREDITO CRE0000011', '8120.00', 1, '2023-02-25 17:44:26'),
('MOVI36032', 'AREQUEO20470', 'ABONO', 'PAGO DE CREDITO CRE0000004', '7550.00', 1, '2023-02-25 16:43:34'),
('MOVI574512', 'AREQUEO49941', 'ABONO', 'PAGO DE CREDITO CRE0000014', '214.00', 1, '2023-10-06 11:27:12'),
('MOVI60934', 'AREQUEO20470', 'ABONO', 'PAGO DE CREDITO CRE0000006', '46830.00', 1, '2023-02-25 16:46:19'),
('MOVI61176', 'AREQUEO20470', 'ABONO', 'PAGO DE CREDITO CRE0000002', '8120.00', 1, '2023-02-25 17:26:55'),
('MOVI62131', 'AREQUEO20470', 'ABONO', 'PAGO DE CREDITO CRE0000003', '54950.00', 1, '2023-02-25 16:34:16'),
('MOVI65027', 'AREQUEO20470', 'ABONO', 'PAGO DE CREDITO CRE0000003', '49150.00', 1, '2023-02-25 17:27:36'),
('MOVI89700', 'AREQUEO20470', 'ABONO', 'PAGO DE CREDITO CRE0000001', '7550.00', 1, '2023-02-25 16:32:04'),
('MOVI95083', 'AREQUEO20470', 'ABONO', 'PAGO DE CREDITO CRE0000005', '8120.00', 1, '2023-02-25 16:45:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos_credito`
--

CREATE TABLE `pagos_credito` (
  `ID_PAGO` varchar(20) NOT NULL,
  `ID_CREDITO` varchar(20) DEFAULT NULL,
  `ID_CAJA` varchar(20) DEFAULT NULL,
  `ID_USUARIO` varchar(20) DEFAULT NULL,
  `ID_SUCURSAL` varchar(20) DEFAULT NULL,
  `MONTO` decimal(40,2) DEFAULT NULL,
  `PAGO_CON` decimal(40,2) DEFAULT NULL,
  `CAMBIO` decimal(40,2) DEFAULT NULL,
  `FECHA_REGISTRO` datetime DEFAULT NULL,
  `ESTADO` int(11) DEFAULT NULL,
  `PAGADO_AC` decimal(40,2) NOT NULL
) ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido_traspasos`
--

CREATE TABLE `pedido_traspasos` (
  `id` int(11) NOT NULL,
  `nro` varchar(20) NOT NULL,
  `sucursal_id` varchar(20) NOT NULL,
  `sucursal_destino_id` varchar(20) NOT NULL,
  `almacen_id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `motivo` text NOT NULL,
  `fecha` datetime NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `is_entregado` int(11) DEFAULT 0
) ;

--
-- Volcado de datos para la tabla `pedido_traspasos`
--

INSERT INTO `pedido_traspasos` (`id`, `nro`, `sucursal_id`, `sucursal_destino_id`, `almacen_id`, `user_id`, `motivo`, `fecha`, `is_active`, `is_entregado`) VALUES
(1, '1', '4', 'SUCURSAL1428567', '4', 'ADMIN01', 'ASSA', '2024-09-04 07:30:07', 1, 1),
(2, '2', '4', 'SUCURSAL1428567', '4', 'ADMIN01', 'FF', '2024-09-04 07:32:38', 1, 1),
(3, '3', '4', 'SUCURSAL2206381', '4', 'ADMIN01', 'GGG', '2024-09-04 07:35:47', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido_traspaso_items`
--

CREATE TABLE `pedido_traspaso_items` (
  `id` int(11) NOT NULL,
  `pedido_traspaso_id` int(11) NOT NULL,
  `item_id` varchar(20) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `cantidad_pedido` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `is_enviado` int(11) NOT NULL DEFAULT 0,
  `almacen_id` varchar(20) NOT NULL,
  `sucursal_id` varchar(20) NOT NULL,
  `producto_id` varchar(20) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1
) ;

--
-- Volcado de datos para la tabla `pedido_traspaso_items`
--

INSERT INTO `pedido_traspaso_items` (`id`, `pedido_traspaso_id`, `item_id`, `cantidad`, `cantidad_pedido`, `stock`, `is_enviado`, `almacen_id`, `sucursal_id`, `producto_id`, `is_active`) VALUES
(1, 1, 'ITEM65055711', 1, 1, 911, 1, 'ALMACEN3660342', 'SUCURSAL1428567', 'PRODUC0765985', 1),
(2, 2, 'ITEM37611412', 1, 1, 961, 1, 'ALMACEN3660342', 'SUCURSAL1428567', 'PRODUC0765985', 1),
(3, 3, 'ITEM7510445', 1, 1, 1600, 0, 'ALMACEN3325123', 'SUCURSAL2206381', 'PRODUC2945171', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perecederos`
--

CREATE TABLE `perecederos` (
  `ID_PERECEDERO` varchar(20) NOT NULL,
  `ID_ITEM` varchar(20) NOT NULL,
  `ID_PRODUCTO` varchar(20) NOT NULL,
  `ID_ALMACEN` varchar(20) NOT NULL,
  `ID_SUCURSAL` varchar(20) NOT NULL,
  `FECHA_1` date DEFAULT NULL,
  `FECHA_2` date DEFAULT NULL,
  `FECHA_3` date DEFAULT NULL,
  `FECHA_4` date DEFAULT NULL
) ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `ID_PERSONA` varchar(20) NOT NULL,
  `NOMBRES` varchar(100) NOT NULL,
  `APELLIDOS` varchar(100) NOT NULL,
  `ID_DOCUMENTO` varchar(20) DEFAULT NULL,
  `NUMERO` varchar(25) DEFAULT NULL,
  `DIRECCION` varchar(100) DEFAULT NULL,
  `TELEFONO` varchar(20) DEFAULT NULL,
  `PERFIL` varchar(100) DEFAULT NULL,
  `ESTADO` int(1) NOT NULL
) ;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`ID_PERSONA`, `NOMBRES`, `APELLIDOS`, `ID_DOCUMENTO`, `NUMERO`, `DIRECCION`, `TELEFONO`, `PERFIL`, `ESTADO`) VALUES
('PERSONA0801651244', 'HOLA', 'PRUEBA', 'DOCUMENTO9795051', '1365465', 'LA PAZ', '88888888', 'sin_perfil.png', 1),
('PERSONA0980967586', 'MIGUEL AMGEL', 'MAMANI', 'DOCUMENTO2696581', '1234564654', 'NO HAY', '716345654', 'PERFIL252145317619135592011.jpg', 1),
('PERSONA3548000661', 'angela', 'muñoz', 'DOCUMENTO9795051', '4585998877', 'ahhshggdg', '7889554', 'PERFIL033892659541744491834.png', 1),
('PERSONA3724402782', 'PRUEBA', 'COMPRAS', 'DOCUMENTO2696581', '1234567890', 'NO TIENE DIRECCION', '', 'PERFIL248442583210093169250.jpg', 1),
('PERSONA4215987907', 'Ingrid Fernanda ', 'Santander Carrasco', 'DOCUMENTO9795051', '56987412', 'zona cota cota calle maribel Nro. 67', '78945612', 'PERFIL052479213072785032198.jpg', 1),
('PERSONA6028720368', 'BOLIVIA', 'KHAT', 'DOCUMENTO9795051', '6753828', 'LA PAZ', '68086073', 'PERFIL592555878775631324050.png', 1),
('PERSONA6315069373', 'gato montes ', 'monte grande', 'DOCUMENTO9795051', '44441111', 'calle san juan potosi', '78888888', 'sin_perfil.png', 1),
('PERSONA6690234985', 'CARLOS', 'MAMANI', 'DOCUMENTO2696581', '10000001', 'HERNANDO SILES', '7890297828', 'PERFIL529057506520383514120.jpg', 1),
('PERSONA7663582080', 'fernando', 'mendoza', 'DOCUMENTO9795051', '45879612', 'AV.obrajes', '1244555566', 'sin_perfil.png', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presentacion`
--

CREATE TABLE `presentacion` (
  `ID_PRESENTACION` varchar(20) NOT NULL,
  `NOMBRE` varchar(20) DEFAULT NULL,
  `ESTADO` int(11) DEFAULT NULL,
  `FOTO` varchar(200) NOT NULL
) ;

--
-- Volcado de datos para la tabla `presentacion`
--

INSERT INTO `presentacion` (`ID_PRESENTACION`, `NOMBRE`, `ESTADO`, `FOTO`) VALUES
('PRES0475131', 'LLORONAS', 1, 'CATEGORIA924681846777079841010.jpg'),
('PRES1330232', 'MORTERO', 1, 'empty_producto.png'),
('PRES2958430', 'DISPLAY', 1, 'empty_producto.png'),
('PRES5094764', 'DIA', 1, 'empty_producto.png'),
('PRES5313803', 'COHETILLO', 1, 'empty_producto.png'),
('PRES9703875', 'HUMO DE COLORES', 1, 'empty_producto.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preventa`
--

CREATE TABLE `preventa` (
  `ID_PREVENTA` varchar(20) NOT NULL,
  `N_PREVENTA` varchar(20) DEFAULT NULL,
  `ID_SUCURSAL` varchar(20) DEFAULT NULL,
  `ID_USUARIO` varchar(20) DEFAULT NULL,
  `ID_CLIENTE` varchar(20) DEFAULT NULL,
  `SUMAS` decimal(40,2) DEFAULT NULL,
  `IVA` decimal(40,2) DEFAULT NULL,
  `EXENTO` decimal(40,2) DEFAULT NULL,
  `SUBTOTAL` decimal(40,2) DEFAULT NULL,
  `RETENIDO` decimal(40,2) DEFAULT NULL,
  `DESCUENTO` decimal(40,2) DEFAULT NULL,
  `DESCUENTO_PERCENT` varchar(20) DEFAULT NULL,
  `TOTAL` decimal(40,2) DEFAULT NULL,
  `PROD_EXENTOS` int(1) DEFAULT NULL,
  `PRECIO_RADIO` int(1) DEFAULT NULL,
  `FECHA_REGISTRO` datetime DEFAULT NULL,
  `ESTADO` int(11) NOT NULL,
  `OBSERVACION` text NOT NULL,
  `NRO_FACTURA` text DEFAULT NULL,
  `NOMBRE_PROMOTOR` text DEFAULT NULL,
  `DIRECCION_FISICA` text DEFAULT NULL,
  `L1` text DEFAULT NULL,
  `L2` text DEFAULT NULL,
  `DESTINO` text DEFAULT NULL
) ;

--
-- Volcado de datos para la tabla `preventa`
--

INSERT INTO `preventa` (`ID_PREVENTA`, `N_PREVENTA`, `ID_SUCURSAL`, `ID_USUARIO`, `ID_CLIENTE`, `SUMAS`, `IVA`, `EXENTO`, `SUBTOTAL`, `RETENIDO`, `DESCUENTO`, `DESCUENTO_PERCENT`, `TOTAL`, `PROD_EXENTOS`, `PRECIO_RADIO`, `FECHA_REGISTRO`, `ESTADO`, `OBSERVACION`, `NRO_FACTURA`, `NOMBRE_PROMOTOR`, `DIRECCION_FISICA`, `L1`, `L2`, `DESTINO`) VALUES
('1', '1', '4', 'ADMIN01', '1', '0.00', '0.00', '2121.00', '0.00', '0.00', '0.00', '0.00', '2121.00', 1, 4, '2024-06-12 07:21:32', 1, 'SIN DATO', '1', 'SIN DATO', 'SIN DATO', 'SIN DATO', 'SIN DATO', 'SIN DATO'),
('2', '2', '4', 'ADMIN01', '1', '0.00', '0.00', '4.00', '0.00', '0.00', '0.00', '0.00', '4.00', 1, 4, '2024-08-20 04:22:27', 1, 'SIN DATO', '1', 'SIN DATO', 'SIN DATO', '-16.516948379985216', '-68.14398765563966', 'SIN DATO'),
('3', '3', '4', 'ADMIN01', '2', '0.00', '0.00', '7.00', '0.00', '0.00', '0.00', '0.00', '7.00', 1, 7, '2024-08-20 10:42:25', 1, 'SIN DATO', '1', 'SIN DATO', 'SIN DATO', '-16.494893685067716', '-68.1434726715088', 'SIN DATO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `ID_PRODUCTO` varchar(20) NOT NULL,
  `BARRA` varchar(30) DEFAULT NULL,
  `ARTICULO` varchar(100) DEFAULT NULL,
  `ID_PRESENTACION` varchar(20) DEFAULT NULL,
  `ID_LINEA` varchar(20) DEFAULT NULL,
  `ID_UNIDAD` varchar(20) DEFAULT NULL,
  `COMPLEMENTO` varchar(200) NOT NULL,
  `PRECIO_COSTO` double(12,2) DEFAULT NULL,
  `PRECIO_VENTA_1` double(12,2) DEFAULT NULL,
  `PRECIO_VENTA_2` double(12,2) DEFAULT NULL,
  `PRECIO_VENTA_3` double(12,2) DEFAULT NULL,
  `PRECIO_VENTA_4` double(12,2) DEFAULT NULL,
  `STOCK_MINIMO` int(11) DEFAULT NULL,
  `STOCK_MEDIO` int(11) DEFAULT NULL,
  `STOCK_MODERADO` int(11) DEFAULT NULL,
  `PERECEDERO` int(11) DEFAULT NULL,
  `EXENTO` int(11) DEFAULT NULL,
  `ESTADO` int(11) DEFAULT NULL,
  `IMAGEN` varchar(200) DEFAULT NULL,
  `MEDIDA_1` varchar(15) DEFAULT NULL,
  `MEDIDA_2` varchar(15) DEFAULT NULL,
  `MEDIDA_3` varchar(15) DEFAULT NULL,
  `MEDIDA_4` varchar(15) DEFAULT NULL,
  `STOCK_1` int(11) DEFAULT NULL,
  `STOCK_2` int(11) DEFAULT NULL,
  `STOCK_3` int(11) DEFAULT NULL,
  `STOCK_4` int(11) DEFAULT NULL,
  `PRECIO_VENTA_5` decimal(10,2) DEFAULT NULL,
  `PRECIO_VENTA_6` decimal(10,2) DEFAULT NULL,
  `PRECIO_VENTA_7` decimal(10,2) DEFAULT NULL,
  `MEDIDA_5` text DEFAULT NULL,
  `MEDIDA_6` text DEFAULT NULL,
  `MEDIDA_7` text DEFAULT NULL,
  `STOCK_5` int(11) DEFAULT 0,
  `STOCK_6` int(11) DEFAULT 0,
  `STOCK_7` int(11) DEFAULT 0
) ;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`ID_PRODUCTO`, `BARRA`, `ARTICULO`, `ID_PRESENTACION`, `ID_LINEA`, `ID_UNIDAD`, `COMPLEMENTO`, `PRECIO_COSTO`, `PRECIO_VENTA_1`, `PRECIO_VENTA_2`, `PRECIO_VENTA_3`, `PRECIO_VENTA_4`, `STOCK_MINIMO`, `STOCK_MEDIO`, `STOCK_MODERADO`, `PERECEDERO`, `EXENTO`, `ESTADO`, `IMAGEN`, `MEDIDA_1`, `MEDIDA_2`, `MEDIDA_3`, `MEDIDA_4`, `STOCK_1`, `STOCK_2`, `STOCK_3`, `STOCK_4`, `PRECIO_VENTA_5`, `PRECIO_VENTA_6`, `PRECIO_VENTA_7`, `MEDIDA_5`, `MEDIDA_6`, `MEDIDA_7`, `STOCK_5`, `STOCK_6`, `STOCK_7`) VALUES
('10', '654651', 'PRODUCTO KILOGRAMOS 4', 'PRES0475131', 'LIN0610260', '4', '1', 10.00, 1.00, 12.00, 120.00, 20.00, 112, 144, 166, 0, 1, 1, 'empty_producto.png', 'UNIDAD', 'CAJA', 'KILO', 'GRAMO', 1, 2, 3, 4, '5.00', '6.00', '7.00', 'M5', 'M6', 'M7', 5, 6, 7),
('11', '43', '34', 'PRES0475131', 'LIN0610260', '4', '03', 3.00, 4.00, 4.00, 4.00, 4.00, 1, 2, 3, 0, 1, 1, 'empty_producto.png', '04', '40', '04', '04', 4, 4, 4, 4, '5.00', '6.00', '7.00', 'M5', 'M6', 'M7', 5, 6, 7),
('12', '32234234234', 'productoprecio 7', 'PRES0475131', 'LIN0610260', '4', '1', 1.00, 1.00, 2.00, 3.00, 4.00, 1, 2, 3, 0, 1, 1, 'empty_producto.png', '1', '2', '3', '4', 1, 2, 3, 4, '5.00', '6.00', '7.00', 'M5', 'M6', 'M7', 5, 6, 7),
('9', '21321321', '12321321', 'PRES0475131', 'LIN0842182', 'UMS1360210', '123123', 123213.00, 21.00, 123.00, 1231.00, 123.00, 123312, 12313212, 123123, 0, 1, 1, 'empty_producto.png', '123', '123', '123123', '21312', 21312, 312321, 3213, 21321, '5.00', '6.00', '7.00', 'M5', 'M6', 'M7', 5, 6, 7),
('PRODUC0765985', '231321654654987', 'Jhony Creativo', 'PRES0475131', 'LIN0610260', 'UMS1360210', '40ss', 10.00, 20.00, 30.00, 40.00, 50.00, 100, 200, 400, 0, 1, 1, 'empty_producto.png', 'UND', 'CUARTA', 'MEDIA', 'DOCENA', 1, 3, 6, 12, '5.00', '6.00', '7.00', 'M5', 'M6', 'M7', 5, 6, 7),
('PRODUC2945171', '0342', 'COHETILLO BIG TOM THUMS', 'PRES5313803', 'LIN0610260', 'UMS7769521', '320', 4.00, 1700.00, 850.00, 230.00, 5.30, 1, 2, 3, 0, 1, 1, 'empty_producto.png', 'CAJA', 'MEDIA CAJA', 'PAQUETE', 'UNIDAD', 320, 160, 40, 1, '5.00', '6.00', '7.00', 'M5', 'M6', 'M7', 5, 6, 7),
('PRODUC4892630', 'DAVK8003B', '3.5 MORTERO ARTILLERY SHELL', 'PRES1330232', 'LIN8169881', 'UMS7769521', '101', 170.00, 3500.00, 1750.00, 0.00, 350.00, 2, 3, 4, 0, 1, 1, 'empty_producto.png', 'CAJA', 'MEDIA CAJA', 'SN', 'UNIDAD', 10, 5, 0, 1, '5.00', '6.00', '7.00', 'M5', 'M6', 'M7', 5, 6, 7),
('PRODUC5518583', '3333', 'TERCERA PARTIDA', 'PRES5094764', 'LIN8169881', 'UMS9583822', '123', 3.00, 4.00, 3.00, 2.00, 1.00, 1, 2, 3, 0, 1, 1, 'empty_producto.png', 'CAJA', 'MEDIA CAJA', 'PAQUETE', 'UNIDAD', 4, 3, 2, 1, '5.00', '6.00', '7.00', 'M5', 'M6', 'M7', 5, 6, 7),
('PRODUC6642236', '56764163', 'FERNANDO CHUPAPI MUÑAÑO', 'PRES0475131', 'LIN0842182', 'UMS1360210', '10', 10.00, 20.00, 50.00, 100.00, 200.00, 100, 50, 40, 0, 1, 1, 'empty_producto.png', 'UNIDAD', 'CUARTA', 'MEDIA', 'DOCENA', 1, 3, 6, 12, '5.00', '6.00', '7.00', 'M5', 'M6', 'M7', 5, 6, 7),
('PRODUC7039504', '1111', 'PRIMERA PARTIDA', 'PRES5094764', 'LIN8169881', 'UMS1360210', '122', 10.00, 0.00, 0.00, 0.00, 1.00, 1, 2, 3, 0, 1, 1, 'empty_producto.png', 'SN', 'SN', 'SN', 'UNIDAD', 0, 0, 0, 1, '5.00', '6.00', '7.00', 'M5', 'M6', 'M7', 5, 6, 7),
('PRODUC7082002', '11111', 'PRIMERA PARTIDA', '', 'LIN5688763', 'UMS1360210', '122', 1.00, 4.00, 3.00, 2.00, 1.00, 1, 3, 3, 0, 1, 1, 'empty_producto.png', 'CAJA', 'MEDIA CAJA', 'PAQUETE', 'UNIDAD', 4, 3, 2, 1, '5.00', '6.00', '7.00', 'M5', 'M6', 'M7', 5, 6, 7),
('PRODUC7583107', '123123123121', 'HH', 'PRES5094764', 'LIN5688763', 'UMS7769521', '122112', 5.00, 1700.00, 850.00, 230.00, 5.30, 150, 200, 300, 0, 1, 1, 'empty_producto.png', 'CAJA', 'MEDIA CAJA', 'PAQUETE', 'UNIDAD', 320, 160, 40, 1, '5.00', '6.00', '7.00', 'M5', 'M6', 'M7', 5, 6, 7),
('PRODUC7677642', '22222', 'SEGUNDA PARTIDA', 'PRES5094764', 'LIN8169881', 'UMS1360210', '123', 2.00, 4.00, 3.00, 2.00, 1.00, 0, 0, 0, 0, 1, 1, 'empty_producto.png', 'CAJA', 'MEDIA CAJA', 'PAQUETE', 'UNIDAD', 4, 3, 2, 1, '5.00', '6.00', '7.00', 'M5', 'M6', 'M7', 5, 6, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_caracteristica`
--

CREATE TABLE `producto_caracteristica` (
  `ID_CARACTERISTICA` varchar(20) NOT NULL,
  `ID_PRODUCTO` varchar(20) NOT NULL,
  `CARACTERISTICA` text DEFAULT NULL
) ;

--
-- Volcado de datos para la tabla `producto_caracteristica`
--

INSERT INTO `producto_caracteristica` (`ID_CARACTERISTICA`, `ID_PRODUCTO`, `CARACTERISTICA`) VALUES
('1', '10', 'safasfafsD'),
('2', 'PRODUC7039504', 'xaxasa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_img`
--

CREATE TABLE `producto_img` (
  `ID_IMG` varchar(20) NOT NULL,
  `ID_PRODUCTO` varchar(20) NOT NULL,
  `IMG` varchar(100) NOT NULL
) ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_recomendados`
--

CREATE TABLE `producto_recomendados` (
  `ID_RECOMENDADOS` varchar(20) NOT NULL,
  `ITEM` varchar(20) NOT NULL,
  `DESCUENTO` decimal(40,2) NOT NULL
) ;

--
-- Volcado de datos para la tabla `producto_recomendados`
--

INSERT INTO `producto_recomendados` (`ID_RECOMENDADOS`, `ITEM`, `DESCUENTO`) VALUES
('3', '1', '10.00'),
('4', '3', '10.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promociones`
--

CREATE TABLE `promociones` (
  `ID` varchar(20) NOT NULL,
  `IMAGEN` varchar(200) NOT NULL
) ;

--
-- Volcado de datos para la tabla `promociones`
--

INSERT INTO `promociones` (`ID`, `IMAGEN`) VALUES
('1', 'PROMO757337562554099088069.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `ID_PROVEEDOR` varchar(20) NOT NULL,
  `RAZON` varchar(100) NOT NULL,
  `TIPO_DOCUMENTO` varchar(20) NOT NULL,
  `N_DOCUMENTO` varchar(20) NOT NULL,
  `DIRECCION` varchar(100) DEFAULT NULL,
  `TELEFONO` varchar(20) DEFAULT NULL,
  `CORREO` varchar(100) DEFAULT NULL,
  `CUENTA` varchar(50) DEFAULT NULL,
  `VENDEDOR` varchar(100) DEFAULT NULL,
  `V_TELEFONO` varchar(100) DEFAULT NULL,
  `ESTADO` int(11) DEFAULT NULL
) ;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`ID_PROVEEDOR`, `RAZON`, `TIPO_DOCUMENTO`, `N_DOCUMENTO`, `DIRECCION`, `TELEFONO`, `CORREO`, `CUENTA`, `VENDEDOR`, `V_TELEFONO`, `ESTADO`) VALUES
('1', 'JOSE BLANCO 3', 'DOCUMENTO2696581', '59709004', '11', '---', '--', '', '', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincia`
--

CREATE TABLE `provincia` (
  `ID_PROVINCIA` varchar(20) NOT NULL,
  `PROVINCIA` varchar(100) NOT NULL,
  `PRECIO` varchar(25) DEFAULT NULL,
  `ID_DEPARTAMENTO` varchar(20) DEFAULT NULL
) ;

--
-- Volcado de datos para la tabla `provincia`
--

INSERT INTO `provincia` (`ID_PROVINCIA`, `PROVINCIA`, `PRECIO`, `ID_DEPARTAMENTO`) VALUES
('2', 'CUZCO', '11', '2'),
('PROVINCIA0847500', 'LIMA', '12', 'DEPARTAMENTO7545050');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccion`
--

CREATE TABLE `seccion` (
  `ID_SECCION` varchar(20) NOT NULL,
  `SECCION` varchar(100) DEFAULT NULL,
  `ESTADO` int(11) DEFAULT NULL
) ;

--
-- Volcado de datos para la tabla `seccion`
--

INSERT INTO `seccion` (`ID_SECCION`, `SECCION`, `ESTADO`) VALUES
('1', 'SALUD Y BELLEZA ', 1),
('2', 'HOLA', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccion_presentacion`
--

CREATE TABLE `seccion_presentacion` (
  `ID_PRESENTACIONES` varchar(20) NOT NULL,
  `ID_SECCION` varchar(20) DEFAULT NULL,
  `ID_PRESENTACION` varchar(20) DEFAULT NULL
) ;

--
-- Volcado de datos para la tabla `seccion_presentacion`
--

INSERT INTO `seccion_presentacion` (`ID_PRESENTACIONES`, `ID_SECCION`, `ID_PRESENTACION`) VALUES
('1', '1', 'PRES0475131'),
('2', '1', 'PRES1330232'),
('3', '1', 'PRES5094764');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguimiento_invoice`
--

CREATE TABLE `seguimiento_invoice` (
  `ID_SEG` varchar(20) NOT NULL,
  `ID_INVOICE` varchar(20) DEFAULT NULL,
  `ID_ITEM` varchar(20) DEFAULT NULL,
  `ID_CANTIDAD` int(11) DEFAULT NULL,
  `ID_KARDEX` varchar(20) DEFAULT NULL
) ;

--
-- Volcado de datos para la tabla `seguimiento_invoice`
--

INSERT INTO `seguimiento_invoice` (`ID_SEG`, `ID_INVOICE`, `ID_ITEM`, `ID_CANTIDAD`, `ID_KARDEX`) VALUES
('5', '10', 'ITEM6601243', 2, '7'),
('6', '11', 'ITEM6601243', 40, '8'),
('SEG1460242', '1', 'ITEM6601243', 1, 'KARDEX1337604'),
('SEG2866071', '1', 'ITEM6601243', 1, 'KARDEX3231163'),
('SEG4783130', '1', 'ITEM6601243', 1, 'KARDEX0631562'),
('SEG8062333', '2', 'ITEM6601243', 1, 'KARDEX4767325');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguimiento_traspaso`
--

CREATE TABLE `seguimiento_traspaso` (
  `ID_SEG` varchar(20) NOT NULL,
  `ID_TRASPASO` varchar(20) DEFAULT NULL,
  `CANTIDAD` int(11) DEFAULT NULL,
  `ID_ITEM` varchar(20) DEFAULT NULL,
  `ID_LOTE` varchar(20) DEFAULT NULL,
  `ID_PERECEDERO` varchar(20) DEFAULT NULL,
  `ID_KARDEX_EN` varchar(20) DEFAULT NULL,
  `ID_KARDEX_SA` varchar(20) DEFAULT NULL
) ;

--
-- Volcado de datos para la tabla `seguimiento_traspaso`
--

INSERT INTO `seguimiento_traspaso` (`ID_SEG`, `ID_TRASPASO`, `CANTIDAD`, `ID_ITEM`, `ID_LOTE`, `ID_PERECEDERO`, `ID_KARDEX_EN`, `ID_KARDEX_SA`) VALUES
('SEG1186182', 'TRASPASO904543', 1600, 'ITEM4948586', 'ITEM4763767', '0', 'KARDEX70968211', 'KARDEX92754012'),
('SEG3946580', 'TRASPASO196161', 5, 'ITEM6601243', 'ITEM1256224', '0', 'KARDEX8937166', 'KARDEX5482827'),
('SEG4498301', 'TRASPASO596102', 1600, 'ITEM5523662', 'ITEM7510445', '0', 'KARDEX9543218', 'KARDEX3195949');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursal`
--

CREATE TABLE `sucursal` (
  `ID_SUCURSAL` varchar(20) NOT NULL,
  `NOMBRE` varchar(100) DEFAULT NULL,
  `ID_DOCUMENTO` varchar(20) NOT NULL,
  `NUMERO` varchar(25) NOT NULL,
  `IVA` varchar(10) NOT NULL,
  `MONEDA` varchar(20) NOT NULL,
  `DIRECCION` varchar(100) DEFAULT NULL,
  `TELEFONO` varchar(20) DEFAULT NULL,
  `EMAIL` varchar(70) DEFAULT NULL,
  `REPRESENTANTE` varchar(150) DEFAULT NULL,
  `LOGO` varchar(50) DEFAULT NULL,
  `ESTADO` int(1) NOT NULL
) ;

--
-- Volcado de datos para la tabla `sucursal`
--

INSERT INTO `sucursal` (`ID_SUCURSAL`, `NOMBRE`, `ID_DOCUMENTO`, `NUMERO`, `IVA`, `MONEDA`, `DIRECCION`, `TELEFONO`, `EMAIL`, `REPRESENTANTE`, `LOGO`, `ESTADO`) VALUES
('4', 'Sucursal de prueba ', 'DOCUMENTO2696581', '123213', '18.00', 'USD', 'Jr. Ticapampa', '23234', 'jaklsdnklasnm@sdka.com', 'JHONATAN', 'SUCURSAL630771659234047337957.jpg', 1),
('SUCURSAL1428567', 'PRINCIPAL', 'DOCUMENTO2696581', '4754733', '0.00', 'Bs./', 'SN', '', 'sn@_', 'KHATERINE', 'SUCURSAL255981040201927446919.png', 1),
('SUCURSAL2206381', 'TARAPACA', 'DOCUMENTO2696581', '4754733', '0.00', 'Bs./', 'LA PAZ', 'SN', 'SN', 'BOLIVIA', 'SUCURSAL853501485194938084970.png', 1),
('SUCURSAL9403882', 'SUCURSAL #3', 'DOCUMENTO2696581', '14654646', '13.00', 'Bs./', 'SN', '27987894', 'sucursal@gmail.com', 'SN', 'SUCURSAL603255507541935318630.png', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tienda_cliente`
--

CREATE TABLE `tienda_cliente` (
  `ID_CLIENTE` varchar(20) NOT NULL,
  `ID_DOCUMENTO` varchar(20) NOT NULL,
  `N_DOCUMENTO` varchar(20) NOT NULL,
  `NOMBRE` varchar(100) DEFAULT NULL,
  `CORREO` varchar(100) DEFAULT NULL,
  `PASSWORD` varchar(100) DEFAULT NULL,
  `PERFIL` varchar(100) DEFAULT NULL,
  `TELEFONO` varchar(100) DEFAULT NULL,
  `FECHA` varchar(100) DEFAULT NULL,
  `GENERO` int(1) DEFAULT NULL,
  `ESTADO` int(1) DEFAULT NULL
) ;

--
-- Volcado de datos para la tabla `tienda_cliente`
--

INSERT INTO `tienda_cliente` (`ID_CLIENTE`, `ID_DOCUMENTO`, `N_DOCUMENTO`, `NOMBRE`, `CORREO`, `PASSWORD`, `PERFIL`, `TELEFONO`, `FECHA`, `GENERO`, `ESTADO`) VALUES
('1', 'DOCUMENTO2696581', '00000000', 'USUARIO0001', 'jhonycreativo.code@gmail.com', 'UFhOUGxudmVoODNyUDhwK1c4Z0hSQT09', 'sin_perfil.jpg', '(001)090 997 ', '0000-00-00', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tienda_sucursal`
--

CREATE TABLE `tienda_sucursal` (
  `ID_TIENDA` varchar(20) NOT NULL,
  `ID_SUCURSAL` varchar(20) DEFAULT NULL,
  `ESTADO` int(11) DEFAULT NULL
) ;

--
-- Volcado de datos para la tabla `tienda_sucursal`
--

INSERT INTO `tienda_sucursal` (`ID_TIENDA`, `ID_SUCURSAL`, `ESTADO`) VALUES
('TIENDA01', 'SUCURSAL1428567', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiraje_comprobante`
--

CREATE TABLE `tiraje_comprobante` (
  `ID_TIRAJE` varchar(20) NOT NULL,
  `FECHA_RESOLUCION` date DEFAULT NULL,
  `NRO_RESOLUCION` varchar(100) DEFAULT NULL,
  `NRO_RESOLUCION_FAC` varchar(100) DEFAULT NULL,
  `SERIE` varchar(100) DEFAULT NULL,
  `DESDE` varchar(100) DEFAULT NULL,
  `HASTA` varchar(100) DEFAULT NULL,
  `ID_COMPROBANTE` varchar(20) DEFAULT NULL,
  `ID_SUCURSAL` varchar(20) DEFAULT NULL,
  `DISPONIBLES` int(11) DEFAULT NULL,
  `ESTADO` int(11) NOT NULL DEFAULT 1
) ;

--
-- Volcado de datos para la tabla `tiraje_comprobante`
--

INSERT INTO `tiraje_comprobante` (`ID_TIRAJE`, `FECHA_RESOLUCION`, `NRO_RESOLUCION`, `NRO_RESOLUCION_FAC`, `SERIE`, `DESDE`, `HASTA`, `ID_COMPROBANTE`, `ID_SUCURSAL`, `DISPONIBLES`, `ESTADO`) VALUES
('2', '2024-08-20', '10', '100', 'F001', '1', '20000', 'COMPRO2437293', '4', 19974, 1),
('TIRA0000000001', '2023-02-06', '1', '1', 'a', '1', '2000000000', 'COMPRO4259314', 'SUCURSAL1428567', 1999999921, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transferencia_almacen`
--

CREATE TABLE `transferencia_almacen` (
  `ID_TRANSFERENCIA` varchar(20) NOT NULL,
  `FECHA` date NOT NULL,
  `MOTIVO` text NOT NULL,
  `ID_ALMACEN_ORIGEN` varchar(20) NOT NULL,
  `ID_ALMACEN_DESTINO` varchar(20) NOT NULL,
  `ID_USUARIO` varchar(20) NOT NULL,
  `ESTADO` int(11) DEFAULT NULL
) ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `traspasos`
--

CREATE TABLE `traspasos` (
  `ID_TRASPASO` varchar(20) NOT NULL,
  `N_TRASPASO` varchar(20) DEFAULT NULL,
  `FECHA_REGISTRO` datetime DEFAULT NULL,
  `ID_SUCURSAL` varchar(20) DEFAULT NULL,
  `ID_USUARIO` varchar(20) DEFAULT NULL,
  `ID_ALMACEN` varchar(20) DEFAULT NULL,
  `MOTIVO` text DEFAULT NULL,
  `ESTADO` int(1) DEFAULT NULL
) ;

--
-- Volcado de datos para la tabla `traspasos`
--

INSERT INTO `traspasos` (`ID_TRASPASO`, `N_TRASPASO`, `FECHA_REGISTRO`, `ID_SUCURSAL`, `ID_USUARIO`, `ID_ALMACEN`, `MOTIVO`, `ESTADO`) VALUES
('TRASPASO196161', 'TPS0000001', '2023-02-22 11:43:22', 'SUCURSAL1428567', 'USUARIO4785330399', 'ALMACEN3325123', 'A SOLICITUD DEL SR. RICARDO H.', 1),
('TRASPASO596102', 'TPS0000002', '2023-02-22 11:46:53', 'SUCURSAL1428567', 'USUARIO4785330399', 'ALMACEN3325123', '5 CAJAS DE COHETILLO A PETICION DEL SR. RICARDO H.', 1),
('TRASPASO904543', 'TPS0000003', '2023-02-23 11:25:17', 'SUCURSAL1428567', 'USUARIO4785330399', 'ALMACEN3325123', '5 CAJAS DE COHETILLO A PETICION DEL SR. RICARDO, ENTREGAO A RICHARD PINTO', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidad_medida`
--

CREATE TABLE `unidad_medida` (
  `ID_UNIDAD` varchar(20) NOT NULL,
  `UNIDAD` varchar(100) DEFAULT NULL,
  `PREFIJO` varchar(50) DEFAULT NULL,
  `ESTADO` int(11) DEFAULT NULL
) ;

--
-- Volcado de datos para la tabla `unidad_medida`
--

INSERT INTO `unidad_medida` (`ID_UNIDAD`, `UNIDAD`, `PREFIJO`, `ESTADO`) VALUES
('4', 'KILOGRAMOS', 'KG', 1),
('UMS1360210', 'UNIDAD', 'UND', 1),
('UMS7769521', 'CAJA', 'CJA', 1),
('UMS9583822', 'PAQUETE', 'PQT', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `ID_USUARIO` varchar(20) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `PASSWORD` varchar(100) NOT NULL,
  `ID_PERSONA` varchar(20) NOT NULL,
  `FECHA_REGISTRO` date DEFAULT NULL,
  `ESTADO` int(1) DEFAULT NULL
) ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`ID_USUARIO`, `EMAIL`, `PASSWORD`, `ID_PERSONA`, `FECHA_REGISTRO`, `ESTADO`) VALUES
('ADMIN01', 'administrador', 'dC9vV1JSQmExNTNJbFNLSU9aaks1UT09', 'PERSONA7663582080', '2020-11-27', 1),
('USUARIO2393603147', 'miguel@gmail.com', 'N0pKcy96Um4vR2JIVU5OcXFzOWpxdz09', 'PERSONA0980967586', '2021-02-08', 1),
('USUARIO3709589306', 'carlos@gmail.com', 'N0pKcy96Um4vR2JIVU5OcXFzOWpxdz09', 'PERSONA6690234985', '2021-02-05', 1),
('USUARIO4785330399', 'khatyna@gmail.com', 'UFhOUGxudmVoODNyUDhwK1c4Z0hSQT09', 'PERSONA6028720368', '2021-02-16', 1),
('USUARIO5977529338', 'ingridsantander@gmail.com', 'RHpkeWVzbG5SZTVCeUthajR6NFV6Zz09', 'PERSONA4215987907', '2021-02-10', 1),
('USUARIO8313455763', 'compras@gmail.com', 'UFhOUGxudmVoODNyUDhwK1c4Z0hSQT09', 'PERSONA3724402782', '2021-01-23', 1),
('USUARIO8469858784', 'gato123@gmail.com', 'Y0dtcXVSN2Q5Z3JhMXZ3RnFDODJ3Zz09', 'PERSONA6315069373', '2021-01-25', 1),
('USUARIO8526052992', 'angela@gmail.com', 'UFhOUGxudmVoODNyUDhwK1c4Z0hSQT09', 'PERSONA3548000661', '2020-12-15', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_sucursal`
--

CREATE TABLE `usuario_sucursal` (
  `ID_PERMISO` int(11) NOT NULL,
  `ID_USUARIO` varchar(20) DEFAULT NULL,
  `ID_SUCURSAL` varchar(20) DEFAULT NULL,
  `DASHBOARD` int(1) NOT NULL DEFAULT 1,
  `POS` int(1) NOT NULL DEFAULT 1,
  `CONFIGURACION` int(1) NOT NULL DEFAULT 1,
  `SUCURSALES` int(1) NOT NULL DEFAULT 1,
  `DOCUMENTOS` int(1) NOT NULL DEFAULT 1,
  `COMPROBANTES` int(1) NOT NULL DEFAULT 1,
  `PERSONAL` int(1) NOT NULL DEFAULT 1,
  `PRODUCTOS` int(1) NOT NULL DEFAULT 1,
  `PRESENTACION` int(1) NOT NULL DEFAULT 1,
  `UNIDAD_MEDIDA` int(1) NOT NULL DEFAULT 1,
  `LINEAS` int(1) NOT NULL DEFAULT 1,
  `PERCEDEROS` int(1) NOT NULL DEFAULT 1,
  `ALMACEN` int(1) DEFAULT 1,
  `ESTADO` int(11) DEFAULT NULL,
  `PROVEEDORES` int(1) NOT NULL DEFAULT 1,
  `COMPRAS` int(1) NOT NULL DEFAULT 1,
  `CONSULTA_COMPRAS` int(1) NOT NULL DEFAULT 1,
  `HISTORICO_PRECIOS` int(1) NOT NULL DEFAULT 1,
  `CUENTAS_PAGAR` int(1) NOT NULL DEFAULT 1,
  `REPORTE_COMPRAS` int(1) NOT NULL DEFAULT 1,
  `CREDITOS` int(1) NOT NULL DEFAULT 1,
  `PAGAR_CREDITOS` int(1) NOT NULL DEFAULT 1,
  `CONSULTA_PAGOS` int(1) NOT NULL DEFAULT 1,
  `ASIGNACION_CAJA` int(1) NOT NULL DEFAULT 1,
  `ARQUEOS_CAJA` int(1) NOT NULL DEFAULT 1,
  `MOVIMIENTOS_CAJA` int(1) NOT NULL DEFAULT 1,
  `REPORTE_CAJA` int(1) NOT NULL DEFAULT 1,
  `COTIZACION` int(1) NOT NULL DEFAULT 1,
  `CONSULTA_COTIZACION` int(1) NOT NULL DEFAULT 1,
  `REPORTE_COTIZACION` int(1) NOT NULL DEFAULT 1,
  `PREVENTA` int(1) NOT NULL DEFAULT 1,
  `CONSULTA_PREVENTA` int(1) NOT NULL DEFAULT 1,
  `REPORTE_PREVENTA` int(1) NOT NULL DEFAULT 1,
  `VENTA` int(1) NOT NULL DEFAULT 1,
  `CLIENTE` int(1) NOT NULL DEFAULT 1,
  `CONSULTA_VENTA` int(1) NOT NULL DEFAULT 1,
  `CUENTAS_COBRAR` int(1) NOT NULL DEFAULT 1,
  `REPORTE_VENTAS` int(1) NOT NULL DEFAULT 1,
  `CREDITOS_VENTAS` int(1) NOT NULL DEFAULT 1,
  `ABONAR_CREDITOS` int(1) NOT NULL DEFAULT 1,
  `CONSULTA_ABONO` int(1) NOT NULL DEFAULT 1,
  `INVENTARTIO_GENERAL` int(1) NOT NULL DEFAULT 1,
  `CONSULTA_PRODUCTOS` int(1) NOT NULL DEFAULT 1,
  `NUEVO_TRASPASO` int(1) NOT NULL DEFAULT 1,
  `AJUSTE_INVENTARIO` int(1) NOT NULL DEFAULT 1,
  `CONSULTA_TRASPASO` int(1) NOT NULL DEFAULT 1,
  `CONSULTA_AJUSTES` int(1) NOT NULL DEFAULT 1,
  `KARDEX_PRODUCTOS` int(1) NOT NULL DEFAULT 1,
  `KARDEX_VALORIZADO` int(1) NOT NULL DEFAULT 1,
  `K_VALO_FECHA` int(1) NOT NULL DEFAULT 1,
  `FACTURA` int(11) NOT NULL DEFAULT 1,
  `TIENDA` int(11) NOT NULL DEFAULT 1,
  `KARDEX_GENERAL` int(11) DEFAULT 9,
  `PEDIDO_TRASPASO` int(11) NOT NULL DEFAULT 1,
  `PEDIDO_TRASPASO_LISTA` int(11) NOT NULL DEFAULT 1,
  `PEDIDO_TRASPASO_PENDIENTES` int(11) NOT NULL DEFAULT 1
) ;

--
-- Volcado de datos para la tabla `usuario_sucursal`
--

INSERT INTO `usuario_sucursal` (`ID_PERMISO`, `ID_USUARIO`, `ID_SUCURSAL`, `DASHBOARD`, `POS`, `CONFIGURACION`, `SUCURSALES`, `DOCUMENTOS`, `COMPROBANTES`, `PERSONAL`, `PRODUCTOS`, `PRESENTACION`, `UNIDAD_MEDIDA`, `LINEAS`, `PERCEDEROS`, `ALMACEN`, `ESTADO`, `PROVEEDORES`, `COMPRAS`, `CONSULTA_COMPRAS`, `HISTORICO_PRECIOS`, `CUENTAS_PAGAR`, `REPORTE_COMPRAS`, `CREDITOS`, `PAGAR_CREDITOS`, `CONSULTA_PAGOS`, `ASIGNACION_CAJA`, `ARQUEOS_CAJA`, `MOVIMIENTOS_CAJA`, `REPORTE_CAJA`, `COTIZACION`, `CONSULTA_COTIZACION`, `REPORTE_COTIZACION`, `PREVENTA`, `CONSULTA_PREVENTA`, `REPORTE_PREVENTA`, `VENTA`, `CLIENTE`, `CONSULTA_VENTA`, `CUENTAS_COBRAR`, `REPORTE_VENTAS`, `CREDITOS_VENTAS`, `ABONAR_CREDITOS`, `CONSULTA_ABONO`, `INVENTARTIO_GENERAL`, `CONSULTA_PRODUCTOS`, `NUEVO_TRASPASO`, `AJUSTE_INVENTARIO`, `CONSULTA_TRASPASO`, `CONSULTA_AJUSTES`, `KARDEX_PRODUCTOS`, `KARDEX_VALORIZADO`, `K_VALO_FECHA`, `FACTURA`, `TIENDA`, `KARDEX_GENERAL`, `PEDIDO_TRASPASO`, `PEDIDO_TRASPASO_LISTA`, `PEDIDO_TRASPASO_PENDIENTES`) VALUES
(1, 'USUARIO4785330399', 'SUCURSAL1428567', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(2, 'USUARIO4785330399', 'SUCURSAL2206381', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(3, 'USUARIO4785330399', 'SUCURSAL9403882', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(4, 'USUARIO8526052992', '4', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 9, 1, 1, 1),
(5, 'USUARIO2393603147', 'SUCURSAL1428567', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 9, 1, 1, 1),
(6, 'USUARIO8526052992', 'SUCURSAL1428567', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 9, 1, 1, 1),
(7, 'USUARIO8526052992', 'SUCURSAL9403882', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 9, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `ID_VENTA` varchar(20) NOT NULL,
  `N_VENTA` varchar(20) NOT NULL,
  `FECHA_RESOLUCION` datetime DEFAULT NULL,
  `TIPO_PAGO` int(11) DEFAULT NULL,
  `NUMERO_COMPROBANTE` int(1) DEFAULT NULL,
  `ID_COMPROBANTE` varchar(20) DEFAULT NULL,
  `SUMAS` decimal(40,2) DEFAULT NULL,
  `IVA` decimal(40,2) DEFAULT NULL,
  `EXENTO` decimal(40,2) DEFAULT NULL,
  `SUBTOTAL` decimal(40,2) DEFAULT NULL,
  `RETENIDO` decimal(40,2) DEFAULT NULL,
  `DESCUENTO` decimal(40,2) DEFAULT NULL,
  `DESCUENTO_PERCENT` varchar(20) DEFAULT NULL,
  `TOTAL` decimal(40,2) DEFAULT NULL,
  `PROD_EXENTOS` int(1) DEFAULT NULL,
  `PAGO_EFECTIVO` decimal(40,2) DEFAULT NULL,
  `PAGO_TARJETA` decimal(40,2) DEFAULT NULL,
  `NUMERO_TARJETA` varchar(20) DEFAULT NULL,
  `TARJETA_HABITANTE` varchar(90) DEFAULT NULL,
  `CAMBIO` decimal(40,2) DEFAULT NULL,
  `ESTADO` int(1) DEFAULT NULL,
  `ID_CLIENTE` varchar(20) DEFAULT NULL,
  `ID_USUARIO` varchar(20) DEFAULT NULL,
  `ID_SUCURSAL` varchar(20) DEFAULT NULL,
  `ID_ARQUEO` varchar(20) NOT NULL,
  `OBSERVACION` longtext NOT NULL,
  `PRECIO_RADIO` int(11) NOT NULL,
  `NRO_FACTURA` text DEFAULT NULL,
  `NOMBRE_PROMOTOR` text DEFAULT NULL,
  `PAGO_INMEDIATO` int(11) NOT NULL DEFAULT 0,
  `PAGOS_A_VENTA` decimal(8,2) NOT NULL DEFAULT 0.00,
  `ID_METODOPAGO` int(11) NOT NULL DEFAULT 1
) ;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`ID_VENTA`, `N_VENTA`, `FECHA_RESOLUCION`, `TIPO_PAGO`, `NUMERO_COMPROBANTE`, `ID_COMPROBANTE`, `SUMAS`, `IVA`, `EXENTO`, `SUBTOTAL`, `RETENIDO`, `DESCUENTO`, `DESCUENTO_PERCENT`, `TOTAL`, `PROD_EXENTOS`, `PAGO_EFECTIVO`, `PAGO_TARJETA`, `NUMERO_TARJETA`, `TARJETA_HABITANTE`, `CAMBIO`, `ESTADO`, `ID_CLIENTE`, `ID_USUARIO`, `ID_SUCURSAL`, `ID_ARQUEO`, `OBSERVACION`, `PRECIO_RADIO`, `NRO_FACTURA`, `NOMBRE_PROMOTOR`, `PAGO_INMEDIATO`, `PAGOS_A_VENTA`, `ID_METODOPAGO`) VALUES
('1', '1', '2023-11-02 22:58:50', 1, 71, 'TIRA0000000001', '14.00', '0.00', '14.00', '0.00', '0.00', '0.00', '0', '14.00', 1, '20.00', '0.00', ' ', ' ', '6.00', 1, '1', 'ADMIN01', 'SUCURSAL1428567', '5', 'SIN DATO', 4, '1', 'SIN DATO', 0, '0.00', 1),
('10', '3', '2024-08-08 22:14:17', 1, 2, '2', '2121.00', '0.00', '2121.00', '0.00', '0.00', '0.00', '0', '2121.00', 1, '0.00', '0.00', ' ', ' ', '0.00', 1, '1', 'ADMIN01', '4', '6', 'SIN DATO', 4, '', '', 0, '0.00', 1),
('11', '4', '2024-08-08 22:14:32', 1, 3, '2', '2121.00', '0.00', '2121.00', '0.00', '0.00', '0.00', '0', '2121.00', 1, '0.00', '0.00', ' ', ' ', '0.00', 1, '1', 'ADMIN01', '4', '6', 'SIN DATO', 4, '', '', 0, '0.00', 1),
('12', '5', '2024-08-10 11:13:51', 1, 4, '2', '0.00', '0.00', '2121.00', '0.00', '0.00', '0.00', '0', '2121.00', 1, '0.00', '0.00', '', '', '0.00', 1, '1', 'ADMIN01', '4', '6', 'SIN DATO', 4, '', '', 1, '2121.00', 1),
('13', '6', '2024-08-10 11:15:13', 1, 5, '2', '2121.00', '0.00', '2121.00', '0.00', '0.00', '0.00', '0', '2121.00', 1, '0.00', '0.00', ' ', ' ', '0.00', 1, '2', 'ADMIN01', '4', '6', 'SIN DATO', 4, '', '', 1, '2121.00', 1),
('14', '7', '2024-08-10 11:18:35', 1, 6, '2', '0.00', '0.00', '2121.00', '0.00', '0.00', '0.00', '0', '2121.00', 1, '2121.00', '2121.00', '', '', '0.00', 1, '1', 'ADMIN01', '4', '6', '', 4, '', '', 0, '0.00', 1),
('15', '8', '2024-08-10 11:36:39', 1, 7, '2', '0.00', '0.00', '2121.00', '0.00', '0.00', '0.00', '0', '2121.00', 1, '0.00', '2121.00', '', '', '-2121.00', 1, '1', 'ADMIN01', '4', '6', '', 4, '', '', 0, '0.00', 1),
('16', '9', '2024-08-10 11:40:17', 1, 8, '2', '0.00', '0.00', '2121.00', '0.00', '0.00', '0.00', '0', '2121.00', 1, '2121.00', '2121.00', '', '', '0.00', 1, '1', 'ADMIN01', '4', '6', '', 4, '', '', 1, '2121.00', 1),
('17', '10', '2024-08-10 11:45:19', 1, 9, '2', '0.00', '0.00', '2121.00', '0.00', '0.00', '0.00', '0', '2121.00', 1, '0.00', '2121.00', '', '', '0.00', 1, '1', 'ADMIN01', '4', '6', '', 4, '', '', 1, '2121.00', 1),
('18', '11', '2024-08-11 02:03:48', 1, 10, '2', '0.00', '0.00', '2121.00', '0.00', '0.00', '0.00', '0', '2121.00', 1, '0.00', '2121.00', '', '', '0.00', 1, '1', 'ADMIN01', '4', '7', '', 4, '', '', 1, '2121.00', 1),
('19', '12', '2024-08-12 17:22:35', 1, 11, '2', '0.00', '0.00', '2121.00', '0.00', '0.00', '0.00', '0', '2121.00', 1, '3000.00', '2121.00', '', '', '944.00', 1, '1', 'ADMIN01', '4', '8', '', 4, '', '', 1, '2121.00', 1),
('2', '2', '2023-11-02 23:00:12', 1, 72, 'TIRA0000000001', '0.00', '0.00', '1700.00', '0.00', '0.00', '0.00', '0', '1700.00', 1, '1800.00', '0.00', '', '', '100.00', 1, '1', 'ADMIN01', 'SUCURSAL1428567', '5', 'SIN DATO', 4, '1', '1', 0, '0.00', 1),
('20', '13', '2024-08-13 21:05:59', 1, 12, '2', '0.00', '0.00', '2121.00', '0.00', '0.00', '0.00', '0', '2121.00', 1, '12.00', '2121.00', '', '', '0.00', 1, '1', 'ADMIN01', '4', '8', '', 4, '', '', 1, '2022.00', 2),
('21', '14', '2024-08-14 01:23:18', 1, 13, '2', '0.00', '0.00', '12.00', '0.00', '0.00', '0.00', '0', '12.00', 1, '12.00', '12.00', '', '', '0.00', 1, '1', 'ADMIN01', '4', '8', '', 4, '', '', 0, '0.00', 2),
('22', '15', '2024-08-14 01:25:43', 1, 14, '2', '0.00', '0.00', '2121.00', '0.00', '0.00', '0.00', '0', '2121.00', 1, '2121.00', '2121.00', '', '', '0.00', 1, '1', 'ADMIN01', '4', '8', '', 4, '', '', 0, '0.00', 2),
('23', '16', '2024-08-14 01:26:37', 1, 15, '2', '0.00', '0.00', '2121.00', '0.00', '0.00', '0.00', '0', '2121.00', 1, '12.00', '0.00', '', '', '0.00', 1, '1', 'ADMIN01', '4', '8', 'SIN DATO', 4, '', '', 1, '22.00', 2),
('24', '17', '2024-08-14 01:27:41', 1, 16, '2', '2121.00', '0.00', '2121.00', '0.00', '0.00', '0.00', '0', '2121.00', 1, '0.00', '0.00', ' ', ' ', '0.00', 1, '1', 'ADMIN01', '4', '8', 'SIN DATO', 4, '', '', 1, '0.00', 2),
('25', '18', '2024-08-14 22:20:19', 1, 17, '2', '0.00', '0.00', '40.00', '0.00', '0.00', '0.00', '0', '40.00', 1, '0.00', '0.00', '', '', '0.00', 1, '1', 'USUARIO8526052992', '4', '9', 'SIN DATO', 4, '', '', 1, '0.00', 2),
('26', '19', '2024-08-15 19:36:49', 1, 18, '2', '5.30', '0.00', '5.30', '0.00', '0.00', '0.00', '0', '5.30', 1, '0.00', '0.00', ' ', ' ', '0.00', 1, '2', 'ADMIN01', '4', '8', 'SIN DATO', 4, '', '', 1, '0.00', 1),
('27', '20', '2024-08-15 19:37:15', 1, 19, '2', '0.00', '0.00', '1700.00', '0.00', '0.00', '0.00', '0', '1700.00', 1, '0.00', '1700.00', '', '', '0.00', 1, '1', 'ADMIN01', '4', '8', '', 4, '', '', 1, '0.00', 1),
('28', '21', '2024-08-15 20:47:21', 1, 20, '2', '5.30', '0.00', '5.30', '0.00', '0.00', '0.00', '0', '5.30', 1, '0.00', '0.00', ' ', ' ', '0.00', 1, '2', 'ADMIN01', '4', '8', 'SIN DATO', 4, '', '', 1, '0.00', 1),
('29', '22', '2024-08-15 20:53:09', 1, 21, '2', '5.30', '0.00', '5.30', '0.00', '0.00', '0.00', '0', '5.30', 1, '0.00', '0.00', ' ', ' ', '0.00', 1, '2', 'ADMIN01', '4', '8', 'SIN DATO', 4, '', '', 1, '0.00', 1),
('3', '3', '2023-11-03 21:31:52', 1, 73, 'TIRA0000000001', '0.00', '0.00', '5.30', '0.00', '0.00', '0.00', '0', '5.30', 1, '10.00', '0.00', '', '', '4.70', 1, '2', 'ADMIN01', 'SUCURSAL1428567', '5', 'SIN DATO', 4, '1', 'SIN DATO', 0, '0.00', 1),
('30', '23', '2024-08-15 20:56:18', 1, 22, '2', '5.30', '0.00', '5.30', '0.00', '0.00', '0.00', '0', '5.30', 1, '0.00', '0.00', ' ', ' ', '0.00', 1, '2', 'ADMIN01', '4', '8', 'SIN DATO', 4, '', '', 1, '0.00', 1),
('31', '24', '2024-08-20 04:38:43', 1, 23, '2', '0.00', '0.00', '7.00', '0.00', '0.00', '0.00', '0', '7.00', 1, '0.00', '0.00', '', '', '0.00', 1, '1', 'ADMIN01', '4', '8', 'SIN DATO', 7, '', '', 1, '0.00', 1),
('32', '25', '2024-08-20 21:00:47', 1, 24, '2', '0.00', '0.00', '9.00', '0.00', '0.00', '0.00', '0', '9.00', 2, '10.00', '0.00', '', '', '1.00', 1, '1', 'ADMIN01', '4', '8', 'SIN DATO', 7, '1', '1', 0, '0.00', 1),
('33', '26', '2024-08-20 23:35:31', 1, 26, '2', '0.00', '0.00', '7.02', '0.00', '0.00', '0.00', '0', '7.02', 1, '0.00', '7.02', '', '', '0.00', 1, '1', 'ADMIN01', '4', '8', '', 7, '', '', 1, '0.00', 1),
('4', '4', '2023-11-03 22:26:07', 1, 74, 'TIRA0000000001', '0.00', '0.00', '53.00', '0.00', '0.00', '0.00', '0', '53.00', 1, '0.00', '0.00', '', '', '0.00', 4, '1', 'ADMIN01', 'SUCURSAL1428567', '5', 'SIN DATO', 4, '1', 'SIN DATO', 0, '0.00', 1),
('5', '5', '2023-11-03 22:37:49', 1, 75, 'TIRA0000000001', '0.00', '0.00', '5.30', '0.00', '0.00', '0.00', '0', '5.30', 1, '0.00', '0.00', '', '', '0.00', 4, '1', 'ADMIN01', 'SUCURSAL1428567', '5', 'SIN DATO', 4, '1', 'SIN DATO', 0, '0.00', 1),
('6', '6', '2023-11-03 22:41:40', 1, 76, 'TIRA0000000001', '0.00', '0.00', '10.60', '0.00', '0.00', '0.00', '0', '10.60', 1, '0.00', '0.00', '', '', '0.00', 4, '2', 'ADMIN01', 'SUCURSAL1428567', '5', 'SIN DATO', 4, '1', 'SIN DATO', 0, '0.00', 1),
('7', '7', '2023-11-03 22:47:17', 1, 77, 'TIRA0000000001', '0.00', '0.00', '21.20', '0.00', '0.00', '0.00', '0', '21.20', 1, '0.00', '0.00', '', '', '0.00', 2, '1', 'ADMIN01', 'SUCURSAL1428567', '5', 'SIN DATO', 4, '1', 'SIN DATO', 0, '0.00', 1),
('8', '1', '2024-06-12 06:21:12', 1, 78, 'TIRA0000000001', '0.00', '0.00', '2121.00', '0.00', '0.00', '0.00', '0', '2121.00', 1, '2121.00', '2121.00', '', '', '0.00', 1, '1', 'ADMIN01', '4', '6', '', 4, '', '', 0, '0.00', 1),
('9', '2', '2024-08-08 22:14:06', 1, 1, '2', '2121.00', '0.00', '2121.00', '0.00', '0.00', '0.00', '0', '2121.00', 1, '0.00', '0.00', ' ', ' ', '0.00', 1, '1', 'ADMIN01', '4', '6', 'SIN DATO', 4, '', '', 0, '0.00', 1);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_almacenes`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_almacenes` (
`ID_ALMACEN` varchar(20)
,`NOMBRE` varchar(50)
,`DIRECCION` varchar(100)
,`ID_SUCURSAL` varchar(20)
,`ESTADO` int(1)
,`SUCURSAL` varchar(100)
,`LOGO` varchar(50)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_chat`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_chat` (
`ID_MENSAJE` varchar(20)
,`ID_ME` varchar(20)
,`ID_YOU` varchar(20)
,`FECHA_REGISTRO` datetime
,`MENSAJE` longtext
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_cliente`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_cliente` (
`ID_CLIENTE` varchar(20)
,`RAZON` varchar(100)
,`TIPO_DOCUMENTO` varchar(20)
,`N_DOCUMENTO` varchar(20)
,`LIMITE_CREDITICIO` double(40,2)
,`N_CREDITO` int(11)
,`DIRECCION` varchar(100)
,`TELEFONO` varchar(20)
,`CORREO` varchar(100)
,`ESTADO` int(11)
,`DOCUMENTO` varchar(50)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_compras`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_compras` (
`ID_COMPRA` varchar(20)
,`FECHA_COMPRA` datetime
,`ID_PROVEEDOR` varchar(20)
,`ID_ALMACEN` varchar(20)
,`TIPO_PAGO` varchar(11)
,`ID_COMPROBANTE` varchar(20)
,`N_COMPROBANTE` varchar(60)
,`FECHA_COMPROBANTE` date
,`SUMAS` decimal(40,2)
,`IVA` decimal(40,2)
,`SUBTOTAL` decimal(40,2)
,`EXENTO` decimal(40,2)
,`RETENIDO` decimal(40,2)
,`TOTAL_EXENTOS` int(11)
,`TOTAL` decimal(40,2)
,`ID_USUARIO` varchar(20)
,`ID_LOTE` varchar(20)
,`ESTADO` int(11)
,`N_COMPRA` varchar(20)
,`ID_ARQUEO` varchar(20)
,`ALMACEN` varchar(50)
,`SUCURSAL` varchar(20)
,`COMPROBANTE` varchar(50)
,`RAZON` varchar(100)
,`DOCUMENTO` varchar(50)
,`N_DOCUMENTO` varchar(20)
,`LOTE` varchar(30)
,`PERSONA` varchar(100)
,`PERFIL` varchar(100)
,`ID_PERSONA` varchar(20)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_comprobante`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_comprobante` (
`ID_COMPROBANTE` varchar(20)
,`COMPROBANTE` varchar(50)
,`ESTADO` int(11)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_consulta_items`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_consulta_items` (
`ID_ITEM` varchar(20)
,`ID_ALMACEN` varchar(20)
,`ID_LOTE` varchar(20)
,`ID_PRODUCTO` varchar(20)
,`PRECIO_COSTO` double(40,2)
,`PRECIO_VENTA_1` double(40,2)
,`PRECIO_VENTA_2` double(40,2)
,`PRECIO_VENTA_3` double(40,2)
,`PRECIO_VENTA_4` double(40,2)
,`CANTIDAD` int(11)
,`PERECEDERO` int(11)
,`FECHA_VEN` date
,`ID_USUARIO` varchar(20)
,`BARRA` varchar(30)
,`ARTICULO` varchar(100)
,`IMAGEN` varchar(200)
,`LINEA` varchar(50)
,`PRESENTACION` varchar(20)
,`LOTE` varchar(30)
,`ID_SUCURSAL` varchar(20)
,`ALMACEN` varchar(50)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_cotizacion`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_cotizacion` (
`ID_COTIZACION` varchar(20)
,`CODIGO_COTIZACION` varchar(20)
,`FECHA` datetime
,`TIPO_PAGO` int(11)
,`TIPO_ENTREGA` int(11)
,`SUMAS` decimal(40,2)
,`IVA` decimal(40,2)
,`EXENTO` decimal(40,2)
,`SUBTOTAL` decimal(40,2)
,`RETENIDO` decimal(40,2)
,`DESCUENTO` decimal(40,2)
,`DESCUENTO_PERCENT` varchar(20)
,`TOTAL` decimal(40,2)
,`PROD_EXENTOS` int(1)
,`ESTADO` int(1)
,`ID_CLIENTE` varchar(20)
,`ID_USUARIO` varchar(20)
,`ID_SUCURSAL` varchar(20)
,`PRECIO_RADIO` int(11)
,`RAZON` varchar(100)
,`DOCUMENTO` varchar(50)
,`N_DOCUMENTO` varchar(20)
,`ID_PERSONA` varchar(20)
,`NOMBRES` varchar(100)
,`APELLIDOS` varchar(100)
,`PERFIL` varchar(100)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_credito`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_credito` (
`ID_CREDITO` varchar(20)
,`ID_VENTA` varchar(20)
,`ID_SUCURSAL` varchar(20)
,`ID_CLIENTE` varchar(20)
,`ID_USUARIO` varchar(20)
,`CODIGO_CREDITO` varchar(20)
,`NOMBRE_CREDITO` varchar(100)
,`FECHA_CREDITO` datetime
,`FECHA_LIMITE` date
,`MONTO_CREDITO` decimal(40,2)
,`MONTO_ABONADO` decimal(40,2)
,`MONTO_RESTANTE` decimal(40,2)
,`ESTADO` int(1)
,`RAZON` varchar(100)
,`DOCUMENTO` varchar(50)
,`N_DOCUMENTO` varchar(20)
,`VENDEDOR` varchar(201)
,`PERFIL` varchar(100)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_detalle_cotizacion`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_detalle_cotizacion` (
`ID_DETALLE` varchar(20)
,`ID_ITEM` varchar(20)
,`ID_COTIZACION` varchar(20)
,`CANTIDAD` int(1)
,`PRECIO` decimal(40,2)
,`DESCUENTO` decimal(40,2)
,`SUBTOTAL` decimal(40,2)
,`TOTAL` decimal(40,2)
,`PERCENT_DESC` decimal(40,2)
,`PRECIO_1` decimal(40,2)
,`PRECIO_2` decimal(40,2)
,`PRECIO_3` decimal(40,2)
,`PRECIO_4` decimal(40,2)
,`ARTICULO` varchar(100)
,`IMAGEN` varchar(200)
,`STOCK_ACTUAL` int(11)
,`BARRA` varchar(30)
,`LINEA` varchar(50)
,`PRESENTACION` varchar(20)
,`ID_SUCURSAL` varchar(20)
,`FECHA` datetime
,`LOTE` varchar(30)
,`NOMBRES` varchar(100)
,`APELLIDOS` varchar(100)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_detalle_transferencia`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_detalle_transferencia` (
`ID_DETALLE` varchar(20)
,`ID_TRANSFERENCIA` varchar(20)
,`ID_PRODUCTO` varchar(20)
,`CANTIDAD` int(11)
,`STOCK` int(11)
,`ESTADO` int(11)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_detalle_venta`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_detalle_venta` (
`ID_DETALLE` varchar(20)
,`ID_ITEM` varchar(20)
,`ID_VENTA` varchar(20)
,`CANTIDAD` int(1)
,`PRECIO` decimal(40,2)
,`DESCUENTO` decimal(40,2)
,`SUBTOTAL` decimal(40,2)
,`TOTAL` decimal(40,2)
,`STOCK` int(11)
,`ARTICULO` varchar(100)
,`BARRA` varchar(30)
,`IMAGEN` varchar(200)
,`LINEA` varchar(50)
,`PRESENTACION` varchar(20)
,`STOCK_ACTUL` int(11)
,`ID_PRODUCTO` varchar(20)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_documento`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_documento` (
`ID_DOCUMENTO` varchar(20)
,`DOCUMENTO` varchar(50)
,`ESTADO` int(11)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_entradas`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_entradas` (
`ID_ENTRADA` varchar(20)
,`MES_INVENTARIO` varchar(20)
,`FECHA` date
,`DESCRIPCION` varchar(100)
,`CANTIDAD` int(11)
,`PRECIO_COSTO` double(40,2)
,`PRECIO_VENTA_1` double(40,2)
,`PRECIO_VENTA_2` double(40,2)
,`PRECIO_VENTA_3` double(40,2)
,`PRECIO_VENTA_4` double(40,2)
,`ID_PRODUCTO` varchar(20)
,`ID_COMPRA` varchar(20)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_historicos`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_historicos` (
`ID_ITEM` varchar(20)
,`ID_ALMACEN` varchar(20)
,`ID_LOTE` varchar(20)
,`ID_PRODUCTO` varchar(20)
,`PRECIO_COSTO` double(40,2)
,`PRECIO_VENTA_1` double(40,2)
,`PRECIO_VENTA_2` double(40,2)
,`PRECIO_VENTA_3` double(40,2)
,`PRECIO_VENTA_4` double(40,2)
,`CANTIDAD` int(11)
,`PERECEDERO` int(11)
,`ID_COMPRA` varchar(20)
,`FECHA_VENCIMIENTO` date
,`RAZON` varchar(100)
,`ID_SUCURSAL` varchar(20)
,`ARTICULO` varchar(100)
,`PRESENTACION` varchar(20)
,`LINEA` varchar(50)
,`COMPLEMENTO` varchar(200)
,`IMAGEN` varchar(200)
,`UNIDAD` varchar(100)
,`PREFIJO` varchar(50)
,`FECHA_COMPRA` datetime
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_items`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_items` (
`ID_ITEM` varchar(20)
,`ID_ALMACEN` varchar(20)
,`ID_LOTE` varchar(20)
,`ID_PRODUCTO` varchar(20)
,`PRECIO_COSTO` double(40,2)
,`PRECIO_VENTA_1` double(40,2)
,`PRECIO_VENTA_2` double(40,2)
,`PRECIO_VENTA_3` double(40,2)
,`PRECIO_VENTA_4` double(40,2)
,`CANTIDAD` int(11)
,`PERECEDERO` int(11)
,`FECHA_VEN` date
,`ID_USUARIO` varchar(20)
,`LOTE` varchar(30)
,`BARRA` varchar(30)
,`ARTICULO` varchar(100)
,`STOCK_1` int(11)
,`STOCK_2` int(11)
,`STOCK_3` int(11)
,`STOCK_4` int(11)
,`COMPLEMENTO` varchar(200)
,`IMAGEN` varchar(200)
,`STOCK_MINIMO` int(11)
,`STOCK_MODERADO` int(11)
,`STOCK_MEDIO` int(11)
,`EXENTO` int(11)
,`ID_PRESENTACION` varchar(20)
,`PRESENTACION` varchar(20)
,`LINEA` varchar(50)
,`ID_LINEA` varchar(20)
,`UNIDAD` varchar(100)
,`PREFIJO` varchar(50)
,`ALMACEN` varchar(50)
,`ID_SUCURSAL` varchar(20)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_items_compra`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_items_compra` (
`ID_ITEM` varchar(20)
,`ID_ALMACEN` varchar(20)
,`ID_LOTE` varchar(20)
,`ID_PRODUCTO` varchar(20)
,`PRECIO_COSTO` double(40,2)
,`PRECIO_VENTA_1` double(40,2)
,`PRECIO_VENTA_2` double(40,2)
,`PRECIO_VENTA_3` double(40,2)
,`PRECIO_VENTA_4` double(40,2)
,`CANTIDAD` int(11)
,`PERECEDERO` int(11)
,`ID_COMPRA` varchar(20)
,`FECHA_VENCIMIENTO` date
,`BARRA` varchar(30)
,`ARTICULO` varchar(100)
,`LINEA` varchar(50)
,`PRESENTACION` varchar(20)
,`IMAGEN` varchar(200)
,`LOTE` varchar(30)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_lineas`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_lineas` (
`ID_LINEA` varchar(20)
,`LINEA` varchar(50)
,`ESTADO` int(11)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_lotes`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_lotes` (
`ID_LOTE` varchar(20)
,`NOMBRE` varchar(30)
,`ID_ALMACEN` varchar(20)
,`FECHA_REGISTRO` date
,`ESTADO` int(11)
,`ALMACEN` varchar(50)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_perecederos`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_perecederos` (
`ID_PERECEDERO` varchar(20)
,`ID_ITEM` varchar(20)
,`ID_PRODUCTO` varchar(20)
,`ID_ALMACEN` varchar(20)
,`ID_SUCURSAL` varchar(20)
,`FECHA_1` date
,`FECHA_2` date
,`FECHA_3` date
,`FECHA_4` date
,`BARRA` varchar(30)
,`ARTICULO` varchar(100)
,`IMAGEN` varchar(200)
,`LINEA` varchar(50)
,`PRESENTACION` varchar(20)
,`ALMACEN` varchar(50)
,`SUCURSAL` varchar(100)
,`CANTIDAD` int(11)
,`LOTE` varchar(30)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_personas`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_personas` (
`ID_PERSONA` varchar(20)
,`NOMBRES` varchar(100)
,`APELLIDOS` varchar(100)
,`ID_DOCUMENTO` varchar(20)
,`NUMERO` varchar(25)
,`DIRECCION` varchar(100)
,`TELEFONO` varchar(20)
,`PERFIL` varchar(100)
,`ESTADO` int(1)
,`DOCUMENTO` varchar(50)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_presentacion`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_presentacion` (
`ID_PRESENTACION` varchar(20)
,`NOMBRE` varchar(20)
,`ESTADO` int(11)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_productos`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_productos` (
`ID_PRODUCTO` varchar(20)
,`BARRA` varchar(30)
,`ARTICULO` varchar(100)
,`ID_PRESENTACION` varchar(20)
,`ID_LINEA` varchar(20)
,`ID_UNIDAD` varchar(20)
,`COMPLEMENTO` varchar(200)
,`PRECIO_COSTO` double(12,2)
,`PRECIO_VENTA_1` double(12,2)
,`PRECIO_VENTA_2` double(12,2)
,`PRECIO_VENTA_3` double(12,2)
,`PRECIO_VENTA_4` double(12,2)
,`PRECIO_VENTA_5` decimal(10,2)
,`PRECIO_VENTA_6` decimal(10,2)
,`PRECIO_VENTA_7` decimal(10,2)
,`STOCK_MINIMO` int(11)
,`STOCK_MEDIO` int(11)
,`STOCK_MODERADO` int(11)
,`PERECEDERO` int(11)
,`EXENTO` int(11)
,`ESTADO` int(11)
,`IMAGEN` varchar(200)
,`LINEA` varchar(50)
,`NOMBRE` varchar(20)
,`UNIDAD` varchar(100)
,`PREFIJO` varchar(50)
,`MEDIDA_1` varchar(15)
,`MEDIDA_2` varchar(15)
,`MEDIDA_3` varchar(15)
,`MEDIDA_4` varchar(15)
,`MEDIDA_5` text
,`MEDIDA_6` text
,`MEDIDA_7` text
,`STOCK_1` int(11)
,`STOCK_2` int(11)
,`STOCK_3` int(11)
,`STOCK_4` int(11)
,`STOCK_5` int(11)
,`STOCK_6` int(11)
,`STOCK_7` int(11)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_productos_venta`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_productos_venta` (
`ID_DETALLE` varchar(20)
,`ID_ITEM` varchar(20)
,`ID_VENTA` varchar(20)
,`CANTIDAD` int(1)
,`PRECIO` decimal(40,2)
,`DESCUENTO` decimal(40,2)
,`SUBTOTAL` decimal(40,2)
,`TOTAL` decimal(40,2)
,`STOCK` int(11)
,`FECHA_RESOLUCION` datetime
,`BARRA` varchar(30)
,`ARTICULO` varchar(100)
,`IMAGEN` varchar(200)
,`LINEA` varchar(50)
,`COMPLEMENTO` varchar(200)
,`UNIDAD` varchar(100)
,`PREFIJO` varchar(50)
,`ID_SUCURSAL` varchar(20)
,`N_VENTA` varchar(20)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_proveedores`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_proveedores` (
`ID_PROVEEDOR` varchar(20)
,`RAZON` varchar(100)
,`TIPO_DOCUMENTO` varchar(20)
,`N_DOCUMENTO` varchar(20)
,`DIRECCION` varchar(100)
,`TELEFONO` varchar(20)
,`CORREO` varchar(100)
,`CUENTA` varchar(50)
,`VENDEDOR` varchar(100)
,`V_TELEFONO` varchar(100)
,`ESTADO` int(11)
,`DOCUMENTO` varchar(50)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_seccion`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_seccion` (
`ID_SECCION` varchar(20)
,`SECCION` varchar(100)
,`ESTADO` int(11)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_sucursales`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_sucursales` (
`ID_SUCURSAL` varchar(20)
,`NOMBRE` varchar(100)
,`ID_DOCUMENTO` varchar(20)
,`NUMERO` varchar(25)
,`IVA` varchar(10)
,`MONEDA` varchar(20)
,`DIRECCION` varchar(100)
,`TELEFONO` varchar(20)
,`EMAIL` varchar(70)
,`REPRESENTANTE` varchar(150)
,`LOGO` varchar(50)
,`ESTADO` int(1)
,`DOCUMENTO` varchar(50)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_tirajes`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_tirajes` (
`ID_TIRAJE` varchar(20)
,`FECHA_RESOLUCION` date
,`NRO_RESOLUCION` varchar(100)
,`NRO_RESOLUCION_FAC` varchar(100)
,`SERIE` varchar(100)
,`DESDE` varchar(100)
,`HASTA` varchar(100)
,`ID_COMPROBANTE` varchar(20)
,`ID_SUCURSAL` varchar(20)
,`ESTADO` int(11)
,`DISPONIBLES` int(11)
,`COMPROBANTE` varchar(50)
,`SUCURSAL` varchar(100)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_transferencias`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_transferencias` (
`ID_TRANSFERENCIA` varchar(20)
,`FECHA` date
,`MOTIVO` text
,`ID_ALMACEN_ORIGEN` varchar(20)
,`ID_ALMACEN_DESTINO` varchar(20)
,`ID_USUARIO` varchar(20)
,`ESTADO` int(11)
,`ALMACEN_ORIGEN` varchar(50)
,`SUCURSAL_ORIGEN` varchar(20)
,`SUCURSAL_NAME_ORIGEN` varchar(100)
,`SUCURSAL_LOGO_ORIGEN` varchar(50)
,`ALMACEN_DESTINO` varchar(50)
,`SUCURSAL_DESTINO` varchar(20)
,`SUCURSAL_NAME_DESTINO` varchar(100)
,`SUCURSAL_LOGO_DESTINO` varchar(50)
,`NOMBRE_PERSONA` varchar(100)
,`PERFIL` varchar(100)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_unidades_medida`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_unidades_medida` (
`ID_UNIDAD` varchar(20)
,`UNIDAD` varchar(100)
,`PREFIJO` varchar(50)
,`ESTADO` int(11)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_usuarios`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_usuarios` (
`ID_USUARIO` varchar(20)
,`EMAIL` varchar(100)
,`PASSWORD` varchar(100)
,`ID_PERSONA` varchar(20)
,`FECHA_REGISTRO` date
,`ESTADO` int(1)
,`NOMBRES` varchar(100)
,`APELLIDOS` varchar(100)
,`PERFIL` varchar(100)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_ventas`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_ventas` (
`ID_VENTA` varchar(20)
,`N_VENTA` varchar(20)
,`FECHA_RESOLUCION` datetime
,`TIPO_PAGO` int(11)
,`NUMERO_COMPROBANTE` int(1)
,`ID_COMPROBANTE` varchar(20)
,`SUMAS` decimal(40,2)
,`IVA` decimal(40,2)
,`EXENTO` decimal(40,2)
,`SUBTOTAL` decimal(40,2)
,`RETENIDO` decimal(40,2)
,`DESCUENTO` decimal(40,2)
,`DESCUENTO_PERCENT` varchar(20)
,`TOTAL` decimal(40,2)
,`PROD_EXENTOS` int(1)
,`PAGO_EFECTIVO` decimal(40,2)
,`PAGO_TARJETA` decimal(40,2)
,`NUMERO_TARJETA` varchar(20)
,`TARJETA_HABITANTE` varchar(90)
,`CAMBIO` decimal(40,2)
,`ESTADO` int(1)
,`ID_CLIENTE` varchar(20)
,`ID_USUARIO` varchar(20)
,`ID_SUCURSAL` varchar(20)
,`PAGO_INMEDIATO` int(11)
,`PAGOS_A_VENTA` decimal(8,2)
,`ID_ARQUEO` varchar(20)
,`OBSERVACION` longtext
,`PRECIO_RADIO` int(11)
,`COMPROBANTE` varchar(50)
,`RAZON` varchar(100)
,`DOCUMENTO` varchar(50)
,`N_DOCUMENTO` varchar(20)
,`TELEFONO` varchar(20)
,`NOMBRES` varchar(100)
,`APELLIDOS` varchar(100)
,`PERFIL` varchar(100)
,`SUCURSAL` varchar(100)
,`ID_PERSONA` varchar(20)
,`LOGO` varchar(50)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_almacenes`
--
DROP TABLE IF EXISTS `vista_almacenes`;

CREATE  VIEW `vista_almacenes`  AS SELECT `a`.`ID_ALMACEN` AS `ID_ALMACEN`, `a`.`NOMBRE` AS `NOMBRE`, `a`.`DIRECCION` AS `DIRECCION`, `a`.`ID_SUCURSAL` AS `ID_SUCURSAL`, `a`.`ESTADO` AS `ESTADO`, `s`.`NOMBRE` AS `SUCURSAL`, `s`.`LOGO` AS `LOGO` FROM (`almacen` `a` join `sucursal` `s` on(`a`.`ID_SUCURSAL` = `s`.`ID_SUCURSAL`))  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_chat`
--
DROP TABLE IF EXISTS `vista_chat`;

CREATE  VIEW `vista_chat`  AS SELECT `chat`.`ID_MENSAJE` AS `ID_MENSAJE`, `chat`.`ID_ME` AS `ID_ME`, `chat`.`ID_YOU` AS `ID_YOU`, `chat`.`FECHA_REGISTRO` AS `FECHA_REGISTRO`, `chat`.`MENSAJE` AS `MENSAJE` FROM `chat`  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_cliente`
--
DROP TABLE IF EXISTS `vista_cliente`;

CREATE  VIEW `vista_cliente`  AS SELECT `c`.`ID_CLIENTE` AS `ID_CLIENTE`, `c`.`RAZON` AS `RAZON`, `c`.`TIPO_DOCUMENTO` AS `TIPO_DOCUMENTO`, `c`.`N_DOCUMENTO` AS `N_DOCUMENTO`, `c`.`LIMITE_CREDITICIO` AS `LIMITE_CREDITICIO`, `c`.`N_CREDITO` AS `N_CREDITO`, `c`.`DIRECCION` AS `DIRECCION`, `c`.`TELEFONO` AS `TELEFONO`, `c`.`CORREO` AS `CORREO`, `c`.`ESTADO` AS `ESTADO`, `d`.`DOCUMENTO` AS `DOCUMENTO` FROM (`cliente` `c` join `documento` `d` on(`c`.`TIPO_DOCUMENTO` = `d`.`ID_DOCUMENTO`))  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_compras`
--
DROP TABLE IF EXISTS `vista_compras`;

CREATE  VIEW `vista_compras`  AS SELECT `c`.`ID_COMPRA` AS `ID_COMPRA`, `c`.`FECHA_COMPRA` AS `FECHA_COMPRA`, `c`.`ID_PROVEEDOR` AS `ID_PROVEEDOR`, `c`.`ID_ALMACEN` AS `ID_ALMACEN`, `c`.`TIPO_PAGO` AS `TIPO_PAGO`, `c`.`ID_COMPROBANTE` AS `ID_COMPROBANTE`, `c`.`N_COMPROBANTE` AS `N_COMPROBANTE`, `c`.`FECHA_COMPROBANTE` AS `FECHA_COMPROBANTE`, `c`.`SUMAS` AS `SUMAS`, `c`.`IVA` AS `IVA`, `c`.`SUBTOTAL` AS `SUBTOTAL`, `c`.`EXENTO` AS `EXENTO`, `c`.`RETENIDO` AS `RETENIDO`, `c`.`TOTAL_EXENTOS` AS `TOTAL_EXENTOS`, `c`.`TOTAL` AS `TOTAL`, `c`.`ID_USUARIO` AS `ID_USUARIO`, `c`.`ID_LOTE` AS `ID_LOTE`, `c`.`ESTADO` AS `ESTADO`, `c`.`N_COMPRA` AS `N_COMPRA`, `c`.`ID_ARQUEO` AS `ID_ARQUEO`, `a`.`NOMBRE` AS `ALMACEN`, `a`.`ID_SUCURSAL` AS `SUCURSAL`, `com`.`COMPROBANTE` AS `COMPROBANTE`, `pro`.`RAZON` AS `RAZON`, `d`.`DOCUMENTO` AS `DOCUMENTO`, `pro`.`N_DOCUMENTO` AS `N_DOCUMENTO`, `lo`.`NOMBRE` AS `LOTE`, `per`.`NOMBRES` AS `PERSONA`, `per`.`PERFIL` AS `PERFIL`, `per`.`ID_PERSONA` AS `ID_PERSONA` FROM (((((((`compras` `c` join `almacen` `a` on(`a`.`ID_ALMACEN` = `c`.`ID_ALMACEN`)) join `comprobante` `com` on(`com`.`ID_COMPROBANTE` = `c`.`ID_COMPROBANTE`)) join `proveedor` `pro` on(`pro`.`ID_PROVEEDOR` = `c`.`ID_PROVEEDOR`)) join `lote` `lo` on(`lo`.`ID_LOTE` = `c`.`ID_LOTE`)) join `documento` `d` on(`d`.`ID_DOCUMENTO` = `pro`.`TIPO_DOCUMENTO`)) join `usuario` `u` on(`u`.`ID_USUARIO` = `c`.`ID_USUARIO`)) join `persona` `per` on(`per`.`ID_PERSONA` = `u`.`ID_PERSONA`))  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_comprobante`
--
DROP TABLE IF EXISTS `vista_comprobante`;

CREATE  VIEW `vista_comprobante`  AS SELECT `c`.`ID_COMPROBANTE` AS `ID_COMPROBANTE`, `c`.`COMPROBANTE` AS `COMPROBANTE`, `c`.`ESTADO` AS `ESTADO` FROM `comprobante` AS `c`  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_consulta_items`
--
DROP TABLE IF EXISTS `vista_consulta_items`;

CREATE  VIEW `vista_consulta_items`  AS SELECT `il`.`ID_ITEM` AS `ID_ITEM`, `il`.`ID_ALMACEN` AS `ID_ALMACEN`, `il`.`ID_LOTE` AS `ID_LOTE`, `il`.`ID_PRODUCTO` AS `ID_PRODUCTO`, `il`.`PRECIO_COSTO` AS `PRECIO_COSTO`, `il`.`PRECIO_VENTA_1` AS `PRECIO_VENTA_1`, `il`.`PRECIO_VENTA_2` AS `PRECIO_VENTA_2`, `il`.`PRECIO_VENTA_3` AS `PRECIO_VENTA_3`, `il`.`PRECIO_VENTA_4` AS `PRECIO_VENTA_4`, `il`.`CANTIDAD` AS `CANTIDAD`, `il`.`PERECEDERO` AS `PERECEDERO`, `il`.`FECHA_VEN` AS `FECHA_VEN`, `il`.`ID_USUARIO` AS `ID_USUARIO`, `pro`.`BARRA` AS `BARRA`, `pro`.`ARTICULO` AS `ARTICULO`, `pro`.`IMAGEN` AS `IMAGEN`, `li`.`LINEA` AS `LINEA`, `pre`.`NOMBRE` AS `PRESENTACION`, `lt`.`NOMBRE` AS `LOTE`, `alm`.`ID_SUCURSAL` AS `ID_SUCURSAL`, `alm`.`NOMBRE` AS `ALMACEN` FROM (((((`items_lote` `il` join `producto` `pro` on(`pro`.`ID_PRODUCTO` = `il`.`ID_PRODUCTO`)) join `linea` `li` on(`li`.`ID_LINEA` = `pro`.`ID_LINEA`)) join `presentacion` `pre` on(`pre`.`ID_PRESENTACION` = `pro`.`ID_PRESENTACION`)) join `lote` `lt` on(`lt`.`ID_LOTE` = `il`.`ID_LOTE`)) join `almacen` `alm` on(`alm`.`ID_ALMACEN` = `il`.`ID_ALMACEN`))  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_cotizacion`
--
DROP TABLE IF EXISTS `vista_cotizacion`;

CREATE  VIEW `vista_cotizacion`  AS SELECT `c`.`ID_COTIZACION` AS `ID_COTIZACION`, `c`.`CODIGO_COTIZACION` AS `CODIGO_COTIZACION`, `c`.`FECHA` AS `FECHA`, `c`.`TIPO_PAGO` AS `TIPO_PAGO`, `c`.`TIPO_ENTREGA` AS `TIPO_ENTREGA`, `c`.`SUMAS` AS `SUMAS`, `c`.`IVA` AS `IVA`, `c`.`EXENTO` AS `EXENTO`, `c`.`SUBTOTAL` AS `SUBTOTAL`, `c`.`RETENIDO` AS `RETENIDO`, `c`.`DESCUENTO` AS `DESCUENTO`, `c`.`DESCUENTO_PERCENT` AS `DESCUENTO_PERCENT`, `c`.`TOTAL` AS `TOTAL`, `c`.`PROD_EXENTOS` AS `PROD_EXENTOS`, `c`.`ESTADO` AS `ESTADO`, `c`.`ID_CLIENTE` AS `ID_CLIENTE`, `c`.`ID_USUARIO` AS `ID_USUARIO`, `c`.`ID_SUCURSAL` AS `ID_SUCURSAL`, `c`.`PRECIO_RADIO` AS `PRECIO_RADIO`, `cl`.`RAZON` AS `RAZON`, `doc`.`DOCUMENTO` AS `DOCUMENTO`, `cl`.`N_DOCUMENTO` AS `N_DOCUMENTO`, `per`.`ID_PERSONA` AS `ID_PERSONA`, `per`.`NOMBRES` AS `NOMBRES`, `per`.`APELLIDOS` AS `APELLIDOS`, `per`.`PERFIL` AS `PERFIL` FROM ((((`cotizacion` `c` join `cliente` `cl` on(`cl`.`ID_CLIENTE` = `c`.`ID_CLIENTE`)) join `documento` `doc` on(`cl`.`TIPO_DOCUMENTO` = `doc`.`ID_DOCUMENTO`)) join `usuario` `u` on(`u`.`ID_USUARIO` = `c`.`ID_USUARIO`)) join `persona` `per` on(`per`.`ID_PERSONA` = `u`.`ID_PERSONA`))  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_credito`
--
DROP TABLE IF EXISTS `vista_credito`;

CREATE  VIEW `vista_credito`  AS SELECT `c`.`ID_CREDITO` AS `ID_CREDITO`, `c`.`ID_VENTA` AS `ID_VENTA`, `c`.`ID_SUCURSAL` AS `ID_SUCURSAL`, `c`.`ID_CLIENTE` AS `ID_CLIENTE`, `c`.`ID_USUARIO` AS `ID_USUARIO`, `c`.`CODIGO_CREDITO` AS `CODIGO_CREDITO`, `c`.`NOMBRE_CREDITO` AS `NOMBRE_CREDITO`, `c`.`FECHA_CREDITO` AS `FECHA_CREDITO`, `c`.`FECHA_LIMITE` AS `FECHA_LIMITE`, `c`.`MONTO_CREDITO` AS `MONTO_CREDITO`, `c`.`MONTO_ABONADO` AS `MONTO_ABONADO`, `c`.`MONTO_RESTANTE` AS `MONTO_RESTANTE`, `c`.`ESTADO` AS `ESTADO`, `cl`.`RAZON` AS `RAZON`, `doc`.`DOCUMENTO` AS `DOCUMENTO`, `cl`.`N_DOCUMENTO` AS `N_DOCUMENTO`, concat(`p`.`NOMBRES`,' ',`p`.`APELLIDOS`) AS `VENDEDOR`, `p`.`PERFIL` AS `PERFIL` FROM ((((`credito` `c` join `cliente` `cl` on(`c`.`ID_CLIENTE` = `cl`.`ID_CLIENTE`)) join `usuario` `u` on(`u`.`ID_USUARIO` = `c`.`ID_USUARIO`)) join `persona` `p` on(`p`.`ID_PERSONA` = `u`.`ID_PERSONA`)) join `documento` `doc` on(`doc`.`ID_DOCUMENTO` = `cl`.`TIPO_DOCUMENTO`))  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_detalle_cotizacion`
--
DROP TABLE IF EXISTS `vista_detalle_cotizacion`;

CREATE  VIEW `vista_detalle_cotizacion`  AS SELECT `d`.`ID_DETALLE` AS `ID_DETALLE`, `d`.`ID_ITEM` AS `ID_ITEM`, `d`.`ID_COTIZACION` AS `ID_COTIZACION`, `d`.`CANTIDAD` AS `CANTIDAD`, `d`.`PRECIO` AS `PRECIO`, `d`.`DESCUENTO` AS `DESCUENTO`, `d`.`SUBTOTAL` AS `SUBTOTAL`, `d`.`TOTAL` AS `TOTAL`, `d`.`PERCENT_DESC` AS `PERCENT_DESC`, `d`.`PRECIO_1` AS `PRECIO_1`, `d`.`PRECIO_2` AS `PRECIO_2`, `d`.`PRECIO_3` AS `PRECIO_3`, `d`.`PRECIO_4` AS `PRECIO_4`, `p`.`ARTICULO` AS `ARTICULO`, `p`.`IMAGEN` AS `IMAGEN`, `l`.`CANTIDAD` AS `STOCK_ACTUAL`, `p`.`BARRA` AS `BARRA`, `li`.`LINEA` AS `LINEA`, `pre`.`NOMBRE` AS `PRESENTACION`, `cot`.`ID_SUCURSAL` AS `ID_SUCURSAL`, `cot`.`FECHA` AS `FECHA`, `lot`.`NOMBRE` AS `LOTE`, `per`.`NOMBRES` AS `NOMBRES`, `per`.`APELLIDOS` AS `APELLIDOS` FROM ((((((((`detalle_cotizacion` `d` join `items_lote` `l` on(`l`.`ID_ITEM` = `d`.`ID_ITEM`)) join `producto` `p` on(`l`.`ID_PRODUCTO` = `p`.`ID_PRODUCTO`)) join `linea` `li` on(`li`.`ID_LINEA` = `p`.`ID_LINEA`)) join `presentacion` `pre` on(`pre`.`ID_PRESENTACION` = `p`.`ID_PRESENTACION`)) join `cotizacion` `cot` on(`cot`.`ID_COTIZACION` = `d`.`ID_COTIZACION`)) join `lote` `lot` on(`l`.`ID_LOTE` = `lot`.`ID_LOTE`)) join `usuario` `u` on(`u`.`ID_USUARIO` = `cot`.`ID_USUARIO`)) join `persona` `per` on(`per`.`ID_PERSONA` = `u`.`ID_PERSONA`))  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_detalle_transferencia`
--
DROP TABLE IF EXISTS `vista_detalle_transferencia`;

CREATE  VIEW `vista_detalle_transferencia`  AS SELECT `d`.`ID_DETALLE` AS `ID_DETALLE`, `d`.`ID_TRANSFERENCIA` AS `ID_TRANSFERENCIA`, `d`.`ID_PRODUCTO` AS `ID_PRODUCTO`, `d`.`CANTIDAD` AS `CANTIDAD`, `d`.`STOCK` AS `STOCK`, `d`.`ESTADO` AS `ESTADO` FROM `detalle_transferencia` AS `d`  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_detalle_venta`
--
DROP TABLE IF EXISTS `vista_detalle_venta`;

CREATE  VIEW `vista_detalle_venta`  AS SELECT `d`.`ID_DETALLE` AS `ID_DETALLE`, `d`.`ID_ITEM` AS `ID_ITEM`, `d`.`ID_VENTA` AS `ID_VENTA`, `d`.`CANTIDAD` AS `CANTIDAD`, `d`.`PRECIO` AS `PRECIO`, `d`.`DESCUENTO` AS `DESCUENTO`, `d`.`SUBTOTAL` AS `SUBTOTAL`, `d`.`TOTAL` AS `TOTAL`, `d`.`STOCK` AS `STOCK`, `p`.`ARTICULO` AS `ARTICULO`, `p`.`BARRA` AS `BARRA`, `p`.`IMAGEN` AS `IMAGEN`, `l`.`LINEA` AS `LINEA`, `pre`.`NOMBRE` AS `PRESENTACION`, `il`.`CANTIDAD` AS `STOCK_ACTUL`, `p`.`ID_PRODUCTO` AS `ID_PRODUCTO` FROM ((((`detalle_venta` `d` join `items_lote` `il` on(`il`.`ID_ITEM` = `d`.`ID_ITEM`)) join `producto` `p` on(`il`.`ID_PRODUCTO` = `p`.`ID_PRODUCTO`)) join `linea` `l` on(`l`.`ID_LINEA` = `p`.`ID_LINEA`)) join `presentacion` `pre` on(`pre`.`ID_PRESENTACION` = `p`.`ID_PRESENTACION`))  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_documento`
--
DROP TABLE IF EXISTS `vista_documento`;

CREATE  VIEW `vista_documento`  AS SELECT `d`.`ID_DOCUMENTO` AS `ID_DOCUMENTO`, `d`.`DOCUMENTO` AS `DOCUMENTO`, `d`.`ESTADO` AS `ESTADO` FROM `documento` AS `d`  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_entradas`
--
DROP TABLE IF EXISTS `vista_entradas`;

CREATE  VIEW `vista_entradas`  AS SELECT `entrada`.`ID_ENTRADA` AS `ID_ENTRADA`, `entrada`.`MES_INVENTARIO` AS `MES_INVENTARIO`, `entrada`.`FECHA` AS `FECHA`, `entrada`.`DESCRIPCION` AS `DESCRIPCION`, `entrada`.`CANTIDAD` AS `CANTIDAD`, `entrada`.`PRECIO_COSTO` AS `PRECIO_COSTO`, `entrada`.`PRECIO_VENTA_1` AS `PRECIO_VENTA_1`, `entrada`.`PRECIO_VENTA_2` AS `PRECIO_VENTA_2`, `entrada`.`PRECIO_VENTA_3` AS `PRECIO_VENTA_3`, `entrada`.`PRECIO_VENTA_4` AS `PRECIO_VENTA_4`, `entrada`.`ID_PRODUCTO` AS `ID_PRODUCTO`, `entrada`.`ID_COMPRA` AS `ID_COMPRA` FROM `entrada`  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_historicos`
--
DROP TABLE IF EXISTS `vista_historicos`;

CREATE  VIEW `vista_historicos`  AS SELECT `i`.`ID_ITEM` AS `ID_ITEM`, `i`.`ID_ALMACEN` AS `ID_ALMACEN`, `i`.`ID_LOTE` AS `ID_LOTE`, `i`.`ID_PRODUCTO` AS `ID_PRODUCTO`, `i`.`PRECIO_COSTO` AS `PRECIO_COSTO`, `i`.`PRECIO_VENTA_1` AS `PRECIO_VENTA_1`, `i`.`PRECIO_VENTA_2` AS `PRECIO_VENTA_2`, `i`.`PRECIO_VENTA_3` AS `PRECIO_VENTA_3`, `i`.`PRECIO_VENTA_4` AS `PRECIO_VENTA_4`, `i`.`CANTIDAD` AS `CANTIDAD`, `i`.`PERECEDERO` AS `PERECEDERO`, `i`.`ID_COMPRA` AS `ID_COMPRA`, `i`.`FECHA_VENCIMIENTO` AS `FECHA_VENCIMIENTO`, `pro`.`RAZON` AS `RAZON`, `a`.`ID_SUCURSAL` AS `ID_SUCURSAL`, `p`.`ARTICULO` AS `ARTICULO`, `pre`.`NOMBRE` AS `PRESENTACION`, `l`.`LINEA` AS `LINEA`, `p`.`COMPLEMENTO` AS `COMPLEMENTO`, `p`.`IMAGEN` AS `IMAGEN`, `um`.`UNIDAD` AS `UNIDAD`, `um`.`PREFIJO` AS `PREFIJO`, `c`.`FECHA_COMPRA` AS `FECHA_COMPRA` FROM (((((((`items_compra` `i` join `compras` `c` on(`c`.`ID_COMPRA` = `i`.`ID_COMPRA`)) join `proveedor` `pro` on(`pro`.`ID_PROVEEDOR` = `c`.`ID_PROVEEDOR`)) join `almacen` `a` on(`a`.`ID_ALMACEN` = `i`.`ID_ALMACEN`)) join `producto` `p` on(`p`.`ID_PRODUCTO` = `i`.`ID_PRODUCTO`)) join `presentacion` `pre` on(`pre`.`ID_PRESENTACION` = `p`.`ID_PRESENTACION`)) join `linea` `l` on(`l`.`ID_LINEA` = `p`.`ID_LINEA`)) join `unidad_medida` `um` on(`um`.`ID_UNIDAD` = `p`.`ID_UNIDAD`))  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_items`
--
DROP TABLE IF EXISTS `vista_items`;

CREATE  VIEW `vista_items`  AS SELECT `i`.`ID_ITEM` AS `ID_ITEM`, `i`.`ID_ALMACEN` AS `ID_ALMACEN`, `i`.`ID_LOTE` AS `ID_LOTE`, `i`.`ID_PRODUCTO` AS `ID_PRODUCTO`, `i`.`PRECIO_COSTO` AS `PRECIO_COSTO`, `i`.`PRECIO_VENTA_1` AS `PRECIO_VENTA_1`, `i`.`PRECIO_VENTA_2` AS `PRECIO_VENTA_2`, `i`.`PRECIO_VENTA_3` AS `PRECIO_VENTA_3`, `i`.`PRECIO_VENTA_4` AS `PRECIO_VENTA_4`, `i`.`CANTIDAD` AS `CANTIDAD`, `i`.`PERECEDERO` AS `PERECEDERO`, `i`.`FECHA_VEN` AS `FECHA_VEN`, `i`.`ID_USUARIO` AS `ID_USUARIO`, `lo`.`NOMBRE` AS `LOTE`, `prod`.`BARRA` AS `BARRA`, `prod`.`ARTICULO` AS `ARTICULO`, `prod`.`STOCK_1` AS `STOCK_1`, `prod`.`STOCK_2` AS `STOCK_2`, `prod`.`STOCK_3` AS `STOCK_3`, `prod`.`STOCK_4` AS `STOCK_4`, `prod`.`COMPLEMENTO` AS `COMPLEMENTO`, `prod`.`IMAGEN` AS `IMAGEN`, `prod`.`STOCK_MINIMO` AS `STOCK_MINIMO`, `prod`.`STOCK_MODERADO` AS `STOCK_MODERADO`, `prod`.`STOCK_MEDIO` AS `STOCK_MEDIO`, `prod`.`EXENTO` AS `EXENTO`, `pre`.`ID_PRESENTACION` AS `ID_PRESENTACION`, `pre`.`NOMBRE` AS `PRESENTACION`, `l`.`LINEA` AS `LINEA`, `l`.`ID_LINEA` AS `ID_LINEA`, `um`.`UNIDAD` AS `UNIDAD`, `um`.`PREFIJO` AS `PREFIJO`, `a`.`NOMBRE` AS `ALMACEN`, `a`.`ID_SUCURSAL` AS `ID_SUCURSAL` FROM ((((((`items_lote` `i` join `producto` `prod` on(`prod`.`ID_PRODUCTO` = `i`.`ID_PRODUCTO`)) join `presentacion` `pre` on(`pre`.`ID_PRESENTACION` = `prod`.`ID_PRESENTACION`)) join `linea` `l` on(`l`.`ID_LINEA` = `prod`.`ID_LINEA`)) join `unidad_medida` `um` on(`um`.`ID_UNIDAD` = `prod`.`ID_UNIDAD`)) join `lote` `lo` on(`lo`.`ID_LOTE` = `i`.`ID_LOTE`)) join `almacen` `a` on(`a`.`ID_ALMACEN` = `i`.`ID_ALMACEN`))  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_items_compra`
--
DROP TABLE IF EXISTS `vista_items_compra`;

CREATE  VIEW `vista_items_compra`  AS SELECT `ic`.`ID_ITEM` AS `ID_ITEM`, `ic`.`ID_ALMACEN` AS `ID_ALMACEN`, `ic`.`ID_LOTE` AS `ID_LOTE`, `ic`.`ID_PRODUCTO` AS `ID_PRODUCTO`, `ic`.`PRECIO_COSTO` AS `PRECIO_COSTO`, `ic`.`PRECIO_VENTA_1` AS `PRECIO_VENTA_1`, `ic`.`PRECIO_VENTA_2` AS `PRECIO_VENTA_2`, `ic`.`PRECIO_VENTA_3` AS `PRECIO_VENTA_3`, `ic`.`PRECIO_VENTA_4` AS `PRECIO_VENTA_4`, `ic`.`CANTIDAD` AS `CANTIDAD`, `ic`.`PERECEDERO` AS `PERECEDERO`, `ic`.`ID_COMPRA` AS `ID_COMPRA`, `ic`.`FECHA_VENCIMIENTO` AS `FECHA_VENCIMIENTO`, `p`.`BARRA` AS `BARRA`, `p`.`ARTICULO` AS `ARTICULO`, `l`.`LINEA` AS `LINEA`, `pre`.`NOMBRE` AS `PRESENTACION`, `p`.`IMAGEN` AS `IMAGEN`, `lo`.`NOMBRE` AS `LOTE` FROM ((((`items_compra` `ic` join `producto` `p` on(`p`.`ID_PRODUCTO` = `ic`.`ID_PRODUCTO`)) join `linea` `l` on(`l`.`ID_LINEA` = `p`.`ID_LINEA`)) join `presentacion` `pre` on(`pre`.`ID_PRESENTACION` = `p`.`ID_PRESENTACION`)) join `lote` `lo` on(`ic`.`ID_LOTE` = `lo`.`ID_LOTE`))  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_lineas`
--
DROP TABLE IF EXISTS `vista_lineas`;

CREATE  VIEW `vista_lineas`  AS SELECT `l`.`ID_LINEA` AS `ID_LINEA`, `l`.`LINEA` AS `LINEA`, `l`.`ESTADO` AS `ESTADO` FROM `linea` AS `l`  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_lotes`
--
DROP TABLE IF EXISTS `vista_lotes`;

CREATE  VIEW `vista_lotes`  AS SELECT `l`.`ID_LOTE` AS `ID_LOTE`, `l`.`NOMBRE` AS `NOMBRE`, `l`.`ID_ALMACEN` AS `ID_ALMACEN`, `l`.`FECHA_REGISTRO` AS `FECHA_REGISTRO`, `l`.`ESTADO` AS `ESTADO`, `a`.`NOMBRE` AS `ALMACEN` FROM (`lote` `l` join `almacen` `a` on(`a`.`ID_ALMACEN` = `l`.`ID_ALMACEN`))  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_perecederos`
--
DROP TABLE IF EXISTS `vista_perecederos`;

CREATE  VIEW `vista_perecederos`  AS SELECT `p`.`ID_PERECEDERO` AS `ID_PERECEDERO`, `p`.`ID_ITEM` AS `ID_ITEM`, `p`.`ID_PRODUCTO` AS `ID_PRODUCTO`, `p`.`ID_ALMACEN` AS `ID_ALMACEN`, `p`.`ID_SUCURSAL` AS `ID_SUCURSAL`, `p`.`FECHA_1` AS `FECHA_1`, `p`.`FECHA_2` AS `FECHA_2`, `p`.`FECHA_3` AS `FECHA_3`, `p`.`FECHA_4` AS `FECHA_4`, `pr`.`BARRA` AS `BARRA`, `pr`.`ARTICULO` AS `ARTICULO`, `pr`.`IMAGEN` AS `IMAGEN`, `l`.`LINEA` AS `LINEA`, `pre`.`NOMBRE` AS `PRESENTACION`, `a`.`NOMBRE` AS `ALMACEN`, `s`.`NOMBRE` AS `SUCURSAL`, `i`.`CANTIDAD` AS `CANTIDAD`, `lo`.`NOMBRE` AS `LOTE` FROM (((((((`perecederos` `p` join `producto` `pr` on(`p`.`ID_PRODUCTO` = `pr`.`ID_PRODUCTO`)) join `linea` `l` on(`l`.`ID_LINEA` = `pr`.`ID_LINEA`)) join `presentacion` `pre` on(`pr`.`ID_PRESENTACION` = `pre`.`ID_PRESENTACION`)) join `almacen` `a` on(`a`.`ID_ALMACEN` = `p`.`ID_ALMACEN`)) join `sucursal` `s` on(`s`.`ID_SUCURSAL` = `p`.`ID_SUCURSAL`)) join `items_lote` `i` on(`i`.`ID_ITEM` = `p`.`ID_ITEM`)) join `lote` `lo` on(`i`.`ID_LOTE` = `lo`.`ID_LOTE`))  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_personas`
--
DROP TABLE IF EXISTS `vista_personas`;

CREATE  VIEW `vista_personas`  AS SELECT `p`.`ID_PERSONA` AS `ID_PERSONA`, `p`.`NOMBRES` AS `NOMBRES`, `p`.`APELLIDOS` AS `APELLIDOS`, `p`.`ID_DOCUMENTO` AS `ID_DOCUMENTO`, `p`.`NUMERO` AS `NUMERO`, `p`.`DIRECCION` AS `DIRECCION`, `p`.`TELEFONO` AS `TELEFONO`, `p`.`PERFIL` AS `PERFIL`, `p`.`ESTADO` AS `ESTADO`, `d`.`DOCUMENTO` AS `DOCUMENTO` FROM (`persona` `p` join `documento` `d` on(`d`.`ID_DOCUMENTO` = `p`.`ID_DOCUMENTO`))  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_presentacion`
--
DROP TABLE IF EXISTS `vista_presentacion`;

CREATE  VIEW `vista_presentacion`  AS SELECT `p`.`ID_PRESENTACION` AS `ID_PRESENTACION`, `p`.`NOMBRE` AS `NOMBRE`, `p`.`ESTADO` AS `ESTADO` FROM `presentacion` AS `p`  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_productos`
--
DROP TABLE IF EXISTS `vista_productos`;

CREATE  VIEW `vista_productos`  AS SELECT `p`.`ID_PRODUCTO` AS `ID_PRODUCTO`, `p`.`BARRA` AS `BARRA`, `p`.`ARTICULO` AS `ARTICULO`, `p`.`ID_PRESENTACION` AS `ID_PRESENTACION`, `p`.`ID_LINEA` AS `ID_LINEA`, `p`.`ID_UNIDAD` AS `ID_UNIDAD`, `p`.`COMPLEMENTO` AS `COMPLEMENTO`, `p`.`PRECIO_COSTO` AS `PRECIO_COSTO`, `p`.`PRECIO_VENTA_1` AS `PRECIO_VENTA_1`, `p`.`PRECIO_VENTA_2` AS `PRECIO_VENTA_2`, `p`.`PRECIO_VENTA_3` AS `PRECIO_VENTA_3`, `p`.`PRECIO_VENTA_4` AS `PRECIO_VENTA_4`, `p`.`PRECIO_VENTA_5` AS `PRECIO_VENTA_5`, `p`.`PRECIO_VENTA_6` AS `PRECIO_VENTA_6`, `p`.`PRECIO_VENTA_7` AS `PRECIO_VENTA_7`, `p`.`STOCK_MINIMO` AS `STOCK_MINIMO`, `p`.`STOCK_MEDIO` AS `STOCK_MEDIO`, `p`.`STOCK_MODERADO` AS `STOCK_MODERADO`, `p`.`PERECEDERO` AS `PERECEDERO`, `p`.`EXENTO` AS `EXENTO`, `p`.`ESTADO` AS `ESTADO`, `p`.`IMAGEN` AS `IMAGEN`, `l`.`LINEA` AS `LINEA`, `pr`.`NOMBRE` AS `NOMBRE`, `um`.`UNIDAD` AS `UNIDAD`, `um`.`PREFIJO` AS `PREFIJO`, `p`.`MEDIDA_1` AS `MEDIDA_1`, `p`.`MEDIDA_2` AS `MEDIDA_2`, `p`.`MEDIDA_3` AS `MEDIDA_3`, `p`.`MEDIDA_4` AS `MEDIDA_4`, `p`.`MEDIDA_5` AS `MEDIDA_5`, `p`.`MEDIDA_6` AS `MEDIDA_6`, `p`.`MEDIDA_7` AS `MEDIDA_7`, `p`.`STOCK_1` AS `STOCK_1`, `p`.`STOCK_2` AS `STOCK_2`, `p`.`STOCK_3` AS `STOCK_3`, `p`.`STOCK_4` AS `STOCK_4`, `p`.`STOCK_5` AS `STOCK_5`, `p`.`STOCK_6` AS `STOCK_6`, `p`.`STOCK_7` AS `STOCK_7` FROM (((`producto` `p` join `linea` `l` on(`l`.`ID_LINEA` = `p`.`ID_LINEA`)) join `presentacion` `pr` on(`pr`.`ID_PRESENTACION` = `p`.`ID_PRESENTACION`)) join `unidad_medida` `um` on(`um`.`ID_UNIDAD` = `p`.`ID_UNIDAD`))  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_productos_venta`
--
DROP TABLE IF EXISTS `vista_productos_venta`;

CREATE  VIEW `vista_productos_venta`  AS SELECT `d`.`ID_DETALLE` AS `ID_DETALLE`, `d`.`ID_ITEM` AS `ID_ITEM`, `d`.`ID_VENTA` AS `ID_VENTA`, `d`.`CANTIDAD` AS `CANTIDAD`, `d`.`PRECIO` AS `PRECIO`, `d`.`DESCUENTO` AS `DESCUENTO`, `d`.`SUBTOTAL` AS `SUBTOTAL`, `d`.`TOTAL` AS `TOTAL`, `d`.`STOCK` AS `STOCK`, `v`.`FECHA_RESOLUCION` AS `FECHA_RESOLUCION`, `p`.`BARRA` AS `BARRA`, `p`.`ARTICULO` AS `ARTICULO`, `p`.`IMAGEN` AS `IMAGEN`, `l`.`LINEA` AS `LINEA`, `p`.`COMPLEMENTO` AS `COMPLEMENTO`, `um`.`UNIDAD` AS `UNIDAD`, `um`.`PREFIJO` AS `PREFIJO`, `v`.`ID_SUCURSAL` AS `ID_SUCURSAL`, `v`.`N_VENTA` AS `N_VENTA` FROM (((((`detalle_venta` `d` join `ventas` `v` on(`v`.`ID_VENTA` = `d`.`ID_VENTA`)) join `items_lote` `i` on(`i`.`ID_ITEM` = `d`.`ID_ITEM`)) join `producto` `p` on(`p`.`ID_PRODUCTO` = `i`.`ID_PRODUCTO`)) join `linea` `l` on(`l`.`ID_LINEA` = `p`.`ID_LINEA`)) join `unidad_medida` `um` on(`p`.`ID_UNIDAD` = `um`.`ID_UNIDAD`))  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_proveedores`
--
DROP TABLE IF EXISTS `vista_proveedores`;

CREATE  VIEW `vista_proveedores`  AS SELECT `p`.`ID_PROVEEDOR` AS `ID_PROVEEDOR`, `p`.`RAZON` AS `RAZON`, `p`.`TIPO_DOCUMENTO` AS `TIPO_DOCUMENTO`, `p`.`N_DOCUMENTO` AS `N_DOCUMENTO`, `p`.`DIRECCION` AS `DIRECCION`, `p`.`TELEFONO` AS `TELEFONO`, `p`.`CORREO` AS `CORREO`, `p`.`CUENTA` AS `CUENTA`, `p`.`VENDEDOR` AS `VENDEDOR`, `p`.`V_TELEFONO` AS `V_TELEFONO`, `p`.`ESTADO` AS `ESTADO`, `d`.`DOCUMENTO` AS `DOCUMENTO` FROM (`proveedor` `p` join `documento` `d` on(`d`.`ID_DOCUMENTO` = `p`.`TIPO_DOCUMENTO`))  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_seccion`
--
DROP TABLE IF EXISTS `vista_seccion`;

CREATE  VIEW `vista_seccion`  AS SELECT `s`.`ID_SECCION` AS `ID_SECCION`, `s`.`SECCION` AS `SECCION`, `s`.`ESTADO` AS `ESTADO` FROM `seccion` AS `s`  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_sucursales`
--
DROP TABLE IF EXISTS `vista_sucursales`;

CREATE  VIEW `vista_sucursales`  AS SELECT `s`.`ID_SUCURSAL` AS `ID_SUCURSAL`, `s`.`NOMBRE` AS `NOMBRE`, `s`.`ID_DOCUMENTO` AS `ID_DOCUMENTO`, `s`.`NUMERO` AS `NUMERO`, `s`.`IVA` AS `IVA`, `s`.`MONEDA` AS `MONEDA`, `s`.`DIRECCION` AS `DIRECCION`, `s`.`TELEFONO` AS `TELEFONO`, `s`.`EMAIL` AS `EMAIL`, `s`.`REPRESENTANTE` AS `REPRESENTANTE`, `s`.`LOGO` AS `LOGO`, `s`.`ESTADO` AS `ESTADO`, `d`.`DOCUMENTO` AS `DOCUMENTO` FROM (`sucursal` `s` join `documento` `d` on(`d`.`ID_DOCUMENTO` = `s`.`ID_DOCUMENTO`))  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_tirajes`
--
DROP TABLE IF EXISTS `vista_tirajes`;

CREATE  VIEW `vista_tirajes`  AS SELECT `ti`.`ID_TIRAJE` AS `ID_TIRAJE`, `ti`.`FECHA_RESOLUCION` AS `FECHA_RESOLUCION`, `ti`.`NRO_RESOLUCION` AS `NRO_RESOLUCION`, `ti`.`NRO_RESOLUCION_FAC` AS `NRO_RESOLUCION_FAC`, `ti`.`SERIE` AS `SERIE`, `ti`.`DESDE` AS `DESDE`, `ti`.`HASTA` AS `HASTA`, `ti`.`ID_COMPROBANTE` AS `ID_COMPROBANTE`, `ti`.`ID_SUCURSAL` AS `ID_SUCURSAL`, `ti`.`ESTADO` AS `ESTADO`, `ti`.`DISPONIBLES` AS `DISPONIBLES`, `c`.`COMPROBANTE` AS `COMPROBANTE`, `su`.`NOMBRE` AS `SUCURSAL` FROM ((`tiraje_comprobante` `ti` join `comprobante` `c` on(`c`.`ID_COMPROBANTE` = `ti`.`ID_COMPROBANTE`)) join `sucursal` `su` on(`su`.`ID_SUCURSAL` = `ti`.`ID_SUCURSAL`))  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_transferencias`
--
DROP TABLE IF EXISTS `vista_transferencias`;

CREATE  VIEW `vista_transferencias`  AS SELECT `t`.`ID_TRANSFERENCIA` AS `ID_TRANSFERENCIA`, `t`.`FECHA` AS `FECHA`, `t`.`MOTIVO` AS `MOTIVO`, `t`.`ID_ALMACEN_ORIGEN` AS `ID_ALMACEN_ORIGEN`, `t`.`ID_ALMACEN_DESTINO` AS `ID_ALMACEN_DESTINO`, `t`.`ID_USUARIO` AS `ID_USUARIO`, `t`.`ESTADO` AS `ESTADO`, `ao`.`NOMBRE` AS `ALMACEN_ORIGEN`, `ao`.`ID_SUCURSAL` AS `SUCURSAL_ORIGEN`, `so`.`NOMBRE` AS `SUCURSAL_NAME_ORIGEN`, `so`.`LOGO` AS `SUCURSAL_LOGO_ORIGEN`, `ad`.`NOMBRE` AS `ALMACEN_DESTINO`, `ad`.`ID_SUCURSAL` AS `SUCURSAL_DESTINO`, `sd`.`NOMBRE` AS `SUCURSAL_NAME_DESTINO`, `sd`.`LOGO` AS `SUCURSAL_LOGO_DESTINO`, `p`.`NOMBRES` AS `NOMBRE_PERSONA`, `p`.`PERFIL` AS `PERFIL` FROM ((((((`transferencia_almacen` `t` join `almacen` `ao` on(`t`.`ID_ALMACEN_ORIGEN` = `ao`.`ID_ALMACEN`)) join `almacen` `ad` on(`t`.`ID_ALMACEN_DESTINO` = `ad`.`ID_ALMACEN`)) join `sucursal` `so` on(`so`.`ID_SUCURSAL` = `ao`.`ID_SUCURSAL`)) join `sucursal` `sd` on(`ad`.`ID_SUCURSAL` = `sd`.`ID_SUCURSAL`)) join `usuario` `u` on(`t`.`ID_USUARIO` = `u`.`ID_USUARIO`)) join `persona` `p` on(`p`.`ID_PERSONA` = `u`.`ID_PERSONA`))  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_unidades_medida`
--
DROP TABLE IF EXISTS `vista_unidades_medida`;

CREATE  VIEW `vista_unidades_medida`  AS SELECT `u`.`ID_UNIDAD` AS `ID_UNIDAD`, `u`.`UNIDAD` AS `UNIDAD`, `u`.`PREFIJO` AS `PREFIJO`, `u`.`ESTADO` AS `ESTADO` FROM `unidad_medida` AS `u`  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_usuarios`
--
DROP TABLE IF EXISTS `vista_usuarios`;

CREATE  VIEW `vista_usuarios`  AS SELECT `u`.`ID_USUARIO` AS `ID_USUARIO`, `u`.`EMAIL` AS `EMAIL`, `u`.`PASSWORD` AS `PASSWORD`, `u`.`ID_PERSONA` AS `ID_PERSONA`, `u`.`FECHA_REGISTRO` AS `FECHA_REGISTRO`, `u`.`ESTADO` AS `ESTADO`, `p`.`NOMBRES` AS `NOMBRES`, `p`.`APELLIDOS` AS `APELLIDOS`, `p`.`PERFIL` AS `PERFIL` FROM (`usuario` `u` join `persona` `p` on(`p`.`ID_PERSONA` = `u`.`ID_PERSONA`))  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_ventas`
--
DROP TABLE IF EXISTS `vista_ventas`;

CREATE  VIEW `vista_ventas`  AS SELECT `v`.`ID_VENTA` AS `ID_VENTA`, `v`.`N_VENTA` AS `N_VENTA`, `v`.`FECHA_RESOLUCION` AS `FECHA_RESOLUCION`, `v`.`TIPO_PAGO` AS `TIPO_PAGO`, `v`.`NUMERO_COMPROBANTE` AS `NUMERO_COMPROBANTE`, `v`.`ID_COMPROBANTE` AS `ID_COMPROBANTE`, `v`.`SUMAS` AS `SUMAS`, `v`.`IVA` AS `IVA`, `v`.`EXENTO` AS `EXENTO`, `v`.`SUBTOTAL` AS `SUBTOTAL`, `v`.`RETENIDO` AS `RETENIDO`, `v`.`DESCUENTO` AS `DESCUENTO`, `v`.`DESCUENTO_PERCENT` AS `DESCUENTO_PERCENT`, `v`.`TOTAL` AS `TOTAL`, `v`.`PROD_EXENTOS` AS `PROD_EXENTOS`, `v`.`PAGO_EFECTIVO` AS `PAGO_EFECTIVO`, `v`.`PAGO_TARJETA` AS `PAGO_TARJETA`, `v`.`NUMERO_TARJETA` AS `NUMERO_TARJETA`, `v`.`TARJETA_HABITANTE` AS `TARJETA_HABITANTE`, `v`.`CAMBIO` AS `CAMBIO`, `v`.`ESTADO` AS `ESTADO`, `v`.`ID_CLIENTE` AS `ID_CLIENTE`, `v`.`ID_USUARIO` AS `ID_USUARIO`, `v`.`ID_SUCURSAL` AS `ID_SUCURSAL`, `v`.`PAGO_INMEDIATO` AS `PAGO_INMEDIATO`, `v`.`PAGOS_A_VENTA` AS `PAGOS_A_VENTA`, `v`.`ID_ARQUEO` AS `ID_ARQUEO`, `v`.`OBSERVACION` AS `OBSERVACION`, `v`.`PRECIO_RADIO` AS `PRECIO_RADIO`, `c`.`COMPROBANTE` AS `COMPROBANTE`, `cl`.`RAZON` AS `RAZON`, `doc`.`DOCUMENTO` AS `DOCUMENTO`, `cl`.`N_DOCUMENTO` AS `N_DOCUMENTO`, `cl`.`TELEFONO` AS `TELEFONO`, `per`.`NOMBRES` AS `NOMBRES`, `per`.`APELLIDOS` AS `APELLIDOS`, `per`.`PERFIL` AS `PERFIL`, `su`.`NOMBRE` AS `SUCURSAL`, `per`.`ID_PERSONA` AS `ID_PERSONA`, `su`.`LOGO` AS `LOGO` FROM (((((((`ventas` `v` join `tiraje_comprobante` `tc` on(`tc`.`ID_TIRAJE` = `v`.`ID_COMPROBANTE`)) join `comprobante` `c` on(`c`.`ID_COMPROBANTE` = `tc`.`ID_COMPROBANTE`)) join `cliente` `cl` on(`cl`.`ID_CLIENTE` = `v`.`ID_CLIENTE`)) join `documento` `doc` on(`doc`.`ID_DOCUMENTO` = `cl`.`TIPO_DOCUMENTO`)) join `usuario` `u` on(`u`.`ID_USUARIO` = `v`.`ID_USUARIO`)) join `persona` `per` on(`u`.`ID_PERSONA` = `per`.`ID_PERSONA`)) join `sucursal` `su` on(`su`.`ID_SUCURSAL` = `v`.`ID_SUCURSAL`))  ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ajuste_inventario`
--
ALTER TABLE `ajuste_inventario`
  ADD PRIMARY KEY (`ID_AJUSTE`);

--
-- Indices de la tabla `almacen`
--
ALTER TABLE `almacen`
  ADD PRIMARY KEY (`ID_ALMACEN`),
  ADD KEY `ID_SUCURSAL` (`ID_SUCURSAL`);

--
-- Indices de la tabla `arqueocaja`
--
ALTER TABLE `arqueocaja`
  ADD PRIMARY KEY (`ID_ARQUEO`),
  ADD KEY `ID_CAJA` (`ID_CAJA`);

--
-- Indices de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  ADD PRIMARY KEY (`ID_BITACORA`);

--
-- Indices de la tabla `caja`
--
ALTER TABLE `caja`
  ADD PRIMARY KEY (`ID_CAJA`),
  ADD KEY `ID_USUARIO` (`ID_USUARIO`),
  ADD KEY `ID_SUCURSAL` (`ID_SUCURSAL`);

--
-- Indices de la tabla `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`ID_MENSAJE`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`ID_CLIENTE`),
  ADD KEY `TIPO_DOCUMENTO` (`TIPO_DOCUMENTO`);

--
-- Indices de la tabla `cobros_credito`
--
ALTER TABLE `cobros_credito`
  ADD PRIMARY KEY (`ID_COBRO`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`ID_COMPRA`),
  ADD KEY `ID_LOTE` (`ID_LOTE`),
  ADD KEY `ID_ALMACEN` (`ID_ALMACEN`),
  ADD KEY `ID_PROVEEDOR` (`ID_PROVEEDOR`),
  ADD KEY `ID_COMPROBANTE` (`ID_COMPROBANTE`),
  ADD KEY `ID_USUARIO` (`ID_USUARIO`);

--
-- Indices de la tabla `comprobante`
--
ALTER TABLE `comprobante`
  ADD PRIMARY KEY (`ID_COMPROBANTE`);

--
-- Indices de la tabla `cotizacion`
--
ALTER TABLE `cotizacion`
  ADD PRIMARY KEY (`ID_COTIZACION`) USING BTREE,
  ADD KEY `ID_CLIENTE` (`ID_CLIENTE`),
  ADD KEY `ID_USUARIO` (`ID_USUARIO`),
  ADD KEY `ID_SUCURSAL` (`ID_SUCURSAL`);

--
-- Indices de la tabla `credito`
--
ALTER TABLE `credito`
  ADD PRIMARY KEY (`ID_CREDITO`),
  ADD KEY `ID_CLIENTE` (`ID_CLIENTE`),
  ADD KEY `ID_SUCURSAL` (`ID_SUCURSAL`),
  ADD KEY `ID_VENTA` (`ID_VENTA`),
  ADD KEY `ID_USUARIO` (`ID_USUARIO`);

--
-- Indices de la tabla `creditos_compra`
--
ALTER TABLE `creditos_compra`
  ADD PRIMARY KEY (`ID_CREDITO`);

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`ID_DEPARTAMENTO`);

--
-- Indices de la tabla `detalle_ajuste`
--
ALTER TABLE `detalle_ajuste`
  ADD PRIMARY KEY (`ID_DETALLE`),
  ADD KEY `ID_AJUSTE` (`ID_AJUSTE`);

--
-- Indices de la tabla `detalle_cotizacion`
--
ALTER TABLE `detalle_cotizacion`
  ADD PRIMARY KEY (`ID_DETALLE`) USING BTREE,
  ADD KEY `ID_COTIZACION` (`ID_COTIZACION`) USING BTREE,
  ADD KEY `ID_ITEM` (`ID_ITEM`) USING BTREE;

--
-- Indices de la tabla `detalle_devolucion_preventa`
--
ALTER TABLE `detalle_devolucion_preventa`
  ADD PRIMARY KEY (`ID_DETALLE`);

--
-- Indices de la tabla `detalle_invoice`
--
ALTER TABLE `detalle_invoice`
  ADD PRIMARY KEY (`ID_DETALLE`);

--
-- Indices de la tabla `detalle_preventa`
--
ALTER TABLE `detalle_preventa`
  ADD PRIMARY KEY (`ID_DETALLE`),
  ADD KEY `ID_PREVENTA` (`ID_PREVENTA`);

--
-- Indices de la tabla `detalle_transferencia`
--
ALTER TABLE `detalle_transferencia`
  ADD PRIMARY KEY (`ID_DETALLE`),
  ADD KEY `ID_PRODUCTO` (`ID_PRODUCTO`),
  ADD KEY `ID_TRANSFERENCIA` (`ID_TRANSFERENCIA`);

--
-- Indices de la tabla `detalle_traspasos`
--
ALTER TABLE `detalle_traspasos`
  ADD PRIMARY KEY (`ID_DETALLE`),
  ADD KEY `ID_TRASPASO` (`ID_TRASPASO`);

--
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`ID_DETALLE`),
  ADD KEY `ID_ITEM` (`ID_ITEM`),
  ADD KEY `ID_VENTA` (`ID_VENTA`);

--
-- Indices de la tabla `direccion_cliente`
--
ALTER TABLE `direccion_cliente`
  ADD PRIMARY KEY (`ID_DIRECCION`);

--
-- Indices de la tabla `documento`
--
ALTER TABLE `documento`
  ADD PRIMARY KEY (`ID_DOCUMENTO`);

--
-- Indices de la tabla `entrada`
--
ALTER TABLE `entrada`
  ADD PRIMARY KEY (`ID_ENTRADA`),
  ADD KEY `ID_COMPRA` (`ID_COMPRA`),
  ADD KEY `ID_PRODUCTO` (`ID_PRODUCTO`);

--
-- Indices de la tabla `entrada_salida`
--
ALTER TABLE `entrada_salida`
  ADD PRIMARY KEY (`ID_KARDEX`);

--
-- Indices de la tabla `imagen_producto`
--
ALTER TABLE `imagen_producto`
  ADD PRIMARY KEY (`ID_IMAGEN`);

--
-- Indices de la tabla `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`ID_INVOICE`);

--
-- Indices de la tabla `invoice_producto`
--
ALTER TABLE `invoice_producto`
  ADD PRIMARY KEY (`ID_ITEMS`);

--
-- Indices de la tabla `invoice_usuario`
--
ALTER TABLE `invoice_usuario`
  ADD PRIMARY KEY (`ID_INVOICE_U`);

--
-- Indices de la tabla `invoice_usuario_notificacion`
--
ALTER TABLE `invoice_usuario_notificacion`
  ADD PRIMARY KEY (`ID_NOTIFICACION`);

--
-- Indices de la tabla `items_compra`
--
ALTER TABLE `items_compra`
  ADD PRIMARY KEY (`ID_ITEM`),
  ADD KEY `ID_ALMACEN` (`ID_ALMACEN`),
  ADD KEY `ID_LOTE` (`ID_LOTE`),
  ADD KEY `ID_PRODUCTO` (`ID_PRODUCTO`),
  ADD KEY `ID_COMPRA` (`ID_COMPRA`);

--
-- Indices de la tabla `items_lote`
--
ALTER TABLE `items_lote`
  ADD PRIMARY KEY (`ID_ITEM`),
  ADD KEY `ID_ALMACEN` (`ID_ALMACEN`),
  ADD KEY `ID_PRODUCTO` (`ID_PRODUCTO`),
  ADD KEY `ID_LOTE` (`ID_LOTE`),
  ADD KEY `ID_USUARIO` (`ID_USUARIO`);

--
-- Indices de la tabla `items_tienda`
--
ALTER TABLE `items_tienda`
  ADD PRIMARY KEY (`ID_ITEMS`);

--
-- Indices de la tabla `linea`
--
ALTER TABLE `linea`
  ADD PRIMARY KEY (`ID_LINEA`);

--
-- Indices de la tabla `lista_deseos`
--
ALTER TABLE `lista_deseos`
  ADD PRIMARY KEY (`ID_DESEO`);

--
-- Indices de la tabla `lote`
--
ALTER TABLE `lote`
  ADD PRIMARY KEY (`ID_LOTE`),
  ADD KEY `ID_ALMACEN` (`ID_ALMACEN`);

--
-- Indices de la tabla `metodopagos`
--
ALTER TABLE `metodopagos`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `movimientoscajas`
--
ALTER TABLE `movimientoscajas`
  ADD PRIMARY KEY (`ID_MOVIMIENTO`),
  ADD KEY `ID_ARQUEO` (`ID_ARQUEO`);

--
-- Indices de la tabla `pagos_credito`
--
ALTER TABLE `pagos_credito`
  ADD PRIMARY KEY (`ID_PAGO`);

--
-- Indices de la tabla `pedido_traspasos`
--
ALTER TABLE `pedido_traspasos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedido_traspaso_items`
--
ALTER TABLE `pedido_traspaso_items`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `perecederos`
--
ALTER TABLE `perecederos`
  ADD PRIMARY KEY (`ID_PERECEDERO`),
  ADD KEY `ID_ITEM` (`ID_ITEM`),
  ADD KEY `ID_PRODUCTO` (`ID_PRODUCTO`),
  ADD KEY `ID_ALMACEN` (`ID_ALMACEN`),
  ADD KEY `ID_SUCURSAL` (`ID_SUCURSAL`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`ID_PERSONA`),
  ADD KEY `ID_DOCUMENTO` (`ID_DOCUMENTO`);

--
-- Indices de la tabla `presentacion`
--
ALTER TABLE `presentacion`
  ADD PRIMARY KEY (`ID_PRESENTACION`);

--
-- Indices de la tabla `preventa`
--
ALTER TABLE `preventa`
  ADD PRIMARY KEY (`ID_PREVENTA`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`ID_PRODUCTO`),
  ADD KEY `ID_UNIDAD` (`ID_UNIDAD`),
  ADD KEY `ID_LINEA` (`ID_LINEA`),
  ADD KEY `ID_PRESENTACION` (`ID_PRESENTACION`);

--
-- Indices de la tabla `producto_caracteristica`
--
ALTER TABLE `producto_caracteristica`
  ADD PRIMARY KEY (`ID_CARACTERISTICA`);

--
-- Indices de la tabla `producto_img`
--
ALTER TABLE `producto_img`
  ADD PRIMARY KEY (`ID_IMG`);

--
-- Indices de la tabla `producto_recomendados`
--
ALTER TABLE `producto_recomendados`
  ADD PRIMARY KEY (`ID_RECOMENDADOS`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`ID_PROVEEDOR`),
  ADD KEY `TIPO_DOCUMENTO` (`TIPO_DOCUMENTO`);

--
-- Indices de la tabla `provincia`
--
ALTER TABLE `provincia`
  ADD PRIMARY KEY (`ID_PROVINCIA`);

--
-- Indices de la tabla `seccion`
--
ALTER TABLE `seccion`
  ADD PRIMARY KEY (`ID_SECCION`);

--
-- Indices de la tabla `seccion_presentacion`
--
ALTER TABLE `seccion_presentacion`
  ADD PRIMARY KEY (`ID_PRESENTACIONES`);

--
-- Indices de la tabla `seguimiento_invoice`
--
ALTER TABLE `seguimiento_invoice`
  ADD PRIMARY KEY (`ID_SEG`);

--
-- Indices de la tabla `seguimiento_traspaso`
--
ALTER TABLE `seguimiento_traspaso`
  ADD PRIMARY KEY (`ID_SEG`);

--
-- Indices de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  ADD PRIMARY KEY (`ID_SUCURSAL`),
  ADD KEY `ID_DOCUMENTO` (`ID_DOCUMENTO`);

--
-- Indices de la tabla `tienda_cliente`
--
ALTER TABLE `tienda_cliente`
  ADD PRIMARY KEY (`ID_CLIENTE`);

--
-- Indices de la tabla `tienda_sucursal`
--
ALTER TABLE `tienda_sucursal`
  ADD PRIMARY KEY (`ID_TIENDA`);

--
-- Indices de la tabla `tiraje_comprobante`
--
ALTER TABLE `tiraje_comprobante`
  ADD PRIMARY KEY (`ID_TIRAJE`),
  ADD KEY `ID_COMPROBANTE` (`ID_COMPROBANTE`),
  ADD KEY `ID_SUCURSAL` (`ID_SUCURSAL`);

--
-- Indices de la tabla `transferencia_almacen`
--
ALTER TABLE `transferencia_almacen`
  ADD PRIMARY KEY (`ID_TRANSFERENCIA`),
  ADD KEY `ID_ALMACEN_ORIGEN` (`ID_ALMACEN_ORIGEN`),
  ADD KEY `ID_ALMACEN_DESTINO` (`ID_ALMACEN_DESTINO`),
  ADD KEY `ID_USUARIO` (`ID_USUARIO`);

--
-- Indices de la tabla `traspasos`
--
ALTER TABLE `traspasos`
  ADD PRIMARY KEY (`ID_TRASPASO`);

--
-- Indices de la tabla `unidad_medida`
--
ALTER TABLE `unidad_medida`
  ADD PRIMARY KEY (`ID_UNIDAD`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ID_USUARIO`),
  ADD KEY `ID_PERSONA` (`ID_PERSONA`);

--
-- Indices de la tabla `usuario_sucursal`
--
ALTER TABLE `usuario_sucursal`
  ADD PRIMARY KEY (`ID_PERMISO`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`ID_VENTA`),
  ADD KEY `ID_COMPROBANTE` (`ID_COMPROBANTE`),
  ADD KEY `ID_CLIENTE` (`ID_CLIENTE`),
  ADD KEY `ID_USUARIO` (`ID_USUARIO`),
  ADD KEY `ID_SUCURSAL` (`ID_SUCURSAL`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `metodopagos`
--
ALTER TABLE `metodopagos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `pedido_traspasos`
--
ALTER TABLE `pedido_traspasos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pedido_traspaso_items`
--
ALTER TABLE `pedido_traspaso_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario_sucursal`
--
ALTER TABLE `usuario_sucursal`
  MODIFY `ID_PERMISO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `almacen`
--
ALTER TABLE `almacen`
  ADD CONSTRAINT `almacen_ibfk_1` FOREIGN KEY (`ID_SUCURSAL`) REFERENCES `sucursal` (`ID_SUCURSAL`);

--
-- Filtros para la tabla `arqueocaja`
--
ALTER TABLE `arqueocaja`
  ADD CONSTRAINT `arqueocaja_ibfk_1` FOREIGN KEY (`ID_CAJA`) REFERENCES `caja` (`ID_CAJA`);

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`TIPO_DOCUMENTO`) REFERENCES `documento` (`ID_DOCUMENTO`);

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `compras_ibfk_1` FOREIGN KEY (`ID_LOTE`) REFERENCES `lote` (`ID_LOTE`),
  ADD CONSTRAINT `compras_ibfk_2` FOREIGN KEY (`ID_ALMACEN`) REFERENCES `almacen` (`ID_ALMACEN`),
  ADD CONSTRAINT `compras_ibfk_3` FOREIGN KEY (`ID_PROVEEDOR`) REFERENCES `proveedor` (`ID_PROVEEDOR`),
  ADD CONSTRAINT `compras_ibfk_4` FOREIGN KEY (`ID_PROVEEDOR`) REFERENCES `proveedor` (`ID_PROVEEDOR`),
  ADD CONSTRAINT `compras_ibfk_5` FOREIGN KEY (`ID_COMPROBANTE`) REFERENCES `comprobante` (`ID_COMPROBANTE`),
  ADD CONSTRAINT `compras_ibfk_6` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuario` (`ID_USUARIO`);

--
-- Filtros para la tabla `cotizacion`
--
ALTER TABLE `cotizacion`
  ADD CONSTRAINT `cotizacion_ibfk_1` FOREIGN KEY (`ID_CLIENTE`) REFERENCES `cliente` (`ID_CLIENTE`),
  ADD CONSTRAINT `cotizacion_ibfk_2` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuario` (`ID_USUARIO`),
  ADD CONSTRAINT `cotizacion_ibfk_3` FOREIGN KEY (`ID_SUCURSAL`) REFERENCES `sucursal` (`ID_SUCURSAL`);

--
-- Filtros para la tabla `credito`
--
ALTER TABLE `credito`
  ADD CONSTRAINT `credito_ibfk_1` FOREIGN KEY (`ID_CLIENTE`) REFERENCES `cliente` (`ID_CLIENTE`),
  ADD CONSTRAINT `credito_ibfk_2` FOREIGN KEY (`ID_SUCURSAL`) REFERENCES `sucursal` (`ID_SUCURSAL`),
  ADD CONSTRAINT `credito_ibfk_4` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuario` (`ID_USUARIO`);

--
-- Filtros para la tabla `detalle_ajuste`
--
ALTER TABLE `detalle_ajuste`
  ADD CONSTRAINT `detalle_ajuste_ibfk_1` FOREIGN KEY (`ID_AJUSTE`) REFERENCES `ajuste_inventario` (`ID_AJUSTE`);

--
-- Filtros para la tabla `detalle_cotizacion`
--
ALTER TABLE `detalle_cotizacion`
  ADD CONSTRAINT `detalle_cotizacion_ibfk_1` FOREIGN KEY (`ID_COTIZACION`) REFERENCES `cotizacion` (`ID_COTIZACION`),
  ADD CONSTRAINT `detalle_cotizacion_ibfk_2` FOREIGN KEY (`ID_ITEM`) REFERENCES `items_lote` (`ID_ITEM`);

--
-- Filtros para la tabla `detalle_preventa`
--
ALTER TABLE `detalle_preventa`
  ADD CONSTRAINT `detalle_preventa_ibfk_1` FOREIGN KEY (`ID_PREVENTA`) REFERENCES `preventa` (`ID_PREVENTA`);

--
-- Filtros para la tabla `detalle_transferencia`
--
ALTER TABLE `detalle_transferencia`
  ADD CONSTRAINT `detalle_transferencia_ibfk_1` FOREIGN KEY (`ID_PRODUCTO`) REFERENCES `producto` (`ID_PRODUCTO`),
  ADD CONSTRAINT `detalle_transferencia_ibfk_2` FOREIGN KEY (`ID_TRANSFERENCIA`) REFERENCES `transferencia_almacen` (`ID_TRANSFERENCIA`);

--
-- Filtros para la tabla `detalle_traspasos`
--
ALTER TABLE `detalle_traspasos`
  ADD CONSTRAINT `detalle_traspasos_ibfk_1` FOREIGN KEY (`ID_TRASPASO`) REFERENCES `traspasos` (`ID_TRASPASO`);

--
-- Filtros para la tabla `entrada`
--
ALTER TABLE `entrada`
  ADD CONSTRAINT `entrada_ibfk_2` FOREIGN KEY (`ID_PRODUCTO`) REFERENCES `producto` (`ID_PRODUCTO`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 28-03-2013 a las 13:52:12
-- Versión del servidor: 5.5.28
-- Versión de PHP: 5.4.4-14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `OpenFact`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `BlockFolios`
--

CREATE TABLE IF NOT EXISTS `BlockFolios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `serie` varchar(5) NOT NULL,
  `folioInicial` int(11) NOT NULL,
  `folioFinal` int(11) NOT NULL,
  `aprobacion` int(11) NOT NULL,
  `inicioVigencia` date NOT NULL,
  `finVigencia` date NOT NULL,
  `cbb` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ClienteFactura`
--

CREATE TABLE IF NOT EXISTS `ClienteFactura` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '\n',
  `cliente` int(11) NOT NULL,
  `razonSocial` varchar(100) NOT NULL,
  `rfc` varchar(15) NOT NULL,
  `calle` varchar(45) DEFAULT NULL,
  `numInt` varchar(5) DEFAULT NULL,
  `numExt` varchar(5) DEFAULT NULL,
  `colonia` varchar(45) DEFAULT NULL,
  `cp` varchar(5) DEFAULT NULL,
  `municipio` varchar(45) DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `pais` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ClienteDocumento_1` (`cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Clientes`
--

CREATE TABLE IF NOT EXISTS `Clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `razonSocial` varchar(100) NOT NULL,
  `rfc` varchar(15) NOT NULL,
  `calle` varchar(45) DEFAULT NULL,
  `numInt` varchar(5) DEFAULT NULL,
  `numExt` varchar(5) DEFAULT NULL,
  `colonia` varchar(45) DEFAULT NULL,
  `cp` varchar(5) DEFAULT NULL,
  `municipio` varchar(45) DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `pais` varchar(20) DEFAULT NULL,
  `correoElectronico` varchar(45) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `porcentajeIVA` int(11) NOT NULL,
  `porcentajeIEPS` int(11) DEFAULT NULL,
  `porcentajeRetIVA` int(11) DEFAULT NULL,
  `porcentajeRetISR` int(11) DEFAULT NULL,
  `saldo` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `Clientes`
--

INSERT INTO `Clientes` (`id`, `razonSocial`, `rfc`, `calle`, `numInt`, `numExt`, `colonia`, `cp`, `municipio`, `estado`, `pais`, `correoElectronico`, `telefono`, `porcentajeIVA`, `porcentajeIEPS`, `porcentajeRetIVA`, `porcentajeRetISR`, `saldo`) VALUES
(3, 'COMERCIALIZADORA CEYKA', 'XAXX010101000', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0),
(4, 'OSCAR EDUARDO PALACIOS VARGAS', 'XAXX010101000', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0),
(5, 'PUBLICO GENERAL', 'XAXX010101000', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CondicionesPago`
--

CREATE TABLE IF NOT EXISTS `CondicionesPago` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `CondicionesPago`
--

INSERT INTO `CondicionesPago` (`id`, `nombre`) VALUES
(1, 'CONTADO'),
(2, 'CREDITO 15 DIAS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `DetalleFactura`
--

CREATE TABLE IF NOT EXISTS `DetalleFactura` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto` int(11) NOT NULL,
  `factura` int(11) NOT NULL,
  `detalle` varchar(500) DEFAULT NULL,
  `precio` double NOT NULL,
  `cantidad` double NOT NULL,
  `total` double NOT NULL,
  `porcentajeIva` int(11) NOT NULL,
  `importeIva` double NOT NULL,
  `porcentajeIEPS` int(11) DEFAULT NULL,
  `importeIEPS` double DEFAULT NULL,
  `porcentajeRetIVA` int(11) DEFAULT NULL,
  `importeRetIVA` double DEFAULT NULL,
  `porcetajeRetISR` int(11) DEFAULT NULL,
  `importeRetISR` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `producto` (`producto`),
  KEY `fk_DetalleFactura_1_idx` (`factura`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Empresa`
--

CREATE TABLE IF NOT EXISTS `Empresa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `rfc` varchar(20) NOT NULL,
  `calle` varchar(45) DEFAULT NULL,
  `numInt` varchar(5) DEFAULT NULL,
  `numExt` varchar(5) DEFAULT NULL,
  `colonia` varchar(45) DEFAULT NULL,
  `cp` int(11) DEFAULT NULL,
  `municipio` varchar(45) DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `pais` varchar(45) DEFAULT NULL,
  `regimenfiscal` varchar(200) NOT NULL,
  `porcentajeIVA` int(11) NOT NULL,
  `porcentajeIEPS` int(11) DEFAULT NULL,
  `porcentajeRetIVA` int(11) DEFAULT NULL,
  `porcentajeRetISR` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `Empresa`
--

INSERT INTO `Empresa` (`id`, `nombre`, `rfc`, `calle`, `numInt`, `numExt`, `colonia`, `cp`, `municipio`, `estado`, `pais`, `regimenfiscal`, `porcentajeIVA`, `porcentajeIEPS`, `porcentajeRetIVA`, `porcentajeRetISR`) VALUES
(1, 'EMPRESA', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NO IDENTIFICADO', 16, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Facturas`
--

CREATE TABLE IF NOT EXISTS `Facturas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `folio` int(11) NOT NULL,
  `cliente` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `metodoPago` int(11) NOT NULL,
  `condicionesPago` int(11) NOT NULL,
  `cuentaPago` varchar(45) NOT NULL,
  `lugarExpedicion` varchar(200) NOT NULL,
  `estatus` int(11) NOT NULL COMMENT 'estatus=\n\n0=capturado\n1=vigente',
  PRIMARY KEY (`id`),
  KEY `fk_Facturas_1` (`cliente`),
  KEY `folio` (`folio`),
  KEY `fk_Facturas_2` (`condicionesPago`),
  KEY `fk_Facturas_3` (`metodoPago`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Folios`
--

CREATE TABLE IF NOT EXISTS `Folios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `serie` varchar(5) NOT NULL,
  `folio` int(11) NOT NULL,
  `blockfolios` int(11) NOT NULL,
  `ocupado` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `blockfolios` (`blockfolios`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `MetodosPago`
--

CREATE TABLE IF NOT EXISTS `MetodosPago` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `MetodosPago`
--

INSERT INTO `MetodosPago` (`id`, `nombre`) VALUES
(1, 'EFECTIVO'),
(2, 'CHEQUE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Productos`
--

CREATE TABLE IF NOT EXISTS `Productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(45) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `precio1` double DEFAULT NULL,
  `precio2` double DEFAULT NULL,
  `unidad` int(11) NOT NULL,
  `porcentajeIVA` int(11) NOT NULL,
  `porcentajeIEPS` int(11) DEFAULT NULL,
  `porcentajeRetIVA` int(11) DEFAULT NULL,
  `porcentajeRetISR` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo_UNIQUE` (`codigo`),
  KEY `unidad` (`unidad`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `Productos`
--

INSERT INTO `Productos` (`id`, `codigo`, `nombre`, `descripcion`, `precio1`, `precio2`, `unidad`, `porcentajeIVA`, `porcentajeIEPS`, `porcentajeRetIVA`, `porcentajeRetISR`) VALUES
(5, '12345', 'COCA COLA 600 ML', '', 10, 0, 5, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Sucursales`
--

CREATE TABLE IF NOT EXISTS `Sucursales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `domicilio` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `Sucursales`
--

INSERT INTO `Sucursales` (`id`, `nombre`, `domicilio`) VALUES
(1, 'CHIAPAS', '1RA SUR ENTRE 5TA Y 6TA PONIENTE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `UnidadesVenta`
--

CREATE TABLE IF NOT EXISTS `UnidadesVenta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `UnidadesVenta`
--

INSERT INTO `UnidadesVenta` (`id`, `nombre`) VALUES
(5, 'PIEZA');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ClienteFactura`
--
ALTER TABLE `ClienteFactura`
  ADD CONSTRAINT `fk_ClienteDocumento_1` FOREIGN KEY (`cliente`) REFERENCES `Clientes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `DetalleFactura`
--
ALTER TABLE `DetalleFactura`
  ADD CONSTRAINT `DetalleFactura_ibfk_1` FOREIGN KEY (`producto`) REFERENCES `Productos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_DetalleFactura_1` FOREIGN KEY (`factura`) REFERENCES `Facturas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Facturas`
--
ALTER TABLE `Facturas`
  ADD CONSTRAINT `Facturas_ibfk_1` FOREIGN KEY (`folio`) REFERENCES `Folios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Facturas_1` FOREIGN KEY (`cliente`) REFERENCES `ClienteFactura` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Facturas_2` FOREIGN KEY (`condicionesPago`) REFERENCES `CondicionesPago` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Facturas_3` FOREIGN KEY (`metodoPago`) REFERENCES `MetodosPago` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Folios`
--
ALTER TABLE `Folios`
  ADD CONSTRAINT `Folios_ibfk_1` FOREIGN KEY (`blockfolios`) REFERENCES `BlockFolios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Productos`
--
ALTER TABLE `Productos`
  ADD CONSTRAINT `Productos_ibfk_1` FOREIGN KEY (`unidad`) REFERENCES `UnidadesVenta` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

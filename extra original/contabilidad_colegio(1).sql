-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 01-12-2017 a las 02:10:52
-- Versión del servidor: 5.6.13
-- Versión de PHP: 5.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `contabilidad_colegio`
--
CREATE DATABASE IF NOT EXISTS `contabilidad_colegio` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `contabilidad_colegio`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_actividad`
--

CREATE TABLE IF NOT EXISTS `tbl_actividad` (
  `id_actividad` int(11) NOT NULL AUTO_INCREMENT,
  `id_centro_costo` int(11) NOT NULL,
  `nombre_actividad` varchar(200) DEFAULT NULL,
  `descripcion_actividad` varchar(500) DEFAULT NULL,
  `tipo_actividad` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_actividad`),
  KEY `id_centro_costo` (`id_centro_costo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `tbl_actividad`
--

INSERT INTO `tbl_actividad` (`id_actividad`, `id_centro_costo`, `nombre_actividad`, `descripcion_actividad`, `tipo_actividad`) VALUES
(2, 1, 'Actividad 1 Centro costo 1', 'una actividad de por allli', 'Primaria'),
(3, 1, 'Actividad 2 Centro costo 1', 'una actividad de por allli 22', 'Primaria'),
(4, 1, 'Actividad 3 Centro costo 1', 'una descripcion mas larga', 'Primaria'),
(5, 2, 'Actividad 1 Centro costo 2', 'una actividad de por allli', 'Primaria'),
(6, 2, 'Actividad 2 centro costo 2', 'ghfdh', 'Primaria'),
(7, 3, 'Actividad 1 Centro costo 3', 'una actividad de por allli', 'Auxiliar'),
(8, 3, 'Actividad 2 centro costo 3', 'sdafsdaf', 'Auxiliar'),
(9, 3, 'Actividad 3 centro costo 3', 'ghfdh', 'Auxiliar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_centro_costo`
--

CREATE TABLE IF NOT EXISTS `tbl_centro_costo` (
  `id_centro_costo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_centro_costo` varchar(200) DEFAULT NULL,
  `descripcion_centro_costo` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id_centro_costo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `tbl_centro_costo`
--

INSERT INTO `tbl_centro_costo` (`id_centro_costo`, `nombre_centro_costo`, `descripcion_centro_costo`) VALUES
(1, 'Centro de costo 1', 'Una descripcion inutil'),
(2, 'Centro de costo 2', 'Una descripcion un poco mas inutil'),
(3, 'Centro de costo 3', 'POr favor...');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_clase_cuenta`
--

CREATE TABLE IF NOT EXISTS `tbl_clase_cuenta` (
  `id_clase_cuenta` int(11) NOT NULL,
  `clase_cuenta` varchar(50) DEFAULT NULL,
  `abreviatura_clase_cuenta` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id_clase_cuenta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_clase_cuenta`
--

INSERT INTO `tbl_clase_cuenta` (`id_clase_cuenta`, `clase_cuenta`, `abreviatura_clase_cuenta`) VALUES
(1, 'Activo', '(A)'),
(2, 'Pasivo', '(P)'),
(3, 'Capital', '(K)'),
(4, 'Ingreso', '(R)'),
(5, 'Egreso', '(R)');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_configuracion`
--

CREATE TABLE IF NOT EXISTS `tbl_configuracion` (
  `perc_utilidad_retenida` int(11) DEFAULT NULL,
  `longitud_periodo_contable` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_configuracion`
--

INSERT INTO `tbl_configuracion` (`perc_utilidad_retenida`, `longitud_periodo_contable`) VALUES
(60, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_consumidor_costo`
--

CREATE TABLE IF NOT EXISTS `tbl_consumidor_costo` (
  `id_consumidor_costo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_consumidor_costo` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_consumidor_costo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tbl_consumidor_costo`
--

INSERT INTO `tbl_consumidor_costo` (`id_consumidor_costo`, `nombre_consumidor_costo`) VALUES
(1, 'Servicio basico clientes'),
(2, 'Servicio basico estudiantes 2.5');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_criterio_reparto_primario`
--

CREATE TABLE IF NOT EXISTS `tbl_criterio_reparto_primario` (
  `id_criterio_reparto_primario` int(11) NOT NULL AUTO_INCREMENT,
  `id_cuenta_interno` int(11) NOT NULL,
  `nombre_criterio_reparto_primario` varchar(150) DEFAULT NULL,
  `desc_criterio_reparto_primario` varchar(500) DEFAULT NULL,
  `unidad_reparto` varchar(10) DEFAULT NULL,
  `total_unidades` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id_criterio_reparto_primario`),
  KEY `id_cuenta_interno` (`id_cuenta_interno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `tbl_criterio_reparto_primario`
--

INSERT INTO `tbl_criterio_reparto_primario` (`id_criterio_reparto_primario`, `id_cuenta_interno`, `nombre_criterio_reparto_primario`, `desc_criterio_reparto_primario`, `unidad_reparto`, `total_unidades`) VALUES
(1, 15, 'Area de la planta', 'Criterio en base al area de la planta', 'm2', '2409.00'),
(2, 18, 'Horas trabajadas', 'Reparto por horas trabajadas', 'h', '4143.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_criterio_reparto_secundario`
--

CREATE TABLE IF NOT EXISTS `tbl_criterio_reparto_secundario` (
  `id_criterio_reparto_secundario` int(11) NOT NULL AUTO_INCREMENT,
  `id_centro_costo` int(11) NOT NULL,
  `nombre_criterio_reparto_secundario` varchar(150) DEFAULT NULL,
  `desc_criterio_reparto_secundario` varchar(500) DEFAULT NULL,
  `unidad_reparto` varchar(10) DEFAULT NULL,
  `total_unidades` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id_criterio_reparto_secundario`),
  KEY `id_centro_costo` (`id_centro_costo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `tbl_criterio_reparto_secundario`
--

INSERT INTO `tbl_criterio_reparto_secundario` (`id_criterio_reparto_secundario`, `id_centro_costo`, `nombre_criterio_reparto_secundario`, `desc_criterio_reparto_secundario`, `unidad_reparto`, `total_unidades`) VALUES
(1, 1, 'Criterio unidades ocupadas', 'por las horas ocupadas en esa actividad', 'h', '855.00'),
(2, 2, 'Criterio unidades ocupadas', 'por las horas ocupadas en esa actividad', 'h', '381.00'),
(4, 3, 'Criterio unidades ocupadas', 'por las horas ocupadas en esa actividad', 'h', '773.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_criterio_reparto_terciario`
--

CREATE TABLE IF NOT EXISTS `tbl_criterio_reparto_terciario` (
  `id_criterio_reparto_terciario` int(11) NOT NULL AUTO_INCREMENT,
  `id_actividad_auxiliar` int(11) NOT NULL,
  `nombre_criterio_reparto_terciario` varchar(150) DEFAULT NULL,
  `desc_criterio_reparto_terciario` varchar(500) DEFAULT NULL,
  `unidad_reparto` varchar(10) DEFAULT NULL,
  `total_unidades` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id_criterio_reparto_terciario`),
  KEY `id_actividad_auxiliar` (`id_actividad_auxiliar`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `tbl_criterio_reparto_terciario`
--

INSERT INTO `tbl_criterio_reparto_terciario` (`id_criterio_reparto_terciario`, `id_actividad_auxiliar`, `nombre_criterio_reparto_terciario`, `desc_criterio_reparto_terciario`, `unidad_reparto`, `total_unidades`) VALUES
(1, 7, 'Criterio al ojo', 'nada mas que decir LEL', 'h', '1525.00'),
(2, 8, 'Criterio al ojo', 'nada mas que decir', 'h', '1475.00'),
(4, 9, 'Criterio al ojo 3', 'nada mas que decir', 'h', '1583.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_cuenta`
--

CREATE TABLE IF NOT EXISTS `tbl_cuenta` (
  `id_cuenta_interno` int(11) NOT NULL AUTO_INCREMENT,
  `id_clase_cuenta` int(11) DEFAULT NULL,
  `id_grupo_cuenta` int(11) DEFAULT NULL,
  `id_cuenta_mayor` int(11) DEFAULT NULL,
  `id_cuenta` int(11) DEFAULT NULL,
  `nombre_cuenta` varchar(150) DEFAULT NULL,
  `atributo_cuenta` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_cuenta_interno`),
  KEY `id_clase_cuenta` (`id_clase_cuenta`),
  KEY `id_grupo_cuenta` (`id_grupo_cuenta`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Volcado de datos para la tabla `tbl_cuenta`
--

INSERT INTO `tbl_cuenta` (`id_cuenta_interno`, `id_clase_cuenta`, `id_grupo_cuenta`, `id_cuenta_mayor`, `id_cuenta`, `nombre_cuenta`, `atributo_cuenta`) VALUES
(4, 1, 1, 1, NULL, 'Efectivo', ''),
(5, 1, 1, 2, NULL, 'Utiles de oficina', ''),
(6, 1, 1, 3, NULL, 'Seguro', ''),
(7, 1, 1, 4, NULL, 'CPC', ''),
(8, 1, 1, 5, NULL, 'Maquinaria', ''),
(9, 3, 1, 1, NULL, 'Capital empresa', 'KE'),
(10, 2, 1, 1, NULL, 'Cuentas por pagar', ''),
(11, 4, 1, 1, NULL, 'Ingresos por servicios', ''),
(12, 5, 1, 1, NULL, 'Gastos por salarios', ''),
(13, 5, 1, 2, NULL, 'Gastos por depreciacion', ''),
(14, 5, 1, 3, NULL, 'Gastos por seguro utilizado', ''),
(15, 1, 1, 5, NULL, 'Depreciacion acumulada maquinaria', ''),
(16, 5, 1, 4, NULL, 'Gastos por robo de capital', 'DI'),
(18, 3, 1, 2, NULL, 'Utilidad retenida', 'UR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_empleado`
--

CREATE TABLE IF NOT EXISTS `tbl_empleado` (
  `id_empleado` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_empleado` varchar(200) DEFAULT NULL,
  `fecha_contratacion` datetime DEFAULT NULL,
  `salario_base_diario` decimal(10,2) DEFAULT NULL,
  `tipo_empleado` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_empleado`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tbl_empleado`
--

INSERT INTO `tbl_empleado` (`id_empleado`, `nombre_empleado`, `fecha_contratacion`, `salario_base_diario`, `tipo_empleado`) VALUES
(1, 'Jorge Alberto Gomez Lopez', '2015-11-01 00:00:00', '40.00', 'Trabajador de planta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_grupo_cuenta`
--

CREATE TABLE IF NOT EXISTS `tbl_grupo_cuenta` (
  `id_grupo_cuenta` int(11) NOT NULL,
  `grupo_cuenta` varchar(50) DEFAULT NULL,
  `abreviatura_grupo_cuenta` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id_grupo_cuenta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_grupo_cuenta`
--

INSERT INTO `tbl_grupo_cuenta` (`id_grupo_cuenta`, `grupo_cuenta`, `abreviatura_grupo_cuenta`) VALUES
(1, 'Circulante', '(C)'),
(2, 'No Circulante', '(NC)');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_inductor_consumido`
--

CREATE TABLE IF NOT EXISTS `tbl_inductor_consumido` (
  `id_inductor_consumido` int(11) NOT NULL AUTO_INCREMENT,
  `id_consumidor_costo` int(11) NOT NULL,
  `id_inductor_costo` int(11) NOT NULL,
  `valor_inductor` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_inductor_consumido`),
  KEY `id_consumidor_costo` (`id_consumidor_costo`),
  KEY `id_inductor_costo` (`id_inductor_costo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `tbl_inductor_consumido`
--

INSERT INTO `tbl_inductor_consumido` (`id_inductor_consumido`, `id_consumidor_costo`, `id_inductor_costo`, `valor_inductor`) VALUES
(1, 1, 1, 18),
(2, 1, 2, 21),
(3, 1, 3, 11),
(4, 1, 4, 3),
(5, 1, 5, 5),
(6, 2, 1, 30),
(7, 2, 2, 35),
(8, 2, 3, 4),
(9, 2, 4, 50),
(10, 2, 5, 18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_inductor_costo`
--

CREATE TABLE IF NOT EXISTS `tbl_inductor_costo` (
  `id_inductor_costo` int(11) NOT NULL AUTO_INCREMENT,
  `id_actividad` int(11) NOT NULL,
  `nombre_inductor_costo` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_inductor_costo`),
  KEY `id_actividad` (`id_actividad`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `tbl_inductor_costo`
--

INSERT INTO `tbl_inductor_costo` (`id_inductor_costo`, `id_actividad`, `nombre_inductor_costo`) VALUES
(1, 2, 'inductor costo 1'),
(2, 3, 'inductor costo 2'),
(3, 4, 'inductor costo 3'),
(4, 5, 'inductor costo 4'),
(5, 6, 'inductor costo 5');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_pago_empleado`
--

CREATE TABLE IF NOT EXISTS `tbl_pago_empleado` (
  `id_pago_empleado` int(11) NOT NULL AUTO_INCREMENT,
  `id_empleado` int(11) NOT NULL,
  `monto_pago` decimal(10,2) DEFAULT NULL,
  `fecha_pago` datetime DEFAULT NULL,
  `id_transaccion_1` int(11) NOT NULL,
  `id_transaccion_2` int(11) NOT NULL,
  PRIMARY KEY (`id_pago_empleado`),
  KEY `id_transaccion_1` (`id_transaccion_1`),
  KEY `id_transaccion_2` (`id_transaccion_2`),
  KEY `id_empleado` (`id_empleado`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tbl_pago_empleado`
--

INSERT INTO `tbl_pago_empleado` (`id_pago_empleado`, `id_empleado`, `monto_pago`, `fecha_pago`, `id_transaccion_1`, `id_transaccion_2`) VALUES
(1, 1, '1403.52', '2017-11-30 17:06:22', 55, 56);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_periodo_contable`
--

CREATE TABLE IF NOT EXISTS `tbl_periodo_contable` (
  `id_periodo_contable` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_creacion` datetime DEFAULT NULL,
  `fecha_inicio` datetime DEFAULT NULL,
  `fecha_final` datetime DEFAULT NULL,
  `meses_duracion` int(11) DEFAULT NULL,
  `perc_utilidad_retenida` int(11) DEFAULT NULL,
  `estado` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_periodo_contable`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `tbl_periodo_contable`
--

INSERT INTO `tbl_periodo_contable` (`id_periodo_contable`, `fecha_creacion`, `fecha_inicio`, `fecha_final`, `meses_duracion`, `perc_utilidad_retenida`, `estado`) VALUES
(1, '2017-11-24 13:06:38', '2017-11-01 00:00:00', '2017-11-30 00:00:00', 1, 60, 'cerrado'),
(11, '2017-11-25 09:27:47', '2017-12-01 00:00:00', '2017-12-31 00:00:00', 1, 60, 'abierto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_transaccion`
--

CREATE TABLE IF NOT EXISTS `tbl_transaccion` (
  `id_transaccion` int(11) NOT NULL AUTO_INCREMENT,
  `id_periodo_contable` int(11) DEFAULT NULL,
  `id_cuenta_interno` int(11) DEFAULT NULL,
  `monto` decimal(20,2) DEFAULT NULL,
  `esta_en_debe` varchar(2) DEFAULT NULL,
  `es_transaccion_ajuste` varchar(2) DEFAULT NULL,
  `fecha_realizacion` datetime DEFAULT NULL,
  PRIMARY KEY (`id_transaccion`),
  KEY `id_periodo_contable` (`id_periodo_contable`),
  KEY `id_cuenta_interno` (`id_cuenta_interno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=66 ;

--
-- Volcado de datos para la tabla `tbl_transaccion`
--

INSERT INTO `tbl_transaccion` (`id_transaccion`, `id_periodo_contable`, `id_cuenta_interno`, `monto`, `esta_en_debe`, `es_transaccion_ajuste`, `fecha_realizacion`) VALUES
(1, 1, 4, '150000.00', 'V', 'F', '2017-11-24 19:25:03'),
(2, 1, 9, '150000.00', 'F', 'F', '2017-11-24 19:25:03'),
(5, 1, 4, '5000.00', 'F', 'F', '2017-11-24 13:27:57'),
(6, 1, 5, '5000.00', 'V', 'F', '2017-11-24 13:27:57'),
(7, 1, 6, '18000.00', 'V', 'F', '2017-11-24 13:31:26'),
(8, 1, 10, '18000.00', 'F', 'F', '2017-11-24 13:31:26'),
(9, 1, 11, '3000.00', 'F', 'F', '2017-11-24 13:32:27'),
(10, 1, 7, '3000.00', 'V', 'F', '2017-11-24 13:32:27'),
(11, 1, 4, '1800.00', 'F', 'F', '2017-11-24 13:33:18'),
(12, 1, 12, '1800.00', 'V', 'F', '2017-11-24 13:33:18'),
(13, 1, 4, '8000.00', 'V', 'F', '2017-11-24 13:34:19'),
(14, 1, 11, '8000.00', 'F', 'F', '2017-11-24 13:34:19'),
(15, 1, 4, '8500.00', 'F', 'F', '2017-11-24 13:36:20'),
(16, 1, 8, '8500.00', 'V', 'F', '2017-11-24 13:36:20'),
(17, 1, 6, '800.00', 'F', 'V', '2017-11-24 13:38:00'),
(18, 1, 14, '800.00', 'V', 'V', '2017-11-24 13:38:00'),
(19, 1, 15, '800.00', 'F', 'V', '2017-11-24 13:39:13'),
(20, 1, 13, '800.00', 'V', 'V', '2017-11-24 13:39:13'),
(21, 1, 4, '800.00', 'F', 'F', '2017-11-24 13:45:31'),
(22, 1, 16, '800.00', 'V', 'F', '2017-11-24 13:45:31'),
(46, 11, 4, '141900.00', 'V', 'F', '2017-11-25 09:27:47'),
(47, 11, 5, '5000.00', 'V', 'F', '2017-11-25 09:27:47'),
(48, 11, 6, '17200.00', 'V', 'F', '2017-11-25 09:27:47'),
(49, 11, 7, '3000.00', 'V', 'F', '2017-11-25 09:27:47'),
(50, 11, 15, '800.00', 'F', 'F', '2017-11-25 09:27:47'),
(51, 11, 8, '8500.00', 'V', 'F', '2017-11-25 09:27:47'),
(52, 11, 10, '18000.00', 'F', 'F', '2017-11-25 09:27:47'),
(53, 11, 18, '4560.00', 'F', 'F', '2017-11-25 09:27:47'),
(54, 11, 9, '152240.00', 'F', 'F', '2017-11-25 09:27:48'),
(55, 11, 4, '1403.52', 'F', 'F', '2017-11-30 17:06:22'),
(56, 11, 12, '1403.52', 'V', 'F', '2017-11-30 17:06:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_unidad_reparto_primario`
--

CREATE TABLE IF NOT EXISTS `tbl_unidad_reparto_primario` (
  `id_unidad_reparto_primario` int(11) NOT NULL AUTO_INCREMENT,
  `id_criterio_reparto_primario` int(11) NOT NULL,
  `id_centro_costo` int(11) NOT NULL,
  `valor_unidad` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id_unidad_reparto_primario`),
  KEY `id_criterio_reparto_primario` (`id_criterio_reparto_primario`),
  KEY `id_centro_costo` (`id_centro_costo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `tbl_unidad_reparto_primario`
--

INSERT INTO `tbl_unidad_reparto_primario` (`id_unidad_reparto_primario`, `id_criterio_reparto_primario`, `id_centro_costo`, `valor_unidad`) VALUES
(1, 1, 1, '801.00'),
(2, 1, 2, '358.00'),
(3, 1, 3, '1250.00'),
(4, 2, 1, '2257.00'),
(5, 2, 2, '1650.00'),
(6, 2, 3, '236.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_unidad_reparto_secundario`
--

CREATE TABLE IF NOT EXISTS `tbl_unidad_reparto_secundario` (
  `id_unidad_reparto_secundario` int(11) NOT NULL AUTO_INCREMENT,
  `id_criterio_reparto_secundario` int(11) NOT NULL,
  `id_actividad` int(11) NOT NULL,
  `valor_unidad` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id_unidad_reparto_secundario`),
  KEY `id_criterio_reparto_secundario` (`id_criterio_reparto_secundario`),
  KEY `id_actividad` (`id_actividad`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `tbl_unidad_reparto_secundario`
--

INSERT INTO `tbl_unidad_reparto_secundario` (`id_unidad_reparto_secundario`, `id_criterio_reparto_secundario`, `id_actividad`, `valor_unidad`) VALUES
(1, 1, 2, '313.00'),
(2, 1, 3, '218.00'),
(3, 1, 4, '324.00'),
(4, 2, 5, '258.00'),
(5, 2, 6, '123.00'),
(9, 4, 7, '360.00'),
(10, 4, 8, '213.00'),
(11, 4, 9, '200.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_unidad_reparto_terciario`
--

CREATE TABLE IF NOT EXISTS `tbl_unidad_reparto_terciario` (
  `id_unidad_reparto_terciario` int(11) NOT NULL AUTO_INCREMENT,
  `id_criterio_reparto_terciario` int(11) NOT NULL,
  `id_actividad` int(11) NOT NULL,
  `valor_unidad` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id_unidad_reparto_terciario`),
  KEY `id_criterio_reparto_terciario` (`id_criterio_reparto_terciario`),
  KEY `id_actividad` (`id_actividad`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Volcado de datos para la tabla `tbl_unidad_reparto_terciario`
--

INSERT INTO `tbl_unidad_reparto_terciario` (`id_unidad_reparto_terciario`, `id_criterio_reparto_terciario`, `id_actividad`, `valor_unidad`) VALUES
(1, 1, 2, '820.00'),
(2, 1, 3, '215.00'),
(3, 1, 4, '223.00'),
(4, 1, 5, '214.00'),
(5, 1, 6, '53.00'),
(6, 2, 2, '216.00'),
(7, 2, 3, '212.00'),
(8, 2, 4, '832.00'),
(9, 2, 5, '114.00'),
(10, 2, 6, '101.00'),
(16, 4, 2, '313.00'),
(17, 4, 3, '223.00'),
(18, 4, 4, '832.00'),
(19, 4, 5, '114.00'),
(20, 4, 6, '101.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuario`
--

CREATE TABLE IF NOT EXISTS `tbl_usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nombre_completo` varchar(200) NOT NULL,
  `tipo` varchar(10) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tbl_usuario`
--

INSERT INTO `tbl_usuario` (`id_usuario`, `email`, `password`, `nombre_completo`, `tipo`) VALUES
(1, 'colegio@gmail.com', '2301c59cbdef6862ec9cb5935165d0de', 'Colegio', 'admin');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_actividad`
--
ALTER TABLE `tbl_actividad`
  ADD CONSTRAINT `tbl_actividad_ibfk_1` FOREIGN KEY (`id_centro_costo`) REFERENCES `tbl_centro_costo` (`id_centro_costo`) ON DELETE CASCADE;

--
-- Filtros para la tabla `tbl_criterio_reparto_primario`
--
ALTER TABLE `tbl_criterio_reparto_primario`
  ADD CONSTRAINT `tbl_criterio_reparto_primario_ibfk_1` FOREIGN KEY (`id_cuenta_interno`) REFERENCES `tbl_cuenta` (`id_cuenta_interno`);

--
-- Filtros para la tabla `tbl_criterio_reparto_secundario`
--
ALTER TABLE `tbl_criterio_reparto_secundario`
  ADD CONSTRAINT `tbl_criterio_reparto_secundario_ibfk_1` FOREIGN KEY (`id_centro_costo`) REFERENCES `tbl_centro_costo` (`id_centro_costo`) ON DELETE CASCADE;

--
-- Filtros para la tabla `tbl_criterio_reparto_terciario`
--
ALTER TABLE `tbl_criterio_reparto_terciario`
  ADD CONSTRAINT `tbl_criterio_reparto_terciario_ibfk_1` FOREIGN KEY (`id_actividad_auxiliar`) REFERENCES `tbl_actividad` (`id_actividad`) ON DELETE CASCADE;

--
-- Filtros para la tabla `tbl_cuenta`
--
ALTER TABLE `tbl_cuenta`
  ADD CONSTRAINT `tbl_cuenta_ibfk_1` FOREIGN KEY (`id_clase_cuenta`) REFERENCES `tbl_clase_cuenta` (`id_clase_cuenta`),
  ADD CONSTRAINT `tbl_cuenta_ibfk_2` FOREIGN KEY (`id_grupo_cuenta`) REFERENCES `tbl_grupo_cuenta` (`id_grupo_cuenta`);

--
-- Filtros para la tabla `tbl_inductor_consumido`
--
ALTER TABLE `tbl_inductor_consumido`
  ADD CONSTRAINT `tbl_inductor_consumido_ibfk_1` FOREIGN KEY (`id_consumidor_costo`) REFERENCES `tbl_consumidor_costo` (`id_consumidor_costo`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_inductor_consumido_ibfk_2` FOREIGN KEY (`id_inductor_costo`) REFERENCES `tbl_inductor_costo` (`id_inductor_costo`) ON DELETE CASCADE;

--
-- Filtros para la tabla `tbl_inductor_costo`
--
ALTER TABLE `tbl_inductor_costo`
  ADD CONSTRAINT `tbl_inductor_costo_ibfk_1` FOREIGN KEY (`id_actividad`) REFERENCES `tbl_actividad` (`id_actividad`) ON DELETE CASCADE;

--
-- Filtros para la tabla `tbl_pago_empleado`
--
ALTER TABLE `tbl_pago_empleado`
  ADD CONSTRAINT `tbl_pago_empleado_ibfk_1` FOREIGN KEY (`id_transaccion_1`) REFERENCES `tbl_transaccion` (`id_transaccion`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_pago_empleado_ibfk_2` FOREIGN KEY (`id_transaccion_2`) REFERENCES `tbl_transaccion` (`id_transaccion`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_pago_empleado_ibfk_3` FOREIGN KEY (`id_empleado`) REFERENCES `tbl_empleado` (`id_empleado`) ON DELETE CASCADE;

--
-- Filtros para la tabla `tbl_transaccion`
--
ALTER TABLE `tbl_transaccion`
  ADD CONSTRAINT `tbl_transaccion_ibfk_1` FOREIGN KEY (`id_periodo_contable`) REFERENCES `tbl_periodo_contable` (`id_periodo_contable`),
  ADD CONSTRAINT `tbl_transaccion_ibfk_2` FOREIGN KEY (`id_cuenta_interno`) REFERENCES `tbl_cuenta` (`id_cuenta_interno`);

--
-- Filtros para la tabla `tbl_unidad_reparto_primario`
--
ALTER TABLE `tbl_unidad_reparto_primario`
  ADD CONSTRAINT `tbl_unidad_reparto_primario_ibfk_1` FOREIGN KEY (`id_criterio_reparto_primario`) REFERENCES `tbl_criterio_reparto_primario` (`id_criterio_reparto_primario`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_unidad_reparto_primario_ibfk_2` FOREIGN KEY (`id_centro_costo`) REFERENCES `tbl_centro_costo` (`id_centro_costo`) ON DELETE CASCADE;

--
-- Filtros para la tabla `tbl_unidad_reparto_secundario`
--
ALTER TABLE `tbl_unidad_reparto_secundario`
  ADD CONSTRAINT `tbl_unidad_reparto_secundario_ibfk_1` FOREIGN KEY (`id_criterio_reparto_secundario`) REFERENCES `tbl_criterio_reparto_secundario` (`id_criterio_reparto_secundario`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_unidad_reparto_secundario_ibfk_2` FOREIGN KEY (`id_actividad`) REFERENCES `tbl_actividad` (`id_actividad`) ON DELETE CASCADE;

--
-- Filtros para la tabla `tbl_unidad_reparto_terciario`
--
ALTER TABLE `tbl_unidad_reparto_terciario`
  ADD CONSTRAINT `tbl_unidad_reparto_terciario_ibfk_1` FOREIGN KEY (`id_criterio_reparto_terciario`) REFERENCES `tbl_criterio_reparto_terciario` (`id_criterio_reparto_terciario`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_unidad_reparto_terciario_ibfk_2` FOREIGN KEY (`id_actividad`) REFERENCES `tbl_actividad` (`id_actividad`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

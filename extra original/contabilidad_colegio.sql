-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-11-2017 a las 17:54:51
-- Versión del servidor: 5.7.17
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `contabilidad_colegio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_clase_cuenta`
--

CREATE TABLE `tbl_clase_cuenta` (
  `id_clase_cuenta` int(11) NOT NULL,
  `clase_cuenta` varchar(50) DEFAULT NULL,
  `abreviatura_clase_cuenta` varchar(5) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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

CREATE TABLE `tbl_configuracion` (
  `perc_utilidad_retenida` int(11) DEFAULT NULL,
  `longitud_periodo_contable` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_configuracion`
--

INSERT INTO `tbl_configuracion` (`perc_utilidad_retenida`, `longitud_periodo_contable`) VALUES
(40, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_cuenta`
--

CREATE TABLE `tbl_cuenta` (
  `id_cuenta_interno` int(11) NOT NULL,
  `id_clase_cuenta` int(11) DEFAULT NULL,
  `id_grupo_cuenta` int(11) DEFAULT NULL,
  `id_cuenta_mayor` int(11) DEFAULT NULL,
  `id_cuenta` int(11) DEFAULT NULL,
  `nombre_cuenta` varchar(150) DEFAULT NULL,
  `atributo_cuenta` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_cuenta`
--

INSERT INTO `tbl_cuenta` (`id_cuenta_interno`, `id_clase_cuenta`, `id_grupo_cuenta`, `id_cuenta_mayor`, `id_cuenta`, `nombre_cuenta`, `atributo_cuenta`) VALUES
(1, 1, 1, 1, NULL, 'Efectivo', ''),
(2, 3, 1, 1, NULL, 'Capital Empresa', ''),
(3, 1, 1, 2, NULL, 'Propaganda', ''),
(4, 2, 1, 1, NULL, 'Documentos por pagar', ''),
(5, 1, 2, 3, NULL, 'Equipo de oficina', ''),
(6, 5, 1, 1, NULL, 'Gastos por propaganda usada', ''),
(7, 4, 1, 1, NULL, 'Ingreso por servicios', ''),
(8, 5, 1, 2, NULL, 'Gastos por robo', 'DI'),
(9, 5, 1, 3, NULL, 'Gastos por servicios basicos', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_grupo_cuenta`
--

CREATE TABLE `tbl_grupo_cuenta` (
  `id_grupo_cuenta` int(11) NOT NULL,
  `grupo_cuenta` varchar(50) DEFAULT NULL,
  `abreviatura_grupo_cuenta` varchar(5) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_grupo_cuenta`
--

INSERT INTO `tbl_grupo_cuenta` (`id_grupo_cuenta`, `grupo_cuenta`, `abreviatura_grupo_cuenta`) VALUES
(1, 'Circulante', '(C)'),
(2, 'No Circulante', '(NC)');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_periodo_contable`
--

CREATE TABLE `tbl_periodo_contable` (
  `id_periodo_contable` int(11) NOT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `fecha_inicio` datetime DEFAULT NULL,
  `fecha_final` datetime DEFAULT NULL,
  `meses_duracion` int(11) DEFAULT NULL,
  `perc_utilidad_retenida` int(11) DEFAULT NULL,
  `estado` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_periodo_contable`
--

INSERT INTO `tbl_periodo_contable` (`id_periodo_contable`, `fecha_creacion`, `fecha_inicio`, `fecha_final`, `meses_duracion`, `perc_utilidad_retenida`, `estado`) VALUES
(1, '2017-10-31 02:16:33', '2016-10-01 00:00:00', '2016-10-31 00:00:00', 1, 40, 'abierto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_transaccion`
--

CREATE TABLE `tbl_transaccion` (
  `id_transaccion` int(11) NOT NULL,
  `id_periodo_contable` int(11) DEFAULT NULL,
  `id_cuenta_interno` int(11) DEFAULT NULL,
  `monto` decimal(20,2) DEFAULT NULL,
  `esta_en_debe` varchar(2) DEFAULT NULL,
  `es_transaccion_ajuste` varchar(2) DEFAULT NULL,
  `fecha_realizacion` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_transaccion`
--

INSERT INTO `tbl_transaccion` (`id_transaccion`, `id_periodo_contable`, `id_cuenta_interno`, `monto`, `esta_en_debe`, `es_transaccion_ajuste`, `fecha_realizacion`) VALUES
(1, 1, 1, '100000.00', 'V', 'F', '2017-11-06 00:00:48'),
(2, 1, 2, '100000.00', 'F', 'F', '2017-11-06 00:00:48'),
(3, 1, 3, '5000.00', 'V', 'F', '2017-11-06 00:02:15'),
(4, 1, 1, '5000.00', 'F', 'F', '2017-11-06 00:02:15'),
(5, 1, 5, '15000.00', 'V', 'F', '2017-11-06 00:04:10'),
(6, 1, 4, '15000.00', 'F', 'F', '2017-11-06 00:04:10'),
(7, 1, 3, '1000.00', 'F', 'V', '2017-11-06 00:10:33'),
(8, 1, 6, '1000.00', 'V', 'V', '2017-11-06 00:10:33'),
(9, 1, 1, '18000.00', 'V', 'F', '2017-11-06 00:42:15'),
(10, 1, 7, '18000.00', 'F', 'F', '2017-11-06 00:42:15'),
(11, 1, 1, '4000.00', 'F', 'F', '2017-11-06 05:41:37'),
(12, 1, 8, '4000.00', 'V', 'F', '2017-11-06 05:41:37');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_clase_cuenta`
--
ALTER TABLE `tbl_clase_cuenta`
  ADD PRIMARY KEY (`id_clase_cuenta`);

--
-- Indices de la tabla `tbl_cuenta`
--
ALTER TABLE `tbl_cuenta`
  ADD PRIMARY KEY (`id_cuenta_interno`),
  ADD KEY `id_clase_cuenta` (`id_clase_cuenta`),
  ADD KEY `id_grupo_cuenta` (`id_grupo_cuenta`);

--
-- Indices de la tabla `tbl_grupo_cuenta`
--
ALTER TABLE `tbl_grupo_cuenta`
  ADD PRIMARY KEY (`id_grupo_cuenta`);

--
-- Indices de la tabla `tbl_periodo_contable`
--
ALTER TABLE `tbl_periodo_contable`
  ADD PRIMARY KEY (`id_periodo_contable`);

--
-- Indices de la tabla `tbl_transaccion`
--
ALTER TABLE `tbl_transaccion`
  ADD PRIMARY KEY (`id_transaccion`),
  ADD KEY `id_periodo_contable` (`id_periodo_contable`),
  ADD KEY `id_cuenta_interno` (`id_cuenta_interno`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_cuenta`
--
ALTER TABLE `tbl_cuenta`
  MODIFY `id_cuenta_interno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `tbl_periodo_contable`
--
ALTER TABLE `tbl_periodo_contable`
  MODIFY `id_periodo_contable` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tbl_transaccion`
--
ALTER TABLE `tbl_transaccion`
  MODIFY `id_transaccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

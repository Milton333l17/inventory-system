-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-08-2020 a las 21:21:47
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inventorysystem`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradas`
--

CREATE TABLE `entradas` (
  `identradas` int(11) NOT NULL COMMENT 'se guardara la ide de las entradas',
  `Nombre_produ` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'en este campo se guardara el nombre del producto',
  `cantidad` int(11) NOT NULL COMMENT 'en este campo se guardara la cantidad que llega del producto',
  `Stock` int(11) NOT NULL COMMENT 'aqui se guardara los productos que se guardaron y que hay en el almacen',
  `hora y fecha` datetime NOT NULL COMMENT 'en este campo se guardara la hora y la fecha de llegada del producto',
  `Login_usuario_n° documento` int(11) NOT NULL COMMENT 'en este campo se guardara el numero de documento que se registro ',
  `unidad_medida_id` int(11) NOT NULL COMMENT 'en este campo se guarda la unidad de la cantidad que llego ya sea litos,unidad, etc.',
  `tipo_producto_id` int(11) NOT NULL COMMENT 'en este campo se guarda el tipo de producto ya sea aseo, hjiene,persona,etc.',
  `estado_idestado` int(11) NOT NULL COMMENT 'en este campo se guardara el estado que llego el producto ya sea bueno o malo',
  `Provedor_id` int(11) NOT NULL COMMENT 'en este campo se guarda el telefono del provedor',
  `salida_idsalida` int(11) NOT NULL COMMENT 'ene este campo se guarda la cantidad de productos que salieron'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `idestado` int(11) NOT NULL COMMENT 'se guarda la id del estado el producto',
  `tipo_estado` tinytext COLLATE utf8_spanish_ci NOT NULL COMMENT 'se sellecciona si llego en buen o mal estado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login_usuario`
--

CREATE TABLE `login_usuario` (
  `id` int(11) NOT NULL,
  `documento` int(11) NOT NULL COMMENT 'sr(a) en este campo se guardara el numero de identificcion de la persona',
  `nombres` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'aqui se registraran los nombres de la persona',
  `apellidos` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'aqui se guardara los apellidos de la persona',
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'aqui se guardara la contraseña asignada',
  `email` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '0',
  `tip_doc_id` int(11) NOT NULL COMMENT 'aqui se guardara la ide del tipo del documento',
  `rol_id` int(11) NOT NULL COMMENT 'en este campo la persona seleccionara el rol a la que pertenece la persona'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `login_usuario`
--

INSERT INTO `login_usuario` (`id`, `documento`, `nombres`, `apellidos`, `password`, `email`, `estado`, `tip_doc_id`, `rol_id`) VALUES
(1, 1001995096, 'Stephen', 'Alarcon', '$2y$10$cXajR4X9FoEu/ZSp0QuJW.hPbBoyZmWS65QXbI7At/UklWk4pbDcS', 'stephen@gmail.com', 0, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provedor`
--

CREATE TABLE `provedor` (
  `idprovedor` varchar(20) COLLATE utf8_spanish_ci NOT NULL COMMENT 'se guarda la id del provedor',
  `telefono` int(11) NOT NULL COMMENT 'se guarda el telefono del provedor',
  `nombre` int(11) NOT NULL COMMENT 'se guarda el nombre de la persona o el laboratorio(provedor)',
  `direccion` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'se guarda la dirreccion del provedor'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idRol` int(11) NOT NULL COMMENT 'se guardara la id del rol de la persona',
  `rol` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'aqui se guardara el rol de las personas y sea administrador o empleado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idRol`, `rol`) VALUES
(1, 'Administrador'),
(2, 'Empleado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salida`
--

CREATE TABLE `salida` (
  `idsalida` int(11) NOT NULL COMMENT 'se guarda la id del la salidas',
  `nombre_clien` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'se guarda el nombre del cliente que compro el producto',
  `fecha y hora` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'se guardad la fecha y hora de salida del producto',
  `cantidad` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'se guarda la cantidad del producto '
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_producto`
--

CREATE TABLE `tipo_producto` (
  `idtipo_producto` int(11) NOT NULL COMMENT 'en este campo se guarda la id del tipo de producto',
  `descripcion` tinytext COLLATE utf8_spanish_ci NOT NULL COMMENT 'en este campo se guarda la descripcion del producto, sea hijiene,aseo,personal, etc.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tip_doc`
--

CREATE TABLE `tip_doc` (
  `idTip_doc` int(11) NOT NULL COMMENT 'sr(a) aqui se guardara el numero de identificacion',
  `descripcion` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'sr(a) en etes campo se guardara el tipo de identficacion ya se a cc,ce,ti,etc.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tip_doc`
--

INSERT INTO `tip_doc` (`idTip_doc`, `descripcion`) VALUES
(2, 'C.C'),
(3, 'C.E'),
(1, 'T.I');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidad_medida`
--

CREATE TABLE `unidad_medida` (
  `idunidad_medida` int(11) NOT NULL COMMENT 'se guarda la id del la unidad que se va utilizar',
  `medida` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'se digita la el tipo de cantidad que se ingresa (lt,un,ml,etc)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD PRIMARY KEY (`identradas`),
  ADD KEY `estado_idestado` (`estado_idestado`),
  ADD KEY `salida_idsalida` (`salida_idsalida`),
  ADD KEY `unidad_medida_id` (`unidad_medida_id`,`Provedor_id`),
  ADD KEY `tipo_producto_id` (`tipo_producto_id`);

--
-- Indices de la tabla `login_usuario`
--
ALTER TABLE `login_usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `documento` (`documento`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `tip_doc_id` (`tip_doc_id`),
  ADD KEY `rol_id` (`rol_id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idRol`),
  ADD UNIQUE KEY `rol` (`rol`);

--
-- Indices de la tabla `tip_doc`
--
ALTER TABLE `tip_doc`
  ADD PRIMARY KEY (`idTip_doc`),
  ADD UNIQUE KEY `descripcion` (`descripcion`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `login_usuario`
--
ALTER TABLE `login_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `login_usuario`
--
ALTER TABLE `login_usuario`
  ADD CONSTRAINT `login_usuario_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`idRol`),
  ADD CONSTRAINT `login_usuario_ibfk_2` FOREIGN KEY (`tip_doc_id`) REFERENCES `tip_doc` (`idTip_doc`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

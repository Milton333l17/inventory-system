-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-11-2020 a las 23:15:29
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Estructura de tabla para la tabla `calendario`
--

CREATE TABLE `calendario` (
  `id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `color` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `textColor` text COLLATE utf8_spanish_ci NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `calendario`
--

INSERT INTO `calendario` (`id`, `title`, `descripcion`, `color`, `textColor`, `start`, `end`) VALUES
(36, 'salsa', 'rosada', '#c18686', '#000000', '2020-11-22 18:19:00', '0000-00-00 00:00:00'),
(37, 'perros', 'callejeros', '#ff0000', '#000000', '2020-11-24 19:38:00', '0000-00-00 00:00:00'),
(38, 'cumpleaños', 'felipe', '#00b3ff', '#e33535', '2020-10-30 10:30:00', '0000-00-00 00:00:00'),
(39, 'sfdgd', 'fdffdf', '#000000', '#000000', '2020-11-04 10:30:00', '0000-00-00 00:00:00'),
(40, 'Mateo y richard', 'tamaño pelotas tipo nueces', '#ffffff', '#ff0000', '2020-11-24 10:30:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `estado`) VALUES
(1, 'cloroxer', 1),
(4, 'andres', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradas`
--

CREATE TABLE `entradas` (
  `id` int(11) NOT NULL COMMENT 'se guardara el id de las entradas',
  `producto_id` int(11) NOT NULL COMMENT 'en este campo se guardara el nombre del producto',
  `cantidad` int(11) NOT NULL COMMENT 'en este campo se guardara la cantidad que llega del producto',
  `fecha` date NOT NULL COMMENT 'en este campo se guardara la hora y la fecha de llegada del producto',
  `login_usuario_id` int(11) NOT NULL COMMENT 'en este campo se guardara el numero de documento que se registro ',
  `estado_id` int(11) NOT NULL COMMENT 'en este campo se guardara el estado que llego el producto ya sea bueno o malo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `entradas`
--

INSERT INTO `entradas` (`id`, `producto_id`, `cantidad`, `fecha`, `login_usuario_id`, `estado_id`) VALUES
(55, 17, 90, '2020-11-21', 21, 3),
(56, 17, 30, '2020-11-21', 21, 3),
(57, 18, 40, '2020-11-26', 21, 3),
(58, 16, 80, '2020-11-25', 21, 3),
(59, 18, 34, '2020-12-08', 21, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `idestado` int(11) NOT NULL COMMENT 'se guarda la id del estado el producto',
  `tipo_estado` tinytext COLLATE utf8_spanish_ci NOT NULL COMMENT 'se sellecciona si llego en buen o mal estado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`idestado`, `tipo_estado`) VALUES
(1, 'obsoleto'),
(2, 'dañado'),
(3, 'activo');

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
  `estado` int(11) NOT NULL DEFAULT 0,
  `tip_doc_id` int(11) NOT NULL COMMENT 'aqui se guardara la ide del tipo del documento',
  `rol_id` int(11) NOT NULL COMMENT 'en este campo la persona seleccionara el rol a la que pertenece la persona',
  `imagen_url` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `login_usuario`
--

INSERT INTO `login_usuario` (`id`, `documento`, `nombres`, `apellidos`, `password`, `email`, `estado`, `tip_doc_id`, `rol_id`, `imagen_url`) VALUES
(1, 1001995096, 'Stephen', 'Alarcon', '$2y$10$AV0eTpAMvQpRuxc2AsSxS.V/Z7vKcE.agFIFpCtbArNcdyH6IMc3a', 'stephen@gmail.com', 0, 1, 1, 'richard.jpg'),
(20, 1006656642, 'milton', 'araque', '$2y$10$bLf35K3URKfc7xdl28AryenhuvleONdnSPUlsAJz0D6ePQU9WUKb.', 'milton333l@hotmail.com', 1, 2, 1, 'pintico.jpg'),
(21, 1000776005, 'andres', 'Cristancho', '$2y$10$YQk7G3ipgEe9EmpFJtWqZeTiN2VO48YVCoP93T2dEsUdgLfVKsD1y', 'afcristancho5@misena.edu.co', 0, 2, 1, 'pikachu.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(95) COLLATE utf8_unicode_ci NOT NULL,
  `unidad_medida_id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `estado_id` int(11) NOT NULL,
  `provedor_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `unidad_medida_id`, `categoria_id`, `estado_id`, `provedor_id`, `cantidad`) VALUES
(16, 'PELOTAS', 'PARA JUGAR CON EL PERRO', 1, 4, 3, 20, 80),
(17, 'LATIGOS', 'PARA CARTIGAR A PERROS Y PERRAS', 1, 4, 3, 22, 120),
(18, 'ARROZ', 'DELICIOSOS ARROZ', 1, 1, 1, 20, 74),
(19, 'CONDONES', 'MAYOR PROTECCION NO VENDRIA MAL Y UN HIJO PERDIDO MENOS?', 1, 4, 2, 20, 40);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provedor`
--

CREATE TABLE `provedor` (
  `id` int(20) NOT NULL COMMENT 'se guarda la id del provedor',
  `telefono` int(11) NOT NULL COMMENT 'se guarda el telefono del provedor',
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'se guarda el nombre de la persona o el laboratorio(provedor)',
  `direccion` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'se guarda la dirreccion del provedor',
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `provedor`
--

INSERT INTO `provedor` (`id`, `telefono`, `nombre`, `direccion`, `estado`) VALUES
(20, 123456789, 'hawking', 'crack12', 1),
(21, 8364321, 'felipondio', 'crav89', 0),
(22, 2147483647, 'logic', 'sdsdadsa', 1);

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
-- Volcado de datos para la tabla `unidad_medida`
--

INSERT INTO `unidad_medida` (`idunidad_medida`, `medida`) VALUES
(1, 'unidad'),
(2, 'ml');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `calendario`
--
ALTER TABLE `calendario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estado_idestado` (`estado_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`idestado`);

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
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`),
  ADD KEY `unidad_medida_id` (`unidad_medida_id`),
  ADD KEY `categoria_id` (`categoria_id`),
  ADD KEY `provedor_id` (`provedor_id`),
  ADD KEY `estado_id` (`estado_id`);

--
-- Indices de la tabla `provedor`
--
ALTER TABLE `provedor`
  ADD PRIMARY KEY (`id`);

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
-- Indices de la tabla `unidad_medida`
--
ALTER TABLE `unidad_medida`
  ADD PRIMARY KEY (`idunidad_medida`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `calendario`
--
ALTER TABLE `calendario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `entradas`
--
ALTER TABLE `entradas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'se guardara el id de las entradas', AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `idestado` int(11) NOT NULL AUTO_INCREMENT COMMENT 'se guarda la id del estado el producto', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `login_usuario`
--
ALTER TABLE `login_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `provedor`
--
ALTER TABLE `provedor`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT COMMENT 'se guarda la id del provedor', AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `unidad_medida`
--
ALTER TABLE `unidad_medida`
  MODIFY `idunidad_medida` int(11) NOT NULL AUTO_INCREMENT COMMENT 'se guarda la id del la unidad que se va utilizar', AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `login_usuario`
--
ALTER TABLE `login_usuario`
  ADD CONSTRAINT `login_usuario_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`idRol`),
  ADD CONSTRAINT `login_usuario_ibfk_2` FOREIGN KEY (`tip_doc_id`) REFERENCES `tip_doc` (`idTip_doc`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`provedor_id`) REFERENCES `provedor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `productos_ibfk_3` FOREIGN KEY (`unidad_medida_id`) REFERENCES `unidad_medida` (`idunidad_medida`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `productos_ibfk_4` FOREIGN KEY (`estado_id`) REFERENCES `estado` (`idestado`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

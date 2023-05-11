-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-05-2023 a las 02:57:29
-- Versión del servidor: 10.4.20-MariaDB
-- Versión de PHP: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto_veterinaria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bloquearcolumna`
--

CREATE TABLE `bloquearcolumna` (
  `id_bloqueo` int(11) NOT NULL,
  `Nomb_dia` varchar(20) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `bloquearcolumna`
--

INSERT INTO `bloquearcolumna` (`id_bloqueo`, `Nomb_dia`, `status`) VALUES
(1, 'lunes', 0),
(2, 'martes', 0),
(3, 'miercoles', 0),
(4, 'jueves', 0),
(5, 'viernes', 0),
(6, 'sabado', 0),
(7, 'domingo', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bloquearfecha`
--

CREATE TABLE `bloquearfecha` (
  `id_bloqueo` int(11) NOT NULL,
  `fecha_bloqueo` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `bloquearfecha`
--

INSERT INTO `bloquearfecha` (`id_bloqueo`, `fecha_bloqueo`) VALUES
(1, '2023-03-28'),
(2, '2023-03-30'),
(3, '2023-03-24'),
(4, '2023-03-31'),
(5, '2023-04-15'),
(6, '2023-05-09'),
(7, '2023-05-13'),
(8, '2023-04-30'),
(9, '2023-04-26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_cat` int(11) NOT NULL,
  `nom_cat` varchar(40) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita`
--

CREATE TABLE `cita` (
  `id_cita` int(11) NOT NULL,
  `id_usu` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` varchar(20) NOT NULL,
  `id_mas` int(11) NOT NULL,
  `id_servicio` int(11) NOT NULL,
  `especificacion` text NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cita`
--

INSERT INTO `cita` (`id_cita`, `id_usu`, `fecha`, `hora`, `id_mas`, `id_servicio`, `especificacion`, `status`) VALUES
(1, 3, '2023-03-27', '03:00:00', 1, 1, 'perro masculino de raza ', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `disponibilidad`
--

CREATE TABLE `disponibilidad` (
  `id_dis` int(11) NOT NULL,
  `inicio` time NOT NULL,
  `final` time NOT NULL,
  `tiempo` time NOT NULL,
  `dias` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `disponibilidad`
--

INSERT INTO `disponibilidad` (`id_dis`, `inicio`, `final`, `tiempo`, `dias`) VALUES
(1, '08:00:00', '18:00:00', '01:00:00', 'lunes'),
(2, '09:00:00', '11:00:00', '00:20:00', 'martes'),
(3, '08:00:00', '10:00:00', '00:10:00', 'miercoles'),
(4, '08:00:00', '10:00:00', '00:50:00', 'jueves'),
(5, '11:00:00', '23:00:00', '02:00:00', 'viernes'),
(6, '06:00:00', '24:00:00', '00:05:29', 'sabado'),
(7, '08:00:00', '23:00:00', '00:30:00', 'domingo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `id_marca` int(11) NOT NULL,
  `nom_marca` varchar(40) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mascota`
--

CREATE TABLE `mascota` (
  `id_mas` int(11) NOT NULL,
  `nom_mas` varchar(80) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `mascota`
--

INSERT INTO `mascota` (`id_mas`, `nom_mas`, `status`) VALUES
(1, 'Perro', 1),
(2, 'Gato', 0),
(3, 'Ave', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulo`
--

CREATE TABLE `modulo` (
  `id_modulo` int(20) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `descripcion` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `modulo`
--

INSERT INTO `modulo` (`id_modulo`, `titulo`, `descripcion`, `status`) VALUES
(1, 'Dashboard', 'Dashboard', 1),
(2, 'Usuarios', 'Usuarios del sistema', 1),
(3, 'Calendario', 'Calendario de citas', 1),
(4, 'Servicios', 'Servicios de la clinica ', 1),
(5, 'Productos', 'Productos para animales', 1),
(6, 'Reportes', 'Reportes de citas ', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id_permiso` int(11) NOT NULL,
  `rol_id` int(20) NOT NULL,
  `modulo_id` int(20) NOT NULL,
  `r` int(11) NOT NULL,
  `w` int(11) NOT NULL,
  `u` int(11) NOT NULL,
  `d` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id_permiso`, `rol_id`, `modulo_id`, `r`, `w`, `u`, `d`) VALUES
(19, 1, 1, 1, 1, 1, 1),
(20, 1, 2, 1, 1, 1, 1),
(21, 1, 3, 1, 1, 1, 1),
(22, 1, 4, 1, 1, 1, 1),
(23, 1, 5, 1, 1, 1, 1),
(24, 1, 6, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_pro` int(11) NOT NULL,
  `nom_pro` varchar(80) NOT NULL,
  `foto` varchar(80) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `id_marca` int(11) NOT NULL,
  `id_cat` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(20) NOT NULL,
  `nom_rol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `nom_rol`) VALUES
(1, 'Administrador'),
(2, 'Usuario'),
(3, 'Moderador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `id_servicio` int(11) NOT NULL,
  `nom_servicio` varchar(80) NOT NULL,
  `foto` varchar(80) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `ruta` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`id_servicio`, `nom_servicio`, `foto`, `descripcion`, `precio`, `ruta`, `status`) VALUES
(1, 'Baño personalizados', 'Grooming.jpg', 'baños, cortes , etc', '50.00', 'baños-personalizados', 1),
(2, 'Consultas medicas', 'consultas.jpg', 'desparasitación, chequeos, etc', '200.00', 'consultas-medicas', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usu` int(11) NOT NULL,
  `nom_usu` varchar(80) NOT NULL,
  `ape_usu` varchar(80) NOT NULL,
  `dni` char(8) NOT NULL,
  `telefono` char(9) NOT NULL,
  `correo` varchar(80) NOT NULL,
  `pass_usu` varchar(120) NOT NULL,
  `id_rol` int(20) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usu`, `nom_usu`, `ape_usu`, `dni`, `telefono`, `correo`, `pass_usu`, `id_rol`, `status`) VALUES
(1, 'Juana Georgina', 'Mendez Galvez', '55342393', '946543821', 'JuanaMendez@gmail.com', 'abcde', 1, 1),
(2, 'Maria', 'Jimenez Tapia', '62331242', '934214321', 'maria.jimenez@gmail.com', '123', 3, 1),
(3, 'ronal ', 'timoteo ', '77059456', '12345678', 'ronalstevns@gmail.com', '123', 1, 0),
(5, 'steven', 'venturo', '87987', '24545', 'steven@gmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 1, 1),
(6, 'newton', 'kan', '6456', '54635', 'newton@gmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 3, 1),
(11, 'Silv', 'Jime', '', '6556465', 'sil@gmail.com', '20a07e6a2c9d675d33cb957a77df2c3a55c7218e76d4e22f9650dfb2b8ac87ed', 2, 1),
(12, 'Filenito', 'Tambo', '', '45321', 'file@gmail.com', 'c97556d9a1bb936d9ae03e03076ffb3841c29c1a57deee7eee12305455d86616', 2, 1),
(13, 'Humberto', 'Eco', '', '7845487', 'eco@gmail.com', '123', 2, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bloquearcolumna`
--
ALTER TABLE `bloquearcolumna`
  ADD PRIMARY KEY (`id_bloqueo`);

--
-- Indices de la tabla `bloquearfecha`
--
ALTER TABLE `bloquearfecha`
  ADD PRIMARY KEY (`id_bloqueo`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_cat`);

--
-- Indices de la tabla `cita`
--
ALTER TABLE `cita`
  ADD PRIMARY KEY (`id_cita`),
  ADD KEY `id_usu` (`id_usu`),
  ADD KEY `id_mas` (`id_mas`),
  ADD KEY `id_servicio` (`id_servicio`);

--
-- Indices de la tabla `disponibilidad`
--
ALTER TABLE `disponibilidad`
  ADD PRIMARY KEY (`id_dis`);

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id_marca`);

--
-- Indices de la tabla `mascota`
--
ALTER TABLE `mascota`
  ADD PRIMARY KEY (`id_mas`);

--
-- Indices de la tabla `modulo`
--
ALTER TABLE `modulo`
  ADD PRIMARY KEY (`id_modulo`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id_permiso`),
  ADD UNIQUE KEY `modulo_id` (`modulo_id`),
  ADD KEY `rol_id` (`rol_id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_pro`),
  ADD KEY `id_marca` (`id_marca`),
  ADD KEY `id_cat` (`id_cat`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`id_servicio`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usu`),
  ADD KEY `id_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bloquearcolumna`
--
ALTER TABLE `bloquearcolumna`
  MODIFY `id_bloqueo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `bloquearfecha`
--
ALTER TABLE `bloquearfecha`
  MODIFY `id_bloqueo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_cat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cita`
--
ALTER TABLE `cita`
  MODIFY `id_cita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `disponibilidad`
--
ALTER TABLE `disponibilidad`
  MODIFY `id_dis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mascota`
--
ALTER TABLE `mascota`
  MODIFY `id_mas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `modulo`
--
ALTER TABLE `modulo`
  MODIFY `id_modulo` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_pro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `id_servicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cita`
--
ALTER TABLE `cita`
  ADD CONSTRAINT `cita_ibfk_1` FOREIGN KEY (`id_usu`) REFERENCES `usuario` (`id_usu`),
  ADD CONSTRAINT `cita_ibfk_2` FOREIGN KEY (`id_mas`) REFERENCES `mascota` (`id_mas`),
  ADD CONSTRAINT `cita_ibfk_3` FOREIGN KEY (`id_servicio`) REFERENCES `servicio` (`id_servicio`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`id_marca`) REFERENCES `marca` (`id_marca`),
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`id_cat`) REFERENCES `categoria` (`id_cat`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

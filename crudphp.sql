-- phpMyAdmin SQL Dump
-- version 4.6.0deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 02-06-2016 a las 23:03:18
-- Versión del servidor: 5.6.28-1
-- Versión de PHP: 5.6.19-2+b1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `crudphp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE `cargo` (
  `codigo` tinyint(4) NOT NULL,
  `descripcion` varchar(60) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`codigo`, `descripcion`) VALUES
(12, 'Jefe Proyecto'),
(23, 'Analista'),
(32, 'Desarrollador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE `contacto` (
  `rut` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `cod_cargo` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `contacto`
--

INSERT INTO `contacto` (`rut`, `nombre`, `email`, `telefono`, `cod_cargo`) VALUES
('12123123-3', 'Alam Brito', 'a.brito@ufrontera.cl', '34343434', 12),
('12234432-4', 'Andres Guzman', 'a.guzman@gmail.cl', '78787878', 23),
('12345678-9', 'Fernando Fernandez', 'f.fernandez01@ufromail.cl', '12121212', 32),
('18234567-8', 'Rodrigo Rodriguez', 'r.rodriguez02@ufromail.cl', '23232323', 23),
('18683667-7', 'Pedro Manriquez', 'ptrmanriquez@gmail.com', '84823178', 23),
('18789323-2', 'Homero Simpsons', 'homer@gmail.cl', '9892337', 32),
('19234234-3', 'Lucas Parra', 'l.parra01@ufro.cl', '565656', 23);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `contacto`
--
ALTER TABLE `contacto`
  ADD PRIMARY KEY (`rut`),
  ADD KEY `cod_cargo` (`cod_cargo`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `contacto`
--
ALTER TABLE `contacto`
  ADD CONSTRAINT `contacto_ibfk_1` FOREIGN KEY (`cod_cargo`) REFERENCES `cargo` (`codigo`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

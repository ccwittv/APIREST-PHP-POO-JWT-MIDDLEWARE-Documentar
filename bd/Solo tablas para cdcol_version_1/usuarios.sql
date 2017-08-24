-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-08-2017 a las 22:12:45
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `cdcol`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
`id` bigint(20) unsigned NOT NULL,
  `nombre` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `apellido` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `mail` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `pass` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `nusuario` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `habilitado` varchar(1) COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `mail`, `pass`, `nusuario`, `habilitado`) VALUES
(1, 'juan carlos', 'mesa', 'jcmesa@gmail.com', 'lalala123', 'juanca', 'x'),
(2, 'roberto', 'pesto', 'rpesto@gmail.com', 'lelele321', 'pestorob', 'x'),
(4, 'julio', 'rizzo', 'jrizzo@gmail.com', 'tarufetti', 'tangalanga', 'x'),
(6, 'tito', 'cosa', 'tcosa@hotmail.com', 'lololo987', 'rando', 'x');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

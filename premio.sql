-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Servidor: localhost:8889
-- Tiempo de generación: 12-04-2016 a las 03:04:22
-- Versión del servidor: 5.5.42
-- Versión de PHP: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de datos: `bunky`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `premio`
--

CREATE TABLE `premio` (
  `id` int(11) NOT NULL,
  `nombre` varchar(35) NOT NULL,
  `valor` int(11) NOT NULL,
  `url` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `premio`
--

INSERT INTO `premio` (`id`, `nombre`, `valor`, `url`) VALUES
(1, 'Recargas', 20, 'http://www.tumundobunky.com/wp-content/uploads/2016/04/netflix-icon.png'),
(2, 'Spotify', 20, 'http://www.tumundobunky.com/wp-content/uploads/2016/04/netflix-icon.png'),
(3, 'Tablet', 48, 'http://www.tumundobunky.com/wp-content/uploads/2016/04/netflix-icon.png');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `premio`
--
ALTER TABLE `premio`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `premio`
--
ALTER TABLE `premio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
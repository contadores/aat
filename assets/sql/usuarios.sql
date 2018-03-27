-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-10-2017 a las 23:01:47
-- Versión del servidor: 10.1.25-MariaDB
-- Versión de PHP: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `miempresa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `Ap_pa` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `Ap_ma` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `IdCatSexo` int(11) NOT NULL,
  `Correo` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `Password` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `FR` datetime NOT NULL,
  `FA` datetime NOT NULL,
  `IdCatTipoUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Id`, `Nombre`, `Ap_pa`, `Ap_ma`, `IdCatSexo`, `Correo`, `Password`, `FR`, `FA`, `IdCatTipoUsuario`) VALUES
(1, 'Cindy Lizbeth', 'Ríos', 'Ríos', 5, 'cin.rios@gmail.com', 'hola1234', '2017-10-12 10:00:00', '2017-10-12 10:00:00', 1),
(2, 'Hector Enrique ', 'Fernández', 'Fernández', 4, 'hector.fer@gmail.com', 'hola1235', '2017-10-12 10:00:00', '2017-10-12 10:00:00', 2),
(3, 'Osciel Fernando', 'Hernández', 'Hernández', 4, 'osciel.hdz@gmail.com', 'hola1236', '2017-10-12 10:00:00', '2017-10-12 10:00:00', 2),
(4, 'Virgilio Román', 'Peréz', 'Peréz', 4, 'virgilio.perez@gmail.com', 'hola1237', '2017-10-12 10:00:00', '2017-10-12 10:00:00', 3),
(5, 'Benito Alan', 'Juárez', 'Juárez', 4, 'benito.juarezh@gmail.com', 'hola1238', '2017-10-12 10:00:00', '2017-10-12 10:00:00', 3),
(6, 'Yeyo', 'Juarez', 'Hdz', 4, 'yeyo.juarezh@gmail.com', 'hola1234', '2017-10-12 10:00:00', '2017-10-12 10:00:00', 1),
(7, 'Usuario', 'De', 'Prueba', 4, 'usuario_de_prueba@gmail.com', 'UsuarioDePrueba', '2017-10-12 20:35:17', '2017-10-12 20:35:17', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-10-2017 a las 22:59:54
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
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE `empresas` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `RFC` varchar(12) COLLATE utf8_spanish2_ci NOT NULL,
  `IdCatMunicipio` int(11) NOT NULL,
  `Colonia` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `Calle` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `Num_ext` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `Num_int` varchar(5) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `CP` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `FR` datetime NOT NULL,
  `FA` datetime NOT NULL,
  `IdUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `empresas`
--

INSERT INTO `empresas` (`Id`, `Nombre`, `RFC`, `IdCatMunicipio`, `Colonia`, `Calle`, `Num_ext`, `Num_int`, `CP`, `FR`, `FA`, `IdUsuario`) VALUES
(1, 'Little Cesar\'s', '123456123456', 2019, 'Tamatán', 'Verde', '123', '8', '87049', '2017-10-12 00:00:00', '2017-10-12 00:00:00', 1),
(2, 'Carl\'s Juniors', 'ABCDEFABCDEF', 2019, 'Luis Portillo', 'Azul', '321', '9', '87456', '2017-10-12 00:00:00', '2017-10-12 00:00:00', 1),
(3, 'Apple', 'ABCDEF123456', 2019, 'Sosa', 'Amarillo', '456', NULL, '87563', '2017-10-12 00:00:00', '2017-10-12 00:00:00', 2),
(4, 'Dell', '123456ABCDEF', 2019, 'Emilio Caballero', 'Naranja', '654', NULL, '87521', '2017-10-12 00:00:00', '2017-10-12 00:00:00', 3),
(5, 'Sony', '123ABCDEF123', 2019, 'Emilio Portes Gil', 'Rojo', '789', '9', '87964', '2017-10-12 00:00:00', '2017-10-12 00:00:00', 3),
(6, 'Doña Tota', '456ABCDEF456', 2019, 'México', 'Blanco', '987', '8', '87145', '2017-10-12 00:00:00', '2017-10-12 00:00:00', 4),
(7, 'Intel', 'ABC123456ABC', 2019, 'Tamatán', 'Rojo', '815', NULL, '87457', '2017-10-12 00:00:00', '2017-10-12 00:00:00', 4),
(8, 'Android', 'DEF123456DEF', 2019, 'México', 'Verde', '258', NULL, '87878', '2017-10-12 00:00:00', '2017-10-12 00:00:00', 4);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `empresas`
--
ALTER TABLE `empresas`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

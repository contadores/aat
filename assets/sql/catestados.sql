-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-10-2017 a las 22:59:25
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
-- Estructura de tabla para la tabla `catestados`
--

CREATE TABLE `catestados` (
  `Id` int(11) NOT NULL,
  `Elemento` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `IdCatPais` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `catestados`
--

INSERT INTO `catestados` (`Id`, `Elemento`, `IdCatPais`) VALUES
(1, 'Aguascalientes', NULL),
(2, 'Baja California', NULL),
(3, 'Baja California Sur', NULL),
(4, 'Campeche', NULL),
(5, 'Coahuila de Zaragoza', NULL),
(6, 'Colima', NULL),
(7, 'Chiapas', NULL),
(8, 'Chihuahua', NULL),
(9, 'Distrito Federal', NULL),
(10, 'Durango', NULL),
(11, 'Guanajuato', NULL),
(12, 'Guerrero', NULL),
(13, 'Hidalgo', NULL),
(14, 'Jalisco', NULL),
(15, 'México', NULL),
(16, 'Michoacán de Ocampo', NULL),
(17, 'Morelos', NULL),
(18, 'Nayarit', NULL),
(19, 'Nuevo León', NULL),
(20, 'Oaxaca', NULL),
(21, 'Puebla', NULL),
(22, 'Querétaro', NULL),
(23, 'Quintana Roo', NULL),
(24, 'San Luis Potosí', NULL),
(25, 'Sinaloa', NULL),
(26, 'Sonora', NULL),
(27, 'Tabasco', NULL),
(28, 'Tamaulipas', NULL),
(29, 'Tlaxcala', NULL),
(30, 'Veracruz de Ignacio de la Llave', NULL),
(31, 'Yucatán', NULL),
(32, 'Zacatecas', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `catestados`
--
ALTER TABLE `catestados`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `catestados`
--
ALTER TABLE `catestados`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

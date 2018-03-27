-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-10-2017 a las 23:00:47
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
-- Estructura de tabla para la tabla `registrospatronales`
--

CREATE TABLE `registrospatronales` (
  `Id` int(11) NOT NULL,
  `RP` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `IdCatMunicipio` int(11) NOT NULL,
  `Colonia` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `Calle` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `Num_ext` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `Num_int` varchar(5) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `CP` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `FR` datetime NOT NULL,
  `FA` datetime NOT NULL,
  `IdEmpresa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `registrospatronales`
--

INSERT INTO `registrospatronales` (`Id`, `RP`, `IdCatMunicipio`, `Colonia`, `Calle`, `Num_ext`, `Num_int`, `CP`, `FR`, `FA`, `IdEmpresa`) VALUES
(1, 'A35-12402-10-0', 2019, 'Tamatán', 'Verde', '123', '8', '87049', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(2, 'YUT-18235-20-0', 2019, 'Luis Portillo', 'Azul', '321', '9', '87456', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(3, 'TKI-42345-80-0', 2019, 'Sosa', 'Amarillo', '456', NULL, '87563', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(4, 'WTE-86789-00-0', 2019, 'Emilio Caballero', 'Naranja', '654', NULL, '87521', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2),
(5, 'VMS-64575-10-0', 2019, 'Emilio Portes Gil', 'Rojo', '789', '9', '87964', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2),
(6, 'ZVA-49813-20-0', 2019, 'México', 'Blanco', '987', '8', '87145', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 4),
(7, 'VMW-35154-30-0', 2019, 'Emilio Caballero', 'Azul', '894', NULL, '87463', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 4),
(8, 'BBM-36541-60-0', 2019, 'Emilio Portes Gil', 'Amarillo', '65', NULL, '87441', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 5),
(9, 'LJS-87944-30-0', 2019, 'México', 'Naranja', '132', NULL, '87419', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 5),
(10, 'IRO-11111-40-0', 2019, 'Emilio Caballero', 'Rojo', '8', NULL, '87397', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 6),
(11, '1J4-99999-20-0', 2019, 'Emilio Portes Gil', 'Blanco', '2', NULL, '87375', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 8),
(12, '5Y4-88888-50-0', 2019, 'México', 'Azul', '822', NULL, '87353', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 8),
(13, 'T4G-77777-70-0', 2019, 'Emilio Caballero', 'Amarillo', '5', NULL, '87330', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 8),
(14, '8R5-66666-80-0', 2019, 'Emilio Portes Gil', 'Naranja', '8', NULL, '87308', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 8),
(15, 'G55-55555-80-0', 2019, 'Tamatán', 'Verde', '10', NULL, '87286', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 8);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `registrospatronales`
--
ALTER TABLE `registrospatronales`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `registrospatronales`
--
ALTER TABLE `registrospatronales`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

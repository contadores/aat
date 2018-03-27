-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-10-2017 a las 20:51:51
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
-- Estructura de tabla para la tabla `catelementos`
--

CREATE TABLE `catelementos` (
  `Id` int(11) NOT NULL,
  `Catalogo` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `IdElemento` int(11) NOT NULL,
  `Elemento` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `NombreCorto` varchar(12) COLLATE utf8_spanish2_ci NOT NULL,
  `IdElementoPadre` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `catelementos`
--

INSERT INTO `catelementos` (`Id`, `Catalogo`, `IdElemento`, `Elemento`, `NombreCorto`, `IdElementoPadre`) VALUES
(1, 'CatTipoUsuario', 1, 'Administrador', 'ADMIN', NULL),
(2, 'CatTipoUsuario', 2, 'Auditor', 'AUDI', NULL),
(3, 'CatTipoUsuario', 3, 'Común', 'COM', NULL),
(4, 'CatSexo', 1, 'Masculino', 'M', NULL),
(5, 'CatSexo', 2, 'Femenino', 'F', NULL),
(6, 'CatTipoExcel', 1, 'Mensual SUA', 'MSUA', NULL),
(7, 'CatTipoExcel', 2, 'Mensual IDSE', 'MIDSE', NULL),
(8, 'CatTipoExcel', 3, 'Mensual XML', 'MXML', NULL),
(9, 'CatTipoExcel', 4, 'Bimestral SUA', 'BSUA', NULL),
(10, 'CatTipoExcel', 5, 'Bimestral IDSE', 'BIDSE', NULL),
(11, 'CatTipoExcel', 6, 'Bimestral XML', 'BXML', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `catelementos`
--
ALTER TABLE `catelementos`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `catelementos`
--
ALTER TABLE `catelementos`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-10-2017 a las 22:59:41
-- Versión del servidor: 10.1.25-MariaDB
-- Versión de PHP: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


CREATE TABLE `porcentajesFactorIntegracion` (
  `IdPorcentajes` int(11) NOT NULL primary key  AUTO_INCREMENT
  ,`IdEmpresa` int(11) NOT NULL
  ,`diasAguinaldo` int(11) NOT NULL
  ,`porcentajePrimaVacacional` double NOT NULL
  ,foreign key (IdEmpresa) references empresas (Id)on delete cascade on update cascade
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;


CREATE TABLE `diasVacaciones` (
  `IdDiasVacaciones` int(11) NOT NULL primary key  AUTO_INCREMENT
  ,`aniosTrabajados` int(2) NOT NULL
  ,`diasVacaciones` double NOT NULL
  ,`IdPorcentajes` int(11) NOT NULL
  ,foreign key (IdPorcentajes) references porcentajesFactorIntegracion (IdPorcentajes)on delete cascade on update cascade
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;



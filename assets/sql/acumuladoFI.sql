SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";



CREATE TABLE `diasvacaciones` (
  `IdDiasVacaciones`int NOT NULL primary key AUTO_INCREMENT ,
  `aniosTrabajados` int(11) NOT NULL,
  `diasVacaciones` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;




insert into diasvacaciones
(
	aniosTrabajados
    ,diasvacaciones
)
VALUES
(0,0)
,(1,6)
,(2,8)
,(3,10)
,(4,12)
,(5,14)
,(6,14)
,(7,14)
,(8,14)
,(9,14)
,(10,16)
,(11,16)
,(12,16)
,(13,16)
,(14,16)
,(15,18)
,(16,18)
,(17,18)
,(18,18)
,(19,18)
,(20,20)
,(21,20)
,(22,20)
,(23,20)
,(24,20)
,(25,22)
,(26,22)
,(27,22)
,(28,22)
,(29,22)
,(30,24)
,(31,24)
,(32,24)
,(33,24)
,(34,24)
,(35,26)
,(36,26)
,(37,26)
,(38,26)
,(39,26)
,(40,28)
,(41,28)
,(42,28)
,(43,28)
,(44,28)
,(45,30)
,(46,30)
,(47,30)
,(48,30)
,(49,30)
,(50,32);

CREATE TABLE `porcentajesfactorintegracion` (
  `IdPorcentajes`int NOT NULL primary key AUTO_INCREMENT ,
  `diasAguinaldo` int(11) NOT NULL,
  `porcentajePrimaVacacional` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;


insert into porcentajesfactorintegracion
(
diasAguinaldo
,porcentajePrimaVacacional
)
VALUES
(
15
,0.25
);

CREATE TABLE `diasvacacionesfI` (
  `IdDiasVacaciones`int NOT NULL primary key AUTO_INCREMENT ,
  `IdEmpresa` int(11) NOT NULL,
  `aniosTrabajados` int(11) NOT NULL,
  `diasVacaciones` int(11) NOT NULL
  ,foreign key (IdEmpresa) references empresas (Id) on delete cascade  on UPDATE cascade
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;


CREATE TABLE `porcentajesfactorintegracionfI` (
  `IdPorcentajes`int NOT NULL primary key AUTO_INCREMENT ,
  `IdEmpresa` int(11) NOT NULL,
  `diasAguinaldo` int(11) NOT NULL,
  `porcentajePrimaVacacional` double NOT NULL
  ,foreign key (IdEmpresa) references empresas (Id) on delete cascade  on UPDATE cascade
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;



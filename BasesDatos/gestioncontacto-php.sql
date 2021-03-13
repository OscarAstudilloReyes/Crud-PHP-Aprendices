-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-02-2021 a las 19:50:37
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gestioncontacto-php`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes`
--

CREATE TABLE `estudiantes` (
  `idEstudiante` int(11) NOT NULL COMMENT 'id del aprendiz (AI)',
  `esIndentificacion` varchar(15) COLLATE utf8_spanish_ci NOT NULL COMMENT 'identificacion del aprendiz',
  `esNombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL COMMENT 'nombre del aprendiz',
  `esApellido` varchar(50) COLLATE utf8_spanish_ci NOT NULL COMMENT 'apellido del aprendiz',
  `esCorreo` varchar(100) COLLATE utf8_spanish_ci NOT NULL COMMENT 'correo del aprendiz',
  `esGenero` enum('Masculino','Femenino') COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'genero del aprendi<',
  `esFecha` date NOT NULL COMMENT 'fecha de nacimiento del aprendiz'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Almacena los datos de los aprendices';

--
-- Volcado de datos para la tabla `estudiantes`
--

INSERT INTO `estudiantes` (`idEstudiante`, `esIndentificacion`, `esNombre`, `esApellido`, `esCorreo`, `esGenero`, `esFecha`) VALUES
(2, '6', 'DANIELAAAx', 'gonzalezes', 'da@gmail.com', 'Masculino', '2016-02-09'),
(36, '1531', 'andrws', 'dolores', 'andrws@gmail.com', 'Masculino', '2020-08-06'),
(43, '16', 'Oscar Astudillo reyes', 'nose', 'dasdaxxsd@gmial.com', 'Masculino', '2020-09-11'),
(50, '4121232', 'Pachecosss', 'martinez', 'pcxxxxxx@gmail.com', 'Masculino', '2020-09-18'),
(65, '64121', 'dasd', 'dasd', 'dsad', 'Femenino', '2020-11-04'),
(67, '4123', 'dsadas', 'dasdas', 'dasdas', 'Femenino', '2020-11-07'),
(68, '8775', 'Pepito', 'perez', 'pp@gmail.com', 'Masculino', '2020-11-03'),
(70, '6534', 'jjuan', 'reyes', 'dasdasx@dasdsa', 'Masculino', '2020-11-05'),
(71, '43213', 'dsadas', 'dasdas', 'dasdasd', 'Femenino', '2020-11-20');



-- Creacion de procedimineto almecenado que borra un estudiante
CREATE  PROCEDURE  borrarEstudiante
(
idBorrar INT
)
DELETE  FROM  estudiante WHERE  idEstuidante=idBorrar

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD PRIMARY KEY (`idEstudiante`),
  ADD UNIQUE KEY `uq_identificacion` (`esIndentificacion`),
  ADD UNIQUE KEY `uq_correo` (`esCorreo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  MODIFY `idEstudiante` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id del aprendiz (AI)', AUTO_INCREMENT=72;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

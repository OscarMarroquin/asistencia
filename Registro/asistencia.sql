-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 21-01-2015 a las 17:55:49
-- Versión del servidor: 5.6.16
-- Versión de PHP: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `asistencia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE IF NOT EXISTS `alumnos` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CARNET` varchar(50) NOT NULL,
  `NOMBRE` varchar(100) NOT NULL,
  `APATERNO` varchar(100) NOT NULL,
  `AMATERNO` varchar(100) NOT NULL,
  `SECCION` varchar(20) NOT NULL,
  `ID_SG` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`ID`, `CARNET`, `NOMBRE`, `APATERNO`, `AMATERNO`, `SECCION`, `ID_SG`) VALUES
(1, 'A1234', 'MANUEL', 'CORTES', 'CRISANTO', 'SEGUNDO', 1),
(2, 'A456', 'JUAN', 'PEREZ', 'PEREZ', '0', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno_semestre_grupo`
--

CREATE TABLE IF NOT EXISTS `alumno_semestre_grupo` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_GRUPO` int(11) NOT NULL,
  `ID_SEMESTRE` int(11) NOT NULL,
  `ID_ALUMNO` int(11) NOT NULL DEFAULT '0',
  `ESTATUS` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `alumno_semestre_grupo`
--

INSERT INTO `alumno_semestre_grupo` (`ID`, `ID_GRUPO`, `ID_SEMESTRE`, `ID_ALUMNO`, `ESTATUS`) VALUES
(1, 1, 1, 1, 0),
(2, 1, 1, 2, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE IF NOT EXISTS `asistencia` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_BIMESTRE` int(11) NOT NULL,
  `ID_GRUPO` int(11) NOT NULL,
  `ID_ALUMNO` int(11) NOT NULL,
  `ID_MATERIA` int(11) NOT NULL,
  `ID_DOCENTE` int(11) NOT NULL,
  `FECHA` varchar(10) NOT NULL,
  `HORA` varchar(10) NOT NULL,
  `DESCRIPCION` varchar(20) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `asistencia`
--

INSERT INTO `asistencia` (`ID`, `ID_BIMESTRE`, `ID_GRUPO`, `ID_ALUMNO`, `ID_MATERIA`, `ID_DOCENTE`, `FECHA`, `HORA`, `DESCRIPCION`) VALUES
(1, 1, 1, 1, 1, 1, '20140307', '14:21:11', 'Presente'),
(2, 1, 1, 2, 1, 1, '20140307', '14:21:11', 'Ausente con Permiso'),
(3, 1, 1, 1, 1, 1, '20140312', '11:43:10', 'Presente'),
(4, 1, 1, 2, 1, 1, '20140312', '11:43:10', 'Tarde'),
(5, 1, 1, 1, 2, 1, '20140312', '15:52:31', 'Presente'),
(6, 1, 1, 2, 2, 1, '20140312', '15:52:31', 'Tarde');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docente_bimestre`
--

CREATE TABLE IF NOT EXISTS `docente_bimestre` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_GRUPO` int(11) NOT NULL,
  `ID_BIMESTRE` int(11) NOT NULL,
  `ID_DOCENTE` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `docente_bimestre`
--

INSERT INTO `docente_bimestre` (`ID`, `ID_GRUPO`, `ID_BIMESTRE`, `ID_DOCENTE`) VALUES
(1, 1, 1, 1),
(2, 2, 1, 1),
(3, 1, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE IF NOT EXISTS `grupos` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `DESCRIPCION` text NOT NULL,
  `ESTATUS` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`ID`, `DESCRIPCION`, `ESTATUS`) VALUES
(1, 'A', 0),
(2, 'B', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

CREATE TABLE IF NOT EXISTS `materias` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CODIGO` varchar(30) NOT NULL,
  `DESCRIPCION` varchar(50) NOT NULL,
  `ID_SEMESTRE` int(11) NOT NULL,
  `GRUPO` varchar(250) NOT NULL,
  `ESTATUS` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`ID`, `CODIGO`, `DESCRIPCION`, `ID_SEMESTRE`, `GRUPO`, `ESTATUS`) VALUES
(1, 'ESPA1', 'ESPAÃ‘OL', 1, '1,2,3', 0),
(2, 'MAT2', 'MATEMATICAS', 1, '1', 0),
(4, 'INFO2', 'INFORMATICA', 2, '1', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `semestre`
--

CREATE TABLE IF NOT EXISTS `semestre` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `DESCRIPCION` text NOT NULL,
  `ESTATUS` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `semestre`
--

INSERT INTO `semestre` (`ID`, `DESCRIPCION`, `ESTATUS`) VALUES
(1, 'PRIMER BIMESTRE', 0),
(2, 'SEGUNDO BIMESTRE', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE` varchar(100) NOT NULL,
  `APATERNO` varchar(100) NOT NULL,
  `AMATERNO` varchar(100) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `PASSWORD` text NOT NULL,
  `TIPO_USUARIO` int(11) NOT NULL,
  `ESTATUS` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID`, `NOMBRE`, `APATERNO`, `AMATERNO`, `EMAIL`, `PASSWORD`, `TIPO_USUARIO`, `ESTATUS`) VALUES
(1, 'GUADALUPE', 'PEREZ', 'PEREZ', 'JUAN@HOTMAIL.COM', '123', 2, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

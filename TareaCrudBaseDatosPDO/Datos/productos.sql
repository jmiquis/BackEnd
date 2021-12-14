-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 14-01-2020 a las 09:29:51
-- Versión del servidor: 5.7.27-0ubuntu0.18.04.1
-- Versión de PHP: 7.2.19-0ubuntu0.18.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
/* -- Base de datos: PRODUCTOS */
--

-- --------------------------------------------------------

--
/* -- Estructura de tabla para la tabla `PRODUCTO` */
--

CREATE TABLE producto (
  producto_no int(4) NOT NULL,
  descripcion varchar(30) DEFAULT NULL,
  precio_actual FLOAT (8,2) DEFAULT NULL,
  stock_disponible int(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
/* -- Volcado de datos para la tabla `PRODUCTO` */
--

INSERT INTO `producto` (`producto_no`, `descripcion`, `precio_actual`, `stock_disponible`) VALUES
(10, 'MESA DESPACHO MOD. GAVIOTA', 550.00, 50),
(20, 'SILLA DIRECTOR MOD. BUFALO', 670.00, 25),
(30, 'ARMARIO NOGAL DOS PUERTAS', 460.00, 20),
(50, 'ARCHIVADOR CEREZO', 1050.00, 20),
(60, 'CAJA SEGURIDAD MOD B222', 280.00, 15),
(70, 'DESTRUCTORA DE PAPEL A3', 450.00, 25),
(80, 'MODULO ORDENADOR MOD. ERGOS', 550.00, 25);


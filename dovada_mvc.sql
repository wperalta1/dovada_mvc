-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 23, 2020 at 08:17 PM
-- Server version: 8.0.21
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dovada_mvc`
--

-- --------------------------------------------------------

--
-- Table structure for table `ordenanzas`
--

DROP TABLE IF EXISTS `ordenanzas`;
CREATE TABLE IF NOT EXISTS `ordenanzas` (
  `ordId` int NOT NULL AUTO_INCREMENT,
  `ordIdUsuario` int NOT NULL,
  `ordNro` int NOT NULL,
  `ordAño` int NOT NULL,
  `ordDescripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ordRuta` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ordNombrePdf` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ordId`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ordenanzas`
--

INSERT INTO `ordenanzas` (`ordId`, `ordIdUsuario`, `ordNro`, `ordAño`, `ordDescripcion`, `ordRuta`, `ordNombrePdf`) VALUES
(24, 15, 1, 2020, 'Ordenanza número 01/2020', '2020/Ord 01-2020 (FTy).pdf', 'Ord 01-2020 (FTy).pdf'),
(25, 15, 2, 2022, 'Ord 02/2022', '2022/Ord 2-2022 (nCt).pdf', 'Ord 2-2022 (nCt).pdf'),
(26, 15, 3, 2020, 'Ordenanza # 03/2020', '2020/Ord 03-2020 (mOv).pdf', 'Ord 03-2020 (mOv).pdf'),
(27, 15, 4, 2027, 'ord 04/2027!!\"!#', '2027/Ord 4-2027 (baG).pdf', 'Ord 4-2027 (baG).pdf'),
(29, 18, 41, 2035, 'Descripción de la ordenanza número 41/2035', '2035/Ord 41-2035 (eny).pdf', 'Ord 41-2035 (eny).pdf');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `usrId` int NOT NULL AUTO_INCREMENT,
  `usrNombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `usrEmail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `usrUsername` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `usrPassword` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `usrFechaCreacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`usrId`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`usrId`, `usrNombre`, `usrEmail`, `usrUsername`, `usrPassword`, `usrFechaCreacion`) VALUES
(15, 'Waldemar Peralta', 'waldeperalta1@gmail.com', 'admin', '$2y$10$RSNpz3ELEVEcGEYyNwYJfe.UUzg725Mfol9VhtsrlhZGdYVb64MtK', '2020-10-23 16:35:28'),
(16, 'Invitado', 'invitado@gmail.com', 'guest', '$2y$10$kYvPirvIGak/5PSV9VDEaexKf4onpP9H.OA3Hn38Giha3Gn.PQwFS', '2020-10-23 16:45:51'),
(18, 'usuariodeprueba', 'usuario@gmail.com', 'usuariodeprueba', '$2y$10$m37.8hXZTTCjfXsR/4GYP.XzfphOdk/n1O8mBlOoztc14OZakJP6K', '2020-10-23 17:07:50');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

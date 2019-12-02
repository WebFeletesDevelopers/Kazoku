-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: bbddsrv16.dondominio.com
-- Generation Time: Dec 01, 2019 at 11:41 PM
-- Server version: 10.4.10-MariaDB-1:10.4.10+maria~buster
-- PHP Version: 7.3.10-1+0~20191008.45+debian10~1.gbp365209

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ddb135595`
--

-- --------------------------------------------------------

--
-- Table structure for table `alumno`
--

CREATE TABLE `alumno` (
  `Nombre` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT 'Nombre',
  `Apellido1` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT 'Apellido',
  `Apellido2` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Sexo` tinyint(1) NOT NULL DEFAULT 1,
  `CodAlumno` int(11) NOT NULL,
  `CodUsu` int(11) DEFAULT NULL,
  `IdFanjyda` int(5) DEFAULT NULL,
  `DNI` varchar(9) CHARACTER SET utf8 DEFAULT NULL,
  `FechaNacimiento` date DEFAULT NULL,
  `Telefono` int(11) DEFAULT NULL,
  `Email` varchar(22) CHARACTER SET utf8 DEFAULT NULL,
  `Enfermedad` longtext CHARACTER SET utf8 DEFAULT NULL,
  `CodTut` int(11) DEFAULT NULL,
  `CodCinturon` int(11) DEFAULT 1,
  `CodDireccion` int(11) DEFAULT NULL,
  `CodClase` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `centro`
--

CREATE TABLE `centro` (
  `CodCentro` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Direccion` longtext DEFAULT NULL,
  `CodPostal` int(5) DEFAULT NULL,
  `Telefono` int(9) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cinturon`
--

CREATE TABLE `cinturon` (
  `CodCinturon` int(11) NOT NULL,
  `Cinturon` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `clase`
--

CREATE TABLE `clase` (
  `CodClase` int(11) NOT NULL,
  `Horario` varchar(15) NOT NULL,
  `Profesor` varchar(20) NOT NULL,
  `EdadMin` int(11) DEFAULT NULL,
  `EdadMax` int(11) DEFAULT NULL,
  `Nombre` varchar(200) DEFAULT NULL,
  `CodCentro` int(11) NOT NULL,
  `Dias` int(3) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `direccion`
--

CREATE TABLE `direccion` (
  `CodDireccion` int(11) NOT NULL,
  `CodigoPostal` int(11) NOT NULL,
  `Localidad` varchar(50) NOT NULL,
  `Provincia` varchar(50) NOT NULL,
  `Direccion` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `noticias`
--

CREATE TABLE `noticias` (
  `CodNot` int(111) NOT NULL,
  `Titulo` varchar(255) NOT NULL,
  `Cuerpo` longtext NOT NULL,
  `Fecha` date DEFAULT current_timestamp(),
  `Autor` varchar(255) NOT NULL,
  `Publica` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tutor`
--

CREATE TABLE `tutor` (
  `CodTut` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Apellido1` varchar(50) NOT NULL,
  `Apellido2` varchar(50) DEFAULT NULL,
  `Telefono` int(11) DEFAULT NULL,
  `DNI` varchar(9) DEFAULT NULL,
  `CodDireccion` int(11) NOT NULL,
  `Correo` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Confirmado` tinyint(1) DEFAULT 0,
  `Rango` int(1) NOT NULL DEFAULT 2,
  `CodUsu` int(11) NOT NULL,
  `username` varchar(80) NOT NULL,
  `name` varchar(80) NOT NULL,
  `Telefono` int(9) DEFAULT NULL,
  `Apellido1` varchar(50) DEFAULT NULL,
  `Apellido2` varchar(50) DEFAULT NULL,
  `password` varchar(60) NOT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `EmailConfirmado` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Verification`
--

CREATE TABLE `Verification` (
  `Code` varchar(255) NOT NULL,
  `CodKey` int(11) NOT NULL,
  `Uname` varchar(50) NOT NULL,
  `confirmado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`CodAlumno`),
  ADD UNIQUE KEY `DNI` (`DNI`),
  ADD KEY `CodTut` (`CodTut`),
  ADD KEY `CodCinturon` (`CodCinturon`),
  ADD KEY `CodDireccion` (`CodDireccion`),
  ADD KEY `CodClase` (`CodClase`);

--
-- Indexes for table `centro`
--
ALTER TABLE `centro`
  ADD PRIMARY KEY (`CodCentro`),
  ADD UNIQUE KEY `Nombre` (`Nombre`);

--
-- Indexes for table `cinturon`
--
ALTER TABLE `cinturon`
  ADD PRIMARY KEY (`CodCinturon`);

--
-- Indexes for table `clase`
--
ALTER TABLE `clase`
  ADD PRIMARY KEY (`CodClase`),
  ADD KEY `CodCentro` (`CodCentro`);

--
-- Indexes for table `direccion`
--
ALTER TABLE `direccion`
  ADD PRIMARY KEY (`CodDireccion`);

--
-- Indexes for table `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`CodNot`);

--
-- Indexes for table `tutor`
--
ALTER TABLE `tutor`
  ADD PRIMARY KEY (`CodTut`),
  ADD KEY `CodDireccion` (`CodDireccion`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`CodUsu`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `Telefono` (`Telefono`);

--
-- Indexes for table `Verification`
--
ALTER TABLE `Verification`
  ADD PRIMARY KEY (`CodKey`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alumno`
--
ALTER TABLE `alumno`
  MODIFY `CodAlumno` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `centro`
--
ALTER TABLE `centro`
  MODIFY `CodCentro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cinturon`
--
ALTER TABLE `cinturon`
  MODIFY `CodCinturon` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clase`
--
ALTER TABLE `clase`
  MODIFY `CodClase` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `direccion`
--
ALTER TABLE `direccion`
  MODIFY `CodDireccion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `noticias`
--
ALTER TABLE `noticias`
  MODIFY `CodNot` int(111) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tutor`
--
ALTER TABLE `tutor`
  MODIFY `CodTut` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `CodUsu` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Verification`
--
ALTER TABLE `Verification`
  MODIFY `CodKey` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

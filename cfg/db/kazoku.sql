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

USE kazoku;


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

CREATE TABLE `pupil` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `pupil_id` int(11) NOT NULL,
    `name` varchar(64) CHARACTER SET utf8 NOT NULL DEFAULT 'Nombre',
    `surname` varchar(64) CHARACTER SET utf8 NOT NULL DEFAULT 'Apellido',
    `second_surname` varchar(64) CHARACTER SET utf8 DEFAULT NULL,
    `gender` tinyint(1) NOT NULL DEFAULT 1,
    `fanjyda_id` int(11) DEFAULT NULL,
    `DNI` varchar(9) CHARACTER SET utf8 DEFAULT NULL,
    `birthDate` date DEFAULT NULL,
    `phone` int(11) DEFAULT NULL,
    `email` varchar(22) CHARACTER SET utf8 DEFAULT NULL,
    `extra_info` longtext CHARACTER SET utf8 DEFAULT NULL,
    `trainer_id` int(11) DEFAULT NULL,
    `belt_id` int(11) DEFAULT 1,
    `address_id` int(11) DEFAULT NULL,
    `class_id` int(11) DEFAULT NULL,
    PRIMARY KEY (pupil_id),
    UNIQUE (DNI),
    FOREIGN KEY (trainer_id) REFERENCES trainer(id),
    FOREIGN KEY (belt_id) REFERENCES belt(id),
    FOREIGN KEY (address_id) REFERENCES address(id),
    FOREIGN KEY (class_id) REFERENCES class(id)
) CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `centro`
--

CREATE TABLE `center` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(100) NOT NULL,
    `address_id` INT(11) DEFAULT NULL,
    `phone` int(9) DEFAULT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (address_id) REFERENCES address(id)
) CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cinturon`
--

CREATE TABLE `belt` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(64) NOT NULL,
    PRIMARY KEY (id)
) CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clase`
--

CREATE TABLE `class` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `schedule` varchar(15) NOT NULL,
    `trainer_id` varchar(20) NOT NULL,
    `minimum_age` int(11) DEFAULT NULL,
    `maximum_age` int(11) DEFAULT NULL,
    `name` varchar(200) DEFAULT NULL,
    `center_id` int(11) NOT NULL,
    `days` int(3) NOT NULL DEFAULT 0,
    PRIMARY KEY (id),
    FOREIGN KEY (center_id) REFERENCES center(id)
) CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `direccion`
--

CREATE TABLE `address` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `zip_code` int(11) NOT NULL,
    `locality` varchar(50) NOT NULL,
    `province` varchar(50) NOT NULL,
    `address` varchar(255) NOT NULL,
    PRIMARY KEY (id)
) CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `noticias`
--

CREATE TABLE `news` (
    `id` int(111) NOT NULL AUTO_INCREMENT,
    `title` varchar(255) NOT NULL,
    `body` longtext NOT NULL,
    `date` date DEFAULT current_timestamp(),
    `user_id` varchar(255) NOT NULL,
    `public` tinyint(1) NOT NULL DEFAULT 0,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES users(id)
) CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tutor`
--

CREATE TABLE `trainer` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(50) NOT NULL,
    `surname` varchar(50) NOT NULL,
    `second_surname` varchar(50) DEFAULT NULL,
    `phone` int(11) DEFAULT NULL,
    `DNI` varchar(9) DEFAULT NULL,
    `address_id` int(11) NOT NULL,
    `email` varchar(255) DEFAULT NULL
) CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `confirmed` tinyint(1) DEFAULT 0,
    `rank` int(1) NOT NULL DEFAULT 2,
    `username` varchar(80) NOT NULL,
    `name` varchar(80) NOT NULL,
    `phone` int(9) DEFAULT NULL,
    `surname` varchar(50) DEFAULT NULL,
    `second_surname` varchar(50) DEFAULT NULL,
    `password` varchar(60) NOT NULL,
    `email` varchar(255) DEFAULT NULL,
    `email_confirmed` tinyint(1) DEFAULT 0,
    PRIMARY KEY (id)
) CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Verification`
--

CREATE TABLE `verification` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `code` VARCHAR(64) NOT NULL,
    `user_id` INT(11) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES users(id)
) CHARSET=utf8 COLLATE=utf8_general_ci;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

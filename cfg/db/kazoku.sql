SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

USE kazoku;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE TABLE absence (
    id int NOT NULL AUTO_INCREMENT,
    userId int null,
    classId int null,
    date date null,
    PRIMARY KEY (`id`)
);

CREATE TABLE `address` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `zip_code` int(11) NOT NULL,
    `locality` varchar(50) NOT NULL,
    `province` varchar(50) NOT NULL,
    `address` varchar(255) NOT NULL,
    PRIMARY KEY (`id`)
) CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `belt` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(64) NOT NULL,
    PRIMARY KEY (`id`)
) CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `center` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(100) NOT NULL,
    `address` LONGTEXT DEFAULT NULL,
    `zip_code` INT(5) DEFAULT NULL,
    `phone` int(9) DEFAULT NULL,
    PRIMARY KEY (`id`)
) CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `class` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `schedule` varchar(15) NOT NULL,
    `trainer` varchar(20) NOT NULL,
    `minimum_age` int(11) DEFAULT NULL,
    `maximum_age` int(11) DEFAULT NULL,
    `name` varchar(200) DEFAULT NULL,
    `center_id` int(11) NOT NULL,
    `days` int(3) NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`)
) CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `login_hash` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `hash` CHAR(64) NOT NULL,
    `user_id` INT(11),
    PRIMARY KEY (`id`)
) CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `news` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `title` varchar(255) NOT NULL,
    `body` longtext NOT NULL,
    `date` date DEFAULT current_timestamp(),
    `user_id` int(11) NOT NULL,
    `public` tinyint(1) NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`)
) CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `pupil` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `user_id` int(11) DEFAULT NULL,
    `name` varchar(64) CHARACTER SET utf8 NOT NULL DEFAULT 'Nombre',
    `surname` varchar(64) CHARACTER SET utf8 NOT NULL DEFAULT 'Apellido',
    `second_surname` varchar(64) CHARACTER SET utf8 DEFAULT NULL,
    `gender` tinyint(1) NOT NULL DEFAULT 1,
    `fanjyda_id` int(11) DEFAULT NULL,
    `DNI` varchar(9) CHARACTER SET utf8 DEFAULT NULL,
    `birth_date` date DEFAULT NULL,
    `phone` int(11) DEFAULT NULL,
    `email` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
    `extra_info` longtext CHARACTER SET utf8 DEFAULT NULL,
    `guardian_id` int(11) DEFAULT NULL,
    `belt_id` int(11) DEFAULT 1,
    `address_id` int(11) DEFAULT 9999,
    `class_id` int(11) DEFAULT 9999,
    PRIMARY KEY (`id`),
    UNIQUE (`DNI`)
) CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `users` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `confirmed` tinyint(1) DEFAULT 0,
    `rank` int(1) NOT NULL DEFAULT 2,
    `username` varchar(80) NOT NULL,
    `name` varchar(80) NOT NULL,
    `phone` int(9) DEFAULT NULL,
    `surname` varchar(50) DEFAULT NULL,
    `second_surname` varchar(50) DEFAULT NULL,
    `password` varchar(64) NOT NULL,
    `email` varchar(255) DEFAULT NULL,
    `email_confirmed` tinyint(1) DEFAULT 0,
    PRIMARY KEY (`id`),
    UNIQUE (`username`),
    UNIQUE (`email`)
) CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `verification` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `code` VARCHAR(64) NOT NULL,
    `user_id` INT(11) NOT NULL,
    PRIMARY KEY (`id`)
) CHARSET=utf8 COLLATE=utf8_general_ci;


ALTER TABLE absence
    ADD FOREIGN key (`classId`) REFERENCES class (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
    ADD FOREIGN KEY (`userId`) REFERENCES pupil (`id`) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE address
    ADD FULLTEXT(`address`);

ALTER TABLE class
    ADD FOREIGN KEY (`center_id`) REFERENCES center(`id`) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE login_hash
    ADD FOREIGN KEY (`user_id`) REFERENCES users(`id`) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE news
    ADD FOREIGN KEY (`user_id`) REFERENCES users(`id`) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE pupil
    ADD UNIQUE (`DNI`),
    ADD FOREIGN KEY (`user_id`) REFERENCES users(`id`) ON UPDATE CASCADE ON DELETE CASCADE,
    ADD FOREIGN KEY (`guardian_id`) REFERENCES users(`id`) ON UPDATE CASCADE ON DELETE CASCADE,
    ADD FOREIGN KEY (`belt_id`) REFERENCES belt(`id`) ON UPDATE CASCADE ON DELETE CASCADE,
    ADD FOREIGN KEY (`address_id`) REFERENCES address(`id`) ON UPDATE CASCADE ON DELETE SET NULL,
    ADD FOREIGN KEY (`class_id`) REFERENCES class(`id`) ON UPDATE CASCADE ON DELETE SET NULL;

ALTER TABLE verification
    ADD FOREIGN KEY (`user_id`) REFERENCES users(`id`) ON UPDATE CASCADE ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

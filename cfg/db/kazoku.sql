SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

USE kazoku;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

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
    `address_id` int(11) DEFAULT NULL,
    `class_id` int(11) DEFAULT NULL,
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


INSERT INTO `center` (`id`, `name`, `address`, `zip_code`, `phone`) VALUES
(2, 'CEIP Félix Revello de Toro\r\n', 'Calle Navarro Ledesma, 168', 29010, 951298573),
(1, 'Fuengirola', 'Calle Boquetillo, S/N', 29640, 672716467);

INSERT INTO `belt` (`id`, `name`) VALUES
(1, 'Blanco'),
(2, 'Blanco-Amarillo'),
(3, 'Amarillo'),
(4, 'Amarillo'),
(5, 'Amarillo-Naranja'),
(6, 'Naranja'),
(7, 'Naranja-Verde'),
(8, 'Verde'),
(9, 'Verde-Azul'),
(10, 'Azul'),
(11, 'Azul-Marrón'),
(12, 'Marrón'),
(13, '1º DAN'),
(14, '2º DAN'),
(15, '3º DAN'),
(16, '4º DAN'),
(17, '5º DAN'),
(18, 'BLANCO-ROJO');

INSERT INTO `class` (`id`, `schedule`, `trainer`, `minimum_age`, `maximum_age`, `name`, `center_id`, `days`) VALUES
(1, '16:30-17:30', 'José David', 4, 8, 'Mini-Benjamines y Pre-Benjamines', 1, 10),
(2, '17:30-18:30', 'Jose David', 9, 12, 'Benjamines y Alevines', 1, 10),
(3, '18:30-19:30', 'Jose David', 13, 14, 'Infantiles', 1, 10),
(4, '19:30-21:00', 'Jose David', 15, 19, 'Cadetes y Junior', 1, 10),
(5, '20:30-22:30', 'Jose David', 20, NULL, 'Absoluto y Senior', 1, 21),
(6, '16:00-17:00', 'Jose David', NULL, NULL, NULL, 2, 5),
(7, '17:00-18:00', 'Jose David', NULL, NULL, NULL, 2, 5),
(8, '8:00-16:00', 'Alberto', NULL, NULL, NULL, 2, 21),
(9, '18:00-19:30', 'Jose David', NULL, NULL, NULL, 2, 5);

INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Bruce','Quinn','Parks','0','2019-08-14',6,6);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Davis','Rios','Hurst','1','2019-10-23',11,1);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Julian','Mann','Harrington','1','2019-07-26',4,5);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Adele','Patterson','Kim','1','2020-09-27',1,8);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Janna','Walters','Hatfield','0','2019-04-23',4,1);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Vaughan','Holloway','Guerrero','0','2020-03-25',10,4);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Venus','Edwards','Romero','0','2019-12-19',3,6);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Freya','Salinas','Hendricks','1','2020-08-07',5,3);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Thane','Castro','Robertson','0','2020-03-13',4,8);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Wynter','Mercado','Horne','1','2021-03-22',4,7);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Melyssa','Kent','Gilbert','1','2019-11-27',8,8);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Rowan','Montgomery','Baldwin','0','2019-12-08',12,8);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Dai','Cortez','Lloyd','0','2019-07-19',7,1);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Blaze','Irwin','Fulton','1','2020-11-16',9,8);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Fulton','Daniels','Hardy','1','2019-12-28',2,5);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Jason','Thompson','Odom','0','2021-01-08',6,7);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Lamar','Butler','Woods','0','2019-11-08',8,7);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Brenna','Patrick','Hoffman','1','2020-09-27',8,6);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Isadora','Oliver','Fulton','1','2019-08-05',5,1);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Britanney','Dyer','Walton','0','2019-11-07',12,3);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Fritz','Hanson','Palmer','1','2019-10-23',6,7);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Kai','Fulton','Hatfield','1','2019-07-10',9,7);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Zenaida','Hale','Taylor','0','2019-10-22',11,5);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Hall','Young','Gonzales','0','2019-04-21',2,6);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Alice','Hall','Hogan','0','2019-11-11',4,3);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Lawrence','Mitchell','Melendez','0','2020-04-20',3,1);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Xavier','Cole','Lester','1','2020-02-15',11,8);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Jeremy','Good','Donaldson','0','2019-03-29',11,5);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Quintessa','Steele','Calhoun','1','2020-12-29',7,4);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Dolan','Glover','Mann','0','2020-12-13',5,3);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Lila','Johns','Brennan','0','2020-03-30',4,3);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Merritt','Adams','Carver','1','2019-04-19',1,4);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Ryan','Mccall','Boyle','0','2020-09-24',12,4);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Juliet','Herrera','Perry','0','2019-08-28',12,7);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Ezekiel','Fleming','Drake','1','2019-06-14',12,6);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Thaddeus','Mccullough','Tran','0','2021-02-19',5,6);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Minerva','Hicks','Cline','1','2020-08-14',7,4);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Miriam','Kane','Kerr','0','2019-09-16',8,1);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Oliver','Hansen','Mccormick','0','2019-07-12',9,8);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Keefe','Shannon','Burch','1','2020-02-29',10,7);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Evan','Burt','Clay','1','2020-05-30',1,3);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Margaret','Meadows','Gray','0','2019-11-23',5,5);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Alexis','Terry','Kirkland','1','2019-03-28',8,6);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Christen','Howell','Hurst','1','2019-11-29',5,4);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Vladimir','Cooper','Lloyd','1','2020-12-12',4,8);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Ramona','Roach','Ochoa','0','2019-04-09',11,1);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Abraham','Mercado','Ingram','1','2020-02-07',1,5);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Odessa','Chapman','Bush','1','2019-10-01',7,8);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Raya','Lancaster','Tanner','0','2019-05-04',6,3);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Kirsten','Morrow','Kirby','1','2020-03-30',1,2);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Melissa','Stephenson','Gilliam','1','2020-07-04',10,8);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Brynne','Michael','Fulton','0','2020-03-24',3,5);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Samuel','Valenzuela','Mcgee','1','2021-03-14',7,3);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Libby','Schwartz','Munoz','1','2020-07-26',8,2);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Cora','Byers','Gonzales','1','2020-03-14',12,3);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Shannon','Moody','Jones','1','2019-09-20',11,3);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Dane','Barber','Duffy','0','2020-08-05',2,7);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Rebekah','Solis','Juarez','0','2020-02-21',12,7);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Brennan','Dejesus','Santos','1','2020-12-23',3,8);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Drew','Witt','Francis','1','2020-03-04',2,6);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Jana','Griffith','Townsend','0','2021-01-18',3,2);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Ann','Nixon','Nolan','1','2019-07-12',3,8);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Rogan','Browning','Pratt','1','2020-09-04',12,4);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Beck','Dunlap','Ware','0','2020-07-21',12,5);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Ignatius','Mckee','Wall','0','2020-02-14',9,8);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Barrett','Conrad','Miranda','0','2019-03-29',2,5);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Raven','Bradley','Flynn','1','2019-09-11',6,7);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Quyn','Dudley','Chase','0','2019-09-17',5,1);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Ronan','Adams','Sawyer','0','2019-09-10',8,3);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Claire','Meyer','Cross','1','2021-02-24',1,7);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Keiko','Estes','Mendez','1','2019-10-30',9,4);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Russell','Reid','Melendez','1','2019-04-24',1,7);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Finn','Hopper','Ross','1','2019-12-01',9,4);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Sonia','Schroeder','Spears','1','2020-08-28',11,8);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Richard','Cunningham','Robertson','0','2019-05-23',6,2);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Maryam','Parsons','Green','0','2020-11-09',12,2);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Abdul','Vazquez','Allison','1','2019-12-29',11,7);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Lydia','Salazar','Russo','0','2020-02-24',8,8);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Buffy','Rasmussen','Padilla','1','2019-11-13',9,4);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Wendy','Booth','Bird','1','2019-07-27',10,4);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Zephr','Barrett','Bennett','1','2019-10-11',9,3);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Ralph','Bush','Hahn','0','2020-12-01',8,8);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Vaughan','Hammond','Vance','0','2020-10-28',6,6);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Forrest','Lawrence','Maddox','1','2019-10-31',9,6);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Jorden','Snow','Cohen','0','2020-07-27',5,1);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Murphy','Hicks','Joyce','1','2021-02-20',1,5);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Merritt','Mccoy','Nichols','0','2019-08-15',4,6);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Velma','Munoz','Carrillo','0','2019-10-07',10,3);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Marah','Velez','Acevedo','0','2021-03-07',8,5);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Gregory','Brown','Knox','0','2019-04-22',6,8);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Simone','Foster','Maynard','1','2020-07-12',3,7);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Kasimir','Calderon','Elliott','0','2019-04-15',6,3);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Kareem','Sexton','Frost','0','2020-07-21',9,8);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Melvin','Orr','Hawkins','1','2020-07-09',5,4);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Claire','Moreno','Gamble','0','2020-01-24',12,5);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Wallace','Hammond','Bonner','1','2019-12-14',7,4);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Keegan','Vance','Stevenson','1','2020-09-22',9,2);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Laurel','Mcgee','Boyer','1','2020-07-17',2,3);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Lana','Gill','Mcdowell','0','2020-11-04',6,3);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Cadman','Cannon','Wyatt','1','2020-02-13',2,1);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Ashely','Rivas','Peterson','1','2021-03-13',9,7);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Evelyn','Savage','Crosby','1','2019-12-02',6,5);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Miriam','Newton','Jacobson','1','2020-06-06',9,5);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Noelle','Murphy','Dunn','1','2019-08-28',8,3);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Rinah','Pickett','Lancaster','0','2019-06-28',7,3);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Aladdin','Larson','Randall','0','2019-04-20',11,6);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Murphy','Tucker','Quinn','1','2021-03-23',4,7);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Zenia','Shepherd','Marks','0','2020-06-13',12,6);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Simon','Owen','Stevens','0','2021-03-04',11,8);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Gareth','Schultz','Craft','1','2020-05-14',1,8);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Amal','Osborn','Zamora','1','2019-03-31',10,8);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Sharon','Romero','Ford','0','2021-03-14',3,3);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Vladimir','Turner','Cherry','1','2019-08-07',8,6);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Denton','Barber','Mcdowell','0','2020-05-17',1,5);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Adam','Stephenson','Jimenez','1','2019-10-04',5,7);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Rashad','Casey','Jordan','1','2020-03-08',3,4);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Eve','Terrell','Gallegos','0','2021-03-03',3,7);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Sopoline','Hess','Reid','0','2019-06-11',10,4);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Irene','Forbes','Hull','0','2020-11-24',10,3);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Sacha','Torres','Mckay','0','2021-01-08',1,1);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Thaddeus','Glover','Sutton','0','2020-06-08',12,3);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Bradley','Gates','Pickett','0','2020-12-22',7,5);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Kibo','Juarez','Rogers','1','2019-10-16',4,8);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Uta','Steele','Rogers','1','2019-07-17',5,6);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Chaim','Baldwin','Wolfe','1','2020-07-13',10,3);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Brenda','Bass','Erickson','1','2020-11-06',11,4);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Asher','Mccray','Nichols','1','2020-02-26',7,7);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Callum','Dean','Simmons','1','2019-10-17',9,6);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Duncan','Carney','Franklin','0','2020-05-30',6,6);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Cyrus','Cook','Bender','0','2021-02-11',8,2);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Rhona','Flores','Farrell','0','2019-03-30',7,2);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Jack','May','Rhodes','1','2020-11-07',3,4);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Chloe','Mcguire','Buckley','0','2019-12-01',9,4);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Fletcher','Riggs','Rivers','0','2020-02-17',1,4);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Lars','Cobb','Levy','1','2019-10-02',1,8);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Emmanuel','Berger','Whitfield','1','2019-04-09',11,8);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Sierra','Barlow','Knowles','0','2020-11-17',12,7);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Keane','Gardner','Farley','0','2019-11-25',10,5);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Dale','Avery','Small','1','2019-07-18',1,4);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Madison','Joyce','Wood','1','2019-07-10',11,5);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Renee','Chavez','Ashley','0','2019-10-05',9,6);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Ginger','Frank','Hebert','0','2020-08-20',1,2);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Ryan','Meyers','Baldwin','0','2020-04-27',6,4);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Connor','Haley','Rosales','0','2021-02-05',1,8);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Lars','Ortega','Turner','0','2020-03-15',5,8);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Beatrice','Noble','Wiley','1','2021-02-12',7,1);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Dane','Pacheco','Whitaker','0','2019-08-16',4,3);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Barbara','Haley','Obrien','0','2020-11-23',6,1);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Ryder','Noble','Burnett','1','2020-02-19',7,4);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Jennifer','Bishop','Vasquez','0','2020-12-16',12,4);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Abel','Boyd','Solomon','1','2020-08-11',7,7);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Dorothy','Bailey','Frazier','0','2020-09-06',6,2);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Brent','Reyes','Johnston','0','2020-11-02',1,5);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Faith','Talley','Burch','0','2021-01-04',6,2);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Carter','Rasmussen','Holman','0','2019-05-02',3,4);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Odette','Lancaster','Garcia','0','2020-01-07',6,7);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Naida','Williamson','Nielsen','1','2020-01-09',11,6);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Brenden','Foreman','Mays','1','2019-08-30',4,5);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Diana','Oneal','Hatfield','1','2019-05-15',5,2);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Kenneth','Middleton','Sheppard','1','2020-01-12',6,2);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Guy','Molina','Mitchell','1','2020-11-27',9,2);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Jermaine','Olsen','Solis','0','2019-11-11',2,6);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Galvin','Carey','Hickman','1','2020-01-10',10,5);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Kasimir','Valenzuela','Talley','1','2020-09-20',2,4);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Kai','Hodge','House','1','2019-08-06',4,1);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Lucas','Bush','Fitzpatrick','0','2020-02-19',12,8);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Alfonso','Fernandez','Aguilar','0','2021-03-09',1,2);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Wyatt','Palmer','Francis','0','2021-02-19',7,1);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Illiana','Rivas','Ramos','1','2019-11-21',9,2);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Eugenia','Hines','Patel','0','2019-06-03',1,7);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Gregory','Erickson','Sweeney','1','2020-12-22',6,1);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Jena','Stanley','Beard','0','2019-11-15',7,2);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Hyatt','Haley','Preston','0','2020-01-18',8,7);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Yeo','Mitchell','Oneil','1','2020-02-05',8,1);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Philip','Wilcox','May','1','2019-12-19',3,2);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Macon','Copeland','Rivas','0','2020-12-16',4,3);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Genevieve','Welch','Adams','0','2019-11-26',4,1);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Boris','Randall','Dickson','0','2019-08-11',5,4);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Moses','William','Bowman','1','2019-10-02',2,8);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Aladdin','Trujillo','Ray','0','2019-11-09',2,1);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Kylan','Dudley','Conrad','0','2019-07-30',5,2);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Yen','Stewart','Daniel','0','2020-01-29',11,4);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Tiger','Weber','Mccarthy','0','2019-07-23',9,4);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Iona','Francis','Boyle','1','2020-02-28',12,5);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Buckminster','Lancaster','Dickerson','1','2019-12-22',1,6);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Tucker','Joyner','Collins','1','2020-02-03',8,7);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Kyra','Dominguez','Wolf','0','2020-04-07',11,8);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Shay','Blanchard','Weaver','1','2021-01-11',10,5);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Chancellor','Petty','Benton','0','2020-04-30',1,4);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Suki','Wagner','Wilcox','1','2020-03-28',8,8);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Charles','Cohen','Franco','0','2019-06-20',4,5);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Rose','Palmer','Mccullough','1','2020-08-02',2,4);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Tatiana','Kelley','Ferrell','0','2021-01-24',6,3);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Maris','Scott','Jimenez','0','2020-01-26',1,4);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Paul','Hahn','Hernandez','1','2019-06-03',2,6);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Cheryl','Fitzgerald','Mcclain','1','2019-05-05',1,6);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Ashely','Malone','Dalton','0','2019-11-20',11,7);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Amir','Hunter','Roach','0','2019-05-05',8,5);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Kitra','Salazar','Walters','1','2020-06-18',12,1);
INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES ('Oscar','Britt','Shannon','0','2020-05-17',9,8);


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

USE kazoku;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

INSERT INTO `address` (id, zip_code, locality, province, address) VALUES
(1, 29011, 'Málaga', 'Málaga', 'Plaza de los Verdiales'),
(2, 29006, 'Málaga', 'Málaga', 'Plaza de Manuel Azaña'),
(3, 29008, 'Málaga', 'Málaga', 'Calle Carretería'),
(4, 29015, 'Málaga', 'Málaga', 'Calle Granada'),
(9999, 00000, 'No especificado', 'No especificado', 'No especificado');

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

INSERT INTO `center` (`id`, `name`, `address`, `zip_code`, `phone`) VALUES
(2, 'CEIP Félix Revello de Toro\r\n', 'Calle Navarro Ledesma, 168', 29010, 951298573),
(1, 'Fuengirola', 'Calle Boquetillo, S/N', 29640, 672716467);

INSERT INTO `class` (`id`, `schedule`, `trainer`, `minimum_age`, `maximum_age`, `name`, `center_id`, `days`) VALUES
(1, '16:30-17:30', 'José David', 4, 8, 'Mini-Benjamines y Pre-Benjamines', 1, 10),
(2, '17:30-18:30', 'Jose David', 9, 12, 'Benjamines y Alevines', 1, 10),
(3, '18:30-19:30', 'Jose David', 13, 14, 'Infantiles', 1, 10),
(4, '19:30-21:00', 'Jose David', 15, 19, 'Cadetes y Junior', 1, 10),
(5, '20:30-22:30', 'Jose David', 20, NULL, 'Absoluto y Senior', 1, 21),
(9999, '00:00-00:00', 'Nadie', 1, NULL, 'Sin clase asignada', 1, 0);

INSERT INTO `pupil` (`name`,`surname`,`second_surname`,`gender`,`birth_date`,`belt_id`,`class_id`) VALUES
('Davis','Rios','Hurst','1','2019-10-23',11,1),
('Julian','Mann','Harrington','1','2019-07-26',4,5),
('Janna','Walters','Hatfield','0','2019-04-23',4,1),
('Vaughan','Holloway','Guerrero','0','2020-03-25',10,4),
('Freya','Salinas','Hendricks','1','2020-08-07',5,3),
('Dai','Cortez','Lloyd','0','2019-07-19',7,1),
('Fulton','Daniels','Hardy','1','2019-12-28',2,5),
('Isadora','Oliver','Fulton','1','2019-08-05',5,1),
('Britanney','Dyer','Walton','0','2019-11-07',12,3),
('Zenaida','Hale','Taylor','0','2019-10-22',11,5);

INSERT INTO kazoku.users (id, confirmed, `rank`, username, name, phone, surname, second_surname, password, email, email_confirmed) VALUES
(1, 0, 0, 'misko', 'misko', 123456789, 'jons', 'garcia', 'a03ab19b866fc585b5cb1812a2f63ca861e7e7643ee5d43fd7106b623725fd67', 'albertogomp@gmail.com', 1),
(2, 1, 2, 'Thana', 'Alberto', 609914731, 'Gómez', '', 'a03ab19b866fc585b5cb1812a2f63ca861e7e7643ee5d43fd7106b623725fd67', 'personal@albertogomp.es', 1),
(4, 0, 3, 'Bruce', 'Quinn', null, 'Fritz', 'garcia', 'a03ab19b866fc585b5cb1812a2f63ca861e7e7643ee5d43fd7106b623725fd67', 'bstrosin@example.net', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

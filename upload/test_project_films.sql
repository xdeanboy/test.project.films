-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 20 2022 г., 00:33
-- Версия сервера: 5.7.29
-- Версия PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `test_project_films`
--

-- --------------------------------------------------------

--
-- Структура таблицы `films`
--

CREATE TABLE `films` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `release` int(5) NOT NULL,
  `format` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `films`
--

INSERT INTO `films` (`id`, `title`, `release`, `format`) VALUES
(29, 'Blazing Saddles', 1974, 'VHS'),
(40, 'Casablanca', 1942, 'DVD'),
(41, 'Charade', 1953, 'DVD'),
(42, 'Cool Hand Luke', 1967, 'VHS'),
(43, 'Butch Cassidy and the Sundance Kid', 1969, 'VHS'),
(44, 'The Sting', 1973, 'DVD'),
(45, 'The Muppet Movie', 1979, 'DVD'),
(46, 'Get Shorty', 1995, 'DVD'),
(47, 'My Cousin Vinny', 1992, 'DVD'),
(48, 'Gladiator', 2000, 'Blu-Ray'),
(49, 'Star Wars', 1977, 'Blu-Ray'),
(50, 'Raiders of the Lost Ark', 1981, 'DVD'),
(51, 'Serenity', 2005, 'Blu-Ray'),
(52, 'Hooisers', 1986, 'VHS'),
(53, 'WarGames', 1983, 'VHS'),
(54, 'Spaceballs', 1987, 'DVD'),
(55, 'Real Genius', 1985, 'VHS'),
(56, 'Top Gun', 1986, 'DVD'),
(57, 'MASH', 1970, 'DVD'),
(58, 'The Russians Are Coming, The Russians Are Coming', 1966, 'VHS'),
(59, 'Jaws', 1975, 'DVD'),
(60, '2001: A Space Odyssey', 1968, 'DVD'),
(61, 'Harvey', 1950, 'DVD'),
(62, 'Knocked Up', 2007, 'Blu-Ray'),
(63, 'Young Frankenstein', 1974, 'VHS');

-- --------------------------------------------------------

--
-- Структура таблицы `films_and_stars`
--

CREATE TABLE `films_and_stars` (
  `id` int(11) NOT NULL,
  `film_id` int(11) NOT NULL,
  `star_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `films_and_stars`
--

INSERT INTO `films_and_stars` (`id`, `film_id`, `star_id`) VALUES
(7, 29, 1),
(8, 29, 2),
(9, 29, 3),
(10, 29, 4),
(11, 29, 5),
(12, 29, 6),
(63, 40, 11),
(64, 40, 12),
(65, 40, 13),
(66, 40, 14),
(67, 41, 15),
(68, 41, 16),
(69, 41, 17),
(70, 41, 18),
(71, 41, 19),
(72, 42, 20),
(73, 42, 19),
(74, 42, 21),
(75, 43, 20),
(76, 43, 22),
(77, 43, 23),
(78, 44, 22),
(79, 44, 20),
(80, 44, 24),
(81, 44, 25),
(82, 45, 26),
(83, 45, 27),
(84, 45, 28),
(85, 45, 1),
(86, 45, 18),
(87, 45, 25),
(88, 45, 29),
(89, 46, 30),
(90, 46, 31),
(91, 46, 32),
(92, 46, 9),
(93, 46, 33),
(94, 47, 34),
(95, 47, 35),
(96, 47, 36),
(97, 47, 29),
(98, 47, 37),
(99, 47, 38),
(100, 48, 39),
(101, 48, 40),
(102, 48, 41),
(103, 49, 42),
(104, 49, 43),
(105, 49, 44),
(106, 49, 45),
(107, 49, 46),
(108, 50, 42),
(109, 50, 47),
(110, 51, 48),
(111, 51, 49),
(112, 51, 50),
(113, 51, 51),
(114, 51, 52),
(115, 51, 53),
(116, 51, 54),
(117, 51, 55),
(118, 51, 56),
(119, 51, 57),
(120, 52, 9),
(121, 52, 58),
(122, 52, 59),
(123, 53, 60),
(124, 53, 61),
(125, 53, 62),
(126, 53, 63),
(127, 53, 64),
(128, 54, 65),
(129, 54, 66),
(130, 54, 1),
(131, 54, 67),
(132, 54, 68),
(133, 54, 69),
(134, 55, 70),
(135, 55, 71),
(136, 55, 72),
(137, 55, 73),
(138, 56, 74),
(139, 56, 75),
(140, 56, 70),
(141, 56, 76),
(142, 56, 77),
(143, 57, 78),
(144, 57, 79),
(145, 57, 77),
(146, 57, 80),
(147, 57, 81),
(148, 58, 82),
(149, 58, 83),
(150, 58, 84),
(151, 58, 85),
(152, 59, 86),
(153, 59, 24),
(154, 59, 87),
(155, 59, 88),
(156, 60, 89),
(157, 60, 90),
(158, 60, 91),
(159, 60, 92),
(160, 61, 93),
(161, 61, 94),
(162, 61, 95),
(163, 61, 96),
(164, 62, 97),
(165, 62, 98),
(166, 62, 99),
(167, 62, 100),
(168, 63, 4),
(169, 63, 7),
(170, 63, 8),
(171, 63, 9),
(172, 63, 10);

-- --------------------------------------------------------

--
-- Структура таблицы `films_image`
--

CREATE TABLE `films_image` (
  `id` int(11) NOT NULL,
  `link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `films_image`
--

INSERT INTO `films_image` (`id`, `link`) VALUES
(29, 'https://flxt.tmsimg.com/assets/p1036_p_v12_an.jpg'),
(40, 'https://m.media-amazon.com/images/I/61Bc+jcl4LL._AC_SY679_.jpg'),
(41, 'https://m.media-amazon.com/images/I/51FghBoVLFL._AC_.jpg'),
(42, 'https://m.media-amazon.com/images/I/71aPuUJGu0L._AC_SY741_.jpg'),
(43, 'https://m.media-amazon.com/images/I/51BiUOTb4jL._AC_SX466_.jpg'),
(44, 'https://m.media-amazon.com/images/I/513H8cTQpEL._AC_.jpg'),
(45, 'https://lumiere-a.akamaihd.net/v1/images/p_themuppetmovie1979_18422_0f5218b6.jpeg?region=0%2C0%2C540%2C810'),
(46, 'https://movieposters2.com/images/698627-b.jpg'),
(47, 'https://m.media-amazon.com/images/I/510SUhZvL2L.jpg'),
(48, 'https://movieposters2.com/images/1729988-b.jpg'),
(49, 'https://images.prom.ua/2284598614_w640_h640_poster-plakat-zvezdnye.jpg'),
(50, 'https://image.posterlounge.com/img/products/480000/477811/477811_poster_l.jpg'),
(51, 'https://m.media-amazon.com/images/I/61L23t8noEL._AC_SY679_.jpg'),
(52, 'https://m.media-amazon.com/images/I/51uutL+JsXL._AC_.jpg'),
(53, 'https://picfiles.alphacoders.com/141/141212.jpg'),
(54, 'https://m.media-amazon.com/images/I/51iob2Jw2qL._AC_SY580_.jpg'),
(55, 'https://m.media-amazon.com/images/I/71jAedW0KtL._AC_SY679_.jpg'),
(56, 'https://m.media-amazon.com/images/I/616OBt164PL._AC_SY741_.jpg'),
(57, 'https://m.media-amazon.com/images/I/51HTGmgH+YL._AC_.jpg'),
(58, 'https://m.media-amazon.com/images/I/51J0ZZZJYVL.jpg'),
(59, 'https://m.media-amazon.com/images/I/51aUE4WyciL._AC_SY679_.jpg'),
(60, 'https://m.media-amazon.com/images/I/41yU9cqLS8L._AC_.jpg'),
(61, 'https://m.media-amazon.com/images/I/51UBZAch74L._AC_.jpg'),
(62, 'https://www.themoviedb.org/t/p/original/caCpMc3NOvyPpNY2PFHFgqsQC63.jpg'),
(63, 'https://m.media-amazon.com/images/I/51LnXYQ66YL._AC_.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `stars`
--

CREATE TABLE `stars` (
  `id` int(11) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `stars`
--

INSERT INTO `stars` (`id`, `surname`, `name`) VALUES
(1, 'Brooks', 'Mel'),
(2, 'Little', 'Clevon'),
(3, 'Korman', 'Harvey'),
(4, 'Wilder', 'Gene'),
(5, 'Pickens', 'Slim'),
(6, 'Kahn', 'Madeline'),
(7, 'Mars', 'Kenneth'),
(8, 'Garr', 'Terri'),
(9, 'Hackman', 'Gene'),
(10, 'Boyle', 'Peter'),
(11, 'Bogart', 'Humphrey'),
(12, 'Bergman', 'Ingrid'),
(13, 'Rains', 'Claude'),
(14, 'Lorre', 'Peter'),
(15, 'Hepburn', 'Audrey'),
(16, 'Grant', 'Cary'),
(17, 'Matthau', 'Walter'),
(18, 'Coburn', 'James'),
(19, 'Kennedy', 'George'),
(20, 'Newman', 'Paul'),
(21, 'Martin', 'Strother'),
(22, 'Redford', 'Robert'),
(23, 'Ross', 'Katherine'),
(24, 'Shaw', 'Robert'),
(25, 'Durning', 'Charles'),
(26, 'Henson', 'Jim'),
(27, 'Oz', 'Frank'),
(28, 'Geolz', 'Dave'),
(29, 'Pendleton', 'Austin'),
(30, 'Travolta', 'John'),
(31, 'DeVito', 'Danny'),
(32, 'Russo', 'Renne'),
(33, 'Farina', 'Dennis'),
(34, 'Pesci', 'Joe'),
(35, 'Tomei', 'Marrisa'),
(36, 'Gwynne', 'Fred'),
(37, 'Smith', 'Lane'),
(38, 'Macchio', 'Ralph'),
(39, 'Crowe', 'Russell'),
(40, 'Phoenix', 'Joaquin'),
(41, 'Nielson', 'Connie'),
(42, 'Ford', 'Harrison'),
(43, 'Hamill', 'Mark'),
(44, 'Fisher', 'Carrie'),
(45, 'Guinness', 'Alec'),
(46, 'Earl Jones', 'James'),
(47, 'Allen', 'Karen'),
(48, 'Fillion', 'Nathan'),
(49, 'Tudyk', 'Alan'),
(50, 'Baldwin', 'Adam'),
(51, 'Glass', 'Ron'),
(52, 'Staite', 'Jewel'),
(53, 'Torres', 'Gina'),
(54, 'Baccarin', 'Morena'),
(55, 'Maher', 'Sean'),
(56, 'Glau', 'Summer'),
(57, 'Ejiofor', 'Chiwetel'),
(58, 'Hershey', 'Barbara'),
(59, 'Hopper', 'Dennis'),
(60, 'Broderick', 'Matthew'),
(61, 'Sheedy', 'Ally'),
(62, 'Coleman', 'Dabney'),
(63, 'Wood', 'John'),
(64, 'Corbin', 'Barry'),
(65, 'Pullman', 'Bill'),
(66, 'Candy', 'John'),
(67, 'Moranis', 'Rick'),
(68, 'Zuniga', 'Daphne'),
(69, 'Rivers', 'Joan'),
(70, 'Kilmer', 'Val'),
(71, 'Jarret', 'Gabe'),
(72, 'Meyrink', 'Michelle'),
(73, 'Atherton', 'William'),
(74, 'Cruise', 'Tom'),
(75, 'McGillis', 'Kelly'),
(76, 'Edwards', 'Anthony'),
(77, 'Skerritt', 'Tom'),
(78, 'Sutherland', 'Donald'),
(79, 'Gould', 'Elliot'),
(80, 'Kellerman', 'Sally'),
(81, 'Duvall', 'Robert'),
(82, 'Reiner', 'Carl'),
(83, 'Marie Saint', 'Eva'),
(84, 'Arkin', 'Alan'),
(85, 'Keith', 'Brian'),
(86, 'Scheider', 'Roy'),
(87, 'Dreyfuss', 'Richard'),
(88, 'Gary', 'Lorraine'),
(89, 'Dullea', 'Keir'),
(90, 'Lockwood', 'Gary'),
(91, 'Sylvester', 'William'),
(92, 'Rain', 'Douglas'),
(93, 'Stewart', 'James'),
(94, 'Hull', 'Josephine'),
(95, 'Dow', 'Peggy'),
(96, 'Drake', 'Charles'),
(97, 'Rogen', 'Seth'),
(98, 'Heigl', 'Katherine'),
(99, 'Rudd', 'Paul'),
(100, 'Mann', 'Leslie');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `is_confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `password_hash` varchar(255) NOT NULL,
  `auth_token` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `nickname`, `email`, `role`, `is_confirmed`, `password_hash`, `auth_token`, `created_at`) VALUES
(1, 'Admin', 'admin@gmail.com', 'admin', 1, '$2y$10$aN5MkgYF2eIXG7VrepfNY.T1l4/gRea6T.lJNfP1Fjep6fzM46Fd.', '60321871315431baa3475a187a184ca8fc205e942bd7ad57ce3755ae2b8be5ad2e92df4d712a590f', '2022-06-19 15:50:21'),
(2, 'User', 'user@gmail.com', 'user', 1, '$2y$10$nEUWMyIReilEk4Gle0qzHuLajaiBVH56N852qTeTPEpxwZLZdwcPu', '58b3f4c1013d3a40f92192fb76eaa7fd0c22e1b3f9983bdd125e126db0b18577dd476498aed87f92', '2022-06-19 15:51:44');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `films`
--
ALTER TABLE `films`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `films_and_stars`
--
ALTER TABLE `films_and_stars`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Индексы таблицы `films_image`
--
ALTER TABLE `films_image`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `stars`
--
ALTER TABLE `stars`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nickname` (`nickname`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `films`
--
ALTER TABLE `films`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT для таблицы `films_and_stars`
--
ALTER TABLE `films_and_stars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;

--
-- AUTO_INCREMENT для таблицы `films_image`
--
ALTER TABLE `films_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT для таблицы `stars`
--
ALTER TABLE `stars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

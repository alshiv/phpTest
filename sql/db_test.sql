-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 03 2019 г., 08:25
-- Версия сервера: 10.3.13-MariaDB-log
-- Версия PHP: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `db_test`
--

-- --------------------------------------------------------

--
-- Структура таблицы `review_tbl`
--

CREATE TABLE `review_tbl` (
  `id` int(11) NOT NULL,
  `userName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userMail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userReview` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `userImage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reviewDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `adminCheck` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `review_tbl`
--

INSERT INTO `review_tbl` (`id`, `userName`, `userMail`, `userReview`, `userImage`, `reviewDate`, `adminCheck`) VALUES
(1, 'Alex', 'alex@phpneuch.com', 'Ну что тут сказать, а нечего сказать', '', '2019-10-30 14:05:02', 1),
(2, 'Ivan', 'ivan@gmail.com', 'Пишу просто так', NULL, '2019-10-30 14:38:47', 1),
(34, 'Jaja', 'aloha@glack.com', 'Che kavo', NULL, '2019-11-01 11:19:53', 0),
(38, 'Gaben', 'steam@galenkinSPIT.com', 'NICE<br>Изменено администратором', NULL, '2019-11-02 12:41:44', 1),
(45, 'Gachi Muchi', '300@bucks.spank', 'Boy Next Door', '5dbdbb7e9654e.png', '2019-11-02 17:23:10', 1),
(46, 'Zeus', 'olimp@throne.com', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sed lorem tellus. Nullam placerat enim vitae tellus convallis pretium. Curabitur ipsum elit, semper in libero at, sodales condimentum dui. Aliquam magna ipsum, varius vitae nulla id, sodales ultricies massa. Proin quis tincidunt massa. Vestibulum elit sapien, ullamcorper vitae laoreet id, scelerisque at odio. Ut vestibulum justo ipsum, in molestie libero laoreet ac. Fusce aliquam a enim efficitur tincidunt. Proin ex felis, maximus sit amet elementum eu, commodo sit amet eros.', '5dbdc8c625614.jpg', '2019-11-02 18:19:50', 1),
(53, 'Ivan Koutikov', 'green@street.uk', 'tu-tu-du-du-du\r\npam-pam-pam-tu-tu-du-du', '5dbe63e5017af.jpg', '2019-11-03 05:21:41', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `users_tbl`
--

CREATE TABLE `users_tbl` (
  `id` int(11) NOT NULL,
  `login` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users_tbl`
--

INSERT INTO `users_tbl` (`id`, `login`, `password`) VALUES
(1, 'admin', '123');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `review_tbl`
--
ALTER TABLE `review_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users_tbl`
--
ALTER TABLE `users_tbl`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `review_tbl`
--
ALTER TABLE `review_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT для таблицы `users_tbl`
--
ALTER TABLE `users_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

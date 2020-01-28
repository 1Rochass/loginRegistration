-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 28 2020 г., 10:25
-- Версия сервера: 5.6.41
-- Версия PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `jokes`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_login` varchar(256) NOT NULL,
  `user_password` varchar(256) NOT NULL,
  `user_email` varchar(256) NOT NULL,
  `admin` int(11) DEFAULT NULL,
  `date_registration` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `user_login`, `user_password`, `user_email`, `admin`, `date_registration`) VALUES
(1, 'admin', '81dc9bdb52d04dc20036dbd8313ed055', 'www@www', 1, '2020-01-22 12:23:03'),
(5, 'Ее', 'c4ca4238a0b923820dcc509a6f75849b', '1', 2, '2020-01-23 21:21:36'),
(7, 'Лл', 'a87ff679a2f3e71d9181a67b7542122c', '4', 2, '2020-01-23 21:38:10'),
(8, 'Нн', 'c4ca4238a0b923820dcc509a6f75849b', 'l@l', NULL, '2020-01-23 22:01:06'),
(9, 'adminyudff', '81dc9bdb52d04dc20036dbd8313ed055', 'q@q', NULL, '2020-01-23 22:28:25');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

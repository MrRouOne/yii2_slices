-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Фев 21 2023 г., 13:41
-- Версия сервера: 10.4.21-MariaDB
-- Версия PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `yii2_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `patronymic` varchar(255) DEFAULT NULL,
  `login` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `name`, `surname`, `patronymic`, `login`, `email`, `password`, `is_admin`) VALUES
(1, 'admin', 'admin', 'admin', 'admin', 'admin@gmail.com', 'e020590f0e18cd6053d7ae0e0a507609', 1),
(2, 'Иван', 'Иванов', 'Иванович', 'Ivanov', 'ivanov@gmail.com', '3d14138fa92c14e3f7a0146fc1939477', 0),
(3, 'дада', 'дада', 'дада', 'dada', 'dada@dada.dada', '6d2cf3fdab44bdfc1990230f21e4c25d', 0),
(4, 'авыпап', 'апап', '', 'username', 'username@username.username', '14c4b06b824ec593239362517f538b29', 0),
(5, 'петя', 'петров', 'петрович', 'petya12', 'petya12@gmail.com', '6c4e6d557a2fc36f3e5f3ff43f3ce401', 0),
(6, 'лоываол', 'лоываол', 'лоываол', 'ffff565656', 'ffff565656@gg.gg', '81b85073999b549a0c58efdd5223ba78', 0),
(7, 'юзернайм', 'юзернайм', 'юзернайм', 'username12', 'username@username.username12', '14c4b06b824ec593239362517f538b29', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

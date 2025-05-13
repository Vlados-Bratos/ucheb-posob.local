-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Хост: MySQL-8.0
-- Время создания: Май 04 2025 г., 18:15
-- Версия сервера: 8.0.35
-- Версия PHP: 8.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `posobie`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Преподаватели`
--

CREATE TABLE `Преподаватели` (
  `id_teacher` int NOT NULL,
  `Фамилия` varchar(50) NOT NULL,
  `Имя` varchar(50) NOT NULL,
  `Отчество` varchar(50) NOT NULL,
  `Логин` varchar(50) NOT NULL,
  `Пароль` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Преподаватели`
--

INSERT INTO `Преподаватели` (`id_teacher`, `Фамилия`, `Имя`, `Отчество`, `Логин`, `Пароль`) VALUES
(1, 'Мамутов', 'Евгений', 'Вадимович', 'Mamutov_Ev', 'qwerty11');

-- --------------------------------------------------------

--
-- Структура таблицы `Студенты`
--

CREATE TABLE `Студенты` (
  `id_students` int NOT NULL,
  `Фамилия` varchar(50) NOT NULL,
  `Имя` varchar(50) NOT NULL,
  `Отчество` varchar(50) NOT NULL,
  `Логин` varchar(50) NOT NULL,
  `Пароль` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Студенты`
--

INSERT INTO `Студенты` (`id_students`, `Фамилия`, `Имя`, `Отчество`, `Логин`, `Пароль`) VALUES
(1, 'Третьяков', 'Егор', 'Владимирович', 'tretyaEgr', 'qwerty12');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Преподаватели`
--
ALTER TABLE `Преподаватели`
  ADD PRIMARY KEY (`id_teacher`);

--
-- Индексы таблицы `Студенты`
--
ALTER TABLE `Студенты`
  ADD PRIMARY KEY (`id_students`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Преподаватели`
--
ALTER TABLE `Преподаватели`
  MODIFY `id_teacher` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `Студенты`
--
ALTER TABLE `Студенты`
  MODIFY `id_students` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

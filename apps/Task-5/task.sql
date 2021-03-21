-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: db
-- Время создания: Мар 21 2021 г., 21:46
-- Версия сервера: 5.7.32
-- Версия PHP: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `task`
--

-- --------------------------------------------------------

--
-- Структура таблицы `balans`
--

CREATE TABLE `balans` (
  `id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `cash` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `balans`
--

INSERT INTO `balans` (`id`, `person_id`, `cash`) VALUES
(1, 1, 95.93),
(2, 2, 112.42),
(3, 3, 111.07),
(4, 4, 77),
(5, 5, 90.58),
(6, 6, 100),
(7, 7, 113);

-- --------------------------------------------------------

--
-- Структура таблицы `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `name` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cities`
--

INSERT INTO `cities` (`id`, `name`) VALUES
(1, 'Minsk'),
(2, 'Gomel'),
(3, 'Hrodna'),
(4, 'Baranovichi'),
(5, 'Brest'),
(6, 'Zhlobin'),
(7, 'Vitebsk'),
(8, 'Krugloe');

-- --------------------------------------------------------

--
-- Структура таблицы `persons`
--

CREATE TABLE `persons` (
  `id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `fullname` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `persons`
--

INSERT INTO `persons` (`id`, `city_id`, `fullname`) VALUES
(1, 5, 'Ivan Petrov'),
(2, 3, 'Sebastian Haponenka'),
(3, 3, 'Vasil Lutsevich'),
(4, 2, 'Leo Klimovich'),
(5, 7, 'Matea Kezhman'),
(6, 8, 'Alex Marshall'),
(7, 3, 'Bilbo Beggins');

-- --------------------------------------------------------

--
-- Структура таблицы `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL,
  `from_person_id` int(11) NOT NULL,
  `to_person_id` int(11) NOT NULL,
  `amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `from_person_id`, `to_person_id`, `amount`) VALUES
(1, 4, 2, 10),
(2, 2, 3, 7),
(3, 5, 2, 12.54),
(4, 4, 7, 13),
(5, 3, 1, 8.23),
(6, 1, 3, 12.3),
(7, 2, 5, 3.12);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `balans`
--
ALTER TABLE `balans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `person_id` (`person_id`);

--
-- Индексы таблицы `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `persons`
--
ALTER TABLE `persons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `city_id` (`city_id`);

--
-- Индексы таблицы `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `from_person_id` (`from_person_id`),
  ADD KEY `to_person_id` (`to_person_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `balans`
--
ALTER TABLE `balans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `persons`
--
ALTER TABLE `persons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `balans`
--
ALTER TABLE `balans`
  ADD CONSTRAINT `balans_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `persons` (`id`);

--
-- Ограничения внешнего ключа таблицы `persons`
--
ALTER TABLE `persons`
  ADD CONSTRAINT `persons_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`);

--
-- Ограничения внешнего ключа таблицы `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`from_person_id`) REFERENCES `persons` (`id`),
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`to_person_id`) REFERENCES `persons` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

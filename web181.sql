-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:8889
-- Время создания: Авг 09 2018 г., 18:00
-- Версия сервера: 5.6.38
-- Версия PHP: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- База данных: `web181`
--

-- --------------------------------------------------------

--
-- Структура таблицы `menu`
--

CREATE TABLE `menu` (
  `id` int(10) NOT NULL,
  `pid` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` text NOT NULL,
  `order` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `menu`
--

INSERT INTO `menu` (`id`, `pid`, `name`, `title`, `order`) VALUES
  (1, 0, 'main', 'Главная', 10),
  (2, 0, 'categories', 'Категории', 20),
  (3, 0, 'about', 'О нас', 30),
  (4, 2, 'news', 'Новости', 10),
  (5, 2, 'actions', 'События', 20);

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE `posts` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `name` text NOT NULL,
  `title` text,
  `content` text,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `name`, `title`, `content`, `date`) VALUES
  (1, 2, 'new', 'новая запись', 'текст записи', '2018-08-06 20:19:07'),
  (2, 3, '', 'инновации на пасеке', 'texr', '2018-08-06 20:24:05'),
  (3, 2, 'memories', 'мемуары', 'длинная история жизни', '2018-08-06 20:30:11'),
  (4, 0, '', 'qwer', 'mnbvc', '2018-08-07 19:52:51'),
  (5, 0, '', 'что-то новое', 'текст и все такое\r\nтро-ло-ло', '2018-08-07 20:11:34'),
  (6, 0, '', 'супер', 'ави', '2018-08-09 20:45:58');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `email`, `password`, `date`) VALUES
  (1, 'admin1', 'admin@localhost', '123', '2018-08-06 20:08:18'),
  (2, 'ivan', 'drago@ya.ru', 'ghgfd', '2018-08-06 20:08:18'),
  (3, 'new', 'valera@rambler.ru', '098', '2018-08-06 20:08:18'),
  (4, 'rockey', 'balboa@yahoo.com', '2345', '2018-08-06 20:08:18'),
  (5, 'predator', 'arnold@mail.ru', '345', '2018-08-06 20:10:00'),
  (6, 'test', 't@ya.ru', '235', '2018-08-06 20:11:17'),
  (8, 'лаврентий', 'beriya@mail.ru', '654', '2018-08-07 19:32:15'),
  (10, 'new user name', '', '', '2018-08-07 19:38:19');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `menu`
--
ALTER TABLE `menu`
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

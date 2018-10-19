-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:8889
-- Время создания: Окт 19 2018 г., 10:28
-- Версия сервера: 5.7.23
-- Версия PHP: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- База данных: `personal-site`
--

-- --------------------------------------------------------

--
-- Структура таблицы `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `parent` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `summary`
--

CREATE TABLE `summary` (
  `id` int(11) NOT NULL,
  `Start` date NOT NULL,
  `end` date NOT NULL,
  `position` varchar(255) NOT NULL,
  `location` geometry NOT NULL,
  `header` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `table-users`
--

CREATE TABLE `table-users` (
  `id` int(11) NOT NULL,
  `fio` varchar(255) NOT NULL,
  `bio` text NOT NULL,
  `birthday` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `users-meta`
--

CREATE TABLE `users-meta` (
  `id` int(11) NOT NULL,
  `key` text NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `summary`
--
ALTER TABLE `summary`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `table-users`
--
ALTER TABLE `table-users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users-meta`
--
ALTER TABLE `users-meta`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `summary`
--
ALTER TABLE `summary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `table-users`
--
ALTER TABLE `table-users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `users-meta`
--
ALTER TABLE `users-meta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 09 2018 г., 13:08
-- Версия сервера: 5.7.21
-- Версия PHP: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `web181`
--

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `name` text NOT NULL,
  `title` text,
  `content` text,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `name`, `title`, `content`, `date`) VALUES
(1, 0, 'New post', 'Заголовок', 'Содержимое', '2018-08-07 16:13:53'),
(2, 3, 'Parts 1', 'Новости мира Hi-tech', 'Много текста co смыслoм, новости...', '2018-08-07 16:27:39'),
(3, 6, 'name of the article', 'Название статьи', 'Содержимое статьи', '2018-08-09 15:36:07'),
(4, 1, 'Important news', 'Последние сенсации', 'Крысы мутанты в башнях кремля', '2018-08-09 16:00:45'),
(5, 4, 'something', 'Очень интересная статья', 'Очень интересное содержимое очень интересной статьи', '2018-08-09 16:06:39');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `email`, `password`, `date`) VALUES
(1, 'admin22', 'admi@yandex.ru', 'pass123', '2018-08-07 16:03:38'),
(3, 'Foma', 'foma@bk.ru', 'ty78', '2018-08-07 16:03:38'),
(4, 'Евпатий', 'kolovrat@yandex.ru', 'sword333', '2018-08-09 15:46:45'),
(5, 'Гришка', 'Rasputin@gmail.com', 'Superstar', '2018-08-09 15:50:37'),
(6, 'Салават', 'Yulayev@rambler.ua', 'Kort1754', '2018-08-09 15:53:34');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

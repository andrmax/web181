-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 20 2018 г., 19:25
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
-- База данных: `serkov_site`
--

-- --------------------------------------------------------

--
-- Структура таблицы `meta`
--

DROP TABLE IF EXISTS `meta`;
CREATE TABLE IF NOT EXISTS `meta` (
  `id meta` int(10) NOT NULL AUTO_INCREMENT,
  `m_key` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id meta`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `meta`
--

INSERT INTO `meta` (`id meta`, `m_key`, `value`) VALUES
(1, 'address', 'Адрес'),
(2, 'phone', 'Телефон'),
(3, 'e-mail', 'E-mail'),
(4, 'web site', 'Web Site'),
(5, 'vk_link', 'vk_link'),
(6, 'vk_image', 'vk_image'),
(7, 'fb_link', 'fb_link'),
(8, 'fb_image', 'fb_image'),
(9, 'inst_link', 'inst_link'),
(10, 'inst_image', 'inst_image');

-- --------------------------------------------------------

--
-- Структура таблицы `site_menu`
--

DROP TABLE IF EXISTS `site_menu`;
CREATE TABLE IF NOT EXISTS `site_menu` (
  `id_menu` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `url_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id_menu`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `site_menu`
--

INSERT INTO `site_menu` (`id_menu`, `name`, `url_name`) VALUES
(1, 'Главная', 'main'),
(2, 'Обо мне', 'about'),
(3, 'Мой опыт', 'resume');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fam. name` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `middle name` varchar(255) DEFAULT NULL,
  `day of birth` date NOT NULL,
  `about` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`user_id`, `fam. name`, `name`, `middle name`, `day of birth`, `about`) VALUES
(1, 'Серков', 'Захар', 'Борисович', '1981-08-14', 'Родился, живу');

-- --------------------------------------------------------

--
-- Структура таблицы `user_meta_data`
--

DROP TABLE IF EXISTS `user_meta_data`;
CREATE TABLE IF NOT EXISTS `user_meta_data` (
  `id meta_data` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `e-mail` varchar(255) DEFAULT NULL,
  `web site` varchar(255) DEFAULT NULL,
  `vk_link` varchar(255) DEFAULT NULL,
  `vk_image` varchar(255) DEFAULT NULL,
  `fb_link` varchar(255) DEFAULT NULL,
  `fb_image` varchar(255) DEFAULT NULL,
  `inst_link` varchar(255) DEFAULT NULL,
  `inst_image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id meta_data`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_meta_data`
--

INSERT INTO `user_meta_data` (`id meta_data`, `address`, `phone`, `e-mail`, `web site`, `vk_link`, `vk_image`, `fb_link`, `fb_image`, `inst_link`, `inst_image`) VALUES
(1, 'Москва', '+7 (985) 920-26-53', 'zakharserkov@me.com', 'http://antip.ru', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `user_resume`
--

DROP TABLE IF EXISTS `user_resume`;
CREATE TABLE IF NOT EXISTS `user_resume` (
  `id job` int(10) NOT NULL AUTO_INCREMENT,
  `start date` date NOT NULL,
  `end date` date DEFAULT NULL,
  `position` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `official duties` varchar(255) NOT NULL,
  PRIMARY KEY (`id job`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_resume`
--

INSERT INTO `user_resume` (`id job`, `start date`, `end date`, `position`, `location`, `official duties`) VALUES
(1, '2015-03-01', '2015-12-01', 'Механик', 'Сызрань', 'Работал в автосервисе, делал все.'),
(2, '2016-01-01', '2016-03-01', 'Механик-электрик', 'Саратов', 'Выкручивал лампочки.'),
(3, '2016-04-01', NULL, 'Механик-танцор', 'Москва', 'Ничего не делаю, но деньги получаю.');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

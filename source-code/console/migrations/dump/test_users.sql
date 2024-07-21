-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 20 2024 г., 21:29
-- Версия сервера: 8.0.24
-- Версия PHP: 7.4.14

SET
SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET
time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `test_users`
--

--


--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`)
VALUES (3, 'develop'),
       (1, 'manager'),
       (2, 'pr-manager');

--
-- Дамп данных таблицы `role_users`
--

INSERT INTO `role_users` (`id`, `user_id`, `role_id`)
VALUES (1, 2, 3),
       (2, 3, 2),
       (3, 4, 1),
       (4, 5, 1),
       (5, 5, 2),
       (6, 1, 3),
       (7, 1, 1),
       (8, 1, 2);

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `authKey`, `accessToken`, `type`)
VALUES (1, 'admin', 'admin@mail.ru', '$2y$13$SsDul/1wqbR.15kI596OWuhq/sWARzHfSZ11FNGVFhJii7vWTMgBy', '0JxBN',
        '1ac61d101bca1b26', 2),
       (2, 'Oleg', 'oleg@mail.ru', '$2y$13$UngpeC7Ol5UPNlyxUDeTtuZE.MIFWC/uJA17KqJ/NNcidgI2CgKde', '7NxU-',
        '61c2d7d1f759510d', 1),
       (3, 'roma', 'roma@mail.ru', '$2y$13$cSma4mmx/.qIvgLcjRnvZuenI/fRIV6YF.rVybHwuvcXbxDSEpIzu', '2LLwz',
        '4e0b83b125114217', 1),
       (4, 'alex', 'alex@mail.ru', '$2y$13$44M5SwN8d/V/7dHBuK6w0OQdWWCseHsWWkyNrtqpADVId69zs8So2', 'ETjRh',
        '77adbeaa3d796eeb', 1),
       (5, 'kate', 'kate@mail.ru', '$2y$13$gczp5httHpI0D6/mTLTpheApSgA90a.nTm9vMp.X0APBnUpWx.s4u', 'MRZ5t',
        '90f511859a0d20e6', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2024-02-18 23:51:54
-- 服务器版本： 5.6.50-log
-- PHP 版本： 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `yh`
--

-- --------------------------------------------------------

--
-- 表的结构 `banip`
--

CREATE TABLE `banip` (
  `id` int(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `why` varchar(255) NOT NULL,
  `time` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `statistics`
--

CREATE TABLE `statistics` (
  `id` int(6) UNSIGNED NOT NULL,
  `referer` varchar(100) NOT NULL DEFAULT '无响应页面',
  `page` varchar(100) NOT NULL,
  `ip` varchar(255) NOT NULL DEFAULT '无数据',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE `user` (
  `uid` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `power` int(2) NOT NULL,
  `qq` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `time` timestamp(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`uid`, `username`, `password`, `power`, `qq`, `url`, `time`) VALUES
(1, 'Admin', 'fe296a417940fdf44b32325e435d115e', 1, '1969947820', 'test.test.top', '2024-02-18 15:51:33.000000');

--
-- 转储表的索引
--

--
-- 表的索引 `banip`
--
ALTER TABLE `banip`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `statistics`
--
ALTER TABLE `statistics`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `banip`
--
ALTER TABLE `banip`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `statistics`
--
ALTER TABLE `statistics`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3274;

--
-- 使用表AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

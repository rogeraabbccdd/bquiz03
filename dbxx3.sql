-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- 主機: 127.0.0.1
-- 產生時間： 2019 年 03 月 24 日 22:07
-- 伺服器版本: 10.1.33-MariaDB
-- PHP 版本： 7.1.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `dbxx3`
--

-- --------------------------------------------------------

--
-- 資料表結構 `ani`
--

CREATE TABLE `ani` (
  `ani` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 資料表的匯出資料 `ani`
--

INSERT INTO `ani` (`ani`) VALUES
(1);

-- --------------------------------------------------------

--
-- 資料表結構 `movie`
--

CREATE TABLE `movie` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '片名',
  `level` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '分級',
  `length` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '片長',
  `ondate` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '上映日期',
  `publish` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '發行商',
  `director` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '導演',
  `trailer` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '預告片',
  `poster` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '海報',
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '簡介',
  `display` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '顯示',
  `seq` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '順序'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 資料表的匯出資料 `movie`
--

INSERT INTO `movie` (`id`, `name`, `level`, `length`, `ondate`, `publish`, `director`, `trailer`, `poster`, `text`, `display`, `seq`) VALUES
(1, '電影1', '1', '100', '1557007200', 'aaa', 'bbb', '03B01v.mp4', '03B01.png', 'bbb', '1', '1'),
(3, '電影3', '3', '180', '1553641200', 'abc', 'abc', '1553459083.mp4', '1553459083.png', 'abc', '1', '3'),
(27, '電影2', '1', '111', '1553554800', 'abc', 'abc', '1553459015.mp4', '1553459015.png', 'abc', '1', '2'),
(28, '電影4', '1', '180', '1553727600', 'abc', 'abc', '1553459121.mp4', '1553459121.png', 'abc', '1', '4');

-- --------------------------------------------------------

--
-- 資料表結構 `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `movie` int(11) NOT NULL COMMENT '電影',
  `date` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '日期',
  `time` int(11) NOT NULL COMMENT '時間',
  `seat` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '座位',
  `num` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '訂單編號'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `file` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '檔案',
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '文字',
  `display` int(11) NOT NULL COMMENT '顯示',
  `seq` int(11) NOT NULL COMMENT '排序'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 資料表的匯出資料 `post`
--

INSERT INTO `post` (`id`, `file`, `text`, `display`, `seq`) VALUES
(11, '03A02.jpg', '預告片2', 1, 2),
(12, '03A03.jpg', '預告片3', 1, 3),
(13, '03A04.jpg', '預告片4', 1, 4),
(14, '03A05.jpg', '預告片5', 1, 5),
(15, '1553453767.jpg', '預告片1', 1, 1);

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `movie`
--
ALTER TABLE `movie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- 使用資料表 AUTO_INCREMENT `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用資料表 AUTO_INCREMENT `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

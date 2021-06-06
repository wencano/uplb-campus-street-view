-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2021 at 05:39 AM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.1.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uplb_campus_view`
--

-- --------------------------------------------------------

--
-- Table structure for table `csv_info_hotspots`
--

CREATE TABLE `csv_info_hotspots` (
  `id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `yaw` double NOT NULL,
  `pitch` double NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `csv_info_hotspots`
--

INSERT INTO `csv_info_hotspots` (`id`, `location_id`, `yaw`, `pitch`, `title`, `text`) VALUES
(1, 10000, -0.10116325941012505, -0.12205365453901074, 'The Oblation', 'The oblation statue here is a replica of National Artist Guillermo Tolentino\'s  masterpiece \"Oblation\". The original Oblation can be found inside the UP Diliman Main Library. There can be no other emblem more fitting than the Oblation for it highlights the core foundation that UP upholds: Selfless service and patriotism that flourishes throughout the country.'),
(2, 10001, -0.5297579276547992, 0.20917154810953242, 'Physical Sciences Building', 'Formerly known as the Francisco O. Santos Hall and named after the recipient of  National Scientist Award in 1983,  Francisco O. Santos. He was hailed as an outstanding educator and eminent scientist in the field of human nutrition and agricultural chemistry. This building houses 4 institutes and lecture halls namely: ICS(Institute of Computer Science, InStat(Institute of Statistics), IMSP (Institute of Mathematical Sciences and Physics), PSLH-A and B, ICSMH, ICSLH3 and 4 and INSTATLH'),
(3, 10009, -1.5866770932250915, 0.06668679695442492, 'ICSMH', 'This is info hotspot for ICSMH'),
(8, 10018, 0, 0, 'Test', 'Test');

-- --------------------------------------------------------

--
-- Table structure for table `csv_link_hotspots`
--

CREATE TABLE `csv_link_hotspots` (
  `id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `yaw` double NOT NULL,
  `pitch` double NOT NULL,
  `rotation` float NOT NULL,
  `target` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `csv_link_hotspots`
--

INSERT INTO `csv_link_hotspots` (`id`, `location_id`, `yaw`, `pitch`, `rotation`, `target`) VALUES
(2, 10001, 2.9333010660995766, 0.11791563588594123, 0, 10000),
(3, 10009, -0.05398527884721993, 0.1368401299251989, 0, 10000),
(7, 10012, -1.7604447575962219, -0.005143867814489056, 0, 10000),
(13, 10017, -0.30392470189295295, 0.13186577776044572, 0.5, 10000),
(16, 10018, 0, 0, 0, 10001),
(19, 10000, 2.9661005742841855, -0.03286207075883851, 0.7854, 10020),
(20, 10000, -0.8973865863824955, 0.04762513608536878, 0, 10017),
(21, 10000, -1.9844705832289051, 0.08013930939333846, 0.7854, 10001);

-- --------------------------------------------------------

--
-- Table structure for table `csv_locations`
--

CREATE TABLE `csv_locations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `levels` text NOT NULL,
  `faceSize` int(11) NOT NULL,
  `initialViewParameters` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `csv_locations`
--

INSERT INTO `csv_locations` (`id`, `name`, `levels`, `faceSize`, `initialViewParameters`, `date_created`) VALUES
(10000, ' Oblation Park', '[{\"tileSize\":256,\"size\":256,\"fallbackOnly\":true},{\"tileSize\":512,\"size\":512},{\"tileSize\":512,\"size\":1024},{\"tileSize\":512,\"size\":2048}]', 2048, '{\"yaw\":-0.08422496371826682,\"pitch\":-0.5411220290303351,\"fov\":1.3231037852768384}', '2018-12-17 00:00:00'),
(10001, 'Physical Sciences Building', '[{\"tileSize\":256,\"size\":256,\"fallbackOnly\":true},{\"tileSize\":512,\"size\":512},{\"tileSize\":512,\"size\":1024},{\"tileSize\":512,\"size\":2048}]', 2048, '{\"pitch\":0,\"yaw\":0,\"fov\":1.5707963267948966}', '2018-12-17 00:00:00'),
(10009, 'ICSMH', '[{\"tileSize\":256,\"size\":256,\"fallbackOnly\":true},{\"tileSize\":512,\"size\":512},{\"tileSize\":512,\"size\":1024},{\"tileSize\":512,\"size\":2048}]', 2048, '{\"pitch\":0,\"yaw\":0,\"fov\":1.5707963267948966}', '2018-12-17 22:59:15'),
(10012, 'PSLH 2', '[{\"tileSize\":256,\"size\":256,\"fallbackOnly\":true},{\"tileSize\":512,\"size\":512},{\"tileSize\":512,\"size\":1024},{\"tileSize\":512,\"size\":2048}]', 2048, '{\"pitch\":0,\"yaw\":0,\"fov\":1.5707963267948966}', '2018-12-17 23:14:37'),
(10017, 'Freedom Park', '[{\"tileSize\":256,\"size\":256,\"fallbackOnly\":true},{\"tileSize\":512,\"size\":512},{\"tileSize\":512,\"size\":1024},{\"tileSize\":512,\"size\":2048}]', 2048, '{\"pitch\":0,\"yaw\":0,\"fov\":1.5707963267948966}', '2018-12-18 03:19:06'),
(10018, 'NCAS', '[{\"tileSize\":256,\"size\":256,\"fallbackOnly\":true},{\"tileSize\":512,\"size\":512},{\"tileSize\":512,\"size\":1024},{\"tileSize\":512,\"size\":2048}]', 2048, '{\"pitch\":0,\"yaw\":0,\"fov\":1.5707963267948966}', '2018-12-18 03:25:40'),
(10020, 'CHE', '[{\"tileSize\":256,\"size\":256,\"fallbackOnly\":true},{\"tileSize\":512,\"size\":512},{\"tileSize\":512,\"size\":1024},{\"tileSize\":512,\"size\":2048}]', 2048, '{\"pitch\":0,\"yaw\":0,\"fov\":1.5707963267948966}', '2018-12-18 04:11:59');

-- --------------------------------------------------------

--
-- Table structure for table `csv_sessions`
--

CREATE TABLE `csv_sessions` (
  `id` int(11) NOT NULL,
  `session_key` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `timein` datetime NOT NULL,
  `last` datetime NOT NULL,
  `timeout` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `csv_sessions`
--

INSERT INTO `csv_sessions` (`id`, `session_key`, `user_id`, `timein`, `last`, `timeout`) VALUES
(100, '9e2a93b6f7869228c8e8a4cb0', 1000, '2018-12-17 10:39:44', '2018-12-17 10:39:44', '0000-00-00 00:00:00'),
(101, '33fb28146a1c16be2d5a243bc', 1000, '2018-12-17 10:39:51', '2018-12-17 10:39:51', '0000-00-00 00:00:00'),
(102, '2d9e7ce965f232488decf9895', 1000, '2018-12-17 10:40:58', '2018-12-17 10:40:58', '0000-00-00 00:00:00'),
(103, '46a2eb8782c463db5fcff32cb', 1000, '2018-12-17 10:47:40', '2018-12-17 10:47:40', '0000-00-00 00:00:00'),
(104, 'fef2244d58df755b353e8f7ef', 1000, '2018-12-17 10:48:57', '2018-12-17 10:48:57', '2018-12-17 10:51:09'),
(105, 'ba1b08503400c76a095dcfd4f', 1000, '2018-12-17 10:51:15', '2018-12-17 10:51:15', '2018-12-17 10:52:38'),
(106, '1ef5f42469997c90992875c0a', 1000, '2018-12-17 10:52:45', '2018-12-17 10:52:45', '2018-12-17 11:13:06'),
(107, '3780555f407689138280b2179', 1000, '2018-12-17 11:13:13', '2018-12-17 11:13:13', '2018-12-17 11:45:50'),
(108, 'e216a6c64d61727aecc29e433', 1000, '2018-12-17 11:46:43', '2018-12-17 11:46:43', '2018-12-17 11:49:06'),
(109, 'b8614704550f7d3f8983252f8', 1000, '2018-12-17 11:49:14', '2018-12-17 11:49:14', '0000-00-00 00:00:00'),
(110, '3f1012bb15486b99a6c27e5b3', 1000, '2018-12-17 11:50:23', '2018-12-17 11:50:23', '0000-00-00 00:00:00'),
(111, '478f91402a730bc2d42742a96', 1000, '2018-12-17 11:51:39', '2018-12-17 11:51:39', '2018-12-17 11:52:22'),
(112, 'e2eb60eded94af4f37f6bceaa', 1000, '2018-12-17 11:52:30', '2018-12-17 11:52:30', '2018-12-17 11:53:12'),
(113, '6439c2491811331f71776b4b4', 1000, '2018-12-17 11:53:19', '2018-12-17 11:53:19', '2018-12-17 11:54:41'),
(114, 'd64187d45bb238b13996b12e4', 1000, '2018-12-17 11:54:47', '2018-12-17 11:54:47', '2018-12-17 11:57:08'),
(115, '46ea72769fb95061c88373b6b', 1000, '2018-12-17 11:58:18', '2018-12-17 11:58:18', '2018-12-17 11:58:52'),
(116, '163c5c9b25c5eb12a79d0ba37', 1000, '2018-12-17 12:08:52', '2018-12-17 12:08:52', '2018-12-17 12:11:05'),
(117, '492deb40bafb81c60b7893299', 1000, '2018-12-17 12:11:11', '2018-12-17 12:11:11', '2018-12-17 12:11:29'),
(118, '188c6117977039e8e0fa2ea41', 1000, '2018-12-17 12:11:36', '2018-12-17 12:11:36', '2018-12-17 12:12:39'),
(119, '074790e8993049e44957117c1', 1000, '2018-12-17 12:12:44', '2018-12-17 12:12:44', '2018-12-17 12:14:31'),
(120, '1a00714362b527206307d9dfe', 1000, '2018-12-17 12:14:38', '2018-12-17 12:14:38', '2018-12-17 12:15:26'),
(121, '6779cc2f7fd9e8a43b1e7026d', 1000, '2018-12-17 12:15:32', '2018-12-17 12:15:32', '2018-12-17 12:15:34'),
(122, '9fa2554d013ffe211f79000de', 1000, '2018-12-17 12:16:10', '2018-12-17 12:16:10', '2018-12-17 12:16:23'),
(123, '2f6993484b9f5ddde58e31880', 1000, '2018-12-17 12:16:28', '2018-12-17 12:16:28', '2018-12-17 12:17:00'),
(124, '97b01dc750aeb4d1bbee3add2', 1000, '2018-12-17 12:17:05', '2018-12-17 12:17:05', '2018-12-17 12:17:15'),
(125, '6ce06efdc756e8ea534bf2116', 1000, '2018-12-17 12:17:19', '2018-12-17 12:17:19', '2018-12-17 12:17:22'),
(126, '69861fd3e71088d73a8ca117f', 1000, '2018-12-17 12:17:26', '2018-12-17 12:17:26', '2018-12-17 12:17:31'),
(127, 'cfc68965a4e3b1a38ba4daabe', 1000, '2018-12-17 12:17:36', '2018-12-17 12:17:36', '2018-12-17 12:17:45'),
(128, '90fda507836c5d2d4b5f4e124', 1000, '2018-12-17 12:17:50', '2018-12-17 12:17:50', '2018-12-17 12:36:19'),
(129, '4a68c92d196484f6e7dff87a9', 1000, '2018-12-17 12:36:26', '2018-12-17 12:36:26', '2018-12-17 12:36:49'),
(130, '4f399de2f54f04cd7c10f9a61', 1000, '2018-12-17 12:36:54', '2018-12-17 12:36:54', '2018-12-17 12:38:37'),
(131, '2a3f905dd9742049697b70890', 1000, '2018-12-17 12:38:40', '2018-12-17 12:38:40', '2018-12-17 12:40:16'),
(132, 'b276330ee1791b1014b66d541', 1000, '2018-12-17 12:40:21', '2018-12-17 12:40:21', '2018-12-17 12:45:18'),
(133, '5ffcb7432aced0231711dcaa1', 1000, '2018-12-17 12:45:22', '2018-12-17 12:45:22', '2018-12-17 14:07:36'),
(134, 'def6815988ce711303db224d7', 1000, '2018-12-17 14:09:49', '2018-12-17 14:09:49', '0000-00-00 00:00:00'),
(135, 'd5ce75a7fc9a4e3980a504757', 1000, '2018-12-17 16:07:58', '2018-12-17 16:07:58', '0000-00-00 00:00:00'),
(136, '0f056333bf80db34305c2b9e0', 1000, '2018-12-17 16:17:51', '2018-12-17 16:17:51', '0000-00-00 00:00:00'),
(137, 'ac244e8d0b94f6020393a93f9', 1000, '2018-12-17 16:21:54', '2018-12-17 16:21:54', '2018-12-17 21:40:18'),
(138, 'f41c2999d1fbd6780640db324', 1000, '2018-12-17 16:24:35', '2018-12-17 16:24:35', '2018-12-17 17:33:08'),
(139, '44a7c26e631dacffb19ad1d17', 1000, '2018-12-17 17:33:10', '2018-12-17 17:33:10', '2018-12-17 17:34:21'),
(140, '789f789dc6f733e7e2e169b77', 1000, '2018-12-17 17:41:55', '2018-12-17 17:41:55', '0000-00-00 00:00:00'),
(141, 'fd64b295a93f21c102911c9cf', 1000, '2018-12-17 22:58:59', '2018-12-17 22:58:59', '2018-12-17 23:59:27'),
(142, '75b595bc209f2c847e6506304', 1000, '2018-12-17 23:03:05', '2018-12-17 23:03:05', '0000-00-00 00:00:00'),
(143, '63947e63dc2c728f795664b00', 1000, '2018-12-17 23:06:23', '2018-12-17 23:06:23', '2018-12-17 23:21:42'),
(144, 'bb7ad2f90feaf011d62959675', 1000, '2018-12-17 23:21:51', '2018-12-17 23:21:51', '2018-12-17 23:22:32'),
(145, '83d00bfdf334d176986f9f99d', 1000, '2018-12-17 23:59:42', '2018-12-17 23:59:42', '2018-12-18 00:00:47'),
(146, '019c246b80c7318e7ed7411ec', 1000, '2018-12-18 00:03:25', '2018-12-18 00:03:25', '0000-00-00 00:00:00'),
(147, '11aee54b1c5d635c3f9e3057a', 1000, '2018-12-18 00:42:53', '2018-12-18 00:42:53', '2018-12-18 10:57:33'),
(148, 'f383afea3223c742425194abe', 1000, '2018-12-18 02:10:14', '2018-12-18 02:10:14', '2018-12-18 02:17:05'),
(149, 'bd834ba62d9a0e6aa843af54d', 1000, '2018-12-18 02:17:22', '2018-12-18 02:17:22', '2018-12-18 02:36:48'),
(150, 'a5271d1d2232a48a7e5b485f7', 1000, '2018-12-18 02:25:56', '2018-12-18 02:25:56', '2018-12-18 02:31:56'),
(151, '2441406bb5fce14dd97c77709', 1000, '2018-12-18 02:36:50', '2018-12-18 02:36:50', '2018-12-18 02:52:43'),
(152, '196b25215b03c4a082bd45e02', 1000, '2018-12-18 02:52:46', '2018-12-18 02:52:46', '2018-12-18 02:59:30'),
(153, 'bd0aaf0b615b6c6ff79097c5a', 1000, '2018-12-18 02:56:53', '2018-12-18 02:56:53', '2018-12-18 03:57:50'),
(154, 'd408f3cba2f7ece3f67275120', 1000, '2018-12-18 02:59:32', '2018-12-18 02:59:32', '2018-12-18 03:07:03'),
(155, '3ca4f60fcc339a5de5a984ca6', 1000, '2018-12-18 03:07:27', '2018-12-18 03:07:27', '0000-00-00 00:00:00'),
(156, '1a8e7ef3646b3ca105bfba286', 1000, '2018-12-18 03:15:44', '2018-12-18 03:15:44', '0000-00-00 00:00:00'),
(157, '68611ce5cc96716e6856ca51b', 1000, '2018-12-18 03:25:08', '2018-12-18 03:25:08', '0000-00-00 00:00:00'),
(158, '07f95c71b4d68f1f9dd60feb8', 1000, '2018-12-18 03:59:06', '2018-12-18 03:59:06', '2018-12-18 04:19:46'),
(159, 'cbff31b875a6a5f6af32d21ec', 1000, '2018-12-18 04:19:55', '2018-12-18 04:19:55', '2018-12-18 04:19:57'),
(160, '677768b897610df5af83a1e36', 1000, '2018-12-18 04:20:06', '2018-12-18 04:20:06', '2018-12-18 04:22:50'),
(161, 'd327263cbe1a6502b488675bd', 1000, '2018-12-18 04:22:53', '2018-12-18 04:22:53', '2018-12-18 04:23:07'),
(162, '795b9443fc4642cdacbb9ce4b', 1000, '2018-12-18 04:23:46', '2018-12-18 04:23:46', '2018-12-18 04:24:56'),
(163, '0d6e034e903d0cbbd649b8177', 1000, '2018-12-18 04:25:29', '2018-12-18 04:25:29', '2018-12-18 04:47:06'),
(164, '4765380cf8687eeea5ee5c679', 1000, '2018-12-18 14:10:07', '2018-12-18 14:10:07', '0000-00-00 00:00:00'),
(165, '64f1113cd64a309c6959aabda', 1000, '2018-12-20 13:39:39', '2018-12-20 13:39:39', '2018-12-20 13:39:49'),
(166, '6564c884b6d8fe9e611d1495e', 1000, '2018-12-20 13:41:00', '2018-12-20 13:41:00', '0000-00-00 00:00:00'),
(167, '54f82be4f81180026af9ca663', 1000, '2021-06-06 03:35:44', '2021-06-06 03:35:44', '2021-06-06 03:37:08'),
(168, 'acad2dc837fa9ef4c90f88cd8', 1000, '2021-06-06 03:37:21', '2021-06-06 03:37:21', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `csv_users`
--

CREATE TABLE `csv_users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `name_first` varchar(255) NOT NULL,
  `name_last` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `status` tinyint(3) NOT NULL DEFAULT '1',
  `date_created` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `type` varchar(100) NOT NULL,
  `notes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `csv_users`
--

INSERT INTO `csv_users` (`id`, `name`, `name_first`, `name_last`, `email`, `pass`, `status`, `date_created`, `date_modified`, `type`, `notes`) VALUES
(1000, 'Admin User', 'Admin', 'User', 'admin', '6a204bd89f3c8348afd5c77c717a097a', 1, '2018-12-17 00:00:00', '0000-00-00 00:00:00', 'admin', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `csv_info_hotspots`
--
ALTER TABLE `csv_info_hotspots`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `csv_link_hotspots`
--
ALTER TABLE `csv_link_hotspots`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `csv_locations`
--
ALTER TABLE `csv_locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `csv_sessions`
--
ALTER TABLE `csv_sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `csv_users`
--
ALTER TABLE `csv_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `csv_info_hotspots`
--
ALTER TABLE `csv_info_hotspots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `csv_link_hotspots`
--
ALTER TABLE `csv_link_hotspots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `csv_locations`
--
ALTER TABLE `csv_locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10021;

--
-- AUTO_INCREMENT for table `csv_sessions`
--
ALTER TABLE `csv_sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT for table `csv_users`
--
ALTER TABLE `csv_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1001;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

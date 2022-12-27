-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2022 at 03:01 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web1ecomm`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(128) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `image`, `created_at`) VALUES
(1, 'Electronics', 'Electronics', 'electronics.png', '2022-12-26 07:46:34'),
(2, 'Mobile', 'mobile', 'mobile.png', '2022-12-26 07:46:59'),
(3, 'Men', 'men', 'men.png', '2022-12-26 07:47:17'),
(4, 'Women', 'women', 'women.png', '2022-12-26 07:47:32');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `sku` varchar(128) NOT NULL,
  `images` varchar(512) NOT NULL,
  `price` float(10,2) NOT NULL,
  `quantity` int(6) NOT NULL,
  `discount` int(2) NOT NULL,
  `hot` set('0','1') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `subcategory_id`, `name`, `description`, `sku`, `images`, `price`, `quantity`, `discount`, `hot`, `created_at`) VALUES
(1, 1, 1, 'asdfsdaf', 'asdfsadfsdf', 'sadfsdf', '63a9608775ba8.png', 123.00, 123, 2, '1', '2022-12-26 08:51:19'),
(2, 2, 3, 'qwe', 'sdfgdsfg', 'asdf', '63a960cf8c456.png', 123.00, 12, 2, '0', '2022-12-26 08:52:31'),
(6, 1, 1, 'asdf', 'asdf', 'asdf123', '63a962d666bc9.png', 123.00, 12, 12, '1', '2022-12-26 09:01:10');

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(128) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `category_id`, `name`, `description`, `image`, `created_at`) VALUES
(1, 1, 'TV', 'TV', 'tv.png', '2022-12-26 07:48:13'),
(2, 1, 'AC', 'AC', 'ac.png', '2022-12-26 07:48:29'),
(3, 2, 'Button Mobile', 'mobile', 'mobile.png', '2022-12-26 07:48:54'),
(4, 2, 'Smart Mobile', 'smart mobile', 'mobile2.png', '2022-12-26 07:54:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role` set('1','2','3') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$/Xo7PcwqvFEJygj2UllMZunWvPOnJ.M0LiN.FiTFpWJOjLNznEK8m', '2', '2022-12-21 07:45:31'),
(4, 'Iqbal Hossain', 'abcd@gmail.com', '$2y$10$cAZfy3BWyQACvz3aGL7gTeiy7IwhIkWNM14Edj8turit.O8SbupMW', '2', '2022-12-21 07:47:14'),
(5, 'mamun', 'mamun@gmail.com', '$2y$10$LXXoFhw/hYMjBWtToAZCSu.vidUKCuUjNu1chVWhLPTIri9iNOAa2', '2', '2022-12-21 07:47:25'),
(6, 'Ananta Kumar Das', 'anantakumar@gmail.com', '$2y$10$6WS5p9weW5tSpMY1OGbUiO9gHPQqwcXKWlC9LrnJaX2bQ.zqg9Q9.', '2', '2022-12-21 07:48:07'),
(7, 'owishi', 'ohichowdhury25@gmail.com', '$2y$10$/.ZhazhaeIz/wR5nlGptn.tWCw8K0c9MMV6dyP8h66KHe3q9z7ofq', '2', '2022-12-21 07:48:16'),
(8, 'Fatema', 'brazil@gmail.com', '$2y$10$1IhuQl/hLGcNmvxYU/ZNPO7sv4MhrGMI2kO97tA6yX.1ZnWE.Zvy6', '2', '2022-12-21 07:48:19'),
(12, 'ananta', 'abc@gmail.com', '$2y$10$ds9z.wZvpm9Ll9dNR5OmoegLrEDRdmkX0uf2/KnTyZJaYTTq/zt2u', '2', '2022-12-21 08:02:20'),
(19, 'Ridoy', 'ridoymojumder922@gmail.com', '$2y$10$lwgXBdRuF0pjDjcKvEjKLOQUsgo7KadoJGGsuVzWl6XYSorjgFnIu', '2', '2022-12-21 08:13:05'),
(21, 'Najmul', 'abcde@gmail.com', '$2y$10$ZWQ/U.oF0.h88K.M5UgPf.WzRPiOGZzYNGwPvRm0cMWBTAzNeuWkq', '2', '2022-12-21 08:13:47'),
(22, 'nurmohammad', 'nurmohammad@gmail.com', '$2y$10$hZYiGAjdf2quzCNhbwO.QuM2jH8avSq9pyu.1vnOR4qTkYjJUuRpW', '2', '2022-12-21 08:14:03'),
(23, 'sharif', 'sharif1234567th@gmail.com', '$2y$10$ONxIPD/4hvbK0RyRtWv5T.vazydG1auSUemOGdSVIHKjRlrTwyFDW', '2', '2022-12-21 08:15:20'),
(24, 'Akhi', 'akhi@gmail.com', '$2y$10$5Iatqny.DMWDJhnbrcXA6.TYlMLlU4xcfRggTp3Vb2ifJAiwiHnSC', '2', '2022-12-21 08:15:52'),
(25, 'Najmul', 'najmul@gmail.com', '$2y$10$rq.hYr8iJAKmV20ZPxtDOOgfftgb5tZaW4DuAnS2I1NQ9ZiWlxruC', '2', '2022-12-26 07:32:45'),
(26, 'Fatema', 'fatema@gmail.com', '$2y$10$cigzrjVqVyxIQvqj9JFxkeJypp1lMgP.oGZTSrJURCxTtG/GS07jC', '2', '2022-12-26 08:07:28'),
(31, 'owishi', 'owishichowdhury@gmail.com', '$2y$10$orxPkywyBQbmmdkC2DT56uPMAvZ31mEl8ScKME.88wfjqiYW5zRO2', '1', '2022-12-26 09:00:48'),
(32, 'khusnur Akther', 'adibaakhi@gmail.com', '$2y$10$Tr/Lx7ld7iMePaAwEgFM6eoKZv1rDe0j.50zod.mQUgNgQumRaK6.', '1', '2022-12-26 09:01:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sku` (`sku`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `subcategory_id` (`subcategory_id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`);

--
-- Constraints for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `subcategories_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

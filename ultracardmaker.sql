-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2024 at 11:33 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ultracardmaker`
--

-- --------------------------------------------------------

--
-- Table structure for table `all_cards`
--

CREATE TABLE `all_cards` (
  `card_id` int(255) NOT NULL,
  `card_title` varchar(255) DEFAULT NULL,
  `card_data` varchar(255) DEFAULT NULL,
  `card_img` varchar(255) DEFAULT NULL,
  `card_author` varchar(255) NOT NULL,
  `card_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `card_published` tinyint(1) NOT NULL DEFAULT 0,
  `card_likes` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `all_cards`
--

INSERT INTO `all_cards` (`card_id`, `card_title`, `card_data`, `card_img`, `card_author`, `card_created_at`, `card_published`, `card_likes`) VALUES
(1, '', 'json_cards/test_card1.json', NULL, 'lol', '2024-06-13 20:38:54', 0, 0),
(2, '', 'json_cards/test_card2.json', NULL, 'lol', '2024-06-13 20:38:55', 0, 0),
(3, '', 'json_cards/test_card3.json', NULL, 'lol', '2024-06-13 20:38:56', 0, 0),
(4, '', 'json_cards/test_card4.json', NULL, 'lol', '2024-06-13 20:38:57', 0, 0),
(5, '', 'json_cards/test_card5.json', NULL, 'lol', '2024-06-13 20:38:58', 0, 0),
(6, '', 'json_cards/test_card6.json', NULL, 'lol', '2024-06-13 20:38:59', 0, 0),
(7, 'Not YET entered', 'json_cards/test_card7.json', NULL, 'Guest User', '2024-06-13 20:47:18', 0, 0),
(8, '', 'json_cards/test_card8.json', NULL, 'Guest User', '2024-06-13 20:52:10', 0, 0),
(9, '', 'json_cards/test_card9.json', NULL, 'Guest User', '2024-06-13 20:52:31', 0, 0),
(10, 'MOKI MOKI', 'json_cards/test_card10.json', NULL, 'Guest User', '2024-06-13 21:00:49', 0, 0),
(11, 'Nekakv naslovNekakv naslovNekakv naslovNekakv naslov', 'json_cards/test_card11.json', NULL, 'lol', '2024-06-13 21:07:57', 0, 0),
(12, 'Not YET entered', 'json_cards/test_card12.json', NULL, 'Guest User', '2024-06-13 21:12:57', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `lol_cards`
--

CREATE TABLE `lol_cards` (
  `id` int(11) NOT NULL,
  `card_id` int(11) DEFAULT NULL,
  `card_like_made` enum('original_author','liked') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `account_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `pass`, `email`, `account_created`) VALUES
(1, 'lol', '$2y$10$XFNHX7./d4Aqqmqm6pVstumU7P.Su.ESAPrEe3sKnBO8P3.RwokiC', 'lol@lol.com', '2024-06-09 19:01:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `all_cards`
--
ALTER TABLE `all_cards`
  ADD PRIMARY KEY (`card_id`),
  ADD KEY `card_created_at` (`card_created_at`),
  ADD KEY `card_likes` (`card_likes`),
  ADD KEY `card_author` (`card_author`);

--
-- Indexes for table `lol_cards`
--
ALTER TABLE `lol_cards`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `card_id` (`card_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `USERNAME` (`username`),
  ADD UNIQUE KEY `EMAIL` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `all_cards`
--
ALTER TABLE `all_cards`
  MODIFY `card_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `lol_cards`
--
ALTER TABLE `lol_cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

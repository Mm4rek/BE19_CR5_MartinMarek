-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 29, 2023 at 04:21 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `be19_cr5_animal_adoption_marek`
--

-- --------------------------------------------------------

--
-- Table structure for table `animals`
--

CREATE TABLE `animals` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `size` varchar(50) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `vaccinated` tinyint(1) DEFAULT NULL,
  `breed` varchar(100) DEFAULT NULL,
  `adoption_status` enum('Adopted','Available') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `animals`
--

INSERT INTO `animals` (`id`, `name`, `photo`, `location`, `description`, `size`, `age`, `vaccinated`, `breed`, `adoption_status`) VALUES
(4, 'Rocky', '../pictures/cat-2143332_1280.jpg', 'Praterstrasse 23', 'A loyal large dog searching for a forever home.', 'Large', 6, 1, 'Labrador Retriever', 'Available'),
(5, 'Milo', '../pictures/cat-5919989_1280.jpg', 'Praterstrasse 23', 'A calm large cat seeking a quiet home.', 'Large', 9, 1, 'Maine Coon', 'Available'),
(6, 'Coco', '../pictures/chihuahua-2900362_1280.jpg', 'Praterstrasse 23', 'An energetic small dog looking for an active family.', 'Small', 1, 1, 'Chihuahua', 'Available'),
(7, 'Simba', '../pictures/cat-2048416_1280.jpg', 'Praterstrasse 23', 'A majestic large cat in need of a royal home.', 'Large', 7, 1, 'Bengal', 'Available'),
(8, 'Charlie', '../pictures/puppy-2785074_1280.jpg', 'Praterstrasse 23', 'A gentle small dog hoping to be your best friend.', 'Small', 5, 1, 'Cavalier King Charles Spaniel', 'Available'),
(9, 'Sophie', '../pictures/important-cat-5031728_1280.jpg', 'Praterstrasse 23', 'A loving large cat searching for a warm lap to curl up on.', 'Large', 11, 1, 'Persian', 'Available'),
(10, 'Bailey', '../pictures/shih-tzu-7324619_1280.jpg', 'Praterstrasse 23', 'A friendly small dog looking for a loving family.', 'Small', 4, 1, 'Shih Tzu', 'Available'),
(11, 'Max', '../pictures/cat-2120915_1280.jpg', 'Praterstrasse 23', 'A wise senior large cat seeking a peaceful home.', 'Large', 12, 1, 'Siamese', 'Adopted'),
(12, 'Lucy', 'path_to_photo_13.jpg', 'Praterstrasse 23', 'A playful senior small dog looking for a warm home.', 'Small', 10, 1, 'Jack Russell Terrier', ''),
(13, 'Leo', '../pictures/cat-2310384_1280.jpg', 'Praterstrasse 23', 'A curious senior large cat searching for a cozy spot.', 'Large', 14, 1, 'Scottish Fold', 'Available'),
(17, 'Milo', '../pictures/cat-2585836_1280.jpg', 'Praterstrasse 23', 'A calm large cat seeking a quiet home.', 'Large', 9, 1, 'Maine Coon', 'Adopted'),
(19, 'Simba', '../pictures/tabby-kitten-1517475_1280.jpg', 'Praterstrasse 23', 'A majestic large cat in need of a royal home.', 'Large', 7, 1, 'Bengal', 'Adopted'),
(21, 'Sophie', 'path_to_photo_10.jpg', 'Praterstrasse 23', 'A loving large cat searching for a warm lap to curl up on.', 'Large', 11, 1, 'Persian', ''),
(24, 'Lucy', '../pictures/animal-3331794_1280.jpg', 'Praterstrasse 23', 'A playful senior small dog looking for a warm home.', 'Small', 10, 1, 'Jack Russell Terrier', 'Available'),
(25, 'Leo', 'path_to_photo_14.jpg', 'Praterstrasse 23', 'A curious senior large cat searching for a cozy spot.', 'Large', 14, 1, 'Scottish Fold', ''),
(26, 'Buddy', '../pictures/pug-2608401_1280.jpg', 'Praterstrasse 23', 'A friendly small dog looking for a new home.', 'Small', 3, 1, 'Pug', 'Available'),
(28, 'Rocky', '../pictures/dog-3034941_1280.jpg', 'Praterstrasse 23', 'A loyal large dog searching for a forever home.', 'Large', 6, 1, 'Labrador Retriever', 'Adopted'),
(29, 'Milo', 'path_to_photo_6.jpg', 'Praterstrasse 23', 'A calm large cat seeking a quiet home.', 'Large', 9, 1, 'Maine Coon', ''),
(33, 'Sophie', 'path_to_photo_10.jpg', 'Praterstrasse 23', 'A loving large cat searching for a warm lap to curl up on.', 'Large', 11, 1, 'Persian', ''),
(35, 'Max', 'path_to_photo_12.jpg', 'Praterstrasse 23', 'A wise senior large cat seeking a peaceful home.', 'Large', 12, 1, 'Siamese', ''),
(36, 'Lucy', 'path_to_photo_13.jpg', 'Praterstrasse 23', 'A playful senior small dog looking for a warm home.', 'Small', 10, 1, 'Jack Russell Terrier', ''),
(37, 'Leo', 'path_to_photo_14.jpg', 'Praterstrasse 23', 'A curious senior large cat searching for a cozy spot.', 'Large', 14, 1, 'Scottish Fold', '');

-- --------------------------------------------------------

--
-- Table structure for table `pet_adoption`
--

CREATE TABLE `pet_adoption` (
  `adoption_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `pet_id` int(11) DEFAULT NULL,
  `adoption_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `status` varchar(4) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `phone_number`, `address`, `picture`, `password`, `date_of_birth`, `status`) VALUES
(1, 'Martin', 'Marek', 'martin@email.com', '', '', 'avatar.png', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', '1998-01-27', 'admi'),
(6, 'ramona', 'pipan', 'ramona@email.com', '068110744995', 'Landstraße Hauptstraße 81', 'avatar.png', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', '2000-02-01', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pet_adoption`
--
ALTER TABLE `pet_adoption`
  ADD PRIMARY KEY (`adoption_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `pet_id` (`pet_id`);

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
-- AUTO_INCREMENT for table `animals`
--
ALTER TABLE `animals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `pet_adoption`
--
ALTER TABLE `pet_adoption`
  MODIFY `adoption_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pet_adoption`
--
ALTER TABLE `pet_adoption`
  ADD CONSTRAINT `pet_adoption_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `pet_adoption_ibfk_2` FOREIGN KEY (`pet_id`) REFERENCES `animals` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

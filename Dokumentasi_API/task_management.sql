-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 31 Okt 2022 pada 12.25
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `task_management`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `start_date` date NOT NULL DEFAULT current_timestamp(),
  `finish_date` date NOT NULL,
  `status` enum('New','On progress','Finish') DEFAULT NULL,
  `doc_url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tasks`
--

INSERT INTO `tasks` (`id`, `category_id`, `title`, `description`, `start_date`, `finish_date`, `status`, `doc_url`) VALUES
(1, 1, 'Using loops in PHP programs', 'Create a loop program to complete a case study looking for odd and even numbers, then add up the total odd and even numbers with the input parameter being n and the loop starting from 1, for example, n : 10, it can be concluded that the odd number is 1,3, 5,7,9 and the even numbers are 2,4,6,8. So the total of each odd number is 25 and the even number is 20 .', '2022-10-27', '2022-10-29', 'Finish', 'Odd_Even_UsingLoop.php'),
(2, 2, 'Finding the area of Mr. udin\'s garden', 'Mr. Udin has a rectangular garden. The length of the garden is 1 3/4 times the width of the garden. The width of Mr. Udin\'s garden is 20 m. What is the area of ​​Mr. Udin\'s garden​', '2022-10-28', '2022-10-31', 'On progress', 'Finding the area of Mr. udin\'s garden.docx'),
(14, 6, 'Find the mass of the object ', 'A certain force produces an acceleration of 5m/s2 on a standard object. If the same force is applied to the second object, it produces an acceleration of 15m/s2 . what is the mass of the second object, and what is the magnitude of the force?', '2022-10-28', '2022-11-01', 'New', 'Find the mass of the object.docx'),
(15, 3, 'Final Exam History', 'Doing all the questions that have been tested in history subjects', '2022-10-29', '2022-10-30', 'Finish', 'Final Exam History.docx'),
(17, 1, 'Simple Array Sum', 'Find the sum of array', '2022-10-30', '2022-10-31', 'New', 'Simple_Array_Sum1.docx'),
(19, 7, 'Biology assigment 2', 'Answer questions about biology ', '2022-10-30', '2022-11-04', 'Finish', 'Biology_Assignment_2.docx');

-- --------------------------------------------------------

--
-- Struktur dari tabel `task_categories`
--

CREATE TABLE `task_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `task_categories`
--

INSERT INTO `task_categories` (`id`, `name`) VALUES
(1, 'Programming'),
(2, 'Math'),
(3, 'History'),
(4, 'Geography'),
(5, 'Art'),
(6, 'Physics'),
(7, 'Biology');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_kategori` (`category_id`);

--
-- Indeks untuk tabel `task_categories`
--
ALTER TABLE `task_categories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `task_categories`
--
ALTER TABLE `task_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `fk_kategori` FOREIGN KEY (`category_id`) REFERENCES `task_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

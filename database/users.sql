-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 13, 2023 at 08:09 AM
-- Server version: 10.5.20-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id20966934_pokebuy`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(300) NOT NULL,
  `isAdmin` tinyint(1) DEFAULT 0,
  `hasFinishedTutorial` tinyint(1) NOT NULL DEFAULT 0,
  `stamina` float NOT NULL DEFAULT 100,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `isAdmin`, `hasFinishedTutorial`, `stamina`, `last_update`) VALUES
(1, 'EldinMesic', 'eldin.mesic125@gmail.com', '$2y$10$84hiJBAn5mYBG019qUM2beMKz8njkI6oVOSmN7fFW..vbJPULzB4O', 1, 1, 0.1467, '2023-06-26 15:53:41'),
(2, 'EldinMesic1', 'eldin.mesic126@gmail.com', '$2y$10$/uwQqj2k7GYhgzVt9QNGPef.f6xf39nrZ/GdFWaDHFLKxX8lo85b2', 0, 0, 100, '2023-06-22 13:56:48'),
(3, 'Eldin2', 'eldin.mesic127@gmail.com', '$2y$10$S1FqN1c8989HNZJFs5arpenHdSfLazAWpfg.Vkr0ByP3Jssu4Tx6y', 0, 1, 100, '2023-06-23 19:43:06'),
(4, 'Elmas_01', 'elmas123@gmail.com', '$2y$10$R7Ycb78SjH1b9NV5fH.1MepzpQbVH3M1s7YQ.I5jxQomRE0qzqX0O', 0, 1, 100, '2023-06-23 20:01:29'),
(5, 'JetLo', 'licth122@gmail.com', '$2y$10$LeislSDvdHXay7wPsowkgOzfuK1v1j6CKptRtT86KCsM.sLI/DhPe', 0, 1, 25.08, '2023-06-26 15:51:19'),
(6, 'petarpeki12', 'markodub123@gmail.com', '$2y$10$O3ahwvZNaHdBa1cmj40aH.op7S72xaIpZ.XHvAT.4qeC7WNrISaYu', 0, 1, 0.324433, '2023-07-10 21:53:30'),
(7, 'lukalesic', 'slay@gmail.com', '$2y$10$G.nKRm1cK1Hu5XmHNAjFQOyZhbaFZiVi.UMJTCjrLZXwb4awe90Qi', 0, 1, 100, '2023-06-26 17:44:47'),
(8, 'Eldin4', 'eldin4@gmail.com', '$2y$10$WpxsT4Ap4osNoHlJfDro9.bxhoTF58UVFW80x3AwZjCG/LdJgLdmC', 0, 1, 94.0875, '2023-06-26 18:46:24'),
(9, 'yes', 'yesyes@yes.com', '$2y$10$QzVzgW.zvvNkzoikpiTzI.SLr1NZNap0Nr/qFX/t5UYOOZFKRbs3y', 0, 1, 7.1791, '2023-06-26 21:40:48'),
(10, 'dariovidovic', 'dario@gmail.com', '$2y$10$xLe8lKYnEZ/i3/EV6gJ4seWKKdcuHpdrQB8An7pIg3e3g579hWU2i', 0, 1, 5.3915, '2023-06-26 18:36:05'),
(11, 'iBee', 'aha@a', '$2y$10$UE8BN/FFJLAkBYFAA4MXDO0xhKkgtGXrsA4zVOkMU9aN.IZvLeokC', 0, 1, 0.2792, '2023-06-26 18:50:30'),
(12, 'zahathewolf', 'emilijano1998@gmail.com', '$2y$10$gSyvzYo3wvBjJGfI5dVa4OJ2pyVeQAY3YdKVJrlwEeRQ6wE0qtwrK', 0, 1, 0.408367, '2023-06-26 20:20:02'),
(13, 'Ime Prezimenovic', 'ime.prezime@gmail.com', '$2y$10$PwnpyRt0OYYwIGUwQHcX9O.I3wMIMZF8oMw4HO5bAeJc4d3VW5.Dq', 0, 1, 0.441633, '2023-06-26 20:42:14'),
(14, 'warix3', 'toni.pejic98@gmail.com', '$2y$10$edC7lpesIIu7ohN75Ua3ielEFuYMDFhreUBu0RxewCCFxAh7lbAn6', 0, 1, 20.0458, '2023-06-26 21:01:43'),
(15, 'Lignjoslav.je.preminuo', 'mislio.sam.da.je.umro@bikinidno.com', '$2y$10$2DTLgnMElM5FXe4NREeXmelWVTZOPvDCR12GQhSqn5rsgUnuaVd4C', 0, 1, 200, '2023-06-26 22:08:04'),
(16, 'Wenter', 'Eldin@luzer.com', '$2y$10$idfv0TLtRPDVifuqJ2p7GO8rtJPSGka0ZIyAFCx1lYFY9O60CvbFa', 0, 1, 0.116667, '2023-07-04 12:36:44'),
(17, 'elmas', 'elmas@gmail.com', '$2y$10$s6cAICO1QsBQL6pSnMhNouZyGssMEZI9sBh7Eiq1MEnKjLJF2M1iG', 1, 1, 15.5916, '2023-06-30 22:17:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

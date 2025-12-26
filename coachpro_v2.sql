-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 26, 2025 at 10:29 AM
-- Server version: 8.0.44
-- PHP Version: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coachpro_v2`
--

-- --------------------------------------------------------

--
-- Table structure for table `coaches`
--

CREATE TABLE `coaches` (
  `id_coach` int NOT NULL,
  `id_user` int DEFAULT NULL,
  `specialite` varchar(150) DEFAULT NULL,
  `experiences` text,
  `bio` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `coaches`
--

INSERT INTO `coaches` (`id_coach`, `id_user`, `specialite`, `experiences`, `bio`) VALUES
(1, 56, 'mmm', 'mmm', 'mmm'),
(2, 57, 'test2', 'tes3', 'test4'),
(3, 59, 'test33', '33', 'mm33'),
(4, 60, 'test33', '33', 'mm33'),
(5, NULL, NULL, NULL, NULL),
(6, NULL, NULL, NULL, NULL),
(7, NULL, NULL, NULL, NULL),
(8, NULL, NULL, NULL, NULL),
(9, NULL, NULL, NULL, NULL),
(10, 72, 'ooooooo', 'pppppppppp', 'mmmmmmm'),
(11, 73, 'Delectus enim bland', 'ooo', 'ooo'),
(12, 75, 'hello', 'hello', 'test one');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id_reservation` int NOT NULL,
  `date_reservation` date DEFAULT NULL,
  `heure_debut` time DEFAULT NULL,
  `heure_fin` time DEFAULT NULL,
  `id_coach` int DEFAULT NULL,
  `id_sportif` int DEFAULT NULL,
  `status` enum('en_attente','accepter','refuser') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id_reservation`, `date_reservation`, `heure_debut`, `heure_fin`, `id_coach`, `id_sportif`, `status`) VALUES
(3, '2025-12-26', '06:39:00', '07:40:00', 11, 76, 'en_attente'),
(4, '2025-12-26', '06:39:00', '07:40:00', 11, 76, 'en_attente'),
(5, '2025-12-26', '06:39:00', '07:40:00', 11, 76, 'en_attente'),
(6, '2025-12-26', '06:39:00', '07:40:00', 11, 76, 'en_attente');

-- --------------------------------------------------------

--
-- Table structure for table `seances`
--

CREATE TABLE `seances` (
  `id_seances` int NOT NULL,
  `date_seance` date DEFAULT NULL,
  `heure_debut` time DEFAULT NULL,
  `heure_fin` time DEFAULT NULL,
  `status` enum('libre','reserver') NOT NULL,
  `id_coach` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `seances`
--

INSERT INTO `seances` (`id_seances`, `date_seance`, `heure_debut`, `heure_fin`, `status`, `id_coach`) VALUES
(17, '2025-12-25', '16:34:00', '19:37:00', 'reserver', 11),
(18, '2025-12-25', '20:54:00', '21:35:00', 'reserver', 12),
(19, '2025-12-25', '02:05:00', '03:06:00', 'reserver', 11),
(20, '2025-12-26', '01:31:00', '04:26:00', 'reserver', 11),
(21, '2025-12-26', '06:39:00', '07:40:00', 'reserver', 11),
(22, '2025-12-30', '15:17:00', '16:18:00', 'libre', 11),
(23, '2025-12-26', '13:02:00', '15:04:00', 'libre', 11);

-- --------------------------------------------------------

--
-- Table structure for table `sportif`
--

CREATE TABLE `sportif` (
  `id_sportif` int NOT NULL,
  `nom` varchar(20) DEFAULT NULL,
  `prenom` varchar(20) DEFAULT NULL,
  `id_user` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sportif`
--

INSERT INTO `sportif` (`id_sportif`, `nom`, `prenom`, `id_user`) VALUES
(76, NULL, NULL, NULL),
(77, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int NOT NULL,
  `nom` varchar(20) DEFAULT NULL,
  `prenom` varchar(20) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `mot_de_passe` varchar(255) DEFAULT NULL,
  `role` enum('coach','sportif') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nom`, `prenom`, `email`, `mot_de_passe`, `role`) VALUES
(56, 'Illuuasi', 'Omm', 'jysibojug@mailinator.com', '$2y$10$Jqktpffwg6MojijzDEcPh.ko3Wy3IrB2OtqIfwgjMm3NiCD/P.F0W', 'coach'),
(57, 'kezo', 'salim', 'salim@gmail.com', '$2y$10$.n7yWYGxjOCDaCLR0e0OA.spzBK19ivLrMwcQsRYeTvp08B36T5CK', 'coach'),
(58, 'eloua', 'mmm', 'mpp@gmail.com', '$2y$10$4cToJESviEOKEXS5B1SQAeR./ToThQvQ43rVxrbGWTX3vIl/HuMYq', 'sportif'),
(59, 'test', 'mari', 'mari@gm.cc', '$2y$10$t8HTMmdVwgf/eLo6oEgyxuPM1mNiWzD9HYYL17yRxWbbJP3Z2VRnG', 'coach'),
(60, 'test', 'mari', 'mari@gm.cc', '$2y$10$lpGkfDkuBmUuZfGWtLNLle.2Jd9vTi4iYgyZfHDclOlezA38kwW42', 'coach'),
(61, 'Est', 'Qmm', 'ppp@pp.com', '$2y$10$rzOViWBsA4ON9bd0dUn78eFFsuzIDUjCUZIYllxWJhuA5LhFP6YIO', 'sportif'),
(62, 'Etmm', 'mmm', 'mm@ppo.com', '$2y$10$ttm6tAN2/dbMiBq9b10E.eSHOje3fTH2K0OMx9BUJ8MMpv5mP0u1S', 'sportif'),
(63, 'Etmm', 'mmm', 'mm@ppo.com', '$2y$10$ziB9SVjMs03X6NZNeowMz.2CS6.XvOHckbo6m.iCDQjRxPk6mHhrm', 'sportif'),
(64, 'Etmm', 'mmm', 'mm@ppo.com', '$2y$10$ePemYrx8JbSpN0wmd7v/beE6v4ZWZF1CM2Mv8eqB4xWHmmsK8Y78u', 'sportif'),
(65, 'azziz', 'mehdi', 'mhd@gmail.com', '$2y$10$J2H8L7ZvJ6L/Tsb52LW0s./mzJlZYxYk5J45BJb0Od903lNkUlb/W', 'sportif'),
(66, 'nulla', 'Vel', 'oop@opp.com', '$2y$10$eqIJ6CRHuo7df4dz42WQmOeQRAdyMDV2DQBqBsbE0Jk29uxXEfEwe', 'sportif'),
(67, 'Et', 'Aperia', 'pp@mm.com', '$2y$10$8ARLZh8QsL.ffd4CWtxq0e/SGf.NvHeKx.w4Zk7aujZ88tt.ja0N.', 'coach'),
(68, 'Et', 'Aperia', 'pp@mm.com', '$2y$10$23cFRQa2M0yVyeK21J/L8ehnDG43By8vwA8RnG.tA2aJLV.yrT7gq', 'coach'),
(69, 'Laboruullamcoroi', 'Dignissimos recusand', 'gefibo@mailinator.com', '$2y$10$CMKMoaLYNFXhPzmpdaNgBOsT8vhR4WSqUBbjkxaXXo8XdX4uQ8DhG', 'coach'),
(70, 'Laboruullamcoroi', 'Dignissimos recusand', 'gefibo@mailinator.com', '$2y$10$n2aRZbgvUgc5BrABnDs1rOii8eRzbzTBtVZSZ0LppXol4gTni6gfS', 'coach'),
(71, 'Ad unde voluptates e', 'Laborum officia ipsa', 'cubucyhipa@mailinator.com', '$2y$10$6.rjihxs3F4uuHH/0rKFzOBH7RwH5QJb1ov1mTbGJlCYoFURIPNtW', 'coach'),
(72, 'Molesti', 'Deleni', 'kotosoj@mailinator.com', '$2y$10$uwoUOGhcPFZc5bSj27SJu.btiuAay.ECYX5LDyKbwKOMSi6s7d6l6', 'coach'),
(73, 'Eveni', 'Corpori', 'giro@htp.com', '$2y$10$HbVNH9iynB0O6m7J9xhvXuio4D5L9Ej1y5BXiVAq9qtfZZaVNzYA.', 'coach'),
(74, 'chakour', 'ahmed', 'ahmed@gg.com', '$2y$10$qQWdfAieP3ys97NRlTB5Ru.zf3sOyJIP6McssL5sr53rXMVF.Rz4O', 'sportif'),
(75, 'dalina', 'sara', 'sara@gg.com', '$2y$10$XOgOBk52qdmNYBsDoJIrJecKTfkTrge3VrnBzz2l774NIwqnpUjG.', 'coach'),
(76, 'asaala', 'sobhi', 'sobhi@mailinator.com', '$2y$10$.BFv0dPF8pUpdpFvtFFdPO8VQbkB2lqhDuGJVp6osqiSRZEj652/u', 'sportif'),
(77, 'salim', 'hamid', 'hmd@gmail.com', '$2y$10$HANF74Yrk1WTdCmHHfjtfeWJh7sL/4Ay77D3PGHij0OhWauA54S1a', 'sportif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coaches`
--
ALTER TABLE `coaches`
  ADD PRIMARY KEY (`id_coach`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id_reservation`),
  ADD KEY `id_coach` (`id_coach`),
  ADD KEY `id_sportif` (`id_sportif`);

--
-- Indexes for table `seances`
--
ALTER TABLE `seances`
  ADD PRIMARY KEY (`id_seances`),
  ADD KEY `id_coach` (`id_coach`);

--
-- Indexes for table `sportif`
--
ALTER TABLE `sportif`
  ADD PRIMARY KEY (`id_sportif`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coaches`
--
ALTER TABLE `coaches`
  MODIFY `id_coach` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id_reservation` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `seances`
--
ALTER TABLE `seances`
  MODIFY `id_seances` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `sportif`
--
ALTER TABLE `sportif`
  MODIFY `id_sportif` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `coaches`
--
ALTER TABLE `coaches`
  ADD CONSTRAINT `coaches_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`id_coach`) REFERENCES `coaches` (`id_coach`),
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`id_sportif`) REFERENCES `sportif` (`id_sportif`);

--
-- Constraints for table `seances`
--
ALTER TABLE `seances`
  ADD CONSTRAINT `seances_ibfk_1` FOREIGN KEY (`id_coach`) REFERENCES `coaches` (`id_coach`);

--
-- Constraints for table `sportif`
--
ALTER TABLE `sportif`
  ADD CONSTRAINT `sportif_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

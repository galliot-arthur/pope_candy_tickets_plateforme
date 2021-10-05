-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 05 oct. 2021 à 08:45
-- Version du serveur :  8.0.26-0ubuntu0.20.04.2
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `pop_candy`
--

-- --------------------------------------------------------

--
-- Structure de la table `artists`
--

DROP TABLE IF EXISTS `artists`;
CREATE TABLE IF NOT EXISTS `artists` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `biography` text NOT NULL,
  `website` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `website` (`website`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `artists`
--

INSERT INTO `artists` (`id`, `name`, `biography`, `website`) VALUES
(1, 'David', 'le roi David, chantre de l\'Eternel.', 'https://fr.wikipedia.org/wiki/David_(roi_d%27Isra%C3%ABl)'),
(2, 'Magdarline', 'chantre gospel', 'magda.fr');

-- --------------------------------------------------------

--
-- Structure de la table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
CREATE TABLE IF NOT EXISTS `bookings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ref_id` int NOT NULL,
  `ref` varchar(50) NOT NULL,
  `id_user` int NOT NULL,
  `type` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `candy_show`
--

DROP TABLE IF EXISTS `candy_show`;
CREATE TABLE IF NOT EXISTS `candy_show` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `venue` int NOT NULL,
  `first_part` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `first_part_website` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `price` int NOT NULL,
  `show_start` datetime NOT NULL,
  `show_end` datetime NOT NULL,
  `sales_on` datetime NOT NULL,
  `sold_out` tinyint(1) DEFAULT NULL,
  `sales` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `first_part` (`first_part`),
  KEY `first_part_website` (`first_part_website`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `candy_show`
--

INSERT INTO `candy_show` (`id`, `title`, `venue`, `first_part`, `first_part_website`, `price`, `show_start`, `show_end`, `sales_on`, `sold_out`, `sales`) VALUES
(5, 'j\'y arriverai', 26, NULL, NULL, 100, '2022-03-11 00:00:00', '2023-07-14 00:00:00', '2021-12-10 00:00:00', 1, 25),
(6, 'j\'y arriverai', 26, NULL, NULL, 100, '2022-03-11 00:00:00', '2023-07-14 00:00:00', '2021-12-10 00:00:00', 1, 25);

-- --------------------------------------------------------

--
-- Structure de la table `prices`
--

DROP TABLE IF EXISTS `prices`;
CREATE TABLE IF NOT EXISTS `prices` (
  `id` int NOT NULL AUTO_INCREMENT,
  `venue_id` int NOT NULL,
  `price` int NOT NULL,
  `ticket_type` int DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `venue_id` (`venue_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `prices`
--

INSERT INTO `prices` (`id`, `venue_id`, `price`, `ticket_type`) VALUES
(2, 3, 106, 7),
(3, 2, 42, 6),
(5, 3, 65, 85);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `adress` varchar(255) NOT NULL,
  `age` int NOT NULL,
  `acces_right` int DEFAULT NULL,
  `admin` json DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `firstname`, `adress`, `age`, `acces_right`, `admin`) VALUES
(1, 'Decilien', 'roosevelt.decilien@yahoo.fr', '$2y$10$ZdwEadnzX1A/V9cALp.Rhu7l1uVAtMM.SE6Bl6G2EsI53GRUQqsCG', 'Magdarline', 'poissy', 32, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `venues`
--

DROP TABLE IF EXISTS `venues`;
CREATE TABLE IF NOT EXISTS `venues` (
  `id` int NOT NULL AUTO_INCREMENT,
  `town` varchar(200) NOT NULL,
  `disabled_acces` tinyint(1) NOT NULL,
  `adress` varchar(250) NOT NULL,
  `capacity` int NOT NULL,
  `vip_available` int DEFAULT NULL,
  `prices` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `town` (`town`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `candy_show`
--
ALTER TABLE `candy_show`
  ADD CONSTRAINT `candy_show_ibfk_1` FOREIGN KEY (`first_part_website`) REFERENCES `artists` (`website`);

--
-- Contraintes pour la table `venues`
--
ALTER TABLE `venues`
  ADD CONSTRAINT `venues_ibfk_1` FOREIGN KEY (`id`) REFERENCES `prices` (`venue_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
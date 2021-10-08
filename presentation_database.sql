-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : ven. 08 oct. 2021 à 13:30
-- Version du serveur : 5.7.33
-- Version de PHP : 7.4.19

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

CREATE TABLE `artists` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `biography` text NOT NULL,
  `website` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `artists`
--

INSERT INTO `artists` (`id`, `name`, `biography`, `website`) VALUES
(1, 'Skrillex', 'Skrillex, de son vrai nom Sonny John Moore, né le 15 janvier 1988 à Los Angeles, est un DJ et compositeur américain de musique électronique. Après avoir grandi au nord de la Californie, Sonny Moore rejoint le groupe de post-hardcore From First to Last en tant que chanteur en 2004 et y enregistre deux albums studio (Dear Diary, My Teen Angst Has a Body Count en 2004, et Heroine en 2006) avant de se lancer dans une carrière musicale en solo3,4. Il lance sa première tournée en solo la même année. Aux côtés d\'une nouvelle formation de groupe, Sonny Moore joue à l\'Alternative Press Tour en soutien à des groupes comme All Time Low et The Rocket Summer et apparaît sur la couverture des « 100 groupes à connaître » du magazine Alternative Press5. \r\n            ', 'https://fr.wikipedia.org/wiki/Skrillex'),
(2, 'Diam\'s', '            Mélanie Georgiades, dite Diam\'s, est une rappeuse, chanteuse et auteure-compositrice-interprète française, née le 25 juillet 1980 à Nicosie (Chypre).\r\n\r\nEn 1994, Diam\'s monte un groupe avec un ami, qui l\'initie à la composition. En 1999, elle sort l’album Premier Mandat. Elle sort en 2003 son deuxième album, Brut de femme, qui est rapidement certifié disque d\'or ; elle remporte une Victoire de la musique pour le meilleur album rap de l\'année 2004. Elle réalise en 2006 l\'album Dans ma bulle, qui contient le single à succès La Boulette. Elle reçoit un disque d\'or pour La Boulette, ainsi qu\'un disque de platine. Elle se voit récompensée d\'un disque de diamant, en 2007, pour l\'album Dans ma bulle. Son quatrième album, SOS, sort en 2009.\r\n\r\nAprès sa conversion à l\'islam, elle met un terme à sa carrière artistique et s\'affiche avec le jilbab. Elle publie Autobiographie en 2012, puis Mélanie, française et musulmane, en 2015. \r\n            ', 'https://fr.wikipedia.org/wiki/Diam%27s'),
(4, 'David Guetta', 'David Guetta, nom de scène de Pierre David Guetta, est un DJ, compositeur, producteur français né le 7 novembre 1967 à Paris. Il débute adolescent avant de se professionnaliser juste avant la majorité1. Il se fait connaître au début de sa carrière comme une figure des nuits parisiennes en faisant ses premières armes dans divers lieux parisiens vers la fin des années 1980. Par la suite, il crée ses propres soirées à Ibiza2.  Dès 2007, il acquiert une reconnaissance internationale avec ses albums Pop Life et One Love. Dès lors, plusieurs de ses titres comme When Love Takes Over, Sexy Bitch, ou Gettin\' Over You se classent en tête des ventes à travers le monde3. Depuis, sa renommée ne cesse de croitre, démontrée par ses records de ventes, sa capacité à remplir les plus grands lieux lors de ses prestations ou par son nombre d\'abonnés sur les réseaux sociaux. Entré dans le classement en 2005, il se voit d\'ailleurs élu six ans plus tard « DJ le plus populaire du monde » par le magazine DJ Mag. ', 'https://fr.wikipedia.org/wiki/David_Guetta'),
(5, 'Mylène Farmer', 'Mylène Gautier, dite Mylène Farmer, est une auteure-compositrice-interprète, productrice et actrice franco-canadienne, née le 12 septembre 1961 à Pierrefonds au Québec (Canada)3,4.  Révélée en 1984 avec le titre Maman a tort, elle connaît au fil des années un succès considérable dans la plupart des pays francophones et dans les pays d\'Europe de l’Est5,6,7. Apparaissant rarement dans les médias et refusant de communiquer sur sa vie privée, elle a construit avec Laurent Boutonnat un univers musical singulier, notamment à travers ses clips ambitieux et ses concerts spectaculaires8,9, ainsi qu\'avec ses textes dans lesquels abondent doubles sens10, allitérations et références littéraires ou picturales11.  Mylène Farmer est la chanteuse française qui a vendu le plus de disques depuis les années 198012,13,14 (plus de 30 millions13,15,16). Elle est également l\'artiste ayant classé le plus de titres à la 1re place du Top 50 (21 chansons no 1)17 ainsi que dans le Top 10 (58 titres)18. ', 'https://fr.wikipedia.org/wiki/Myl%C3%A8ne_Farmer'),
(6, 'POPE CANDY', 'Pop Smoke, de son vrai nom Bashar Barakah Jackson, né le 20 juillet 1999 à Brooklyn (New York) et mort assassiné le 19 février 2020 à Los Angeles (Californie) est un rappeur et auteur-compositeur-interprète américain.  La carrière de Pop Smoke décolle avec la sortie de son single Welcome to the Party extrait de sa première mixtape intitulée Meet the Woo sortie le 26 juillet 2019. Sa deuxième mixtape Meet the Woo 2 sort quant à elle 7 mois plus tard le 7 février 2020.  Pop Smoke est tué à l\'âge de 20 ans après avoir reçu plusieurs balles lors d\'une attaque à main armée dans sa résidence à Hollywood Hills. L\'album Shoot For The Stars Aim For The Moon sort 5 mois après sa mort. ', 'https://fr.wikipedia.org/wiki/Pop_Smoke');

-- --------------------------------------------------------

--
-- Structure de la table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `ref_id` int(11) DEFAULT NULL,
  `ref` varchar(50) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `bookings`
--

INSERT INTO `bookings` (`id`, `ref_id`, `ref`, `id_user`, `type`) VALUES
(9, 6, 'Paris @ AccorHotels Arena', 3, 1),
(10, 6, 'Paris @ AccorHotels Arena', 3, 1),
(11, 6, 'Paris @ AccorHotels Arena', 3, 0),
(12, 8, 'Grenoble @ La Belle Electrique', 3, 0),
(13, 8, 'Grenoble @ La Belle Electrique', 3, 1),
(14, 8, 'Grenoble @ La Belle Electrique', 3, 0),
(15, 7, 'Grenoble @ La Belle Electrique', 3, 0),
(16, 7, 'Grenoble @ La Belle Electrique', 3, 1),
(17, 7, 'Grenoble @ La Belle Electrique', 3, 0),
(18, 9, 'Grenoble @ La Belle Electrique', 6, 0),
(19, 9, 'Grenoble @ La Belle Electrique', 6, 1),
(20, 9, 'Grenoble @ La Belle Electrique', 6, 0),
(21, 9, 'Grenoble @ La Belle Electrique', 6, 0),
(22, 9, 'Grenoble @ La Belle Electrique', 6, 1),
(23, 9, 'Grenoble @ La Belle Electrique', 6, 0),
(24, 9, 'Grenoble @ La Belle Electrique', 6, 0),
(25, 9, 'Grenoble @ La Belle Electrique', 6, 1),
(26, 9, 'Grenoble @ La Belle Electrique', 6, 0),
(27, 7, 'Grenoble @ La Belle Electrique', 6, 0),
(28, 7, 'Grenoble @ La Belle Electrique', 6, 1),
(29, 7, 'Grenoble @ La Belle Electrique', 6, 0),
(30, 7, 'Grenoble @ La Belle Electrique', 6, 0),
(31, 7, 'Grenoble @ La Belle Electrique', 6, 1),
(32, 7, 'Grenoble @ La Belle Electrique', 6, 0),
(33, 8, 'Grenoble @ La Belle Electrique', 6, 0),
(34, 8, 'Grenoble @ La Belle Electrique', 6, 1),
(35, 8, 'Grenoble @ La Belle Electrique', 6, 0),
(36, 8, 'Grenoble @ La Belle Electrique', 6, 0),
(37, 8, 'Grenoble @ La Belle Electrique', 6, 1),
(38, 8, 'Grenoble @ La Belle Electrique', 6, 0),
(39, 9, 'Grenoble @ La Belle Electrique', 6, 0),
(40, 9, 'Grenoble @ La Belle Electrique', 6, 1),
(41, 9, 'Grenoble @ La Belle Electrique', 6, 0),
(42, 9, 'Grenoble @ La Belle Electrique', 6, 0),
(43, 9, 'Grenoble @ La Belle Electrique', 6, 1),
(44, 9, 'Grenoble @ La Belle Electrique', 6, 0),
(45, 9, 'Toulouse @ Le Bikini', 3, 1),
(46, 9, 'Toulouse @ Le Bikini', 3, 1),
(47, 9, 'Toulouse @ Le Bikini', 3, 1),
(48, 7, 'Grenoble @ La Belle Electrique', 3, 0),
(49, 7, 'Grenoble @ La Belle Electrique', 3, 1),
(50, 7, 'Grenoble @ La Belle Electrique', 3, 2),
(51, 7, 'Grenoble @ La Belle Electrique', 3, 0),
(52, 7, 'Grenoble @ La Belle Electrique', 3, 0),
(53, 7, 'Grenoble @ La Belle Electrique', 3, 1),
(54, 7, 'Grenoble @ La Belle Electrique', 3, 1),
(55, 7, 'Grenoble @ La Belle Electrique', 3, 0),
(56, 7, 'Grenoble @ La Belle Electrique', 3, 1),
(57, 7, 'Grenoble @ La Belle Electrique', 3, 0),
(58, 7, 'Grenoble @ La Belle Electrique', 3, 1),
(59, 7, 'Grenoble @ La Belle Electrique', 3, 0),
(60, 7, 'Grenoble @ La Belle Electrique', 3, 1),
(61, 7, 'Grenoble @ La Belle Electrique', 3, 0),
(62, 7, 'Grenoble @ La Belle Electrique', 3, 0),
(63, 7, 'Grenoble @ La Belle Electrique', 3, 0),
(64, 7, 'Grenoble @ La Belle Electrique', 3, 0),
(65, 7, 'Grenoble @ La Belle Electrique', 3, 1),
(66, 7, 'Grenoble @ La Belle Electrique', 3, 0),
(67, 7, 'Grenoble @ La Belle Electrique', 3, 0),
(68, 7, 'Grenoble @ La Belle Electrique', 3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `candy_show`
--

CREATE TABLE `candy_show` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `venue` int(11) NOT NULL,
  `first_part` varchar(255) DEFAULT NULL,
  `first_part_website` varchar(255) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `show_start` datetime NOT NULL,
  `show_end` datetime NOT NULL,
  `sales_on` datetime NOT NULL,
  `sold_out` tinyint(1) DEFAULT NULL,
  `sales` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `candy_show`
--

INSERT INTO `candy_show` (`id`, `title`, `venue`, `first_part`, `first_part_website`, `price`, `show_start`, `show_end`, `sales_on`, `sold_out`, `sales`) VALUES
(6, 'Paris @ AccorHotels Arena', 3, '2', NULL, 100, '2022-04-09 21:30:00', '2022-04-09 00:30:00', '2021-12-11 00:00:00', 1, 25),
(7, 'Grenoble @ La Belle Electrique', 10, '4', NULL, 60, '2021-10-27 21:00:00', '2021-10-27 23:30:00', '2021-10-07 00:00:00', NULL, 27),
(8, 'Nice @ Palais Nikaïa', 12, '5', NULL, 95, '2022-08-05 20:30:00', '2022-08-05 23:30:00', '2021-10-25 00:00:00', NULL, 6),
(9, 'Toulouse @ Le Bikini', 11, '1', NULL, 60, '2023-04-29 21:00:00', '2023-04-29 23:30:00', '2021-12-25 00:00:00', NULL, 11),
(10, 'Marseille @ Stade Orange Vélodrome', 14, '2', NULL, 70, '2022-04-02 21:30:00', '2022-04-02 00:30:00', '2021-11-20 00:00:00', NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `alt` varchar(255) NOT NULL,
  `context` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `prices`
--

CREATE TABLE `prices` (
  `id` int(11) NOT NULL,
  `venue_id` int(11) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `ticket_type` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `prices`
--

INSERT INTO `prices` (`id`, `venue_id`, `price`, `ticket_type`) VALUES
(2, 11, 8, 1),
(3, 2, 5, 1),
(6, 2, 0, 0),
(7, 3, 0, 0),
(8, 10, 0, 0),
(9, 11, 0, 0),
(10, 12, 0, 0),
(11, 3, 10, 1),
(12, 10, 6, 1),
(13, 10, 10, 2),
(14, 14, 20, 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `adress` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `acces_right` int(11) DEFAULT NULL,
  `admin` json DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `firstname`, `adress`, `age`, `acces_right`, `admin`) VALUES
(1, 'Decilien', 'roosevelt.decilien@yahoo.fr', '$2y$10$ZdwEadnzX1A/V9cALp.Rhu7l1uVAtMM.SE6Bl6G2EsI53GRUQqsCG', 'Magdarline', 'poissy', 32, NULL, NULL),
(2, 'Morin', 'morino@edgardino.com', '$2y$10$NZo97h6HvN41lSdTL0ih7O3cfuICkBql02UlQ.xehCauPlMPDNaOC', 'Edgard', 'sdsd', 107, NULL, NULL),
(3, 'Bernard', 'tapis@tuvasnousmanquer.fr', '$2y$10$xmJNnCKY8hDKBhnOlyOSnejZWWJt/pWGGzp/N0BSXtMC/lLPBfNZW', 'Tapis', 'Paradis', 78, NULL, '1'),
(4, 'Frechon', 'frais@choin.org', '$2y$10$WLFjEao.NSMa2W.dC894Vubidp.24W.9ghf9Osep.6ITqYNL7qquG', 'Eric', 'azeazea', 64, NULL, NULL),
(5, 'Junio', 'jujugege@gmail.com', '$2y$10$jj72l2vR6Fa22L/2wq9IwOWUjwRMmH0zeLo9Q82RnQ2lwqCXi2FYy', 'Gerard', 'Chez le père noel', 64, NULL, NULL),
(6, 'BIGBOYYY', 'bigboy@caramail.fr', '$2y$10$IOYLMMdKbgz274tdJVsW.OgA/76TBVjm0x4lGQAuH3QhqyLYtl7cq', 'Eric', '75 rue des Octobres Bleu 75020 Paris', 34, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `venues`
--

CREATE TABLE `venues` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `town` varchar(200) NOT NULL,
  `disabled_access` tinyint(1) NOT NULL,
  `address` varchar(250) NOT NULL,
  `capacity` int(11) NOT NULL,
  `vip_available` int(11) DEFAULT NULL,
  `prices` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `venues`
--

INSERT INTO `venues` (`id`, `title`, `town`, `disabled_access`, `address`, `capacity`, `vip_available`, `prices`) VALUES
(2, 'Transbordeur', 'Villeurbanne', 1, '3 Bd de Stalingrad, 69100 Villeurbanne', 30, 0, 0),
(3, 'AccorHotels Arena', 'Paris', 1, '8 Bd de Bercy, 75012 Paris', 60, 1, 0),
(10, 'La Belle Electrique', 'Grenoble', 1, '12 Esp. Andry Farcy, 38000 Grenoble', 30, 1, 0),
(11, 'Le Bikini', 'Toulouse', 1, 'Parc Technologique du Canal, Rue Théodore Monod, 31520 Ramonville-Saint-Agne', 10, 0, 0),
(12, 'Palais Nikaïa', 'Nice', 1, 'Bd du Mercantour, 06200 Nice', 9, 1, 0),
(13, 'H Arena', 'Nantes', 1, 'Rue René Viviani, 44200 Nantes', 50, 1, 0),
(14, 'Stade Orange Vélodrome', 'Marseille', 1, '3 Bd Michelet, 13008 Marseille', 80, 1, 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`),
  ADD KEY `website` (`website`);

--
-- Index pour la table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `candy_show`
--
ALTER TABLE `candy_show`
  ADD PRIMARY KEY (`id`),
  ADD KEY `first_part` (`first_part`),
  ADD KEY `first_part_website` (`first_part_website`);

--
-- Index pour la table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `venue_id` (`venue_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`);

--
-- Index pour la table `venues`
--
ALTER TABLE `venues`
  ADD PRIMARY KEY (`id`),
  ADD KEY `town` (`town`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `artists`
--
ALTER TABLE `artists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT pour la table `candy_show`
--
ALTER TABLE `candy_show`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `prices`
--
ALTER TABLE `prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `venues`
--
ALTER TABLE `venues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

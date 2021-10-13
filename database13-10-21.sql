-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 13 oct. 2021 à 09:13
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
  `holder` varchar(255) NOT NULL,
  `type` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `bookings`
--

INSERT INTO `bookings` (`id`, `ref_id`, `ref`, `id_user`, `holder`, `type`) VALUES
(101, 7, 'Grenoble @ La Belle Electrique', 3, 'Sophie Valencourt', 0),
(102, 7, 'Grenoble @ La Belle Electrique', 3, 'Eric Vautier', 1),
(103, 7, 'Grenoble @ La Belle Electrique', 3, 'Daphné Azudot', 2),
(104, 10, 'Marseille @ Stade Orange Vélodrome', 3, 'John Talabot', 1),
(105, 10, 'Marseille @ Stade Orange Vélodrome', 3, 'Silvie Vartant', 1),
(106, 10, 'Marseille @ Stade Orange Vélodrome', 3, 'Peter Grimson', 1),
(107, 6, 'Paris @ AccorHotels Arena', 3, 'Leo Costa', 0),
(108, 6, 'Paris @ AccorHotels Arena', 3, 'Silvie Vartant', 1),
(109, 6, 'Paris @ AccorHotels Arena', 3, 'Lucie Balard', 0),
(110, 7, 'Grenoble @ La Belle Electrique', 6, 'Sophie Valencourt', 0),
(111, 7, 'Grenoble @ La Belle Electrique', 6, 'Jean Duboit', 1),
(112, 10, 'Marseille @ Stade Orange Vélodrome', 6, 'John Talabot', 1),
(113, 10, 'Marseille @ Stade Orange Vélodrome', 6, 'Eric Vautier', 1),
(114, 10, 'Marseille @ Stade Orange Vélodrome', 6, 'Daphné Azudot', 1),
(115, 6, 'Paris @ AccorHotels Arena', 6, 'John Talabot', 0),
(116, 6, 'Paris @ AccorHotels Arena', 6, 'Eric Vautier', 0),
(117, 6, 'Paris @ AccorHotels Arena', 6, 'Daphné Azudot', 1),
(118, 7, 'Grenoble @ La Belle Electrique', 8, 'François Gaurale', 0),
(119, 7, 'Grenoble @ La Belle Electrique', 8, 'Eulalie Delpierre', 2),
(120, 10, 'Marseille @ Stade Orange Vélodrome', 8, 'François Gaurale', 1),
(121, 10, 'Marseille @ Stade Orange Vélodrome', 8, 'Eulalie Delpierre', 1),
(122, 10, 'Marseille @ Stade Orange Vélodrome', 8, 'Peter Grimson', 1);

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
(6, 'Paris @ AccorHotels Arena', 3, '2', NULL, 100, '2022-04-09 21:30:00', '2022-04-09 00:30:00', '2021-12-11 00:00:00', NULL, 6),
(7, 'Grenoble @ La Belle Electrique', 10, '4', NULL, 60, '2021-10-27 21:00:00', '2021-10-27 23:30:00', '2021-10-07 00:00:00', NULL, 7),
(8, 'Nice @ Palais Nikaïa', 12, '5', NULL, 95, '2022-08-05 20:30:00', '2022-08-05 23:30:00', '2021-10-25 00:00:00', NULL, 0),
(9, 'Toulouse @ Le Bikini', 11, '1', NULL, 60, '2023-04-29 21:00:00', '2023-04-29 23:30:00', '2021-12-25 00:00:00', NULL, 0),
(10, 'Marseille @ Stade Orange Vélodrome', 14, '2', NULL, 70, '2022-04-02 21:30:00', '2022-04-02 00:30:00', '2021-10-13 00:00:00', NULL, 9);

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `alt` varchar(255) NOT NULL,
  `context` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `images`
--

INSERT INTO `images` (`id`, `alt`, `context`) VALUES
(13, 'pope candy in limoge\'s streets', '                                    Pope Candy à Limoge\r\n            \r\n            \r\n            '),
(14, 'pope candy on stage', 'Pope Candy au Soda Festival, Paris 2019'),
(16, 'pope candy nice picture', 'Pope Candy à Los Angeles, 2019'),
(17, 'pope candy fashion week 2020', 'Pope Candy lors de la fashion week à Paris en 2020');

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
(1, 'Decilien', 'roosevelt.decilien@yahoo.fr', '$2y$10$ZdwEadnzX1A/V9cALp.Rhu7l1uVAtMM.SE6Bl6G2EsI53GRUQqsCG', 'Magdarline', 'poissy', 32, NULL, '1'),
(2, 'Morin', 'morino@edgardino.com', '$2y$10$NZo97h6HvN41lSdTL0ih7O3cfuICkBql02UlQ.xehCauPlMPDNaOC', 'Edgard', 'sdsd', 107, NULL, '1'),
(3, 'Tapis', 'tapis@tuvasnousmanquer.fr', '$2y$10$xmJNnCKY8hDKBhnOlyOSnejZWWJt/pWGGzp/N0BSXtMC/lLPBfNZW', 'Bernard', 'Paradis', 78, NULL, '1'),
(4, 'Frechon', 'frais@choin.org', '$2y$10$WLFjEao.NSMa2W.dC894Vubidp.24W.9ghf9Osep.6ITqYNL7qquG', 'Eric', 'azeazea', 64, NULL, '0'),
(5, 'Junio', 'jujugege@gmail.com', '$2y$10$jj72l2vR6Fa22L/2wq9IwOWUjwRMmH0zeLo9Q82RnQ2lwqCXi2FYy', 'Gerard', 'Chez le père noel', 64, NULL, NULL),
(6, 'BIGBOYYY', 'bigboy@caramail.fr', '$2y$10$IOYLMMdKbgz274tdJVsW.OgA/76TBVjm0x4lGQAuH3QhqyLYtl7cq', 'Eric', '75 rue des Octobres Bleu 75020 Paris', 34, NULL, NULL),
(7, 'Princesse', 'princesse@star.com', '$2y$10$bmuXtBrOwXYrpZ/XpuuUCOrvXztJ3lNRVfhjkq7btNSc6x3vleon6', 'Amidala', 'Tatoine', 24, NULL, NULL),
(8, 'Godard', 'jj@cinetek.fr', '$2y$10$7eCxwHDdooMqTOkcbZ0z3uGR3n0YFM5kvqad4v3cTZvXVQabnoEmW', 'Jean Luc', '75 rue des Octobres Bleu 75020 Paris', 90, NULL, NULL),
(9, 'Talaboman', 'johntalabot@hiverndiscs.com', '$2y$10$QTEZgy3pRVl0lxNtYvgroOi6C7p03gyk2Aqn75l/g4dOcjamFVoSe', 'John', 'Carrer de Mallorca, 401, 08013 Barcelona, Espagne', 45, NULL, NULL),
(10, 'Davant', 'soph666@gmail.com', '$2y$10$ozNbdC3cgvoNxBP5Iz4J3O0sTzMF/vovsBykNJBrkZy9c4IDx1O4O', 'Sophie', 'Meteo France', 64, NULL, NULL);

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
(2, 'Transbordeur', 'Villeurbanne', 1, '3 Bd de Stalingrad, 69100 Villeurbanne', 9, 0, 0),
(3, 'AccorHotels Arena', 'Paris', 1, '8 Bd de Bercy, 75012 Paris', 7, 1, 0),
(10, 'La Belle Electrique', 'Grenoble', 1, '12 Esp. Andry Farcy, 38000 Grenoble', 14, 1, 0),
(11, 'Le Bikini', 'Toulouse', 1, 'Parc Technologique du Canal, Rue Théodore Monod, 31520 Ramonville-Saint-Agne', 4, 0, 0),
(12, 'Palais Nikaïa', 'Nice', 1, 'Bd du Mercantour, 06200 Nice', 9, 1, 0),
(13, 'H Arena', 'Nantes', 1, 'Rue René Viviani, 44200 Nantes', 12, 1, 0),
(14, 'Stade Orange Vélodrome', 'Marseille', 1, '3 Bd Michelet, 13008 Marseille', 12, 1, 0);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT pour la table `candy_show`
--
ALTER TABLE `candy_show`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `prices`
--
ALTER TABLE `prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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

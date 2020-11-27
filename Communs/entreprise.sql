-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  Dim 15 nov. 2020 à 22:22
-- Version du serveur :  10.4.6-MariaDB
-- Version de PHP :  7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `entreprise`
--

-- --------------------------------------------------------

--
-- Structure de la table `emp2`
--

CREATE TABLE `emp2` (
  `no_employe` int(5) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `emploi` varchar(50) DEFAULT NULL,
  `embauche` date DEFAULT NULL,
  `salaire` float(9,2) DEFAULT NULL,
  `commission` float(9,2) DEFAULT NULL,
  `sup` int(5) DEFAULT NULL,
  `no_service` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `emp2`
--

INSERT INTO `emp2` (`no_employe`, `nom`, `prenom`, `emploi`, `embauche`, `salaire`, `commission`, `sup`, `no_service`) VALUES
(1000, 'LEROY', 'PAUL', 'PRESIDENT', '1987-10-25', 55005.50, NULL, NULL, 1),
(1010, 'MOYEN', 'TOTO', 'COMPTABLE', '1999-12-12', 20576.62, NULL, 1000, 1),
(1101, 'DUMONT', 'LOUIS', 'VENDEUR', '1987-10-25', 10947.03, 0.00, 1300, 1),
(1102, 'MINET', 'MARC', 'VENDEUR', '1987-10-25', 9783.61, 17230.00, 1300, 1),
(1104, 'NYS', 'ETIENNE', 'TECHNICIEN', '1987-10-25', 14934.58, NULL, 1200, 1),
(1105, 'DENIMAL', 'JEROME', 'COMPTABLE', '1987-10-25', 19053.42, NULL, 1600, 1),
(1200, 'LEMAIRE', 'GUY', 'DIRECTEUR', '1987-03-11', 36303.63, NULL, 1000, 2),
(1201, 'MARTIN', 'JEAN', 'TECHNICIEN', '1987-06-25', 13594.52, 0.00, 1300, 2),
(1202, 'DUPONT', 'JACQUES', 'TECHNICIEN', '1987-10-25', 12203.61, NULL, 1200, 2),
(1300, 'LENOIR', 'GERARD', 'DIRECTEUR', '1987-04-02', 31353.14, 13071.00, 1000, 3),
(1301, 'GERARD', 'ROBERT', 'VENDEUR', '1999-04-25', 9310.50, 12430.00, 1300, 3),
(1303, 'MASURE', 'EMILE', 'TECHNICIEN', '1988-06-25', 12646.47, NULL, 1200, 3),
(1500, 'DUPONT', 'JEAN', 'DIRECTEUR', '1987-10-23', 28434.63, NULL, 1000, 5),
(1501, 'DUPIRE', 'PIERRE', 'ANALYSTE', '1984-10-25', 23102.14, NULL, 1500, 5),
(1502, 'DURAND', 'BERNARD', 'PROGRAMMATEUR', '1987-07-30', 15973.97, NULL, 1500, 5),
(1503, 'DELNATTE', 'LUC', 'PUPITREUR', '1999-01-25', 10649.97, NULL, 1500, 5),
(1524, 'montaye', 'aurelien', 'programmateur', '2020-10-19', 9075.00, 1500.00, 1500, 5),
(1600, 'LAVARE', 'PAUL', 'DIRECTEUR', '1991-12-13', 31238.63, NULL, 1000, 6),
(1601, 'CARON', 'ALAIN', 'COMPTABLE', '1985-09-25', 33003.63, NULL, 1600, 6),
(1602, 'DUBOIS', 'JULES', 'VENDEUR', '1990-12-20', 11520.35, 35535.00, 1300, 6),
(1603, 'MOREL', 'ROBERT', 'COMPTABLE', '1985-07-18', 33003.30, NULL, 1600, 6),
(1604, 'HAVET', 'ALAIN', 'VENDEUR', '1991-01-01', 11360.61, 33415.00, 1300, 6),
(1605, 'RICHARD', 'JULES', 'COMPTABLE', '1985-10-22', 33503.40, NULL, 1600, 5),
(1615, 'DUPREZ', 'JEAN', 'BALAYEUR', '1998-10-22', 7260.73, NULL, 1000, 5);

-- --------------------------------------------------------

--
-- Structure de la table `employes`
--

CREATE TABLE `employes` (
  `no_employe` int(5) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `emploi` varchar(50) DEFAULT NULL,
  `embauche` date DEFAULT NULL,
  `salaire` float(9,2) DEFAULT NULL,
  `commission` float(9,2) DEFAULT NULL,
  `sup` int(5) DEFAULT NULL,
  `no_service` int(2) DEFAULT NULL,
  `NOPROJ` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `employes`
--

INSERT INTO `employes` (`no_employe`, `nom`, `prenom`, `emploi`, `embauche`, `salaire`, `commission`, `sup`, `no_service`, `NOPROJ`) VALUES
(1000, 'LEROY', 'PAUL', 'PRESIDENT', '1987-10-25', 55005.50, NULL, NULL, 1, NULL),
(1057, 'DUGARDIN', 'GUEAND', 'JARDINIER', '2020-11-04', 12503.00, 1050.00, 1000, 1, 102),
(1091, 'GOLIATH', 'DAVID', 'DEMOLISSEUR', '2020-10-27', 14522.00, 223.00, 1000, 2, 102),
(1100, 'DELPIERRE', 'DOROTHEE', 'SECRETAIRE', '1987-10-26', 12351.50, NULL, 1000, 1, 103),
(1101, 'DUMONT', 'LOUIS', 'VENDEUR', '1987-10-25', 9047.14, 0.00, 1300, 1, 103),
(1102, 'MINET', 'MARC', 'VENDEUR', '1987-10-25', 8085.63, 17230.00, 1300, 1, 103),
(1104, 'NYS', 'ETIENNE', 'TECHNICIEN', '1987-10-25', 12342.63, NULL, 1200, 1, 103),
(1105, 'DENIMAL', 'JEROME', 'COMPTABLE', '1987-10-25', 15746.63, NULL, 1600, 1, 102),
(1200, 'LEMAIRE', 'GUY', 'DIRECTEUR', '1987-03-11', 36303.63, NULL, 1000, 2, 103),
(1201, 'MARTIN', 'JEAN', 'TECHNICIEN', '1987-06-25', 11235.14, 0.00, 1300, 2, 103),
(1254, 'HIBIG', 'JJJJJJJ', 'BIUHBUI', '2020-12-12', 2121.00, 5455.00, 1100, 2, 103),
(1300, 'LENOIR', 'GERARD', 'DIRECTEUR', '1987-04-02', 31353.14, 13071.00, 1000, 3, 103),
(1301, 'GERARD', 'ROBERT', 'VENDEUR', '1999-04-25', 7694.63, 12430.00, 1300, 3, 103),
(1303, 'MASURE', 'EMILE', 'TECHNICIEN', '1988-06-25', 10451.63, NULL, 1200, 3, 103),
(1500, 'DUPONT', 'JEAN', 'DIRECTEUR', '1987-10-23', 28434.63, NULL, 1000, 5, 103),
(1501, 'DUPIRE', 'PIERRE', 'ANALYSTE', '1984-10-25', 23102.14, NULL, 1500, 5, 102),
(1502, 'DURAND', 'BERNARD', 'PROGRAMMATEUR', '1987-07-30', 13201.63, NULL, 1500, 5, 102),
(1503, 'DELNATTE', 'LUC', 'PUPITREUR', '1999-01-25', 8801.63, NULL, 1500, 5, 102),
(1600, 'LAVARE', 'PAUL', 'DIRECTEUR', '1991-12-13', 31238.63, NULL, 1000, 6, 103),
(1601, 'CARON', 'ALAIN', 'COMPTABLE', '1985-09-25', 33003.63, NULL, 1600, 6, 102),
(1602, 'DUBOIS', 'JULES', 'VENDEUR', '1990-12-20', 9520.95, 35535.00, 1300, 6, 103),
(1603, 'MOREL', 'ROBERT', 'COMPTABLE', '1985-07-18', 33003.30, NULL, 1600, 6, 102),
(1604, 'HAVET', 'ALAIN', 'VENDEUR', '1991-01-01', 9388.94, 33415.00, 1300, 6, 103),
(2020, 'BONJOUR', 'VOUS', 'PROPHETE', '2020-10-23', 1500.00, 50.00, 1500, 2, 102),
(2222, 'AAAAAAAAAA', 'BBBBBBZZZZZ', 'CCCCCCCCCCOO', '2020-11-03', 45000.00, 300.00, 1100, 3, 102),
(3256, 'TESSTTTT', 'TESTTTTTT', 'TTTTTT', '2020-03-12', 15165.00, 121.00, 1100, 7, 102),
(3544, 'jjj', 'jjjj', 'jjjjj', '2020-04-12', 32115.00, 15145.00, 1100, 1, 102),
(3625, 'DERNIER', 'DERNIER', 'DEBUTANT', '2020-11-17', 21514.00, 152.00, 1000, 1, 102),
(4321, 'OOOO', 'PPPP', 'OOOOOOO', NULL, 15422.00, 20.00, 1300, 2, 103),
(4552, 'TEST', 'TEST', 'NJJKNJNH', '2020-01-01', 15512.00, 1.00, 1200, 2, 103);

-- --------------------------------------------------------

--
-- Structure de la table `proj`
--

CREATE TABLE `proj` (
  `noproj` int(11) NOT NULL,
  `nomproj` varchar(10) DEFAULT NULL,
  `budget` float(13,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `proj`
--

INSERT INTO `proj` (`noproj`, `nomproj`, `budget`) VALUES
(101, 'alpha', 250000.00),
(102, 'beta', 175000.00),
(103, 'gamma', 1500000.00);

-- --------------------------------------------------------

--
-- Structure de la table `serv2`
--

CREATE TABLE `serv2` (
  `no_service` int(2) NOT NULL,
  `libelle` varchar(50) DEFAULT NULL,
  `ville` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `serv2`
--

INSERT INTO `serv2` (`no_service`, `libelle`, `ville`) VALUES
(1, 'DIRECTION', 'PARIS'),
(2, 'LOGISTIQUE', 'SECLIN'),
(3, 'VENTES', 'ROUBAIX'),
(4, 'FORMATION', 'VILLENEUVE D\'ASCQ'),
(5, 'INFORMATIQUE', 'LILLE'),
(6, 'COMPTABILITE', 'LILLE'),
(7, 'TECHNIQUE', 'ROUBAIX');

-- --------------------------------------------------------

--
-- Structure de la table `service`
--

CREATE TABLE `service` (
  `no_service` int(2) NOT NULL,
  `libelle` varchar(50) DEFAULT NULL,
  `ville` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `service`
--

INSERT INTO `service` (`no_service`, `libelle`, `ville`) VALUES
(1, 'DIRECTION', 'PARIS'),
(2, 'LOGISTIQUE', 'SECLIN'),
(3, 'VENTES', 'ROUBAIX'),
(4, 'FORMATION', 'VILLENEUVE D\'ASCQ'),
(5, 'INFORMATIQUE', 'LILLE'),
(6, 'COMPTABILITE', 'LILLE'),
(7, 'TECHNIQUE', 'ROUBAIX'),
(8, 'ETRANGE', 'SUPERVISION'),
(9, 'REINE', 'TOURCOING'),
(10, 'TEST', 'TEST'),
(11, 'LAVERIE', 'FLEURBAIX'),
(12, 'MAGASIN', 'TOURCOING'),
(13, 'BLAIREAU', 'BLAIRWITCH2'),
(14, 'OPERATIONNEL', 'LILLE');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(100) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profil` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `userName`, `password`, `profil`) VALUES
(1, 'BIBI', 'BABA', 'utilisateur'),
(2, 'BBBBBB', 'utilisateur', '$2y$10$r4d6d/mYq2HUJ'),
(3, 'TOTO', '$2y$10$KXVfKf38sDx/kb6or9YTXeydZKaaksDpti0oFK9sJ5T.XP1V49OHW', 'utilisateur'),
(4, 'UUUUUUUUU', '$2y$10$jU3mMMa.sVkNYD2WKvgjfuZHVgl8RXk8HFifJp2fljxAkBFR47y8G', 'utilisateur'),
(5, 'ADMIN', '$2y$10$bXZurjmKH4Bfq/pLsZCTK.8zAGZL0zsqlOS80JTAoKoAtRlm6ZxYW', 'admin'),
(6, 'YYYYYYY', '$2y$10$IC4B0WIrIldGF7vaAzGb7OyPxTXG2DMjoGHFSLvS5TTL44bJlpex2', ''),
(7, 'PPPPPPPPP', '$2y$10$G1ijyQightgHPYliDKcqaer9hK0COp0UHgE5v5va22Nmucxp4lJIS', ''),
(8, 'vvvvvv', '$2y$10$oo.TyPaizGx6JgVDlvOqouGcsVcaCJrPvu2AkkRA.eH0CzMmgi8Fu', 'utilisateur'),
(9, 'ggggg', '$2y$10$mwABgHoJ3ygbepPjJ/cra.4tgDztJvqzIDkp/Pvhp.ZfjdmafSq9W', 'utilisateur'),
(10, 'JAJA', '$2y$10$mcrkGIcVmV/HPV3cZmRMi.18mw3MQ2sZt2BlXg/VUYpYx8lPPtJ0e', 'utilisateur'),
(11, 'DADA', '$2y$10$1CUyEPQavG7G0rvBBLGXVuqE7DQq8To3C6dHGrZ.TCef7bC0O.PLW', 'utilisateur'),
(12, 'DADA', '$2y$10$3jl4SKrpMZocL.5oefyoW.SlyMlBa3Zge8CnqdLyevLa0RSVCjDJC', 'utilisateur'),
(13, 'BIBI', '$2y$10$AYKM6KX6r.e81PA6oDYqN.cFEVzGiSMhE3hm4izvrCdMpgc6ec48a', 'utilisateur'),
(14, 'BIBI', '$2y$10$1KpRqq4gkSuYipCvOo1YVOsZwXA7uY9FBKi7T1QkRRC0RgpxMehp.', 'utilisateur'),
(15, 'AAA', '$2y$10$7MMJod3rrHPX.uu/NmKzQ.p6.FE5Z.GVWl09Zx0IYYet/LwgTztZK', 'utilisateur'),
(16, 'AAA', '$2y$10$7MMJod3rrHPX.uu/NmKzQ.p6.FE5Z.GVWl09Zx0IYYet/LwgTztZK', 'utilisateur'),
(17, 'BIBI', '$2y$10$YxhKjEqUhr2aMpgh1Ay0G.y028bbflCA2L2X1svKQd/.N6.gvUwOC', 'utilisateur'),
(18, 'BIBI', '$2y$10$YxhKjEqUhr2aMpgh1Ay0G.y028bbflCA2L2X1svKQd/.N6.gvUwOC', 'utilisateur'),
(19, 'BIBI', '$2y$10$zLrAmUGf3AgwK4qfUThWuu1pDhrQkYyd4lgN7jqphx4t0SEHzkKcO', 'utilisateur'),
(20, 'BIBI', '$2y$10$zLrAmUGf3AgwK4qfUThWuu1pDhrQkYyd4lgN7jqphx4t0SEHzkKcO', 'utilisateur'),
(21, 'AAAA', '$2y$10$DIrqDFbEm2JwLmdL0kWWSO1xkUWqdHsWNYN4HNYfF29miFyobzCgC', 'utilisateur'),
(22, 'AAAA', '$2y$10$DIrqDFbEm2JwLmdL0kWWSO1xkUWqdHsWNYN4HNYfF29miFyobzCgC', 'utilisateur'),
(23, 'UUU', '$2y$10$v2vwswhAwkgumx1Ha6vEw.EbOle1dMNu6f/MVBdw6EZXdQkaRZ6zy', 'utilisateur'),
(24, 'UUU', '$2y$10$v2vwswhAwkgumx1Ha6vEw.EbOle1dMNu6f/MVBdw6EZXdQkaRZ6zy', 'utilisateur'),
(25, 'AAAA', '$2y$10$F3ZLA3sJFnP./PN637oYTupU0hgOk5eOcVdvGUDomNWV/MylJ8f2G', 'utilisateur'),
(26, 'AAAA', '$2y$10$F3ZLA3sJFnP./PN637oYTupU0hgOk5eOcVdvGUDomNWV/MylJ8f2G', 'utilisateur'),
(27, 'BABA', '$2y$10$Vq2bpJrMpTFw.2BydhkJyeJmWbyT5sUjyffMkAgRu3FPfHGJya5Yi', 'utilisateur'),
(28, 'BABA', '$2y$10$Vq2bpJrMpTFw.2BydhkJyeJmWbyT5sUjyffMkAgRu3FPfHGJya5Yi', 'utilisateur'),
(29, 'zz', '$2y$10$Wp3mucVmxULQbr1qzXbW2ea0IsQqcyLAuJmWtX21AtCLxoywJ.r.i', 'utilisateur'),
(30, 'zz', '$2y$10$Wp3mucVmxULQbr1qzXbW2ea0IsQqcyLAuJmWtX21AtCLxoywJ.r.i', 'utilisateur'),
(31, 'zz', '$2y$10$lnXIUHz8zBCfRQ3CUI.B/.pwswF6BV.xN9M8AoUjoDHtsEWP37XFW', 'utilisateur'),
(32, 'zz', '$2y$10$lnXIUHz8zBCfRQ3CUI.B/.pwswF6BV.xN9M8AoUjoDHtsEWP37XFW', 'utilisateur'),
(33, 'zz', '$2y$10$57t8HF/gpAuRjg5lQBiZ1ehFXUTFGrGw.OlIZPG8FXtmfxja4DIgW', 'utilisateur'),
(34, 'zz', '$2y$10$57t8HF/gpAuRjg5lQBiZ1ehFXUTFGrGw.OlIZPG8FXtmfxja4DIgW', 'utilisateur');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `emp2`
--
ALTER TABLE `emp2`
  ADD PRIMARY KEY (`no_employe`),
  ADD KEY `no_service` (`no_service`);

--
-- Index pour la table `employes`
--
ALTER TABLE `employes`
  ADD PRIMARY KEY (`no_employe`),
  ADD KEY `sup` (`sup`),
  ADD KEY `no_service` (`no_service`),
  ADD KEY `NOPROJ` (`NOPROJ`);

--
-- Index pour la table `proj`
--
ALTER TABLE `proj`
  ADD PRIMARY KEY (`noproj`);

--
-- Index pour la table `serv2`
--
ALTER TABLE `serv2`
  ADD PRIMARY KEY (`no_service`);

--
-- Index pour la table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`no_service`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `emp2`
--
ALTER TABLE `emp2`
  ADD CONSTRAINT `emp2_ibfk_1` FOREIGN KEY (`no_service`) REFERENCES `serv2` (`no_service`);

--
-- Contraintes pour la table `employes`
--
ALTER TABLE `employes`
  ADD CONSTRAINT `employes_ibfk_1` FOREIGN KEY (`sup`) REFERENCES `employes` (`no_employe`),
  ADD CONSTRAINT `employes_ibfk_2` FOREIGN KEY (`no_service`) REFERENCES `service` (`no_service`),
  ADD CONSTRAINT `employes_ibfk_3` FOREIGN KEY (`NOPROJ`) REFERENCES `proj` (`noproj`),
  ADD CONSTRAINT `employes_ibfk_4` FOREIGN KEY (`NOPROJ`) REFERENCES `proj` (`noproj`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

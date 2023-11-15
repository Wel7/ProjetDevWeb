-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 15 nov. 2023 à 15:27
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `infraction`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `num_admin` int NOT NULL AUTO_INCREMENT,
  `nom_admin` varchar(25) NOT NULL,
  `prenom_admin` varchar(25) NOT NULL,
  `mdp_admin` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `identifiant_admin` varchar(25) NOT NULL,
  PRIMARY KEY (`num_admin`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`num_admin`, `nom_admin`, `prenom_admin`, `mdp_admin`, `identifiant_admin`) VALUES
(1, 'Girard', 'Gérard', '$2y$10$AWSZFW2zwgwWFmVTeC3uveBu.wVM/f7zlJ1wU.ac4.nPoEbiq2C8K', 'Gégé42');

-- --------------------------------------------------------

--
-- Structure de la table `comprend`
--

DROP TABLE IF EXISTS `comprend`;
CREATE TABLE IF NOT EXISTS `comprend` (
  `id_inf` varchar(5) NOT NULL,
  `id_delit` int NOT NULL,
  PRIMARY KEY (`id_inf`,`id_delit`),
  KEY `id_delit` (`id_delit`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `comprend`
--

INSERT INTO `comprend` (`id_inf`, `id_delit`) VALUES
('1', 1),
('11', 3),
('11', 5),
('12', 3),
('13', 2),
('2', 1),
('2', 2),
('3', 3),
('4', 4),
('4', 5),
('5', 2),
('5', 4),
('6', 1),
('6', 2),
('6', 4),
('6', 6),
('7', 1),
('7', 2),
('7', 5),
('8', 1),
('8', 2),
('8', 6),
('85', 1),
('85', 5),
('86', 1),
('86', 2),
('86', 3),
('86', 4),
('86', 5),
('86', 6),
('87', 4),
('87', 6),
('88', 2),
('9', 3),
('9', 6);

-- --------------------------------------------------------

--
-- Structure de la table `conducteur`
--

DROP TABLE IF EXISTS `conducteur`;
CREATE TABLE IF NOT EXISTS `conducteur` (
  `num_permis` varchar(4) NOT NULL,
  `date_permis` date NOT NULL,
  `nom` varchar(25) NOT NULL,
  `prenom` varchar(25) NOT NULL,
  `motDePasse` varchar(75) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`num_permis`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `conducteur`
--

INSERT INTO `conducteur` (`num_permis`, `date_permis`, `nom`, `prenom`, `motDePasse`) VALUES
('AZ67', '2011-02-01', 'AIRPACH', 'Fabrice', '$2y$05$O5U2lsn71jDKUVNgoPg53Oat4SdOQvD5SGpv/A2HwXV8MgSf3Lblq'),
('AZ69', '2011-02-01', 'CAVALLI', 'Frédéric', '$2y$05$heAfX617ceDLy1dJ3IbfNezIk7cEahwoi09Kg6qSFIUhl9cvzX5de'),
('AZ71', '2017-02-02', 'MANGONI', 'Joseph', '$2y$05$fELHui58E7CEvccD2y7RfObS5h00RqbbQ4s4cvJWUwppd3n0TFp9q'),
('AZ81', '1997-04-09', 'GAUDE', 'David', '$2y$05$l20RLkYUOBtr6pOjJzpDVO.kICqKTmKTWpqKLSSdpW6ya8yyD58wG'),
('AZ90', '2000-05-04', 'KIEFFER', 'Claudine', '$2y$05$e6dqPkLkhpGP.RDKTNfL2OYeGIDXWjFHX.BA85X.ujF1b/4XWA5h6'),
('AZ92', '2001-04-06', 'THEOBALD', 'Pascal', '$2y$05$5gdEHsW0re0SPoBy616St.NJykjetsJaXoH88owOXyYTcuaasDzEu'),
('AZ99', '2003-09-06', 'CAMARA', 'Souleymane', '$2y$05$jd.iLocX/yWwP6OTHvLsLO0QU/HOZdTsDU6sNIX5XzzjIccly95wG');

-- --------------------------------------------------------

--
-- Structure de la table `delit`
--

DROP TABLE IF EXISTS `delit`;
CREATE TABLE IF NOT EXISTS `delit` (
  `id_delit` int NOT NULL AUTO_INCREMENT,
  `nature` varchar(40) NOT NULL,
  `tarif` decimal(6,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id_delit`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `delit`
--

INSERT INTO `delit` (`id_delit`, `nature`, `tarif`) VALUES
(1, 'Excès de vitesse', '220.00'),
(2, 'Outrage à agent', '450.00'),
(3, 'Feu rouge grillé', '270.00'),
(4, 'Conduite en état d\'ivresse', '380.00'),
(5, 'Delit de fuite', '400.00'),
(6, 'Refus de priorité', '280.00');

-- --------------------------------------------------------

--
-- Structure de la table `infraction`
--

DROP TABLE IF EXISTS `infraction`;
CREATE TABLE IF NOT EXISTS `infraction` (
  `id_inf` int NOT NULL,
  `date_inf` date NOT NULL,
  `num_immat` varchar(8) NOT NULL,
  `num_permis` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`id_inf`),
  KEY `num_permis` (`num_permis`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `infraction`
--

INSERT INTO `infraction` (`id_inf`, `date_inf`, `num_immat`, `num_permis`) VALUES
(1, '2021-09-02', 'CA409BG', 'AZ67'),
(11, '2020-05-14', 'AA643BB', ''),
(12, '2021-12-02', 'AA643BB', 'AZ99'),
(13, '2021-08-11', 'AA643BB', 'AZ67'),
(2, '2021-09-04', 'BE456AD', 'AZ69'),
(3, '2021-09-04', 'AA643BB', 'AZ71'),
(4, '2021-09-06', 'BF823NG', 'AZ81'),
(5, '2021-09-08', '5432YZ88', 'AZ90'),
(6, '2021-09-11', 'AB308FG', 'AZ92'),
(7, '2021-09-08', 'AB308FG', ''),
(8, '2020-06-05', 'AA643BB', 'AZ67'),
(85, '2021-03-18', 'AA643BB', ''),
(9, '2020-10-01', 'BE456AD', ''),
(86, '2023-05-28', 'CD575HS', ''),
(87, '2023-06-01', 'BE456AD', 'AZ99'),
(88, '2023-09-13', 'CA409BG', '');

-- --------------------------------------------------------

--
-- Structure de la table `vehicule`
--

DROP TABLE IF EXISTS `vehicule`;
CREATE TABLE IF NOT EXISTS `vehicule` (
  `num_immat` varchar(8) NOT NULL,
  `date_immat` date NOT NULL,
  `modele` varchar(20) NOT NULL,
  `marque` varchar(20) NOT NULL,
  `num_permis` varchar(4) NOT NULL,
  PRIMARY KEY (`num_immat`),
  KEY `num_permis` (`num_permis`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `vehicule`
--

INSERT INTO `vehicule` (`num_immat`, `date_immat`, `modele`, `marque`, `num_permis`) VALUES
('5432YZ88', '2011-08-15', 'C3', 'Citroën', 'AZ90'),
('AA643BB', '2016-01-07', 'Golf', 'Volkswagen', 'AZ71'),
('AB308FG', '2017-03-27', '309', 'Peugeot', 'AZ92'),
('BE456AD', '2018-07-10', 'Kangoo', 'Renault', 'AZ69'),
('BF823NG', '2018-09-10', 'C3', 'Citroën', 'AZ81'),
('CA409BG', '2019-03-21', 'T-Roc', 'Volkswagen', 'AZ67');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

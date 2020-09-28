-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 18 sep. 2020 à 12:59
-- Version du serveur :  8.0.18
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `keneya`
--

-- --------------------------------------------------------

--
-- Structure de la table `dom20_admin`
--

DROP TABLE IF EXISTS `dom20_admin`;
CREATE TABLE IF NOT EXISTS `dom20_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_dom20_users` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `dom20_appointments`
--

DROP TABLE IF EXISTS `dom20_appointments`;
CREATE TABLE IF NOT EXISTS `dom20_appointments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `comment` text NOT NULL,
  `id_dom20_doctors` int(11) NOT NULL,
  `id_dom20_timeSlots` int(11) NOT NULL,
  `id_dom20_patients` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `dom20_appointments_dom20_doctors_FK` (`id_dom20_doctors`),
  KEY `dom20_appointments_dom20_timeSlots0_FK` (`id_dom20_timeSlots`),
  KEY `dom20_appointments_dom20_patients1_FK` (`id_dom20_patients`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `dom20_comments`
--

DROP TABLE IF EXISTS `dom20_comments`;
CREATE TABLE IF NOT EXISTS `dom20_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `linkPicture` varchar(255) NOT NULL,
  `id_dom20_doctors` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `dom20_comments_dom20_doctors_FK` (`id_dom20_doctors`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `dom20_doctors`
--

DROP TABLE IF EXISTS `dom20_doctors`;
CREATE TABLE IF NOT EXISTS `dom20_doctors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `matricule` varchar(255) NOT NULL,
  `phoneNumbers` varchar(20) NOT NULL,
  `price` int(11) NOT NULL,
  `accepted` tinyint(1) NOT NULL,
  `id_dom20_users` int(11) NOT NULL,
  `id_dom20_specialities` int(11) NOT NULL,
  `id_dom20_practiceplace` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dom20_doctors_dom20_users_AK` (`id_dom20_users`),
  KEY `dom20_doctors_dom20_practiceplace_FK` (`id_dom20_practiceplace`),
  KEY `dom20_doctors_dom20_specialities0_FK` (`id_dom20_specialities`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `dom20_doctors`
--

INSERT INTO `dom20_doctors` (`id`, `matricule`, `phoneNumbers`, `price`, `accepted`, `id_dom20_users`, `id_dom20_specialities`, `id_dom20_practiceplace`) VALUES
(46, '', '00 223 55 22 44 77', 3000, 0, 100, 7, 26),
(51, '', '', 2500, 0, 106, 6, 74),
(52, '', '', 30000, 0, 110, 23, 44),
(56, '', '00 223 55 55 77 55', 2000, 0, 121, 8, 44),
(57, '', '00 223 55 55 77 55', 2000, 0, 122, 8, 44),
(58, '', '00 223 55 55 77 55', 2000, 0, 123, 8, 44),
(59, '', '00 223 55 55 77 55', 2000, 0, 124, 8, 44),
(60, '', '00 223 55 55 77 55', 2000, 0, 126, 8, 44),
(61, '', '00 223 55 55 55 88', 2345, 0, 127, 20, 32),
(62, '', '00 223 55 55 55 55', 2200, 0, 128, 13, 110),
(63, '', '00 223 55 55 55 55', 30000, 0, 129, 8, 114),
(66, '', '00 223 55 55 55 55', 2000, 0, 132, 16, 42),
(67, '', '00 223 55 55 55 55', 25000, 0, 133, 2, 102),
(68, '', '00 223 55 55 55 55', 3000, 0, 134, 16, 102),
(69, '', '00 223 55 55 55 55', 3000, 0, 135, 16, 102),
(70, '', '00 223 55 55 55 55', 8000, 0, 137, 20, 108),
(71, '', '00 223 55 55 55 55', 3000, 0, 138, 2, 114),
(72, '', '00 223 55 55 55 55', 4500, 0, 140, 3, 32);

-- --------------------------------------------------------

--
-- Structure de la table `dom20_doctorsleftdocument`
--

DROP TABLE IF EXISTS `dom20_doctorsleftdocument`;
CREATE TABLE IF NOT EXISTS `dom20_doctorsleftdocument` (
  `id` int(11) NOT NULL,
  `id_dom20_reports` int(11) NOT NULL,
  PRIMARY KEY (`id`,`id_dom20_reports`),
  KEY `dom20_doctorsLeftDocument_dom20_reports0_FK` (`id_dom20_reports`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `dom20_patients`
--

DROP TABLE IF EXISTS `dom20_patients`;
CREATE TABLE IF NOT EXISTS `dom20_patients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `birthDate` date NOT NULL,
  `phoneNumbers` varchar(20) NOT NULL,
  `id_dom20_users` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dom20_patients_dom20_users_AK` (`id_dom20_users`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `dom20_patients`
--

INSERT INTO `dom20_patients` (`id`, `birthDate`, `phoneNumbers`, `id_dom20_users`) VALUES
(3, '1975-08-08', '00 223 55 77 77 55', 25),
(4, '1987-04-23', '0667656659', 59),
(5, '2020-08-07', '0666666666', 61),
(6, '2020-08-07', '0666666666', 62),
(7, '1994-05-02', '0666666666', 63),
(23, '1980-02-02', '00 223 55 55 55 55', 83),
(25, '2000-02-02', '00 223 55 55 55 55', 84),
(28, '1945-01-01', '00 223 55 55 75 75', 87),
(29, '2020-09-01', '00 223 55 55 75 75', 88),
(30, '1980-09-12', '00 223 55 55 55 55', 92),
(31, '1954-09-09', '00 223 55 55 55 55', 93),
(32, '1985-01-08', '00 223 55 55 55 55', 94),
(33, '1985-01-01', '00 223 65 65 65 65', 101),
(34, '2020-09-02', '00 223 55 55 55 55', 107),
(35, '2020-09-09', '00 223 55 55 55 55', 108),
(36, '2020-09-09', '00 223 55 55 55 55', 109),
(38, '2020-09-25', '00 223 55 55 55 55', 114),
(39, '1976-07-23', '00 223 55 55 55 55', 115),
(40, '1985-10-01', '00 223 62 69 76 75', 116),
(41, '2017-05-29', '00 223 55 55 55 77', 118),
(42, '1945-09-02', '00 223 55 55 55 55', 119),
(43, '1945-09-02', '00 223 55 55 55 55', 120),
(44, '1955-09-09', '00 223 55 55 55 23', 125),
(45, '2017-05-29', '00 223 55 55 55 29', 136),
(46, '1985-01-08', '00 223 62 69 76 75', 139);

-- --------------------------------------------------------

--
-- Structure de la table `dom20_patientsleftcomment`
--

DROP TABLE IF EXISTS `dom20_patientsleftcomment`;
CREATE TABLE IF NOT EXISTS `dom20_patientsleftcomment` (
  `id` int(11) NOT NULL,
  `id_dom20_comments` int(11) NOT NULL,
  PRIMARY KEY (`id`,`id_dom20_comments`),
  KEY `dom20_patientsLeftComment_dom20_comments0_FK` (`id_dom20_comments`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `dom20_practiceplace`
--

DROP TABLE IF EXISTS `dom20_practiceplace`;
CREATE TABLE IF NOT EXISTS `dom20_practiceplace` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `placename` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `dom20_practiceplace`
--

INSERT INTO `dom20_practiceplace` (`id`, `placename`) VALUES
(1, 'Médical Grace'),
(2, 'Union'),
(3, 'Ophtalmo Plus'),
(4, 'Espérance de Vie'),
(5, 'Médicale Youma'),
(6, 'Médicale MAM'),
(7, 'Médicale le Relais Yalaly'),
(8, 'Médicale Mozart'),
(9, 'Sianwa'),
(10, 'Mohamed 5'),
(11, 'Ophtalmologie Lafia'),
(12, 'Doumare Ameri'),
(13, 'Médical Kala Diata'),
(14, 'Etoiles'),
(15, 'Keneya So'),
(16, 'Médicale Sankoré'),
(17, 'Thiam'),
(19, 'La Paix Divine'),
(20, 'Polyclinique ALMED'),
(21, 'El Shaddaï'),
(22, 'MedicPlus'),
(23, 'Diata'),
(25, 'Youma'),
(26, 'Avicenne'),
(27, 'Le Kaarta'),
(28, 'Eden\r\n'),
(29, 'Espoir Naata'),
(30, 'CNAM'),
(31, 'GAHAMBANI'),
(32, 'Centre Médical BIA'),
(33, 'Centre Médical Salam'),
(34, 'ASMA'),
(35, 'Médicale Nouveau Soleil'),
(36, 'Solidarité'),
(37, 'Pont d\'Ain'),
(38, 'Initiale Santé'),
(39, 'Cabinet Médical Fakoly'),
(40, 'A Domicile'),
(41, 'Le Soudan'),
(42, 'Cabinet médical Sabunyuman'),
(43, 'Défi Santé'),
(44, 'Cabinet Yereko'),
(45, 'Cabinet Dentaire du Golf'),
(46, 'Blanco Dent'),
(47, 'Cabinet Médical du Centre'),
(48, 'Cabinet Doniya'),
(49, 'Cabinet Kafo'),
(50, 'Horizon Santé'),
(51, 'Donko'),
(68, 'Cabient Médicale Docteur Yamadou Sidibé'),
(74, '2M'),
(102, 'Cabinet Médical Solidarité'),
(103, 'Cabinet Médical Duflo'),
(105, 'Clinique Farako'),
(106, 'PSY2A'),
(108, 'Centre de Santé de la Croix du Sud'),
(109, 'Csref'),
(110, 'Cabinet Médical la Reference'),
(111, 'Polyclinique Pasteur'),
(114, 'Centre médical du palais'),
(117, 'Clinique d\'ophtamologue El Azar');

-- --------------------------------------------------------

--
-- Structure de la table `dom20_reports`
--

DROP TABLE IF EXISTS `dom20_reports`;
CREATE TABLE IF NOT EXISTS `dom20_reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link` varchar(255) NOT NULL,
  `date` time NOT NULL,
  `id_dom20_reportTypes` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `dom20_reports_dom20_reportTypes_FK` (`id_dom20_reportTypes`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `dom20_reporttypes`
--

DROP TABLE IF EXISTS `dom20_reporttypes`;
CREATE TABLE IF NOT EXISTS `dom20_reporttypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `dom20_reporttypes`
--

INSERT INTO `dom20_reporttypes` (`id`, `name`) VALUES
(1, 'Ordonnance'),
(2, 'Echographie/Radiographie/Scanner'),
(3, 'Compte - rendu de visite'),
(4, 'Résultat analyse médicale'),
(5, 'Suivi de vaccinnation'),
(6, 'Pathologie '),
(7, 'Ordonnance'),
(8, 'Echographie/Radiographie/Scanner'),
(9, 'Compte - rendu de visite'),
(10, 'Résultat analyse médicale'),
(11, 'Suivi de vaccinnation'),
(12, 'Pathologie ');

-- --------------------------------------------------------

--
-- Structure de la table `dom20_roles`
--

DROP TABLE IF EXISTS `dom20_roles`;
CREATE TABLE IF NOT EXISTS `dom20_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `dom20_roles`
--

INSERT INTO `dom20_roles` (`id`, `name`) VALUES
(2, 'Admin'),
(3, 'users');

-- --------------------------------------------------------

--
-- Structure de la table `dom20_specialities`
--

DROP TABLE IF EXISTS `dom20_specialities`;
CREATE TABLE IF NOT EXISTS `dom20_specialities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `dom20_specialities`
--

INSERT INTO `dom20_specialities` (`id`, `name`) VALUES
(1, 'Généraliste'),
(2, 'Ophtalmologue'),
(3, 'Gynécologue  et obstétrique'),
(4, 'Dermatologue et vénérologue'),
(5, 'Pédiatre'),
(6, 'Cardiologue'),
(7, 'Chirurgien-dentiste '),
(8, 'ORL'),
(9, 'Médecine traditionnelle'),
(10, 'Sage-Femme'),
(11, 'Rhumatologue'),
(12, 'Allergologue'),
(13, 'Oncologue'),
(15, 'Gastro-enterologue'),
(16, 'Nutritionniste'),
(17, 'Urologue'),
(18, 'Pédicure-Podologue'),
(19, 'Psychologue'),
(20, 'Pneumologue'),
(21, 'Endocrinologue'),
(22, 'Diabétologue'),
(23, 'Neurologue'),
(24, 'Imagerie-Medicale'),
(25, 'Kinesitherapeute-Masseur'),
(51, 'Orthodontiste');

-- --------------------------------------------------------

--
-- Structure de la table `dom20_timeslots`
--

DROP TABLE IF EXISTS `dom20_timeslots`;
CREATE TABLE IF NOT EXISTS `dom20_timeslots` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `startTime` datetime NOT NULL,
  `endTime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `dom20_timeslots`
--

INSERT INTO `dom20_timeslots` (`id`, `startTime`, `endTime`) VALUES
(1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `dom20_users`
--

DROP TABLE IF EXISTS `dom20_users`;
CREATE TABLE IF NOT EXISTS `dom20_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lastname` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_dom20_roles` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `dom20_users_dom20_roles_FK` (`id_dom20_roles`)
) ENGINE=InnoDB AUTO_INCREMENT=141 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `dom20_users`
--

INSERT INTO `dom20_users` (`id`, `lastname`, `firstname`, `mail`, `password`, `id_dom20_roles`) VALUES
(25, 'Kantefs', 'Nggggg', 'mA.kantef60s@gmail.com', '$2y$10$rNtxkHvXhIh3Ms/MYcXu/.2lOpGKLt3HuXDSU2mxbcpKTDBBMnwYm', 3),
(53, 'Test', 'Test', 'hello@hello.fr', '$2y$10$Kf1/F7a5KVtncc2d2j2Kne1TIoiO9EPEfxVK7cBH43RjrhKtAry/K', 3),
(54, 'Sy', 'Maria', 'm.sy60@gmail.com', '$2y$10$ae5S46PCmmPCSUaUfVn/ZuaMMMUCl8Y7pzmHlTY9j1R5lRvbkx8Wm', 3),
(55, 'Sy', 'Maria', 'm.sy62@gmail.com', '$2y$10$wtOCdaYGc2AA/LCukXVqZ.p58x.Xd7ThgAS8AHP3/9QLl9m4K8CAS', 3),
(56, 'Sya', 'Maria', 'm.sy63@gmail.com', '$2y$10$QwoISnb1A182JBOQoMjj6uH4ZykqS/n8RXii5OIlnFlzh.RUxX1Ra', 3),
(57, 'Sya', 'Mariam', 'm.sy64@gmail.com', '$2y$10$mawDUeI2MBvb3YLPaaH92Ood8tw09FcStQohUiWdNYtFwVqM/EY7e', 3),
(58, 'ka', 'Mariam', 'm.sy64@gmail.com', '$2y$10$f4DlmoWY0ONEJDxDnoO0re2g4wlqvttdXPGjH6auerMb/I48xZHqq', 3),
(59, 'Bali', 'Oumar', 'sy60@gmail.com', '$2y$10$eqPUdapRDFuI7DkzLwfVn.fzUmDwB.Kvi3UHKHKAFGKGvtOSGHPAq', 3),
(60, 'Dupont', 'bri', 'sy44@gmail.com', '$2y$10$tJGspBfUFRrqcQhaUyMCEeg.Lm0hc7EWK.gMl7JYA9Rgz3GZKKGWq', 3),
(61, 'Kante', 'anna', 'anna@gmail.com', '$2y$10$Wr/HbBLmMaffEJUjG40H.uq.MhCONuQQTdKdkNLUQXWSPk8FbTjAi', 3),
(62, 'Diakite', 'anna', 'anna@gmail.com', '$2y$10$tYNThw8EcM85Ey32r/5LPeh9xTpa7Rvfq5O5POI8E7604zAe1/GH6', 3),
(63, 'Kante', 'mame', 'm.kantemame@gmail.com', '$2y$10$6Ygx1CgKm09nDvB536tUaODY2CAnbIMYyBmRDp24ANPBYLZ7EGSBi', 3),
(80, 'Camara', 'aline', 'aline@gmail.com', '$2y$10$gn8SGEH3WSi5PziEApjtEOlhP02gaSymCGumRUnLhqpU6Bud/99jq', 3),
(81, 'Camara', 'aline', 'aline@gmail.com', '$2y$10$TdocwHkPdzimMiE53G9V.uTrCGkWB9zzCwDo.OtMNg4hSAQWiKkzy', 3),
(83, 'Camara', 'Penda', 'PENDA@gmail.com', '$2y$10$81aSaMFCn/JCdploDkhhmObZQw6PbJ/JJ9K6J/YpsLbNd3tg6Snsa', 3),
(84, 'Camara', 'Penda', 'Penda@gmail.com', '$2y$10$U40JqtoCxydxQvqv0mMB9Oai/50ZUponVGlpn8wuuIA.ZSuMrLvaS', 3),
(85, 'KANTE', 'Mariam', 'kante@gmail.com', '$2y$10$Vge1n6gi6zLnMtRLREL/pO9jHv1Zstj/CDc2hHKbOpZnhT5A6DZ22', 3),
(86, 'KANTE', 'Mariam', 'kante@gmail.com', '$2y$10$r4nKMhQhTxblu0SqyNwey.SJ24On1bThuHDrVe.4PKYfsiiuJRE6G', 3),
(87, 'Diakite', 'Oumou', 'oumou@gmail.com', '$2y$10$yFAMV/gYNxb6RAYL/2lAhOksL9WODX3PhBPDZg4uJ3YJtxHfcKCba', 3),
(88, 'Diakite', 'Oumou', 'oumou@gmail.co', '$2y$10$qye8/XT5rBIXo67cjFwEHuGUKXYjdiO3jnu2beGK0AOS/yX5tNUg.', 3),
(89, 'Cisse', 'Aminata', 'cisse223@gmail.com', '$2y$10$aoTm3RsfEOp0vc/JYdFID.UsFOkUBLCUY0KuFCodGHxgX1zyAbAVG', 3),
(90, 'Cissoko', 'Binta', 'cissoko@gmail.com', '$2y$10$KTBCZ6NqdVHIXysz8be0Xu4nfEzRtEtihC15TT8.pSMSU5VuO1D0.', 3),
(91, 'Diakite', 'Kani', 'kani@gmail.com', '$2y$10$GdZmSP7azyYDaJB4ghuEle83USrsQ68V9cdLBJleyI5N9cr4FUvrS', 3),
(92, 'Camara', 'Elysabeth', 'camara@gmail.com', '$2y$10$TCmQ.4KxA.8m4KnXwQSTluWc10jJvFb9hLJkn00E9GdxRonVwrlJy', 3),
(93, 'Kante', 'DJIBRIL', 'kante@yahoo.com', '$2y$10$a9i4DR1AlYe1vqet/ZzhTurPLhoUrPb1sR5AZmWxPl.OIoOP1xHHy', 3),
(94, 'Kante', 'Maimouna', 'maimouna@gmail.com', '$2y$10$7NIBljhUC5dqLTjzir6/CeGGtdXEpuoJb/50wel8Egz9MRu2c7qja', 3),
(95, 'Kante', 'Maimouna', 'maimouna223@gmail.com', '$2y$10$vr26f39pGh3FHPiXtqRcUeyp7xxolZqsPfP18trNdGTfJX0iqFOY2', 3),
(96, 'Keita', 'Diariatou', 'keita@gmail.com', '$2y$10$NTvS2zAagP25IJ3lvfe4/eubi.7FsFKfk3yJudpCrerPrnXUprHFe', 3),
(97, 'Sy', 'Kani', 'kani223@gmail.com', '$2y$10$jAYYp6mkLS2TB9x1MtZIQu1kTcH/LiikgA1A/vdSQHuM8OL2T5mlq', 3),
(98, 'kaba', 'Kamel', 'kani12@gmail.com', '$2y$10$t6Eix06JfoX.Tfvyd82/qO5fNR83k2R6o7UTwk90qh6Udn.0QBsFa', 3),
(99, 'Kante', 'Sina', 'SINA@gmail.com', '$2y$10$yMbSVtKLsmZCxANxhE7gFuP0vNwH.0ldckINC2xWJ4wOljALnYgv6', 3),
(100, 'Kante', 'Maria', 'maria@gmail.com', '$2y$10$FBcEmWNAWt4pzc0vSxhomepLf5dgUrbRzTBe9OXkdIVgm/zxOPxBa', 3),
(101, 'Sow', 'Yah', 'sow@gmail.com', '$2y$10$oHEnY3P.uMG/KASHvJs2R.kaU8kXRYsnnn2q407hv57949/g8icGW', 3),
(106, 'Kante', 'brigitte', 'kele@gmail.com', '$2y$10$ZJ9RiR9Esyl4jJNMoprCweVwHpdpWz/A0lHSpni/oNK6eK4NTUcju', 3),
(107, 'Kante', 'BIBI', 'bibi@gmail.com', '$2y$10$02zMe18NoI/kv2MgYqFTKuP19FBocloMPk3GLLWrm7GvMYIkxMEB.', 3),
(108, 'Kante', 'BIBI', 'bidfsfdsfdsdfsdfsbi@gmail.com', '$2y$10$PUj63kP64Nu5cWkX3KQ0T.lfgXGLceE1PyKBmnW8fiR7CQZ.SU0C.', 3),
(109, 'Kante', 'BIBI', 'bidfsfdsfdsdfddddsdfsbi@gmail.com', '$2y$10$1AZzMZetN4ltw3MdE6ZAvOedJXCHOkZaNATu2UmUzHNFpZfe8Mmz.', 3),
(110, 'Badin', 'Johanne', 'johanne.test@gmail.com', '$2y$10$g1/fjS2vfg.L848WEsYETei3T.fMPbCRHANkCUw/W5Oh0q2sZfLmi', 3),
(114, 'Kante', 'DJIBRIL', 'sy60m@gmail.com', '$2y$10$wz8crZigJTLAa6qWXaeM8urqFnb.OXVBRl9/4aRQSb4hqVeESluuS', 3),
(115, 'Kante', 'DJIBRIL', 'khhjgjhgukj@gmail.com', '$2y$10$Sr4otax1/otxNWNSdiZXjOLQYdWvrzgHEUSGMKEQAvxhIapcZYdtC', 3),
(116, 'Samake', 'Fousseyne', 'samake223@gmail.com', '$2y$10$6J36yFAhZZseY7yS5I/JPubUQK8GBs2JhYGzATsk/xcBsNKHW/cVa', 3),
(118, 'Kante', 'Mohamed', 'mohamed17@gmail.com', '$2y$10$jEIyHNginEZAwomNp5XFq.amEQaOiuefTtsVdZ9BP8q2.srrHwj5W', 3),
(119, 'Cisse', 'Ismael', 'CISSE@gmail.com', '$2y$10$HsEOcA3ettCiwfsrroQGE.84dbrr1zLwY6cPcSm.z6AUDpgrOal62', 3),
(120, 'Cisse', 'Ismael', 'CISSE223kkkkkkkk@gmail.com', '$2y$10$NDdoCmHw1/eU7hYE56DKWe2pHVafOVZ8GHiUPQdBbS8MWmfp1FCTu', 3),
(121, 'KANTE', 'Mariam', 'mariamK@gmail.com', '$2y$10$0lfZiZUmghQpsX6KaNRAjuT3w4M8yF65bdeRPFQ.WkAPF8NnAj6Re', 3),
(122, 'KANTE', 'Mariam', 'mariamD@gmail.com', '$2y$10$jWtBuElJaWZ8G/UNpwqPbufIqoFgcegEmFP3n9yf17t/OS7Jr8e2K', 3),
(123, 'KANTE', 'Mariam', 'mariam12@gmail.com', '', 3),
(124, 'KANTE', 'Mariam', 'bibi12@gmail.com', '', 3),
(125, 'Diakite', 'Mariam', 'Mariam01@gmail.com', '$2y$10$EaoULdbcj6/ClYCMt.5Zx.YbRQ8abwm8IbfMUhbHHQsvOCtwXGruS', 3),
(126, 'KANTE', 'Mariam', 'mariam45@gmail.com', '$2y$10$XRNQrQpFmRVPzFu6nye9du/HQPV8q6wGUO6ALaidw3mraQ6VKWRI6', 3),
(127, 'Dupont', 'Fati', 'manu@gmail.com', '$2y$10$8crQucdKL0ELYt82xG1wlO4UlLu5ERoLpvBYPMA8IGPqUeq3jsgRa', 3),
(128, 'Diakite', 'Mariam', 'sy6025@gmail.com', '$2y$10$c/hPVTybzpO82tW6wWFbSulKWvdWrYoZ5506nlRKuFM5id7IhZpTC', 3),
(129, 'Dupont', 'Mariam', 'm.dupont60@gmail.com', '$2y$10$nqUdDsPSls1nHhbEr3Hja.Os9wn2qgB5UdzrAz3uyI7hSSdq5ZHe2', 3),
(132, 'Badin', 'Johanne', 'test@testaheader.fr', '$2y$10$pF8KnTw91rKqWj2IG1XfVeBFfjir4/ebqtWnZ1vSn488KKdYX3nYm', 3),
(133, 'Badin', 'Johanne', 'm.dupont601111112@gmail.com', '$2y$10$9fbra0B5ZidYlKQzEe.ibe82Vg0rIdpnJlfJ6qAq7Puu3GVSkv/um', 3),
(134, 'Kante', 'brigitte', 'samake223jkhkjhkhhkj@gmail.com', '$2y$10$NVKWgtziKlD90T8P9NkPA.dst/lcl1rNpIFsVrs9Agvw3lJed.xCe', 3),
(135, 'Kante', 'brigitte', 'samake223jkhkjjjjjjhkhhkj@gmail.com', '$2y$10$DJxjCxXy7KUBru4SuEaEHO9LdnbbHqsHCGYu4XQUEVhVD9xz.R/Gu', 3),
(136, 'Camara', 'Bilel', 'bilel17@gmail.com', '$2y$10$lmwZT2hEAi/tDaJCxUVIYuxoRgEUYtEWTQel3r/It4WqUJmjWoaMe', 3),
(137, 'KANTE', 'Mohamed', 'mohamed2017@gmail.com', '$2y$10$e5FMQQxq93UNBOJIJSeEw.ZaxRrRrE/G2OqPcGLTlXVMFAIczUIx2', 3),
(138, 'LAMIABLE', 'Elise', 'elise@test.fr', '$2y$10$HlwOkz59M4rOjBvFL5g3selNqe2FpyzcAM51F1fAJlPnt2qWG8xcK', 3),
(139, 'KANTE', 'Maimouna', 'admin@gmail.com', '$2y$10$w8YWEqmwQzDEDf/BXGzE6edfLBsjYdGH2QX.pe63F2Ea6lgGL4yBG', 2),
(140, 'Dupont', 'Elise', 'dupont60@gmail.com', '$2y$10$T8FE.GPfNH3loA78zFgKYeUiJnehmU4mO6d1jKCLwvo1ewWJHQsSa', 3);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `dom20_appointments`
--
ALTER TABLE `dom20_appointments`
  ADD CONSTRAINT `dom20_appointments_dom20_doctors_FK` FOREIGN KEY (`id_dom20_doctors`) REFERENCES `dom20_doctors` (`id`),
  ADD CONSTRAINT `dom20_appointments_dom20_patients1_FK` FOREIGN KEY (`id_dom20_patients`) REFERENCES `dom20_patients` (`id`),
  ADD CONSTRAINT `dom20_appointments_dom20_timeSlots0_FK` FOREIGN KEY (`id_dom20_timeSlots`) REFERENCES `dom20_timeslots` (`id`);

--
-- Contraintes pour la table `dom20_comments`
--
ALTER TABLE `dom20_comments`
  ADD CONSTRAINT `dom20_comments_dom20_doctors_FK` FOREIGN KEY (`id_dom20_doctors`) REFERENCES `dom20_doctors` (`id`);

--
-- Contraintes pour la table `dom20_doctors`
--
ALTER TABLE `dom20_doctors`
  ADD CONSTRAINT `dom20_doctors_dom20_practiceplace_FK` FOREIGN KEY (`id_dom20_practiceplace`) REFERENCES `dom20_practiceplace` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `dom20_doctors_dom20_specialities0_FK` FOREIGN KEY (`id_dom20_specialities`) REFERENCES `dom20_specialities` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `dom20_doctors_dom20_users_FK` FOREIGN KEY (`id_dom20_users`) REFERENCES `dom20_users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Contraintes pour la table `dom20_doctorsleftdocument`
--
ALTER TABLE `dom20_doctorsleftdocument`
  ADD CONSTRAINT `dom20_doctorsLeftDocument_dom20_doctors_FK` FOREIGN KEY (`id`) REFERENCES `dom20_doctors` (`id`),
  ADD CONSTRAINT `dom20_doctorsLeftDocument_dom20_reports0_FK` FOREIGN KEY (`id_dom20_reports`) REFERENCES `dom20_reports` (`id`);

--
-- Contraintes pour la table `dom20_patients`
--
ALTER TABLE `dom20_patients`
  ADD CONSTRAINT `dom20_patients_dom20_users_FK` FOREIGN KEY (`id_dom20_users`) REFERENCES `dom20_users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Contraintes pour la table `dom20_patientsleftcomment`
--
ALTER TABLE `dom20_patientsleftcomment`
  ADD CONSTRAINT `dom20_patientsLeftComment_dom20_comments0_FK` FOREIGN KEY (`id_dom20_comments`) REFERENCES `dom20_comments` (`id`),
  ADD CONSTRAINT `dom20_patientsLeftComment_dom20_patients_FK` FOREIGN KEY (`id`) REFERENCES `dom20_patients` (`id`);

--
-- Contraintes pour la table `dom20_reports`
--
ALTER TABLE `dom20_reports`
  ADD CONSTRAINT `dom20_reports_dom20_reportTypes_FK` FOREIGN KEY (`id_dom20_reportTypes`) REFERENCES `dom20_reporttypes` (`id`);

--
-- Contraintes pour la table `dom20_users`
--
ALTER TABLE `dom20_users`
  ADD CONSTRAINT `dom20_users_dom20_roles_FK` FOREIGN KEY (`id_dom20_roles`) REFERENCES `dom20_roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

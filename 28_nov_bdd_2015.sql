-- phpMyAdmin SQL Dump
-- version 4.4.14.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Sam 28 Novembre 2015 à 12:36
-- Version du serveur :  5.5.46-0+deb7u1-log
-- Version de PHP :  5.4.45-0+deb7u2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `lama`
--
CREATE DATABASE IF NOT EXISTS `lama` DEFAULT CHARACTER SET utf8 COLLATE utf8_roman_ci;
USE `lama`;

-- --------------------------------------------------------

--
-- Structure de la table `journal`
--

CREATE TABLE IF NOT EXISTS `journal` (
  `id` int(10) unsigned NOT NULL,
  `numero` int(11) NOT NULL,
  `date` varchar(20) COLLATE utf8_roman_ci NOT NULL,
  `text` text COLLATE utf8_roman_ci NOT NULL,
  `type` text COLLATE utf8_roman_ci NOT NULL,
  `titre` text COLLATE utf8_roman_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci;

--
-- Vider la table avant d'insérer `journal`
--

TRUNCATE TABLE `journal`;
--
-- Contenu de la table `journal`
--

INSERT INTO `journal` (`id`, `numero`, `date`, `text`, `type`, `titre`) VALUES
(1, 1, '06 aoÃ»t 2014', 'Un Ã©tÃ© gris, des journÃ©es pour le moins humides, on sâ€™occupe comme on peutâ€¦ Aujourdâ€™hui on dÃ©cide de jouer avec la nourriture. Toujours avec ma complice Louise, qui chaussera pour aujourdâ€™hui sa toque de chef.\r\n', 'Photographie', 'On joue avec la nourriture'),
(2, 2, '23 aoÃ»t 2014', 'Cet Ã©tÃ© jâ€™ai Ã©tÃ© conviÃ© Ã  un mariage Ã  Trolly breuil, jâ€™avais pour mission de faire quelques photos des mariÃ©s. Avec ma complice Louise Smith, on a trouvÃ© une butte qui surplom-\r\nbait des grands champs de culture, qui offrait ainsi une belle profondeur aux photos.\r\n', 'Photographie', 'Un joyeux mariage'),
(3, 3, '10 novembre 2014', ' Le groupement forestier Bois Guillaume, une entreprise qui vend des sapins, mâ€™a confiÃ© la conception et la rÃ©alisation de sa campagne publicitaire de NoÃ«l. Je me lance dans la crÃ©ation de visuels en papier dÃ©coupÃ©.', 'Photos, papier dÃ©coupÃ©', 'Ã  chacun son sapin'),
(4, 4, '4 novembre 2014', 'Total de la campagne publicitaire Â«Ã€ chacun son sapinÂ» : 65 sapins, 15 maisons, 3 immeubles, un lac, 2 bateaux, 3 camions, un bonhomme de neige et deux personnages ! ', 'Photos, papier dÃ©coupÃ©', ' Making-of'),
(6, 5, '10 Janvier 2015', 'L''agence lama* vous souhaite une belle, joyeuse et crÃ©ative annÃ©e 2015 !\r\n', 'Photographie', 'Carte de voeux 2015'),
(8, 6, '3 mars 2015', 'Propositions pour une publicitÃ© pour la marque Vertical dans un magazine de sport.', 'Mise en page', 'Pub Vertical'),
(9, 7, '5 mars 2015', 'Pas de place pour le dÃ©tail, seulement des silhouettes arrondies et lourdes qui imposent leur corps au support, se cognent et parfois passent au travers.', 'Peinture', 'Formes fÃ©minines'),
(10, 8, '20 juin 2015', ' Un week-end Ã  la campagne lyonnaise, j''en profite pour essayer mon nouvel appareil photo tÃ©lÃ©mÃ©trique en photo d''action.', '', 'fouet'),
(11, 9, '2 septembre 2015', 'Nouveau site, nouveau cv, nouvelle stratÃ©gie pour dÃ©crocher un entretien et un travail.', '', 'self promotion'),
(12, 10, '7 septembre 2015', 'J''ai commencÃ© une nouvelle sÃ©rie de reportages sur des mÃ©tiers oubliÃ©s. Voici le premier de la sÃ©rie, Pascale bergÃ¨re et fromagÃ¨re.', 'Photographie', 'La bergerie'),
(13, 11, '30 septembres 2015', 'Pour cette seconde Ã©dition de la campagne Ã€ chacun son sapin, le site internet a le droit Ã  un petit rafraÃ®chissement.\r\n', 'webdesign', 'Ã€ chacun son sapin'),
(14, 12, '1 octobre 2015', ' Une pomme mangÃ©e en 63 coups de dents, une affiche rÃ©alisÃ© Ã  moindre coup pour un colloque de psychologie sur Lille. Religions et politiques contemporaines de la sexualitÃ© et de la filiation.\r\n', 'Photographie', 'Religions et sexualitÃ©'),
(15, 13, '3 octobre 2015', 'La sÃ©rigraphie n''a plus de secrets pour moi, je sors d''un stage (avec Louise) dans un atelier d''artiste Ã  Saint Denis.', 'Photographie', 'Stage SÃ©rigraphie'),
(16, 14, '14 novembre 2015', 'J''ai profitÃ© de mon stage chez Unica SÃ©ries pour imprimer quelques cartes de visite en sÃ©rigraphie. DiffÃ©rentes couleurs, diffÃ©rents supports. Ici, en orange fluo et en noir.', 'Photographie', 'Carte de visite'),
(17, 15, '16 novembre 2015', 'Aujourd''hui sÃ©ance de photo de T-shirts sÃ©rigraphiÃ©s suite Ã  la crÃ©ation de mon nouveau logotype !', 'Photographie', 'Logotype');

-- --------------------------------------------------------

--
-- Structure de la table `photo`
--

CREATE TABLE IF NOT EXISTS `photo` (
  `id` int(10) unsigned NOT NULL,
  `titre` varchar(40) COLLATE utf8_roman_ci NOT NULL,
  `date` varchar(20) COLLATE utf8_roman_ci NOT NULL,
  `numero` int(11) NOT NULL,
  `nom_couverture` varchar(40) COLLATE utf8_roman_ci NOT NULL,
  `alt_couverture` varchar(40) COLLATE utf8_roman_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci;

--
-- Vider la table avant d'insérer `photo`
--

TRUNCATE TABLE `photo`;
--
-- Contenu de la table `photo`
--

INSERT INTO `photo` (`id`, `titre`, `date`, `numero`, `nom_couverture`, `alt_couverture`) VALUES
(1, 'Ces gens-lÃ ', 'novembre 2013', 1, '1.jpg', 'montagne dans la brume'),
(2, 'Souffle Tsigane', 'dÃ©cembre 2013', 2, '2.jpg', 'danse'),
(3, 'Un mariage tzigane', 'aoÃ»t 2014', 3, '3.jpg', 'unknow'),
(4, 'Des enfants rue de Rosny', 'aoÃ»t 2014', 4, '4.jpg', 'unknow'),
(5, 'Brume en Chartreuse', 'juillet 2014', 5, '5.jpg', 'unknow'),
(6, 'Une aprÃ¨s-midi de pÃªche', 'mars 2015', 6, '6.jpg', 'unknow'),
(7, 'Papier oubliÃ©', 'mai 2015', 7, '7.jpg', 'photo'),
(8, 'La Bergerie', 'AoÃ»t 2015', 8, '8.jpg', 'photo');

-- --------------------------------------------------------

--
-- Structure de la table `photo_journal`
--

CREATE TABLE IF NOT EXISTS `photo_journal` (
  `id` int(10) unsigned NOT NULL,
  `id_journal` int(11) NOT NULL,
  `nom` varchar(20) COLLATE utf8_roman_ci NOT NULL,
  `alt` varchar(40) COLLATE utf8_roman_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci;

--
-- Vider la table avant d'insérer `photo_journal`
--

TRUNCATE TABLE `photo_journal`;
--
-- Contenu de la table `photo_journal`
--

INSERT INTO `photo_journal` (`id`, `id_journal`, `nom`, `alt`) VALUES
(1, 1, '1_1.jpg', ''),
(2, 1, '1_2.jpg', ''),
(3, 2, '2_1.jpg', ''),
(4, 3, '3_1.jpg', ''),
(5, 3, '3_2.jpg', ''),
(6, 4, '4_1.jpg', ''),
(7, 4, '4_2.jpg', ''),
(17, 6, '6_1.jpg', ''),
(18, 6, '6_2.jpg', ''),
(19, 6, '6_3.jpg', ''),
(22, 8, '8_1.jpg', ''),
(23, 9, '9_1.jpg', ''),
(24, 9, '9_2.jpg', ''),
(25, 9, '9_3.jpg', ''),
(29, 10, '10_1.jpg', ''),
(30, 10, '10_2.jpg', ''),
(31, 11, '11_1.jpg', ''),
(32, 12, '12_1.jpg', ''),
(33, 12, '12_2.jpg', ''),
(34, 12, '12_3.jpg', ''),
(41, 13, '13_1.jpg', ''),
(42, 13, '13_2.jpg', ''),
(43, 13, '13_3.jpg', ''),
(44, 13, '13_4.jpg', ''),
(45, 14, '14_1.jpg', ''),
(46, 14, '14_2.jpg', ''),
(47, 15, '15_1.jpg', ''),
(48, 15, '15_2.jpg', ''),
(49, 15, '15_3.jpg', ''),
(50, 16, '16_1.jpg', ''),
(51, 16, '16_2.jpg', ''),
(52, 17, '17_1.jpg', ''),
(53, 17, '17_2.jpg', ''),
(54, 17, '17_3.jpg', '');

-- --------------------------------------------------------

--
-- Structure de la table `photo_photo`
--

CREATE TABLE IF NOT EXISTS `photo_photo` (
  `id` int(10) unsigned NOT NULL,
  `id_photo` int(11) NOT NULL,
  `nom` varchar(40) COLLATE utf8_roman_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=236 DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci;

--
-- Vider la table avant d'insérer `photo_photo`
--

TRUNCATE TABLE `photo_photo`;
--
-- Contenu de la table `photo_photo`
--

INSERT INTO `photo_photo` (`id`, `id_photo`, `nom`) VALUES
(128, 1, '1.jpg'),
(129, 1, '2.jpg'),
(130, 1, '3.jpg'),
(131, 1, '4.jpg'),
(132, 1, '5.jpg'),
(133, 1, '6.jpg'),
(134, 1, '7.jpg'),
(135, 1, '8.jpg'),
(136, 1, '9.jpg'),
(137, 2, '1.jpg'),
(138, 2, '2.jpg'),
(139, 2, '3.jpg'),
(140, 2, '4.jpg'),
(141, 2, '5.jpg'),
(142, 2, '6.jpg'),
(143, 2, '7.jpg'),
(144, 2, '8.jpg'),
(146, 2, '10.jpg'),
(147, 2, '11.jpg'),
(148, 2, '12.jpg'),
(149, 2, '13.jpg'),
(150, 2, '14.jpg'),
(151, 2, '15.jpg'),
(152, 2, '16.jpg'),
(153, 2, '17.jpg'),
(154, 2, '18.jpg'),
(155, 2, '19.jpg'),
(156, 2, '20.jpg'),
(157, 2, '21.jpg'),
(158, 2, '22.jpg'),
(159, 3, '1.jpg'),
(160, 3, '2.jpg'),
(161, 3, '3.jpg'),
(162, 3, '4.jpg'),
(163, 3, '5.jpg'),
(164, 3, '6.jpg'),
(165, 3, '7.jpg'),
(166, 3, '8.jpg'),
(167, 3, '9.jpg'),
(168, 3, '10.jpg'),
(169, 3, '11.jpg'),
(170, 3, '12.jpg'),
(171, 4, '1.jpg'),
(172, 4, '2.jpg'),
(173, 4, '3.jpg'),
(174, 4, '4.jpg'),
(175, 4, '5.jpg'),
(176, 4, '6.jpg'),
(177, 4, '7.jpg'),
(178, 4, '8.jpg'),
(179, 4, '9.jpg'),
(180, 4, '10.jpg'),
(181, 4, '11.jpg'),
(182, 4, '12.jpg'),
(183, 4, '13.jpg'),
(184, 4, '14.jpg'),
(185, 4, '15.jpg'),
(186, 4, '16.jpg'),
(187, 4, '17.jpg'),
(188, 4, '18.jpg'),
(189, 4, '19.jpg'),
(190, 4, '20.jpg'),
(191, 4, '21.jpg'),
(192, 4, '22.jpg'),
(193, 4, '23.jpg'),
(194, 4, '24.jpg'),
(195, 4, '25.jpg'),
(196, 5, '1.jpg'),
(197, 5, '2.jpg'),
(198, 5, '3.jpg'),
(199, 5, '4.jpg'),
(200, 5, '5.jpg'),
(201, 5, '6.jpg'),
(202, 5, '7.jpg'),
(203, 5, '8.jpg'),
(204, 5, '9.jpg'),
(205, 5, '10.jpg'),
(206, 5, '11.jpg'),
(207, 6, '1.jpg'),
(208, 6, '2.jpg'),
(209, 6, '3.jpg'),
(210, 6, '4.jpg'),
(211, 6, '5.jpg'),
(212, 6, '6.jpg'),
(213, 6, '7.jpg'),
(214, 7, '1.jpg'),
(215, 7, '2.jpg'),
(216, 7, '3.jpg'),
(217, 7, '4.jpg'),
(218, 7, '5.jpg'),
(219, 7, '6.jpg'),
(220, 7, '7.jpg'),
(221, 7, '8.jpg'),
(222, 8, '1.jpg'),
(223, 8, '2.jpg'),
(224, 8, '3.jpg'),
(225, 8, '4.jpg'),
(226, 8, '5.jpg'),
(227, 8, '6.jpg'),
(228, 8, '7.jpg'),
(229, 8, '8.jpg'),
(230, 8, '9.jpg'),
(231, 8, '10.jpg'),
(232, 8, '11.jpg'),
(233, 8, '12.jpg'),
(234, 8, '13.jpg'),
(235, 8, '14.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `photo_projet`
--

CREATE TABLE IF NOT EXISTS `photo_projet` (
  `id` int(10) unsigned NOT NULL,
  `nom` varchar(20) COLLATE utf8_roman_ci NOT NULL,
  `id_projet` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=310 DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci;

--
-- Vider la table avant d'insérer `photo_projet`
--

TRUNCATE TABLE `photo_projet`;
--
-- Contenu de la table `photo_projet`
--

INSERT INTO `photo_projet` (`id`, `nom`, `id_projet`) VALUES
(207, '26_1.jpg', 26),
(208, '26_2.jpg', 26),
(209, '26_3.jpg', 26),
(210, '26_4.jpg', 26),
(211, '26_5.jpg', 26),
(212, '26_6.jpg', 26),
(213, '26_7.jpg', 26),
(214, '26_8.jpg', 26),
(225, '29_1.jpg', 29),
(226, '29_2.jpg', 29),
(227, '29_3.jpg', 29),
(228, '29_4.jpg', 29),
(229, '29_5.jpg', 29),
(230, '30_1.jpg', 30),
(231, '30_2.jpg', 30),
(232, '30_3.jpg', 30),
(233, '30_4.jpg', 30),
(234, '30_5.jpg', 30),
(235, '31_1.jpg', 31),
(236, '31_2.jpg', 31),
(237, '31_3.jpg', 31),
(238, '31_4.jpg', 31),
(239, '31_5.jpg', 31),
(240, '31_6.jpg', 31),
(241, '31_7.jpg', 31),
(242, '31_8.jpg', 31),
(243, '32_1.jpg', 32),
(244, '32_2.jpg', 32),
(245, '32_3.jpg', 32),
(246, '32_4.jpg', 32),
(247, '32_5.jpg', 32),
(248, '32_6.jpg', 32),
(249, '32_7.jpg', 32),
(250, '32_8.jpg', 32),
(253, '33_3.jpg', 33),
(254, '33_4.jpg', 33),
(255, '33_5.jpg', 33),
(256, '33_6.jpg', 33),
(257, '34_1.jpg', 34),
(258, '34_2.jpg', 34),
(259, '34_3.jpg', 34),
(260, '34_4.jpg', 34),
(261, '34_5.jpg', 34),
(262, '34_6.jpg', 34),
(263, '34_7.jpg', 34),
(264, '34_8.jpg', 34),
(265, '34_9.jpg', 34),
(269, '35_1.jpg', 35),
(270, '35_2.jpg', 35),
(271, '35_3.jpg', 35),
(272, '35_4.jpg', 35),
(273, '35_5.jpg', 35),
(274, '36_1.jpg', 36),
(275, '36_2.jpg', 36),
(276, '36_3.jpg', 36),
(277, '36_4.jpg', 36),
(278, '36_5.jpg', 36),
(279, '36_6.jpg', 36),
(280, '36_7.jpg', 36),
(297, '34_10.jpg', 34),
(298, '34_11.jpg', 34),
(299, '34_12.jpg', 34),
(300, '34_13.jpg', 34),
(301, '34_14.jpg', 34),
(302, '34_15.jpg', 34),
(303, '37_1.png', 37),
(304, '37_2.png', 37),
(305, '37_3.png', 37),
(306, '37_4.png', 37),
(307, '37_5.jpg', 37),
(308, '37_6.jpg', 37),
(309, '37_7.jpg', 37);

-- --------------------------------------------------------

--
-- Structure de la table `projet`
--

CREATE TABLE IF NOT EXISTS `projet` (
  `id` int(10) unsigned NOT NULL,
  `titre` varchar(255) COLLATE utf8_roman_ci NOT NULL,
  `description` text COLLATE utf8_roman_ci NOT NULL,
  `photo_principale` varchar(20) COLLATE utf8_roman_ci NOT NULL,
  `commandataire` text COLLATE utf8_roman_ci NOT NULL,
  `commande` text COLLATE utf8_roman_ci NOT NULL,
  `date` varchar(20) COLLATE utf8_roman_ci NOT NULL,
  `composition` text COLLATE utf8_roman_ci NOT NULL,
  `sous_titre` varchar(255) COLLATE utf8_roman_ci NOT NULL,
  `lettre` varchar(5) COLLATE utf8_roman_ci NOT NULL,
  `gras` text COLLATE utf8_roman_ci NOT NULL,
  `normal` text COLLATE utf8_roman_ci NOT NULL,
  `photographie` varchar(255) COLLATE utf8_roman_ci NOT NULL,
  `medium` varchar(255) COLLATE utf8_roman_ci NOT NULL,
  `note` text COLLATE utf8_roman_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COLLATE=utf8_roman_ci;

--
-- Vider la table avant d'insérer `projet`
--

TRUNCATE TABLE `projet`;
--
-- Contenu de la table `projet`
--

INSERT INTO `projet` (`id`, `titre`, `description`, `photo_principale`, `commandataire`, `commande`, `date`, `composition`, `sous_titre`, `lettre`, `gras`, `normal`, `photographie`, `medium`, `note`) VALUES
(26, 'Arrondies et Anguleux', 'Recherche de personnages et modÃ¨le vivant.', '26_principale.jpg', '', ' Enrte le contenu ici.', '2013-2014', ' Enrte le contenu ici.', '', 'ne pa', 'ne pas utiliser', 'La courbe dâ€™une Ã©paule, le dÃ©liÃ© dâ€™un bras, dâ€™un dos, la rondeur dâ€™un sein, une fesse galbÃ©e, le pli dâ€™un genouâ€¦ Jâ€™observe les corps et leurs formes. Je suis particuliÃ¨rement interpelÃ© par les dÃ©formations que peut subir ce corps ; la joue qui sâ€™affaisse en vieillissant, la torsion du dos lorsque lâ€™on se retourne, les plis du ventre quand on sâ€™assoit, les cheveux qui dansent, le volume extraordinaire du ventre dâ€™une femme enceinte, la chair opulente qui semble Ãªtre en mouvement constant, sâ€™Ã©taler et se dÃ©ployer.', 'Baptiste Plantin', 'Illustration, recherche', ''),
(29, 'Affiches Rossignol', 'Participation Ã  diverses campagnes publicitaires.', '29_principale.jpg', '', 'Enrte le contenu ici.', 'Juin 2013', 'Enrte le contenu ici.', '', 'ne pa', 'ne pas utiliser', 'Durant mon stage au sein du groupe Rossignol, jâ€™ai rÃ©alisÃ© divers supports pour la communication interne et externe de la marque. Il sâ€™agissait Ã©galement dâ€™expÃ©rimenter et dâ€™appliquer la toute nouvelle charte graphique du groupe.<br /> Jâ€™ai Ã©tÃ© chargÃ© de dÃ©cliner la Â« campagne women Â» de Rossignol sur diffÃ©rents supports, de rÃ©aliser une PublicitÃ© sur le Lieu de Vente destinÃ©e Ã  promouvoir les produits Rossignol dans les magasins DÃ©cathlon et enfin de crÃ©er une gamme de posters et cartes postales. Jâ€™ai eu pour mission de proposer pour cette derniÃ¨re une nouvelle maquette plus actuelle, plus en cohÃ©rence avec lâ€™image de la marque et conÃ§ue selon sa nouvelle charte graphique.<br /> Photo de la campagne Women : Sasha Goldberger', 'Baptiste Plantin', 'Print, affiche', ''),
(30, 'Loyalty Program', 'CrÃ©ation de huit pictogrammes.', '30_principale.jpg', '', ' Enrte le contenu ici.', 'Juillet 2013', ' Enrte le contenu ici.', '', 'ne pa', 'ne pas utiliser', 'Afin de fidÃ©liser sa clientÃ¨le, Rossignol lance un programme de fidÃ©litÃ© permettant Ã  ses clients de cumuler des points, dâ€™obtenir des avantages exclusifs, etc. Jâ€™ai Ã©tÃ© chargÃ© de crÃ©er des pictogrammes illustrant les diffÃ©rents aspects de ce programme et de rÃ©flÃ©chir Ã  lâ€™intÃ©gration de ces pictogrammes Ã  diffÃ©rents supports. Ils sont prÃ©sentÃ©s sur fond noir, rouge ou blanc, avec ou sans pastille, selon lâ€™atmosphÃ¨re que lâ€™on souhaite vÃ©hiculer. En effet, les pictogrammes donnent une identitÃ© visuelle au programme de fidÃ©litÃ© et dÃ©finissent lâ€™esprit du Â« Club Â». Un graphique venait ensuite mettre en relation diffÃ©rentes vignettes afin dâ€™expliquer le fonctionnement de la transformation des Â« points Rossignol Â» en bons dâ€™achat.<br /> Direction artistique : Simon Baret. Photos : Vanessa Andrieux', 'Baptiste Plantin', 'Picto, print, web', ''),
(31, 'Projections GÃ©omÃ©triques', 'Objet Ã©ditorial constituant mon projet de fin d''Ã©tudes.', '31_principale.jpg', '', ' Enrte le contenu ici.', 'AoÃ»t 2013', ' Enrte le contenu ici.', '', 'ne pa', 'ne pas utiliser', 'Cet ensemble constituÃ© dâ€™un coffret  contenant un livre de 55 pages, un lexique et un jeu de tangram prÃ©sente les diffÃ©rents projets sur lesquels jâ€™ai Ã©tÃ© amenÃ© Ã  travailler au cours de mon stage de fin dâ€™Ã©tudes. En effet jâ€™ai choisi pour ce travail de mise en page, dâ€™analyse et de rÃ©daction de mâ€™appuyer sur la forme du tangram. Elle exprime mon approche ludique et curieuse du graphisme ainsi que ma recherche de perfection : le tangram est constituÃ© de sept Ã©lÃ©ments que lâ€™on peut rÃ©-agencer sans cesse, jusquâ€™Ã  trouver la forme parfaite. La mise en page suit ce principe : les diffÃ©rents Ã©lÃ©ments (images et texte) sont agencÃ©s comme dans un puzzle et une grande attention est accordÃ©e au blanc qui entoure chaque piÃ¨ce.', 'Baptiste Plantin', 'Book design, print', ''),
(32, 'Ces Gens-lÃ ', 'Magazine de reportage sur les Roms d''Ã®le-de-France.', '32_principale.jpg', '', ' Enrte le contenu ici.', 'Juin 2014', ' Enrte le contenu ici.', '', 'ne pa', 'ne pas utiliser', 'Ce travail de mise en page est le compte rendu dâ€™un reportage photographique rÃ©alisÃ© en 2013-2014 en ÃŽle-de-France. La mise en page type magazine correspond bien Ã  ce travail qui lie des situations sociales prÃ©occupantes et au cÅ“ur de lâ€™actualitÃ© Ã  des prÃ©occupations artistiques â€“ la beautÃ© de lâ€™image, le travail de la lumiÃ¨re, des formes, des couleurs et des contrastes. De plus, la presse magazine permet, plus que la presse quotidienne, dâ€™avoir une certaine distance sur lâ€™actualitÃ©. Or ce travail photographique, rÃ©alisÃ© sur plusieurs mois, cherche lui aussi Ã  adopter un regard rÃ©flÃ©chi, Ã  la fois critique et apaisÃ© sur les faits. Ce dossier de presse prÃ©sente plusieurs articles sur un mÃªme sujet et confronte les points de vue. Le regard du photographe fait ainsi lâ€™unitÃ© de ce dossier tout en illustrant des articles diversifiÃ©s.', 'Baptiste Plantin', 'Photographie, book design', ''),
(33, 'Brume en Chartreuse', 'Livre d''art rÃ©alisÃ© Ã  partir d''un texte de Samivel.', '33_principale.jpg', '', ' Enrte le contenu ici.', 'Juillet 2014', ' Enrte le contenu ici.', '', 'ne pa', 'ne pas utiliser', 'CrÃ©ation d''un leporello mettant en relation un texte de Samivel et une sÃ©rie de photos du massif de la Chartreuse. L''objet joue sur la notion de disparition et de rÃ©vÃ©lation ; la brume cache la montagne mais souligne sa majestÃ©. Les photos peuvent Ãªtre dÃ©couvertes une Ã  une en ouvrant le livre page par page ou bien toutes en mÃªme temps si le leporello est entiÃ¨rement dÃ©pliÃ©. Le massif se dÃ©ploie alors dans l''espace et met en Ã©vidence sa disparition progressive. C''est un objet d''art, luxueux, mÃªlant diverses aptitudes : photographie, mise en page, impression, reliure.', 'Baptiste Plantin', 'Photographie, book design', ''),
(34, 'Ã€ Chacun son sapin', 'Campagne publicitaire Â«Ã€ chacun son SapinÂ»', '34_principale.jpg', '', ' Enrte le contenu ici.', 'Octobre 2014', ' Enrte le contenu ici.', '', 'ne pa', 'ne pas utiliser', 'Le groupement forestier de Bois Guillaume, a souhaitÃ© en 2014 proposer deux solutions innovantes : la livraison Ã  domicile dâ€™un sapin frais et la possibilitÃ© de venir choisir et couper en famille son sapin sur lâ€™exploitation. Il mâ€™a sollicitÃ© pour promouvoir ces nouvelles faÃ§ons dâ€™acheter son sapin de NoÃ«l. Jâ€™ai donc choisi de communiquer Ã  la fois sur le produit et sur lâ€™Ã©vÃ©nement. Il mâ€™a fallu rÃ©flÃ©chir sur le concept, le nom de lâ€™Ã©vÃ©nement, le choix des supports et mettre en place une identitÃ© visuelle adaptÃ©e Ã  la fois au print et au et qui puisse Ã©voluer pour les annÃ©es Ã  venir. Jâ€™ai construit des scÃ¨nettes en papier dÃ©coupÃ© illustrant les deux concepts proposÃ©s. Ce sont des visuels simples et ludiques aux couleurs franches, qui sâ€™inscrivent dans une palette colorÃ©e hivernale. Jâ€™ai choisi comme supports de communication : un site web, une page facebook, des affichages Ã  Lyon, des flyers, des affiches, le dos du magazine rÃ©gional Â« Grains de sel Â», des grands formats pour les bords de route ainsi que de la signalÃ©tiques sur le lieu de la vente. Deux reportages tÃ©lÃ©visÃ©s, plusieurs articles dans les journaux locaux ainsi quâ€™une interview Ã  la radio ont suivi la campagne et renforcÃ© son efficacitÃ©. Lâ€™initiative a donc Ã©tÃ© un succÃ¨s pour une annÃ©e de lancement, les consommateurs ont Ã©tÃ© sÃ©duits par ces nouvelles propositions.', 'Baptiste Plantin', 'DA, Print, Web, id visuelle', ''),
(35, 'Culti''run', 'Conception et design d''une application mobile.', '35_principale.png', '', ' Enrte le contenu ici.', 'Janvier 2015', ' Enrte le contenu ici.', '', 'ne pa', 'ne pas utiliser', 'Cultiâ€™run est un projet innovant et le compagnon idÃ©ale de vos sorties sportives. Appuyez-vous sur ses parcours pour dÃ©couvrir les recoins les plus intÃ©ressant de votre ville, crÃ©ez vos propres parcours, proposer vos propres exercices et nâ€™oubliez pas de partager vos dÃ©couvertes et crÃ©ation avec vos proches ! Cultiâ€™run est la premiÃ¨re application sportivo-culturelle entiÃ¨rement personnalisable. Jâ€™ai souhaitÃ© rÃ©aliser pour cette application un design Ã©lÃ©gant et dynamique ainsi quâ€™une interface pensÃ©e pour une utilisation intuitive.', 'Baptiste Plantin', 'DA, design mobile', ''),
(36, 'Self promotion', 'Nouveau site, nouveau cv, nouvelle stratÃ©gie !', '36_principale.jpg', '', ' Enrte le contenu ici.', 'Septembre 2015', ' Enrte le contenu ici.', '', 'ne pa', 'ne pas utiliser', 'Nouvelle annÃ©e, nouvelle identitÃ© visuelle, nouveaux projets ! Ã€ la recherche dâ€™une Ã©quipe de graphistes avec qui partager ma passion et mon travail, jâ€™ai refondu mon site, mon CV et ma carte de visite afin quâ€™ils correspondent davantage Ã  mes affinitÃ©s graphiques. Je mise sur la simplicitÃ© et le dynamisme pour traduire mon envie de travailler !', 'Baptiste Plantin', 'Webdesign, print, id visuelle', ''),
(37, 'Agence lama', 'Recherches et rÃ©alisation du logo de l''agence lama.', '37_principale.jpg', '', ' Enrte le contenu ici.', '20 novembre 2015', ' Enrte le contenu ici.', '', 'ne pa', 'ne pas utiliser', 'AprÃ¨s avoir revu la charte graphique de lâ€™agence, jâ€™ai ressenti le besoin de donner un coup de neuf Ã  son logo. Il sâ€™agissait dâ€™Ã©crire LAMA en combinant des Ã©lÃ©ments gÃ©omÃ©triques simples. Trois modules de base sont utilisÃ© : le cercle, la ligne et le point. On simplifie ainsi la typographie jusquâ€™Ã  son stade le plus Ã©lÃ©mentaire : des barres et des cercles. La rÃ©pÃ©tition de ces modules crÃ©e un rythme dans le mot. Cela a Ã©galement un aspect ludique : le mot Ã©crit par combinaisons, comme avec un jeu de gommettes.', 'Baptiste Plantin', 'Logo, typographie, photo', '');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `journal`
--
ALTER TABLE `journal`
  ADD KEY `id` (`id`);

--
-- Index pour la table `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `photo_journal`
--
ALTER TABLE `photo_journal`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `photo_photo`
--
ALTER TABLE `photo_photo`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `photo_projet`
--
ALTER TABLE `photo_projet`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `projet`
--
ALTER TABLE `projet`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `journal`
--
ALTER TABLE `journal`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT pour la table `photo_journal`
--
ALTER TABLE `photo_journal`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT pour la table `photo_photo`
--
ALTER TABLE `photo_photo`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=236;
--
-- AUTO_INCREMENT pour la table `photo_projet`
--
ALTER TABLE `photo_projet`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=310;
--
-- AUTO_INCREMENT pour la table `projet`
--
ALTER TABLE `projet`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=38;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

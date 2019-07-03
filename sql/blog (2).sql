-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 15, 2019 at 10:40 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `description`, `image`) VALUES
(1, 'Cinéma', 'Trailers, infos, sorties...', ''),
(2, 'Musique', 'Concerts, sorties d\'albums, festivals...', ''),
(3, 'Théâtre', '', ''),
(4, 'Culture', 'Expositions, musées..', '');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_at` date NOT NULL,
  `content` longtext NOT NULL,
  `summary` text NOT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '1',
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `title`, `created_at`, `content`, `summary`, `is_published`, `image`) VALUES
(1, '« Le Crime de l’Orient Express » : rencontre avec Kenneth Branaghf', '2018-01-10', '<p>Morbi vel erat non mauris convallis vehicula. Nulla et sapien. Integer tortor tellus, aliquam faucibus, convallis id, congue eu, quam. Mauris ullamcorper felis vitae erat.sssss</p>', 'Résumé de l\'article Le Crime de l’Orient Expressssss', 1, NULL),
(2, 'Pourquoi \"Mario + Lapins Crétins : Kingdom Battle\" est le jeu de la rentrée', '2018-01-16', '<p>Integer quis metus vitae elit lobortis egestas. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>', 'Résumé de l\'article Mario + Lapins Crétins', 0, NULL),
(3, 'Pourquoi \"Destiny 2\" est un remède à l’ultra-moderne solitude', '2018-01-14', '<p>Pellentesque rhoncus nunc et augue. Integer id felis. Curabitur aliquet pellentesque diam.</p>', ' Résumé de l\'article Destiny 2', 1, NULL),
(4, 'BO de « Les seigneurs de Dogtown » : l’époque bénie du rock.', '2018-01-03', '<p>Nulla sollicitudin. Fusce varius, ligula non tempus aliquam, nunc turpis ullamcorper nibh, in tempus sapien eros vitae ligula.</p>', 'Résumé de l\'article Les seigneurs de Dogtown', 1, NULL),
(5, 'Comment “Assassin’s Creed” trouve un nouveau souffle en Egypte', '2018-01-06', '<p>Ut velit mauris, egestas sed, gravida nec, ornare ut, mi. Aenean ut orci vel massa suscipit pulvinar.</p>', 'Résumé de l\'article Assassin’s Creed', 0, NULL),
(6, 'De “Skyrim” à “L.A. Noire” ou “Doom” : pourquoi les vieux jeux sont meilleurs sur la Switch', '2018-01-17', '<p>Mauris ac mauris sed pede pellentesque fermentum. Maecenas adipiscing ante non diam sodales hendrerit.</p>', 'Résumé de l\'article Switch', 1, NULL),
(7, 'Revue - The Ramones', '2018-01-08', '<p>Pellentesque sed dui ut augue blandit sodales. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aliquam nibh.</p>', 'Résumé de l\'article The Ramones', 1, NULL),
(8, 'Critique « Star Wars 8 – Les derniers Jedi » de Rian Johnson : le renouveau de la saga ?', '2018-01-01', '<p>Duis semper. Duis arcu massa, scelerisque vitae, consequat in, pretium a, enim. Pellentesque congue.</p>', 'Résumé de l\'article Star Wars 8', 0, NULL),
(14, 'La BO du film « Pixel »', '2018-03-07', '<p>Integer quis metus vitae elit lobortis egestas. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>\r\n<p>Integer quis metus vitae elit lobortis egestas. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>\r\n<p>Integer quis metus vitae elit lobortis egestas. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>', 'Integer quis metus vitae elit lobortis egestas. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.', 1, NULL),
(15, 'Fête de la musique 2019', '2018-04-06', 'Cette année Melun mise sur ses artistes locaux en s’appuyant sur son dispositif « Scène 77 ».\r\n\r\nCrée par la médiathèque Astrolabe, « Scène 77 » fête ses 15 ans. Véritable dénicheur de talents, ce dispositif permet de valoriser les artistes musicaux Seine-et-Marnais, en créant un patrimoine de la musique locale.\r\n\r\nDepuis 2004, plus de 400 albums ont été collectés et mis à disposition du public à l’Astrolabe (sous format CD ou en streaming depuis le portail web de la médiathèque).\r\n\r\n\r\nPour vous faire partager cet univers, et fêter le coup d’envoi de l’été nous vous donnons rendez-vous : Jardin de la Mairie, Place Saint-Jean, Place Jacques Amyot et à la Médiathèque Astrolabe. \r\n\r\n\r\n \r\n\r\nJARDIN DE LA MAIRIE \r\nRejoignez-nous dans les jardins pour un repas en musique\r\n\r\nBuvette & restauration sur place\r\n\r\n20H. « SPARKY IN THE CLOUDS » - FOLK \r\n21H. MAFÉ – ROCK\r\n\r\nDJ SET EN FIN DE SOIRÉE\r\n\r\n\r\n \r\n\r\nPLACE JACQUES AMYOT - Musiques Actuelles – Carte Blanche au Conservatoire\r\n\r\n19H. HARMONIE DES TROIS CONSERVATOIRES\r\n\r\n20H. LE BIGRE BAND\r\n\r\n21H. GROUPES DE MUSIQUES ACTUELLES\r\n\r\nLes élèves investissent la place pour jouer une musique teintée de rock, de pop\r\n\r\net de jazz !\r\n\r\n\r\n \r\n\r\nMÉDIATHÈQUE ASTROLABE -À partir de 17h. Scène ouverte\r\n\r\n\r\n17H - 18H. ÉLÈVES DU CONSERVATOIRE DE MELUN\r\n\r\n18H15. SLAM POÉTIQUE DES PARENTS\r\n\r\n18H45. 19H30. LORD & MIGHTY\r\n\r\n20H-22H30. NEW SAXOMANIA\r\n\r\n\r\n\r\nPLACE SAINT-JEAN\r\n\r\n19H – 20H. L’ORCHESTRE D’HARMONIE DE MELUN\r\n\r\n20H15. NAÏRY\r\n\r\n21H. INES', 'Retrouvez le programme de votre ville pour la fête de la musique !', 1, '9677548ee4ee2f157590053c5c5f56c4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `event_category`
--

CREATE TABLE `event_category` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event_category`
--

INSERT INTO `event_category` (`id`, `event_id`, `category_id`) VALUES
(1, 4, 1),
(2, 4, 2),
(3, 1, 1),
(4, 2, 4),
(5, 3, 4),
(6, 5, 4),
(7, 6, 4),
(8, 7, 2),
(9, 8, 1),
(10, 14, 1),
(11, 14, 2),
(12, 14, 4),
(13, 15, 2);

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `caption` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`id`, `caption`, `name`, `event_id`) VALUES
(19, 'View 4', 'ebe4361baf7318a92facaec817c6d0d9.jpg', 15),
(18, 'View 3', '832353270aacb6e3322f493a66aaf5b9.jpg', 15),
(16, 'View 1', 'f50ebce922538b3c57a3e6b7bbb6d628.jpg', 15),
(17, 'View 2', '1aaa7438a59157a0f21ad30dda4d4088.jpg', 15);

-- --------------------------------------------------------

--
-- Table structure for table `signal_category`
--

CREATE TABLE `signal_category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `signal_category`
--

INSERT INTO `signal_category` (`id`, `name`, `description`, `image`) VALUES
(1, 'Voirie', '', NULL),
(2, 'Signalisation', '', NULL),
(3, 'Espaces verts', '', NULL),
(4, 'Propreté', '', NULL),
(5, 'Autre', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(225) NOT NULL,
  `is_admin` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `email`, `password`, `is_admin`) VALUES
(30, 'Admin', 'TheBrickBox', 'admin@thebrickbox.net', 'b53759f3ce692de7aff1b5779d3964da', 1),
(31, 'User', 'TheBrickBox', 'user@thebrickbox.net', 'b53759f3ce692de7aff1b5779d3964da', 0),
(32, 'Jim', 'Halpert', 'jima.halpert@dundermifflin.com', '91c0f7100bde719c44790e7df757a1a6', 1),
(33, 'sooz', 'vbn', 'sorayabekkouche@live.fr', '8115153332991997460b9f236e0da71a', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_category`
--
ALTER TABLE `event_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `signal_category`
--
ALTER TABLE `signal_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `event_category`
--
ALTER TABLE `event_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `signal_category`
--
ALTER TABLE `signal_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 26, 2022 at 08:30 AM
-- Server version: 10.7.3-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `morla`
--
CREATE DATABASE IF NOT EXISTS `morla` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `morla`;

-- --------------------------------------------------------

--
-- Table structure for table `cuisinier`
--

DROP TABLE IF EXISTS `cuisinier`;
CREATE TABLE `cuisinier` (
  `cid` int(11) UNSIGNED NOT NULL,
  `nom` varchar(31) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(31) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(31) CHARACTER SET ascii DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cuisinier`
--

INSERT INTO `cuisinier` (`cid`, `nom`, `prenom`, `photo`) VALUES
(1, 'Coffe', 'Jean-Pierre', 'cuisinier.1.jpg'),
(2, 'Thé', 'Mai', 'cuisinier.2.jpg'),
(3, 'Bocuse', 'Paul', 'cuisinier.3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `membre`
--

DROP TABLE IF EXISTS `membre`;
CREATE TABLE `membre` (
  `id` int(11) UNSIGNED NOT NULL,
  `pseudo` varchar(31) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(31) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent` varchar(31) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `membre`
--

INSERT INTO `membre` (`id`, `pseudo`, `password`, `parent`) VALUES
(6, 'eric@free.fr', '123456', '8'),
(8, 'kalo@mail.bg', '123456', '6');

-- --------------------------------------------------------

--
-- Table structure for table `remote`
--

DROP TABLE IF EXISTS `remote`;
CREATE TABLE `remote` (
  `rid` int(11) UNSIGNED NOT NULL,
  `ticket` int(11) UNSIGNED NOT NULL,
  `ip` varchar(127) CHARACTER SET ascii NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `remote`
--

INSERT INTO `remote` (`rid`, `ticket`, `ip`) VALUES
(88, 100, '::1'),
(92, 99, '::1'),
(94, 103, '666'),
(95, 103, '777'),
(96, 103, '::1'),
(97, 96, '::1');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

DROP TABLE IF EXISTS `ticket`;
CREATE TABLE `ticket` (
  `id` int(11) UNSIGNED NOT NULL COMMENT 'identifiant',
  `title` varchar(63) NOT NULL COMMENT 'le titre',
  `description` varchar(111) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '''ticket description''' COMMENT 'la description',
  `color` varchar(15) CHARACTER SET ascii NOT NULL COMMENT 'background color',
  `keywords` varchar(111) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '''ticket keywords''' COMMENT 'la \r\nliste des ingrédients',
  `body` varchar(4095) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'les étapes',
  `jour` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'la date de publication',
  `prix` set('1','2','3','4') CHARACTER SET ascii NOT NULL DEFAULT '1' COMMENT 'prix (1 - 4)\r\n',
  `diff` set('1','2','3','4') CHARACTER SET ascii NOT NULL DEFAULT '1' COMMENT 'difficulté (1 - 4)\r\n\r\n',
  `temps` int(6) UNSIGNED NOT NULL DEFAULT 1000 COMMENT 'le temps de réalisation en seconde\r\n',
  `personne` int(3) UNSIGNED NOT NULL DEFAULT 2 COMMENT 'le nombre de personne',
  `hide` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'cacher l''article',
  `cuisinier` int(11) UNSIGNED DEFAULT NULL COMMENT 'l''author d''article',
  `photo` varchar(31) CHARACTER SET ascii DEFAULT NULL COMMENT 'photo file name'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`id`, `title`, `description`, `color`, `keywords`, `body`, `jour`, `prix`, `diff`, `temps`, `personne`, `hide`, `cuisinier`, `photo`) VALUES
(96, 'Choux à la crème frêche', 'Une recette incontournable, des petits choux hiboux cailloux à croquer !', '#f776bf', 'des choux, de la crème du sucre, du poney', 'Préparer la pâte : faire préchauffer le four à 200°C (thermostat 6/7).\r\nFaire chauffer dans une casserole le beurre, l\'eau, le sel et le sucre. Dès que tout est fondu, verser toute la farine d\'un coup et bien mélanger avec une cuillère en bois, jusqu\'à ce que la pâte n’adhère plus à la cuillère ni à la casserole.\r\nHors du feu, ajouter les œufs un à un, puis mélanger à chaque fois ce que le mélange soit bon.\r\nBeurrer une tôle à pâtisserie, puis disposer la pâte en petits tas (18 pour des petits choux, 12 pour des gros). Utiliser pour cela une poche à douille, ou tout simplement deux cuillères.\r\nCuire au four 20 à 25 mn. Petit truc pour vérifier la cuisson : Les choux doivent résister à une pression du doigt (ou de la cuillère, si l\'on a peur de se brûler !).\r\nPréparer la crème pâtissière : faire chauffer dans une casserole le lait, le sel et le sucre vanillé.\r\nPendant que le lait chauffe, travailler dans une grande terrine le sucre et les œufs avec une cuillère en bois jusqu\'à ce que le mélange blanchisse. Incorporer la farine puis, peu à peu, le lait bouillant.\r\nReverser dans la casserole (à allure douce) et remuer jusqu\'à ce que la crème épaississe. Verser dans un plat.\r\nLorsque la crème est refroidie, vous pouvez y ajouter une cuillère à soupe d\'Amaretto ou d\'une autre liqueur (Baileys, Amiaula) Bien mélanger après cet ajout. NB : Ne rien ajouter lorsque la crème est chaude !.\r\nLa touche finale : la préparation des choux. Remplissez de crème la poche à douille et remplissez les choux un à un, en pratiquant un trou dessous (vous n\'avez jamais remarqué, dans les boulangeries, les trous sous les religieuses ?). Si vous n\'avez pas de poche à douille, couper chaque chou à moitié en deux pour y insérer la crème', '2022-03-30 06:59:56', '2', '4', 4800, 2, 0, 3, NULL),
(99, 'Croque-monsieur', 'La fameuse recette pour croquer monsieur.', 'orange', 'pain de mie, fromage, jambon, beurre', 'Beurrez les 8 tranches de pain de mie sur une seule face. \r\nPosez 1 tranche de fromage sur chaque tranche de pain de mie. \r\nPosez 1 tranche de jambon plié en deux sur 4 tranches de pain de mie. \r\nRecouvrez avec les autres tartines (face non beurrée au-dessus). \r\nDans un bol mélanger le fromage râpé avec le lait, le sel, le poivre et la muscade. \r\nRépartissez le mélange sur les croque-monsieur. \r\nPlacez sur une plaque au four sous le grill pendant 10 mn\r\n', '2022-03-30 08:24:44', '3', '1', 1200, 2, 0, 3, NULL),
(100, 'Tartiflette super facile', 'L\'hiver approche, il est temps de préparer une bonne tartiflette des familles...', '#efface', 'de la tarte, de la flette, du fromage, de poney', 'Cuire les pommes de terre à l’eau pendant 20 minutes, puis les éplucher et les couper en rondelles. \r\nEmincer les oignons et les faire revenir dans un peu de beurre. \r\nAjouter les lardons fumés et laisser également revenir à feu assez doux (une dizaine de minutes) en remuant régulièrement. \r\nPréparer un plat de cuisson (j’utilise un plat rond en terre cuite de 40 cm de diamètre, 10 cm de haut). \r\nFrotter généreusement le fond du plat avec une gousse d’ail. Organiser le plat en trois couches : recouvrir le fond du plat de la moitié des pommes de terre, puis ajouter le mélange oignons et lardons, ajouter enfin par-dessus le reste des pommes de terre. \r\nVerser dessus le vin blanc et la crème fleurette. \r\nPoivrer (assez copieusement) et saler (légèrement). \r\nPréchauffer le four à 190°C (thermostat 6-7). \r\nGratter les reblochons, les couper en deux dans l\'épaisseur et les poser (côté croûte en haut) sur le dessus des pommes de terre. \r\nEnfourner environ 20 minutes (je mets le four en « chaleur tournante » + gril). \r\nAu moment de servir (dans le plat de cuisson), on peut saupoudrez d’un peu de persil haché. \r\nCe plat unique se déguste (c’est le mot juste !) accompagné du vin utilisé pour la recette', '2022-03-30 08:24:44', '4', '3', 2700, 2, 0, 1, NULL),
(101, 'Choux à la crème', 'Une recette incontournable, des petits choux hiboux cailloux à croquer !', '#f776bf', 'des choux, de la crème, du sucre, du poney', 'Préparer la pâte : faire préchauffer le four à 200°C (thermostat 6/7).\r\nFaire chauffer dans une casserole le beurre, l\'eau, le sel et le sucre. Dès que tout est fondu, verser toute la farine d\'un coup et bien mélanger avec une cuillère en bois, jusqu\'à ce que la pâte n’adhère plus à la cuillère ni à la casserole.\r\nHors du feu, ajouter les œufs un à un, puis mélanger à chaque fois ce que le mélange soit bon.\r\nBeurrer une tôle à pâtisserie, puis disposer la pâte en petits tas (18 pour des petits choux, 12 pour des gros). Utiliser pour cela une poche à douille, ou tout simplement deux cuillères.\r\nCuire au four 20 à 25 mn. Petit truc pour vérifier la cuisson : Les choux doivent résister à une pression du doigt (ou de la cuillère, si l\'on a peur de se brûler !).\r\nPréparer la crème pâtissière : faire chauffer dans une casserole le lait, le sel et le sucre vanillé.\r\nPendant que le lait chauffe, travailler dans une grande terrine le sucre et les œufs avec une cuillère en bois jusqu\'à ce que le mélange blanchisse. Incorporer la farine puis, peu à peu, le lait bouillant.\r\nReverser dans la casserole (à allure douce) et remuer jusqu\'à ce que la crème épaississe. Verser dans un plat.\r\nLorsque la crème est refroidie, vous pouvez y ajouter une cuillère à soupe d\'Amaretto ou d\'une autre liqueur (Baileys, Amiaula...). Bien mélanger après cet ajout. NB : Ne rien ajouter lorsque la crème est chaude !\r\nLa touche finale : la préparation des choux. Remplissez de crème la poche à douille et remplissez les choux un à un, en pratiquant un trou dessous (vous n\'avez jamais remarqué, dans les boulangeries, les trous sous les religieuses ?). Si vous n\'avez pas de poche à douille, couper chaque chou à moitié en deux pour y insérer la crème.', '2022-03-30 06:59:56', '1', '2', 4800, 2, 0, 2, NULL),
(102, 'Croque-monsieur', 'La fameuse recette pour croquer monsieur.', 'orange', 'pain de mie, fromage, jambon, beurre', 'Beurrez les 8 tranches de pain de mie sur une seule face. \r\nPosez 1 tranche de fromage sur chaque tranche de pain de mie. \r\nPosez 1 tranche de jambon plié en deux sur 4 tranches de pain de mie. \r\nRecouvrez avec les autres tartines (face non beurrée au-dessus). \r\nDans un bol mélanger le fromage râpé avec le lait, le sel, le poivre et la muscade. \r\nRépartissez le mélange sur les croque-monsieur. \r\nPlacez sur une plaque au four sous le grill pendant 10 mn\r\n', '2022-03-30 08:24:44', '2', '1', 1200, 2, 0, 1, NULL),
(103, 'Tartiflette difficile', 'L\'hiver approche, il est temps de préparer une bonne tartiflette des familles...', '#efface', 'de la tarte, de la flette, du fromage, de poney', 'Cuire les pommes de terre à l’eau pendant 20 minutes, puis les éplucher et les couper en rondelles. \r\nEmincer les oignons et les faire revenir dans un peu de beurre. \r\nAjouter les lardons fumés et laisser également revenir à feu assez doux (une dizaine de minutes) en remuant régulièrement. \r\nPréparer un plat de cuisson (j’utilise un plat rond en terre cuite de 40 cm de diamètre, 10 cm de haut). \r\nFrotter généreusement le fond du plat avec une gousse d’ail. Organiser le plat en trois couches : recouvrir le fond du plat de la moitié des pommes de terre, puis ajouter le mélange oignons et lardons, ajouter enfin par-dessus le reste des pommes de terre. \r\nVerser dessus le vin blanc et la crème fleurette. \r\nPoivrer (assez copieusement) et saler (légèrement). \r\nPréchauffer le four à 190°C (thermostat 6-7). \r\nGratter les reblochons, les couper en deux dans l\'épaisseur et les poser (côté croûte en haut) sur le dessus des pommes de terre. \r\nEnfourner environ 20 minutes (je mets le four en « chaleur tournante » + gril). \r\nAu moment de servir (dans le plat de cuisson), on peut saupoudrez d’un peu de persil haché. \r\nCe plat unique se déguste (c’est le mot juste !) accompagné du vin utilisé pour la recette.', '2022-03-30 08:24:44', '4', '3', 2700, 2, 0, 2, NULL),
(104, 'un ticket généré automatiquement', 'la méthode est randomBody', '#ed7de7', 'bedeec', 'ce ticket est autogénéré par la méthode randomBody modelTicket', '2022-04-19 13:44:49', '1', '1', 1000, 2, 1, NULL, NULL),
(105, 'le titre', 'une déscription', '#ce74f2', 'diviser les produit avec virgule', 'diviser les étapes avec point', '2022-04-22 17:30:12', '2', '2', 3600, 2, 0, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cuisinier`
--
ALTER TABLE `cuisinier`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `remote`
--
ALTER TABLE `remote`
  ADD PRIMARY KEY (`rid`),
  ADD KEY `ticket` (`ticket`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cuisinier` (`cuisinier`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cuisinier`
--
ALTER TABLE `cuisinier`
  MODIFY `cid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `membre`
--
ALTER TABLE `membre`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `remote`
--
ALTER TABLE `remote`
  MODIFY `rid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'identifiant', AUTO_INCREMENT=106;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `remote`
--
ALTER TABLE `remote`
  ADD CONSTRAINT `ticket` FOREIGN KEY (`ticket`) REFERENCES `ticket` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `cuisinier` FOREIGN KEY (`cuisinier`) REFERENCES `cuisinier` (`cid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

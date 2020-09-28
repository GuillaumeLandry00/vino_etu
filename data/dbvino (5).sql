-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 21 sep. 2020 à 22:36
-- Version du serveur :  10.4.10-MariaDB
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
-- Base de données :  `dbvino`
--

-- --------------------------------------------------------

--
-- Structure de la table `cellier__bouteille`
--

DROP TABLE IF EXISTS `cellier__bouteille`;
CREATE TABLE IF NOT EXISTS `cellier__bouteille` (
  `vino__bouteille_id` int(11) NOT NULL,
  `vino__cellier_id` int(11) NOT NULL,
  `quantite` int(4) NOT NULL,
  `prix` decimal(10,2) UNSIGNED DEFAULT NULL,
  `date_achat` varchar(255) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `garde_jusqua` int(11) DEFAULT NULL,
  `millesime` int(4) DEFAULT NULL,
  PRIMARY KEY (`vino__bouteille_id`,`vino__cellier_id`),
  KEY `fk_vino__bouteille_has_vino__cellier_vino__cellier1_idx` (`vino__cellier_id`),
  KEY `fk_vino__bouteille_has_vino__cellier_vino__bouteille1_idx` (`vino__bouteille_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `cellier__bouteille`
--

INSERT INTO `cellier__bouteille` (`vino__bouteille_id`, `vino__cellier_id`, `quantite`, `prix`, `date_achat`, `notes`, `garde_jusqua`, `millesime`) VALUES
(8, 7, 6, NULL, NULL, '', NULL, NULL),
(10, 11, 4, NULL, NULL, '', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `users_id` int(11) NOT NULL AUTO_INCREMENT,
  `users_mpd` varchar(255) DEFAULT NULL,
  `users_login` varchar(45) DEFAULT NULL,
  `users_type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`users_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`users_id`, `users_mpd`, `users_login`, `users_type`) VALUES
(1, 'user1', 'user1', 'utilisateur'),
(23, '126be26daf73fbcbd28ee77712296687c9e1052146e2774dad55c4d8f06c8495', 'e1995614', 'utilisateur'),
(24, '126be26daf73fbcbd28ee77712296687c9e1052146e2774dad55c4d8f06c8495', 'e1', 'utilisateur');

-- --------------------------------------------------------

--
-- Structure de la table `vino__bouteille`
--

DROP TABLE IF EXISTS `vino__bouteille`;
CREATE TABLE IF NOT EXISTS `vino__bouteille` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(200) NOT NULL,
  `image` varchar(200) NOT NULL,
  `code_saq` varchar(50) NOT NULL,
  `pays` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `prix_saq` float DEFAULT NULL,
  `url_saq` varchar(200) NOT NULL,
  `url_img` varchar(200) NOT NULL,
  `format` varchar(20) NOT NULL,
  `fk__vino__type_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_vino__bouteille_vino__type1_idx` (`fk__vino__type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=131 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `vino__bouteille`
--

INSERT INTO `vino__bouteille` (`id`, `nom`, `image`, `code_saq`, `pays`, `description`, `prix_saq`, `url_saq`, `url_img`, `format`, `fk__vino__type_id`) VALUES
(1, 'Borsao Seleccion', '//s7d9.scene7.com/is/image/SAQ/10324623_is?$saq-rech-prod-gril$', '10324623', 'Espagne', 'Vin rouge\r\n         \r\n      \r\n      \r\n      Espagne, 750 ml\r\n      \r\n      \r\n      Code SAQ : 10324623', 11, 'https://www.saq.com/page/fr/saqcom/vin-rouge/borsao-seleccion/10324623', '//s7d9.scene7.com/is/image/SAQ/10324623_is?$saq-rech-prod-gril$', ' 750 ml', 1),
(2, 'Monasterio de Las Vinas Gran Reserva', '//s7d9.scene7.com/is/image/SAQ/10359156_is?$saq-rech-prod-gril$', '10359156', 'Espagne', 'Vin rouge\r\n         \r\n      \r\n      \r\n      Espagne, 750 ml\r\n      \r\n      \r\n      Code SAQ : 10359156', 19, 'https://www.saq.com/page/fr/saqcom/vin-rouge/monasterio-de-las-vinas-gran-reserva/10359156', '//s7d9.scene7.com/is/image/SAQ/10359156_is?$saq-rech-prod-gril$', ' 750 ml', 1),
(3, 'Castano Hecula', '//s7d9.scene7.com/is/image/SAQ/11676671_is?$saq-rech-prod-gril$', '11676671', 'Espagne', 'Vin rouge\r\n         \r\n      \r\n      \r\n      Espagne, 750 ml\r\n      \r\n      \r\n      Code SAQ : 11676671', 12, 'https://www.saq.com/page/fr/saqcom/vin-rouge/castano-hecula/11676671', '//s7d9.scene7.com/is/image/SAQ/11676671_is?$saq-rech-prod-gril$', ' 750 ml', 1),
(4, 'Campo Viejo Tempranillo Rioja', '//s7d9.scene7.com/is/image/SAQ/11462446_is?$saq-rech-prod-gril$', '11462446', 'Espagne', 'Vin rouge\r\n         \r\n      \r\n      \r\n      Espagne, 750 ml\r\n      \r\n      \r\n      Code SAQ : 11462446', 14, 'https://www.saq.com/page/fr/saqcom/vin-rouge/campo-viejo-tempranillo-rioja/11462446', '//s7d9.scene7.com/is/image/SAQ/11462446_is?$saq-rech-prod-gril$', ' 750 ml', 1),
(5, 'Bodegas Atalaya Laya 2017', '//s7d9.scene7.com/is/image/SAQ/12375942_is?$saq-rech-prod-gril$', '12375942', 'Espagne', 'Vin rouge\r\n         \r\n      \r\n      \r\n      Espagne, 750 ml\r\n      \r\n      \r\n      Code SAQ : 12375942', 17, 'https://www.saq.com/page/fr/saqcom/vin-rouge/bodegas-atalaya-laya-2017/12375942', '//s7d9.scene7.com/is/image/SAQ/12375942_is?$saq-rech-prod-gril$', ' 750 ml', 1),
(6, 'Vin Vault Pinot Grigio', '//s7d9.scene7.com/is/image/SAQ/13467048_is?$saq-rech-prod-gril$', '13467048', 'États-Unis', 'Vin blanc\r\n         \r\n      \r\n      \r\n      États-Unis, 3 L\r\n      \r\n      \r\n      Code SAQ : 13467048', NULL, 'https://www.saq.com/page/fr/saqcom/vin-blanc/vin-vault-pinot-grigio/13467048', '//s7d9.scene7.com/is/image/SAQ/13467048_is?$saq-rech-prod-gril$', ' 3 L', 2),
(7, 'Huber Riesling Engelsberg 2017', '//s7d9.scene7.com/is/image/SAQ/13675841_is?$saq-rech-prod-gril$', '13675841', 'Autriche', 'Vin blanc\r\n         \r\n      \r\n      \r\n      Autriche, 750 ml\r\n      \r\n      \r\n      Code SAQ : 13675841', 22, 'https://www.saq.com/page/fr/saqcom/vin-blanc/huber-riesling-engelsberg-2017/13675841', '//s7d9.scene7.com/is/image/SAQ/13675841_is?$saq-rech-prod-gril$', ' 750 ml', 2),
(8, 'Dominio de Tares Estay Castilla y Léon 2015', '//s7d9.scene7.com/is/image/SAQ/13802571_is?$saq-rech-prod-gril$', '13802571', 'Espagne', 'Vin rouge\r\n         \r\n      \r\n      \r\n      Espagne, 750 ml\r\n      \r\n      \r\n      Code SAQ : 13802571', 18, 'https://www.saq.com/page/fr/saqcom/vin-rouge/dominio-de-tares-estay-castilla-y-leon-2015/13802571', '//s7d9.scene7.com/is/image/SAQ/13802571_is?$saq-rech-prod-gril$', ' 750 ml', 1),
(9, 'Tessellae Old Vines Côtes du Roussillon 2016', '//s7d9.scene7.com/is/image/SAQ/12216562_is?$saq-rech-prod-gril$', '12216562', 'France', 'Vin rouge\r\n         \r\n      \r\n      \r\n      France, 750 ml\r\n      \r\n      \r\n      Code SAQ : 12216562', 21, 'https://www.saq.com/page/fr/saqcom/vin-rouge/tessellae-old-vines-cotes-du-roussillon-2016/12216562', '//s7d9.scene7.com/is/image/SAQ/12216562_is?$saq-rech-prod-gril$', ' 750 ml', 1),
(10, 'Tenuta Il Falchetto Bricco Paradiso -... 2015', '//s7d9.scene7.com/is/image/SAQ/13637422_is?$saq-rech-prod-gril$', '13637422', 'Italie', 'Vin rouge\r\n         \r\n      \r\n      \r\n      Italie, 750 ml\r\n      \r\n      \r\n      Code SAQ : 13637422', 34, 'https://www.saq.com/page/fr/saqcom/vin-rouge/tenuta-il-falchetto-bricco-paradiso---barbera-dasti-superiore-docg-2015/13637422', '//s7d9.scene7.com/is/image/SAQ/13637422_is?$saq-rech-prod-gril$', ' 750 ml', 1),
(11, '1000 Stories Zinfandel Californie', '//www.saq.com/media/catalog/product/1/3/13584455-1_1578538222.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '13584455', 'Ã‰tats-Unis', 'Vin rouge', NULL, 'https://www.saq.com/fr/13584455', '//www.saq.com/media/catalog/product/1/3/13584455-1_1578538222.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '750 ml', 1),
(12, '11th Hour Cellars Pinot', '//www.saq.com/media/catalog/product/1/3/13966470-1_1578546924.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '13966470', 'Ã‰tats-Unis', 'Vin rouge', NULL, 'https://www.saq.com/fr/13966470', '//www.saq.com/media/catalog/product/1/3/13966470-1_1578546924.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '750 ml', 1),
(13, '13th Street Winery Gamay', '//www.saq.com/media/catalog/product/1/2/12705631-1_1582140016.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '12705631', 'Canada', 'Vin rouge', NULL, 'https://www.saq.com/fr/12705631', '//www.saq.com/media/catalog/product/1/2/12705631-1_1582140016.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '750 ml', 1),
(14, '13th Street Winery Red Palette', '//www.saq.com/media/catalog/product/1/2/12687823-1_1578361222.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '12687823', 'Canada', 'Vin rouge', NULL, 'https://www.saq.com/fr/12687823', '//www.saq.com/media/catalog/product/1/2/12687823-1_1578361222.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '750 ml', 1),
(15, '14 Hands Cabernet-Sauvignon Columbia', '//www.saq.com/media/catalog/product/1/3/13876247-1_1582145731.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '13876247', 'Ã‰tats-Unis', 'Vin rouge', NULL, 'https://www.saq.com/fr/13876247', '//www.saq.com/media/catalog/product/1/3/13876247-1_1582145731.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '750 ml', 1),
(16, '14 Hands Hot to Trot Columbia', '//www.saq.com/media/catalog/product/1/2/12245611-1_1580661909.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '12245611', 'Ã‰tats-Unis', 'Vin rouge', NULL, 'https://www.saq.com/fr/12245611', '//www.saq.com/media/catalog/product/1/2/12245611-1_1580661909.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '750 ml', 1),
(17, '1865 Syrah Limited Edition', '//www.saq.com/media/catalog/product/1/3/13270211-1_1578443420.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '13270211', 'Chili', 'Vin rouge', NULL, 'https://www.saq.com/fr/13270211', '//www.saq.com/media/catalog/product/1/3/13270211-1_1578443420.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '750 ml', 1),
(18, '19 Crimes Cabernet-Sauvignon Limestone', '//www.saq.com/media/catalog/product/1/2/12824197-1_1578411313.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '12824197', 'Australie', 'Vin rouge', NULL, 'https://www.saq.com/fr/12824197', '//www.saq.com/media/catalog/product/1/2/12824197-1_1578411313.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '750 ml', 1),
(19, '19 Crimes', '//www.saq.com/media/catalog/product/1/2/12073995-1_1580659214.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '12073995', 'Australie', 'Vin rouge', NULL, 'https://www.saq.com/fr/12073995', '//www.saq.com/media/catalog/product/1/2/12073995-1_1580659214.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '750 ml', 1),
(20, '1938 - Depuis Un Esprit D\'exception Puisseguin Saint-Ã‰milion', '//www.saq.com/media/catalog/product/1/1/11655601-1_1580625025.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '11655601', 'France', 'Vin rouge', NULL, 'https://www.saq.com/fr/11655601', '//www.saq.com/media/catalog/product/1/1/11655601-1_1580625025.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '750 ml', 1),
(21, '3 Badge Leese-Fitch Merlot', '//www.saq.com/media/wysiwyg/placeholder/category/06.png', '13523011', 'Ã‰tats-Unis', 'Vin rouge', NULL, 'https://www.saq.com/fr/13523011', '//www.saq.com/media/wysiwyg/placeholder/category/06.png', '750 ml', 1),
(22, '3 de Valandraud', '//www.saq.com/media/catalog/product/1/3/13392031-1_1578535218.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '13392031', 'France', 'Vin rouge', NULL, 'https://www.saq.com/fr/13392031', '//www.saq.com/media/catalog/product/1/3/13392031-1_1578535218.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '750 ml', 1),
(23, '3 Rings Shiraz', '//www.saq.com/media/catalog/product/1/2/12815725-1_1578411013.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '12815725', 'Australie', 'Vin rouge', NULL, 'https://www.saq.com/fr/12815725', '//www.saq.com/media/catalog/product/1/2/12815725-1_1578411013.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '750 ml', 1),
(24, '350Â° de Bellevue', '//www.saq.com/media/catalog/product/1/2/12562123-1_1578346511.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '12562123', 'France', 'Vin rouge', NULL, 'https://www.saq.com/fr/12562123', '//www.saq.com/media/catalog/product/1/2/12562123-1_1578346511.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '750 ml', 1),
(25, '4 Kilos Gallinas y Focas', '//www.saq.com/media/catalog/product/1/3/13903479-1_1589489114.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '13903479', 'Espagne', 'Vin rouge', NULL, 'https://www.saq.com/fr/13903479', '//www.saq.com/media/catalog/product/1/3/13903479-1_1589489114.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '750 ml', 1),
(26, '4 Kilos The Island Syndicate', '//www.saq.com/media/wysiwyg/placeholder/category/06.png', '13903487', 'Espagne', 'Vin rouge', NULL, 'https://www.saq.com/fr/13903487', '//www.saq.com/media/wysiwyg/placeholder/category/06.png', '750 ml', 1),
(27, '6 Degrees Red', '//www.saq.com/media/catalog/product/1/3/13234738-1_1578442821.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '13234738', 'Ã‰tats-Unis', 'Vin rouge', NULL, 'https://www.saq.com/fr/13234738', '//www.saq.com/media/catalog/product/1/3/13234738-1_1578442821.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '750 ml', 1),
(28, '655 Miles Cabernet Sauvignon', '//www.saq.com/media/catalog/product/1/4/14139863-1_1578552320.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '14139863', 'Ã‰tats-Unis', 'Vin rouge', NULL, 'https://www.saq.com/fr/14139863', '//www.saq.com/media/catalog/product/1/4/14139863-1_1578552320.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '750 ml', 1),
(29, '7Colores Gran Reserva Valle Casablanca', '//www.saq.com/media/wysiwyg/placeholder/category/06.png', '14208427', 'Chili', 'Vin rouge', NULL, 'https://www.saq.com/fr/14208427', '//www.saq.com/media/wysiwyg/placeholder/category/06.png', '750 ml', 1),
(30, 'A Mandria di Signadore Patrimonio', '//www.saq.com/media/catalog/product/1/1/11908161-1_1580629223.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '11908161', 'France', 'Vin rouge', NULL, 'https://www.saq.com/fr/11908161', '//www.saq.com/media/catalog/product/1/1/11908161-1_1580629223.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '750 ml', 1),
(31, 'A thousand Lives Cabernet-Sauvignon', '//www.saq.com/media/catalog/product/1/4/14250211-1_1580352616.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '14250211', 'Argentine', 'Vin rouge', NULL, 'https://www.saq.com/fr/14250211', '//www.saq.com/media/catalog/product/1/4/14250211-1_1580352616.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '750 ml', 1),
(32, 'A. & P. de Villaine La Fortune', '//www.saq.com/media/catalog/product/9/1/918219-1_1580608218.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '918219', 'France', 'Vin rouge', NULL, 'https://www.saq.com/fr/918219', '//www.saq.com/media/catalog/product/9/1/918219-1_1580608218.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '750 ml', 1),
(33, 'A. de Luze & Fils ChÃ¢teau La VerriÃ¨re', '//www.saq.com/media/catalog/product/1/3/13710861-1_1580352021.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '13710861', 'France', 'Vin rouge', NULL, 'https://www.saq.com/fr/13710861', '//www.saq.com/media/catalog/product/1/3/13710861-1_1580352021.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '750 ml', 1),
(34, 'A.A. Badenhorst Family Red Blend', '//www.saq.com/media/catalog/product/1/2/12275298-1_1581958830.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '12275298', 'Afrique du Sud', 'Vin rouge', NULL, 'https://www.saq.com/fr/12275298', '//www.saq.com/media/catalog/product/1/2/12275298-1_1581958830.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '750 ml', 1),
(107, '\"Y\" d\'Yquem', '//www.saq.com/media/wysiwyg/placeholder/category/06.png', '13932771', 'France', 'Vin blanc', 241, 'https://www.saq.com/fr/13932771', '//www.saq.com/media/wysiwyg/placeholder/category/06.png', '750 ml', 2),
(108, '14 Hands Pinot Grigio Columbia', '//www.saq.com/media/catalog/product/1/3/13876271-1_1578544517.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '13876271', 'Ã‰tats-Unis', 'Vin blanc', 14.95, 'https://www.saq.com/fr/13876271', '//www.saq.com/media/catalog/product/1/3/13876271-1_1578544517.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '750 ml', 2),
(109, '14 Hands Pinot Gris Columbia Valley', '//www.saq.com/media/catalog/product/1/3/13299881-1_1578444011.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '13299881', 'Ã‰tats-Unis', 'Vin blanc', 20, 'https://www.saq.com/fr/13299881', '//www.saq.com/media/catalog/product/1/3/13299881-1_1578444011.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '750 ml', 2),
(110, '1865 Single Vineyard Chardonnay', '//www.saq.com/media/catalog/product/1/3/13566572-1_1578537619.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '13566572', 'Chili', 'Vin blanc', 20, 'https://www.saq.com/fr/13566572', '//www.saq.com/media/catalog/product/1/3/13566572-1_1578537619.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '750 ml', 2),
(111, '19 Crimes Hard', '//www.saq.com/media/catalog/product/1/3/13624710-1_1578539419.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '13624710', 'Australie', 'Vin blanc', 17.95, 'https://www.saq.com/fr/13624710', '//www.saq.com/media/catalog/product/1/3/13624710-1_1578539419.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '750 ml', 2),
(112, '50 Degree Riesling Trocken Rheingau', '//www.saq.com/media/catalog/product/1/4/14434336-1_1595256048.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '14434336', 'Allemagne', 'Vin blanc', 17.95, 'https://www.saq.com/fr/14434336', '//www.saq.com/media/catalog/product/1/4/14434336-1_1595256048.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '750 ml', 2),
(113, '50th Parallel Estate Pinot Gris', '//www.saq.com/media/catalog/product/1/3/13962479-1_1578546918.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '13962479', 'Canada', 'Vin blanc', 29.65, 'https://www.saq.com/fr/13962479', '//www.saq.com/media/catalog/product/1/3/13962479-1_1578546918.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '750 ml', 2),
(114, 'A to Z Chardonnay Willamette Valley', '//www.saq.com/media/catalog/product/1/1/11399678-1_1580617512.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '11399678', 'Ã‰tats-Unis', 'Vin blanc', 26.4, 'https://www.saq.com/fr/11399678', '//www.saq.com/media/catalog/product/1/1/11399678-1_1580617512.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '750 ml', 2),
(115, 'A to Z Pinot Gris Willamette Valley', '//www.saq.com/media/catalog/product/1/1/11334057-1_1580616023.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '11334057', 'Ã‰tats-Unis', 'Vin blanc', 23.95, 'https://www.saq.com/fr/11334057', '//www.saq.com/media/catalog/product/1/1/11334057-1_1580616023.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '750 ml', 2),
(116, 'A&D Wines Monologo Arinto p24', '//www.saq.com/media/catalog/product/1/4/14296666-1_1580258418.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '14296666', 'Portugal', 'Vin blanc', 18.65, 'https://www.saq.com/fr/14296666', '//www.saq.com/media/catalog/product/1/4/14296666-1_1580258418.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '750 ml', 2),
(117, 'A&D Wines Singular Vinho Verde', '//www.saq.com/media/catalog/product/1/4/14296674-1_1582736706.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '14296674', 'Portugal', 'Vin blanc', 22.3, 'https://www.saq.com/fr/14296674', '//www.saq.com/media/catalog/product/1/4/14296674-1_1582736706.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '750 ml', 2),
(118, 'A.A. Badenhorst The Curator', '//www.saq.com/media/catalog/product/1/2/12889126-1_1578413412.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '12889126', 'Afrique du Sud', 'Vin blanc', 14.2, 'https://www.saq.com/fr/12889126', '//www.saq.com/media/catalog/product/1/2/12889126-1_1578413412.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '750 ml', 2),
(119, 'A.J. Adam Dhroner Riesling Trocken Mosel', '//www.saq.com/media/catalog/product/1/4/14216101-1_1578554119.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '14216101', 'Allemagne', 'Vin blanc', 32, 'https://www.saq.com/fr/14216101', '//www.saq.com/media/catalog/product/1/4/14216101-1_1578554119.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '750 ml', 2),
(120, 'A.J. Adam Hofberg Kabinett Mosel', '//www.saq.com/media/catalog/product/1/4/14216128-1_1578554119.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '14216128', 'Allemagne', 'Vin blanc', 30.25, 'https://www.saq.com/fr/14216128', '//www.saq.com/media/catalog/product/1/4/14216128-1_1578554119.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '750 ml', 2),
(121, 'A.J. Adam Im Pfarrgarten Riesling Feinherb Gutswein Mosel', '//www.saq.com/media/catalog/product/1/4/14216110-1_1578554119.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '14216110', 'Allemagne', 'Vin blanc', 22.8, 'https://www.saq.com/fr/14216110', '//www.saq.com/media/catalog/product/1/4/14216110-1_1578554119.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '750 ml', 2),
(122, 'A.J. Adam, Hofberg Spatlese', '//www.saq.com/media/catalog/product/1/4/14216136-1_1578554119.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '14216136', 'Allemagne', 'Vin blanc', 41.25, 'https://www.saq.com/fr/14216136', '//www.saq.com/media/catalog/product/1/4/14216136-1_1578554119.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '750 ml', 2),
(123, 'AA Badenhorst Riviera Secateurs Swartland', '//www.saq.com/media/catalog/product/1/3/13995027-1_1578548408.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '13995027', 'Afrique du Sud', 'Vin blanc', 22.5, 'https://www.saq.com/fr/13995027', '//www.saq.com/media/catalog/product/1/3/13995027-1_1578548408.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '750 ml', 2),
(124, 'Abbazia Di Novacella Praepositus Kerner Alto Adige Valle Isarco', '//www.saq.com/media/catalog/product/1/4/14035466-1_1578549912.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '14035466', 'Italie', 'Vin blanc', 37.75, 'https://www.saq.com/fr/14035466', '//www.saq.com/media/catalog/product/1/4/14035466-1_1578549912.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '750 ml', 2),
(125, 'Abbazia Di Novacella Riesling Alto Adige Valle Isarco', '//www.saq.com/media/wysiwyg/placeholder/category/06.png', '14035431', 'Italie', 'Vin blanc', 29.65, 'https://www.saq.com/fr/14035431', '//www.saq.com/media/wysiwyg/placeholder/category/06.png', '750 ml', 2),
(126, 'Acustic', '//www.saq.com/media/catalog/product/1/1/11902077-1_1580628926.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '11902077', 'Espagne', 'Vin blanc', 24.5, 'https://www.saq.com/fr/11902077', '//www.saq.com/media/catalog/product/1/1/11902077-1_1580628926.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '750 ml', 2),
(127, 'Adalia Singan Soave', '//www.saq.com/media/catalog/product/1/3/13986008-1_1578547523.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '13986008', 'Italie', 'Vin blanc', 23.95, 'https://www.saq.com/fr/13986008', '//www.saq.com/media/catalog/product/1/3/13986008-1_1578547523.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '750 ml', 2),
(128, 'Adega de PegÃµes Colheita Seleccionada Peninsula de', '//www.saq.com/media/catalog/product/1/0/10838801-1_1580608817.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '10838801', 'Portugal', 'Vin blanc', 12.7, 'https://www.saq.com/fr/10838801', '//www.saq.com/media/catalog/product/1/0/10838801-1_1580608817.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '750 ml', 2),
(129, 'Adega de Penalva DÃ£o', '//www.saq.com/media/catalog/product/1/2/12728904-1_1578408922.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '12728904', 'Portugal', 'Vin blanc', 11.95, 'https://www.saq.com/fr/12728904', '//www.saq.com/media/catalog/product/1/2/12728904-1_1578408922.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '750 ml', 2),
(130, 'Adega de Penalva Maceration pelliculaire DÃ£o', '//www.saq.com/media/catalog/product/1/3/13844317-1_1578543322.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '13844317', 'Portugal', 'Vin blanc', 22.2, 'https://www.saq.com/fr/13844317', '//www.saq.com/media/catalog/product/1/3/13844317-1_1578543322.png?quality=80&fit=bounds&height=166&width=111&canvas=111:166', '750 ml', 2);

-- --------------------------------------------------------

--
-- Structure de la table `vino__cellier`
--

DROP TABLE IF EXISTS `vino__cellier`;
CREATE TABLE IF NOT EXISTS `vino__cellier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk__users_id` int(11) NOT NULL,
  `cellier__nom` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_vino__cellier_users1_idx` (`fk__users_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `vino__cellier`
--

INSERT INTO `vino__cellier` (`id`, `fk__users_id`, `cellier__nom`) VALUES
(1, 1, 'YESTERDAY IS DEAD YEAH MOMENT OF SILENCE'),
(7, 24, 'Boff ouin'),
(11, 23, 'Les best');

-- --------------------------------------------------------

--
-- Structure de la table `vino__type`
--

DROP TABLE IF EXISTS `vino__type`;
CREATE TABLE IF NOT EXISTS `vino__type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `vino__type`
--

INSERT INTO `vino__type` (`id`, `type`) VALUES
(1, 'Vin rouge'),
(2, 'Vin blanc');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cellier__bouteille`
--
ALTER TABLE `cellier__bouteille`
  ADD CONSTRAINT `fk_vino__bouteille_has_vino__cellier_vino__bouteille1` FOREIGN KEY (`vino__bouteille_id`) REFERENCES `vino__bouteille` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_vino__bouteille_has_vino__cellier_vino__cellier1` FOREIGN KEY (`vino__cellier_id`) REFERENCES `vino__cellier` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `vino__bouteille`
--
ALTER TABLE `vino__bouteille`
  ADD CONSTRAINT `fk_vino__bouteille_vino__type1` FOREIGN KEY (`fk__vino__type_id`) REFERENCES `vino__type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `vino__cellier`
--
ALTER TABLE `vino__cellier`
  ADD CONSTRAINT `fk_vino__cellier_users1` FOREIGN KEY (`fk__users_id`) REFERENCES `users` (`users_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

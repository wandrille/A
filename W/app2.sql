-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Ven 13 Avril 2012 à 11:10
-- Version du serveur: 5.5.16
-- Version de PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `app2`
--

-- --------------------------------------------------------

--
-- Structure de la table `cd`
--

CREATE TABLE IF NOT EXISTS `cd` (
  `id_cd` int(11) NOT NULL AUTO_INCREMENT,
  `nom_cd` varchar(10) NOT NULL,
  PRIMARY KEY (`id_cd`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `cd`
--

INSERT INTO `cd` (`id_cd`, `nom_cd`) VALUES
(1, '78000'),
(2, '75000'),
(3, '69000');

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE IF NOT EXISTS `commentaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emetteur` int(11) NOT NULL,
  `contenu` text NOT NULL,
  `validation` tinyint(1) NOT NULL,
  `signalement` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `mail`
--

CREATE TABLE IF NOT EXISTS `mail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `objet` varchar(30) NOT NULL,
  `contenu` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `pays`
--

CREATE TABLE IF NOT EXISTS `pays` (
  `id_pays` int(11) NOT NULL AUTO_INCREMENT,
  `nom_pays` varchar(30) NOT NULL,
  PRIMARY KEY (`id_pays`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `pays`
--

INSERT INTO `pays` (`id_pays`, `nom_pays`) VALUES
(1, 'France'),
(2, 'Angleterre'),
(3, 'Belgique');

-- --------------------------------------------------------

--
-- Structure de la table `restaurant`
--

CREATE TABLE IF NOT EXISTS `restaurant` (
  `id_resto` int(11) NOT NULL AUTO_INCREMENT,
  `nom_resto` varchar(50) NOT NULL,
  `telephone` int(10) NOT NULL,
  `mail` varchar(30) NOT NULL,
  `date_creation` date NOT NULL,
  `adresse` varchar(150) NOT NULL,
  `proprietaire` int(11) NOT NULL,
  `id_pays` int(11) NOT NULL,
  `id_ville` int(11) NOT NULL,
  `id_cd` int(11) NOT NULL,
  `id_rue` int(11) NOT NULL,
  `id_type` int(11) NOT NULL,
  `note` int(4) DEFAULT NULL,
  `prix_moyen` int(11) NOT NULL,
  `caracteristiques` varchar(30) NOT NULL,
  `description` varchar(250) DEFAULT NULL,
  `carte` text,
  `nb_place_reservable` int(11) DEFAULT NULL,
  `nb_place reservee` int(11) DEFAULT NULL,
  `nb_commentaire` int(11) NOT NULL,
  `photos` text,
  `validation_moderateur` tinyint(1) NOT NULL,
  `signalement` int(11) NOT NULL,
  PRIMARY KEY (`id_resto`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `restaurant`
--

INSERT INTO `restaurant` (`id_resto`, `nom_resto`, `telephone`, `mail`, `date_creation`, `adresse`, `proprietaire`, `id_pays`, `id_ville`, `id_cd`, `id_rue`, `id_type`, `note`, `prix_moyen`, `caracteristiques`, `description`, `carte`, `nb_place_reservable`, `nb_place reservee`, `nb_commentaire`, `photos`, `validation_moderateur`, `signalement`) VALUES
(1, 'crevette en folie', 154683259, 'crevette@sdfgh.fr', '2012-04-04', '22 boulevard haussman', 1, 1, 1, 1, 2, 1, NULL, 15, 'crevette', NULL, NULL, NULL, NULL, 0, NULL, 0, 0),
(2, 'ouaich kebab', 654859562, 'petagedebid@sd.zce', '2012-04-03', '', 1, 1, 1, 1, 3, 3, NULL, 3, 'kebab frites', NULL, NULL, NULL, NULL, 0, NULL, 0, 3);

-- --------------------------------------------------------

--
-- Structure de la table `rue`
--

CREATE TABLE IF NOT EXISTS `rue` (
  `id_rue` int(11) NOT NULL AUTO_INCREMENT,
  `nom_rue` varchar(30) NOT NULL,
  PRIMARY KEY (`id_rue`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `rue`
--

INSERT INTO `rue` (`id_rue`, `nom_rue`) VALUES
(1, 'avenue des champs élysées'),
(2, 'boulevard haussman'),
(3, 'rue mouffetard'),
(4, 'impasse des gendarmes'),
(5, 'rue du cherche midi');

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

CREATE TABLE IF NOT EXISTS `type` (
  `id_type` int(11) NOT NULL AUTO_INCREMENT,
  `nom_type` varchar(20) NOT NULL,
  PRIMARY KEY (`id_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `type`
--

INSERT INTO `type` (`id_type`, `nom_type`) VALUES
(1, 'Chinois'),
(2, 'Indien'),
(3, 'Fast-food'),
(4, 'Mexicain'),
(5, 'Francais');

-- --------------------------------------------------------

--
-- Structure de la table `type_util`
--

CREATE TABLE IF NOT EXISTS `type_util` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `type_util`
--

INSERT INTO `type_util` (`id`, `nom`) VALUES
(1, 'client'),
(2, 'restaurateur'),
(3, 'moderateur');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_type` int(11) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `login` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `date_naissance` date NOT NULL,
  `civilite` enum('Mr','Mme','Mlle') NOT NULL,
  `mail` varchar(30) NOT NULL,
  `avatar` varchar(100) DEFAULT NULL,
  `nb_commentaire` int(11) DEFAULT NULL,
  `nb_signalement` int(11) NOT NULL,
  `restaurant` text,
  `favoris` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `id_type`, `nom`, `prenom`, `login`, `password`, `date_naissance`, `civilite`, `mail`, `avatar`, `nb_commentaire`, `nb_signalement`, `restaurant`, `favoris`) VALUES
(1, 2, 'Carel', 'roger', 'rogercarel', 'rogercarel', '1991-11-25', 'Mr', 'rogercarel@wanadoo.fr', NULL, NULL, 0, NULL, NULL),
(2, 1, 'facerias', 'benoit', 'poupipou', 'poupipou', '1532-06-25', 'Mr', 'benoit@oaziyurbg.fr', NULL, NULL, 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `ville`
--

CREATE TABLE IF NOT EXISTS `ville` (
  `id_ville` int(11) NOT NULL AUTO_INCREMENT,
  `id_pays` int(11) NOT NULL,
  `id_cp` int(5) NOT NULL,
  `nom_ville` varchar(50) NOT NULL,
  PRIMARY KEY (`id_ville`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `ville`
--

INSERT INTO `ville` (`id_ville`, `id_pays`, `id_cp`, `nom_ville`) VALUES
(1, 1, 0, 'Paris'),
(2, 1, 0, 'Lyon'),
(3, 1, 0, 'Versailles');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

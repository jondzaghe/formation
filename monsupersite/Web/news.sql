-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Ven 27 Mars 2015 à 18:12
-- Version du serveur :  5.6.20-log
-- Version de PHP :  5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `news`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
`id` mediumint(9) NOT NULL,
  `news` smallint(6) NOT NULL,
  `auteur` varchar(50) NOT NULL,
  `contenu` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
`id` smallint(5) unsigned NOT NULL,
  `auteur` varchar(30) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `contenu` text NOT NULL,
  `dateAjout` datetime NOT NULL,
  `dateModif` datetime NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `news`
--

INSERT INTO `news` (`id`, `auteur`, `titre`, `contenu`, `dateAjout`, `dateModif`) VALUES
(8, 'Vedi', 'Juste un test', 'Voila une petite news pour un test', 0x323031352d30332d32372031363a35363a3334, 0x323031352d30332d32372031363a35363a3334),
(7, 'Joon', 'Test', 'N''importe quoi', 0x323031352d30332d32372031333a31343a3533, 0x323031352d30332d32372031333a31343a3533),
(6, 'Joon', 'Ma nouvelle news de test', 'Test test teste test test test test test test', 0x323031352d30332d32372031313a31373a3234, 0x323031352d30332d32372031313a31373a3234);

-- --------------------------------------------------------

--
-- Structure de la table `t_mem_userc`
--

CREATE TABLE IF NOT EXISTS `t_mem_userc` (
`fuc_id` int(11) NOT NULL,
  `fuc_nom` varchar(1000) NOT NULL,
  `fuc_prenom` varchar(1000) NOT NULL,
  `fuc_mdp` varchar(1000) NOT NULL,
  `fuc_fk_type` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `t_mem_userc`
--

INSERT INTO `t_mem_userc` (`fuc_id`, `fuc_nom`, `fuc_prenom`, `fuc_mdp`, `fuc_fk_type`) VALUES
(1, 'Ondzaghe', 'Josua', 'm', 1),
(2, 'Vedi', 'mathieu', 'm', 2);

-- --------------------------------------------------------

--
-- Structure de la table `t_mem_usery`
--

CREATE TABLE IF NOT EXISTS `t_mem_usery` (
`muy_id` int(11) NOT NULL,
  `muy_descriptif` varchar(1000) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `t_mem_usery`
--

INSERT INTO `t_mem_usery` (`muy_id`, `muy_descriptif`) VALUES
(1, 'ADMIN'),
(2, 'ECRIVAIN');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `news`
--
ALTER TABLE `news`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `t_mem_userc`
--
ALTER TABLE `t_mem_userc`
 ADD PRIMARY KEY (`fuc_id`), ADD KEY `fk_type` (`fuc_fk_type`);

--
-- Index pour la table `t_mem_usery`
--
ALTER TABLE `t_mem_usery`
 ADD PRIMARY KEY (`muy_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `news`
--
ALTER TABLE `news`
MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `t_mem_userc`
--
ALTER TABLE `t_mem_userc`
MODIFY `fuc_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `t_mem_usery`
--
ALTER TABLE `t_mem_usery`
MODIFY `muy_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `t_mem_userc`
--
ALTER TABLE `t_mem_userc`
ADD CONSTRAINT `fuc_fk_type` FOREIGN KEY (`fuc_fk_type`) REFERENCES `t_mem_usery` (`muy_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 30 Janvier 2017 à 16:04
-- Version du serveur :  5.7.11
-- Version de PHP :  7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `messagerie_bdd`
--

-- --------------------------------------------------------

--
-- Structure de la table `conversation`
--

CREATE TABLE `conversation` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `color` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `conversation`
--

INSERT INTO `conversation` (`id`, `name`, `color`) VALUES
(1, 'Conversation_1', ''),
(2, 'Conversation_2', ''),
(3, 'Conversation_3', ''),
(4, 'Conversation_4', '');

-- --------------------------------------------------------

--
-- Structure de la table `friends`
--

CREATE TABLE `friends` (
  `fk_user` varchar(250) NOT NULL,
  `fk_friend` varchar(250) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id` int(250) NOT NULL,
  `fk_user` varchar(250) NOT NULL,
  `fk_conversation` int(250) NOT NULL,
  `content` varchar(250) NOT NULL,
  `datetime` datetime(6) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `message`
--

INSERT INTO `message` (`id`, `fk_user`, `fk_conversation`, `content`, `datetime`) VALUES
(1, 'Tran@mail', 1, 'hellow', '2017-01-23 05:00:00.000000'),
(2, 'Tran@mail', 3, 'Test conversation 3', '2017-01-30 05:00:00.000000'),
(3, 'Tran@mail', 1, 't2s', '2017-01-31 10:00:00.000000');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` varchar(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `displayname` varchar(250) NOT NULL,
  `avatar` varchar(250) DEFAULT NULL,
  `password` varchar(250) NOT NULL,
  `userfamilyname` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `username`, `displayname`, `avatar`, `password`, `userfamilyname`) VALUES
('Tran@mail', 'Cedric', 'Warlaine', NULL, '0000', 'Tran');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `conversation`
--
ALTER TABLE `conversation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_friend` (`fk_friend`),
  ADD KEY `fk_user` (`fk_user`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user` (`fk_user`),
  ADD KEY `fk_conversation` (`fk_conversation`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `conversation`
--
ALTER TABLE `conversation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

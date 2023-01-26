-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 12 mai 2021 à 23:33
-- Version du serveur :  10.3.27-MariaDB-0+deb10u1
-- Version de PHP : 7.3.27-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mg06866u`
--

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `id_etudiant` int(11) NOT NULL,
  `nom` text NOT NULL,
  `email` text NOT NULL,
  `password_etudiant` text NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`id_etudiant`, `nom`, `email`, `password_etudiant`, `score`) VALUES
(3, 'bizak menaa', 'bizakmenaa@gmail.com', '123', 0),
(5, 'test_test', 'test_test@gmail.com', '123', 0),
(7, 'MENAA Abderrezak', 'menaa@gmail.com', 'menaa', 0);

-- --------------------------------------------------------

--
-- Structure de la table `prof_auth`
--

CREATE TABLE `prof_auth` (
  `email` text NOT NULL,
  `password` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `prof_auth`
--

INSERT INTO `prof_auth` (`email`, `password`) VALUES
('admin@admin.com', 'admin'),
('christophe.moulin@univ-st-etienne.fr', 'christophe'),
('christophe.moulin@univ-st-etienne.fr', 'christophe');

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

CREATE TABLE `question` (
  `id_question` int(11) NOT NULL,
  `titre_question` text NOT NULL,
  `liste_options` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `options_juste` text NOT NULL,
  `score` int(11) NOT NULL,
  `id_quiz` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Déchargement des données de la table `question`
--

INSERT INTO `question` (`id_question`, `titre_question`, `liste_options`, `options_juste`, `score`, `id_quiz`) VALUES
(1, 'question1', '[\"opt1\", \"opt2\", \"opt3\", \"opt juste\"]', 'opt juste', 10, 1),
(2, 'question2', '[\"opt juste\", \"opt1\", \"opt2\", \"opt3\", \"opt4\"]', 'opt juste', 5, 1),
(4, 'question3', '[\"option juste\", \"opt1\"]', 'option juste', 5, 1),
(5, 'question1', '[\"option juste\", \"opt1\", \"opt2\", \"opt3\", \"opt4\"]', 'option juste', 15, 2);

-- --------------------------------------------------------

--
-- Structure de la table `quiz`
--

CREATE TABLE `quiz` (
  `id_quiz` int(11) NOT NULL,
  `titre_quiz` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Déchargement des données de la table `quiz`
--

INSERT INTO `quiz` (`id_quiz`, `titre_quiz`) VALUES
(1, 'quiz1'),
(2, 'quiz2'),
(3, 'quiz3'),
(5, 'test a ajouter'),
(6, 'quiz test bizak'),
(8, 'test6');

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

CREATE TABLE `reponse` (
  `id_quiz` int(11) NOT NULL,
  `id_question` int(11) NOT NULL,
  `id_etudiant` int(11) NOT NULL,
  `scoreAttribuer` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `reponse`
--

INSERT INTO `reponse` (`id_quiz`, `id_question`, `id_etudiant`, `scoreAttribuer`) VALUES
(1, 1, 1, 10),
(1, 2, 1, 5),
(1, 4, 1, 5),
(3, 10, 1, 90),
(3, 9, 1, 0),
(2, 7, 1, 12),
(2, 5, 1, 0),
(2, 8, 1, 13),
(1, 1, 3, 10),
(1, 2, 3, 5),
(1, 4, 3, 5),
(2, 5, 3, 15),
(2, 7, 3, 12),
(2, 8, 3, 13),
(3, 9, 3, 10),
(3, 10, 3, 90),
(3, 10, 2, 90),
(3, 9, 2, 10),
(2, 5, 2, 15),
(2, 7, 2, 12),
(2, 8, 2, 13),
(1, 1, 2, 0),
(1, 2, 2, 0),
(1, 4, 2, 5),
(1, 1, 4, 10),
(1, 1, 5, 10),
(1, 2, 5, 0),
(1, 4, 5, 5),
(3, 10, 5, 90),
(6, 14, 5, 15),
(6, 15, 5, 30),
(6, 14, 6, 15),
(6, 15, 6, 30),
(1, 1, 7, 10);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`id_etudiant`);

--
-- Index pour la table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id_question`);

--
-- Index pour la table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`id_quiz`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `etudiant`
--
ALTER TABLE `etudiant`
  MODIFY `id_etudiant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `question`
--
ALTER TABLE `question`
  MODIFY `id_question` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `id_quiz` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

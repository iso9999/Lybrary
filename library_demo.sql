-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Sam 08 Juillet 2017 à 12:06
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `library_demo`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `login_admin` varchar(30) NOT NULL,
  `password_admin` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `admin`
--

INSERT INTO `admin` (`id_admin`, `login_admin`, `password_admin`) VALUES
(1, 'admin', '8f87098716016fdcbb594ea3a689f6c2');

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `id` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `cne` varchar(10) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(100) NOT NULL,
  `date_inscription` datetime NOT NULL,
  `permission` enum('v','e','r') NOT NULL DEFAULT 'v',
  `isConfirmed` enum('a','c','r') NOT NULL DEFAULT 'c',
  `niveau` varchar(30) NOT NULL,
  `filiere` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `etudiant`
--

INSERT INTO `etudiant` (`id`, `nom`, `prenom`, `cne`, `email`, `password`, `date_inscription`, `permission`, `isConfirmed`, `niveau`, `filiere`) VALUES
(0, 'anon', 'anon', '0', 'anon', 'anon', '2017-07-02 00:00:00', 'v', 'r', '1ere Année CI', 'Ginfo'),
(1, 'MANAREDDINE', 'ismail', '1412247174', 'ismail.manared@gmail.com', 'cf3b1b05a8db29d9dfe38d238556a703', '2017-07-01 00:00:00', 'e', 'c', '1ere Année CI', 'Ginfo'),
(2, 'MOMO', 'Iso', '1412247173', 'ismail2@gmail.com', 'cf3b1b05a8db29d9dfe38d238556a703', '2017-07-04 00:00:00', 'e', 'c', '1ere Année CI', 'Ginfo'),
(3, 'ismail', 'momo', '1412025845', 'ismail4d@gmail.com', 'cf3b1b05a8db29d9dfe38d238556a703', '2017-07-04 00:00:00', 'e', 'c', '1ere Année CI', 'Ginfo'),
(4, 'ismail', 'momom', '1412247177', 'ismail3@gmail.com', 'cf3b1b05a8db29d9dfe38d238556a703', '2017-07-04 00:00:00', 'e', 'c', '1ere Année CI', 'Ginfo'),
(5, 'ismail', 'momode', '1412247354', 'ismail553@gmail.com', 'cf3b1b05a8db29d9dfe38d238556a703', '2017-07-04 00:00:00', 'e', 'r', '1ere Année CI', 'Ginfo'),
(6, 'iso', 'momoo', '147', 'ismail4zdd@gmail.com', 'cf3b1b05a8db29d9dfe38d238556a703', '2017-07-04 00:00:00', 'e', 'r', '1ere Année CI', 'Ginfo'),
(7, 'iso', 'molo', '1412247100', 'ismail33@gmail.com', 'cf3b1b05a8db29d9dfe38d238556a703', '2017-07-04 00:00:00', 'e', 'c', '1ere Année CI', 'Ginfo'),
(8, 'iso', 'molo', '141224710', 'ismail33@gmal.com', 'cf3b1b05a8db29d9dfe38d238556a703', '2017-07-04 00:00:00', 'e', 'r', '1ere Année CI', 'Ginfo'),
(9, 'iso', 'molo', '14122471', 'ismail74@gmal.com', 'cf3b1b05a8db29d9dfe38d238556a703', '2017-07-04 00:00:00', 'e', 'c', '1ere Année CI', 'Ginfo'),
(10, 'iso', 'molo', '1412247', 'ismail74@mal.com', 'cf3b1b05a8db29d9dfe38d238556a703', '2017-07-04 00:00:00', 'e', 'c', '1ere Année CI', 'Ginfo'),
(11, 'hamza', 'mola', '123456789', 'hamza@gmail.com', 'cf3b1b05a8db29d9dfe38d238556a703', '2017-07-08 00:00:00', 'e', 'c', '2ème Année CI', 'Ginfo');

-- --------------------------------------------------------

--
-- Structure de la table `livre`
--

CREATE TABLE `livre` (
  `id_livre` int(11) NOT NULL,
  `libelle_livre` varchar(100) NOT NULL,
  `auteur` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `date_debut` date NOT NULL,
  `etudiant` int(11) NOT NULL,
  `theme` int(11) NOT NULL,
  `etudiant_dem` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `livre`
--

INSERT INTO `livre` (`id_livre`, `libelle_livre`, `auteur`, `description`, `date_debut`, `etudiant`, `theme`, `etudiant_dem`) VALUES
(3, 'le corrige aux concours police', 'Bebey EKINDI', 'le corrige aux concours police sessions de 1996/1999/2000 1ere édition', '2017-07-01', 0, 8, 0),
(4, 'HUNGER GAMERS', 'SUZANNE COLLINS', 'Une jeu imposé,24 condidats.Seul la gagnant survivra!', '2017-06-24', 0, 9, 0),
(5, 'HARRY POTTER', 'folio junior', 'HARRY POTTER à l\'école des sorciers 1ere édition                ', '2017-07-07', 0, 9, 0),
(8, 'Art @ Science', 'internet', 'Art a Science de internet ENSA AGADIR', '2017-07-08', 11, 7, 0),
(9, 'APPSClub', 'Ensa Agadir', 'AppsClub Ensa Agadir', '2017-07-07', 0, 7, 0),
(10, 'A CLOCK', 'Anthony Burgess', 'Math For A CLOCK de Anthony Burgess', '2017-07-06', 0, 1, 0),
(11, 'ismail', 'manare', 'kokoko', '2017-07-07', 0, 9, 0),
(25, 'Competitive programing', 'APPSClub', 'Competitive programing par : APPSCLUB', '2017-07-07', 0, 7, 0),
(26, 'The Rings Of Saiturn', 'ISAAC ASIMOV', 'The Rings Of Saiturn de ISAAC ASIMOV', '2017-07-07', 0, 4, 0),
(27, 'Soirée', 'Ensa Agadir', 'Bde Phoenix!', '2017-07-07', 1, 3, 0),
(29, 'Semaine Revival', 'ENSA Agadir', 'Semaine Revival Ensa Agadir', '2017-07-07', 0, 2, 0),
(30, 'The Politics of Electoral Systems', 'Micheal Gallagher', 'The Politics of Electoral Systems                     ', '2017-07-07', 0, 3, 0),
(32, 'JAWS', 'Peter Benchley', 'JAWS de ENSA Agadir', '2017-07-07', 0, 5, 0),
(33, 'Just Courage', 'Gary A. Haugen', 'EXAMENS de Just Courage de Gary A. Haugen', '2017-07-07', 0, 6, 0),
(34, 'Philo', 'plo', 'How can I do it ?        ', '2017-07-07', 0, 9, 0),
(35, 'A brief history of the time', ' Stephen Hawking', 'A landmark volume in science writing by one of the great minds of our time.', '2017-07-07', 0, 2, 0);

-- --------------------------------------------------------

--
-- Structure de la table `theme`
--

CREATE TABLE `theme` (
  `id_theme` int(11) NOT NULL,
  `libelle_theme` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `theme`
--

INSERT INTO `theme` (`id_theme`, `libelle_theme`) VALUES
(1, 'MATHÉMATIQUE'),
(2, 'SCIENCE ET TECHNOLOGIE'),
(3, 'HISTOIRE'),
(4, 'PHYSQUE'),
(5, 'CHIMIE'),
(6, 'EXAMENS'),
(7, 'INFORMATIQUE'),
(8, 'EXERCICES'),
(9, 'AUTRES');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `livre`
--
ALTER TABLE `livre`
  ADD PRIMARY KEY (`id_livre`),
  ADD KEY `etudiant` (`etudiant`),
  ADD KEY `theme` (`theme`),
  ADD KEY `etudiant_dem` (`etudiant_dem`);

--
-- Index pour la table `theme`
--
ALTER TABLE `theme`
  ADD PRIMARY KEY (`id_theme`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `etudiant`
--
ALTER TABLE `etudiant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `livre`
--
ALTER TABLE `livre`
  MODIFY `id_livre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT pour la table `theme`
--
ALTER TABLE `theme`
  MODIFY `id_theme` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `livre`
--
ALTER TABLE `livre`
  ADD CONSTRAINT `livre_ibfk_1` FOREIGN KEY (`etudiant`) REFERENCES `etudiant` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `livre_ibfk_2` FOREIGN KEY (`theme`) REFERENCES `theme` (`id_theme`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `livre_ibfk_3` FOREIGN KEY (`etudiant_dem`) REFERENCES `etudiant` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 29 avr. 2022 à 18:00
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `billets`
--

CREATE TABLE `billets` (
  `id` int(11) NOT NULL,
  `titre` varchar(64) DEFAULT NULL,
  `body` text DEFAULT NULL,
  `cat_id` int(11) DEFAULT 1,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `billets`
--

INSERT INTO `billets` (`id`, `titre`, `body`, `cat_id`, `date`) VALUES
(1, 'go sluc, go', 'tout est dans le titre', 1, '2014-11-20'),
(2, 'Concert : nolwenn live', 'c\'est d\'la balle, Ca vaut bien Mick Jagger et Iggy Stooges réunis.\r\nAngus Young doit l\'ecouter en boucle...', 3, '2014-11-20'),
(3, 'Titanic', 'c\'est l\'histoire d\'un gros bateau qui croise un glaçon', 2, '2014-11-20');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `titre` varchar(64) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `titre`, `description`) VALUES
(1, 'sport', 'tout sur le sport en general'),
(2, 'cinema', 'tout sur le cinema'),
(3, 'music', 'toute la music que j\'aaiiiimeuh, elle vient de la, elle vient du bluuuuuuzee'),
(4, 'tele', 'tout sur les programmes tele, les emissions, les series, et vos stars preferes'),
(8, 'test', 'catégorie de test'),
(9, 'test', 'catégorie de test'),
(10, 'test', 'catégorie de test');

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `id_com` int(11) NOT NULL,
  `contenu` varchar(500) NOT NULL,
  `DateCom` date DEFAULT NULL,
  `id_auteur` int(11) NOT NULL,
  `id_billet` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`id_com`, `contenu`, `DateCom`, `id_auteur`, `id_billet`) VALUES
(1, 'Commentaire 1', '2022-04-29', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

CREATE TABLE `membres` (
  `id_membre` int(11) NOT NULL,
  `pseudo` varchar(25) DEFAULT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `prenom` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `date_inscription` date DEFAULT NULL,
  `mdp` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='base contenant la liste des membres du blog';

--
-- Déchargement des données de la table `membres`
--

INSERT INTO `membres` (`id_membre`, `pseudo`, `nom`, `prenom`, `email`, `date_inscription`, `mdp`) VALUES
(1, 'membre_1', 'Jacob', 'Peter', 'jacob.peter@email.com', '2022-04-29', 'test_test');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `billets`
--
ALTER TABLE `billets`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `categ` (`cat_id`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id_com`),
  ADD KEY `id_billet` (`id_billet`),
  ADD KEY `id_auteur` (`id_auteur`);

--
-- Index pour la table `membres`
--
ALTER TABLE `membres`
  ADD PRIMARY KEY (`id_membre`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `billets`
--
ALTER TABLE `billets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `billets`
--
ALTER TABLE `billets`
  ADD CONSTRAINT `categ` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`id`);

--
-- Contraintes pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `commentaires_ibfk_1` FOREIGN KEY (`id_billet`) REFERENCES `billets` (`id`),
  ADD CONSTRAINT `commentaires_ibfk_2` FOREIGN KEY (`id_auteur`) REFERENCES `membres` (`id_membre`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

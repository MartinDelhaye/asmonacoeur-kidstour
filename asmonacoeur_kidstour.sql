-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 12 déc. 2024 à 11:20
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `asmonacoeur_kidstour`
--

-- --------------------------------------------------------

--
-- Structure de la table `anime`
--

CREATE TABLE `anime` (
  `id_anime` int(11) NOT NULL,
  `id_invite` int(11) DEFAULT NULL,
  `id_evenement` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `etapes`
--

CREATE TABLE `etapes` (
  `id_etape` int(11) NOT NULL,
  `date_etape` date NOT NULL,
  `lieu_etape` varchar(500) NOT NULL,
  `nom_etape` varchar(255) NOT NULL,
  `description_etape` text NOT NULL,
  `illustration_etape` varchar(255) NOT NULL,
  `image_etape` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `invites`
--

CREATE TABLE `invites` (
  `id_invite` int(11) NOT NULL,
  `nom__invite` varchar(50) NOT NULL,
  `prenom__invite` varchar(50) NOT NULL,
  `description_invite` varchar(1000) NOT NULL,
  `contact_invite` varchar(255) NOT NULL,
  `image_invite` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `participe`
--

CREATE TABLE `participe` (
  `id_participe` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_evenement` int(11) DEFAULT NULL,
  `nbr_enfant_participe` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `login_user` varchar(50) NOT NULL,
  `mdp_user` varchar(500) NOT NULL,
  `nom_user` varchar(50) NOT NULL,
  `prenom_user` varchar(50) NOT NULL,
  `type_user` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `login_user`, `mdp_user`, `nom_user`, `prenom_user`, `type_user`) VALUES
(1, 'MartinDelhaye', '$2y$10$0pI/AarH6ZIpNoru.eU50.5EMfnUv/nK0X.0v3JsyyH3e3GdpDJnq', 'Delhaye', 'Martin', 'superAdmin'),
(2, 'Charlotte2711', '$2y$10$0pI/AarH6ZIpNoru.eU50.5EMfnUv/nK0X.0v3JsyyH3e3GdpDJnq', 'Madec', 'Charlotte', 'membre'),
(3, 'MatMatou43', '$2y$10$0pI/AarH6ZIpNoru.eU50.5EMfnUv/nK0X.0v3JsyyH3e3GdpDJnq', 'Couragier', 'Mathis', 'admin');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `anime`
--
ALTER TABLE `anime`
  ADD PRIMARY KEY (`id_anime`),
  ADD KEY `id_invite` (`id_invite`),
  ADD KEY `id_evenement` (`id_evenement`);

--
-- Index pour la table `etapes`
--
ALTER TABLE `etapes`
  ADD PRIMARY KEY (`id_etape`);

--
-- Index pour la table `invites`
--
ALTER TABLE `invites`
  ADD PRIMARY KEY (`id_invite`);

--
-- Index pour la table `participe`
--
ALTER TABLE `participe`
  ADD PRIMARY KEY (`id_participe`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_evenement` (`id_evenement`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `anime`
--
ALTER TABLE `anime`
  MODIFY `id_anime` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `invites`
--
ALTER TABLE `invites`
  MODIFY `id_invite` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `participe`
--
ALTER TABLE `participe`
  MODIFY `id_participe` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `anime`
--
ALTER TABLE `anime`
  ADD CONSTRAINT `anime_ibfk_1` FOREIGN KEY (`id_invite`) REFERENCES `invites` (`id_invite`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `anime_ibfk_2` FOREIGN KEY (`id_evenement`) REFERENCES `etapes` (`id_etape`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `participe`
--
ALTER TABLE `participe`
  ADD CONSTRAINT `participe_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `participe_ibfk_2` FOREIGN KEY (`id_evenement`) REFERENCES `etapes` (`id_etape`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

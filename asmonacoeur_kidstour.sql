-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : ven. 20 déc. 2024 à 10:35
-- Version du serveur : 5.7.39
-- Version de PHP : 8.2.0

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
  `id_etape` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `anime`
--

INSERT INTO `anime` (`id_anime`, `id_invite`, `id_etape`) VALUES
(1, 1, 4),
(2, 2, 1),
(3, 3, 5),
(4, 4, 2),
(5, 5, 3),
(6, 3, 4),
(7, 4, 4),
(8, 5, 1),
(9, 1, 1),
(10, 2, 5),
(11, 4, 5),
(12, 1, 2),
(13, 5, 2),
(14, 2, 3),
(15, 3, 3);

-- --------------------------------------------------------

--
-- Structure de la table `etapes`
--

CREATE TABLE `etapes` (
  `id_etape` int(11) NOT NULL,
  `date_etape` date NOT NULL,
  `lieu_etape` varchar(150) NOT NULL,
  `nom_etape` varchar(255) NOT NULL,
  `description_etape` text NOT NULL,
  `illustration_etape` varchar(255) NOT NULL,
  `image_etape` varchar(255) NOT NULL,
  `ville_etape` varchar(100) NOT NULL,
  `heure_etape` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `etapes`
--

INSERT INTO `etapes` (`id_etape`, `date_etape`, `lieu_etape`, `nom_etape`, `description_etape`, `illustration_etape`, `image_etape`, `ville_etape`, `heure_etape`) VALUES
(1, '2023-11-03', '2 Pl. de la République, 83440 Fayence', 'Le Kids Tour et Aleksandr Golovin à Fayence ce vendredi !', 'Rendez-vous à la mairie.\r\nPour cette étape de l’AS Monaco Kids tour, la journée s’annonce riche en activités : \r\nRencontre avec notre mascotte Bouba et un invité surprise\r\nCible géante gonflable\r\nQuiz sur l’AS Monaco\r\nImmersion du Stade Louis-II grâce à des casques RV\r\nParties de FC 24 sur Playstation 5\r\nEt de belles surprises, telles qu’un maillot dédicacé de notre invité et des invitations pour des matchs sont à gagner ! Tout comme les goodies offerts, c’est une journée à ne pas manquer!', 'images/Temp_kidstour_Complet.jpg', 'images/Kidstour_img_enfant1.webp', 'Fayence', '13h30 - 17h30'),
(2, '2023-11-17', '62 Av. du Trois Septembre, 06320 Cap-d\'Ail', 'Cap-d’Ail en mode Kids Tour !', 'Rendez-vous à la mairie.\r\nPour cette étape de l’AS Monaco Kids tour, cette journée ensoleillée annonce pleins de surprises : \r\nRencontre avec notre mascotte et des invités surprises\r\nEntraînement de football\r\nQuiz sur l’AS Monaco\r\nParties de FC24 sur Playstation 5\r\nC’est aussi l’occasion de se mettre à l’épreuve lors d’un tire au but, les joueurs les plus précis auront le droit de repartir avec de belles surprises !', 'images/Temp_kidstour_Cap_dAil.jpg', 'images/Kidstour_img_enfant2.webp', 'Cap-d’Ail', '13h30 - 17h30'),
(3, '2023-11-24', '1 Av. de la Victoire, 06320 La Turbie', 'Le Kids Tour à La Turbie vendredi 24 novembre !', 'Rendez-vous sur la place de la mairie.\r\nPour cette étape notre équipe vous propose plusieurs divertissements : \r\nRencontre avec notre fidèle mascotte Bouba\r\nEntraînement de foot avec des joueurs de Monaco\r\nQuiz sur l’AS Monaco\r\nCréation de décoration de Noël\r\nLa caravane rouge et blanche sera toujours remplie de pleins de goodies à vous offrir, une autre journée à ne pas louper !', 'images/Temp_kidstour_LaTurbine.jpg', 'images/Kidstour_img_enfant3.webp', 'La Turbie', '13h30 - 17h30'),
(4, '2023-12-01', '5 Pl. de la République, 06670 Levens', 'Avec Folarin Balogun, un Kids Tour à Levens !', 'Rendez-vous sur la place de la mairie.\r\nPour cette étape, l’AS Monacoeur s’annonce encore une fois riche en surprises et émotions. De nombreux défis sont mis en place pour tenter de gagner les calendriers AS Monaco spécial Noël !', 'images/Temp_kidstour_Fayences_Levens.jpg', 'images/Kidstour_img_enfant4.webp', 'Levens', '13h30 - 17h30'),
(5, '2023-12-08', 'Quai Albert 1er, 98000 Monaco', 'Le Kids Tour et Breel Embolo au Village de Noël de Monaco ce vendredi !', 'Rendez-vous au village de Noël\r\nUne journée encore remplie de surprises avec des séances de dédicaces, une visite du marché et d’autres activités et cadeaux pour fêter ce Noël !', 'images/Temp_kidstour_Monaco.jpg', 'images/Kidstour_img_enfant5b.webp', 'Monaco', '13h30 - 17h30');

-- --------------------------------------------------------

--
-- Structure de la table `invites`
--

CREATE TABLE `invites` (
  `id_invite` int(11) NOT NULL,
  `nom_invite` varchar(50) NOT NULL,
  `prenom_invite` varchar(50) NOT NULL,
  `description_invite` varchar(1000) NOT NULL,
  `contact_invite` varchar(255) NOT NULL,
  `image_invite` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `invites`
--

INSERT INTO `invites` (`id_invite`, `nom_invite`, `prenom_invite`, `description_invite`, `contact_invite`, `image_invite`) VALUES
(1, 'Balogun', 'Folarin', 'Folarin Balogun est un jeune footballeur talentueux né le 3 juillet 2001 à New York, aux États-Unis. Il joue comme attaquant et est connu pour sa vitesse et ses nombreux buts. Balogun a grandi en Angleterre et a joué pour Arsenal avant de rejoindre l’AS Monaco en France. Il représente l’équipe nationale des États-Unis et est un espoir prometteur dans le monde du football. Avec son énergie et son talent, il inspire de nombreux jeunes à suivre leurs rêves dans le sport.', 'Téléphone : 06 12 34 56 78\r\nMail : folarin.balogun@gmail.com', 'images/Folarin_Balogun.webp'),
(2, 'Golovin', 'Aleksandr', 'Aleksandr Golovin est un footballeur russe né le 30 mai 1996 à Kaltan, en Russie. Il joue au milieu de terrain et est connu pour sa technique, sa vision de jeu et ses passes précises. Golovin a commencé sa carrière en Russie avant de rejoindre l’AS Monaco, un club de Ligue 1 en France. Il a également représenté l’équipe nationale de Russie dans plusieurs compétitions internationales. Son travail acharné et son style de jeu créatif en font un joueur très apprécié des fans de football.', 'Téléphone : 07 98 76 54 32\r\nMail : aleksandr.golovin@gmail.com', 'images/Aleksandr_Golovin.webp'),
(3, 'Minamino', 'Takumi', 'Takumi Minamino est un footballeur japonais né le 16 janvier 1995 à Izumisano, au Japon. Il joue comme attaquant ou milieu offensif et est connu pour sa rapidité, sa technique et son intelligence sur le terrain. Minamino a joué pour des clubs célèbres comme le Red Bull Salzburg et Liverpool avant de rejoindre l’AS Monaco en France. Il représente également l’équipe nationale du Japon, où il est un joueur clé. Avec son talent et son travail acharné, il est un modèle pour les jeunes passionnés de football.', 'Téléphone : 01 23 45 67 89\r\nMail : takumi.minamino@gmail.com', 'images/Takumi_Minamino.webp'),
(4, 'Akliouche', 'Maghnes', 'Maghnes Akliouche est un jeune footballeur français né le 25 février 2002 à Tremblay-en-France. Il évolue au poste de milieu offensif et est reconnu pour sa créativité, ses dribbles et sa vision du jeu. Formé à l’AS Monaco, il joue actuellement dans l’équipe professionnelle du club en Ligue 1. Akliouche est aussi pressenti comme un futur grand talent du football français. Avec son style élégant et son potentiel, il inspire les jeunes à croire en leurs rêves.', 'Téléphone : 06 87 65 43 21\r\nMail : maghnes.akliouche@gmail.com', 'images/Magnhes_Akliouche.webp'),
(5, 'Embolo', 'Breel', 'Breel Embolo est un footballeur suisse né le 14 février 1997 à Yaoundé, au Cameroun. Il joue comme attaquant et est connu pour sa puissance, sa vitesse et son sens du but. Embolo a évolué dans des clubs prestigieux comme Schalke 04 et le Borussia Mönchengladbach avant de rejoindre l’AS Monaco en France. Il représente l’équipe nationale de Suisse, avec laquelle il a marqué de nombreux buts importants. Son parcours impressionnant inspire les jeunes à travailler dur pour réussir dans le sport.', 'Téléphone : 04 56 78 90 12\r\nMail : breel.embolo@gmail.com', 'images/Breel_Embolo.webp');

-- --------------------------------------------------------

--
-- Structure de la table `organise`
--

CREATE TABLE `organise` (
  `id_organise` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_etape` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `organise`
--

INSERT INTO `organise` (`id_organise`, `id_user`, `id_etape`) VALUES
(1, 1, 5),
(2, 2, 3),
(3, 3, 2),
(4, 4, 1),
(5, 5, 4),
(6, 1, 1),
(7, 1, 2),
(8, 1, 3),
(9, 1, 4),
(10, 2, 1),
(11, 2, 2),
(12, 2, 4),
(13, 2, 5),
(14, 3, 1),
(15, 3, 3),
(16, 3, 4),
(17, 3, 5),
(18, 4, 2),
(19, 4, 3),
(20, 4, 4),
(21, 4, 5),
(22, 5, 1),
(23, 5, 2),
(24, 5, 3),
(25, 5, 5);

-- --------------------------------------------------------

--
-- Structure de la table `participe`
--

CREATE TABLE `participe` (
  `id_participe` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_etape` int(11) DEFAULT NULL,
  `nbr_enfant_participe` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `participe`
--

INSERT INTO `participe` (`id_participe`, `id_user`, `id_etape`, `nbr_enfant_participe`) VALUES
(1, 6, 3, 2),
(2, 7, 5, 3),
(3, 8, 2, 1),
(4, 9, 1, 2),
(5, 10, 4, 3),
(6, 6, 5, 2),
(7, 7, 2, 3),
(8, 8, 1, 1),
(9, 9, 4, 2),
(10, 10, 3, 3);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `login_user` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mdp_user` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom_user` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom_user` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_user` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `login_user`, `mdp_user`, `nom_user`, `prenom_user`, `type_user`) VALUES
(1, 'delhayemar1@gmail.com', '$2y$10$0pI/AarH6ZIpNoru.eU50.5EMfnUv/nK0X.0v3JsyyH3e3GdpDJnq', 'Delhaye', 'Martin', 'superAdmin'),
(2, 'madec.charlotte74@gmail.com', '$2y$10$0pI/AarH6ZIpNoru.eU50.5EMfnUv/nK0X.0v3JsyyH3e3GdpDJnq', 'Madec', 'Charlotte', 'membreAssociation'),
(3, 'mathiscouragier00@gmail.com', '$2y$10$0pI/AarH6ZIpNoru.eU50.5EMfnUv/nK0X.0v3JsyyH3e3GdpDJnq', 'Couragier', 'Mathis', 'membreAssociation'),
(4, 'cmalaquin4@gmail.com', '$2y$10$0pI/AarH6ZIpNoru.eU50.5EMfnUv/nK0X.0v3JsyyH3e3GdpDJnq', 'Malaquin', 'Clara', 'membreAssociation'),
(5, 'hugoc38230@gmail.com', '$2y$10$0pI/AarH6ZIpNoru.eU50.5EMfnUv/nK0X.0v3JsyyH3e3GdpDJnq', 'Cerisier', 'Hugo', 'membreAssociation'),
(6, 'mathieu.dupont@example.com', '$2y$10$0pI/AarH6ZIpNoru.eU50.5EMfnUv/nK0X.0v3JsyyH3e3GdpDJnq', 'Dupont', 'Mathieu', 'participant'),
(7, 'lilou.bernard@example.com', '$2y$10$0pI/AarH6ZIpNoru.eU50.5EMfnUv/nK0X.0v3JsyyH3e3GdpDJnq', 'Bernard', 'Lilou', 'participant'),
(8, 'lucas.myllon@example.com', '$2y$10$0pI/AarH6ZIpNoru.eU50.5EMfnUv/nK0X.0v3JsyyH3e3GdpDJnq', 'Myllon', 'Lucas', 'participant'),
(9, 'emma.lefevre@example.com', '$2y$10$0pI/AarH6ZIpNoru.eU50.5EMfnUv/nK0X.0v3JsyyH3e3GdpDJnq', 'Lefevre', 'Emma', 'participant'),
(10, 'julien.morel@example.com', '$2y$10$0pI/AarH6ZIpNoru.eU50.5EMfnUv/nK0X.0v3JsyyH3e3GdpDJnq', 'Morel', 'Julien', 'participant');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `anime`
--
ALTER TABLE `anime`
  ADD PRIMARY KEY (`id_anime`),
  ADD KEY `id_invite` (`id_invite`),
  ADD KEY `id_evenement` (`id_etape`);

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
-- Index pour la table `organise`
--
ALTER TABLE `organise`
  ADD PRIMARY KEY (`id_organise`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_etape` (`id_etape`);

--
-- Index pour la table `participe`
--
ALTER TABLE `participe`
  ADD PRIMARY KEY (`id_participe`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_evenement` (`id_etape`);

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
  MODIFY `id_anime` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `invites`
--
ALTER TABLE `invites`
  MODIFY `id_invite` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `organise`
--
ALTER TABLE `organise`
  MODIFY `id_organise` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `participe`
--
ALTER TABLE `participe`
  MODIFY `id_participe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `anime`
--
ALTER TABLE `anime`
  ADD CONSTRAINT `anime_ibfk_1` FOREIGN KEY (`id_invite`) REFERENCES `invites` (`id_invite`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `anime_ibfk_2` FOREIGN KEY (`id_etape`) REFERENCES `etapes` (`id_etape`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `organise`
--
ALTER TABLE `organise`
  ADD CONSTRAINT `organise_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `organise_ibfk_2` FOREIGN KEY (`id_etape`) REFERENCES `etapes` (`id_etape`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `participe`
--
ALTER TABLE `participe`
  ADD CONSTRAINT `participe_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `participe_ibfk_2` FOREIGN KEY (`id_etape`) REFERENCES `etapes` (`id_etape`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  ven. 22 jan. 2021 à 10:44
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP :  7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `api_auth`
--

-- --------------------------------------------------------

--
-- Structure de la table `teams`
--

CREATE TABLE `teams` (
  `id` int(255) NOT NULL,
  `name` varchar(256) NOT NULL,
  `img` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `teams`
--

INSERT INTO `teams` (`id`, `name`, `img`) VALUES
(1, 'G2 eSports', 'https://g2esports.com/wp-content/uploads/Secondary_G2_Red_Eye_Dark_background.png'),
(2, 'Team Vitality', 'https://upload.wikimedia.org/wikipedia/fr/3/30/Team_Vitality_Logo_2018.png'),
(3, 'Team Liquid', 'https://upload.wikimedia.org/wikipedia/fr/thumb/f/fe/Team_Liquid.svg/1200px-Team_Liquid.svg.png'),
(4, 'Fnatic', 'https://upload.wikimedia.org/wikipedia/fr/thumb/3/36/Fnatic_Logo.svg/1200px-Fnatic_Logo.svg.png');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `pseudo` varchar(32) NOT NULL,
  `mail` varchar(72) NOT NULL,
  `discord_status` varchar(255) NOT NULL DEFAULT 'not',
  `discord_id` varchar(192) DEFAULT NULL,
  `discord_username` varchar(255) DEFAULT NULL,
  `discord_tag` varchar(10) DEFAULT NULL,
  `discord_avatar` varchar(256) DEFAULT NULL,
  `description` varchar(1024) DEFAULT NULL,
  `team` varchar(256) DEFAULT NULL,
  `age` int(3) DEFAULT NULL,
  `role` varchar(32) NOT NULL DEFAULT 'user',
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `pseudo`, `mail`, `discord_status`, `discord_id`, `discord_username`, `discord_tag`, `discord_avatar`, `description`, `team`, `age`, `role`, `password`) VALUES
(17, 'ROOT', 'trapzfut@gmail.com', 'linked', '205973547095556098', 'PROSERV TrapZed', '1725', 'ef7955b3746fd37d7bac361979eee281', 'sdfsdgsdgsd', 'Fnatic', 21, 'user', 'root'),
(18, 'test', 'qsfqsfqsf', 'not', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', 'aze');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

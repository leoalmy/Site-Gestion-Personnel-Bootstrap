-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 18 sep. 2025 à 09:28
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `empsce`
--

-- --------------------------------------------------------

--
-- Structure de la table `employe`
--

CREATE TABLE `employe` (
  `emp_matricule` char(6) NOT NULL,
  `emp_nom` varchar(50) DEFAULT NULL,
  `emp_prenom` varchar(50) DEFAULT NULL,
  `emp_service` char(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `employe`
--

INSERT INTO `employe` (`emp_matricule`, `emp_nom`, `emp_prenom`, `emp_service`) VALUES
('e001', 'Dubois', 'Roland', 's01'),
('e002', 'Gernau', 'Patricia', 's01'),
('e003', 'Louvel', 'Marc', 's01'),
('e004', 'Maurel', 'Jeanne', 's01'),
('e005', 'Dubosc', 'Alain', 's02'),
('e006', 'Parent', 'Stéphanie', 's02'),
('e007', 'Potier', 'Jean', 's02'),
('e008', 'Fauvel', 'Anne', 's03'),
('e009', 'Nouvion', 'Patrick', 's03'),
('e010', 'Arsane', 'Marie', 's04'),
('e011', 'Durand', 'Sylvie', 's04');

-- --------------------------------------------------------

--
-- Structure de la table `service`
--

CREATE TABLE `service` (
  `sce_code` char(3) NOT NULL,
  `sce_designation` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `service`
--

INSERT INTO `service` (`sce_code`, `sce_designation`) VALUES
('s01', 'Fabrication'),
('s02', 'Emballage'),
('s03', 'Commercial'),
('s04', 'Administration');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `email` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `nom` varchar(150) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `telephone` varchar(16) DEFAULT NULL CHECK (`telephone` regexp '^\\+[0-9]{8,15}$'),
  `dateInscription` date DEFAULT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'membre'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`email`, `mdp`, `nom`, `prenom`, `telephone`, `dateInscription`, `role`) VALUES
('admin@bts.sio', '$2y$10$v3yw0fIcQJYQibLon8//7e3f4d2WJMkH6jxsBhv3JWozoWUHCjXHS', '', 'Admin', '+330000000000', '2025-09-18', 'admin'),
('test@test.com', '$2y$10$w0AnSfhlsE1oz51ZF8uMKuGx56dlqtRnBeANiyp5MzYCvppvBEsnS', 'test1', 'test2', '+330606060606', '2025-09-10', 'membre');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `employe`
--
ALTER TABLE `employe`
  ADD PRIMARY KEY (`emp_matricule`),
  ADD KEY `emp_service` (`emp_service`);

--
-- Index pour la table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`sce_code`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `employe`
--
ALTER TABLE `employe`
  ADD CONSTRAINT `employe_ibfk_1` FOREIGN KEY (`emp_service`) REFERENCES `service` (`sce_code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

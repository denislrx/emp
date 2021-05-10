-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 10 mai 2021 à 19:44
-- Version du serveur :  10.4.17-MariaDB
-- Version de PHP : 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `personnel_bdd`
--

-- --------------------------------------------------------

--
-- Structure de la table `emp2`
--

CREATE TABLE `emp2` (
  `NoEmp` int(4) NOT NULL,
  `Nom` varchar(20) DEFAULT NULL,
  `Prenom` varchar(20) DEFAULT NULL,
  `Emploi` varchar(20) DEFAULT NULL,
  `Sup` int(4) DEFAULT NULL,
  `Embauche` date DEFAULT NULL,
  `Sal` float(9,2) DEFAULT NULL,
  `Comm` float(9,2) DEFAULT NULL,
  `NoServ` int(2) NOT NULL,
  `NOPROJ` int(3) DEFAULT NULL,
  `Saisie` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `emp2`
--

INSERT INTO `emp2` (`NoEmp`, `Nom`, `Prenom`, `Emploi`, `Sup`, `Embauche`, `Sal`, `Comm`, `NoServ`, `NOPROJ`, `Saisie`) VALUES
(1000, 'LEROY', 'PAUL', 'PRESIDENT', NULL, '1987-10-25', 55005.50, NULL, 1, 103, '2021-04-19'),
(1101, 'DUMONT', 'PIERRE', 'VENDEUR', 1300, '1987-10-25', 9952.69, 0.00, 1, 101, '2021-04-19'),
(1102, 'MINET', 'PIERRE', 'VENDEUR', 1300, '1987-10-25', 8894.39, 17230.00, 1, 101, '2021-04-19'),
(1104, 'NYS', 'ETIENNE', 'TECHNICIEN', 1200, '1987-10-25', 13576.45, 0.00, 1, 103, '2021-04-19'),
(1105, 'DENIMAL', 'JEROME', 'COMPTABLE', 1600, '1987-10-25', 17321.23, NULL, 1, 103, '2021-04-19'),
(1200, 'LEMAIRE', 'GUY', 'DIRECTEUR', 1000, '1987-03-11', 36303.63, NULL, 2, 103, '2021-04-19'),
(1201, 'MARTIN', 'JEAN', 'TECHNICIEN', 1200, '1997-06-25', 12358.63, NULL, 2, 103, '2021-04-19'),
(1202, 'DUPONT', 'JACQUES', 'TECHNICIEN', 1200, '1988-10-30', 11344.33, 0.00, 2, 103, '2021-04-19'),
(1300, 'LENOIR', 'GERARD', 'DIRECTEUR', 1000, '1987-04-02', 31353.10, 13071.00, 1, 103, '2021-04-19'),
(1301, 'GERARD', 'ROBERT', 'VENDEUR', 1300, '1999-04-16', 8464.25, 12430.00, 3, 103, '2021-04-19'),
(1303, 'MASURE', 'EMILE', 'TECHNICIEN', 1200, '1988-06-17', 11496.15, NULL, 3, 103, '2021-04-19'),
(1500, 'DUPONT', 'JEAN', 'DIRECTEUR', 1000, '1987-10-23', 28434.84, NULL, 5, 102, '2021-04-19'),
(1501, 'DUPIRE', 'PIERRE', 'ANALYSTE', 1500, '1984-10-24', 23102.31, NULL, 5, 102, '2021-04-19'),
(1502, 'DURAND', 'BERNARD', 'PROGRAMMEUR', 1500, '1987-07-30', 14521.45, NULL, 5, 102, '2021-04-19'),
(1503, 'DELNATTE', 'LUC', 'PUPITREUR', 1500, '1999-01-15', 9681.11, NULL, 5, 102, '2021-04-19'),
(1600, 'LAVARE', 'PAUL', 'DIRECTEUR', 1000, '1991-12-13', 31238.12, NULL, 6, 102, '2021-04-19'),
(1601, 'CARON', 'ALAIN', 'COMPTABLE', 1600, '1985-09-16', 33003.30, NULL, 6, 102, '2021-04-19'),
(1602, 'DUBOIS', 'JULES', 'VENDEUR', 1300, '1990-12-20', 10473.05, 35535.00, 6, 102, '2021-04-19'),
(1603, 'MOREL', 'ROBERT', 'COMPTABLE', 1600, '1985-07-18', 33003.30, NULL, 6, 102, '2021-04-19'),
(1604, 'HAVET', 'ALAIN', 'VENDEUR', 1300, '1991-01-01', 10327.83, 33415.00, 6, 102, '2021-04-19'),
(1605, 'LEROUX', 'DENIS', 'PROGRAMMEUR', 1200, '2021-04-07', 18894.39, 0.00, 5, 102, '2021-04-19'),
(1606, 'DUPONT', 'ROBERT', 'VENDEUR', 1200, '1989-10-13', 9652.00, 26485.00, 3, 101, '2021-04-19'),
(1607, 'LEROUX', 'CHARLES', 'PROGRAMMEUR', 1200, '2012-12-12', 18894.39, 12698.00, 1, 101, '2021-04-19'),
(1608, 'RIBOT', 'JEAN', 'VENDEUR', 1200, '2021-04-19', 18894.39, 12698.00, 3, 102, '2021-04-19'),
(1610, 'RIBOT', 'PAUL', 'VENDEUR', 1200, '2021-04-19', 18894.39, 12698.00, 3, 102, '2021-04-19'),
(1620, 'LEROY BEAULIEU', 'DENIS', 'VENDEUR', 1200, '2021-04-19', 18894.39, 12698.00, 3, 102, '2021-04-19'),
(1621, 'NYSO', 'DENIS', 'PROGRAMMEUR', 1200, '2021-04-19', 18894.39, 12698.00, 1, 102, '2021-04-19'),
(1622, 'GUYOT', 'GERARD', 'PROGRAMMEUR', 1200, '2021-04-20', 18894.39, 0.00, 5, 102, '2021-04-20'),
(1623, 'LAMBERT', 'YVES', 'PROGRAMMEUR', 1200, '2021-04-20', 18894.39, 0.00, 5, 103, '2021-04-20'),
(1624, 'LOISEAU', 'JULIE', 'PROGRAMMEUR', 1000, '2021-04-20', 18894.39, 0.00, 1, 101, '2021-04-20'),
(1625, 'HENRY', 'LUC', 'VENDEUR', 1200, '2021-04-20', 18894.39, 0.00, 1, 101, '2021-04-20'),
(1626, 'PEREZ', 'PAUL', 'SECRETAIRE', 1000, '2021-04-20', 18894.39, 0.00, 1, 101, '2021-04-20');

-- --------------------------------------------------------

--
-- Structure de la table `employes`
--

CREATE TABLE `employes` (
  `NoEmp` int(4) NOT NULL,
  `Nom` varchar(20) DEFAULT NULL,
  `Prenom` varchar(20) DEFAULT NULL,
  `Emploi` varchar(20) DEFAULT NULL,
  `Sup` int(4) DEFAULT NULL,
  `Embauche` date DEFAULT NULL,
  `Sal` float(9,2) DEFAULT NULL,
  `Comm` float(9,2) DEFAULT NULL,
  `NoServ` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `employes`
--

INSERT INTO `employes` (`NoEmp`, `Nom`, `Prenom`, `Emploi`, `Sup`, `Embauche`, `Sal`, `Comm`, `NoServ`) VALUES
(1000, 'LEROY', 'PAUL', 'PRESIDENT', NULL, '1987-10-25', 55005.50, NULL, 1),
(1100, 'DELPIERRE', 'DOROTHEE', 'SECRETAIRE', 1000, '1987-10-25', 12351.20, NULL, 1),
(1101, 'DUMONT', 'LOUIS', 'VENDEUR', 1300, '1987-10-25', 9047.90, 0.00, 1),
(1102, 'MINET', 'MARC', 'VENDEUR', 1300, '1987-10-25', 8085.81, 17230.00, 1),
(1104, 'NYS', 'ETIENNE', 'TECHNICIEN', 1200, '1987-10-25', 12342.23, NULL, 1),
(1105, 'DENIMAL', 'JEROME', 'COMPTABLE', 1600, '1987-10-25', 15746.57, NULL, 1),
(1200, 'LEMAIRE', 'GUY', 'DIRECTEUR', 1000, '1987-03-11', 36303.63, NULL, 2),
(1201, 'MARTIN', 'JEAN', 'TECHNICIEN', 1200, '1997-06-25', 11235.12, NULL, 2),
(1202, 'DUPONT', 'JACQUES', 'TECHNICIEN', 1200, '1988-10-30', 10313.03, NULL, 2),
(1300, 'LENOIR', 'GERARD', 'DIRECTEUR', 1000, '1987-04-02', 31353.10, 13071.00, 1),
(1301, 'GERARD', 'ROBERT', 'VENDEUR', 1300, '1999-04-16', 7694.77, 12430.00, 3),
(1303, 'MASURE', 'EMILE', 'TECHNICIEN', 1200, '1988-06-17', 10451.05, NULL, 3),
(1500, 'DUPONT', 'JEAN', 'DIRECTEUR', 1000, '1987-10-23', 28434.84, NULL, 5),
(1501, 'DUPIRE', 'PIERRE', 'ANALYSTE', 1500, '1984-10-24', 23102.31, NULL, 5),
(1502, 'DURAND', 'BERNARD', 'PROGRAMMEUR', 1500, '1987-07-30', 13201.32, NULL, 5),
(1503, 'DELNATTE', 'LUC', 'PUPITREUR', 1500, '1999-01-15', 8801.01, NULL, 5),
(1600, 'LAVARE', 'PAUL', 'DIRECTEUR', 1000, '1991-12-13', 31238.12, NULL, 6),
(1601, 'CARON', 'ALAIN', 'COMPTABLE', 1600, '1985-09-16', 33003.30, NULL, 6),
(1602, 'DUBOIS', 'JULES', 'VENDEUR', 1300, '1990-12-20', 9520.95, 35535.00, 6),
(1603, 'MOREL', 'ROBERT', 'COMPTABLE', 1600, '1985-07-18', 33003.30, NULL, 6),
(1604, 'HAVET', 'ALAIN', 'VENDEUR', 1300, '1991-01-01', 9388.94, 33415.00, 6),
(1605, 'RICHARD', 'JULES', 'COMPTABLE', 1600, '1985-10-22', 33503.35, NULL, 5),
(1615, 'DUPREZ', 'JEAN', 'BALAYEUR', 1000, '1998-10-22', 6000.60, NULL, 5);

-- --------------------------------------------------------

--
-- Structure de la table `proj`
--

CREATE TABLE `proj` (
  `noproj` int(3) NOT NULL,
  `nomproj` varchar(10) DEFAULT NULL,
  `budget` float(13,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `proj`
--

INSERT INTO `proj` (`noproj`, `nomproj`, `budget`) VALUES
(101, 'alpha', 250000.00),
(102, 'beta', 175000.00),
(103, 'gamma', 10000000000.00);

-- --------------------------------------------------------

--
-- Structure de la table `serv`
--

CREATE TABLE `serv` (
  `NoServ` int(11) NOT NULL,
  `Serv` varchar(20) DEFAULT NULL,
  `Ville` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `serv`
--

INSERT INTO `serv` (`NoServ`, `Serv`, `Ville`) VALUES
(1, 'Direction', 'Paris'),
(2, 'Logistique', 'Seclin'),
(3, 'Ventes', 'Roubaix'),
(4, 'Formation', 'Villeneuve d\'Ascq'),
(5, 'Informatique', 'Lille'),
(6, 'Comptabilite', 'Lille'),
(7, 'Technique', 'Roubaix');

-- --------------------------------------------------------

--
-- Structure de la table `serv2`
--

CREATE TABLE `serv2` (
  `NoServ` int(11) NOT NULL,
  `Serv` varchar(20) DEFAULT NULL,
  `Ville` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `serv2`
--

INSERT INTO `serv2` (`NoServ`, `Serv`, `Ville`) VALUES
(1, 'Direction', 'Paris'),
(2, 'Logistique', 'Seclin'),
(3, 'Ventes', 'Roubaix'),
(4, 'Formation', 'Villeneuve d\'Ascq'),
(5, 'Informatique', 'Lille'),
(6, 'Comptabilite', 'Lille'),
(7, 'Technique', 'Roubaix');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `IdUser` int(4) NOT NULL,
  `Nom` varchar(30) NOT NULL,
  `MDP` varchar(80) NOT NULL,
  `Profil` varchar(15) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`IdUser`, `Nom`, `MDP`, `Profil`) VALUES
(3, 'dd', '$2y$10$wG4LsJ4ywNMglVEymm4Pg.F2of4Px5s5Q3kQXi817IEPDaif7fKIu', 'user'),
(1, 'Denis', '$2y$10$.r1uBhGGTYck3St4n.SVTO7KH8.rsBPi9ufV9Y1gJYRNJ6oKqSwFq', 'user'),
(5, 'Eloi', '$2y$10$aazJbxevgFmqc9gEkTeXS.xzhktH6x9k/9rY/ApyWykUQUeNp.7NW', 'user'),
(2, 'JPM', '$2y$10$sZzSUdvrbfQU6lBKxfqvY.p0.0H7PJPR4/2gTuhL0hBsgY0Qt4/Um', 'admin'),
(6, 'lolo', '$2y$10$91L38j5FBm8hJhSH0/2OF.QyavIFUjcm4WrVwrKfr1v1/CvmPdBT6', 'user'),
(4, 'makhno', '$2y$10$XcTZpYniFfstBWTIHWdc1epcD6P5a8VT2jd.0.UT6y41Gfq9QoDyW', 'user');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `emp2`
--
ALTER TABLE `emp2`
  ADD PRIMARY KEY (`NoEmp`),
  ADD KEY `Serv_FKey` (`NoServ`),
  ADD KEY `Proj_FKey` (`NOPROJ`),
  ADD KEY `Sup_FKey` (`Sup`);

--
-- Index pour la table `employes`
--
ALTER TABLE `employes`
  ADD PRIMARY KEY (`NoEmp`),
  ADD KEY `NoServ` (`NoServ`),
  ADD KEY `Sup` (`Sup`);

--
-- Index pour la table `proj`
--
ALTER TABLE `proj`
  ADD PRIMARY KEY (`noproj`);

--
-- Index pour la table `serv`
--
ALTER TABLE `serv`
  ADD PRIMARY KEY (`NoServ`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD UNIQUE KEY `Nom` (`Nom`),
  ADD KEY `IdUser` (`IdUser`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `emp2`
--
ALTER TABLE `emp2`
  ADD CONSTRAINT `Proj_FKey` FOREIGN KEY (`NOPROJ`) REFERENCES `proj` (`noproj`),
  ADD CONSTRAINT `Serv_FKey` FOREIGN KEY (`NoServ`) REFERENCES `serv` (`NoServ`),
  ADD CONSTRAINT `Sup_FKey` FOREIGN KEY (`Sup`) REFERENCES `emp2` (`NoEmp`);

--
-- Contraintes pour la table `employes`
--
ALTER TABLE `employes`
  ADD CONSTRAINT `employes_ibfk_1` FOREIGN KEY (`NoServ`) REFERENCES `serv` (`NoServ`),
  ADD CONSTRAINT `employes_ibfk_2` FOREIGN KEY (`Sup`) REFERENCES `employes` (`NoEmp`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

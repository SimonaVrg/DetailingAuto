-- phpMyAdmin SQL Dump
-- version 4.7.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 02, 2021 at 04:16 PM
-- Server version: 5.6.34
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `detailingauto`
--
CREATE DATABASE IF NOT EXISTS `detailingauto` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `detailingauto`;

-- --------------------------------------------------------

--
-- Table structure for table `angajat`
--

CREATE TABLE `angajat` (
  `tokenAng` int(11) NOT NULL,
  `idAng` int(11) NOT NULL,
  `numeAng` varchar(50) NOT NULL,
  `mailAng` varchar(50) NOT NULL,
  `nrTelAng` varchar(10) NOT NULL,
  `dataNaAng` date NOT NULL,
  `parolaAng` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `angajat`
--

INSERT INTO `angajat` (`tokenAng`, `idAng`, `numeAng`, `mailAng`, `nrTelAng`, `dataNaAng`, `parolaAng`) VALUES
(1, 1, 'Admin Account', 'mailsef@gmail.com', '0789878744', '1992-05-13', 'parolasef'),
(0, 10, 'Gherasim Paul', 'paulgherasim@yahoo.com', '0789895633', '1949-01-07', 'parola'),
(0, 11, 'Sabina Angajaata', 'sabinaang@yahoo.com', '0789996655', '1987-08-07', 'parola'),
(0, 15, 'Angajat Doi', 'angajat2@yahoo.com', '0794354177', '1958-05-08', 'parola'),
(0, 16, 'Un Angajat', 'un_angajat@yahoo.com', '0789756471', '1975-06-08', 'parola'),
(0, 17, 'Lucian Gherasim', 'lucian@yahoo.com', '0789675644', '1974-06-08', 'parola'),
(0, 18, 'Angajat Trei', 'angajattrei@yahoo.com', '0786786533', '1982-07-28', 'parola'),
(0, 19, 'Angajat Patru', 'angajat4@yahoo.com', '0798454224', '1998-02-18', 'parola');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `tokenCl` int(11) NOT NULL DEFAULT '-1',
  `idCl` int(100) NOT NULL,
  `numeCl` varchar(50) CHARACTER SET utf8 NOT NULL,
  `mailCl` varchar(50) CHARACTER SET utf8 NOT NULL,
  `nrTelCl` varchar(10) CHARACTER SET utf8 NOT NULL,
  `dataNaCl` date NOT NULL,
  `parolaCl` varchar(30) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`tokenCl`, `idCl`, `numeCl`, `mailCl`, `nrTelCl`, `dataNaCl`, `parolaCl`) VALUES
(-1, 1, 'Nume Client', 'mailcl1@gmail.com', '0749963518', '2000-05-14', 'parolacl1'),
(-1, 2, 'Varga Sabina', 'mailcl2@gmail.com', '0748885971', '1989-04-14', 'parolacl2'),
(-1, 7, 'Nume Prenume', 'address@yahoo.com', '0738853416', '2001-08-05', 'parolamea'),
(-1, 11, 'Varga Simona', 'varga.simona97@yahoo.com', '0788888898', '1997-10-25', 'parolanoua'),
(-1, 15, 'Sabina Varga', 'vargasabi@yahoo.com', '0786787865', '1997-02-05', 'parola'),
(-1, 16, 'Nume Prenume', 'simona97@yahoo.com', '0789878766', '1996-08-05', 'paroparo'),
(-1, 17, 'Cont Zece', 'cont10@yahoo.com', '0789876544', '1990-07-08', 'cont10'),
(-1, 18, 'Nume Prenume', 'addressss@yahoo.com', '0719019051', '2001-12-31', 'parola'),
(-1, 19, 'Nume Pren', 'simona93@yahoo.com', '0789856432', '1999-05-18', 'parola'),
(-1, 25, 'Varga Paul', 'vargabp@yahoo.it', '0749221400', '1992-04-20', 'hx2bjyjtty'),
(-1, 26, 'Varga Simona', 'adresanoua@gmail.com', '0786545433', '1999-02-22', 'parola'),
(-1, 27, 'Ciobanu Aline', 'ciobanu@yahoo.com', '0786745664', '1997-03-06', 'parola'),
(-1, 28, 'Patru Iunie', 'patruiunie@yahoo.com', '0781112211', '2000-06-01', 'parola'),
(-1, 29, 'Varga Sabina', 'vrgsabina@yahoo.com', '0789891111', '2001-02-07', 'parola'),
(-1, 30, 'Sapte Iunie', 'sapte@yahoo.com', '0785643333', '1978-08-07', 'parola'),
(-1, 31, 'Magda Ciobanu', 'magaciobanu@yahoo.com', '0789765555', '1980-08-09', 'parola'),
(-1, 32, 'Antoci Madalina', 'antoci@yahoo.com', '0789898822', '1967-08-09', 'parola'),
(-1, 35, 'Magda Gherasim', 'magdaa@yahoo.com', '0789876666', '1989-07-08', 'parola'),
(-1, 36, 'Perca Mirabela', 'mirabela@yahoo.com', '0789996546', '1968-09-08', 'parola'),
(-1, 37, 'Ionut Gabor', 'ionut@yahoo.com', '0740718597', '1997-07-31', 'parola');

-- --------------------------------------------------------

--
-- Table structure for table `coduripromo`
--

CREATE TABLE `coduripromo` (
  `codVoucher` varchar(6) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `procent` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coduripromo`
--

INSERT INTO `coduripromo` (`codVoucher`, `startDate`, `endDate`, `procent`) VALUES
('AA22AA', '2021-04-05', '2021-06-05', 10),
('AA77AA', '2021-04-24', '2021-05-24', 10),
('AB03CD', '2021-03-06', '2021-04-06', 10),
('AB04CD', '2021-03-04', '2021-06-04', 15),
('AB05CD', '2021-03-05', '2021-06-05', 20),
('AB07CD', '2021-04-13', '2021-04-13', 20);

-- --------------------------------------------------------

--
-- Table structure for table `coduripromofolosite`
--

CREATE TABLE `coduripromofolosite` (
  `codVoucher` varchar(6) NOT NULL,
  `mailCl` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coduripromofolosite`
--

INSERT INTO `coduripromofolosite` (`codVoucher`, `mailCl`) VALUES
('', 'varga.simona97@yahoo.com'),
('AA22AA', 'varga.simona97@yahoo.com'),
('AB04CD', 'varga.simona97@yahoo.com'),
('AB05CD', 'varga.simona97@yahoo.com');

-- --------------------------------------------------------

--
-- Table structure for table `marcamasina`
--

CREATE TABLE `marcamasina` (
  `idMarca` int(11) NOT NULL,
  `numeMarca` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `marcamasina`
--

INSERT INTO `marcamasina` (`idMarca`, `numeMarca`) VALUES
(1, 'Alfa Romeo'),
(3, 'Aston Martin'),
(2, 'Audi'),
(4, 'Bentley'),
(5, 'BMW'),
(6, 'Chevrolet'),
(7, 'Citroen'),
(8, 'Dacia'),
(9, 'Daewoo'),
(10, 'Dodge'),
(11, 'Fiat'),
(12, 'Ford'),
(13, 'Honda'),
(14, 'Hyundai'),
(15, 'Iveco'),
(16, 'Jaguar'),
(17, 'Jeep'),
(18, 'Kia'),
(19, 'Land Rover'),
(20, 'Lexus'),
(21, 'Maserati'),
(22, 'Maybach'),
(23, 'Mazda'),
(24, 'Mercedes-Benz'),
(25, 'Mini'),
(26, 'Mitsubishi'),
(27, 'Nissan'),
(28, 'Opel'),
(29, 'Peugeot'),
(30, 'Porche'),
(31, 'Renault'),
(32, 'Rolls-Royce'),
(33, 'Rover'),
(34, 'Saab'),
(35, 'Seat'),
(36, 'Skoda'),
(37, 'Smart'),
(38, 'Subaru'),
(39, 'Suzuki'),
(40, 'Tesla'),
(41, 'Toyota'),
(42, 'Volkswagen'),
(43, 'Volvo');

-- --------------------------------------------------------

--
-- Table structure for table `masini`
--

CREATE TABLE `masini` (
  `idMasina` int(11) NOT NULL,
  `marca` text NOT NULL,
  `model` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `masini`
--

INSERT INTO `masini` (`idMasina`, `marca`, `model`) VALUES
(11, 'Alfa Romeo', '145'),
(12, 'Alfa Romeo', '146'),
(13, 'Alfa Romeo', '147'),
(14, 'Alfa Romeo', '156'),
(15, 'Alfa Romeo', '159'),
(16, 'Alfa Romeo', 'Brera'),
(17, 'Alfa Romeo', 'Giulia'),
(18, 'Alfa Romeo', 'Giulietta'),
(19, 'Alfa Romeo', 'GT'),
(20, 'Alfa Romeo', 'Mito'),
(21, 'Alfa Romeo', 'Spider'),
(22, 'Alfa Romeo', 'Stelvio'),
(23, 'Audi', '90'),
(24, 'Audi', 'A1'),
(25, 'Audi', 'A2'),
(26, 'Audi', 'A3'),
(27, 'Audi', 'A4'),
(28, 'Audi', 'A4 Allroad'),
(29, 'Audi', 'A5'),
(30, 'Audi', 'A6'),
(31, 'Audi', 'A7'),
(32, 'Audi', 'A8'),
(33, 'Audi', 'RS Q3'),
(34, 'Audi', 'Cabriolet'),
(35, 'Audi', 'Q2'),
(36, 'Audi', 'Q3'),
(37, 'Audi', 'Q5'),
(38, 'Audi', 'Q7'),
(39, 'Audi', 'Q8'),
(40, 'Audi', 'Quattro'),
(41, 'Audi', 'R8'),
(42, 'Audi', 'RSQ8'),
(43, 'Audi', 'RS3'),
(44, 'Audi', 'RS4'),
(45, 'Audi', 'RS5'),
(46, 'Audi', 'RS6'),
(47, 'Audi', 'RS7'),
(48, 'Audi', 'S3'),
(49, 'Audi', 'S4'),
(50, 'Audi', 'S5'),
(51, 'Audi', 'S6'),
(52, 'Audi', 'S7'),
(53, 'Audi', 'S8'),
(54, 'Audi', 'SQ5'),
(55, 'Audi', 'SQ7'),
(56, 'Audi', 'SQ8'),
(57, 'Audi', 'TT'),
(58, 'Audi', 'TT RS'),
(59, 'Audi', 'TT S'),
(60, 'BMW', 'ALPINA'),
(61, 'BMW', 'i8'),
(62, 'BMW', 'M1'),
(63, 'BMW', 'M2'),
(64, 'BMW', 'M3'),
(65, 'BMW', 'M4'),
(66, 'BMW', 'M5'),
(67, 'BMW', 'M6'),
(68, 'BMW', 'M850'),
(69, 'BMW', 'X3 M'),
(70, 'BMW', 'X4 M'),
(71, 'BMW', 'X5 M'),
(72, 'BMW', 'X6M'),
(73, 'BMW', 'Z4'),
(74, 'BMW', 'Z4 M'),
(75, 'BMW', 'i3'),
(76, 'BMW', 'iX3'),
(77, 'BMW', 'Seria 1'),
(78, 'BMW', 'Seria 2'),
(79, 'BMW', 'Seria 3'),
(80, 'BMW', 'Seria 4'),
(81, 'BMW', 'Seria 5'),
(82, 'BMW', 'Seria 6'),
(83, 'BMW', 'Seria 7'),
(84, 'BMW', 'Seria 8'),
(85, 'BMW', 'X7'),
(86, 'BMW', 'X1'),
(87, 'BMW', 'X2'),
(88, 'BMW', 'X3'),
(89, 'BMW', 'X4'),
(90, 'BMW', 'X5'),
(91, 'BMW', 'X6'),
(92, 'Chevrolet', 'Aveo'),
(93, 'Chevrolet', 'Camaro'),
(94, 'Chevrolet', 'Captiva'),
(95, 'Chevrolet', 'Corvette'),
(96, 'Chevrolet', 'Cruze'),
(97, 'Chevrolet', 'Epica'),
(98, 'Chevrolet', 'Kalos'),
(99, 'Chevrolet', 'Matiz'),
(100, 'Chevrolet', 'Nubira'),
(101, 'Chevrolet', 'Orlando'),
(102, 'Chevrolet', 'Silverado'),
(103, 'Chevrolet', 'Spark'),
(104, 'Chevrolet', 'Tahoe'),
(105, 'Chevrolet', 'Trax'),
(106, 'Citroen', 'Berlingo'),
(107, 'Citroen', 'C-Crosser'),
(108, 'Citroen', 'C-ZERO'),
(109, 'Citroen', 'C1'),
(110, 'Citroen', 'C2'),
(111, 'Citroen', 'C3'),
(112, 'Citroen', 'C3 AIRCROSS'),
(113, 'Citroen', 'C3 Picasso'),
(114, 'Citroen', 'C3 Pluriel'),
(115, 'Citroen', 'C4'),
(116, 'Citroen', 'C4 Aircross'),
(117, 'Citroen', 'C4 Cactus'),
(118, 'Citroen', 'C4 Grand Picasso'),
(119, 'Citroen', 'C4 Grand Space Tourer'),
(120, 'Citroen', 'C4 Picasso'),
(121, 'Citroen', 'C5'),
(122, 'Citroen', 'C5 Aircross'),
(123, 'Citroen', 'C6'),
(124, 'Citroen', 'C8'),
(125, 'Citroen', 'DS3'),
(126, 'Citroen', 'DS4'),
(127, 'Citroen', 'DS5'),
(128, 'Citroen', 'Jumper'),
(129, 'Citroen', 'Jumpy'),
(130, 'Citroen', 'Nemo'),
(131, 'Citroen', 'SpaceTourer'),
(132, 'Citroen', 'Xsara'),
(133, 'Citroen', 'Xsara Picasso'),
(134, 'Dacia', '1300'),
(135, 'Dacia', '1310'),
(136, 'Dacia', '1410'),
(137, 'Dacia', 'Logan Stepway'),
(138, 'Dacia', 'Dokker'),
(139, 'Dacia', 'Duster'),
(140, 'Dacia', 'Lodgy'),
(141, 'Dacia', 'Logan'),
(142, 'Dacia', 'Logan Van'),
(143, 'Dacia', 'Pick Up'),
(144, 'Dacia', 'Sandero'),
(145, 'Dacia', 'Sandero Stepway'),
(146, 'Dacia', 'Solenza'),
(147, 'Dacia', 'Super Nova');

-- --------------------------------------------------------

--
-- Table structure for table `pretserv`
--

CREATE TABLE `pretserv` (
  `idServ` int(100) NOT NULL,
  `idTip` int(100) NOT NULL,
  `pretServ` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pretserv`
--

INSERT INTO `pretserv` (`idServ`, `idTip`, `pretServ`) VALUES
(1, 1, 250),
(1, 2, 450),
(1, 3, 550),
(1, 4, 650),
(1, 5, 750),
(1, 6, 300),
(1, 7, 400),
(2, 1, 200),
(2, 2, 350),
(2, 3, 500),
(2, 4, 550),
(2, 5, 550),
(2, 6, 250),
(2, 7, 300),
(5, 1, 100),
(5, 2, 150),
(5, 3, 250),
(5, 4, 250),
(5, 5, 350),
(5, 6, 100),
(5, 7, 100),
(6, 1, 40),
(6, 2, 80),
(6, 3, 100),
(6, 4, 100),
(6, 5, 180),
(6, 6, 60),
(6, 7, 70),
(7, 1, 150),
(7, 2, 150),
(7, 3, 150),
(7, 4, 150),
(7, 5, 150),
(7, 6, 150),
(7, 7, 150),
(8, 1, 150),
(8, 2, 300),
(8, 3, 400),
(8, 4, 350),
(8, 5, 450),
(8, 6, 200),
(8, 7, 250),
(9, 1, 30),
(9, 2, 50),
(9, 3, 80),
(9, 4, 150),
(9, 5, 200),
(9, 6, 40),
(9, 7, 50),
(10, 1, 200),
(10, 2, 200),
(10, 3, 200),
(10, 4, 200),
(10, 5, 200),
(10, 6, 200),
(10, 7, 200),
(11, 1, 90),
(11, 2, 150),
(11, 3, 250),
(11, 4, 250),
(11, 5, 350),
(11, 6, 100),
(11, 7, 150),
(12, 1, 450),
(12, 2, 450),
(12, 3, 450),
(12, 4, 450),
(12, 5, 550),
(12, 6, 450),
(12, 7, 450),
(13, 1, 0),
(13, 2, 0),
(13, 3, 0),
(13, 4, 0),
(13, 5, 0),
(13, 6, 0),
(13, 7, 0),
(15, 1, 0),
(15, 2, 0),
(15, 3, 0),
(15, 4, 0),
(15, 5, 0),
(15, 6, 0),
(15, 7, 0),
(16, 1, 50),
(16, 2, 40),
(16, 3, 100),
(16, 4, 0),
(16, 5, 0),
(16, 6, 0),
(16, 7, 0);

-- --------------------------------------------------------

--
-- Table structure for table `programare`
--

CREATE TABLE `programare` (
  `idProg` int(10) NOT NULL,
  `idCl` int(10) NOT NULL,
  `idMasina` int(11) NOT NULL,
  `tipCaroserie` int(100) NOT NULL,
  `dataProg` date NOT NULL,
  `idAng` int(10) NOT NULL,
  `listaServicii` varchar(1000) NOT NULL,
  `codVoucher` varchar(6) DEFAULT NULL,
  `pretProg` int(10) NOT NULL,
  `pretFinal` int(100) DEFAULT NULL,
  `statusProg` enum('Acceptata','Finalizata','Anulata') NOT NULL DEFAULT 'Acceptata',
  `displayForClient` set('display','hide') NOT NULL DEFAULT 'display'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `programare`
--

INSERT INTO `programare` (`idProg`, `idCl`, `idMasina`, `tipCaroserie`, `dataProg`, `idAng`, `listaServicii`, `codVoucher`, `pretProg`, `pretFinal`, `statusProg`, `displayForClient`) VALUES
(123, 36, 0, 0, '2020-06-10', 10, 'Curatare plafon,Pachet exterior,Pachet interior', NULL, 520, NULL, 'Anulata', 'display'),
(139, 17, 0, 0, '2020-06-25', 11, 'Curatare plafon,Pachet exterior,Pachet interior', NULL, 520, NULL, 'Finalizata', 'display'),
(144, 11, 0, 0, '2020-06-30', 10, 'Dressing cauciucuri,Curatare tapiterie auto', NULL, 350, NULL, 'Finalizata', 'display'),
(146, 36, 0, 0, '2020-07-06', 10, 'Curatare tapiterie auto', NULL, 250, NULL, 'Acceptata', 'display'),
(150, 31, 0, 0, '2020-06-10', 15, 'Dressing cauciucuri,Curatare tapiterie auto', NULL, 350, NULL, 'Acceptata', 'display'),
(151, 18, 0, 0, '2020-06-10', 15, 'Dressing cauciucuri,Curatare tapiterie auto', NULL, 350, NULL, 'Acceptata', 'display'),
(159, 11, 0, 0, '2020-06-26', 10, 'Curatare tapiterie auto', NULL, 250, NULL, 'Acceptata', 'display'),
(174, 11, 0, 0, '2020-06-28', 10, 'Reconditionare polish si jante,Curatare tapiterie auto,Curatare portbagaj', NULL, 800, NULL, 'Finalizata', 'display'),
(175, 11, 0, 0, '2020-07-28', 17, 'Polish faruri,Curatare portbagaj', NULL, 250, NULL, 'Finalizata', 'display'),
(176, 11, 0, 0, '2020-07-20', 15, 'Polish faruri,Reconditionare polish si jante', NULL, 600, NULL, 'Finalizata', 'hide'),
(177, 11, 0, 0, '2020-08-27', 11, 'Curatare tapiterie auto', NULL, 250, NULL, 'Acceptata', 'hide'),
(178, 11, 0, 0, '2020-08-27', 10, 'Dressing cauciucuri', NULL, 100, NULL, 'Acceptata', 'hide'),
(179, 11, 0, 0, '2020-08-25', 10, 'Curatare portbagaj', NULL, 200, NULL, 'Acceptata', 'display'),
(180, 11, 0, 0, '2021-04-28', 11, 'Curatare tapiterie auto,Curatare portbagaj,Curatare tapiterie auto,Curatare portbagaj,Curatare tapiterie auto,Curatare portbagaj,Curatare tapiterie auto,Curatare portbagaj,Curatare tapiterie auto,Curatare portbagaj,Curatare tapiterie auto,Curatare portbagaj,Curatare tapiterie auto,Curatare portbagaj,Curatare tapiterie auto,Curatare portbagaj,Curatare tapiterie auto,Curatare portbagaj,Curatare tapiterie auto,Curatare portbagaj', NULL, 800, NULL, 'Acceptata', 'display'),
(181, 11, 0, 0, '2021-04-30', 16, 'Dressing cauciucuri,Curatare tapiterie auto', NULL, 920, NULL, 'Acceptata', 'display'),
(182, 11, 0, 0, '2021-04-11', 19, 'Dressing cauciucuri', 'AB05CD', 256, NULL, 'Finalizata', 'hide'),
(184, 11, 0, 0, '2021-04-29', 16, 'Curatare portbagaj', NULL, 200, NULL, 'Acceptata', 'display'),
(185, 11, 16, 5, '2021-04-30', 11, 'Corectie vopsea si lac, Polish faruri', 'AA22AA', 500, 540, 'Acceptata', 'display'),
(186, 11, 0, 0, '2021-04-25', 15, 'Curatare tapiterie auto', NULL, 600, NULL, 'Acceptata', 'display'),
(187, 11, 0, 0, '2021-04-25', 15, 'Curatare tapiterie auto', NULL, 600, NULL, 'Acceptata', 'display'),
(188, 11, 0, 0, '2021-04-28', 17, 'Polish faruri', NULL, 550, NULL, 'Acceptata', 'display'),
(189, 11, 0, 0, '2021-04-18', 15, 'Curatare portbagaj', NULL, 200, NULL, 'Acceptata', 'display'),
(190, 11, 0, 0, '2021-04-18', 15, 'Curatare portbagaj', NULL, 200, NULL, 'Acceptata', 'display'),
(193, 11, 0, 0, '2021-04-29', 15, 'Curatare portbagaj', NULL, 200, NULL, 'Acceptata', 'display'),
(196, 11, 0, 0, '2021-04-29', 11, 'Aplicare ceara protectie,Polish faruri ', NULL, 230, NULL, 'Acceptata', 'display'),
(197, 11, 0, 7, '2021-04-30', 15, 'Polish exterior', NULL, 400, NULL, 'Acceptata', 'display'),
(198, 11, 0, 0, '2021-04-29', 10, 'Aplicare tratament piele ', NULL, 50, NULL, 'Acceptata', 'display'),
(199, 11, 0, 3, '2021-04-29', 18, 'Decontaminare cu Argila', NULL, 250, NULL, 'Acceptata', 'display'),
(200, 11, 54, 4, '2021-04-01', 10, 'Cosmetizare motor', NULL, 200, NULL, 'Acceptata', 'display'),
(201, 11, 18, 7, '2021-04-30', 10, 'Polish exterior', NULL, 400, NULL, 'Acceptata', 'display'),
(202, 11, 19, 7, '2021-04-30', 17, 'Polish exterior,Cosmetizare interior,Corectie vopsea si lac,Aplicare ceara protectie,Polish faruri ,Vopsire si reconditionare piele,Aplicare tratament piele ,Cosmetizare motor,Decontaminare cu Argila,Reconditionare jante', 'AB04CD', 1802, NULL, 'Acceptata', 'display'),
(203, 11, 17, 4, '2021-05-21', 17, 'Aplicare ceara protectie, Serviciu25', 'AA22AA', 180, NULL, 'Acceptata', 'display');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `idProg` int(100) NOT NULL,
  `review` text CHARACTER SET utf8 NOT NULL,
  `displayNume` set('public','anonim') CHARACTER SET utf8 NOT NULL DEFAULT 'public'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`idProg`, `review`, `displayNume`) VALUES
(139, 'Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper Suuper ', 'anonim'),
(144, 'scfawefcaewfc ', 'anonim'),
(174, 'ddddddddddd', 'public'),
(175, 'DDDD WQdwd kkkk', 'anonim'),
(176, 'ce ef defwdQWD    ', 'public');

-- --------------------------------------------------------

--
-- Table structure for table `servicii`
--

CREATE TABLE `servicii` (
  `idServ` int(100) NOT NULL,
  `numeServ` text CHARACTER SET utf8 COLLATE utf8_romanian_ci NOT NULL,
  `pretServ` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `servicii`
--

INSERT INTO `servicii` (`idServ`, `numeServ`, `pretServ`) VALUES
(1, 'Polish exterior', 450),
(2, 'Cosmetizare interior', 350),
(5, 'Corectie vopsea si lac', 150),
(6, 'Aplicare ceara protectie', 80),
(7, 'Polish faruri ', 150),
(8, 'Vopsire si reconditionare piele', 300),
(9, 'Aplicare tratament piele ', 50),
(10, 'Cosmetizare motor', 200),
(11, 'Decontaminare cu Argila', 150),
(12, 'Reconditionare jante', 450),
(13, 'Serviciu25', 100),
(14, 'Serviciu26', 250),
(15, 'Serviciu27', 230),
(16, 'Pachet interior+exterior + una alta asta aia una alta asta aia', 220);

-- --------------------------------------------------------

--
-- Table structure for table `serviciu`
--

CREATE TABLE `serviciu` (
  `idServ` int(100) NOT NULL,
  `numeServ` varchar(100) NOT NULL,
  `pretServ` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `serviciu`
--

INSERT INTO `serviciu` (`idServ`, `numeServ`, `pretServ`) VALUES
(4, 'Polish faruri', 550),
(5, 'Protectie lac cu ceara', 450),
(6, 'Dressing cauciucuri', 320),
(7, 'Curatare tapiterie auto', 600),
(8, 'Curatare portbagaj', 200);

-- --------------------------------------------------------

--
-- Table structure for table `tipcaroserie`
--

CREATE TABLE `tipcaroserie` (
  `idTip` int(100) NOT NULL,
  `numeTip` varchar(20) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipcaroserie`
--

INSERT INTO `tipcaroserie` (`idTip`, `numeTip`) VALUES
(6, 'Cabrio'),
(3, 'Combi'),
(1, 'Compacta'),
(7, 'Coupe'),
(4, 'Monovolum'),
(2, 'Sedan '),
(5, 'SUV');

-- --------------------------------------------------------

--
-- Table structure for table `voucher`
--

CREATE TABLE `voucher` (
  `mailCl` varchar(30) NOT NULL,
  `codVoucher` varchar(6) NOT NULL,
  `disponibilitate` varchar(10) NOT NULL DEFAULT 'disponibil'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `voucher`
--

INSERT INTO `voucher` (`mailCl`, `codVoucher`, `disponibilitate`) VALUES
('address@yahoo.com', 'AB12CD', 'disponibil'),
('address@yahoo.com', 'AK75GH', 'disponibil'),
('address@yahoo.com', 'AX78BG', 'disponibil'),
('address@yahoo.com', 'AX78BH', 'disponibil'),
('address@yahoo.com', 'AX78BJ', 'disponibil'),
('address@yahoo.com', 'AX78BK', 'disponibil'),
('address@yahoo.com', 'AX78BL', 'disponibil'),
('address@yahoo.com', 'AX78BM', 'disponibil'),
('address@yahoo.com', 'AX78BO', 'disponibil'),
('address@yahoo.com', 'AX78HL', 'disponibil'),
('address@yahoo.com', 'BU78GG', 'disponibil'),
('address@yahoo.com', 'KH84GT', 'disponibil'),
('address@yahoo.com', 'KH84GX', 'disponibil'),
('address@yahoo.com', 'XA65AS', 'disponibil'),
('address@yahoo.com', 'XK78AB', 'disponibil'),
('addressss@yahoo.com', 'AB12CD', 'disponibil'),
('addressss@yahoo.com', 'AK75GH', 'disponibil'),
('addressss@yahoo.com', 'AX78BG', 'disponibil'),
('addressss@yahoo.com', 'AX78BH', 'disponibil'),
('addressss@yahoo.com', 'AX78BJ', 'disponibil'),
('addressss@yahoo.com', 'AX78BK', 'disponibil'),
('addressss@yahoo.com', 'AX78BL', 'disponibil'),
('addressss@yahoo.com', 'AX78BM', 'disponibil'),
('addressss@yahoo.com', 'AX78BO', 'disponibil'),
('addressss@yahoo.com', 'AX78HL', 'disponibil'),
('addressss@yahoo.com', 'BU78GG', 'disponibil'),
('addressss@yahoo.com', 'KH84GT', 'disponibil'),
('addressss@yahoo.com', 'KH84GX', 'disponibil'),
('addressss@yahoo.com', 'XA65AS', 'disponibil'),
('addressss@yahoo.com', 'XK78AB', 'disponibil'),
('adresanoua@gmail.com', 'AB12CD', 'disponibil'),
('adresanoua@gmail.com', 'AK75GH', 'disponibil'),
('adresanoua@gmail.com', 'AX78BG', 'disponibil'),
('adresanoua@gmail.com', 'AX78BH', 'disponibil'),
('adresanoua@gmail.com', 'AX78BJ', 'disponibil'),
('adresanoua@gmail.com', 'AX78BK', 'disponibil'),
('adresanoua@gmail.com', 'AX78BL', 'disponibil'),
('adresanoua@gmail.com', 'AX78BM', 'disponibil'),
('adresanoua@gmail.com', 'AX78BO', 'disponibil'),
('adresanoua@gmail.com', 'AX78HL', 'disponibil'),
('adresanoua@gmail.com', 'BU78GG', 'disponibil'),
('adresanoua@gmail.com', 'KH84GT', 'disponibil'),
('adresanoua@gmail.com', 'KH84GX', 'disponibil'),
('adresanoua@gmail.com', 'XA65AS', 'disponibil'),
('adresanoua@gmail.com', 'XK78AB', 'disponibil'),
('antoci@yahoo.com', 'AB12CD', 'disponibil'),
('antoci@yahoo.com', 'AK75GH', 'disponibil'),
('antoci@yahoo.com', 'AX78BG', 'disponibil'),
('antoci@yahoo.com', 'AX78BH', 'disponibil'),
('antoci@yahoo.com', 'AX78BJ', 'disponibil'),
('antoci@yahoo.com', 'AX78BK', 'disponibil'),
('antoci@yahoo.com', 'AX78BL', 'disponibil'),
('antoci@yahoo.com', 'AX78BM', 'disponibil'),
('antoci@yahoo.com', 'AX78BO', 'disponibil'),
('antoci@yahoo.com', 'AX78HL', 'disponibil'),
('antoci@yahoo.com', 'BU78GG', 'disponibil'),
('antoci@yahoo.com', 'KH84GT', 'disponibil'),
('antoci@yahoo.com', 'KH84GX', 'disponibil'),
('antoci@yahoo.com', 'XA65AS', 'disponibil'),
('antoci@yahoo.com', 'XK78AB', 'disponibil'),
('ciobanu@yahoo.com', 'AB12CD', 'disponibil'),
('ciobanu@yahoo.com', 'AK75GH', 'disponibil'),
('ciobanu@yahoo.com', 'AX78BG', 'disponibil'),
('ciobanu@yahoo.com', 'AX78BH', 'disponibil'),
('ciobanu@yahoo.com', 'AX78BJ', 'disponibil'),
('ciobanu@yahoo.com', 'AX78BK', 'disponibil'),
('ciobanu@yahoo.com', 'AX78BL', 'disponibil'),
('ciobanu@yahoo.com', 'AX78BM', 'disponibil'),
('ciobanu@yahoo.com', 'AX78BO', 'disponibil'),
('ciobanu@yahoo.com', 'AX78HL', 'disponibil'),
('ciobanu@yahoo.com', 'BU78GG', 'disponibil'),
('ciobanu@yahoo.com', 'KH84GT', 'disponibil'),
('ciobanu@yahoo.com', 'KH84GX', 'disponibil'),
('ciobanu@yahoo.com', 'XA65AS', 'disponibil'),
('ciobanu@yahoo.com', 'XK78AB', 'disponibil'),
('cont10@yahoo.com', 'AB12CD', 'disponibil'),
('cont10@yahoo.com', 'AK75GH', 'disponibil'),
('cont10@yahoo.com', 'AX78BG', 'disponibil'),
('cont10@yahoo.com', 'AX78BH', 'disponibil'),
('cont10@yahoo.com', 'AX78BJ', 'disponibil'),
('cont10@yahoo.com', 'AX78BK', 'disponibil'),
('cont10@yahoo.com', 'AX78BL', 'disponibil'),
('cont10@yahoo.com', 'AX78BM', 'disponibil'),
('cont10@yahoo.com', 'AX78BO', 'disponibil'),
('cont10@yahoo.com', 'AX78HL', 'disponibil'),
('cont10@yahoo.com', 'BU78GG', 'disponibil'),
('cont10@yahoo.com', 'KH84GT', 'disponibil'),
('cont10@yahoo.com', 'KH84GX', 'disponibil'),
('cont10@yahoo.com', 'XA65AS', 'disponibil'),
('cont10@yahoo.com', 'XK78AB', 'disponibil'),
('ionut@yahoo.com', 'AB12CD', 'disponibil'),
('ionut@yahoo.com', 'AK75GH', 'disponibil'),
('ionut@yahoo.com', 'AX78BG', 'disponibil'),
('ionut@yahoo.com', 'XA65AS', 'disponibil'),
('ionut@yahoo.com', 'XK78AB', 'disponibil'),
('magaciobanu@yahoo.com', 'AB12CD', 'disponibil'),
('magaciobanu@yahoo.com', 'AK75GH', 'disponibil'),
('magaciobanu@yahoo.com', 'AX78BG', 'disponibil'),
('magaciobanu@yahoo.com', 'AX78BH', 'disponibil'),
('magaciobanu@yahoo.com', 'AX78BJ', 'disponibil'),
('magaciobanu@yahoo.com', 'AX78BK', 'disponibil'),
('magaciobanu@yahoo.com', 'AX78BL', 'disponibil'),
('magaciobanu@yahoo.com', 'AX78BM', 'disponibil'),
('magaciobanu@yahoo.com', 'AX78BO', 'disponibil'),
('magaciobanu@yahoo.com', 'AX78HL', 'disponibil'),
('magaciobanu@yahoo.com', 'BU78GG', 'disponibil'),
('magaciobanu@yahoo.com', 'KH84GT', 'disponibil'),
('magaciobanu@yahoo.com', 'KH84GX', 'disponibil'),
('magaciobanu@yahoo.com', 'XA65AS', 'disponibil'),
('magaciobanu@yahoo.com', 'XK78AB', 'disponibil'),
('magdaa@yahoo.com', 'AB12CD', 'disponibil'),
('magdaa@yahoo.com', 'AK75GH', 'disponibil'),
('magdaa@yahoo.com', 'AX78BG', 'disponibil'),
('magdaa@yahoo.com', 'AX78BH', 'disponibil'),
('magdaa@yahoo.com', 'AX78BJ', 'disponibil'),
('magdaa@yahoo.com', 'AX78BK', 'disponibil'),
('magdaa@yahoo.com', 'AX78BL', 'disponibil'),
('magdaa@yahoo.com', 'AX78BM', 'disponibil'),
('magdaa@yahoo.com', 'AX78BO', 'disponibil'),
('magdaa@yahoo.com', 'AX78HL', 'disponibil'),
('magdaa@yahoo.com', 'BU78GG', 'disponibil'),
('magdaa@yahoo.com', 'KH84GT', 'disponibil'),
('magdaa@yahoo.com', 'KH84GX', 'disponibil'),
('magdaa@yahoo.com', 'XA65AS', 'disponibil'),
('magdaa@yahoo.com', 'XK78AB', 'disponibil'),
('mailcl1@gmail.com', 'AB12CD', 'disponibil'),
('mailcl1@gmail.com', 'AK75GH', 'disponibil'),
('mailcl1@gmail.com', 'AX78BG', 'disponibil'),
('mailcl1@gmail.com', 'AX78BH', 'disponibil'),
('mailcl1@gmail.com', 'AX78BJ', 'disponibil'),
('mailcl1@gmail.com', 'AX78BK', 'disponibil'),
('mailcl1@gmail.com', 'AX78BL', 'disponibil'),
('mailcl1@gmail.com', 'AX78BM', 'disponibil'),
('mailcl1@gmail.com', 'AX78BO', 'disponibil'),
('mailcl1@gmail.com', 'AX78HL', 'disponibil'),
('mailcl1@gmail.com', 'BU78GG', 'disponibil'),
('mailcl1@gmail.com', 'KH84GT', 'disponibil'),
('mailcl1@gmail.com', 'KH84GX', 'disponibil'),
('mailcl1@gmail.com', 'XA65AS', 'disponibil'),
('mailcl1@gmail.com', 'XK78AB', 'disponibil'),
('mailcl2@gmail.com', 'AB12CD', 'disponibil'),
('mailcl2@gmail.com', 'AK75GH', 'disponibil'),
('mailcl2@gmail.com', 'AX78BG', 'disponibil'),
('mailcl2@gmail.com', 'AX78BH', 'disponibil'),
('mailcl2@gmail.com', 'AX78BJ', 'disponibil'),
('mailcl2@gmail.com', 'AX78BK', 'disponibil'),
('mailcl2@gmail.com', 'AX78BL', 'disponibil'),
('mailcl2@gmail.com', 'AX78BM', 'disponibil'),
('mailcl2@gmail.com', 'AX78BO', 'disponibil'),
('mailcl2@gmail.com', 'AX78HL', 'disponibil'),
('mailcl2@gmail.com', 'BU78GG', 'disponibil'),
('mailcl2@gmail.com', 'KH84GT', 'disponibil'),
('mailcl2@gmail.com', 'KH84GX', 'disponibil'),
('mailcl2@gmail.com', 'XA65AS', 'disponibil'),
('mailcl2@gmail.com', 'XK78AB', 'disponibil'),
('mirabela@yahoo.com', 'AA11AA', 'disponibil'),
('mirabela@yahoo.com', 'AB12CD', 'disponibil'),
('mirabela@yahoo.com', 'AK75GH', 'disponibil'),
('mirabela@yahoo.com', 'AX78BG', 'disponibil'),
('mirabela@yahoo.com', 'AX78BH', 'disponibil'),
('mirabela@yahoo.com', 'AX78BJ', 'disponibil'),
('mirabela@yahoo.com', 'AX78BK', 'disponibil'),
('mirabela@yahoo.com', 'AX78BL', 'disponibil'),
('mirabela@yahoo.com', 'AX78BM', 'disponibil'),
('mirabela@yahoo.com', 'AX78BO', 'disponibil'),
('mirabela@yahoo.com', 'AX78HL', 'disponibil'),
('mirabela@yahoo.com', 'BU78GG', 'folosit'),
('mirabela@yahoo.com', 'KH84GT', 'disponibil'),
('mirabela@yahoo.com', 'KH84GX', 'disponibil'),
('mirabela@yahoo.com', 'XA65AS', 'disponibil'),
('mirabela@yahoo.com', 'XK78AB', 'disponibil'),
('patruiunie@yahoo.com', 'AB12CD', 'disponibil'),
('patruiunie@yahoo.com', 'AK75GH', 'disponibil'),
('patruiunie@yahoo.com', 'AX78BG', 'disponibil'),
('patruiunie@yahoo.com', 'AX78BH', 'disponibil'),
('patruiunie@yahoo.com', 'AX78BJ', 'disponibil'),
('patruiunie@yahoo.com', 'AX78BK', 'disponibil'),
('patruiunie@yahoo.com', 'AX78BL', 'disponibil'),
('patruiunie@yahoo.com', 'AX78BM', 'disponibil'),
('patruiunie@yahoo.com', 'AX78BO', 'disponibil'),
('patruiunie@yahoo.com', 'AX78HL', 'disponibil'),
('patruiunie@yahoo.com', 'BU78GG', 'disponibil'),
('patruiunie@yahoo.com', 'KH84GT', 'disponibil'),
('patruiunie@yahoo.com', 'KH84GX', 'disponibil'),
('patruiunie@yahoo.com', 'XA65AS', 'disponibil'),
('patruiunie@yahoo.com', 'XK78AB', 'disponibil'),
('sapte@yahoo.com', 'AB12CD', 'disponibil'),
('sapte@yahoo.com', 'AK75GH', 'disponibil'),
('sapte@yahoo.com', 'AX78BG', 'disponibil'),
('sapte@yahoo.com', 'AX78BH', 'disponibil'),
('sapte@yahoo.com', 'AX78BJ', 'disponibil'),
('sapte@yahoo.com', 'AX78BK', 'disponibil'),
('sapte@yahoo.com', 'AX78BL', 'disponibil'),
('sapte@yahoo.com', 'AX78BM', 'disponibil'),
('sapte@yahoo.com', 'AX78BO', 'disponibil'),
('sapte@yahoo.com', 'AX78HL', 'disponibil'),
('sapte@yahoo.com', 'BU78GG', 'disponibil'),
('sapte@yahoo.com', 'KH84GT', 'disponibil'),
('sapte@yahoo.com', 'KH84GX', 'disponibil'),
('sapte@yahoo.com', 'XA65AS', 'disponibil'),
('sapte@yahoo.com', 'XK78AB', 'disponibil'),
('simona93@yahoo.com', 'AB12CD', 'disponibil'),
('simona93@yahoo.com', 'AK75GH', 'disponibil'),
('simona93@yahoo.com', 'AX78BG', 'disponibil'),
('simona93@yahoo.com', 'AX78BH', 'disponibil'),
('simona93@yahoo.com', 'AX78BJ', 'disponibil'),
('simona93@yahoo.com', 'AX78BK', 'disponibil'),
('simona93@yahoo.com', 'AX78BL', 'disponibil'),
('simona93@yahoo.com', 'AX78BM', 'disponibil'),
('simona93@yahoo.com', 'AX78BO', 'disponibil'),
('simona93@yahoo.com', 'AX78HL', 'disponibil'),
('simona93@yahoo.com', 'BU78GG', 'disponibil'),
('simona93@yahoo.com', 'KH84GT', 'disponibil'),
('simona93@yahoo.com', 'KH84GX', 'disponibil'),
('simona93@yahoo.com', 'XA65AS', 'disponibil'),
('simona93@yahoo.com', 'XK78AB', 'disponibil'),
('simona97@yahoo.com', 'AB12CD', 'disponibil'),
('simona97@yahoo.com', 'AK75GH', 'disponibil'),
('simona97@yahoo.com', 'AX78BG', 'disponibil'),
('simona97@yahoo.com', 'AX78BH', 'disponibil'),
('simona97@yahoo.com', 'AX78BJ', 'disponibil'),
('simona97@yahoo.com', 'AX78BK', 'disponibil'),
('simona97@yahoo.com', 'AX78BL', 'disponibil'),
('simona97@yahoo.com', 'AX78BM', 'disponibil'),
('simona97@yahoo.com', 'AX78BO', 'disponibil'),
('simona97@yahoo.com', 'AX78HL', 'disponibil'),
('simona97@yahoo.com', 'BU78GG', 'disponibil'),
('simona97@yahoo.com', 'KH84GT', 'disponibil'),
('simona97@yahoo.com', 'KH84GX', 'disponibil'),
('simona97@yahoo.com', 'XA65AS', 'disponibil'),
('simona97@yahoo.com', 'XK78AB', 'disponibil'),
('varga.simona97@yahoo.com', 'AB12CD', 'disponibil'),
('varga.simona97@yahoo.com', 'AK75GH', 'disponibil'),
('varga.simona97@yahoo.com', 'AX78BG', 'disponibil'),
('varga.simona97@yahoo.com', 'AX78BH', 'folosit'),
('varga.simona97@yahoo.com', 'AX78BJ', 'disponibil'),
('varga.simona97@yahoo.com', 'AX78BK', 'disponibil'),
('varga.simona97@yahoo.com', 'AX78BL', 'disponibil'),
('varga.simona97@yahoo.com', 'AX78BM', 'disponibil'),
('varga.simona97@yahoo.com', 'AX78BO', 'disponibil'),
('varga.simona97@yahoo.com', 'AX78HL', 'disponibil'),
('varga.simona97@yahoo.com', 'BU78GG', 'disponibil'),
('varga.simona97@yahoo.com', 'KA84GT', 'folosit'),
('varga.simona97@yahoo.com', 'KH84GT', 'disponibil'),
('varga.simona97@yahoo.com', 'KH84GX', 'disponibil'),
('varga.simona97@yahoo.com', 'XA65AS', 'disponibil'),
('varga.simona97@yahoo.com', 'XK78AB', 'disponibil'),
('vargabp@yahoo.it', 'AB12CD', 'disponibil'),
('vargabp@yahoo.it', 'AK75GH', 'disponibil'),
('vargabp@yahoo.it', 'AX78BG', 'disponibil'),
('vargabp@yahoo.it', 'AX78BH', 'disponibil'),
('vargabp@yahoo.it', 'AX78BJ', 'disponibil'),
('vargabp@yahoo.it', 'AX78BK', 'disponibil'),
('vargabp@yahoo.it', 'AX78BL', 'disponibil'),
('vargabp@yahoo.it', 'AX78BM', 'disponibil'),
('vargabp@yahoo.it', 'AX78BO', 'disponibil'),
('vargabp@yahoo.it', 'AX78HL', 'disponibil'),
('vargabp@yahoo.it', 'BU78GG', 'disponibil'),
('vargabp@yahoo.it', 'KH84GT', 'disponibil'),
('vargabp@yahoo.it', 'KH84GX', 'disponibil'),
('vargabp@yahoo.it', 'XA65AS', 'disponibil'),
('vargabp@yahoo.it', 'XK78AB', 'disponibil'),
('vargasabi@yahoo.com', 'AB12CD', 'disponibil'),
('vargasabi@yahoo.com', 'AK75GH', 'disponibil'),
('vargasabi@yahoo.com', 'AX78BG', 'disponibil'),
('vargasabi@yahoo.com', 'AX78BH', 'disponibil'),
('vargasabi@yahoo.com', 'AX78BJ', 'disponibil'),
('vargasabi@yahoo.com', 'AX78BK', 'disponibil'),
('vargasabi@yahoo.com', 'AX78BL', 'disponibil'),
('vargasabi@yahoo.com', 'AX78BM', 'disponibil'),
('vargasabi@yahoo.com', 'AX78BO', 'disponibil'),
('vargasabi@yahoo.com', 'AX78HL', 'disponibil'),
('vargasabi@yahoo.com', 'BU78GG', 'disponibil'),
('vargasabi@yahoo.com', 'KH84GT', 'disponibil'),
('vargasabi@yahoo.com', 'KH84GX', 'disponibil'),
('vargasabi@yahoo.com', 'XA65AS', 'disponibil'),
('vargasabi@yahoo.com', 'XK78AB', 'disponibil'),
('vrgsabina@yahoo.com', 'AB12CD', 'disponibil'),
('vrgsabina@yahoo.com', 'AK75GH', 'disponibil'),
('vrgsabina@yahoo.com', 'AX78BG', 'disponibil'),
('vrgsabina@yahoo.com', 'AX78BH', 'disponibil'),
('vrgsabina@yahoo.com', 'AX78BJ', 'disponibil'),
('vrgsabina@yahoo.com', 'AX78BK', 'disponibil'),
('vrgsabina@yahoo.com', 'AX78BL', 'disponibil'),
('vrgsabina@yahoo.com', 'AX78BM', 'disponibil'),
('vrgsabina@yahoo.com', 'AX78BO', 'disponibil'),
('vrgsabina@yahoo.com', 'AX78HL', 'disponibil'),
('vrgsabina@yahoo.com', 'BU78GG', 'disponibil'),
('vrgsabina@yahoo.com', 'KH84GT', 'disponibil'),
('vrgsabina@yahoo.com', 'KH84GX', 'disponibil'),
('vrgsabina@yahoo.com', 'XA65AS', 'disponibil'),
('vrgsabina@yahoo.com', 'XK78AB', 'disponibil');

-- --------------------------------------------------------

--
-- Table structure for table `zilelibere`
--

CREATE TABLE `zilelibere` (
  `idAng` int(11) NOT NULL,
  `ziLibera` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zilelibere`
--

INSERT INTO `zilelibere` (`idAng`, `ziLibera`) VALUES
(10, '2020-06-03'),
(10, '2020-06-13'),
(10, '2020-06-15'),
(10, '2020-06-30'),
(10, '2020-07-04'),
(11, '2020-06-11'),
(11, '2020-06-12'),
(11, '2020-07-04'),
(15, '2020-06-30'),
(15, '2020-07-04'),
(16, '2020-06-30'),
(16, '2020-07-04'),
(17, '2020-07-01'),
(17, '2020-07-02'),
(17, '2020-07-03'),
(17, '2020-07-04'),
(17, '2020-07-05'),
(17, '2020-07-06'),
(17, '2020-07-07'),
(17, '2020-07-09'),
(17, '2020-07-10'),
(17, '2020-07-11'),
(17, '2020-07-12'),
(17, '2020-07-13'),
(17, '2020-07-14'),
(17, '2020-07-16'),
(17, '2020-07-17'),
(17, '2020-07-18'),
(17, '2020-07-20'),
(17, '2020-08-11'),
(18, '2021-03-17'),
(18, '2021-03-18'),
(18, '2021-03-19'),
(19, '2021-05-05'),
(19, '2021-05-06'),
(19, '2021-05-07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `angajat`
--
ALTER TABLE `angajat`
  ADD PRIMARY KEY (`idAng`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`idCl`),
  ADD UNIQUE KEY `mailCl` (`mailCl`),
  ADD UNIQUE KEY `nrTelCl` (`nrTelCl`);

--
-- Indexes for table `coduripromo`
--
ALTER TABLE `coduripromo`
  ADD PRIMARY KEY (`codVoucher`);

--
-- Indexes for table `coduripromofolosite`
--
ALTER TABLE `coduripromofolosite`
  ADD UNIQUE KEY `codVoucher` (`codVoucher`,`mailCl`);

--
-- Indexes for table `marcamasina`
--
ALTER TABLE `marcamasina`
  ADD PRIMARY KEY (`idMarca`),
  ADD UNIQUE KEY `numeMarca` (`numeMarca`);

--
-- Indexes for table `masini`
--
ALTER TABLE `masini`
  ADD PRIMARY KEY (`idMasina`);

--
-- Indexes for table `pretserv`
--
ALTER TABLE `pretserv`
  ADD PRIMARY KEY (`idServ`,`idTip`),
  ADD KEY `idTip` (`idTip`);

--
-- Indexes for table `programare`
--
ALTER TABLE `programare`
  ADD PRIMARY KEY (`idProg`),
  ADD KEY `idAng` (`idAng`),
  ADD KEY `idCl` (`idCl`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`idProg`);

--
-- Indexes for table `servicii`
--
ALTER TABLE `servicii`
  ADD PRIMARY KEY (`idServ`);

--
-- Indexes for table `serviciu`
--
ALTER TABLE `serviciu`
  ADD PRIMARY KEY (`idServ`) USING BTREE;

--
-- Indexes for table `tipcaroserie`
--
ALTER TABLE `tipcaroserie`
  ADD PRIMARY KEY (`idTip`),
  ADD UNIQUE KEY `numeTip` (`numeTip`);

--
-- Indexes for table `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`mailCl`,`codVoucher`);

--
-- Indexes for table `zilelibere`
--
ALTER TABLE `zilelibere`
  ADD PRIMARY KEY (`idAng`,`ziLibera`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `angajat`
--
ALTER TABLE `angajat`
  MODIFY `idAng` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `idCl` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `marcamasina`
--
ALTER TABLE `marcamasina`
  MODIFY `idMarca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `masini`
--
ALTER TABLE `masini`
  MODIFY `idMasina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT for table `programare`
--
ALTER TABLE `programare`
  MODIFY `idProg` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=204;

--
-- AUTO_INCREMENT for table `servicii`
--
ALTER TABLE `servicii`
  MODIFY `idServ` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `serviciu`
--
ALTER TABLE `serviciu`
  MODIFY `idServ` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tipcaroserie`
--
ALTER TABLE `tipcaroserie`
  MODIFY `idTip` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pretserv`
--
ALTER TABLE `pretserv`
  ADD CONSTRAINT `pretserv_ibfk_1` FOREIGN KEY (`idServ`) REFERENCES `servicii` (`idServ`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `pretserv_ibfk_2` FOREIGN KEY (`idTip`) REFERENCES `tipcaroserie` (`idTip`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `programare`
--
ALTER TABLE `programare`
  ADD CONSTRAINT `programare_ibfk_1` FOREIGN KEY (`idAng`) REFERENCES `angajat` (`idAng`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `programare_ibfk_2` FOREIGN KEY (`idCl`) REFERENCES `client` (`idCl`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`idProg`) REFERENCES `programare` (`idProg`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `voucher`
--
ALTER TABLE `voucher`
  ADD CONSTRAINT `voucher_ibfk_1` FOREIGN KEY (`mailCl`) REFERENCES `client` (`mailCl`);

--
-- Constraints for table `zilelibere`
--
ALTER TABLE `zilelibere`
  ADD CONSTRAINT `zilelibere_ibfk_1` FOREIGN KEY (`idAng`) REFERENCES `angajat` (`idAng`) ON DELETE CASCADE ON UPDATE CASCADE;
--
-- Database: `monitorizare`
--
CREATE DATABASE IF NOT EXISTS `monitorizare` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `monitorizare`;

-- --------------------------------------------------------

--
-- Table structure for table `angajat`
--

CREATE TABLE `angajat` (
  `idAngajat` int(11) NOT NULL,
  `numeAngajat` varchar(20) NOT NULL,
  `oraSosire` time DEFAULT NULL,
  `oraPlecare` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `angajat`
--

INSERT INTO `angajat` (`idAngajat`, `numeAngajat`, `oraSosire`, `oraPlecare`) VALUES
(1, 'Mihail', '08:00:00', NULL),
(2, 'Alina', '08:00:00', NULL),
(3, 'Andrei', '08:00:00', NULL),
(4, 'Alina', '08:00:00', NULL),
(8, 'Popescu Mariana', NULL, NULL),
(9, 'Ghergut Sara', NULL, NULL),
(12, 'Antoci Adriana', NULL, NULL),
(13, 'Popescu Mariana', NULL, NULL),
(14, 'NumeNou2', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `listasarcini`
--

CREATE TABLE `listasarcini` (
  `idSarcina` int(11) NOT NULL,
  `idAngajat` int(11) NOT NULL,
  `descriereSarcina` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `listasarcini`
--

INSERT INTO `listasarcini` (`idSarcina`, `idAngajat`, `descriereSarcina`) VALUES
(1, 1, 'Sarcina Mihai'),
(2, 3, 'Andrei are ceva de facut'),
(3, 3, 'Andrei mai face ceva'),
(4, 1, 'Mihai are treaba'),
(5, 4, 'Alina are ceva de facut'),
(6, 3, 'Mihai are treaba'),
(9, 4, 'Alina are ceva de facut 2'),
(11, 3, 'Andrei are ceva de facutx2'),
(12, 3, 'Andrei are ceva de facut din nou'),
(13, 1, 'Mihai are treabahij'),
(14, 1, 'Angajtaul1 are de facut ceva'),
(16, 13, 'jiiij');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `angajat`
--
ALTER TABLE `angajat`
  ADD PRIMARY KEY (`idAngajat`);

--
-- Indexes for table `listasarcini`
--
ALTER TABLE `listasarcini`
  ADD PRIMARY KEY (`idSarcina`),
  ADD KEY `idSarcina` (`idSarcina`),
  ADD KEY `idAngajat` (`idAngajat`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `angajat`
--
ALTER TABLE `angajat`
  MODIFY `idAngajat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `listasarcini`
--
ALTER TABLE `listasarcini`
  MODIFY `idSarcina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `listasarcini`
--
ALTER TABLE `listasarcini`
  ADD CONSTRAINT `listasarcini_ibfk_1` FOREIGN KEY (`idAngajat`) REFERENCES `angajat` (`idAngajat`) ON DELETE CASCADE ON UPDATE CASCADE;
--
-- Database: `proiectflori`
--
CREATE DATABASE IF NOT EXISTS `proiectflori` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `proiectflori`;
--
-- Database: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;

-- --------------------------------------------------------

--
-- Table structure for table `jokes_table`
--

CREATE TABLE `jokes_table` (
  `JokeID` int(11) NOT NULL,
  `Joke_question` varchar(500) NOT NULL,
  `Joke_answer` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jokes_table`
--

INSERT INTO `jokes_table` (`JokeID`, `Joke_question`, `Joke_answer`) VALUES
(1, 'q1', 'a1'),
(2, 'q2', 'a2'),
(15, 'newjoke2', 'newanswer2'),
(16, 'newjoke2', 'newanswer2'),
(17, 'newjoke\'2', 'newanswer2\''),
(18, 'newjoke\'2', 'newanswer2\''),
(19, 'new\'\'joke\'2', 'new\'\'\'answer2\''),
(20, 'new\'\'\'joke\'2', 'new\'\'\'answer2\''),
(21, 'newjoke22', 'newanswer22'),
(22, 'newjoke22', 'newanswer22'),
(23, 'qu1', 'asn1'),
(24, '', ''),
(25, '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jokes_table`
--
ALTER TABLE `jokes_table`
  ADD PRIMARY KEY (`JokeID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jokes_table`
--
ALTER TABLE `jokes_table`
  MODIFY `JokeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

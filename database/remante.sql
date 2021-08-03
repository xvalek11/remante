-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 20, 2021 at 12:12 PM
-- Server version: 8.0.25
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `remante`
--

-- --------------------------------------------------------

--
-- Table structure for table `manufacturer`
--

DROP TABLE IF EXISTS `manufacturer`;
CREATE TABLE IF NOT EXISTS `manufacturer` (
  `ID` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) COLLATE utf8_czech_ci DEFAULT NULL,
  `Adress` varchar(50) COLLATE utf8_czech_ci DEFAULT NULL,
  `Descrp` text COLLATE utf8_czech_ci,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_czech_ci;

--
-- Dumping data for table `manufacturer`
--

INSERT INTO `manufacturer` (`ID`, `Name`, `Adress`, `Descrp`) VALUES
(1, 'BOSCH ', 'Gerlingen, Německo', NULL),
(2, 'Zexel ', 'Prokopovka 162, 331 51 Kaznějov', NULL),
(3, 'DELPHI', NULL, NULL),
(4, 'SIEMENS/VDO', NULL, NULL),
(5, 'GARRET', NULL, NULL),
(6, 'Mitsubishi', NULL, NULL),
(7, 'KKK', NULL, NULL),
(8, 'MAGNETI MARRELI', NULL, NULL),
(9, 'DENSO', NULL, NULL),
(10, 'KNORR', NULL, NULL),
(11, 'MERITOL', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `man_type_mn_conection`
--

DROP TABLE IF EXISTS `man_type_mn_conection`;
CREATE TABLE IF NOT EXISTS `man_type_mn_conection` (
  `ID` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` int UNSIGNED NOT NULL,
  `man` int UNSIGNED NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `man` (`man`),
  KEY `type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `ID` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `Type` int UNSIGNED NOT NULL,
  `Manufacturer` int UNSIGNED NOT NULL,
  `Name` varchar(150) CHARACTER SET utf8 COLLATE utf8_czech_ci DEFAULT NULL,
  `Price` float DEFAULT NULL,
  `Code` varchar(20) COLLATE utf8_czech_ci DEFAULT NULL,
  `Descrp` text COLLATE utf8_czech_ci,
  PRIMARY KEY (`ID`),
  KEY `Type` (`Type`),
  KEY `Manufacturer` (`Manufacturer`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_czech_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ID`, `Type`, `Manufacturer`, `Name`, `Price`, `Code`, `Descrp`) VALUES
(16, 5, 1, 'Startér BOSCH 0986013590', 2082, '011-001-000027R', '  '),
(17, 1, 8, 'Startér MAGNETI MARELLI 944280800940', 2132, '011-001-000004R', '    '),
(18, 1, 1, 'Vstřikovací čerpadlo BOSCH VP30 0470004004', 12991, '002-001-000061R', ''),
(19, 1, 2, 'Vstřikovací čerpadlo Zexel VRZ 109144-3062', 34969, '002-004-000001R', ''),
(20, 1, 1, 'Vstřikovací čerpadlo BOSCH VP44 0470504015', 12490, '002-001-000036R', ''),
(21, 3, 1, 'Vysokotlaké čerpadlo Common rail BOSCH CP1 0445010046', 6290, '002-002-000055R', ''),
(22, 3, 3, 'Vysokotlaké čerpadlo Common rail DELPHI DFP1 R9042A041A', 6990, '002-002-000468R', ''),
(23, 6, 1, 'Alternátor BOSCH 0986048320', 2228, '011-003-000001R', ''),
(24, 8, 3, 'Klimakompresor DELPHI TSP015545', 4390, '005-001-000042R', ''),
(26, 11, 1, 'Podávací modul pro vstřikovaní močoviny (AdBlue) BOSCH 0444010025', 17936, '002-020-000002R', ''),
(27, 2, 7, 'Turbodmychadlo KKK 54359700027', 6990, '003-002-001082R', ''),
(28, 2, 5, 'Turbodmychadlo GARRETT 708639-5010S', 5391, '003-001-000057R', 'Nově repasované - po generální opravě - protokol z autorizované testovací stanice stvrzuje 100% funkčnost.'),
(29, 2, 7, 'Turbodmychadlo KKK 53039880205', 11990, '003-002-000065R', ''),
(30, 1, 2, 'Vstřikovací čerpadlo Zexel VRZ 109144-3062', 34969, '002-004-000001R', ''),
(31, 1, 2, 'Vstřikovací čerpadlo Zexel Covec 104700-0551', 17380, '002-004-000003R', ''),
(32, 6, 1, 'Alternátor BOSCH 0986048320', 2228, '011-003-000001R', ''),
(33, 6, 1, 'Alternátor BOSCH 0 986 041 860', 4390, '011-003-000369R', ''),
(34, 9, 10, 'Brzdový třmen KNORR K013175 - Pravý', 6959, '008-004-000079R', ''),
(35, 9, 11, 'Brzdový třmen MERITOR LRG571 - Pravý', 8396, '008-004-000067R', ''),
(36, 9, 11, 'Brzdový třmen KNORR K023249 - Pravý', 6959, '008-004-000096R', '');

-- --------------------------------------------------------

--
-- Table structure for table `typeofproduct`
--

DROP TABLE IF EXISTS `typeofproduct`;
CREATE TABLE IF NOT EXISTS `typeofproduct` (
  `ID` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `Name` varchar(150) CHARACTER SET utf8 COLLATE utf8_czech_ci DEFAULT NULL,
  `Type` varchar(50) COLLATE utf8_czech_ci DEFAULT NULL,
  `Descrp` text COLLATE utf8_czech_ci,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_czech_ci;

--
-- Dumping data for table `typeofproduct`
--

INSERT INTO `typeofproduct` (`ID`, `Name`, `Type`, `Descrp`) VALUES
(1, 'Vstřikovací čerpadlo', 'Auto', NULL),
(2, 'Turbodmychadlo ', 'Auto', NULL),
(3, 'Vysokotlaká čerpadla', 'Auto', NULL),
(4, 'Ložišskové středy', 'Auto', NULL),
(5, 'Startéry', 'Auto', NULL),
(6, 'Alternátory', 'Auto', NULL),
(7, 'Díly řízení', NULL, NULL),
(8, 'Klima komprespory', 'Auto', NULL),
(9, 'Brzdové třmeny', 'Nákladní auto', NULL),
(10, 'Snímače NOx', 'Nákladní auta', NULL),
(11, 'AdBlue', 'Nákladní auto', NULL),
(12, 'Vstřikovače', 'Auto', NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `man_type_mn_conection`
--
ALTER TABLE `man_type_mn_conection`
  ADD CONSTRAINT `man_type_mn_conection_ibfk_1` FOREIGN KEY (`man`) REFERENCES `manufacturer` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `man_type_mn_conection_ibfk_2` FOREIGN KEY (`type`) REFERENCES `typeofproduct` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`Type`) REFERENCES `typeofproduct` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`Manufacturer`) REFERENCES `manufacturer` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

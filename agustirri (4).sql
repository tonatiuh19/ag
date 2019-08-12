-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2019 at 11:06 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agustirri`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `myview`
-- (See below for the actual view)
--
CREATE TABLE `myview` (
`id_viaje` int(10)
);

-- --------------------------------------------------------

--
-- Table structure for table `paquetes`
--

CREATE TABLE `paquetes` (
  `id_paquete` int(10) NOT NULL,
  `id_viaje` int(10) NOT NULL,
  `precio` double NOT NULL,
  `incluido` varchar(300) COLLATE latin1_spanish_ci NOT NULL,
  `fecha_ida` date NOT NULL,
  `fecha_vuelta` date NOT NULL,
  `moneda` varchar(5) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `paquetes`
--

INSERT INTO `paquetes` (`id_paquete`, `id_viaje`, `precio`, `incluido`, `fecha_ida`, `fecha_vuelta`, `moneda`) VALUES
(1, 1, 26699, 'Ticket Ultra three days, Hotel Downtown Miami, Vuelo redondo origen seleccionado, Traslados incluidos, Seguro de viajero, Regalos Sorpresa.', '2019-03-28', '2019-04-01', ''),
(2, 1, 27999, 'Ticket Ultra three days, Hotel Downtown Miami, Vuelo redondo origen seleccionado, 1 Pool Party Miami Music Week, 1 After Party Miami Music Week, Traslados Incluidos, Seguro de viajero, Regalos Sorpresa.', '2019-03-25', '2019-04-11', ''),
(3, 1, 10000, 'Solo boleto.', '2019-03-26', '2019-03-29', ''),
(6, 9, 27599, 'Â¿Que incluye?', '2018-08-19', '2018-08-29', 'MXN'),
(7, 9, 25999, 'Â¿Que incluye?', '2018-08-19', '2018-08-29', 'MXN'),
(8, 10, 3500, 'Â¿Que incluye?', '2018-08-19', '2018-08-29', 'MXN'),
(9, 14, 45000, 'Â¿Que incluye?', '2018-08-19', '2018-08-29', 'MXN');

-- --------------------------------------------------------

--
-- Table structure for table `payconek`
--

CREATE TABLE `payconek` (
  `id_pay` int(255) NOT NULL,
  `cantidad` float(7,4) NOT NULL,
  `id_paquete` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `promo`
--

CREATE TABLE `promo` (
  `descuento` int(3) NOT NULL,
  `fecha_exp` date NOT NULL,
  `fecha_ap` date NOT NULL,
  `id_viaje` int(10) NOT NULL,
  `id_promo` varchar(100) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `promo`
--

INSERT INTO `promo` (`descuento`, `fecha_exp`, `fecha_ap`, `id_viaje`, `id_promo`) VALUES
(30, '2019-02-19', '2019-02-12', 1, 'EDCFRIENDS');

-- --------------------------------------------------------

--
-- Table structure for table `reservas`
--

CREATE TABLE `reservas` (
  `id_reserva` int(10) NOT NULL,
  `id_paquete` int(10) NOT NULL,
  `email` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `abonado` double NOT NULL,
  `pagado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `reservas`
--

INSERT INTO `reservas` (`id_reserva`, `id_paquete`, `email`, `abonado`, `pagado`) VALUES
(1, 1, 'peke@gmail.com', 22999, 0),
(2, 1, 'hola@gmail.com', 599, 0),
(3, 2, 'tgomezz@icloud.com', 300, 0);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `email` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `nombre` varchar(200) COLLATE latin1_spanish_ci NOT NULL,
  `apellido` varchar(200) COLLATE latin1_spanish_ci NOT NULL,
  `pwd` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `telefono` varchar(15) COLLATE latin1_spanish_ci NOT NULL,
  `activo` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`email`, `nombre`, `apellido`, `pwd`, `telefono`, `activo`) VALUES
('hola@gmail.com', 'Hola', 'Adios', '123', '0', 0),
('peke@gmail.com', 'Peke', 'Garcia', '123', '8765432190', 1),
('tgomezz@icloud.com', 'Felix Alejandro Tonatiuh', 'Gomez Briones', '7421954', '4741400363', 0);

-- --------------------------------------------------------

--
-- Table structure for table `viajes`
--

CREATE TABLE `viajes` (
  `id_viaje` int(10) NOT NULL,
  `origen` varchar(200) COLLATE latin1_spanish_ci NOT NULL,
  `destino` varchar(200) COLLATE latin1_spanish_ci NOT NULL,
  `titulo` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `activo` int(1) NOT NULL,
  `email_user` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `general_descripcion` varchar(1000) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `viajes`
--

INSERT INTO `viajes` (`id_viaje`, `origen`, `destino`, `titulo`, `activo`, `email_user`, `general_descripcion`) VALUES
(1, 'GDL', 'Las Vegas', 'EDC Las Vegas', 1, 'peke@gmail.com', 'Electric Daisy Carnival (EDC) es un festival de música electrónica organizado por la empresa Insomniac Events.1? El festival abarca géneros como EDM, House, Dance, Electro, Drum and Bass, Techno, dance-punk, Hard dance, Dubstep, Trance, Trap y mucho más. '),
(2, 'Guadalajara, CDMX, Cancun, Monterrey, Los Cabos, Tijuana', 'Belgica', 'Tomorrowland 2019', 1, 'peke@gmail.com', ''),
(9, 'Guadalajara, CDMX, Cancun, Monterrey, Tijuana', 'Miami', 'Ultra Music Festival 2019', 0, 'tgomezz@icloud.com', ''),
(10, 'Lagos de Moreno', 'Puerto Vallarta', 'Viaje a Vallarta', 1, 'tgomezz@icloud.com', ''),
(14, 'Guadalajara, CDMX, Cancun, Monterrey', 'Amsterdam', 'AMF 2019', 0, 'peke@gmail.com', '');

-- --------------------------------------------------------

--
-- Structure for view `myview`
--
DROP TABLE IF EXISTS `myview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `myview`  AS  select `paquetes`.`id_viaje` AS `id_viaje` from `paquetes` where `paquetes`.`id_paquete` in (select `reservas`.`id_paquete` from `reservas` where (`reservas`.`email` = 'tgomezz@icloud.com')) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `paquetes`
--
ALTER TABLE `paquetes`
  ADD PRIMARY KEY (`id_paquete`),
  ADD KEY `id_viaje` (`id_viaje`);

--
-- Indexes for table `payconek`
--
ALTER TABLE `payconek`
  ADD KEY `id_paquete` (`id_paquete`);

--
-- Indexes for table `promo`
--
ALTER TABLE `promo`
  ADD PRIMARY KEY (`id_promo`),
  ADD KEY `id_viaje` (`id_viaje`);

--
-- Indexes for table `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id_reserva`),
  ADD KEY `email` (`email`),
  ADD KEY `id_paquete` (`id_paquete`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `viajes`
--
ALTER TABLE `viajes`
  ADD PRIMARY KEY (`id_viaje`),
  ADD KEY `email_user` (`email_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `paquetes`
--
ALTER TABLE `paquetes`
  MODIFY `id_paquete` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id_reserva` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `viajes`
--
ALTER TABLE `viajes`
  MODIFY `id_viaje` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `paquetes`
--
ALTER TABLE `paquetes`
  ADD CONSTRAINT `paquetes_ibfk_1` FOREIGN KEY (`id_viaje`) REFERENCES `viajes` (`id_viaje`);

--
-- Constraints for table `payconek`
--
ALTER TABLE `payconek`
  ADD CONSTRAINT `payconek_ibfk_1` FOREIGN KEY (`id_paquete`) REFERENCES `paquetes` (`id_paquete`);

--
-- Constraints for table `promo`
--
ALTER TABLE `promo`
  ADD CONSTRAINT `promo_ibfk_1` FOREIGN KEY (`id_viaje`) REFERENCES `viajes` (`id_viaje`);

--
-- Constraints for table `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`email`) REFERENCES `usuarios` (`email`),
  ADD CONSTRAINT `reservas_ibfk_2` FOREIGN KEY (`id_paquete`) REFERENCES `paquetes` (`id_paquete`);

--
-- Constraints for table `viajes`
--
ALTER TABLE `viajes`
  ADD CONSTRAINT `viajes_ibfk_1` FOREIGN KEY (`email_user`) REFERENCES `usuarios` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

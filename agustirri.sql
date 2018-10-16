-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 17, 2018 at 01:05 AM
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
  `incluido` varchar(300) NOT NULL,
  `fecha_ida` date NOT NULL,
  `fecha_vuelta` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paquetes`
--

INSERT INTO `paquetes` (`id_paquete`, `id_viaje`, `precio`, `incluido`, `fecha_ida`, `fecha_vuelta`) VALUES
(1, 1, 25599, 'Ticket Ultra three days, Hotel Downtown Miami, Vuelo redondo origen seleccionado, Traslados incluidos, Seguro de viajero, Regalos Sorpresa.', '2019-03-28', '2019-04-01'),
(2, 1, 27999, 'Ticket Ultra three days, Hotel Downtown Miami, Vuelo redondo origen seleccionado, 1 Pool Party Miami Music Week, 1 After Party Miami Music Week, Traslados Incluidos, Seguro de viajero, Regalos Sorpresa.', '2019-03-27', '2019-04-01');

-- --------------------------------------------------------

--
-- Table structure for table `reservas`
--

CREATE TABLE `reservas` (
  `id_reserva` int(10) NOT NULL,
  `id_paquete` int(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `abonado` double NOT NULL,
  `pagado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservas`
--

INSERT INTO `reservas` (`id_reserva`, `id_paquete`, `email`, `abonado`, `pagado`) VALUES
(1, 2, 'peke@gmail.com', 300, 0),
(2, 1, 'hola@gmail.com', 300, 0);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `email` varchar(100) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `apellido` varchar(200) NOT NULL,
  `pwd` varchar(100) NOT NULL,
  `telefono` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`email`, `nombre`, `apellido`, `pwd`, `telefono`) VALUES
('hola@gmail.com', 'Hola', 'Adios', '123', 0),
('peke@gmail.com', 'Peke', 'Garcia', '123', 0);

-- --------------------------------------------------------

--
-- Table structure for table `viajes`
--

CREATE TABLE `viajes` (
  `id_viaje` int(10) NOT NULL,
  `origen` varchar(200) NOT NULL,
  `destino` varchar(200) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `activo` int(1) NOT NULL,
  `email_user` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `viajes`
--

INSERT INTO `viajes` (`id_viaje`, `origen`, `destino`, `titulo`, `activo`, `email_user`) VALUES
(1, 'Guadalajara, CDMX, Cancun, Monterrey', 'Miami', 'Ultra Miami 2019', 1, 'peke@gmail.com'),
(2, 'Guadalajara, CDMX, Cancun, Monterrey, Los Cabos, Tijuana', 'Belgica', 'Tomorrowland 2019', 1, 'peke@gmail.com');

-- --------------------------------------------------------

--
-- Structure for view `myview`
--
DROP TABLE IF EXISTS `myview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `myview`  AS  select `paquetes`.`id_viaje` AS `id_viaje` from `paquetes` where `paquetes`.`id_paquete` in (select `reservas`.`id_paquete` from `reservas` where (`reservas`.`email` = 'peke@gmail.com')) ;

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
  MODIFY `id_paquete` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id_reserva` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `viajes`
--
ALTER TABLE `viajes`
  MODIFY `id_viaje` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `paquetes`
--
ALTER TABLE `paquetes`
  ADD CONSTRAINT `paquetes_ibfk_1` FOREIGN KEY (`id_viaje`) REFERENCES `viajes` (`id_viaje`);

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

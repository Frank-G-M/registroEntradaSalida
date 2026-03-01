-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-03-2026 a las 23:03:55
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `doc`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

CREATE TABLE `horario` (
  `ID_Horario` int(10) NOT NULL,
  `Fecha` date NOT NULL,
  `Hora_Entrada` datetime(6) NOT NULL,
  `Hora_Salida` datetime(6) NOT NULL,
  `ID_User` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `horario`
--

INSERT INTO `horario` (`ID_Horario`, `Fecha`, `Hora_Entrada`, `Hora_Salida`, `ID_User`) VALUES
(1, '2026-03-01', '2026-03-01 13:48:30.000000', '2026-03-01 13:48:43.000000', 13),
(2, '2026-03-01', '2026-03-01 14:34:11.000000', '2026-03-01 15:17:11.000000', 13),
(3, '2026-03-01', '2026-03-01 15:17:13.000000', '2026-03-01 15:19:21.000000', 13),
(4, '2026-03-01', '2026-03-01 15:19:22.000000', '2026-03-01 15:21:04.000000', 13),
(5, '2026-03-01', '2026-03-01 15:31:01.000000', '2026-03-01 15:31:11.000000', 13),
(6, '2026-03-01', '2026-03-01 15:39:34.000000', '2026-03-01 15:39:42.000000', 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `ID` int(10) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `Document` int(12) NOT NULL,
  `Phone` int(10) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Rol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`ID`, `Name`, `Document`, `Phone`, `Email`, `Password`, `Rol`) VALUES
(12, 'Frank Guerrero', 1013006389, 2147483647, 'frankmayorgaguerrero@gmail.com', '$2y$10$.hhTwzgG.m3j1TYGkkJvceW3oIf340tgVlbXBVaVsdmjfEoa0GQDa', ''),
(13, 'Frank Guerrero', 1234567891, 2147483647, 'frankmayorgaguerrero@gmail.com', '$2y$10$Uu2mW/ye9EtMVDlqm2pAfuLzGq.YMWUuJpWODSXyEVh/TZxKFt6Ci', ''),
(14, 'Frank Guerrero', 1013006389, 2147483647, 'frankmayorgaguerrero@gmail.com', '$2y$10$RI3qkU4VDjUmN6WDqtFjw.USFXPnICLMf7POhFCqYMG7wbFuwb2Ge', 'Medico'),
(15, 'Prueba', 987654321, 987654321, 'prueba@gmail.com', '$2y$10$lHFaoBh.lxl9PjKh5CQypOrvXwRBtFXBbhyrQwGAFw0T.gecqsSXW', 'Medico');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `horario`
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`ID_Horario`),
  ADD KEY `fk_usuario_horario` (`ID_User`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `horario`
--
ALTER TABLE `horario`
  MODIFY `ID_Horario` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `horario`
--
ALTER TABLE `horario`
  ADD CONSTRAINT `fk_usuario_horario` FOREIGN KEY (`ID_User`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

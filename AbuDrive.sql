-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 04-05-2023 a las 14:26:26
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `AbuDrive`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accesorios`
--

CREATE TABLE `accesorios` (
  `id_accesorio` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `accesorios`
--

INSERT INTO `accesorios` (`id_accesorio`, `nombre`, `imagen`, `precio`) VALUES
(1, 'SillitaNiños', 'sillita.jpg', '9.99'),
(2, 'Bluetooth', 'Bluetooth.jpg', '6.99'),
(3, 'Cadenas Nieve', 'cadenasparanieve.jpg', '24.99'),
(4, 'Baca', 'baca.jpg', '19.99'),
(5, 'GPS', 'gps.png', '14.99'),
(6, 'Bidón Gasolina Homologado', 'bidon.png', '9.99');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alquileres`
--

CREATE TABLE `alquileres` (
  `id_alquiler` int(11) NOT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_coche` int(11) DEFAULT NULL,
  `precio_final` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alquileres_accesorios`
--

CREATE TABLE `alquileres_accesorios` (
  `id_alquiler` int(11) NOT NULL,
  `id_accesorio` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `costo_total` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `coches`
--

CREATE TABLE `coches` (
  `id_coche` int(11) NOT NULL,
  `marca` varchar(50) DEFAULT NULL,
  `modelo` varchar(50) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL,
  `precio_diario` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `coches`
--

INSERT INTO `coches` (`id_coche`, `marca`, `modelo`, `imagen`, `estado`, `precio_diario`) VALUES
(1, 'Seat', 'Leon', 'leon.jpg', 'ocupado', '49.99'),
(2, 'Volkswagen', 'Golf', 'golf.jpg', 'ocupado', '59.99'),
(3, 'Toyota', 'Supra MK5', 'supra.jpg', 'ocupado', '179.99'),
(4, 'Renault', 'Clio', 'clio.jpeg', 'libre', '29.99'),
(5, 'Mercedes', 'Clase A', 'clasea.jpg', 'libre', '99.99'),
(6, 'Opel', 'Corsa', 'corsa.jpg', 'libre', '34.99'),
(7, 'Audi', 'A1', 'a1.jpg', 'libre', '99.99'),
(8, 'Fiat', 'Panda', 'panda.jpeg', 'libre', '79.99'),
(9, 'Mazda', 'MX-5', 'mx5.jpg', 'libre', '199.99');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(50) DEFAULT NULL,
  `contraseña` varchar(50) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellidos` varchar(50) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `dni` varchar(20) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_usuario`, `contraseña`, `nombre`, `apellidos`, `telefono`, `dni`, `correo`) VALUES
(1, 'Unai', 'unai', 'unai', 'unai', '6583865853', '982384932834U', 'unai@unai.unai');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `accesorios`
--
ALTER TABLE `accesorios`
  ADD PRIMARY KEY (`id_accesorio`);

--
-- Indices de la tabla `alquileres`
--
ALTER TABLE `alquileres`
  ADD PRIMARY KEY (`id_alquiler`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_coche` (`id_coche`);

--
-- Indices de la tabla `alquileres_accesorios`
--
ALTER TABLE `alquileres_accesorios`
  ADD PRIMARY KEY (`id_alquiler`,`id_accesorio`),
  ADD KEY `id_accesorio` (`id_accesorio`);

--
-- Indices de la tabla `coches`
--
ALTER TABLE `coches`
  ADD PRIMARY KEY (`id_coche`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alquileres`
--
ALTER TABLE `alquileres`
  MODIFY `id_alquiler` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alquileres`
--
ALTER TABLE `alquileres`
  ADD CONSTRAINT `alquileres_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `alquileres_ibfk_2` FOREIGN KEY (`id_coche`) REFERENCES `coches` (`id_coche`);

--
-- Filtros para la tabla `alquileres_accesorios`
--
ALTER TABLE `alquileres_accesorios`
  ADD CONSTRAINT `alquileres_accesorios_ibfk_1` FOREIGN KEY (`id_alquiler`) REFERENCES `alquileres` (`id_alquiler`),
  ADD CONSTRAINT `alquileres_accesorios_ibfk_2` FOREIGN KEY (`id_accesorio`) REFERENCES `accesorios` (`id_accesorio`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

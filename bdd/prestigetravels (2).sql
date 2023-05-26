-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-05-2023 a las 06:42:23
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `prestigetravels`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `10_hoteles` ()   BEGIN
    SELECT h.id, h.nombre, AVG(r.promedio) AS calificacion_promedio
    FROM hoteles h
    JOIN resena_hotel r ON h.id = r.id_hotel
    GROUP BY h.id, h.nombre
    ORDER BY calificacion_promedio DESC
    LIMIT 10;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `10_paquetes` ()   BEGIN
SELECT p.id, p.nombre, AVG(r.promedio) AS calificacion_promedio
FROM paquetes p
JOIN resena_paquete r ON p.id = r.id_paquete
GROUP BY p.id, p.nombre
ORDER BY calificacion_promedio DESC
LIMIT 10;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `4mayores` ()   BEGIN
(
    SELECT id,nombre, habitaciones_disponibles AS cantidad, 'hoteles' AS tipo
    FROM hoteles
    ORDER BY habitaciones_disponibles DESC
    LIMIT 4
)
UNION ALL
(
    SELECT id,nombre, disponibles AS cantidad, 'paquetes' AS tipo
    FROM paquetes
    ORDER BY disponibles DESC
    LIMIT 4
)
ORDER BY cantidad DESC
LIMIT 4;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizar_promedio` ()   BEGIN
	UPDATE resena_hotel SET promedio = (limpieza + servicio + decoracion + camas) / 4;
	UPDATE resena_paquete SET promedio = (calidad + calidad_precio + transporte + servicio) / 4;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id_carrito` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Disparadores `carrito`
--
DELIMITER $$
CREATE TRIGGER `comprar` AFTER UPDATE ON `carrito` FOR EACH ROW BEGIN
    UPDATE hoteles
    SET habitaciones_disponibles = habitaciones_disponibles - OLD.cantidad
    WHERE id = OLD.id_producto;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `comprar2` AFTER UPDATE ON `carrito` FOR EACH ROW BEGIN
    UPDATE paquetes
    SET disponibles = disponibles - OLD.cantidad
    WHERE id = OLD.id_producto;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id_compra` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hospedaje_paquetes`
--

CREATE TABLE `hospedaje_paquetes` (
  `id_hotel` int(11) NOT NULL,
  `id_paquete` int(11) NOT NULL,
  `ciudad` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hoteles`
--

CREATE TABLE `hoteles` (
  `id` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `cant_estrellas` int(11) NOT NULL,
  `precio_noche` int(11) NOT NULL,
  `ciudad` varchar(50) NOT NULL,
  `habitaciones_totales` int(11) NOT NULL,
  `habitaciones_disponibles` int(11) NOT NULL,
  `estacionamiento` tinyint(1) NOT NULL,
  `piscina` tinyint(1) NOT NULL,
  `lavanderia` tinyint(1) NOT NULL,
  `pet_friendly` tinyint(1) NOT NULL,
  `desayuno` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `hoteles`
--

INSERT INTO `hoteles` (`id`, `Nombre`, `cant_estrellas`, `precio_noche`, `ciudad`, `habitaciones_totales`, `habitaciones_disponibles`, `estacionamiento`, `piscina`, `lavanderia`, `pet_friendly`, `desayuno`) VALUES
(1000, 'La joya del desierto', 4, 80000, 'concon', 400, 300, 1, 1, 1, 0, 1),
(1001, 'La flor del océano', 5, 120000, 'Puerto Montt', 500, 90, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paquetes`
--

CREATE TABLE `paquetes` (
  `nombre` varchar(100) NOT NULL,
  `aerolinea_ida` varchar(50) NOT NULL,
  `aerolina_vuelta` varchar(50) NOT NULL,
  `fecha_salida` date NOT NULL,
  `fecha_entrada` date NOT NULL,
  `noches_totales` int(11) NOT NULL,
  `precio_persona` int(11) NOT NULL,
  `disponibles` int(11) NOT NULL,
  `paquetes_totales` int(11) NOT NULL,
  `max_personas` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `paquetes`
--

INSERT INTO `paquetes` (`nombre`, `aerolinea_ida`, `aerolina_vuelta`, `fecha_salida`, `fecha_entrada`, `noches_totales`, `precio_persona`, `disponibles`, `paquetes_totales`, `max_personas`, `id`) VALUES
('Paquete Norte Grande', 'LAN Chile', 'Express Airlines', '2023-06-09', '2023-06-20', 11, 120000, 10, 13, 3, 2000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resena_hotel`
--

CREATE TABLE `resena_hotel` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `opinion` varchar(500) NOT NULL,
  `limpieza` int(11) NOT NULL,
  `servicio` int(11) NOT NULL,
  `decoracion` int(11) NOT NULL,
  `camas` int(11) NOT NULL,
  `id_hotel` int(11) NOT NULL,
  `promedio` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `resena_hotel`
--

INSERT INTO `resena_hotel` (`id`, `id_usuario`, `fecha`, `opinion`, `limpieza`, `servicio`, `decoracion`, `camas`, `id_hotel`, `promedio`) VALUES
(30, 12, '2023-05-03', 'Muy buen hotel, cumplió totalmente con mis expectativas, totalmente recomendado', 5, 4, 5, 5, 1000, 4.75),
(31, 13, '2023-05-01', 'Buen hotel, muy bonito, con vistas al mar, excelente servicio.', 5, 5, 5, 5, 1001, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resena_paquete`
--

CREATE TABLE `resena_paquete` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `opinion` varchar(500) NOT NULL,
  `calidad` int(11) NOT NULL,
  `transporte` int(11) NOT NULL,
  `servicio` int(11) NOT NULL,
  `calidad_precio` int(11) NOT NULL,
  `id_paquete` int(11) NOT NULL,
  `promedio` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `resena_paquete`
--

INSERT INTO `resena_paquete` (`id`, `id_usuario`, `fecha`, `opinion`, `calidad`, `transporte`, `servicio`, `calidad_precio`, `id_paquete`, `promedio`) VALUES
(30, 12, '2023-06-01', 'Compré este paquete y me parece que es muy bueno', 5, 4, 5, 5, 2000, 4.75);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `contrasena` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `fecha_nacimiento`, `contrasena`) VALUES
(12, 'juanito', 'juanito@gmail.com', '2003-05-14', 'aloaloaloaloalo'),
(13, 'aquiles bailo', 'aquiles.bailo@gmail.com', '2003-05-13', 'juanperezgomes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `whishlist`
--

CREATE TABLE `whishlist` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_paquete` int(11) NOT NULL,
  `puntuacion_promedio` int(11) NOT NULL,
  `paquete` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id_carrito`),
  ADD KEY `fk_usuario_carrito` (`id_usuario`);

--
-- Indices de la tabla `hospedaje_paquetes`
--
ALTER TABLE `hospedaje_paquetes`
  ADD PRIMARY KEY (`id_hotel`);

--
-- Indices de la tabla `hoteles`
--
ALTER TABLE `hoteles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `paquetes`
--
ALTER TABLE `paquetes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `resena_hotel`
--
ALTER TABLE `resena_hotel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resena-hotel` (`id_hotel`),
  ADD KEY `resena-usuario` (`id_usuario`);

--
-- Indices de la tabla `resena_paquete`
--
ALTER TABLE `resena_paquete`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_resena_paquete` (`id_usuario`),
  ADD KEY `resena-paquete` (`id_paquete`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `whishlist`
--
ALTER TABLE `whishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-usuario` (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `whishlist`
--
ALTER TABLE `whishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `fk_usuario_carrito` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `resena_hotel`
--
ALTER TABLE `resena_hotel`
  ADD CONSTRAINT `resena-hotel` FOREIGN KEY (`id_hotel`) REFERENCES `hoteles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `resena_paquete`
--
ALTER TABLE `resena_paquete`
  ADD CONSTRAINT `resena-paquete` FOREIGN KEY (`id_paquete`) REFERENCES `paquetes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `whishlist`
--
ALTER TABLE `whishlist`
  ADD CONSTRAINT `fk-usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

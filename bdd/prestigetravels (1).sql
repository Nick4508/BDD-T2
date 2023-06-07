-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-06-2023 a las 06:48:07
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
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`id_carrito`, `id_usuario`, `id_producto`, `cantidad`) VALUES
(31, 12, 1008, 1);

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

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id_compra`, `id_usuario`, `id_producto`, `cantidad`) VALUES
(5, 25, 1000, 2),
(6, 25, 2000, 2),
(7, 25, 1000, 2),
(8, 25, 2000, 1),
(11, 25, 2004, 1),
(12, 25, 2004, 2),
(13, 25, 2004, 2),
(14, 25, 2004, 3),
(15, 25, 1008, 1),
(16, 25, 2003, 1);

--
-- Disparadores `compras`
--
DELIMITER $$
CREATE TRIGGER `comprar` AFTER INSERT ON `compras` FOR EACH ROW BEGIN
    UPDATE hoteles
    SET habitaciones_disponibles = habitaciones_disponibles - NEW.cantidad
    WHERE id = NEW.id_producto;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `comprar2` AFTER INSERT ON `compras` FOR EACH ROW BEGIN
    UPDATE paquetes
    SET disponibles = disponibles - NEW.cantidad
    WHERE id = NEW.id_producto;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hospedaje_paquetes`
--

CREATE TABLE `hospedaje_paquetes` (
  `id_hotel` int(11) NOT NULL,
  `id_paquete` int(11) NOT NULL,
  `ciudad` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `hospedaje_paquetes`
--

INSERT INTO `hospedaje_paquetes` (`id_hotel`, `id_paquete`, `ciudad`, `nombre`) VALUES
(200, 2000, 'concon', 'Hotel Paraíso '),
(201, 2000, 'Viña del Mar', 'Vista al Mar'),
(203, 2001, 'Puerto Varas', 'Bosques del sur'),
(204, 2001, 'Puerto Montt', 'La casa de Aquiles'),
(210, 2003, 'Iquique', 'Joyas Marinas'),
(211, 2003, 'Arica', 'El marinero de agua dulce'),
(212, 2004, 'Pucón', 'Adentro del Bosque'),
(213, 2002, 'Rancagua', 'El sueño de O\'higgins'),
(214, 2002, 'Santiago', 'Sheraton'),
(215, 2005, 'Copiapo', 'El paraiso de Copiapo'),
(216, 2006, 'Coquimbo', 'Perlas del mar'),
(217, 2006, 'Copiapo', 'El paraiso de Copiapo'),
(218, 2007, 'Puerto Williams', 'El calor de Puerto Williams'),
(219, 2008, 'Puerto Montt', 'Bosques del sur'),
(220, 2008, 'Valparaiso', 'El puerto mi lugar'),
(221, 2008, 'Iquique', 'La joya del desierto'),
(222, 2009, '<Inserte nombre>', '<nombre hotel>'),
(223, 2010, 'Iquique', 'Iquique\'s Resort'),
(224, 2011, 'Isla de Pascua', 'El fragor de la Isla'),
(225, 2012, 'Puerto Montt', 'Paraiso del Sur'),
(226, 2012, 'Puerto Varas', 'La posada de los muertos');

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
(1000, 'La joya del desierto', 4, 80000, 'concon', 100, 70, 1, 1, 1, 0, 1),
(1001, 'La flor del océano', 5, 120000, 'Puerto Montt', 100, 56, 1, 1, 1, 1, 1),
(1002, 'Paraiso del sur', 5, 120000, 'Puerto Varas', 90, 50, 1, 1, 1, 1, 1),
(1003, 'Extreme Paradise', 4, 90000, 'Copiapo', 70, 65, 1, 1, 0, 1, 1),
(1004, 'Canciones de alta Mar', 4, 90000, 'Arica', 50, 46, 1, 1, 1, 1, 0),
(1005, 'Flores del bosque', 4, 90000, 'Temuco', 50, 40, 1, 1, 1, 1, 1),
(1006, 'La posada de los muertos', 4, 130000, 'Concepcion', 100, 70, 1, 1, 1, 1, 1),
(1007, 'Valparaiso el puerto principal', 5, 100000, 'Valparaíso', 95, 65, 1, 1, 1, 1, 1),
(1008, 'Punta del mar', 5, 105000, 'San Antonio', 100, 79, 1, 1, 1, 1, 0),
(1009, 'El volcán', 4, 80000, 'Osorno', 90, 50, 1, 0, 1, 0, 1),
(1010, 'Valdivia\'s Resort', 5, 120000, 'Valdivia', 60, 30, 1, 1, 1, 1, 1),
(1011, 'Los 3 Hermanos', 4, 70000, 'Calama', 60, 40, 1, 1, 0, 0, 1),
(1012, 'Paraiso perdido', 4, 90000, 'Arica', 70, 50, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `mayores`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `mayores` (
`id` int(11)
,`nombre` varchar(100)
,`cantidad` int(11)
,`tipo` varchar(8)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paquetes`
--

CREATE TABLE `paquetes` (
  `nombre` varchar(100) NOT NULL,
  `aerolinea_ida` varchar(50) NOT NULL,
  `aerolinea_vuelta` varchar(50) NOT NULL,
  `fecha_salida` date NOT NULL,
  `fecha_llegada` date NOT NULL,
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

INSERT INTO `paquetes` (`nombre`, `aerolinea_ida`, `aerolinea_vuelta`, `fecha_salida`, `fecha_llegada`, `noches_totales`, `precio_persona`, `disponibles`, `paquetes_totales`, `max_personas`, `id`) VALUES
('Paquete Norte Grande', 'LAN Chile', 'Express Airlines', '2023-06-09', '2023-06-20', 11, 120000, 10, 13, 3, 2000),
('Paquete La magia del sur', 'LAN Chile', 'American Airlines', '2023-06-07', '2023-06-14', 6, 110000, 20, 30, 2, 2001),
('Paquete Centro de Chile', 'LAN Chile', 'American Airlines', '2023-06-10', '2023-06-15', 5, 90000, 50, 60, 2, 2002),
('Paquete Vistas al mar', 'LAN Chile', 'Express Airlines', '2023-06-12', '2023-06-19', 7, 90000, 29, 40, 4, 2003),
('Paquete Visitas Inesperadas', 'Express Airlines', 'LAN Chile', '2023-06-13', '2023-06-22', 9, 130000, 30, 35, 3, 2004),
('Paquete Norte Chico', 'Express Airlines', 'LAN Chile', '2023-06-15', '2023-06-20', 4, 130000, 30, 40, 2, 2005),
('Paquete Los lagos mi tierra', 'LAN Chile', 'Express Airlines', '2023-06-09', '2023-06-14', 5, 130000, 20, 30, 3, 2006),
('Paquete Zona Austral', 'Express Airlines', 'American Airlines', '2023-06-15', '2023-06-20', 4, 110000, 30, 40, 3, 2007),
('Paquete  1 2 3 Ya lo ves', 'LATAM Airlines', 'American Airlines', '2023-06-16', '2023-06-27', 8, 150000, 10, 13, 3, 2008),
('Paquete Placeholders', 'Express Airlines', 'LAN Chile', '2023-06-21', '2023-06-26', 5, 120000, 30, 40, 2, 2009),
('Paquete Ayuda no tengo mas ideas', 'Jet SMART', 'Jet SMART', '2023-06-16', '2023-06-23', 7, 120000, 30, 40, 2, 2010),
('Paquete Isla de Pascua', 'Express Airlines', 'LAN Chile', '2023-06-15', '2023-06-20', 5, 110000, 30, 40, 2, 2011),
('Paquete Los ultimos son los primeros', 'LAN Chile', 'Jet SMART', '2023-06-16', '2023-06-30', 14, 150000, 20, 30, 3, 2012);

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
(1, 25, '2023-06-07', '', 0, 0, 0, 0, 1000, 0),
(12, 12, '2023-02-08', '', 3, 5, 3, 3, 1004, 3.5),
(30, 12, '2023-05-03', 'Si me gustó muchisimo', 5, 5, 5, 5, 1000, 5),
(31, 13, '2023-05-01', 'Buen hotel, muy bonito, con vistas al mar, excelente servicio.', 5, 5, 5, 5, 1001, 5),
(100, 12, '2023-05-03', '', 5, 5, 5, 5, 1002, 5),
(101, 12, '2023-05-03', '', 5, 5, 5, 5, 1006, 5),
(102, 12, '2023-06-02', '', 5, 5, 5, 5, 1003, 5),
(104, 13, '2023-05-03', '', 3, 3, 4, 4, 1004, 3.5),
(105, 14, '2023-05-03', '', 5, 4, 3, 5, 1005, 4.25),
(109, 14, '2023-06-02', '', 5, 5, 4, 4, 1006, 4.5),
(110, 10, '2023-05-03', '', 5, 4, 5, 5, 1007, 4.75),
(111, 10, '2023-06-02', '', 5, 5, 3, 4, 1008, 4.25),
(115, 10, '2023-05-03', 'Buen hotel me gustó mucho', 5, 4, 5, 5, 1009, 4.75),
(116, 40, '2023-06-01', '', 5, 4, 4, 4, 1010, 4.25),
(117, 25, '2023-06-07', '', 4, 4, 4, 4, 1008, 4);

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
(1, 25, '2023-06-06', '', 5, 5, 5, 5, 2000, 5),
(2, 12, '2023-05-03', 'Si me gustó muchisimo', 5, 5, 3, 3, 2003, 4),
(3, 15, '2023-05-05', '', 4, 4, 5, 5, 2002, 4.5),
(4, 15, '2023-05-03', '', 5, 4, 5, 5, 2001, 4.75),
(5, 11, '2023-05-10', '', 5, 5, 3, 4, 2005, 4.25),
(6, 10, '2023-05-02', '', 4, 4, 5, 5, 2006, 4.5),
(7, 9, '2023-05-14', '', 5, 5, 5, 5, 2008, 5),
(8, 9, '2023-05-28', '', 4, 4, 5, 5, 2008, 4.5),
(9, 8, '2023-05-19', '', 5, 4, 3, 5, 2012, 4.25),
(10, 10, '2023-05-14', '', 4, 4, 5, 5, 2007, 4.5),
(30, 12, '2023-06-01', '', 4, 4, 4, 4, 2000, 4),
(31, 25, '2023-06-07', 'Si me gustó muchisimo', 4, 4, 4, 4, 2004, 4);

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
(12, 'Elvis', 'elvis@gmail.com', '2001-08-29', '123'),
(13, 'aquiles bailo', 'aquiles.bailo@gmail.com', '2003-05-13', 'juanperezgomes'),
(14, 'Armando', 'armando@gmail.com', '2001-08-29', '123'),
(15, 'Ando', 'Ando@gmail.com', '2003-06-04', '123'),
(25, 'nicolas', 'nicolas.rodriguezbe@ums.cl', '2001-08-29', '123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_paquete` int(11) NOT NULL,
  `puntuacion_promedio` float NOT NULL,
  `paquete` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `wishlist`
--

INSERT INTO `wishlist` (`id`, `id_usuario`, `id_paquete`, `puntuacion_promedio`, `paquete`) VALUES
(19, 12, 1008, 4.25, 0),
(20, 12, 2000, 3.25, 1),
(24, 25, 1008, 4.125, 0);

-- --------------------------------------------------------

--
-- Estructura para la vista `mayores`
--
DROP TABLE IF EXISTS `mayores`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `mayores`  AS SELECT `hoteles`.`id` AS `id`, `hoteles`.`nombre` AS `nombre`, `hoteles`.`cantidad` AS `cantidad`, `hoteles`.`tipo` AS `tipo` FROM (select `hoteles`.`id` AS `id`,`hoteles`.`Nombre` AS `nombre`,`hoteles`.`habitaciones_disponibles` AS `cantidad`,'hoteles' AS `tipo` from `hoteles` order by `hoteles`.`habitaciones_disponibles` desc limit 4) AS `hoteles`union all select `paquetes`.`id` AS `id`,`paquetes`.`nombre` AS `nombre`,`paquetes`.`cantidad` AS `cantidad`,`paquetes`.`tipo` AS `tipo` from (select `paquetes`.`id` AS `id`,`paquetes`.`nombre` AS `nombre`,`paquetes`.`disponibles` AS `cantidad`,'paquetes' AS `tipo` from `paquetes` order by `paquetes`.`disponibles` desc limit 4) `paquetes` order by `cantidad` desc limit 4  ;

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
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id_compra`);

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
-- Indices de la tabla `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-usuario` (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id_carrito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `resena_hotel`
--
ALTER TABLE `resena_hotel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT de la tabla `resena_paquete`
--
ALTER TABLE `resena_paquete`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

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
-- Filtros para la tabla `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `fk-usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

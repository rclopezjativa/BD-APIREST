-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-06-2022 a las 20:48:59
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bolsaempleo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ofertastrabajo`
--

CREATE TABLE `ofertastrabajo` (
  `id_oferta_trabajo` int(11) NOT NULL,
  `nombre_oferta_trabajo` varchar(250) NOT NULL,
  `descripcion_oferta_trabajo` text NOT NULL,
  `estado_oferta_trabajo` tinyint(1) NOT NULL,
  `date_created_oferta_trabajo` date NOT NULL,
  `date_updated_oferta_trabajo` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ofertastrabajo`
--

INSERT INTO `ofertastrabajo` (`id_oferta_trabajo`, `nombre_oferta_trabajo`, `descripcion_oferta_trabajo`, `estado_oferta_trabajo`, `date_created_oferta_trabajo`, `date_updated_oferta_trabajo`) VALUES
(1, 'Desarrollador', 'Fullstack developer', 1, '2022-05-30', '2022-05-31 05:28:52'),
(2, 'Analista', 'Analista', 0, '2022-05-30', '2022-05-31 06:14:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `correo_usuario` varchar(100) NOT NULL,
  `nombre_usuario` varchar(250) NOT NULL,
  `tipo_documento_usuario` char(3) NOT NULL,
  `numero_documento_usuario` varchar(15) NOT NULL,
  `date_create_usuarios` date DEFAULT NULL,
  `date_updated_usuarios` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `correo_usuario`, `nombre_usuario`, `tipo_documento_usuario`, `numero_documento_usuario`, `date_create_usuarios`, `date_updated_usuarios`) VALUES
(1, 'rclopez.jativa@hotmail.com', 'roberto.lopez', 'CED', '0915267595', '2022-05-30', '2022-05-31 05:12:11'),
(2, 'correo1@correo.com', 'Beto', 'CED', '0912312312', '2022-05-30', '2022-05-31 07:25:12'),
(3, 'correo2@correo.com', 'Luis', 'CED', '0978978945', '2022-05-30', '2022-05-31 07:26:32'),
(4, 'correo3@correo.com', 'Bety', 'CED', '0945645612', '2022-05-30', '2022-05-31 07:26:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuariosoferta`
--

CREATE TABLE `usuariosoferta` (
  `id` int(11) NOT NULL,
  `oferta_usuarios_oferta` int(11) NOT NULL,
  `usuario_usuarios_oferta` int(11) NOT NULL,
  `date_created_usuarios_oferta` date NOT NULL,
  `date_updated_usuarios_oferta` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuariosoferta`
--

INSERT INTO `usuariosoferta` (`id`, `oferta_usuarios_oferta`, `usuario_usuarios_oferta`, `date_created_usuarios_oferta`, `date_updated_usuarios_oferta`) VALUES
(1, 1, 1, '2022-05-30', '2022-05-31 07:28:03'),
(2, 1, 2, '2022-05-30', '2022-05-31 07:28:03'),
(3, 2, 3, '2022-05-30', '2022-05-31 07:28:39'),
(4, 2, 4, '2022-05-30', '2022-05-31 07:28:39');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ofertastrabajo`
--
ALTER TABLE `ofertastrabajo`
  ADD PRIMARY KEY (`id_oferta_trabajo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `idx_u_correo` (`correo_usuario`),
  ADD UNIQUE KEY `idx_u_numero` (`numero_documento_usuario`);

--
-- Indices de la tabla `usuariosoferta`
--
ALTER TABLE `usuariosoferta`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_u_oferta_usuario` (`oferta_usuarios_oferta`,`usuario_usuarios_oferta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ofertastrabajo`
--
ALTER TABLE `ofertastrabajo`
  MODIFY `id_oferta_trabajo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuariosoferta`
--
ALTER TABLE `usuariosoferta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Temps de generació: 15-12-2020 a les 17:17:41
-- Versió del servidor: 10.3.22-MariaDB-0+deb10u1
-- Versió de PHP: 7.3.17-1+0~20200419.57+debian9~1.gbp0fda17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de dades: `todo_list`
--

-- --------------------------------------------------------

--
-- Estructura de la taula `tareas`
--

CREATE TABLE `tareas` (
  `id_tarea` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8_unicode_ci NOT NULL,
  `acabado` tinyint(1) NOT NULL DEFAULT 0,
  `fecha_creacion` date NOT NULL,
  `fecha_entrega` date NOT NULL,
  `usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Bolcant dades de la taula `tareas`
--

INSERT INTO `tareas` (`id_tarea`, `nombre`, `descripcion`, `acabado`, `fecha_creacion`, `fecha_entrega`, `usuario`) VALUES
(2, 'tirarle al gachapon al juanma', 'para que le toque dilux', 0, '2020-12-05', '2020-12-05', 6),
(4, 'arreglar las ruta a toni en m7', 'pork voy muerto', 0, '2020-12-09', '2020-12-17', 5),
(6, 'pasarme al cyberpunk2077 ', 'pork le tengo ganasd', 0, '2020-12-09', '2020-12-24', 5),
(7, 'Hacer M9 ', 'INSTAGRAMUSIC ', 1, '2020-12-09', '2020-12-12', 5);

-- --------------------------------------------------------

--
-- Estructura de la taula `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `password` char(32) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Bolcant dades de la taula `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `password`) VALUES
(1, 'fallguysito777', '926e27eecdbc7a18858b3798ba99bddd'),
(2, 'sergiomj', '202cb962ac59075b964b07152d234b70'),
(3, 'fallguysito7778', '202cb962ac59075b964b07152d234b70'),
(4, 'linus', '6cd71071ccd0edfe7500231c77eea572'),
(5, 'pepe', '81dc9bdb52d04dc20036dbd8313ed055'),
(6, 'tonisempai', '81dc9bdb52d04dc20036dbd8313ed055'),
(7, 'Sergiomj1', 'e10adc3949ba59abbe56e057f20f883e'),
(8, 'dionisio', '81dc9bdb52d04dc20036dbd8313ed055'),
(9, 'pepa', '827ccb0eea8a706c4c34a16891f84e7b');

--
-- Indexos per taules bolcades
--

--
-- Index de la taula `tareas`
--
ALTER TABLE `tareas`
  ADD PRIMARY KEY (`id_tarea`),
  ADD KEY `usuario` (`usuario`);

--
-- Index de la taula `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- AUTO_INCREMENT per les taules bolcades
--

--
-- AUTO_INCREMENT per la taula `tareas`
--
ALTER TABLE `tareas`
  MODIFY `id_tarea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT per la taula `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Restriccions per taules bolcades
--

--
-- Restriccions per la taula `tareas`
--
ALTER TABLE `tareas`
  ADD CONSTRAINT `tareas_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-06-2021 a las 18:01:53
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*
  Recuerda deshabilitar la opción "Enable foreign key checks" para evitar problemas a la hora de importar el script.
*/

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `shopirt`
--
CREATE DATABASE IF NOT EXISTS `shopirt` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `shopirt`;

--
-- Truncar tablas antes de insertar `Usuarios`
--

TRUNCATE TABLE `Usuarios`;
--
-- Volcado de datos para la tabla `Usuarios`
--

/*
admin:adminpass
miguelito:miguelpass
Chema:chemapass
marlon10:marlonpass
davidATM:davidpass97
David:davidpass
*/

INSERT INTO `Usuarios` (`id_usuario`, `nombreUsuario`, `password`, `nombre`, `email`, `telefono`, `saldo`) VALUES
(1, 'admin', '$2y$10$O3c1kBFa2yDK5F47IUqusOJmIANjHP6EiPyke5dD18ldJEow.e0eS', 'Administrador', 'admin@gmail.com', '910000000', 0),
(4, 'miguelito', '$2y$10$mu/puJP0Y1R7lqzJziyXsObR4wOhwI8zhLofRo9wj2okyHsF0gM6.', 'Miguel', 'miguel@gmail.com', '657896543', 0),
(5, 'Chema', '$2y$10$3HliWnXcmqTMdbwQn2s2S.RJCns0fId1Zr1MTm14lz3AMuPu1lT56', 'Jose Maria', 'chema@gmail.com', '654324589', 0),
(6, 'marlon10', '$2y$10$KBmZuTC5qlNL2PkkCtROi.iYRglUcbAE0DTH8eiLvP8op4/9q8gDe', 'Marlon', 'marlon@gmail.com', '652378390', 0),
(7, 'davidATM', '$2y$10$tau272tFMyq8YuOB6NniO.BrugSKc38wGdCDkozUt6YxNX8LrABD.', 'David', 'davidG@gmail.com', '678954323', 0),
(8, 'David', '$2y$10$YIUbILnRIiJtZmF7AdpAjeqRrjkp./ouTtxv.0/HUAsje87sheEza', 'David', 'david@gmail.com', '678234567', 3000);

--
-- Truncar tablas antes de insertar `Roles`
--

TRUNCATE TABLE `Roles`;

--
-- Volcado de datos para la tabla `Roles`
--

INSERT INTO `Roles` (`id`, `nombre`) VALUES
(1, 'admin'),
(2, 'user');


--
-- Truncar tablas antes de insertar `RolesUsuario`
--

TRUNCATE TABLE `RolesUsuario`;

--
-- Volcado de datos para la tabla `RolesUsuario`
--

INSERT INTO `RolesUsuario` (`usuario`, `rol`) VALUES
(1, 1),
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 2);

--
-- Truncar tablas antes de insertar `Categorias`
--

TRUNCATE TABLE `Categorias`;

--
-- Volcado de datos para la tabla `Categorias`
--

INSERT INTO `Categorias` (`id_categoria`, `nombre`) VALUES
(1, 'Futbol'),
(2, 'Gimnasio'),
(3, 'Anime'),
(4, 'Nike'),
(5, 'Puma'),
(6, 'Adidas');

--
-- Truncar tablas antes de insertar `Productos`
--

TRUNCATE TABLE `Productos`;

--
-- Volcado de datos para la tabla `Productos`
--

INSERT INTO `Productos` (`id_producto`, `nombre`, `descripcion`, `id_categoria`, `precio`, `precio_oferta`, `talla`, `stock`, `img`, `fecha`) VALUES
(1, 'Camiseta Azul', 'Camiseta de gimnasio de color azul', 2, 100, NULL, 'XL', 96, 'img/azul.jpg', '2022-02-05'),
(2, 'Camiseta Roja', 'Camiseta de gimnasio de color rojo', 2, 200, NULL, 'L', 79, 'img/roja.jpg', '2022-03-12'),
(11, 'Camiseta Atletico de Madrid', 'Camiseta del club Atletico de Madrid', 1, 100, 90, 'L', 100, 'img/atleti.jpg', '2022-05-12'),
(12, 'Camiseta Betis Copa', 'Camiseta con la que gano el Real Betis la Copa del Rey', 1, 100, NULL, 'M', 80, 'img/Betis.jpg', '2022-05-12'),
(14, 'Nike SportWear', 'Camiseta Nike con los mejores tejidos', 4, 160, 120, 'L', 100, 'img/NikeSportwear.jpg', '2022-02-12'),
(15, 'Attack on Titans', 'Camiseta de la serie Ataque a los titanes', 3, 60, 40, 'L', 119, 'img/AoT.jpg', '2022-05-12'),
(16, 'Nike StreetWear', 'Camiseta Nike con los mejores tejidos', 4, 100, 80, 'L', 100, 'img/nikestreetwear.jpg', '2022-05-12'),
(17, 'Puma Street', 'Camiseta de la marca Puma de estilo urbano', 5, 90, NULL, 'M', 50, 'img/pumashirt.jpg', '2022-01-12'),
(18, 'Adidas UltraBoost', 'Camiseta Adidas para todo tipo de ocasiones', 6, 70, NULL, 'S', 50, 'img/adidasshirt.jpg', '2022-05-12'),
(19, 'Naruto Shippuden', 'Camiseta de la serie Naruto Shippuden', 3, 70, 60, 'L', 70, 'img/naruto.jpg', '2022-05-12');


--
-- Truncar tablas antes de insertar `Pedidos`
--

TRUNCATE TABLE `Pedidos`;

--
-- Volcado de datos para la tabla `Pedidos`
--

INSERT INTO `Pedidos` (`id_pedido`, `id_usuario`, `direccion`, `precioTotal`) VALUES
(1, 1, 'FDI UCM', 850),
(2, 8, 'FDI UCM', 340);

--
-- Truncar tablas antes de insertar `ArticulosPedido`
--

TRUNCATE TABLE `ArticulosPedido`;

--
-- Volcado de datos para la tabla `ArticulosPedido`
--

INSERT INTO `ArticulosPedido` (`id_articulospedido`, `id_pedido`, `id_producto`, `unidades`) VALUES
(2, 1, 1, 4),
(13, 2, 15, 1);


--
-- Truncar tablas antes de insertar `Favoritos`
--

TRUNCATE TABLE `Favoritos`;

--
-- Volcado de datos para la tabla `Favoritos`
--

INSERT INTO `Favoritos` (`id_favorito`, `id_usuario`, `id_producto`) VALUES
(8, 8, 12),
(9, 8, 19);

--
-- Truncar tablas antes de insertar `Valoraciones`
--

TRUNCATE TABLE `Valoraciones`;

--
-- Volcado de datos para la tabla `Valoraciones`
--

INSERT INTO `Valoraciones` (`id_valoraciones`, `id_usuario`, `id_producto`, `puntuacion`) VALUES
(10, 8, 12, 5),
(11, 8, 15, 4);


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

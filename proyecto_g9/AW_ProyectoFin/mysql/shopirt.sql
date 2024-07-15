/*
  Recuerda deshabilitar la opción "Enable foreign key checks" para evitar problemas a la hora de importar el script.
*/
CREATE DATABASE IF NOT EXISTS `shopirt` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `shopirt`;

CREATE USER 'shopirt'@'%' IDENTIFIED BY 'shopirt';
GRANT ALL PRIVILEGES ON `shopirt`.* TO 'shopirt'@'%';

CREATE USER 'shopirt'@'localhost' IDENTIFIED BY 'shopirt';
GRANT ALL PRIVILEGES ON `shopirt`.* TO 'shopirt'@'localhost';

DROP TABLE IF EXISTS `RolesUsuario`;
DROP TABLE IF EXISTS `Roles`;
DROP TABLE IF EXISTS `Usuarios`;

CREATE TABLE IF NOT EXISTS `Roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `RolesUsuario` (
  `usuario` int(11) NOT NULL,
  `rol` int(11) NOT NULL,
  PRIMARY KEY (`usuario`,`rol`),
  KEY `rol` (`rol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `Usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombreUsuario` varchar(30) COLLATE utf8mb4_general_ci NOT NULL UNIQUE,
  `password` varchar(70) COLLATE utf8mb4_general_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(30) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `saldo` int(10) NOT NULL,

  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `Favoritos`;
CREATE TABLE `Favoritos` (
  `id_favorito` int(10) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_producto` int(10) NOT NULL,

  PRIMARY KEY (`id_favorito`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `Productos`;
CREATE TABLE `Productos` (
  `id_producto` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `id_categoria` int(10) NOT NULL,
  `precio` int(10) NOT NULL,
  `precio_oferta` int(10),
  `talla` varchar(10) NOT NULL,
  `stock` int(15) NOT NULL,
  `img` varchar(30) NOT NULL,
  `fecha` date NOT NULL,

  PRIMARY KEY (`id_producto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

-- INSERT INTO `Productos` (`id_producto`, `nombre`, `descripcion`, `id_categoria`, `precio`, `precio_oferta`, `talla`, `stock`, `img`, `fecha`) VALUES
-- (1, 'Camiseta Azul', 'Camiseta de gimnasio de color azul', 2, 100, null , 'XL', 100, 'img/azul.jpg', '2022-02-05'),
-- (2, 'Camiseta Roja', 'Camiseta de gimnasio de color rojo', 2, 200, 150 , 'L',80, 'img/roja.jpg', curdate()); 

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `ArticulosPedido`;
CREATE TABLE `ArticulosPedido` (
  `id_articulospedido` int(10) NOT NULL AUTO_INCREMENT,
  `id_pedido` int(10) NOT NULL,
  `id_producto` int(10) NOT NULL,
  `unidades` int(15) NOT NULL,


  PRIMARY KEY (`id_articulospedido`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



--
-- Estructura de tabla para la tabla `categorias`
--

DROP TABLE IF EXISTS `Categorias`;
CREATE TABLE `Categorias` (
  `id_categoria` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,

  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `Pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Pedidos` (
  `id_pedido` int(10) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `precioTotal` int(100) NOT NULL,
  PRIMARY KEY (`id_pedido`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

-- INSERT INTO `Categorias` (`id_categoria`, `nombre`) VALUES (1, 'Futbol'), (2, 'Gimnasio'), (3, 'Anime'), 
-- (4, 'Nike'), (5, 'Puma'), (6, 'Adidas');

-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valoraciones`
--

DROP TABLE IF EXISTS `Valoraciones`;
CREATE TABLE `Valoraciones` (
  `id_valoraciones` int(10) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11),
  `id_producto` int(10) NOT NULL,
  `puntuacion` int(1) NOT NULL,
  PRIMARY KEY (`id_valoraciones`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `valoraciones`
--

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--

-- Indices de la tabla `favoritos`
--
ALTER TABLE `Favoritos`
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `-`
--

--
-- Indices de la tabla `valoraciones`
--
ALTER TABLE `Valoraciones`
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_producto` (`id_producto`);


-- Indices de la tabla `pedidos`
--
ALTER TABLE `Pedidos`
  ADD KEY `id_pedido` (`id_pedido`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `Productos`
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `categorias`
--

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `?`
--


--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `favoritos`
--
ALTER TABLE `Favoritos`
  ADD CONSTRAINT `id_usuario_fk1` FOREIGN KEY (`id_usuario`) REFERENCES `Usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_producto_fk1` FOREIGN KEY (`id_producto`) REFERENCES `Productos` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `transacciones`
--
ALTER TABLE `Pedidos`
  ADD CONSTRAINT `id_usuario_fk2` FOREIGN KEY (`id_usuario`) REFERENCES `Usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `Valoraciones`
  ADD CONSTRAINT `id_usuario_fk3` FOREIGN KEY (`id_usuario`) REFERENCES `Usuarios` (`id_usuario`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `id_producto_f3` FOREIGN KEY (`id_producto`) REFERENCES `Productos` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `categorias`
/*Falta añadir esta restricción, pero no la he añadido para que funcione el subir producto.*/
ALTER TABLE `ArticulosPedido`
  ADD CONSTRAINT `id_pedido_fk1` FOREIGN KEY (`id_pedido`) REFERENCES `Pedidos` (`id_pedido`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_producto_f4` FOREIGN KEY (`id_producto`) REFERENCES `Productos` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE;


/*ALTER TABLE `Productos`
  ADD CONSTRAINT `id_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `Categorias` (`id_categoria`),
  ADD CONSTRAINT `id_estado` FOREIGN KEY (`id_estado`) REFERENCES `Estados` (`id_estado`);
COMMIT;*/

TRUNCATE TABLE `RolesUsuario`;
TRUNCATE TABLE `Roles`;
TRUNCATE TABLE `Usuarios`;

-- INSERT INTO `Roles` (`id`, `nombre`) VALUES
-- (1, 'admin'),
-- (2, 'user');


-- INSERT INTO `RolesUsuario` (`usuario`, `rol`) VALUES
-- (1, 1),
-- (1, 2),
-- (2, 2);

-- /*
--   user: userpass
--   admin: adminpass
-- */
-- INSERT INTO `Usuarios` (`id_usuario`, `nombreUsuario`, `nombre`, `password`, `email`, `telefono`, `saldo`) VALUES
-- (1, 'admin', 'Administrador', '$2y$10$O3c1kBFa2yDK5F47IUqusOJmIANjHP6EiPyke5dD18ldJEow.e0eS', 'admin@gmail.com', '910000000', '0'),
-- (2, 'user', 'Usuario', '$2y$10$uM6NtF.f6e.1Ffu2rMWYV.j.X8lhWq9l8PwJcs9/ioVKTGqink6DG', 'user@gmail.com', '910000001', '0');
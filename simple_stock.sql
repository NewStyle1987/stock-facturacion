-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.1.34-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura de base de datos para simple_stock
CREATE DATABASE IF NOT EXISTS `simple_stock` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `simple_stock`;


-- Volcando estructura para tabla simple_stock.categorias
CREATE TABLE IF NOT EXISTS `categorias` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_categoria` varchar(255) NOT NULL,
  `descripcion_categoria` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla simple_stock.categorias: 1 rows
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` (`id_categoria`, `nombre_categoria`, `descripcion_categoria`, `date_added`) VALUES
	(7, 'Accesorios', 'Accesorios', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;


-- Volcando estructura para tabla simple_stock.clientes
CREATE TABLE IF NOT EXISTS `clientes` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_cliente` varchar(50) DEFAULT NULL,
  `telefono_cliente` char(50) DEFAULT NULL,
  `email_cliente` varchar(50) DEFAULT NULL,
  `direccion_cliente` varchar(50) DEFAULT NULL,
  `status_cliente` tinyint(4) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  PRIMARY KEY (`id_cliente`),
  UNIQUE KEY `nombre_cliente` (`nombre_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla simple_stock.clientes: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` (`id_cliente`, `nombre_cliente`, `telefono_cliente`, `email_cliente`, `direccion_cliente`, `status_cliente`, `date_added`) VALUES
	(1, 'anonimus', '08002020', 'ano@nimus.com', 'anonimus', 1, '2018-07-22 13:57:27'),
	(10, 'sin_identificar', '', 'sin@identificar.com', '', 1, '2018-12-28 00:48:00'),
	(11, 'prueba_youtube', '', 'prueba@youtube.com', '', 1, '2018-12-28 11:33:21');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;


-- Volcando estructura para tabla simple_stock.detalle_factura
CREATE TABLE IF NOT EXISTS `detalle_factura` (
  `id_detalle` int(11) NOT NULL AUTO_INCREMENT,
  `numero_factura` int(11) DEFAULT '0',
  `id_producto` int(11) DEFAULT '0',
  `cantidad` int(11) DEFAULT '0',
  `precio_venta` double DEFAULT '0',
  PRIMARY KEY (`id_detalle`),
  KEY `id_producto` (`id_producto`),
  KEY `numero_factura` (`numero_factura`)
) ENGINE=InnoDB AUTO_INCREMENT=237 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla simple_stock.detalle_factura: ~16 rows (aproximadamente)
/*!40000 ALTER TABLE `detalle_factura` DISABLE KEYS */;
INSERT INTO `detalle_factura` (`id_detalle`, `numero_factura`, `id_producto`, `cantidad`, `precio_venta`) VALUES
	(204, 1, 6, 1, 100),
	(205, 1, 5, 1, 100),
	(206, 1, 4, 1, 100),
	(209, 1, 1, 1, 500),
	(211, 2, 1, 5, 500),
	(212, 3, 1, 10, 500),
	(214, 1, 3, 1, 100),
	(215, 1, 2, 1, 100),
	(216, 4, 1, 1, 500),
	(217, 4, 2, 1, 100),
	(218, 4, 3, 1, 100),
	(219, 4, 4, 1, 100),
	(221, 1, 22, 1, 500),
	(222, 1, 22, 1, 500),
	(223, 1, 22, 1, 500),
	(224, 2, 22, 1, 500),
	(225, 2, 22, 1, 500),
	(226, 2, 22, 1, 500),
	(227, 2, 22, 1, 500),
	(228, 2, 22, 1, 500),
	(229, 2, 22, 1, 500),
	(230, 2, 22, 1, 500),
	(231, 3, 22, 1, 500),
	(232, 4, 22, 1, 500),
	(233, 5, 22, 1, 500),
	(234, 6, 22, 1, 500),
	(235, 7, 22, 1, 500),
	(236, 8, 22, 1, 500);
/*!40000 ALTER TABLE `detalle_factura` ENABLE KEYS */;


-- Volcando estructura para tabla simple_stock.estado
CREATE TABLE IF NOT EXISTS `estado` (
  `id_estado` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_estado` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_estado`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla simple_stock.estado: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `estado` DISABLE KEYS */;
INSERT INTO `estado` (`id_estado`, `nombre_estado`) VALUES
	(0, 'INACTIVO'),
	(1, 'ACTIVO');
/*!40000 ALTER TABLE `estado` ENABLE KEYS */;


-- Volcando estructura para tabla simple_stock.facturas
CREATE TABLE IF NOT EXISTS `facturas` (
  `id_factura` int(11) NOT NULL AUTO_INCREMENT,
  `numero_factura` int(11) DEFAULT NULL,
  `fecha_factura` datetime DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `id_vendedor` int(11) DEFAULT NULL,
  `condiciones` varchar(50) DEFAULT NULL,
  `total_venta` varchar(50) DEFAULT NULL,
  `estado_factura` tinyint(4) DEFAULT NULL,
  `canal` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_factura`),
  UNIQUE KEY `numero_factura` (`numero_factura`),
  KEY `id_cliente` (`id_cliente`),
  CONSTRAINT `FK_facturas_clientes` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla simple_stock.facturas: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `facturas` DISABLE KEYS */;
INSERT INTO `facturas` (`id_factura`, `numero_factura`, `fecha_factura`, `id_cliente`, `id_vendedor`, `condiciones`, `total_venta`, `estado_factura`, `canal`) VALUES
	(1, 1, '2019-02-01 23:49:53', 1, 6, '1', '1500', 1, 1),
	(2, 2, '2019-02-02 00:02:27', 1, 6, '2', '3500', 0, 1),
	(3, 3, '2019-02-02 00:03:07', 1, 6, '1', '500', 1, 1),
	(4, 4, '2019-02-02 17:01:45', 1, 6, '2', '500', 1, 1),
	(5, 5, '2019-02-02 17:02:49', 1, 6, '1', '500', 1, 1),
	(6, 6, '2019-02-02 17:03:47', 1, 6, '1', '500', 1, 1),
	(7, 7, '2019-02-02 17:04:51', 1, 6, '1', '500', 0, 0),
	(8, 8, '2019-02-02 17:14:20', 1, 6, '5', '500', 0, 0);
/*!40000 ALTER TABLE `facturas` ENABLE KEYS */;


-- Volcando estructura para tabla simple_stock.historial
CREATE TABLE IF NOT EXISTS `historial` (
  `id_historial` int(11) NOT NULL AUTO_INCREMENT,
  `id_producto` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `nota` varchar(255) NOT NULL,
  `referencia` varchar(100) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `canal` varchar(107) DEFAULT NULL,
  `f_pago` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_historial`),
  KEY `id_producto` (`id_producto`),
  CONSTRAINT `fk_id_producto` FOREIGN KEY (`id_producto`) REFERENCES `products` (`id_producto`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla simple_stock.historial: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `historial` DISABLE KEYS */;
INSERT INTO `historial` (`id_historial`, `id_producto`, `user_id`, `fecha`, `nota`, `referencia`, `cantidad`, `canal`, `f_pago`) VALUES
	(1, 22, 6, '2019-01-30 15:36:39', 'testing eliminO por FACTURA Nro 1: 50 producto(s) al inventario - ref BB002 ', 'FACTURA', 50, 'Contado', NULL),
	(2, 22, 6, '2019-02-02 00:01:31', 'testing eliminO por FACTURA Nro 1: 1 producto(s) al inventario - ref BB002 ', 'FACTURA', 1, 'Contado', NULL),
	(3, 22, 6, '2019-02-02 00:01:31', 'testing eliminO por FACTURA Nro 1: 1 producto(s) al inventario - ref BB002 ', 'FACTURA', 1, 'Contado', NULL),
	(4, 22, 6, '2019-02-02 00:01:32', 'testing eliminO por FACTURA Nro 1: 1 producto(s) al inventario - ref BB002 ', 'FACTURA', 1, 'Contado', NULL),
	(5, 22, 6, '2019-02-02 00:02:48', 'testing eliminO por FACTURA Nro 2: 1 producto(s) al inventario - ref BB002 ', 'FACTURA', 1, 'Contado', NULL),
	(6, 22, 6, '2019-02-02 00:02:48', 'testing eliminO por FACTURA Nro 2: 1 producto(s) al inventario - ref BB002 ', 'FACTURA', 1, 'Contado', NULL),
	(7, 22, 6, '2019-02-02 00:02:48', 'testing eliminO por FACTURA Nro 2: 1 producto(s) al inventario - ref BB002 ', 'FACTURA', 1, 'Contado', NULL),
	(8, 22, 6, '2019-02-02 00:02:48', 'testing eliminO por FACTURA Nro 2: 1 producto(s) al inventario - ref BB002 ', 'FACTURA', 1, 'Contado', NULL),
	(9, 22, 6, '2019-02-02 00:02:49', 'testing eliminO por FACTURA Nro 2: 1 producto(s) al inventario - ref BB002 ', 'FACTURA', 1, 'Contado', NULL),
	(10, 22, 6, '2019-02-02 00:02:49', 'testing eliminO por FACTURA Nro 2: 1 producto(s) al inventario - ref BB002 ', 'FACTURA', 1, 'Contado', NULL),
	(11, 22, 6, '2019-02-02 00:02:49', 'testing eliminO por FACTURA Nro 2: 1 producto(s) al inventario - ref BB002 ', 'FACTURA', 1, 'Contado', NULL);
/*!40000 ALTER TABLE `historial` ENABLE KEYS */;


-- Volcando estructura para tabla simple_stock.products
CREATE TABLE IF NOT EXISTS `products` (
  `id_producto` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_producto` char(20) NOT NULL,
  `nombre_producto` char(255) NOT NULL,
  `date_added` datetime NOT NULL,
  `precio_producto` double NOT NULL,
  `stock` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_talle` int(11) DEFAULT NULL,
  `modelo` char(3) DEFAULT NULL,
  `detalle` varchar(150) DEFAULT NULL,
  `codigo_barras` varchar(20) DEFAULT NULL,
  `img` varchar(500) DEFAULT NULL,
  `id_estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_producto`),
  UNIQUE KEY `codigo_producto` (`codigo_producto`),
  KEY `FK_products_estado` (`id_estado`),
  CONSTRAINT `FK_products_estado` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id_estado`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla simple_stock.products: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`id_producto`, `codigo_producto`, `nombre_producto`, `date_added`, `precio_producto`, `stock`, `id_categoria`, `id_talle`, `modelo`, `detalle`, `codigo_barras`, `img`, `id_estado`) VALUES
	(22, 'BB002', 'Super Remera Match', '2018-07-31 01:03:42', 500, 40, 7, 4, 'EJE', 'EJEMPLO2', 'EJEMPLO2', '', 0);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;


-- Volcando estructura para tabla simple_stock.talles
CREATE TABLE IF NOT EXISTS `talles` (
  `id_talle` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_talle` char(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcion_talle` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  PRIMARY KEY (`id_talle`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla simple_stock.talles: ~14 rows (aproximadamente)
/*!40000 ALTER TABLE `talles` DISABLE KEYS */;
INSERT INTO `talles` (`id_talle`, `nombre_talle`, `descripcion_talle`, `date_added`) VALUES
	(1, 't0', 'Talle Unico - va de 86 cms a 95 cms', '2018-06-28 01:01:01'),
	(2, 'ts', 'Tu chico', '0000-00-00 00:00:00'),
	(3, 'tg', 'Tu grande', '0000-00-00 00:00:00'),
	(4, 't1', 'S', '0000-00-00 00:00:00'),
	(5, 't2', 'M', '0000-00-00 00:00:00'),
	(6, 't3', 'L', '0000-00-00 00:00:00'),
	(7, 'q1', 'XL', '0000-00-00 00:00:00'),
	(8, 'q2', '2XL', '0000-00-00 00:00:00'),
	(9, 'q3', '3XL', '0000-00-00 00:00:00'),
	(10, 'q4', '4XL', '0000-00-00 00:00:00'),
	(11, 'q5', '5XL', '0000-00-00 00:00:00'),
	(12, 'q6', '6XL', '0000-00-00 00:00:00'),
	(13, 'q7', '7XL', '0000-00-00 00:00:00'),
	(14, 'q8', '8XL', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `talles` ENABLE KEYS */;


-- Volcando estructura para tabla simple_stock.tmp
CREATE TABLE IF NOT EXISTS `tmp` (
  `id_tmp` int(11) NOT NULL AUTO_INCREMENT,
  `id_producto` int(11) DEFAULT NULL,
  `cantidad_tmp` int(11) DEFAULT NULL,
  `precio_tmp` double DEFAULT NULL,
  `session_id` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_tmp`),
  KEY `id_producto` (`id_producto`),
  CONSTRAINT `FK_tmp_products` FOREIGN KEY (`id_producto`) REFERENCES `products` (`id_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla simple_stock.tmp: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `tmp` DISABLE KEYS */;
/*!40000 ALTER TABLE `tmp` ENABLE KEYS */;


-- Volcando estructura para tabla simple_stock.users
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'auto incrementing user_id of each user, unique index',
  `firstname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `user_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s name, unique',
  `user_password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s password in salted and hashed format',
  `user_email` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s email, unique',
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`),
  UNIQUE KEY `user_email` (`user_email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data';

-- Volcando datos para la tabla simple_stock.users: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `user_name`, `user_password_hash`, `user_email`, `date_added`) VALUES
	(2, 'adm', 'adm', 'adm', '$2y$10$H9xqsEghlCKG5.sE0SG0tOUP2zLKg/cvCZQ1okmN.26RdeCIU5pji', 'maru.szwedowski@gmail.com', '2018-06-28 01:13:20'),
	(6, 'testing', 'testing', 'testing', '$2y$10$NKAZ9nXNjpDFuQ5Vb.TmO.sWbmdpWDofo7fzSsRQNlTSsykZ416AG', 'testing@testing.com', '2018-06-28 16:09:56'),
	(7, 'Dieguchu', 'Chu', 'diegu', '$2y$10$Aont6c1O1MH38BYMaoVEregFcm/Vu5XE4JSHoRe9PsqkSxio.PMGG', 'diegu@diegu.com', '2018-07-31 01:19:48');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

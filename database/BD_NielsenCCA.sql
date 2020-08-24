-- --------------------------------------------------------
-- Host:                         localhost
-- Versión del servidor:         5.7.24 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para nielsen_cca
CREATE DATABASE IF NOT EXISTS `nielsen_cca` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `nielsen_cca`;

-- Volcando estructura para tabla nielsen_cca.categorias
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla nielsen_cca.categorias: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
REPLACE INTO `categorias` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(2, 'GOLOSINAS', '2020-07-25 00:37:55', '2020-07-25 00:37:55'),
	(3, 'FIAMBRERIAS', '2020-07-25 00:38:02', '2020-07-25 00:38:02'),
	(4, 'LIMPIEZA', '2020-07-27 16:16:52', '2020-07-29 16:53:04'),
	(8, 'PANADERIA', '2020-07-30 19:26:41', '2020-07-30 19:26:41'),
	(9, 'ALMACEN', '2020-07-30 19:26:51', '2020-07-30 19:26:51'),
	(10, 'HIGIENE PERSONAL', '2020-07-30 19:27:03', '2020-07-30 19:27:03');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;

-- Volcando estructura para tabla nielsen_cca.clientes
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `documento` int(11) NOT NULL,
  `telefono` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `compras` int(11) unsigned DEFAULT '0',
  `agregado` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `clientes_documento_unique` (`documento`),
  UNIQUE KEY `clientes_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla nielsen_cca.clientes: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
REPLACE INTO `clientes` (`id`, `name`, `documento`, `telefono`, `email`, `direccion`, `fecha_nacimiento`, `compras`, `agregado`, `created_at`, `updated_at`) VALUES
	(2, 'Ernesto Guevara', 12908791, '(129) 8979-7898', 'ernesto@ernesto.com', 'Siempre viva 123', '2000-03-14', 0, '2020-08-03 11:54:10', '2020-08-03 11:54:10', '2020-08-03 12:12:55'),
	(3, 'Juana de arco', 423534, '(011) 2322-9897', 'juana@juana.com', 'Alfonsina 8766', '1876-12-12', 0, '2020-08-03 12:12:36', '2020-08-03 12:12:36', '2020-08-03 12:12:36'),
	(4, 'Juan Carlos', 23123443, '(011) 2312-3244', 'juancarlos@juan.com', 'Ayacucho 1242', '1956-12-12', 0, '2020-08-11 13:10:34', '2020-08-11 13:10:34', '2020-08-11 13:10:34');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;

-- Volcando estructura para tabla nielsen_cca.estados
CREATE TABLE IF NOT EXISTS `estados` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla nielsen_cca.estados: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `estados` DISABLE KEYS */;
REPLACE INTO `estados` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(0, 'Desactivado', '2020-07-24 20:26:13', '2020-07-24 20:26:14'),
	(1, 'Activado', '2020-07-24 20:26:14', '2020-07-24 20:27:30');
/*!40000 ALTER TABLE `estados` ENABLE KEYS */;

-- Volcando estructura para tabla nielsen_cca.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla nielsen_cca.migrations: ~9 rows (aproximadamente)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
REPLACE INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(3, '2020_07_14_153129_create_ajax_cruds_table', 2),
	(10, '2014_10_12_100000_create_password_resets_table', 3),
	(11, '2019_10_12_000000_create_users_table', 3),
	(12, '2020_07_17_153634_create_estados_table', 3),
	(13, '2020_07_17_162602_create_perfiles_table', 3),
	(14, '2020_07_23_145713_create_productos_table', 3),
	(15, '2020_07_23_145955_create_categorias_table', 3),
	(16, '2020_07_25_004909_alter_table_productos', 4),
	(18, '2020_07_25_010557_create_table_productos', 5),
	(20, '2020_07_31_123429_create_clientes_table', 6),
	(21, '2020_08_04_110001_create_table_ventas', 7);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Volcando estructura para tabla nielsen_cca.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla nielsen_cca.password_resets: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Volcando estructura para tabla nielsen_cca.perfiles
CREATE TABLE IF NOT EXISTS `perfiles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla nielsen_cca.perfiles: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `perfiles` DISABLE KEYS */;
REPLACE INTO `perfiles` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'Administrador', '2020-06-24 20:25:24', '2020-07-24 20:25:25'),
	(2, 'Especial', '2020-07-24 20:25:38', '2020-07-24 20:25:38'),
	(3, 'Vendedor', '2020-07-24 20:28:18', '2020-07-24 20:44:34');
/*!40000 ALTER TABLE `perfiles` ENABLE KEYS */;

-- Volcando estructura para tabla nielsen_cca.productos
CREATE TABLE IF NOT EXISTS `productos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_categoria` bigint(20) unsigned NOT NULL DEFAULT '0',
  `codigo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imagen` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'default.jpg',
  `stock` int(100) unsigned NOT NULL DEFAULT '0',
  `precio_compra` float NOT NULL DEFAULT '0',
  `precio_venta` float NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `agregado` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `productos_codigo_unique` (`codigo`),
  KEY `FK_productos_categorias` (`id_categoria`),
  CONSTRAINT `FK_productos_categorias` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla nielsen_cca.productos: ~12 rows (aproximadamente)
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
REPLACE INTO `productos` (`id`, `id_categoria`, `codigo`, `descripcion`, `imagen`, `stock`, `precio_compra`, `precio_venta`, `created_at`, `updated_at`, `agregado`) VALUES
	(5, 3, '201', 'Cortadora Especial 1.0 250w por minuto', '201.jpg', 12, 150, 210, '2020-07-27 03:18:07', '2020-08-17 13:28:28', '2020-08-17 00:00:00'),
	(7, 9, '401', 'Licuadora Matic', '1222343.jpg', 10, 1212, 1696.8, '2020-07-28 01:22:32', '2020-08-17 13:28:52', '2020-08-17 00:00:00'),
	(8, 2, '202', 'Aspiradora Dewo 250W', '12345612.png', 1212, 1212, 122, '2020-07-28 01:58:58', '2020-07-29 17:03:10', '2020-07-29 00:00:00'),
	(10, 3, '6666', 'Led Samsung 4K', '6666.JPG', 5, 1222, 16619.2, '2020-07-30 15:39:21', '2020-08-10 11:03:00', '2020-08-10 00:00:00'),
	(11, 4, '645343', 'Ayudin Ropa', '645343.jpg', 100, 100, 140, '2020-07-31 13:19:13', '2020-07-31 13:19:13', '2020-07-31 13:19:13'),
	(12, 9, '218987', 'Multiprocesadora Plavicon 200w 4500 rpm slow', '218987.jpg', 100, 1900, 2660, '2020-08-04 01:57:06', '2020-08-04 01:57:06', '2020-08-04 01:57:06'),
	(13, 3, '2323', 'Lavandina en gel', '2323.jpg', 1020, 1220, 1708, '2020-08-05 11:42:19', '2020-08-05 11:42:19', '2020-08-05 11:42:18'),
	(14, 4, '35443534', 'Alcohol en gel', 'default.jpg', 1213, 23, 32.2, '2020-08-05 11:42:44', '2020-08-05 11:42:44', '2020-08-05 11:42:44'),
	(15, 2, '325245', 'Caramelos sugus', '325245.jpg', 9, 989, 1384.6, '2020-08-05 11:43:19', '2020-08-05 11:43:19', '2020-08-05 11:43:19'),
	(16, 8, '1222343', '1 kilo de pan', 'default.jpg', 12, 12, 16.8, '2020-08-05 11:43:54', '2020-08-05 11:43:54', '2020-08-05 11:43:54'),
	(17, 10, '2222', 'Pepas PIGS', 'default.jpg', 1212, 12321, 17249.4, '2020-08-05 11:44:13', '2020-08-05 11:44:13', '2020-08-05 11:44:13'),
	(18, 3, '1234', 'Aspiradora Dewo 250W', '1234.jpg', 0, 1500, 2175, '2020-08-16 15:09:52', '2020-08-16 15:09:52', '2020-08-16 15:09:52');
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;

-- Volcando estructura para tabla nielsen_cca.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `perfil` bigint(20) unsigned DEFAULT NULL,
  `foto` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'default.png',
  `estado` bigint(10) unsigned NOT NULL DEFAULT '0',
  `ultima_login` datetime DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `FK_users_perfiles` (`perfil`),
  KEY `FK_users_estados` (`estado`),
  CONSTRAINT `FK_users_estados` FOREIGN KEY (`estado`) REFERENCES `estados` (`id`),
  CONSTRAINT `FK_users_perfiles` FOREIGN KEY (`perfil`) REFERENCES `perfiles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla nielsen_cca.users: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
REPLACE INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `perfil`, `foto`, `estado`, `ultima_login`, `remember_token`, `created_at`, `updated_at`) VALUES
	(6, 'Ezequiel Almeira', 'Ezequiel.Almeira', 'eze@eze.com', NULL, '$2y$10$VSuAqfhz/ULLiQgkQvfwAeOGCr/inKmmD2ZyYvmdKnpER4m2PqGXC', 1, 'Ezequiel.Almeira.jpg', 0, '2020-08-01 01:57:25', NULL, '2020-07-25 00:45:21', '2020-08-16 14:58:45'),
	(7, 'Administrador', 'Especial.Especial', 'admin@admin.com', NULL, '$2y$10$DTXDEguXlYOk38jJVP5jk.qNAiRHJrgvFqv/n5ImWGnvEU6wW55AC', 2, 'Especial.Especial.jpg', 1, '2020-08-17 13:25:31', NULL, '2020-07-28 02:08:22', '2020-08-17 13:25:31'),
	(8, 'lautaro coton', 'darkoelcapo', 'lautaro@lautaro.com', NULL, '$2y$10$hvAy8PJLlVGtNLVD.COLeuastg2uFYnnJp/Dq2ZAKfrbI8MEGSVp.', 1, 'default.png', 1, '2020-08-16 14:58:04', NULL, '2020-08-16 14:56:54', '2020-08-16 14:58:04');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Volcando estructura para tabla nielsen_cca.ventas
CREATE TABLE IF NOT EXISTS `ventas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` int(11) unsigned NOT NULL DEFAULT '10000',
  `id_cliente` bigint(20) unsigned NOT NULL DEFAULT '0',
  `id_vendedor` bigint(20) unsigned NOT NULL DEFAULT '0',
  `productos` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `impuesto` float NOT NULL DEFAULT '0',
  `neto` float NOT NULL DEFAULT '0',
  `total` float NOT NULL DEFAULT '0',
  `metodo_pago` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ventas_codigo_unique` (`codigo`),
  KEY `FK_ventas_clientes` (`id_cliente`),
  KEY `FK_ventas_users` (`id_vendedor`),
  CONSTRAINT `FK_ventas_clientes` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`),
  CONSTRAINT `FK_ventas_users` FOREIGN KEY (`id_vendedor`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla nielsen_cca.ventas: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `ventas` DISABLE KEYS */;
/*!40000 ALTER TABLE `ventas` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

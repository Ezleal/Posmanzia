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

-- Volcando estructura para tabla nielsen_cca.arqueos
CREATE TABLE IF NOT EXISTS `arqueos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_caja` int(10) unsigned NOT NULL,
  `id_user` bigint(20) unsigned NOT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `hora_inicio` time DEFAULT NULL,
  `fecha_cierre` date DEFAULT NULL,
  `hora_cierre` time DEFAULT NULL,
  `monto_inicio` decimal(10,2) DEFAULT NULL,
  `monto_cierre` decimal(10,2) DEFAULT NULL,
  `saldo_cierre` decimal(10,2) DEFAULT NULL,
  `cierre_caja` decimal(10,2) DEFAULT NULL,
  `observaciones` text,
  `total_ventas` int(11) DEFAULT NULL,
  `estado_caja` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_CAJA` (`id_caja`),
  KEY `FK_USER` (`id_user`),
  CONSTRAINT `FK_CAJA` FOREIGN KEY (`id_caja`) REFERENCES `cajas` (`id`),
  CONSTRAINT `FK_USER` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=latin1 COMMENT='Apertura y Cierre de caja\r\n';

-- Volcando datos para la tabla nielsen_cca.arqueos: ~14 rows (aproximadamente)
/*!40000 ALTER TABLE `arqueos` DISABLE KEYS */;
REPLACE INTO `arqueos` (`id`, `id_caja`, `id_user`, `fecha_inicio`, `hora_inicio`, `fecha_cierre`, `hora_cierre`, `monto_inicio`, `monto_cierre`, `saldo_cierre`, `cierre_caja`, `observaciones`, `total_ventas`, `estado_caja`, `created_at`, `updated_at`) VALUES
	(1, 1, 8, '2021-01-21', '11:23:28', '2021-01-21', '11:23:54', 0.00, 0.00, 0.00, 0.00, 'INICIO  DE ACTIVIDADES', 0, 0, '2021-01-21 11:23:10', '2021-01-21 11:23:12'),
	(59, 2, 7, '2021-01-21', '11:24:42', '2021-01-21', '11:34:16', 133.00, 133.00, 0.00, -133.00, NULL, 0, 0, '2021-01-21 11:32:39', '2021-01-21 11:34:16'),
	(60, 2, 7, '2021-01-21', '12:04:07', '2021-01-21', '12:15:10', 12332.00, 12332.00, 1221.00, -11111.00, NULL, 0, 0, '2021-01-21 12:04:13', '2021-01-21 12:15:10'),
	(61, 1, 7, '2021-01-21', '12:32:01', '2021-01-21', '12:32:40', 111.00, 111.00, 12121.00, 12010.00, NULL, 0, 0, '2021-01-21 12:32:11', '2021-01-21 12:32:40'),
	(62, 2, 7, '2021-01-21', '12:32:40', '2021-01-21', '12:32:55', 111.00, 111.00, 1212.00, 1101.00, NULL, 0, 0, '2021-01-21 12:32:48', '2021-01-21 12:32:55'),
	(63, 2, 7, '2021-01-21', '12:33:50', '2021-01-21', '12:36:39', 111.00, 111.00, 1212.00, 1101.00, NULL, 0, 0, '2021-01-21 12:33:56', '2021-01-21 12:36:39'),
	(64, 2, 7, '2021-01-21', '12:38:21', '2021-01-21', '12:39:45', 1.00, 1.00, 12332.00, 12331.00, NULL, 0, 0, '2021-01-21 12:38:33', '2021-01-21 12:39:45'),
	(65, 3, 7, '2021-01-21', '12:52:01', '2021-01-21', '12:57:41', 12223.00, 12223.00, 1212.00, -11011.00, 'Sin Observaciones', 0, 0, '2021-01-21 12:52:24', '2021-01-21 12:57:41'),
	(66, 1, 7, '2021-01-21', '12:57:48', '2021-01-21', '12:58:36', 444.00, 444.00, 500.00, 56.00, NULL, 0, 0, '2021-01-21 12:58:27', '2021-01-21 12:58:36'),
	(67, 2, 7, '2021-01-21', '13:00:27', '2021-01-21', '13:01:19', 1232.00, 1232.00, 12121.00, 10889.00, '12132', 0, 0, '2021-01-21 13:00:33', '2021-01-21 13:01:19'),
	(68, 2, 7, '2021-01-21', '13:06:15', '2021-01-21', '13:06:35', 12323.00, 12323.00, 100.00, -12223.00, NULL, 0, 0, '2021-01-21 13:06:23', '2021-01-21 13:06:35'),
	(69, 1, 7, '2021-01-22', '11:14:34', '2021-01-22', '11:15:26', 100.00, 247.62, 300.00, 52.38, 'Sin Observaciones', 1, 0, '2021-01-22 11:14:51', '2021-01-22 11:15:26'),
	(70, 2, 7, '2021-01-22', '11:17:07', '2021-01-22', '11:18:27', 12334.00, 12334.00, 2000.00, -10334.00, NULL, 0, 0, '2021-01-22 11:17:13', '2021-01-22 11:18:27'),
	(71, 2, 7, '2021-01-22', '11:21:05', NULL, NULL, 1221.00, NULL, NULL, NULL, NULL, NULL, 1, '2021-01-22 11:21:10', '2021-01-22 11:21:10'),
	(72, 2, 7, '2021-01-25', '11:27:23', '2021-01-25', '11:31:26', 1221.00, 1221.00, 2000.00, 779.00, NULL, 0, 0, '2021-01-25 11:27:30', '2021-01-25 11:31:26'),
	(73, 2, 7, '2021-01-25', '11:48:33', '2021-01-25', '16:11:43', 121.00, 120727.02, 13000.00, -107727.02, 'So', 19, 0, '2021-01-25 11:48:42', '2021-01-25 16:11:43'),
	(74, 1, 7, '2021-01-27', '15:15:40', NULL, NULL, 12332.00, NULL, NULL, NULL, NULL, NULL, 1, '2021-01-27 15:15:47', '2021-01-27 15:15:47');
/*!40000 ALTER TABLE `arqueos` ENABLE KEYS */;

-- Volcando estructura para tabla nielsen_cca.cajas
CREATE TABLE IF NOT EXISTS `cajas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `numero` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COMMENT='Apertura y cierre de caja';

-- Volcando datos para la tabla nielsen_cca.cajas: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `cajas` DISABLE KEYS */;
REPLACE INTO `cajas` (`id`, `numero`) VALUES
	(1, 1),
	(2, 2),
	(3, 3),
	(4, 4),
	(5, 5);
/*!40000 ALTER TABLE `cajas` ENABLE KEYS */;

-- Volcando estructura para tabla nielsen_cca.categorias
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla nielsen_cca.categorias: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
REPLACE INTO `categorias` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(2, 'GOLOSINAS', '2020-07-25 00:37:55', '2020-12-21 10:04:32'),
	(3, 'FIAMBRERIAS', '2020-07-25 00:38:02', '2020-07-25 00:38:02'),
	(4, 'LIMPIEZA', '2020-07-27 16:16:52', '2020-07-29 16:53:04'),
	(8, 'PANADERIA', '2020-07-30 19:26:41', '2020-07-30 19:26:41'),
	(9, 'ALMACEN', '2020-07-30 19:26:51', '2020-09-26 15:58:08'),
	(10, 'HIGIENE PERSONAL', '2020-07-30 19:27:03', '2020-07-30 19:27:03'),
	(11, 'Chocolates', '2021-01-19 14:13:01', '2021-01-19 14:13:01');
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
  `ultima_compra` datetime DEFAULT NULL,
  `agregado` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `clientes_documento_unique` (`documento`),
  UNIQUE KEY `clientes_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla nielsen_cca.clientes: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
REPLACE INTO `clientes` (`id`, `name`, `documento`, `telefono`, `email`, `direccion`, `fecha_nacimiento`, `compras`, `ultima_compra`, `agregado`, `created_at`, `updated_at`) VALUES
	(10, 'Gabriela Valenzuela', 32112443, '(011) 2232-1212', 'gabriela@gmail.com', 'Juan B Justo 4432', '1988-03-10', 29, '2021-01-27 15:49:36', '2020-12-18 15:41:33', '2020-12-18 15:41:33', '2021-01-27 15:49:36'),
	(11, 'Don Pepe', 4454212, '(011) 2434-4323', 'pepe@pepe.com', 'Donofre 2020', '1982-12-22', 35, '2021-01-27 15:53:16', '2020-12-18 15:52:02', '2020-12-18 15:52:02', '2021-01-27 15:53:16'),
	(12, 'Gerardo Gonzalez', 32321211, '(011) 2113-4232', 'gerardo@gerardo.com', 'Uspallate 1222', '1956-10-31', 20, '2021-01-27 15:54:45', '2020-12-18 15:55:40', '2020-12-18 15:55:40', '2021-01-27 15:54:45'),
	(13, 'Juana', 12343434, '(011) 2231-3321', 'juana@juana.com', 'Donato 12232', '1948-12-12', 20, '2021-01-25 15:35:21', '2020-12-18 15:58:04', '2020-12-18 15:58:04', '2021-01-25 15:35:21'),
	(14, 'lautaro WQW', 1212, '(113) 3212-332_', 'admin@admin.com', '23EEWR3', '1224-02-04', 3, '2021-01-25 14:50:04', '2021-01-18 15:02:33', '2021-01-18 15:02:33', '2021-01-25 14:50:04');
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
  `ventas` int(100) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `agregado` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `productos_codigo_unique` (`codigo`),
  KEY `FK_productos_categorias` (`id_categoria`),
  CONSTRAINT `FK_productos_categorias` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla nielsen_cca.productos: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
REPLACE INTO `productos` (`id`, `id_categoria`, `codigo`, `descripcion`, `imagen`, `stock`, `precio_compra`, `precio_venta`, `ventas`, `created_at`, `updated_at`, `agregado`) VALUES
	(5, 3, '201', 'Cortadora Especial 1.0 250w por minuto', '201.jpg', 0, 200, 280, 20, '2020-07-27 03:18:07', '2021-01-25 15:22:17', '2020-12-18 00:00:00'),
	(7, 9, '401', 'Licuadora Matic', '1222343.jpg', 11, 3000, 3900, 22, '2020-07-28 01:22:32', '2021-01-27 15:53:52', '2021-01-25 00:00:00'),
	(8, 2, '202', 'Aspiradora Dewo 250W', '12345612.png', 0, 299, 122, 20, '2020-07-28 01:58:58', '2021-01-27 15:52:44', '2020-11-27 00:00:00'),
	(10, 3, '6666', 'Led Samsung 4K', '6666.JPG', 5, 1400, 16619.2, 95, '2020-07-30 15:39:21', '2021-01-27 15:53:53', '2020-11-30 00:00:00'),
	(11, 4, '645343', 'Ayudin Ropa', '645343.jpg', 97, 100, 140, 3, '2020-07-31 13:19:13', '2021-01-25 15:35:21', '2020-11-26 00:00:00'),
	(12, 9, '218987', 'Multiprocesadora Plavicon 200w 4500 rpm slow', '218987.jpg', 90, 1900, 2660, 10, '2020-08-04 01:57:06', '2021-01-25 15:35:21', '2020-11-26 00:00:00'),
	(13, 2, '123432', 'Sugus', '123432.jpg', 88, 50, 70, 12, '2020-12-18 16:07:37', '2021-01-27 15:54:45', '2020-12-18 16:07:36'),
	(14, 2, '54653', 'Mogul', '54653.jpg', 161, 60, 84, 39, '2020-12-18 16:08:18', '2021-01-27 15:54:45', '2020-12-18 16:08:18'),
	(15, 3, '202222', 'Lisoform', 'default.jpg', 15, 23, 32.2, 7, '2020-12-21 16:26:17', '2021-01-27 15:49:36', '2020-12-21 16:26:17'),
	(16, 2, '45435', 'Licuadora Matic34', 'default.jpg', 0, 1222, 1710.8, 2, '2021-01-21 13:03:57', '2021-01-25 14:23:02', '2021-01-21 13:03:57');
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla nielsen_cca.users: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
REPLACE INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `perfil`, `foto`, `estado`, `ultima_login`, `remember_token`, `created_at`, `updated_at`) VALUES
	(6, 'Ezequiel Almeira', 'Ezequiel.Almeira', 'eze@eze.com', NULL, '$2y$10$oOS.ZKwotVv9SHZj1bQu5.fqAQLF43ZhoBZDo9iBBv.yxS0PL9H.6', 1, 'Ezequiel.Almeira.jpg', 1, '2020-12-14 16:23:33', NULL, '2020-07-25 00:45:21', '2021-01-14 15:08:20'),
	(7, 'Administrador', 'Especial.Especial', 'admin@admin.com', NULL, '$2y$10$DTXDEguXlYOk38jJVP5jk.qNAiRHJrgvFqv/n5ImWGnvEU6wW55AC', 1, 'Especial.Especial.jpg', 1, '2021-01-27 15:15:20', NULL, '2020-07-28 02:08:22', '2021-01-27 15:15:20'),
	(8, 'lautaro coton', 'darkoelcapo', 'lautaro@lautaro.com', NULL, '$2y$10$9YVfazqfdXkmv0Ji/43wu.dEcYEyiQFlp1k9yud7GQ9GXHQXlOywG', 3, 'default.png', 1, '2020-12-14 16:21:51', NULL, '2020-08-16 14:56:54', '2021-01-20 17:35:54'),
	(11, 'Roberto San', 'Roberto.Sanchez', 'sandro@sandro.com', NULL, '$2y$10$Skdb3pN..mMuI1Ab84DA8.MdThvoh.NOr6ikutAhibKrMmueKxinK', 1, 'Roberto.Sanchez.jpg', 1, NULL, NULL, '2021-01-14 15:11:59', '2021-01-20 17:14:24');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Volcando estructura para tabla nielsen_cca.ventas
CREATE TABLE IF NOT EXISTS `ventas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` int(11) unsigned NOT NULL DEFAULT '10000',
  `id_cliente` bigint(20) unsigned NOT NULL DEFAULT '0',
  `id_vendedor` bigint(20) unsigned NOT NULL DEFAULT '0',
  `productos` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `impuesto` float NOT NULL DEFAULT '0',
  `porcentaje` float DEFAULT '0',
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
) ENGINE=InnoDB AUTO_INCREMENT=227 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla nielsen_cca.ventas: ~59 rows (aproximadamente)
/*!40000 ALTER TABLE `ventas` DISABLE KEYS */;
REPLACE INTO `ventas` (`id`, `codigo`, `id_cliente`, `id_vendedor`, `productos`, `impuesto`, `porcentaje`, `neto`, `total`, `metodo_pago`, `fecha`, `created_at`, `updated_at`) VALUES
	(158, 10000, 12, 7, '[{"id":"10","descripcion":"Led Samsung 4K","cantidad":"1","stock":"6","precio":"16619.2","total":"16619.2"},{"id":"10","descripcion":"Led Samsung 4K","cantidad":"1","stock":"5","precio":"16619.2","total":"16619.2"}]', 6980.06, 21, 33238.4, 40218.5, 'Efectivo', '2021-01-27 15:53:53', '2021-01-21 10:46:11', '2021-01-27 15:53:53'),
	(159, 10001, 10, 7, '[{"id":"8","descripcion":"Aspiradora Dewo 250W","cantidad":"1","stock":"15","precio":"122","total":"122"},{"id":"5","descripcion":"Cortadora Especial 1.0 250w por minuto","cantidad":"1","stock":"19","precio":"280","total":"280"}]', 84.42, 21, 402, 486.42, 'Efectivo', '2021-01-21 10:51:08', '2021-01-21 10:51:08', '2021-01-21 10:51:08'),
	(160, 10002, 11, 7, '[{"id":"7","descripcion":"Licuadora Matic","cantidad":"1","stock":"9","precio":"3900","total":"3900"}]', 819, 21, 3900, 4719, 'TC-1212', '2021-01-27 15:53:16', '2021-01-21 10:51:20', '2021-01-27 15:53:16'),
	(161, 10003, 12, 7, '[{"id":"8","descripcion":"Aspiradora Dewo 250W","cantidad":"1","stock":"14","precio":"122","total":"122"}]', 25.62, 21, 122, 147.62, 'Efectivo', '2021-01-21 10:55:01', '2021-01-21 10:55:01', '2021-01-21 10:55:01'),
	(162, 10004, 12, 7, '[{"id":"13","descripcion":"Sugus","cantidad":"1","stock":"88","precio":"70","total":"70"}]', 14.7, 21, 70, 84.7, 'Efectivo', '2021-01-27 15:54:45', '2021-01-21 10:55:12', '2021-01-27 15:54:45'),
	(163, 10005, 10, 7, '[{"id":"12","descripcion":"Multiprocesadora Plavicon 200w 4500 rpm slow","cantidad":"6","stock":"92","precio":"2660","total":"15960"}]', 3351.6, 21, 15960, 19311.6, 'TC-2121', '2021-01-21 10:55:23', '2021-01-21 10:55:23', '2021-01-21 10:55:23'),
	(164, 10006, 11, 7, '[{"id":"7","descripcion":"Licuadora Matic","cantidad":"1","stock":"26","precio":"3900","total":"3900"},{"id":"10","descripcion":"Led Samsung 4K","cantidad":"1","stock":"20","precio":"16619.2","total":"16619.2"}]', 4309.03, 21, 20519.2, 24828.2, 'Efectivo', '2021-01-21 11:00:29', '2021-01-21 11:00:29', '2021-01-21 11:00:29'),
	(165, 10007, 12, 7, '[{"id":"7","descripcion":"Licuadora Matic","cantidad":"1","stock":"25","precio":"3900","total":"3900"}]', 819, 21, 3900, 4719, 'TC-1212', '2021-01-21 11:00:37', '2021-01-21 11:00:37', '2021-01-21 11:00:37'),
	(166, 10008, 10, 7, '[{"id":"7","descripcion":"Licuadora Matic","cantidad":"1","stock":"24","precio":"3900","total":"3900"}]', 819, 21, 3900, 4719, 'Efectivo', '2021-01-21 11:07:15', '2021-01-21 11:07:15', '2021-01-21 11:07:15'),
	(167, 10009, 11, 7, '[{"id":"13","descripcion":"Sugus","cantidad":"1","stock":"92","precio":"70","total":"70"}]', 14.7, 21, 70, 84.7, 'Efectivo', '2021-01-21 11:14:00', '2021-01-21 11:14:00', '2021-01-21 11:14:00'),
	(168, 10010, 13, 7, '[{"id":"15","descripcion":"Lisoform","cantidad":"1","stock":"17","precio":"32.2","total":"32.2"}]', 6.762, 21, 32.2, 38.962, 'Efectivo', '2021-01-21 11:14:10', '2021-01-21 11:14:10', '2021-01-21 11:14:10'),
	(169, 10011, 13, 7, '[{"id":"10","descripcion":"Led Samsung 4K","cantidad":"1","stock":"19","precio":"16619.2","total":"16619.2"}]', 3490.03, 21, 16619.2, 20109.2, 'TC-212', '2021-01-21 11:14:19', '2021-01-21 11:14:19', '2021-01-21 11:14:19'),
	(170, 10012, 11, 7, '[{"id":"8","descripcion":"Aspiradora Dewo 250W","cantidad":"1","stock":"13","precio":"122","total":"122"}]', 25.62, 21, 122, 147.62, 'Efectivo', '2021-01-22 11:15:05', '2021-01-22 11:15:05', '2021-01-22 11:15:05'),
	(171, 10013, 11, 7, '[{"id":"8","descripcion":"Aspiradora Dewo 250W","cantidad":"1","stock":"11","precio":"122","total":"122"},{"id":"7","descripcion":"Licuadora Matic","cantidad":"1","stock":"23","precio":"3900","total":"3900"}]', 844.62, 21, 4022, 4866.62, 'TC-22233', '2021-01-22 12:24:16', '2021-01-22 12:24:16', '2021-01-22 12:24:16'),
	(172, 10014, 10, 7, '[{"id":"10","descripcion":"Led Samsung 4K","cantidad":"1","stock":"18","precio":"16619.2","total":"16619.2"}]', 3490.03, 21, 16619.2, 20109.2, 'Efectivo', '2021-01-25 11:52:32', '2021-01-25 11:52:32', '2021-01-25 11:52:32'),
	(173, 10015, 12, 7, '[{"id":"16","descripcion":"Licuadora Matic34","cantidad":"1","stock":"1","precio":"1710.8","total":"1710.8"}]', 359.268, 21, 1710.8, 2070.07, 'Efectivo', '2021-01-25 12:01:13', '2021-01-25 12:01:13', '2021-01-25 12:01:13'),
	(174, 10016, 10, 7, '[{"id":"8","descripcion":"Aspiradora Dewo 250W","cantidad":"1","stock":"10","precio":"122","total":"122"}]', 25.62, 21, 122, 147.62, 'Efectivo', '2021-01-25 12:12:43', '2021-01-25 12:12:43', '2021-01-25 12:12:43'),
	(175, 10017, 10, 7, '[{"id":"7","descripcion":"Licuadora Matic","cantidad":"1","stock":"22","precio":"3900","total":"3900"}]', 819, 21, 3900, 4719, 'Efectivo', '2021-01-25 12:22:11', '2021-01-25 12:22:11', '2021-01-25 12:22:11'),
	(176, 10018, 13, 7, '[{"id":"8","descripcion":"Aspiradora Dewo 250W","cantidad":"1","stock":"9","precio":"122","total":"122"}]', 25.62, 21, 122, 147.62, 'TC-1221', '2021-01-25 12:26:02', '2021-01-25 12:26:02', '2021-01-25 12:26:02'),
	(179, 10019, 11, 7, '[{"id":"8","descripcion":"Aspiradora Dewo 250W","cantidad":"1","stock":"6","precio":"122","total":"122"}]', 0, 21, 0, 0, 'TC-1212', '2021-01-27 15:52:44', '2021-01-25 12:27:11', '2021-01-27 15:52:44'),
	(180, 10020, 13, 7, '[{"id":"8","descripcion":"Aspiradora Dewo 250W","cantidad":"1","stock":"5","precio":"122","total":"122"}]', 25.62, 21, 122, 147.62, 'TC-1212', '2021-01-25 12:27:49', '2021-01-25 12:27:49', '2021-01-25 12:27:49'),
	(181, 10021, 11, 7, '[{"id":"8","descripcion":"Aspiradora Dewo 250W","cantidad":"1","stock":"4","precio":"122","total":"122"}]', 25.62, 21, 122, 147.62, 'TD-7887', '2021-01-25 12:29:50', '2021-01-25 12:29:50', '2021-01-25 12:29:50'),
	(183, 10022, 10, 7, '[{"id":"5","descripcion":"Cortadora Especial 1.0 250w por minuto","cantidad":"1","stock":"18","precio":"280","total":"280"}]', 58.8, 21, 280, 338.8, 'Efectivo', '2021-01-25 13:44:58', '2021-01-25 13:44:58', '2021-01-25 13:44:58'),
	(184, 10023, 11, 7, '[{"id":"7","descripcion":"Licuadora Matic","cantidad":"1","stock":"21","precio":"3900","total":"3900"}]', 819, 21, 3900, 4719, 'Efectivo', '2021-01-25 13:45:39', '2021-01-25 13:45:39', '2021-01-25 13:45:39'),
	(186, 10024, 11, 7, '[{"id":"8","descripcion":"Aspiradora Dewo 250W","cantidad":"1","stock":"2","precio":"122","total":"122"}]', 25.62, 21, 122, 147.62, 'Efectivo', '2021-01-25 13:46:13', '2021-01-25 13:46:13', '2021-01-25 13:46:13'),
	(187, 10025, 10, 7, '[{"id":"7","descripcion":"Licuadora Matic","cantidad":"1","stock":"19","precio":"3900","total":"3900"}]', 819, 21, 3900, 4719, 'Efectivo', '2021-01-25 13:47:04', '2021-01-25 13:47:04', '2021-01-25 13:47:04'),
	(188, 10026, 11, 7, '[{"id":"8","descripcion":"Aspiradora Dewo 250W","cantidad":"1","stock":"1","precio":"122","total":"122"}]', 25.62, 21, 122, 147.62, 'Efectivo', '2021-01-25 13:47:36', '2021-01-25 13:47:36', '2021-01-25 13:47:36'),
	(189, 10027, 11, 7, '[{"id":"7","descripcion":"Licuadora Matic","cantidad":"1","stock":"18","precio":"3900","total":"3900"},{"id":"10","descripcion":"Led Samsung 4K","cantidad":"1","stock":"17","precio":"16619.2","total":"16619.2"}]', 4309.03, 21, 20519.2, 24828.2, 'TC-12212', '2021-01-25 13:53:58', '2021-01-25 13:53:58', '2021-01-25 13:53:58'),
	(191, 10028, 10, 7, '[{"id":"8","descripcion":"Aspiradora Dewo 250W","cantidad":"1","stock":"0","precio":"122","total":"122"}]', 25.62, 21, 122, 147.62, 'Efectivo', '2021-01-25 13:57:33', '2021-01-25 13:57:33', '2021-01-25 13:57:33'),
	(192, 10029, 10, 7, '[{"id":"7","descripcion":"Licuadora Matic","cantidad":"1","stock":"17","precio":"3900","total":"3900"}]', 819, 21, 3900, 4719, 'TC-121212', '2021-01-25 14:01:05', '2021-01-25 14:01:05', '2021-01-25 14:01:05'),
	(193, 10030, 11, 7, '[{"id":"7","descripcion":"Licuadora Matic","cantidad":"1","stock":"16","precio":"3900","total":"3900"}]', 819, 21, 3900, 4719, 'TC-12133', '2021-01-25 14:12:25', '2021-01-25 14:12:25', '2021-01-25 14:12:25'),
	(194, 10031, 11, 7, '[{"id":"5","descripcion":"Cortadora Especial 1.0 250w por minuto","cantidad":"1","stock":"17","precio":"280","total":"280"}]', 58.8, 21, 280, 338.8, 'TC-2323', '2021-01-25 14:15:44', '2021-01-25 14:15:44', '2021-01-25 14:15:44'),
	(195, 10032, 11, 7, '[{"id":"7","descripcion":"Licuadora Matic","cantidad":"1","stock":"15","precio":"3900","total":"3900"}]', 819, 21, 3900, 4719, 'Efectivo', '2021-01-25 14:16:26', '2021-01-25 14:16:26', '2021-01-25 14:16:26'),
	(196, 10033, 11, 7, '[{"id":"16","descripcion":"Licuadora Matic34","cantidad":"1","stock":"0","precio":"1710.8","total":"1710.8"},{"id":"14","descripcion":"Mogul","cantidad":"1","stock":"175","precio":"84","total":"84"}]', 376.908, 21, 1794.8, 2171.71, 'Efectivo', '2021-01-25 14:23:03', '2021-01-25 14:23:03', '2021-01-25 14:23:03'),
	(197, 10034, 13, 7, '[{"id":"7","descripcion":"Licuadora Matic","cantidad":"1","stock":"14","precio":"3900","total":"3900"},{"id":"10","descripcion":"Led Samsung 4K","cantidad":"1","stock":"15","precio":"16619.2","total":"16619.2"}]', 4309.03, 21, 20519.2, 24828.2, 'Efectivo', '2021-01-25 14:27:57', '2021-01-25 14:27:57', '2021-01-25 14:27:57'),
	(198, 10035, 11, 7, '[{"id":"5","descripcion":"Cortadora Especial 1.0 250w por minuto","cantidad":"1","stock":"16","precio":"280","total":"280"}]', 58.8, 21, 280, 338.8, 'Efectivo', '2021-01-25 14:28:33', '2021-01-25 14:28:33', '2021-01-25 14:28:33'),
	(200, 10036, 12, 7, '[{"id":"5","descripcion":"Cortadora Especial 1.0 250w por minuto","cantidad":"1","stock":"14","precio":"280","total":"280"}]', 58.8, 21, 280, 338.8, 'TD-2321', '2021-01-25 14:30:23', '2021-01-25 14:30:23', '2021-01-25 14:30:23'),
	(201, 10037, 14, 7, '[{"id":"5","descripcion":"Cortadora Especial 1.0 250w por minuto","cantidad":"1","stock":"13","precio":"280","total":"280"}]', 58.8, 21, 280, 338.8, 'TC-21212', '2021-01-25 14:30:52', '2021-01-25 14:30:52', '2021-01-25 14:30:52'),
	(202, 10038, 11, 7, '[{"id":"5","descripcion":"Cortadora Especial 1.0 250w por minuto","cantidad":"1","stock":"12","precio":"280","total":"280"}]', 58.8, 21, 280, 338.8, 'TD-12121', '2021-01-25 14:48:43', '2021-01-25 14:48:43', '2021-01-25 14:48:43'),
	(203, 10039, 14, 7, '[{"id":"5","descripcion":"Cortadora Especial 1.0 250w por minuto","cantidad":"1","stock":"11","precio":"280","total":"280"}]', 58.8, 21, 280, 338.8, 'TC-2323', '2021-01-25 14:49:44', '2021-01-25 14:49:44', '2021-01-25 14:49:44'),
	(205, 10040, 11, 7, '[{"id":"5","descripcion":"Cortadora Especial 1.0 250w por minuto","cantidad":"1","stock":"9","precio":"280","total":"280"}]', 58.8, 21, 280, 338.8, 'TC-2323', '2021-01-25 14:50:16', '2021-01-25 14:50:16', '2021-01-25 14:50:16'),
	(206, 10041, 11, 7, '[{"id":"5","descripcion":"Cortadora Especial 1.0 250w por minuto","cantidad":"1","stock":"8","precio":"280","total":"280"}]', 58.8, 21, 280, 338.8, 'TC-7887', '2021-01-25 14:50:36', '2021-01-25 14:50:36', '2021-01-25 14:50:36'),
	(207, 10042, 13, 7, '[{"id":"5","descripcion":"Cortadora Especial 1.0 250w por minuto","cantidad":"1","stock":"7","precio":"280","total":"280"}]', 58.8, 21, 280, 338.8, 'TD-2323', '2021-01-25 14:53:26', '2021-01-25 14:53:26', '2021-01-25 14:53:26'),
	(208, 10043, 11, 7, '[{"id":"5","descripcion":"Cortadora Especial 1.0 250w por minuto","cantidad":"1","stock":"6","precio":"280","total":"280"}]', 58.8, 21, 280, 338.8, 'TC-1212', '2021-01-25 14:56:40', '2021-01-25 14:56:40', '2021-01-25 14:56:40'),
	(209, 10044, 11, 7, '[{"id":"5","descripcion":"Cortadora Especial 1.0 250w por minuto","cantidad":"1","stock":"5","precio":"280","total":"280"}]', 58.8, 21, 280, 338.8, 'Efectivo', '2021-01-25 14:57:43', '2021-01-25 14:57:43', '2021-01-25 14:57:43'),
	(210, 10045, 12, 7, '[{"id":"5","descripcion":"Cortadora Especial 1.0 250w por minuto","cantidad":"1","stock":"4","precio":"280","total":"280"}]', 58.8, 21, 280, 338.8, 'TC-232323', '2021-01-25 14:58:25', '2021-01-25 14:58:25', '2021-01-25 14:58:25'),
	(211, 10046, 11, 7, '[{"id":"7","descripcion":"Licuadora Matic","cantidad":"1","stock":"13","precio":"3900","total":"3900"}]', 819, 21, 3900, 4719, 'Efectivo', '2021-01-25 15:05:53', '2021-01-25 15:05:53', '2021-01-25 15:05:53'),
	(212, 10047, 13, 7, '[{"id":"5","descripcion":"Cortadora Especial 1.0 250w por minuto","cantidad":"1","stock":"3","precio":"280","total":"280"}]', 58.8, 21, 280, 338.8, 'TC-232', '2021-01-25 15:07:03', '2021-01-25 15:07:03', '2021-01-25 15:07:03'),
	(213, 10048, 13, 7, '[{"id":"5","descripcion":"Cortadora Especial 1.0 250w por minuto","cantidad":"1","stock":"2","precio":"280","total":"280"},{"id":"10","descripcion":"Led Samsung 4K","cantidad":"1","stock":"14","precio":"16619.2","total":"16619.2"}]', 3548.83, 21, 16899.2, 20448, 'Efectivo', '2021-01-25 15:08:59', '2021-01-25 15:08:59', '2021-01-25 15:08:59'),
	(214, 10049, 12, 7, '[{"id":"10","descripcion":"Led Samsung 4K","cantidad":"1","stock":"13","precio":"16619.2","total":"16619.2"},{"id":"7","descripcion":"Licuadora Matic","cantidad":"1","stock":"12","precio":"3900","total":"3900"}]', 4309.03, 21, 20519.2, 24828.2, 'TC-12121', '2021-01-25 15:14:32', '2021-01-25 15:14:32', '2021-01-25 15:14:32'),
	(215, 10050, 11, 7, '[{"id":"10","descripcion":"Led Samsung 4K","cantidad":"1","stock":"12","precio":"16619.2","total":"16619.2"},{"id":"7","descripcion":"Licuadora Matic","cantidad":"1","stock":"11","precio":"3900","total":"3900"}]', 4309.03, 21, 20519.2, 24828.2, 'TD-2323', '2021-01-25 15:16:41', '2021-01-25 15:16:41', '2021-01-25 15:16:41'),
	(217, 10051, 10, 7, '[{"id":"5","descripcion":"Cortadora Especial 1.0 250w por minuto","cantidad":"1","stock":"1","precio":"280","total":"280"},{"id":"14","descripcion":"Mogul","cantidad":"1","stock":"174","precio":"84","total":"84"}]', 76.44, 21, 364, 440.44, 'Efectivo', '2021-01-25 15:19:48', '2021-01-25 15:19:48', '2021-01-25 15:19:48'),
	(218, 10052, 12, 7, '[{"id":"7","descripcion":"Licuadora Matic","cantidad":"1","stock":"9","precio":"3900","total":"3900"}]', 819, 21, 3900, 4719, 'TC-1212', '2021-01-25 15:20:56', '2021-01-25 15:20:56', '2021-01-25 15:20:56'),
	(219, 10053, 12, 7, '[{"id":"5","descripcion":"Cortadora Especial 1.0 250w por minuto","cantidad":"1","stock":"0","precio":"280","total":"280"}]', 58.8, 21, 280, 338.8, 'TC-12232', '2021-01-25 15:22:17', '2021-01-25 15:22:17', '2021-01-25 15:22:17'),
	(220, 10054, 11, 7, '[{"id":"10","descripcion":"Led Samsung 4K","cantidad":"1","stock":"10","precio":"16619.2","total":"16619.2"}]', 3490.03, 21, 16619.2, 20109.2, 'TC-1212', '2021-01-25 15:23:00', '2021-01-25 15:23:00', '2021-01-25 15:23:00'),
	(221, 10055, 13, 7, '[{"id":"14","descripcion":"Mogul","cantidad":"5","stock":"169","precio":"84","total":"420"}]', 88.2, 21, 420, 508.2, 'TC-1212121', '2021-01-25 15:26:28', '2021-01-25 15:26:28', '2021-01-25 15:26:28'),
	(222, 10056, 12, 7, '[{"id":"7","descripcion":"Licuadora Matic","cantidad":"1","stock":"8","precio":"3900","total":"3900"},{"id":"10","descripcion":"Led Samsung 4K","cantidad":"1","stock":"9","precio":"16619.2","total":"16619.2"},{"id":"15","descripcion":"Lisoform","cantidad":"1","stock":"16","precio":"32.2","total":"32.2"},{"id":"14","descripcion":"Mogul","cantidad":"1","stock":"168","precio":"84","total":"84"},{"id":"13","descripcion":"Sugus","cantidad":"1","stock":"91","precio":"70","total":"70"},{"id":"12","descripcion":"Multiprocesadora Plavicon 200w 4500 rpm slow","cantidad":"1","stock":"91","precio":"2660","total":"2660"},{"id":"11","descripcion":"Ayudin Ropa","cantidad":"1","stock":"98","precio":"140","total":"140"}]', 4936.13, 21, 23505.4, 28441.5, 'TC-30000', '2021-01-25 15:31:14', '2021-01-25 15:31:14', '2021-01-25 15:31:14'),
	(223, 10057, 10, 7, '[{"id":"14","descripcion":"Mogul","cantidad":"5","stock":"163","precio":"84","total":"420"},{"id":"10","descripcion":"Led Samsung 4K","cantidad":"1","stock":"8","precio":"16619.2","total":"16619.2"},{"id":"7","descripcion":"Licuadora Matic","cantidad":"1","stock":"7","precio":"3900","total":"3900"}]', 4397.23, 21, 20939.2, 25336.4, 'Efectivo', '2021-01-25 15:33:57', '2021-01-25 15:33:57', '2021-01-25 15:33:57'),
	(224, 10058, 13, 7, '[{"id":"14","descripcion":"Mogul","cantidad":"1","stock":"162","precio":"84","total":"84"},{"id":"13","descripcion":"Sugus","cantidad":"1","stock":"90","precio":"70","total":"70"},{"id":"12","descripcion":"Multiprocesadora Plavicon 200w 4500 rpm slow","cantidad":"1","stock":"90","precio":"2660","total":"2660"},{"id":"11","descripcion":"Ayudin Ropa","cantidad":"1","stock":"97","precio":"140","total":"140"}]', 620.34, 21, 2954, 3574.34, 'TC-31232', '2021-01-25 15:35:21', '2021-01-25 15:35:21', '2021-01-25 15:35:21'),
	(225, 10059, 12, 7, '[{"id":"10","descripcion":"Led Samsung 4K","cantidad":"1","stock":"7","precio":"16619.2","total":"16619.2"},{"id":"14","descripcion":"Mogul","cantidad":"1","stock":"161","precio":"84","total":"84"}]', 3507.67, 21, 16703.2, 20210.9, 'TD-7887', '2021-01-27 15:42:26', '2021-01-27 15:42:26', '2021-01-27 15:42:26'),
	(226, 10060, 10, 7, '[{"id":"14","descripcion":"Mogul","cantidad":"1","stock":"160","precio":"84","total":"84"},{"id":"15","descripcion":"Lisoform","cantidad":"1","stock":"15","precio":"32.2","total":"32.2"},{"id":"13","descripcion":"Sugus","cantidad":"1","stock":"89","precio":"70","total":"70"},{"id":"10","descripcion":"Led Samsung 4K","cantidad":"1","stock":"6","precio":"16619.2","total":"16619.2"}]', 3529.13, 21, 16805.4, 20334.5, 'Efectivo', '2021-01-27 15:49:36', '2021-01-27 15:49:36', '2021-01-27 15:49:36');
/*!40000 ALTER TABLE `ventas` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

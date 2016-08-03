-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.6.24 - MySQL Community Server (GPL)
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura de base de datos para alquilerautos
DROP DATABASE IF EXISTS `alquilerautos`;
CREATE DATABASE IF NOT EXISTS `alquilerautos` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci */;
USE `alquilerautos`;


-- Volcando estructura para tabla alquilerautos.alquilers
DROP TABLE IF EXISTS `alquilers`;
CREATE TABLE IF NOT EXISTS `alquilers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `FechaDeRegistro` date NOT NULL,
  `FechaDeEntregaPrevisto` date NOT NULL,
  `FechaDeEntrega` date DEFAULT NULL,
  `pago` decimal(8,2) NOT NULL,
  `idVehiiculo` int(10) unsigned NOT NULL,
  `idEstadoAlquiler` int(10) unsigned NOT NULL,
  `idUsuario` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `alquilers_idvehiiculo_foreign` (`idVehiiculo`),
  KEY `alquilers_idestadoalquiler_foreign` (`idEstadoAlquiler`),
  KEY `alquilers_idusuario_foreign` (`idUsuario`),
  CONSTRAINT `alquilers_idestadoalquiler_foreign` FOREIGN KEY (`idEstadoAlquiler`) REFERENCES `estado_alquilers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `alquilers_idusuario_foreign` FOREIGN KEY (`idUsuario`) REFERENCES `clientes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `alquilers_idvehiiculo_foreign` FOREIGN KEY (`idVehiiculo`) REFERENCES `vehiculos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla alquilerautos.alquilers: ~3 rows (aproximadamente)
DELETE FROM `alquilers`;
/*!40000 ALTER TABLE `alquilers` DISABLE KEYS */;
INSERT INTO `alquilers` (`id`, `FechaDeRegistro`, `FechaDeEntregaPrevisto`, `FechaDeEntrega`, `pago`, `idVehiiculo`, `idEstadoAlquiler`, `idUsuario`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, '2015-11-09', '2015-11-30', '2015-11-12', 75.00, 1, 2, 1, '2015-11-09 00:43:37', '2015-11-11 01:37:07', NULL),
	(2, '2015-11-10', '2015-11-12', '2015-11-12', 32.00, 2, 1, 2, '2015-11-10 19:28:50', '2015-11-11 01:36:46', NULL),
	(3, '2015-11-10', '2015-11-11', '2015-11-12', 32.00, 2, 2, 2, '2015-11-10 22:51:49', '2015-11-11 00:07:20', NULL);
/*!40000 ALTER TABLE `alquilers` ENABLE KEYS */;


-- Volcando estructura para tabla alquilerautos.clientes
DROP TABLE IF EXISTS `clientes`;
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `PrimerNombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `SegundoNombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `PrimerApellido` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `SegundoApellido` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `genero` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `nDocumento` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `Telefono` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `EstadoD` varchar(110) COLLATE utf8_spanish_ci NOT NULL,
  `DireccionEspecifica` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `CodigoPostal` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `FechaDeNacimiento` date NOT NULL,
  `idPaisUser` int(10) unsigned NOT NULL,
  `idTipoUsuario` int(10) unsigned NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `clientes_ndocumento_unique` (`nDocumento`),
  UNIQUE KEY `clientes_telefono_unique` (`Telefono`),
  KEY `clientes_idpaisuser_foreign` (`idPaisUser`),
  KEY `clientes_idtipousuario_foreign` (`idTipoUsuario`),
  CONSTRAINT `clientes_idpaisuser_foreign` FOREIGN KEY (`idPaisUser`) REFERENCES `pais` (`id`),
  CONSTRAINT `clientes_idtipousuario_foreign` FOREIGN KEY (`idTipoUsuario`) REFERENCES `tipo_usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla alquilerautos.clientes: ~3 rows (aproximadamente)
DELETE FROM `clientes`;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` (`id`, `PrimerNombre`, `SegundoNombre`, `PrimerApellido`, `SegundoApellido`, `genero`, `nDocumento`, `Telefono`, `EstadoD`, `DireccionEspecifica`, `CodigoPostal`, `estado`, `FechaDeNacimiento`, `idPaisUser`, `idTipoUsuario`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Alexander', 'Leonardo ', 'Domínguez', 'Pascacio', 'M', '123456789', '79496110', 'La Paz, Olocuilta', 'Carretera Antigua a Zacatecoluca KM 19 y 3 cuartos', '00000', 1, '1994-07-14', 65, 3, NULL, '2015-11-09 00:40:23', '2015-11-09 00:44:32', NULL),
	(2, 'Rudy', 'Ulises', 'Chavez', 'Hernandez', 'M', '789123458', '78541265', 'San Salvador, Apopa', 'OLOCUILTA La Paz Carretera Antigua a Zacatecoluca KM 20', '00000', 1, '1997-11-09', 65, 2, NULL, '2015-11-09 23:52:49', '2015-11-11 01:36:45', NULL),
	(3, 'Brenda', 'Martiza', 'Beltran', 'Bonilla', 'F', '498731621', '79496112', 'La Paz, Cuyultitán', 'Calle 3 Av 4', '00000', 1, '1993-07-14', 65, 3, NULL, '2015-11-10 00:45:28', '2015-11-10 01:29:54', '2015-11-10 01:29:54');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;


-- Volcando estructura para tabla alquilerautos.colors
DROP TABLE IF EXISTS `colors`;
CREATE TABLE IF NOT EXISTS `colors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla alquilerautos.colors: ~18 rows (aproximadamente)
DELETE FROM `colors`;
/*!40000 ALTER TABLE `colors` DISABLE KEYS */;
INSERT INTO `colors` (`id`, `Nombre`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Azul', '2015-11-09 00:34:40', '2015-11-09 22:52:22', NULL),
	(2, 'Negro', '2015-11-09 00:34:40', '2015-11-09 22:52:53', NULL),
	(3, 'Rojo', '2015-11-09 00:34:40', '2015-11-09 23:09:08', '2015-11-09 23:09:08'),
	(4, 'Celeste', '2015-11-09 00:34:41', '2015-11-11 01:36:46', NULL),
	(5, 'Morado', '2015-11-09 22:19:02', '2015-11-09 22:22:43', '2015-11-09 22:22:43'),
	(6, 'd', '2015-11-10 22:57:32', '2015-11-10 22:57:32', NULL),
	(7, 'dsaasdasdasdads', '2015-11-10 22:57:36', '2015-11-10 22:57:36', NULL),
	(8, 'gdgd', '2015-11-10 22:57:41', '2015-11-10 22:57:41', NULL),
	(9, 'gdgdggf', '2015-11-10 22:57:45', '2015-11-10 22:57:45', NULL),
	(10, 'ghgfh', '2015-11-10 22:57:52', '2015-11-10 22:57:52', NULL),
	(11, 'eqweq', '2015-11-10 22:57:55', '2015-11-10 22:57:55', NULL),
	(12, 'dadasd', '2015-11-10 22:57:58', '2015-11-10 22:57:58', NULL),
	(13, 'eqweqewq', '2015-11-10 22:58:02', '2015-11-10 22:58:02', NULL),
	(14, 'zczxczxc', '2015-11-10 22:58:06', '2015-11-10 22:58:06', NULL),
	(15, 'sdadsaggh', '2015-11-10 22:58:10', '2015-11-10 22:58:10', NULL),
	(16, 'nvbnbvnvnbvv', '2015-11-10 22:58:13', '2015-11-10 22:58:13', NULL),
	(17, 'nvbnnvnvvvnv', '2015-11-10 22:58:18', '2015-11-10 22:58:18', NULL),
	(18, 'nvbvvnvnvnbbvnbv', '2015-11-10 22:58:25', '2015-11-10 22:58:25', NULL);
/*!40000 ALTER TABLE `colors` ENABLE KEYS */;


-- Volcando estructura para tabla alquilerautos.condicions
DROP TABLE IF EXISTS `condicions`;
CREATE TABLE IF NOT EXISTS `condicions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla alquilerautos.condicions: ~3 rows (aproximadamente)
DELETE FROM `condicions`;
/*!40000 ALTER TABLE `condicions` DISABLE KEYS */;
INSERT INTO `condicions` (`id`, `Nombre`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Disponible', '2015-11-09 00:34:41', '2015-11-09 00:34:41', NULL),
	(2, 'Ocupado', '2015-11-09 00:34:41', '2015-11-09 00:34:41', NULL),
	(3, 'En Mantenimiento', '2015-11-09 00:34:41', '2015-11-09 00:34:41', NULL);
/*!40000 ALTER TABLE `condicions` ENABLE KEYS */;


-- Volcando estructura para tabla alquilerautos.estado_alquilers
DROP TABLE IF EXISTS `estado_alquilers`;
CREATE TABLE IF NOT EXISTS `estado_alquilers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla alquilerautos.estado_alquilers: ~3 rows (aproximadamente)
DELETE FROM `estado_alquilers`;
/*!40000 ALTER TABLE `estado_alquilers` DISABLE KEYS */;
INSERT INTO `estado_alquilers` (`id`, `Nombre`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 'En Curso', NULL, '2015-11-09 00:34:41', '2015-11-09 00:34:41'),
	(2, 'Completado', NULL, '2015-11-09 00:34:41', '2015-11-09 00:34:41'),
	(3, 'Cancelado', NULL, '2015-11-09 00:34:41', '2015-11-09 00:34:41');
/*!40000 ALTER TABLE `estado_alquilers` ENABLE KEYS */;


-- Volcando estructura para tabla alquilerautos.marcas
DROP TABLE IF EXISTS `marcas`;
CREATE TABLE IF NOT EXISTS `marcas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombreMarca` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla alquilerautos.marcas: ~2 rows (aproximadamente)
DELETE FROM `marcas`;
/*!40000 ALTER TABLE `marcas` DISABLE KEYS */;
INSERT INTO `marcas` (`id`, `nombreMarca`, `estado`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Ferrari', 1, '2015-11-09 00:41:28', '2015-11-09 00:41:28', NULL),
	(2, 'Toyota', 1, '2015-11-09 00:41:43', '2015-11-11 01:36:45', NULL),
	(3, 'Nisan', 1, '2015-11-09 11:52:16', '2015-11-09 13:21:00', NULL);
/*!40000 ALTER TABLE `marcas` ENABLE KEYS */;


-- Volcando estructura para tabla alquilerautos.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla alquilerautos.migrations: ~12 rows (aproximadamente)
DELETE FROM `migrations`;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`migration`, `batch`) VALUES
	('2014_10_12_100000_create_password_resets_table', 1),
	('2015_10_15_102916_create_marcas_table', 1),
	('2015_10_17_222943_create_colors_table', 1),
	('2015_10_17_223008_create_condicions_table', 1),
	('2015_10_17_223121_create_pais_table', 1),
	('2015_10_17_223156_create_estado_alquilers_table', 1),
	('2015_10_17_223221_create_tipo_usuarios_table', 1),
	('2015_10_27_170850_create_modelos_table', 1),
	('2015_10_27_171051_create_users_table', 1),
	('2015_10_27_171157_create_vehiculos_table', 1),
	('2015_11_04_011419_create_clientes_table', 1),
	('2015_11_07_174407__create_alquilers_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;


-- Volcando estructura para tabla alquilerautos.modelos
DROP TABLE IF EXISTS `modelos`;
CREATE TABLE IF NOT EXISTS `modelos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `idMarca` int(10) unsigned NOT NULL,
  `Estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `modelos_idmarca_foreign` (`idMarca`),
  CONSTRAINT `modelos_idmarca_foreign` FOREIGN KEY (`idMarca`) REFERENCES `marcas` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla alquilerautos.modelos: ~2 rows (aproximadamente)
DELETE FROM `modelos`;
/*!40000 ALTER TABLE `modelos` DISABLE KEYS */;
INSERT INTO `modelos` (`id`, `Nombre`, `idMarca`, `Estado`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Corola delux', 2, 1, '2015-11-09 00:42:07', '2015-11-11 01:36:45', NULL),
	(2, 'centra', 3, 1, '2015-11-09 12:44:49', '2015-11-11 01:28:19', NULL);
/*!40000 ALTER TABLE `modelos` ENABLE KEYS */;


-- Volcando estructura para tabla alquilerautos.pais
DROP TABLE IF EXISTS `pais`;
CREATE TABLE IF NOT EXISTS `pais` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=255 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla alquilerautos.pais: ~254 rows (aproximadamente)
DELETE FROM `pais`;
/*!40000 ALTER TABLE `pais` DISABLE KEYS */;
INSERT INTO `pais` (`id`, `Nombre`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 'Afganistán', NULL, '2015-11-09 00:34:41', '2015-11-09 00:34:41'),
	(2, 'Akrotiri', NULL, '2015-11-09 00:34:41', '2015-11-09 00:34:41'),
	(3, 'Albania', NULL, '2015-11-09 00:34:41', '2015-11-09 00:34:41'),
	(4, 'Alemania', NULL, '2015-11-09 00:34:41', '2015-11-09 00:34:41'),
	(5, 'Andorra', NULL, '2015-11-09 00:34:41', '2015-11-09 00:34:41'),
	(6, 'Angola', NULL, '2015-11-09 00:34:41', '2015-11-09 00:34:41'),
	(7, 'Anguila', NULL, '2015-11-09 00:34:41', '2015-11-09 00:34:41'),
	(8, 'Antártida', NULL, '2015-11-09 00:34:41', '2015-11-09 00:34:41'),
	(9, 'Antigua y Barbuda', NULL, '2015-11-09 00:34:41', '2015-11-09 00:34:41'),
	(10, 'Antillas Neerlandesas', NULL, '2015-11-09 00:34:41', '2015-11-09 00:34:41'),
	(11, 'Arabia Saudí', NULL, '2015-11-09 00:34:41', '2015-11-09 00:34:41'),
	(12, 'Arctic Ocean', NULL, '2015-11-09 00:34:41', '2015-11-09 00:34:41'),
	(13, 'Argelia', NULL, '2015-11-09 00:34:41', '2015-11-09 00:34:41'),
	(14, 'Argentina', NULL, '2015-11-09 00:34:41', '2015-11-09 00:34:41'),
	(15, 'Armenia', NULL, '2015-11-09 00:34:42', '2015-11-09 00:34:42'),
	(16, 'Aruba', NULL, '2015-11-09 00:34:42', '2015-11-09 00:34:42'),
	(17, 'Ashmore andCartier Islands', NULL, '2015-11-09 00:34:42', '2015-11-09 00:34:42'),
	(18, 'Atlantic Ocean', NULL, '2015-11-09 00:34:42', '2015-11-09 00:34:42'),
	(19, 'Australia', NULL, '2015-11-09 00:34:42', '2015-11-09 00:34:42'),
	(20, 'Austria', NULL, '2015-11-09 00:34:42', '2015-11-09 00:34:42'),
	(21, 'Azerbaiyán', NULL, '2015-11-09 00:34:42', '2015-11-09 00:34:42'),
	(22, 'Bahamas', NULL, '2015-11-09 00:34:42', '2015-11-09 00:34:42'),
	(23, 'Bahráin', NULL, '2015-11-09 00:34:42', '2015-11-09 00:34:42'),
	(24, 'Bangladesh', NULL, '2015-11-09 00:34:42', '2015-11-09 00:34:42'),
	(25, 'Barbados', NULL, '2015-11-09 00:34:42', '2015-11-09 00:34:42'),
	(26, 'Bélgica', NULL, '2015-11-09 00:34:42', '2015-11-09 00:34:42'),
	(27, 'Belice', NULL, '2015-11-09 00:34:42', '2015-11-09 00:34:42'),
	(28, 'Benín', NULL, '2015-11-09 00:34:42', '2015-11-09 00:34:42'),
	(29, 'Bermudas', NULL, '2015-11-09 00:34:42', '2015-11-09 00:34:42'),
	(30, 'Bielorrusia', NULL, '2015-11-09 00:34:42', '2015-11-09 00:34:42'),
	(31, 'Birmania Myanmar', NULL, '2015-11-09 00:34:42', '2015-11-09 00:34:42'),
	(32, 'Bolivia', NULL, '2015-11-09 00:34:42', '2015-11-09 00:34:42'),
	(33, 'Bosnia y Hercegovina', NULL, '2015-11-09 00:34:42', '2015-11-09 00:34:42'),
	(34, 'Botsuana', NULL, '2015-11-09 00:34:42', '2015-11-09 00:34:42'),
	(35, 'Brasil', NULL, '2015-11-09 00:34:42', '2015-11-09 00:34:42'),
	(36, 'Brunéi', NULL, '2015-11-09 00:34:42', '2015-11-09 00:34:42'),
	(37, 'Bulgaria', NULL, '2015-11-09 00:34:42', '2015-11-09 00:34:42'),
	(38, 'Burkina Faso', NULL, '2015-11-09 00:34:42', '2015-11-09 00:34:42'),
	(39, 'Burundi', NULL, '2015-11-09 00:34:42', '2015-11-09 00:34:42'),
	(40, 'Bután', NULL, '2015-11-09 00:34:42', '2015-11-09 00:34:42'),
	(41, 'Cabo Verde', NULL, '2015-11-09 00:34:42', '2015-11-09 00:34:42'),
	(42, 'Camboya', NULL, '2015-11-09 00:34:42', '2015-11-09 00:34:42'),
	(43, 'Camerún', NULL, '2015-11-09 00:34:42', '2015-11-09 00:34:42'),
	(44, 'Canadá', NULL, '2015-11-09 00:34:43', '2015-11-09 00:34:43'),
	(45, 'Chad', NULL, '2015-11-09 00:34:43', '2015-11-09 00:34:43'),
	(46, 'Chile', NULL, '2015-11-09 00:34:43', '2015-11-09 00:34:43'),
	(47, 'China', NULL, '2015-11-09 00:34:43', '2015-11-09 00:34:43'),
	(48, 'Chipre', NULL, '2015-11-09 00:34:43', '2015-11-09 00:34:43'),
	(49, 'Clipperton Island', NULL, '2015-11-09 00:34:43', '2015-11-09 00:34:43'),
	(50, 'Colombia', NULL, '2015-11-09 00:34:43', '2015-11-09 00:34:43'),
	(51, 'Comoras', NULL, '2015-11-09 00:34:43', '2015-11-09 00:34:43'),
	(52, 'Congo', NULL, '2015-11-09 00:34:43', '2015-11-09 00:34:43'),
	(53, 'Coral Sea Islands', NULL, '2015-11-09 00:34:43', '2015-11-09 00:34:43'),
	(54, 'Corea del Norte', NULL, '2015-11-09 00:34:43', '2015-11-09 00:34:43'),
	(55, 'Corea del Sur', NULL, '2015-11-09 00:34:43', '2015-11-09 00:34:43'),
	(56, 'Costa de Marfil', NULL, '2015-11-09 00:34:43', '2015-11-09 00:34:43'),
	(57, 'Costa Rica', NULL, '2015-11-09 00:34:43', '2015-11-09 00:34:43'),
	(58, 'Croacia', NULL, '2015-11-09 00:34:43', '2015-11-09 00:34:43'),
	(59, 'Cuba', NULL, '2015-11-09 00:34:43', '2015-11-09 00:34:43'),
	(60, 'Dhekelia', NULL, '2015-11-09 00:34:43', '2015-11-09 00:34:43'),
	(61, 'Dinamarca', NULL, '2015-11-09 00:34:43', '2015-11-09 00:34:43'),
	(62, 'Dominica', NULL, '2015-11-09 00:34:43', '2015-11-09 00:34:43'),
	(63, 'Ecuador', NULL, '2015-11-09 00:34:43', '2015-11-09 00:34:43'),
	(64, 'Egipto', NULL, '2015-11-09 00:34:43', '2015-11-09 00:34:43'),
	(65, 'El Salvador', NULL, '2015-11-09 00:34:43', '2015-11-09 00:34:43'),
	(66, 'El Vaticano', NULL, '2015-11-09 00:34:43', '2015-11-09 00:34:43'),
	(67, 'Emiratos Árabes Unidos', NULL, '2015-11-09 00:34:43', '2015-11-09 00:34:43'),
	(68, 'Eritrea', NULL, '2015-11-09 00:34:43', '2015-11-09 00:34:43'),
	(69, 'Eslovaquia', NULL, '2015-11-09 00:34:43', '2015-11-09 00:34:43'),
	(70, 'Eslovenia', NULL, '2015-11-09 00:34:43', '2015-11-09 00:34:43'),
	(71, 'España', NULL, '2015-11-09 00:34:43', '2015-11-09 00:34:43'),
	(72, 'Estados Unidos', NULL, '2015-11-09 00:34:43', '2015-11-09 00:34:43'),
	(73, 'Estonia', NULL, '2015-11-09 00:34:43', '2015-11-09 00:34:43'),
	(74, 'Etiopía', NULL, '2015-11-09 00:34:43', '2015-11-09 00:34:43'),
	(75, 'Filipinas', NULL, '2015-11-09 00:34:44', '2015-11-09 00:34:44'),
	(76, 'Finlandia', NULL, '2015-11-09 00:34:44', '2015-11-09 00:34:44'),
	(77, 'Fiyi', NULL, '2015-11-09 00:34:44', '2015-11-09 00:34:44'),
	(78, 'Francia', NULL, '2015-11-09 00:34:44', '2015-11-09 00:34:44'),
	(79, 'Gabón', NULL, '2015-11-09 00:34:44', '2015-11-09 00:34:44'),
	(80, 'Gambia', NULL, '2015-11-09 00:34:44', '2015-11-09 00:34:44'),
	(81, 'Gaza Strip', NULL, '2015-11-09 00:34:44', '2015-11-09 00:34:44'),
	(82, 'Georgia', NULL, '2015-11-09 00:34:44', '2015-11-09 00:34:44'),
	(83, 'Ghana', NULL, '2015-11-09 00:34:44', '2015-11-09 00:34:44'),
	(84, 'Gibraltar', NULL, '2015-11-09 00:34:44', '2015-11-09 00:34:44'),
	(85, 'Granada', NULL, '2015-11-09 00:34:44', '2015-11-09 00:34:44'),
	(86, 'Grecia', NULL, '2015-11-09 00:34:44', '2015-11-09 00:34:44'),
	(87, 'Groenlandia', NULL, '2015-11-09 00:34:44', '2015-11-09 00:34:44'),
	(88, 'Guam', NULL, '2015-11-09 00:34:44', '2015-11-09 00:34:44'),
	(89, 'Guatemala', NULL, '2015-11-09 00:34:44', '2015-11-09 00:34:44'),
	(90, 'Guernsey', NULL, '2015-11-09 00:34:44', '2015-11-09 00:34:44'),
	(91, 'Guinea', NULL, '2015-11-09 00:34:44', '2015-11-09 00:34:44'),
	(92, 'Guinea Ecuatorial', NULL, '2015-11-09 00:34:44', '2015-11-09 00:34:44'),
	(93, 'Guinea-Bissau', NULL, '2015-11-09 00:34:44', '2015-11-09 00:34:44'),
	(94, 'Guyana', NULL, '2015-11-09 00:34:44', '2015-11-09 00:34:44'),
	(95, 'Haití', NULL, '2015-11-09 00:34:44', '2015-11-09 00:34:44'),
	(96, 'Honduras', NULL, '2015-11-09 00:34:44', '2015-11-09 00:34:44'),
	(97, 'Hong Kong', NULL, '2015-11-09 00:34:44', '2015-11-09 00:34:44'),
	(98, 'Hungría', NULL, '2015-11-09 00:34:44', '2015-11-09 00:34:44'),
	(99, 'India', NULL, '2015-11-09 00:34:44', '2015-11-09 00:34:44'),
	(100, 'Indian Ocean', NULL, '2015-11-09 00:34:44', '2015-11-09 00:34:44'),
	(101, 'Indonesia', NULL, '2015-11-09 00:34:44', '2015-11-09 00:34:44'),
	(102, 'Irán', NULL, '2015-11-09 00:34:45', '2015-11-09 00:34:45'),
	(103, 'Iraq', NULL, '2015-11-09 00:34:45', '2015-11-09 00:34:45'),
	(104, 'Irlanda', NULL, '2015-11-09 00:34:45', '2015-11-09 00:34:45'),
	(105, 'Isla Bouvet', NULL, '2015-11-09 00:34:45', '2015-11-09 00:34:45'),
	(106, 'Isla Christmas', NULL, '2015-11-09 00:34:45', '2015-11-09 00:34:45'),
	(107, 'Isla Norfolk', NULL, '2015-11-09 00:34:45', '2015-11-09 00:34:45'),
	(108, 'Islandia', NULL, '2015-11-09 00:34:45', '2015-11-09 00:34:45'),
	(109, 'Islas Caimán', NULL, '2015-11-09 00:34:45', '2015-11-09 00:34:45'),
	(110, 'Islas Cocos', NULL, '2015-11-09 00:34:45', '2015-11-09 00:34:45'),
	(111, 'Islas Cook', NULL, '2015-11-09 00:34:45', '2015-11-09 00:34:45'),
	(112, 'Islas Feroe', NULL, '2015-11-09 00:34:45', '2015-11-09 00:34:45'),
	(113, 'Islas Georgia del Sur y Sandwich del Sur', NULL, '2015-11-09 00:34:45', '2015-11-09 00:34:45'),
	(114, 'Islas Heard y McDonald', NULL, '2015-11-09 00:34:45', '2015-11-09 00:34:45'),
	(115, 'Islas Malvinas', NULL, '2015-11-09 00:34:45', '2015-11-09 00:34:45'),
	(116, 'Islas Marianas del Norte', NULL, '2015-11-09 00:34:45', '2015-11-09 00:34:45'),
	(117, 'IslasMarshall', NULL, '2015-11-09 00:34:45', '2015-11-09 00:34:45'),
	(118, 'Islas Pitcairn', NULL, '2015-11-09 00:34:45', '2015-11-09 00:34:45'),
	(119, 'Islas Salomón', NULL, '2015-11-09 00:34:45', '2015-11-09 00:34:45'),
	(120, 'Islas Turcas y Caicos', NULL, '2015-11-09 00:34:45', '2015-11-09 00:34:45'),
	(121, 'Islas Vírgenes Americanas', NULL, '2015-11-09 00:34:45', '2015-11-09 00:34:45'),
	(122, 'Islas Vírgenes Británicas', NULL, '2015-11-09 00:34:45', '2015-11-09 00:34:45'),
	(123, 'Israel', NULL, '2015-11-09 00:34:45', '2015-11-09 00:34:45'),
	(124, 'Italia', NULL, '2015-11-09 00:34:45', '2015-11-09 00:34:45'),
	(125, 'Jamaica', NULL, '2015-11-09 00:34:45', '2015-11-09 00:34:45'),
	(126, 'Jan Mayen', NULL, '2015-11-09 00:34:45', '2015-11-09 00:34:45'),
	(127, 'Japón', NULL, '2015-11-09 00:34:45', '2015-11-09 00:34:45'),
	(128, 'Jersey', NULL, '2015-11-09 00:34:45', '2015-11-09 00:34:45'),
	(129, 'Jordania', NULL, '2015-11-09 00:34:45', '2015-11-09 00:34:45'),
	(130, 'Kazajistán', NULL, '2015-11-09 00:34:45', '2015-11-09 00:34:45'),
	(131, 'Kenia', NULL, '2015-11-09 00:34:45', '2015-11-09 00:34:45'),
	(132, 'Kirguizistán', NULL, '2015-11-09 00:34:45', '2015-11-09 00:34:45'),
	(133, 'Kiribati', NULL, '2015-11-09 00:34:45', '2015-11-09 00:34:45'),
	(134, 'Kuwait', NULL, '2015-11-09 00:34:46', '2015-11-09 00:34:46'),
	(135, 'Laos', NULL, '2015-11-09 00:34:46', '2015-11-09 00:34:46'),
	(136, 'Lesoto', NULL, '2015-11-09 00:34:46', '2015-11-09 00:34:46'),
	(137, 'Letonia', NULL, '2015-11-09 00:34:46', '2015-11-09 00:34:46'),
	(138, 'Líbano', NULL, '2015-11-09 00:34:46', '2015-11-09 00:34:46'),
	(139, 'Liberia', NULL, '2015-11-09 00:34:46', '2015-11-09 00:34:46'),
	(140, 'Libia', NULL, '2015-11-09 00:34:46', '2015-11-09 00:34:46'),
	(141, 'Liechtenstein', NULL, '2015-11-09 00:34:46', '2015-11-09 00:34:46'),
	(142, 'Lituania', NULL, '2015-11-09 00:34:46', '2015-11-09 00:34:46'),
	(143, 'Luxemburgo', NULL, '2015-11-09 00:34:46', '2015-11-09 00:34:46'),
	(144, 'Macao', NULL, '2015-11-09 00:34:46', '2015-11-09 00:34:46'),
	(145, 'Macedonia', NULL, '2015-11-09 00:34:46', '2015-11-09 00:34:46'),
	(146, 'Madagascar', NULL, '2015-11-09 00:34:46', '2015-11-09 00:34:46'),
	(147, 'Malasia', NULL, '2015-11-09 00:34:46', '2015-11-09 00:34:46'),
	(148, 'Malaui', NULL, '2015-11-09 00:34:46', '2015-11-09 00:34:46'),
	(149, 'Maldivas', NULL, '2015-11-09 00:34:46', '2015-11-09 00:34:46'),
	(150, 'Malí', NULL, '2015-11-09 00:34:46', '2015-11-09 00:34:46'),
	(151, 'Malta', NULL, '2015-11-09 00:34:46', '2015-11-09 00:34:46'),
	(152, 'Man, Isle of', NULL, '2015-11-09 00:34:46', '2015-11-09 00:34:46'),
	(153, 'Marruecos', NULL, '2015-11-09 00:34:46', '2015-11-09 00:34:46'),
	(154, 'Mauricio', NULL, '2015-11-09 00:34:46', '2015-11-09 00:34:46'),
	(155, 'Mauritania', NULL, '2015-11-09 00:34:46', '2015-11-09 00:34:46'),
	(156, 'Mayotte', NULL, '2015-11-09 00:34:46', '2015-11-09 00:34:46'),
	(157, 'México', NULL, '2015-11-09 00:34:46', '2015-11-09 00:34:46'),
	(158, 'Micronesia', NULL, '2015-11-09 00:34:46', '2015-11-09 00:34:46'),
	(159, 'Moldavia', NULL, '2015-11-09 00:34:46', '2015-11-09 00:34:46'),
	(160, 'Mónaco', NULL, '2015-11-09 00:34:46', '2015-11-09 00:34:46'),
	(161, 'Mongolia', NULL, '2015-11-09 00:34:47', '2015-11-09 00:34:47'),
	(162, 'Montserrat', NULL, '2015-11-09 00:34:47', '2015-11-09 00:34:47'),
	(163, 'Mozambique', NULL, '2015-11-09 00:34:47', '2015-11-09 00:34:47'),
	(164, 'Namibia', NULL, '2015-11-09 00:34:47', '2015-11-09 00:34:47'),
	(165, 'Nauru', NULL, '2015-11-09 00:34:47', '2015-11-09 00:34:47'),
	(166, 'Navassa Island', NULL, '2015-11-09 00:34:47', '2015-11-09 00:34:47'),
	(167, 'Nepal', NULL, '2015-11-09 00:34:47', '2015-11-09 00:34:47'),
	(168, 'Nicaragua', NULL, '2015-11-09 00:34:47', '2015-11-09 00:34:47'),
	(169, 'Níger', NULL, '2015-11-09 00:34:47', '2015-11-09 00:34:47'),
	(170, 'Nigeria', NULL, '2015-11-09 00:34:47', '2015-11-09 00:34:47'),
	(171, 'Niue', NULL, '2015-11-09 00:34:47', '2015-11-09 00:34:47'),
	(172, 'Noruega', NULL, '2015-11-09 00:34:47', '2015-11-09 00:34:47'),
	(173, 'Nueva Caledonia', NULL, '2015-11-09 00:34:47', '2015-11-09 00:34:47'),
	(174, 'Nueva Zelanda', NULL, '2015-11-09 00:34:47', '2015-11-09 00:34:47'),
	(175, 'Omán', NULL, '2015-11-09 00:34:47', '2015-11-09 00:34:47'),
	(176, 'Pacific Ocean', NULL, '2015-11-09 00:34:47', '2015-11-09 00:34:47'),
	(177, 'Países Bajos', NULL, '2015-11-09 00:34:47', '2015-11-09 00:34:47'),
	(178, 'Pakistán', NULL, '2015-11-09 00:34:47', '2015-11-09 00:34:47'),
	(179, 'Palaos', NULL, '2015-11-09 00:34:47', '2015-11-09 00:34:47'),
	(180, 'Panamá', NULL, '2015-11-09 00:34:47', '2015-11-09 00:34:47'),
	(181, 'Papúa-Nueva Guinea', NULL, '2015-11-09 00:34:47', '2015-11-09 00:34:47'),
	(182, 'Paracel Islands', NULL, '2015-11-09 00:34:47', '2015-11-09 00:34:47'),
	(183, 'Paraguay', NULL, '2015-11-09 00:34:47', '2015-11-09 00:34:47'),
	(184, 'Perú', NULL, '2015-11-09 00:34:47', '2015-11-09 00:34:47'),
	(185, 'Polinesia Francesa', NULL, '2015-11-09 00:34:47', '2015-11-09 00:34:47'),
	(186, 'Polonia', NULL, '2015-11-09 00:34:47', '2015-11-09 00:34:47'),
	(187, 'Portugal', NULL, '2015-11-09 00:34:47', '2015-11-09 00:34:47'),
	(188, 'Puerto Rico', NULL, '2015-11-09 00:34:47', '2015-11-09 00:34:47'),
	(189, 'Qatar', NULL, '2015-11-09 00:34:47', '2015-11-09 00:34:47'),
	(190, 'Reino Unido', NULL, '2015-11-09 00:34:47', '2015-11-09 00:34:47'),
	(191, 'República Centroafricana', NULL, '2015-11-09 00:34:47', '2015-11-09 00:34:47'),
	(192, 'República Checa', NULL, '2015-11-09 00:34:47', '2015-11-09 00:34:47'),
	(193, 'República Democrática del Congo', NULL, '2015-11-09 00:34:47', '2015-11-09 00:34:47'),
	(194, 'República Dominicana', NULL, '2015-11-09 00:34:47', '2015-11-09 00:34:47'),
	(195, 'Ruanda', NULL, '2015-11-09 00:34:47', '2015-11-09 00:34:47'),
	(196, 'Rumania', NULL, '2015-11-09 00:34:48', '2015-11-09 00:34:48'),
	(197, 'Rusia', NULL, '2015-11-09 00:34:48', '2015-11-09 00:34:48'),
	(198, 'Sáhara Occidental', NULL, '2015-11-09 00:34:48', '2015-11-09 00:34:48'),
	(199, 'Samoa', NULL, '2015-11-09 00:34:48', '2015-11-09 00:34:48'),
	(200, 'Samoa Americana', NULL, '2015-11-09 00:34:48', '2015-11-09 00:34:48'),
	(201, 'San Cristóbal y Nieves', NULL, '2015-11-09 00:34:48', '2015-11-09 00:34:48'),
	(202, 'San Marino', NULL, '2015-11-09 00:34:48', '2015-11-09 00:34:48'),
	(203, 'San Pedro y Miquelón', NULL, '2015-11-09 00:34:48', '2015-11-09 00:34:48'),
	(204, 'San Vicente y las Granadinas', NULL, '2015-11-09 00:34:48', '2015-11-09 00:34:48'),
	(205, 'Santa Helena', NULL, '2015-11-09 00:34:48', '2015-11-09 00:34:48'),
	(206, 'Santa Lucía', NULL, '2015-11-09 00:34:48', '2015-11-09 00:34:48'),
	(207, 'Santo Tomé y Príncipe', NULL, '2015-11-09 00:34:48', '2015-11-09 00:34:48'),
	(208, 'Senegal', NULL, '2015-11-09 00:34:48', '2015-11-09 00:34:48'),
	(209, 'Seychelles', NULL, '2015-11-09 00:34:48', '2015-11-09 00:34:48'),
	(210, 'Sierra Leona', NULL, '2015-11-09 00:34:48', '2015-11-09 00:34:48'),
	(211, 'Singapur', NULL, '2015-11-09 00:34:48', '2015-11-09 00:34:48'),
	(212, 'Siria', NULL, '2015-11-09 00:34:48', '2015-11-09 00:34:48'),
	(213, 'Somalia', NULL, '2015-11-09 00:34:48', '2015-11-09 00:34:48'),
	(214, 'Southern Ocean', NULL, '2015-11-09 00:34:48', '2015-11-09 00:34:48'),
	(215, 'Spratly Islands', NULL, '2015-11-09 00:34:48', '2015-11-09 00:34:48'),
	(216, 'Sri Lanka', NULL, '2015-11-09 00:34:48', '2015-11-09 00:34:48'),
	(217, 'Suazilandia', NULL, '2015-11-09 00:34:48', '2015-11-09 00:34:48'),
	(218, 'Sudáfrica', NULL, '2015-11-09 00:34:49', '2015-11-09 00:34:49'),
	(219, 'Sudán', NULL, '2015-11-09 00:34:49', '2015-11-09 00:34:49'),
	(220, 'Suecia', NULL, '2015-11-09 00:34:49', '2015-11-09 00:34:49'),
	(221, 'Suiza', NULL, '2015-11-09 00:34:49', '2015-11-09 00:34:49'),
	(222, 'Surinam', NULL, '2015-11-09 00:34:49', '2015-11-09 00:34:49'),
	(223, 'Svalbard y Jan Mayen', NULL, '2015-11-09 00:34:49', '2015-11-09 00:34:49'),
	(224, 'Tailandia', NULL, '2015-11-09 00:34:49', '2015-11-09 00:34:49'),
	(225, 'Taiwán', NULL, '2015-11-09 00:34:49', '2015-11-09 00:34:49'),
	(226, 'Tanzania', NULL, '2015-11-09 00:34:49', '2015-11-09 00:34:49'),
	(227, 'Tayikistán', NULL, '2015-11-09 00:34:49', '2015-11-09 00:34:49'),
	(228, 'TerritorioBritánicodel Océano Indico', NULL, '2015-11-09 00:34:49', '2015-11-09 00:34:49'),
	(229, 'Territorios Australes Franceses', NULL, '2015-11-09 00:34:49', '2015-11-09 00:34:49'),
	(230, 'Timor Oriental', NULL, '2015-11-09 00:34:49', '2015-11-09 00:34:49'),
	(231, 'Togo', NULL, '2015-11-09 00:34:49', '2015-11-09 00:34:49'),
	(232, 'Tokelau', NULL, '2015-11-09 00:34:49', '2015-11-09 00:34:49'),
	(233, 'Tonga', NULL, '2015-11-09 00:34:49', '2015-11-09 00:34:49'),
	(234, 'Trinidad y Tobago', NULL, '2015-11-09 00:34:49', '2015-11-09 00:34:49'),
	(235, 'Túnez', NULL, '2015-11-09 00:34:49', '2015-11-09 00:34:49'),
	(236, 'Turkmenistán', NULL, '2015-11-09 00:34:49', '2015-11-09 00:34:49'),
	(237, 'Turquía', NULL, '2015-11-09 00:34:49', '2015-11-09 00:34:49'),
	(238, 'Tuvalu', NULL, '2015-11-09 00:34:49', '2015-11-09 00:34:49'),
	(239, 'Ucrania', NULL, '2015-11-09 00:34:49', '2015-11-09 00:34:49'),
	(240, 'Uganda', NULL, '2015-11-09 00:34:49', '2015-11-09 00:34:49'),
	(241, 'Unión Europea', NULL, '2015-11-09 00:34:49', '2015-11-09 00:34:49'),
	(242, 'Uruguay', NULL, '2015-11-09 00:34:49', '2015-11-09 00:34:49'),
	(243, 'Uzbekistán', NULL, '2015-11-09 00:34:49', '2015-11-09 00:34:49'),
	(244, 'Vanuatu', NULL, '2015-11-09 00:34:49', '2015-11-09 00:34:49'),
	(245, 'Venezuela', NULL, '2015-11-09 00:34:49', '2015-11-09 00:34:49'),
	(246, 'Vietnam', NULL, '2015-11-09 00:34:49', '2015-11-09 00:34:49'),
	(247, 'Wake Island', NULL, '2015-11-09 00:34:49', '2015-11-09 00:34:49'),
	(248, 'Wallis y Futuna', NULL, '2015-11-09 00:34:49', '2015-11-09 00:34:49'),
	(249, 'West Bank', NULL, '2015-11-09 00:34:49', '2015-11-09 00:34:49'),
	(250, 'World', NULL, '2015-11-09 00:34:49', '2015-11-09 00:34:49'),
	(251, 'Yemen', NULL, '2015-11-09 00:34:49', '2015-11-09 00:34:49'),
	(252, 'Yibuti', NULL, '2015-11-09 00:34:49', '2015-11-09 00:34:49'),
	(253, 'Zambia', NULL, '2015-11-09 00:34:49', '2015-11-09 00:34:49'),
	(254, 'Zimbabue', NULL, '2015-11-09 00:34:49', '2015-11-09 00:34:49');
/*!40000 ALTER TABLE `pais` ENABLE KEYS */;


-- Volcando estructura para tabla alquilerautos.password_resets
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla alquilerautos.password_resets: ~0 rows (aproximadamente)
DELETE FROM `password_resets`;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;


-- Volcando estructura para tabla alquilerautos.tipo_usuarios
DROP TABLE IF EXISTS `tipo_usuarios`;
CREATE TABLE IF NOT EXISTS `tipo_usuarios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla alquilerautos.tipo_usuarios: ~3 rows (aproximadamente)
DELETE FROM `tipo_usuarios`;
/*!40000 ALTER TABLE `tipo_usuarios` DISABLE KEYS */;
INSERT INTO `tipo_usuarios` (`id`, `Nombre`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 'Administrador', NULL, '2015-11-09 00:34:50', '2015-11-09 00:34:50'),
	(2, 'Empleado', NULL, '2015-11-09 00:34:50', '2015-11-09 00:34:50'),
	(3, 'Cliente', NULL, '2015-11-09 00:34:50', '2015-11-09 00:34:50');
/*!40000 ALTER TABLE `tipo_usuarios` ENABLE KEYS */;


-- Volcando estructura para tabla alquilerautos.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `PrimerNombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `SegundoNombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `PrimerApellido` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `SegundoApellido` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `genero` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `nDocumento` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `EstadoD` varchar(110) COLLATE utf8_spanish_ci NOT NULL,
  `DireccionEspecifica` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `CodigoPostal` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `FechaDeNacimiento` date NOT NULL,
  `idPaisUser` int(10) unsigned NOT NULL,
  `idTipoUsuario` int(10) unsigned NOT NULL,
  `email` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_ndocumento_unique` (`nDocumento`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_idpaisuser_foreign` (`idPaisUser`),
  KEY `users_idtipousuario_foreign` (`idTipoUsuario`),
  CONSTRAINT `users_idpaisuser_foreign` FOREIGN KEY (`idPaisUser`) REFERENCES `pais` (`id`),
  CONSTRAINT `users_idtipousuario_foreign` FOREIGN KEY (`idTipoUsuario`) REFERENCES `tipo_usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla alquilerautos.users: ~2 rows (aproximadamente)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `PrimerNombre`, `SegundoNombre`, `PrimerApellido`, `SegundoApellido`, `genero`, `nDocumento`, `EstadoD`, `DireccionEspecifica`, `CodigoPostal`, `estado`, `FechaDeNacimiento`, `idPaisUser`, `idTipoUsuario`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Alexander', 'Leonardo', 'Dominguez', 'Pascacio', 'M', '156789432', 'La Paz', 'Olocuilta', '02132', 1, '1994-07-14', 1, 1, 'todociber100@gmail.com', '$2y$10$sJjXE44J63BccVzyvcwqV.8FHJc0vtNYo2QqwEqVpxSQyR3yPMXF6', 'CbrVbTDic0D0PcMJwL49kLaNoI5qW9FO3McsfDrz6U5zFZmiUZsoRBusBo00', '2015-11-09 00:34:50', '2015-11-10 19:33:42', NULL),
	(2, 'Rudy', 'Ulises', 's', 'Hernandez', 'M', '789123451', 'San Salvador, Apopa', 'OLOCUILTA La Paz Carretera Antigua a Zacatecoluca KM 20', '00000', 1, '1997-11-09', 65, 2, 'rudy@gmail.com', '$2y$10$5wggpFYtuKUmvDbSf6XSn.3B5Us08OnrvBXfAJNdWeQHHP94YXX.i', 'c1J6uRyI4dHY69gA2hJPMUy3sHPKgKsXMqQoukqd87sYNWDeFBzUawOu12Hn', '2015-11-09 23:53:48', '2015-11-10 01:12:38', '2015-11-10 01:12:38'),
	(3, 'Brenda', 'Elizabet', '', 'Hernandez', 'M', '123456237', 'San Miguel, San Miguel', '6703 NW 7th St', 'CP 1601', 1, '1997-11-10', 65, 2, 'brenda@gmail.com', '$2y$10$qk/v.y7Rch7H1a.0KHUZEOGXqNCDgqAXrd94jQcpfJAR1q14yGOHW', 'X1Do6LfrJ2phbA0sbUBB9EEcm6sIeFLrSRXIIq45qy9zSgfnNvCIEqtuuhro', '2015-11-10 01:16:14', '2015-11-10 19:36:50', NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


-- Volcando estructura para tabla alquilerautos.vehiculos
DROP TABLE IF EXISTS `vehiculos`;
CREATE TABLE IF NOT EXISTS `vehiculos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Kilometraje` double NOT NULL DEFAULT '0',
  `PrecioPorHora` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `placa` int(11) NOT NULL,
  `anio` int(11) NOT NULL,
  `Estado` tinyint(1) NOT NULL DEFAULT '1',
  `idColor` int(10) unsigned NOT NULL,
  `idModelo` int(10) unsigned NOT NULL,
  `idCondicion` int(10) unsigned NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `vehiculos_idcolor_foreign` (`idColor`),
  KEY `vehiculos_idmodelo_foreign` (`idModelo`),
  KEY `vehiculos_idcondicion_foreign` (`idCondicion`),
  CONSTRAINT `vehiculos_idcolor_foreign` FOREIGN KEY (`idColor`) REFERENCES `colors` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `vehiculos_idcondicion_foreign` FOREIGN KEY (`idCondicion`) REFERENCES `condicions` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `vehiculos_idmodelo_foreign` FOREIGN KEY (`idModelo`) REFERENCES `modelos` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla alquilerautos.vehiculos: ~2 rows (aproximadamente)
DELETE FROM `vehiculos`;
/*!40000 ALTER TABLE `vehiculos` DISABLE KEYS */;
INSERT INTO `vehiculos` (`id`, `Kilometraje`, `PrecioPorHora`, `placa`, `anio`, `Estado`, `idColor`, `idModelo`, `idCondicion`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 90, '25', 13245678, 2010, 1, 2, 1, 1, NULL, '2015-11-09 00:42:49', '2015-11-11 01:37:57'),
	(2, 0, '16', 12345698, 1990, 1, 4, 1, 2, NULL, '2015-11-09 22:46:01', '2015-11-11 01:36:46'),
	(3, 9, '37', 74569812, 2005, 1, 2, 2, 1, NULL, '2015-11-11 01:23:01', '2015-11-11 01:23:01');
/*!40000 ALTER TABLE `vehiculos` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.14-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para almacenkeka
CREATE DATABASE IF NOT EXISTS `almacenkeka` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `almacenkeka`;

-- Volcando estructura para tabla almacenkeka.categorias
CREATE TABLE IF NOT EXISTS `categorias` (
  `id_categoria` int(250) NOT NULL AUTO_INCREMENT,
  `nombre_categoria` varchar(500) NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla almacenkeka.categorias: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` (`id_categoria`, `nombre_categoria`) VALUES
	(1, 'Cecinas'),
	(2, 'Abarrotes'),
	(3, 'Dulces'),
	(4, 'Bebidas'),
	(5, 'Utiles Escolares'),
	(6, 'Congelados');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;

-- Volcando estructura para tabla almacenkeka.ofertas
CREATE TABLE IF NOT EXISTS `ofertas` (
  `nombre` varchar(500) NOT NULL,
  `formato` varchar(500) NOT NULL,
  `marca` varchar(500) NOT NULL,
  `precio` int(250) NOT NULL,
  `id` int(250) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla almacenkeka.ofertas: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `ofertas` DISABLE KEYS */;
/*!40000 ALTER TABLE `ofertas` ENABLE KEYS */;

-- Volcando estructura para tabla almacenkeka.productos
CREATE TABLE IF NOT EXISTS `productos` (
  `id_producto` int(250) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(500) NOT NULL,
  `precio` int(250) NOT NULL,
  `stock` int(250) NOT NULL,
  `cod_categoria` int(250) NOT NULL,
  PRIMARY KEY (`id_producto`),
  KEY `cod_categoria` (`cod_categoria`),
  CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`cod_categoria`) REFERENCES `categorias` (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla almacenkeka.productos: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` (`id_producto`, `nombre`, `precio`, `stock`, `cod_categoria`) VALUES
	(4, 'Colorante Gel Colores2', 15000, 5, 5),
	(5, 'Pan', 50333, 10022, 5),
	(6, 'Leche 1L', 129839812, 981298, 2),
	(8, 'Canela', 2121, 822, 2),
	(10, 'Azucar', 218321, 21, 6),
	(11, 'Aceite', 123821, 21, 6);
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;

-- Volcando estructura para tabla almacenkeka.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(100) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `priv` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla almacenkeka.usuarios: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id_usuario`, `nombre`, `email`, `password`, `priv`) VALUES
	(1, 'Administrador', 'user@prueba.com', 'admin', 'admin'),
	(2, 'Cajero', 'prueba@123.com', '1234', 'user');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

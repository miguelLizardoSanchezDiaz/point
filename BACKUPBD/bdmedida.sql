-- MySQL dump 10.17  Distrib 10.3.16-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: bdmedida
-- ------------------------------------------------------
-- Server version	10.3.16-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `almacen`
--

DROP TABLE IF EXISTS `almacen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `almacen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alm_codigo` varchar(50) DEFAULT NULL,
  `alm_descripcion` varchar(200) DEFAULT NULL,
  `alm_estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `almacen`
--

LOCK TABLES `almacen` WRITE;
/*!40000 ALTER TABLE `almacen` DISABLE KEYS */;
/*!40000 ALTER TABLE `almacen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caja`
--

DROP TABLE IF EXISTS `caja`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caja` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `caj_codigo` varchar(50) DEFAULT NULL,
  `caj_descripcion` varchar(200) DEFAULT NULL,
  `caj_estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caja`
--

LOCK TABLES `caja` WRITE;
/*!40000 ALTER TABLE `caja` DISABLE KEYS */;
/*!40000 ALTER TABLE `caja` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caja_movimientos`
--

DROP TABLE IF EXISTS `caja_movimientos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caja_movimientos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fop_id` int(11) NOT NULL,
  `cao_id` int(11) NOT NULL,
  `cam_monto_entrada` decimal(10,2) DEFAULT NULL,
  `cam_monto_salida` decimal(10,2) DEFAULT NULL,
  `cam_referencia_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FKcaja_movim484932` (`cao_id`),
  KEY `FKcaja_movim30358` (`fop_id`),
  CONSTRAINT `FKcaja_movim30358` FOREIGN KEY (`fop_id`) REFERENCES `forma_pago` (`id`),
  CONSTRAINT `FKcaja_movim484932` FOREIGN KEY (`cao_id`) REFERENCES `caja_operacion` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caja_movimientos`
--

LOCK TABLES `caja_movimientos` WRITE;
/*!40000 ALTER TABLE `caja_movimientos` DISABLE KEYS */;
/*!40000 ALTER TABLE `caja_movimientos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caja_operacion`
--

DROP TABLE IF EXISTS `caja_operacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caja_operacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `caj_id` int(11) NOT NULL,
  `cao_apertura` int(11) DEFAULT NULL,
  `cao_monto_apertura` decimal(10,2) DEFAULT NULL,
  `cao_inconsistencia_apertura` varchar(200) DEFAULT NULL,
  `cao_cierre` int(11) DEFAULT NULL,
  `cao_monto_cierre` decimal(10,2) DEFAULT NULL,
  `cao_inconsistencia_cierre` varchar(200) DEFAULT NULL,
  `cao_fecha` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FKcaja_opera744270` (`caj_id`),
  CONSTRAINT `FKcaja_opera744270` FOREIGN KEY (`caj_id`) REFERENCES `caja` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caja_operacion`
--

LOCK TABLES `caja_operacion` WRITE;
/*!40000 ALTER TABLE `caja_operacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `caja_operacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoria` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `cat_codigo` varchar(50) DEFAULT NULL,
  `cat_descripcion` varchar(200) DEFAULT NULL,
  `cat_estado` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES (1,'01','MERCADERIA',1);
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comprobante`
--

DROP TABLE IF EXISTS `comprobante`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comprobante` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `com_serie` varchar(20) DEFAULT NULL,
  `com_numero` varchar(50) DEFAULT NULL,
  `com_estado` int(11) DEFAULT NULL,
  `com_usuario` varchar(100) DEFAULT NULL,
  `com_fecha` date DEFAULT NULL,
  `com_observacion` text DEFAULT NULL,
  `com_total` decimal(10,2) DEFAULT NULL,
  `com_igv` decimal(10,2) DEFAULT NULL,
  `com_subtotal` decimal(10,2) DEFAULT NULL,
  `ter_id` int(11) NOT NULL,
  `tco_id` int(11) NOT NULL,
  `pto_id` int(11) NOT NULL,
  `imp_id1` int(11) NOT NULL,
  `imp_id2` int(11) NOT NULL,
  `imp_id3` int(11) NOT NULL,
  `com_impuesto1` decimal(10,2) DEFAULT NULL,
  `com_impuesto2` decimal(10,2) DEFAULT NULL,
  `com_impuesto3` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FKcomprobant583318` (`imp_id3`),
  KEY `FKcomprobant583319` (`imp_id2`),
  KEY `FKcomprobant583320` (`imp_id1`),
  KEY `FKcomprobant308766` (`pto_id`),
  KEY `FKcomprobant333627` (`tco_id`),
  KEY `FKcomprobant51471` (`ter_id`),
  CONSTRAINT `FKcomprobant308766` FOREIGN KEY (`pto_id`) REFERENCES `punto_venta` (`id`),
  CONSTRAINT `FKcomprobant333627` FOREIGN KEY (`tco_id`) REFERENCES `tipo_comprobante` (`id`),
  CONSTRAINT `FKcomprobant51471` FOREIGN KEY (`ter_id`) REFERENCES `tercero` (`id`),
  CONSTRAINT `FKcomprobant583318` FOREIGN KEY (`imp_id3`) REFERENCES `impuesto` (`id`),
  CONSTRAINT `FKcomprobant583319` FOREIGN KEY (`imp_id2`) REFERENCES `impuesto` (`id`),
  CONSTRAINT `FKcomprobant583320` FOREIGN KEY (`imp_id1`) REFERENCES `impuesto` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comprobante`
--

LOCK TABLES `comprobante` WRITE;
/*!40000 ALTER TABLE `comprobante` DISABLE KEYS */;
/*!40000 ALTER TABLE `comprobante` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_comprobante`
--

DROP TABLE IF EXISTS `detalle_comprobante`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalle_comprobante` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `com_id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `dco_cantidad` decimal(10,4) DEFAULT NULL,
  `dco_precio` decimal(10,2) DEFAULT NULL,
  `dco_importe` decimal(10,2) DEFAULT NULL,
  `dco_descuento` decimal(10,2) DEFAULT NULL,
  `dco_total` decimal(10,2) DEFAULT NULL,
  `dco_estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FKdetalle_co573347` (`com_id`),
  KEY `FKdetalle_co401143` (`pro_id`),
  CONSTRAINT `FKdetalle_co401143` FOREIGN KEY (`pro_id`) REFERENCES `producto` (`id`),
  CONSTRAINT `FKdetalle_co573347` FOREIGN KEY (`com_id`) REFERENCES `comprobante` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_comprobante`
--

LOCK TABLES `detalle_comprobante` WRITE;
/*!40000 ALTER TABLE `detalle_comprobante` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalle_comprobante` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documento_identidad`
--

DROP TABLE IF EXISTS `documento_identidad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documento_identidad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `doi_codigo` varchar(50) DEFAULT NULL,
  `doi_descripcion` varchar(200) DEFAULT NULL,
  `doi_codigo_sunat` varchar(25) DEFAULT NULL,
  `doi_estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documento_identidad`
--

LOCK TABLES `documento_identidad` WRITE;
/*!40000 ALTER TABLE `documento_identidad` DISABLE KEYS */;
INSERT INTO `documento_identidad` VALUES (1,'01','RUC','01',1),(2,'02','DNI','02',1);
/*!40000 ALTER TABLE `documento_identidad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forma_pago`
--

DROP TABLE IF EXISTS `forma_pago`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forma_pago` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fop_codigo` varchar(50) DEFAULT NULL,
  `fop_descripcion` varchar(200) DEFAULT NULL,
  `fop_estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forma_pago`
--

LOCK TABLES `forma_pago` WRITE;
/*!40000 ALTER TABLE `forma_pago` DISABLE KEYS */;
/*!40000 ALTER TABLE `forma_pago` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `impuesto`
--

DROP TABLE IF EXISTS `impuesto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `impuesto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `imp_codigo` varchar(50) DEFAULT NULL,
  `imp_descripcion` varchar(200) DEFAULT NULL,
  `imp_estado` int(11) DEFAULT NULL,
  `imp_porcentaje` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `impuesto`
--

LOCK TABLES `impuesto` WRITE;
/*!40000 ALTER TABLE `impuesto` DISABLE KEYS */;
/*!40000 ALTER TABLE `impuesto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kardex`
--

DROP TABLE IF EXISTS `kardex`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kardex` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pro_id` int(11) NOT NULL,
  `tim_id` int(11) NOT NULL,
  `alm_id` int(11) NOT NULL,
  `kar_fecha` date DEFAULT NULL,
  `kar_cantidad_entrada` decimal(10,2) DEFAULT NULL,
  `kar_precio_entrada` decimal(10,2) DEFAULT NULL,
  `kar_costo_entrada` decimal(10,2) DEFAULT NULL,
  `kar_cantidad_salida` decimal(10,2) DEFAULT NULL,
  `kar_costo_salida` decimal(10,2) DEFAULT NULL,
  `kar_precio_salida` decimal(10,2) DEFAULT NULL,
  `kar_cantidad_saldo` decimal(10,2) DEFAULT NULL,
  `kar_costo_saldo` decimal(10,2) DEFAULT NULL,
  `kar_precio_saldo` decimal(10,2) DEFAULT NULL,
  `kar_usuario` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FKkardex686937` (`alm_id`),
  KEY `FKkardex599647` (`tim_id`),
  KEY `FKkardex819895` (`pro_id`),
  CONSTRAINT `FKkardex599647` FOREIGN KEY (`tim_id`) REFERENCES `tipo_movimiento` (`id`),
  CONSTRAINT `FKkardex686937` FOREIGN KEY (`alm_id`) REFERENCES `almacen` (`id`),
  CONSTRAINT `FKkardex819895` FOREIGN KEY (`pro_id`) REFERENCES `producto` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kardex`
--

LOCK TABLES `kardex` WRITE;
/*!40000 ALTER TABLE `kardex` DISABLE KEYS */;
/*!40000 ALTER TABLE `kardex` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `marca`
--

DROP TABLE IF EXISTS `marca`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `marca` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mar_codigo` varchar(50) DEFAULT NULL,
  `mar_descripcion` varchar(200) DEFAULT NULL,
  `mar_estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marca`
--

LOCK TABLES `marca` WRITE;
/*!40000 ALTER TABLE `marca` DISABLE KEYS */;
INSERT INTO `marca` VALUES (1,'01','MARCA DEMO',1);
/*!40000 ALTER TABLE `marca` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modelo`
--

DROP TABLE IF EXISTS `modelo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modelo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mod_codigo` varchar(50) DEFAULT NULL,
  `mod_descripcion` varchar(200) DEFAULT NULL,
  `mod_estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modelo`
--

LOCK TABLES `modelo` WRITE;
/*!40000 ALTER TABLE `modelo` DISABLE KEYS */;
INSERT INTO `modelo` VALUES (1,'01','MODELO GENERAL',1);
/*!40000 ALTER TABLE `modelo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permiso`
--

DROP TABLE IF EXISTS `permiso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permiso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `per_codigo` varchar(50) DEFAULT NULL,
  `per_descripcion` varchar(150) DEFAULT NULL,
  `per_estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permiso`
--

LOCK TABLES `permiso` WRITE;
/*!40000 ALTER TABLE `permiso` DISABLE KEYS */;
INSERT INTO `permiso` VALUES (1,'01','CONFIGURACIÓN DE USUARIOS',1),(2,'02','TERCEROS SI',1),(3,'03','PERMISOS POR ROLES',1),(4,'02','CATEGORIAS',1),(5,'03','ROLES',1),(6,'06','GESTIONAR PUNTO DE VENTA',1);
/*!40000 ALTER TABLE `permiso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `producto`
--

DROP TABLE IF EXISTS `producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pro_codigo` varchar(50) DEFAULT NULL,
  `pro_descripcion` varchar(250) DEFAULT NULL,
  `pro_fecha_creacion` date DEFAULT NULL,
  `pro_ruta_foto` varchar(280) DEFAULT NULL,
  `pro_tipo_producto` char(1) DEFAULT NULL,
  `pro_peso` decimal(10,2) DEFAULT NULL,
  `pro_volumen` decimal(10,2) DEFAULT NULL,
  `pro_longitud` decimal(10,2) DEFAULT NULL,
  `pro_estado` int(11) DEFAULT NULL,
  `pro_caracteristicas` varchar(250) DEFAULT NULL,
  `cat_id` int(10) DEFAULT NULL,
  `unm_id` int(10) DEFAULT NULL,
  `mar_id` int(11) DEFAULT NULL,
  `mod_id` int(11) DEFAULT NULL,
  `pro_precio` decimal(10,2) DEFAULT 0.00,
  `pro_usuario` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FKproducto411178` (`mar_id`),
  KEY `FKproducto464403` (`cat_id`),
  KEY `FKproducto605850` (`mod_id`),
  KEY `FKproducto826079` (`unm_id`),
  CONSTRAINT `FKproducto411178` FOREIGN KEY (`mar_id`) REFERENCES `marca` (`id`),
  CONSTRAINT `FKproducto464403` FOREIGN KEY (`cat_id`) REFERENCES `categoria` (`id`),
  CONSTRAINT `FKproducto605850` FOREIGN KEY (`mod_id`) REFERENCES `modelo` (`id`),
  CONSTRAINT `FKproducto826079` FOREIGN KEY (`unm_id`) REFERENCES `unidad_medida` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producto`
--

LOCK TABLES `producto` WRITE;
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
INSERT INTO `producto` VALUES (1,'001','demoproduc',NULL,NULL,'S',4.00,3.00,NULL,1,'asda dasd sd',1,1,1,1,12.00,NULL),(2,'002','descripcion demo',NULL,NULL,'M',NULL,NULL,NULL,1,NULL,1,1,1,1,NULL,NULL),(4,'10500','HUAWEY Y6 2020',NULL,NULL,'M',NULL,NULL,NULL,1,NULL,1,1,1,1,3500.00,NULL);
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `punto_venta`
--

DROP TABLE IF EXISTS `punto_venta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `punto_venta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pto_codigo` varchar(50) DEFAULT NULL,
  `pto_descripcion` varchar(150) DEFAULT NULL,
  `pto_fecha` date DEFAULT NULL,
  `pto_estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `punto_venta`
--

LOCK TABLES `punto_venta` WRITE;
/*!40000 ALTER TABLE `punto_venta` DISABLE KEYS */;
/*!40000 ALTER TABLE `punto_venta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rol`
--

DROP TABLE IF EXISTS `rol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rol` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rol_codigo` varchar(20) DEFAULT NULL,
  `rol_descripcion` varchar(200) DEFAULT NULL,
  `rol_estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rol`
--

LOCK TABLES `rol` WRITE;
/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
INSERT INTO `rol` VALUES (1,'01','ADMINISTRADOR DEL SISTEMA',1),(2,'02','ADMINISTRADOR',1),(3,'03','VENTAS',1);
/*!40000 ALTER TABLE `rol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rol_permiso`
--

DROP TABLE IF EXISTS `rol_permiso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rol_permiso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rol_id` int(11) NOT NULL,
  `per_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FKrol_permis500712` (`per_id`),
  KEY `FKrol_permis446711` (`rol_id`),
  CONSTRAINT `FKrol_permis446711` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`),
  CONSTRAINT `FKrol_permis500712` FOREIGN KEY (`per_id`) REFERENCES `permiso` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rol_permiso`
--

LOCK TABLES `rol_permiso` WRITE;
/*!40000 ALTER TABLE `rol_permiso` DISABLE KEYS */;
INSERT INTO `rol_permiso` VALUES (1,1,1),(2,1,3),(3,1,4),(4,1,5),(5,2,1),(6,2,4),(7,1,2),(8,1,6);
/*!40000 ALTER TABLE `rol_permiso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tercero`
--

DROP TABLE IF EXISTS `tercero`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tercero` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ter_codigo` varchar(50) DEFAULT NULL,
  `ter_descripcion` varchar(250) DEFAULT NULL,
  `ter_nombre_comercial` varchar(150) DEFAULT NULL,
  `ter_fecha_nacimiento` date DEFAULT NULL,
  `ter_ruc` varchar(11) DEFAULT NULL,
  `ter_apellido_paterno` varchar(200) DEFAULT NULL,
  `ter_apellido_materno` varchar(200) DEFAULT NULL,
  `ter_nombres` varchar(150) DEFAULT NULL,
  `ter_email` varchar(250) DEFAULT NULL,
  `ter_telefono1` varchar(25) DEFAULT NULL,
  `ter_telefono2` varchar(25) DEFAULT NULL,
  `ter_web` varchar(250) DEFAULT NULL,
  `ter_dni` char(8) DEFAULT NULL,
  `ter_direccion` varchar(250) DEFAULT NULL,
  `ter_estado` int(11) DEFAULT NULL,
  `doi_id` int(11) NOT NULL,
  `ubi_id` int(11) NOT NULL,
  `tit_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FKtercero707784` (`tit_id`),
  KEY `FKtercero841917` (`ubi_id`),
  KEY `FKtercero172551` (`doi_id`),
  CONSTRAINT `FKtercero172551` FOREIGN KEY (`doi_id`) REFERENCES `documento_identidad` (`id`),
  CONSTRAINT `FKtercero707784` FOREIGN KEY (`tit_id`) REFERENCES `tipo_tercero` (`id`),
  CONSTRAINT `FKtercero841917` FOREIGN KEY (`ubi_id`) REFERENCES `ubigeo` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tercero`
--

LOCK TABLES `tercero` WRITE;
/*!40000 ALTER TABLE `tercero` DISABLE KEYS */;
/*!40000 ALTER TABLE `tercero` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_comprobante`
--

DROP TABLE IF EXISTS `tipo_comprobante`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_comprobante` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tco_codigo` varchar(50) DEFAULT NULL,
  `tco_descripcion` varchar(200) DEFAULT NULL,
  `tco_estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_comprobante`
--

LOCK TABLES `tipo_comprobante` WRITE;
/*!40000 ALTER TABLE `tipo_comprobante` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipo_comprobante` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_movimiento`
--

DROP TABLE IF EXISTS `tipo_movimiento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_movimiento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tim_codigo` varchar(50) DEFAULT NULL,
  `tim_descripcion` varchar(200) DEFAULT NULL,
  `tim_estado` int(11) DEFAULT NULL,
  `tim_tipo` char(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_movimiento`
--

LOCK TABLES `tipo_movimiento` WRITE;
/*!40000 ALTER TABLE `tipo_movimiento` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipo_movimiento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_tercero`
--

DROP TABLE IF EXISTS `tipo_tercero`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_tercero` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tit_codigo` varchar(50) DEFAULT NULL,
  `tit_descripcion` varchar(200) DEFAULT NULL,
  `tit_estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_tercero`
--

LOCK TABLES `tipo_tercero` WRITE;
/*!40000 ALTER TABLE `tipo_tercero` DISABLE KEYS */;
INSERT INTO `tipo_tercero` VALUES (1,'01','Natural',1),(2,'02','Jurídico',1);
/*!40000 ALTER TABLE `tipo_tercero` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ubigeo`
--

DROP TABLE IF EXISTS `ubigeo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ubigeo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ubi_codigo` varchar(50) DEFAULT NULL,
  `ubi_descripcion` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ubigeo`
--

LOCK TABLES `ubigeo` WRITE;
/*!40000 ALTER TABLE `ubigeo` DISABLE KEYS */;
/*!40000 ALTER TABLE `ubigeo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unidad_medida`
--

DROP TABLE IF EXISTS `unidad_medida`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unidad_medida` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `unm_codigo` varchar(50) DEFAULT NULL,
  `unm_descripcion` varchar(200) DEFAULT NULL,
  `unm_estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unidad_medida`
--

LOCK TABLES `unidad_medida` WRITE;
/*!40000 ALTER TABLE `unidad_medida` DISABLE KEYS */;
INSERT INTO `unidad_medida` VALUES (1,'01','UNIDAD',1);
/*!40000 ALTER TABLE `unidad_medida` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `rol_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'MIGUEL SANCHEZ','shagui2607@gmail.com','2020-02-08 22:01:37','$2y$10$EJ.iM77ikVAjraSawYMiNepbDrH8rdjaxXlaq.qfDI7hX6gJ0tJ7S','auyIQPITvyL1EcPFQasog0I6GzRNSeVeZlhPkMvuXYfK5AccoTASpK8drNIh','2020-02-08 22:01:37','2020-02-11 08:23:49',1),(2,'MIGUEL LIZARDO','miguel_92_scorpio@hotmail.com',NULL,'$2y$10$iBqMcBIgMDA7aX2W1I/v6uOyg292psHa/c0/I1M5jBaB9i1ER9nqG',NULL,'2020-02-09 06:25:29','2020-02-09 06:25:29',2),(3,'FELIPE','juan@gmail.com',NULL,'$2y$10$1G/pTlr0tRmngY8bZomwBu57/KPefU3A4wPr.FZA2E7DW6lrmVrre',NULL,'2020-02-11 08:15:14','2020-02-11 08:15:14',2),(6,'CARLOS BAZAN','cbazan26@gmail.com',NULL,'$2y$10$/i/8BihgGBR5crY6PNKkM.7LbHfjntA3ohawqZ7KIQAzrw7vS3bna',NULL,'2020-07-04 20:19:29','2020-07-04 20:19:29',1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users2`
--

DROP TABLE IF EXISTS `users2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users2` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `rol_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users2`
--

LOCK TABLES `users2` WRITE;
/*!40000 ALTER TABLE `users2` DISABLE KEYS */;
/*!40000 ALTER TABLE `users2` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-07-16 12:36:20

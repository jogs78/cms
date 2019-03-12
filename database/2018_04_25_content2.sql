-- MySQL dump 10.13  Distrib 5.6.39, for Linux (x86_64)
--
-- Host: localhost    Database: content2
-- ------------------------------------------------------
-- Server version	5.6.39-cll-lve

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `accesos`
--

DROP TABLE IF EXISTS `accesos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accesos` (
  `usuario` varchar(15) COLLATE latin1_spanish_ci NOT NULL,
  `objeto` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `accion` varchar(15) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accesos`
--

LOCK TABLES `accesos` WRITE;
/*!40000 ALTER TABLE `accesos` DISABLE KEYS */;
INSERT INTO `accesos` VALUES ('jogs','COMENTARIO','CONTESTAR'),('jogs','COMENTARIO','ELIMINAR'),('jogs','CONTENIDO','AGREGAR'),('jogs','CONTENIDO','MODIFICAR'),('jogs','CONTENIDO','ELIMINAR'),('jogs','ENTRADA','AGREGAR'),('jogs','ENTRADA','MODIFICAR'),('jogs','ENTRADA','ELIMINAR'),('jogs','ENTRADA','ORDENAR'),('eanzueto','ANUNCIO','AGREGAR'),('eanzueto','ANUNCIO','MODIFICAR'),('eanzueto','ANUNCIO','ELIMINAR'),('eanzueto','NOTICIA','AGREGAR'),('eanzueto','NOTICIA','MODIFICAR'),('eanzueto','NOTICIA','ELIMINAR'),('admin','ANUNCIO','AGREGAR'),('admin','ANUNCIO','MODIFICAR'),('admin','ANUNCIO','ELIMINAR'),('admin','NOTICIA','AGREGAR'),('admin','NOTICIA','MODIFICAR'),('admin','NOTICIA','ELIMINAR'),('admin','ANUNCIOG','AGREGAR'),('admin','ANUNCIOG','MODIFICAR'),('admin','ANUNCIOG','ELIMINAR'),('admin','COMENTARIO','CONTESTAR'),('admin','COMENTARIO','ELIMINAR'),('admin','CONTENIDO','AGREGAR'),('admin','CONTENIDO','MODIFICAR'),('admin','CONTENIDO','ELIMINAR'),('admin','ENTRADA','AGREGAR'),('admin','ENTRADA','MODIFICAR'),('admin','ENTRADA','ELIMINAR'),('admin','ENTRADA','ORDENAR'),('webmaster','ANUNCIO','AGREGAR'),('webmaster','ANUNCIO','MODIFICAR'),('webmaster','ANUNCIO','ELIMINAR'),('webmaster','NOTICIA','AGREGAR'),('webmaster','NOTICIA','MODIFICAR'),('webmaster','NOTICIA','ELIMINAR'),('webmaster','ANUNCIOG','AGREGAR'),('webmaster','ANUNCIOG','MODIFICAR'),('webmaster','ANUNCIOG','ELIMINAR'),('webmaster','COMENTARIO','CONTESTAR'),('webmaster','COMENTARIO','ELIMINAR'),('webmaster','CONTENIDO','AGREGAR'),('webmaster','CONTENIDO','MODIFICAR'),('webmaster','CONTENIDO','ELIMINAR'),('webmaster','ENTRADA','AGREGAR'),('webmaster','ENTRADA','MODIFICAR'),('webmaster','ENTRADA','ELIMINAR'),('webmaster','ENTRADA','ORDENAR');
/*!40000 ALTER TABLE `accesos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accion`
--

DROP TABLE IF EXISTS `accion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accion` (
  `id` int(4) NOT NULL,
  `descripcion` varchar(10) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accion`
--

LOCK TABLES `accion` WRITE;
/*!40000 ALTER TABLE `accion` DISABLE KEYS */;
INSERT INTO `accion` VALUES (1,'AGREGAR'),(2,'MODIFICAR'),(3,'ELIMINAR'),(4,'CONTESTAR'),(5,'ORDENAR'),(6,'LISTAR'),(8,'PROPONER'),(9,'REVISAR'),(10,'VER'),(11,'ENTRADA'),(12,'SALIDA'),(13,'PERMITIR'),(14,'CAMBIAR'),(15,'RECORDAR');
/*!40000 ALTER TABLE `accion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `anuncio`
--

DROP TABLE IF EXISTS `anuncio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `anuncio` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
  `p01` text COLLATE latin1_spanish_ci,
  `img1` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `img2` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `img3` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `img4` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `img5` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `img6` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `img7` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `img8` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `img9` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `doc1` varchar(35) COLLATE latin1_spanish_ci DEFAULT NULL,
  `doc2` varchar(35) COLLATE latin1_spanish_ci DEFAULT NULL,
  `doc3` varchar(35) COLLATE latin1_spanish_ci DEFAULT NULL,
  `doc4` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `ima1` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `ima2` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `ima3` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `ima4` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `fecha` date DEFAULT '2007-08-09',
  `nuevo` int(1) NOT NULL DEFAULT '2',
  `publico` tinyint(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci COMMENT='anuncios';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `anuncio`
--

LOCK TABLES `anuncio` WRITE;
/*!40000 ALTER TABLE `anuncio` DISABLE KEYS */;
/*!40000 ALTER TABLE `anuncio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `anunciog`
--

DROP TABLE IF EXISTS `anunciog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `anunciog` (
  `img` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `titulo` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  `tipo` int(4) DEFAULT NULL,
  `id` int(4) DEFAULT NULL,
  `fecha` date DEFAULT '2008-01-01',
  `idg` int(4) NOT NULL AUTO_INCREMENT,
  `central` int(1) DEFAULT '0',
  `der` int(1) DEFAULT '0',
  `izq` int(1) DEFAULT '0',
  `url` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
  `orden` int(3) DEFAULT '0',
  PRIMARY KEY (`idg`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci COMMENT='anunciosg';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `anunciog`
--

LOCK TABLES `anunciog` WRITE;
/*!40000 ALTER TABLE `anunciog` DISABLE KEYS */;
/*!40000 ALTER TABLE `anunciog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `bitacora`
--

DROP TABLE IF EXISTS `bitacora`;
/*!50001 DROP VIEW IF EXISTS `bitacora`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `bitacora` AS SELECT 
 1 AS `FECHA`,
 1 AS `HORA`,
 1 AS `USUARIO`,
 1 AS `OBJETO`,
 1 AS `ACCION`,
 1 AS `QUERY`,
 1 AS `ID`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `comentario`
--

DROP TABLE IF EXISTS `comentario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comentario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `titulo` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `comentario` text COLLATE latin1_spanish_ci NOT NULL,
  `nombre` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comentario`
--

LOCK TABLES `comentario` WRITE;
/*!40000 ALTER TABLE `comentario` DISABLE KEYS */;
/*!40000 ALTER TABLE `comentario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contenido`
--

DROP TABLE IF EXISTS `contenido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contenido` (
  `id` int(4) NOT NULL,
  `p01` text COLLATE latin1_spanish_ci,
  `img1` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `img2` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `img3` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `img4` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `img5` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `img6` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `img7` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `img8` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `img9` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `doc1` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `doc2` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `doc3` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `doc4` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `ima1` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `ima2` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `ima3` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `ima4` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `fecha` varchar(10) COLLATE latin1_spanish_ci DEFAULT '02/08/2007',
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `actualizado` varchar(10) COLLATE latin1_spanish_ci DEFAULT NULL,
  `fot0` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `fot1` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `fot2` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `fot3` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `fot4` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `fot5` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `fot6` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `fot7` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `fot8` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `fot9` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci COMMENT='el texto';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contenido`
--

LOCK TABLES `contenido` WRITE;
/*!40000 ALTER TABLE `contenido` DISABLE KEYS */;
INSERT INTO `contenido` VALUES (2,'<p style=\"font-weight: bold\" align=\"center\">Historia</p>\r\n<p>&nbsp;</p>\r\n<p>En la d&eacute;cada de los 70&rsquo;s, se incorpora el estado de Chiapas al movimiento educativo nacional extensi&oacute;n educativa, por intervenci&oacute;n del Gobierno del Estado de Chiapas ante la federaci&oacute;n.<br /><br />Esta gesti&oacute;n dio origen a la creaci&oacute;n del Instituto Tecnol&oacute;gico Regional de Tuxtla Guti&eacute;rrez (ITRTG) hoy Instituto Tecnol&oacute;gico de Tuxtla Guti&eacute;rrez (ITTG).<br /><br />El d&iacute;a 23 de agosto de 1971 el Gobernador del Estado, Dr. Manuel Velasco Su&aacute;rez, coloc&oacute; la primera piedra de lo que muy pronto ser&iacute;a el Centro Educativo de nivel medio superior m&aacute;s importante de la entidad.<br /><br />El d&iacute;a 22 de octubre de 1972, con una infraestructura de 2 edificios con 8 aulas, 2 laboratorios y un edificio para talleres abre sus puertas el Instituto Tecnol&oacute;gico de Tuxtla Guti&eacute;rrez con las carreras de T&eacute;cnico en M&aacute;quinas de Combusti&oacute;n Interna, Electricidad, Laboratorista Qu&iacute;mico y M&aacute;quinas y Herramientas.<br /><br />En el a&ntilde;o 1974 dio inicio la modalidad en el nivel superior, ofreciendo las carrera de Ingenier&iacute;a Industrial en Producci&oacute;n y Bioqu&iacute;mica en Productos Naturales.<br />En 1980 se ampli&oacute; la oferta educativa al incorporarse las carreras de Ingenier&iacute;a Industrial El&eacute;ctrica e Ingenier&iacute;a Industrial Qu&iacute;mica.<br /><br />En 1987 se abre la carrera de Ingenier&iacute;a en Electr&oacute;nica y se liquidan en 1989 las carreras del sistema abierto del nivel medio superior y en el nivel superior se reorient&oacute; la oferta en la carrera de Ingenier&iacute;a Industrial El&eacute;ctrica y se inicia tambi&eacute;n Ingenier&iacute;a Mec&aacute;nica.</p>\r\n<p>En 1991 surge la licenciatura en Ingenier&iacute;a en Sistemas Computacionales.<br /><br />Desde 1997 el Instituto Tecnol&oacute;gico de Tuxtla Guti&eacute;rrez ofrece la Especializaci&oacute;n en Ingenier&iacute;a Ambiental como primer programa de postgrado.</p>\r\n<p>En 1998 se estableci&oacute; el programa interinstitucional de postgrado con la Universidad Aut&oacute;noma de Chiapas para impartir en el Instituto Tecnol&oacute;gico la Maestr&iacute;a en Biotecnolog&iacute;a.<br /><br />En el a&ntilde;o 1999 se inici&oacute; el programa de Maestr&iacute;a en Administraci&oacute;n como respuesta a la demanda del sector industrial y de servicios de la regi&oacute;n.</p>\r\n<p>A partir de 2000 se abri&oacute; tambi&eacute;n la Especializaci&oacute;n en Biotecnolog&iacute;a Vegetal y un a&ntilde;o despu&eacute;s dio inicio el programa de Maestr&iacute;a en Ciencias en Ingenier&iacute;a Bioqu&iacute;mica y la Licenciatura en Inform&aacute;tica.<br /><br /><a href=\"contenido.php?id=1&amp;libre=1\">Escudo</a> del Instituto Tecnol&oacute;gico de Tuxtla Guti&eacute;rrez</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>Como llegar? <a href=\"http://maps.google.es/maps/ms?f=q&amp;hl=es&amp;geocode=&amp;ie=UTF8&amp;t=h&amp;g=tuxtla+gutierrez+chiapas+mexico&amp;msa=0&amp;msid=116483312603248095203.00045ad1687d898d5509a&amp;ll=16.758831,-93.17256&amp;spn=0.009801,0.01914&amp;z=16\">aqui</a></p>\r\n<p>&nbsp;</p>\r\n<hr />','2_c_1.png','2_c_2.jpg','2_c_3.JPG','2_c_4.JPG','2_c_5.JPG','2_c_6.JPG','2_c_7.JPG','2_c_8.JPG',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'31/7/2007',1,'','','','','','','','','','',''),(3,'<p align=\"center\"><strong>Ingenier&iacute;a en Gesti&oacute;n Empresarial</strong></p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><strong>OBJETIVO GENERAL:</strong></p>\r\n<p>Formar integralmente con enfoque en competencias a los estudiantes de esta carrera, en las &aacute;reas clave de empresas peque&ntilde;as, medianas y grandes, para la toma de decisiones eficientes y eficaces, con actitud de logro y alto desempe&ntilde;o, en un entorno global.</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><strong>PERFIL DE EGRESO:</strong></p>\r\n<p>&nbsp;</p>\r\n<p><em>Competencias Espec&iacute;ficas</em></p>\r\n<div style=\"margin-left: 30px\">\r\n<p><br />1. Dise&ntilde;a e implementa estrategias financieras en un mercado global<br />2. Gestiona sistemas de producci&oacute;n<br />3. Dise&ntilde;a e implementa estrategias de mercadotecnia<br />4. Dirige el desempe&ntilde;o de organizamos empresariales<br />5. Aplica herramientas b&aacute;sicas de la ingenier&iacute;a de la gesti&oacute;n<br />6. Gestiona la creaci&oacute;n de nuevos negocios.</p>\r\n</div>\r\n<p>&nbsp;</p>\r\n<p><em>Competencias Gen&eacute;ricas</em></p>\r\n<div style=\"margin-left: 30px\">\r\n<p><br />1. Se comunica en el idioma ingl&eacute;s<br />2. Emplea nuevas tecnolog&iacute;as de informaci&oacute;n y comunicaci&oacute;n<br />3. Se comunica con asertividad en forma oral y escrita en su propia lengua<br />4. Abstrae, analiza y sintetiza informaci&oacute;n<br />5. Identifica, plantea y resuelve problemas<br />6. Toma decisiones en forma efectiva<br />7. Evidencia su compromiso &eacute;tico<br />8. Trabaja en equipo<br />9. Maneja relaciones interpersonales en forma efectiva<br />10. Autogesti&oacute;n de su aprendizaje y actualizaci&oacute;n continua<br />11. Ejerce liderazgo efectivo<br />12. Denota esp&iacute;ritu emprendedor<br />13. Gestiona modelos y sistemas de calidad<br />14. Realiza investigaci&oacute;n.</p>\r\n</div>\r\n<p>&nbsp;</p>\r\n<p><strong>Curricula </strong></p>\r\n<p>ret&iacute;cula oficial [_d2]</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>',NULL,NULL,NULL,'3img4contenido.pdf',NULL,NULL,NULL,NULL,NULL,'3doc1contenido.pdf','3doc2contenido.pdf',NULL,NULL,NULL,NULL,NULL,NULL,'2009-11-25',1,'25/11/2009','','','','','','','','','',''),(4,'<p>P&aacute;gina en construcci&oacute;n</p>',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2008-11-26',1,'','','','','','','','','','',''),(5,'<p style=\"text-align: center;\"><strong>Directorio</strong></p>\r\n<p style=\"text-align: center;\"><strong>\r\n<p><strong><strong></strong></strong></p>\r\n<table border=\"1\" cellspacing=\"0\" cellpadding=\"0\" width=\"529\">\r\n<tbody>\r\n<tr>\r\n<td width=\"348\">\r\n<p><strong>Nombre y Cargo</strong></p>\r\n</td>\r\n<td>\r\n<p><strong>Ext.</strong></p>\r\n</td>\r\n<td>\r\n<p><strong>Correo electr&oacute;nico</strong></p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"348\">\r\n<p>Ing. Jos&eacute; Luis Herrera Mart&iacute;nez<br /><strong>Director del I.T.T.G.</strong></p>\r\n</td>\r\n<td>\r\n<p>100</p>\r\n</td>\r\n<td>\r\n<p>director*</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"348\">\r\n<p>Psic. Adriana Gonz&aacute;lez Escobar <br /><strong>Subdirectora Acad&eacute;mica </strong></p>\r\n</td>\r\n<td>\r\n<p>300</p>\r\n</td>\r\n<td>\r\n<p>subacadem*</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"348\">\r\n<p>M.C. Ignacio Arrioja Cardenas<br /><strong>Subdirector de Planeaci&oacute;n y Vinculaci&oacute;n </strong></p>\r\n</td>\r\n<td>\r\n<p>400</p>\r\n</td>\r\n<td>\r\n<p>subplanea*</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"348\">\r\n<p>M. C. Miguel Cid del Prado Mart&iacute;nez<br /><strong>Subdirector de Servicios Administrativos </strong></p>\r\n</td>\r\n<td>\r\n<p>200</p>\r\n</td>\r\n<td>\r\n<p>subadmon*</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"348\">\r\n<p>Dr. Daniel Samayoa Penagos<br /><strong>Jefe del Depto. de Comunicaci&oacute;n y Difusi&oacute;n </strong></p>\r\n</td>\r\n<td>\r\n<p>404</p>\r\n</td>\r\n<td>\r\n<p>difusion*</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"348\">\r\n<p>Ing. Roberto Cifuentes Villafuerte<strong></strong></p>\r\n<p><strong>Jefe de la Divisi&oacute;n de Estudios Profesionales </strong></p>\r\n</td>\r\n<td>\r\n<p>303</p>\r\n</td>\r\n<td>\r\n<p>division*</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"348\">\r\n<p>C.P. Melquiceded Dom&iacute;nguez Hol&aacute;n <br /><strong>Jefe del Depto. de Recursos Financieros </strong></p>\r\n</td>\r\n<td>\r\n<p>209</p>\r\n</td>\r\n<td>\r\n<p>finanzas*</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"348\">\r\n<p>Ing. Francisco de Jes&uacute;s Suarez Ruiz <br /><strong>Jefe del Depto. de Activ. Extraescolares </strong></p>\r\n</td>\r\n<td>\r\n<p>402</p>\r\n</td>\r\n<td>\r\n<p>extraescolar*</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"348\">\r\n<p>M.C. Ren&eacute; R&iacute;os Couti&ntilde;o <br /><strong>Jefe del Depto. de Recursos Humanos </strong></p>\r\n</td>\r\n<td>\r\n<p>210</p>\r\n</td>\r\n<td>\r\n<p>humanos*</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"348\">\r\n<p>C.P. Agust&iacute;n V&aacute;zquez Morales<br /><strong>Jefe del Depto. de Recursos Materiales y Servicios</strong></p>\r\n</td>\r\n<td>\r\n<p>212</p>\r\n</td>\r\n<td>\r\n<p>materiales*</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"348\">\r\n<p>M.C. A&iacute;da Guillermina Coss&iacute;o Mart&iacute;nez <br /><strong>Jefa del Depto. de Ingenier&iacute;a en Sistemas Computacionales </strong></p>\r\n</td>\r\n<td>\r\n<p>319</p>\r\n</td>\r\n<td>\r\n<p>sistemas*</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"348\">\r\n<p>Dr. H&eacute;ctor Ricardo Hern&aacute;ndez de Le&oacute;n<br /><strong>Jefe de la Div. de Est.. Invest. y Posgrado </strong></p>\r\n</td>\r\n<td>\r\n<p>306</p>\r\n</td>\r\n<td>\r\n<p>posgrado*</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"348\">\r\n<p>C.P. Liliana Patricia Moreno Cancino <br /><strong>Jefa del Depto. de Planeaci&oacute;n, Programaci&oacute;n y Presupuestaci&oacute;n </strong></p>\r\n</td>\r\n<td>\r\n<p>406</p>\r\n</td>\r\n<td>\r\n<p>planea*</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"348\">\r\n<p>Ing. Vicente Le&oacute;n Orozco<br /><strong>Jefe Depto. de Ing. El&eacute;ctrica y Electr&oacute;nica </strong></p>\r\n</td>\r\n<td>\r\n<p>311</p>\r\n</td>\r\n<td>\r\n<p>eleyeca*</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"348\">\r\n<p>Ing. Carlos Ram&oacute;n Alfonzo Santiago</p>\r\n<p><strong>Jefe del Depto. de Mantenimiento de Equipo </strong></p>\r\n</td>\r\n<td>\r\n<p>207</p>\r\n</td>\r\n<td>\r\n<p>mantto*</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"348\">\r\n<p>Ing. Javier Ram&iacute;rez D&iacute;az <br /><strong>Jefe del Depto. de Ing. Qu&iacute;mica y Bioqu&iacute;mica</strong></p>\r\n</td>\r\n<td>\r\n<p>316</p>\r\n</td>\r\n<td>\r\n<p>quimica*</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"348\">\r\n<p>M.C. Apolinar P&eacute;rez L&oacute;pez<br /><strong>Jefe del Depto. de Metalmec&aacute;nica </strong></p>\r\n</td>\r\n<td>\r\n<p>315</p>\r\n</td>\r\n<td>\r\n<p>mecanica*</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"348\">\r\n<p>Ing. Jorge Octavio Guzm&aacute;n S&aacute;nchez <br /><strong>Jefe del Centro de C&oacute;mputo </strong></p>\r\n</td>\r\n<td>\r\n<p>205</p>\r\n</td>\r\n<td>\r\n<p>computo*</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"348\">\r\n<p>Ing. Jorge Antonio Orozco Torres <br /><strong>Jefe del Depto. de Ing. Industrial </strong></p>\r\n</td>\r\n<td>\r\n<p>313</p>\r\n</td>\r\n<td>\r\n<p>industrial*</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"348\">\r\n<p>Lic. Edna Morales Couti&ntilde;o<br /><strong>Jefa del Depto. de Desarrollo Acad&eacute;mico </strong></p>\r\n</td>\r\n<td>\r\n<p>308</p>\r\n</td>\r\n<td>\r\n<p>desacad*</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"348\">\r\n<p>M. C. Raquel Camacho M&eacute;ndez<br /><strong>Jefa del Depto. de Ciencias B&aacute;sicas </strong></p>\r\n</td>\r\n<td>\r\n<p>307</p>\r\n</td>\r\n<td>\r\n<p>basicas*</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"348\">\r\n<p>Lic. Mar&iacute;a Isabel Palacios Trujillo <br /><strong>Jefa del Depto. de Servicios Escolares </strong></p>\r\n</td>\r\n<td>\r\n<p>407</p>\r\n</td>\r\n<td>\r\n<p>descolares*</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"348\">\r\n<p>Lic. Ren&eacute; Arj&oacute;n Castro <br /><strong>Jefe del Centro de Informaci&oacute;n </strong></p>\r\n</td>\r\n<td>\r\n<p>403</p>\r\n</td>\r\n<td>\r\n<p>biblioteca*</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"348\">\r\n<p>M.C. Roberto Carlos Garc&iacute;a G&oacute;mez<br /><strong>Jefe del Depto. Gesti&oacute;n Tecnol&oacute;gica y Vinculaci&oacute;n </strong></p>\r\n</td>\r\n<td>\r\n<p>405</p>\r\n</td>\r\n<td>\r\n<p>gestion*</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"348\">\r\n<p>Ing. Mar&iacute;a Delina Culebro Farrera<br /><strong>Jefa del Depto. Econ&oacute;mico - Administrativo </strong></p>\r\n</td>\r\n<td>\r\n<p>320</p>\r\n</td>\r\n<td>\r\n<p>informatica*</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"348\">\r\n<p>Ing. Jorge Arturo Sarmiento Torres <br /><strong>Oficina de Innovaci&oacute;n y Calidad <br />Representante de la Direcci&oacute;n </strong></p>\r\n</td>\r\n<td>\r\n<p>305</p>\r\n</td>\r\n<td>\r\n<p>sgcittg*</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</strong></p>\r\n<p>&nbsp;</p>\r\n<p><br />*Todos los correos son @ ittg.edu.mx</p>','5_c_1.png','5_c_2.JPG','5_c_3.jpg','5_c_4.JPG','5_c_5.JPG','5_c_6.JPG','5_c_7.JPG','5_c_8.JPG','5img9contenido.jpg',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2009-11-23',1,'26/01/2010','','','','','','','','','',''),(6,'<p style=\"font-weight: bold\" align=\"center\">Departamento de Servicios Escolares</p><p>&nbsp;</p><p>El Departamento de Servicios Escolares es el encargado de realizar todos los tr&aacute;mites relacionados con el alumno, desde que se inscribe al Instituto hasta que se titula, en esta secci&oacute;n podr&aacute;s enterarte de todos los proceso que se desarrollan en este departamento.</p>','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'02/08/2007',1,'','','','','','','','','','',''),(7,'<p style=\"font-weight: bold\" align=\"center\">Sistema de Gesti&oacute;n de Calidad</p>\r\n<p>&nbsp;</p>\r\n<p style=\"font-weight: bold\">INTRODUCCI&Oacute;N:</p>\r\n<p>&nbsp;</p>\r\n<p>La Secretar&iacute;a de Educaci&oacute;n P&uacute;blica, en el af&aacute;n de garantizar la calidad de la educaci&oacute;n superior p&uacute;blica, impulsa programas extraordinarios a trav&eacute;s de los cuales se pretende atender la demanda de educaci&oacute;n superior, ofreciendo servicio educativo con Calidad. Entre los objetivos estrat&eacute;gicos que se alcanzar&aacute;n hacia el 2006 a trav&eacute;s de estos programas especiales, se encuentran la ampliaci&oacute;n de cobertura con equidad, calidad de planes y programas de estudio, as&iacute; como los servicios que ofrecen las IES p&uacute;blicas y la integraci&oacute;n, coordinaci&oacute;n y gesti&oacute;n del sistema de educaci&oacute;n superior.<br />El Instituto Tecnol&oacute;gico de Tuxtla Guti&eacute;rrez ha hecho patente siempre su compromiso con la sociedad y con los j&oacute;venes de Chiapas y M&eacute;xico, en respuesta a estos retos, a principios del 2004 implement&oacute; el Programa de Innovaci&oacute;n y Calidad y en Diciembre de ese mismo a&ntilde;o, inici&oacute; la implementaci&oacute;n de su Sistema de Gesti&oacute;n de la Calidad basado en la norma ISO 9001:2000, incorporando as&iacute; las herramientas necesarias para responder con &eacute;xito las exigencias del mundo actual.<br /><br />El personal directivo, docentes, de apoyo administrativo y alumnos, est&aacute;n unidos en este esfuerzo por consolidar al Instituto Tecnol&oacute;gico de Tuxtla Guti&eacute;rrez como una Instituci&oacute;n reconocida por la calidad de sus servicios educativos a trav&eacute;s de la Certificaci&oacute;n de su Proceso Educativo, conforme a la Norma ISO 9001:2000.</p>\r\n<p>&nbsp;</p>\r\n<p style=\"font-weight: bold\">Pol&iacute;tica de Calidad</p>\r\n<p>&nbsp;</p>\r\n<p>El SNEST establece el compromiso de implementar todos sus procesos, orient&aacute;ndolos hacia la satisfacci&oacute;n de sus clientes sustentada en la Calidad del Proceso Educativo, para cumplir con sus requerimientos mediante la eficacia de un Sistema de Gesti&oacute;n de la Calidad y de mejora continua, conforme a la norma ISO 9001:2000/NMX-CC-9001-IMNC-2000.</p>\r\n<p>&nbsp;</p>\r\n<p style=\"font-weight: bold\">Los valores de la Organizaci&oacute;n son:</p>\r\n<p>&nbsp;</p>\r\n<ul>\r\n<li>El ser humano</li>\r\n<li>El esp&iacute;ritu de servicio</li>\r\n<li>El liderazgo</li>\r\n<li>El Trabajo en equipo</li>\r\n<li>La calidad</li>\r\n<li>Alto desempe&ntilde;o</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p style=\"font-weight: bold; font-style: italic\" align=\"center\">Objetivos de la Calidad</p>\r\n<p>&nbsp;</p>\r\n<p style=\"font-weight: bold\">Objetivo General:</p>\r\n<p>&nbsp;</p>\r\n<p>&ldquo;Proporcionar el Servicio Educativo de Calidad, orientado hacia el Aprendizaje significativo en el alumno&rdquo;.</p>\r\n<p>&nbsp;</p>\r\n<p style=\"font-weight: bold; font-style: italic\" align=\"center\">Objetivos de Procesos Estrat&eacute;gicos</p>\r\n<p>&nbsp;</p>\r\n<p><span style=\"font-weight: bold\">Acad&eacute;mico:</span></p>\r\n<p>&nbsp;</p>\r\n<p>Gestionar los Planes y Programas de Estudio, as&iacute; como los programas de formaci&oacute;n y actualizaci&oacute;n docente y profesional en el servicio educativo.</p>\r\n<p>&nbsp;</p>\r\n<p style=\"font-weight: bold\">Planeaci&oacute;n:</p>\r\n<p>&nbsp;</p>\r\n<p>Definir el rumbo estrat&eacute;gico mediante la planeaci&oacute;n y realizar la programaci&oacute;n, presupuestaci&oacute;n, seguimiento y evaluaci&oacute;n de las acciones para cumplir con los requisitos del servicio.</p>\r\n<p>&nbsp;</p>\r\n<p><span style=\"font-weight: bold\">Vinculaci&oacute;n y Difusi&oacute;n de la Cultura:</span></p>\r\n<p>&nbsp;</p>\r\n<p>Contribuir a la formaci&oacute;n integral del Alumno, a trav&eacute;s de su vinculaci&oacute;n con el sector productivo y la sociedad, as&iacute; como del deporte y la cultura.</p>\r\n<p>&nbsp;</p>\r\n<p style=\"font-weight: bold\">Administraci&oacute;n de recursos:</p>\r\n<p>&nbsp;</p>\r\n<p>Determinar y proporcionar los recursos necesarios para implementar, mantener y mejorar el SGC y lograr la conformidad con los requisitos del Servicio Educativo.</p>\r\n<p>&nbsp;</p>\r\n<p style=\"font-weight: bold\">Innovaci&oacute;n y Calidad:</p>\r\n<p>&nbsp;</p>\r\n<p>Promover una cultura de calidad al interior de la ORGANIZACI&Oacute;N y asegurar la satisfacci&oacute;n del alumno.</p>\r\n<p>&nbsp;</p>\r\n<p><a href=\"http://148.208.246.250/sgc/formatos/\">Formatos</a></p>','7_c_1.JPG','7_c_sgc.jpg','7_c_sgc1.jpg','7_c_sgc2.jpg','7_c_sgc3.jpg',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'31/31/2007',1,'','','','','','','','','','',''),(9,'SECCION QUE ESTA EN DESARROLLO DESDE QUE NACIO....',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'04/08/2007',1,'','','','','','','','','','',''),(11,'<p style=\"font-weight: bold\" align=\"center\">Ingenier&iacute;a Bioqu&iacute;mica</p>\r\n<p>&nbsp;</p>\r\n<p style=\"font-weight: bold\">Objetivo General de la Carrera:</p>\r\n<p>&nbsp;</p>\r\n<p>Formar profesionales que, con sentido critico, apliquen los principios y m&eacute;todos de la Ingenier&iacute;a Bioqu&iacute;mica para el aprovechamiento racional e integral de los recursos bi&oacute;ticos, en la producci&oacute;n de bienes y servicios que contribuyen a elevar el nivel de vida de la sociedad.</p>\r\n<p>&nbsp;</p>\r\n<p style=\"font-weight: bold\">Que hacer Profesional:</p>\r\n<p><br />Se prev&eacute; que la Ingenier&iacute;a Bioqu&iacute;mica tenga un fuerte desarrollo en sectores industriales como procesamiento de alimentos y procesos de fermentaci&oacute;n y farmac&eacute;uticos; as&iacute; mismo se espera un potencial desarrollo en actividades emergentes tales como ingenier&iacute;a gen&eacute;tica, biotecnolog&iacute;a vegetal, cultivo de c&eacute;lulas y tejidos animales y la biog&eacute;netica.</p>\r\n<p>&nbsp;</p>\r\n<p>La apertura econ&oacute;mica del pa&iacute;s trae consigo mayores niveles de competencia que demanda la generaci&oacute;n, innovaci&oacute;n, adquisici&oacute;n, difusi&oacute;n y adaptaci&oacute;n de nuevas tecnolog&iacute;as, por lo que se requieren recursos humanos capacitados que sepan aprovechar plenamente el potencial t&eacute;cnico y econ&oacute;mico de las nuevas tecnolog&iacute;as.</p>\r\n<p>&nbsp;</p>\r\n<p>En M&eacute;xico, el numero de profesionales en este campo es significativamente reducido, por lo que las perspectivas son favorables.</p>\r\n<p>&nbsp;</p>\r\n<p style=\"font-weight: bold\">Campo de Trabajo:</p>\r\n<p>&nbsp;</p>\r\n<p>Los egresados pueden desenvolverse en el sector industrial, por ejemplo en empresas procesadoras de alimentos (empacadoras, enlatadoras, congeladoras, etc.) de fermentaci&oacute;n (productoras de vino, cerveza, antibi&oacute;ticos, amino&aacute;cidos, enzimas, &aacute;cidos org&aacute;nicos, levadura, etc.) farmac&eacute;uticos, de productos biol&oacute;gicos (vacunas, hemoderivados), entre otras.</p>\r\n<p>&nbsp;</p>\r\n<p>En el sector acad&eacute;mico y de investigaci&oacute;n, sus potenciales de desarrollo son los campos tradicionales, ciencia y tecnolog&iacute;a de alimentos, tecnolog&iacute;a microbiana, y tecnolog&iacute;a de enzimas, pero tambi&eacute;n los campos emergentes, como la ingenier&iacute;a gen&eacute;tica, la biotecnolog&iacute;a vegetal y el cultivo de vegetal y el cultivo de c&eacute;lulas y tejidos animales.</p>\r\n<p>&nbsp;</p>\r\n<p style=\"font-weight: bold\">Campo de trabajo en el estado:</p>\r\n<p>&nbsp;</p>\r\n<ul>\r\n<li>Proceso de frutas y hortalizas</li>\r\n<li>Procesamiento de carnes</li>\r\n<li>Procesos de l&aacute;cteos</li>\r\n<li>Proceso de cereales</li>\r\n<li>Planta elaboradora de alimentos balanceados</li>\r\n<li>Planta productora de ma&iacute;z</li>\r\n<li>Planta productora de harina de trigo</li>\r\n<li>Industria extractiva de aceite vegetal</li>\r\n<li>Ingenios azucareros</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p>Todo lo relacionado a la industria agropecuaria</p>\r\n<p>&nbsp;</p>\r\n<p style=\"font-weight: bold\">Plan de estudios</p>\r\n<p style=\"font-weight: bold\">&nbsp;</p>\r\n<p>ret&iacute;cula oficial [_d1]</p>\r\n<p>ret&iacute;cula con materias de especialidad [_d2]</p>\r\n<p>&nbsp;</p>\r\n<p style=\"font-weight: bold\">Duraci&oacute;n de la Carrera:</p>\r\n<p>&nbsp;</p>\r\n<p>La duraci&oacute;n prevista para estudiar la carrera es de 9 semestres, pudiendo el alumno adelantar asignaturas despu&eacute;s del primero y concluir el plan de estudios en menor tiempo, dependiendo de la carga acad&eacute;mica cursada en cada periodo, no debiendo, por otro lado, excederse de 12 semestres.</p>\r\n<p>[_i1]</p>','11_c_1.jpg','11_c_2.jpg','11_c_3.JPG','11_c_4.JPG','11_c_5.JPG','11_c_6.jpg','11_c_7.jpg','11_c_8.JPG',NULL,'11doc1contenido.pdf','11doc2contenido.pdf',NULL,NULL,'11_p_cintillo2.jpg',NULL,NULL,NULL,'02/08/2007',1,'07/01/2009','','','','','','','','','',''),(12,'<p style=\"font-weight: bold\" align=\"center\">Ingenier&iacute;a Quimica</p>\r\n<p>&nbsp;</p>\r\n<p style=\"font-weight: bold\">Objetivo General de la Carrera:</p>\r\n<p>&nbsp;</p>\r\n<p>Formar profesionales que, con sentido critico, apliquen los principios y m&eacute;todos de la Ingenier&iacute;a Qu&iacute;mica.</p>\r\n<p>&nbsp;</p>\r\n<p style=\"font-weight: bold\">Quehacer Profesional:</p>\r\n<p>&nbsp;</p>\r\n<p>La Ingenier&iacute;a Qu&iacute;mica tiene un importante papel en la producci&oacute;n y aplicaci&oacute;n de nuevos materiales, de esquemas flexibles de producci&oacute;n en biotecnolog&iacute;a y control de contaminantes, entre otros.</p>\r\n<p>&nbsp;</p>\r\n<p>Como campo profesional ha sido uno de los pilares b&aacute;sicos del desarrollo de los pa&iacute;ses industrializados.</p>\r\n<p>&nbsp;</p>\r\n<p>En nuestro pa&iacute;s, ha contribuido al desarrollo de la industria petrolera y petroqu&iacute;mica obteni&eacute;ndose avances significativos en la ingenier&iacute;a b&aacute;sica y de detalle, comparables con el desarrollo alcanzado por los pa&iacute;ses mas avanzados en este rubro.</p>\r\n<p>&nbsp;</p>\r\n<p>En Chiapas se requiere impulsar a la agroindustria, bajo un desarrollo sustentable, d&aacute;ndole as&iacute;, relevancia a la generaci&oacute;n de empleos y aprovechamiento integral de los recursos agropecuarios.</p>\r\n<p>&nbsp;</p>\r\n<p style=\"font-weight: bold\">Campo de Trabajo:</p>\r\n<p>&nbsp;</p>\r\n<p>El egresado de la carrera de Ingenier&iacute;a Qu&iacute;mica, estar&aacute; capacitado para integrarse, con &eacute;xito a: empresas p&uacute;blicas y privadas, laboratorios de investigaci&oacute;n, industrias extractivas y de transformaci&oacute;n e industrias de procesos qu&iacute;micos ubicados en todo el pa&iacute;s.</p>\r\n<p>&nbsp;</p>\r\n<p>Tambi&eacute;n esta preparado para iniciar su propia empresa, en el &aacute;rea agroindustrial, adem&aacute;s podr&aacute; coadyuvar en la formaci&oacute;n de nuevos profesionales en instituciones educativas.</p>\r\n<p>&nbsp;</p>\r\n<p>El ingeniero qu&iacute;mico podr&aacute; participar en equipos multidisciplinarios para la planificaci&oacute;n, formulaci&oacute;n y ejecuci&oacute;n de proyectos que resuelvan la problem&aacute;tica estatal y regional del desarrollo sustentable.</p>\r\n<p>&nbsp;</p>\r\n<p><span style=\"font-weight: bold\">Plan de estudios</span>:</p>\r\n<p>ret&iacute;cula oficial <a href=\"#\">[_d1]</a></p>\r\n<p>ret&iacute;cula con materias de especialidad [_d2]</p>\r\n<p>&nbsp;</p>\r\n<p style=\"font-weight: bold\">Duraci&oacute;n de la Carrera</p>\r\n<p>&nbsp;</p>\r\n<p>La duraci&oacute;n prevista para estudiar la carrera es de 9 semestres pudiendo el alumno adelantar asignaturas despu&eacute;s del primero y concluir el plan de estudios en menos tiempo dependiendo de la carga acad&eacute;mica cursada en cada el periodo, no debiendo, por otro lado, excederse de los doce semestres.</p>\r\n<p>&nbsp;</p>','12_c_1.jpg','12_c_2.jpg',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'12doc1contenido.pdf','12doc2contenido.pdf',NULL,NULL,'12_p_cintillo.jpg',NULL,NULL,NULL,'02/08/2007',1,'07/01/2009','','','','','','','','','',''),(13,'<p style=\"font-weight: bold\" align=\"center\">Ingenier&iacute;a El&eacute;ctrica</p>\r\n<p>&nbsp;</p>\r\n<p style=\"font-weight: bold\">Objetivo General de la Carrera:</p>\r\n<p><br />Formar profesionales en Ingenier&iacute;a El&eacute;ctrica con capacidad anal&iacute;tica, creativa, emprendedora y competitiva que le permitan administrar, proyectar, dise&ntilde;ar, construir, operar y mantener equipos y sistemas el&eacute;ctricos; comprometidos con la calidad, la &eacute;tica y el desarrollo sustentable.</p>\r\n<p>&nbsp;</p>\r\n<p style=\"font-weight: bold\">Perfil Profesional:</p>\r\n<p>&nbsp;</p>\r\n<p>Con base en el desempe&ntilde;o esperado para un Ingeniero Electricista, a continuaci&oacute;n se presentan los principales rasgos que definen su perfil, bajo la forma del tipo de actividades que desarrolla, de las habilidades indispensables para su desempe&ntilde;o y de actitudes importantes para lograr los prop&oacute;sitos de este profesionista.</p>\r\n<p>&nbsp;</p>\r\n<ul>\r\n<li>Dise&ntilde;ar, construir, operar y mantener sistemas de generaci&oacute;n, transformaci&oacute;n y distribuci&oacute;n de energ&iacute;a el&eacute;ctrica.</li>\r\n<li>Planear, dise&ntilde;ar, construir y mantener instalaciones el&eacute;ctricas industriales, comerciales, residenciales y de servicios.</li>\r\n<li>Seleccionar, especificar y adaptar tecnolog&iacute;a, equipos y materiales para su instalaci&oacute;n, operaci&oacute;n y mantenimiento.</li>\r\n<li>Dise&ntilde;ar, construir, operar y mantener sistemas de control y automatizaci&oacute;n de procesos industriales y de servicios.</li>\r\n<li>Realizar diagn&oacute;sticos para promover el ahorro y uso eficiente de la energ&iacute;a el&eacute;ctrica.</li>\r\n<li>Efectuar, evaluar y analizar pruebas para el diagn&oacute;stico y mantenimiento de equipos y materiales el&eacute;ctricos.</li>\r\n<li>Promover el uso de fuentes alternas de energ&iacute;a el&eacute;ctrica.</li>\r\n<li>Participar en la administraci&oacute;n y toma de decisiones de los recursos humanos, econ&oacute;micos y materiales en la ejecuci&oacute;n de proyectos y obras el&eacute;ctricas.</li>\r\n<li>Participar en actividades de divulgaci&oacute;n, docencia, investigaci&oacute;n y desarrollo tecnol&oacute;gico en el campo de la ingenier&iacute;a el&eacute;ctrica.</li>\r\n<li>Interpretar y aplicar la normatividad y reglamentaci&oacute;n el&eacute;ctricas vigentes en el desarrollo de su &aacute;mbito profesional.</li>\r\n<li>Analizar, diagnosticar y dar soluci&oacute;n a problemas relacionados con la calidad de la energ&iacute;a el&eacute;ctrica.</li>\r\n<li>Ejercer la profesi&oacute;n de una manera responsable, legal y &eacute;tica, comprometido con el desarrollo sustentable de su entorno.</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p style=\"font-weight: bold\">Campo de Trabajo:</p>\r\n<p><br />El ingeniero electricista es un profesional que puede incorporarse tanto en instituciones p&uacute;blicas como privadas, en distintas &aacute;reas de aplicaci&oacute;n de la Ingenier&iacute;a El&eacute;ctrica y en empresas peque&ntilde;as, medianas o grandes.</p>\r\n<p>&nbsp;</p>\r\n<p>Su ejercicio privado independiente lo realiza en la consultor&iacute;a, la asesor&iacute;a y el peritaje o bien en la asistencia t&eacute;cnica.</p>\r\n<p>&nbsp;</p>\r\n<p>Para el Estado de Chiapas la especialidad en aplicaciones industriales, permite a este profesionista, ampliar su campo de acci&oacute;n en la electr&oacute;nica.</p>\r\n<p>&nbsp;</p>\r\n<p style=\"font-weight: bold\">Duraci&oacute;n de la Carrera:</p>\r\n<p>&nbsp;</p>\r\n<p>La duraci&oacute;n prevista para estudiar la carrera es de 9 semestres pudiendo el alumno adelantar asignaturas despu&eacute;s del primero y concluir el plan de estudios en menos tiempo dependiendo de la carga acad&eacute;mica cursada en cada periodo, no debiendo, por otro lado, excederse de los doce semestres.</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Plan de estudios</strong></p>\r\n<p>ret&iacute;cula oficial <a href=\"planes/electrica/objetivo/relectrica.pdf\" target=\"_blanck\">aqu&iacute;</a></p>\r\n<p>ret&iacute;cula con materias de especialidad [_d2]</p>','13_c_1.jpg','13_c_2.jpg','13_c_3.jpg',NULL,NULL,NULL,NULL,NULL,NULL,'13doc1contenido.pdf','13doc2contenido.pdf',NULL,NULL,NULL,NULL,NULL,NULL,'02/08/2007',1,'07/01/2009','','','','','','','','','',''),(14,'<p style=\"font-weight: bold\" align=\"center\">Ingenier&iacute;a Electr&oacute;nica</p>\r\n<p>&nbsp;</p>\r\n<p style=\"font-weight: bold\">Objetivo General de la Carrera:</p>\r\n<p>&nbsp;</p>\r\n<p>Formar profesionistas en Ingenier&iacute;a Electr&oacute;nica con capacidad creativa, emprendedora, de an&aacute;lisis y liderazgo, que realicen actividades de dise&ntilde;o, innovaci&oacute;n, adaptaci&oacute;n y transferencia de tecnolog&iacute;a para resolver problemas en forma competitiva y atender las necesidades de su entorno con una conciencia social y un compromiso con el desarrollo sustentable.</p>\r\n<p>&nbsp;</p>\r\n<p style=\"font-weight: bold\">Perfil Profesional de la Carrera:</p>\r\n<p>&nbsp;</p>\r\n<p>Con base en el desempe&ntilde;o esperado para un Ingeniero Electr&oacute;nico, a continuaci&oacute;n se presentan los principales rasgos que definen su perfil, bajo la forma del tipo de actividades que desarrolla, de las habilidades indispensables para su desempe&ntilde;o y de actitudes importantes para lograr los prop&oacute;sitos de este profesionista.</p>\r\n<ul>\r\n<li>Dise&ntilde;ar, analizar, adaptar, operar y construir sistemas anal&oacute;gicos y digitales.</li>\r\n<li>Crear, innovar, adaptar y transferir tecnolog&iacute;a en el &aacute;mbito de ingenier&iacute;a electr&oacute;nica mediante la aplicaci&oacute;n de m&eacute;todos y procedimientos, tomando en cuenta el desarrollo sustentable de su entorno.</li>\r\n<li>Planear, organizar, dirigir y controlar actividades de instalaci&oacute;n, operaci&oacute;n y mantenimiento de sistemas y equipo electr&oacute;nico.</li>\r\n<li>Desarrollar, dirigir y participar en proyectos de investigaci&oacute;n y desarrollo tecnol&oacute;gico en el &aacute;rea de ingenier&iacute;a electr&oacute;nica</li>\r\n<li>Dirigir y participar en equipos de trabajo interdisciplinario y multidisciplinario.</li>\r\n<li>Capacitar y actualizar al personal en las diversas disciplinas de ingenier&iacute;a electr&oacute;nica.</li>\r\n<li>Asumir el compromiso de su formaci&oacute;n integral permanente y de su actualizaci&oacute;n profesional continua de manera aut&oacute;noma.</li>\r\n<li>Ejercer la profesi&oacute;n de una manera responsable, legal y &eacute;tica.</li>\r\n<li>Poseer los conocimientos b&aacute;sicos de las ciencias exactas, sociales y de humanidades que le permitan aplicar profesionalmente la ingenier&iacute;a electr&oacute;nica</li>\r\n<li>Comunicarse con efectividad en su &aacute;mbito profesional tanto en su idioma como en un idioma extranjero.</li>\r\n<li>Administrar proyectos relacionados con su &aacute;rea de manera eficaz y eficiente.</li>\r\n<li>Ejercer actitudes emprendedoras, de liderazgo y desarrollar habilidades para la toma de decisiones en su &aacute;mbito profesional.</li>\r\n<li>Comprender su entorno pol&iacute;tico, econ&oacute;mico, social y cultural.</li>\r\n<li>Utilizar la tecnolog&iacute;a de la informaci&oacute;n y comunicaci&oacute;n.</li>\r\n<li>Promover y participar en programas de mejora continua aplicando normas de calidad.</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p style=\"font-weight: bold\">Campo de Acci&oacute;n:</p>\r\n<p>&nbsp;</p>\r\n<p>El Ingeniero Electr&oacute;nico es un profesional que puede incorporarse tanto a instituciones p&uacute;blicas como privadas, tanto en empresas que manejen tecnolog&iacute;a de punta en este campo, como en aqu&eacute;llas cuyo nivel tecnol&oacute;gico sea incipiente; asimismo, puede desempe&ntilde;arse en distintas &aacute;reas de aplicaci&oacute;n de la electr&oacute;nica, ya sea en empresas peque&ntilde;as, en medianas o en grandes.</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Plan de estudios</strong></p>\r\n<p>ret&iacute;cula oficial <a href=\"planes/electronica/objetivo/relectronica.pdf\" target=\"_blank\">aqu&iacute;</a></p>\r\n<p>&nbsp;</p>\r\n<p>ret&iacute;cula con materias de especialidad [_d2]</p>\r\n<p style=\"font-weight: bold\">Duraci&oacute;n de la Carrera</p>\r\n<p>&nbsp;</p>\r\n<p>La duraci&oacute;n prevista para estudiar la carrera es de 10 semestres pudiendo el alumno adelantar asignaturas despu&eacute;s del primero y concluir el plan de estudios en menos tiempo dependiendo de la carga acad&eacute;mica cursada en cada periodo, no debiendo, por otro lado, excederse de los doce semestres.</p>',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'14doc1contenido.pdf','14doc2contenido.pdf',NULL,NULL,NULL,NULL,NULL,NULL,'02/08/2007',1,'07/01/2009','','','','','','','','','',''),(15,'<p style=\"font-weight: bold\" align=\"center\">Ingenier&iacute;a Industrial</p>\r\n<p style=\"font-weight: bold\">&nbsp;</p>\r\n<p style=\"font-weight: bold\">Objetivo General de la Carrera:</p>\r\n<p>&nbsp;</p>\r\n<p>Formar profesionales que contribuyan al desarrollo sustentable, con una visi&oacute;n sist&eacute;mica, que responda a los retos que presentan los constantes cambios, en los sistemas de producci&oacute;n de bienes y servicios en el entorno global, con &eacute;tica y comprometidos con la sociedad.</p>\r\n<p>&nbsp;</p>\r\n<p style=\"font-weight: bold\">Perfil Profesional:</p>\r\n<p>&nbsp;</p>\r\n<ul>\r\n<li>Dise&ntilde;a, implementa, administra y mejora sistemas integrados de abastecimiento, producci&oacute;n y distribuci&oacute;n de organizaciones productoras de bienes y servicios, de forma sustentable y considerando las normas nacionales e internacionales.</li>\r\n<li>Conoce la estructura y funcionamiento b&aacute;sico para operar la maquinaria, herramientas, equipos e instrumentos de medici&oacute;n y control convencionales y de vanguardia.</li>\r\n<li>Participa en proyectos de transferencia, asimilaci&oacute;n, desarrollo y adaptaci&oacute;n de tecnolog&iacute;as.</li>\r\n<li>Integra, dirige y mantiene equipos de trabajo inter y multidisciplinarios en ambientes cambiantes y multiculturales.</li>\r\n<li>Dise&ntilde;a, implementa y administra sistemas de mantenimiento.</li>\r\n<li>Planea y dise&ntilde;a la localizaci&oacute;n y distribuci&oacute;n de instalaciones para la producci&oacute;n de bienes y servicios.</li>\r\n<li>Selecciona, instala y pone en marcha maquinaria y equipo.</li>\r\n<li>Dise&ntilde;a, implementa y mejora los sistemas de trabajo aplicando la ergonom&iacute;a.</li>\r\n<li>Integra y administra sistemas de higiene, seguridad industrial y protecci&oacute;n al medio ambiente con conciencia e identidad social.</li>\r\n<li>Formula, eval&uacute;a y administra proyectos de inversi&oacute;n.</li>\r\n<li>Desarrolla actitudes emprendedoras, creativas, de superaci&oacute;n personal y de liderazgo en su entorno social.</li>\r\n<li>Act&uacute;a con sentido &eacute;tico en su entorno laboral y social.</li>\r\n<li>Utiliza las tecnolog&iacute;as y sistemas de informaci&oacute;n de manera eficiente.</li>\r\n<li>Utiliza t&eacute;cnicas y m&eacute;todos cualitativos y cuantitativos para la toma de decisiones</li>\r\n</ul>\r\n<p><strong>Plan de estudios</strong><br />ret&iacute;cula oficial [_d1]</p>\r\n<p>ret&iacute;cula con materias de especialidad [_d2]</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>[_i1]</p>','15_c_industrial.jpg','15_c_torno.jpg',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'15doc1contenido.pdf','15doc2contenido.pdf',NULL,NULL,'15_p_cintillo.jpg',NULL,NULL,NULL,'02/08/2007',1,'07/01/2009','','','','','','','','','',''),(16,'<p style=\"font-weight: bold\" align=\"center\">Ingenier&iacute;a en Sistemas Computacionales</p>\r\n<p>&nbsp;</p>\r\n<p style=\"font-weight: bold\">Objetivo General de la Carrera:</p>\r\n<p>Formar profesionales capaces de dise&ntilde;ar y desarrollar sistemas de software que les permitan propiciar el fortalecimiento de la tecnolog&iacute;a nacional; administrar proyectos de desarrollo de software y especificar y evaluar configuraciones de sistemas de computo en todo tipo de organizaciones donde se utilicen sistemas computacionales.</p>\r\n<p>&nbsp;</p>\r\n<p style=\"font-weight: bold\">Objetivo:</p>\r\n<p>Formar profesionales capaces de dise&ntilde;ar y desarrollar sistemas de software que les permitan propiciar el fortalecimiento de la tecnolog&iacute;a nacional; administrar proyectos de desarrollo de software y especificar y evaluar configuraciones de sistemas de computo en todo tipo de organizaciones donde se utilicen sistemas computacionales.</p>\r\n<p>&nbsp;</p>\r\n<p style=\"font-weight: bold\">Quehacer Profesional:</p>\r\n<p>Las necesidades actuales de desarrollo hacen necesario que en el estado se cuente con profesionistas capaces de dise&ntilde;ar, crear y dar mantenimiento a modernos e innovadores productos. La transformaci&oacute;n de los sistemas computacionales ha sido muy r&aacute;pida; la combinaci&oacute;n de software y hardware con tecnolog&iacute;a de comunicaci&oacute;n, de interfase con el medio ambiente y otras han permitido el desarrollo de poderosos sistemas. Se espera, que los tres sectores productivos del estado de apoyen aun mas en los sistemas computacionales, telecomunicaciones y redes.</p>\r\n<p><strong>Plan de estudios</strong><br />ret&iacute;cula oficial [_d1]</p>\r\n<p>ret&iacute;cula con materias de especialidad [_d2]</p>\r\n<p style=\"font-weight: bold\">Campo de Trabajo</p>\r\n<p>El ingeniero en sistemas computacionales puede prestar sus servicios de manera independiente, trabajar en todo tipo de empresas industriales, de servicios, publicas o privadas como podr&iacute;an ser industrias extractivas, de transformaci&oacute;n, empresas de servicios, comerciales, exportadoras, de distribuci&oacute;n, de desarrollo inform&aacute;tico, de inversi&oacute;n o cr&eacute;dito.</p>',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'16doc1contenido.pdf','16doc2contenido.pdf',NULL,NULL,NULL,NULL,NULL,NULL,'02/08/2007',1,'07/01/2009','','','','','','','','','',''),(17,'<p style=\"font-weight: bold\" align=\"center\">Ingenier&iacute;a Mecanica</p>\r\n<p>&nbsp;</p>\r\n<p style=\"font-weight: bold\">Objetivo General de la Carrera:</p>\r\n<p>&nbsp;</p>\r\n<p>Formar profesionales de la Ingenier&iacute;a Mec&aacute;nica capaces de aplicar y desarrollar conocimientos cient&iacute;ficos y tecnol&oacute;gicos en el dise&ntilde;o, construcci&oacute;n, instalaci&oacute;n, operaci&oacute;n y mantenimiento de sistemas mec&aacute;nicos en los sectores productivo y deservicios en forma segura, eficiente y rentable. As&iacute; como de realizar actividades de direcci&oacute;n y administraci&oacute;n de los recursos.</p>\r\n<p>&nbsp;</p>\r\n<p style=\"font-weight: bold\">Quehacer Profesional:</p>\r\n<p><br />La Ingenier&iacute;a Mec&aacute;nica deber&aacute; desempe&ntilde;ar un rol fundamental en los esfuerzos del pa&iacute;s por elevar su competitividad internacional, entre otros campos. Las caracter&iacute;sticas de las modernas tecnolog&iacute;as apuntan hacia los altos niveles de automatizaci&oacute;n, flexibilidad y computarizaci&oacute;n. Algunas &aacute;reas del futuro ser&aacute;n la mecatr&oacute;nica, la fot&oacute;nica, los dise&ntilde;os y procesos asistidos por computadora y los nuevos materiales, tales como los metales y las resinas.</p>\r\n<p>&nbsp;</p>\r\n<p style=\"font-weight: bold\">Campo de Trabajo:</p>\r\n<p style=\"font-weight: bold\">&nbsp;</p>\r\n<p>El ingeniero mec&aacute;nico puede desempe&ntilde;arse profesionalmente en toda clase de empresas industriales o de servicios, p&uacute;blicas o privadas, como Ingenios Azucareros, Sistema Municipal de Agua Potable, Compa&ntilde;&iacute;a Nestl&eacute;, CFE, PEMEX, empresas dedicadas al servicio de mantenimiento de equipos mec&aacute;nicos. IMSS, ISSSTE, Instituciones Educativas en el &aacute;rea de docencia y tambi&eacute;n puede trabajar de manera independiente.</p>\r\n<p><strong>Plan de estudios</strong><br />ret&iacute;cula oficial [_d1]</p>\r\n<p>ret&iacute;cula con materia de especialidad [_d2]</p>\r\n<p style=\"font-weight: bold\">Duraci&oacute;n de la carrera:</p>\r\n<p>&nbsp;</p>\r\n<p>La duraci&oacute;n prevista para estudiar la carrera es de 9 semestres pudiendo el alumno adelantar asignaturas despu&eacute;s del primero y concluir el plan de estudios en menos tiempo dependiendo de la carga acad&eacute;mica cursada en cada el periodo, no debiendo, por otro lado, excederse de los doce semestres.</p>',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'17doc1contenido.pdf','17doc2contenido.pdf',NULL,NULL,NULL,NULL,NULL,NULL,'02/08/2007',1,'07/01/2009','','','','','','','','','',''),(18,'<p style=\"font-weight: bold\" align=\"center\">Licenciatura en Inform&aacute;tica</p>\r\n<p>&nbsp;</p>\r\n<p style=\"font-weight: bold\">Objetivo General de la Carrera:</p>\r\n<p>&nbsp;</p>\r\n<p>Los egresados de la Licenciatura en Inform&aacute;tica tendr&aacute;n una formaci&oacute;n interdisciplinaria que les permita el conocimiento y manejo de los elementos y relaciones del contexto inform&aacute;tico involucrados en una organizaci&oacute;n; que tenga la capacidad de analizar situaciones reales y plantar soluciones a los problemas detectados en el desarrollo del procesamiento de datos en una organizaci&oacute;n que favorezca y mejore su estado actual, reflej&aacute;ndose en un incremento en la calidad y productividad de la misma. Se busca que los egresados adem&aacute;s de estar comprometidos con la problem&aacute;tica nacional, act&uacute;en como agentes de cambio en su &aacute;rea.</p>\r\n<p>&nbsp;</p>\r\n<p style=\"font-weight: bold\">Quehacer Profesional:</p>\r\n<p>&nbsp;</p>\r\n<p>El desarrollo de la inform&aacute;tica en nuestro pa&iacute;s ha sido vertiginoso y ha logrado impactar diferentes &aacute;mbitos de la vida laboral, profesional y cotidiana se ha incrementado el n&uacute;mero de organizaciones, empresas privadas y estatales, en todos los sectores de la econom&iacute;a que incorporan el uso de la computadora para el mejoramiento de sus procesos administrativos.</p>\r\n<p>&nbsp;</p>\r\n<p>Las computadoras se usan con mayor frecuencia en casi todo el proceso productivo: en el dise&ntilde;o; la manufactura ayudada por computadora; el control autom&aacute;tico de inventarios; el manejo y la planificaci&oacute;n centralizados de diversas actividades en diferentes geogr&aacute;ficos; la contabilidad; los c&aacute;lculos financieros y de costos; las ventas, la mercadotecnia y las transacciones comerciales y monetarias. En este sentido los profesionistas de la inform&aacute;tica tendr&aacute;n una demanda m&aacute;s flexible por los sectores industriales y de servicios, que la que origina los sectores directamente productores de bienes y servicios de las tecnolog&iacute;as de la informaci&oacute;n. La cual parece perfilar una tendencia con predominio hacia los aspectos aplicados mas que a los aspectos de desarrollo, como consecuencia de la aplicaci&oacute;n de las tecnolog&iacute;as de la informaci&oacute;n en las empresas para mejorar sus actividades, y constituya un factor decisivo para la competitividad de las mismas, o en su caso, propicie la generaci&oacute;n de productos, servicios o procesos innovadores. Los campos de software a medida y de servicios inform&aacute;ticos, son &aacute;reas que parecen estar relativamente menos expuestas a la competencia internacional, y en consecuencia, las nuevas posibilidades telem&aacute;tica van a propiciar que se torne mas viable la contrataci&oacute;n de estos trabajos a pa&iacute;ses con menores costos laborables, y que por lo tanto, constituye un sector del mercado inform&aacute;tico con mas posibilidades de desarrollo y rentabilidad en el mediano plazo.</p>\r\n<p><strong>Plan de estudios</strong><br />&nbsp;ret&iacute;cula oficial [_d1]</p>\r\n<p>&nbsp;ret&iacute;cula con materia de especialidad [_d2]</p>\r\n<p>&nbsp;</p>\r\n<p style=\"font-weight: bold\">Campo de Trabajo:</p>\r\n<p>El licenciado en inform&aacute;tica es un profesional que puede prestar sus servicios en cualquier organizaci&oacute;n productiva de bienes y servicios, de los sectores p&uacute;blicos privado y social. De igual forma estar&aacute; capacitado para desempe&ntilde;arse de manera independiente, presentando sus servicios profesionales.</p>\r\n<p>&nbsp;</p>\r\n<p style=\"font-weight: bold\">Duraci&oacute;n de la Carrera:</p>\r\n<p>&nbsp;</p>\r\n<p>La duraci&oacute;n prevista para estudiar la carrera es de 9 semestres pudiendo el alumno adelantar asignaturas despu&eacute;s del primero y concluir el plan de estudios en menos tiempo dependiendo de la carga acad&eacute;mica cursada en cada el periodo, no debiendo, por otro lado, excederse de los doce semestres.</p>',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'18doc1contenido.pdf','18doc2contenido.pdf',NULL,NULL,NULL,NULL,NULL,NULL,'02/08/2007',1,'07/01/2009','','','','','','','','','',''),(19,'<p><strong>Objetivo<br /></strong>Formar recursos humanos de alto nivel con excelencia acad&eacute;mica, capaces de desarrollar investigacion cientifica y tecnol&oacute;gica en el campo de la ingenieria bioqu&iacute;mica.<br /><br /><strong>Lineas de investigaci&oacute;n<br /></strong><span style=\"text-decoration: underline;\">Biotecnolog&iacute;a vegetal<br /></span><em>Objetivo:</em> Desarrollar procesos biotecnol&oacute;gicos para el aprovechamiento sustentable de vegetales de inter&eacute;s agroindustria del estado de Chiapas.<br /><em>Areas:</em> Mircropropagaci&oacute;n y productos naturales.<br /><br /><span style=\"text-decoration: underline;\">Ingenier&iacute;a de procesos biotecnol&oacute;gicos y alimentarios<br /></span><em>Objetivo</em>: Aprovechar y transformar sustentablemente los productos primarios, as&iacute; como evaluar, controlar y/o reediar los problemas ambientales del estado de Chiapas.<br /><em>Areas</em>: Aguas y s&oacute;lidos residuales; Conservaci&oacute;n de alimentos y alimentos funcionales.<br /><br /><strong>Duraci&oacute;n de la Maestria<br /></strong>La duraci&oacute;n prevista para estudiar la maestria es de 4 semestres.<br /><br /><strong>Requisitos de ingreso<br /></strong></p>\r\n<ol>\r\n<li>T&iacute;tulo de licenciatura o acta de examen profesional en: Ingenier&iacute;a Bioqu&iacute;mica, Ingenier&iacute;a Qu&iacute;mica, Ingenier&iacute;a en Alimentos, Agronom&iacute;a o carreras afines.</li>\r\n<li>Certificado de estudios profesionales o constancia de estudios terminados con un promedio general m&iacute;nimo de 8 o equivalente.</li>\r\n<li>Solicitud de ingreso con exposici&oacute;n de motivos.</li>\r\n<li>Curriculum vitae resumido</li>\r\n<li>Aprobar la entrevista de diagn&oacute;stico ante el comit&eacute; de posgrado.</li>\r\n<li>Aprobar el examen de conprensi&oacute;n del idioma ingl&eacute;s.</li>\r\n<li>Aprobar cada una de las materias del examen de adminisi&oacute;n.</li>\r\n</ol>\r\n<p><br />Para mayor informaci&oacute;n referirse a la <a href=\"contenido.php?id=90\">p&aacute;gina del departamento</a></p>',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'02/08/2007',1,'28/11/2008','','','','','','','','','',''),(20,'Control Escolar <p>&nbsp;</p><p>El &aacute;rea de Control Escolar se encarga de realizar los proceso de inscripci&oacute;n a alumnos de 1er. semestre y reinscripci&oacute;n a alumnos de semestres superiores.</p><p>&nbsp;</p><p>En la Instituci&oacute;n se pueden recibir a alumnos que vienen de otras escuelas y desean hacer una equivalencia de estudios, si este es tu caso deberas cumplir una lista de requisitos que puedes ver aqu&iacute;.</p><p>&nbsp;</p><p>Servicios que proporciona el &aacute;rea:</p><p>&nbsp;</p><ul><li>CONSTANCIA DE ESTUDIOS SIN MATERIAS (Licenciatura, Especialidad y Maestr&iacute;a)</li><li>CONSTANCIA DE ESTUDIOS CON MATERIAS CURSADAS</li><li>CONSTANCIA DE ESTUDIOS CON MATERIA POR SEMESTRE</li><li>CONSTANCIA SIN MATERIAS DE TERMINACION DE ESTUDIOS</li><li>CONSTANCIA CON CREDITOS ACUMULADOS PARA INGLES</li><li>CONSTANCIA DE HORARIOS</li><li>CONSTANCIA CON CREDITOS ACUMULADOS PARA RESIDENCIA PROFESIONAL</li><li>DUPLICADO DE CREDENCIAL</li><li>DUPLICADO DE BOLETA</li><li>KARDEX</li><li>CERTIFICACION DE DOCUMENTOS</li><li>DUPLICADO DE CERTIFICADO DE BACHILLERATO</li><li>DUPLICADO DE CERTIFICADO DE LICENCIATURA, ESPECIALIDAD O MAESTRIA.</li><li>CERTIFICADO PARCIAL O INCOMPLETO DE ESTUDIOS DE BACHILLERATO</li><li>CERTIFICADO PARCIAL O INCOMPLETO DE ESTUDIOS DE LICENCIATURA</li><li>CERTIFICADO DE ESPECIALIDAD</li><li>CERTIFICADO DE MAESTRIA</li></ul><p>&nbsp;</p><p>NOTA: la entrega de las constancias se har&aacute;n al d&iacute;a siguiente despu&eacute;s de haber recibido su solicitud.</p><p>&nbsp;</p><p style=\"font-style: italic\">Pasos que debe cumplir para la obtenci&oacute;n de estos servicios:</p><p>&nbsp;</p><p>1.- Requisitar la solicitud, la cual podr&aacute; adquirirla mediante el servicio de ventanilla o a trav&eacute;s del buz&oacute;n de solicitudes que le proporcionara el Departamento de Servicios Escolares.</p><p>2.- Efectuar el pago correspondiente, en el Departamento de Recursos Financieros.</p><p>3.- Entregar la solicitud y recibo de pago, en el Departamento de Servicios Escolares.</p><p>&nbsp;</p><p style=\"font-style: italic\">Para realizar estos tramites debes cumplir con el siguiente horario:</p><p>&nbsp;</p><p>Lunes a Miercoles</p><p>09:00 a 13:00 hrs.</p><p>16:00 a 19:00 hrs.</p><p>&nbsp;</p><p>Jueves a Viernes</p><p>09:00 a 13:00 hrs.</p><p>16:00 a 18:00 hrs.</p>','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'02/08/2007',1,'','','','','','','','','','',''),(21,'Servicios Estudiantiles <p>&nbsp;</p><p>El &aacute;rea de Servicios Estudiantiles se encarga de llevar el proceso de Becas, Titulaci&oacute;n y Seguro M&eacute;dico.</p><p>&nbsp;</p><p>El proceso de Becas se divide en dos subprocesos que son:</p><p>&nbsp;</p><p>Becas SEP</p><p>Becas Pronabes</p><p>&nbsp;</p><p>En cuanto a titulaci&oacute;n puedes encontrar toda la informaci&oacute;n necesaria en el apartado de Titulaci&oacute;n.</p>','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'02/08/2007',1,'','','','','','','','','','',''),(22,'SERVICIO MEDICO ESTUDIANTIL DENTRO DEL INSTITUTO <p>&nbsp;</p><p>Con base a las necesidades internas de la Instituci&oacute;n, se cuenta con M&eacute;dico Escolar ubicado en el edificio Q (planta Baja).</p><p>&nbsp;</p><p>La funci&oacute;n de este servicio es atender situaciones de Emergencia, se valora, se selecciona y clasifica al paciente basado en sus necesidades terap&eacute;uticas para darles atenci&oacute;n m&eacute;dica ambulatoria, para su permanencia en el Instituto, con seguimiento en el IMSS o el env&iacute;o a un servicio de Urgencias Hospitalario.</p><p>&nbsp;</p><p>Otra funci&oacute;n del servicio medico estudiantil es la medicina preventiva, realizando acciones de campa&ntilde;as de vacunaci&oacute;n, as&iacute; como pl&aacute;ticas en tema de salud.</p><p>&nbsp;</p><p style=\"font-weight: bold\">REQUISITOS PARA RECIBIR ATENCI&Oacute;N EN EL CONSULTORIO DE LA ESCUELA</p><p>&nbsp;</p><ul><li>Carnet del IMSS</li><li>Credencial de la escuela</li><li>Acudir al servicio m&eacute;dico en el horario de atenci&oacute;n publicado.*</li></ul><p>&nbsp;</p><p>*En caso de necesitar atenci&oacute;n medica fuera del horario de servicio, acudir al IMSS.</p><p>&nbsp;</p><p style=\"font-weight: bold\">SEGURO DE VIDA Y GASTOS M&Eacute;DICOS MAYORES</p><p>&nbsp;</p><p>Algo muy importante que debes saber es que desde el momento en el que te inscribes te haces acreedor a un Seguro de Vida, para el cual no debes realizar ning&uacute;n tipo de tr&aacute;mite y/o pago, ya que el costo de este seguro va incluido dentro del pago de inscripci&oacute;n a la instituci&oacute;n.</p><p>&nbsp;</p><p>El seguro te protege en los siguientes casos:</p><ul><li>Atenci&oacute;n de padecimientos con m&aacute;s de 48 hrs. de hospitalizaci&oacute;n.</li><li>Reembolso de gastos m&eacute;dicos.</li><li>Indemnizaci&oacute;n en perdidas org&aacute;nicas.</li><li>Seguro de Vida.</li><li>Becas de estudios en caso de fallecimiento del padre.</li></ul><p>&nbsp;</p><p><span style=\"font-weight: bold\">Encargado de Servicio M&eacute;dico:</span></p><p>&nbsp;</p><p>Dra. Maria de Lourdes G&aacute;lvez Reyes</p><p>Horario de Atenci&oacute;n:<br />De lunes a Viernes 9:00 a 12:00 hrs.<br />Lunes, Mi&eacute;rcoles y Viernes 15:30 a 18:00 hrs. <br />Martes y Jueves 15:00 a 16:00 hrs.</p>','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'02/08/2007',1,'','','','','','','','','','',''),(23,'<p style=\"font-weight: bold\" align=\"center\">Titulaci&oacute;n</p><p>&nbsp;</p><p style=\"font-weight: bold\">&iquest;Qu&eacute; es el proceso de Titulaci&oacute;n?</p><p>&nbsp;</p><p>Es el proceso integrador de la acreditaci&oacute;n de un conjunto de asignaturas para la titulaci&oacute;n, que tiene como finalidad: Generar un grado de significatividad en el estudiante hacia la investigaci&oacute;n, desarrollar un proyecto o una investigaci&oacute;n, donde vincule la teor&iacute;a con la pr&aacute;ctica en la soluci&oacute;n de una problem&aacute;tica real.</p><p>&nbsp;</p><p style=\"font-weight: bold\">&iquest;Cu&aacute;ndo pueden empezar el tr&aacute;mite y a d&oacute;nde deben acudir?</p><p>&nbsp;</p><p>El proceso inicia cuando el estudiante solicita su inscripci&oacute;n a la asigntatura &quot;Taller de investigaci&oacute;n II&quot; y concluye con la presentaci&oacute;n del informe t&eacute;cnico de la residencia profesional.</p><p>&nbsp;</p><p>El alumno egresado es candidato a recepci&oacute;n profesional cuando cumpla los siguientes requisitos:</p><p>&nbsp;</p><ul><li>Haber aprobado el total de cr&eacute;ditos que integran el plan de estudios de la carrera cursada, en el nivel de licenciatura.</li><li>Haber realizado el servicio social en los t&eacute;rminos que marca la ley reglamentaria y el manual de procedimientos para la realizaci&oacute;n del servicio social en los Institutos Tecnol&oacute;gicos.</li><li>Haber acreditado la residencia profesional, de acuerdo con lo establecido en el procedimiento respectivo, para quienes cursaron los planes de estudio resultantes del modelo educativo para el siglo XXI (planes a partir del 2004).</li><li>Haber obtenido la acreditaci&oacute;n de una lengua extranjera (ingl&eacute;s), de acuerdo al procedimiento de lengua extranjera, para quienes hayan cursado planes de estudio a partir del 2004.</li><li>No tener adeudo econ&oacute;mico, de material o equipo con las oficinas, laboratorios, talleres y centro de informaci&oacute;n o cualquier otra por la cual haya transitado.</li><li>Cubrir los derechos correspondientes.</li><li>Haber presentado la solicitud y constancias de haber cumplido los requisitos anteriores a la division de estudios profesionales, para los tr&aacute;mites administrativos necesarios.</li><li>Anexar un archivo electr&oacute;nico y cuatro ejemplares impresos del informe t&eacute;cnico.</li></ul><p>&nbsp;</p><p>Requisitos a presentar en el departmento de control escolar en el &aacute;rea de titulaci&oacute;n.</p><p>&nbsp;</p><ul><li>FORMATO DE SOLICITUD DE ACTO RECEPCIONAL (3 originales).</li><li>FORMATO D.G.P. (con letra de molde y tinta negra, 2 tantos originales).</li><li>ACTA DE NACIMIENTO (Actualizada de 5 a&ntilde;os a la fecha, Original y dos copias).</li><li>C.U.R.P. (dos copias).</li><li>CERTIFICADOS DE: SECUNDARIA, BACHILLERATO, LICENCIATURA (Original y una copia).</li><li>CONSTANCIA DE LIBERACION DE SERVICIO SOCIAL (Original y una copia).</li><li>CONSTANCIA DE LIBERACION DE PRACTICAS PROFESIONALES (Original y una copia; para planes de estudios 73-80 y 90).</li><li>CONSTANCIA DE ACREDITACION DE IDIOMA INGLES (actualizada de 3 a&ntilde;os a partir de la fecha de expedici&oacute;n, original y una copia).</li><li>AUTORIZACION DE IMPRESI&Oacute;N DEL TRABAJO PROFESIONAL, PARA LAS OPCIONES I,II,III,IV, V, VII, Y X (&Uacute;nicamente copia).</li><li>OFICIO DE CONCLUSION DE ASESORIAS, PARA LA OPCION VI (&Uacute;nicamente copia).</li><li>COPIA DEL OFICIO DE AUTORIZACION, PARA LA OPCION IX (y copia de la constancia de terminaci&oacute;n o certificado de maestr&iacute;a o especializaci&oacute;n ).</li><li>4 FOTOGRAFIAS TAMA&Ntilde;O CREDENCIAL, DE FRENTE, OVALADAS, CON TRAJE; RETOCADAS EN PAPEL DELGADO SIN BRILLO, B/N con nombre al reverso.</li><li>6 FOTOGRAFIAS TAMA&Ntilde;O INFANTIL, DE FRENTE CON TRAJE; RETOCADAS EN PAPEL DELGADO SIN BRILLO, B/N (Incluyendo las 2 fotograf&iacute;as de los 2 formatos D.G.P.) con nombre al reverso.</li><li>FORMATO PARA RECABAR SELLOS DE NO ADEUDO DE MATERIAL.</li><li>4 FOLDERS TAMA&Ntilde;O OFICIO COLOR CREMA Y UN SOBRE PAPEL MANILA T/OFICIO.</li><li>RECIBOS DE PAGOS, LOS CUALES SE DEBERAN EFECTUAR, CUANDO SERVICIOS ESCOLARES LOS AUTORICE.</li></ul><p>&nbsp;</p><p style=\"font-weight: bold\">NOTA:</p><p>Es responsabilidad del alumno verificar que la clave de la curp sea correcta, antes de la integraci&oacute;n de documentos.</p><p>Todas las copias deben de ser en tama&ntilde;o carta, legibles y completas.<br />No debes realizar ning&uacute;n pago hasta que se te indique y debes acudir en las fechas programadas por el &aacute;rea de servicios escolares, puesto que no se dar&aacute; atenci&oacute;n fuera de la programaci&oacute;n.</p><p>&nbsp;</p><p>No se recibir&aacute; expediente en caso de estar incompleto.</p><p>&nbsp;</p><p>Horario de atenci&oacute;n: de lunes a viernes de 9:00 a 12:00 hrs. (&uacute;nicamente)</p><p>Tel&eacute;fonos: 61 5 03 80 &oacute; 61 5 04 61, Ext. 407.</p><p>Encargada de recibir documentaci&oacute;n: <span style=\"font-style: italic; text-decoration: underline\">Lleni Elizabeth Arzate Gordillo</span></p>','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'02/08/2007',1,'','','','','','','','','','',''),(24,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'02/08/2007',0,'','','','','','','','','','',''),(25,'<p><strong>Misi&oacute;n</strong><br />Formar de manera integral profesionistas de excelencia en el campo de la ciencia y la tecnol&oacute;gia con actitud emprendedora, respeto al medio ambiente y apego a los valores &eacute;ticos<br /><br /><strong>Visi&oacute;n</strong><br />Ser una Instituci&oacute;n de excelencia en la educaci&oacute;n superior tecnol&oacute;gica del Sureste, comprometida con el desarrollo socioecon&oacute;mico sustentable de la regi&oacute;n<br /><br /><strong>Valores</strong></p>\r\n<ul>\r\n<li>El ser humano</li>\r\n<li>El esp&iacute;ritu de servicio</li>\r\n<li>El liderazgo</li>\r\n<li>El trabajo en equipo</li>\r\n<li>La calidad</li>\r\n<li>El alto desemp&eacute;&ntilde;o</li>\r\n</ul>','25_c_tec1.jpg','25_c_tec2.jpg','25_c_tec3.jpg',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'02/08/2007',1,'','','','','','','','','','',''),(30,'<p>La Secretaria de Educaci&oacute;n en conjunto con el Gobierno del Estado de Chiapas, se dieron a la tarea de buscar alternativas de Educaci&oacute;n Superior para aquellas personas que por situaciones econ&oacute;micas y marginadas de las zonas donde viven no han logrado concluir una carrera profesional, con el objetivo de aprovechar las nuevas tecnolog&iacute;as de informaci&oacute;n y comunicaci&oacute;n que existen para abatir los costos recibiendo un servicio educativo con la misma calidez que la tienen los municipios con mayor desarrollo en el estado.</p><p>En el a&ntilde;o 2005 la Secretaria de Educaci&oacute;n y el Gobernador del Estado Lic. Pablo Salazar Mendiguchia convocaron a diferentes instituciones de educaci&oacute;n superior en el estado con el fin de obtener una soluci&oacute;n al problema propuesto.</p><p>En Julio del 2006 se da un gran avance en el proyecto de Educaci&oacute;n a Distancia, cuando el Gobernador del Estado el Lic. Pablo Salazar Mendiguchia asiste a las instalaciones del Instituto Tecnol&oacute;gico de Tuxtla Guti&eacute;rrez a inaugurar la sede central de este gran proyecto....</p><p>Si deseas conocer mas,&nbsp;&nbsp;el sitio del sistema de Edcaci&oacute;n Superior a Distancia lo puedes acceder <a href=\"http://www.edittg.edu.mx/\" target=\"_blank\">aqu&iacute;</a> </p>',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'16/08/2007',1,'','','','','','','','','','',''),(37,'<p>Puedes consultar el Reglamento de alumnos [_d1]</p>',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'37_d_reglamento.pdf',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'31/10/2007',1,'','','','','','','','','','',''),(39,'<p>En este espacio podr&aacute;s encontrar material de ayuda para t&iacute;:</p><p>En la secci&oacute;n AULA VIRTUAL puedes encontrar algunos cursos en l&iacute;nea.</p><p>En la secci&oacute;n CALIFICACONES AGOSTO - DIC. podras encontrar tus calificaciones de ese semestre.</p><p>En SIE EN LINEA, se encuenstra el Sistema de Integraci&oacute;n Escolar, en el cual puedes informaci&oacute;n como boletas, calificaciones, kardex, horario, etc.... </p>',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'04/02/2008',1,'','','','','','','','','','',''),(40,'<p>ESTA SECCION ES DISPONIBLE DESDE LA INTRANET DEL ITTG </p><p>(desde computadoras conectadas a la red&nbsp; del ITTG)</p>',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'08/12/2007',1,'','','','','','','','','','','');
/*!40000 ALTER TABLE `contenido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `correos`
--

DROP TABLE IF EXISTS `correos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `correos` (
  `id` int(2) NOT NULL,
  `correo` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `nombre` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `cargo` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `correos`
--

LOCK TABLES `correos` WRITE;
/*!40000 ALTER TABLE `correos` DISABLE KEYS */;
INSERT INTO `correos` VALUES (5,'difusion@ittg.edu.mx','Lic. Julio Cesar Ochoa Countiño','Jefe del Depto. de Comunicación y Difusión'),(6,'division@ittg.edu.mx','Ing. Fernando A. May Arrioja','Jefe de la Div. de Estudios Profesionales'),(7,'financieros@ittg.edu.mx','C.P. Melquiceded Dominguez Holán','Jefe del Depto. de Recursos Financieros'),(8,'extraescolar@ittg.edu.mx','L.E.F. Florentino Ovando Ocaña','Jefe del Depto. de Activ. Extraescolares'),(9,'humanos@ittg.edu.mx','Lic. Obdulia Ríos Coutiño','Jefe del Depto. de Recursos Humanos'),(10,'materiales@ittg.edu.mx','Ing. Carlos Ramón Alfonzo Santiago','Jefe del Depto. de Rec. Materiales y Serv.'),(11,'sistemas@ittg.edu.mx','Ing. Miguel A. Vázquez Velásquez','Jefe del Depto. de Ing. en Sistemas Comp.'),(12,'posgrado@ittg.edu.mx','Dr. Daniel Samayoa Penagos','Jefe de la Div. de Est. Invest. y Posgrado'),(13,'planea@ittg.edu.mx','C.P. Liliana Patricia Moreno Cancino','Jefe del Depto. de Planeación, Prog. y P.'),(14,'eleyeca@ittg.edu.mx','Ing. Jos‚ Ángel Zepeda Hernández','Jefe del Depto. de Ing. Eléctrica y Electr¢nica'),(15,'mantto@ittg.edu.mx','Lic. Roberto Antonio Meza Guillén','Jefe del Depto. de Mantenimiento de Eq.'),(16,'quimica@ittg.edu.mx','Ing. Leonardo Gómez Gutiérrez','Jefe del Depto. de Ing. Química y Bioq.'),(17,'mecanica@ittg.edu.mx','Ing. Ignacio Arrioja Cárdenas','Jefe del Depto. de Metalmecánica'),(18,'computo@ittg.edu.mx','Ing. Jorge Octavio Guzmán Sánchez','Jefe del Centro de Cómputo'),(19,'industrial@ittg.edu.mx','Ing. Jorge Antonio Orozco Torres','Jefe del Depto. de Ing. Industrial'),(20,'desacad@ittg.edu.mx','Psic. Adriana González Escobar','Jefa del Depto. de Desarrollo Acad‚mico'),(21,'basicas@ittg.edu.mx','M. en C. Roberto Carlos García Gómez','Jefe del Depto. de Ciencias Básicas'),(22,'descolares@ittg.edu.mx','Lic. Ma. Elidia Castellanos Morales','Jefe del Depto. de Servicios Escolares'),(23,'biblioteca@ittg.edu.mx','Lic. René Arjón Castro','Jefe del Centro de Información'),(24,'gestion@ittg.edu.mx','Lic. María Isabel Palacios Trujillo','Jefe del Depto. Gestión Tecnol. y Vinc.'),(25,'informatica@ittg.edu.mx','M. en C. René Ríos Coutiño','Jefe del Depto. Económico - Administrativo'),(26,'sgcittg@ittg.edu.mx','Ing. Jorge Arturo Sarmiento Torres','Oficina de Innovación y Calidad'),(27,'cordinacion@edittg.edu.m','Ing. Miguel Cid del Prado','Oficina de Educacion a distancia');
/*!40000 ALTER TABLE `correos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departamento`
--

DROP TABLE IF EXISTS `departamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departamento` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  `sub` int(2) DEFAULT NULL,
  `titular` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departamento`
--

LOCK TABLES `departamento` WRITE;
/*!40000 ALTER TABLE `departamento` DISABLE KEYS */;
INSERT INTO `departamento` VALUES (1,'CENTRO DE COMPUTO',22,'ISC. Jorge Otavio Guzmán Sánchez'),(2,'RECURSOS HUMANOS',22,''),(3,'RECURSOS FINANCIEROS',22,''),(4,'RECURSOS MATERIALES',22,''),(5,'MANTENIMIENTO',22,''),(6,'PLANEACION',23,''),(7,'GESTION TECNOLOGICA Y VINCULACION',23,''),(8,'CENTRO DE INFORMACION',23,''),(9,'ACTIVIDADES EXTRAESCOLARES',23,''),(10,'SERVICIOS ESCOLARES',23,''),(11,'COMUNICACION Y DIFUSION',23,''),(12,'DESARROLLO ACADEMICO',24,''),(13,'CIENCIAS BASICAS',24,''),(14,'CIENCIAS ECONOMICO ADMINISTRATIVAS',24,''),(15,'METAL MECANICA',24,''),(16,'ELECTRICA Y ELECTRONICA',24,''),(17,'QUIMICA Y BIOQUIMICA',24,''),(18,'SISTEMAS COMPUTACIONALES',24,''),(19,'INDUSTRIAL',24,''),(20,'DIVISION DE ESTUDIOS PROFESIONALES',24,''),(21,'DIVISION DE POSGRADO',24,''),(22,'SUB DIRECCION ADINISTRATIVA',25,'ING. MIGUEL CID DEL PRADO MARTINEZ'),(23,'SUB DIRECCION DE PLANEACION',25,'ING. JUAN JOSE VILLALOBOS MALDONADO'),(24,'SUB DIRECCION ACADEMICA',25,'ING. JOSE ANGEL ZEPEDA HERNANDEZ'),(25,'DIRECCION',NULL,''),(26,'INOVACION Y CALIDAD',25,'ING. JORGE SARMIENTO'),(27,'EDUCACION A DISTANCIA',24,'ING. ALEXIS AGUILAR');
/*!40000 ALTER TABLE `departamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `encuestas`
--

DROP TABLE IF EXISTS `encuestas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `encuestas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pregunta` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `oa` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `ob` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `oc` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
  `od` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
  `a` int(11) NOT NULL DEFAULT '0',
  `b` int(11) NOT NULL DEFAULT '0',
  `c` int(11) NOT NULL DEFAULT '0',
  `d` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `encuestas`
--

LOCK TABLES `encuestas` WRITE;
/*!40000 ALTER TABLE `encuestas` DISABLE KEYS */;
INSERT INTO `encuestas` VALUES (1,'¿Que prefieres como mascota para el tec?','Un conejo','Un Jaguar','Indiferente',NULL,3757,1661,313,0);
/*!40000 ALTER TABLE `encuestas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entrada`
--

DROP TABLE IF EXISTS `entrada`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entrada` (
  `orden` int(11) DEFAULT '0',
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `id_padre` int(4) NOT NULL,
  `titulo` varchar(100) COLLATE latin1_spanish_ci NOT NULL DEFAULT 'TITULO',
  `tipo` int(4) NOT NULL,
  `url` varchar(80) COLLATE latin1_spanish_ci DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `intra` tinyint(1) DEFAULT '0',
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci COMMENT='entradas (sistemas, secciones, contenidos)';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entrada`
--

LOCK TABLES `entrada` WRITE;
/*!40000 ALTER TABLE `entrada` DISABLE KEYS */;
INSERT INTO `entrada` VALUES (0,1,0,'INICIO',1,'','2008-01-01',0,1),(1,2,1,'HISTORIA',2,'','2008-01-29',0,1),(2,5,1,'DIRECTORIO',2,'','2008-01-01',0,1),(2,14,70,'Ing. Electrónica',2,'','2008-01-01',0,1),(1,16,70,'Ing. en Sistemas Computacionales',2,'','2008-01-01',0,1),(1,26,40,'CMS',999,'_cms/sistema.php','2008-01-01',1,1),(3,70,1,'CARRERAS',1,NULL,'2008-06-25',0,1);
/*!40000 ALTER TABLE `entrada` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `libre`
--

DROP TABLE IF EXISTS `libre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `libre` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `id_contenedor` int(11) DEFAULT NULL,
  `titulo` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
  `p01` text COLLATE latin1_spanish_ci,
  `img1` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `img2` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `img3` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `img4` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `img5` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `img6` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `img7` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `img8` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `img9` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `doc1` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `doc2` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `doc3` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `doc4` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `ima1` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `ima2` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `ima3` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `ima4` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `fecha` varchar(10) COLLATE latin1_spanish_ci DEFAULT '02/08/2007',
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci COMMENT='el texto libre';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `libre`
--

LOCK TABLES `libre` WRITE;
/*!40000 ALTER TABLE `libre` DISABLE KEYS */;
INSERT INTO `libre` VALUES (1,NULL,'ESCUDO','<p align=\"center\" style=\"font-weight: bold\">ESCUDO</p>\r\n<p align=\"left\">&nbsp;</p>\r\n<p><a href=\"img/logoTec.jpg\" rel=\"lightbox\"><img src=\"img/logoTec_thumb.jpg\" alt=\"logoTec\" width=\"170\" height=\"167\" border=\"0\" align=\"left\" longdesc=\"Logo del Instituto Tecnol&oacute;gico de Tuxtla Guti&eacute;rrez\" /></a>En 1974 se  desempe&ntilde;aba como director del Instituto Ricardo Ram&iacute;rez Vidal, quien  vio la necesidad de que se adoptara un escudo que identificara a la  instituci&oacute;n y que permitiera constituirse en el emblema que todos los  miembros de la comunidad tecnol&oacute;gica portaran con orgullo.</p>\r\n      <p>&nbsp;</p>\r\n      <p>Fue  lanzada la convocatoria en la que se invit&oacute; a alumnos, maestros y  trabajadores de apoyo para que presentaran diseños que ser&iacute;an evaluados  para seleccionar al m&aacute;s representativo, fue el alumno de la carrera de  T&eacute;cnicos en Maquinas de Combusti&oacute;n Interna, Boanerges de Le&oacute;n  Nucamendi, quien gan&oacute; el concurso de entre 15 proyectos.<br />\r\n          <br />\r\n        Dicho  escudo esta constituido por un matraz en la parte central que  representa a las Ciencias Qu&iacute;micas, a los lados lo apuntalan dos rayos  que representan a la F&iacute;sica que involucran a las &aacute;reas Electricidad y Electr&oacute;nica; el matraz est&aacute; soportado por la mitad de un cojinete con 13 bolas que representan las &aacute;reas relacionadas con la Mec&aacute;nica.</p>\r\n      <p>&nbsp;</p>\r\n      <p>Tambi&eacute;n  representa a los elementos que constituyen la base de la educaci&oacute;n  tecnol&oacute;gica y soportan adecuadamente al desarrollo regional.</p>\r\n      <p>&nbsp;</p>\r\n      <p>En  el interior del matraz se encuentra un libro abierto que representan el  conocimiento y que es destilado para que se derrame en la sociedad,  dentro del libro se encuentra un sombrero de Chamula cruzado por una  flecha lacandona, estos elementos representan la riqueza &eacute;tnica del  estado de Chiapas.</p>\r\n      <p>&nbsp;</p>\r\n      <p>Alrededor y en forma de arco se encuentran  encerrado al complejo los r&oacute;tulos &ldquo;Tecnol&oacute;gico&rdquo; en la parte superior y  &ldquo;Tuxtla Guti&eacute;rrez&rdquo; en la parte inferior; es necesario aclarar que en el  centro del libro estaba inscrito el n&uacute;mero 27, &eacute;ste correspond&iacute;a al  consecutivo que se asign&oacute; a la instituci&oacute;n en su fundaci&oacute;n, pero fue  retirado cuando el Instituto dej&oacute; de ser regional.</p>\r\n      <p>&nbsp;</p>\r\n      <p>Se encuentran  incluidos los colores representativos del Instituto Tecnol&oacute;gico: el  rojo en los rayos, el azul en los r&oacute;tulos y el blanco en el fondo.</p>\r\n      <p>&nbsp;</p>','_l_c_logotec.jpg',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'02/08/2007',1),(3,0,'BECAS','<p>[_d1]</p><p>&nbsp;</p><p>&nbsp;</p><p><a href=\"http://www.becanet.sep.gob\">sito de becanet</a>&nbsp;</p>',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'16/08/2007',1),(14,126,'CONVOCATORIA -SISTEMA INTERNO DE INVESTIGACION 2010','<p>&nbsp;</p>\r\n<p>CONVOCATORIA [_d1]</p>\r\n<p>&nbsp;</p>\r\n<p>SOLICITUD DE REGISTRO [_d2]</p>\r\n<p>&nbsp;</p>\r\n<p>FICHA PARA CONCENTRADO DE PROYECTOS DE INVESTIGACION [_d3]</p>\r\n<p>&nbsp;</p>\r\n<p>FICHA PARA REGISTRO DE CURRICULUM&nbsp;[_d4]</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'13doc1agregado.pdf','13doc2agregado.pdf','13doc3agregado.pdf','13doc4agregado.pdf',NULL,NULL,NULL,NULL,'2009-10-09',1),(28,127,'CONVOCATORIA  PARA PLAZAS DOCENTES','<p>VER DETALLES DE LAS CONVOCATORIAS [_d1]</p>',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'27doc1agregado.pdf',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2010-01-28',1),(30,127,'CONVOCATORIA  PARA PLAZAS DOCENTES','<p>PARA VER DETALLES DE LAS CONVOCATORIAS DA CLICK [_d1]</p>',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'29doc1agregado.pdf',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2010-01-28',1),(32,126,'CONVOCATORIA  PARA  BECARIOS ','<p style=\"text-align: center;\">[_i1]</p>\r\n<p style=\"text-align: center;\">&nbsp;</p>\r\n<p style=\"text-align: center;\">para ampliar da click [_d1]</p>',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'32doc1agregado.pdf',NULL,NULL,NULL,'31ima1agregado.jpg',NULL,NULL,NULL,'2010-02-05',1);
/*!40000 ALTER TABLE `libre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log` (
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `usuario` int(4) NOT NULL,
  `objeto` int(4) NOT NULL,
  `accion` int(4) NOT NULL,
  `query` text COLLATE latin1_spanish_ci NOT NULL,
  `id` int(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log`
--

LOCK TABLES `log` WRITE;
/*!40000 ALTER TABLE `log` DISABLE KEYS */;
INSERT INTO `log` VALUES ('2015-08-11','20:18:05',3,1,6,'',0),('2015-08-11','20:18:18',3,2,6,'',0),('2015-08-11','20:18:29',3,3,6,'',0),('2015-08-11','20:18:37',3,4,6,'',0),('2015-08-11','20:18:41',3,5,6,'',0),('2015-08-11','20:18:44',3,6,6,'',0),('2015-08-11','20:18:49',3,12,6,'',0),('2015-08-11','20:19:09',3,12,6,'',0),('2015-08-11','20:19:26',3,13,6,'',0),('2015-08-11','20:19:33',0,0,0,'',0),('2015-08-11','20:19:39',0,0,0,'',0),('2015-08-11','20:56:19',3,11,11,'',0),('2015-08-11','20:56:34',0,0,0,'',0),('2015-08-11','20:56:42',3,12,6,'',0),('2015-08-11','21:07:36',3,12,6,'',0),('2015-08-11','21:08:52',3,12,6,'',0),('2015-08-11','21:09:50',3,12,6,'',0),('2015-08-11','21:10:10',3,12,6,'',0),('2015-08-11','21:10:23',3,6,6,'',0),('2015-08-11','21:10:30',3,12,6,'',0),('2015-08-11','21:10:53',3,12,1,'INSERT INTO propuesta_usuario (idc, idu) VALUES (5 , 31) ',0),('2015-08-11','21:10:57',3,12,6,'',0),('2015-08-11','21:13:17',3,12,6,'',0),('2015-08-11','21:13:25',3,8,6,'',0),('2015-08-11','21:13:33',3,8,6,'',0),('2015-08-11','21:13:47',1,11,11,'',0),('2015-08-11','21:14:01',1,12,6,'',0),('2015-08-11','21:14:06',1,8,6,'',0),('2015-08-11','21:14:11',1,8,6,'',0),('2015-08-11','21:14:16',1,8,6,'',0),('2015-08-11','21:15:09',1,12,1,'INSERT INTO propuesta_usuario (idc, idu) VALUES (25 , 1) ',0),('2015-08-11','21:15:11',1,12,6,'',0),('2015-08-11','21:15:17',1,8,6,'',0),('2015-08-11','21:15:21',1,8,6,'',0),('2015-08-11','21:15:26',1,8,6,'',0),('2015-08-11','21:17:43',1,12,6,'',0),('2015-08-11','21:17:48',1,8,6,'',0),('2015-08-11','21:20:08',1,12,1,'INSERT INTO propuesta_usuario (idc, idu) VALUES (2 , 31) ',0),('2015-08-11','21:20:13',1,12,6,'',0),('2015-08-11','21:20:32',1,8,6,'',0),('2015-08-11','21:20:37',0,0,2,'',2),('2015-08-11','21:22:25',1,8,6,'',0),('2015-08-13','22:52:30',1,11,11,'',0),('2015-08-13','22:52:47',1,1,6,'',0),('2015-08-13','22:57:10',1,2,6,'',0),('2015-08-13','22:57:16',1,2,10,'',59),('2015-08-13','22:58:31',1,2,6,'',0),('2015-08-13','23:00:33',1,2,10,'',55),('2015-08-13','23:01:06',1,2,6,'',0),('2015-08-13','23:01:13',1,2,10,'',113),('2015-08-13','23:01:35',1,2,6,'',0),('2015-08-13','23:03:16',1,2,6,'',0),('2015-08-13','23:03:43',1,2,10,'',48),('2015-08-13','23:03:54',1,2,6,'',0),('2015-08-13','23:04:35',1,2,6,'',0),('2015-08-13','23:05:11',1,1,6,'',0),('2015-08-13','23:09:23',1,1,6,'',0),('2015-08-13','23:12:25',1,1,6,'',0),('2015-08-13','23:12:34',1,1,5,'',0),('2015-08-13','23:12:36',1,1,5,'',0),('2015-08-13','23:13:08',1,1,5,'',0),('2015-08-13','23:13:10',1,1,5,'',0),('2015-08-13','23:13:17',1,1,5,'',0),('2015-08-13','23:13:18',1,1,5,'',0),('2015-08-13','23:14:41',1,2,6,'',0),('2015-08-13','23:14:48',1,2,10,'',14),('2015-08-13','23:14:59',1,1,6,'',0),('2015-08-13','23:15:01',1,1,10,'',14),('2015-08-13','23:15:16',1,1,2,'UPDATE entrada SET id_padre = \'70\', titulo = \'Ing. Electrónica\', tipo = \'2\', intra = \'0\', activo = \'1\', fecha = \'2008-01-01\'   WHERE id = 14;',14),('2015-08-13','23:15:17',1,1,6,'',0),('2015-09-04','10:56:38',1,11,11,'',0);
/*!40000 ALTER TABLE `log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `noticia`
--

DROP TABLE IF EXISTS `noticia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `noticia` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) COLLATE latin1_spanish_ci DEFAULT 'Titulo',
  `p01` text COLLATE latin1_spanish_ci,
  `img1` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `img2` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `img3` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `img4` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `img5` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `img6` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `img7` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `img8` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `img9` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `doc1` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `doc2` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `doc3` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `doc4` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `ima1` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `ima2` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `ima3` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `ima4` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `nuevo` int(1) NOT NULL DEFAULT '2',
  `publico` tinyint(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci COMMENT='noticias';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `noticia`
--

LOCK TABLES `noticia` WRITE;
/*!40000 ALTER TABLE `noticia` DISABLE KEYS */;
/*!40000 ALTER TABLE `noticia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `objeto`
--

DROP TABLE IF EXISTS `objeto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `objeto` (
  `sec` int(2) NOT NULL DEFAULT '1',
  `id` int(4) NOT NULL,
  `descripcion` varchar(10) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `objeto`
--

LOCK TABLES `objeto` WRITE;
/*!40000 ALTER TABLE `objeto` DISABLE KEYS */;
INSERT INTO `objeto` VALUES (1,1,'ENTRADA'),(2,2,'CONTENIDO'),(3,3,'NOTICIA'),(4,4,'AVISO'),(5,5,'ANUNCIOG'),(6,6,'COMENTARIO'),(7,7,'BANNER'),(8,12,'POSTOR'),(9,8,'PROPUESTA'),(10,13,'AGREGADO'),(11,9,'USUARIOS'),(12,10,'BITACORA'),(100,11,'SISTEMA');
/*!40000 ALTER TABLE `objeto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `per`
--

DROP TABLE IF EXISTS `per`;
/*!50001 DROP VIEW IF EXISTS `per`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `per` AS SELECT 
 1 AS `USUARIO`,
 1 AS `OBJETO`,
 1 AS `ACCION`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `permisos`
--

DROP TABLE IF EXISTS `permisos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permisos` (
  `usuario` int(4) NOT NULL,
  `objeto` int(4) NOT NULL,
  `accion` int(4) NOT NULL,
  `menu` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permisos`
--

LOCK TABLES `permisos` WRITE;
/*!40000 ALTER TABLE `permisos` DISABLE KEYS */;
INSERT INTO `permisos` VALUES (6,8,8,1),(6,9,14,1),(7,8,8,1),(7,9,14,1),(8,8,8,1),(8,9,14,1),(9,8,8,1),(9,9,14,1),(10,8,8,1),(10,9,14,1),(11,8,8,1),(11,9,14,1),(12,8,8,1),(12,9,14,1),(13,8,8,1),(13,9,14,1),(14,8,8,1),(14,9,14,1),(15,8,8,1),(15,9,14,1),(16,8,8,1),(16,9,14,1),(17,8,8,1),(17,9,14,1),(18,8,8,1),(18,9,14,1),(19,8,8,1),(19,9,14,1),(20,8,8,1),(20,9,14,1),(21,8,8,1),(21,9,14,1),(22,8,8,1),(22,9,14,1),(23,8,8,1),(23,9,14,1),(24,8,8,1),(24,9,14,1),(26,8,8,1),(26,9,14,1),(27,1,2,0),(27,1,5,1),(27,1,6,1),(27,1,10,0),(27,2,2,0),(27,2,6,1),(27,2,10,0),(27,3,1,1),(27,3,2,0),(27,3,3,0),(27,3,6,1),(27,3,10,0),(27,4,1,1),(27,4,2,0),(27,4,3,0),(27,4,6,1),(27,4,10,0),(27,5,1,1),(27,5,2,0),(27,5,3,0),(27,5,6,1),(27,5,10,0),(27,6,3,0),(27,6,4,0),(27,6,6,1),(27,6,10,0),(27,8,9,1),(27,10,9,1),(4,6,6,1),(4,6,10,0),(4,9,14,1),(31,1,6,1),(31,1,10,0),(31,2,6,1),(31,2,10,0),(31,3,1,1),(31,3,2,0),(31,3,3,0),(31,3,6,1),(31,3,10,0),(31,4,1,1),(31,4,2,0),(31,4,3,0),(31,4,6,1),(31,4,10,0),(31,5,6,1),(31,5,10,0),(31,6,6,1),(31,6,10,0),(31,7,6,1),(31,13,1,1),(31,13,2,0),(31,13,3,0),(31,13,6,1),(31,13,10,0),(31,9,14,1),(31,10,9,1),(2,1,1,1),(2,1,2,0),(2,1,3,0),(2,1,5,1),(2,2,1,1),(2,2,2,0),(2,2,3,0),(2,2,6,1),(2,2,10,0),(2,3,1,1),(2,3,6,1),(2,3,10,0),(2,4,1,1),(2,4,6,1),(2,4,10,0),(2,5,1,1),(2,5,6,1),(2,5,10,0),(2,13,1,1),(2,13,6,1),(2,13,10,0),(2,9,14,1),(1,1,1,1),(1,1,2,0),(1,1,3,0),(1,1,5,1),(1,1,6,1),(1,1,10,0),(1,2,1,1),(1,2,2,0),(1,2,3,0),(1,2,6,1),(1,2,10,0),(1,3,1,1),(1,3,2,0),(1,3,3,0),(1,3,6,1),(1,3,10,0),(1,4,1,1),(1,4,2,0),(1,4,3,0),(1,4,6,1),(1,4,10,0),(1,5,1,1),(1,5,2,0),(1,5,3,0),(1,5,6,1),(1,5,10,0),(1,6,3,0),(1,6,4,0),(1,6,6,1),(1,6,10,0),(1,12,1,1),(1,12,6,1),(1,8,8,1),(1,8,9,1),(1,13,1,1),(1,13,2,0),(1,13,3,0),(1,13,6,1),(1,13,10,0),(1,9,6,1),(1,9,14,1),(1,10,9,1),(3,1,1,1),(3,1,2,0),(3,1,3,0),(3,1,5,1),(3,1,6,1),(3,1,10,0),(3,2,1,1),(3,2,2,0),(3,2,3,0),(3,2,6,1),(3,2,10,0),(3,3,1,1),(3,3,2,0),(3,3,3,0),(3,3,6,1),(3,3,10,0),(3,4,1,1),(3,4,2,0),(3,4,3,0),(3,4,6,1),(3,4,10,0),(3,5,1,1),(3,5,2,0),(3,5,3,0),(3,5,6,1),(3,5,10,0),(3,6,6,1),(3,6,10,0),(3,12,1,1),(3,12,6,1),(3,8,8,1),(3,8,9,1),(3,13,1,1),(3,13,2,0),(3,13,3,0),(3,13,6,1),(3,13,10,0),(3,9,1,1),(3,9,2,0),(3,9,3,0),(3,9,6,1),(3,9,14,1),(3,10,9,1);
/*!40000 ALTER TABLE `permisos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permisos2`
--

DROP TABLE IF EXISTS `permisos2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permisos2` (
  `objeto` int(4) NOT NULL,
  `id` int(4) NOT NULL,
  `descripcion` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  UNIQUE KEY `objeto` (`objeto`,`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permisos2`
--

LOCK TABLES `permisos2` WRITE;
/*!40000 ALTER TABLE `permisos2` DISABLE KEYS */;
INSERT INTO `permisos2` VALUES (1,1,'AGREGAR'),(1,2,'MODIFICAR'),(1,3,'ELIMINAR'),(1,5,'ORDENAR'),(1,6,'LISTAR'),(1,10,'VER'),(2,1,'AGREGAR'),(2,2,'MODIFICAR'),(2,3,'ELIMINAR'),(2,6,'LISTAR'),(2,10,'VER'),(3,1,'AGREGAR'),(3,2,'MODIFICAR'),(3,3,'ELIMINAR'),(3,6,'LISTAR'),(3,10,'VER'),(4,1,'AGREGAR'),(4,2,'MODIFICAR'),(4,3,'ELIMINAR'),(4,6,'LISTAR'),(4,10,'VER'),(5,1,'AGREGAR'),(5,2,'MODIFICAR'),(5,3,'ELIMINAR'),(5,6,'LISTAR'),(5,10,'VER'),(6,3,'ELIMINAR'),(6,4,'CONTESTAR'),(6,6,'LISTAR'),(6,10,'VER'),(7,1,'AGREGAR'),(7,3,'ELIMINAR'),(7,6,'LISTAR'),(8,8,'PROPONER'),(8,9,'REVISAR'),(9,1,'AGREGAR'),(9,2,'MODIFICAR'),(9,3,'ELIMINAR'),(9,6,'LISTAR'),(9,14,'CAMBIAR PASSWORD'),(10,9,'REVISAR'),(12,1,'AGREGAR'),(12,6,'LISTAR'),(13,1,'AGREGAR'),(13,2,'MODIFICAR'),(13,3,'ELIMINAR'),(13,6,'LISTAR'),(13,10,'VER');
/*!40000 ALTER TABLE `permisos2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `ponencias`
--

DROP TABLE IF EXISTS `ponencias`;
/*!50001 DROP VIEW IF EXISTS `ponencias`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `ponencias` AS SELECT 
 1 AS `uid`,
 1 AS `donde`,
 1 AS `nombre`,
 1 AS `modificado`,
 1 AS `idc`,
 1 AS `titulo`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `propuesta`
--

DROP TABLE IF EXISTS `propuesta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `propuesta` (
  `idp` int(4) NOT NULL AUTO_INCREMENT,
  `idc` int(4) NOT NULL,
  `p01` text COLLATE latin1_spanish_ci,
  `img1` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `img2` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `img3` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `img4` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `img5` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `img6` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `img7` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `img8` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `img9` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `doc1` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `doc2` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `doc3` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `doc4` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `ima1` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `ima2` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `ima3` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `ima4` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL,
  `modificado` tinyint(1) NOT NULL DEFAULT '0',
  `nota` text COLLATE latin1_spanish_ci,
  PRIMARY KEY (`idp`),
  UNIQUE KEY `idc` (`idc`),
  UNIQUE KEY `idc_2` (`idc`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci COMMENT='el texto que proponen';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `propuesta`
--

LOCK TABLES `propuesta` WRITE;
/*!40000 ALTER TABLE `propuesta` DISABLE KEYS */;
INSERT INTO `propuesta` VALUES (1,48,'<p>Espacio del departamento de desarrollo ac&aacute;demico ir a <a href=\"http://wwww.google.com.mx\">google</a></p>','48img1contenido.jpg',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'<p>Debe cambiarse</p>'),(2,6,'<p style=\"font-weight: bold\" align=\"center\">Departamento de Servicios Escolares</p>\r\n<p>&nbsp;</p>\r\n<p>CAMBIANDO</p>','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(8,30,'<p>La Secretaria de Educaci&oacute;n en conjunto con el Gobierno del Estado de Chiapas , &nbsp;se dieron a la tarea de buscar alternativas de Educaci&oacute;n Superior para aquellas personas que por situaciones econ&oacute;micas y marginadas de las zonas donde viven no han logrado concluir una carrera profesional, con el objetivo de aprovechar las nuevas tecnolog&iacute;as de informaci&oacute;n y comunicaci&oacute;n que existen para abatir los costos recibiendo un servicio educativo con la misma calidez que la tienen los municipios con mayor desarrollo en el estado.</p>\r\n<p>En el a&ntilde;o 2005 la Secretaria de Educaci&oacute;n y el Gobernador del Estado Lic. Pablo Salazar Mendiguchia convocaron a diferentes instituciones de educaci&oacute;n superior en el estado con el fin de obtener una soluci&oacute;n al problema propuesto.</p>\r\n<p>En Julio del 2006 se da un gran avance en el proyecto de Educaci&oacute;n a Distancia, cuando el Gobernador del Estado el Lic. Pablo Salazar Mendiguchia asiste a las instalaciones del Instituto Tecnol&oacute;gico de Tuxtla Guti&eacute;rrez a inaugurar la sede central de este gran proyecto....</p>\r\n<p>Si deseas conocer mas,&nbsp;&nbsp;el sitio del sistema de Edcaci&oacute;n Superior a Distancia lo puedes acceder <a href=\"http://www.edittg.edu.mx/\" target=\"_blank\">aqu&iacute;</a></p>',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(10,90,'<p>P&aacute;gina en construcci&oacute;n, visite la <a href=\"http://www.google.com.mx\">p&aacute;gina</a></p>',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL),(11,102,'<p>La Secretar&iacute;a de Educaci&oacute;n P&uacute;blica, en el af&aacute;n de garantizar la calidad de la educaci&oacute;n superior p&uacute;blica, impulsa programas extraordinarios a trav&eacute;s de los cuales se pretende atender la demanda de educaci&oacute;n superior, ofreciendo servicio educativo con Calidad. Entre los objetivos estrat&eacute;gicos que se alcanzar&aacute;n hacia el 2006 a trav&eacute;s de estos programas especiales, se encuentran la ampliaci&oacute;n de cobertura con equidad, calidad de planes y programas de estudio, as&iacute; como los servicios que ofrecen las IES p&uacute;blicas y la integraci&oacute;n, coordinaci&oacute;n y gesti&oacute;n del sistema de educaci&oacute;n superior.<br />El Instituto Tecnol&oacute;gico de Tuxtla Guti&eacute;rrez ha hecho patente siempre su compromiso con la sociedad y con los j&oacute;venes de Chiapas y M&eacute;xico, en respuesta a estos retos, a principios del 2004 implement&oacute; el Programa de Innovaci&oacute;n y Calidad y en Diciembre de ese mismo a&ntilde;o, inici&oacute; la implementaci&oacute;n de su Sistema de Gesti&oacute;n de la Calidad basado en la norma ISO 9001:2000, incorporando as&iacute; las herramientas necesarias para responder con &eacute;xito las exigencias del mundo actual.<br /><br />El personal directivo, docentes, de apoyo administrativo y alumnos, est&aacute;n unidos en este esfuerzo por consolidar al Instituto Tecnol&oacute;gico de Tuxtla Guti&eacute;rrez como una Instituci&oacute;n reconocida por la calidad de sus servicios educativos a trav&eacute;s de la Certificaci&oacute;n de su Proceso Educativo, conforme a la Norma ISO 9001:2000.</p>\r\n<p>&nbsp;</p>\r\n<p style=\"font-weight: bold\">Pol&iacute;tica de Calidad</p>\r\n<p>&nbsp;</p>\r\n<p>El SNEST establece el compromiso de implementar todos sus procesos, orient&aacute;ndolos hacia la satisfacci&oacute;n de sus clientes sustentada en la Calidad del Proceso Educativo, para cumplir con sus requerimientos mediante la eficacia de un Sistema de Gesti&oacute;n de la Calidad y de mejora continua, conforme a la norma ISO 9001:2000/NMX-CC-9001-IMNC-2000.</p>\r\n<p>&nbsp;</p>\r\n<p style=\"font-weight: bold\">Los valores de la Organizaci&oacute;n son:</p>\r\n<p>&nbsp;</p>\r\n<ul>\r\n<li>El ser humano</li>\r\n<li>El esp&iacute;ritu de servicio</li>\r\n<li>El liderazgo</li>\r\n<li>El Trabajo en equipo</li>\r\n<li>La calidad</li>\r\n<li>Alto desempe&ntilde;o</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p style=\"font-weight: bold; font-style: italic\" align=\"center\">Objetivos de la Calidad</p>\r\n<p>&nbsp;</p>\r\n<p style=\"font-weight: bold\">Objetivo General:</p>\r\n<p>&nbsp;</p>\r\n<p>&ldquo;Proporcionar el Servicio Educativo de Calidad, orientado hacia el Aprendizaje significativo en el alumno&rdquo;.</p>\r\n<p>&nbsp;</p>\r\n<p style=\"font-weight: bold; font-style: italic\" align=\"center\">Objetivos de Procesos Estrat&eacute;gicos</p>\r\n<p>&nbsp;</p>\r\n<p><span style=\"font-weight: bold\">Acad&eacute;mico:</span></p>\r\n<p>&nbsp;</p>\r\n<p>Gestionar los Planes y Programas de Estudio, as&iacute; como los programas de formaci&oacute;n y actualizaci&oacute;n docente y profesional en el servicio educativo.</p>\r\n<p>&nbsp;</p>\r\n<p style=\"font-weight: bold\">Planeaci&oacute;n:</p>\r\n<p>&nbsp;</p>\r\n<p>Definir el rumbo estrat&eacute;gico mediante la planeaci&oacute;n y realizar la programaci&oacute;n, presupuestaci&oacute;n, seguimiento y evaluaci&oacute;n de las acciones para cumplir con los requisitos del servicio.</p>\r\n<p>&nbsp;</p>\r\n<p><span style=\"font-weight: bold\">Vinculaci&oacute;n y Difusi&oacute;n de la Cultura:</span></p>\r\n<p>&nbsp;</p>\r\n<p>Contribuir a la formaci&oacute;n integral del Alumno, a trav&eacute;s de su vinculaci&oacute;n con el sector productivo y la sociedad, as&iacute; como del deporte y la cultura.</p>\r\n<p>&nbsp;</p>\r\n<p style=\"font-weight: bold\">Administraci&oacute;n de recursos:</p>\r\n<p>&nbsp;</p>\r\n<p>Determinar y proporcionar los recursos necesarios para implementar, mantener y mejorar el SGC y lograr la conformidad con los requisitos del Servicio Educativo.</p>\r\n<p>&nbsp;</p>\r\n<p style=\"font-weight: bold\">Innovaci&oacute;n y Calidad:</p>\r\n<p>&nbsp;</p>\r\n<p>Promover una cultura de calidad al interior de la ORGANIZACI&Oacute;N y asegurar la satisfacci&oacute;n del alumno.</p>\r\n<p>&nbsp;</p>\r\n<p><a href=\"http://148.208.246.250/sgc/formatos/\">Formatos</a></p>',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL),(12,101,'<p>el centro de computo tiene</p>',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,''),(13,100,'<p>P&aacute;gina en construcci&oacute;n</p>',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL),(14,99,'<p>P&aacute;gina en construcci&oacute;n</p>',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL),(15,98,'<p>P&aacute;gina en construcci&oacute;n</p>',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL),(16,97,'<p>P&aacute;gina en construcci&oacute;n</p>',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL),(17,96,'<p>P&aacute;gina en construcci&oacute;n</p>',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL),(18,95,'<p>P&aacute;gina en construcci&oacute;n</p>',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL),(19,94,'<p>P&aacute;gina en construcci&oacute;n</p>',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL),(20,93,'<p>P&aacute;gina en construcci&oacute;n</p>',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL),(21,92,'<p>P&aacute;gina en construcci&oacute;n</p>',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL),(22,91,'<p>*P&aacute;gina en construcci&oacute;n</p>',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL),(23,89,'<p>P&aacute;gina en construcci&oacute;n</p>',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL),(24,88,'<p>*P&aacute;gina en construcci&oacute;n</p>',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL),(25,87,'<p>P&aacute;gina en construcci&oacute;n</p>',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL),(26,86,'<p>P&aacute;gina en construcci&oacute;n</p>',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL),(27,85,'<ul>\r\n<li>\r\n<h2>&iquest;Qu&eacute; es la Divisi&oacute;n de Estudios Profesionales?</h2>\r\n</li>\r\n<li>\r\n<h2>Organigrama</h2>\r\n</li>\r\n<li>\r\n<h2>Tr&aacute;mites que puedes realizar en la Divisi&oacute;n de Estudios Profesionales</h2>\r\n<ul>\r\n<li>\r\n<h3>Cambio de carrera</h3>\r\n</li>\r\n<li>\r\n<h3>Tr&aacute;nsito estudiantil</h3>\r\n</li>\r\n<li>\r\n<h3>Movilidad estudiantil</h3>\r\n</li>\r\n<li>\r\n<h3>Titulaci&oacute;n</h3>\r\n</li>\r\n</ul>\r\n</li>\r\n</ul>',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'85doc1contenido.pdf',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL),(28,5,'<p style=\"text-align: center;\"><strong>Directorio</strong></p>\r\n<p style=\"text-align: center;\"><strong>\r\n<p><strong><strong></strong></strong></p>\r\n<table border=\"1\" cellspacing=\"0\" cellpadding=\"0\" width=\"529\">\r\n<tbody>\r\n<tr>\r\n<td width=\"348\">\r\n<p><strong>Nombre y Cargo</strong></p>\r\n</td>\r\n<td>\r\n<p><strong>Ext.</strong></p>\r\n</td>\r\n<td>\r\n<p><strong>Correo electr&oacute;nico</strong></p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"348\">\r\n<p>Ing. Jos&eacute; Luis Herrera Mart&iacute;nez<br /><strong>Director del I.T.T.G.</strong></p>\r\n</td>\r\n<td>\r\n<p>100</p>\r\n</td>\r\n<td>\r\n<p>director*</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"348\">\r\n<p>Psic. Adriana Gonz&aacute;lez Escobar <br /><strong>Subdirectora Acad&eacute;mica </strong></p>\r\n</td>\r\n<td>\r\n<p>300</p>\r\n</td>\r\n<td>\r\n<p>subacadem*</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"348\">\r\n<p>M.C. Ignacio Arrioja Cardenas<br /><strong>Subdirector de Planeaci&oacute;n y Vinculaci&oacute;n </strong></p>\r\n</td>\r\n<td>\r\n<p>400</p>\r\n</td>\r\n<td>\r\n<p>subplanea*</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"348\">\r\n<p>M. C. Miguel Cid del Prado Mart&iacute;nez<br /><strong>Subdirector de Servicios Administrativos </strong></p>\r\n</td>\r\n<td>\r\n<p>200</p>\r\n</td>\r\n<td>\r\n<p>subadmon*</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"348\">\r\n<p>Dr. Daniel Samayoa Penagos<br /><strong>Jefe del Depto. de Comunicaci&oacute;n y Difusi&oacute;n </strong></p>\r\n</td>\r\n<td>\r\n<p>404</p>\r\n</td>\r\n<td>\r\n<p>difusion*</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"348\">\r\n<p>Ing. Roberto Cifuentes Villafuerte<strong></strong></p>\r\n<p><strong>Jefe de la Divisi&oacute;n de Estudios Profesionales </strong></p>\r\n</td>\r\n<td>\r\n<p>303</p>\r\n</td>\r\n<td>\r\n<p>division*</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"348\">\r\n<p>C.P. Melquiceded Dom&iacute;nguez Hol&aacute;n <br /><strong>Jefe del Depto. de Recursos Financieros </strong></p>\r\n</td>\r\n<td>\r\n<p>209</p>\r\n</td>\r\n<td>\r\n<p>finanzas*</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"348\">\r\n<p>Ing. Francisco de Jes&uacute;s Suarez Ruiz <br /><strong>Jefe del Depto. de Activ. Extraescolares </strong></p>\r\n</td>\r\n<td>\r\n<p>402</p>\r\n</td>\r\n<td>\r\n<p>extraescolar*</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"348\">\r\n<p>M.C. Ren&eacute; R&iacute;os Couti&ntilde;o <br /><strong>Jefe del Depto. de Recursos Humanos </strong></p>\r\n</td>\r\n<td>\r\n<p>210</p>\r\n</td>\r\n<td>\r\n<p>humanos*</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"348\">\r\n<p>C.P. Agust&iacute;n V&aacute;zquez Morales<br /><strong>Jefe del Depto. de Recursos Materiales y Servicios</strong></p>\r\n</td>\r\n<td>\r\n<p>212</p>\r\n</td>\r\n<td>\r\n<p>materiales*</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"348\">\r\n<p>M.C. A&iacute;da Guillermina Coss&iacute;o Mart&iacute;nez <br /><strong>Jefa del Depto. de Ingenier&iacute;a en Sistemas Computacionales </strong></p>\r\n</td>\r\n<td>\r\n<p>319</p>\r\n</td>\r\n<td>\r\n<p>sistemas*</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"348\">\r\n<p>Dr. H&eacute;ctor Ricardo Hern&aacute;ndez de Le&oacute;n<br /><strong>Jefe de la Div. de Est.. Invest. y Posgrado </strong></p>\r\n</td>\r\n<td>\r\n<p>306</p>\r\n</td>\r\n<td>\r\n<p>posgrado*</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"348\">\r\n<p>C.P. Liliana Patricia Moreno Cancino <br /><strong>Jefa del Depto. de Planeaci&oacute;n, Programaci&oacute;n y Presupuestaci&oacute;n </strong></p>\r\n</td>\r\n<td>\r\n<p>406</p>\r\n</td>\r\n<td>\r\n<p>planea*</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"348\">\r\n<p>Ing. Vicente Le&oacute;n Orozco<br /><strong>Jefe Depto. de Ing. El&eacute;ctrica y Electr&oacute;nica </strong></p>\r\n</td>\r\n<td>\r\n<p>311</p>\r\n</td>\r\n<td>\r\n<p>eleyeca*</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"348\">\r\n<p>Ing. Carlos Ram&oacute;n Alfonzo Santiago</p>\r\n<p><strong>Jefe del Depto. de Mantenimiento de Equipo </strong></p>\r\n</td>\r\n<td>\r\n<p>207</p>\r\n</td>\r\n<td>\r\n<p>mantto*</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"348\">\r\n<p>Ing. Javier Ram&iacute;rez D&iacute;az <br /><strong>Jefe del Depto. de Ing. Qu&iacute;mica y Bioqu&iacute;mica</strong></p>\r\n</td>\r\n<td>\r\n<p>316</p>\r\n</td>\r\n<td>\r\n<p>quimica*</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"348\">\r\n<p>M.C. Apolinar P&eacute;rez L&oacute;pez<br /><strong>Jefe del Depto. de Metalmec&aacute;nica </strong></p>\r\n</td>\r\n<td>\r\n<p>315</p>\r\n</td>\r\n<td>\r\n<p>mecanica*</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"348\">\r\n<p>Ing. Jorge Octavio Guzm&aacute;n S&aacute;nchez <br /><strong>Jefe del Centro de C&oacute;mputo </strong></p>\r\n</td>\r\n<td>\r\n<p>205</p>\r\n</td>\r\n<td>\r\n<p>computo*</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"348\">\r\n<p>Ing. Jorge Antonio Orozco Torres <br /><strong>Jefe del Depto. de Ing. Industrial </strong></p>\r\n</td>\r\n<td>\r\n<p>313</p>\r\n</td>\r\n<td>\r\n<p>industrial*</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"348\">\r\n<p>Lic. Edna Morales Couti&ntilde;o<br /><strong>Jefa del Depto. de Desarrollo Acad&eacute;mico </strong></p>\r\n</td>\r\n<td>\r\n<p>308</p>\r\n</td>\r\n<td>\r\n<p>desacad*</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"348\">\r\n<p>M. C. Raquel Camacho M&eacute;ndez<br /><strong>Jefa del Depto. de Ciencias B&aacute;sicas </strong></p>\r\n</td>\r\n<td>\r\n<p>307</p>\r\n</td>\r\n<td>\r\n<p>basicas*</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"348\">\r\n<p>Lic. Mar&iacute;a Isabel Palacios Trujillo <br /><strong>Jefa del Depto. de Servicios Escolares </strong></p>\r\n</td>\r\n<td>\r\n<p>407</p>\r\n</td>\r\n<td>\r\n<p>descolares*</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"348\">\r\n<p>Lic. Ren&eacute; Arj&oacute;n Castro <br /><strong>Jefe del Centro de Informaci&oacute;n </strong></p>\r\n</td>\r\n<td>\r\n<p>403</p>\r\n</td>\r\n<td>\r\n<p>biblioteca*</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"348\">\r\n<p>M.C. Roberto Carlos Garc&iacute;a G&oacute;mez<br /><strong>Jefe del Depto. Gesti&oacute;n Tecnol&oacute;gica y Vinculaci&oacute;n </strong></p>\r\n</td>\r\n<td>\r\n<p>405</p>\r\n</td>\r\n<td>\r\n<p>gestion*</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"348\">\r\n<p>Ing. Mar&iacute;a Delina Culebro Farrera<br /><strong>Jefa del Depto. Econ&oacute;mico - Administrativo </strong></p>\r\n</td>\r\n<td>\r\n<p>320</p>\r\n</td>\r\n<td>\r\n<p>informatica*</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td width=\"348\">\r\n<p>Ing. Jorge Arturo Sarmiento Torres <br /><strong>Oficina de Innovaci&oacute;n y Calidad <br />Representante de la Direcci&oacute;n </strong></p>\r\n</td>\r\n<td>\r\n<p>305</p>\r\n</td>\r\n<td>\r\n<p>sgcittg*</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</strong></p>\r\n<p>&nbsp;</p>\r\n<p><br />*Todos los correos son @ ittg.edu.mx</p>','5_c_1.png','5_c_2.JPG','5_c_3.jpg','5_c_4.JPG','5_c_5.JPG','5_c_6.JPG','5_c_7.JPG','5_c_8.JPG','5img9contenido.jpg',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL),(29,25,'<p><strong>Misi&oacute;n</strong><br />Formar de manera integral profesionistas de excelencia en el campo de la ciencia y la tecnol&oacute;gia con actitud emprendedora, respeto al medio ambiente y apego a los valores &eacute;ticos<br /><br /><strong>Visi&oacute;n</strong><br />Ser una Instituci&oacute;n de excelencia en la educaci&oacute;n superior tecnol&oacute;gica del Sureste, comprometida con el desarrollo socioecon&oacute;mico sustentable de la regi&oacute;n<br /><br /><strong>Valores</strong></p>\r\n<ul>\r\n<li>El ser humano</li>\r\n<li>El esp&iacute;ritu de servicio</li>\r\n<li>El liderazgo</li>\r\n<li>El trabajo en equipo</li>\r\n<li>La calidad</li>\r\n<li>El alto desemp&eacute;&ntilde;o</li>\r\n</ul>','25_c_tec1.jpg','25_c_tec2.jpg','25_c_tec3.jpg',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL),(30,2,'<p style=\"font-weight: bold\" align=\"center\">Historia</p>\r\n<p>&nbsp;</p>\r\n<p>En la d&eacute;cada de los 70&rsquo;s, se incorpora el estado de Chiapas al movimiento educativo nacional extensi&oacute;n educativa, por intervenci&oacute;n del Gobierno del Estado de Chiapas ante la federaci&oacute;n.<br /><br />Esta gesti&oacute;n dio origen a la creaci&oacute;n del Instituto Tecnol&oacute;gico Regional de Tuxtla Guti&eacute;rrez (ITRTG) hoy Instituto Tecnol&oacute;gico de Tuxtla Guti&eacute;rrez (ITTG).<br /><br />El d&iacute;a 23 de agosto de 1971 el Gobernador del Estado, Dr. Manuel Velasco Su&aacute;rez, coloc&oacute; la primera piedra de lo que muy pronto ser&iacute;a el Centro Educativo de nivel medio superior m&aacute;s importante de la entidad.<br /><br />El d&iacute;a 22 de octubre de 1972, con una infraestructura de 2 edificios con 8 aulas, 2 laboratorios y un edificio para talleres abre sus puertas el Instituto Tecnol&oacute;gico de Tuxtla Guti&eacute;rrez con las carreras de T&eacute;cnico en M&aacute;quinas de Combusti&oacute;n Interna, Electricidad, Laboratorista Qu&iacute;mico y M&aacute;quinas y Herramientas.<br /><br />En el a&ntilde;o 1974 dio inicio la modalidad en el nivel superior, ofreciendo las carrera de Ingenier&iacute;a Industrial en Producci&oacute;n y Bioqu&iacute;mica en Productos Naturales.<br />En 1980 se ampli&oacute; la oferta educativa al incorporarse las carreras de Ingenier&iacute;a Industrial El&eacute;ctrica e Ingenier&iacute;a Industrial Qu&iacute;mica.<br /><br />En 1987 se abre la carrera de Ingenier&iacute;a en Electr&oacute;nica y se liquidan en 1989 las carreras del sistema abierto del nivel medio superior y en el nivel superior se reorient&oacute; la oferta en la carrera de Ingenier&iacute;a Industrial El&eacute;ctrica y se inicia tambi&eacute;n Ingenier&iacute;a Mec&aacute;nica.</p>\r\n<p>En 1991 surge la licenciatura en Ingenier&iacute;a en Sistemas Computacionales.<br /><br />Desde 1997 el Instituto Tecnol&oacute;gico de Tuxtla Guti&eacute;rrez ofrece la Especializaci&oacute;n en Ingenier&iacute;a Ambiental como primer programa de postgrado.</p>\r\n<p>En 1998 se estableci&oacute; el programa interinstitucional de postgrado con la Universidad Aut&oacute;noma de Chiapas para impartir en el Instituto Tecnol&oacute;gico la Maestr&iacute;a en Biotecnolog&iacute;a.<br /><br />En el a&ntilde;o 1999 se inici&oacute; el programa de Maestr&iacute;a en Administraci&oacute;n como respuesta a la demanda del sector industrial y de servicios de la regi&oacute;n.</p>\r\n<p>A partir de 2000 se abri&oacute; tambi&eacute;n la Especializaci&oacute;n en Biotecnolog&iacute;a Vegetal y un a&ntilde;o despu&eacute;s dio inicio el programa de Maestr&iacute;a en Ciencias en Ingenier&iacute;a Bioqu&iacute;mica y la Licenciatura en Inform&aacute;tica.<br /><br /><a href=\"contenido.php?id=1&amp;libre=1\">Escudo</a> del Instituto Tecnol&oacute;gico de Tuxtla Guti&eacute;rrez</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>Como llegar? <a href=\"http://maps.google.es/maps/ms?f=q&amp;hl=es&amp;geocode=&amp;ie=UTF8&amp;t=h&amp;g=tuxtla+gutierrez+chiapas+mexico&amp;msa=0&amp;msid=116483312603248095203.00045ad1687d898d5509a&amp;ll=16.758831,-93.17256&amp;spn=0.009801,0.01914&amp;z=16\">aqui</a></p>\r\n<p>&nbsp;</p>\r\n<hr />','2_c_1.png','2_c_2.jpg','2_c_3.JPG','2_c_4.JPG','2_c_5.JPG','2_c_6.JPG','2_c_7.JPG','2_c_8.JPG',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,NULL);
/*!40000 ALTER TABLE `propuesta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `propuesta_usuario`
--

DROP TABLE IF EXISTS `propuesta_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `propuesta_usuario` (
  `idp` int(5) NOT NULL AUTO_INCREMENT,
  `idc` int(5) NOT NULL,
  `idu` int(5) NOT NULL,
  PRIMARY KEY (`idp`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `propuesta_usuario`
--

LOCK TABLES `propuesta_usuario` WRITE;
/*!40000 ALTER TABLE `propuesta_usuario` DISABLE KEYS */;
INSERT INTO `propuesta_usuario` VALUES (1,48,6),(2,6,7),(8,30,26),(10,90,14),(11,102,25),(12,101,3),(13,100,24),(14,99,23),(15,98,22),(16,97,21),(17,96,20),(18,95,19),(19,94,18),(20,93,17),(21,92,16),(22,91,15),(23,89,13),(24,88,11),(25,87,10),(26,86,9),(27,85,8),(30,2,31);
/*!40000 ALTER TABLE `propuesta_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo`
--

DROP TABLE IF EXISTS `tipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(10) COLLATE latin1_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1001 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo`
--

LOCK TABLES `tipo` WRITE;
/*!40000 ALTER TABLE `tipo` DISABLE KEYS */;
INSERT INTO `tipo` VALUES (1,'SECCION'),(2,'CONTENIDO'),(5,'CONTENEDOR'),(999,'SISTEMA'),(1000,'PAGINA');
/*!40000 ALTER TABLE `tipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo2`
--

DROP TABLE IF EXISTS `tipo2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo2` (
  `id` int(4) NOT NULL,
  `descripcion` varchar(10) COLLATE latin1_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo2`
--

LOCK TABLES `tipo2` WRITE;
/*!40000 ALTER TABLE `tipo2` DISABLE KEYS */;
INSERT INTO `tipo2` VALUES (2,'CONTENIDO'),(3,'ANUNCIO'),(4,'NOTICIA'),(5,'CONTENEDOR'),(999,'SISTEMA'),(1000,'PAGINA'),(2000,'BANNER');
/*!40000 ALTER TABLE `tipo2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` tinyint(5) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `usuario` varchar(15) COLLATE latin1_spanish_ci DEFAULT NULL,
  `pass` varchar(32) COLLATE latin1_spanish_ci DEFAULT NULL,
  `email` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  `depto` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Lic. Julio Cesar Ochoa','difusion','asd','difusion@ittg.edu.mx',11),(2,'Lic. Estrella Anzueto','eanzueto','asd','eanzueto@ittg.edu.mx',11),(3,'Ing. Jorge Octavio Guzmán Sánchez','computo','asd','computo@ittg.edu.mx',1),(4,'Eli Alejandro','webmaster','asd','elialejandro@hotmail.com',1),(6,'Lic. Edna Morales Coutiño','desacad','asd','desacad@ittg.edu.mx',12),(7,'Lic. Isabel Palacios Trujillo','descolares','asd','descolares@ittg.edu.mx',10),(8,'Ing. Roberto Cifuentes','division','asd','division@ittg.edu.mx',20),(9,'C.P. Melquiceded Dominguez Holán ','finanzas','asd','finanzas@ittg.edu.mx',3),(10,'Ing. Francisco de Jesus Suarez','extraescolar','asd','extraescolar@ittg.edu.mx',9),(11,'M. en C. René Ríos Coutiño ','humanos','asd','humanos@ittg.edu.mx',2),(12,'C.P. Agustin Morales','materiales','asd','materiales@ittg.edu.mx',4),(13,'M. en C. Aída Guillermina Cossío Martínez ','sistemas','asd','sistemas@ittg.edu.mx',18),(14,'Dr. Hector Ricardo Hernández','posgrado','asd','posgrado@ittg.edu.mx',21),(15,'C.P. Liliana Patricia Moreno Cancino ','planea','asd','planea@ittg.edu.mx',6),(16,'Ing. Vicente León Orozco','eleyeca','asd','eleyeca@ittg.edu.mx',16),(17,'Ing. Carlos Ramón Alfonzo Santiago','mantto','asd','mantto@ittg.edu.mx',5),(18,'Ing. Javier Ramirez','qyb','asd','qyb@ittg.edu.mx',17),(19,'Ing. Ignacio Arrioja Cárdenas ','mecanica','asd','mecanica@ittg.edu.mx',15),(20,'Ing. Jorge Antonio Orozco Torres ','industrial','asd','industrial@ittg.edu.mx',19),(21,'M. en C. Roberto Carlos García Gómez ','basicas','asd','basicas@ittg.edu.mx',13),(22,'Lic. René Arjón Castro ','biblioteca','asd','biblioteca@ittg.edu.mx',8),(23,'Dr. Daniel Samayoa Penagos','gestion','asd','gestion@ittg.edu.mx',7),(24,'Ing. María Delina Culebro Farrera','economico','asd','informatica@ittg.edu.mx',14),(25,'Ing. Jorge Arturo Sarmiento Torres ','sgcittg','asd','sgcittg@ittg.edu.mx',26),(26,'Ing. Alexis Aguiar Brindis','distancia','asd','distancia@ittg.edu.mx',27),(28,'Ing. Tomas Palomino Solorzano','director','asd','director@ittg.edu.mx',25),(29,'PSIC. Adriana González Escobar','subacadem','asd','subacadem@ittg.edu.mx',24),(30,'Ing. Miguel Cid del Prado Martinez','subadmon','asd','subadmon@ittg.edu.mx',22),(31,'Ing. José Angel Zepeda Hernández','subplanea','asd','subplanea@ittg.edu.mx',23);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visitas`
--

DROP TABLE IF EXISTS `visitas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `visitas` (
  `ip` varchar(15) COLLATE latin1_spanish_ci DEFAULT NULL,
  `fecha` int(14) unsigned NOT NULL DEFAULT '0',
  KEY `ip` (`ip`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visitas`
--

LOCK TABLES `visitas` WRITE;
/*!40000 ALTER TABLE `visitas` DISABLE KEYS */;
INSERT INTO `visitas` VALUES ('95.216.0.58',1524692788),('148.208.246.253',1524692636);
/*!40000 ALTER TABLE `visitas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visitas_unicas`
--

DROP TABLE IF EXISTS `visitas_unicas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `visitas_unicas` (
  `id_visitas` int(12) NOT NULL,
  `visitas` int(30) NOT NULL,
  PRIMARY KEY (`id_visitas`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visitas_unicas`
--

LOCK TABLES `visitas_unicas` WRITE;
/*!40000 ALTER TABLE `visitas_unicas` DISABLE KEYS */;
INSERT INTO `visitas_unicas` VALUES (1,1441629);
/*!40000 ALTER TABLE `visitas_unicas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `bitacora`
--

/*!50001 DROP VIEW IF EXISTS `bitacora`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`content2_root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `bitacora` AS select `l`.`fecha` AS `FECHA`,`l`.`hora` AS `HORA`,`u`.`usuario` AS `USUARIO`,`o`.`descripcion` AS `OBJETO`,`a`.`descripcion` AS `ACCION`,`l`.`query` AS `QUERY`,`l`.`id` AS `ID` from (((`log` `l` join `usuarios` `u` on((`l`.`usuario` = `u`.`id`))) join `objeto` `o` on((`l`.`objeto` = `o`.`id`))) join `accion` `a` on((`l`.`accion` = `a`.`id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `per`
--

/*!50001 DROP VIEW IF EXISTS `per`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`content2_root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `per` AS select `u`.`usuario` AS `USUARIO`,`o`.`descripcion` AS `OBJETO`,`a`.`descripcion` AS `ACCION` from (((`permisos` `p` join `usuarios` `u` on((`p`.`usuario` = `u`.`id`))) join `objeto` `o` on((`p`.`objeto` = `o`.`id`))) join `accion` `a` on((`p`.`accion` = `a`.`id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `ponencias`
--

/*!50001 DROP VIEW IF EXISTS `ponencias`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`content2_root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `ponencias` AS select `u`.`id` AS `uid`,`ep`.`titulo` AS `donde`,`u`.`nombre` AS `nombre`,`p`.`modificado` AS `modificado`,`r`.`idc` AS `idc`,`e`.`titulo` AS `titulo` from ((((`entrada` `e` join `propuesta` `p` on((`e`.`id` = `p`.`idc`))) join `propuesta_usuario` `r` on((`r`.`idc` = `p`.`idc`))) join `usuarios` `u` on((`u`.`id` = `r`.`idu`))) join `entrada` `ep` on((`e`.`id_padre` = `ep`.`id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-04-25 15:20:37

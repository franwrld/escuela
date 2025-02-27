-- MySQL dump 10.13  Distrib 8.0.41, for Win64 (x86_64)
--
-- Host: localhost    Database: school
-- ------------------------------------------------------
-- Server version	8.4.4

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `alumnos`
--

DROP TABLE IF EXISTS `alumnos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `alumnos` (
  `id_alumno` int NOT NULL AUTO_INCREMENT,
  `nombre_completo` varchar(50) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `telefono` int DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `genero` enum('Masculino','Femenino') NOT NULL,
  `latitud` decimal(10,8) NOT NULL,
  `longitud` decimal(11,8) NOT NULL,
  `id_grado` int NOT NULL,
  `id_seccion` int NOT NULL,
  `id_school` int NOT NULL,
  PRIMARY KEY (`id_alumno`),
  KEY `id_grado` (`id_grado`),
  KEY `id_seccion` (`id_seccion`),
  KEY `id_school` (`id_school`)
) ENGINE=InnoDB AUTO_INCREMENT=136 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumnos`
--

LOCK TABLES `alumnos` WRITE;
/*!40000 ALTER TABLE `alumnos` DISABLE KEYS */;
INSERT INTO `alumnos` VALUES (42,'Marvin Mauricio Hernandez Perez','Ave Independencia, Santa Ana',12331155,'marvinmau@gmail.com','/escuela/public_html/fotos/estudiante2.jpg','Masculino',13.96721812,-89.56322079,25,2,13),(43,'Fernando Manuel Iteriano Linares','Calle Capitan Guzman, Santa Ana',12344555,'fernandoli19@gmail.com','/escuela/public_html/fotos/estudents1.jpg','Masculino',13.97955894,-89.55356481,25,1,13),(44,'Diego Ernesto Ramirez Rivera','Psj Santa Cruz, Santa Ana',12445677,'diegora16@outlook.com','/escuela/public_html/fotos/estudiante6.jpg','Masculino',13.98820021,-89.54596932,25,3,16),(45,'Ana Sofia Arevalo Lemus','Calle Loma Alta, Santa Ana',78787879,'anasofia299@outlook.com','/escuela/public_html/fotos/estudiante3.jpg','Femenino',13.97972965,-89.55144774,23,3,16),(46,'Maria Esperanza Trujillo Montoya','Pasaje Dinamarca, Santa Ana',14445556,'maria2025@hotmail.es','/escuela/public_html/fotos/estudiante4.jpg','Femenino',13.97449519,-89.57095810,21,1,15),(48,'Lucia Magaly Linares Linares','Calle Samaria, CA 12S, Santa Ana',98766222,'lucilix2@gmail.com','/escuela/public_html/fotos/estudiante7.jpg','Femenino',13.98278723,-89.57733007,20,1,14),(49,'Juan Luis Guerrero Ramirez','Ave Los Almendros, Santa Ana',12444553,'juan24@gmail.com','/escuela/public_html/fotos/estudiante8.jpg','Masculino',13.98104344,-89.57794944,22,1,14),(50,'Jose Luis Herrera Sierra','5ave Sur',14441122,'josece@outlook.com','/escuela/public_html/fotos/estudiante9.png','Masculino',14.11516576,-89.64956384,20,5,17),(84,'Carlos Alberto Flores','Col. El Matazano, San Salvador',78324012,'caflores@mail.com','','Masculino',13.98562345,-89.67234112,14,8,18),(85,'María Fernanda López','Resid. La Gloria, Santa Tecla',76011458,'mflopez@gmail.com','','Femenino',13.99256478,-89.68123567,15,23,18),(86,'Kevin Adalberto Martínez','Calle Las Rosas, Santa Ana',62547890,'kmartinez@outlook.com','','Masculino',13.98315642,-89.66782431,26,19,18),(87,'Sofía Mercedes Reyes','Resid. Jardines del Volcán, Soyapango',75231409,'sreyes@yahoo.com','','Femenino',13.99347218,-89.67812562,16,2,18),(88,'Eduardo José González','B° Santa Lucía, San Miguel',71230985,'egonzalez@mail.com','','Masculino',13.98012456,-89.67432154,18,1,18),(89,'Ana Cristina Pérez','Calle Principal #5, Usulután',78901234,'acperez@gmail.com','','Femenino',13.98753127,-89.66675419,25,10,18),(90,'Luis Fernando Ramos','Col. Santa Isabel, Mejicanos',76541239,'lframos@outlook.com','','Masculino',13.99686451,-89.67035481,14,17,18),(91,'Karla Beatriz Castro','Av. Independencia, Ahuachapán',60234517,'kbcastro@yahoo.com','','Femenino',13.98211433,-89.66154329,24,9,18),(92,'José Mauricio Hernández','Pasaje Los Pinos, Apopa',75109834,'jmhernandez@mail.com','','Masculino',13.99062311,-89.67765478,17,3,18),(93,'Adriana Paola Rivera','Resid. El Trébol, Santa Tecla',72503461,'aprivera@gmail.com','','Femenino',13.98546792,-89.66932156,19,5,18),(94,'Ricardo David Chávez','Av. Morazán, Sensuntepeque',60019485,'rdchavez@outlook.com','','Masculino',13.98125432,-89.67684125,22,26,18),(95,'Alejandra Elizabeth Romero','B° El Calvario, Chalatenango',72015439,'aeromero@yahoo.com','','Femenino',13.99004215,-89.67569143,23,12,18),(96,'Fernando José Ramírez','Calle Libertad, Zacatecoluca',71458603,'fjramirez@mail.com','','Masculino',13.98435978,-89.66385247,20,11,18),(97,'Carolina de Jesús Vásquez','Col. Las Mercedes, Sonsonate',75510284,'cjvasquez@gmail.com','','Femenino',13.99367124,-89.66812435,21,7,18),(98,'Joaquín Alberto Sánchez','Calle Principal, La Unión',76789012,'jasanchez@outlook.com','','Masculino',13.99725189,-89.67453126,26,4,18),(114,'Jonathan Alberto Rojas','Residencial Morazán, San Miguel',62543901,'jrojas@example.com','','Masculino',13.70012345,-89.19234567,14,5,20),(115,'Beatriz Cecilia Escobar','B° Santa Lucía, Santa Ana',73456029,'bescobar@outlook.com','','Femenino',13.69456789,-89.18765432,15,1,20),(116,'Héctor Daniel Campos','Col. La Providencia, Chalchuapa',71238945,'hcampos@gmail.com','','Masculino',13.69987456,-89.19543210,16,10,20),(117,'Andrea del Carmen Ruiz','Av. Independencia, San Salvador',78901234,'arcruiz@mail.com','','Femenino',13.69534218,-89.18023456,25,26,20),(118,'Pedro Ezequiel Hernández','Calle El Progreso, Zacatecoluca',73451209,'pehernandez@yahoo.com','','Masculino',13.70324561,-89.19678524,26,12,20),(119,'Rosita Maricela Umanzor','Residencial Las Flores, Santa Tecla',72340158,'ruman@gmail.com','','Femenino',13.69756123,-89.19023476,17,3,20),(120,'Gustavo Adolfo Jiménez','Col. Santa Eugenia, Apopa',75460123,'gajimenez@outlook.com','','Masculino',13.70123456,-89.18345678,22,23,20),(121,'Marta Beatriz Velásquez','Pasaje El Prado, Mejicanos',78954321,'mbvelasquez@mail.com','','Femenino',13.70234567,-89.19897654,14,6,20),(122,'Juan Carlos Morales','Residencial El Carmen, Usulután',70123456,'jcmorales@example.com','','Masculino',13.69312457,-89.18834512,24,7,20),(123,'Patricia Alejandra Ortiz','Av. Las Delicias, Sonsonate',70321456,'paortiz@gmail.com','','Femenino',13.70567892,-89.19431257,18,25,20),(124,'Ricardo Ernesto Santos','Barrio El Ángel, Ahuachapán',72560143,'rsantos@mail.com','','Masculino',13.69456821,-89.19781365,19,4,20),(125,'Claudia Isabel Meléndez','Col. Jardines del Sur, San Miguel',76011243,'cimelendez@example.com','','Femenino',13.69982437,-89.18923148,20,14,20),(126,'Jorge Alberto Quintanilla','Urbanización El Palmar, Santa Ana',75432189,'jaquintanilla@outlook.com','','Masculino',13.69671243,-89.18697852,21,8,20),(127,'Fabiola Esther Rivas','Pasaje La Paz, Soyapango',73651240,'frivas@yahoo.com','','Femenino',13.69834571,-89.18456109,26,19,20),(128,'Diego Armando Fuentes','Calle Principal #7, La Unión',70456123,'dafuentes@gmail.com','/escuela/public_html/fotos/estudiante10.jpg','Masculino',13.70259134,-89.19984123,23,2,20),(129,'Paola Margarita Corleto Ramirez','Calle El Negro, Santiago de la Frontera',88772222,'paocor77@bookland.com','/escuela/public_html/fotos/estudiante11.jpg','Femenino',14.18112413,-89.60700216,14,1,21),(130,'Fabricio Edgardo Lima Juarez','Colonia El Castillo, Santiago de la Frontera',12882212,'tomashe08@outlook.com','/escuela/public_html/fotos/estudiante12.png','Masculino',14.18480823,-89.60523724,20,1,21),(131,'Edgardo Daniel Mendoza Trujillo','Colonia Arevalo, Santiago de la Frontera',14444552,'edgardo daniel mendoza trujillo','/escuela/public_html/fotos/estudiante13.jpg','Masculino',14.18119367,-89.61055445,20,1,21),(132,'Maricela Kimberly Medrano Linares','Colonia Arevalo, Santiago de la Frontera',54555534,'kimmari9@gmail.com','/escuela/public_html/fotos/estudiante14.jpg','Femenino',14.17955312,-89.61115977,24,2,21),(133,'Antony Liam Chinchilla Ordoñez','Barrio El Centro, Santiago de la Frontera',21444441,'sin correo','/escuela/public_html/fotos/estudiante15.jpg','Masculino',14.18226051,-89.60778021,21,3,21);
/*!40000 ALTER TABLE `alumnos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grados`
--

DROP TABLE IF EXISTS `grados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `grados` (
  `id_grado` int NOT NULL AUTO_INCREMENT,
  `grado` varchar(40) NOT NULL,
  PRIMARY KEY (`id_grado`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grados`
--

LOCK TABLES `grados` WRITE;
/*!40000 ALTER TABLE `grados` DISABLE KEYS */;
INSERT INTO `grados` VALUES (14,'Kinder'),(15,'Primer Grado'),(16,'Segundo Grado'),(17,'Tercer Grado'),(18,'Cuarto Grado'),(19,'Quinto Grado'),(20,'Sexto Grado'),(21,'Séptimo Grado'),(22,'Octavo Grado'),(23,'Noveno Grado'),(24,'Primero de Bachillerato'),(25,'Segundo de Bachillerato'),(26,'Tercero de Bachillerato');
/*!40000 ALTER TABLE `grados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `padres`
--

DROP TABLE IF EXISTS `padres`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `padres` (
  `id_padre` int NOT NULL AUTO_INCREMENT,
  `nombre_padre` varchar(255) DEFAULT NULL,
  `direccion_padre` varchar(255) DEFAULT NULL,
  `telefono_padre` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_padre`)
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `padres`
--

LOCK TABLES `padres` WRITE;
/*!40000 ALTER TABLE `padres` DISABLE KEYS */;
INSERT INTO `padres` VALUES (30,'Celeste Cristales Henriquez Linares','Calle Capitan Guzman, Santa Ana','11223344'),(31,'Osmin Orlando Hernández Méndez','Calle Capitan Guzman, Santa Ana','13484888'),(32,'Mercedez Maria Guzman Linares','Colonia Villa Hermosa, Santa Ana','22445566'),(33,'Marta Liliana Gonzales Rivera','Pasaje Santa Cruz, Santa Ana','12444456'),(34,'Esperanza de Luz Martinez Carcamo','Pasaje Dinamarca, Santa Ana','12345566'),(35,'Blanca Cecilia Trujillo Martinez','Ave Independencia, Santa Ana','11457788'),(36,'Efrain Manuel Arevalo Polanco','Casa #240 Calle California, Santa Ana','5556777'),(38,'Elvia Noemy Linares Gonzales','Calle Los Almendros, Santa Ana','14145676'),(39,'Yamileth Jenifer Linares Gutiérrez','Calle 31, Santa Ana','141345'),(58,'Luis Figueroa','Calle Principal #4, Chalchuapa','70012345'),(59,'Gloria Contreras','Col. Jardines, Chalchuapa','70023456'),(60,'Manuel Escalante','Resid. Los Pinos, Chalchuapa','70034567'),(61,'Patricia Pérez','Av. El Calvario, Chalchuapa','70045678'),(62,'Oscar Hernández','Barrio Santa Lucía, Chalchuapa','70056789'),(63,'Rosa Martínez','Col. Los Naranjos, Chalchuapa','70067890'),(64,'David Quintanilla','Calle Libertad, Chalchuapa','70078901'),(65,'Carmen Pineda','Bo. Las Flores, Chalchuapa','70089012'),(66,'Andrés Alvarado','Resid. El Trébol, Chalchuapa','70090123'),(67,'Laura de González','Pasaje San Juan, Chalchuapa','70101234'),(68,'Francisco Gómez','Calle San Rafael, Chalchuapa','70112345'),(69,'Marta Herrera','Bo. El Calvario, Chalchuapa','70123456'),(70,'Antonio Castro','Col. San Antonio, Chalchuapa','70134567'),(71,'Sonia Ramírez','Av. Central, Chalchuapa','70145678'),(72,'Roberto Campos','Resid. Las Arboledas, Chalchuapa','70156789'),(73,'Carlos Tejada','Resid. Flores #2, San Salvador','70167890'),(74,'María Ayala','Col. Santa Eugenia, SS','70178901'),(75,'Héctor García','Col. La Rábida, SS','70189012'),(76,'Andrea Ramos','Av. Independencia, SS','70190123'),(77,'Pedro Aguilar','B° Santa Lucía, SS','70201234'),(78,'Rosita Acevedo','Calle El Progreso, SS','70212345'),(79,'Gustavo Guzmán','Urb. Loma Linda, SS','70223456'),(80,'Marta Sorto','Resid. San Francisco, SS','70234567'),(81,'Juan Morales','Col. San José, SS','70245678'),(82,'Patricia Vides','B° El Centro, SS','70256789'),(83,'Ricardo Díaz','Av. Bolívar, SS','70267890'),(84,'Claudia Campos','Col. Escalón, SS','70278901'),(85,'Jorge Morales','Resid. Jardines, SS','70289012'),(86,'Fabiola Rivas','Calle Arce, SS','70290123'),(87,'Diego Fuentes','Pje. Libertad, SS','70301234'),(88,'Milena Escobar Hernandez','Calle Principal, Santiago de la Frontera','1414455'),(90,'Adela Ortiz Mendez','Barrio El Castillo, Santiago de la Frontera','1421444'),(91,'Antonio Mendoza','Colonia Arevalo, Santiago de la Frontera','1414124'),(92,'Nestor Ordoñez','Calle Principal, Santiago de la Frontera','12992222'),(94,'Emma Ortiz','Calle Principal, BO el Centro, Santiago de la Frontera','19184984');
/*!40000 ALTER TABLE `padres` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `padres_alumnos`
--

DROP TABLE IF EXISTS `padres_alumnos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `padres_alumnos` (
  `id_padre_alumno` int NOT NULL AUTO_INCREMENT,
  `id_alumno` int NOT NULL,
  `id_padre` int NOT NULL,
  `parentesco` varchar(20) NOT NULL,
  PRIMARY KEY (`id_padre_alumno`),
  KEY `id_alumno` (`id_alumno`),
  KEY `id_padre` (`id_padre`),
  CONSTRAINT `padres_alumnos_ibfk_1` FOREIGN KEY (`id_alumno`) REFERENCES `alumnos` (`id_alumno`) ON DELETE CASCADE,
  CONSTRAINT `padres_alumnos_ibfk_2` FOREIGN KEY (`id_padre`) REFERENCES `padres` (`id_padre`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `padres_alumnos`
--

LOCK TABLES `padres_alumnos` WRITE;
/*!40000 ALTER TABLE `padres_alumnos` DISABLE KEYS */;
INSERT INTO `padres_alumnos` VALUES (29,42,30,'Madre'),(30,42,31,'Padre'),(31,43,32,'Abuelo/a'),(32,44,33,'Madre'),(33,46,34,'Sobrino/a'),(34,45,35,'Sobrino/a'),(35,45,36,'Padre'),(37,49,38,'Sobrino/a'),(38,48,39,'Tio/a'),(57,84,58,'Padre'),(58,85,59,'Madre'),(59,86,60,'Abuelo/a'),(60,87,61,'Tio/a'),(61,88,62,'Hermano/a'),(62,89,63,'Primo/a'),(63,90,64,'Sobrino/a'),(64,91,65,'Madre'),(65,92,66,'Padre'),(66,93,67,'Sin Parentesco'),(67,94,68,'Padre'),(68,95,69,'Madre'),(69,96,70,'Tio/a'),(70,97,71,'Primo/a'),(71,98,72,'Sobrino/a'),(72,114,73,'Padre'),(73,115,74,'Madre'),(74,116,75,'Hermano/a'),(75,117,76,'Tio/a'),(76,118,77,'Abuelo/a'),(77,119,78,'Primo/a'),(78,120,79,'Sobrino/a'),(79,121,80,'Madre'),(80,122,81,'Padre'),(81,123,82,'Sin Parentesco'),(82,124,83,'Tio/a'),(83,125,84,'Hermano/a'),(84,126,85,'Primo/a'),(85,127,86,'Abuelo/a'),(86,128,87,'Madre'),(87,129,88,'Sobrino/a'),(89,130,90,'Madre'),(90,131,91,'Padre'),(91,133,92,'Padre'),(93,132,94,'Padre');
/*!40000 ALTER TABLE `padres_alumnos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `school`
--

DROP TABLE IF EXISTS `school`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `school` (
  `id_school` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `latitud` decimal(10,8) DEFAULT NULL,
  `longitud` decimal(11,8) DEFAULT NULL,
  `id_user` int DEFAULT NULL,
  PRIMARY KEY (`id_school`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `school`
--

LOCK TABLES `school` WRITE;
/*!40000 ALTER TABLE `school` DISABLE KEYS */;
INSERT INTO `school` VALUES (13,'Instituto Nacional de Santa Ana','Ave Santa Ana California Santa Ana','insasv@mined.sv','/escuela/public_html/fotos/INSAfoto.jpg',13.97964353,-89.56420809,11),(14,'Complejo Educativo \"Prof. Martín Romeo Monterrosa Rodríguez\"','Calle Aldea San Antonio, Santa Ana','cemartinmonterrosasv@gmail.com','/escuela/public_html/fotos/DahQSihXUAA4Fyj.jpg',13.98242066,-89.57616806,11),(16,'Colegio Salesiano San José','Calle Santa Ana, bypass Metapán, Santa Ana','colesalesiano@edu.com.sv','/escuela/public_html/fotos/colegiosalefoto.jpg',13.98006778,-89.55052614,9),(17,'Centro Escolar Católico \"Nuestra Señora de Candelaria\"','Ave, Penate, Candelaria de La Frontera','cecandelariansc@mined.edu.sv','/escuela/public_html/fotos/cecandelariase.jpg',14.11343224,-89.65017423,9),(18,'Centro Escolar \"Doctor Ranulfo Castro\"','11a Av Sur, Chalchuapa, El Salvador','cedoctorranulfo@mined.edu.sv','/escuela/public_html/fotos/fotocedoc.jpg',13.98560639,-89.67304409,12),(20,'Centro Escolar Republica de El Salvador','Calle Mosserrat, San Salvador','cerepelsalvador@gmail.com','/escuela/public_html/fotos/cesarep.jpg',13.68554619,-89.21477795,10),(21,'Complejo Educativo Santiago de la Frontera','Calle al tablon, Barrio El Centro, Santiago de la Frontera','cesantiagodelafrontera@mined.edu.sv','/escuela/public_html/fotos/santiagoescuela.jpg',14.18147196,-89.60395306,18);
/*!40000 ALTER TABLE `school` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `secciones`
--

DROP TABLE IF EXISTS `secciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `secciones` (
  `id_seccion` int NOT NULL AUTO_INCREMENT,
  `seccion` varchar(1) NOT NULL,
  PRIMARY KEY (`id_seccion`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `secciones`
--

LOCK TABLES `secciones` WRITE;
/*!40000 ALTER TABLE `secciones` DISABLE KEYS */;
INSERT INTO `secciones` VALUES (1,'A'),(2,'B'),(3,'C'),(4,'D'),(5,'E'),(6,'F'),(7,'G'),(8,'H'),(9,'I'),(10,'J'),(11,'K'),(12,'L'),(13,'M'),(14,'N'),(15,'O'),(16,'P'),(17,'Q'),(18,'R'),(19,'S'),(20,'T'),(21,'U'),(22,'V'),(23,'W'),(24,'X'),(25,'Y'),(26,'Z');
/*!40000 ALTER TABLE `secciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `usuario` varchar(15) NOT NULL,
  `password` varchar(50) NOT NULL,
  `tipo` enum('Administrador','Usuario') NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (9,'Carlos Francisco Ruiz','franciscoadmin','d033e22ae348aeb5660fc2140aec35850c4da997','Administrador'),(10,'Vanessa Yamileth Serrano Hernandez','vanessa17','12dea96fec20593566ab75692c9949596833adc9','Usuario'),(11,'Wilfredo Chacon','wilfredoadmin','d033e22ae348aeb5660fc2140aec35850c4da997','Administrador'),(12,'Hector Alexander Colindres Montoya','alex2025','12dea96fec20593566ab75692c9949596833adc9','Usuario'),(18,'Albert Jose Linares Henriquez','albertuser','12dea96fec20593566ab75692c9949596833adc9','Usuario');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-02-27  5:13:03

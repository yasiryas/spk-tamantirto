-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: spk_tamantirto
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.16-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `hasil_perhitungan`
--

DROP TABLE IF EXISTS `hasil_perhitungan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hasil_perhitungan` (
  `id_perhitungan` int(11) NOT NULL AUTO_INCREMENT,
  `id_kategori` int(11) NOT NULL,
  `id_indikator` int(11) NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `hasil_keputusan` varchar(128) NOT NULL,
  `date_create` date NOT NULL,
  PRIMARY KEY (`id_perhitungan`),
  KEY `id_kategori` (`id_kategori`),
  KEY `id_indikator` (`id_indikator`),
  CONSTRAINT `hasil_perhitungan_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `hasil_perhitungan_ibfk_2` FOREIGN KEY (`id_indikator`) REFERENCES `indikator` (`id_indikator`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hasil_perhitungan`
--

LOCK TABLES `hasil_perhitungan` WRITE;
/*!40000 ALTER TABLE `hasil_perhitungan` DISABLE KEYS */;
/*!40000 ALTER TABLE `hasil_perhitungan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `indikator`
--

DROP TABLE IF EXISTS `indikator`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `indikator` (
  `id_indikator` int(11) NOT NULL AUTO_INCREMENT,
  `nama_indikator` varchar(128) NOT NULL,
  `key_indikator` varchar(100) DEFAULT NULL,
  `sedang` varchar(100) DEFAULT NULL,
  `rendah` varchar(100) DEFAULT NULL,
  `tinggi` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_indikator`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `indikator`
--

LOCK TABLES `indikator` WRITE;
/*!40000 ALTER TABLE `indikator` DISABLE KEYS */;
INSERT INTO `indikator` VALUES (7,'Sumber Daya Manusia','SDM','30-60','0-30','60-100'),(8,'Potensi Kelembagaan','KL','30-60','0-30','60-100'),(9,'Sarana dan Prasarana','PSR','30-60','0-30','60-100');
/*!40000 ALTER TABLE `indikator` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kategori`
--

DROP TABLE IF EXISTS `kategori`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(128) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kategori`
--

LOCK TABLES `kategori` WRITE;
/*!40000 ALTER TABLE `kategori` DISABLE KEYS */;
INSERT INTO `kategori` VALUES (8,'Persawahan'),(9,'Perladangan'),(10,'Peternakan'),(11,'Perkebunan'),(12,'Pertambangan'),(13,'Kerajinan'),(14,'Industri Sedang/ Besar'),(15,'Perikanan'),(16,'Jasa/ Perdagangan');
/*!40000 ALTER TABLE `kategori` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nilaicrips`
--

DROP TABLE IF EXISTS `nilaicrips`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `nilaicrips` (
  `id_nilaicrip` int(11) NOT NULL AUTO_INCREMENT,
  `rendah` int(11) DEFAULT NULL,
  `sedang` int(11) DEFAULT NULL,
  `tinggi` int(11) DEFAULT NULL,
  `sangat_tinggi` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_nilaicrip`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nilaicrips`
--

LOCK TABLES `nilaicrips` WRITE;
/*!40000 ALTER TABLE `nilaicrips` DISABLE KEYS */;
INSERT INTO `nilaicrips` VALUES (1,25,50,75,100);
/*!40000 ALTER TABLE `nilaicrips` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `padukuhan`
--

DROP TABLE IF EXISTS `padukuhan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `padukuhan` (
  `id_padukuhan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_padukuhan` varchar(128) NOT NULL,
  `indikator_ids` varchar(100) DEFAULT NULL,
  `indikator_values` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_padukuhan`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `padukuhan`
--

LOCK TABLES `padukuhan` WRITE;
/*!40000 ALTER TABLE `padukuhan` DISABLE KEYS */;
INSERT INTO `padukuhan` VALUES (7,'Geblagan','7,8,9','20,70,70'),(8,'Gatak','7,8,9','30,25,35'),(9,'Ngebel','7,8,9','20,35,40'),(10,'Ngrame','7,8,9','20,50,25'),(11,'Jetis','7,8,9','30,40,10'),(12,'Jadan','7,8,9','20,30,25'),(13,'Brajan','7,8,9','40,20,30'),(14,'Gonjen','7,8,9','30,35,40'),(15,'Kasihan','7,8,9','30,50,35'),(16,'Kembaran','7,8,9','25,35,20');
/*!40000 ALTER TABLE `padukuhan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pertanyaan`
--

DROP TABLE IF EXISTS `pertanyaan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pertanyaan` (
  `id_pertanyaan` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal_survey` date NOT NULL,
  `id_surveyor` int(11) NOT NULL,
  `pertanyaan` varchar(512) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_indikator` int(11) NOT NULL,
  `id_padukuhan` int(11) NOT NULL,
  `skor` int(11) NOT NULL,
  PRIMARY KEY (`id_pertanyaan`),
  KEY `pertanyaan_ibfk_1` (`id_kategori`),
  KEY `pertanyaan_ibfk_2` (`id_padukuhan`),
  KEY `id_surveyor` (`id_surveyor`),
  KEY `id_indikator` (`id_indikator`),
  CONSTRAINT `pertanyaan_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pertanyaan_ibfk_2` FOREIGN KEY (`id_padukuhan`) REFERENCES `padukuhan` (`id_padukuhan`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pertanyaan_ibfk_3` FOREIGN KEY (`id_surveyor`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pertanyaan_ibfk_4` FOREIGN KEY (`id_indikator`) REFERENCES `indikator` (`id_indikator`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pertanyaan`
--

LOCK TABLES `pertanyaan` WRITE;
/*!40000 ALTER TABLE `pertanyaan` DISABLE KEYS */;
INSERT INTO `pertanyaan` VALUES (0,'2024-05-22',2,'Berapa persen dari pendduduk usia muda yang berminat jadi petani muda?',9,8,7,20),(18,'2024-05-24',3,'Apakah rutin diadakan penyuluhan tentang tanaman ladan di desa ini?',9,9,9,50),(19,'2024-05-22',2,'Berapa persen dari pendduduk usia muda yang berminat jadi petani muda?',9,8,7,20);
/*!40000 ALTER TABLE `pertanyaan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `survey`
--

DROP TABLE IF EXISTS `survey`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `survey` (
  `id_survey` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_pertanyaan` int(11) NOT NULL,
  `tanggal_survey` date NOT NULL,
  PRIMARY KEY (`id_survey`),
  KEY `id_pertanyaan` (`id_pertanyaan`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `survey_ibfk_1` FOREIGN KEY (`id_pertanyaan`) REFERENCES `pertanyaan` (`id_pertanyaan`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `survey_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `survey`
--

LOCK TABLES `survey` WRITE;
/*!40000 ALTER TABLE `survey` DISABLE KEYS */;
/*!40000 ALTER TABLE `survey` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role` enum('super_user','admin','user') NOT NULL,
  `is_active` int(11) NOT NULL,
  `date_create` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Admin','admin@mail.com','default.jpg','$2y$10$vkRpX1y/U2YcCyGAgjGgM.MhEFKiKuFB6YywCW5Xdm/6cNNLHat9u','admin',1,1710131674),(2,'User','user@mail.com','default.jpg','$2y$10$UfJOorvl1Qaq4n2L/drCZ.9vn.nVY4Z4SS4JGPVBZeJmw03wxvlKS','user',1,1710132125),(3,'Super User','su@mail.com','default.jpg','$2y$10$TsnmU5oVrG8WpiKc2NcnUOU/tvI1Gjb0AROomlo9mx5YH0zW.VFKm','super_user',1,1710132254),(4,'yas','123@mail.c','default.jpg','$2y$10$W7Yo56NxHP2JrzkiigzQj.RkGnca58u9julBLDXvG0BV6suWTh4dm','user',0,1712651773),(5,'Oke','123@mail.c','default.jpg','$2y$10$qca7RVWadvmH6UUPAG4MG.NbMk7K72uYI7/WBk6zK/SaemrfEmq1q','user',0,1712651931),(9,'andy','andy@mail.com','default.jpg','$2y$10$5NviRXf97idhcXV90gj4ZeQhOrEZyT0rH1AwFNP3fZ/PWS.WLyVN2','user',1,1713434480),(11,'Bagas Saputra','paribadi@mail.com','default.jpg','$2y$10$SFKBrH6eLuMpzNaKrkNAKOwkrwBsr9AghK.FX03NsK5yJOw/aPMiq','admin',1,1713435283);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'spk_tamantirto'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-11-25  7:10:35

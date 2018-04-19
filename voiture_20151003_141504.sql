-- MySQL dump 10.13  Distrib 5.6.17, for Win64 (x86_64)
--
-- Host: localhost    Database: voiture
-- ------------------------------------------------------
-- Server version	5.6.17

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
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant unique attribué à la création de l’enregistrement',
  `login` varchar(150) NOT NULL COMMENT 'le login de l''utilisateur',
  `mdp` varchar(255) NOT NULL COMMENT 'le mot de passe de l''utilisateur',
  `level` int(11) NOT NULL COMMENT 'le niveau de l''utilisateur plus le niveau est élevé plus il a des droits',
  `mail` varchar(255) NOT NULL COMMENT 'l''adresse mail de l''utilisateur',
  `tel` varchar(255) NOT NULL COMMENT 'téléphone de l''utilisateur',
  `nom` varchar(255) NOT NULL COMMENT 'nom de l''utilisateur',
  `prenom` varchar(255) NOT NULL COMMENT 'prénom de l''utilisateur',
  `photo` varchar(255) NOT NULL COMMENT 'photo de l''utilisateur',
  `heurco` varchar(255) NOT NULL COMMENT 'heure de connexion',
  `heurde` varchar(255) NOT NULL COMMENT 'heure de déconnexion',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=66 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` (`id`, `login`, `mdp`, `level`, `mail`, `tel`, `nom`, `prenom`, `photo`, `heurco`, `heurde`) VALUES (48,'romaric','$2y$10$AY7JS8gjhAEk4RPgvTM.UOk0to35hrNN4XwEalDYV3veUeQymcRbS',2,'bangaromaric@gmail.com','04399599','BANGA','ROMARIC','avatar.jpg','02-10-2015 a 15:38:21','25-09-2015 a 09:44:56'),(52,'stacey','$2y$10$OSvjj0T8GarTSHSbuND.5uxbkm7N9EkVJLvKExWrcI9CHDN0FybPy',1,'bitolistacey@gmail.com','06160715','BITOLI LAFFORTE','STACEY','avatar.jpg','',''),(47,'teko','$2y$10$aTVjIFA.cE0PP69oVPk6peneDvzGFGw1AIuhtW4.WqMc9YDioebFq',1,'koupenteko@yahoo.fr','07885110','KOUKPEN','TÊKO','avatar.jpg','14-09-2015 a 18:05:34','10-09-2015 a 17:56:21'),(60,'mark','$2y$09$eshH6/DmFJEU90UpnlgweOtWJva4E0BOmUF4xrD2T0gHynE64WXTy',1,'leromantiqueroma@gmail.com','04399599','BANGA','ROMARIC','avatar.jpg','',''),(51,'nene','$2y$10$v5FOPXaXmfsZJGJ9o3PrDuYGT4KOQ4l1.uWAo7VSBxo5CByl4L2R2',1,'rostinlewis@gmail.com','06195382','NENE-YIBENGUIA','ROSTIN LEWIS','avatar.jpg','10-09-2015 a 16:55:59','10-09-2015 a 16:56:08'),(59,'david','$2y$09$wHgxySVeolu4xokBUYhUvum0oRiYBCXLmebSGc0iBiUjWcYFx6CGC',1,'ban@hjds.com','04296282','DAVID','ZDOF','avatar.jpg','',''),(61,'roma','$2y$10$uER599RsSvy5aOAKqps9wuinn6oot.0NcFSFZj3/x1wvO1Q31V9Mm',1,'bekalepaulus@gmail.com','06633260','BANGA','ROMARIC','avatar.jpg','',''),(62,'Jeff','$2y$09$nGPJYhizaSZSfhiLsbmoe.xKLJ9oGGnPzfsItxz3os7wiLlVTnt9i',1,'jmanfred7@gmail.com','07750737','JEFF','BOUNDS','avatar.jpg','',''),(63,'Jeff','$2y$10$2y6GA1wkFH7KZFRXczQdUOOJJyr1p1iFgkXLA8A9ukule.A.O1/o6',1,'jmanfred7@gmail.com','07750737','JEFF','BOUNDS','avatar.jpg','',''),(64,'Jeff','$2y$09$yCqGqX83..HlmbgP8jPq5eCKqYmVeFQxTiC0QNoDbAx2iu4vmETzW',1,'jmanfred7@gmail.com','07750737','JEFF','BOUNDS','avatar.jpg','',''),(65,'Jeff','$2y$09$qldNsGto1xIYLlJ4Gfhcru3O2QqMDQz0opM7qQoKHp/4QXyYUsvO6',1,'jmanfred7@gmail.com','07750737','JEFF','BOUNDS','avatar.jpg','','');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assurance`
--

DROP TABLE IF EXISTS `assurance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assurance` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `assurDateDebut` date NOT NULL,
  `assurDateFin` date NOT NULL,
  `id_voi` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assurance`
--

LOCK TABLES `assurance` WRITE;
/*!40000 ALTER TABLE `assurance` DISABLE KEYS */;
INSERT INTO `assurance` (`id`, `assurDateDebut`, `assurDateFin`, `id_voi`, `nom`) VALUES (6,'2015-09-08','2016-01-02',32,'SAHAM Assurance '),(7,'2015-09-08','2016-01-01',33,'SAHAM'),(8,'2015-09-08','2016-02-10',34,'SAHAM Assurance '),(10,'2015-09-22','2016-10-19',37,'SAHAM Assurance '),(11,'2015-09-22','2016-09-22',38,'SAHAM Assurance '),(13,'2015-09-22','2016-09-26',40,'SAHAM Assurance '),(14,'2015-09-22','2016-09-26',41,'SAHAM Assurance '),(15,'2015-09-22','2016-09-26',42,'SAHAM Assurance '),(16,'2015-09-25','2016-09-25',43,'SAHAM Assurance '),(17,'2015-09-25','2016-09-26',44,'SAHAM Assurance '),(18,'2015-09-25','2016-09-25',45,'SAHAM Assurance '),(19,'2015-09-25','2016-09-25',46,'SAHAM Assurance ');
/*!40000 ALTER TABLE `assurance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorie` (
  `id_cate` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  PRIMARY KEY (`id_cate`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorie`
--

LOCK TABLES `categorie` WRITE;
/*!40000 ALTER TABLE `categorie` DISABLE KEYS */;
INSERT INTO `categorie` (`id_cate`, `nom`) VALUES (1,'4*4 De Luxe'),(2,'4*4 Standard'),(3,'Citadine'),(5,'Berline de Luxe'),(6,'Berline Standard'),(8,'Mini-Bus'),(9,'Bus'),(10,'Camion'),(11,'Pick Up'),(12,'Monospace'),(13,'Cabriolet');
/*!40000 ALTER TABLE `categorie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chauffeur`
--

DROP TABLE IF EXISTS `chauffeur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chauffeur` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant unique attribué à la création de l’enregistrement ',
  `nom` varchar(255) NOT NULL COMMENT 'nom du chauffeur',
  `prenom` varchar(255) NOT NULL COMMENT 'prénom du chauffeur',
  `permis` varchar(255) NOT NULL COMMENT 'permis du chauffeur',
  `tel` varchar(255) NOT NULL COMMENT 'téléphone du chauffeur',
  `obs` varchar(255) NOT NULL COMMENT 'observateur concernant le chauffeur',
  `status` varchar(255) NOT NULL COMMENT 'status du chauffeur (occupé, libre)',
  `photo` varchar(255) NOT NULL COMMENT 'photo du chauffeur',
  `id_fact` int(11) NOT NULL,
  `numPermis` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `n°permis` (`permis`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chauffeur`
--

LOCK TABLES `chauffeur` WRITE;
/*!40000 ALTER TABLE `chauffeur` DISABLE KEYS */;
INSERT INTO `chauffeur` (`id`, `nom`, `prenom`, `permis`, `tel`, `obs`, `status`, `photo`, `id_fact`, `numPermis`) VALUES (38,'KONDOU','Claude','A','07680982','','occupe','avatar.jpg',138,'10330Q20045'),(34,'GAÏTOU','Gilles Dodzi','A','07157292','','libre','avatar.jpg',0,'31049S72644'),(35,'MBAÏRI','Uriel','A','07514578','','occupe','avatar.jpg',139,'20089B01014'),(36,'MADOUNGOU','Darryl','A','05734057','','libre','avatar.jpg',0,'21884A21013'),(37,'MBAPPE','David','A','04296282','','libre','avatar.jpg',0,'13749F81604'),(33,'BIYOGO','Clay','B','07303517','','libre','avatar.jpg',0,'21049D01014'),(32,'TOKINLO','Jeese','B','06573118','','libre','avatar.jpg',0,'30030Q20045'),(39,'MADJAMBA','Tiphaine','B','04420725','','libre','avatar.jpg',0,'21069K02016'),(40,'MALANDA','Aminata','A','06414073','','libre','avatar.jpg',0,'50089B01014'),(41,'MVE','James','D','05164044','','occupe','avatar.jpg',136,'42082B01014'),(42,'NGUELE','Ralph','B','06193513','','libre','avatar.jpg',0,'44069R31514'),(43,'NGONE','Cecile','B,D','02619421','','libre','avatar.jpg',0,'20070Q08146'),(44,'MIHINDOU','Natal','B,C','04104394','','occupe','avatar.jpg',137,'32049M01014'),(45,'EYI','Ariel','A','07881901','','libre','avatar.jpg',0,'20009B00044'),(46,'EBINDA','Harss','A','07883179','','libre','avatar.jpg',0,'10279F11013');
/*!40000 ALTER TABLE `chauffeur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `client` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant unique attribué à la création de l’enregistrement  ',
  `nom` varchar(255) NOT NULL COMMENT 'nom du client',
  `prenom` varchar(255) NOT NULL COMMENT 'prénom du client',
  `tel` varchar(255) NOT NULL COMMENT 'téléphone du client',
  `permis` varchar(255) NOT NULL COMMENT 'permis du client',
  `id_cat` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL COMMENT 'photo du client',
  `id_fact` int(11) NOT NULL COMMENT 'identifiant unique a chaque facture',
  `location` varchar(255) NOT NULL COMMENT 'état de la location',
  `numPermis` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client`
--

LOCK TABLES `client` WRITE;
/*!40000 ALTER TABLE `client` DISABLE KEYS */;
INSERT INTO `client` (`id`, `nom`, `prenom`, `tel`, `permis`, `id_cat`, `photo`, `id_fact`, `location`, `numPermis`) VALUES (1,'AZIZE','EMMA','07189176','B',0,'avatar.jpg',136,'voiture non rendue','21049D01012'),(3,'OBIANG','NICEPHORE','04052265','aucun',0,'avatar.jpg',139,'voiture non rendue',''),(4,'BIFANE','LEÏLA','06054412','aucun',0,'avatar.jpg',137,'voiture non rendue',''),(5,'JOUMAS','EMILE','05142255','aucun',0,'avatar.jpg',138,'voiture non rendue','');
/*!40000 ALTER TABLE `client` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `date`
--

DROP TABLE IF EXISTS `date`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `date` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant unique attribué à la création de l’enregistrement  ',
  `mois` varchar(255) NOT NULL COMMENT 'mois de la dernière facture',
  `num` int(11) NOT NULL COMMENT 'numero de la dernière facture',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `date`
--

LOCK TABLES `date` WRITE;
/*!40000 ALTER TABLE `date` DISABLE KEYS */;
INSERT INTO `date` (`id`, `mois`, `num`) VALUES (1,'09',22);
/*!40000 ALTER TABLE `date` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `energie`
--

DROP TABLE IF EXISTS `energie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `energie` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant unique attribué à la création de l’enregistrement  ',
  `nom` varchar(100) CHARACTER SET utf8 NOT NULL COMMENT 'nom de l''énergie',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `energie`
--

LOCK TABLES `energie` WRITE;
/*!40000 ALTER TABLE `energie` DISABLE KEYS */;
INSERT INTO `energie` (`id`, `nom`) VALUES (1,'Gasoil'),(2,'Essence'),(3,'Électrique');
/*!40000 ALTER TABLE `energie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entreprise`
--

DROP TABLE IF EXISTS `entreprise`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entreprise` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant unique attribué à la création de l’enregistrement  ',
  `photo` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'photo de l''entreprise',
  `nom` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'nom de l''entreprise',
  `slogan` varchar(255) NOT NULL COMMENT 'slogan de l''entreprise',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entreprise`
--

LOCK TABLES `entreprise` WRITE;
/*!40000 ALTER TABLE `entreprise` DISABLE KEYS */;
INSERT INTO `entreprise` (`id`, `photo`, `nom`, `slogan`) VALUES (1,'3amuo0.jpg','Les Transports Citadins','');
/*!40000 ALTER TABLE `entreprise` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `facture`
--

DROP TABLE IF EXISTS `facture`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `facture` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant unique attribué à la création de l’enregistrement  ',
  `id_voi` int(11) NOT NULL COMMENT 'identifiant unique à la voiture ',
  `id_cli` int(11) NOT NULL COMMENT 'identifiant unique au client',
  `prixl` int(255) NOT NULL COMMENT 'prix de la location',
  `observation` varchar(255) NOT NULL COMMENT 'observation',
  `nbrj` int(255) NOT NULL DEFAULT '0' COMMENT 'nombre de jour de la location',
  `remise` int(11) NOT NULL DEFAULT '0' COMMENT 'remise sur le prix',
  `datel` date NOT NULL COMMENT 'date de la location',
  `dater` date NOT NULL COMMENT 'date de retour de la location',
  `datef` varchar(20) NOT NULL COMMENT 'date de fin de location',
  `num` varchar(255) NOT NULL COMMENT 'numéro de la location',
  `fait` varchar(255) NOT NULL COMMENT 'date de la facture',
  `id_cha` int(11) NOT NULL COMMENT 'identifiant unique du chauffeur ',
  `id_chacli` int(11) NOT NULL COMMENT 'identifiant unique du client s''il est chauffeur',
  `operateur` varchar(255) NOT NULL COMMENT 'l''opérateur qui saisit la facture',
  PRIMARY KEY (`id`),
  KEY `code_client` (`id_cli`)
) ENGINE=MyISAM AUTO_INCREMENT=140 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `facture`
--

LOCK TABLES `facture` WRITE;
/*!40000 ALTER TABLE `facture` DISABLE KEYS */;
INSERT INTO `facture` (`id`, `id_voi`, `id_cli`, `prixl`, `observation`, `nbrj`, `remise`, `datel`, `dater`, `datef`, `num`, `fait`, `id_cha`, `id_chacli`, `operateur`) VALUES (136,37,1,200000,'',8,0,'2015-09-25','2015-10-03','25-09-2015','#201509-18','25-09-2015 a 01:55:27',41,0,'romaric'),(137,33,4,440000,'',11,0,'2015-09-10','2015-09-21','10-09-2015','#201509-20','25-09-2015 a 01:57:55',44,0,'romaric'),(138,38,5,16000,'',1,0,'2015-09-25','2015-09-26','25-09-2015','#201509-21','25-09-2015 a 02:00:57',38,0,'romaric'),(139,42,3,468000,'',36,0,'2015-09-24','2015-10-30','25-09-2015','#201509-22','25-09-2015 a 10:00:37',35,0,'romaric');
/*!40000 ALTER TABLE `facture` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historique`
--

DROP TABLE IF EXISTS `historique`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `historique` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant unique attribué à la création de l’enregistrement  ',
  `nom` varchar(255) NOT NULL COMMENT 'nom du client',
  `prenom` varchar(255) NOT NULL COMMENT 'prenom du client',
  `tel` varchar(255) NOT NULL COMMENT 'téléphone du client',
  `observation` varchar(255) NOT NULL,
  `prixl` int(255) NOT NULL COMMENT 'prix de la location ',
  `remise` int(11) NOT NULL DEFAULT '0' COMMENT 'remise sur le prix ',
  `nbrj` int(255) NOT NULL DEFAULT '0' COMMENT 'nombre de jour',
  `datel` date NOT NULL COMMENT 'date de la location ',
  `dater` date NOT NULL COMMENT 'date de retour de la location ',
  `datef` date NOT NULL COMMENT 'date de fin de location ',
  `num` varchar(255) NOT NULL COMMENT 'numéro de la location ',
  `matricule` varchar(255) NOT NULL COMMENT 'matricule de la voiture',
  `modele` varchar(255) NOT NULL COMMENT 'modèle de la voiture',
  `marque` varchar(255) NOT NULL COMMENT 'marque de la voiture',
  `prixj` int(11) NOT NULL COMMENT 'priix par jour de la voiture',
  `fait` varchar(255) NOT NULL COMMENT 'date de la facture ',
  `permis` varchar(255) NOT NULL COMMENT 'permis du chauffeur',
  `npch` varchar(255) NOT NULL COMMENT 'nom et prénom du chauffeur',
  `npchc` varchar(255) NOT NULL COMMENT 'nom et prénom pour client chauffeur',
  `operateur` varchar(255) NOT NULL COMMENT 'l''opérateur qui a saisi la facture ',
  PRIMARY KEY (`id`),
  KEY `code_client` (`nom`)
) ENGINE=MyISAM AUTO_INCREMENT=128 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historique`
--

LOCK TABLES `historique` WRITE;
/*!40000 ALTER TABLE `historique` DISABLE KEYS */;
INSERT INTO `historique` (`id`, `nom`, `prenom`, `tel`, `observation`, `prixl`, `remise`, `nbrj`, `datel`, `dater`, `datef`, `num`, `matricule`, `modele`, `marque`, `prixj`, `fait`, `permis`, `npch`, `npchc`, `operateur`) VALUES (116,'MOUBA','RICHARD','03654875','',15000,0,1,'2015-09-09','2015-09-10','0000-00-00','#201509-5','DM-225-AA','serie3','BMW',15000,'09-09-2015 a 17:05:13','azerty','moussavou magdjosse','','nene'),(123,'KASSA','DARRYL','02050422','',102000,0,6,'2015-09-27','2015-10-03','0000-00-00','#201509-13','DM-225-BA','EPICA','CHEVROLET',17000,'25-09-2015 a 01:32:42','aucun','EYI Ariel','','romaric'),(124,'OBIANG','NICEPHORE','04052265','',48000,0,3,'2015-09-21','2015-09-24','0000-00-00','#201509-15','DN-135-AA','Hybrid','BMW',16000,'25-09-2015 a 01:36:00','aucun','MVE James','','romaric'),(127,'AZIZE','EMMA','07189176','',200000,0,8,'2015-09-25','2015-10-03','0000-00-00','#201509-17','DS-215-BC','A1','AUDI',25000,'25-09-2015 a 01:51:11','B','MVE James','','romaric');
/*!40000 ALTER TABLE `historique` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `marque`
--

DROP TABLE IF EXISTS `marque`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `marque` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `icone` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marque`
--

LOCK TABLES `marque` WRITE;
/*!40000 ALTER TABLE `marque` DISABLE KEYS */;
INSERT INTO `marque` (`id`, `nom`, `icone`) VALUES (1,'ALFA ROMEO',''),(2,'AUDI',''),(3,'BMW',''),(4,'CITROEN',''),(5,'DAF',''),(6,'FERRARI',''),(7,'FIAT',''),(8,'FORD',''),(9,'HONDA',''),(10,'JAGUAR',''),(11,'LADA',''),(12,'LAMBORGHINI',''),(13,'LANCIA',''),(14,'MASERATI',''),(15,'MAZDA',''),(16,'MERCEDES',''),(17,'MITSUBISHI',''),(18,'NISSAN',''),(19,'OPEL',''),(20,'PEUGEOT',''),(21,'PORSCHE',''),(22,'RENAULT',''),(23,'ROLLS ROYCE',''),(24,'ROVER',''),(25,'SAAB',''),(26,'SEAT',''),(27,'SKODA',''),(28,'SUBARU',''),(29,'SUZUKI',''),(30,'TOYOTA',''),(31,'VAUXHALL',''),(32,'VOLKSWAGEN',''),(33,'VOLVO',''),(38,'TVR',''),(39,'BENTLEY',''),(40,'CHEVROLET',''),(41,'DACIA',''),(42,'DODGE',''),(43,'HYUNDAI',''),(44,'ISUZU',''),(45,'INFINITI',''),(46,'KIA',''),(47,'BUGATTI',''),(48,'CHRYSLER',''),(49,'HUMMER',''),(50,'JEEP',''),(51,'LAND ROVER',''),(52,'LEXUS',''),(53,'LOTUS',''),(54,'SSANGYONG','');
/*!40000 ALTER TABLE `marque` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permis`
--

DROP TABLE IF EXISTS `permis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permis` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant unique attribué à la création de l’enregistrement  ',
  `nom` varchar(10) NOT NULL COMMENT 'nom du permis',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permis`
--

LOCK TABLES `permis` WRITE;
/*!40000 ALTER TABLE `permis` DISABLE KEYS */;
INSERT INTO `permis` (`id`, `nom`) VALUES (1,'A'),(2,'B'),(3,'C'),(4,'D'),(5,'aucun'),(6,'A,B'),(7,'A,C'),(8,'A,D'),(9,'C,D'),(10,'B,D'),(11,'B,C'),(12,'A,B,C'),(13,'A,B,D'),(14,'A,C,D'),(15,'B,C,D'),(16,'A,B,C,D');
/*!40000 ALTER TABLE `permis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_voi` int(11) NOT NULL,
  `id_cli` int(11) NOT NULL,
  `prixl` int(255) NOT NULL,
  `observation` varchar(255) NOT NULL,
  `nbrj` int(255) NOT NULL DEFAULT '0',
  `remise` int(11) NOT NULL DEFAULT '0',
  `datel` date NOT NULL,
  `dater` date NOT NULL,
  `datef` date NOT NULL,
  `num` varchar(255) NOT NULL,
  `fait` varchar(255) NOT NULL,
  `id_cha` int(11) NOT NULL,
  `id_chacli` int(11) NOT NULL,
  `operateur` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `code_client` (`id_cli`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservations`
--

LOCK TABLES `reservations` WRITE;
/*!40000 ALTER TABLE `reservations` DISABLE KEYS */;
INSERT INTO `reservations` (`id`, `id_voi`, `id_cli`, `prixl`, `observation`, `nbrj`, `remise`, `datel`, `dater`, `datef`, `num`, `fait`, `id_cha`, `id_chacli`, `operateur`) VALUES (37,40,3,51000,'',3,0,'2015-09-27','2015-09-30','0000-00-00','#201509-19','25-09-2015 a 01:56:05',45,0,'romaric');
/*!40000 ALTER TABLE `reservations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicule`
--

DROP TABLE IF EXISTS `vehicule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicule` (
  `id` int(255) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant unique attribué à la création de l’enregistrement  ',
  `id_client` varchar(255) NOT NULL COMMENT 'identifiant du client de la dernière location',
  `matricule` varchar(255) NOT NULL COMMENT 'matricule du véhicule',
  `marque` varchar(255) NOT NULL COMMENT 'marque du véhicule',
  `modele` varchar(255) NOT NULL COMMENT 'modèle du véhicule',
  `nbrP` varchar(255) NOT NULL COMMENT 'nombre de place',
  `etat` varchar(255) NOT NULL COMMENT 'l''état du véhicule',
  `photo` varchar(255) NOT NULL COMMENT 'photo  du véhicule',
  `status` varchar(255) NOT NULL COMMENT 'statut du véhicule (libre, occupé)',
  `prix` int(255) NOT NULL COMMENT 'prix par heure',
  `cate` varchar(255) NOT NULL COMMENT 'catégorie du véhicule',
  `energie` varchar(100) NOT NULL COMMENT 'énergie du véhicule ',
  `id_fact` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicule`
--

LOCK TABLES `vehicule` WRITE;
/*!40000 ALTER TABLE `vehicule` DISABLE KEYS */;
INSERT INTO `vehicule` (`id`, `id_client`, `matricule`, `marque`, `modele`, `nbrP`, `etat`, `photo`, `status`, `prix`, `cate`, `energie`, `id_fact`) VALUES (34,'RSGDFCV XCVB','DM-125-AA','HYUNDAI','Tucson','5','yes','7kqqni.jpg','libre',35000,'4*4 De Luxe','Gasoil',0),(32,'srdtgfh fhgj','DM-225-AA','BMW','serie3','5','yes','6tiuer.jpg','libre',15000,'4*4 Standard','Essence',0),(33,'BIFANE Leïla','DM-225-BA','AUDI','A4','5','yes','h8k7hl.jpg','location',40000,'4*4 De Luxe','Gasoil',137),(38,'JOUMAS Emile','DN-135-AA','BMW','Hybrid','5','yes','fa62sm.jpg','location',16000,'4*4 De Luxe','Essence',138),(37,'AZIZE EMMA','DS-215-BC','AUDI','A1','5','yes','ktoeh7.jpg','location',25000,'Citadine','Essence',136),(40,'OBIANG NICEPHORE','DM-225-BA','CHEVROLET','EPICA','5','yes','t6gci7.jpg','libre',17000,'Citadine','Essence',0),(41,'','AS-212-Bm','CITROEN','crosser','5','yes','8l3st8.jpg','libre',13000,'4*4 De Luxe','Essence',0),(42,'OBIANG NICEPHORE','AC-115-BC','CITROEN','C4','5','yes','vao3v0.jpg','location',13000,'4*4 De Luxe','Essence',139),(43,'','EC-215-ZC','MITSUBISHI','pajero','5','yes','89bjrs.jpg','libre',15500,'4*4 Standard','Gasoil',0),(44,'','AM-202-BP','PEUGEOT','308','5','yes','8bu1nr.jpg','libre',24500,'4*4 De Luxe','Essence',0),(45,'','AL-242-LO','TOYOTA','Yaris','5','yes','89r948.jpg','libre',12000,'4*4 De Luxe','Gasoil',0),(46,'','DK-125-CA','TOYOTA','Carina','5','yes','wmo3dl.jpg','libre',12000,'4*4 De Luxe','Gasoil',0);
/*!40000 ALTER TABLE `vehicule` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-10-03 14:15:26

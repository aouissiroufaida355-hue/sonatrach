-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: sonatrach_db
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

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
-- Table structure for table `autorisations`
--

DROP TABLE IF EXISTS `autorisations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `autorisations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stagiaire_id` int(11) NOT NULL,
  `contrat_id` int(11) DEFAULT NULL,
  `date_emission` date NOT NULL,
  `date_expiration` date NOT NULL,
  `numero_autorisation` varchar(50) DEFAULT NULL,
  `statut` enum('active','expiree','revoquee') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `numero_autorisation` (`numero_autorisation`),
  KEY `stagiaire_id` (`stagiaire_id`),
  KEY `contrat_id` (`contrat_id`),
  CONSTRAINT `autorisations_ibfk_1` FOREIGN KEY (`stagiaire_id`) REFERENCES `stagiaires` (`id`) ON DELETE CASCADE,
  CONSTRAINT `autorisations_ibfk_2` FOREIGN KEY (`contrat_id`) REFERENCES `contrats` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `autorisations`
--

LOCK TABLES `autorisations` WRITE;
/*!40000 ALTER TABLE `autorisations` DISABLE KEYS */;
INSERT INTO `autorisations` VALUES (1,2,NULL,'2024-07-01','2024-09-30','AUTH-2024-002','active','2026-05-18 22:56:34');
/*!40000 ALTER TABLE `autorisations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contrats`
--

DROP TABLE IF EXISTS `contrats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contrats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stagiaire_id` int(11) DEFAULT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `statut` enum('en_attente','valide','refuse') DEFAULT 'en_attente',
  `fichier_pdf` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `valide_par` varchar(100) DEFAULT NULL,
  `date_validation` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `organisme` varchar(255) DEFAULT NULL,
  `theme` varchar(255) DEFAULT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `prenom` varchar(100) DEFAULT NULL,
  `noms_stagiaires` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `stagiaire_id` (`stagiaire_id`),
  CONSTRAINT `contrats_ibfk_1` FOREIGN KEY (`stagiaire_id`) REFERENCES `stagiaires` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contrats`
--

LOCK TABLES `contrats` WRITE;
/*!40000 ALTER TABLE `contrats` DISABLE KEYS */;
INSERT INTO `contrats` VALUES (39,NULL,'2026-01-01','2026-05-01','valide',NULL,NULL,'GRH','2026-06-01 16:07:44','2026-06-01 17:07:38','2026-06-01 17:07:44','UNIVERSITE BOUMERDES','GERER STAGES ET STAGIAIRES ','SELLALI','DJOMANA','SELLALI DJOMANA, MERDES NABIL');
/*!40000 ALTER TABLE `contrats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2026_05_19_121006_add_soft_deletes_to_stagiaires_table',1),(2,'0001_01_01_000001_create_cache_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rendezvous`
--

DROP TABLE IF EXISTS `rendezvous`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rendezvous` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stagiaire_id` int(11) DEFAULT NULL,
  `date_rdv` date NOT NULL,
  `heure_rdv` time NOT NULL,
  `objet` varchar(200) NOT NULL,
  `rapport` text DEFAULT NULL,
  `has_rapport` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `nom_stagiaire` varchar(100) DEFAULT NULL,
  `prenom_stagiaire` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `stagiaire_id` (`stagiaire_id`),
  CONSTRAINT `rendezvous_ibfk_1` FOREIGN KEY (`stagiaire_id`) REFERENCES `stagiaires` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rendezvous`
--

LOCK TABLES `rendezvous` WRITE;
/*!40000 ALTER TABLE `rendezvous` DISABLE KEYS */;
INSERT INTO `rendezvous` VALUES (3,NULL,'2026-01-11','11:11:00','Point d’avancement','fffhfffn',1,'2026-05-14 09:58:21','2026-05-27 01:34:17','MARDES','NABIL'),(4,NULL,'2024-11-13','12:12:00','Avancement du mémoire',NULL,0,'2026-05-14 11:28:39','2026-05-27 01:34:45','SAID','SARA');
/*!40000 ALTER TABLE `rendezvous` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stagiaires`
--

DROP TABLE IF EXISTS `stagiaires`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stagiaires` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `specialite` varchar(100) DEFAULT NULL,
  `periode_debut` date DEFAULT NULL,
  `periode_fin` date DEFAULT NULL,
  `lieu_naissance` varchar(150) DEFAULT NULL,
  `lieu_residence` varchar(150) DEFAULT NULL,
  `journee` varchar(20) DEFAULT NULL,
  `diplome` varchar(100) DEFAULT NULL,
  `sujet_id` int(11) DEFAULT NULL,
  `archived` tinyint(1) NOT NULL DEFAULT 0,
  `archived_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stagiaires`
--

LOCK TABLES `stagiaires` WRITE;
/*!40000 ALTER TABLE `stagiaires` DISABLE KEYS */;
INSERT INTO `stagiaires` VALUES (2,'SAID','Sara','sara.said@mail.com','0555222222','Réseaux','2024-07-01','2024-07-31','Oran','Oran','Mercredi',NULL,1,0,NULL),(4,'khelifi','khaoula',NULL,NULL,NULL,'2026-09-13','2026-11-11',NULL,NULL,'Lundi',NULL,3,0,NULL),(5,'aoudache','MANEL',NULL,NULL,NULL,'2026-11-11','2027-11-11',NULL,NULL,'Mardi','Ingénieur',4,0,NULL),(45,'merdes','nabil','nabilmerdes@gmail.com','0555222222','IA','2025-11-11','2026-11-12','Constantine','Alger','Jeudi','Master',4,0,NULL),(46,'sellali','djomana',NULL,'0786844184','INFORMATIQUE','2026-01-11','2026-05-11','BASKRA','ALGER','Mercredi','Ingénieur',NULL,0,NULL);
/*!40000 ALTER TABLE `stagiaires` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sujet_stagiaire`
--

DROP TABLE IF EXISTS `sujet_stagiaire`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sujet_stagiaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sujet_id` int(11) NOT NULL,
  `stagiaire_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sujet_id` (`sujet_id`),
  KEY `stagiaire_id` (`stagiaire_id`),
  CONSTRAINT `sujet_stagiaire_ibfk_1` FOREIGN KEY (`sujet_id`) REFERENCES `sujets` (`id`) ON DELETE CASCADE,
  CONSTRAINT `sujet_stagiaire_ibfk_2` FOREIGN KEY (`stagiaire_id`) REFERENCES `stagiaires` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sujet_stagiaire`
--

LOCK TABLES `sujet_stagiaire` WRITE;
/*!40000 ALTER TABLE `sujet_stagiaire` DISABLE KEYS */;
INSERT INTO `sujet_stagiaire` VALUES (4,6,4),(5,6,5);
/*!40000 ALTER TABLE `sujet_stagiaire` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sujets`
--

DROP TABLE IF EXISTS `sujets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sujets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `domaine` varchar(100) NOT NULL,
  `sujet` varchar(200) NOT NULL,
  `propose_par` varchar(100) NOT NULL,
  `annee_proposee` year(4) NOT NULL,
  `description` text DEFAULT NULL,
  `description_detaillee` text DEFAULT NULL,
  `statut` enum('non_attribue_ouvert','non_attribue_verrouille','attribue','soutenu') DEFAULT 'non_attribue_ouvert',
  `stagiaire_id` int(11) DEFAULT NULL,
  `encadrant_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sujets`
--

LOCK TABLES `sujets` WRITE;
/*!40000 ALTER TABLE `sujets` DISABLE KEYS */;
INSERT INTO `sujets` VALUES (1,'Gestion des compétences','Plateforme de gestion des formations internes','Dr. Ahmed',2024,'Plateforme de gestion des formations internes','Gestion des formations, inscriptions, évaluations et certificats.','non_attribue_verrouille',1,NULL,'2026-04-30 10:14:53','2026-05-26 21:28:27'),(2,'Intelligence artificielle','Système intelligent de maintenance préventive','BEN Ali',2025,'Système intelligent de maintenance préventive','Utilisation de l’IA pour prévoir les pannes des équipements industriels','non_attribue_verrouille',6,NULL,'2026-04-30 10:14:53','2026-05-26 21:27:05'),(3,'Génie industriel','Plateforme de suivi des interventions techniques','Dr. Karim',2024,'Plateforme de suivi des interventions techniques','Gestion des équipes techniques, des missions et des rapports d’intervention.','non_attribue_ouvert',7,NULL,'2026-04-30 10:14:53','2026-05-26 17:05:22'),(4,'Maintenance industrielle','Application de gestion des équipements pétroliers','Dr. Karim',2025,'Application de gestion des équipements pétroliers','Suivi des équipements, maintenance, pannes et historique des interventions','soutenu',NULL,NULL,'2026-04-30 10:14:53','2026-05-26 17:04:02'),(6,'Informatique de gestion','SITE WEB POUR GERER LES STAGES ET STAGIAIRES','Dr. Ahmed',2024,'SITE WEB POUR GERER LES STAGES ET STAGIAIRES','d’ajouter et gérer les informations des stagiaires ;\nd’affecter un encadreur à chaque stagiaire ;\nde proposer et suivre les sujets de stage ;\nde gérer les contrats et la durée des stages','attribue',4,NULL,'2026-05-14 23:10:12','2026-05-26 17:04:56');
/*!40000 ALTER TABLE `sujets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_utilisateur` varchar(100) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `role` enum('encadrant','grh') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `nom_utilisateur` (`nom_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'farid','03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4','grh','2026-04-30 10:14:20'),(2,'aourag ','03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4','encadrant','2026-04-30 10:53:56');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-06-01 22:40:22

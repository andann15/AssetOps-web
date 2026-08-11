-- MySQL dump 10.13  Distrib 8.4.3, for Win64 (x86_64)
--
-- Host: localhost    Database: assetops
-- ------------------------------------------------------
-- Server version	8.4.3

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
-- Table structure for table `asset_categories`
--

DROP TABLE IF EXISTS `asset_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `asset_categories` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asset_categories`
--

LOCK TABLES `asset_categories` WRITE;
/*!40000 ALTER TABLE `asset_categories` DISABLE KEYS */;
INSERT INTO `asset_categories` VALUES ('019fc150-552f-72f9-b73e-75829a6569bd','Komputer & Laptop',1,'2026-08-01 23:11:35','2026-08-01 23:11:35'),('019fc150-5531-70a6-aef8-96fab03653a8','Printer & Scanner',1,'2026-08-01 23:11:35','2026-08-01 23:11:35'),('019fc150-5535-725f-8b7d-a31b0fed6acb','Jaringan (Networking)',0,'2026-08-01 23:11:35','2026-08-05 07:25:10'),('019fc150-5538-7395-96fb-33669c6d446e','Peralatan Produksi',1,'2026-08-01 23:11:35','2026-08-01 23:11:35'),('019fc150-553a-7268-8dcd-835ce2c6aec3','Kendaraan',1,'2026-08-01 23:11:35','2026-08-01 23:11:35'),('019fc150-553d-7011-aca5-f66e2cc175c1','Furniture Kantor',1,'2026-08-01 23:11:35','2026-08-01 23:11:35');
/*!40000 ALTER TABLE `asset_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assets`
--

DROP TABLE IF EXISTS `assets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `assets` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `asset_category_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serial_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `warranty_end` date DEFAULT NULL,
  `location_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `current_user_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `work_unit_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `assets_code_unique` (`code`),
  KEY `assets_asset_category_id_foreign` (`asset_category_id`),
  KEY `assets_brand_id_foreign` (`brand_id`),
  KEY `assets_location_id_foreign` (`location_id`),
  KEY `assets_current_user_id_foreign` (`current_user_id`),
  KEY `assets_work_unit_id_foreign` (`work_unit_id`),
  CONSTRAINT `assets_asset_category_id_foreign` FOREIGN KEY (`asset_category_id`) REFERENCES `asset_categories` (`id`) ON DELETE RESTRICT,
  CONSTRAINT `assets_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE RESTRICT,
  CONSTRAINT `assets_current_user_id_foreign` FOREIGN KEY (`current_user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `assets_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE RESTRICT,
  CONSTRAINT `assets_work_unit_id_foreign` FOREIGN KEY (`work_unit_id`) REFERENCES `work_units` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assets`
--

LOCK TABLES `assets` WRITE;
/*!40000 ALTER TABLE `assets` DISABLE KEYS */;
INSERT INTO `assets` VALUES ('019fca5d-be3e-73e6-a756-f9eeac6ab640','AST-2026-001','007','019fc150-553d-7011-aca5-f66e2cc175c1','019fc150-5541-7079-ad40-902c016c6290',NULL,NULL,NULL,NULL,'019fc150-5557-701c-a20d-cc2010b2777f','active',NULL,'019fc150-54ed-72ad-989f-33dfe7fc32c5','1. Meja     = 7\r\n2. Kursi    = 8\r\n3. Lemari = 14','2026-08-03 17:22:49','2026-08-09 02:14:00','2026-08-09 02:14:00'),('019fca62-498a-7161-a252-aecf3ea76d0b','AST-2026-002','008','019fc150-552f-72f9-b73e-75829a6569bd','019fc150-5547-70ab-bf10-9dbdd8a6a4e0',NULL,NULL,NULL,NULL,'019fc150-5557-701c-a20d-cc2010b2777f','active',NULL,'019fc150-551e-7232-9adf-32316b0629fb','sudah diserahkan','2026-08-03 17:27:46','2026-08-09 02:14:03','2026-08-09 02:14:03'),('019fcac6-1b33-73b8-a9fd-c9ba1b6ec18f','AST-2026-003','009','019fc150-552f-72f9-b73e-75829a6569bd',NULL,NULL,NULL,NULL,NULL,'019fc150-5550-715d-ace6-bba52477e700','active',NULL,'019fc150-551e-7232-9adf-32316b0629fb','sudah diserahkan','2026-08-03 19:16:48','2026-08-09 02:14:07','2026-08-09 02:14:07'),('019fd2af-0404-72bf-b828-da34a92926ac','ASET-2026-0001','laptop','019fc150-552f-72f9-b73e-75829a6569bd','019fc150-5541-7079-ad40-902c016c6290',NULL,NULL,'2026-08-06',NULL,'019fc150-5550-715d-ace6-bba52477e700','active',NULL,NULL,NULL,'2026-08-05 08:08:33','2026-08-09 02:14:10','2026-08-09 02:14:10'),('019fe609-389d-739a-bcf2-9898045b231a','ASET-2026-0002','Printer HP','019fc150-5531-70a6-aef8-96fab03653a8','019fc150-5544-717f-a4fb-5d5d4f9cd21e',NULL,NULL,NULL,NULL,'019fc150-5550-715d-ace6-bba52477e700','active',NULL,NULL,NULL,'2026-08-09 02:19:51','2026-08-09 02:19:51',NULL);
/*!40000 ALTER TABLE `assets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `audit_logs`
--

DROP TABLE IF EXISTS `audit_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `audit_logs` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `actor_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entity_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entity_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `old_value` text COLLATE utf8mb4_unicode_ci,
  `new_value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `audit_logs_actor_id_foreign` (`actor_id`),
  CONSTRAINT `audit_logs_actor_id_foreign` FOREIGN KEY (`actor_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audit_logs`
--

LOCK TABLES `audit_logs` WRITE;
/*!40000 ALTER TABLE `audit_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `audit_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `brands` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brands`
--

LOCK TABLES `brands` WRITE;
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
INSERT INTO `brands` VALUES ('019fc150-5541-7079-ad40-902c016c6290','Lenovo',1,'2026-08-01 23:11:35','2026-08-01 23:11:35'),('019fc150-5544-717f-a4fb-5d5d4f9cd21e','HP',1,'2026-08-01 23:11:35','2026-08-01 23:11:35'),('019fc150-5547-70ab-bf10-9dbdd8a6a4e0','Dell',1,'2026-08-01 23:11:35','2026-08-01 23:11:35'),('019fc150-5549-7338-83f0-56ae3114b660','Epson',1,'2026-08-01 23:11:35','2026-08-01 23:11:35'),('019fc150-554c-715f-ace2-4a6fe1f96b0e','Cisco',1,'2026-08-01 23:11:35','2026-08-01 23:11:35');
/*!40000 ALTER TABLE `brands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
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
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
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
-- Table structure for table `compartments`
--

DROP TABLE IF EXISTS `compartments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `compartments` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compartments`
--

LOCK TABLES `compartments` WRITE;
/*!40000 ALTER TABLE `compartments` DISABLE KEYS */;
INSERT INTO `compartments` VALUES ('019fc150-54e2-723d-bea6-40d01ec5d1a1','Kompartemen Teknologi Informasi',1,'2026-08-01 23:11:35','2026-08-01 23:11:35'),('019fc150-5500-72f4-91dd-ec95f943967d','Kompartemen Sumber Daya Manusia',1,'2026-08-01 23:11:35','2026-08-01 23:11:35'),('019fc150-5515-71d9-8bb9-9803664db5d8','Kompartemen Operasi & Produksi',1,'2026-08-01 23:11:35','2026-08-01 23:11:35'),('019fd294-eb3e-71ca-aad5-726385e3b22e','Kompartemen Operasi Pabrik',1,'2026-08-05 07:40:02','2026-08-05 07:40:02'),('019fd29c-38ab-73ec-ac22-e8e4a1c59549','Kompartemen Pemeliharaan Pabrik',1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-38c8-733f-a547-41b898b1b7a6','Kompartemen Jasa Pelayanan Pabrik (JPP)',1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-38d5-734a-8690-a83ee5b1c093','Kompartemen Teknik & Keandalan Pabrik',1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-38e8-7200-937a-81140e83efd5','Kompartemen Pengembangan Bisnis & Investasi',1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-38f6-73f1-91aa-41305a4bc14f','Kompartemen Tata Kelola Lingkungan & K3',1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-3907-713d-b15a-25a5fb90e1dd','Kompartemen Rantai Pasok (Supply Chain)',1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-3919-7178-a172-22c94c35691d','Kompartemen Pemasaran & Distribusi',1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-392e-721e-9d75-b21e66914890','Kompartemen Keuangan',1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-393e-71a5-afc3-e3f3dc601ad6','Kompartemen Sumber Daya Manusia (SDM)',1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-3950-70b1-81b5-be70f7837204','Kompartemen Umum & Korporat',1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-3961-730a-ba09-71fc851814bb','Satuan Pengawasan Intern (SPI)',1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-396d-71a3-80f7-b510f91a9c20','Sekretaris Perusahaan (Corporate Secretary)',1,'2026-08-05 07:48:01','2026-08-05 07:48:01');
/*!40000 ALTER TABLE `compartments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `departments` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `compartment_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `departments_compartment_id_foreign` (`compartment_id`),
  CONSTRAINT `departments_compartment_id_foreign` FOREIGN KEY (`compartment_id`) REFERENCES `compartments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departments`
--

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
INSERT INTO `departments` VALUES ('019fc150-54e7-701f-8ab8-866b6b6c8911','019fc150-54e2-723d-bea6-40d01ec5d1a1','Departemen Infrastruktur TI',1,'2026-08-01 23:11:35','2026-08-01 23:11:35'),('019fc150-54f5-7242-b458-831b56c26625','019fc150-54e2-723d-bea6-40d01ec5d1a1','Departemen Pengembangan Aplikasi',1,'2026-08-01 23:11:35','2026-08-01 23:11:35'),('019fc150-5503-7091-8148-f6946f285fb1','019fc150-5500-72f4-91dd-ec95f943967d','Departemen Pendidikan & Pelatihan',1,'2026-08-01 23:11:35','2026-08-01 23:11:35'),('019fc150-550c-702d-b721-f997b384320e','019fc150-5500-72f4-91dd-ec95f943967d','Departemen Personalia',1,'2026-08-01 23:11:35','2026-08-01 23:11:35'),('019fc150-551a-7196-a5ec-de733aaf301a','019fc150-5515-71d9-8bb9-9803664db5d8','Departemen Operasi Pabrik 1',1,'2026-08-01 23:11:35','2026-08-01 23:11:35'),('019fc150-5524-72d1-83d9-0b157e637a21','019fc150-5515-71d9-8bb9-9803664db5d8','Departemen Operasi Pabrik 2',1,'2026-08-01 23:11:35','2026-08-01 23:11:35'),('019fd29c-3881-72fc-add4-ef6e452f384a','019fd294-eb3e-71ca-aad5-726385e3b22e','Departemen Operasi Pabrik 1A',1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-388d-73e9-8f06-b4202c53e1ee','019fd294-eb3e-71ca-aad5-726385e3b22e','Departemen Operasi Pabrik 2',1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-3892-704c-86de-c6e42331d64e','019fd294-eb3e-71ca-aad5-726385e3b22e','Departemen Operasi Pabrik 3',1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-3897-73e0-965a-f7926e8c3318','019fd294-eb3e-71ca-aad5-726385e3b22e','Departemen Operasi Pabrik 4',1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-389c-711d-ab73-ec73dd039c2c','019fd294-eb3e-71ca-aad5-726385e3b22e','Departemen Operasi Pabrik 5',1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-38a1-7027-a123-5e6633cec66a','019fd294-eb3e-71ca-aad5-726385e3b22e','Departemen Operasi Pabrik 6 (Boiler Batubara & Utilitas Gas)',1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-38a7-70f9-8422-2d4e8d96a4fc','019fd294-eb3e-71ca-aad5-726385e3b22e','Departemen Operasi Pabrik 7 (NPK)',1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-38ae-7206-a412-efd7dcbb75ab','019fd29c-38ab-73ec-ac22-e8e4a1c59549','Departemen Pemeliharaan Mechanical & Machinery',1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-38b3-7050-8307-59859fa1727a','019fd29c-38ab-73ec-ac22-e8e4a1c59549','Departemen Pemeliharaan Listrik dan Instalasi',1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-38b8-7303-ad26-fdaed292afb4','019fd29c-38ab-73ec-ac22-e8e4a1c59549','Departemen Pemeliharaan Instrumen',1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-38be-7090-bc69-c149ad1a9245','019fd29c-38ab-73ec-ac22-e8e4a1c59549','Departemen Pemeliharaan Bengkel (Workshop)',1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-38c3-72f5-91ba-96d6017b6306','019fd29c-38ab-73ec-ac22-e8e4a1c59549','Departemen Perencanaan & Pengendalian TA (Turn Around / Pemeliharaan Total)',1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-38cb-734e-a974-33c376b9221f','019fd29c-38c8-733f-a547-41b898b1b7a6','Departemen Fabrikasi & Suku Cadang',1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-38d0-71b2-b7d5-cae49e554892','019fd29c-38c8-733f-a547-41b898b1b7a6','Departemen Pengecoran & Metalurgi',1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-38d8-72e9-ac80-0e41f1ab70d5','019fd29c-38d5-734a-8690-a83ee5b1c093','Departemen Rekayasa Teknik (Engineering)',1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-38de-7397-b059-06de94518ba7','019fd29c-38d5-734a-8690-a83ee5b1c093','Departemen Keandalan Pabrik (Plant Reliability)',1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-38e3-7374-9e6a-2e157f77bb9e','019fd29c-38d5-734a-8690-a83ee5b1c093','Departemen Laboratorium Pengujian & Kalibrasi',1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-38eb-7287-9f9c-4902f2e25851','019fd29c-38e8-7200-937a-81140e83efd5','Departemen Pengembangan Bisnis',1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-38f0-7300-a363-09a1541599c8','019fd29c-38e8-7200-937a-81140e83efd5','Departemen Manajemen Proyek',1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-38f8-713c-b61c-95dc258c0816','019fd29c-38f6-73f1-91aa-41305a4bc14f','Departemen Keselamatan & Kesehatan Kerja (K3)',1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-38fd-73f1-8bf9-f4c505c2a0d7','019fd29c-38f6-73f1-91aa-41305a4bc14f','Departemen Lingkungan Hidup',1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-3902-71b7-a9d7-7e0f32dbf9d8','019fd29c-38f6-73f1-91aa-41305a4bc14f','Departemen Keamanan dan Ketertiban (Kamtib)',1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-3909-7378-a22a-79a87a206bf2','019fd29c-3907-713d-b15a-25a5fb90e1dd','Departemen Perencanaan Material dan Pergudangan',1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-390f-711f-a9a9-b436a739cd86','019fd29c-3907-713d-b15a-25a5fb90e1dd','Departemen Pengadaan Barang',1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-3914-713b-ac30-6688357be371','019fd29c-3907-713d-b15a-25a5fb90e1dd','Departemen Pengadaan Jasa',1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-391b-72bf-b41f-3125f014e332','019fd29c-3919-7178-a172-22c94c35691d','Departemen Pemasaran Dalam Negeri',1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-3920-7266-b37c-94c4ac2900e7','019fd29c-3919-7178-a172-22c94c35691d','Departemen Pemasaran Luar Negeri',1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-3925-7294-ae27-6ed47843aa8b','019fd29c-3919-7178-a172-22c94c35691d','Departemen Distribusi & Transportasi',1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-392a-71c9-a296-d618e78563c6','019fd29c-3919-7178-a172-22c94c35691d','Departemen Pelayanan Pelanggan & Produk Non-Pupuk',1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-3931-7202-9b69-8dcf905d5703','019fd29c-392e-721e-9d75-b21e66914890','Departemen Akuntansi',1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-3935-71b1-b4ca-f82cb7aa5746','019fd29c-392e-721e-9d75-b21e66914890','Departemen Perbendaharaan & Pendanaan',1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-393a-7351-af96-7e6394f21cd7','019fd29c-392e-721e-9d75-b21e66914890','Departemen Anggaran & Perencanaan Keuangan',1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-3940-73e3-8f52-4ea8cc3e033f','019fd29c-393e-71a5-afc3-e3f3dc601ad6','Departemen Perencanaan & Pengembangan SDM',1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-3946-7057-8186-ebf08d0650ea','019fd29c-393e-71a5-afc3-e3f3dc601ad6','Departemen Hubungan Industrial & Kesejahteraan Karyawan',1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-394c-728b-b7b8-be574e2f0987','019fd29c-393e-71a5-afc3-e3f3dc601ad6','Departemen Pembelajaran & Sertifikasi (Diklat)',1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-3952-71b5-b10e-d5e73ee3a608','019fd29c-3950-70b1-81b5-be70f7837204','Departemen Hubungan Masyarakat (Humas)',1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-3957-7193-aaa6-7d3697ff285c','019fd29c-3950-70b1-81b5-be70f7837204','Departemen Kesejahteraan & Pengelolaan Fasilitas (Umum)',1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-395d-708a-a6c8-b0ec7301ff4a','019fd29c-3950-70b1-81b5-be70f7837204','Departemen Tanggung Jawab Sosial dan Lingkungan (TJSL / CSR)',1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-3964-737a-ab7f-2312eb1a1735','019fd29c-3961-730a-ba09-71fc851814bb','Departemen Audit Operasional',1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-3968-73e9-ac13-6667dc076ba3','019fd29c-3961-730a-ba09-71fc851814bb','Departemen Audit Keuangan & Umum',1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-396f-714d-a74e-33d28ff26d17','019fd29c-396d-71a3-80f7-b510f91a9c20','Departemen Hukum & Legal Korporat',1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-3974-712c-89a0-5cb0a0555232','019fd29c-396d-71a3-80f7-b510f91a9c20','Departemen Tata Kelola Perusahaan & Kepatuhan (Governance & Compliance)',1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-3978-7302-ac73-c9e9f447fd8b','019fd29c-396d-71a3-80f7-b510f91a9c20','Departemen Sistem Informasi dan Telekomunikasi (TI)',1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-397e-72fe-952d-afdc5cfa58ad','019fd29c-396d-71a3-80f7-b510f91a9c20','Administrasi Korporat / Kesekretariatan',1,'2026-08-05 07:48:01','2026-08-05 07:48:01');
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `locations`
--

DROP TABLE IF EXISTS `locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `locations` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `locations`
--

LOCK TABLES `locations` WRITE;
/*!40000 ALTER TABLE `locations` DISABLE KEYS */;
INSERT INTO `locations` VALUES ('019fc150-5550-715d-ace6-bba52477e700','Gedung Pusat PKT',1,'2026-08-01 23:11:35','2026-08-05 07:24:06'),('019fc150-5552-72be-b755-c4bac5401dae','Gedung Pusat Arsip',1,'2026-08-01 23:11:35','2026-08-05 07:24:19'),('019fc150-5554-701c-8c48-67be88203094','Gedung Teknical File',1,'2026-08-01 23:11:35','2026-08-05 07:24:41'),('019fc150-5557-701c-a20d-cc2010b2777f','Area Pabrik',1,'2026-08-01 23:11:35','2026-08-01 23:11:35'),('019fd287-11fa-7052-91cc-c4469cc516db','Luar Pabrik',1,'2026-08-05 07:24:55','2026-08-05 07:24:55');
/*!40000 ALTER TABLE `locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_07_21_005642_create_permission_tables',1),(5,'2026_07_21_010841_create_asset_categories_table',1),(6,'2026_07_21_010846_create_brands_table',1),(7,'2026_07_21_010853_create_locations_table',1),(8,'2026_07_21_010859_create_ticket_priorities_table',1),(9,'2026_07_21_010905_create_rejection_reasons_table',1),(10,'2026_07_21_010923_create_assets_table',1),(11,'2026_07_21_010928_create_tickets_table',1),(12,'2026_07_21_010933_create_ticket_histories_table',1),(13,'2026_07_21_010940_create_user_notifications_table',1),(14,'2026_07_21_010944_create_audit_logs_table',1),(15,'2026_07_23_003910_add_ticket_number_to_tickets_table',1),(16,'2026_07_24_112213_add_soft_deletes_to_assets_and_tickets_tables',1),(17,'2026_08_02_070559_create_compartments_table',1),(18,'2026_08_02_070600_create_departments_table',1),(19,'2026_08_02_070600_create_work_units_table',1),(20,'2026_08_02_070601_add_work_unit_id_to_users_table',1),(21,'2026_08_02_070602_create_work_unit_histories_table',1),(22,'2026_08_03_132017_add_work_unit_and_notes_to_assets_table',2),(23,'2026_08_04_014139_make_brand_id_nullable_in_assets_table',3),(24,'2026_08_05_150800_create_work_unit_asset_statuses_table',4),(25,'2026_08_05_153000_make_department_id_nullable_in_work_units_table',5),(26,'2026_08_05_153001_make_compartment_id_nullable_in_departments_table',5),(27,'2026_08_05_155000_make_name_nullable_in_work_units_table',6);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_roles` (
  `role_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES ('019fc150-549d-73a0-8c0b-6f0e94b42c0f','App\\Models\\User','019fc150-5697-73da-9df8-5b2c50b40191'),('019fc150-54af-73e6-8e77-7d40e67bfbff','App\\Models\\User','019fc150-57c7-710f-9ba6-6e35dd9acea1'),('019fc150-54c7-716c-8d47-fe37d747f4b2','App\\Models\\User','019fc150-58e7-7162-bc83-89e12c36560b'),('019fc150-54af-73e6-8e77-7d40e67bfbff','App\\Models\\User','019fc150-5a08-7378-88f9-90cddae795d2'),('019fc150-54c7-716c-8d47-fe37d747f4b2','App\\Models\\User','019fc150-5b1f-73cb-844e-749226b7be23'),('019fc150-549d-73a0-8c0b-6f0e94b42c0f','App\\Models\\User','019fc17a-a26e-7062-97bf-44e9afaffcb9');
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES ('019fc150-5458-707f-b629-a29b7346a3c1','assets.view','web','2026-08-01 23:11:35','2026-08-01 23:11:35'),('019fc150-5460-72a5-ac87-49e7081e4d5f','assets.create','web','2026-08-01 23:11:35','2026-08-01 23:11:35'),('019fc150-5463-7307-b7dc-479c8ddf0302','assets.edit','web','2026-08-01 23:11:35','2026-08-01 23:11:35'),('019fc150-5466-738f-af17-3e4990ff9bed','assets.delete','web','2026-08-01 23:11:35','2026-08-01 23:11:35'),('019fc150-5468-711e-ae87-597ebcc17489','tickets.view-all','web','2026-08-01 23:11:35','2026-08-01 23:11:35'),('019fc150-546c-7100-8de0-6acf4bc68da1','tickets.view-own','web','2026-08-01 23:11:35','2026-08-01 23:11:35'),('019fc150-5471-722c-80c4-80d3afeedae3','tickets.create','web','2026-08-01 23:11:35','2026-08-01 23:11:35'),('019fc150-5474-7021-993f-2eb09614fc0b','tickets.assign','web','2026-08-01 23:11:35','2026-08-01 23:11:35'),('019fc150-5477-7112-9159-4b23d7dc8234','tickets.approve','web','2026-08-01 23:11:35','2026-08-01 23:11:35'),('019fc150-547a-7278-8379-6adbdf6c3895','tickets.reject','web','2026-08-01 23:11:35','2026-08-01 23:11:35'),('019fc150-547f-7249-9905-4cebab7786a4','tickets.update-status','web','2026-08-01 23:11:35','2026-08-01 23:11:35'),('019fc150-5483-7072-90a0-96fc39b40272','tickets.close','web','2026-08-01 23:11:35','2026-08-01 23:11:35'),('019fc150-5487-7123-91ec-39a46d318373','tickets.cancel','web','2026-08-01 23:11:35','2026-08-01 23:11:35'),('019fc150-548b-71ee-b7df-4f40f7d081f7','users.manage','web','2026-08-01 23:11:35','2026-08-01 23:11:35'),('019fc150-548f-7262-9616-c7f1429e0f3d','divisions.manage','web','2026-08-01 23:11:35','2026-08-01 23:11:35'),('019fc150-5493-73ea-a6a8-ccb4817abed8','audit-logs.view','web','2026-08-01 23:11:35','2026-08-01 23:11:35'),('019fc150-5496-7344-85c3-52ad019c8963','reports.view','web','2026-08-01 23:11:35','2026-08-01 23:11:35');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rejection_reasons`
--

DROP TABLE IF EXISTS `rejection_reasons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rejection_reasons` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rejection_reasons`
--

LOCK TABLES `rejection_reasons` WRITE;
/*!40000 ALTER TABLE `rejection_reasons` DISABLE KEYS */;
INSERT INTO `rejection_reasons` VALUES ('019fc150-5567-7065-a21a-bf2412ebd50d','Informasi tiket tidak lengkap',1,'2026-08-01 23:11:35','2026-08-01 23:11:35'),('019fc150-5569-719e-ad0d-c7158f9b26ad','Bukan termasuk aset yang terdaftar di sistem',1,'2026-08-01 23:11:35','2026-08-01 23:11:35'),('019fc150-556b-7034-b14f-b5911b27e6e8','Duplikat dengan tiket lain yang sudah dibuat',1,'2026-08-01 23:11:35','2026-08-01 23:11:35'),('019fc150-556d-7107-854a-3d2e04662631','Di luar tanggung jawab divisi terkait',1,'2026-08-01 23:11:35','2026-08-01 23:11:35'),('019fc150-5570-73f4-987c-4b04ce8f2f40','Kerusakan sudah pernah diperbaiki sebelumnya',1,'2026-08-01 23:11:35','2026-08-01 23:11:35');
/*!40000 ALTER TABLE `rejection_reasons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` VALUES ('019fc150-5458-707f-b629-a29b7346a3c1','019fc150-549d-73a0-8c0b-6f0e94b42c0f'),('019fc150-5460-72a5-ac87-49e7081e4d5f','019fc150-549d-73a0-8c0b-6f0e94b42c0f'),('019fc150-5463-7307-b7dc-479c8ddf0302','019fc150-549d-73a0-8c0b-6f0e94b42c0f'),('019fc150-5466-738f-af17-3e4990ff9bed','019fc150-549d-73a0-8c0b-6f0e94b42c0f'),('019fc150-5468-711e-ae87-597ebcc17489','019fc150-549d-73a0-8c0b-6f0e94b42c0f'),('019fc150-546c-7100-8de0-6acf4bc68da1','019fc150-549d-73a0-8c0b-6f0e94b42c0f'),('019fc150-5471-722c-80c4-80d3afeedae3','019fc150-549d-73a0-8c0b-6f0e94b42c0f'),('019fc150-5474-7021-993f-2eb09614fc0b','019fc150-549d-73a0-8c0b-6f0e94b42c0f'),('019fc150-5477-7112-9159-4b23d7dc8234','019fc150-549d-73a0-8c0b-6f0e94b42c0f'),('019fc150-547a-7278-8379-6adbdf6c3895','019fc150-549d-73a0-8c0b-6f0e94b42c0f'),('019fc150-547f-7249-9905-4cebab7786a4','019fc150-549d-73a0-8c0b-6f0e94b42c0f'),('019fc150-5483-7072-90a0-96fc39b40272','019fc150-549d-73a0-8c0b-6f0e94b42c0f'),('019fc150-5487-7123-91ec-39a46d318373','019fc150-549d-73a0-8c0b-6f0e94b42c0f'),('019fc150-548b-71ee-b7df-4f40f7d081f7','019fc150-549d-73a0-8c0b-6f0e94b42c0f'),('019fc150-548f-7262-9616-c7f1429e0f3d','019fc150-549d-73a0-8c0b-6f0e94b42c0f'),('019fc150-5493-73ea-a6a8-ccb4817abed8','019fc150-549d-73a0-8c0b-6f0e94b42c0f'),('019fc150-5496-7344-85c3-52ad019c8963','019fc150-549d-73a0-8c0b-6f0e94b42c0f'),('019fc150-5458-707f-b629-a29b7346a3c1','019fc150-54af-73e6-8e77-7d40e67bfbff'),('019fc150-5468-711e-ae87-597ebcc17489','019fc150-54af-73e6-8e77-7d40e67bfbff'),('019fc150-547f-7249-9905-4cebab7786a4','019fc150-54af-73e6-8e77-7d40e67bfbff'),('019fc150-5496-7344-85c3-52ad019c8963','019fc150-54af-73e6-8e77-7d40e67bfbff'),('019fc150-5458-707f-b629-a29b7346a3c1','019fc150-54c7-716c-8d47-fe37d747f4b2'),('019fc150-546c-7100-8de0-6acf4bc68da1','019fc150-54c7-716c-8d47-fe37d747f4b2'),('019fc150-5471-722c-80c4-80d3afeedae3','019fc150-54c7-716c-8d47-fe37d747f4b2'),('019fc150-5483-7072-90a0-96fc39b40272','019fc150-54c7-716c-8d47-fe37d747f4b2'),('019fc150-5487-7123-91ec-39a46d318373','019fc150-54c7-716c-8d47-fe37d747f4b2');
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES ('019fc150-549d-73a0-8c0b-6f0e94b42c0f','admin','web','2026-08-01 23:11:35','2026-08-01 23:11:35'),('019fc150-54af-73e6-8e77-7d40e67bfbff','operator','web','2026-08-01 23:11:35','2026-08-01 23:11:35'),('019fc150-54c7-716c-8d47-fe37d747f4b2','user','web','2026-08-01 23:11:35','2026-08-01 23:11:35');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('VDkPwr2pTExy6RA46kHWUVfXjyH5DUt5JgVwqP0Z','019fc150-5697-73da-9df8-5b2c50b40191','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoib3V1Mm41NjFab1NrM3ZFNXpjSUVnZVpPS3R2MGdKZ0VOdzg3WXBzSCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9hc3NldHMiO3M6NToicm91dGUiO3M6MTg6ImFkbWluLmFzc2V0cy5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtzOjM2OiIwMTlmYzE1MC01Njk3LTczZGEtOWRmOC01YjJjNTBiNDAxOTEiO30=',1786331798);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_histories`
--

DROP TABLE IF EXISTS `ticket_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ticket_histories` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ticket_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `actor_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_from` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_to` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `ticket_histories_ticket_id_foreign` (`ticket_id`),
  KEY `ticket_histories_actor_id_foreign` (`actor_id`),
  CONSTRAINT `ticket_histories_actor_id_foreign` FOREIGN KEY (`actor_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT,
  CONSTRAINT `ticket_histories_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket_histories`
--

LOCK TABLES `ticket_histories` WRITE;
/*!40000 ALTER TABLE `ticket_histories` DISABLE KEYS */;
/*!40000 ALTER TABLE `ticket_histories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_priorities`
--

DROP TABLE IF EXISTS `ticket_priorities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ticket_priorities` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sla_hours` int unsigned NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket_priorities`
--

LOCK TABLES `ticket_priorities` WRITE;
/*!40000 ALTER TABLE `ticket_priorities` DISABLE KEYS */;
INSERT INTO `ticket_priorities` VALUES ('019fc150-555b-7244-9ac0-90f9167e1729','Critical',4,1,'2026-08-01 23:11:35','2026-08-01 23:11:35'),('019fc150-555e-70be-8d42-d2b70b3fe952','High',24,1,'2026-08-01 23:11:35','2026-08-01 23:11:35'),('019fc150-5560-7051-bb3b-755b29c3a031','Medium',72,1,'2026-08-01 23:11:35','2026-08-01 23:11:35'),('019fc150-5562-70bb-b697-77d0c3062340','Low',168,1,'2026-08-01 23:11:35','2026-08-01 23:11:35');
/*!40000 ALTER TABLE `ticket_priorities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tickets`
--

DROP TABLE IF EXISTS `tickets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tickets` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ticket_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asset_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `proof_photo_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ticket_priority_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'waiting_approval',
  `assigned_operator_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sla_deadline` timestamp NULL DEFAULT NULL,
  `sla_breached` tinyint(1) NOT NULL DEFAULT '0',
  `rejection_reason_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tickets_ticket_number_unique` (`ticket_number`),
  KEY `tickets_asset_id_foreign` (`asset_id`),
  KEY `tickets_created_by_foreign` (`created_by`),
  KEY `tickets_ticket_priority_id_foreign` (`ticket_priority_id`),
  KEY `tickets_assigned_operator_id_foreign` (`assigned_operator_id`),
  KEY `tickets_rejection_reason_id_foreign` (`rejection_reason_id`),
  CONSTRAINT `tickets_asset_id_foreign` FOREIGN KEY (`asset_id`) REFERENCES `assets` (`id`) ON DELETE RESTRICT,
  CONSTRAINT `tickets_assigned_operator_id_foreign` FOREIGN KEY (`assigned_operator_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `tickets_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE RESTRICT,
  CONSTRAINT `tickets_rejection_reason_id_foreign` FOREIGN KEY (`rejection_reason_id`) REFERENCES `rejection_reasons` (`id`) ON DELETE SET NULL,
  CONSTRAINT `tickets_ticket_priority_id_foreign` FOREIGN KEY (`ticket_priority_id`) REFERENCES `ticket_priorities` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tickets`
--

LOCK TABLES `tickets` WRITE;
/*!40000 ALTER TABLE `tickets` DISABLE KEYS */;
/*!40000 ALTER TABLE `tickets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_notifications`
--

DROP TABLE IF EXISTS `user_notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ticket_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_notifications_user_id_foreign` (`user_id`),
  KEY `user_notifications_ticket_id_foreign` (`ticket_id`),
  CONSTRAINT `user_notifications_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_notifications`
--

LOCK TABLES `user_notifications` WRITE;
/*!40000 ALTER TABLE `user_notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `work_unit_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `login_pertama` tinyint(1) NOT NULL DEFAULT '1',
  `percobaan_gagal` tinyint unsigned NOT NULL DEFAULT '0',
  `terkunci_hingga` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_nik_unique` (`nik`),
  KEY `users_work_unit_id_foreign` (`work_unit_id`),
  CONSTRAINT `users_work_unit_id_foreign` FOREIGN KEY (`work_unit_id`) REFERENCES `work_units` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('019fc150-5697-73da-9df8-5b2c50b40191','019fc150-54f1-72ca-a838-89a5ee9f458e','ADM-2026-001','Admin AdKor','admin@pkt.id','admin',NULL,'$2y$12$aumePM0s7Ty7M3vULyR1cu.tvM/3a/TAOqewgW51JxS9ZOeju4/se',0,0,NULL,NULL,'2026-08-01 23:11:35','2026-08-01 23:11:35'),('019fc150-57c7-710f-9ba6-6e35dd9acea1','019fc150-552a-709b-9e50-00e9d14460a3','OPS-2026-001','Operator Maintenance','operator@pkt.id','operator',NULL,'$2y$12$9OLOrfS5sskpd1.liWYcgO4RD/j9D1HlLuYD3f6IZyGXEHbb70phi',0,0,NULL,NULL,'2026-08-01 23:11:35','2026-08-01 23:11:35'),('019fc150-58e7-7162-bc83-89e12c36560b','019fc150-551e-7232-9adf-32316b0629fb','USR-2026-001','Karyawan Produksi','karyawan@pkt.id','user',NULL,'$2y$12$/8kALuGYS2oL5fYdRAJsueYzsf5VWPMO2FgcsSoW0N8yXhfcp4qB6',0,0,NULL,NULL,'2026-08-01 23:11:36','2026-08-01 23:11:36'),('019fc150-5a08-7378-88f9-90cddae795d2',NULL,'OP001','Operator IT','op@pkt.id','operator',NULL,'$2y$12$iC3LObHR9lct9CLcQMtXhOl.t9SGJCnRNBUpXZ6CTcsRD6G8wAfka',1,0,NULL,NULL,'2026-08-01 23:11:36','2026-08-01 23:11:36'),('019fc150-5b1f-73cb-844e-749226b7be23',NULL,'USR001','Karyawan PKT','user@pkt.id','user',NULL,'$2y$12$6au0r6NfaRhDrkoQ9mK.Y.q22TCVS5rvGMmJV4EbDvVV1i.PUsg2y',1,0,NULL,NULL,'2026-08-01 23:11:36','2026-08-01 23:11:36'),('019fc17a-a26e-7062-97bf-44e9afaffcb9','019fd29c-3980-70a8-bd9f-db1ca525246f','1203071512040002','Andan Riski Mustari','andanriski11@gmail.com','admin',NULL,'$2y$12$4H4p0K3OgJjrDHOj9fwPmeKmaSFcs8Zih/QIStHPDOTzNsJoqpF9G',1,0,NULL,NULL,'2026-08-01 23:57:47','2026-08-09 17:38:23');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `work_unit_asset_statuses`
--

DROP TABLE IF EXISTS `work_unit_asset_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `work_unit_asset_statuses` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `work_unit_asset_statuses_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `work_unit_asset_statuses`
--

LOCK TABLES `work_unit_asset_statuses` WRITE;
/*!40000 ALTER TABLE `work_unit_asset_statuses` DISABLE KEYS */;
INSERT INTO `work_unit_asset_statuses` VALUES ('019fd27d-2248-7060-b670-7f665cefa2b8','Aktif Digunakan','active',1,1,'2026-08-05 07:14:04','2026-08-05 07:14:04'),('019fd27d-22d8-7240-8955-199b2f028834','Di Gudang','in_storage',1,2,'2026-08-05 07:14:04','2026-08-05 07:14:04'),('019fd27d-22db-7157-ab94-d2e8739c23b8','Dalam Perbaikan','maintenance',1,3,'2026-08-05 07:14:04','2026-08-05 07:14:04'),('019fd27d-22de-7365-a2c7-af693cc41bc0','Rusak','damaged',1,4,'2026-08-05 07:14:04','2026-08-05 07:14:04'),('019fd27d-22e1-706c-9294-4efa1208f924','Dihapuskan','disposed',1,5,'2026-08-05 07:14:04','2026-08-05 07:14:04');
/*!40000 ALTER TABLE `work_unit_asset_statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `work_unit_histories`
--

DROP TABLE IF EXISTS `work_unit_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `work_unit_histories` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_work_unit_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `to_work_unit_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `changed_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reason` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `work_unit_histories_user_id_foreign` (`user_id`),
  KEY `work_unit_histories_from_work_unit_id_foreign` (`from_work_unit_id`),
  KEY `work_unit_histories_to_work_unit_id_foreign` (`to_work_unit_id`),
  KEY `work_unit_histories_changed_by_foreign` (`changed_by`),
  CONSTRAINT `work_unit_histories_changed_by_foreign` FOREIGN KEY (`changed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `work_unit_histories_from_work_unit_id_foreign` FOREIGN KEY (`from_work_unit_id`) REFERENCES `work_units` (`id`) ON DELETE SET NULL,
  CONSTRAINT `work_unit_histories_to_work_unit_id_foreign` FOREIGN KEY (`to_work_unit_id`) REFERENCES `work_units` (`id`) ON DELETE SET NULL,
  CONSTRAINT `work_unit_histories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `work_unit_histories`
--

LOCK TABLES `work_unit_histories` WRITE;
/*!40000 ALTER TABLE `work_unit_histories` DISABLE KEYS */;
INSERT INTO `work_unit_histories` VALUES ('019fc150-56a0-71a4-92de-3f20c41569af','019fc150-5697-73da-9df8-5b2c50b40191',NULL,'019fc150-54f1-72ca-a838-89a5ee9f458e','019fc150-5697-73da-9df8-5b2c50b40191','Initial assign','2026-08-01 23:11:35','2026-08-01 23:11:35'),('019fc150-57ce-739b-9f41-d915c0edf44a','019fc150-57c7-710f-9ba6-6e35dd9acea1',NULL,'019fc150-552a-709b-9e50-00e9d14460a3','019fc150-5697-73da-9df8-5b2c50b40191','Initial assign','2026-08-01 23:11:35','2026-08-01 23:11:35'),('019fc150-58ee-7188-b3d8-472c3ab4e6d9','019fc150-58e7-7162-bc83-89e12c36560b',NULL,'019fc150-551e-7232-9adf-32316b0629fb','019fc150-5697-73da-9df8-5b2c50b40191','Initial assign','2026-08-01 23:11:36','2026-08-01 23:11:36');
/*!40000 ALTER TABLE `work_unit_histories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `work_units`
--

DROP TABLE IF EXISTS `work_units`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `work_units` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `work_units_department_id_foreign` (`department_id`),
  CONSTRAINT `work_units_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `work_units`
--

LOCK TABLES `work_units` WRITE;
/*!40000 ALTER TABLE `work_units` DISABLE KEYS */;
INSERT INTO `work_units` VALUES ('019fc150-54ed-72ad-989f-33dfe7fc32c5','019fc150-54e7-701f-8ab8-866b6b6c8911','Unit Jaringan',0,'2026-08-01 23:11:35','2026-08-05 07:22:55'),('019fc150-54f1-72ca-a838-89a5ee9f458e','019fc150-54e7-701f-8ab8-866b6b6c8911','Unit Server & Cloud',0,'2026-08-01 23:11:35','2026-08-05 07:22:58'),('019fc150-54f8-7031-9ea7-e55a43a50ea0','019fc150-54f5-7242-b458-831b56c26625','Unit ERP',0,'2026-08-01 23:11:35','2026-08-05 07:23:00'),('019fc150-54fc-72c6-878f-a7da7fa3ca8d','019fc150-54f5-7242-b458-831b56c26625','Unit Aplikasi Bisnis',0,'2026-08-01 23:11:35','2026-08-05 07:23:02'),('019fc150-5506-7162-8cbf-d071b8abfd9f','019fc150-5503-7091-8148-f6946f285fb1','Unit Operasional Diklat',0,'2026-08-01 23:11:35','2026-08-05 07:23:04'),('019fc150-5509-72dc-87e4-612b11d3f2bc','019fc150-5503-7091-8148-f6946f285fb1','Unit Perencanaan Diklat',0,'2026-08-01 23:11:35','2026-08-05 07:23:06'),('019fc150-550f-72c3-864d-280fe04715bc','019fc150-550c-702d-b721-f997b384320e','Unit Administrasi Karyawan',0,'2026-08-01 23:11:35','2026-08-05 07:23:09'),('019fc150-5512-7195-a634-65cc8a8053be','019fc150-550c-702d-b721-f997b384320e','Unit Payroll',0,'2026-08-01 23:11:35','2026-08-05 08:03:36'),('019fc150-551e-7232-9adf-32316b0629fb',NULL,'Kompartemen Operasi Pabrik',0,'2026-08-01 23:11:35','2026-08-05 08:03:15'),('019fc150-5521-70d3-b8eb-1ea3ecbd331c','019fc150-551a-7196-a5ec-de733aaf301a','Unit Shift B',0,'2026-08-01 23:11:35','2026-08-05 08:03:22'),('019fc150-5527-7181-8c5a-9dcde1a63c7f','019fc150-5524-72d1-83d9-0b157e637a21','Unit Kontrol',0,'2026-08-01 23:11:35','2026-08-05 07:22:52'),('019fc150-552a-709b-9e50-00e9d14460a3','019fc150-5524-72d1-83d9-0b157e637a21','Unit Maintenance Dasar',0,'2026-08-01 23:11:35','2026-08-05 07:22:47'),('019fd294-eb4c-7043-bd49-aaa881657b09',NULL,'Kompartemen Operasi Pabrik',0,'2026-08-05 07:40:02','2026-08-05 08:03:02'),('019fd29c-3889-70d4-84d1-db68fff0484c','019fd29c-3881-72fc-add4-ef6e452f384a',NULL,1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-388f-713d-b04e-a35bf34b78e0','019fd29c-388d-73e9-8f06-b4202c53e1ee',NULL,1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-3894-73cc-9a08-9e27e3cb9fa9','019fd29c-3892-704c-86de-c6e42331d64e',NULL,1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-3899-710a-88b0-a520e2cdbc60','019fd29c-3897-73e0-965a-f7926e8c3318',NULL,1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-389e-70ee-a275-94cb5cb1eeff','019fd29c-389c-711d-ab73-ec73dd039c2c',NULL,1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-38a4-712c-84aa-91537006dde6','019fd29c-38a1-7027-a123-5e6633cec66a',NULL,1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-38a9-705b-8aca-6a5bbf7e49b6','019fd29c-38a7-70f9-8422-2d4e8d96a4fc',NULL,1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-38b0-7339-a59a-037a5e929b0e','019fd29c-38ae-7206-a412-efd7dcbb75ab',NULL,1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-38b6-710d-98d7-cd53c7179f01','019fd29c-38b3-7050-8307-59859fa1727a',NULL,1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-38bb-70f5-aafc-7c9bf621d345','019fd29c-38b8-7303-ad26-fdaed292afb4',NULL,1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-38c0-7240-803c-491abbc248b8','019fd29c-38be-7090-bc69-c149ad1a9245',NULL,1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-38c6-720b-a51a-7612b9d40949','019fd29c-38c3-72f5-91ba-96d6017b6306',NULL,1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-38ce-71b4-aa2d-972427a80a13','019fd29c-38cb-734e-a974-33c376b9221f',NULL,1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-38d3-73f3-8cd5-41f07925cc61','019fd29c-38d0-71b2-b7d5-cae49e554892',NULL,1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-38db-7018-86a2-f43e0cf78525','019fd29c-38d8-72e9-ac80-0e41f1ab70d5',NULL,1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-38e1-7199-8f30-fc999d83b793','019fd29c-38de-7397-b059-06de94518ba7',NULL,1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-38e6-72e6-9c40-f87bc4643b61','019fd29c-38e3-7374-9e6a-2e157f77bb9e',NULL,1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-38ee-710e-8201-f37fcdd267d8','019fd29c-38eb-7287-9f9c-4902f2e25851',NULL,1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-38f3-71df-ac58-151578c459b8','019fd29c-38f0-7300-a363-09a1541599c8',NULL,1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-38fa-72dd-9cd4-4f7b4333cde8','019fd29c-38f8-713c-b61c-95dc258c0816',NULL,1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-3900-707e-8659-89db3cabdb48','019fd29c-38fd-73f1-8bf9-f4c505c2a0d7',NULL,1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-3905-73fe-95f2-2ff4d4eea80e','019fd29c-3902-71b7-a9d7-7e0f32dbf9d8',NULL,1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-390c-7193-905a-d54329eb6bf1','019fd29c-3909-7378-a22a-79a87a206bf2',NULL,1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-3912-73ff-adb2-8032430d5d07','019fd29c-390f-711f-a9a9-b436a739cd86',NULL,1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-3916-70d1-801a-f21354601755','019fd29c-3914-713b-ac30-6688357be371',NULL,1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-391d-7322-a92d-6c1467292584','019fd29c-391b-72bf-b41f-3125f014e332',NULL,1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-3922-7251-9644-a5b82d2a6116','019fd29c-3920-7266-b37c-94c4ac2900e7',NULL,1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-3927-73c4-8fb5-6990669f6f9e','019fd29c-3925-7294-ae27-6ed47843aa8b',NULL,1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-392c-72b4-a4b6-f256c2393152','019fd29c-392a-71c9-a296-d618e78563c6',NULL,1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-3933-7045-a4c1-e8314395857d','019fd29c-3931-7202-9b69-8dcf905d5703',NULL,1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-3937-71ce-a317-b3618fd3e6d2','019fd29c-3935-71b1-b4ca-f82cb7aa5746',NULL,1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-393c-723e-b2ff-d565626d534d','019fd29c-393a-7351-af96-7e6394f21cd7',NULL,1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-3943-73ee-b800-6808d04aaf56','019fd29c-3940-73e3-8f52-4ea8cc3e033f',NULL,1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-3949-728d-8002-c37147e2f7e5','019fd29c-3946-7057-8186-ebf08d0650ea',NULL,1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-394e-73c0-8513-2f0efbf16fda','019fd29c-394c-728b-b7b8-be574e2f0987',NULL,1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-3955-7079-aeb8-9900a8821a25','019fd29c-3952-71b5-b10e-d5e73ee3a608',NULL,1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-395a-7252-a295-e5d6632020ae','019fd29c-3957-7193-aaa6-7d3697ff285c',NULL,1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-395f-7325-a34f-f7a4fe191b4b','019fd29c-395d-708a-a6c8-b0ec7301ff4a',NULL,1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-3966-7202-a3e5-21e39e475c6a','019fd29c-3964-737a-ab7f-2312eb1a1735',NULL,1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-396b-7251-8e8a-5b00c277e4f9','019fd29c-3968-73e9-ac13-6667dc076ba3',NULL,1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-3972-7059-810a-cfe452493a07','019fd29c-396f-714d-a74e-33d28ff26d17',NULL,1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-3976-72c7-bf25-93740d122c23','019fd29c-3974-712c-89a0-5cb0a0555232',NULL,1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-397b-7106-bcc8-527822d9123b','019fd29c-3978-7302-ac73-c9e9f447fd8b',NULL,1,'2026-08-05 07:48:01','2026-08-05 07:48:01'),('019fd29c-3980-70a8-bd9f-db1ca525246f','019fd29c-397e-72fe-952d-afdc5cfa58ad',NULL,1,'2026-08-05 07:48:01','2026-08-05 07:48:01');
/*!40000 ALTER TABLE `work_units` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-08-10 14:44:31

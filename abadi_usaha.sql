/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 10.4.32-MariaDB : Database - abadi_usaha
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`abadi_usaha` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `abadi_usaha`;

/*Table structure for table `cache` */

DROP TABLE IF EXISTS `cache`;

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `cache` */

/*Table structure for table `cache_locks` */

DROP TABLE IF EXISTS `cache_locks`;

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `cache_locks` */

/*Table structure for table `detail_pemesanan` */

DROP TABLE IF EXISTS `detail_pemesanan`;

CREATE TABLE `detail_pemesanan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pemesanan_id` int(11) DEFAULT NULL,
  `pekerja_id` int(11) DEFAULT NULL,
  `verifikasi` varchar(15) DEFAULT NULL,
  `alasan` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `detail_pemesanan` */

insert  into `detail_pemesanan`(`id`,`pemesanan_id`,`pekerja_id`,`verifikasi`,`alasan`) values 
(2,9,3,NULL,NULL),
(3,9,9,NULL,NULL),
(4,9,10,NULL,NULL);

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `gaji` */

DROP TABLE IF EXISTS `gaji`;

CREATE TABLE `gaji` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `pemesanan_id` int(11) DEFAULT NULL,
  `pendapatan` bigint(20) DEFAULT NULL,
  `gaji_karyawan` bigint(20) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `gaji` */

/*Table structure for table `job_batches` */

DROP TABLE IF EXISTS `job_batches`;

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `job_batches` */

/*Table structure for table `jobs` */

DROP TABLE IF EXISTS `jobs`;

CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `jobs` */

/*Table structure for table `layanan` */

DROP TABLE IF EXISTS `layanan`;

CREATE TABLE `layanan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_layanan` varchar(255) DEFAULT NULL,
  `harga` bigint(20) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `layanan` */

insert  into `layanan`(`id`,`nama_layanan`,`harga`,`keterangan`,`icon`,`updated_at`,`created_at`) values 
(2,'Pelancaran',550000,'Kami menyediakan layanan sedot WC cepat, bersih, dan profesional untuk rumah tangga, kantor, restoran, maupun gedung komersial. Tim kami menggunakan peralatan modern dan aman, memastikan penyedotan dilakukan secara tuntas tanpa menimbulkan bau atau kerusakan pada saluran pembuangan. Layanan ini juga mencakup pemeriksaan tangki septik serta perawatan berkala untuk mencegah masalah di kemudian hari.',NULL,'2025-10-20 06:25:33',NULL),
(8,'Sedot WC',700000,'Kami melayani pelancaran saluran air, wastafel, kamar mandi, dan pembuangan yang tersumbat menggunakan alat bertekanan tinggi. Dikerjakan oleh tenaga ahli berpengalaman, proses dilakukan dengan cepat dan tanpa merusak instalasi pipa. Cocok untuk Anda yang mengalami masalah saluran mampet di rumah, kantor, atau tempat usaha dengan hasil yang bersih dan tahan lama.','1760331760_audit.png','2025-10-20 06:25:41','2025-10-13 05:02:40');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'0001_01_01_000000_create_users_table',1),
(2,'0001_01_01_000001_create_cache_table',1),
(3,'0001_01_01_000002_create_jobs_table',1),
(4,'2025_10_20_153845_create_personal_access_tokens_table',2);

/*Table structure for table `password_reset_tokens` */

DROP TABLE IF EXISTS `password_reset_tokens`;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_reset_tokens` */

/*Table structure for table `pemesanan` */

DROP TABLE IF EXISTS `pemesanan`;

CREATE TABLE `pemesanan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `nama_pemesan` varchar(255) DEFAULT NULL,
  `layanan_id` int(11) DEFAULT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `detail_alamat` text DEFAULT NULL,
  `status` varchar(10) DEFAULT 'pending',
  `harga` bigint(20) DEFAULT 0,
  `ongkir` bigint(20) DEFAULT 0,
  `testimoni_id` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pemesanan` */

insert  into `pemesanan`(`id`,`user_id`,`nama_pemesan`,`layanan_id`,`no_telp`,`alamat`,`detail_alamat`,`status`,`harga`,`ongkir`,`testimoni_id`,`updated_at`,`created_at`) values 
(7,NULL,'abel',2,'08646789','kediri',NULL,'pending',10000,0,0,'2025-10-13 05:59:31','2025-10-13 05:59:31'),
(8,7,'Reprehenderit omnis',2,'081203801','Politeknik Negeri Malang Kediri',NULL,'selesai',550000,0,0,'2025-10-20 17:39:30','2025-10-13 07:46:09'),
(9,7,'faiz',8,'08123456','Kota, Kediri City, East Java, Java, 64124, Indonesia',NULL,'proses',700000,0,0,'2025-10-20 17:07:13','2025-10-13 07:47:10');

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  KEY `personal_access_tokens_expires_at_index` (`expires_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `sessions` */

DROP TABLE IF EXISTS `sessions`;

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sessions` */

insert  into `sessions`(`id`,`user_id`,`ip_address`,`user_agent`,`payload`,`last_activity`) values 
('Mk0achw9NJj3osDA9NTrPgcuClJqTPyWZOdFXIdR',8,'192.168.1.65','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSjY0cW5mT0p1VmlpN0JEM3hxSFg0bGVBYmNVT29CMkIyVFcwMThUdSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xOTIuMTY4LjEuNjU6ODAwMC9hZG1pbi9wZW1lc2FuYW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo4O30=',1760982670);

/*Table structure for table `testimoni` */

DROP TABLE IF EXISTS `testimoni`;

CREATE TABLE `testimoni` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `id_pemesanan` int(11) DEFAULT NULL,
  `komentar` text DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `testimoni` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `job` varchar(255) DEFAULT NULL,
  `no_rekening` varchar(20) DEFAULT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`role`,`status`,`job`,`no_rekening`,`no_telp`,`alamat`,`gambar`,`remember_token`,`created_at`,`updated_at`) values 
(3,'Pak Anam','anamjr@gmail.com',NULL,'$2y$12$P9MO9mcSJyBgCK8Ee2nkkeXFG7qNN7ilD6UjhVBtYBaburuLgenKa','petugas','Sedia','Petugas Biasa','987536788','081238',NULL,'1760936474_macan 2.png',NULL,'2025-10-13 05:08:45','2025-10-20 15:01:22'),
(7,'faiz','faiz@gmail.com',NULL,'$2y$12$57W7D41Jq8qcBQyG/fOuFOsC3fqhJt3CPrUaD/vSf5ftqmwzHU1pO','pemesan',NULL,NULL,NULL,'08123456','jl oke','foto_profil/1Az41Aw1WZfzhB7U2f6GxHkSkIhTAwR0TuXK9cp8.jpg',NULL,'2025-10-13 05:23:08','2025-10-15 14:31:44'),
(8,'admin','admin@gmail.com',NULL,'$2y$12$8P/w6JjWG0OEkJ3gilp2H.Ql9e8Y0Hi5fQNODQ0Ozum53mqxcGVhK','admin',NULL,NULL,NULL,'081332795308',NULL,NULL,NULL,'2025-10-13 05:32:17','2025-10-13 05:32:17'),
(9,'Pak Chandra','chandra@gmail.com',NULL,'$2y$12$0W7eItgyZJhOheHXAHpZiO18vTbjiOH3vQLt98rT2Z2PgaNshSYZ2','petugas','Sedia','Supir','81723812793','0182031',NULL,'1760345889_video.png',NULL,'2025-10-13 08:58:09','2025-10-13 08:59:05'),
(10,'Pak Agus','agus@gmail.com',NULL,'$2y$12$wdnIDWPMd4t86gGB6NZ1p.8lc8Ze0/Vo3meGWz3r6GKUqI3bNGvd2','petugas','Sedia','Supir','273487239','08123123',NULL,'1760345936_loading.png',NULL,'2025-10-13 08:58:56','2025-10-13 08:59:11'),
(11,'abellya','abel@gmail.com',NULL,'$2y$12$/0F7D16KO8fS83LZKUSoRepBEQkZA2C3ZkRDg86x19idL9PC.TFd.','pemesan',NULL,NULL,NULL,'097653678',NULL,NULL,NULL,'2025-10-20 04:49:50','2025-10-20 04:49:50');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

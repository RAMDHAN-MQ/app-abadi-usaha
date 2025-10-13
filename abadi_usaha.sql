/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 10.4.32-MariaDB-log : Database - abadi_usaha
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
  `verivikasi` varchar(15) DEFAULT NULL,
  `alasan` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `detail_pemesanan` */

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

insert  into `gaji`(`id`,`user_id`,`pemesanan_id`,`pendapatan`,`gaji_karyawan`,`status`,`update_at`,`created_at`) values 
(1,3,7,1000000,50000,'Belum Dibayar',NULL,NULL);

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
(2,'Pelancaran',6000000,'qoweioqwieoqwie',NULL,NULL,NULL),
(4,'asdasd',123123,'asdasd','1759830338_person-4096070_1280.jpg','2025-10-07 09:45:38','2025-10-07 09:45:38'),
(5,'aaaaaa',5555,'sdfqqqqqqqqqqq','1759830405_Screenshot (209).png','2025-10-13 01:23:58','2025-10-07 09:46:45'),
(8,'Sedot WC',700000,'sedot mas','1760331760_audit.png','2025-10-13 05:02:40','2025-10-13 05:02:40');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'0001_01_01_000000_create_users_table',1),
(2,'0001_01_01_000001_create_cache_table',1),
(3,'0001_01_01_000002_create_jobs_table',1);

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
  `no_telp` bigint(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `detail_alamat` text DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `harga` bigint(20) DEFAULT NULL,
  `ongkir` bigint(20) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pemesanan` */

insert  into `pemesanan`(`id`,`user_id`,`nama_pemesan`,`layanan_id`,`no_telp`,`alamat`,`detail_alamat`,`status`,`harga`,`ongkir`,`updated_at`,`created_at`) values 
(7,NULL,'abel',2,8646789,'kediri',NULL,'pending',10000,NULL,'2025-10-13 05:59:31','2025-10-13 05:59:31'),
(8,7,'Reprehenderit omnis',2,81203801,'Politeknik Negeri Malang Kediri',NULL,NULL,NULL,NULL,'2025-10-13 07:46:09','2025-10-13 07:46:09'),
(9,7,'faiz',8,8123456,'Kota, Kediri City, East Java, Java, 64124, Indonesia',NULL,NULL,NULL,NULL,'2025-10-13 07:47:10','2025-10-13 07:47:10');

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
('5s34duIX6KkLgWbxbFd9E0RDoR9nTDLQIdozLuN1',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVjdwM2I2Z1dXSlhQcUlPd3I3TUVRQjJOaVB1TjN6RVU5alJIMWs1YSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9yZWdpc3RyYXNpIjt9czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0NDoiaHR0cDovL2xvY2FsaG9zdDo4MDAwL3BlbWVzYW4vZm9ybS1wZW1lc2FuYW4iO319',1760343570),
('bwP2KJcO23n32PkcZGxhpPpOqLHBRVn2MX2KiYMW',8,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiYTFTbUNhZjJNV0VRdEFoYkhnUUYwd3dtTjVvZ21JMGtjQmtHMEozOCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9wZW1lc2FuYW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjM6InVybCI7YTowOnt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6ODt9',1760346436),
('txHNHUibPvSErmLcaRBPpzvEuSo2Oj1o5fwK96nz',8,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiV2V0RzRtVW9JeFJPd0lteVJiVmFBM1poODRaemh5SVRwNTVETVBxRyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wZW1lc2FuL2Zvcm0tcGVtZXNhbmFuIjt9czozOiJ1cmwiO2E6MDp7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjg7fQ==',1760346842);

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
  `no_rekening` bigint(20) DEFAULT NULL,
  `no_telp` bigint(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`role`,`status`,`job`,`no_rekening`,`no_telp`,`alamat`,`gambar`,`remember_token`,`created_at`,`updated_at`) values 
(3,'Pak Anam','anamjr@gmail.com',NULL,'$2y$12$7mQGUK0q93On8Yri3Wy8AuRskJJd9srjbHjZ1IJKPazku2uL/Gewu','petugas','Sedia','Petugas Biasa',987536788,NULL,NULL,'1760332125_icon_large.png',NULL,'2025-10-13 05:08:45','2025-10-13 08:57:14'),
(7,'faiz','faiz@gmail.com',NULL,'$2y$12$57W7D41Jq8qcBQyG/fOuFOsC3fqhJt3CPrUaD/vSf5ftqmwzHU1pO','pemesan',NULL,NULL,NULL,8123456,'jl oke','foto_profil/sfIgRpZ5jpYJ8rtyawBrLMOazOJQvwlOHvjzYM5p.png',NULL,'2025-10-13 05:23:08','2025-10-13 08:01:57'),
(8,'admin','admin@gmail.com',NULL,'$2y$12$8P/w6JjWG0OEkJ3gilp2H.Ql9e8Y0Hi5fQNODQ0Ozum53mqxcGVhK','admin',NULL,NULL,NULL,81332795308,NULL,NULL,NULL,'2025-10-13 05:32:17','2025-10-13 05:32:17'),
(9,'Pak Chandra','chandra@gmail.com',NULL,'$2y$12$0W7eItgyZJhOheHXAHpZiO18vTbjiOH3vQLt98rT2Z2PgaNshSYZ2','petugas','Sedia','Supir',81723812793,NULL,NULL,'1760345889_video.png',NULL,'2025-10-13 08:58:09','2025-10-13 08:59:05'),
(10,'Pak Agus','agus@gmail.com',NULL,'$2y$12$wdnIDWPMd4t86gGB6NZ1p.8lc8Ze0/Vo3meGWz3r6GKUqI3bNGvd2','petugas','Sedia','Supir',273487239,NULL,NULL,'1760345936_loading.png',NULL,'2025-10-13 08:58:56','2025-10-13 08:59:11');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

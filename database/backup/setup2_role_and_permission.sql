-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 21, 2023 at 09:25 AM
-- Server version: 8.0.31
-- PHP Version: 8.1.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `setup2_role_and_permission`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2023_10_31_042221_create_settings_table', 1),
(5, '2023_11_30_064737_create_permission_tables', 1),
(6, '2023_11_30_072146_create_roles_table', 1),
(7, '2023_11_30_075648_create_users_table', 1),
(8, '2023_11_30_075758_create_permission_users_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `slug`, `description`, `model`, `created_at`, `updated_at`) VALUES
(1, 'Index Role', 'role.index', 'User can view role menu', 'Role', '2023-12-01 07:51:30', '2023-12-01 07:51:30'),
(2, 'Show Role', 'role.show', 'User can view role details', 'Role', '2023-12-01 07:51:30', '2023-12-01 07:51:30'),
(3, 'Create Role', 'role.create', 'User can create new role', 'Role', '2023-12-01 07:51:30', '2023-12-01 07:51:30'),
(4, 'Edit Role', 'role.edit', 'User can edit role details', 'Role', '2023-12-01 07:51:30', '2023-12-01 07:51:30'),
(5, 'Delete Role', 'role.destroy', 'User can delete role', 'Role', '2023-12-01 07:51:30', '2023-12-01 07:51:30'),
(6, 'Active/Inactive Role', 'role.status', 'User can change role status', 'Role', '2023-12-01 07:51:30', '2023-12-01 07:51:30'),
(7, 'Index User', 'user.index', 'User can view user menu', 'User', '2023-12-01 07:51:30', '2023-12-01 07:51:30'),
(8, 'Show User', 'user.show', 'User can view user details', 'User', '2023-12-01 07:51:30', '2023-12-01 07:51:30'),
(9, 'Create User', 'user.create', 'User can create new user', 'User', '2023-12-01 07:51:30', '2023-12-01 07:51:30'),
(10, 'Edit User', 'user.edit', 'User can edit user details', 'User', '2023-12-01 07:51:30', '2023-12-01 07:51:30'),
(11, 'Delete User', 'user.destroy', 'User can delete user', 'User', '2023-12-01 07:51:30', '2023-12-01 07:51:30'),
(12, 'Active/Inactive User', 'user.status', 'User can change user status', 'User', '2023-12-01 07:51:30', '2023-12-01 07:51:30'),
(13, 'Index User Profile', 'profile.index', 'User can view user profile', 'Profile', '2023-12-01 07:51:30', '2023-12-01 07:51:30'),
(14, 'Edit User Edit', 'profile.edit', 'User can edit user profile', 'Profile', '2023-12-01 07:51:30', '2023-12-01 07:51:30'),
(15, 'Index Web-setting', 'websetting.index', 'User can view web-setting', 'Web-setting', '2023-12-01 07:51:30', '2023-12-01 07:51:30');

-- --------------------------------------------------------

--
-- Table structure for table `permission_users`
--

DROP TABLE IF EXISTS `permission_users`;
CREATE TABLE IF NOT EXISTS `permission_users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `permission_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permission_users_permission_id_foreign` (`permission_id`),
  KEY `permission_users_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_users`
--

INSERT INTO `permission_users` (`id`, `permission_id`, `user_id`, `created_at`, `updated_at`) VALUES
(21, 13, 2, NULL, NULL),
(22, 14, 2, NULL, NULL),
(25, 7, 2, NULL, NULL),
(28, 9, 2, NULL, NULL),
(50, 1, 4, NULL, NULL),
(56, 7, 4, NULL, NULL),
(62, 13, 4, NULL, NULL),
(63, 14, 4, NULL, NULL),
(68, 13, 5, NULL, NULL),
(69, 14, 5, NULL, NULL),
(70, 13, 3, NULL, NULL),
(71, 14, 3, NULL, NULL),
(72, 8, 2, NULL, NULL),
(73, 12, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 - inactive | 1 - active',
  `added_by` bigint UNSIGNED NOT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `status`, `added_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Super admin', 1, 1, NULL, NULL, '2023-12-01 03:20:22', '2023-12-01 03:20:22'),
(2, 'Vendor', 1, 1, NULL, NULL, '2023-12-01 03:20:22', '2023-12-01 07:24:49'),
(3, 'User', 1, 1, NULL, NULL, '2023-12-01 05:53:35', '2023-12-08 02:14:01');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `favicon` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `title`, `logo`, `favicon`, `created_at`, `updated_at`) VALUES
(1, 'Setup2 Role And Permission', '79880.jpg', '60327.png', '2023-12-01 06:05:21', '2023-12-21 02:51:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 - inactive | 1 - active',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_view` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `added_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `status`, `password`, `password_view`, `email_verified_at`, `added_by`, `updated_by`, `remember_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', 'admin@gmail.com', 1, '$2y$10$0mCwQ/B9cRWuG.rtWfyW6OWBNFbjoeqvKlJr2xQPOoU008EM8hr6K', '123456789', NULL, 1, NULL, NULL, NULL, '2023-12-01 03:20:22', '2023-12-01 03:20:22'),
(2, 2, 'vendor', 'vendor@gmail.com', 1, '$2y$10$o.X642M8ASEnFr5W/yy3l.SViiO8QNm88g2VewoV8EnLbZ6qkXe56', '123456789', NULL, 1, 1, NULL, NULL, '2023-12-01 03:20:22', '2023-12-08 01:27:23'),
(3, 3, 'Nevada Simmons', 'feke@mailinator.com', 0, '$2y$10$tIsoKtlWNC2IVlzGrfNgKeOs/hqHI9eUss9EdszmB0M8LtlnO83sG', '123456789', NULL, NULL, 1, NULL, NULL, '2023-12-01 04:54:29', '2023-12-08 02:13:49'),
(4, 3, 'Kishan', 'k@g', 1, '$2y$10$X9IqrTqXWgONhM.bSrimJ.2PcC82JVUMqm0F0QWVuf/XOcITOfLdO', '123456789', NULL, NULL, 1, '', NULL, '2023-12-01 05:54:15', '2023-12-08 02:24:49'),
(5, 3, 'Jade Pennington', 'nuromedyta@mailinator.com', 0, '$2y$10$KpEoA4CGA1rRlE.7sWGl3OopJ47EGOTR5AeVQDipTJCcuhS2co1Py', '123456789', NULL, NULL, 1, NULL, NULL, '2023-12-08 00:49:20', '2023-12-08 02:13:49');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `permission_users`
--
ALTER TABLE `permission_users`
  ADD CONSTRAINT `permission_users_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`),
  ADD CONSTRAINT `permission_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

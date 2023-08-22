-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2023 at 07:25 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stomatolozi_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_04_14_000003_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_05_03_000001_create_customer_columns', 1),
(4, '2019_05_03_000002_create_subscriptions_table', 1),
(5, '2019_05_03_000003_create_subscription_items_table', 1),
(6, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(7, '2023_04_14_000001_create_permissions_table', 1),
(8, '2023_04_14_000002_create_roles_table', 1),
(9, '2023_04_14_000004_create_zaposlenicis_table', 1),
(10, '2023_04_14_000005_create_pacjentis_table', 1),
(11, '2023_04_14_000006_create_terminus_table', 1),
(12, '2023_04_14_000007_create_permission_role_pivot_table', 1),
(13, '2023_04_14_000008_create_role_user_pivot_table', 1),
(14, '2023_04_14_000009_add_relationship_fields_to_terminus_table', 1),
(15, '2023_04_17_052004_create_plans_table', 1),
(16, '2023_05_03_165222_add_country_code_to_pacjentis_table', 1),
(17, '2023_05_06_223113_add_user_id_to_terminus_table', 1),
(18, '2023_05_07_095401_create_jobs_table', 1),
(19, '2023_05_08_173959_add_selected_teeth_to_terminus_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `pacjentis`
--

CREATE TABLE `pacjentis` (
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `country_code` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pacjentis`
--

INSERT INTO `pacjentis` (`user_id`, `id`, `name`, `email`, `country_code`, `phone`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Luciano Grmovšek', 'luciano.grmovsek@protonmail.com', '385', '919727091', '2023-05-08 11:33:30', '2023-05-24 06:23:50', '2023-05-24 06:23:50'),
(1, 2, 'Usama', 'usama.hassan577@gmail.com', '92', '3020051955', '2023-05-11 16:25:50', '2023-05-24 06:23:50', '2023-05-24 06:23:50'),
(1, 3, 'Luciano 2', 'luciano.grmovsek@protonmail.com', '385', '919727091', '2023-05-12 08:19:24', '2023-05-24 06:23:50', '2023-05-24 06:23:50'),
(1, 4, 'Luciano Grmovšek', 'luciano.grmovsek@protonmail.com', NULL, '919727091', '2023-05-24 06:27:48', '2023-05-24 06:37:33', '2023-05-24 06:37:33'),
(1, 5, 'Luciano Grmovšek', 'luciano.grmovsek@protonmail.com', '385', '992934827', '2023-05-24 06:37:48', '2023-05-24 10:42:11', NULL),
(1, 6, 'Usama', 'usama.hassan577@gmail.com', '92', '3177904512', '2023-05-24 14:44:06', '2023-06-01 07:13:53', '2023-06-01 07:13:53'),
(1, 7, 'Marko Markovic', 'marko_markovic@gmail.com', '385', '9988774', '2023-07-06 08:17:24', '2023-07-06 08:17:24', NULL),
(5, 8, 'Luciano Grmovsek', 'luciano123123@gmail.com', '385', '992934827', '2023-07-17 14:32:17', '2023-07-17 14:32:17', NULL),
(5, 9, 'Zvonimir Jurković', 'asfljdghlaskdfgj@askldjlas.com', '385', '915304621', '2023-07-17 14:35:36', '2023-07-17 14:35:36', NULL),
(1, 10, 'Neven', 'neven1@sadas.com', '385', '98233711', '2023-07-19 13:46:04', '2023-07-19 13:46:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'user_management_access', NULL, NULL, NULL),
(2, 'permission_create', NULL, NULL, NULL),
(3, 'permission_edit', NULL, NULL, NULL),
(4, 'permission_show', NULL, NULL, NULL),
(5, 'permission_delete', NULL, NULL, NULL),
(6, 'permission_access', NULL, NULL, NULL),
(7, 'role_create', NULL, NULL, NULL),
(8, 'role_edit', NULL, NULL, NULL),
(9, 'role_show', NULL, NULL, NULL),
(10, 'role_delete', NULL, NULL, NULL),
(11, 'role_access', NULL, NULL, NULL),
(12, 'user_create', NULL, NULL, NULL),
(13, 'user_edit', NULL, NULL, NULL),
(14, 'user_show', NULL, NULL, NULL),
(15, 'user_delete', NULL, NULL, NULL),
(16, 'user_access', NULL, NULL, NULL),
(17, 'zaposlenici_create', NULL, NULL, NULL),
(18, 'zaposlenici_edit', NULL, NULL, NULL),
(19, 'zaposlenici_show', NULL, NULL, NULL),
(20, 'zaposlenici_delete', NULL, NULL, NULL),
(21, 'zaposlenici_access', NULL, NULL, NULL),
(22, 'pacjenti_create', NULL, NULL, NULL),
(23, 'pacjenti_edit', NULL, NULL, NULL),
(24, 'pacjenti_show', NULL, NULL, NULL),
(25, 'pacjenti_delete', NULL, NULL, NULL),
(26, 'pacjenti_access', NULL, NULL, NULL),
(27, 'terminu_create', NULL, NULL, NULL),
(28, 'terminu_edit', NULL, NULL, NULL),
(29, 'terminu_show', NULL, NULL, NULL),
(30, 'terminu_delete', NULL, NULL, NULL),
(31, 'terminu_access', NULL, NULL, NULL),
(32, 'profile_password_edit', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 22),
(1, 23),
(1, 24),
(1, 25),
(1, 26),
(1, 27),
(1, 28),
(1, 29),
(1, 30),
(1, 31),
(1, 32),
(2, 17),
(2, 18),
(2, 19),
(2, 20),
(2, 21),
(2, 22),
(2, 23),
(2, 24),
(2, 25),
(2, 26),
(2, 27),
(2, 28),
(2, 29),
(2, 30),
(2, 31),
(2, 32);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `stripe_plan` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `name`, `slug`, `stripe_plan`, `price`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Pretplata', 'pretplata', 'price_1MxtUDDZvpInnoCnCq6b161y', 40, 'Pretplata Basic Plan', '2023-06-09 04:48:22', '2023-06-09 04:48:22');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', NULL, NULL, NULL),
(2, 'User', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 1),
(2, 2),
(3, 2),
(4, 2),
(5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `stripe_id` varchar(255) NOT NULL,
  `stripe_status` varchar(255) NOT NULL,
  `stripe_price` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  `ends_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `user_id`, `name`, `stripe_id`, `stripe_status`, `stripe_price`, `quantity`, `trial_ends_at`, `ends_at`, `created_at`, `updated_at`) VALUES
(1, 5, 'default', 'sub_1NUsRvDZvpInnoCncbaHeQwp', 'active', 'price_1MxtUDDZvpInnoCnCq6b161y', 1, '2023-07-20 14:30:55', NULL, '2023-07-17 14:30:58', '2023-07-20 14:32:32');

-- --------------------------------------------------------

--
-- Table structure for table `subscription_items`
--

CREATE TABLE `subscription_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subscription_id` bigint(20) UNSIGNED NOT NULL,
  `stripe_id` varchar(255) NOT NULL,
  `stripe_product` varchar(255) NOT NULL,
  `stripe_price` varchar(255) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscription_items`
--

INSERT INTO `subscription_items` (`id`, `subscription_id`, `stripe_id`, `stripe_product`, `stripe_price`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 'si_OHRKXb2xbJIRq9', 'prod_NjMC7D6vBqHhcW', 'price_1MxtUDDZvpInnoCnCq6b161y', 1, '2023-07-17 14:30:58', '2023-07-17 14:30:58');

-- --------------------------------------------------------

--
-- Table structure for table `terminus`
--

CREATE TABLE `terminus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `start_time` datetime NOT NULL,
  `finish_time` datetime NOT NULL,
  `komentar` longtext DEFAULT NULL,
  `allow_notifications` int(11) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `pacjent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `zaposlenik_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `selected_teeth` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `terminus`
--

INSERT INTO `terminus` (`id`, `start_time`, `finish_time`, `komentar`, `allow_notifications`, `created_at`, `updated_at`, `deleted_at`, `pacjent_id`, `zaposlenik_id`, `user_id`, `selected_teeth`) VALUES
(1, '2023-05-08 13:30:00', '2023-05-08 13:45:00', NULL, 1, '2023-05-08 13:33:42', '2023-05-24 06:23:37', '2023-05-24 06:23:37', 1, NULL, 1, NULL),
(2, '2023-05-08 13:30:00', '2023-05-08 13:45:00', NULL, 1, '2023-05-08 13:34:55', '2023-05-24 06:23:37', '2023-05-24 06:23:37', 1, NULL, 1, NULL),
(3, '2023-05-08 13:45:00', '2023-05-08 13:45:00', NULL, 1, '2023-05-08 13:43:53', '2023-05-24 06:23:37', '2023-05-24 06:23:37', 1, 1, 1, NULL),
(4, '2023-05-08 13:45:00', '2023-05-08 13:45:00', NULL, 1, '2023-05-08 13:43:53', '2023-05-24 06:23:37', '2023-05-24 06:23:37', 1, 1, 1, NULL),
(5, '2023-05-08 14:00:00', '2023-05-08 15:15:00', NULL, 1, '2023-05-08 13:45:55', '2023-05-24 06:23:37', '2023-05-24 06:23:37', 1, 1, 1, NULL),
(6, '2023-05-08 14:00:00', '2023-05-08 14:15:00', NULL, 1, '2023-05-08 13:49:08', '2023-05-24 06:23:37', '2023-05-24 06:23:37', 1, 1, 1, NULL),
(7, '2023-05-08 14:15:00', '2023-05-08 14:30:00', NULL, 1, '2023-05-08 14:06:41', '2023-05-24 06:23:37', '2023-05-24 06:23:37', 1, 1, 1, NULL),
(8, '2023-05-08 14:15:00', '2023-05-08 14:30:00', NULL, 1, '2023-05-08 14:15:26', '2023-05-24 06:23:37', '2023-05-24 06:23:37', 1, 1, 1, NULL),
(9, '2023-05-08 14:15:00', '2023-05-08 14:15:00', NULL, 1, '2023-05-08 14:19:07', '2023-05-24 06:23:37', '2023-05-24 06:23:37', 1, 1, 1, NULL),
(10, '2023-05-08 14:15:00', '2023-05-08 14:15:00', NULL, 1, '2023-05-08 14:21:48', '2023-05-24 06:23:37', '2023-05-24 06:23:37', 1, 1, 1, NULL),
(11, '2023-05-08 20:00:00', '2023-05-08 20:15:00', NULL, 1, '2023-05-08 19:51:22', '2023-05-24 06:23:37', '2023-05-24 06:23:37', 1, 1, 1, '[]'),
(12, '2023-05-08 20:15:00', '2023-05-08 20:30:00', NULL, 1, '2023-05-08 20:03:47', '2023-05-24 06:23:37', '2023-05-24 06:23:37', 1, 1, 1, '[]'),
(13, '2023-05-08 20:15:00', '2023-05-08 20:30:00', NULL, 1, '2023-05-08 20:05:19', '2023-05-24 06:23:37', '2023-05-24 06:23:37', 1, 1, 1, '[]'),
(14, '2023-05-08 20:30:00', '2023-05-08 20:45:00', NULL, 1, '2023-05-08 20:10:02', '2023-05-24 06:23:37', '2023-05-24 06:23:37', 1, 1, 1, '[\"13\",\"42\"]'),
(15, '2023-05-08 20:15:00', '2023-05-08 20:30:00', 'Radimo vađenje zuba (14, 42, 32)', 1, '2023-05-08 20:10:47', '2023-05-24 06:23:37', '2023-05-24 06:23:37', 1, 1, 1, '[\"14\",\"42\",\"32\"]'),
(16, '2023-05-09 20:30:00', '2023-05-09 21:30:00', NULL, 1, '2023-05-08 20:33:19', '2023-05-24 06:23:37', '2023-05-24 06:23:37', 1, 1, 1, '[\"12\",\"21\",\"42\"]'),
(17, '2023-05-11 18:15:00', '2023-05-11 18:30:00', NULL, 1, '2023-05-11 18:19:23', '2023-05-24 06:23:37', '2023-05-24 06:23:37', 1, 1, 1, '[]'),
(18, '2023-05-11 21:30:00', '2023-05-11 21:30:00', 'asdfjasdf', 1, '2023-05-11 18:27:00', '2023-05-24 06:23:37', '2023-05-24 06:23:37', 2, 1, 1, '[]'),
(19, '2023-05-11 21:30:00', '2023-05-11 21:30:00', 'asdfjasdf', 1, '2023-05-11 18:27:59', '2023-05-24 06:23:37', '2023-05-24 06:23:37', 2, 1, 1, '[]'),
(20, '2023-05-11 21:30:00', '2023-05-11 21:30:00', 'lklfasdf', 1, '2023-05-11 18:28:59', '2023-05-24 06:23:37', '2023-05-24 06:23:37', 2, 1, 1, '[]'),
(21, '2023-05-11 21:30:00', '2023-05-11 21:30:00', 'lklfasdf', 1, '2023-05-11 18:30:14', '2023-05-11 16:58:56', '2023-05-11 16:58:56', 2, 1, 1, '[]'),
(22, '2023-05-11 21:30:00', '2023-05-11 21:30:00', 'lklfasdf', 1, '2023-05-11 18:32:17', '2023-05-11 16:58:56', '2023-05-11 16:58:56', 2, 1, 1, '[]'),
(23, '2023-05-11 21:30:00', '2023-05-11 21:30:00', 'lklfasdf', 1, '2023-05-11 18:33:03', '2023-05-11 16:58:56', '2023-05-11 16:58:56', 2, 1, 1, '[]'),
(24, '2023-05-11 21:30:00', '2023-05-11 21:30:00', 'lklfasdf', 1, '2023-05-11 18:33:48', '2023-05-11 16:58:56', '2023-05-11 16:58:56', 2, 1, 1, '[]'),
(25, '2023-05-11 21:30:00', '2023-05-11 21:30:00', 'asfd', 1, '2023-05-11 18:36:00', '2023-05-11 16:58:56', '2023-05-11 16:58:56', 2, 1, 1, '[]'),
(26, '2023-05-11 21:30:00', '2023-05-11 21:30:00', 'asfd', 1, '2023-05-11 18:36:45', '2023-05-11 16:58:56', '2023-05-11 16:58:56', 2, 1, 1, '[]'),
(27, '2023-05-11 21:30:00', '2023-05-11 21:30:00', 'asfd', 1, '2023-05-11 18:39:33', '2023-05-11 16:58:56', '2023-05-11 16:58:56', 2, 1, 1, '[]'),
(28, '2023-05-11 21:30:00', '2023-05-11 21:30:00', 'asfd', 1, '2023-05-11 18:39:51', '2023-05-11 16:58:56', '2023-05-11 16:58:56', 2, 1, 1, '[]'),
(29, '2023-05-11 21:30:00', '2023-05-11 21:30:00', 'asfd', 1, '2023-05-11 18:40:34', '2023-05-11 16:58:56', '2023-05-11 16:58:56', 2, 1, 1, '[]'),
(30, '2023-05-11 21:30:00', '2023-05-11 21:30:00', 'asfd', 1, '2023-05-11 18:41:06', '2023-05-11 16:58:56', '2023-05-11 16:58:56', 2, 1, 1, '[]'),
(31, '2023-05-11 18:45:00', '2023-05-11 19:00:00', NULL, 1, '2023-05-11 18:42:21', '2023-05-11 16:43:04', '2023-05-11 16:43:04', 1, 1, 1, '[]'),
(32, '2023-05-11 21:30:00', '2023-05-11 21:30:00', 'asfd', 1, '2023-05-11 18:43:50', '2023-05-11 16:58:56', '2023-05-11 16:58:56', 2, 1, 1, '[]'),
(33, '2023-05-11 21:45:00', '2023-05-11 21:45:00', 'Appintment', 1, '2023-05-11 18:44:32', '2023-05-11 16:58:56', '2023-05-11 16:58:56', 1, 1, 1, '[]'),
(34, '2023-05-11 18:45:00', '2023-05-11 19:00:00', NULL, 1, '2023-05-11 18:46:30', '2023-05-11 16:58:56', '2023-05-11 16:58:56', 1, 1, 1, '[]'),
(35, '2023-05-11 18:45:00', '2023-05-11 19:00:00', NULL, 1, '2023-05-11 18:47:21', '2023-05-11 16:58:56', '2023-05-11 16:58:56', 1, 1, 1, '[]'),
(36, '2023-05-11 21:45:00', '2023-05-11 21:45:00', 'asdfasdf', 1, '2023-05-11 18:48:41', '2023-05-11 16:58:56', '2023-05-11 16:58:56', 2, 1, 1, '[]'),
(37, '2023-05-12 18:45:00', '2023-05-12 19:00:00', NULL, 1, '2023-05-11 18:50:15', '2023-05-11 16:58:56', '2023-05-11 16:58:56', 1, 1, 1, '[]'),
(38, '2023-05-11 21:45:00', '2023-05-11 21:45:00', 'asdf', 1, '2023-05-11 18:52:14', '2023-05-11 16:58:56', '2023-05-11 16:58:56', 1, 1, 1, '[]'),
(39, '2023-05-11 21:45:00', '2023-05-11 21:45:00', 'asdf', 1, '2023-05-11 18:53:03', '2023-05-11 16:58:56', '2023-05-11 16:58:56', 1, 1, 1, '[]'),
(40, '2023-05-11 21:45:00', '2023-05-11 21:45:00', 'asdf', 1, '2023-05-11 18:54:56', '2023-05-11 16:58:56', '2023-05-11 16:58:56', 1, 1, 1, '[]'),
(41, '2023-05-11 21:45:00', '2023-05-11 21:45:00', 'asdf', 1, '2023-05-11 18:56:47', '2023-05-11 16:58:56', '2023-05-11 16:58:56', 1, 1, 1, '[]'),
(42, '2023-05-11 21:45:00', '2023-05-11 21:45:00', 'asdf', 1, '2023-05-11 18:57:26', '2023-05-11 16:58:56', '2023-05-11 16:58:56', 1, 1, 1, '[]'),
(43, '2023-05-11 21:45:00', '2023-05-11 21:45:00', 'asdf', 1, '2023-05-11 18:57:57', '2023-05-11 16:58:56', '2023-05-11 16:58:56', 1, 1, 1, '[]'),
(44, '2023-05-11 21:45:00', '2023-05-11 21:45:00', 'asdf', 1, '2023-05-11 18:59:42', '2023-05-24 06:23:37', '2023-05-24 06:23:37', 1, 1, 1, '[]'),
(45, '2023-05-11 21:45:00', '2023-05-11 21:45:00', 'asdf', 1, '2023-05-11 19:02:47', '2023-05-24 06:23:37', '2023-05-24 06:23:37', 1, 1, 1, '[]'),
(46, '2023-05-11 21:45:00', '2023-05-11 21:45:00', 'asdf', 1, '2023-05-11 19:05:36', '2023-05-24 06:23:37', '2023-05-24 06:23:37', 1, 1, 1, '[]'),
(47, '2023-05-11 21:45:00', '2023-05-11 21:45:00', 'asdf', 1, '2023-05-11 19:09:22', '2023-05-24 06:23:37', '2023-05-24 06:23:37', 1, 1, 1, '[]'),
(48, '2023-05-11 21:45:00', '2023-05-11 21:45:00', 'asdf', 1, '2023-05-11 19:12:44', '2023-05-24 06:23:37', '2023-05-24 06:23:37', 1, 1, 1, '[]'),
(49, '2023-05-11 22:15:00', '2023-05-11 22:15:00', 'asldfkj', 1, '2023-05-11 19:18:43', '2023-05-24 06:23:37', '2023-05-24 06:23:37', 1, 1, 1, '[]'),
(50, '2023-05-13 19:30:00', '2023-05-13 20:30:00', NULL, 1, '2023-05-11 19:26:33', '2023-05-24 06:23:37', '2023-05-24 06:23:37', 1, 1, 1, '[]'),
(51, '2023-05-11 22:15:00', '2023-05-11 22:15:00', 'asldfkj', 1, '2023-05-11 19:29:41', '2023-05-24 06:23:37', '2023-05-24 06:23:37', 1, 1, 1, '[]'),
(52, '2023-05-12 19:30:00', '2023-05-12 20:30:00', 'Hah', 1, '2023-05-11 19:34:03', '2023-05-24 06:23:37', '2023-05-24 06:23:37', 1, 1, 1, '[]'),
(53, '2023-05-11 22:15:00', '2023-05-11 22:15:00', 'asldfkj', 1, '2023-05-11 19:35:33', '2023-05-24 06:23:37', '2023-05-24 06:23:37', 1, 1, 1, '[]'),
(54, '2023-05-12 19:30:00', '2023-05-12 20:30:00', NULL, 1, '2023-05-11 19:35:43', '2023-05-24 06:23:37', '2023-05-24 06:23:37', 1, 1, 1, '[\"14\"]'),
(55, '2023-05-12 10:30:00', '2023-05-12 10:45:00', NULL, 1, '2023-05-12 10:19:48', '2023-05-24 06:23:37', '2023-05-24 06:23:37', 3, 1, 1, '[]'),
(56, '2023-05-13 18:45:00', '2023-05-13 18:50:00', NULL, 1, '2023-05-13 18:51:26', '2023-05-24 06:23:37', '2023-05-24 06:23:37', 3, 1, 1, '[\"12\"]'),
(57, '2023-05-25 09:00:00', '2023-05-25 09:30:00', NULL, 1, '2023-05-24 09:06:38', '2023-05-25 06:54:05', '2023-05-25 06:54:05', 5, 1, 1, '[]'),
(58, '2023-05-26 09:30:00', '2023-05-26 10:00:00', 'testni komentar', 1, '2023-05-24 09:08:12', '2023-05-25 06:54:05', '2023-05-25 06:54:05', 5, 1, 1, '[]'),
(59, '2023-05-26 09:15:00', '2023-05-26 09:45:00', 'kbjkhb', 1, '2023-05-24 09:08:57', '2023-05-25 06:54:05', '2023-05-25 06:54:05', 5, 1, 1, '[\"12\",\"11\",\"46\"]'),
(60, '2023-05-26 12:45:00', '2023-05-26 13:15:00', 'assdads', 1, '2023-05-24 12:42:29', '2023-05-25 06:54:05', '2023-05-25 06:54:05', 5, 1, 1, '[\"11\",\"41\",\"33\"]'),
(61, '2023-05-24 13:45:00', '2023-05-24 14:15:00', NULL, 1, '2023-05-24 12:45:54', '2023-05-25 06:54:05', '2023-05-25 06:54:05', 5, 1, 1, '[]'),
(62, '2023-05-24 16:15:00', '2023-05-24 16:45:00', NULL, 1, '2023-05-24 16:17:26', '2023-05-25 06:54:05', '2023-05-25 06:54:05', 5, 1, 1, '[]'),
(63, '2023-05-24 16:15:00', '2023-05-24 16:45:00', NULL, 1, '2023-05-24 16:19:45', '2023-05-25 06:54:05', '2023-05-25 06:54:05', 5, 1, 1, '[]'),
(64, '2023-05-25 16:15:00', '2023-05-25 16:45:00', NULL, 1, '2023-05-24 16:20:26', '2023-05-25 06:54:05', '2023-05-25 06:54:05', 5, 1, 1, '[]'),
(65, '2023-05-25 16:15:00', '2023-05-25 16:45:00', NULL, 1, '2023-05-24 16:22:13', '2023-05-25 06:54:05', '2023-05-25 06:54:05', 5, 1, 1, '[]'),
(66, '2023-05-26 16:15:00', '2023-05-26 16:45:00', 'Testni komentar', 1, '2023-05-24 16:23:01', '2023-05-25 06:54:05', '2023-05-25 06:54:05', 5, 1, 1, '[\"16\",\"13\",\"21\",\"42\",\"32\",\"35\",\"38\"]'),
(67, '2023-05-24 19:26:00', '2023-05-24 20:15:00', '2023-05-24 18:26 || 2023-05-24 18:27', 1, '2023-05-24 16:45:36', '2023-05-25 06:54:05', '2023-05-25 06:54:05', 6, 1, 1, '[]'),
(68, '2023-05-24 22:45:00', '2023-05-24 23:15:00', 'Check', 1, '2023-05-24 18:30:21', '2023-05-25 06:54:05', '2023-05-25 06:54:05', 6, 1, 1, '[]'),
(69, '2023-05-24 22:45:00', '2023-05-24 23:15:00', 'asdflkasdf', 1, '2023-05-24 18:32:26', '2023-05-25 06:54:05', '2023-05-25 06:54:05', 5, 1, 1, '[]'),
(70, '2023-05-24 22:45:00', '2023-05-24 23:15:00', 'asdflkasdf', 1, '2023-05-24 18:34:10', '2023-05-25 06:54:05', '2023-05-25 06:54:05', 5, 1, 1, '[]'),
(71, '2023-05-24 22:45:00', '2023-05-24 23:15:00', 'asdflkasdf', 1, '2023-05-24 18:36:33', '2023-05-25 06:54:05', '2023-05-25 06:54:05', 5, 1, 1, '[]'),
(72, '2023-05-24 22:45:00', '2023-05-24 23:15:00', 'asdflkasdf', 1, '2023-05-24 18:39:46', '2023-05-25 06:54:05', '2023-05-25 06:54:05', 5, 1, 1, '[]'),
(73, '2023-05-24 22:45:00', '2023-05-24 23:15:00', 'asdflkasdf', 1, '2023-05-24 18:40:06', '2023-05-25 06:54:05', '2023-05-25 06:54:05', 5, 1, 1, '[]'),
(74, '2023-05-24 22:45:00', '2023-05-24 23:15:00', 'asdflkasdf', 1, '2023-05-24 18:40:26', '2023-05-25 06:54:05', '2023-05-25 06:54:05', 5, 1, 1, '[]'),
(75, '2023-05-24 22:45:00', '2023-05-24 23:15:00', 'asdflkasdf', 1, '2023-05-24 18:41:02', '2023-05-25 06:54:05', '2023-05-25 06:54:05', 5, 1, 1, '[]'),
(82, '2023-05-24 22:00:00', '2023-05-24 23:30:00', '2023-05-24 21:00 || 2023-05-25 08:54', 1, '2023-05-24 18:49:34', '2023-05-25 06:54:05', '2023-05-25 06:54:05', 6, 1, 1, '[]'),
(83, '2023-05-24 23:00:00', '2023-05-24 23:30:00', NULL, 1, '2023-05-24 21:45:02', '2023-05-25 06:54:05', '2023-05-25 06:54:05', 5, 1, 1, '[\"14\",\"13\"]'),
(84, '2023-05-25 22:30:00', '2023-05-25 23:00:00', NULL, 1, '2023-05-24 23:29:12', '2023-05-25 06:54:05', '2023-05-25 06:54:05', 5, 1, 1, '[]'),
(85, '2023-05-25 10:00:00', '2023-05-25 10:30:00', NULL, 1, '2023-05-25 08:54:28', '2023-05-25 06:55:39', '2023-05-25 06:55:39', 5, 1, 1, '[]'),
(86, '2023-05-25 10:30:00', '2023-05-25 11:00:00', 'Testni komenatr samo da vidmo što će se prikazati unutar aplikacije.j', 1, '2023-05-25 09:16:08', '2023-05-25 07:37:46', NULL, 5, 1, 1, '[]'),
(87, '2023-05-25 09:45:00', '2023-05-25 10:15:00', 'asdasdf', 1, '2023-05-25 09:38:34', '2023-05-25 09:38:34', NULL, 5, 1, 1, '[\"13\",\"42\"]'),
(88, '2023-05-29 14:00:00', '2023-05-29 14:30:00', 'teasd', 1, '2023-05-28 13:56:07', '2023-05-28 13:56:07', NULL, 5, 1, 1, '[\"18\",\"48\",\"41\"]'),
(89, '2023-05-28 15:15:00', '2023-05-28 15:45:00', 'sad', 1, '2023-05-28 14:11:40', '2023-05-28 12:16:32', NULL, 5, 1, 1, '[\"18\"]'),
(90, '2023-06-14 10:15:00', '2023-06-14 10:45:00', 'testni komentar', 1, '2023-06-13 10:12:08', '2023-06-13 08:12:35', '2023-06-13 08:12:35', 5, 1, 1, '[\"18\",\"45\"]'),
(91, '2023-07-18 14:15:00', '2023-07-18 14:45:00', 'balabal', 1, '2023-07-17 12:24:02', '2023-07-17 12:24:02', NULL, 5, 1, 1, '[\"16\"]'),
(92, '2023-07-17 16:30:00', '2023-07-17 17:15:00', 'ahdsbahsd', 1, '2023-07-17 16:33:29', '2023-07-17 16:33:29', NULL, 8, 3, 5, '[\"13\",\"31\"]'),
(93, '2023-07-18 15:30:00', '2023-07-18 16:00:00', 'endodoncija pk', 1, '2023-07-17 16:36:20', '2023-07-17 16:36:20', NULL, 9, 2, 5, '[\"23\"]'),
(94, '2023-07-19 17:00:00', '2023-07-19 17:30:00', 'fdfdsfsd', 1, '2023-07-17 16:39:56', '2023-07-20 11:02:18', NULL, 8, 2, 5, '[]'),
(95, '2023-07-21 13:00:00', '2023-07-22 13:30:00', 'dasidjasiodhsauidhasuihduiadasidjasiodhsauidh', 1, '2023-07-20 13:01:39', '2023-08-14 18:40:04', NULL, 5, NULL, 1, '[]'),
(96, '2023-07-21 13:00:00', '2023-07-22 13:30:00', 'dasidjasiodhsauidhasuihduiadasidjasiodhsauidhasuihduiadasidjasiodhsauidhasuihduiadasidjasiodhsauidhasuihduiadasidjasiodhsauidhasuihduiadasidjasiodhsauidhasuihduiadasidjasiodhsauidhasuihduiadasidjasiodhsauidhasuihduiadasidjasiodhsauidhasuihduiadasidjasiodhsauidhasuihduiadasidjasiodhsauidhasuihduiadasidjasiodhsauidhasuihduiadasidjasiodhsauidhasuihduiadasidjasiodhsauidhasuihduiadasidjasiodhsauidhasuihduiadasidjasiodhsauidhasuihduia', 1, '2023-07-20 13:01:49', '2023-07-20 13:01:49', NULL, 5, 1, 1, '[\"48\"]'),
(97, '2023-07-21 14:15:00', '2023-07-21 14:45:00', NULL, 1, '2023-07-21 11:08:32', '2023-07-21 11:08:32', NULL, 10, 1, 1, '[\"11\"]'),
(99, '2023-08-15 11:00:00', '2023-08-15 11:30:00', NULL, 1, '2023-08-14 20:24:17', '2023-08-14 20:24:17', NULL, 5, 4, 1, '[]'),
(102, '2023-08-16 09:30:00', '2023-08-16 10:00:00', NULL, 1, '2023-08-15 04:08:51', '2023-08-15 04:08:51', NULL, 7, 1, 1, '[]'),
(113, '2023-08-16 12:00:00', '2023-08-16 13:30:00', NULL, 1, '2023-08-16 08:27:17', '2023-08-16 08:27:17', NULL, 7, 4, 1, '[]'),
(114, '2023-08-03 08:30:00', '2023-08-03 09:30:00', NULL, 1, '2023-08-16 08:32:24', '2023-08-16 08:32:24', NULL, 10, 1, 1, '[]'),
(122, '2023-08-17 09:00:00', '2023-08-17 10:00:00', NULL, 1, '2023-08-17 06:00:52', '2023-08-17 06:00:52', NULL, 5, 1, 1, '[]'),
(126, '2023-08-17 09:00:00', '2023-08-17 10:00:00', NULL, 1, '2023-08-17 07:19:08', '2023-08-17 07:19:08', NULL, 7, 4, 1, '[]'),
(140, '2023-08-22 08:00:00', '2023-08-22 08:30:00', '123', 1, '2023-08-21 21:09:43', '2023-08-21 21:09:43', NULL, 7, 1, 1, '[\"14\"]'),
(147, '2023-08-22 08:00:00', '2023-08-22 08:30:00', '123', 1, '2023-08-21 21:39:49', '2023-08-21 21:39:49', NULL, 5, 1, 1, '[\"17\"]');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `clinic_name` varchar(255) DEFAULT NULL,
  `clinic_address` varchar(255) DEFAULT NULL,
  `clinic_phone` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `stripe_id` varchar(255) DEFAULT NULL,
  `pm_type` varchar(255) DEFAULT NULL,
  `pm_last_four` varchar(4) DEFAULT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `clinic_name`, `clinic_address`, `clinic_phone`, `created_at`, `updated_at`, `deleted_at`, `stripe_id`, `pm_type`, `pm_last_four`, `trial_ends_at`) VALUES
(1, 'Admin', 'admin@admin.com', NULL, '$2y$10$kYzm1rrIZVirLAzgfKcVG.TUNC/GVLUaTWkVyLnR1Ohxp1tJ2hzLW', 'YVA9eivZzxQpm0HmIhDBcIcyw1yw9PKxLcNJq9xmN8i1lPY5alP8Qde0SubK', 'Grmovsek clinic', 'Velebitska 19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'test', 'test1@gmail.com', NULL, '$2y$10$1lwX0vJ9bmnAmTCVDAljuOA9G1jQtjMT0QrTNpF9NQXuorR6PvTmy', NULL, 'Testna ordinacija', 'masda', NULL, '2023-05-24 14:12:13', '2023-06-08 13:53:22', '2023-06-08 13:53:22', NULL, NULL, NULL, NULL),
(3, 'Jay Test', 'user@user.com', NULL, '$2y$10$PmGewqD7utbPtBCCOurDLulYYVUtlqYzbYC1zgC/kMTKz.9V5B/Ly', 'LC4qii7mxphifH3V3lBtIIgUjyv203dndBpPyAkyecwLRbI7FzWXoZBR77kl', 'Manager', 'erghe', NULL, '2023-06-09 04:50:16', '2023-06-09 04:50:16', NULL, NULL, NULL, NULL, NULL),
(4, 'Test1', 'test1@test1.com', NULL, '$2y$10$DmdMqZbiivs52p9KEZrh7eRSFMW5xNaN2d4XEW.aZLzN9AMbMwqOC', NULL, 'Test1', 'Maslenicka 8', NULL, '2023-06-12 08:59:56', '2023-06-12 09:12:50', NULL, 'cus_O4FI9aPHFRkduL', NULL, NULL, NULL),
(5, 'Luka Lubina', 'lukalubina@gmail.com', NULL, '$2y$10$05IuDFjlLOdOc2ZwBVZW6.QbGQUMXi1nf4zOItvDEjfzNudPmYsWK', NULL, 'Ordinacija Lubina', 'Gospina 7', NULL, '2023-07-17 14:25:59', '2023-07-17 14:26:33', NULL, 'cus_OHRGIpICmpEhX1', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `zaposlenicis`
--

CREATE TABLE `zaposlenicis` (
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `zaposlenicis`
--

INSERT INTO `zaposlenicis` (`user_id`, `id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Josipa Lubina', '2023-05-08 11:43:41', '2023-05-08 11:43:41', NULL),
(5, 2, 'Josipa Lubina', '2023-07-17 14:31:40', '2023-07-17 14:31:40', NULL),
(5, 3, 'Luka Lubina', '2023-07-17 14:31:51', '2023-07-17 14:31:51', NULL),
(1, 4, 'Ivan Simic', '2023-08-17 04:40:22', '2023-08-17 04:40:22', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pacjentis`
--
ALTER TABLE `pacjentis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pacjentis_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD KEY `role_id_fk_8318717` (`role_id`),
  ADD KEY `permission_id_fk_8318717` (`permission_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD KEY `user_id_fk_8318726` (`user_id`),
  ADD KEY `role_id_fk_8318726` (`role_id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subscriptions_stripe_id_unique` (`stripe_id`),
  ADD KEY `subscriptions_user_id_stripe_status_index` (`user_id`,`stripe_status`);

--
-- Indexes for table `subscription_items`
--
ALTER TABLE `subscription_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subscription_items_subscription_id_stripe_price_unique` (`subscription_id`,`stripe_price`),
  ADD UNIQUE KEY `subscription_items_stripe_id_unique` (`stripe_id`);

--
-- Indexes for table `terminus`
--
ALTER TABLE `terminus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pacjent_fk_8318788` (`pacjent_id`),
  ADD KEY `zaposlenik_fk_8318789` (`zaposlenik_id`),
  ADD KEY `terminus_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_stripe_id_index` (`stripe_id`);

--
-- Indexes for table `zaposlenicis`
--
ALTER TABLE `zaposlenicis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `zaposlenicis_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `pacjentis`
--
ALTER TABLE `pacjentis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subscription_items`
--
ALTER TABLE `subscription_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `terminus`
--
ALTER TABLE `terminus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `zaposlenicis`
--
ALTER TABLE `zaposlenicis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pacjentis`
--
ALTER TABLE `pacjentis`
  ADD CONSTRAINT `pacjentis_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_id_fk_8318717` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_id_fk_8318717` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_id_fk_8318726` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_id_fk_8318726` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `terminus`
--
ALTER TABLE `terminus`
  ADD CONSTRAINT `pacjent_fk_8318788` FOREIGN KEY (`pacjent_id`) REFERENCES `pacjentis` (`id`),
  ADD CONSTRAINT `terminus_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `zaposlenik_fk_8318789` FOREIGN KEY (`zaposlenik_id`) REFERENCES `zaposlenicis` (`id`);

--
-- Constraints for table `zaposlenicis`
--
ALTER TABLE `zaposlenicis`
  ADD CONSTRAINT `zaposlenicis_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 25, 2023 at 06:36 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_venues`
--

CREATE TABLE `admin_venues` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zipcode` varchar(255) DEFAULT NULL,
  `createdby` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_venues`
--

INSERT INTO `admin_venues` (`id`, `name`, `address`, `city`, `state`, `zipcode`, `createdby`, `deleted_at`, `created_at`, `updated_at`) VALUES
(5, 'abc', 'acb', 'acb', 'abc', 'acb', 1, '2023-11-05 10:54:07', '2023-11-05 09:40:31', '2023-11-05 10:54:07'),
(6, 'update', 'Omnis ad quaerat iru', 'Consequatur sunt ani', 'Ea qui delectus non', '80557', 1, '2023-11-05 10:54:13', '2023-11-05 09:52:33', '2023-11-05 10:54:13'),
(7, ',ajhsd', 'Anim aut dolor labor', 'Quia molestias anim', 'Eius perferendis exe', '17429', 1, '2023-11-05 10:58:38', '2023-11-05 10:57:17', '2023-11-05 10:58:38'),
(8, 'Hoyt Hawkins', 'Est quia sit velit', 'Enim aperiam ad nost', 'Exercitation totam i', '15063', 1, '2023-11-05 10:58:43', '2023-11-05 10:58:31', '2023-11-05 10:58:43'),
(9, 'Sylvester Diaz', 'test', 'test', 'test', 'test', 10, NULL, '2023-11-15 10:48:04', '2023-11-15 10:48:04');

-- --------------------------------------------------------

--
-- Table structure for table `customer_venues`
--

CREATE TABLE `customer_venues` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ContactPerson` varchar(255) NOT NULL,
  `ContactEmail` varchar(255) DEFAULT NULL,
  `ContactPhone` varchar(255) NOT NULL,
  `admin_venue_id` bigint(20) UNSIGNED DEFAULT NULL,
  `createdby` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_venues`
--

INSERT INTO `customer_venues` (`id`, `ContactPerson`, `ContactEmail`, `ContactPhone`, `admin_venue_id`, `createdby`, `deleted_at`, `created_at`, `updated_at`) VALUES
(6, 'Et exercitationem es', 'vokec@mailinator.com', '+1 (363) 595-2075', 5, 1, '2023-11-05 09:51:50', '2023-11-05 09:40:31', '2023-11-05 09:51:50'),
(7, 'Et consequat Tempor', 'dyty@mailinator.com', '+1 (461) 792-8508', 6, 1, '2023-11-05 10:50:12', '2023-11-05 09:52:33', '2023-11-05 10:50:12'),
(8, 'Cumque sed nihil sed', 'bufe@mailinator.com', '+1 (956) 279-9741', 7, 1, '2023-11-05 10:57:23', '2023-11-05 10:57:17', '2023-11-05 10:57:23'),
(9, 'Voluptate eius ut no', 'ajsdna@gmail.com', '(323) 232-3232', 9, 10, NULL, '2023-11-15 10:48:04', '2023-11-20 04:40:20'),
(17, 'Magni rerum et qui e', 'gitujyhi@mailinator.com', '+1 (171) 295-7923', 9, 12, NULL, '2023-11-18 02:11:56', '2023-11-18 02:11:56'),
(18, 'In irure iste delect', 'nerawuwevu@mailinator.com', '+1 (955) 766-5183', 9, 13, NULL, '2023-11-18 12:15:03', '2023-11-18 12:15:03'),
(19, 'Eveniet molestiae m', 'kymywypu@mailinator.com', '(324) 234-2342', 9, 14, NULL, '2023-11-19 01:03:46', '2023-11-19 01:03:46');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guests` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `occasion` varchar(255) NOT NULL,
  `start_time` varchar(255) NOT NULL,
  `end_time` varchar(255) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `createdby` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `guests`, `type`, `date`, `occasion`, `start_time`, `end_time`, `deleted_at`, `created_at`, `updated_at`, `createdby`) VALUES
(1, 'Vernon Stevenson', '926', 'abc', '2001-11-01', 'abc', '00:00:00', '00:50:00', '2023-11-06 07:10:14', '2023-11-06 06:32:31', '2023-11-06 07:10:14', NULL),
(2, 'Kirby Bell', '83', 'abc', '1995-05-06', 'abc', '00:37:00', '23:58:59', '2023-11-06 07:10:22', '2023-11-06 06:35:09', '2023-11-06 07:10:22', NULL),
(3, 'Mia Rojas', '998', 'Necessitatibus modi', '2023-11-30', 'Debitis maxime irure', '12:00 AM', '12:00 AM', NULL, '2023-11-06 06:46:02', '2023-11-20 04:29:50', NULL),
(4, 'Hasad Wynn', '169', 'abc', '1977-12-01', 'abc', '12:00 AM', '12:00 AM', NULL, '2023-11-06 06:51:03', '2023-11-20 04:29:59', NULL),
(5, 'Willa Kerr', '240', 'Ipsam ipsa est inv', '1988-10-06', 'Amet perferendis in', '13:00:00', '17:50:00', NULL, '2023-11-06 06:56:06', '2023-11-06 06:59:05', NULL),
(6, 'Ifeoma Duffy', '722', 'Quidem ut ex ad quia', '2013-08-06', 'Laudantium Nam sed', '13:00:00', '13:00:00', NULL, '2023-11-06 07:02:27', '2023-11-06 07:02:27', NULL),
(7, 'Uriah Meadows', '325', 'abc', '2014-03-06', 'abc', '00:00:00', '00:00:00', '2023-11-06 07:10:07', '2023-11-06 07:09:37', '2023-11-06 07:10:07', NULL),
(8, 'Hop Carson', '300', 'Nisi sunt sunt enim', '1994-01-06', 'Ex inventore digniss', '00:00:01', '00:00:01', NULL, '2023-11-06 07:12:10', '2023-11-06 07:12:10', NULL),
(9, 'James Kelly', '843', 'Proident ea in qui', '2004-01-06', 'Labore ratione et et', '00:00:06', '00:00:10', NULL, '2023-11-06 07:12:37', '2023-11-06 07:12:37', NULL),
(10, 'Melvin Nash', '212', 'Quam exercitationem', '2036-06-06', 'Rerum cillum dicta a', '12:00 AM', '12:00 AM', NULL, '2023-11-06 07:18:10', '2023-11-06 07:29:51', NULL),
(11, 'Bruce Donovan', '881', 'Rem est beatae non s', '2023-11-14', 'Nisi vel fugiat est', '01:00 PM', '10:00 PM', NULL, '2023-11-06 07:35:53', '2023-11-06 07:35:53', NULL),
(12, 'Brenden Bean', '762', 'test', '2023-11-09', 'test', '01:00 PM', '02:00 PM', NULL, '2023-11-15 11:00:55', '2023-11-15 11:00:55', NULL),
(13, 'Denise Reid', '866', 'test', '1976-10-31', 'test', '12:00 AM', '01:00 PM', NULL, '2023-11-15 11:01:17', '2023-11-15 11:01:17', NULL),
(14, 'Bell Raymond', '27', 'abc', '2005-06-14', 'abc', '12:00 AM', '01:00 PM', NULL, '2023-11-15 11:02:02', '2023-11-15 11:02:02', NULL),
(15, 'Buffy Maxwell', '737', 'Ipsa qui iste ex cu', '2023-11-30', 'test', '12:00 AM', '01:00 PM', NULL, '2023-11-19 01:22:58', '2023-11-19 01:22:58', NULL),
(16, 'abc', '10', 'sdfsdf', '2023-12-01', 'dfdf', '12:00 AM', '01:00 PM', NULL, '2023-11-21 08:18:14', '2023-11-21 08:18:14', NULL),
(17, 'abc', '2', 'abc', '2023-12-01', 'abc', '12:00 AM', '01:00 PM', NULL, '2023-11-21 08:20:35', '2023-11-21 08:20:35', NULL),
(18, 'Abdul Rehman', '273', 'test', '2023-12-01', 'test', '12:00 AM', '01:00 PM', NULL, '2023-11-21 08:34:34', '2023-11-21 08:34:34', NULL),
(19, 'new test', '20', 'TEST', '2023-12-01', 'TEST', '12:00 AM', '01:00 PM', NULL, '2023-11-21 08:37:45', '2023-11-21 08:37:45', NULL),
(20, 'Stella Beach', '764', 'test', '1995-12-02', 'test', '12:00 AM', '01:00 PM', NULL, '2023-11-21 08:40:40', '2023-11-21 08:40:40', NULL),
(21, 'Sloane Burton', '17', 'test', '1979-08-07', 'test', '12:00 AM', '01:00 PM', NULL, '2023-11-21 08:43:58', '2023-11-21 08:43:58', 18),
(22, 'Virginia Ferguson', '555', 'Soluta at commodo mo', '2023-12-09', 'test', '12:00 AM', '01:00 PM', NULL, '2023-11-21 10:08:24', '2023-11-21 10:08:24', 18),
(23, 'Shad Madden', '612', 'Harum eum obcaecati', '1993-10-10', 'abc', '12:00 AM', '01:00 PM', '2023-12-18 23:57:38', '2023-12-18 23:44:47', '2023-12-18 23:57:38', 24),
(24, 'abc', '21', 'qweq', '2023-12-29', 'TEST', '12:00 AM', '06:00 AM', NULL, '2023-12-18 23:58:14', '2023-12-18 23:58:14', 24);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_11_01_063956_create_occasions_table', 1),
(6, '2023_11_01_082004_create_types_table', 1),
(7, '2023_11_01_105747_create_events_table', 1),
(8, '2023_11_04_054730_create_admin_venues_table', 1),
(9, '2023_11_04_075127_create_customer_venues_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `occasions`
--

CREATE TABLE `occasions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('say2muammar@gmail.com', '$2y$10$bm.LJqN4HIXRPOdrO2ML0e.qcAZhUO6rq9T/mhqsAkDcwjQw3fd6q', '2023-11-06 08:47:37');

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
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `Role` varchar(255) NOT NULL DEFAULT 'User',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `google_id` varchar(255) DEFAULT NULL,
  `twitter_id` varchar(255) DEFAULT NULL,
  `oauth_type` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `Role`, `email_verified_at`, `phone`, `password`, `google_id`, `twitter_id`, `oauth_type`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'eatanmol', 'eatanmoldev@gmail.com', 'Admin', NULL, '(123) 131-2321', NULL, '112999433582524596227', NULL, NULL, NULL, '2023-11-04 04:36:23', '2023-11-10 03:06:10'),
(2, 'Guest1734', 'd43a99e1-0a07-448c-8ff1-d1a597085afb', 'Guest', NULL, NULL, '$2y$10$7eOck6XbH6/sAGJqhLN7ku1VqU2SILMdJZWqPb.TZZDR3lXyzuqA.', NULL, NULL, NULL, NULL, '2023-11-06 02:07:35', '2023-11-06 02:07:35'),
(3, 'Guest4551', 'a3e171e3-1e30-49ac-b34e-da4f0f290a3d', 'Guest', NULL, NULL, '$2y$10$3dn6rBtw1ZD2TSY2ex5IZe6HYIsm9L4q6mfT3M7IqHbfP5yGJOoNS', NULL, NULL, NULL, NULL, '2023-11-06 06:31:40', '2023-11-06 06:31:40'),
(5, 'Muhammad Muammar', 'say2muammar@gmail.com', 'User', NULL, '(213) 213-1231', NULL, '112523112687941812663', NULL, NULL, NULL, '2023-11-06 08:02:46', '2023-11-10 03:07:44'),
(6, 'Chanda Vaughn', 'kepeg@mailinator.com', 'User', NULL, '(938) 192-2319', '$2y$10$ddxOJrfISuFi67wYe1cxUup9jXxlyagi1GAX9x.PBFss5Jm6dr0QK', NULL, NULL, NULL, NULL, '2023-11-10 06:07:01', '2023-11-10 06:09:45'),
(7, 'Guest9393', '74d05923-e898-45d7-8929-7a93004d329f', 'Guest', NULL, NULL, '$2y$10$qjYU75xGGhDyjxm7eDMn/.G/jY/gXl9vvBXBTCMjgyxSmQlcZym56', NULL, NULL, NULL, NULL, '2023-11-10 12:23:58', '2023-11-10 12:23:58'),
(8, 'Guest2408', '1a0aa91e-e50a-41fb-a2f7-8b181560ec3e', 'Guest', NULL, NULL, '$2y$10$SXILyZJ.PEOAoUq..DJiW.CP7TjxQw.1TlMmpwrhvs01uy3xKs9vm', NULL, NULL, NULL, NULL, '2023-11-11 02:11:07', '2023-11-11 02:11:07'),
(9, 'Guest6333', 'a98a6f12-b5e8-45b7-9dd3-6633d7809b0c', 'Guest', NULL, NULL, '$2y$10$WR2nnFr3azeVcsp2W3AOqummG3QmF6CDGcJL0WEtMo1o4KKtrTIZK', NULL, NULL, NULL, NULL, '2023-11-14 01:56:27', '2023-11-14 01:56:27'),
(10, 'Guest7668', 'b1a83029-927d-498d-8b8e-1c9273f11dcf', 'Guest', NULL, NULL, '$2y$10$nBxed2z7c9pYd5NGCsMpiOS/dZNrk3tEfax6ssXQXSulIv0/yHYZW', NULL, NULL, NULL, NULL, '2023-11-15 10:47:30', '2023-11-15 10:47:30'),
(11, 'Guest1809', 'e8873d67-d1dd-42c9-b309-46e2d2688981', 'Guest', NULL, NULL, '$2y$10$bFW5HDyM2XI0l846slNMye8IWJ0.3WmB/hSH20xKJ9A6q.4HwErrq', NULL, NULL, NULL, NULL, '2023-11-17 05:06:40', '2023-11-17 05:06:40'),
(12, 'Guest3732', '4109f3a4-72ea-454c-a22c-e614ac7626ae', 'Guest', NULL, NULL, '$2y$10$kNPo/V25lwL13b1CsF06gOKyqqYtzckFToig71CEl9Ws.7LEmjk16', NULL, NULL, NULL, NULL, '2023-11-18 02:06:29', '2023-11-18 02:06:29'),
(13, 'Guest1150', 'cd0cf978-9eeb-48d9-9b8d-d7fc41abb1f6', 'Guest', NULL, NULL, '$2y$10$LTtbxXST67jAIrAFny1QSeqeVch3.Myqovl4WBi2u7mwsAn.SKuLi', NULL, NULL, NULL, NULL, '2023-11-18 11:41:41', '2023-11-18 11:41:41'),
(14, 'Guest4904', '4a179e7a-a1d7-4df1-93ec-bdfff92ef8c9', 'Guest', NULL, NULL, '$2y$10$SvBrfRHTadR0NOxAJL8xBOuDjncduG167bRApC4x0DElpgm9emYtG', NULL, NULL, NULL, NULL, '2023-11-19 00:48:32', '2023-11-19 00:48:32'),
(15, 'Guest4326', '09ddc1c7-3237-4607-88e9-3c1aefa6257f', 'Guest', NULL, NULL, '$2y$10$1cH/lqKPScZOsje3c9/Blea/kkprHyYRox5nJXiEPJaqcZxCgTAgu', NULL, NULL, NULL, NULL, '2023-11-19 01:29:02', '2023-11-19 01:29:02'),
(16, 'Guest7459', '525240a1-d68a-4f74-98df-6c52c55461b3', 'Guest', NULL, NULL, '$2y$10$S..L7/v9x5VbGi0iIh8tCuIF61ucjc4oLbwMJpbgthM9U/iEXdwqm', NULL, NULL, NULL, NULL, '2023-11-19 01:29:04', '2023-11-19 01:29:04'),
(17, 'Guest7006', '6926a56e-f943-4805-817e-f06799f95b17', 'Guest', NULL, NULL, '$2y$10$EXfVnoINAf/hEEyZ2Asjeuxyfx73LZmuqVgnlxD/Y4aQ0fPccB7l6', NULL, NULL, NULL, NULL, '2023-11-20 02:33:25', '2023-11-20 02:33:25'),
(18, 'Guest6076', '48a37ad1-c32c-4c51-a605-4f4e07e50b35', 'Guest', NULL, NULL, '$2y$10$ZhLNQuoWyZBTo7FxoaOPse/Sz16D1t21hOYs/W1FrN.pu2.QzJiO2', NULL, NULL, NULL, NULL, '2023-11-21 08:14:30', '2023-11-21 08:14:30'),
(20, 'Guest86', '45f37e41-41ea-47a7-ae3d-f7f72e7dcfd0', 'Guest', NULL, NULL, '$2y$10$nnuJG9H0agPmeVRwaCvF7uIS3Fu8eTXxu6zvKtVIxU0QBSMtpOWru', NULL, NULL, NULL, NULL, '2023-11-25 05:08:29', '2023-11-25 05:08:29'),
(23, 'Patrick Olsen', 'mobe@mailinator.com', 'User', NULL, '() -', '$2y$10$M9nKx/gBap/jeytg.7JzmuJApYKDwmJqIsYyd93mOkJC53iggMwXO', NULL, NULL, NULL, NULL, '2023-11-27 06:57:27', '2023-11-27 06:57:27'),
(24, 'Guest8176', '0e97798f-2171-491b-8357-8227b644bfdd', 'Admin', NULL, NULL, '$2y$10$c55W4lfyiNS15B.9xeChAuFey96TiOIJssGmxY0O/Nk0e8bNHLdbO', NULL, NULL, NULL, NULL, '2023-12-18 23:34:03', '2023-12-18 23:34:03'),
(25, 'Calvin Smith', 'faty@mailinator.com', 'Admin', NULL, '(123) 123-1233', '$2y$10$K15zKSZCZVgGDLZ9./bqPOCSMBNE10Red/unN.oIjR6oXqPf0fXFO', NULL, NULL, NULL, NULL, '2023-12-21 11:32:48', '2023-12-21 11:32:48'),
(27, 'Althea Page', 'zuwi@mailinator.com', 'Kitchen', NULL, '(231) 231-3131', '$2y$10$yrzTnLYUVE3/RnIhtJAqjeKoc8kKwA9dK9k0uDWl1xSHz9/YF4nCS', NULL, NULL, NULL, NULL, '2023-12-23 19:53:36', '2023-12-23 19:53:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_venues`
--
ALTER TABLE `admin_venues`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_venues_createdby_foreign` (`createdby`);

--
-- Indexes for table `customer_venues`
--
ALTER TABLE `customer_venues`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_venues_admin_venue_id_foreign` (`admin_venue_id`),
  ADD KEY `customer_venues_createdby_foreign` (`createdby`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_events_createdby` (`createdby`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `occasions`
--
ALTER TABLE `occasions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_venues`
--
ALTER TABLE `admin_venues`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `customer_venues`
--
ALTER TABLE `customer_venues`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `occasions`
--
ALTER TABLE `occasions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_venues`
--
ALTER TABLE `admin_venues`
  ADD CONSTRAINT `admin_venues_createdby_foreign` FOREIGN KEY (`createdby`) REFERENCES `users` (`id`);

--
-- Constraints for table `customer_venues`
--
ALTER TABLE `customer_venues`
  ADD CONSTRAINT `customer_venues_admin_venue_id_foreign` FOREIGN KEY (`admin_venue_id`) REFERENCES `admin_venues` (`id`),
  ADD CONSTRAINT `customer_venues_createdby_foreign` FOREIGN KEY (`createdby`) REFERENCES `users` (`id`);

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `fk_events_createdby` FOREIGN KEY (`createdby`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2021 at 09:38 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `panda`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_slug`, `created_at`, `updated_at`, `deleted_at`) VALUES
(68, 'Grocery', 'grocery', '2021-06-10 15:39:02', '2021-06-29 15:50:23', NULL),
(69, 'Woman Fashion', 'woman-fashion', '2021-06-10 15:44:23', '2021-06-14 08:43:05', NULL),
(71, 'Home & Appliance', 'home-&-appliance', '2021-06-10 15:44:48', '2021-06-14 08:43:04', NULL),
(72, 'Electronics', 'electronics', '2021-06-10 15:44:59', '2021-06-14 08:43:03', NULL),
(75, 'man', 'man', '2021-06-29 15:17:51', '2021-06-29 15:32:45', NULL),
(76, 'woman', 'woman', '2021-06-29 16:09:14', '2021-07-01 15:45:40', '2021-07-01 15:45:40'),
(77, 'woman', 'woman', '2021-06-29 16:09:21', '2021-07-01 15:09:26', '2021-07-01 15:09:26'),
(78, 'grggrgrgr rgrg', 'grggrgrgr-rgrg', '2021-07-01 15:50:09', '2021-07-01 15:50:10', '2021-07-01 15:50:10');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(13, '2021_05_27_110647_create_socials_table', 1),
(26, '2014_10_12_000000_create_users_table', 2),
(27, '2014_10_12_100000_create_password_resets_table', 2),
(28, '2019_08_19_000000_create_failed_jobs_table', 2),
(29, '2021_05_20_075105_create_categories_table', 2),
(30, '2021_05_30_134344_create_socials_table', 2),
(31, '2021_06_01_151550_add_deleted_at_to_categories_table', 2),
(32, '2021_06_02_004806_add_deleted_at_to_socials', 3),
(33, '2021_06_05_203805_create_subcategories_table', 4),
(38, '2021_06_13_125124_create_products_table', 5),
(39, '2021_06_23_123416_create_product_colors_table', 6),
(40, '2021_06_23_123439_create_product_sizes_table', 6),
(41, '2021_06_24_135312_create_product_attributes_table', 7),
(42, '2021_06_24_142100_create_product_image_galleries_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('anik@gmail.com', '$2y$10$xEQbCLcX3fxHFfL1WT3JH.DCrdQtjRlM7M0Af4ypHab9G.3w3KRBG', '2021-07-01 18:08:32');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Category_id` bigint(20) UNSIGNED NOT NULL,
  `subcategory_id` bigint(20) UNSIGNED NOT NULL,
  `summary` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `slug`, `thumbnail`, `Category_id`, `subcategory_id`, `summary`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(12, 'T shirt Blue', 't-shirt-blue', 't-shirt-blue-itam6oJkE7.jpg', 75, 30, 'e centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letra', 'e centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of', '2021-06-24 10:44:10', '2021-06-24 10:44:10', NULL),
(14, 'Job Preparation Pro', 'job-preparation-pro', 'job-preparation-pro-d0iYPqleAY.jpg', 68, 35, 'lorem ipsum dollor immot dollor color minimum order 520 package lorem ipsum dollor immot dollor color minimum order 520 package', 'lorem ipsum dollor immot dollor color minimum order 520 package lorem ipsum dollor immot dollor color minimum order 520 package lorem ipsum dollor immot dollor color minimum order 520 package', '2021-06-26 15:57:53', '2021-06-26 15:57:53', NULL),
(15, 'Casual Shirt', 'casual-shirt', 'casual-shirt-m1v1FsdQlM.jpg', 75, 34, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer too', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer too', '2021-06-27 06:38:14', '2021-06-27 06:38:14', NULL),
(17, 'Smart Watch', 'smart-watch', 'smart-watch-z3Bbn2U40w.jpg', 72, 33, 'default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', '2021-07-05 08:59:55', '2021-07-05 08:59:55', NULL),
(18, 'Watch', 'watch', 'watch-KIcrbWoeeF.jpg', 72, 36, 'default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like.', 'default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like.', '2021-07-05 09:05:05', '2021-07-05 09:05:05', NULL),
(19, 'Super Smart Watch', 'super-smart-watch', 'super-smart-watch-IUAdQ4YNLM.jpg', 72, 33, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,', '2021-07-05 09:09:28', '2021-07-05 09:09:28', NULL),
(20, 'Simple Watch', 'simple-watch', 'simple-watch-xWMWtlo6h6.jpg', 72, 36, 'f the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"d', 'f the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"d', '2021-07-05 17:27:58', '2021-07-05 17:27:58', NULL),
(21, 'Smart Watchs', 'smart-watchs', 'smart-watchs-DMhLWAhPrp.jpg', 72, 33, 'f the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"d', 'f the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"d', '2021-07-05 18:03:07', '2021-07-05 18:03:07', NULL),
(22, 'TV', 'tv', 'tv-jzLJpuGicV.jpeg', 72, 35, 'lorem ipsum summary', 'lorem ipsum description', '2021-07-20 19:01:04', '2021-07-20 19:01:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes`
--

CREATE TABLE `product_attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `color_id` bigint(20) UNSIGNED DEFAULT NULL,
  `size_id` bigint(20) UNSIGNED DEFAULT NULL,
  `regular_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `offer_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_attributes`
--

INSERT INTO `product_attributes` (`id`, `product_id`, `color_id`, `size_id`, `regular_price`, `offer_price`, `quantity`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 12, 4, 2, '450', '400', '20', '2021-06-24 10:44:10', '2021-06-24 10:44:10', NULL),
(3, 12, 5, 4, '550', '500', '30', '2021-06-24 10:44:10', '2021-06-24 10:44:10', NULL),
(4, 14, 4, 1, '400', '350', '20', '2021-06-26 15:57:53', '2021-06-26 15:57:53', NULL),
(5, 14, 5, 2, '600', '550', '10', '2021-06-26 15:57:53', '2021-06-26 15:57:53', NULL),
(6, 15, 4, 1, '450', '400', '20', '2021-06-27 06:38:14', '2021-06-27 06:38:14', NULL),
(7, 15, 5, 2, '520', '400', '10', '2021-06-27 06:38:14', '2021-06-27 06:38:14', NULL),
(8, 17, 5, 2, '520', '400', '10', '2021-06-27 06:38:14', '2021-06-27 06:38:14', NULL),
(9, 18, 4, 3, '500', '400', '20', '2021-07-05 09:05:05', '2021-07-05 09:05:05', NULL),
(10, 19, 3, NULL, '2500', '2100', '20', '2021-07-05 09:09:28', '2021-07-05 09:09:28', NULL),
(11, 20, 5, 6, '2500', '2000', '50', '2021-07-05 17:27:58', '2021-07-05 17:27:58', NULL),
(12, 20, 4, 6, '2500', '2000', '50', '2021-07-05 17:27:58', '2021-07-05 17:27:58', NULL),
(13, 20, 4, 6, '2500', '2000', '50', '2021-07-05 17:27:58', '2021-07-05 17:27:58', NULL),
(14, 21, 4, NULL, '2500', '2000', '250', '2021-07-05 18:03:07', '2021-07-05 18:03:07', NULL),
(15, 21, 2, NULL, '2500', '2000', '20', '2021-07-05 18:03:07', '2021-07-05 18:03:07', NULL),
(16, 22, 4, 1, '2500', '2000', '50', '2021-07-20 19:01:04', '2021-07-20 19:01:04', NULL),
(17, 22, 4, 1, '2800', '2400', '50', '2021-07-20 19:01:04', '2021-07-20 19:01:04', NULL),
(18, 22, 2, 2, '1500', '1000', '20', '2021-07-20 19:01:04', '2021-07-20 19:01:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_colors`
--

CREATE TABLE `product_colors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `color_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_colors`
--

INSERT INTO `product_colors` (`id`, `color_name`, `color_slug`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Red', 'red', '2021-06-23 06:37:48', '2021-06-23 06:37:48', NULL),
(2, 'Green', 'green', '2021-06-23 06:37:48', '2021-06-23 06:37:48', NULL),
(3, 'Pink', 'pink', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(4, 'Blue', 'blue', '2021-06-23 06:50:44', '2021-06-23 06:50:44', NULL),
(5, 'Gray', 'gray', '2021-06-23 06:51:05', '2021-06-23 06:51:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_image_galleries`
--

CREATE TABLE `product_image_galleries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `image_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_image_galleries`
--

INSERT INTO `product_image_galleries` (`id`, `product_id`, `image_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 14, 'job-preparation-pro-hdd64Cmrda.jpg', '2021-06-26 15:57:53', '2021-06-26 15:57:53', NULL),
(2, 14, 'job-preparation-pro-px3oWlbQsw.jpg', '2021-06-26 15:57:53', '2021-06-26 15:57:53', NULL),
(3, 14, 'job-preparation-pro-8GaYEkd7Hu.jpg', '2021-06-26 15:57:53', '2021-06-26 15:57:53', NULL),
(4, 15, 'casual-shirt-za781VIk6S.jpg', '2021-06-27 06:38:14', '2021-06-27 06:38:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_sizes`
--

CREATE TABLE `product_sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `size_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_sizes`
--

INSERT INTO `product_sizes` (`id`, `size_name`, `size_slug`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'S', 's', '2021-06-23 06:51:46', '2021-06-23 06:51:46', NULL),
(2, 'M', 'm', '2021-06-23 06:51:46', '2021-06-23 06:51:46', NULL),
(3, 'L', 'l', '2021-06-23 06:52:15', '2021-06-23 06:52:15', NULL),
(4, 'XL', 'xl', '2021-06-23 06:52:28', '2021-06-23 06:52:28', NULL),
(5, 'XXL', 'xxl', '2021-06-23 06:52:42', '2021-06-23 06:52:42', NULL),
(6, 'XXXL', 'xxxl', '2021-06-23 06:52:55', '2021-06-23 06:52:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `socials`
--

CREATE TABLE `socials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `social_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `social_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `socials`
--

INSERT INTO `socials` (`id`, `social_name`, `social_link`, `created_at`, `updated_at`, `deleted_at`) VALUES
(17, 'Linkedin', 'facebook.com/anik.web', '2021-06-02 07:31:15', '2021-06-02 07:31:15', NULL),
(19, 'facebook', 'facebook.com/anik', '2021-06-02 09:33:09', '2021-06-02 09:33:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subcategory_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subcategory_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foreign_key` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `subcategory_name`, `subcategory_slug`, `foreign_key`, `created_at`, `updated_at`, `deleted_at`) VALUES
(30, 'T-Shirt', 't-shirt', 68, '2021-06-19 14:14:22', '2021-06-19 14:14:22', NULL),
(31, '1 Pices', '1-pices', 69, '2021-06-19 14:14:38', '2021-07-05 12:04:30', '2021-07-05 12:04:30'),
(32, 'Scarf', 'scarf', 69, '2021-06-19 14:14:56', '2021-07-05 12:04:20', '2021-07-05 12:04:20'),
(33, 'Smart Watch', 'smart-watch', 72, '2021-06-19 14:15:26', '2021-06-27 06:11:29', NULL),
(34, 'Shirt', 'shirt', 68, '2021-06-27 06:34:24', '2021-07-01 16:00:01', NULL),
(35, 'Tv', 'tv', 72, '2021-07-01 16:23:18', '2021-07-01 16:23:18', NULL),
(36, 'Watch', 'watch', 72, '2021-07-05 08:56:28', '2021-07-05 08:56:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Anik Kumar Nandi', 'anik@gmail.com', NULL, '$2y$10$lm5DmgNoxjKn8sb42D7YBeFJK6cJMEyJoAyNVIZa5H/qdv/knfpWK', 'QpbDklKHhWw8Se7UURoOo8XKX6tNaPuwpFfkHUnLiRDAGYmEgcJh0MKRVOAu', '2021-06-01 15:03:36', '2021-06-01 15:03:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_colors`
--
ALTER TABLE `product_colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_image_galleries`
--
ALTER TABLE `product_image_galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `socials`
--
ALTER TABLE `socials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `product_attributes`
--
ALTER TABLE `product_attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `product_colors`
--
ALTER TABLE `product_colors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_image_galleries`
--
ALTER TABLE `product_image_galleries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_sizes`
--
ALTER TABLE `product_sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `socials`
--
ALTER TABLE `socials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

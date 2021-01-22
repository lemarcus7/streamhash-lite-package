-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 05, 2017 at 03:07 PM
-- Server version: 5.7.19-0ubuntu0.16.04.1
-- PHP Version: 7.0.15-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `streamhash-lite-pack`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_activated` int(11) NOT NULL,
  `gender` enum('male','female','others') COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `paypal_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token_expiry` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `timezone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `picture`, `description`, `is_activated`, `gender`, `mobile`, `paypal_email`, `address`, `token`, `token_expiry`, `remember_token`, `timezone`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@streamhash.com', '$2y$10$LFUsKL7gFZf2Gxx89ehRWOnSAwqJ/HRvGtmKYaaFPSaeeQWlI0RS2', 'http://adminview.streamhash.com/placeholder.png', '', 0, 'male', '', '', '', '', '', NULL, '', '2017-08-05 04:02:43', '2017-08-05 04:02:43'),
(2, 'Test', 'test@streamhash.com', '$2y$10$h.3BkdXzIqehzpWEtGrTNuur5D1IbrxPhlXjfy8XRe9klI5ZUExQe', 'http://adminview.streamhash.com/placeholder.png', '', 0, 'male', '', '', '', '', '', NULL, '', '2017-08-05 04:02:43', '2017-08-05 04:02:43');

-- --------------------------------------------------------

--
-- Table structure for table `admin_videos`
--

CREATE TABLE `admin_videos` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL,
  `video` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `trailer_video` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `default_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `banner_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ratings` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reviews` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_approved` int(11) NOT NULL,
  `is_home_slider` int(11) NOT NULL DEFAULT '0',
  `is_banner` int(11) NOT NULL,
  `uploaded_by` enum('admin','moderator','user','other') COLLATE utf8_unicode_ci NOT NULL,
  `publish_time` datetime NOT NULL,
  `duration` time NOT NULL,
  `edited_by` enum('admin','moderator','user','other') COLLATE utf8_unicode_ci NOT NULL,
  `watch_count` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `video_type` int(11) NOT NULL,
  `video_upload_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_video_images`
--

CREATE TABLE `admin_video_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `admin_video_id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_default` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_series` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_approved` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` int(10) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8_unicode_ci NOT NULL,
  `queue` text COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `position` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `is_approved` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2015_08_25_172600_create_settings_table', 1),
('2016_07_25_142335_create_admins_table', 1),
('2016_07_28_111853_create_categories_table', 1),
('2016_07_28_111900_create_sub_categories_table', 1),
('2016_07_28_113237_create_sub_category_images_table', 1),
('2016_07_30_033554_add_is_series_field_to_categories_table', 1),
('2016_07_30_040800_create_admin_videos_table', 1),
('2016_07_30_040833_create_admin_video_images_table', 1),
('2016_07_30_132812_create_genres_table', 1),
('2016_07_31_140521_add_genre_id_to_admin_videos_table', 1),
('2016_08_01_151115_add_status_to_admin_videos_table', 1),
('2016_08_02_030955_add_is_approved_to_categories_table', 1),
('2016_08_02_031030_add_is_approved_to_sub_categories_table', 1),
('2016_08_02_031053_add_is_approved_genres_table', 1),
('2016_08_02_031301_add_is_approved_admin_videos_table', 1),
('2016_08_02_134552_create_user_ratings_table', 1),
('2016_08_02_143110_create_wishlists_table', 1),
('2016_08_02_144545_create_user_histories_table', 1),
('2016_08_02_152202_add_default_image_to_admin_videos_table', 1),
('2016_08_02_154250_add_watch_count_to_admin_videos_table', 1),
('2016_08_07_122712_create_pages_table', 1),
('2016_08_08_091037_add_publish_time_to_admin_videos_table', 1),
('2016_08_13_075844_add_video_type-to_admin_videos_table', 1),
('2016_08_13_083130_add_video_upload_type-to_admin_videos_table', 1),
('2016_08_14_042749_add_description_as_text_type', 1),
('2016_08_16_035007_add_is_moderator_to_users_table', 1),
('2016_08_19_134019_create_user_payments_table', 1),
('2016_08_19_182650_add_is_paid_to_users', 1),
('2016_08_26_065631_add_duration_to_admin_videos', 1),
('2016_08_29_064138_change_device_type_in_users_table', 1),
('2016_08_31_194838_change_video_id_in_admin_video_images', 1),
('2016_09_02_133843_add_is_home_slider_to_admin_videos', 1),
('2016_09_15_070030_create_jobs_table', 1),
('2016_09_15_070051_create_failed_jobs_table', 1),
('2016_09_15_163652_add_is_banner_to_admin_videos_table', 1),
('2016_09_23_180525_add_push_status_users_table', 1),
('2016_09_29_103536_change_login_by_users', 1),
('2017_07_22_124047_added_timezone_field_in_admins', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `heading` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `type` enum('about','privacy','terms') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'site_name', 'StreamHash', NULL, NULL),
(2, 'site_logo', 'http://lite.streamhash.com/logo.png', NULL, NULL),
(3, 'site_icon', 'http://lite.streamhash.com/favicon.png', NULL, NULL),
(4, 'tag_name', '', NULL, NULL),
(5, 'paypal_email', '', NULL, NULL),
(6, 'browser_key', '', NULL, NULL),
(7, 'default_lang', 'en', NULL, NULL),
(8, 'currency', '$', NULL, NULL),
(9, 'streaming_url', '', NULL, NULL),
(10, 'admin_take_count', '12', NULL, NULL),
(11, 'installation_process', '0', NULL, NULL),
(12, 'admin_delete_control', '0', NULL, NULL),
(13, 'JWPLAYER_KEY', 'M2NCefPoiiKsaVB8nTttvMBxfb1J3Xl7PDXSaw==', NULL, NULL),
(14, 'HLS_STREAMING_URL', '', NULL, NULL),
(15, 'header_scripts', '', NULL, NULL),
(16, 'body_scripts', '', NULL, NULL),
(17, 'demo_admin_email', 'admin@streamhash.com', NULL, NULL),
(18, 'demo_admin_password', '123456', NULL, NULL),
(19, 'copyrights_url', '', NULL, NULL),
(20, 'post_max_size', '2M', NULL, NULL),
(21, 'upload_max_size', '2M', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_approved` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sub_category_images`
--

CREATE TABLE `sub_category_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `position` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token_expiry` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `device_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `device_type` enum('android','ios','web') COLLATE utf8_unicode_ci NOT NULL,
  `login_by` enum('manual','facebook','twitter','google','linkedin') COLLATE utf8_unicode_ci NOT NULL,
  `social_unique_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fb_lg` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gl_lg` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_activated` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `push_status` int(11) NOT NULL,
  `user_type` int(11) NOT NULL,
  `is_moderator` int(11) NOT NULL,
  `moderator_id` int(11) NOT NULL,
  `gender` enum('male','female','others') COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `latitude` double(15,8) NOT NULL,
  `longitude` double(15,8) NOT NULL,
  `paypal_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `picture`, `token`, `token_expiry`, `device_token`, `device_type`, `login_by`, `social_unique_id`, `fb_lg`, `gl_lg`, `description`, `is_activated`, `status`, `push_status`, `user_type`, `is_moderator`, `moderator_id`, `gender`, `mobile`, `latitude`, `longitude`, `paypal_email`, `address`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'User', 'user@streamhash.com', '$2y$10$WmXVsomXG7aJkyYh38u9jeMkrOjoQNKuiXBNa09R7kE0.ecmi7qxG', 'http://lite.streamhash.com/placeholder.png', '', '', '', 'android', 'manual', '', '', '', '', 0, 1, 0, 1, 0, 0, 'male', '', 0.00000000, 0.00000000, '', '', NULL, '2017-08-05 04:02:43', '2017-08-05 04:02:43'),
(2, 'Test', 'test@streamhash.com', '$2y$10$7flX20oQoh/SRp6rnlD9PeFJTL/QoYSz2yb4FfsfDHveVFpC9Z83C', 'http://lite.streamhash.com/placeholder.png', '', '', '', 'android', 'manual', '', '', '', '', 0, 1, 0, 1, 0, 0, 'male', '', 0.00000000, 0.00000000, '', '', NULL, '2017-08-05 04:02:43', '2017-08-05 04:02:43');

-- --------------------------------------------------------

--
-- Table structure for table `user_histories`
--

CREATE TABLE `user_histories` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `admin_video_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_payments`
--

CREATE TABLE `user_payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` double(8,2) NOT NULL,
  `expiry_date` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_ratings`
--

CREATE TABLE `user_ratings` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `admin_video_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `admin_video_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `admin_videos`
--
ALTER TABLE `admin_videos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_video_images`
--
ALTER TABLE `admin_video_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_reserved_reserved_at_index` (`queue`,`reserved`,`reserved_at`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `settings_key_index` (`key`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_category_images`
--
ALTER TABLE `sub_category_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_histories`
--
ALTER TABLE `user_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_payments`
--
ALTER TABLE `user_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_ratings`
--
ALTER TABLE `user_ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `admin_videos`
--
ALTER TABLE `admin_videos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `admin_video_images`
--
ALTER TABLE `admin_video_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sub_category_images`
--
ALTER TABLE `sub_category_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user_histories`
--
ALTER TABLE `user_histories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_payments`
--
ALTER TABLE `user_payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_ratings`
--
ALTER TABLE `user_ratings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

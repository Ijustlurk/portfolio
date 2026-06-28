-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2026 at 04:01 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portfolio_cms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_contents`
--

CREATE TABLE `about_contents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `image_scale` double NOT NULL DEFAULT 1,
  `image_offset_x` int(11) NOT NULL DEFAULT 0,
  `image_offset_y` int(11) NOT NULL DEFAULT 0,
  `text_content` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `about_contents`
--

INSERT INTO `about_contents` (`id`, `image_path`, `image_scale`, `image_offset_x`, `image_offset_y`, `text_content`, `created_at`, `updated_at`) VALUES
(1, 'images/IMG_4171 2.png', 1.58, 57, 16, '<p>This is <strong>Elian Benjamin</strong>, or Yan, Yattsu, or [yanillust].</p><p>I am a <strong>Digital Artist</strong> in the Philippines mainly specializing in <strong>2D stylized Japanese style illustrations</strong>.</p><p>I\'ve been on the art industry for <strong>6 years</strong>, polishing my techniques in capturing the anime aesthetic by working as a commission artist for a multitude of individuals.</p><p>This portfolio showcases some of my works, including illustrations, comics, manga, and more. This also serves as a showcase for my frontend skills for website development.</p>', '2026-06-10 20:32:00', '2026-06-27 15:11:47');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-5c785c036466adea360111aa28563bfd556b5fba', 'i:2;', 1782606081),
('laravel-cache-5c785c036466adea360111aa28563bfd556b5fba:timer', 'i:1782606081;', 1782606081);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `commission_tiers`
--

CREATE TABLE `commission_tiers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `render_quality` varchar(255) NOT NULL,
  `coverage_type` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `delivery_time` varchar(255) NOT NULL,
  `resolution` varchar(255) NOT NULL,
  `dpi` int(11) NOT NULL,
  `tools` varchar(255) NOT NULL,
  `slots_available` int(11) NOT NULL DEFAULT 5,
  `image_path` varchar(255) DEFAULT NULL,
  `feature_high_res` tinyint(1) NOT NULL DEFAULT 1,
  `feature_revisions` tinyint(1) NOT NULL DEFAULT 1,
  `feature_background` tinyint(1) NOT NULL DEFAULT 0,
  `feature_commercial` tinyint(1) NOT NULL DEFAULT 0,
  `feature_source_file` tinyint(1) NOT NULL DEFAULT 0,
  `feature_urgent` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `commission_tiers`
--

INSERT INTO `commission_tiers` (`id`, `render_quality`, `coverage_type`, `price`, `delivery_time`, `resolution`, `dpi`, `tools`, `slots_available`, `image_path`, `feature_high_res`, `feature_revisions`, `feature_background`, `feature_commercial`, `feature_source_file`, `feature_urgent`, `created_at`, `updated_at`) VALUES
(1, 'sketch', 'headshot', 20, '1 Week', '3000 x 4000 px', 300, 'Clip Studio Paint', 5, 'commissions/ZVM4Cdff55EQpH88R0VSvRMAnk5v40RxpNIiWVQw.jpg', 1, 1, 0, 0, 0, 0, '2026-06-25 09:49:26', '2026-06-27 15:07:17'),
(2, 'sketch', 'bust', 25, '1 Week', '3000 x 4000 px', 300, 'Clip Studio Paint', 5, 'commissions/TrMLE7jhEKGmavKBTWswQQH6dEQn1PzkgrUqhfLm.jpg', 1, 1, 0, 0, 0, 0, '2026-06-25 09:49:26', '2026-06-27 15:58:21'),
(3, 'sketch', 'full_body', 50, '1-2 Weeks', '3000 x 4000 px', 300, 'Clip Studio Paint', 5, 'commissions/hhrNEI2lF8ieJ02ciEYJPRLiDzEyVVNOXreYabUZ.jpg', 1, 1, 0, 0, 0, 0, '2026-06-25 09:49:26', '2026-06-27 15:57:29'),
(4, 'flat_color', 'headshot', 30, '1-2 Weeks', '3000 x 4000 px', 300, 'Clip Studio Paint', 5, NULL, 1, 1, 0, 0, 0, 0, '2026-06-25 09:49:26', '2026-06-25 09:49:26'),
(5, 'flat_color', 'bust', 40, '1-2 Weeks', '3000 x 4000 px', 300, 'Clip Studio Paint', 5, NULL, 1, 1, 0, 0, 0, 0, '2026-06-25 09:49:26', '2026-06-27 15:58:33'),
(6, 'flat_color', 'full_body', 60, '1-2 Weeks', '3000 x 4000 px', 300, 'Clip Studio Paint, Photoshop', 5, NULL, 1, 1, 0, 0, 0, 0, '2026-06-25 09:49:26', '2026-06-27 15:57:43'),
(7, 'fully_rendered', 'headshot', 45, '2-3 Weeks', 'Variable', 350, 'Clip Studio Paint, Photoshop', 5, NULL, 1, 1, 1, 1, 0, 0, '2026-06-25 09:49:26', '2026-06-27 15:58:44'),
(8, 'fully_rendered', 'bust', 70, '2-3 Weeks', 'Variable', 350, 'Clip Studio Paint, Photoshop', 5, 'commissions/9B6JBHRlg5NRdRTucdROFKdAlcCO4A1kQJJo7AhO.jpg', 1, 1, 1, 1, 0, 0, '2026-06-25 09:49:26', '2026-06-27 17:23:48'),
(9, 'fully_rendered', 'full_body', 150, '2-3 Weeks', 'Variable', 350, 'Clip Studio Paint, Photoshop', 5, 'commissions/ysEaQEkXZ0oEJ7MTODiWWX9SUEOxVh2vCHjz5hyq.jpg', 1, 1, 1, 1, 0, 0, '2026-06-25 09:49:26', '2026-06-27 16:07:11');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` varchar(255) NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` smallint(5) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

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
  `finished_at` int(11) DEFAULT NULL
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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_06_10_000000_create_portfolio_items_table', 1),
(6, '2026_06_10_000001_update_portfolio_item_types', 2),
(7, '2026_06_10_052655_add_pages_to_portfolio_items_table', 3),
(8, '2026_06_10_083441_add_reading_direction_to_portfolio_items_table', 4),
(9, '2026_06_11_042950_create_about_contents_table', 5),
(10, '2026_06_11_060859_create_page_views_table', 6),
(11, '2026_06_12_040000_create_settings_table', 7),
(12, '2026_06_14_000000_add_image_adjustments_to_portfolio_items_table', 8),
(13, '2026_06_14_051100_add_timelapse_to_portfolio_items_table', 9),
(14, '2026_06_18_013207_add_sort_order_to_portfolio_items_table', 10),
(15, '2026_06_25_150803_create_commission_tiers_table', 11),
(16, '2026_06_25_192905_add_slots_to_commission_tiers_table', 12),
(17, '2026_06_27_230109_create_social_links_table', 13),
(18, '2026_06_27_233548_add_description_to_portfolio_items_table', 14),
(19, '2026_06_28_014651_add_custom_fields_to_social_links_table', 15);

-- --------------------------------------------------------

--
-- Table structure for table `page_views`
--

CREATE TABLE `page_views` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `url` text NOT NULL,
  `path` varchar(255) DEFAULT NULL,
  `referer` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `page_views`
--

INSERT INTO `page_views` (`id`, `ip_address`, `user_agent`, `url`, `path`, `referer`, `created_at`) VALUES
(1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', NULL, '2026-06-11 11:00:59'),
(2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', NULL, '2026-06-12 03:43:07'),
(3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://localhost:8000', 'Home', NULL, '2026-06-12 04:15:39'),
(4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', NULL, '2026-06-12 04:15:49'),
(5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/cms', '2026-06-12 04:21:00'),
(6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/cms', '2026-06-12 04:21:13'),
(7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/cms', '2026-06-12 04:21:39'),
(8, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/cms', '2026-06-12 04:30:23'),
(9, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/cms', '2026-06-12 04:30:46'),
(10, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', NULL, '2026-06-14 06:59:38'),
(11, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/cms', '2026-06-14 07:11:19'),
(12, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/cms', '2026-06-14 07:13:07'),
(13, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/cms', '2026-06-14 07:15:27'),
(14, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/cms', '2026-06-14 07:16:12'),
(15, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/cms', '2026-06-14 07:20:19'),
(16, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/cms', '2026-06-14 07:25:04'),
(17, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/cms', '2026-06-14 07:39:03'),
(18, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', NULL, '2026-06-14 10:19:06'),
(19, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/cms', '2026-06-14 10:23:44'),
(20, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/cms', '2026-06-14 10:26:17'),
(21, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/cms', '2026-06-14 10:29:50'),
(22, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/cms', '2026-06-14 10:32:23'),
(23, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/cms', '2026-06-14 10:32:35'),
(24, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', NULL, '2026-06-14 10:38:21'),
(25, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/cms', '2026-06-14 10:38:27'),
(26, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/cms', '2026-06-14 15:52:14'),
(27, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/cms', '2026-06-14 17:10:46'),
(28, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/cms', '2026-06-15 16:44:35'),
(29, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/cms', '2026-06-15 16:53:10'),
(30, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/cms', '2026-06-15 17:02:29'),
(31, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/cms', '2026-06-15 17:06:29'),
(32, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/cms', '2026-06-15 17:07:10'),
(33, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/cms', '2026-06-15 17:09:06'),
(34, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/cms', '2026-06-15 17:09:44'),
(35, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/cms', '2026-06-15 17:13:23'),
(36, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/cms', '2026-06-15 17:13:57'),
(37, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/cms', '2026-06-15 17:19:16'),
(38, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/cms', '2026-06-15 17:36:35'),
(39, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/cms', '2026-06-15 17:39:59'),
(40, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/cms', '2026-06-15 17:44:44'),
(41, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/cms', '2026-06-15 17:47:12'),
(42, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/cms', '2026-06-15 17:51:19'),
(43, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/cms', '2026-06-15 17:56:36'),
(44, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', NULL, '2026-06-17 15:56:07'),
(45, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/cms', '2026-06-17 16:01:21'),
(46, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', NULL, '2026-06-17 17:41:44'),
(47, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/cms', '2026-06-17 17:59:07'),
(48, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/cms', '2026-06-17 17:59:37'),
(49, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/cms', '2026-06-17 18:04:07'),
(50, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/cms', '2026-06-17 18:18:37'),
(51, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/cms', '2026-06-17 18:19:03'),
(52, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', NULL, '2026-06-24 18:10:16'),
(53, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/cms', '2026-06-24 18:12:17'),
(54, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/cms', '2026-06-24 18:15:10'),
(55, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/cms', '2026-06-24 18:18:40'),
(56, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/cms', '2026-06-25 02:47:23'),
(57, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', NULL, '2026-06-25 18:30:36'),
(58, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', NULL, '2026-06-25 19:11:20'),
(59, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/commission', 'commission', 'http://127.0.0.1:8000/', '2026-06-25 19:11:26'),
(60, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/commission', 'commission', 'http://127.0.0.1:8000/', '2026-06-25 19:17:09'),
(61, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/commission', 'commission', 'http://127.0.0.1:8000/', '2026-06-25 19:33:49'),
(62, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/commission', '2026-06-25 19:48:11'),
(63, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/commission', 'commission', 'http://127.0.0.1:8000/', '2026-06-25 19:51:12'),
(64, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/commission', '2026-06-25 19:57:17'),
(65, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/commission', 'commission', 'http://127.0.0.1:8000/', '2026-06-25 20:02:04'),
(66, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/commission', 'commission', 'http://127.0.0.1:8000/', '2026-06-25 20:02:10'),
(67, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/commission', 'commission', 'http://127.0.0.1:8000/', '2026-06-25 20:03:48'),
(68, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/commission', 'commission', 'http://127.0.0.1:8000/', '2026-06-25 20:18:45'),
(69, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/commission', 'commission', 'http://127.0.0.1:8000/', '2026-06-25 20:42:22'),
(70, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/commission', 'commission', 'http://127.0.0.1:8000/commission', '2026-06-25 20:42:26'),
(71, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/commission', 'commission', 'http://127.0.0.1:8000/commission', '2026-06-25 20:45:53'),
(72, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/commission', '2026-06-25 20:52:53'),
(73, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/commission', 'commission', 'http://127.0.0.1:8000/', '2026-06-25 20:53:05'),
(74, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/commission', 'commission', 'http://127.0.0.1:8000/', '2026-06-26 12:22:57'),
(75, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/cms/login', '2026-06-27 02:23:43'),
(76, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', NULL, '2026-06-27 12:32:23'),
(77, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/commission', 'commission', 'http://127.0.0.1:8000/', '2026-06-27 12:32:29'),
(78, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/commission', '2026-06-27 12:32:39'),
(79, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', NULL, '2026-06-27 14:07:06'),
(80, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/commission', 'commission', 'http://127.0.0.1:8000/', '2026-06-27 14:07:13'),
(81, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/commission', 'commission', 'http://127.0.0.1:8000/', '2026-06-27 22:47:00'),
(82, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/commission', '2026-06-27 22:47:16'),
(83, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/commission', '2026-06-27 22:58:24'),
(84, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/commission', 'commission', 'http://127.0.0.1:8000/', '2026-06-27 22:58:39'),
(85, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/commission', '2026-06-27 23:00:24'),
(86, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/commission', '2026-06-27 23:04:32'),
(87, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/commission', '2026-06-27 23:05:49'),
(88, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/commission', 'commission', 'http://127.0.0.1:8000/', '2026-06-27 23:06:05'),
(89, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/commission', 'commission', 'http://127.0.0.1:8000/', '2026-06-27 23:07:25'),
(90, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/commission', '2026-06-27 23:09:00'),
(91, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/commission', '2026-06-27 23:09:03'),
(92, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/commission', '2026-06-27 23:11:22'),
(93, '127.0.0.1', 'Mozilla/5.0 (Linux; Android 15; Pixel 9) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Mobile Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/commission', '2026-06-27 23:14:20'),
(94, '127.0.0.1', 'Mozilla/5.0 (Linux; Android 15; Pixel 9) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Mobile Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/commission', '2026-06-27 23:17:03'),
(95, '127.0.0.1', 'Mozilla/5.0 (Linux; Android 15; Pixel 9) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Mobile Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/commission', '2026-06-27 23:17:30'),
(96, '127.0.0.1', 'Mozilla/5.0 (Linux; Android 15; Pixel 9) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Mobile Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/commission', '2026-06-27 23:22:42'),
(97, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/commission', '2026-06-27 23:25:11'),
(98, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/commission', '2026-06-27 23:28:02'),
(99, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/cms', '2026-06-27 23:28:50'),
(100, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/commission', 'commission', 'http://127.0.0.1:8000/', '2026-06-27 23:28:55'),
(101, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/commission', '2026-06-27 23:33:59'),
(102, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/cms', '2026-06-27 23:38:43'),
(103, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/commission', 'commission', 'http://127.0.0.1:8000/', '2026-06-27 23:38:47'),
(104, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/commission', 'commission', 'http://127.0.0.1:8000/', '2026-06-27 23:39:08'),
(105, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/commission', 'commission', 'http://127.0.0.1:8000/', '2026-06-27 23:39:58'),
(106, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/commission', 'commission', 'http://127.0.0.1:8000/', '2026-06-27 23:41:20'),
(107, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/commission', 'commission', 'http://127.0.0.1:8000/', '2026-06-27 23:44:51'),
(108, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/commission', 'commission', 'http://127.0.0.1:8000/', '2026-06-27 23:46:03'),
(109, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/commission', 'commission', 'http://127.0.0.1:8000/', '2026-06-27 23:46:03'),
(110, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/commission', 'commission', 'http://127.0.0.1:8000/', '2026-06-27 23:47:19'),
(111, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/commission', 'commission', 'http://127.0.0.1:8000/', '2026-06-27 23:49:10'),
(112, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/commission', 'commission', 'http://127.0.0.1:8000/', '2026-06-27 23:49:23'),
(113, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/commission', 'commission', 'http://127.0.0.1:8000/', '2026-06-27 23:50:54'),
(114, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/commission', 'commission', 'http://127.0.0.1:8000/', '2026-06-27 23:51:01'),
(115, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/commission', 'commission', 'http://127.0.0.1:8000/', '2026-06-27 23:51:07'),
(116, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/commission', 'commission', 'http://127.0.0.1:8000/', '2026-06-27 23:51:18'),
(117, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/commission', 'commission', 'http://127.0.0.1:8000/', '2026-06-27 23:51:32'),
(118, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/commission', 'commission', 'http://127.0.0.1:8000/', '2026-06-27 23:51:48'),
(119, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/commission', 'commission', 'http://127.0.0.1:8000/', '2026-06-27 23:53:11'),
(120, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/commission', 'commission', 'http://127.0.0.1:8000/', '2026-06-27 23:55:45'),
(121, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/commission', 'commission', 'http://127.0.0.1:8000/', '2026-06-27 23:56:11'),
(122, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/commission', 'commission', 'http://127.0.0.1:8000/', '2026-06-27 23:56:21'),
(123, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/commission', 'commission', 'http://127.0.0.1:8000/', '2026-06-28 00:02:24'),
(124, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/commission', 'commission', 'http://127.0.0.1:8000/', '2026-06-28 00:07:15'),
(125, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000', 'Home', 'http://127.0.0.1:8000/commission', '2026-06-28 00:09:52'),
(126, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/commission', 'commission', 'http://127.0.0.1:8000/', '2026-06-28 00:10:28');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `username` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `portfolio_items`
--

CREATE TABLE `portfolio_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `image_path` varchar(255) NOT NULL,
  `pages` text DEFAULT NULL,
  `reading_direction` varchar(255) DEFAULT 'ltr',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image_scale` double NOT NULL DEFAULT 1,
  `image_offset_x` int(11) NOT NULL DEFAULT 0,
  `image_offset_y` int(11) NOT NULL DEFAULT 0,
  `timelapse_path` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `portfolio_items`
--

INSERT INTO `portfolio_items` (`id`, `title`, `category`, `section`, `type`, `sort_order`, `image_path`, `pages`, `reading_direction`, `created_at`, `updated_at`, `image_scale`, `image_offset_x`, `image_offset_y`, `timelapse_path`, `description`) VALUES
(1, 'Bride Vivian', 'Cute 💖', 'illustration', 'fanart', 0, 'portfolio/kTd0Tknp9954VTS6pfUvVJbpSnnulaRTy0kqr5ID.jpg', NULL, 'ltr', '2026-06-09 19:30:28', '2026-06-15 09:12:36', 1.11, 5, 56, 'timelapse/9a8EKCAY2yXIoUz5I7uTKn3CDELFF4ympsXlaGBa.mp4', NULL),
(2, 'Matcha Date', 'Blending Real Life and Illustration', 'illustration', 'original', 2, 'https://lh3.googleusercontent.com/d/1-Rk20cyEYOjZrscxfI3tVh3LRVe15Awt', NULL, 'ltr', '2026-06-09 19:30:28', '2026-06-17 09:59:04', 1.17, 0, 58, NULL, NULL),
(3, 'Heyy!!!', 'POV Art', 'illustration', 'original', 0, 'portfolio/JEPK3185BuphwBgA1gSjKaLwTzSv7ZTMnBXyclZd.jpg', NULL, 'ltr', '2026-06-09 19:30:28', '2026-06-27 17:27:33', 1.08, -4, -31, 'timelapse/gUVWuAqewMIoQ1JHYsnsIx4bZaj57Vv19ykh89lC.mp4', 'Original character illustration.'),
(4, 'HIGH UP', 'Manga Style', 'illustration', 'original', 1, 'portfolio/80Ylvdy3vlQsPPUasnnEYMyDllXhSPlw6KybRz8d.jpg', NULL, 'ltr', '2026-06-09 19:30:28', '2026-06-17 09:59:04', 1, 0, 0, NULL, NULL),
(5, 'Phoebe', 'Pheeb', 'illustration', 'fanart', 0, 'portfolio/8rpXN69hP434FBanYqfYHhWbDU8Ng9kGkRIex3Ea.jpg', NULL, 'ltr', '2026-06-09 19:30:28', '2026-06-15 09:51:13', 1, 0, 0, 'timelapse/Imjwcg7abzMjySzAmpgwuioBa5PtmoybquFUTKS5.mp4', NULL),
(6, 'HSR Cipher', 'Nyaa~', 'illustration', 'fanart', 0, 'portfolio/4vo6G7SBi1aXTFY2Cf6x924nKT8PHPXq7wkjjJL3.jpg', NULL, 'ltr', '2026-06-09 19:30:28', '2026-06-17 10:03:59', 1, 0, 0, 'timelapse/9tJQqcgvst11AJHObpak7LATIlcMWCVlj4CEy5CQ.mp4', NULL),
(9, 'Mornye', 'Dakimakura', 'illustration', 'spicy', 1, 'portfolio/CtulXxEJ2PspA7cDFs2xT7mB7BoDDme0st6qIz52.jpg', NULL, 'ltr', '2026-06-09 19:30:28', '2026-06-27 17:28:46', 1.48, 4, 190, 'timelapse/L42XdhtudfMfTZzDp36bNg3ys0H4BZ0eKRM77fyq.mp4', 'Dakimakura Cover commission for Cuddly Octopus portraying the Wuthering Waves character Mornye in a office setting.'),
(10, 'Today is March 7th!', 'Risque Selfie', 'illustration', 'spicy', 2, 'portfolio/plpPJWtTlkOj4KWnTjzsD0hzzu2bGhvPB5MuT8nD.jpg', NULL, 'ltr', '2026-06-09 19:30:28', '2026-06-17 09:59:32', 1, -1, -22, NULL, NULL),
(11, 'March\'s Gift', 'Memento', 'illustration', 'spicy', 3, 'portfolio/6XQC3ZR5SNosBMm2nqscjHPDwY2qCeMYTaPzprws.jpg', NULL, 'ltr', '2026-06-09 19:30:28', '2026-06-17 09:59:32', 1, 0, 0, NULL, NULL),
(12, 'Swimsuit March 7th', 'Summer!!', 'illustration', 'spicy', 0, 'portfolio/4nwowVIZdgnGMfYPjjGRGEVvT4x8dSg7LumYd6an.jpg', NULL, 'ltr', '2026-06-09 19:30:28', '2026-06-17 09:59:32', 1.1, -1, 28, 'timelapse/bwJ5yEINTrNOymOd4aR9acBAYvQoTZfME6wx2imn.mp4', NULL),
(13, 'Neon Samurai Chronicles', 'Manga Series', 'comic', NULL, 0, 'https://images.unsplash.com/photo-1607604276583-eef5d076aa5f?auto=format&fit=crop&q=80&w=800', '[\"uploads\\/flipbooks\\/book_6a2923c0592b4\\/page_1.png\",\"uploads\\/flipbooks\\/book_6a2923c0592b4\\/page_2.png\",\"uploads\\/flipbooks\\/book_6a2923c0592b4\\/page_3.png\",\"uploads\\/flipbooks\\/book_6a2923c0592b4\\/page_4.png\",\"uploads\\/flipbooks\\/book_6a2923c0592b4\\/page_5.png\",\"uploads\\/flipbooks\\/book_6a2923c0592b4\\/page_6.png\",\"uploads\\/flipbooks\\/book_6a2923c0592b4\\/page_7.png\",\"uploads\\/flipbooks\\/book_6a2923c0592b4\\/page_8.png\",\"uploads\\/flipbooks\\/book_6a2923c0592b4\\/page_9.png\",\"uploads\\/flipbooks\\/book_6a2923c0592b4\\/page_10.png\",\"uploads\\/flipbooks\\/book_6a2923c0592b4\\/page_11.png\",\"uploads\\/flipbooks\\/book_6a2923c0592b4\\/page_12.png\",\"uploads\\/flipbooks\\/book_6a2923c0592b4\\/page_13.png\",\"uploads\\/flipbooks\\/book_6a2923c0592b4\\/page_14.png\",\"uploads\\/flipbooks\\/book_6a2923c0592b4\\/page_15.png\",\"uploads\\/flipbooks\\/book_6a2923c0592b4\\/page_16.png\",\"uploads\\/flipbooks\\/book_6a2923c0592b4\\/page_17.png\",\"uploads\\/flipbooks\\/book_6a2923c0592b4\\/page_18.png\",\"uploads\\/flipbooks\\/book_6a2923c0592b4\\/page_19.png\",\"uploads\\/flipbooks\\/book_6a2923c0592b4\\/page_20.png\",\"uploads\\/flipbooks\\/book_6a2923c0592b4\\/page_21.png\",\"uploads\\/flipbooks\\/book_6a2923c0592b4\\/page_22.png\",\"uploads\\/flipbooks\\/book_6a2923c0592b4\\/page_23.png\",\"uploads\\/flipbooks\\/book_6a2923c0592b4\\/page_24.png\"]', 'ltr', '2026-06-09 19:30:28', '2026-06-10 01:12:48', 1, 0, 0, NULL, NULL),
(14, 'City of Sparks', 'Webtoon', 'comic', NULL, 0, 'https://images.unsplash.com/photo-1542751371-adc38448a05e?auto=format&fit=crop&q=80&w=800', NULL, 'ltr', '2026-06-09 19:30:28', '2026-06-09 19:30:28', 1, 0, 0, NULL, NULL),
(15, 'Chronicles of the Void', 'Graphic Novel', 'comic', NULL, 0, 'https://images.unsplash.com/photo-1534447677768-be436bb09401?auto=format&fit=crop&q=80&w=800', NULL, 'ltr', '2026-06-09 19:30:28', '2026-06-09 19:30:28', 1, 0, 0, NULL, NULL),
(19, 'Manga Sketch', 'Sketches', 'comic', NULL, 0, 'portfolio/IYw69ektKfH5j80toR8sZRCecVKSyfshlO1zDvcj.jpg', '[\"uploads\\/flipbooks\\/book_6a29293d1aea3\\/page_1.jpg\",\"uploads\\/flipbooks\\/book_6a29293d1aea3\\/page_2.jpg\",\"uploads\\/flipbooks\\/book_6a29293d1aea3\\/page_3.jpg\",\"uploads\\/flipbooks\\/book_6a29293d1aea3\\/page_4.jpg\",\"uploads\\/flipbooks\\/book_6a29293d1aea3\\/page_5.jpg\",\"uploads\\/flipbooks\\/book_6a29293d1aea3\\/page_6.jpg\",\"uploads\\/flipbooks\\/book_6a29293d1aea3\\/page_7.jpg\"]', 'rtl', '2026-06-10 01:07:34', '2026-06-10 01:12:49', 1, 0, 0, NULL, NULL),
(32, 'Candid Grad', 'Mixing RL and 2D', 'concept', NULL, 0, 'portfolio/o5kiKVMEsYFvRAMBBZwiJSqAXkkshghMk0a8nCa4.jpg', NULL, 'ltr', '2026-06-14 02:32:10', '2026-06-15 09:44:40', 1, 0, 59, NULL, NULL),
(33, 'Heroine A -chan (Provisional Name)', 'Character Sheet', 'concept', NULL, 0, 'portfolio/Huq51L2zJwJ8989fsH9dJ1oiXCi2HeCpwSbBpFwU.jpg', NULL, 'ltr', '2026-06-14 02:32:10', '2026-06-17 10:06:16', 1, 0, 0, NULL, NULL),
(34, 'Almond Eye', '30 Min rakugaki', 'concept', NULL, 0, 'portfolio/33lvpv4NDWbqYbEQQR2cIaDJRPAqP43INg4ciOku.jpg', NULL, 'ltr', '2026-06-14 02:32:10', '2026-06-27 15:22:36', 1, 0, 0, NULL, NULL),
(35, 'Milim Nava', '30 Min rakugaki', 'concept', NULL, 0, 'portfolio/yRs8I3fZLrIWM8SCDRtOu2w6O3QFh7E7k53SrYCR.jpg', NULL, 'ltr', '2026-06-14 02:32:10', '2026-06-27 15:23:52', 1, 0, 0, NULL, NULL),
(36, 'Gate', 'Fantasy Environment', 'concept', NULL, 0, 'portfolio/y1tZwwKLPYUulEHuBNh3xzfITaAZd27pk9rbUnoo.jpg', NULL, 'ltr', '2026-06-14 02:32:10', '2026-06-27 15:24:35', 1, 0, 0, NULL, NULL),
(37, 'River', 'RL Study', 'concept', NULL, 0, 'portfolio/2fm9pgtbIrswFtwEyVSk38lf4pzsvMr4orUcVP7S.jpg', NULL, 'ltr', '2026-06-14 02:32:10', '2026-06-27 15:25:02', 1, 0, 0, NULL, NULL),
(38, 'Bedrot', 'RKGK', 'concept', NULL, 0, 'portfolio/Kjy2nl4WQYjN3uzwnTwbR281OyjTxMfB4KL9R0GG.jpg', NULL, 'ltr', '2026-06-14 02:32:10', '2026-06-27 15:26:28', 1, 0, 0, NULL, NULL),
(39, 'Emilia', 'RKGK', 'concept', NULL, 0, 'portfolio/UnDq0j071ngFaJy1bSPJeYVtKdiyyggF9jvuX9dt.jpg', NULL, 'ltr', '2026-06-14 02:32:10', '2026-06-27 17:30:15', 1, 0, 0, NULL, 'A 30 minute timed sketch requested by viewers in TikTok live.'),
(40, 'Won the Battle, Lost the War', '4 koma', 'concept', NULL, 0, 'portfolio/0MzbMu1MM6z0yk4eT0O6U4L2mpE1pWSeaUlx4Uuk.jpg', NULL, 'ltr', '2026-06-14 02:32:10', '2026-06-27 17:31:43', 1, 1, 44, NULL, 'Gag Comic I made for our school\'s publication'),
(41, 'Aqua', 'Character Illust', 'concept', NULL, 0, 'portfolio/sPvJ2XZIg9YaYx4hYN7GiCQRdW77ROoHVzbGwZDU.jpg', NULL, 'ltr', '2026-06-14 02:32:10', '2026-06-27 17:34:08', 1, 0, 0, NULL, 'Original Character commission'),
(42, 'Retro Sunset Horizon', 'Vibe Art', 'concept', NULL, 0, 'https://images.unsplash.com/photo-1607604276583-eef5d076aa5f?auto=format&fit=crop&q=80&w=800', NULL, 'ltr', '2026-06-14 02:32:10', '2026-06-14 02:32:10', 1, 0, 0, NULL, NULL),
(43, 'Digital Prism Array', 'VFX Concept', 'concept', NULL, 0, 'https://images.unsplash.com/photo-1563089145-599997674d42?auto=format&fit=crop&q=80&w=700', NULL, 'ltr', '2026-06-14 02:32:10', '2026-06-14 02:32:10', 1, 0, 0, NULL, NULL),
(44, 'Vibrant Neon Circle', 'VFX Study', 'concept', NULL, 0, 'https://images.unsplash.com/photo-1515462277126-270d878326e5?auto=format&fit=crop&q=80&w=700', NULL, 'ltr', '2026-06-14 02:32:10', '2026-06-14 02:32:10', 1, 0, 0, NULL, NULL),
(45, 'Space Fantasy Nebula', 'Matte Painting', 'concept', NULL, 0, 'https://images.unsplash.com/photo-1561736778-92e52a7769ef?auto=format&fit=crop&q=80&w=800', NULL, 'ltr', '2026-06-14 02:32:10', '2026-06-14 02:32:10', 1, 0, 0, NULL, NULL),
(46, 'Warm Sunset Horizon', 'Concept Study', 'concept', NULL, 0, 'https://images.unsplash.com/photo-1501183007986-d0d080b147f9?auto=format&fit=crop&q=80&w=750', NULL, 'ltr', '2026-06-14 02:32:10', '2026-06-14 02:32:10', 1, 0, 0, NULL, NULL),
(47, 'Aesthetic Botanical Leaf', 'Texture Design', 'concept', NULL, 0, 'https://images.unsplash.com/photo-1525498128493-380d1990a112?auto=format&fit=crop&q=80&w=700', NULL, 'ltr', '2026-06-14 02:32:10', '2026-06-14 02:32:10', 1, 0, 0, NULL, NULL),
(48, 'Landscape Brush Strokes', 'Stylized Matte', 'concept', NULL, 0, 'https://images.unsplash.com/photo-1536924940846-227afb31e2a5?auto=format&fit=crop&q=80&w=850', NULL, 'ltr', '2026-06-14 02:32:10', '2026-06-14 02:32:10', 1, 0, 0, NULL, NULL),
(49, 'Aesthetic Flower Portrait', 'Color Study', 'concept', NULL, 0, 'https://images.unsplash.com/photo-1520690216874-32cedc35f68c?auto=format&fit=crop&q=80&w=650', NULL, 'ltr', '2026-06-14 02:32:10', '2026-06-14 02:32:10', 1, 0, 0, NULL, NULL),
(50, 'Anime Pastel Sky', 'Environment Sketch', 'concept', NULL, 0, 'https://images.unsplash.com/photo-1518156677180-95a2893f3e9f?auto=format&fit=crop&q=80&w=800', NULL, 'ltr', '2026-06-14 02:32:10', '2026-06-14 02:32:10', 1, 0, 0, NULL, NULL),
(51, 'Abstract Paint Texture', 'Asset Concept', 'concept', NULL, 0, 'https://images.unsplash.com/photo-1549490349-8643362247b5?auto=format&fit=crop&q=80&w=600', NULL, 'ltr', '2026-06-14 02:32:10', '2026-06-14 02:32:10', 1, 0, 0, NULL, NULL),
(52, 'Vibrant Abstract Gradient', 'Lighting Key', 'concept', NULL, 0, 'https://images.unsplash.com/photo-1579546929518-9e396f3cc809?auto=format&fit=crop&q=80&w=800', NULL, 'ltr', '2026-06-14 02:32:10', '2026-06-14 02:32:10', 1, 0, 0, NULL, NULL),
(53, 'Modern Colorful Splash', 'Concept FX', 'concept', NULL, 0, 'https://images.unsplash.com/photo-1547891654-e66ed7edd96c?auto=format&fit=crop&q=80&w=700', NULL, 'ltr', '2026-06-14 02:32:10', '2026-06-14 02:32:10', 1, 0, 0, NULL, NULL),
(54, 'Scenic Mountains Art', 'Matte Painting', 'concept', NULL, 0, 'https://images.unsplash.com/photo-1501472312651-726afd116ff1?auto=format&fit=crop&q=80&w=800', NULL, 'ltr', '2026-06-14 02:32:10', '2026-06-14 02:32:10', 1, 0, 0, NULL, NULL),
(55, 'Colorful Abstract Portrait', 'Stylization Key', 'concept', NULL, 0, 'https://images.unsplash.com/photo-1513364776144-60967b0f800f?auto=format&fit=crop&q=80&w=750', NULL, 'ltr', '2026-06-14 02:32:10', '2026-06-14 02:32:10', 1, 0, 0, NULL, NULL),
(56, 'Remielle Dan', 'Wedding', 'illustration', 'fanart', 0, 'portfolio/Nq4q1SaUfOso7yQ336TeAVmhHRikwAQMKa0EZ9Qk.jpg', NULL, 'ltr', '2026-06-24 10:12:13', '2026-06-24 10:15:04', 1, 0, 0, 'timelapse/xxjMbrxDRwaWCRw4rrWWRdfocd1dYKEzxUwOwI15.mp4', NULL),
(57, 'THE HERTA', 'Gray and Gritty', 'illustration', 'fanart', 0, 'portfolio/ZpzVmDwlhqrcGd3sVPDkWecSnHsem6FrBPZp53g4.jpg', NULL, 'ltr', '2026-06-24 10:18:34', '2026-06-24 10:18:34', 1, 0, 0, 'timelapse/V7cMEZJLaRrmq50lk1XotH4ydu6NSAyvjv6UuG9y.mp4', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('9Er5pMFYglPGmrv6pKYkpDnBl1lj4SjtoqKJiyg9', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'ZXlKcGRpSTZJa0ZaZDNWaFlrbERhVXRPUlhacmIwb3pibkprU0VFOVBTSXNJblpoYkhWbElqb2lRell5TlZCWmJubHhRWFZoV2tzMVJrVjBLM1ZxVW0xMk4yNXVNMVpOVG14Q2NXUldaVTRyZUdSR1JYWjBVVmRFVlZGVlRTOXRMM001ZFVocVVtMW9RekEzYXpSRlpWZERVWEJoUVZkTUwyUmhUa2RTVG1FNVRrVllXRGxHVkhoTVpVaFhiR0YyU3k5aWJrOUNXRTB2WjFVclNIcFFabE1yV0ZGWlpVVjBZMGR0VjBKYU5WVnJaek5zU20xak5ETnhNa1ZYWjI1elpXY3pORWRJWjBGaU5FNW9NRzQyZFVWSE1sSlVTMkZyVTJKQmVubHFlR1JyY0ZSRWFUaENaVVJNYmxoUlVUSnpjMEZXTDNOc1YzVlJSRWR0T0d0eVQwWnVSWGsyWXk5WVZFaGxNVGRrVWtkSk5YRlVaRUl5Y0ZKTGJFcGpTR2RYVG14eVZXbzFZV3RvWVhsTE1pdGxTalJIVGxZeFFYbzRSbTFNY0ZOcVlVODVhMGhQTTNoWk5FUlJSV040Tkc5UmFGcG9RMEU5SWl3aWJXRmpJam9pWkRrelpEWmpOR00xWldabU1UWmhNV1U0TUdSaU1qYzFNek0yWlRFek1EUXlOalJtTVRJeFlUVmlZV0U0WWpVelpEQmhNR1poWWpFeVpURXpOVGRoWVNJc0luUmhaeUk2SWlKOQ==', 1782611853);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'maintenance_illustration', '0', '2026-06-11 20:21:10', '2026-06-11 20:30:44'),
(2, 'maintenance_comic', '1', '2026-06-11 20:21:10', '2026-06-24 10:14:32'),
(3, 'maintenance_concept', '0', '2026-06-11 20:21:10', '2026-06-11 20:30:44'),
(4, 'commission_multiplier_detailed_bg', '50', '2026-06-25 12:01:32', '2026-06-25 12:01:32'),
(5, 'commission_multiplier_source_file', '20', '2026-06-25 12:01:32', '2026-06-25 12:01:32'),
(6, 'commission_multiplier_urgent', '30', '2026-06-25 12:01:32', '2026-06-25 12:01:32'),
(7, 'commission_multiplier_commercial', '50', '2026-06-25 12:01:32', '2026-06-25 12:01:32'),
(8, 'commission_multiplier_additional_character', '50', '2026-06-25 12:01:32', '2026-06-25 12:55:15'),
(9, 'commission_multiplier_with_graphic', '20', '2026-06-25 12:01:32', '2026-06-25 12:01:32'),
(10, 'commission_price_char_sheet_sketch', '80', '2026-06-25 12:55:15', '2026-06-25 12:55:15'),
(11, 'commission_price_char_sheet_flat_color', '140', '2026-06-25 12:55:15', '2026-06-25 12:55:15'),
(12, 'commission_price_char_sheet_fully_rendered', '220', '2026-06-25 12:55:15', '2026-06-25 12:55:15'),
(13, 'commission_price_nsfw', '25', '2026-06-27 15:02:08', '2026-06-27 15:02:08');

-- --------------------------------------------------------

--
-- Table structure for table `social_links`
--

CREATE TABLE `social_links` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `is_visible` tinyint(1) NOT NULL DEFAULT 1,
  `bg_color` varchar(255) DEFAULT NULL,
  `text_color` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social_links`
--

INSERT INTO `social_links` (`id`, `name`, `url`, `is_visible`, `bg_color`, `text_color`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'VGen', 'https://vgen.co/tsuya9', 1, NULL, NULL, 0, '2026-06-27 15:01:26', '2026-06-27 17:56:30'),
(2, 'Instagram', 'https://instagram.com/doodelyan', 1, NULL, NULL, 1, '2026-06-27 15:01:26', '2026-06-27 17:56:30'),
(3, 'Twitter', 'https://twitter.com/yattsu9', 1, NULL, NULL, 2, '2026-06-27 15:01:26', '2026-06-27 17:56:30'),
(4, 'TikTok', 'https://tiktok.com/@doodelyan', 1, NULL, NULL, 3, '2026-06-27 15:01:26', '2026-06-27 17:56:30'),
(5, 'Facebook', 'https://facebook.com/yan.796666', 1, NULL, NULL, 4, '2026-06-27 15:01:26', '2026-06-27 17:57:25'),
(6, 'Commission Calculator', '/commission', 1, NULL, NULL, 6, '2026-06-27 15:01:26', '2026-06-27 17:56:30'),
(7, 'Pixiv', 'https://www.pixiv.net/en/users/37034375', 1, NULL, NULL, 5, '2026-06-27 17:56:26', '2026-06-27 17:56:30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin', '$2y$12$CIjiS0fOED/7W/Elk5rhwuI.9qhM.8dbFgveOFfKIyMJJNbZv2yS.', NULL, '2026-06-09 19:30:28', '2026-06-09 19:30:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_contents`
--
ALTER TABLE `about_contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `commission_tiers`
--
ALTER TABLE `commission_tiers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  ADD KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_views`
--
ALTER TABLE `page_views`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `portfolio_items`
--
ALTER TABLE `portfolio_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indexes for table `social_links`
--
ALTER TABLE `social_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_contents`
--
ALTER TABLE `about_contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `commission_tiers`
--
ALTER TABLE `commission_tiers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `page_views`
--
ALTER TABLE `page_views`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `portfolio_items`
--
ALTER TABLE `portfolio_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `social_links`
--
ALTER TABLE `social_links`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

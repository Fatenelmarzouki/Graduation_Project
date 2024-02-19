-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2024 at 11:56 AM
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
-- Database: `final_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` int(10) UNSIGNED NOT NULL,
  `mark` int(11) NOT NULL DEFAULT 0,
  `behavior` enum('Turbulent','Conformist','Solitary','Friendly') NOT NULL DEFAULT 'Friendly',
  `team_work` enum('Excellent','Very Good','Good','Acceptable') NOT NULL DEFAULT 'Good',
  `performance_evaluation` enum('Excellent','Very Good','Good','Acceptable') NOT NULL DEFAULT 'Good',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `child_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `mark`, `behavior`, `team_work`, `performance_evaluation`, `created_at`, `updated_at`, `child_id`) VALUES
(1, 55, 'Solitary', 'Good', 'Good', '2023-03-15 13:28:55', '2023-06-16 16:25:00', 8),
(2, 13, 'Conformist', 'Good', 'Acceptable', '2023-03-15 13:28:55', '2023-03-15 13:28:55', 3),
(3, 46, 'Friendly', 'Acceptable', 'Acceptable', '2023-03-15 13:28:55', '2023-03-15 13:28:55', 10),
(6, 52, 'Solitary', 'Good', 'Excellent', '2023-03-15 13:29:42', '2023-03-15 13:29:42', 7),
(7, 15, 'Solitary', 'Good', 'Excellent', '2023-03-15 13:29:42', '2023-03-15 13:29:42', 4),
(8, 17, 'Friendly', 'Very Good', 'Acceptable', '2023-03-15 13:29:42', '2023-03-15 13:29:42', 5),
(9, 57, 'Conformist', 'Acceptable', 'Acceptable', '2023-03-15 13:29:43', '2023-03-15 13:29:43', 6),
(14, 89, 'Conformist', 'Good', 'Very Good', '2023-05-24 17:05:54', '2023-05-24 17:58:11', 9);

-- --------------------------------------------------------

--
-- Table structure for table `activitydatasets`
--

CREATE TABLE `activitydatasets` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(45) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `admin_id` int(10) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `activitydatasets`
--

INSERT INTO `activitydatasets` (`id`, `name`, `created_at`, `updated_at`, `admin_id`) VALUES
(1, 'Artistic', '2023-03-15 15:24:15', '2023-03-15 15:24:15', 1),
(2, 'Cultural', '2023-03-15 15:24:15', '2023-03-15 15:24:15', 1),
(3, 'Athletic', '2023-03-15 15:24:15', '2023-03-15 15:24:15', 1),
(4, 'Social', '2023-03-15 15:24:15', '2023-03-15 15:24:15', 1),
(5, 'Scientific', '2023-03-15 15:24:15', '2023-03-15 15:24:15', 1);

-- --------------------------------------------------------

--
-- Table structure for table `activity_emp`
--

CREATE TABLE `activity_emp` (
  `activity_id` int(10) UNSIGNED NOT NULL,
  `emp_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `activity_emp`
--

INSERT INTO `activity_emp` (`activity_id`, `emp_id`) VALUES
(2, 9),
(3, 4),
(3, 10),
(6, 7),
(7, 7),
(8, 2),
(8, 6),
(8, 10),
(9, 6);

-- --------------------------------------------------------

--
-- Table structure for table `add_healths`
--

CREATE TABLE `add_healths` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `father_id` int(10) UNSIGNED NOT NULL,
  `child_id` int(10) UNSIGNED NOT NULL,
  `health_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `add_healths`
--

INSERT INTO `add_healths` (`id`, `name`, `type`, `created_at`, `updated_at`, `father_id`, `child_id`, `health_id`) VALUES
(4, 'Tempora.', 'Nulla.', '2023-03-15 13:55:39', '2023-03-15 13:55:39', 5, 2, 4),
(5, 'Optio.', 'Molestiae.', '2023-03-15 13:55:39', '2023-03-15 13:55:39', 5, 2, 4),
(6, 'Et et.', 'Eligendi.', '2023-03-15 13:55:39', '2023-03-15 13:55:39', 5, 2, 3),
(7, 'Commodi.', 'Et ut.', '2023-03-15 13:56:12', '2023-03-15 13:56:12', 6, 3, 5),
(8, 'Aut vero.', 'Ut non.', '2023-03-15 13:56:12', '2023-03-15 13:56:12', 6, 3, 6),
(9, 'In.', 'Minus.', '2023-03-15 13:56:12', '2023-03-15 13:56:12', 6, 3, 6),
(12, 'new dis', 'new type', '2023-03-15 16:58:56', '2023-03-15 16:58:56', 5, 2, 12),
(13, 'new dis', 'new type', '2023-03-15 16:59:46', '2023-03-15 16:59:46', 5, 2, 13),
(14, 'new dis', 'new type', '2023-03-15 17:00:22', '2023-03-15 17:00:22', 5, 2, 14),
(15, 'new dis', 'new type', '2023-03-15 17:01:57', '2023-03-15 17:01:57', 5, 2, 15),
(19, 'new disssssss', 'new typeeeee', '2023-03-21 12:50:53', '2023-03-21 12:50:53', 5, 2, 27),
(20, 'new disssssss', 'new typeeeee', '2023-03-25 18:24:42', '2023-03-25 18:24:42', 5, 2, 28),
(21, 'new disssssss', 'new typeeeee', '2023-03-27 07:11:52', '2023-03-27 07:11:52', 5, 2, 31),
(22, 'new disssssss', 'new typeeeee', '2023-03-27 07:12:51', '2023-03-27 07:12:51', 5, 2, 32);

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`, `updated_at`, `created_at`) VALUES
(1, 'Rizk@admin.com', '$2y$10$JcmxTGjQPKylOIH0wM2R5Olm2eDMcy2oOvAaSAnNWXHHw4OJQBTYS', '2023-03-15 15:22:47', '2023-03-15 15:22:47'),
(2, 'Faten@admin.com', '$2y$10$gkRT.ClXYHgbOcNhFz1X6.7uHHXorRApyZPxBLz4YYoz0FuneM15u', '2024-02-19 07:17:01', '2024-02-19 07:17:01');

-- --------------------------------------------------------

--
-- Table structure for table `attendences`
--

CREATE TABLE `attendences` (
  `id` int(10) UNSIGNED NOT NULL,
  `attendence_date` date NOT NULL,
  `attendence_status` enum('Presence','Absence') NOT NULL DEFAULT 'Presence',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `child_id` int(10) UNSIGNED NOT NULL,
  `emp_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `attendences`
--

INSERT INTO `attendences` (`id`, `attendence_date`, `attendence_status`, `created_at`, `updated_at`, `child_id`, `emp_id`) VALUES
(1, '2001-12-24', 'Absence', '2023-03-15 13:42:03', '2023-03-15 13:42:03', 2, 9),
(2, '1975-07-01', 'Presence', '2023-03-15 13:42:03', '2023-03-15 13:42:03', 9, 2),
(3, '1975-05-19', 'Absence', '2023-03-15 13:42:03', '2023-03-15 13:42:03', 10, 2),
(4, '2005-11-06', 'Absence', '2023-03-15 13:42:04', '2023-03-15 13:42:04', 10, 8),
(5, '1997-09-12', 'Presence', '2023-03-15 13:42:04', '2023-03-15 13:42:04', 8, 9),
(6, '2003-11-24', 'Presence', '2023-03-15 13:42:04', '2023-03-15 13:42:04', 5, 8),
(7, '1977-05-31', 'Presence', '2023-03-15 13:42:04', '2023-03-15 13:42:04', 7, 9),
(8, '2015-08-22', 'Absence', '2023-03-15 13:42:04', '2023-03-15 13:42:04', 7, 9),
(9, '1981-02-14', 'Presence', '2023-03-15 13:42:04', '2023-03-15 13:42:04', 3, 8),
(13, '2020-05-10', 'Absence', '2023-03-28 21:42:24', '2023-03-28 21:42:24', 2, 2),
(14, '2023-05-18', 'Absence', '2023-05-22 16:52:17', '2023-05-22 16:52:17', 7, 2),
(15, '2023-05-19', 'Absence', '2023-06-06 19:41:05', '2023-06-06 19:41:05', 7, 2);

-- --------------------------------------------------------

--
-- Table structure for table `bandedfoods`
--

CREATE TABLE `bandedfoods` (
  `id` int(10) UNSIGNED NOT NULL,
  `food_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bandedfoods`
--

INSERT INTO `bandedfoods` (`id`, `food_id`, `created_at`, `updated_at`) VALUES
(1, 8, '2023-03-15 14:02:35', '2023-03-15 14:02:35'),
(2, 1, '2023-03-15 14:02:36', '2023-03-15 14:02:36'),
(3, 8, '2023-03-15 14:02:36', '2023-03-15 14:02:36'),
(4, 8, '2023-03-15 14:02:36', '2023-03-15 14:02:36'),
(5, 8, '2023-03-15 14:02:36', '2023-03-15 14:02:36'),
(6, 8, '2023-03-15 14:02:36', '2023-03-15 14:02:36'),
(7, 1, '2023-03-15 14:02:36', '2023-03-15 14:02:36'),
(8, 8, '2023-03-15 14:02:36', '2023-03-15 14:02:36'),
(9, 8, '2023-03-15 14:02:36', '2023-03-15 14:02:36'),
(10, 8, '2023-03-15 14:02:36', '2023-03-15 14:02:36'),
(11, 2, '2023-03-26 22:07:32', '2023-03-26 22:07:32'),
(12, 1, '2023-03-26 22:09:01', '2023-03-26 22:09:01'),
(13, 1, '2023-03-27 06:18:39', '2023-03-27 06:18:39'),
(14, 3, '2023-03-27 06:20:48', '2023-03-27 06:20:48'),
(15, 3, '2023-03-27 06:22:23', '2023-03-27 06:22:23'),
(16, 3, '2023-03-27 06:23:01', '2023-03-27 06:23:01'),
(17, 3, '2023-03-27 07:05:30', '2023-03-27 07:05:30'),
(18, 3, '2023-03-28 22:08:07', '2023-03-28 22:08:07');

-- --------------------------------------------------------

--
-- Table structure for table `bandedfood_child`
--

CREATE TABLE `bandedfood_child` (
  `child_id` int(10) UNSIGNED NOT NULL,
  `bandedfood_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bandedfood_child`
--

INSERT INTO `bandedfood_child` (`child_id`, `bandedfood_id`) VALUES
(2, 10),
(2, 12),
(2, 13),
(2, 14),
(2, 15),
(2, 16),
(2, 17),
(7, 2),
(7, 5),
(10, 8),
(10, 9);

-- --------------------------------------------------------

--
-- Table structure for table `bandedfood_emp`
--

CREATE TABLE `bandedfood_emp` (
  `emp_id` int(10) UNSIGNED NOT NULL,
  `bandedfood_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bandedfood_emp`
--

INSERT INTO `bandedfood_emp` (`emp_id`, `bandedfood_id`) VALUES
(1, 5),
(2, 8),
(3, 5),
(6, 1),
(6, 4),
(8, 3);

-- --------------------------------------------------------

--
-- Table structure for table `children`
--

CREATE TABLE `children` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `grade` enum('1','2','3','4','5','6') NOT NULL DEFAULT '1',
  `gender` enum('male','female') NOT NULL DEFAULT 'male',
  `health_condition` enum('normal','special') NOT NULL DEFAULT 'normal',
  `image` varchar(100) DEFAULT NULL,
  `height` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `blood` enum('A+','A-','B+','B-','AB+','AB-','O+','O-') NOT NULL DEFAULT 'A+',
  `class` enum('A','B','C') NOT NULL DEFAULT 'A',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `admin_id` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `father_id` int(10) UNSIGNED NOT NULL,
  `activitydataset_id` int(10) UNSIGNED NOT NULL,
  `qr_code` text DEFAULT NULL,
  `child_code` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `children`
--

INSERT INTO `children` (`id`, `name`, `age`, `grade`, `gender`, `health_condition`, `image`, `height`, `weight`, `blood`, `class`, `created_at`, `updated_at`, `admin_id`, `father_id`, `activitydataset_id`, `qr_code`, `child_code`) VALUES
(2, 'Shemar', 12, '1', 'female', 'special', NULL, 88, 60, 'O+', 'B', '2023-03-15 13:27:13', '2023-03-15 13:27:13', 1, 5, 2, NULL, NULL),
(3, 'Garrison', 12, '3', 'male', 'normal', NULL, 84, 51, 'AB+', 'C', '2023-03-15 13:27:13', '2023-03-15 13:27:13', 1, 6, 5, NULL, NULL),
(4, 'Karley', 10, '3', 'male', 'special', NULL, 136, 63, 'A+', 'C', '2023-03-15 13:27:13', '2023-03-15 13:27:13', 1, 8, 3, NULL, NULL),
(5, 'Alexandra', 14, '1', 'female', 'special', NULL, 107, 37, 'AB-', 'B', '2023-03-15 13:27:13', '2023-03-15 13:27:13', 1, 10, 1, NULL, NULL),
(6, 'Marie', 9, '1', 'female', 'special', NULL, 127, 35, 'O+', 'B', '2023-03-15 13:27:13', '2023-03-15 13:27:13', 1, 9, 2, NULL, NULL),
(7, 'Chaz', 12, '1', 'male', 'normal', NULL, 131, 25, 'A-', 'C', '2023-03-15 13:27:13', '2023-03-15 13:27:13', 1, 3, 4, NULL, NULL),
(8, 'Eloisa', 11, '1', 'female', 'special', NULL, 128, 48, 'AB-', 'C', '2023-03-15 13:27:14', '2023-03-15 13:27:14', 1, 4, 5, NULL, NULL),
(9, 'Fern', 8, '1', 'male', 'normal', NULL, 150, 46, 'AB-', 'C', '2023-03-15 13:27:14', '2023-03-15 13:27:14', 1, 2, 5, NULL, NULL),
(10, 'Tremayne', 9, '1', 'male', 'special', NULL, 105, 68, 'O+', 'C', '2023-03-15 13:27:14', '2023-03-15 13:27:14', 1, 7, 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `child_emp`
--

CREATE TABLE `child_emp` (
  `child_id` int(10) UNSIGNED NOT NULL,
  `emp_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `child_emp`
--

INSERT INTO `child_emp` (`child_id`, `emp_id`) VALUES
(2, 2),
(2, 9),
(5, 3),
(5, 8),
(8, 8);

-- --------------------------------------------------------

--
-- Table structure for table `child_selectedfood`
--

CREATE TABLE `child_selectedfood` (
  `selected_food_id` int(10) UNSIGNED NOT NULL,
  `child_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `child_selectedfood`
--

INSERT INTO `child_selectedfood` (`selected_food_id`, `child_id`) VALUES
(1, 6),
(2, 10),
(5, 2),
(5, 5),
(5, 6),
(9, 2),
(11, 2),
(15, 2),
(22, 2);

-- --------------------------------------------------------

--
-- Table structure for table `child_subject`
--

CREATE TABLE `child_subject` (
  `child_id` int(10) UNSIGNED NOT NULL,
  `subject_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `child_subject`
--

INSERT INTO `child_subject` (`child_id`, `subject_id`) VALUES
(3, 5),
(4, 8),
(6, 15),
(7, 4),
(7, 16),
(7, 17),
(7, 18),
(7, 19),
(7, 20),
(8, 12),
(8, 13),
(8, 14),
(9, 4);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `job_title` enum('Doctor','Teacher','Manager','Seller','Specialist') NOT NULL DEFAULT 'Teacher',
  `image` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `access_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `admin_id` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `subjectdataset_id` int(10) UNSIGNED DEFAULT NULL,
  `activitydataset_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `email`, `password`, `job_title`, `image`, `address`, `phone`, `access_token`, `created_at`, `updated_at`, `admin_id`, `subjectdataset_id`, `activitydataset_id`) VALUES
(1, 'Jasper Dickinson', 'qsawayn@yahoo.com', '$2y$10$xRhqtvSpy/aytsyljULCFOh0c1FKIJ9tcJCIsK3/YzUp0Nns2Ba4y', 'Seller', 'https://via.placeholder.com/640x480.png/007744?text=voluptatem', '733 Oberbrunner Stream Suite 840\nWest Dorcasville, AK 63087', '(510) 813-6487', 'hBS7y5nrdX9Xj1kNuPjOxdb0qt3UJhkuvU78WiOolrUtCgQGLTDYRFlA0aifhp8r', '2023-03-15 13:25:30', '2023-05-12 11:35:54', 1, NULL, NULL),
(2, 'mohammed', 'emerald.wiegand@abernathy.com', '$2y$10$IRZQ.sqBdbu9715M6ZqGRO0OcF4Ty.cSrxE7UPfILXWTH1A0NC/Eu', 'Teacher', NULL, 'opopkokpokd', '012548754818', 'Gg8WC7ZJgyneYKyX6FGFj7XFQmwlIIzdBQVKfavi9TzO0gVD2geM5cjlHaUPgGeu', '2023-03-15 13:25:30', '2023-06-06 20:05:30', 1, 4, NULL),
(3, 'Kian Rowe I', 'iarmstrong@yahoo.com', '$2y$10$kp.goVd1fjz/QzfXnJ9d0O0EaebhW4D1UIfRKF8wmnacNnIFILLc2', 'Seller', 'https://via.placeholder.com/640x480.png/0000ee?text=provident', '61273 Bridget Curve\nChanellemouth, WA 56303', '+1 (380) 549-2168', 'ON4jXuG4fuax2jrklD9DCoM2RzvdGOAjrcPzIUNgf3obzhXcwJTIxwfNk9gnQiAo', '2023-03-15 13:25:30', '2023-03-15 13:25:30', 1, NULL, NULL),
(4, 'kolplko', 'cassandre83@gmail.com', '$2y$10$qkuu5WYljFGIGrQMHJ944eueKPAO4gPEQtU05JIwkbCOMvTF8elEW', 'Teacher', 'Emp Images/BsgWzMz9uryhIX9mO6ExlQ4HD4ektOqwrgEfCXgF.png', 'opopkokpokd', '012548754818', '1y5UltL5kR84oO8JePSKwG8UnPp5KuA3TkXM9EiPkVBYWQtSy0RwG5UaPw6pQhP5', '2023-03-15 13:25:30', '2023-05-24 19:30:38', 1, NULL, 5),
(5, 'Camron Barton', 'pprice@gmail.com', '$2y$10$iPDJLNV7G1bTBPQRGlhGhe1MR9VgQlFgkvPky2Nr0za.TIVVHCLGG', 'Teacher', 'https://via.placeholder.com/640x480.png/0011aa?text=numquam', '5854 Maryse Cape Apt. 081\nHegmannville, NM 28543', '1-970-669-6246', 'IwzfashyGEyQv4jj0JTmio5J5gGWquWdxzzeBciQblYbor9YV0nQYCBSBoKjHqXa', '2023-03-15 13:25:30', '2023-03-15 13:25:30', 1, 2, NULL),
(6, 'Prof. Damian Rippin PhD', 'rhiannon.goldner@bernhard.com', '$2y$10$JzpQKy32qVRaefHEjhlHrOfG7A.c.oZJiTqkv8pvuclPQXp0N1ezG', 'Teacher', 'https://via.placeholder.com/640x480.png/007700?text=adipisci', '38764 Waelchi Ridge\nDelphineland, DE 88107', '1-734-341-1753', 'zbsCdnlQvBGbwaN3LwO4WM0DsDhsiuxilBSiXTQAHoynYUFfYLd33RfV8ZLDCuUM', '2023-03-15 13:25:30', '2023-03-15 13:25:30', 1, NULL, 3),
(7, 'popdoc', 'violet.maggio@yahoo.com', '$2y$10$ytS7cEqzxf7xzfxbdf/DSuGWYUhkIfhtgJf.US8beHa0mnAm15tzS', 'Doctor', NULL, 'lopkk jhhk hhjn', '015124814578', 'MQgNjuUDmr3kiqf4ef50MnlaVQt1kVMGU2uWPgVMOcSqgk0ItWEmtvVJ4oe5COLB', '2023-03-15 13:25:30', '2023-05-14 06:34:46', 1, NULL, NULL),
(8, 'Prof. Deja Osinski Jr.', 'mbernhard@schimmel.info', '$2y$10$4eqcHBHMGdXd5UIFikI04OBIzvQM8sOUgU9vwfFjdY3.mSh4/fVgG', 'Specialist', 'https://via.placeholder.com/640x480.png/001144?text=consequatur', '1327 Augustus Trail\nLake Coychester, KS 83942-2347', '1-283-284-4645', 'DjNnLTT91pBkumbkQQDHs2mfaEOPV1P6jUx1FDE2kRSzFxJFdnfnIUvE6SocIRTj', '2023-03-15 13:25:30', '2023-03-15 13:25:30', 1, NULL, NULL),
(9, 'Woodrow Effertz', 'alessia.braun@gmail.com', '$2y$10$JNFd2VhxqqewWx.7/7gWEe.4IJ3eTWVYAYx7RmicDoycjZjp8WEne', 'Manager', 'https://via.placeholder.com/640x480.png/005511?text=sed', '49245 Frami Vista\nDanielaton, TX 44167-5876', '1-551-793-8198', 'ck4r7nGBEcIIyPeuediBoVb9OLlVJUudMqcTYHE6vv6ZEDlccU2olLqvHcMHWF2P', '2023-03-15 13:25:30', '2023-05-23 15:36:15', 1, NULL, NULL),
(10, 'Susan Schuster', 'russel.jonatan@yahoo.com', '$2y$10$Cy5rgIH90TCyTjlfoDauWu9UlMQwrsRyalTzFME7CrW0jjogLnCjC', 'Teacher', 'https://via.placeholder.com/640x480.png/00ffcc?text=dolorum', '9118 Kennedy Stream\nSouth Gregory, ID 35881', '+1 (283) 879-6932', 'Yu52O1Xe6D0ozEcmkbbhs1rTmp9yeVzh98r2n9SmxbqkNndwyiGYBtahP7J3Md2U', '2023-03-15 13:25:30', '2023-03-15 13:25:30', 1, NULL, 4),
(11, 'iop', 'gh@ghy.com', '123456789789', 'Teacher', NULL, 'hgjfffm fjh', '012236556879', 'SPGgParTGTbqSPtxW3vhY9omGSlhxSoCmmp8zlu6Yycjema3rKZOMKoDOWOXUho4', '2023-03-26 09:24:18', '2023-03-26 09:10:00', 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `emp_food`
--

CREATE TABLE `emp_food` (
  `emp_id` int(10) UNSIGNED NOT NULL,
  `food_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `emp_food`
--

INSERT INTO `emp_food` (`emp_id`, `food_id`) VALUES
(1, 1),
(5, 2),
(7, 2),
(8, 5),
(10, 2),
(10, 5);

-- --------------------------------------------------------

--
-- Table structure for table `fathers`
--

CREATE TABLE `fathers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `gender` enum('male','female') NOT NULL DEFAULT 'male',
  `image` varchar(100) DEFAULT NULL,
  `status` enum('accepted','rejected') NOT NULL DEFAULT 'rejected',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `access_token` varchar(100) DEFAULT NULL,
  `username` varchar(100) NOT NULL DEFAULT 'parent',
  `admin_id` int(10) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fathers`
--

INSERT INTO `fathers` (`id`, `name`, `email`, `password`, `address`, `phone`, `gender`, `image`, `status`, `created_at`, `updated_at`, `access_token`, `username`, `admin_id`) VALUES
(2, 'Tony Steuber', 'harry.miller@yahoo.com', '$2y$10$l3Ay0IB1NQ66w2xAgqzpQ.wuVQ5IJHYBVkclPyEhx.HdqkKzUDpre', '71347 Unique Cove\nLake Joeyton, WY 52512-8748', '+16122592960', 'male', NULL, 'rejected', '2023-03-15 13:26:16', '2023-05-14 06:23:42', '9ETJ1vxOIT4iqyvdOT52fHur38crHwIks7xWPh9a6Eaet5gb733yyWsDGKyvkyRD', 'parentFranco', 1),
(3, 'Deshaun Reynolds', 'brant.pfeffer@heller.biz', '$2y$10$6IGUgo09FBPVlBNSj8KhNejayi1zq/NR9Jg.tpA6L7aUMLHqHAX2K', '8435 Wisozk Prairie Suite 587\nRebecatown, NC 98774-9155', '+1 (718) 880-6800', 'male', NULL, 'rejected', '2023-03-15 13:26:16', '2023-03-15 13:26:16', 'ro8E6CptScrz6rQuniPhvodZhJ2Dln03undHQY5kuoPhSc0BYn2baipNWsxbMdgK', 'parentPreston', 1),
(4, 'Victor Crist', 'ohara.kelli@hotmail.com', '$2y$10$GHWXTHSFNNhN/IRk3.WYVeSLlfl6y5cIQXJC76W32YfBrAwj0qohq', '76805 Shaina Lodge\nDenesikborough, UT 99305', '562.524.6810', 'male', NULL, 'rejected', '2023-03-15 13:26:16', '2023-05-12 11:34:50', 'jpVsckguusoA9KwT5LmqLyhLOlFVHLkDZzVUSdjHA7kSF6cYKgH2HgzVpxNszybq', 'parentOrville', 1),
(5, 'Elias Satterfield', 'lakin.sheila@jones.com', '$2y$10$dfQ6NvdeBFL.fiQyF03fRevSZUW107Ig7Wek40T/R/9YRhmVn3Zq6', '881 Connelly Plains Suite 364\nEast Lindsey, AZ 26241', '1-678-503-8106', 'male', NULL, 'rejected', '2023-03-15 13:26:16', '2023-03-15 13:26:16', 'I17OEed3HBnfpky83FUS8p6IiTmb1IW32l5gptQQAZ5ztYTjPGTQHZ4tP0S4Yk6s', 'parentJanick', 1),
(6, 'Cloyd Osinski', 'niko93@green.net', '$2y$10$7dLgJLB9Dl6fhmMLGeEKI.i5EX3ROIHPKc7ykyae2c1UcFqidRIxa', '651 Luettgen Landing\nEast Mertie, WI 91795-7276', '312.354.6358', 'male', NULL, 'rejected', '2023-03-15 13:26:16', '2023-03-15 13:26:16', '3agnYE73xqr6eWlrwOEgpaoUwMHB3VGCxCZibbVATAIQ9KmmVzJ0GmY43jjP5vHy', 'parentFredy', 1),
(7, 'John Gerlach', 'camilla.barrows@kuvalis.com', '$2y$10$0/ejdq.luodPrO5lHlFkeOlWaielTYmx2Qy93/AIOocZI/5KuJ6h6', '38492 Cheyenne Islands\nEbertmouth, IA 76907', '850-241-5023', 'male', NULL, 'rejected', '2023-03-15 13:26:16', '2023-03-15 13:26:16', 'QfHkRU9ETP9PkoIuX6pwKFcGycA6AMPTr6YADzIbGgXerYQYxEPvqkSMMCQs08WM', 'parentTerrell', 1),
(8, 'Melisa O\'Connell', 'pietro.jones@effertz.com', '$2y$10$XkYW75uC3goSSygZtICs7OagYMJcjC/nR4FQG4eBMVE9wBb9TVaKa', '22577 Shayna Ranch\nEmelyfurt, OK 29558', '(812) 527-3173', 'female', NULL, 'rejected', '2023-03-15 13:26:16', '2023-03-15 13:26:16', 'KMmqD6c1vZWkh3zkKuutvWOaGNUNpI8iDUYndbpsAgw7h20Qal29RJ3Qwe9SxwhS', 'parentIva', 1),
(9, 'Ned Weissnat', 'pkiehn@hotmail.com', '$2y$10$IbjHVUym8AUSmw4SSjetHOrOTyM.Q9ztfbnv7Yh9Hhul.v60xi.ua', '781 Pouros Spurs\nLake Jalynborough, GA 17412', '+15714602876', 'male', NULL, 'rejected', '2023-03-15 13:26:16', '2023-03-15 13:26:16', 'cbDHAqu3KriLtEWBA9fZexuYfc2dk64EGQgLvPs8NXXoiIpAjDjJlOuja7ghgtOE', 'parentDillon', 1),
(10, 'Delphia Osinski', 'yesenia.parker@hotmail.com', '$2y$10$jJfFCSYH7I.hdc4psQQ67O70wLYXjzpfC2YcHFITrkTJK7x5CO4bi', '11302 Jacobs Dam Apt. 738\nHandport, RI 25824-8742', '1-831-413-8857', 'female', NULL, 'rejected', '2023-03-15 13:26:16', '2023-03-15 13:26:16', 'ZfvoiwBdqrgxb1OE6s1GN7U9NGVxQBsRvslY5NkQqthBqnEYcLbqHRoCPdpwjcl3', 'parentHerta', 1),
(11, 'lkmol', 'hghg@r.com', '$2y$10$wWgcDZhm.hRJOSqRUDN5POoow.XruO2XpmjoGvxI7SoL90xIF5eqO', 'jfjgkjs', '458755', 'male', NULL, 'rejected', '2023-03-21 09:21:59', '2023-03-21 09:21:59', 'zffZdO0hcTqNsQcc9Qg4QjDdmsuV3HmPwzegGwvgDxSq4vBvsi4OYh4KGgvPaon6', 'parent', 1),
(12, 'lkmol', 'hghg@r.com', '$2y$10$rji/UZYvtKdwFNjFRw16juRyNQgnKgFdegC2MZKnSCYAdG4HbG8ty', 'jfjgkjs', '458755', 'male', NULL, 'rejected', '2023-03-21 09:23:08', '2023-03-21 09:23:08', 'rnttE73L7inMx49jrDje2qquM5wbXWMzzWIZawO4XDEdBTgWouEVa3P6baNpsYef', 'lkmol parent', 1),
(13, 'lk', 'hghg@r.com', '$2y$10$MZxcZkd.k6lb0lTHMWNjwuIJxdgJSQjQjS3E3.GVCKzVoElhpnCZq', 'jfjgkjs', '458755', 'male', NULL, 'rejected', '2023-03-21 09:23:51', '2023-03-21 09:23:51', '3JjG19hkPkJfYAXwQ6TzWv3i2TEWF1NhSnTRxuahyZnsyzcY4QNPcCuUGiA56y7M', 'lk parent', 1),
(14, 'mnoib', 'hghg@r.com', '$2y$10$TN5cX8xRzYwrFATo2VVJuu3i7uP4FaBNyYELTBh0L5gWpn.D3hx1G', 'jfjgkjs', '458755', 'male', NULL, 'rejected', '2023-03-21 09:24:48', '2023-03-21 09:24:48', 'F2kEr3RuTlcSVMxdpBNYRqSFGdfGYHPmxuMo44l1mbmKpeORBY8wUFKeQ987fBcn', 'parent mnoib', 1),
(15, 'mnoib', 'hghg@r.com', '$2y$10$IGYQ5k9HD5RwvtMVGPvBkeM4zWkyOoEIXFxPkZDSLKeMK/VACV/FK', 'jfjgkjs', '458755', 'male', NULL, 'rejected', '2023-03-25 12:13:28', '2023-03-25 12:13:28', 'sB1stqHDa92sa3WVhGf6eltOSXgxRhUCreHmNFn0qoVJ31lncxfGGQWWnOlug5Qo', 'parent mnoib', 1),
(16, 'mnjhu', 'fkslfg@r.com', '$2y$10$27hlC3gixwt0Kp9abZMk/ONGscJHlPMO5PZidxmzxk6z4FVNib7c6', 'jdsldijvv', '45875557', 'male', 'FatherImages/JAAIlq571qohlAXfiBZ6NmBjeGFmNvuDZmEnDZZ8.png', 'rejected', '2023-03-25 12:15:42', '2023-03-25 12:15:42', '7Ss08O4TVNrwEKJtzwhrJgmrjYmJgxNDhtfiJrDpGd8zIlpkeR82uU6InHqnhwta', 'parent mnjhu', 1),
(17, 'mnjhu', 'fkslfg@r.com', '$2y$10$0V4AYAZvns0VSXIsI4s8ze7X2d.pJpToiyg7DX5ifhG/y/K11A.zS', 'jdsldijvv', '45875557', 'male', 'FatherImages/Mtwq6WLSs2XeobBbg0KqNDPpgMolOG2Y849SRNHe.png', 'rejected', '2023-03-25 12:18:22', '2023-03-25 12:18:22', 'lgKLM6zPfnTu7BbBJKzjrc3gjXbiuj0HoWkpOLneGQVBnMG9Jz4iTdTyxwmQM3Ln', 'parent mnjhu', 1),
(18, 'mnjhu475', 'fkslfg@r.com', '$2y$10$MigzPPYqjml3xpqFaz7EDOHLuoOH50X1mmEkis3ZGuEjwm5B3bFYe', 'jdsldijvv', '45875557', 'male', 'FatherImages/QgOgsUR6HyTJhmYXSMUugPiByOqcAYPc6F2c5ElF.png', 'rejected', '2023-03-25 12:19:14', '2023-03-25 12:19:14', 'RPXkyqJWzjG6QBIJmVjAAe0xkTvNUvpoErxD70ycBgmcmi2bYtj2QcZeKYz06YwP', 'parent mnjhu475', 1),
(19, 'mko 23', 'fg@r.com', '$2y$10$7a/PWTggs1tCHUQoWDHxwu6KrS0wiHP56ws3y1YB1CVUtRjBegVSS', 'jdsldijvv', '45875557', 'male', 'FatherImages/Hn27YyVSrCYcqsAtcD7s0t2q7zzxqC3v5bZ67NE2.png', 'rejected', '2023-03-26 06:59:41', '2023-03-27 08:26:03', 'cFKUnXFoWwQjUBPeJbWrNfuiBNi4MurKh2URoQQKoGUXGymOi5xA9qiCy7fpKHHB', 'parent mko 23', 1),
(20, 'mlop', 'o@fer.com', '$2y$10$ptGwIDMYOAV5qMCzocmXyu9xVSjgfnRtdH0CJ/9ebz4RQNeBOU/MS', 'jfjgkjs', '458755', 'male', NULL, 'rejected', '2023-05-07 07:16:30', '2023-05-11 13:29:50', 'eYPswKBsot7hOamzDBZuKUJDCXxj9y7komBbf2lBiXB96vcE6WD9GqiATzVxocfm', 'parent mlop', 1);

-- --------------------------------------------------------

--
-- Table structure for table `father_food`
--

CREATE TABLE `father_food` (
  `father_id` int(10) UNSIGNED NOT NULL,
  `food_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `father_food`
--

INSERT INTO `father_food` (`father_id`, `food_id`) VALUES
(3, 3),
(3, 7),
(7, 2);

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `calories` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `admin_id` int(10) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`id`, `name`, `calories`, `created_at`, `updated_at`, `admin_id`) VALUES
(1, 'Chocolate', 375, '2023-03-15 13:30:59', '2023-03-15 13:30:59', 1),
(2, 'Candy', 320, '2023-03-15 13:30:59', '2023-03-15 13:30:59', 1),
(3, 'Soda', 362, '2023-03-15 13:30:59', '2023-03-15 13:30:59', 1),
(4, 'Dount', 129, '2023-03-15 13:31:00', '2023-03-15 13:31:00', 1),
(5, 'Cookies', 428, '2023-03-15 13:31:00', '2023-03-15 13:31:00', 1),
(6, 'Juice', 205, '2023-03-15 13:31:00', '2023-03-15 13:31:00', 1),
(7, 'Biscuits', 303, '2023-03-15 13:31:00', '2023-03-15 13:31:00', 1),
(8, 'Chips', 124, '2023-03-15 13:31:00', '2023-03-15 13:31:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `healthdatasetnames`
--

CREATE TABLE `healthdatasetnames` (
  `id` int(10) UNSIGNED NOT NULL,
  `dis_name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `admin_id` int(10) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `healthdatasetnames`
--

INSERT INTO `healthdatasetnames` (`id`, `dis_name`, `created_at`, `updated_at`, `admin_id`) VALUES
(1, 'Heart', '2023-03-15 13:41:28', '2023-03-15 13:41:28', 1),
(2, 'Diabetes', '2023-03-15 13:41:29', '2023-03-15 13:41:29', 1),
(3, 'Allergic', '2023-03-15 13:41:29', '2023-03-15 13:41:29', 1),
(4, 'Vision Impairment', '2023-03-15 13:41:29', '2023-03-15 13:41:29', 1),
(5, 'Food', '2023-03-26 23:06:43', '2023-03-26 23:06:43', 1);

-- --------------------------------------------------------

--
-- Table structure for table `healthdatasetname_health`
--

CREATE TABLE `healthdatasetname_health` (
  `health_id` int(10) UNSIGNED NOT NULL,
  `healthdatasetname_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `healthdatasetname_health`
--

INSERT INTO `healthdatasetname_health` (`health_id`, `healthdatasetname_id`) VALUES
(3, 3),
(5, 2),
(6, 3),
(7, 2),
(8, 4),
(9, 3),
(24, 2),
(29, 1),
(30, 2);

-- --------------------------------------------------------

--
-- Table structure for table `healthdatasettypes`
--

CREATE TABLE `healthdatasettypes` (
  `id` int(10) UNSIGNED NOT NULL,
  `dis_type` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `admin_id` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `healthdatasetname_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `healthdatasettypes`
--

INSERT INTO `healthdatasettypes` (`id`, `dis_type`, `created_at`, `updated_at`, `admin_id`, `healthdatasetname_id`) VALUES
(1, 'ty1_1', '2023-03-15 13:41:46', '2023-03-15 13:41:46', 1, 1),
(2, 'de2_1', '2023-03-15 13:41:46', '2023-03-15 13:41:46', 1, 2),
(3, 'de2_2', '2023-03-15 13:41:46', '2023-03-15 13:41:46', 1, 2),
(4, 'de2_3', '2023-03-15 13:41:46', '2023-03-15 13:41:46', 1, 2),
(5, 'all3_1', '2023-03-15 13:41:46', '2023-03-15 13:41:46', 1, 3),
(6, 'type_7', '2023-03-15 13:41:47', '2023-03-15 13:41:47', 1, 4),
(7, 'type_5', '2023-03-15 13:41:47', '2023-03-15 13:41:47', 1, 4),
(8, 'all3_2', '2023-03-15 13:41:47', '2023-03-15 13:41:47', 1, 3),
(9, 'ty1_2', '2023-03-15 13:41:47', '2023-03-15 13:41:47', 1, 1),
(10, 'all3_3', '2023-03-15 13:41:47', '2023-03-15 13:41:47', 1, 3),
(11, 'type_2', '2023-03-15 13:41:47', '2023-03-15 13:41:47', 1, 4),
(12, 'type_3', '2023-03-15 13:41:47', '2023-03-15 13:41:47', 1, 4),
(13, 'ty1_3', '2023-03-21 10:02:07', '2023-03-21 10:02:07', 1, 1),
(14, 'ty1_4', '2023-03-21 10:02:07', '2023-03-21 10:02:07', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `healthdatasettype_health`
--

CREATE TABLE `healthdatasettype_health` (
  `health_id` int(10) UNSIGNED NOT NULL,
  `healthdatasettype_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `healthdatasettype_health`
--

INSERT INTO `healthdatasettype_health` (`health_id`, `healthdatasettype_id`) VALUES
(3, 4),
(3, 5),
(6, 8),
(6, 10),
(7, 1),
(7, 2),
(10, 2),
(24, 2),
(29, 3),
(30, 2);

-- --------------------------------------------------------

--
-- Table structure for table `healths`
--

CREATE TABLE `healths` (
  `id` int(10) UNSIGNED NOT NULL,
  `banded_food` varchar(100) DEFAULT NULL,
  `medicien` varchar(255) DEFAULT NULL,
  `medical_analysis` varchar(100) DEFAULT NULL,
  `personal_comment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `father_id` int(10) UNSIGNED NOT NULL,
  `child_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `healths`
--

INSERT INTO `healths` (`id`, `banded_food`, `medicien`, `medical_analysis`, `personal_comment`, `created_at`, `updated_at`, `father_id`, `child_id`) VALUES
(3, 'Juice', 'mkiou', NULL, NULL, '2023-03-15 13:33:19', '2023-03-27 08:49:58', 5, 2),
(4, 'Chocolate', 'Oflo muran', NULL, 'Quod sit et quae sit sit similique. Labore molestias voluptatem omnis.', '2023-03-15 13:33:20', '2023-03-15 13:33:20', 5, 2),
(5, 'Dount', 'Brimo trol', NULL, 'Minima aut labore illo eum ut. Harum iusto voluptatem sed eligendi sit nihil. Numquam vero qui qui.', '2023-03-15 13:33:28', '2023-03-15 13:33:28', 6, 3),
(6, 'Chips', 'Retro sumab', NULL, 'Porro minus quisquam tempore vel. Quia temporibus id cupiditate optio numquam.', '2023-03-15 13:33:28', '2023-03-15 13:33:28', 6, 3),
(7, 'Soda', 'Flexi sonide', NULL, 'mnjuikhjl  jbkvklvj', '2023-03-15 13:33:36', '2023-03-25 23:58:20', 8, 4),
(8, 'Dount', 'Agene pizole', NULL, 'Non rerum dolores adipisci et. Sit ab sit dolor placeat esse ut maxime.', '2023-03-15 13:33:36', '2023-03-15 13:33:36', 8, 4),
(9, 'Chocolate', 'Cabo lin', NULL, 'Ipsa delectus modi est. Odio deserunt hic aliquid blanditiis voluptatem.', '2023-03-15 13:33:46', '2023-03-15 13:33:46', 10, 5),
(10, 'Juice', 'Gluco zole', NULL, 'Voluptates vitae eum et. Exercitationem quod enim odio modi est unde libero nam.', '2023-03-15 13:33:46', '2023-03-15 13:33:46', 10, 5),
(12, 'band', 'lop', NULL, 'fdvbkdfabvjf vigieav', '2023-03-15 16:58:55', '2023-03-15 16:58:55', 5, 2),
(13, 'band', 'lop', '', 'fdvbkdfabvjf vigieav', '2023-03-15 16:59:46', '2023-03-15 16:59:46', 5, 2),
(14, 'band', 'lop', '', 'fdvbkdfabvjf vigieav', '2023-03-15 17:00:22', '2023-03-15 17:00:22', 5, 2),
(15, 'band', 'lop', '', 'fdvbkdfabvjf vigieav', '2023-03-15 17:01:57', '2023-03-15 17:01:57', 5, 2),
(17, NULL, 'ploolk', '', 'hvjghgkvhcjch', '2023-03-16 10:27:23', '2023-03-16 10:27:23', 2, 5),
(18, NULL, 'ploolk', '', 'hvjghgkvhcjch', '2023-03-16 10:28:22', '2023-03-16 10:28:22', 2, 5),
(19, NULL, 'ploolk', '', 'hvjghgkvhcjch', '2023-03-16 10:32:29', '2023-03-16 10:32:29', 2, 5),
(20, NULL, 'ploolk', '', 'hvjghgkvhcjch', '2023-03-16 10:44:44', '2023-03-16 10:44:44', 2, 5),
(21, NULL, 'ploolk', '', 'hvjghgkvhcjch', '2023-03-16 10:55:43', '2023-03-16 10:55:43', 2, 5),
(22, NULL, 'ploolk', '', 'hvjghgkvhcjch', '2023-03-16 11:07:57', '2023-03-16 11:07:57', 2, 5),
(23, NULL, 'ploolk', '', 'hvjghgkvhcjch', '2023-03-16 11:09:13', '2023-03-16 11:09:13', 2, 5),
(24, 'cyrdtgkc', 'ploolk', '', 'hvjghgkvhcjch', '2023-03-16 12:03:52', '2023-03-16 12:03:52', 5, 2),
(27, 'band', 'loppppppp', '', 'gfg vigieav', '2023-03-21 12:50:53', '2023-03-21 12:50:53', 5, 2),
(28, 'booo', 'loppppppp', '', 'gfg vigieav', '2023-03-25 18:24:42', '2023-03-25 18:24:42', 5, 2),
(29, 'cyrdtgkc', 'ploolk', NULL, 'mnjuikhjl nbjglkugl hghg', '2023-03-25 18:33:50', '2023-05-07 07:34:33', 5, 2),
(30, 'cyrdtgkc', 'ploolk', 'MedicalAnalysis/WGmCccoFfBamdcSEFaqnWEEzlthJAwoVjoE30Kvc.png', 'hvjghgkvhcjch', '2023-03-26 08:06:45', '2023-03-26 08:06:45', 5, 2),
(31, 'booomk', 'loppppppp', 'MedicalAnalysis/jy0j7NRoiBi48XtH01tmvADedDGapJt5PGQrfGXE.png', 'gfg vigieav', '2023-03-27 07:11:52', '2023-03-27 07:11:52', 5, 2),
(32, 'booomk', 'loppppppp', NULL, 'gfg vigieav', '2023-03-27 07:12:51', '2023-03-27 07:12:51', 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `health_emp`
--

CREATE TABLE `health_emp` (
  `health_type` int(10) UNSIGNED NOT NULL,
  `emp_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `health_emp`
--

INSERT INTO `health_emp` (`health_type`, `emp_id`) VALUES
(3, 8),
(6, 6),
(6, 7),
(8, 7),
(9, 7);

-- --------------------------------------------------------

--
-- Table structure for table `health_reports`
--

CREATE TABLE `health_reports` (
  `id` int(10) UNSIGNED NOT NULL,
  `report` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `father_id` int(10) UNSIGNED NOT NULL,
  `child_id` int(10) UNSIGNED NOT NULL,
  `emp_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `health_reports`
--

INSERT INTO `health_reports` (`id`, `report`, `created_at`, `updated_at`, `father_id`, `child_id`, `emp_id`) VALUES
(4, 'Eos ab quis et facilis nisi. Ipsam consequuntur reiciendis placeat molestiae a. Ut atque maxime assumenda.', '2023-03-15 13:36:26', '2023-03-15 13:36:26', 5, 2, 7),
(5, 'Magni in qui laboriosam repellendus. Iure dolorum perferendis sint et reiciendis unde consequatur assumenda. Voluptas vero fuga aut repudiandae. Eos est in omnis et officia corporis harum qui.', '2023-03-15 13:36:27', '2023-03-15 13:36:27', 5, 2, 7),
(6, 'Id modi dolores quia neque doloribus saepe omnis. Et debitis magnam aut sunt sequi in ut. Molestias asperiores quo ipsam recusandae quae. Nihil minus rerum quam qui enim illum corporis.', '2023-03-15 13:36:27', '2023-03-15 13:36:27', 5, 2, 7),
(7, 'Voluptatem velit qui maiores maxime. Expedita et iusto aliquam porro sed. Molestias repellendus sed consectetur quia qui non delectus. Est quia aut eveniet dolores architecto possimus.', '2023-03-15 13:36:37', '2023-03-15 13:36:37', 6, 3, 7),
(8, 'In atque non accusantium qui occaecati ut. Exercitationem qui cum consequatur voluptatem. Perspiciatis voluptas ad aliquid qui.', '2023-03-15 13:36:37', '2023-03-15 13:36:37', 6, 3, 7),
(9, 'Ut numquam doloribus suscipit quis suscipit voluptates est. Vitae qui id voluptatem ut. Ab ex aut sit accusantium fugiat.', '2023-03-15 13:36:37', '2023-03-15 13:36:37', 6, 3, 7),
(10, 'Et dolor quod in. Labore aliquam voluptatum sunt rem ducimus dignissimos vel cupiditate. Nisi delectus et debitis eum expedita. Consequatur corrupti animi iusto adipisci velit.', '2023-03-15 13:36:46', '2023-03-15 13:36:46', 8, 4, 7),
(11, 'Nostrum nobis adipisci doloremque repudiandae quia repudiandae. Voluptatem pariatur nihil dolorum quia velit ut ea. Provident quod quas qui quia doloremque et. Et rerum aut ut sit fuga dolorem.', '2023-03-15 13:36:47', '2023-03-15 13:36:47', 8, 4, 7),
(12, 'Non delectus incidunt sunt. Quia quisquam consequuntur magni magnam. Nam ullam dolores occaecati voluptas quaerat ut aspernatur. Aliquam quo natus impedit officia non eum saepe.', '2023-03-15 13:36:47', '2023-03-15 13:36:47', 8, 4, 7),
(13, 'Voluptas omnis facilis fugit consequatur. Aut voluptates ut eum odio quas ut. Amet molestiae facere eos voluptatem fugit expedita et.', '2023-03-15 13:36:54', '2023-03-15 13:36:54', 10, 5, 7),
(14, 'Porro eum aspernatur eligendi mollitia aspernatur. Velit ut et accusantium atque. Est ut fuga ullam a nisi.', '2023-03-15 13:36:55', '2023-03-15 13:36:55', 10, 5, 7),
(15, 'Amet fugiat vel corporis libero. Aut consequatur quis aut accusantium provident ut. Ut distinctio eum et accusantium et impedit occaecati. Ab et illo necessitatibus officiis et et corporis.', '2023-03-15 13:36:55', '2023-03-15 13:36:55', 10, 5, 7);

-- --------------------------------------------------------

--
-- Table structure for table `issues`
--

CREATE TABLE `issues` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `problem` varchar(255) NOT NULL,
  `from` enum('Child','Employee','Family','Others') NOT NULL DEFAULT 'Others',
  `reason` enum('Psychologically','Healthily','Difficulty in Compatibility','economically','Others') NOT NULL DEFAULT 'Others',
  `take_action` varchar(255) NOT NULL,
  `emp_id` int(10) UNSIGNED NOT NULL,
  `child_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `issues`
--

INSERT INTO `issues` (`id`, `name`, `problem`, `from`, `reason`, `take_action`, `emp_id`, `child_id`, `created_at`, `updated_at`) VALUES
(1, '', 'Temporibus nisi nihil labore. Earum minima et qui eum. Voluptatem occaecati quisquam recusandae iure debitis.', 'Others', 'Others', 'Voluptates molestias perspiciatis fugit et vel voluptate. Sed quis assumenda beatae consequatur dolores. Accusamus et ipsam repellat quia id sequi.', 8, 5, '2023-03-15 13:42:19', '2023-03-15 13:42:19'),
(2, '', 'Rerum provident fugit fuga possimus. Rerum iure voluptatibus tenetur perferendis praesentium fugiat veritatis.', 'Family', 'Others', 'Quisquam veniam sit quam repellat aliquid aperiam. Quas voluptas quo laborum sequi et accusamus dolores. Sed porro minima quasi rerum ut. Illum aut impedit beatae laboriosam atque ut nobis.', 8, 5, '2023-03-15 13:42:20', '2023-03-15 13:42:20'),
(5, '', 'Facere natus iure beatae iure consectetur nam. Dolorem dolor quae voluptatibus dolor. Aperiam animi enim minima et eaque sint.', 'Others', 'Psychologically', 'Eum perferendis architecto aliquid voluptas cumque ad. Ad aliquid molestiae et quia amet at quos. Vero itaque cumque illum molestiae laborum atque cum.', 8, 2, '2023-03-15 13:43:15', '2023-03-15 13:43:15'),
(6, '', 'Voluptas placeat voluptatem incidunt. Deleniti numquam omnis qui eos sed natus et. Rem amet perspiciatis voluptas qui dignissimos sapiente. Cumque qui delectus numquam voluptatem.', 'Employee', 'economically', 'Ratione earum labore quibusdam reiciendis placeat ut quidem. Est dignissimos qui enim minus placeat.', 8, 2, '2023-03-15 13:43:15', '2023-03-15 13:43:15'),
(7, '', 'Dolores magnam quibusdam nemo quia asperiores. Quibusdam illo unde corrupti in et aut corrupti qui. Aut culpa et est consectetur laborum eum.', 'Child', 'Healthily', 'Quaerat modi quia corporis excepturi sed. Perspiciatis velit animi voluptatem reprehenderit quaerat. Quis voluptatem quasi non culpa rerum quo nostrum.', 8, 3, '2023-03-15 13:43:21', '2023-03-15 13:43:21'),
(8, '', 'Dolor eveniet qui sit debitis delectus vitae quia. Officia sunt tenetur voluptatibus ut.', 'Child', 'economically', 'Magni commodi est voluptates sunt excepturi. Voluptatem consequatur eius quos porro rerum expedita facere. Autem asperiores excepturi dolor maxime.', 8, 3, '2023-03-15 13:43:21', '2023-03-15 13:43:21'),
(9, '', 'Ducimus vero ut unde. Blanditiis sunt est suscipit voluptatem.', 'Family', 'Psychologically', 'Minus qui quidem minus eveniet pariatur nihil aut et. Accusamus et omnis commodi velit in est quam molestiae.', 8, 4, '2023-03-15 13:43:27', '2023-03-15 13:43:27'),
(10, '', 'Ipsam facere rerum qui natus. Voluptatem dolorem deserunt veniam esse. Amet sit vel eum et necessitatibus voluptas dolore id.', 'Family', 'Healthily', 'Repellendus architecto et aut esse exercitationem et. Et et ut molestiae maiores. Eligendi culpa quo sunt magni autem rerum. Voluptas rerum facere facere vel sed enim blanditiis.', 8, 4, '2023-03-15 13:43:28', '2023-03-15 13:43:28'),
(11, '', 'Nostrum pariatur minima nam est quia. Est rerum repellat sit quia enim sed provident. Fuga quisquam voluptatem et sit vel. Voluptate mollitia necessitatibus aspernatur pariatur.', 'Others', 'Others', 'Consequuntur omnis omnis sed odit et esse deleniti. Cum commodi quis laboriosam est. A voluptates excepturi provident tempore sed. Deleniti quod mollitia voluptatem reiciendis amet et.', 8, 5, '2023-03-15 13:43:33', '2023-03-15 13:43:33'),
(12, '', 'Fuga explicabo quia vitae. Est ipsam aut doloremque harum est voluptatem expedita. Ut perspiciatis nesciunt quae.', 'Child', 'economically', 'Voluptatum tempora laborum ea. Aliquid libero dolorem inventore excepturi. A ducimus quia perferendis eum autem rerum.', 8, 5, '2023-03-15 13:43:33', '2023-03-15 13:43:33'),
(13, 'bad', 'kloij uhgfty', 'Family', 'Healthily', 'nobe', 8, 2, '2023-03-25 12:48:49', '2023-03-25 12:48:49');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `problem` text NOT NULL,
  `take_action` varchar(255) NOT NULL,
  `requirements` varchar(255) NOT NULL,
  `father_reply` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `emp_id` int(10) UNSIGNED NOT NULL,
  `child_id` int(10) UNSIGNED NOT NULL,
  `father_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `name`, `problem`, `take_action`, `requirements`, `father_reply`, `created_at`, `updated_at`, `emp_id`, `child_id`, `father_id`) VALUES
(1, '', 'Harum nesciunt omnis veniam. Provident autem id iusto sunt. Odio corporis corrupti optio. Voluptate exercitationem ut accusantium qui aut at error aut.', 'Nostrum quidem et consequatur modi exercitationem. Sequi sint repellat fugiat praesentium. Sequi voluptates ut qui et. Cumque quod et consequuntur facere sapiente deleniti.', 'Quis aliquam velit sint quisquam consequuntur voluptas. Nihil iure aut itaque similique sint placeat. Ut est dolorem ipsam corrupti impedit voluptas molestias aliquid. At ab molestiae cum aut eum.', 'Doloribus dignissimos officiis animi nihil. Molestiae aperiam voluptates quaerat. Rerum omnis voluptatem vel debitis.', '2023-03-15 13:42:12', '2023-03-15 13:42:12', 8, 5, 6),
(2, '', 'Ut eveniet sit sed vel. Dolorum libero quam omnis enim aperiam ea. Officia enim suscipit reprehenderit et ducimus et esse.', 'Quidem magnam aut deleniti sed temporibus ea velit. Perferendis repellat ratione pariatur doloremque nam.', 'Vero fuga excepturi quae fuga incidunt consectetur molestias. Vero quibusdam ad aspernatur. Vel libero neque mollitia tempora.', 'Nihil ut excepturi quod eligendi id excepturi. Assumenda cum esse voluptatem porro eius iste molestiae veniam. Iure vel dolores voluptatum voluptatem est.', '2023-03-15 13:42:12', '2023-03-15 13:42:12', 8, 5, 6),
(3, 'null', 'Deleniti recusandae autem voluptatem labore non. Ut excepturi eius temporibus et soluta laudantium dolorum qui. Dolorum ea veniam expedita quis.', 'Perspiciatis fugit eum accusamus ut aperiam minus. Quasi repellat temporibus aut quia voluptatem. Debitis magni sint consequatur voluptatem sapiente animi qui. Ab recusandae repellendus est deserunt.', 'Est eos doloremque quia cumque fugit delectus iusto natus. Voluptatum ducimus similique earum. Aut quia iusto suscipit ea. Rerum voluptatem ipsum tenetur qui.', 'uiop rep_5', '2023-03-15 13:44:01', '2023-03-26 01:58:10', 8, 2, 5),
(4, NULL, 'Dicta vitae ab reiciendis velit pariatur. Non doloremque ratione quia eveniet rerum. Qui laudantium sapiente error totam voluptatem autem animi.', 'Maiores neque voluptate veritatis vero dolores. Voluptatem eveniet quas dicta nisi aut. Ut quo velit voluptatem enim.', 'Illum architecto nesciunt dicta et. Officiis dolores similique nihil. Pariatur esse necessitatibus eum odit in corrupti aliquam. Et necessitatibus ut sit velit et.', '1254vcgxjg yjtdydku udutiytk', '2023-03-15 13:44:01', '2023-03-26 01:57:02', 8, 2, 5),
(5, '', 'Quis a rerum vel omnis molestias nihil neque. Deleniti iure quod qui aut est soluta. Voluptate quae laborum qui.', 'Soluta qui alias numquam dignissimos. Harum id laboriosam sit aliquid. Exercitationem omnis quia eum itaque. Rem et reprehenderit nulla in pariatur optio cumque.', 'Est qui aut aliquid laboriosam perspiciatis numquam excepturi. Veniam omnis totam et soluta.', 'Corrupti optio vero adipisci qui. Accusamus et sint modi. Eum ipsa eum iste dolor ut. Qui similique rem sint cum.', '2023-03-15 13:44:15', '2023-03-15 13:44:15', 8, 3, 6),
(6, '', 'Amet necessitatibus quia cupiditate odio expedita fuga. Omnis et enim enim veritatis. Praesentium eaque inventore quam ex hic veritatis optio.', 'Vel voluptate expedita doloremque sapiente esse officia. Quia ut quod similique quasi. Labore animi iste est beatae architecto veritatis rem. Optio optio alias rem enim eveniet dolor adipisci.', 'Dolores aperiam harum recusandae ea deleniti labore officia. Et doloremque libero est et. Quisquam voluptatem fugit provident.', 'Ut possimus doloribus fugit possimus enim. Quam non deleniti quo maiores. Aut qui in voluptatem beatae sunt eum maiores voluptates. Magni sapiente sunt vel enim cupiditate.', '2023-03-15 13:44:15', '2023-03-15 13:44:15', 8, 3, 6),
(7, '', 'Repellendus reprehenderit dolore sequi sint nam voluptatum. Ut neque deleniti aut qui aut minima adipisci. Ullam reiciendis magnam ea porro quia ut praesentium.', 'Sed et natus et nihil vel libero facere. Veniam est aut explicabo atque dolor dignissimos.', 'Blanditiis cumque inventore voluptas voluptatem corporis sed occaecati saepe. Pariatur quam fuga qui. Omnis dolorem consectetur adipisci expedita molestiae sequi ipsum.', 'Et quo sit vero ratione consequatur repellendus unde. Iusto quidem omnis impedit omnis ratione veritatis dolor. Et porro velit hic asperiores.', '2023-03-15 13:44:25', '2023-03-15 13:44:25', 8, 4, 8),
(8, '', 'Dolores maxime est voluptas pariatur voluptatem eius eius. Ad quis corrupti ut ipsam vel doloribus eum voluptas. Iure pariatur repellat omnis inventore sit.', 'Est nam illo accusamus voluptates adipisci rerum et. Hic omnis odit ratione reprehenderit cupiditate sunt. Non consequatur aliquam omnis nesciunt ex. Sint aut veritatis et consequatur distinctio.', 'Officia veniam amet sit quod fugiat quia sint aut. Enim earum praesentium est aliquam. Dolores culpa est est dolores id.', 'Aliquam quas ab vitae impedit molestiae. Deleniti id illo voluptatibus a. Dolor sed accusamus qui.', '2023-03-15 13:44:25', '2023-03-15 13:44:25', 8, 4, 8),
(9, '', 'Dolores eaque maxime impedit. Vero in perferendis molestias quo sequi velit. Sunt in aliquam quasi quisquam reprehenderit reprehenderit aut.', 'At qui nobis mollitia repellendus porro. Rerum impedit velit voluptas. Magnam debitis nulla ab nihil dolorem rerum.', 'Animi soluta libero perspiciatis ab numquam qui vero. Qui amet quam nam quam asperiores similique nihil. A explicabo voluptate officiis repellat voluptas consequatur.', 'Deserunt deserunt rem adipisci qui iure iste. Qui commodi voluptatem neque cupiditate sapiente. Non tempore quasi omnis molestiae ut iure ea.', '2023-03-15 13:44:34', '2023-03-15 13:44:34', 8, 5, 10),
(10, '', 'Alias voluptas similique velit voluptate. Adipisci sunt quas dolorem ipsa modi quo. Iste vitae corporis odit repudiandae distinctio maxime.', 'Voluptatem iste sunt officia consequatur modi velit laborum maiores. Ipsa quia nobis illum accusantium repudiandae voluptas consequatur earum. Ea qui qui maxime est doloremque.', 'In rem esse eveniet sunt. Voluptas accusantium voluptatibus voluptas. Soluta est voluptatum ut qui. Saepe nam aut porro vel.', 'Voluptates repellat aut provident similique nobis. Dolore suscipit labore quos ab. Dolorem fugiat est commodi dolores.', '2023-03-15 13:44:34', '2023-03-15 13:44:34', 8, 5, 10),
(11, 'huio', 'goooo', 'push', 'ko', 'kijolunm khk', '2023-03-25 12:38:14', '2023-05-25 17:50:11', 8, 2, 5),
(12, 'play', 'goooo', 'push', 'ko', NULL, '2023-03-25 12:40:15', '2023-03-25 12:40:15', 8, 2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `selectedfoods`
--

CREATE TABLE `selectedfoods` (
  `id` int(10) UNSIGNED NOT NULL,
  `count` int(11) NOT NULL DEFAULT 0,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `food_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `selectedfoods`
--

INSERT INTO `selectedfoods` (`id`, `count`, `updated_at`, `created_at`, `food_id`) VALUES
(1, 4, '2023-03-15 13:35:12', '2023-03-15 13:35:12', 7),
(2, 0, '2023-03-15 13:35:12', '2023-03-15 13:35:12', 3),
(3, 2, '2023-03-15 13:35:12', '2023-03-15 13:35:12', 5),
(4, 0, '2023-03-15 13:35:12', '2023-03-15 13:35:12', 6),
(5, 4, '2023-03-15 13:35:13', '2023-03-15 13:35:13', 1),
(6, 1, '2023-03-15 13:35:13', '2023-03-15 13:35:13', 8),
(7, 0, '2023-03-15 13:35:13', '2023-03-15 13:35:13', 2),
(8, 1, '2023-03-15 13:35:13', '2023-03-15 13:35:13', 4),
(9, 4, '2023-03-16 19:16:10', '2023-03-16 19:16:10', 4),
(10, 5, '2023-03-16 19:19:06', '2023-03-16 19:19:06', 7),
(11, 4, '2023-03-21 07:27:37', '2023-03-21 07:27:37', 1),
(12, 5, '2023-03-21 07:29:02', '2023-03-21 07:29:02', 3),
(13, 3, '2023-03-21 07:51:13', '2023-03-21 07:51:13', 2),
(14, 3, '2023-03-26 22:05:56', '2023-03-26 22:05:56', 2),
(15, 5, '2023-03-27 06:26:40', '2023-03-27 06:26:40', 3),
(16, 5, '2023-03-27 08:35:40', '2023-03-27 08:35:40', 3),
(17, 3, '2023-03-27 08:35:40', '2023-03-27 08:35:40', 2),
(18, 5, '2023-03-27 08:36:18', '2023-03-27 08:36:18', 3),
(19, 3, '2023-03-27 08:36:18', '2023-03-27 08:36:18', 2),
(20, 5, '2023-03-27 08:37:15', '2023-03-27 08:37:15', 3),
(21, 3, '2023-03-27 08:37:15', '2023-03-27 08:37:15', 2),
(22, 5, '2023-03-27 06:52:35', '2023-03-27 06:52:35', 3);

-- --------------------------------------------------------

--
-- Table structure for table `selectedfood_emp`
--

CREATE TABLE `selectedfood_emp` (
  `selected_food_id` int(10) UNSIGNED NOT NULL,
  `emp_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `selectedfood_emp`
--

INSERT INTO `selectedfood_emp` (`selected_food_id`, `emp_id`) VALUES
(2, 4),
(2, 7),
(3, 5),
(3, 6),
(4, 7),
(6, 2),
(6, 4),
(8, 3);

-- --------------------------------------------------------

--
-- Table structure for table `selectedfood_father`
--

CREATE TABLE `selectedfood_father` (
  `father_id` int(10) UNSIGNED NOT NULL,
  `selected_food_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `selectedfood_father`
--

INSERT INTO `selectedfood_father` (`father_id`, `selected_food_id`) VALUES
(2, 6),
(2, 8),
(3, 1),
(3, 4),
(6, 5),
(10, 2);

-- --------------------------------------------------------

--
-- Table structure for table `subjectdatasets`
--

CREATE TABLE `subjectdatasets` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `admin_id` int(10) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `subjectdatasets`
--

INSERT INTO `subjectdatasets` (`id`, `name`, `created_at`, `updated_at`, `admin_id`) VALUES
(1, 'Arabic', '2023-03-15 15:23:47', '2023-03-15 15:23:47', 1),
(2, 'English', '2023-03-15 15:23:47', '2023-03-15 15:23:47', 1),
(3, 'Math', '2023-03-15 15:23:47', '2023-03-15 15:23:47', 1),
(4, 'History', '2023-03-15 15:23:47', '2023-03-15 15:23:47', 1),
(5, 'Science', '2023-03-15 15:23:47', '2023-03-15 15:23:47', 1),
(6, 'Geography', '2023-03-15 15:23:47', '2023-03-15 15:23:47', 1),
(7, 'Computer', '2023-03-15 15:23:47', '2023-03-15 15:23:47', 1);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(10) UNSIGNED NOT NULL,
  `mark` int(11) NOT NULL DEFAULT 0,
  `behavior` enum('Turbulent','Conformist','Solitary','Friendly') NOT NULL DEFAULT 'Friendly',
  `activity` enum('Excellent','Very Good','Good','Acceptable') NOT NULL DEFAULT 'Good',
  `interact` enum('Excellent','Very Good','Good','Acceptable') NOT NULL DEFAULT 'Good',
  `team_work` enum('Excellent','Very Good','Good','Acceptable') NOT NULL DEFAULT 'Good',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `father_id` int(10) UNSIGNED NOT NULL,
  `subjectdataset_id` int(10) UNSIGNED NOT NULL,
  `child_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `mark`, `behavior`, `activity`, `interact`, `team_work`, `created_at`, `updated_at`, `father_id`, `subjectdataset_id`, `child_id`) VALUES
(1, 38, 'Conformist', 'Acceptable', 'Acceptable', 'Excellent', '2023-03-15 13:30:30', '2023-03-15 13:30:30', 6, 3, NULL),
(2, 50, 'Turbulent', 'Acceptable', 'Good', 'Excellent', '2023-03-15 13:30:30', '2023-03-15 13:30:30', 7, 3, NULL),
(3, 66, 'Friendly', 'Good', 'Excellent', 'Acceptable', '2023-03-15 13:30:30', '2023-03-15 13:30:30', 9, 2, NULL),
(4, 26, 'Conformist', 'Very Good', 'Very Good', 'Good', '2023-03-15 13:30:30', '2023-03-15 13:30:30', 3, 6, NULL),
(5, 44, 'Friendly', 'Excellent', 'Acceptable', 'Very Good', '2023-03-15 13:30:30', '2023-03-15 13:30:30', 5, 7, NULL),
(6, 27, 'Conformist', 'Very Good', 'Acceptable', 'Excellent', '2023-03-15 13:30:30', '2023-03-15 13:30:30', 4, 5, NULL),
(7, 46, 'Friendly', 'Excellent', 'Acceptable', 'Very Good', '2023-03-15 13:30:30', '2023-03-15 13:30:30', 10, 1, NULL),
(8, 36, 'Turbulent', 'Excellent', 'Good', 'Very Good', '2023-03-15 13:30:30', '2023-03-15 13:30:30', 8, 5, NULL),
(10, 45, 'Turbulent', 'Very Good', 'Excellent', 'Very Good', '2023-03-15 13:30:30', '2023-03-15 13:30:30', 2, 5, NULL),
(12, 75, 'Turbulent', 'Very Good', 'Very Good', 'Very Good', '2023-03-30 08:34:26', '2023-03-30 08:34:26', 4, 4, NULL),
(13, 85, 'Turbulent', 'Very Good', 'Very Good', 'Very Good', '2023-03-30 08:39:40', '2023-03-30 08:39:40', 4, 4, NULL),
(14, 70, 'Conformist', 'Good', 'Very Good', 'Very Good', '2023-05-22 15:55:46', '2023-05-22 15:55:46', 4, 4, NULL),
(15, 70, 'Conformist', 'Good', 'Very Good', 'Very Good', '2023-05-22 16:09:30', '2023-05-22 16:09:30', 9, 4, NULL),
(16, 70, 'Conformist', 'Good', 'Very Good', 'Very Good', '2023-05-22 16:29:01', '2023-05-22 16:29:01', 3, 4, NULL),
(17, 80, 'Conformist', 'Good', 'Very Good', 'Very Good', '2023-05-24 17:11:08', '2023-05-24 17:11:08', 3, 4, NULL),
(18, 55, 'Conformist', 'Good', 'Very Good', 'Very Good', '2023-05-24 17:36:42', '2023-05-24 17:36:42', 3, 4, NULL),
(19, 60, 'Conformist', 'Good', 'Very Good', 'Very Good', '2023-05-24 17:37:07', '2023-05-24 17:37:07', 3, 4, NULL),
(20, 78, 'Conformist', 'Good', 'Very Good', 'Very Good', '2023-05-24 17:40:11', '2023-05-24 17:40:11', 3, 4, NULL),
(21, 78, 'Conformist', 'Good', 'Very Good', 'Very Good', '2023-05-24 18:29:08', '2023-05-24 18:29:08', 3, 4, NULL),
(22, 88, 'Conformist', 'Good', 'Very Good', 'Very Good', '2023-05-24 18:29:56', '2023-06-16 15:51:21', 3, 4, 7);

-- --------------------------------------------------------

--
-- Table structure for table `subject_emp`
--

CREATE TABLE `subject_emp` (
  `subject_id` int(10) UNSIGNED NOT NULL,
  `emp_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `subject_emp`
--

INSERT INTO `subject_emp` (`subject_id`, `emp_id`) VALUES
(3, 3),
(4, 1),
(5, 6),
(7, 1),
(7, 2),
(7, 4);

-- --------------------------------------------------------

--
-- Table structure for table `subject_reports`
--

CREATE TABLE `subject_reports` (
  `id` int(10) UNSIGNED NOT NULL,
  `report` text NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `father_id` int(10) UNSIGNED NOT NULL,
  `child_id` int(10) UNSIGNED NOT NULL,
  `emp_id` int(10) UNSIGNED NOT NULL,
  `subjectdataset_id` int(11) UNSIGNED DEFAULT NULL,
  `activitydataset_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `subject_reports`
--

INSERT INTO `subject_reports` (`id`, `report`, `updated_at`, `created_at`, `father_id`, `child_id`, `emp_id`, `subjectdataset_id`, `activitydataset_id`) VALUES
(4, 'Voluptas fuga qui assumenda earum repudiandae aliquam non. Aut et beatae voluptatem reiciendis. Vel architecto excepturi quia ut quo quisquam aperiam. Ut dolorem in totam.', '2023-03-15 13:38:08', '2023-03-15 13:38:08', 5, 2, 2, 4, NULL),
(7, 'Accusamus non iste aut eius totam repellat mollitia. Illum laboriosam non ut ut dolore molestiae. Asperiores occaecati voluptatem itaque nobis debitis.', '2023-03-15 13:38:24', '2023-03-15 13:38:24', 6, 3, 2, 4, NULL),
(8, 'Sunt blanditiis sapiente vel qui reprehenderit voluptate dolorum. Ad odio earum esse eos. Et odit adipisci et minima. Cum temporibus quam harum aut quas adipisci.', '2023-03-15 13:38:24', '2023-03-15 13:38:24', 6, 3, 4, NULL, 5),
(9, 'Similique accusamus explicabo optio est excepturi amet sint. Similique ut sequi doloremque laborum nesciunt at. Iure voluptatibus et et debitis ipsa vero.', '2023-03-15 13:38:24', '2023-03-15 13:38:24', 6, 3, 5, 2, NULL),
(10, 'Atque ut debitis quibusdam saepe illum. Praesentium laudantium nisi minima nesciunt. Molestiae aliquid aut suscipit libero sequi sed dolor. Laboriosam delectus sit error. Ut aut dolores eos sit.', '2023-03-15 13:38:36', '2023-03-15 13:38:36', 8, 4, 6, NULL, 3),
(11, 'Qui laboriosam eligendi sed nisi optio. Aspernatur at omnis libero optio rem doloribus. Et iusto quas perspiciatis iure commodi et et voluptatem. Corrupti quis necessitatibus nihil alias.', '2023-03-15 13:38:36', '2023-03-15 13:38:36', 8, 4, 5, 2, NULL),
(12, 'Praesentium et id sint illum et dolorem. Blanditiis consectetur eos laboriosam vel. Quas enim est aspernatur aut quisquam. Vel corrupti laborum enim.', '2023-03-15 13:38:36', '2023-03-15 13:38:36', 8, 4, 2, 4, NULL),
(13, 'Voluptates eius quia assumenda accusamus. Perspiciatis deleniti dignissimos enim voluptas. In provident beatae nemo aperiam laudantium.', '2023-03-15 13:38:44', '2023-03-15 13:38:44', 10, 5, 6, NULL, 3),
(14, 'Deleniti mollitia qui praesentium. Quia recusandae dignissimos aspernatur eligendi. Pariatur ut sequi nihil eos voluptatum. Modi rem dolore iusto modi sapiente.', '2023-03-15 13:38:44', '2023-03-15 13:38:44', 10, 5, 2, 4, NULL),
(15, 'Beatae et qui odit. Sed qui et libero perspiciatis sint tenetur. Sequi accusantium sint voluptatem fugiat velit et eaque.', '2023-03-15 13:38:44', '2023-03-15 13:38:44', 10, 5, 4, NULL, 5),
(16, 'dfrv tyth kjjhuyj jbknbjb', '2023-05-12 11:52:54', '2023-05-12 11:52:54', 3, 7, 2, 4, NULL),
(17, 'dfrv tyth kjjhuyj jbknbjb', '2023-05-14 06:43:34', '2023-05-14 06:43:34', 3, 7, 2, 4, NULL),
(18, 'finish him', '2023-05-24 19:14:42', '2023-05-24 19:14:42', 2, 9, 2, 4, NULL),
(19, 'kill him', '2023-05-24 19:22:35', '2023-05-24 19:22:35', 6, 3, 4, NULL, 5),
(20, 'finish him nooooooooooooow', '2023-06-06 19:55:00', '2023-06-06 19:55:00', 2, 9, 2, NULL, NULL),
(21, 'finish him right nooooooooooooow', '2023-06-06 20:00:03', '2023-06-06 20:00:03', 2, 9, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `watches`
--

CREATE TABLE `watches` (
  `id` int(10) UNSIGNED NOT NULL,
  `heart_rate` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `child_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `child_id_UNIQUE` (`child_id`),
  ADD KEY `child_activitymark_idx` (`child_id`);

--
-- Indexes for table `activitydatasets`
--
ALTER TABLE `activitydatasets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_activity_idx` (`admin_id`);

--
-- Indexes for table `activity_emp`
--
ALTER TABLE `activity_emp`
  ADD PRIMARY KEY (`activity_id`,`emp_id`),
  ADD KEY `emp_activity_idx` (`emp_id`);

--
-- Indexes for table `add_healths`
--
ALTER TABLE `add_healths`
  ADD PRIMARY KEY (`id`),
  ADD KEY `father_inserthealth_idx` (`father_id`),
  ADD KEY `child_hadhealth_idx` (`child_id`),
  ADD KEY `addhealth_health_idx` (`health_id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendences`
--
ALTER TABLE `attendences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `child_attendence_idx` (`child_id`),
  ADD KEY `emp_attendence_idx` (`emp_id`);

--
-- Indexes for table `bandedfoods`
--
ALTER TABLE `bandedfoods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `food_bandedfood_idx` (`food_id`);

--
-- Indexes for table `bandedfood_child`
--
ALTER TABLE `bandedfood_child`
  ADD PRIMARY KEY (`child_id`,`bandedfood_id`),
  ADD KEY `bandedfood_children_idx` (`bandedfood_id`);

--
-- Indexes for table `bandedfood_emp`
--
ALTER TABLE `bandedfood_emp`
  ADD PRIMARY KEY (`emp_id`,`bandedfood_id`),
  ADD KEY `bandedfood_employee_idx` (`bandedfood_id`);

--
-- Indexes for table `children`
--
ALTER TABLE `children`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `child_code` (`child_code`),
  ADD KEY `father_child_idx` (`father_id`),
  ADD KEY `admin_child_idx` (`admin_id`),
  ADD KEY `child_activitydataset_idx` (`activitydataset_id`);

--
-- Indexes for table `child_emp`
--
ALTER TABLE `child_emp`
  ADD PRIMARY KEY (`child_id`,`emp_id`),
  ADD KEY `emp_relation_idx` (`emp_id`);

--
-- Indexes for table `child_selectedfood`
--
ALTER TABLE `child_selectedfood`
  ADD PRIMARY KEY (`selected_food_id`,`child_id`),
  ADD KEY `child_food_select_idx` (`child_id`);

--
-- Indexes for table `child_subject`
--
ALTER TABLE `child_subject`
  ADD PRIMARY KEY (`child_id`,`subject_id`),
  ADD KEY `subject_relation_idx` (`subject_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emp_admin_idx` (`admin_id`),
  ADD KEY `emp_subjectdataset_idx` (`subjectdataset_id`),
  ADD KEY `emp_avtivitydataset_idx` (`activitydataset_id`);

--
-- Indexes for table `emp_food`
--
ALTER TABLE `emp_food`
  ADD PRIMARY KEY (`emp_id`,`food_id`),
  ADD KEY `food_emp_idx` (`food_id`);

--
-- Indexes for table `fathers`
--
ALTER TABLE `fathers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_father_idx` (`admin_id`);

--
-- Indexes for table `father_food`
--
ALTER TABLE `father_food`
  ADD PRIMARY KEY (`father_id`,`food_id`),
  ADD KEY `food_father_idx` (`food_id`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_food_idx` (`admin_id`);

--
-- Indexes for table `healthdatasetnames`
--
ALTER TABLE `healthdatasetnames`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_insert_idx` (`admin_id`);

--
-- Indexes for table `healthdatasetname_health`
--
ALTER TABLE `healthdatasetname_health`
  ADD PRIMARY KEY (`health_id`,`healthdatasetname_id`),
  ADD UNIQUE KEY `health_id` (`health_id`),
  ADD KEY `insert_dis_idx` (`healthdatasetname_id`);

--
-- Indexes for table `healthdatasettypes`
--
ALTER TABLE `healthdatasettypes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_type_idx` (`admin_id`),
  ADD KEY `healthname_type_idx` (`healthdatasetname_id`);

--
-- Indexes for table `healthdatasettype_health`
--
ALTER TABLE `healthdatasettype_health`
  ADD PRIMARY KEY (`health_id`,`healthdatasettype_id`),
  ADD KEY `health_type_idx` (`health_id`),
  ADD KEY `datasettype_health_idx` (`healthdatasettype_id`);

--
-- Indexes for table `healths`
--
ALTER TABLE `healths`
  ADD PRIMARY KEY (`id`),
  ADD KEY `father_health_idx` (`father_id`),
  ADD KEY `child_health_idx` (`child_id`);

--
-- Indexes for table `health_emp`
--
ALTER TABLE `health_emp`
  ADD PRIMARY KEY (`health_type`,`emp_id`),
  ADD KEY `emp_relation_idx` (`emp_id`);

--
-- Indexes for table `health_reports`
--
ALTER TABLE `health_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `father_h_report_idx` (`father_id`),
  ADD KEY `child_h_report_idx` (`child_id`),
  ADD KEY `emp_h_report_idx` (`emp_id`);

--
-- Indexes for table `issues`
--
ALTER TABLE `issues`
  ADD PRIMARY KEY (`id`),
  ADD KEY `child_issues_idx` (`child_id`),
  ADD KEY `emp_issues_idx` (`emp_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emp_posts_idx` (`emp_id`),
  ADD KEY `child_posts_idx` (`child_id`),
  ADD KEY `father_posts_idx` (`father_id`);

--
-- Indexes for table `selectedfoods`
--
ALTER TABLE `selectedfoods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `select_foods_idx` (`food_id`);

--
-- Indexes for table `selectedfood_emp`
--
ALTER TABLE `selectedfood_emp`
  ADD PRIMARY KEY (`selected_food_id`,`emp_id`),
  ADD KEY `emp_selected_food_idx` (`emp_id`);

--
-- Indexes for table `selectedfood_father`
--
ALTER TABLE `selectedfood_father`
  ADD PRIMARY KEY (`father_id`,`selected_food_id`),
  ADD KEY `selected_father_idx` (`selected_food_id`);

--
-- Indexes for table `subjectdatasets`
--
ALTER TABLE `subjectdatasets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_admin_idx` (`admin_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `father_subject_idx` (`father_id`),
  ADD KEY `subject_subjectdataset_idx` (`subjectdataset_id`),
  ADD KEY `child_subject_mark` (`child_id`);

--
-- Indexes for table `subject_emp`
--
ALTER TABLE `subject_emp`
  ADD PRIMARY KEY (`subject_id`,`emp_id`),
  ADD KEY `emp_relation_idx` (`emp_id`);

--
-- Indexes for table `subject_reports`
--
ALTER TABLE `subject_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `father_s_report_idx` (`father_id`),
  ADD KEY `child_s_report_idx` (`child_id`),
  ADD KEY `emp_s_report_idx` (`emp_id`),
  ADD KEY `sub_report_child` (`subjectdataset_id`),
  ADD KEY `act_report_child` (`activitydataset_id`);

--
-- Indexes for table `watches`
--
ALTER TABLE `watches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `child_id` (`child_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `activitydatasets`
--
ALTER TABLE `activitydatasets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `add_healths`
--
ALTER TABLE `add_healths`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `attendences`
--
ALTER TABLE `attendences`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `bandedfoods`
--
ALTER TABLE `bandedfoods`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `children`
--
ALTER TABLE `children`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `fathers`
--
ALTER TABLE `fathers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `healthdatasetnames`
--
ALTER TABLE `healthdatasetnames`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `healthdatasettypes`
--
ALTER TABLE `healthdatasettypes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `healths`
--
ALTER TABLE `healths`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `health_reports`
--
ALTER TABLE `health_reports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `issues`
--
ALTER TABLE `issues`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `selectedfoods`
--
ALTER TABLE `selectedfoods`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `subjectdatasets`
--
ALTER TABLE `subjectdatasets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `subject_reports`
--
ALTER TABLE `subject_reports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `watches`
--
ALTER TABLE `watches`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activities`
--
ALTER TABLE `activities`
  ADD CONSTRAINT `child_activitymark` FOREIGN KEY (`child_id`) REFERENCES `children` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `activitydatasets`
--
ALTER TABLE `activitydatasets`
  ADD CONSTRAINT `admin_activity` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `activity_emp`
--
ALTER TABLE `activity_emp`
  ADD CONSTRAINT `activity_emp` FOREIGN KEY (`activity_id`) REFERENCES `activities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `emp_activity` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `add_healths`
--
ALTER TABLE `add_healths`
  ADD CONSTRAINT `addhealth_health` FOREIGN KEY (`health_id`) REFERENCES `healths` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `child_hadhealth` FOREIGN KEY (`child_id`) REFERENCES `children` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `father_inserthealth` FOREIGN KEY (`father_id`) REFERENCES `fathers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `attendences`
--
ALTER TABLE `attendences`
  ADD CONSTRAINT `child_attendence` FOREIGN KEY (`child_id`) REFERENCES `children` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `emp_attendence` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bandedfoods`
--
ALTER TABLE `bandedfoods`
  ADD CONSTRAINT `food_bandedfood` FOREIGN KEY (`food_id`) REFERENCES `food` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bandedfood_child`
--
ALTER TABLE `bandedfood_child`
  ADD CONSTRAINT `bandedfood_children` FOREIGN KEY (`bandedfood_id`) REFERENCES `bandedfoods` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `children_bandedfood` FOREIGN KEY (`child_id`) REFERENCES `children` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bandedfood_emp`
--
ALTER TABLE `bandedfood_emp`
  ADD CONSTRAINT `bandedfood_employee` FOREIGN KEY (`bandedfood_id`) REFERENCES `bandedfoods` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `employee_bandedfood` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `children`
--
ALTER TABLE `children`
  ADD CONSTRAINT `admin_child` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `child_activitydataset` FOREIGN KEY (`activitydataset_id`) REFERENCES `activitydatasets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `father_child` FOREIGN KEY (`father_id`) REFERENCES `fathers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `child_emp`
--
ALTER TABLE `child_emp`
  ADD CONSTRAINT `child_relation` FOREIGN KEY (`child_id`) REFERENCES `children` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `emp_relation` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `child_selectedfood`
--
ALTER TABLE `child_selectedfood`
  ADD CONSTRAINT `child_food_select` FOREIGN KEY (`child_id`) REFERENCES `children` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `selected_food_child` FOREIGN KEY (`selected_food_id`) REFERENCES `selectedfoods` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `child_subject`
--
ALTER TABLE `child_subject`
  ADD CONSTRAINT `child_subject_relation` FOREIGN KEY (`child_id`) REFERENCES `children` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subject_child_relation` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `emp_admin` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `emp_avtivitydataset` FOREIGN KEY (`activitydataset_id`) REFERENCES `activitydatasets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `emp_subjectdataset` FOREIGN KEY (`subjectdataset_id`) REFERENCES `subjectdatasets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `emp_food`
--
ALTER TABLE `emp_food`
  ADD CONSTRAINT `emp_food` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `food_emp` FOREIGN KEY (`food_id`) REFERENCES `food` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `fathers`
--
ALTER TABLE `fathers`
  ADD CONSTRAINT `admin_father` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `father_food`
--
ALTER TABLE `father_food`
  ADD CONSTRAINT `father_food` FOREIGN KEY (`father_id`) REFERENCES `fathers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `food_father` FOREIGN KEY (`food_id`) REFERENCES `food` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `food`
--
ALTER TABLE `food`
  ADD CONSTRAINT `admin_food` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `healthdatasetnames`
--
ALTER TABLE `healthdatasetnames`
  ADD CONSTRAINT `admin_insert` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `healthdatasetname_health`
--
ALTER TABLE `healthdatasetname_health`
  ADD CONSTRAINT `child_dis` FOREIGN KEY (`health_id`) REFERENCES `healths` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `insert_dis` FOREIGN KEY (`healthdatasetname_id`) REFERENCES `healthdatasetnames` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `healthdatasettypes`
--
ALTER TABLE `healthdatasettypes`
  ADD CONSTRAINT `admin_type` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `healthname_type` FOREIGN KEY (`healthdatasetname_id`) REFERENCES `healthdatasetnames` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `healthdatasettype_health`
--
ALTER TABLE `healthdatasettype_health`
  ADD CONSTRAINT `datasettype_health` FOREIGN KEY (`healthdatasettype_id`) REFERENCES `healthdatasettypes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `health_datasettype` FOREIGN KEY (`health_id`) REFERENCES `healths` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `healths`
--
ALTER TABLE `healths`
  ADD CONSTRAINT `child_health_ex` FOREIGN KEY (`child_id`) REFERENCES `children` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `father_health_ex` FOREIGN KEY (`father_id`) REFERENCES `fathers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `health_emp`
--
ALTER TABLE `health_emp`
  ADD CONSTRAINT `emp_child_register` FOREIGN KEY (`health_type`) REFERENCES `healths` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `emp_health_relation` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `health_reports`
--
ALTER TABLE `health_reports`
  ADD CONSTRAINT `child_h_report` FOREIGN KEY (`child_id`) REFERENCES `children` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `emp_h_report` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `father_h_report` FOREIGN KEY (`father_id`) REFERENCES `fathers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `issues`
--
ALTER TABLE `issues`
  ADD CONSTRAINT `child_issues` FOREIGN KEY (`child_id`) REFERENCES `children` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `emp_issues` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `child_posts` FOREIGN KEY (`child_id`) REFERENCES `children` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `emp_posts` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `father_posts` FOREIGN KEY (`father_id`) REFERENCES `fathers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `selectedfoods`
--
ALTER TABLE `selectedfoods`
  ADD CONSTRAINT `select_foods` FOREIGN KEY (`food_id`) REFERENCES `food` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `selectedfood_emp`
--
ALTER TABLE `selectedfood_emp`
  ADD CONSTRAINT `emp_selected_food` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `selected_food_emp` FOREIGN KEY (`selected_food_id`) REFERENCES `selectedfoods` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `selectedfood_father`
--
ALTER TABLE `selectedfood_father`
  ADD CONSTRAINT `father_selected` FOREIGN KEY (`father_id`) REFERENCES `fathers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `selected_father` FOREIGN KEY (`selected_food_id`) REFERENCES `selectedfoods` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subjectdatasets`
--
ALTER TABLE `subjectdatasets`
  ADD CONSTRAINT `subject_admin` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `child_subject_mark` FOREIGN KEY (`child_id`) REFERENCES `children` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `father_subject` FOREIGN KEY (`father_id`) REFERENCES `fathers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subject_subjectdataset` FOREIGN KEY (`subjectdataset_id`) REFERENCES `subjectdatasets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subject_emp`
--
ALTER TABLE `subject_emp`
  ADD CONSTRAINT `emp_subject_relation` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subject_relation` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subject_reports`
--
ALTER TABLE `subject_reports`
  ADD CONSTRAINT `act_report_child` FOREIGN KEY (`activitydataset_id`) REFERENCES `activitydatasets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `child_s_report` FOREIGN KEY (`child_id`) REFERENCES `children` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `emp_s_report` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `father_s_report` FOREIGN KEY (`father_id`) REFERENCES `fathers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sub_report_child` FOREIGN KEY (`subjectdataset_id`) REFERENCES `subjectdatasets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `watches`
--
ALTER TABLE `watches`
  ADD CONSTRAINT `child_watch` FOREIGN KEY (`child_id`) REFERENCES `children` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

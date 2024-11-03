-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2024 at 08:12 PM
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
-- Database: `property_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `email`, `password`) VALUES
(3, 'admin', 'admin@example.com', '$2y$10$akLu/pef6N5QX8V0ELdaXuZfKMkYCUsXB7SztZBLNsNIuBVgGu4Tu');

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
-- Table structure for table `landlord`
--

CREATE TABLE `landlord` (
  `landlord_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `current_address` varchar(255) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `picture` mediumblob NOT NULL,
  `account_type` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `landlord`
--

INSERT INTO `landlord` (`landlord_id`, `name`, `email`, `phone`, `current_address`, `password`, `picture`, `account_type`, `created_at`, `updated_at`) VALUES
(1, 'John Doe', 'johndoe@example.com', '1234567890', NULL, 'hashed_password1', '', 'landlord', '2024-11-02 06:49:23', '2024-11-02 06:49:23'),
(7, 'Jachi sangma', 'jsangma09@gmail.com', '01785546431', 'kalachandpur', '$2y$10$bwKLtRFg2WgXZdGCkW71BO48fQEHhBIegjpsKyEAmrNE0CEP1vGqi', 0x70726f66696c655f70696374757265732f5637786f567261367948646d544d6b424e76336b6b5a7954754a444a4c30455939314131397633452e6a7067, 'landlord', '2024-11-02 01:41:55', '2024-11-02 01:41:55'),
(12, 'jachijachi', 'samia@gmail.com', '01727652231', NULL, '$2y$10$wZVvWAgs.2gQxtWyrl8H5eBqWuErqg37H9C9YVP1568QxTaal2zIG', 0x70726f66696c655f70696374757265732f6e764c666d5a63597034454f4867696b6433426b4f5a31614e6548496f50347174643438636a42562e6a7067, 'landlord', '2024-11-02 02:29:27', '2024-11-02 02:29:27'),
(13, 'tdhdfh', 'shamima@gmail.com', '01837493744', NULL, '$2y$10$zi/9oV.L6i6yfkua.rplFen4Xrlov6r0p30jfri4SwLb7Cc6Xqgva', 0x70726f66696c655f70696374757265732f74414d4c687a6476647863764b416c354f6f73704c3146547555686c3268544d79744d753654524a2e6a7067, 'landlord', '2024-11-02 02:39:05', '2024-11-02 02:39:05'),
(14, 'mia', 'mia@gmail.com', '01727652231', NULL, '$2y$10$o/lLa3tvk/mcKaMLetP8kOgVedoOVYI/oPfTqiORKIVQVZ2HALIze', 0x70726f66696c655f70696374757265732f7a37666133423977306156676c514f5266337239304d707932766468304b41703742624b6c74576c2e6a7067, 'landlord', '2024-11-02 04:07:20', '2024-11-02 04:07:20');

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_10_28_141729_create_users_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `landlord_id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `status` enum('unread','read') DEFAULT 'unread',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `landlord_id`, `message`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Test notification', 'unread', '2024-11-03 12:55:04', '2024-11-03 12:55:04');

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
-- Table structure for table `property`
--

CREATE TABLE `property` (
  `property_ID` int(11) NOT NULL,
  `st_no` int(11) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `size` decimal(10,2) DEFAULT NULL,
  `amenities` text DEFAULT NULL,
  `num_of_rooms` int(11) DEFAULT NULL,
  `num_of_bathrooms` int(11) NOT NULL,
  `rent` decimal(15,2) DEFAULT NULL,
  `img1` varchar(255) DEFAULT NULL,
  `img2` varchar(255) DEFAULT NULL,
  `img3` varchar(255) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `landlord_id` int(11) DEFAULT NULL,
  `floor` int(11) DEFAULT NULL,
  `available_from` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `property`
--

INSERT INTO `property` (`property_ID`, `st_no`, `city`, `state`, `country`, `type`, `size`, `amenities`, `num_of_rooms`, `num_of_bathrooms`, `rent`, `img1`, `img2`, `img3`, `status`, `landlord_id`, `floor`, `available_from`) VALUES
(1, 123, 'New York', 'NY', 'USA', 'Apartment', 1200.50, 'Pool, Gym, Parking', 3, 2, 2500.00, '', '', '', 'available', 1, 5, '2024-11-01'),
(3, 345345, 'Dhaka', 'gulshan', 'bangladesh', 'apartment', 1000.00, 'gym', 7, 3, 3466.00, 'properties/tpuL3RnTNXxh2T65t1GPKJVlEQ9LgSlQQ25LfEJ2.jpg', 'properties/pejbfHtZNIl5KR735SBIL4iCDdhmQaGB5a6eezwX.jpg', 'properties/u4UzLmGPQdRlXEVcmEru0fSxWx0OnMbn33hdqReI.jpg', NULL, 7, 7, '2024-11-30'),
(4, 3545, 'dhaka', 'gulshan', 'bangladesh', 'apartment', 4356.00, 'gym', 7, 3, 24456.00, 'properties/RSYsinC78SKuEzEqwTGwgtUOd20iF6GqeFEAwM4h.jpg', 'properties/A9rVH1wNxC9UFTtsu66CJr7vZjCZ90qk8XxHNK3g.jpg', 'properties/SukXgaSOrczR3XVXZ6wk7QkuPVWncCrF95w3HK6J.jpg', NULL, 7, 5, '2024-11-22');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `type` varchar(100) NOT NULL,
  `cost` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `picture`, `type`, `cost`, `description`, `created_at`, `updated_at`) VALUES
(1, 'images/plumbing_service.jpg', 'Plumbing', 75.00, 'Leak repair and pipe replacement.', '2024-11-03 16:37:05', '2024-11-03 16:37:05'),
(2, 'images/electrical_service.jpg', 'Electrical', 100.00, 'Wiring installation and electrical repairs.', '2024-11-03 16:37:05', '2024-11-03 16:37:05'),
(3, 'images/carpentry_service.jpg', 'Carpentry', 85.00, 'Furniture assembly and woodwork.', '2024-11-03 16:37:05', '2024-11-03 16:37:05'),
(4, 'images/cleaning_service.jpg', 'Cleaning', 50.00, 'House cleaning and maintenance services.', '2024-11-03 16:37:05', '2024-11-03 16:37:05'),
(5, 'images/hvac_service.jpg', 'HVAC', 120.00, 'Heating and cooling system maintenance.', '2024-11-03 16:37:05', '2024-11-03 16:37:05');

-- --------------------------------------------------------

--
-- Table structure for table `service_requests`
--

CREATE TABLE `service_requests` (
  `id` int(11) NOT NULL,
  `tenant_id` int(11) NOT NULL,
  `property_ID` int(11) NOT NULL,
  `service_type` varchar(255) NOT NULL,
  `service_date` date NOT NULL,
  `service_time` time NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('pending','ongoing','completed','canceled') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_requests`
--

INSERT INTO `service_requests` (`id`, `tenant_id`, `property_ID`, `service_type`, `service_date`, `service_time`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 'Plumbing', '2024-11-14', '11:00:00', 'drainage likage', 'canceled', '2024-11-03 11:02:10', '2024-11-03 11:06:01'),
(16, 1, 4, 'Plumbing', '2024-11-13', '06:06:00', 'gtfhhf', 'pending', '2024-11-03 13:04:11', '2024-11-03 13:04:11'),
(17, 1, 4, 'Plumbing', '2024-11-29', '12:03:00', 'dirty', 'pending', '2024-11-03 13:05:22', '2024-11-03 13:05:22'),
(18, 1, 4, 'Plumbing', '2024-11-28', '11:02:00', 'go', 'pending', '2024-11-03 13:08:32', '2024-11-03 13:08:32');

-- --------------------------------------------------------

--
-- Table structure for table `tenants`
--

CREATE TABLE `tenants` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `current_address` varchar(255) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `account_type` varchar(50) DEFAULT 'tenant',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `property_ID` int(11) DEFAULT NULL,
  `rental_start_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tenants`
--

INSERT INTO `tenants` (`id`, `full_name`, `email`, `password`, `picture`, `current_address`, `phone_number`, `account_type`, `created_at`, `updated_at`, `property_ID`, `rental_start_date`) VALUES
(1, 'jachi', 'jsangma234@gmail.com', '$2y$10$t5LcX7qSMXIWLPSBpP.vFemvq/fH0ebg9/bRvXUYCLiXlHdAM5dUC', 'profile_pictures/WCACtmUJj0XrLxjSaioz2fYkHu88ZmeCIIImszfM.jpg', 'sdgsdg', '01727652231', 'tenant', '2024-11-01 21:34:56', '2024-11-03 14:24:18', 4, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `current_address` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `account_type` enum('landlord','visitor') DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `current_address`, `phone_number`, `account_type`, `email`, `password`, `picture`, `created_at`, `updated_at`) VALUES
(2, 'jachi', 'dhaka', '01727652231', 'visitor', 'jsangma7@gmail.com', '$2y$10$ihr5cSwBJQxz0IW.Dl/eIOCiNMElAulS5.zF78sYM0GE6OAEhVee6', 'profile_pictures/9p77J9VGlc2xmqC2ehw6jrlqIet7IWFQ03k1dQ8I.jpg', '2024-11-03 05:23:30', '2024-11-03 05:23:30'),
(3, 'jachi', 'dhaka', '01727652231', 'visitor', 'jsangma70@gmail.com', '$2y$10$EI3R44Ahj5.gOU/qIMmtN.v0/QfIUxh2zFYLkJmU2SJkjFMrUO8ku', 'profile_pictures/nFupYZwsqjn4r2mwq6BcbJSSIdT9KxXLwAb7o2TS.jpg', '2024-11-03 05:26:00', '2024-11-03 05:26:00'),
(4, 'jachi', 'dhaka', '01727652231', 'visitor', 'jsangma99@gmail.com', '$2y$10$Ssbpd3nnxv0hQBkXO5A9HORG4NM2shx4.e9D5rokAsc/01KnWqL3C', 'profile_pictures/uu7NrFbfQNKQEumuG4IpiKqLEpkZi8B17Z0JK036.jpg', '2024-11-03 05:28:48', '2024-11-03 05:28:48');

-- --------------------------------------------------------

--
-- Table structure for table `visit_requests`
--

CREATE TABLE `visit_requests` (
  `id` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `visit_date` date NOT NULL,
  `visit_time` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `property_id` int(11) NOT NULL,
  `status` enum('pending','approved','rejected','canceled') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `landlord`
--
ALTER TABLE `landlord`
  ADD PRIMARY KEY (`landlord_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `landlord_id` (`landlord_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `property`
--
ALTER TABLE `property`
  ADD PRIMARY KEY (`property_ID`),
  ADD KEY `Landlord_ID` (`landlord_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_requests`
--
ALTER TABLE `service_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tenant_id` (`tenant_id`),
  ADD KEY `property_ID` (`property_ID`);

--
-- Indexes for table `tenants`
--
ALTER TABLE `tenants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_property` (`property_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `visit_requests`
--
ALTER TABLE `visit_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_visit_user_id` (`user_id`),
  ADD KEY `fk_property_id` (`property_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `landlord`
--
ALTER TABLE `landlord`
  MODIFY `landlord_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `property`
--
ALTER TABLE `property`
  MODIFY `property_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `service_requests`
--
ALTER TABLE `service_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tenants`
--
ALTER TABLE `tenants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `visit_requests`
--
ALTER TABLE `visit_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`landlord_id`) REFERENCES `landlord` (`landlord_id`) ON DELETE CASCADE;

--
-- Constraints for table `property`
--
ALTER TABLE `property`
  ADD CONSTRAINT `property_ibfk_1` FOREIGN KEY (`landlord_id`) REFERENCES `landlord` (`landlord_id`) ON DELETE CASCADE;

--
-- Constraints for table `service_requests`
--
ALTER TABLE `service_requests`
  ADD CONSTRAINT `service_requests_ibfk_1` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`),
  ADD CONSTRAINT `service_requests_ibfk_2` FOREIGN KEY (`property_ID`) REFERENCES `property` (`property_ID`);

--
-- Constraints for table `tenants`
--
ALTER TABLE `tenants`
  ADD CONSTRAINT `fk_property` FOREIGN KEY (`property_ID`) REFERENCES `property` (`property_ID`);

--
-- Constraints for table `visit_requests`
--
ALTER TABLE `visit_requests`
  ADD CONSTRAINT `fk_property_id` FOREIGN KEY (`property_id`) REFERENCES `property` (`property_ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_visit_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

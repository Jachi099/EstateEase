-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2024 at 11:43 AM
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
(16, 'Jannatun Naim Samia', 'jsamia211090@bscse.uiu.ac.bd', '01837493744', 'kalachandpur, gulshan,dhaka-1212', '$2y$10$61zB4FP/9ko46J88tFbEReSovBnA92oFN7jVZ/c3R6/FDZO1anKdu', 0x70726f66696c655f70696374757265732f553155367a50627773616f6477584e4f7466784c4e456e4265577a79556f59355571596d354234532e6a7067, 'landlord', '2024-12-04 05:52:15', '2024-12-04 05:52:15'),
(17, 'Shamima Sultana', 'ssultana211025@bscse.uiu.ac.bd', '017366458733', 'Oman', '$2y$10$9gZA9NAKEaVcvEe1.D.spui1BsXSjuQ/V9AWX8lOIpX1l4JMSHcFm', 0x70726f66696c655f70696374757265732f4f6247754157766c7a37424445684434324648417a6f5a3453696c7454624a596d705a6241484c322e6a7067, 'landlord', '2024-12-06 04:12:17', '2024-12-06 04:12:17');

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
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) NOT NULL,
  `visitor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `amount` decimal(10,2) NOT NULL,
  `service_charge` decimal(10,2) NOT NULL,
  `status` enum('pending','confirmed','failed') NOT NULL DEFAULT 'pending',
  `payment_method` enum('nagad','bkash','debit','credit') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `house_no` varchar(100) DEFAULT NULL,
  `area` varchar(100) DEFAULT NULL,
  `thana` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `size` decimal(10,2) DEFAULT NULL,
  `amenities` text DEFAULT NULL,
  `num_of_rooms` int(11) DEFAULT NULL,
  `num_of_bathrooms` int(11) NOT NULL,
  `num_of_balcony` int(11) DEFAULT NULL,
  `rent` decimal(15,2) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `landlord_id` int(11) DEFAULT NULL,
  `floor` int(11) DEFAULT NULL,
  `available_from` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `postal_code` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `property`
--

INSERT INTO `property` (`property_ID`, `house_no`, `area`, `thana`, `city`, `type`, `size`, `amenities`, `num_of_rooms`, `num_of_bathrooms`, `num_of_balcony`, `rent`, `status`, `landlord_id`, `floor`, `available_from`, `created_at`, `updated_at`, `postal_code`) VALUES
(17, '12A', 'Banani Block E', 'Banani', 'Dhaka', 'apartment', 950.00, '[\"parking\",\"lift\",\"generator_backup\",\"security\"]', 3, 2, 3, 40000.00, NULL, 17, 3, '2024-12-06', '2024-12-06 10:17:29', '2024-12-06 10:40:31', '1213'),
(18, '20', 'Lalmatia', 'Dhanmondi', 'Dhaka', 'apartment', 1500.00, '[\"parking\",\"lift\",\"generator_backup\",\"security\",\"playground\",\"hot_water\",\"gated_community\",\"rooftop_access\",\"pets_allowed\"]', 4, 3, 2, 70000.00, NULL, 17, 6, '2024-12-06', '2024-12-06 10:20:13', '2024-12-06 10:40:32', '1209'),
(19, '12A', 'Uttara Sector 4', 'Uttara', 'Dhaka', 'condo', 2400.00, '[\"parking\",\"lift\",\"generator_backup\",\"security\",\"swimming_pool\",\"playground\",\"garden\",\"hot_water\",\"gated_community\",\"built_in_wardrobes\",\"rooftop_access\",\"pets_allowed\"]', 5, 4, 3, 70000.00, NULL, 17, 10, '2024-12-08', '2024-12-06 10:25:50', '2024-12-06 10:25:50', '1230'),
(20, '22', 'Mirpur DOHS', 'Mirpur', 'Dhaka', 'villa', 3000.00, '[\"parking\",\"generator_backup\",\"security\",\"gym\",\"private_pool\",\"garden\",\"hot_water\",\"gated_community\",\"built_in_wardrobes\",\"rooftop_access\",\"pets_allowed\"]', 6, 5, 4, 90000.00, NULL, 16, 2, '2024-12-08', '2024-12-06 10:29:29', '2024-12-06 10:29:29', '1216');

-- --------------------------------------------------------

--
-- Table structure for table `property_images`
--

CREATE TABLE `property_images` (
  `id` int(11) NOT NULL,
  `property_ID` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `property_images`
--

INSERT INTO `property_images` (`id`, `property_ID`, `image_path`) VALUES
(16, 17, 'properties/Fm1hmHziBxlfcTG06H8IqANPyC4gq1kc5sWR7SVF.jpg'),
(17, 17, 'properties/Fjn6Y9D8vOC2IxYKQlBBeJeKbZy54MSJZjahfKXK.png'),
(18, 17, 'properties/Qaz4b2LV3ptgtzPUdCEmF5H1aCEDGXH66X45tYXR.png'),
(19, 17, 'properties/RmW3WuWSQJytGosBvppmcda3vaGvI0PmsL8PlMeM.jpg'),
(20, 18, 'properties/jrTNraOrcoPeyhVUeWgEON5sF4nNhNZaoAx2psCa.jpg'),
(21, 18, 'properties/HsHiaCkpiUQypoiC8sikRiRjcWK8jrEsvu20cNU9.jpg'),
(22, 18, 'properties/IEOalJpLEB06nKT7ZLuWknO4lFjaArHGaiy538EY.jpg'),
(23, 18, 'properties/VFEdTeqe6dDaetlLlllAks7UdLi5QijTMbvEU0ok.jpg'),
(24, 18, 'properties/v7XGCFmk6ozffVwKIcxOD4T0yPvCAqtWsVcl4ifr.png'),
(25, 19, 'properties/SdXwWqUtQaVwDqsWwPkNR3BfFOrU2l4TPXkNGY8u.jpg'),
(26, 19, 'properties/8ymrIs0OwvncwRxEJvfVsMIXxhDKUO2X0w1Uz6wQ.jpg'),
(27, 19, 'properties/NCqBqErBbVWA0noxnXn4k47SeF5D5fsAbuTasAdG.jpg'),
(28, 19, 'properties/FZwKhQnAOAlQ3mYe1czVcJvWyp1db0ONVjs8vLkP.jpg'),
(29, 19, 'properties/hhCk1CrMrtFmmF0RQVeemRqmAIzO3bbLj7fiQBjc.jpg'),
(30, 19, 'properties/p2lyzcnI2mo3BQ5mrswNfcjXjFwxPTVt97bXytAU.jpg'),
(31, 20, 'properties/vbSweokWZWHLtVhTt8plqhT4stsOfFUtIsyuWJ7y.jpg'),
(32, 20, 'properties/zkmW1y3CkGcyBxql4USOxMEIRctbBSf4KnPuEy4e.jpg'),
(33, 20, 'properties/jvJVKLHmNVrJlEyjW25QmwSOYvciimqraheLSOBy.jpg'),
(34, 20, 'properties/lFqpbiRIplB5U123mlrsYj7kl3kqzhrGeddO7Ib3.jpg'),
(35, 20, 'properties/SFqzieOT1Amhcw7JaPMVk5deuHrWaHQRJqgp7fJb.jpg'),
(36, 20, 'properties/uDbd7Zku8eVAFv2OK2CsGtyANOAQx5XkzY4QFcVg.jpg');

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
  `rental_start_date` date DEFAULT NULL,
  `rent` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(22, 'Jachi Sangma', 'ka-50/8c, kalachandpur, gulshan, dhaka', '01785546431', 'visitor', 'jsangma09@gmail.com', '$2y$10$lXo19J8sQSjZOOHJYYF56.HtJB9Hq.AH1aaPOyCuV7D0VcofLAJAG', 'profile_pictures/ZhEIuMFA6mvNyLgmywwqUjTDY9aqdGrFI38YvRyz.jpg', '2024-12-04 05:53:44', '2024-12-04 05:53:44'),
(23, 'Jachi Sangma', 'kalachandpur, gulshan,dhaka-1212', '01785546431', 'visitor', 'jessisangma7@gmail.com', '$2y$10$J83Cdbx3cCquAt.FQLqWTO.Z.h/BgQzEuyEPKFzRjt2UMmdBIfW.a', 'profile_pictures/OHb8BFamkqCzbHnUi8udVUJXG6fcCT9GpHG2albO.png', '2024-12-06 04:49:12', '2024-12-06 04:49:12');

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
  `status` enum('pending','accepted','rejected') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visit_requests`
--

INSERT INTO `visit_requests` (`id`, `user_id`, `visit_date`, `visit_time`, `created_at`, `updated_at`, `property_id`, `status`) VALUES
(17, 22, '2024-12-09', '19:51:00', '2024-12-06 04:48:17', '2024-12-06 04:59:46', 17, 'accepted'),
(20, 23, '2024-12-12', '19:51:00', '2024-12-06 05:00:17', '2024-12-06 05:00:17', 17, 'pending');

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
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_payments_visitor_id` (`visitor_id`);

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
-- Indexes for table `property_images`
--
ALTER TABLE `property_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_ID` (`property_ID`);

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
  MODIFY `landlord_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `property`
--
ALTER TABLE `property`
  MODIFY `property_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `property_images`
--
ALTER TABLE `property_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `visit_requests`
--
ALTER TABLE `visit_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`landlord_id`) REFERENCES `landlord` (`landlord_id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `fk_payments_visitor_id` FOREIGN KEY (`visitor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `property`
--
ALTER TABLE `property`
  ADD CONSTRAINT `property_ibfk_1` FOREIGN KEY (`landlord_id`) REFERENCES `landlord` (`landlord_id`) ON DELETE CASCADE;

--
-- Constraints for table `property_images`
--
ALTER TABLE `property_images`
  ADD CONSTRAINT `property_images_ibfk_1` FOREIGN KEY (`property_ID`) REFERENCES `property` (`property_ID`) ON DELETE CASCADE;

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

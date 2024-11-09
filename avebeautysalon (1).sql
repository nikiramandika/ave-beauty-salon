-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 06, 2024 at 05:07 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `avebeautysalon`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_general_ci NOT NULL,
  `expiration` int NOT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `expiration` int NOT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `cart_id` int NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_active` tinyint(1) NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `cart_item_id` int NOT NULL,
  `cart_id` int DEFAULT NULL,
  `product_id` char(36) DEFAULT NULL,
  `quantity` int NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ;

-- --------------------------------------------------------

--
-- Table structure for table `cashiers`
--

CREATE TABLE `cashiers` (
  `cashier_id` char(36) NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1'
) ;

--
-- Dumping data for table `cashiers`
--

INSERT INTO `cashiers` (`cashier_id`, `user_id`, `is_active`) VALUES
('0bdcc9d0-99d4-11ef-b5ca-04421acf77b5', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `category_slug` varchar(50) NOT NULL,
  `category_image` varchar(255) NOT NULL
);

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_slug`, `category_image`) VALUES
(1, 'Serum ahha', 'serum-ahha', 'storage/categories/1730635989.png'),
(2, 'aSdakjdh akjlsjdglsakfg', 'asdakjdh-akjlsjdglsakfg', 'storage/categories/1730639695.png'),
(4, 'adssdflkajbadsfk', 'adssdflkajbadsfk', 'storage/categories/1730636835.png'),
(5, 'hahahahahaasda', 'hahahahahaasda', 'storage/categories/1730639684.png');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `course_slug` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `sessions` int NOT NULL,
  `benefits` varchar(255) DEFAULT NULL,
  `free_items` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `course_registrations`
--

CREATE TABLE `course_registrations` (
  `registration_id` int NOT NULL,
  `course_id` int DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `sessions_completed` int DEFAULT '0',
  `status` varchar(20) NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `connection` text COLLATE utf8mb4_general_ci NOT NULL,
  `queue` text COLLATE utf8mb4_general_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_general_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_general_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- --------------------------------------------------------

--
-- Table structure for table `information`
--

CREATE TABLE `information` (
  `info_id` int NOT NULL,
  `salon_name` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone_number` varchar(15) NOT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_general_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_general_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_general_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `log_id` int NOT NULL,
  `log_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `invoice_code` varchar(50) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `log_target` enum('User','Product','Transaction','Promotion','Course') NOT NULL,
  `log_description` text NOT NULL,
  `old_value` text,
  `new_value` text
);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `member_id` char(36) NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `membership_number` varchar(50) NOT NULL,
  `points` int DEFAULT '0',
  `joined_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_active` tinyint(1) DEFAULT '1',
  `updated_at` timestamp NULL DEFAULT NULL
) ;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`member_id`, `user_id`, `membership_number`, `points`, `joined_date`, `is_active`, `updated_at`) VALUES
('a08cbcf5-99bf-11ef-b5ca-04421acf77b5', 1, '8273912032', 22, '2024-11-02 17:00:00', 1, '2024-11-03 02:01:35');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `batch` int NOT NULL
);

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `point_redemptions`
--

CREATE TABLE `point_redemptions` (
  `redemption_id` int NOT NULL,
  `member_id` char(36) DEFAULT NULL,
  `points_used` int NOT NULL,
  `reward_type` varchar(50) NOT NULL,
  `discount_amount` decimal(10,2) DEFAULT NULL,
  `redemption_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` char(36) NOT NULL,
  `description_id` char(36) DEFAULT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_slug` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `category_id` int DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ;

-- --------------------------------------------------------

--
-- Table structure for table `product_descriptions`
--

CREATE TABLE `product_descriptions` (
  `description_id` int NOT NULL,
  `product_id` char(36) DEFAULT NULL,
  `product_image` varchar(255) DEFAULT NULL,
  `description` text
);

-- --------------------------------------------------------

--
-- Table structure for table `product_details`
--

CREATE TABLE `product_details` (
  `detail_id` int NOT NULL,
  `product_id` char(36) DEFAULT NULL,
  `product_stock` int DEFAULT NULL,
  `size` varchar(50) DEFAULT NULL,
  `variant` varchar(50) DEFAULT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `promos`
--

CREATE TABLE `promos` (
  `promo_id` int NOT NULL,
  `promo_name` varchar(100) NOT NULL,
  `promo_slug` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `original_price` decimal(10,2) NOT NULL,
  `promo_price` decimal(10,2) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `product_id` char(36) DEFAULT NULL,
  `treatment_id` int DEFAULT NULL
);

--
-- Triggers `promos`
--
DELIMITER $$
CREATE TRIGGER `before_promos_insert` BEFORE INSERT ON `promos` FOR EACH ROW BEGIN
    IF NEW.end_date < NEW.start_date THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'End date must be greater than or equal to start date';
    END IF;
    IF NEW.promo_price > NEW.original_price THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Promo price must be less than or equal to original price';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `selling_invoices`
--

CREATE TABLE `selling_invoices` (
  `selling_invoice_id` char(36) NOT NULL,
  `invoice_code` varchar(20) NOT NULL,
  `cashier_id` char(36) DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `recipient_name` varchar(100) DEFAULT NULL,
  `recipient_phone` varchar(15) DEFAULT NULL,
  `recipient_file` varchar(255) DEFAULT NULL,
  `recipient_request` longtext,
  `recipient_bank` varchar(255) DEFAULT NULL,
  `recipient_payment` varchar(255) DEFAULT NULL,
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `order_complete` timestamp NULL DEFAULT NULL,
  `refund_file` varchar(255) DEFAULT NULL,
  `order_status` varchar(20) NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `selling_invoice_details`
--

CREATE TABLE `selling_invoice_details` (
  `invoice_detail_id` int NOT NULL,
  `invoice_id` char(36) DEFAULT NULL,
  `product_id` char(36) DEFAULT NULL,
  `treatment_id` int DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int NOT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_general_ci,
  `payload` longtext COLLATE utf8mb4_general_ci NOT NULL,
  `last_activity` int NOT NULL
);

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('dqRbhmhbJRTzxzm3jW2pyeHTE4x2J4DuhvW6Ukzp', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQ2tlWDZwemVkOGVxRVZKMkdvejFvRFNFT1dnQW1BMU02RTBzc08wTyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9jYXRlZ29yaWVzLW93bmVyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1730638315),
('dR55pL8fK6ZnR3MK8IiAzfx2i9souJRzMzVlAj7Z', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSHJzVlhLUmFLT1FrQUtqWjRXaTlpRkpiODJTUGYwcVJzSWRtU2R5SCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9jYXRlZ29yaWVzLW93bmVyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1730639857);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `cashier_id` char(36) DEFAULT NULL,
  `transaction_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total_amount` decimal(10,2) NOT NULL,
  `points_earned` int DEFAULT '0',
  `payment_method` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_items`
--

CREATE TABLE `transaction_items` (
  `item_id` int NOT NULL,
  `transaction_id` int DEFAULT NULL,
  `product_id` char(36) DEFAULT NULL,
  `treatment_id` int DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `order_status` varchar(20) DEFAULT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `treatments`
--

CREATE TABLE `treatments` (
  `treatment_id` int NOT NULL,
  `treatment_name` varchar(100) NOT NULL,
  `treatment_slug` varchar(100) NOT NULL,
  `base_price` decimal(10,2) NOT NULL,
  `is_variable_price` tinyint(1) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ;

-- --------------------------------------------------------

--
-- Table structure for table `treatment_descriptions`
--

CREATE TABLE `treatment_descriptions` (
  `description_id` int NOT NULL,
  `treatment_id` int DEFAULT NULL,
  `treatment_image` varchar(255) DEFAULT NULL,
  `description` text
);

-- --------------------------------------------------------

--
-- Table structure for table `treatment_details`
--

CREATE TABLE `treatment_details` (
  `detail_id` int NOT NULL,
  `treatment_id` int DEFAULT NULL,
  `duration` varchar(50) DEFAULT NULL,
  `method` varchar(50) DEFAULT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_depan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama_belakang` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('Admin','Cashier','User','') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'User',
  `remember_token` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1'
);

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama_depan`, `nama_belakang`, `phone`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`, `is_active`) VALUES
(1, 'Niki', 'Ramandika', '081269447678', 'nikiramandika@icloud.com', '2024-11-02 15:16:17', 'Niki1234', 'Cashier', NULL, '2024-11-02 15:16:17', '2024-11-03 04:09:08', 1),
(2, 'Nikiaowkawok', 'Ramandika', NULL, 'nikiramandika@gmail.com', NULL, '$2y$12$HOBv0lUIpMMRkK8PquD86ev9z5qMyMu4fIcR1a26twXKZCvWWTkjS', 'Admin', NULL, '2024-11-03 01:08:55', '2024-11-03 04:16:59', 1);

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `after_user_insert` AFTER INSERT ON `users` FOR EACH ROW BEGIN
    IF NEW.role = 'Cashier' THEN
        INSERT INTO cashiers (cashier_id, user_id, is_active)
        VALUES (UUID(), NEW.id, NEW.is_active);
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_user_update` AFTER UPDATE ON `users` FOR EACH ROW BEGIN
    -- Jika role diubah menjadi Cashier
    IF NEW.role = 'Cashier' AND OLD.role != 'Cashier' THEN
        INSERT INTO cashiers (cashier_id, user_id, is_active)
        VALUES (UUID(), NEW.id, NEW.is_active);
    
    -- Jika role diubah dari Cashier ke role lain
    ELSEIF OLD.role = 'Cashier' AND NEW.role != 'Cashier' THEN
        DELETE FROM cashiers WHERE user_id = OLD.id;
    
    -- Jika tetap Cashier tapi status is_active berubah
    ELSEIF NEW.role = 'Cashier' AND OLD.role = 'Cashier' AND NEW.is_active != OLD.is_active THEN
        UPDATE cashiers 
        SET is_active = NEW.is_active
        WHERE user_id = NEW.id;
    END IF;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`cart_id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`is_active`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`cart_item_id`),
  ADD UNIQUE KEY `cart_id` (`cart_id`,`product_id`),
  ADD KEY `fk_cart_item_product` (`product_id`);

--
-- Indexes for table `cashiers`
--
ALTER TABLE `cashiers`
  ADD PRIMARY KEY (`cashier_id`),
  ADD KEY `fk_cashier_user` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`),
  ADD UNIQUE KEY `category_slug` (`category_slug`),
  ADD UNIQUE KEY `category_image` (`category_image`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`),
  ADD UNIQUE KEY `course_slug` (`course_slug`);

--
-- Indexes for table `course_registrations`
--
ALTER TABLE `course_registrations`
  ADD PRIMARY KEY (`registration_id`),
  ADD KEY `fk_course_registration_course` (`course_id`),
  ADD KEY `fk_course_registration_user` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `information`
--
ALTER TABLE `information`
  ADD PRIMARY KEY (`info_id`);

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
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`member_id`),
  ADD UNIQUE KEY `membership_number` (`membership_number`),
  ADD KEY `fk_member_user` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `point_redemptions`
--
ALTER TABLE `point_redemptions`
  ADD PRIMARY KEY (`redemption_id`),
  ADD KEY `fk_point_redemption_member` (`member_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `product_slug` (`product_slug`),
  ADD KEY `fk_product_category` (`category_id`);

--
-- Indexes for table `product_descriptions`
--
ALTER TABLE `product_descriptions`
  ADD PRIMARY KEY (`description_id`),
  ADD KEY `fk_product_description_product` (`product_id`);

--
-- Indexes for table `product_details`
--
ALTER TABLE `product_details`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `fk_product_detail_product` (`product_id`);

--
-- Indexes for table `promos`
--
ALTER TABLE `promos`
  ADD PRIMARY KEY (`promo_id`),
  ADD UNIQUE KEY `promo_slug` (`promo_slug`),
  ADD KEY `fk_promo_product` (`product_id`),
  ADD KEY `fk_promo_treatment` (`treatment_id`);

--
-- Indexes for table `selling_invoices`
--
ALTER TABLE `selling_invoices`
  ADD PRIMARY KEY (`selling_invoice_id`),
  ADD UNIQUE KEY `invoice_code` (`invoice_code`),
  ADD KEY `fk_selling_invoice_cashier` (`cashier_id`),
  ADD KEY `fk_selling_invoice_user` (`user_id`);

--
-- Indexes for table `selling_invoice_details`
--
ALTER TABLE `selling_invoice_details`
  ADD PRIMARY KEY (`invoice_detail_id`),
  ADD UNIQUE KEY `invoice_id` (`invoice_id`,`product_id`,`treatment_id`),
  ADD KEY `fk_selling_invoice_detail_product` (`product_id`),
  ADD KEY `fk_selling_invoice_detail_treatment` (`treatment_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `fk_transaction_user` (`user_id`),
  ADD KEY `fk_transaction_cashier` (`cashier_id`);

--
-- Indexes for table `transaction_items`
--
ALTER TABLE `transaction_items`
  ADD PRIMARY KEY (`item_id`),
  ADD UNIQUE KEY `transaction_id` (`transaction_id`,`product_id`,`treatment_id`),
  ADD KEY `fk_transaction_item_product` (`product_id`),
  ADD KEY `fk_transaction_item_treatment` (`treatment_id`);

--
-- Indexes for table `treatments`
--
ALTER TABLE `treatments`
  ADD PRIMARY KEY (`treatment_id`),
  ADD UNIQUE KEY `treatment_slug` (`treatment_slug`);

--
-- Indexes for table `treatment_descriptions`
--
ALTER TABLE `treatment_descriptions`
  ADD PRIMARY KEY (`description_id`),
  ADD KEY `fk_treatment_description_treatment` (`treatment_id`);

--
-- Indexes for table `treatment_details`
--
ALTER TABLE `treatment_details`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `fk_treatment_detail_treatment` (`treatment_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `log_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `fk_cart_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `fk_cart_item_cart` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`cart_id`),
  ADD CONSTRAINT `fk_cart_item_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `cashiers`
--
ALTER TABLE `cashiers`
  ADD CONSTRAINT `fk_cashier_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `course_registrations`
--
ALTER TABLE `course_registrations`
  ADD CONSTRAINT `fk_course_registration_course` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`),
  ADD CONSTRAINT `fk_course_registration_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `fk_member_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `point_redemptions`
--
ALTER TABLE `point_redemptions`
  ADD CONSTRAINT `fk_point_redemption_member` FOREIGN KEY (`member_id`) REFERENCES `members` (`member_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_product_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `product_descriptions`
--
ALTER TABLE `product_descriptions`
  ADD CONSTRAINT `fk_product_description_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `product_details`
--
ALTER TABLE `product_details`
  ADD CONSTRAINT `fk_product_detail_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `promos`
--
ALTER TABLE `promos`
  ADD CONSTRAINT `fk_promo_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `fk_promo_treatment` FOREIGN KEY (`treatment_id`) REFERENCES `treatments` (`treatment_id`);

--
-- Constraints for table `selling_invoices`
--
ALTER TABLE `selling_invoices`
  ADD CONSTRAINT `fk_selling_invoice_cashier` FOREIGN KEY (`cashier_id`) REFERENCES `cashiers` (`cashier_id`),
  ADD CONSTRAINT `fk_selling_invoice_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `selling_invoice_details`
--
ALTER TABLE `selling_invoice_details`
  ADD CONSTRAINT `fk_selling_invoice_detail_invoice` FOREIGN KEY (`invoice_id`) REFERENCES `selling_invoices` (`selling_invoice_id`),
  ADD CONSTRAINT `fk_selling_invoice_detail_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `fk_selling_invoice_detail_treatment` FOREIGN KEY (`treatment_id`) REFERENCES `treatments` (`treatment_id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `fk_transaction_cashier` FOREIGN KEY (`cashier_id`) REFERENCES `cashiers` (`cashier_id`),
  ADD CONSTRAINT `fk_transaction_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `transaction_items`
--
ALTER TABLE `transaction_items`
  ADD CONSTRAINT `fk_transaction_item_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `fk_transaction_item_transaction` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`transaction_id`),
  ADD CONSTRAINT `fk_transaction_item_treatment` FOREIGN KEY (`treatment_id`) REFERENCES `treatments` (`treatment_id`);

--
-- Constraints for table `treatment_descriptions`
--
ALTER TABLE `treatment_descriptions`
  ADD CONSTRAINT `fk_treatment_description_treatment` FOREIGN KEY (`treatment_id`) REFERENCES `treatments` (`treatment_id`);

--
-- Constraints for table `treatment_details`
--
ALTER TABLE `treatment_details`
  ADD CONSTRAINT `fk_treatment_detail_treatment` FOREIGN KEY (`treatment_id`) REFERENCES `treatments` (`treatment_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

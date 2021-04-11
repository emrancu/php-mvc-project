
CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT ,
  `amount` int(20) NOT NULL,
  `buyer` varchar(255) NOT NULL,
  `receipt_id` varchar(20) NOT NULL,
  `items` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `buyer_email` varchar(50) NOT NULL,
  `buyer_ip` varchar(20) DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `hash_key` varchar(255) DEFAULT NULL,
  `entry_at` date DEFAULT NULL,
  `entry_by` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

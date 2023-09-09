<?php

// Database connection parameters
$host = 'localhost'; // Replace with your database host
$username = 'admin'; // Replace with your database username
$password = 'admin'; // Replace with your database password

try {
    // Create a new PDO instance (database connection)
    $pdo = new PDO("mysql:host=$host;", $username, $password);

    // Set PDO error mode to exception for better error handling
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create a new database
    $databaseName = 'articles_app'; // Replace with your desired database name
    $pdo->exec("CREATE DATABASE IF NOT EXISTS $databaseName");
    echo "Database '$databaseName' created successfully.\n";

    // Switch to the newly created database
    $pdo->exec("USE $databaseName");

    $pdo->exec("
    DROP TABLE IF EXISTS `users`;
    CREATE TABLE `users` (
      `id` int NOT NULL AUTO_INCREMENT,
      `email` varchar(100) NOT NULL,
      `password` varchar(255) NOT NULL,
      `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
      `profile_picture` varchar(255) DEFAULT NULL,
      `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
      `status` varchar(50) NOT NULL,
      `group` int NOT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
     ");

    echo "Table 'users' created successfully.\n";


    // Create a sample table
    $pdo->exec("
    DROP TABLE IF EXISTS `account_verifications`;
    CREATE TABLE `account_verifications` (
      `id` bigint unsigned NOT NULL AUTO_INCREMENT,
      `user_id` int NOT NULL,
      `token` varchar(255) NOT NULL,
      `expiration` timestamp NOT NULL,
      UNIQUE KEY `id` (`id`),
      KEY `user_id` (`user_id`),
      CONSTRAINT `account_verifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
    ");

    echo "Table 'account_verifications' created successfully.\n";

    // Create a sample table
    $pdo->exec("
    DROP TABLE IF EXISTS `articles`;
    CREATE TABLE `articles` (
      `id` int NOT NULL AUTO_INCREMENT,
      `title` varchar(255) NOT NULL,
      `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
      `content` text NOT NULL,
      `author_id` int NOT NULL,
      `category_id` int NOT NULL,
      `publication_date` date NOT NULL,
      `image_url` varchar(255) DEFAULT NULL,
      PRIMARY KEY (`id`),
      KEY `author_id` (`author_id`),
      KEY `category_id` (`category_id`),
      CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

    ");

    echo "Table 'articles' created successfully.\n";    // Create a sample table

    $pdo->exec("
    DROP TABLE IF EXISTS `categories`;
    CREATE TABLE `categories` (
      `id` int NOT NULL AUTO_INCREMENT,
      `name` varchar(50) NOT NULL,
      `description` text,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
    ");

    echo "Table 'categories' created successfully.\n";

    $pdo->exec("
    DROP TABLE IF EXISTS `groups`;
    CREATE TABLE `groups` (
      `id` int NOT NULL AUTO_INCREMENT,
      `name` varchar(50) NOT NULL,
      `permissions` text NOT NULL,
      UNIQUE KEY `id` (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
    ");

    echo "Table 'groups' created successfully.\n";

    $pdo->exec("
    DROP TABLE IF EXISTS `password_resets`;
    CREATE TABLE `password_resets` (
      `id` int NOT NULL AUTO_INCREMENT,
      `user_id` int NOT NULL,
      `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
      `expiration` timestamp NOT NULL,
      PRIMARY KEY (`id`),
      KEY `user_id` (`user_id`),
      CONSTRAINT `password_resets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
    ");

    echo "Table 'password_resets' created successfully.\n";

    $pdo->exec("
    DROP TABLE IF EXISTS `remember_tokens`;
    CREATE TABLE `remember_tokens` (
      `id` int NOT NULL AUTO_INCREMENT,
      `user_id` int NOT NULL,
      `token` varchar(255) NOT NULL,
      `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
      PRIMARY KEY (`id`),
      KEY `user_id` (`user_id`),
      CONSTRAINT `remember_tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
    ) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
     ");

    echo "Table 'remember_tokens' created successfully.\n";

    // Close the database connection
    $pdo = null;
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>

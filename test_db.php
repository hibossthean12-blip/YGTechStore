<?php
try {
    $pdo = new PDO('mysql:host=127.0.0.1;port=3306', 'root', '');
    echo "Connected OK\n";
    // Create database
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `techstore_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    echo "Database created/verified\n";
}
catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}

<?php

require_once __DIR__ . '/../config.php';

try {
    $connection = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

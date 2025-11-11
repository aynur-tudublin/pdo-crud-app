<?php
/**
 * DDEV database configuration with MySQL
 * The PHP runs INSIDE the DDEV web container, so host is "db" as it is the name of the Docker service name.
 */
$host     = "db";
$port     = "3306";
$username = "db";
$password = "db";
$dbname   = "db";  // use the pre-created "db" database in DDEV

$dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";

$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false
);

<?php
$host = '127.0.0.1';
$port = '3307';
$db   = 'dwarfinder';
$user = 'root';
$pass = '';

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
     $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";
     $pdo = new PDO($dsn, $user, $pass, $options);
     echo "Connected successfully to database '$db' on port $port.";
} catch (\PDOException $e) {
     echo "Connection failed: " . $e->getMessage();
}

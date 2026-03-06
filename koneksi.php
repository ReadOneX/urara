<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "config.php";

try {
    // Menambahkan port ke dalam DSN
    $dsn = "mysql:host=" . DB_HOST . ";port=" . DB_PORT;
    $pdo = new PDO($dsn, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdo->exec("CREATE DATABASE IF NOT EXISTS " . DB_NAME);
    $pdo->exec("USE " . DB_NAME);

    $pdo->exec("CREATE TABLE IF NOT EXISTS stats (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(50) UNIQUE NOT NULL,
        value INT DEFAULT 0
    )");

    $stmt = $pdo->prepare("INSERT IGNORE INTO stats (name, value) VALUES ('cheer_count', 0)");
    $stmt->execute();

} catch (PDOException $e) {
    echo "<div style='color:red; background:#fee2e2; padding:10px; border:1px solid red; margin:10px; border-radius:5px; font-family:sans-serif;'>";
    echo "<strong>Database Connection Error:</strong> " . $e->getMessage() . "<br><br>";
    echo "<small>Tips: Pastikan port MySQL benar (8111 atau 3306) dan password root sudah sesuai.</small>";
    echo "</div>";
}
?>

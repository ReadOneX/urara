<?php
require_once "../koneksi.php";

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Update jumlah cheers di database
        $stmt = $pdo->prepare("UPDATE stats SET value = value + 1 WHERE name = 'cheer_count'");
        $stmt->execute();

        // Ambil nilai terbaru
        $stmt = $pdo->prepare("SELECT value FROM stats WHERE name = 'cheer_count'");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        echo json_encode(['success' => true, 'count' => $result['value']]);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        $stmt = $pdo->prepare("SELECT value FROM stats WHERE name = 'cheer_count'");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode(['count' => $result['value']]);
    } catch (PDOException $e) {
        echo json_encode(['count' => 0]);
    }
}
?>

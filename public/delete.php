<?php
declare(strict_types=1);
require_once __DIR__ . '/../config/bd.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id <= 0) {
    die("ID inválido.");
}

try {
    $stmt = $pdo->prepare("DELETE FROM producto WHERE producto_id = :id");
    $stmt->execute(['id' => $id]);

    header("Location: index.php?msg=Producto eliminado");
    exit;

} catch (PDOException $e) {
    die("Error al eliminar: " . $e->getMessage());
}

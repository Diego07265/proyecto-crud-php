<?php
declare(strict_types=1);
require_once __DIR__ . '/../config/bd.php';

// Recibir datos
$id = (int) ($_POST['producto_id'] ?? 0);
$nombre = $_POST['nombre'] ?? '';
$categoria_id = (int) ($_POST['categoria_id'] ?? 0);
$precio = (float) ($_POST['precio'] ?? 0);
$stock = (int) ($_POST['stock'] ?? 0);
$fecha_vencimiento = $_POST['fecha_vencimiento'] ?: null;
$id_proveedor = (int) ($_POST['id_proveedor'] ?? 0);
$requiere_receta = isset($_POST['requiere_receta']) ? 1 : 0;

if ($id <= 0) {
    die("ID inválido.");
}

try {
    $sql = "UPDATE producto 
            SET nombre = :nombre,
                categoria_id = :categoria_id,
                precio = :precio,
                stock = :stock,
                fecha_vencimiento = :fecha_vencimiento,
                requiere_receta = :requiere_receta,
                id_proveedor = :id_proveedor
            WHERE producto_id = :id";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        'nombre' => $nombre,
        'categoria_id' => $categoria_id,
        'precio' => $precio,
        'stock' => $stock,
        'fecha_vencimiento' => $fecha_vencimiento,
        'requiere_receta' => $requiere_receta,
        'id_proveedor' => $id_proveedor,
        'id' => $id
    ]);

    header("Location: index.php?msg=Producto actualizado correctamente");
    exit;

} catch (PDOException $e) {
    die("Error al actualizar: " . $e->getMessage());
}

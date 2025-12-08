<?php
declare(strict_types=1);
require_once __DIR__ . '/../config/bd.php';

try {
    // Recibir datos del formulario y convertir a tipos correctos
    $nombre = trim($_POST['nombre'] ?? ''); // string
    $categoria_id = isset($_POST['categoria_id']) ? (int)$_POST['categoria_id'] : null; // int
    $precio = isset($_POST['precio']) ? (float)$_POST['precio'] : null; // float
    $stock = isset($_POST['stock']) ? (int)$_POST['stock'] : null; // int
    $fecha_vencimiento = $_POST['fecha_vencimiento'] ?? null; // date (YYYY-MM-DD)
    $requiere_receta = isset($_POST['requiere_receta']) ? 1 : 0; // tinyint(1)
    $id_proveedor = isset($_POST['id_proveedor']) ? (int)$_POST['id_proveedor'] : null; // int

    // Validar campos obligatorios
    if (!$nombre || $categoria_id === null || $precio === null || $stock === null || !$fecha_vencimiento || $id_proveedor === null) {
        throw new Exception("Todos los campos obligatorios deben estar completos.");
    }

    // Preparar e insertar usando PDO
    $sql = "INSERT INTO producto 
            (nombre, categoria_id, precio, stock, fecha_vencimiento, requiere_receta, id_proveedor) 
            VALUES (:nombre, :categoria_id, :precio, :stock, :fecha_vencimiento, :requiere_receta, :id_proveedor)";
    
    $stmt = $bd->prepare($sql);
    $stmt->execute([
        ':nombre' => $nombre,
        ':categoria_id' => $categoria_id,
        ':precio' => $precio,
        ':stock' => $stock,
        ':fecha_vencimiento' => $fecha_vencimiento,
        ':requiere_receta' => $requiere_receta,
        ':id_proveedor' => $id_proveedor
    ]);

    // Redirigir al index si todo está bien
    header("Location: index.php");
    exit;

} catch (Exception $e) {
    echo "<div class='alert alert-danger m-5'>Error al guardar el producto: " . htmlspecialchars($e->getMessage()) . "</div>";
}

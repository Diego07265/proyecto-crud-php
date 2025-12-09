<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/bd.php';

try {

    // Recibir datos del formulario
    $nombre = trim($_POST['nombre'] ?? '');
    $categoria_id = (int) ($_POST['categoria_id'] ?? 0);
    $precio = (float) ($_POST['precio'] ?? 0);
    $stock = (int) ($_POST['stock'] ?? 0);
    $fecha_vencimiento = $_POST['fecha_vencimiento'] ?? null;
    $requiere_receta = isset($_POST['requiere_receta']) ? 1 : 0;
    $id_proveedor = (int) ($_POST['id_proveedor'] ?? 0);

    // Validar campos obligatorios
    if ($nombre === '' || $categoria_id <= 0 || $precio <= 0 || $stock < 0 || $id_proveedor <= 0) {
        die("Error: Todos los campos obligatorios deben ser completados.");
    }

    // Preparar consulta
    $sql = "INSERT INTO producto 
            (nombre, categoria_id, precio, stock, fecha_vencimiento, requiere_receta, id_proveedor)
            VALUES (:nombre, :categoria_id, :precio, :stock, :fecha_vencimiento, :requiere_receta, :id_proveedor)";

    $stmt = $pdo->prepare($sql);

    // Ejecutar
    $stmt->execute([
        ':nombre' => $nombre,
        ':categoria_id' => $categoria_id,
        ':precio' => $precio,
        ':stock' => $stock,
        ':fecha_vencimiento' => $fecha_vencimiento,
        ':requiere_receta' => $requiere_receta,
        ':id_proveedor' => $id_proveedor
    ]);

    // Volver al index
    header('Location: index.php?msg=Producto creado correctamente');
    exit;

} catch (Exception $e) {
    echo "Error al guardar el producto: " . $e->getMessage();
}

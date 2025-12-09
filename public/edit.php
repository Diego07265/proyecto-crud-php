<?php
declare(strict_types=1);
require_once __DIR__ . '/../config/bd.php';

// Validar ID
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if ($id <= 0) {
    die("ID inválido.");
}

// Obtener el producto
$stmt = $pdo->prepare("SELECT * FROM producto WHERE producto_id = :id");
$stmt->execute(['id' => $id]);
$producto = $stmt->fetch();

if (!$producto) {
    die("Producto no encontrado.");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h1 class="mb-4">Editar Producto</h1>

    <form action="update.php" method="POST">
        <input type="hidden" name="producto_id" value="<?= htmlspecialchars($producto['producto_id']) ?>">

        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nombre" required value="<?= htmlspecialchars($producto['nombre']) ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Categoria ID</label>
            <input type="number" class="form-control" name="categoria_id" required value="<?= htmlspecialchars($producto['categoria_id']) ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Precio</label>
            <input type="number" step="0.01" class="form-control" name="precio" required value="<?= htmlspecialchars($producto['precio']) ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Stock</label>
            <input type="number" class="form-control" name="stock" required value="<?= htmlspecialchars($producto['stock']) ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Fecha de Vencimiento</label>
            <input type="date" class="form-control" name="fecha_vencimiento" value="<?= htmlspecialchars($producto['fecha_vencimiento']) ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Proveedor ID</label>
            <input type="number" class="form-control" name="id_proveedor" required value="<?= htmlspecialchars($producto['id_proveedor']) ?>">
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" class="form-check-input" name="requiere_receta" <?= $producto['requiere_receta'] ? 'checked' : '' ?>>
            <label class="form-check-label">Requiere Receta</label>
        </div>

        <button type="submit" class="btn btn-success">Guardar Cambios</button>
        <a href="index.php" class="btn btn-secondary">Volver</a>
    </form>

</div>

</body>
</html>

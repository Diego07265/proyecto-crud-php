<?php
declare(strict_types=1);
require_once __DIR__ . '/../config/bd.php';

// Validar ID recibido
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    echo "<div class='container mt-3'><div class='alert alert-danger'>ID inválido.</div></div>";
    exit;
}

try {
    $sql = 'SELECT * FROM producto WHERE producto_id = :id LIMIT 1';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    $producto = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$producto) {
        echo "<div class='container mt-3'><div class='alert alert-warning'>Producto no encontrado.</div></div>";
        exit;
    }

} catch (PDOException $e) {
    echo "<div class='container mt-3'><div class='alert alert-danger'>Error: " . htmlspecialchars($e->getMessage()) . "</div></div>";
    exit;
}
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Editar Producto</title>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
  <h1>Editar Producto</h1>

  <form action="update.php" method="post">
    <input type="hidden" name="producto_id" value="<?= htmlspecialchars((string)$producto['producto_id']) ?>">

    <div class="mb-3">
      <label class="form-label">Nombre</label>
      <input name="nombre" class="form-control" value="<?= htmlspecialchars($producto['nombre']) ?>">
    </div>

    <div class="mb-3">
      <label class="form-label">Categoría ID</label>
      <input name="categoria_id" type="number" class="form-control" value="<?= htmlspecialchars((string)$producto['categoria_id']) ?>">
    </div>

    <div class="mb-3">
      <label class="form-label">Precio</label>
      <input name="precio" type="number" step="0.01" class="form-control" value="<?= htmlspecialchars((string)$producto['precio']) ?>">
    </div>

    <div class="mb-3">
      <label class="form-label">Stock</label>
      <input name="stock" type="number" class="form-control" value="<?= htmlspecialchars((string)$producto['stock']) ?>">
    </div>

    <div class="mb-3">
      <label class="form-label">Fecha de vencimiento</label>
      <input name="fecha_vencimiento" type="date" class="form-control" value="<?= htmlspecialchars((string)$producto['fecha_vencimiento']) ?>">
    </div>

    <div class="form-check mb-3">
      <input id="rec" name="requiere_receta" type="checkbox" class="form-check-input" <?= $producto['requiere_receta'] ? 'checked' : '' ?> value="1">
      <label class="form-check-label" for="rec">Requiere receta</label>
    </div>

    <div class="mb-3">
      <label class="form-label">ID Proveedor</label>
      <input name="id_proveedor" type="number" class="form-control" value="<?= htmlspecialchars((string)$producto['id_proveedor']) ?>">
    </div>

    <button class="btn btn-success">Guardar</button>
    <a class="btn btn-secondary" href="index.php">Cancelar</a>
  </form>
</div>

<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>

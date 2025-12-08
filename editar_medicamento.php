<?php
require_once 'config.php';

// Obtener el ID del medicamento a editar
$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: index.php');
    exit;
}

// Obtener los datos actuales del medicamento
$stmt = $conn->prepare("SELECT * FROM medicamentos WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$medicamento = $result->fetch_assoc();

if (!$medicamento) {
    header('Location: index.php');
    exit;
}

// Procesar el formulario cuando se envía
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $categoria = $_POST['categoria'];
    
    $stmt = $conn->prepare("UPDATE medicamentos SET nombre = ?, descripcion = ?, precio = ?, stock = ?, categoria = ? WHERE id = ?");
    $stmt->bind_param("ssdisi", $nombre, $descripcion, $precio, $stock, $categoria, $id);
    
    if ($stmt->execute()) {
        header('Location: index.php?mensaje=actualizado');
        exit;
    } else {
        $error = "Error al actualizar el medicamento: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Medicamento - PharmaTrack</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>✏️ Editar Medicamento</h1>
        
        <?php if (isset($error)): ?>
            <div class="alert alert-error"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <form method="POST" class="form-medicamento">
            <div class="form-group">
                <label for="nombre">Nombre del Medicamento:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($medicamento['nombre']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" rows="4" required><?php echo htmlspecialchars($medicamento['descripcion']); ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="precio">Precio ($):</label>
                <input type="number" id="precio" name="precio" step="0.01" value="<?php echo $medicamento['precio']; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="stock">Stock Disponible:</label>
                <input type="number" id="stock" name="stock" value="<?php echo $medicamento['stock']; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="categoria">Categoría:</label>
                <select id="categoria" name="categoria" required>
                    <option value="">Seleccione una categoría</option>
                    <option value="Analgésicos" <?php echo $medicamento['categoria'] === 'Analgésicos' ? 'selected' : ''; ?>>Analgésicos</option>
                    <option value="Antibióticos" <?php echo $medicamento['categoria'] === 'Antibióticos' ? 'selected' : ''; ?>>Antibióticos</option>
                    <option value="Antiinflamatorios" <?php echo $medicamento['categoria'] === 'Antiinflamatorios' ? 'selected' : ''; ?>>Antiinflamatorios</option>
                    <option value="Vitaminas" <?php echo $medicamento['categoria'] === 'Vitaminas' ? 'selected' : ''; ?>>Vitaminas</option>
                    <option value="Otros" <?php echo $medicamento['categoria'] === 'Otros' ? 'selected' : ''; ?>>Otros</option>
                </select>
            </div>
            
            <div class="form-buttons">
                <button type="submit" class="btn btn-primary">💾 Guardar Cambios</button>
                <a href="index.php" class="btn btn-secondary">❌ Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>
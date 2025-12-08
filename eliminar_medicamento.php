<?php
require_once 'config.php';

// Obtener el ID del medicamento a eliminar
$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: index.php?error=id_invalido');
    exit;
}

// Verificar que el medicamento existe
$stmt = $conn->prepare("SELECT nombre FROM medicamentos WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$medicamento = $result->fetch_assoc();

if (!$medicamento) {
    header('Location: index.php?error=no_encontrado');
    exit;
}

// Si se confirma la eliminación
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirmar'])) {
    $stmt = $conn->prepare("DELETE FROM medicamentos WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        header('Location: index.php?mensaje=eliminado');
        exit;
    } else {
        $error = "Error al eliminar el medicamento: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Medicamento - PharmaTrack</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .confirm-box {
            background: #fff3cd;
            border: 2px solid #ffc107;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
            text-align: center;
        }
        .warning-icon {
            font-size: 48px;
            color: #ff6b6b;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🗑️ Eliminar Medicamento</h1>
        
        <?php if (isset($error)): ?>
            <div class="alert alert-error"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <div class="confirm-box">
            <div class="warning-icon">⚠️</div>
            <h2>¿Estás seguro?</h2>
            <p>Estás a punto de eliminar el medicamento:</p>
            <p><strong><?php echo htmlspecialchars($medicamento['nombre']); ?></strong></p>
            <p style="color: #d32f2f;">Esta acción no se puede deshacer.</p>
            
            <form method="POST" style="display: inline;">
                <input type="hidden" name="confirmar" value="1">
                <button type="submit" class="btn btn-danger">🗑️ Sí, Eliminar</button>
                <a href="index.php" class="btn btn-secondary">❌ Cancelar</a>
            </form>
        </div>
    </div>
</body>
</html>
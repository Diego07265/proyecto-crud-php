<?php
require_once 'config.php';

// Obtener todos los medicamentos
$query = "SELECT * FROM medicamentos ORDER BY id DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PharmaTrack - Sistema de Gestión</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>💊 PharmaTrack - Gestión de Medicamentos</h1>
            <p>Sistema de Control de Inventario</p>
        </header>

        <!-- Mensajes de éxito/error -->
        <?php if (isset($_GET['mensaje'])): ?>
            <div class="alert alert-success">
                <?php
                switch ($_GET['mensaje']) {
                    case 'agregado':
                        echo '✅ Medicamento agregado exitosamente';
                        break;
                    case 'actualizado':
                        echo '✅ Medicamento actualizado exitosamente';
                        break;
                    case 'eliminado':
                        echo '✅ Medicamento eliminado exitosamente';
                        break;
                }
                ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-error">
                ❌ Ocurrió un error al procesar la solicitud
            </div>
        <?php endif; ?>

        <!-- Botón para agregar nuevo medicamento -->
        <div style="margin: 20px 0;">
            <a href="agregar.php" class="btn btn-primary">➕ Agregar Nuevo Medicamento</a>
        </div>

        <!-- Tabla de medicamentos -->
        <h2>📋 Lista de Medicamentos</h2>
        
        <?php if ($result->num_rows > 0): ?>
            <table class="tabla-medicamentos">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Categoría</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($medicamento = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $medicamento['id']; ?></td>
                            <td><strong><?php echo htmlspecialchars($medicamento['nombre']); ?></strong></td>
                            <td><?php echo htmlspecialchars(substr($medicamento['descripcion'], 0, 50)); ?>...</td>
                            <td>$<?php echo number_format($medicamento['precio'], 2); ?></td>
                            <td>
                                <span class="stock-badge <?php echo $medicamento['stock'] < 10 ? 'stock-bajo' : 'stock-ok'; ?>">
                                    <?php echo $medicamento['stock']; ?> unidades
                                </span>
                            </td>
                            <td><?php echo htmlspecialchars($medicamento['categoria']); ?></td>
                            <td class="acciones">
                                <a href="editar.php?id=<?php echo $medicamento['id']; ?>" class="btn-accion btn-editar" title="Editar">✏️</a>
                                <a href="eliminar.php?id=<?php echo $medicamento['id']; ?>" class="btn-accion btn-eliminar" title="Eliminar">🗑️</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-info">
                ℹ️ No hay medicamentos registrados. <a href="agregar.php">Agrega el primero</a>
            </div>
        <?php endif; ?>

        <!-- Estadísticas -->
        <div class="estadisticas">
            <div class="stat-card">
                <h3>📊 Total de Medicamentos</h3>
                <p class="stat-number"><?php echo $result->num_rows; ?></p>
            </div>
            
            <?php
            // Calcular valor total del inventario
            $query_total = "SELECT SUM(precio * stock) as valor_total FROM medicamentos";
            $result_total = $conn->query($query_total);
            $valor_total = $result_total->fetch_assoc()['valor_total'] ?? 0;
            ?>
            
            <div class="stat-card">
                <h3>💰 Valor del Inventario</h3>
                <p class="stat-number">$<?php echo number_format($valor_total, 2); ?></p>
            </div>
            
            <?php
            // Contar medicamentos con stock bajo
            $query_bajo = "SELECT COUNT(*) as bajo_stock FROM medicamentos WHERE stock < 10";
            $result_bajo = $conn->query($query_bajo);
            $bajo_stock = $result_bajo->fetch_assoc()['bajo_stock'];
            ?>
            
            <div class="stat-card">
                <h3>⚠️ Stock Bajo</h3>
                <p class="stat-number"><?php echo $bajo_stock; ?></p>
            </div>
        </div>
    </div>

    <footer>
        <p>PharmaTrack © 2024 - Sistema de Gestión de Medicamentos</p>
    </footer>
</body>
</html>

<?php

session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include("conexion.php");

$sql = "SELECT * FROM pedidos ORDER BY fecha DESC";

$resultado = $conexion->query($sql);

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pedidos | Farmacia Dayisyis</title>

    <link rel="stylesheet" href="css/style.css">

</head>

<body>

<header class="encabezado">

    <h1>Farmacia Dayisyis</h1>

    <nav>
        <a href="admin.php">Panel</a>
        <a href="productos_admin.php">Productos</a>
        <a href="pedidos_admin.php">Pedidos</a>
        <a href="logout.php">Cerrar sesión</a>
    </nav>

</header>

<section class="productos">

    <h2>Pedidos registrados</h2>

    <?php if ($resultado->num_rows > 0) { ?>

        <?php while ($pedido = $resultado->fetch_assoc()) { ?>

            <div class="producto">

                <h3>
                    Pedido #<?php echo $pedido['id_pedido']; ?>
                </h3>

                <p>
                    Cliente:
                    <?php echo htmlspecialchars($pedido['cliente']); ?>
                </p>

                <p>
                    Teléfono:
                    <?php echo htmlspecialchars($pedido['telefono']); ?>
                </p>

                <p>
                    Dirección:
                    <?php echo htmlspecialchars($pedido['direccion']); ?>
                </p>

                <p>
                    Fecha:
                    <?php echo htmlspecialchars($pedido['fecha']); ?>
                </p>

                <p>
                    Total:
                    $<?php echo number_format($pedido['total'], 2); ?>
                </p>

                <p>
                    Estado:
                    <?php echo htmlspecialchars($pedido['estado']); ?>
                </p>

            </div>

        <?php } ?>

    <?php } else { ?>

        <p>No hay pedidos registrados.</p>

    <?php } ?>

</section>

</body>
</html>

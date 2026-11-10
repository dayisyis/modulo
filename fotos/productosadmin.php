
<?php

session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include("conexion.php");

$sql = "SELECT productos.*, categorias.nombre AS categoria
        FROM productos
        INNER JOIN categorias
        ON productos.id_categoria = categorias.id_categoria";

$resultado = $conexion->query($sql);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Administrar productos</title>

    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<header class="encabezado">

    <h1>Farmacia Dayisyis</h1>

    <nav>
        <a href="admin.php">Panel</a>
        <a href="agregar_producto.php">Agregar producto</a>
        <a href="pedidos_admin.php">Pedidos</a>
    </nav>

</header>

<section class="productos">

    <h2>Productos registrados</h2>

    <a href="agregar_producto.php" class="boton">
        Agregar nuevo producto
    </a>

    <div class="contenedor-productos">

        <?php while ($producto = $resultado->fetch_assoc()) { ?>

            <div class="producto">

                <img
                    src="fotos/<?php echo htmlspecialchars($producto['imagen']); ?>"
                    alt="Producto"
                >

                <h3>
                    <?php echo htmlspecialchars($producto['nombre']); ?>
                </h3>

                <p>
                    Categoría:
                    <?php echo htmlspecialchars($producto['categoria']); ?>
                </p>

                <p>
                    Precio: $<?php echo number_format($producto['precio'], 2); ?>
                </p>

                <p>
                    Existencias: <?php echo $producto['existencia']; ?>
                </p>

                <a
                    href="editar_producto.php?id=<?php echo $producto['id_producto']; ?>"
                    class="boton">
                    Editar
                </a>

                <form action="eliminar_producto.php" method="POST">

                    <input type="hidden" name="id"
                    value="<?php echo $producto['id_producto']; ?>">

                    <button type="submit" class="boton">
                        Eliminar
                    </button>

                </form>

            </div>

        <?php } ?>

    </div>

</section>

</body>
</html>


<?php

session_start();

include("conexion.php");

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}


// AGREGAR PRODUCTOS
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = (int)($_POST['id_producto'] ?? 0);
    $accion = $_POST['accion'] ?? '';

    if ($accion == "agregar" && $id > 0) {

        $stmt = $conexion->prepare(
            "SELECT existencia FROM productos WHERE id_producto = ?"
        );

        $stmt->bind_param("i", $id);
        $stmt->execute();

        $resultado = $stmt->get_result();
        $producto = $resultado->fetch_assoc();

        if ($producto && $producto['existencia'] > 0) {

            $cantidadActual = $_SESSION['carrito'][$id] ?? 0;

            if ($cantidadActual < $producto['existencia']) {
                $_SESSION['carrito'][$id] = $cantidadActual + 1;
            }

        }

        $stmt->close();
    }


    // ACTUALIZAR CANTIDAD
    if ($accion == "actualizar" && $id > 0) {

        $cantidad = (int)($_POST['cantidad'] ?? 1);

        $stmt = $conexion->prepare(
            "SELECT existencia FROM productos WHERE id_producto = ?"
        );

        $stmt->bind_param("i", $id);
        $stmt->execute();

        $producto = $stmt->get_result()->fetch_assoc();

        if ($producto && $cantidad > 0) {

            if ($cantidad <= $producto['existencia']) {
                $_SESSION['carrito'][$id] = $cantidad;
            }

        } else {
            unset($_SESSION['carrito'][$id]);
        }

        $stmt->close();
    }


    // ELIMINAR PRODUCTO
    if ($accion == "eliminar" && $id > 0) {

        unset($_SESSION['carrito'][$id]);

    }

    header("Location: carrito.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Carrito | Farmacia Dayisyis</title>

    <link rel="stylesheet" href="css/style.css">

</head>

<body>

<header class="encabezado">

    <h1>Farmacia Dayisyis</h1>

    <nav>
        <a href="index.html">Inicio</a>
        <a href="nosotros.html">Nosotros</a>
        <a href="catalogo.php">Catálogo</a>
        <a href="categorias.php">Categorías</a>
        <a href="contacto.html">Contacto</a>
        <a href="carrito.php">🛒 Carrito</a>
    </nav>

</header>


<section class="productos">

    <h2>Mi carrito de compras</h2>

    <?php

    $total = 0;

    if (!empty($_SESSION['carrito'])) {

        foreach ($_SESSION['carrito'] as $id => $cantidad) {

            $stmt = $conexion->prepare(
                "SELECT * FROM productos WHERE id_producto = ?"
            );

            $stmt->bind_param("i", $id);
            $stmt->execute();

            $resultado = $stmt->get_result();

            if ($producto = $resultado->fetch_assoc()) {

                $subtotal = $producto['precio'] * $cantidad;
                $total += $subtotal;

    ?>

                <div class="producto">

                    <img
                        src="fotos/<?php echo htmlspecialchars($producto['imagen']); ?>"
                        alt="<?php echo htmlspecialchars($producto['nombre']); ?>"
                    >

                    <h3>
                        <?php echo htmlspecialchars($producto['nombre']); ?>
                    </h3>

                    <p>
                        Precio: $<?php echo number_format($producto['precio'], 2); ?>
                    </p>

                    <p>
                        Subtotal: $<?php echo number_format($subtotal, 2); ?>
                    </p>


                    <form action="carrito.php" method="POST">

                        <input type="hidden" name="id_producto"
                        value="<?php echo $id; ?>">

                        <input type="hidden" name="accion"
                        value="actualizar">

                        <input type="number" name="cantidad"
                        value="<?php echo $cantidad; ?>"
                        min="1" max="<?php echo $producto['existencia']; ?>">

                        <button type="submit" class="boton">
                            Actualizar
                        </button>

                    </form>


                    <form action="carrito.php" method="POST">

                        <input type="hidden" name="id_producto"
                        value="<?php echo $id; ?>">

                        <input type="hidden" name="accion"
                        value="eliminar">

                        <button type="submit" class="boton">
                            Eliminar
                        </button>

                    </form>

                </div>

    <?php

            }

            $stmt->close();

        }

    ?>

        <h2>
            Total: $<?php echo number_format($total, 2); ?>
        </h2>

        <a href="catalogo.php" class="boton">
            Seguir comprando
        </a>

    <?php

    } else {

        echo "<p>Tu carrito está vacío.</p>";

    }

    ?>

</section>

</body>
</html>

<?php
$conexion->close();
?>

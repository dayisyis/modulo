
<?php

session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include("conexion.php");

$mensaje = "";

$categorias = $conexion->query(
    "SELECT * FROM categorias"
);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = trim($_POST['nombre']);
    $descripcion = trim($_POST['descripcion']);
    $precio = (float)$_POST['precio'];
    $imagen = trim($_POST['imagen']);
    $existencia = (int)$_POST['existencia'];
    $id_categoria = (int)$_POST['id_categoria'];

    if (
        $nombre != "" &&
        $precio >= 0 &&
        $existencia >= 0 &&
        $id_categoria > 0
    ) {

        $stmt = $conexion->prepare(
            "INSERT INTO productos
            (nombre, descripcion, precio, imagen, existencia, id_categoria)
            VALUES (?, ?, ?, ?, ?, ?)"
        );

        $stmt->bind_param(
            "ssdsii",
            $nombre,
            $descripcion,
            $precio,
            $imagen,
            $existencia,
            $id_categoria
        );

        if ($stmt->execute()) {
            $mensaje = "Producto registrado correctamente.";
        } else {
            $mensaje = "Error al registrar el producto.";
        }

        $stmt->close();

    } else {

        $mensaje = "Revisa los datos ingresados.";

    }

}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar producto</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<header class="encabezado">
    <h1>Farmacia Dayisyis</h1>

    <nav>
        <a href="admin.php">Panel</a>
        <a href="productos_admin.php">Productos</a>
        <a href="pedidos_admin.php">Pedidos</a>
    </nav>
</header>

<section class="nosotros">

    <h2>Registrar producto</h2>

    <p><?php echo htmlspecialchars($mensaje); ?></p>

    <form method="POST">

        <input type="text" name="nombre"
        placeholder="Nombre del producto" required>

        <br><br>

        <textarea name="descripcion"
        placeholder="Descripción del producto"></textarea>

        <br><br>

        <input type="number" name="precio"
        placeholder="Precio" min="0" step="0.01" required>

        <br><br>

        <input type="text" name="imagen"
        placeholder="Nombre de la imagen (ejemplo: producto1.jpg)">

        <br><br>

        <input type="number" name="existencia"
        placeholder="Existencias" min="0" required>

        <br><br>

        <select name="id_categoria" required>

            <option value="">Seleccionar categoría</option>

            <?php while ($cat = $categorias->fetch_assoc()) { ?>

                <option value="<?php echo $cat['id_categoria']; ?>">
                    <?php echo htmlspecialchars($cat['nombre']); ?>
                </option>

            <?php } ?>

        </select>

        <br><br>

        <button type="submit" class="boton">
            Guardar producto
        </button>

    </form>

    <br>

    <a href="admin.php" class="boton">Regresar</a>

</section>

</body>
</html>

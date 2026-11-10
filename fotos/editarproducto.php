
<?php

session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include("conexion.php");

$id = (int)($_GET['id'] ?? 0);

$stmt = $conexion->prepare(
    "SELECT * FROM productos WHERE id_producto = ?"
);

$stmt->bind_param("i", $id);
$stmt->execute();

$resultado = $stmt->get_result();
$producto = $resultado->fetch_assoc();
$stmt->close();

if (!$producto) {
    die("Producto no encontrado.");
}

$categorias = $conexion->query(
    "SELECT * FROM categorias"
);

$mensaje = "";

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
            "UPDATE productos SET
            nombre = ?,
            descripcion = ?,
            precio = ?,
            imagen = ?,
            existencia = ?,
            id_categoria = ?
            WHERE id_producto = ?"
        );

        $stmt->bind_param(
            "ssdsiii",
            $nombre,
            $descripcion,
            $precio,
            $imagen,
            $existencia,
            $id_categoria,
            $id
        );

        if ($stmt->execute()) {

            header("Location: productos_admin.php");
            exit();

        } else {

            $mensaje = "Error al actualizar.";

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
    <title>Editar producto</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<section class="nosotros">

    <h2>Editar producto</h2>

    <p><?php echo htmlspecialchars($mensaje); ?></p>

    <form method="POST">

        <input type="text" name="nombre"
        value="<?php echo htmlspecialchars($producto['nombre']); ?>"
        required>

        <br><br>

        <textarea name="descripcion"><?php
            echo htmlspecialchars($producto['descripcion']);
        ?></textarea>

        <br><br>

        <input type="number" name="precio"
        value="<?php echo $producto['precio']; ?>"
        min="0" step="0.01" required>

        <br><br>

        <input type="text" name="imagen"
        value="<?php echo htmlspecialchars($producto['imagen']); ?>">

        <br><br>

        <input type="number" name="existencia"
        value="<?php echo $producto['existencia']; ?>"
        min="0" required>

        <br><br>

        <select name="id_categoria" required>

            <?php while ($cat = $categorias->fetch_assoc()) { ?>

                <option
                    value="<?php echo $cat['id_categoria']; ?>"
                    <?php if ($cat['id_categoria'] == $producto['id_categoria']) echo "selected"; ?>
                >
                    <?php echo htmlspecialchars($cat['nombre']); ?>
                </option>

            <?php } ?>

        </select>

        <br><br>

        <button type="submit" class="boton">
            Guardar cambios
        </button>

    </form>

</section>

</body>
</html>

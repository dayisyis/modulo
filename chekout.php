
<?php

session_start();

include("conexion.php");

if (empty($_SESSION['carrito'])) {
    header("Location: carrito.php");
    exit();
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $cliente = trim($_POST['cliente'] ?? '');
    $telefono = trim($_POST['telefono'] ?? '');
    $direccion = trim($_POST['direccion'] ?? '');

    if ($cliente == "" || $telefono == "" || $direccion == "") {

        $error = "Debes completar todos los campos.";

    } else {

        try {

            $conexion->begin_transaction();

            $total = 0;
            $productos = [];

            foreach ($_SESSION['carrito'] as $id => $cantidad) {

                $stmt = $conexion->prepare(
                    "SELECT nombre, precio, existencia
                     FROM productos
                     WHERE id_producto = ?
                     FOR UPDATE"
                );

                $stmt->bind_param("i", $id);
                $stmt->execute();

                $producto = $stmt->get_result()->fetch_assoc();
                $stmt->close();

                if (!$producto || $cantidad <= 0 ||
                    $cantidad > $producto['existencia']) {

                    throw new Exception("No hay existencia suficiente.");

                }

                $subtotal = $producto['precio'] * $cantidad;
                $total += $subtotal;

                $productos[] = [
                    'id' => $id,
                    'cantidad' => $cantidad,
                    'precio' => $producto['precio']
                ];
            }


            // GUARDAR PEDIDO
            $stmt = $conexion->prepare(
                "INSERT INTO pedidos
                (cliente, telefono, direccion, total)
                VALUES (?, ?, ?, ?)"
            );

            $stmt->bind_param(
                "sssd",
                $cliente,
                $telefono,
                $direccion,
                $total
            );

            $stmt->execute();

            $id_pedido = $conexion->insert_id;
            $stmt->close();


            // GUARDAR DETALLES
            foreach ($productos as $item) {

                $stmt = $conexion->prepare(
                    "INSERT INTO detalle_pedido
                    (id_pedido, id_producto, cantidad, precio)
                    VALUES (?, ?, ?, ?)"
                );

                $stmt->bind_param(
                    "iiid",
                    $id_pedido,
                    $item['id'],
                    $item['cantidad'],
                    $item['precio']
                );

                $stmt->execute();
                $stmt->close();


                // ACTUALIZAR EXISTENCIAS
                $stmt = $conexion->prepare(
                    "UPDATE productos
                     SET existencia = existencia - ?
                     WHERE id_producto = ?"
                );

                $stmt->bind_param(
                    "ii",
                    $item['cantidad'],
                    $item['id']
                );

                $stmt->execute();
                $stmt->close();

            }

            $conexion->commit();

            $_SESSION['carrito'] = [];

            header("Location: carrito.php?pedido=" . $id_pedido);
            exit();

        } catch (Exception $e) {

            $conexion->rollback();

            $error = $e->getMessage();

        }

    }

}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Finalizar compra | Farmacia Dayisyis</title>

    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <header class="encabezado">
        <h1>Farmacia Dayisyis</h1>
    </header>

    <section class="nosotros">

        <h2>Finalizar compra</h2>

        <p>Completa tus datos para registrar tu pedido.</p>

        <?php if ($error != "") { ?>

            <p><?php echo htmlspecialchars($error); ?></p>

        <?php } ?>

        <form action="checkout.php" method="POST">

            <input
                type="text"
                name="cliente"
                placeholder="Nombre completo"
                maxlength="100"
                required
            >

            <br><br>

            <input
                type="tel"
                name="telefono"
                placeholder="Número de teléfono"
                maxlength="20"
                required
            >

            <br><br>

            <input
                type="text"
                name="direccion"
                placeholder="Dirección de entrega"
                maxlength="255"
                required
            >

            <br><br>

            <button type="submit" class="boton">
                Confirmar pedido
            </button>

        </form>

    </section>

</body>
</html>

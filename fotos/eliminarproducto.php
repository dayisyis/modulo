
<?php

session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = (int)($_POST['id'] ?? 0);

    if ($id > 0) {

        $stmt = $conexion->prepare(
            "DELETE FROM productos WHERE id_producto = ?"
        );

        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {

            header("Location: productos_admin.php");
            exit();

        } else {

            echo "No se pudo eliminar el producto. Puede estar asociado a un pedido.";

        }

        $stmt->close();

    }

}

$conexion->close();

?>

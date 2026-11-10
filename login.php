
<?php

session_start();

include("conexion.php");

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usuario = trim($_POST['usuario']);
    $password = $_POST['password'];

    $stmt = $conexion->prepare(
        "SELECT * FROM administradores WHERE usuario = ?"
    );

    $stmt->bind_param("s", $usuario);
    $stmt->execute();

    $resultado = $stmt->get_result();

    if ($admin = $resultado->fetch_assoc()) {

        if (password_verify($password, $admin['password'])) {

            session_regenerate_id(true);

            $_SESSION['admin'] = $admin['id_admin'];

            header("Location: admin.php");
            exit();

        } else {

            $error = "Usuario o contraseña incorrectos.";

        }

    } else {

        $error = "Usuario o contraseña incorrectos.";

    }

    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Administrador | Farmacia Dayisyis</title>

    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <section class="nosotros">

        <h2>Inicio de sesión</h2>

        <p>Panel de administración de Farmacia Dayisyis</p>

        <?php if ($error != "") { ?>
            <p><?php echo htmlspecialchars($error); ?></p>
        <?php } ?>

        <form method="POST">

            <input
                type="text"
                name="usuario"
                placeholder="Usuario"
                required
            >

            <br><br>

            <input
                type="password"
                name="password"
                placeholder="Contraseña"
                required
            >

            <br><br>

            <button type="submit" class="boton">
                Ingresar
            </button>

        </form>

    </section>

</body>
</html>

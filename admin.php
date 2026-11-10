
<?php

include("conexion.php");

$usuario = "admin";
$password = password_hash("Admin12345", PASSWORD_DEFAULT);

$stmt = $conexion->prepare(
    "INSERT INTO administradores (usuario, password)
     VALUES (?, ?)"
);

$stmt->bind_param("ss", $usuario, $password);

if ($stmt->execute()) {
    echo "Administrador registrado correctamente.";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conexion->close();

?>


<?php

session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include("conexion.php");

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Panel de administración</title>

    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<header class="encabezado">

    <h1>Farmacia Dayisyis</h1>

    <nav>
        <a href="admin.php">Panel</a>
        <a href="agregar_producto.php">Agregar producto</a>
        <a href="pedidos_admin.php">Pedidos</a>
        <a href="logout.php">Cerrar sesión</a>
    </nav>

</header>


<section class="nosotros">

    <h2>Panel de administración</h2>

    <p>Bienvenido al sistema de Farmacia Dayisyis.</p>

    <div class="contenedor-categorias">

        <div class="categoria">

            <h3>Productos</h3>

            <a href="productos_admin.php" class="boton">
                Administrar productos
            </a>

        </div>

        <div class="categoria">

            <h3>Agregar productos</h3>

            <a href="agregar_producto.php" class="boton">
                Registrar producto
            </a>

        </div>

        <div class="categoria">

            <h3>Pedidos</h3>

            <a href="pedidos_admin.php" class="boton">
                Ver pedidos
            </a>

        </div>

    </div>

</section>

</body>
</html>

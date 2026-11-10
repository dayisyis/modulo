
<?php
$categorias = [
    "Medicamentos de venta libre",
    "Vitaminas y suplementos",
    "Higiene personal",
    "Cuidado de la piel",
    "Cuidado infantil"
];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorías | Farmacia Dayisyis</title>
    <link rel="stylesheet" href="style.css">
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

    <section class="categorias">

        <h2>Clasificación de productos</h2>

        <div class="contenedor-categorias">

            <?php foreach ($categorias as $categoria) { ?>

                <div class="categoria">

                    <h3>
                        <?php echo $categoria; ?>
                    </h3>

                    <a href="catalogo.php?categoria=<?php echo urlencode($categoria); ?>"
                       class="boton">
                        Ver productos
                    </a>

                </div>

            <?php } ?>

        </div>

    </section>

</body>
</html>

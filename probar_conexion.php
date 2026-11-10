
<?php

$ruta = __DIR__ . "/conexion.php";

if (!file_exists($ruta)) {
    die("No se encuentra el archivo conexion.php");
}

require_once $ruta;

echo "Conexion exitosa con la base de datos!";

?>

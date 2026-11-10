
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Catálogo | Farmacia Dayisyis</title>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body {
    background: #f4f8f6;
    color: #333;
}

/* ENCABEZADO */
header {
    background: white;
    padding: 20px 6%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 2px 10px #0001;
    position: sticky;
    top: 0;
    z-index: 10;
}

.logo {
    color: #269879;
    font-size: 23px;
    font-weight: bold;
}

nav {
    display: flex;
    align-items: center;
    gap: 22px;
}

nav a {
    text-decoration: none;
    color: #444;
    font-weight: bold;
}

nav a:hover {
    color: #269879;
}

.carrito-btn {
    background: #269879;
    color: white;
    border: none;
    padding: 11px 16px;
    border-radius: 8px;
    cursor: pointer;
    font-weight: bold;
}

/* PORTADA */
.portada {
    background: linear-gradient(120deg, #d8f1e8, #edf8f4);
    text-align: center;
    padding: 55px 20px;
}

.portada h1 {
    color: #258568;
    font-size: 36px;
    margin-bottom: 12px;
}

.portada p {
    color: #63766d;
    font-size: 16px;
}

/* CONTENIDO */
.contenido {
    padding: 35px 7%;
}

.titulo {
    text-align: center;
    margin-bottom: 25px;
}

.titulo h2 {
    color: #258568;
    font-size: 27px;
    margin-bottom: 8px;
}

/* BUSCADOR */
.busqueda {
    display: flex;
    justify-content: center;
    margin: 25px 0;
}

.busqueda input {
    width: 65%;
    padding: 15px;
    border: 1px solid #cbded5;
    border-radius: 25px;
    outline: none;
    font-size: 15px;
}

.busqueda input:focus {
    border-color: #269879;
}

/* FILTROS */
.categorias {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 12px;
    margin-bottom: 30px;
}

.categorias button {
    background: #dcefe7;
    color: #28785e;
    border: none;
    padding: 11px 20px;
    border-radius: 20px;
    cursor: pointer;
    font-weight: bold;
}

.categorias button:hover,
.categorias button.activo {
    background: #269879;
    color: white;
}

/* PRODUCTOS */
.productos {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 23px;
}

.producto {
    background: white;
    padding: 18px;
    border-radius: 15px;
    box-shadow: 0 3px 12px #00000010;
    transition: 0.3s;
}

.producto:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 18px #0002;
}

.imagen-producto {
    background: #edf7f2;
    height: 165px;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 12px;
    font-size: 75px;
    margin-bottom: 15px;
}

.producto h3 {
    color: #287c62;
    margin-bottom: 10px;
    font-size: 17px;
}

.producto p {
    font-size: 13px;
    color: #777;
    min-height: 38px;
    line-height: 1.5;
}

.categoria-texto {
    display: inline-block;
    background: #e6f4ed;
    color: #268465;
    padding: 5px 9px;
    border-radius: 10px;
    font-size: 11px;
    margin: 10px 0;
}

.precio {
    color: #269879;
    font-size: 21px;
    font-weight: bold;
    margin: 8px 0 15px;
}

.producto button {
    width: 100%;
    background: #269879;
    color: white;
    border: none;
    padding: 12px;
    border-radius: 8px;
    cursor: pointer;
    font-weight: bold;
}

.producto button:hover {
    background: #20765e;
}

.sin-resultados {
    text-align: center;
    grid-column: 1 / -1;
    padding: 40px;
    color: #777;
}

/* VENTANA DEL CARRITO */
.modal {
    display: none;
    position: fixed;
    inset: 0;
    background: #0008;
    z-index: 20;
    justify-content: center;
    align-items: center;
    padding: 15px;
}

.modal-contenido {
    background: white;
    width: 100%;
    max-width: 500px;
    max-height: 85vh;
    overflow-y: auto;
    padding: 25px;
    border-radius: 15px;
}

.modal-encabezado {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.modal-encabezado h2 {
    color: #258568;
}

.cerrar {
    border: none;
    background: none;
    font-size: 27px;
    cursor: pointer;
}

.item-carrito {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 10px;
    padding: 15px 0;
    border-bottom: 1px solid #eee;
}

.item-carrito p {
    font-size: 14px;
    margin-bottom: 5px;
}

.cantidad {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-top: 7px;
}

.cantidad button,
.eliminar {
    border: none;
    cursor: pointer;
    border-radius: 5px;
    padding: 5px 9px;
}

.cantidad button {
    background: #dcefe7;
}

.eliminar {
    background: #ffe5e5;
    color: #c33;
}

.total {
    text-align: right;
    margin: 20px 0;
    color: #258568;
    font-size: 22px;
    font-weight: bold;
}

.vaciar {
    width: 100%;
    background: #e9eeee;
    padding: 12px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    margin-bottom: 10px;
}

.finalizar {
    width: 100%;
    background: #269879;
    color: white;
    padding: 13px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-weight: bold;
}

.finalizar:hover {
    background: #20765e;
}

.carrito-vacio {
    text-align: center;
    padding: 25px;
    color: #888;
}

/* PIE DE PAGINA */
footer {
    background: #267c61;
    color: white;
    text-align: center;
    padding: 22px;
    margin-top: 40px;
}

/* CELULARES Y TABLETS */
@media(max-width: 1000px) {
    .productos {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media(max-width: 750px) {
    header {
        flex-direction: column;
        gap: 18px;
    }

    nav {
        flex-wrap: wrap;
        justify-content: center;
        gap: 15px;
    }

    .productos {
        grid-template-columns: repeat(2, 1fr);
    }

    .busqueda input {
        width: 90%;
    }
}

@media(max-width: 480px) {
    .productos {
        grid-template-columns: 1fr;
    }

    .portada h1 {
        font-size: 28px;
    }
}
</style>
</head>

<body>

<!-- ENCABEZADO -->
<header>

    <div class="logo">✚ Farmacia Dayisyis</div>

    <nav>
        <a href="index.php">Inicio</a>
        <a href="nosotros.php">Nosotros</a>
        <a href="catalogo.php">Catálogo</a>
        <a href="contacto.php">Contacto</a>

        <button class="carrito-btn" onclick="abrirCarrito()">
            🛒 Carrito (<span id="contador">0</span>)
        </button>
    </nav>

</header>

<!-- PORTADA -->
<section class="portada">
    <h1>Nuestro catálogo</h1>
    <p>Encuentra los productos que necesitas para cuidar de ti.</p>
</section>

<!-- CATALOGO -->
<main class="contenido">

    <div class="titulo">
        <h2>Explora nuestros productos</h2>
        <p>Conoce nuestra variedad de productos disponibles.</p>
    </div>

    <!-- BUSCADOR -->
    <div class="busqueda">
        <input
            type="text"
            id="buscar"
            placeholder="🔍 Buscar un producto..."
            oninput="mostrarProductos()"
        >
    </div>

    <!-- CATEGORIAS -->
    <div class="categorias">

        <button class="activo" onclick="cambiarCategoria('todos', this)">
            Todos
        </button>

        <button onclick="cambiarCategoria('analgesicos', this)">
            Analgésicos
        </button>

        <button onclick="cambiarCategoria('vitaminas', this)">
            Vitaminas
        </button>

        <button onclick="cambiarCategoria('cuidado', this)">
            Cuidado personal
        </button>

        <button onclick="cambiarCategoria('primeros', this)">
            Primeros auxilios
        </button>

    </div>

    <!-- PRODUCTOS GENERADOS CON JAVASCRIPT -->
    <section class="productos" id="listaProductos"></section>

</main>

<!-- VENTANA DEL CARRITO -->
<div class="modal" id="modalCarrito">

    <div class="modal-contenido">

        <div class="modal-encabezado">
            <h2>🛒 Mi carrito</h2>
            <button class="cerrar" onclick="cerrarCarrito()">×</button>
        </div>

        <div id="listaCarrito"></div>

        <div class="total" id="total">
            Total: $0.00
        </div>

        <button class="vaciar" onclick="vaciarCarrito()">
            Vaciar carrito
        </button>

        <button class="finalizar" onclick="finalizarCompra()">
            Finalizar compra
        </button>

    </div>

</div>

<!-- PIE DE PAGINA -->
<footer>
    <p>© 2026 Farmacia Dayisyis</p>
    <p>Tu bienestar es nuestra prioridad.</p>
</footer>

<script>

// LISTA DE PRODUCTOS
const productos = [

    {
        id: 1,
        nombre: "Paracetamol 500 mg",
        descripcion: "Medicamento utilizado para aliviar el dolor y la fiebre.",
        precio: 2.50,
        categoria: "analgesicos",
        icono: "💊"
    },

    {
        id: 2,
        nombre: "Ibuprofeno 400 mg",
        descripcion: "Medicamento antiinflamatorio y analgésico.",
        precio: 3.50,
        categoria: "analgesicos",
        icono: "💊"
    },

    {
        id: 3,
        nombre: "Vitamina C",
        descripcion: "Suplemento alimenticio de vitamina C.",
        precio: 5.00,
        categoria: "vitaminas",
        icono: "🍊"
    },

    {
        id: 4,
        nombre: "Multivitaminas",
        descripcion: "Complemento de vitaminas y minerales.",
        precio: 7.00,
        categoria: "vitaminas",
        icono: "🧴"
    },

    {
        id: 5,
        nombre: "Alcohol 70%",
        descripcion: "Producto para limpieza y desinfección.",
        precio: 1.75,
        categoria: "cuidado",
        icono: "🧴"
    },

    {
        id: 6,
        nombre: "Shampoo",
        descripcion: "Producto para la limpieza del cabello.",
        precio: 4.50,
        categoria: "cuidado",
        icono: "🧴"
    },

    {
        id: 7,
        nombre: "Crema corporal",
        descripcion: "Crema hidratante para el cuidado de la piel.",
        precio: 5.25,
        categoria: "cuidado",
        icono: "🧴"
    },

    {
        id: 8,
        nombre: "Jabón antibacterial",
        descripcion: "Producto para la higiene diaria.",
        precio: 2.25,
        categoria: "cuidado",
        icono: "🧼"
    },

    {
        id: 9,
        nombre: "Curitas",
        descripcion: "Adhesivos para cubrir pequeñas heridas.",
        precio: 1.25,
        categoria: "primeros",
        icono: "🩹"
    },

    {
        id: 10,
        nombre: "Gasas estériles",
        descripcion: "Material para curaciones y primeros auxilios.",
        precio: 2.00,
        categoria: "primeros",
        icono: "🩺"
    },

    {
        id: 11,
        nombre: "Termómetro digital",
        descripcion: "Instrumento para medir la temperatura corporal.",
        precio: 8.00,
        categoria: "primeros",
        icono: "🌡️"
    },

    {
        id: 12,
        nombre: "Suplemento de calcio",
        descripcion: "Suplemento alimenticio de calcio.",
        precio: 6.50,
        categoria: "vitaminas",
        icono: "🧴"
    }

];

// VARIABLES
let categoriaActual = "todos";

let carrito = JSON.parse(localStorage.getItem("carritoDayisyis")) || [];

// MOSTRAR PRODUCTOS
function mostrarProductos() {

    const contenedor = document.getElementById("listaProductos");

    const texto = document.getElementById("buscar")
        .value.toLowerCase();

    contenedor.innerHTML = "";

    const filtrados = productos.filter(producto => {

        const coincideNombre =
            producto.nombre.toLowerCase().includes(texto);

        const coincideCategoria =
            categoriaActual === "todos" ||
            producto.categoria === categoriaActual;

        return coincideNombre && coincideCategoria;

    });

    if (filtrados.length === 0) {
        contenedor.innerHTML =
            '<p class="sin-resultados">No se encontraron productos.</p>';
        return;
    }

    filtrados.forEach(producto => {

        contenedor.innerHTML += `

            <article class="producto">

                <div class="imagen-producto">
                    ${producto.icono}
                </div>

                <h3>${producto.nombre}</h3>

                <p>${producto.descripcion}</p>

                <span class="categoria-texto">
                    ${producto.categoria}
                </span>

                <div class="precio">
                    $${producto.precio.toFixed(2)}
                </div>

                <button onclick="agregarCarrito(${producto.id})">
                    Agregar al carrito
                </button>

            </article>

        `;

    });

}

// CAMBIAR CATEGORIA
function cambiarCategoria(categoria, boton) {

    categoriaActual = categoria;

    document.querySelectorAll(".categorias button")
        .forEach(btn => btn.classList.remove("activo"));

    boton.classList.add("activo");

    mostrarProductos();

}

// AGREGAR AL CARRITO
function agregarCarrito(id) {

    const producto = productos.find(p => p.id === id);

    const existente = carrito.find(p => p.id === id);

    if (existente) {
        existente.cantidad++;
    } else {
        carrito.push({
            id: producto.id,
            nombre: producto.nombre,
            precio: producto.precio,
            cantidad: 1
        });
    }

    guardarCarrito();

    alert("Producto agregado al carrito.");

}

// GUARDAR CARRITO
function guardarCarrito() {

    localStorage.setItem(
        "carritoDayisyis",
        JSON.stringify(carrito)
    );

    actualizarContador();

    mostrarCarrito();

}

// ACTUALIZAR CONTADOR
function actualizarContador() {

    let cantidad = carrito.reduce(
        (total, producto) => total + producto.cantidad, 0
    );

    document.getElementById("contador").textContent = cantidad;

}

// ABRIR CARRITO
function abrirCarrito() {

    document.getElementById("modalCarrito").style.display = "flex";

    mostrarCarrito();

}

// CERRAR CARRITO
function cerrarCarrito() {

    document.getElementById("modalCarrito").style.display = "none";

}

// MOSTRAR CONTENIDO DEL CARRITO
function mostrarCarrito() {

    const lista = document.getElementById("listaCarrito");

    lista.innerHTML = "";

    if (carrito.length === 0) {

        lista.innerHTML =
            '<div class="carrito-vacio">Tu carrito está vacío 🛒</div>';

    }

    carrito.forEach(producto => {

        lista.innerHTML += `

            <div class="item-carrito">

                <div>
                    <p><strong>${producto.nombre}</strong></p>

                    <p>$${producto.precio.toFixed(2)} cada uno</p>

                    <div class="cantidad">

                        <button onclick="cambiarCantidad(${producto.id}, -1)">
                            -
                        </button>

                        <span>${producto.cantidad}</span>

                        <button onclick="cambiarCantidad(${producto.id}, 1)">
                            +
                        </button>

                    </div>
                </div>

                <div>
                    <p>
                        $${(producto.precio * producto.cantidad).toFixed(2)}
                    </p>

                    <button class="eliminar"
                        onclick="eliminarProducto(${producto.id})">
                        Eliminar
                    </button>
                </div>

            </div>

        `;

    });

    calcularTotal();

}

// CAMBIAR CANTIDAD
function cambiarCantidad(id, cambio) {

    const producto = carrito.find(p => p.id === id);

    producto.cantidad += cambio;

    if (producto.cantidad <= 0) {
        carrito = carrito.filter(p => p.id !== id);
    }

    guardarCarrito();

}

// ELIMINAR PRODUCTO
function eliminarProducto(id) {

    carrito = carrito.filter(p => p.id !== id);

    guardarCarrito();

}

// CALCULAR TOTAL
function calcularTotal() {

    const total = carrito.reduce(
        (suma, producto) =>
            suma + producto.precio * producto.cantidad, 0
    );

    document.getElementById("total").textContent =
        "Total: $" + total.toFixed(2);

}

// VACIAR CARRITO
function vaciarCarrito() {

    carrito = [];

    guardarCarrito();

}

// FINALIZAR COMPRA
function finalizarCompra() {

    if (carrito.length === 0) {
        alert("Tu carrito está vacío.");
        return;
    }

    alert("Esta es una demostración del catálogo. Para completar una compra real, primero debemos configurar el proceso de pedidos.");

}

// INICIAR PAGINA
mostrarProductos();

actualizarContador();

</script>

</body>
</html>

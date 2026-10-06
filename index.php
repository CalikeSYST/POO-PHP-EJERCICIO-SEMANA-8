<?php
require_once 'clases/Producto.php';
require_once 'clases/Carrito.php';

session_start();

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = new Carrito();
}

$carrito = $_SESSION['carrito'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Se agregó la validación del botón agregar
    if (isset($_POST['agregar'])) {
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $cantidad = $_POST['cantidad'];

        if ($nombre != '' && $precio > 0 && $cantidad > 0) {
            $producto = new Producto($nombre, $precio, $cantidad);
            $carrito->agregarProducto($producto);
            $_SESSION['carrito'] = $carrito;
        }
    }

    // Se agregó la validación del botón limpiar
    if (isset($_POST['limpiar'])) {
        $carrito->Limpiar();
        $_SESSION['carrito'] = $carrito;
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POO</title>
    <link rel="stylesheet" href="assets/css/estilos.css?v=2">
</head>

<body>
    <div class="container">
        <h1>Sistema de ventas con POO</h1>
        <p class="subtitulo"> Aprendiendo Programacion Orientada a Objetos</p>

        <section class="panel panel-productos">
            <h2>Agregar Productos</h2>
            <form method="POST" autocomplete="off">
                <div class="campo">
                    <label for="">Producto</label>
                    <input type="text" name="nombre" required>
                </div>
                <div class="campo">
                    <label for="">Precio</label>
                    <input type="number" name="precio" required>
                </div>
                <div class="campo">
                    <label for="">Cantidad</label>
                    <input type="number" name="cantidad" required>
                </div>
                <!-- CORRECCIÓN: Se agregó name="agregar" -->
                <button type="submit" name="agregar" class="btn-agregar">Agregar</button>
            </form>
        </section>

        <section class="panel">
            <h2>Detalle de venta</h2>

            <table>
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($carrito->getProductos() as $producto): ?>
                        <tr>
                            <td><?= $producto->getNombre() ?></td>
                            <td><?= $producto->getPrecio() ?></td>
                            <td><?= $producto->getCantidad() ?></td>
                            <td><?= $producto->calcularSubtotal() ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>

            <div class="resumen">
                <p>Total Productos: <strong><?= count($carrito->getProductos()) ?></strong></p>
                <h2>Total: $<?= $carrito->calcularTotal() ?></h2>
            </div>

            <form method="POST">
                <button type="submit" name="limpiar" class="btn-limpiar">Limpiar Venta</button>
            </form>
        </section>
    </div>
</body>

</html>
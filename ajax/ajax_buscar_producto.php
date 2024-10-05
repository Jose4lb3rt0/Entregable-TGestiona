<?php
require_once '../controllers/ProductoController.php';

if (isset($_GET['id'])) {
    $productoId = $_GET['id'];

    $controller = new ProductoController();
    $producto = $controller->buscarProducto($productoId);

    if ($producto) {
        echo json_encode($producto);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Producto no encontrado.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'ID de producto no especificado.']);
}

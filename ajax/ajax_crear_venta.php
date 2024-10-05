<?php
require_once '../controllers/VentaController.php';

if (isset($_POST['cliente_id'], $_POST['producto_id'], $_POST['cantidad'], $_POST['precio_total'])) {
    $ventaController = new VentaController();

    $cliente_id = $_POST['cliente_id'];
    $productos = $_POST['producto_id'];
    $cantidades = $_POST['cantidad'];
    $totales = $_POST['precio_total'];

    $respuesta = $ventaController->crearVenta($cliente_id, $productos, $cantidades, $totales);

    echo json_encode($respuesta);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Faltan campos requeridos.'
    ]);
}

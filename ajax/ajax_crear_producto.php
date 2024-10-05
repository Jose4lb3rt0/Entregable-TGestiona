<?php

require_once '../controllers/ProductoController.php';

if(isset($_POST['nombre'], $_POST['marca'], $_POST['precio'], $_POST['stock'], $_POST['categoria_id'])) {
    $productoController = new ProductoController();
    $productoController->crearProducto();

    $response = [
        'status' => 'success',
        'message' => 'Producto creado correctamente.'
    ];

    echo json_encode($response);
} else {
    $response = [
        'status' => 'error',
        'message' => 'Error al crear el producto.'
    ];

    echo json_encode($response);
}



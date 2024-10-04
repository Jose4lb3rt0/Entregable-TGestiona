<?php

require_once '../controllers/ClienteController.php';

if (isset($_POST['nombre'], $_POST['apellido'], $_POST['dni'], $_POST['email'], $_POST['telefono'])) {
    $controller = new ClienteController();
    $controller->crearCliente();

    $response = [
        'status' => 'success',
        'message' => 'Cliente creado correctamente.'
    ];

    echo json_encode($response);
} else {
    $response = [
        'status' => 'error',
        'message' => 'Error al crear el cliente.'
    ];

    echo json_encode($response);
}



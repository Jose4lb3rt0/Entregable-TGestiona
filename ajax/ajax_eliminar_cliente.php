<?php

require_once '../controllers/ClienteController.php';

if(isset($_POST['id'])){
    $clienteController = new ClienteController();
    $clienteController->eliminarCliente($_POST['id']);

    $response = [
        'status' => 'success',
        'message' => 'Cliente eliminado correctamente.'
    ];

    echo json_encode($response);
} else {
    $response = [
        'status' => 'error',
        'message' => 'Error al eliminar el cliente.'
    ];

    echo json_encode($response);
}
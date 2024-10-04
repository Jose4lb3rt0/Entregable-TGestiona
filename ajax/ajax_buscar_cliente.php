<?php
require_once '../controllers/ClienteController.php';

if (isset($_GET['id'])) {
    $clienteController = new ClienteController();
    $cliente = $clienteController->buscarCliente($_GET['id']);

    if ($cliente) {
        echo json_encode($cliente);
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Cliente no encontrado.'
        ];
        echo json_encode($response);
    }
} else {
    $response = [
        'status' => 'error',
        'message' => 'ID de cliente no proporcionado.'
    ];
    echo json_encode($response);
}

<?php 

require_once '../controllers/ClienteController.php';

$clienteController = new ClienteController();
$clienteController->actualizarCliente();

$response = [
    'status' => 'success',
    'message' => 'Cliente actualizado correctamente.'
];

echo json_encode($response);
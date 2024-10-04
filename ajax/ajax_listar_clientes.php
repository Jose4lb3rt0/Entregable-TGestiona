<?php
require_once '../config/config.php';
require_once '../controllers/ClienteController.php';

$clienteController = new ClienteController();
$clientes = $clienteController->listarClientes();

echo json_encode($clientes);

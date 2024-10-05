<?php

require_once '../controllers/VentaController.php';

$ventaController = new VentaController();
$ventas = $ventaController->listarVentas();

echo json_encode($ventas);
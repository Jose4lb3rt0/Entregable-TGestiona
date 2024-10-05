<?php

require_once '../config/config.php';
require_once '../controllers/ProductoController.php';

$controller = new ProductoController();
$controller->listarProductosPorCategoria();
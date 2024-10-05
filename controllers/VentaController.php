<?php

require_once '../config/config.php';
require_once '../models/Venta.php';
require_once '../models/DetalleVenta.php';

class VentaController {
    private $ventaModel;

    public function __construct() {
        $this->ventaModel = new Venta();
    }

    public function crearVenta($cliente_id, $productos, $cantidades, $totales){
        global $pdo;
        try {
            $pdo->beginTransaction();

            $venta = new Venta($cliente_id, date('Y-m-d H:i:s'), array_sum($totales));
            $venta_id = $venta->crearVenta();

            foreach ($productos as $index => $producto_id) {
                $detalleVenta = new DetalleVenta();
                $detalleVenta->venta_id = $venta_id;
                $detalleVenta->producto_id = $producto_id;
                $detalleVenta->cantidad = $cantidades[$index];
                $detalleVenta->precio_unitario = $totales[$index] / $cantidades[$index];
                $detalleVenta->total = $totales[$index];

                $detalleVenta->crearDetalleVenta();
            }

            $pdo->commit();
            return ['status' => 'success', 'message' => 'Venta creada correctamente.'];

        } catch (Exception $e) {
            $pdo->rollBack();
            return ['status' => 'error', 'message' => 'Error al crear la venta: ' . $e->getMessage()];
        }
    }

    public function listarVentas() {
        return $this->ventaModel->listarVentas();
    }
}
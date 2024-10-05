<?php

require_once '../config/config.php';

class Venta{
    public $cliente_id;
    public $fecha_venta;
    public $total;

    public function __construct($cliente_id = null, $fecha_venta = '', $total = ''){
        $this->cliente_id = $cliente_id;
        $this->fecha_venta = $fecha_venta;
        $this->total = $total;
    }

    public function crearVenta(){
        global $pdo;
        $sql = "INSERT INTO ventas (cliente_id, fecha_venta, total) VALUES (:cliente_id, :fecha_venta, :total)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':cliente_id' => $this->cliente_id,
            ':fecha_venta' => $this->fecha_venta,
            ':total' => $this->total
        ]);

        return $pdo->lastInsertId();
    }

    public function listarVentas(){
        global $pdo;
        $sql = "SELECT v.id, v.fecha_venta, v.total, c.nombre as cliente_nombre, c.apellido as cliente_apellido, c.email as cliente_email
                FROM ventas v
                INNER JOIN clientes c ON v.cliente_id = c.id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarVentaPorId($venta_id) {
        global $pdo;
        $sql = "SELECT v.*, c.nombre as cliente_nombre, c.apellido as cliente_apellido, c.email as cliente_email
                FROM ventas v
                INNER JOIN clientes c ON v.cliente_id = c.id
                WHERE v.id = :venta_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':venta_id' => $venta_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
}
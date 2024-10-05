<?php

class DetalleVenta{
    public $venta_id;
    public $producto_id;
    public $cantidad;
    public $precio_unitario;
    public $total;

    public function crearDetalleVenta(){
        global $pdo;
        $sql = "INSERT INTO detalle_ventas (venta_id, producto_id, cantidad, precio_unitario, total)
                VALUES (:venta_id, :producto_id, :cantidad, :precio_unitario, :total)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':venta_id' => $this->venta_id,
            ':producto_id' => $this->producto_id,
            ':cantidad' => $this->cantidad,
            ':precio_unitario' => $this->precio_unitario,
            ':total' => $this->total
        ]);
    }

    public function listarDetallesPorVentaId($venta_id) {
        global $pdo;
        $sql = "SELECT dv.*, p.nombre as producto_nombre, p.precio as producto_precio
                FROM detalle_ventas dv
                INNER JOIN productos p ON dv.producto_id = p.id
                WHERE dv.venta_id = :venta_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':venta_id' => $venta_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
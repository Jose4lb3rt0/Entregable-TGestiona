<?php 

require_once '../config/config.php';

class Producto {
    protected $id;
    protected $nombre;
    protected $marca;
    protected $precio;
    protected $stock;
    protected $categoria_id;
    protected $fecha_creacion;

    public function __construct($id, $nombre, $marca, $precio, $stock, $categoria_id, $fecha_creacion) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->marca = $marca;
        $this->precio = $precio;
        $this->stock = $stock;
        $this->categoria_id = $categoria_id;
        $this->fecha_creacion = $fecha_creacion;
    }

    public function crearProducto($producto) {
        $sql = "INSERT INTO productos (nombre, marca, precio, stock, categoria_id, fecha_creacion) 
                VALUES (:nombre, :marca, :precio, :stock, :categoria_id, :fecha_creacion)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':nombre' => $producto->getNombre(),
            ':marca' => $producto->getMarca(),
            ':precio' => $producto->getPrecio(),
            ':stock' => $producto->getStock(),
            ':categoria_id' => $producto->getCategoriaId(),
            ':fecha_creacion' => $producto->getFechaCreacion(),
        ]);
    }

    public function listarProductos() {
        $sql = "SELECT * FROM productos";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarProducto($id) {
        $sql = "SELECT * FROM productos WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarProducto($id, $nombre, $precio, $stock) {
        $sql = "UPDATE productos SET nombre = :nombre, precio = :precio, stock = :stock WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':id' => $id,
            ':nombre' => $nombre,
            ':precio' => $precio,
            ':stock' => $stock
        ]);
    }

    public function eliminarProducto($id) {
        $sql = "DELETE FROM productos WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getMarca() {
        return $this->marca;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function getStock() {
        return $this->stock;
    }

    public function getCategoriaId() {
        return $this->categoria_id;
    }

    public function getFechaCreacion() {
        return $this->fecha_creacion;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setMarca($marca) {
        $this->marca = $marca;
    }

    public function setPrecio($precio) {
        $this->precio = $precio;
    }

    public function setStock($stock) {
        $this->stock = $stock;
    }

    public function setCategoriaId($categoria_id) {
        $this->categoria_id = $categoria_id;
    }

    public function setFechaCreacion($fecha_creacion) {
        $this->fecha_creacion = $fecha_creacion;
    }

    public function __toString() {
        return "Producto[id=$this->id, nombre=$this->nombre, marca=$this->marca, precio=$this->precio, stock=$this->stock, categoria_id=$this->categoria_id, fecha_creacion=$this->fecha_creacion]";
    }
}

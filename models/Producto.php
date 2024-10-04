<?php 

class Producto {
    private $id;
    private $nombre;
    private $marca;
    private $precio;
    private $stock;
    private $categoria_id;
    private $fecha_creacion;

    public function __construct($id, $nombre, $descripcion, $precio, $stock, $categoria_id, $fecha_creacion) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
        $this->stock = $stock;
        $this->categoria_id = $categoria_id;
        $this->fecha_creacion = $fecha_creacion;
    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getDescripcion() {
        return $this->descripcion;
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

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
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
        return "Producto[id=$this->id, nombre=$this->nombre, descripcion=$this->descripcion, precio=$this->precio, stock=$this->stock, categoria_id=$this->categoria_id, fecha_creacion=$this->fecha_creacion]";
    }
}
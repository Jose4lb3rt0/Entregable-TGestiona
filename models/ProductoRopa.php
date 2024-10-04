<?php

class ProductoRopa extends Producto {
    private $talla;
    private $color;
    private $genero;

    public function __construct($id, $nombre, $marca, $precio, $stock, $categoria_id, $fecha_creacion, $talla, $color, $genero) {
        parent::__construct($id, $nombre, $marca, $precio, $stock, $categoria_id, $fecha_creacion);
        $this->talla = $talla;
        $this->color = $color;
        $this->genero = $genero;
    }

    public function getTalla() {
        return $this->talla;
    }

    public function getColor() {
        return $this->color;
    }

    public function getGenero() {
        return $this->genero;
    }

    public function setTalla($talla) {
        $this->talla = $talla;
    }

    public function setColor($color) {
        $this->color = $color;
    }

    public function setGenero($genero) {
        $this->genero = $genero;
    }

    public function __toString() {
        return "ProductoRopa[id=$this->id, nombre=$this->nombre, marca=$this->marca, precio=$this->precio, stock=$this->stock, categoria_id=$this->categoria_id, fecha_creacion=$this->fecha_creacion, talla=$this->talla, color=$this->color, genero=$this->genero]";
    }
}
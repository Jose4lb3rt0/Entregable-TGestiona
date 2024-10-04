<?php

class ProductoElectrodomestico extends Producto {
    private $consumo_energetico;

    public function __construct($id, $nombre, $marca, $precio, $stock, $categoria_id, $fecha_creacion, $consumo_energetico) {
        parent::__construct($id, $nombre, $marca, $precio, $stock, $categoria_id, $fecha_creacion);
        $this->consumo_energetico = $consumo_energetico;
    }

    public function getConsumoEnergetico() {
        return $this->consumo_energetico;
    }

    public function setConsumoEnergetico($consumo_energetico) {
        $this->consumo_energetico = $consumo_energetico;
    }

    public function __toString() {
        return "ProductoElectrodomestico[id=$this->id, nombre=$this->nombre, marca=$this->marca, precio=$this->precio, stock=$this->stock, categoria_id=$this->categoria_id, fecha_creacion=$this->fecha_creacion, consumo_energetico=$this->consumo_energetico]";
    }
}
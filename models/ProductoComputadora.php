<?php

class ProductoComputadora extends Producto {
    private $procesador;
    private $ram;
    private $disco_duro;
    private $tarjeta_grafica;

    public function __construct($id, $nombre, $marca, $precio, $stock, $categoria_id, $fecha_creacion, $procesador, $ram, $disco_duro, $tarjeta_grafica) {
        parent::__construct($id, $nombre, $marca, $precio, $stock, $categoria_id, $fecha_creacion);
        $this->procesador = $procesador;
        $this->ram = $ram;
        $this->disco_duro = $disco_duro;
        $this->tarjeta_grafica = $tarjeta_grafica;
    }

    public function getProcesador() {
        return $this->procesador;
    }

    public function getRam() {
        return $this->ram;
    }

    public function getDiscoDuro() {
        return $this->disco_duro;
    }

    public function getTarjetaGrafica() {
        return $this->tarjeta_grafica;
    }

    public function setProcesador($procesador) {
        $this->procesador = $procesador;
    }

    public function setRam($ram) {
        $this->ram = $ram;
    }

    public function setDiscoDuro($disco_duro) {
        $this->disco_duro = $disco_duro;
    }

    public function setTarjetaGrafica($tarjeta_grafica) {
        $this->tarjeta_grafica = $tarjeta_grafica;
    }

    public function __toString() {
        return "ProductoComputadora[id=$this->id, nombre=$this->nombre, marca=$this->marca, precio=$this->precio, stock=$this->stock, categoria_id=$this->categoria_id, fecha_creacion=$this->fecha_creacion, procesador=$this->procesador, ram=$this->ram, disco_duro=$this->disco_duro, tarjeta_grafica=$this->tarjeta_grafica]";
    }
}
<?php

class Categoria {
    private $id;
    private $nombre;
    private $descripcion;
    private $fecha_creacion;

    public function __construct($id, $nombre, $descripcion, $fecha_creacion) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
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

    public function setFechaCreacion($fecha_creacion) {
        $this->fecha_creacion = $fecha_creacion;
    }

    public function __toString() {
        return "Categoria[id=$this->id, nombre=$this->nombre, descripcion=$this->descripcion, fecha_creacion=$this->fecha_creacion]";
    }
}
<?php

class Cliente {
    private $id;
    private $nombre;
    private $dni;
    private $email;
    private $telefono;

    public function __construct($id, $nombre, $dni, $email, $telefono) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->dni = $dni;
        $this->email = $email;
        $this->telefono = $telefono;
    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getDni() {
        return $this->dni;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setDni($dni) {
        $this->dni = $dni;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    public function __toString() {
        return "Cliente[id=$this->id, nombre=$this->nombre, dni=$this->dni, email=$this->email, telefono=$this->telefono]";
    }
}
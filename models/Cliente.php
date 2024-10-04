<?php

require_once '../config/config.php';

class Cliente {
    private $id;
    private $nombre;
    private $apellido;
    private $dni;
    private $email;
    private $telefono;

    public function __construct($id = null, $nombre = '', $apellido = '', $dni = '', $email = '', $telefono = '') {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->dni = $dni;
        $this->email = $email;
        $this->telefono = $telefono;
    }

    public function crearCliente($cliente) {
        global $pdo; 
        $sql = "INSERT INTO clientes (nombre, apellido, dni, email, telefono) VALUES (:nombre, :apellido, :dni, :email, :telefono)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nombre' => $cliente->getNombre(),
            ':dni' => $cliente->getDni(),
            ':apellido' => $cliente->getApellido(),
            ':email' => $cliente->getEmail(),
            ':telefono' => $cliente->getTelefono()
        ]);
    }

    public function listarClientes() {
        global $pdo; 
        $sql = "SELECT * FROM clientes";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function eliminarCliente($id) {
        global $pdo; 
        $sql = "DELETE FROM clientes WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
    }

    public function buscarCliente($id){
        global $pdo;
        $sql = "SELECT * FROM clientes WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarCliente($cliente){
        global $pdo;
        $sql = "UPDATE clientes SET nombre = :nombre, apellido = :apellido, dni = :dni, email = :email, telefono = :telefono WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':id' => $cliente->getId(),
            ':nombre' => $cliente->getNombre(),
            ':apellido' => $cliente->getApellido(),
            ':dni' => $cliente->getDni(),
            ':email' => $cliente->getEmail(),
            ':telefono' => $cliente->getTelefono()
        ]);
    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getApellido() {
        return $this->apellido;
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

    public function setApellido($apellido) {
        $this->apellido = $apellido;
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
        return "Cliente[id=$this->id, nombre=$this->nombre, apellido=$this->apellido, dni=$this->dni, email=$this->email, telefono=$this->telefono]";
    }
}
<?php

require_once '../models/Cliente.php';

class ClienteController {
    private $model;

    public function __construct() {
        $this->model = new Cliente();
    }

    public function crearCliente() {
        if (isset($_POST['nombre'], $_POST['apellido'], $_POST['dni'], $_POST['email'], $_POST['telefono'])) {
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $dni = $_POST['dni'];
            $email = $_POST['email'];
            $telefono = $_POST['telefono'];

            $cliente = new Cliente(null, $nombre, $apellido, $dni, $email, $telefono);

            $this->model->crearCliente($cliente);
        } else {
            die('Faltan campos requeridos para el cliente.');
        }
    }

    public function listarClientes() {
        return $this->model->listarClientes();
    }

    public function eliminarCliente($id) {
        $this->model->eliminarCliente($id);
    }

    public function buscarCliente() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $cliente = $this->model->buscarCliente($id);
            return $cliente;
        } else {
            die('ID de cliente no especificado.');
        }
    }

    public function actualizarCliente() {
        if (isset($_POST['id'], $_POST['nombre'], $_POST['dni'], $_POST['email'], $_POST['telefono'])) {
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $dni = $_POST['dni'];
            $email = $_POST['email'];
            $telefono = $_POST['telefono'];

            $this->model->actualizarCliente($id, $nombre, $dni, $email, $telefono);
        } else {
            die('Faltan campos requeridos para el cliente.');
        }
    }
    
}
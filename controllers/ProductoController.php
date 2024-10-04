<?php

require_once '../models/Producto.php';

class ProductoController {
    private $model;

    public function __construct() {
        $this->model = new Producto();
    }

    public function crearProducto() {
        if (isset($_POST['nombre'], $_POST['marca'], $_POST['precio'], $_POST['stock'], $_POST['categoria_id'])) {
            $nombre = $_POST['nombre'];
            $marca = $_POST['marca'];
            $precio = $_POST['precio'];
            $stock = $_POST['stock'];
            $categoria_id = $_POST['categoria_id'];
            $fecha_creacion = date('Y-m-d H:i:s');

            if ($categoria_id == 1) {
                if (isset($_POST['procesador'], $_POST['ram'], $_POST['disco_duro'], $_POST['tarjeta_grafica'])) {
                    $procesador = $_POST['procesador'];
                    $ram = $_POST['ram'];
                    $disco_duro = $_POST['disco_duro'];
                    $tarjeta_grafica = $_POST['tarjeta_grafica'];
                    $producto = new ProductoComputadora(null, $nombre, $marca, $precio, $stock, $categoria_id, $fecha_creacion, $procesador, $ram, $disco_duro, $tarjeta_grafica);
                } else {
                    die('Faltan campos para la categoría computadora.');
                }
            } else if ($categoria_id == 2) {
                if (isset($_POST['talla'], $_POST['color'], $_POST['genero'])) {
                    $talla = $_POST['talla'];
                    $color = $_POST['color'];
                    $genero = $_POST['genero'];
                    $producto = new ProductoRopa(null, $nombre, $marca, $precio, $stock, $categoria_id, $fecha_creacion, $talla, $color, $genero);
                } else {
                    die('Faltan campos para la categoría ropa.');
                }
            } else if ($categoria_id == 3) {
                if (isset($_POST['consumo_energetico'])) {
                    $consumo_energetico = $_POST['consumo_energetico'];
                    $producto = new ProductoElectrodomestico(null, $nombre, $marca, $precio, $stock, $categoria_id, $fecha_creacion, $consumo_energetico);
                } else {
                    die('Faltan campos para la categoría electrodoméstico.');
                }
            } else {
                die('Categoría inválida.');
            }

            $this->model->crearProducto($producto);
        } else {
            die('Faltan campos requeridos para el producto.');
        }
    }

    public function listarProductos() {
        $productos = $this->model->listarProductos();
        return $productos;
    }

    public function buscarProducto($id) {
        $producto = $this->model->buscarProducto($id);
        return $producto;
    }

    public function eliminarProducto($id) {
        $this->model->eliminarProducto($id);
    }

    public function actualizarProducto($id) {
        if (isset($_POST['nombre'], $_POST['precio'], $_POST['stock'])) {
            $nombre = $_POST['nombre'];
            $precio = $_POST['precio'];
            $stock = $_POST['stock'];

            $this->model->actualizarProducto($id, $nombre, $precio, $stock);
            header('Location: /views/producto/index.php');
        }
    }
}

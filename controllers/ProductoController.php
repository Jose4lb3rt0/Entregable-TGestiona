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
            $categoria = $_POST['categoria_id'];

            $datosComunes = [
                'nombre' => $nombre,
                'marca' => $marca,
                'precio' => $precio,
                'stock' => $stock,
                'categoria' => $categoria
            ];

            $datosCategoria = [];
            
            if ($categoria == '1') { 
                if (isset($_POST['procesador'], $_POST['ram'], $_POST['disco_duro'], $_POST['tarjeta_grafica'])) {
                    $datosCategoria = [
                        'procesador' => $_POST['procesador'],
                        'ram' => $_POST['ram'],
                        'disco_duro' => $_POST['disco_duro'],
                        'tarjeta_grafica' => $_POST['tarjeta_grafica']
                    ];
                }
            } elseif ($categoria == '2') { 
                if (isset($_POST['talla'], $_POST['color'], $_POST['genero'])) {
                    $datosCategoria = [
                        'talla' => $_POST['talla'],
                        'color' => $_POST['color'],
                        'genero' => $_POST['genero']
                    ];
                }
            } elseif ($categoria == '3') { 
                if (isset($_POST['consumo_energetico'])) {
                    $datosCategoria = [
                        'consumo_energetico' => $_POST['consumo_energetico']
                    ];
                }
            }

            $this->model->crearProducto($datosComunes, $datosCategoria);

            $response = [
                'status' => 'success',
                'message' => 'Producto creado correctamente.'
            ];
            echo json_encode($response);
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Faltan campos requeridos.'
            ];
            echo json_encode($response);
        }
    }

    public function listarProductosPorCategoria(){
        if (isset($_GET['categoria_id'])){
            $categoria_id = $_GET['categoria_id'];
            $productos = $this->model->listarProductosPorCategoria($categoria_id);

            echo json_encode($productos);
        }else{
            $response = [
                'status' => 'error',
                'message' => 'Error al listar productos por categoria.'
            ];
            echo json_encode($response);
        }
    }

    public function eliminarProducto() {
        if (isset($_POST['producto_id'])) {
            $producto_id = $_POST['producto_id'];

            $result = $this->model->eliminarProducto($producto_id);

            if ($result > 0) {
                $response = [
                    'status' => 'success', 
                    'message' => 'Producto eliminado correctamente.'
                ];
            } else {
                $response = ['status' => 'error', 
                'message' => 'Error al eliminar el producto.'
            ];
            }

            echo json_encode($response);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No se especificó el ID del producto.']);
        }
    }

    public function buscarProducto($id) {
        $producto = $this->model->buscarProducto($id);
        return $producto;
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

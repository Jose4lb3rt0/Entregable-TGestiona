<?php 

require_once '../config/config.php';

class Producto {
    protected $id;
    protected $nombre;
    protected $marca;
    protected $precio;
    protected $stock;
    protected $categoria;
    protected $fecha_creacion;

    public function __construct($id = null, $nombre = '', $marca = '', $precio = '', $stock = '', $categoria = '', $fecha_creacion = '') {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->marca = $marca;
        $this->precio = $precio;
        $this->stock = $stock;
        $this->categoria = $categoria;
        $this->fecha_creacion = $fecha_creacion;
    }

    public function crearProducto($datos, $categoriaEspecifica){
        global $pdo;
        $sql = "INSERT INTO productos (nombre, marca, precio, stock, categoria, fecha_creacion)  
                VALUES (:nombre, :marca, :precio, :stock, :categoria, :fecha_creacion)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nombre' => $datos['nombre'],
            ':marca' => $datos['marca'],
            ':precio' => $datos['precio'],
            ':stock' => $datos['stock'],
            ':categoria' => $datos['categoria'],
            ':fecha_creacion' => date('Y-m-d H:i:s')
        ]);

        $productoId = $pdo->lastInsertId();

        switch($datos['categoria']){
            case 1:
                $sqlComputadora = "INSERT INTO producto_computadora (productos_id, procesador, ram, disco_duro, tarjeta_grafica)
                                   VALUES (:productos_id, :procesador, :ram, :disco_duro, :tarjeta_grafica)";
                $stmt = $pdo->prepare($sqlComputadora);
                $stmt->execute([
                    ':productos_id' => $productoId,
                    ':procesador' => $categoriaEspecifica['procesador'],
                    ':ram' => $categoriaEspecifica['ram'],
                    ':disco_duro' => $categoriaEspecifica['disco_duro'],
                    ':tarjeta_grafica' => $categoriaEspecifica['tarjeta_grafica']
                ]);
                break;
            case 2:
                $sqlRopa = "INSERT INTO producto_ropa (productos_id, talla, color, genero)
                            VALUES (:productos_id, :talla, :color, :genero)";
                $stmt = $pdo->prepare($sqlRopa);
                $stmt->execute([
                    ':productos_id' => $productoId,
                    ':talla' => $categoriaEspecifica['talla'],
                    ':color' => $categoriaEspecifica['color'],
                    ':genero' => $categoriaEspecifica['genero']
                ]);
                break;
            case '3': 
                $sqlElectrodomestico = "INSERT INTO producto_electrodomestico (productos_id, consumo_energetico)
                                        VALUES (:productos_id, :consumo_energetico)";
                $stmt = $pdo->prepare($sqlElectrodomestico);
                $stmt->execute([
                    ':productos_id' => $productoId,
                    ':consumo_energetico' => $categoriaEspecifica['consumo_energetico']
                ]);
                break;
        }
    }

    public function listarProductosPorCategoria($categoria_id) {
        global $pdo;

        if ($categoria_id == '1') {
            $sql = "SELECT p.id, p.nombre, p.marca, p.precio, p.stock, p.categoria, p.fecha_creacion, 
                           c.procesador, c.ram, c.disco_duro, c.tarjeta_grafica
                    FROM productos p
                    JOIN producto_computadora c ON p.id = c.productos_id
                    WHERE p.categoria = :categoria_id";
        } elseif ($categoria_id == '2') {
            $sql = "SELECT p.id, p.nombre, p.marca, p.precio, p.stock, p.categoria, p.fecha_creacion, 
                           r.talla, r.color, r.genero
                    FROM productos p
                    JOIN producto_ropa r ON p.id = r.productos_id
                    WHERE p.categoria = :categoria_id";
        } elseif ($categoria_id == '3') {
            $sql = "SELECT p.id, p.nombre, p.marca, p.precio, p.stock, p.categoria, p.fecha_creacion, 
                           e.consumo_energetico
                    FROM productos p
                    JOIN producto_electrodomestico e ON p.id = e.productos_id
                    WHERE p.categoria = :categoria_id";
        }

        $stmt = $pdo->prepare($sql);
        $stmt->execute(['categoria_id' => $categoria_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerProductos() {
        global $pdo;

        $sql = "SELECT * FROM productos";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function eliminarProducto($producto_id) {
        global $pdo;

        $sqlComputadora = "DELETE FROM producto_computadora WHERE productos_id = :producto_id";
        $stmt = $pdo->prepare($sqlComputadora);
        $stmt->execute(['producto_id' => $producto_id]);

        $sqlRopa = "DELETE FROM producto_ropa WHERE productos_id = :producto_id";
        $stmt = $pdo->prepare($sqlRopa);
        $stmt->execute(['producto_id' => $producto_id]);

        $sqlElectrodomestico = "DELETE FROM producto_electrodomestico WHERE productos_id = :producto_id";
        $stmt = $pdo->prepare($sqlElectrodomestico);
        $stmt->execute(['producto_id' => $producto_id]);

        $sql = "DELETE FROM productos WHERE id = :producto_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['producto_id' => $producto_id]);

        return $stmt->rowCount();
    }

    public function buscarProducto($id) {
        global $pdo;
    
        $sql = "SELECT * FROM productos WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $producto = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($producto) {
            if ($producto['categoria'] == '1') {
                $sql = "SELECT * FROM producto_computadora WHERE productos_id = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([':id' => $id]);
                $detalles = $stmt->fetch(PDO::FETCH_ASSOC);
                $producto = array_merge($producto, $detalles);
            } else if ($producto['categoria'] == '2') {
                $sql = "SELECT * FROM producto_ropa WHERE productos_id = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([':id' => $id]);
                $detalles = $stmt->fetch(PDO::FETCH_ASSOC);
                $producto = array_merge($producto, $detalles);
            } else if ($producto['categoria'] == '3') {
                $sql = "SELECT * FROM producto_electrodomestico WHERE productos_id = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([':id' => $id]);
                $detalles = $stmt->fetch(PDO::FETCH_ASSOC);
                $producto = array_merge($producto, $detalles);
            }
            return $producto;
        } else {
            return false;
        }
    }

    public function actualizarProducto($producto) {
        global $pdo;
        $sql = "UPDATE productos SET nombre = :nombre, marca = :marca, precio = :precio, stock = :stock, categoria = :categoria, fecha_creacion = :fecha_creacion WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nombre' => $producto['nombre'],
            ':marca' => $producto['marca'],
            ':precio' => $producto['precio'],
            ':stock' => $producto['stock'],
            ':categoria' => $producto['categoria'],
            ':fecha_creacion' => $producto['fecha_creacion'],
            ':id' => $producto['id']
        ]);

        if ($producto['categoria'] == '1') {
            $sql = "UPDATE producto_computadora SET procesador = :procesador, ram = :ram, disco_duro = :disco_duro, tarjeta_grafica = :tarjeta_grafica WHERE productos_id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':procesador' => $producto['procesador'],
                ':ram' => $producto['ram'],
                ':disco_duro' => $producto['disco_duro'],
                ':tarjeta_grafica' => $producto['tarjeta_grafica'],
                ':id' => $producto['id']
            ]);
        } else if ($producto['categoria'] == '2') {
            $sql = "UPDATE producto_ropa SET talla = :talla, color = :color, genero = :genero WHERE productos_id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':talla' => $producto['talla'],
                ':color' => $producto['color'],
                ':genero' => $producto['genero'],
                ':id' => $producto['id']
            ]);
        } else if ($producto['categoria'] == '3') {
            $sql = "UPDATE producto_electrodomestico SET consumo_energetico = :consumo_energetico WHERE productos_id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':consumo_energetico' => $producto['consumo_energetico'],
                ':id' => $producto['id']
            ]);
        }

        return $stmt->rowCount(); 
    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getMarca() {
        return $this->marca;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function getStock() {
        return $this->stock;
    }

    public function getCategoria() {
        return $this->categoria;
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

    public function setMarca($marca) {
        $this->marca = $marca;
    }

    public function setPrecio($precio) {
        $this->precio = $precio;
    }

    public function setStock($stock) {
        $this->stock = $stock;
    }

    public function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

    public function setFechaCreacion($fecha_creacion) {
        $this->fecha_creacion = $fecha_creacion;
    }

    public function __toString() {
        return "Producto[id=$this->id, nombre=$this->nombre, marca=$this->marca, precio=$this->precio, stock=$this->stock, categoria=$this->categoria, fecha_creacion=$this->fecha_creacion]";
    }
}

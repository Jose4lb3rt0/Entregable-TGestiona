<?php 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TGestiona</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <style>
        .sidebar {
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            width: 250px;
            background-color: #343a40;
            padding: 15px;
        }

        .sidebar a {
            color: #ffffff;
            text-decoration: none;
            display: block;
            padding: 10px;
            margin-bottom: 5px;
        }

        .sidebar a:hover {
            background-color: #495057;
        }

        .content {
            margin-left: 260px;
            padding: 20px;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            .content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

<nav class="sidebar bg-dark">
    <a href="<?php echo BASE_URL; ?>" >
        <h4 class="text-white">Menú</h4>
    </a>
    <!-- <a href="#" data-bs-toggle="collapse" data-bs-target="#productosMenu" aria-expanded="false" aria-controls="productosMenu">
        Productos
    </a> -->
    <!-- <div class="collapse" id="productosMenu"> -->
        <a href="<?php echo BASE_URL; ?>views/productos.php" class="">Productos</a>
    <!-- </div> -->


    <!-- <a href="#" data-bs-toggle="collapse" data-bs-target="#clientesMenu" aria-expanded="false" aria-controls="clientesMenu">
        Clientes
    </a> -->
    <!-- <div class="collapse" id="clientesMenu"> -->
    <a href="<?php echo BASE_URL; ?>views/clientes.php" class="">Clientes</a>
    <!-- </div> -->


    <!-- <a href="<?php echo BASE_URL; ?>views/ventas.php" data-bs-toggle="collapse" data-bs-target="#ventasMenu" aria-expanded="false" aria-controls="ventasMenu">
        Ventas
    </a> -->
    <!-- <div class="collapse" id="ventasMenu"> -->
        <a href="<?php echo BASE_URL; ?>views/ventas.php" class="">Ventas</a>
    <!-- </div> -->
</nav>

</body>
</html>

<?php 
    include 'config/config.php';
    include 'includes/sidebar.php'; 
    include $_SERVER['DOCUMENT_ROOT'] . BASE_URL . '/includes/sidebar.php';
?>



<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Productos</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

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

    <?php include './includes/sidebar.php'; ?>

    <div class="content">
        <div class="container">
            <h1>Bienvenido al sistema de TGestiona</h1>
            <p>Bienvenido a la plataforma de gestión de la tienda. Utiliza el menú para navegar entre las opciones.</p>

            <!-- <div class="card mt-3">
                <div class="card-header">Listado de Productos</div>
                <div class="card-body">
                </div>
            </div> -->
        </div>
    </div>

</body>

</html>
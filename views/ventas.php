<?php 
    include '../config/config.php';
    include '../includes/sidebar.php'; 
    include $_SERVER['DOCUMENT_ROOT'] . BASE_URL . '/includes/sidebar.php';
    include '../controllers/ClienteController.php';
    include '../controllers/ProductoController.php';

    $clienteController = new ClienteController();
    $clientes = $clienteController->listarClientes();

    $productoController = new ProductoController();
    $productos = $productoController->listarProductos();
?>
<body>
<div class="content">
    <div class="container">
        <div class="card mb-4">
            <div class="card-header">
                <h4 id="form-title">Crear Venta</h4>
            </div>
            <div class="card-body">
                <div id="mensaje"></div>
                <form id="ventaForm">
                    <input type="hidden" id="ventaId" name="venta_id">
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="cliente_id" class="form-label">Cliente</label>
                            <select id="cliente_id" name="cliente_id" class="form-control" required>
                                <option value="">Selecciona un cliente</option>
                                <?php
                                    foreach ($clientes as $cliente) {
                                        echo "<option value='{$cliente['id']}'>{$cliente['nombre']} {$cliente['apellido']}</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="productos">
                        <div class="row producto-row">
                            <div class="col-md-6 mb-3">
                                <label for="producto_id" class="form-label">Producto</label>
                                <select id="producto_id" name="producto_id[]" class="form-control producto-select" required>
                                    <option value="">Selecciona un producto</option>
                                    <?php
                                        foreach ($productos as $producto) {
                                            echo "<option value='{$producto['id']}' data-precio='{$producto['precio']}'>{$producto['nombre']}</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="cantidad" class="form-label">Cantidad</label>
                                <input type="number" class="form-control cantidad-input" name="cantidad[]" min="1" value="1" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Precio total</label>
                                <input type="text" class="form-control precio-total" name="precio_total[]" readonly>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-primary mb-3" id="addProductButton">Agregar otro producto</button>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="total" class="form-label">Total de la Venta</label>
                            <input type="text" class="form-control" id="totalVenta" name="total" readonly>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success" id="submitButton">Registrar Venta</button>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4>Lista de Ventas</h4>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Fecha de Venta</th>
                            <th>Cliente</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody id="tablaVentas">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        cargarVentas()
    })

    function cargarVentas(){
        $.ajax({
            url: '../ajax/ajax_listar_ventas.php',
            type: 'GET',
            success: function(response){
                const ventas = JSON.parse(response)
                const tbody = $('#tablaVentas')
                tbody.empty()

                ventas.forEach(function(venta){
                    tbody.append(`
                        <tr>
                            <td>${venta.id}</td>
                            <td>${venta.fecha_venta}</td>
                            <td>${venta.cliente_nombre} ${venta.cliente_apellido}</td>
                            <td>S/ ${venta.total}</td>
                        </tr>
                    `)
                })
            },
            error:function(){
                alert('Error al cargar las ventas.')
            }
        })
    }

    $(document).ready(function() {
        function calcularPrecioTotal() {
            let totalVenta = 0;
            $('.producto-row').each(function() {
                const precioProducto = parseFloat($(this).find('.producto-select option:selected').data('precio') || 0);
                const cantidad = parseInt($(this).find('.cantidad-input').val()) || 1;
                const precioTotal = precioProducto * cantidad;
                $(this).find('.precio-total').val(precioTotal.toFixed(2));
                totalVenta += precioTotal;
            });
            $('#totalVenta').val(totalVenta.toFixed(2));
        }

        $(document).on('change', '.producto-select, .cantidad-input', function() {
            calcularPrecioTotal();
        });

        $('#addProductButton').click(function() {
            const nuevaFila = `
                <div class="row producto-row">
                    <div class="col-md-6 mb-3">
                        <label for="producto_id" class="form-label">Producto</label>
                        <select id="producto_id" name="producto_id[]" class="form-control producto-select" required>
                            <option value="">Selecciona un producto</option>
                            <?php
                                foreach ($productos as $producto) {
                                    echo "<option value='{$producto['id']}' data-precio='{$producto['precio']}'>{$producto['nombre']}</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="cantidad" class="form-label">Cantidad</label>
                        <input type="number" class="form-control cantidad-input" name="cantidad[]" min="1" value="1" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Precio total</label>
                        <input type="text" class="form-control precio-total" name="precio_total[]" readonly>
                    </div>
                </div>
            `;
            $('.productos').append(nuevaFila);
        });

        $('#ventaForm').submit(function(e) {
            e.preventDefault()
            const url = '../ajax/ajax_crear_venta.php'
            $.ajax({
                url: url,
                type: 'POST',
                data: $(this).serialize(),

                success: function(response) {
                    const json = JSON.parse(response);
                    if (json.status === 'success') {
                        $('#ventaForm')[0].reset()
                        $('#mensaje').html('<div class="alert alert-success">' + json.message + '</div>')
                        cargarVentas()
                    } else {
                        $('#mensaje').html('<div class="alert alert-danger">' + json.message + '</div>')
                    }
                },
                error: function() {
                    $('#mensaje').html('<div class="alert alert-danger">Error al procesar la venta. Inténtelo nuevamente.')
                }
            })
        })
    })
</script>

</body>
</html>

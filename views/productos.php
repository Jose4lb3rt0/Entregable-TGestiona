<?php
include '../config/config.php';
include '../includes/sidebar.php';
include $_SERVER['DOCUMENT_ROOT'] . BASE_URL . '/includes/sidebar.php';
?>
<body>
<div class="content">
    <div class="container">
        <div class="card mb-4">
            <div class="card-header">
                <h4 id="form-title">Crear Producto</h4>
            </div>
            <div class="card-body">
                <div id="mensaje"></div>
                <form id="productoForm">
                    <input type="hidden" id="productoId" name="id">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="categoria_id" class="form-label">Categoría</label>
                            <select id="categoria_id" name="categoria_id" class="form-control" required>
                                <option value="">Selecciona una categoría</option>
                                <option value="1">Computadoras</option>
                                <option value="2">Ropa</option>
                                <option value="3">Electrodomésticos</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="marca" class="form-label">Marca</label>
                            <input type="text" class="form-control" id="marca" name="marca" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="precio" class="form-label">Precio</label>
                            <input type="number" class="form-control" id="precio" name="precio" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="stock" class="form-label">Stock</label>
                            <input type="number" class="form-control" id="stock" name="stock" required>
                        </div>
                    </div>

                    <!-- Computadoras -->
                    <div id="campos-computadoras" style="display: none;">
                        <h5>Detalles de Computadora</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="procesador" class="form-label">Procesador</label>
                                <input type="text" class="form-control" id="procesador" name="procesador">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="ram" class="form-label">RAM</label>
                                <input type="text" class="form-control" id="ram" name="ram">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="disco_duro" class="form-label">Disco Duro</label>
                                <input type="text" class="form-control" id="disco_duro" name="disco_duro">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="tarjeta_grafica" class="form-label">Tarjeta Gráfica</label>
                                <input type="text" class="form-control" id="tarjeta_grafica" name="tarjeta_grafica">
                            </div>
                        </div>
                    </div>

                    <!-- Ropa -->
                    <div id="campos-ropa" style="display: none;">
                        <h5>Detalles de Ropa</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="talla" class="form-label">Talla</label>
                                <input type="text" class="form-control" id="talla" name="talla">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="color" class="form-label">Color</label>
                                <input type="text" class="form-control" id="color" name="color">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="genero" class="form-label">Género</label>
                                <input type="text" class="form-control" id="genero" name="genero">
                            </div>
                        </div>
                    </div>

                    <!-- Electrodomésticos -->
                    <div id="campos-electrodomesticos" style="display: none;">
                        <h5>Detalles de Electrodoméstico</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="consumo_energetico" class="form-label">Consumo Energético</label>
                                <input type="text" class="form-control" id="consumo_energetico" name="consumo_energetico">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary" id="submitButton">Agregar Producto</button>
                </form>
            </div>
        </div>

        <!--Selector de tablas-->
        <div class="col-md-6 mb-3 mt-3">
            <label for="categoria_view_table" class="form-label">Tabla</label>
            <select id="categoria_view_table" name="categoria_view_table" class="form-control" required>
                <option value="">Selecciona una categoría</option>
                <option value="1">Computadoras</option>
                <option value="2">Ropa</option>
                <option value="3">Electrodomésticos</option>
            </select>
        </div>

        <!--Tablas por categorías-->
        <div class="card">
            <div class="card-header">
                <h4>Lista de Productos</h4>
            </div>
            <div class="card-body">
                <table id="tablaComputadora" class="table table-striped" style="display:none;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Marca</th>
                            <th>Procesador</th>
                            <th>RAM</th>
                            <th>Disco duro</th>
                            <th>Tarjeta gráfica</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Categoria</th>
                            <th>Fecha Creacion</th>
                        </tr>
                    </thead>
                    <tbody id="tbodyComputadora">
                    </tbody>
                </table>
                <table id="tablaElectrodomestico" class="table table-striped" style="display:none;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Marca</th>
                            <th>Consumo Energético</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Categoria</th>
                            <th>Fecha Creacion</th>
                        </tr>
                    </thead>
                    <tbody id="tbodyElectrodomestico">
                    </tbody>
                </table>
                <table id="tablaRopa" class="table table-striped" style="display:none;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Marca</th>
                            <th>Talla</th>
                            <th>Color</th>
                            <th>Género</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Categoria</th>
                            <th>Fecha Creacion</th>
                        </tr>
                    </thead>
                    <tbody id="tbodyRopa">
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<script>
function mostrarCamposPorCategoria(categoriaId) {
    $('#campos-computadoras').hide()
    $('#campos-ropa').hide()
    $('#campos-electrodomesticos').hide()

    if (categoriaId == '1') {
        $('#campos-computadoras').show()
    } else if (categoriaId == '2') {
        $('#campos-ropa').show()
    } else if (categoriaId == '3') {
        $('#campos-electrodomesticos').show()
    }
}

function mostrarTablaPorCategoria(categoriaId){
    $('#tablaComputadora').hide()
    $('#tablaRopa').hide()
    $('#tablaElectrodomestico').hide()

    if (categoriaId == '1') {
        $('#tablaComputadora').show()
        cargarProductosPorCategoria(categoriaId, '#tbodyComputadora')
    } else if (categoriaId == '2') {
        $('#tablaRopa').show()
        cargarProductosPorCategoria(categoriaId, '#tbodyRopa')
    } else if (categoriaId == '3') {
        $('#tablaElectrodomestico').show()
        cargarProductosPorCategoria(categoriaId, '#tbodyElectrodomestico')
    }
}

$('#categoria_id').change(function() {
    var categoriaId = $(this).val();
    mostrarCamposPorCategoria(categoriaId)
})

$(document).ready(function() {
    $('#categoria_id').trigger('change')
})

function cargarProductosPorCategoria(categoriaId, tablaId){
    $.ajax({
        url: '../ajax/ajax_listar_productos.php',
        type: 'GET',
        data: {categoria_id: categoriaId},
        success: function(response){
            var productos = JSON.parse(response)
            var tbody = $(tablaId)
            tbody.empty()

            productos.forEach(function(producto){
                if (categoriaId == '1'){
                    tbody.append(`
                        <tr>
                            <td>${producto.id}</td>
                            <td>${producto.nombre}</td>
                            <td>${producto.marca}</td>
                            <td>${producto.procesador}</td>
                            <td>${producto.ram}</td>
                            <td>${producto.disco_duro}</td>
                            <td>${producto.tarjeta_grafica}</td>
                            <td>${producto.precio}</td>
                            <td>${producto.stock}</td>
                            <td>${producto.categoria_id}</td>
                            <td>${producto.fecha_creacion}</td>
                            <td>
                                <button class="btn btn-sm btn-danger btnEliminar" data-id="${producto.id}">
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                    `)
                }else if (categoriaId == '2'){
                    tbody.append(`
                        <tr>
                            <td>${producto.id}</td>
                            <td>${producto.nombre}</td>
                            <td>${producto.marca}</td>
                            <td>${producto.talla}</td>
                            <td>${producto.color}</td>
                            <td>${producto.genero}</td>
                            <td>${producto.precio}</td>
                            <td>${producto.stock}</td>
                            <td>${producto.categoria_id}</td>
                            <td>${producto.fecha_creacion}</td>
                            <td>
                                <button class="btn btn-sm btn-danger btnEliminar" data-id="${producto.id}">
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                    `)
                }else if (categoriaId == '3'){
                    tbody.append(`
                        <tr>
                            <td>${producto.id}</td>
                            <td>${producto.nombre}</td>
                            <td>${producto.marca}</td>
                            <td>${producto.consumo_energetico}</td>
                            <td>${producto.precio}</td>
                            <td>${producto.stock}</td>
                            <td>${producto.categoria_id}</td>
                            <td>${producto.fecha_creacion}</td>
                            <td>
                                <button class="btn btn-sm btn-danger btnEliminar" data-id="${producto.id}">
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                    `)
                }
            })

            $('.btnEliminar').click(function(e){
                e.preventDefault()
                var id = $(this).data('id')
                eliminarProducto(id)
            })
        }
    })
}

function eliminarProducto(producto_id) {
    if (confirm('¿Está seguro de que desea eliminar este producto?')) {
        $.ajax({
            url: '../ajax/ajax_eliminar_producto.php',
            type: 'POST',
            data: { producto_id: producto_id },
            success: function(response) {
                var json = JSON.parse(response)

                if (json.status === 'success') {
                    alert(json.message);
                    cargarProductosPorCategoria($('#categoria_view_table').val(), '#tbodyComputadora')
                } else {
                    alert(json.message)
                }
            },
            error: function() {
                alert('Error al eliminar el producto. Inténtelo nuevamente.')
            }
        })
    }
}


$('#productoForm').submit(function(e){
    e.preventDefault()

    var url = '../ajax/ajax_crear_producto.php'

    $.ajax({
        url: url,
        type: 'POST',
        data: $(this).serialize(),
        success: function(response) {
            var json = JSON.parse(response)

            if (json.status === 'success') {
                $('#productoForm')[0].reset()
                $('#mensaje').html('<div class="alert alert-success">' + json.message + '</div>')
                cargarProductos()
            } else {
                $('#mensaje').html('<div class="alert alert-danger">' + json.message + '</div>')
            }
        },
        error: function(){
            $('#mensaje').html('<div class="alert alert-danger">Error al procesar la solicitud. Inténtelo nuevamente.</div>');
        }
    })
})

$('#categoria_view_table').change(function(){
    var categoriaId = $(this).val()
    mostrarTablaPorCategoria(categoriaId)
})

$(document).ready(function(){
    $('#categoria_view_table').trigger('change');
})
</script>

</body>
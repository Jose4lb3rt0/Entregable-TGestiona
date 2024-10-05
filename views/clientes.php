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
                <h4 id="form-title">Crear Cliente</h4>
            </div>
            <div class="card-body">
                <div id="mensaje"></div>
                <form id="crearClienteForm" >
                    <input type="hidden" id="clienteId" name="id">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="apellido" class="form-label">Apellido</label>
                            <input type="text" class="form-control" id="apellido" name="apellido" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="dni" class="form-label">DNI</label>
                            <input type="text" class="form-control" id="dni" name="dni" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" id="submitButton">Agregar Cliente</button>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4>Lista de Clientes</h4>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>DNI</th>
                            <th>Teléfono</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tablaClientes">
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
function cargarClientes(){
    $.ajax({
        url: '../ajax/ajax_listar_clientes.php',
        type: 'GET',
        success: function(response){
            var clientes = JSON.parse(response)
            var tbody = $('#tablaClientes')
            tbody.html('')

            clientes.forEach(function(cliente){
                tbody.append(`
                    <tr>
                        <td>${cliente.id}</td>
                        <td>${cliente.nombre}</td>
                        <td>${cliente.apellido}</td>
                        <td>${cliente.dni}</td>
                        <td>${cliente.email}</td>
                        <td>${cliente.telefono}</td>
                        <td>
                            <a href="#" class="btn btn-sm btn-warning btnEditar" data-id="${cliente.id}">
                                Editar
                            </a>
                            <a href="#" class="btn btn-sm btn-danger btnEliminar" data-id="${cliente.id}">
                                Eliminar
                            </a>
                        </td>
                    </tr>
                `)
            })

            $('.btnEditar').click(function(e){
                e.preventDefault();
                var id = $(this).data('id')
                cargarCliente(id)
            })

            $('.btnEliminar').click(function(e){
                e.preventDefault();
                var id = $(this).data('id')
                eliminarCliente(id)
            })
            
        },
        error: function(){
            $('#mensaje').html('<div class="alert alert-danger">Error al cargar los clientes. Inténtelo nuevamente.</div>')
        }
    })
}

function cargarCliente(id){
    $.ajax({
        url: '../ajax/ajax_buscar_cliente.php',
        type: 'GET',
        data: {id: id},
        success: function(response){
            var cliente = JSON.parse(response)
            $('#clienteId').val(cliente.id)
            $('#nombre').val(cliente.nombre)
            $('#apellido').val(cliente.apellido)
            $('#dni').val(cliente.dni)
            $('#email').val(cliente.email)
            $('#telefono').val(cliente.telefono)
            $('#form-title').text('Editar Cliente');
            $('#submitButton').text('Actualizar Cliente');
        },
    })
}

function eliminarCliente(id){
    if (confirm('¿Está seguro de eliminar el cliente?')){
        $.ajax({
            url: '../ajax/ajax_eliminar_cliente.php',
            type: 'POST',
            data: {id: id},
            success: function(response){
                var json = JSON.parse(response)
                
                if (json.status === 'success') {
                    $('#mensaje').html('<div class="alert alert-success">' + json.message + '</div>')
                    cargarClientes()
                } else {
                    $('#mensaje').html('<div class="alert alert-danger">' + json.message + '</div>')
                }
            },
            error: function(){
                $('#mensaje').html('<div class="alert alert-danger">Error al eliminar el cliente. Inténtelo nuevamente.</div>')
            }
        })
    }
}

$('#crearClienteForm').submit(function(e){
    e.preventDefault()
    
    var url = $('#clienteId').val() ? '../ajax/ajax_actualizar_cliente.php' : '../ajax/ajax_crear_cliente.php';

    $.ajax({
        url: url,  
        type: 'POST',
        data: $(this).serialize(), 
        success: function(response) {
            var json = JSON.parse(response)
            
            if (json.status === 'success') {
                $('#crearClienteForm')[0].reset();
                $('#mensaje').html('<div class="alert alert-success">' + json.message + '</div>')
                cargarClientes()
            } else {
                $('#mensaje').html('<div class="alert alert-danger">' + json.message + '</div>')
            }
        },
        error: function() {
            $('#mensaje').html('<div class="alert alert-danger">Error al crear el cliente. Inténtelo nuevamente.</div>')
        }
    })
})

$(document).ready(function(){
    cargarClientes()
})

</script>

</body>
</html>

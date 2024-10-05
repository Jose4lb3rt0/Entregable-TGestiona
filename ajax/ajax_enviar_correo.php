<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once '../config/config.php';
require_once '../models/Venta.php';
require_once '../models/DetalleVenta.php';
require_once '../vendor/autoload.php';

if (isset($_POST['venta_id'])) {
    $venta_id = $_POST['venta_id'];

    $ventaModel = new Venta();
    $detalleVentaModel = new DetalleVenta();

    $venta = $ventaModel->buscarVentaPorId($venta_id);
    $detalles = $detalleVentaModel->listarDetallesPorVentaId($venta_id);

    if ($venta && $detalles) {
        $mensaje = "<h3>Detalles de la Venta</h3>";
        $mensaje .= "<p>Cliente: {$venta['cliente_nombre']} {$venta['cliente_apellido']}</p>";
        $mensaje .= "<p>Fecha de Venta: {$venta['fecha_venta']}</p>";
        $mensaje .= "<p>Total: {$venta['total']}</p>";
        $mensaje .= "<h4>Productos:</h4><ul>";

        foreach ($detalles as $detalle) {
            $mensaje .= "<li>Producto: {$detalle['producto_nombre']}, Cantidad: {$detalle['cantidad']}, Precio: {$detalle['total']}</li>";
        }
        $mensaje .= "</ul>";

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host     = 'smtp.gmail.com';      
        $mail->SMTPAuth = true;
        $mail->Username = 'josealberto3200@gmail.com'; 
        $mail->Password = 'oefh gjce yuuh vfft';  
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        $clienteEmail = $venta['cliente_email'];

        $mail->setFrom('tu_correo@dominio.com', 'Nombre de tu empresa');
        $mail->addAddress($clienteEmail, $venta['cliente_nombre'] . ' ' . $venta['cliente_apellido']);
        $mail->isHTML(true);
        $mail->Subject = 'Detalles de su compra';
        $mail->Body = $mensaje;

        if ($mail->send()) {
            echo json_encode(['status' => 'success', 'message' => 'Correo enviado correctamente.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al enviar el correo: ' . $mail->ErrorInfo]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No se encontraron detalles de la venta.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Faltan campos requeridos.']);
}
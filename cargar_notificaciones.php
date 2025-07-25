<?php
$conn = new mysqli("localhost", "root", "", "pruebas001");
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
$conn->set_charset("utf8");

// Obtener el id del usuario desde GET
$id_usuario = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id_usuario <= 0) {
    // Si no hay id válido, retornar array vacío JSON
    echo json_encode([]);
    exit;
}

// Consulta para obtener las notificaciones del usuario
$sql = "SELECT id, mensaje, leido FROM notificaciones WHERE id_usuario = $id_usuario ORDER BY fecha DESC";
$result = $conn->query($sql);

$notificaciones = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $notificaciones[] = $row;
    }
}

// Establecer tipo de contenido JSON y enviar resultado
header('Content-Type: application/json');
echo json_encode($notificaciones);

$conn->close();


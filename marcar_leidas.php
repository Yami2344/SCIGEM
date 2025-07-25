<?php
$conn = new mysqli("localhost", "root", "", "pruebas001");
$conn->set_charset("utf8");
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$id_usuario = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id_usuario <= 0) {
    echo json_encode(['success' => false, 'error' => 'ID inválido']);
    exit;
}

$sql = "UPDATE notificaciones SET leido = 1 WHERE id_usuario = $id_usuario";
$conn->query($sql);
echo json_encode(['success' => true]);
$conn->close();
?>

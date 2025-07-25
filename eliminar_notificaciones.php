<?php
header('Content-Type: application/json');

$conn = new mysqli("localhost", "root", "", "pruebas001");
$conn->set_charset("utf8");

if ($conn->connect_error) {
    echo json_encode(['success' => false, 'error' => 'Error de conexión: ' . $conn->connect_error]);
    exit;
}

$id_usuario = isset($_POST['id']) ? intval($_POST['id']) : 0;
$id_notificacion = isset($_POST['id_notificacion']) ? intval($_POST['id_notificacion']) : 0;

if ($id_usuario <= 0 || $id_notificacion <= 0) {
    echo json_encode(['success' => false, 'error' => 'ID inválido']);
    exit;
}

$sql = "DELETE FROM notificaciones WHERE id = ? AND id_usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $id_notificacion, $id_usuario);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => $stmt->error]);
}

$stmt->close();
$conn->close();
?>

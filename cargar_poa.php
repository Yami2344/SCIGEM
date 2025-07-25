<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root"; // Cambia si es necesario
$password = "";
$dbname = "pruebas001";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'error' => 'Conexión fallida']);
    exit;
}

$id_usuario = intval($_GET['id_usuario']);
$mes = intval($_GET['mes']);
$anio = intval($_GET['anio']);

$sql = "SELECT actividades, calendario FROM poa_actividades WHERE id_usuario=$id_usuario AND mes=$mes AND anio=$anio LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode([
        'success' => true,
        'actividades' => json_decode($row['actividades']),
        'calendario' => json_decode($row['calendario'])
    ]);
} else {
    echo json_encode(['success' => false]);
}

$conn->close();
?>

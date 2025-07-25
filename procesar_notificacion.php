<?php
$conn = new mysqli("localhost", "root", "", "pruebas001");
$conn->set_charset("utf8");

// Recoger datos del formulario
$mensaje = $_POST['mensaje'];
$id_usuario = $_POST['id_usuario'];

// Si se envía a todos los usuarios
if ($id_usuario === 'todos') {
    $usuarios = $conn->query("SELECT iduser FROM Usuario");
    while ($row = $usuarios->fetch_assoc()) {
        $conn->query("INSERT INTO notificaciones (mensaje, id_usuario) 
                      VALUES ('$mensaje', {$row['iduser']})");
    }
} else {
    // Insertar solo a un usuario
    $conn->query("INSERT INTO notificaciones (mensaje, id_usuario) 
                  VALUES ('$mensaje', $id_usuario)");
}

echo "✅ Notificación enviada correctamente.";
echo "<br><a href='enviar_notificacion.php'>Volver</a>";
?>

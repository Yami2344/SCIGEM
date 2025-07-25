<?php
// enviar_notificacion.php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pruebas001";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
$conn->set_charset("utf8");

// Traer usuarios para el select
$sql = "SELECT iduser, Nombre, AP, AM FROM usuario ORDER BY Nombre";
$result = $conn->query($sql);
$usuarios = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $usuarios[] = $row;
    }
}

$mensaje_exito = "";
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_usuario = isset($_POST['id_usuario']) ? intval($_POST['id_usuario']) : 0;
    $mensaje = isset($_POST['mensaje']) ? trim($_POST['mensaje']) : "";

    if (empty($mensaje)) {
        $error = "Por favor escribe un mensaje.";
    } else {
        if ($id_usuario === 0) {
            // Enviar a todos
            $stmt = $conn->prepare("INSERT INTO notificaciones (id_usuario, mensaje, fecha, leido) VALUES (?, ?, NOW(), 0)");
            foreach ($usuarios as $usuario) {
                $stmt->bind_param("is", $usuario['iduser'], $mensaje);
                $stmt->execute();
            }
            $stmt->close();
            $mensaje_exito = "Notificación enviada a TODOS los usuarios correctamente.";
        } else {
            // Enviar a un usuario específico
            $stmt = $conn->prepare("INSERT INTO notificaciones (id_usuario, mensaje, fecha, leido) VALUES (?, ?, NOW(), 0)");
            $stmt->bind_param("is", $id_usuario, $mensaje);
            $stmt->execute();
            $stmt->close();
            $mensaje_exito = "Notificación enviada correctamente.";
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Enviar Notificación - Admin</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #ffffff;
      margin: 0;
      padding: 20px;
      color: #333;
    }
    header {
      background: linear-gradient(90deg, #660021, #00333a);
      color: white;
      padding: 15px 20px;
      text-align: center;
      font-weight: bold;
      font-size: 24px;
      border-radius: 0 0 10px 10px;
      margin-bottom: 30px;
    }
    form {
      max-width: 500px;
      margin: 0 auto;
      background: #f9f9f9;
      border: 2px solid #660021;
      border-radius: 10px;
      padding: 20px;
      box-shadow: 0 0 10px rgba(102,0,33,0.4);
    }
    label {
      display: block;
      margin-bottom: 8px;
      color: #660021;
      font-weight: bold;
      font-size: 16px;
    }
    select, textarea {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 2px solid #00333a;
      border-radius: 6px;
      font-size: 14px;
      font-family: Arial, sans-serif;
      box-sizing: border-box;
      resize: vertical;
      transition: border-color 0.3s ease;
    }
    select:focus, textarea:focus {
      border-color: #660021;
      outline: none;
    }
    textarea {
      min-height: 100px;
    }
    button {
      background-color: #660021;
      color: white;
      border: none;
      padding: 12px 20px;
      font-size: 16px;
      border-radius: 8px;
      cursor: pointer;
      font-weight: bold;
      transition: background-color 0.3s ease;
      width: 100%;
    }
    button:hover {
      background-color: #00333a;
    }
    .mensaje-exito {
      background-color: #d4edda;
      border: 2px solid #28a745;
      color: #155724;
      padding: 10px 15px;
      border-radius: 8px;
      margin-bottom: 20px;
      font-weight: bold;
      max-width: 500px;
      margin-left: auto;
      margin-right: auto;
      text-align: center;
    }
    .error {
      background-color: #f8d7da;
      border: 2px solid #dc3545;
      color: #721c24;
      padding: 10px 15px;
      border-radius: 8px;
      margin-bottom: 20px;
      font-weight: bold;
      max-width: 500px;
      margin-left: auto;
      margin-right: auto;
      text-align: center;
    }
  </style>
</head>
<body>

<header>Enviar Notificación - Administración</header>

<?php if ($mensaje_exito): ?>
  <div class="mensaje-exito"><?= htmlspecialchars($mensaje_exito) ?></div>
<?php endif; ?>

<?php if ($error): ?>
  <div class="error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<form method="POST" action="enviar_notificacion.php">
  <label for="id_usuario">Selecciona usuario:</label>
  <select name="id_usuario" id="id_usuario" required>
    <option value="0">-- Enviar a TODOS los usuarios --</option>
    <?php foreach ($usuarios as $usuario): ?>
      <option value="<?= $usuario['iduser'] ?>">
        <?= htmlspecialchars($usuario['Nombre'] . ' ' . $usuario['AP'] . ' ' . $usuario['AM']) ?>
      </option> 
    <?php endforeach; ?>
  </select>

  <label for="mensaje">Mensaje:</label>
  <textarea name="mensaje" id="mensaje" placeholder="Escribe el mensaje aquí..." required></textarea>

  <button type="submit">Enviar Notificación</button>
</form>

</body>
</html>

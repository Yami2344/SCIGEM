<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Registrar Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      /* Fondo degradado suave con textura ligera */
      background: linear-gradient(135deg, #660021, #00333a);
      height: 100vh;
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      overflow: hidden;
      position: relative;
      color: #fff;
    }

    /* Opcional: agregar patrón o textura */
    body::before {
      content: "";
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
      background: radial-gradient(circle at center, rgba(255,255,255,0.05) 1px, transparent 1px);
      background-size: 50px 50px;
      pointer-events: none;
      z-index: 0;
    }

    .form-container {
      position: relative;
      z-index: 1;
      background-color: #ffffff;
      color: #000;
      max-width: 450px;
      width: 100%;
      padding: 30px;
      border-radius: 20px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
    }

    .form-container h2 {
      color: #660021;
      font-weight: 700;
      margin-bottom: 25px;
      text-align: center;
      font-size: 2rem;
      letter-spacing: 1.2px;
    }

    label.form-label {
      font-weight: 600;
      color: #00333a;
    }

    .form-control {
      border-radius: 10px;
      border: 2px solid #00333a;
      transition: border-color 0.3s ease;
    }

    .form-control:focus {
      border-color: #660021;
      box-shadow: none;
      outline: none;
    }

    .btn-custom {
      background-color: #660021;
      border: none;
      border-radius: 12px;
      font-weight: 700;
      padding: 12px 0;
      font-size: 1.1rem;
      transition: background-color 0.3s ease;
    }

    .btn-custom:hover {
      background-color: #80002d;
    }

    .message-box {
      margin-top: 20px;
      padding: 15px;
      border-radius: 12px;
      background-color: #e9f6ff;
      border-left: 5px solid #00333a;
      color: #00333a;
      font-size: 1rem;
    }
  </style>
</head>
<body>

<div class="form-container">
  <h2>Registro de Acceso</h2>
  <form method="POST" action="/registrar_login">
    <div class="mb-3">
      <label for="id_usuario" class="form-label">Clave única de usuario</label>
      <input type="number" class="form-control" name="id_usuario" required />
    </div>
    <div class="mb-3">
      <label for="username" class="form-label">Nombre de Usuario</label>
      <input type="text" class="form-control" name="username" required />
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Contraseña</label>
      <input type="password" class="form-control" name="password" required />
    </div>
    <button type="submit" class="btn btn-custom w-100">Registrar</button>
  </form>

</body>
</html>

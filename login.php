<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Iniciar Sesión - SCIGEM</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to right, #660021, #00333a);
      color: #fff;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Segoe UI', sans-serif;
    }

    .login-container {
      background-color: #ffffff;
      color: #000;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0px 0px 15px rgba(255, 255, 255, 0.2);
      width: 100%;
      max-width: 400px;
    }

    .form-control {
      border-radius: 10px;
    }

    .btn-primary {
      background-color: #00333a;
      border: none;
      border-radius: 10px;
    }

    .btn-primary:hover {
      background-color: #004d5a;
    }

    .login-title {
      color: #660021;
      font-weight: bold;
    }

    .link-crear {
      color: #00333a;
      text-decoration: none;
    }

    .link-crear:hover {
      text-decoration: underline;
    }

    .alert {
      border-radius: 10px;
    }
  </style>
</head>
<body>

<div class="login-container">
  <h2 class="text-center login-title mb-4">Iniciar Sesión</h2>

  <form method="POST" action="/login">
    <div class="mb-3">
      <label for="username" class="form-label">Usuario</label>
      <input type="text" class="form-control" id="username" name="usuario" placeholder="Ingresa tu usuario" required>
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Contraseña</label>
      <input type="password" class="form-control" id="password" name="password" placeholder="********" required>
    </div>
    <button type="submit" class="btn btn-primary w-100">Ingresar</button>

    <div class="text-center mt-3">
      <a href="{{ url_for('registrar_login') }}" class="link-crear">¿No tienes acceso? Crear usuario</a>

 
  </form>
</div>

</body>
</html>

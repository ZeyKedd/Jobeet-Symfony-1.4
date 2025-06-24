<!-- error.php -->
<?php
http_response_code(404); // Código HTTP 500: Error interno del servidor
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Error del servidor</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      text-align: center;
      padding: 100px;
      background-color: #f8f8f8;
    }
    h1 {
      font-size: 50px;
      color: #cc0000;
    }
    p {
      font-size: 18px;
      color: #333;
    }
  </style>
</head>
<body>
  <h1>¡Ups! Algo salió mal</h1>
  <p>Estamos trabajando para solucionar el problema.<br>Por favor, intenta de nuevo más tarde.</p>
</body>
</html>

<?php
require 'credenciales.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

if (isset($_POST['usuario']) && isset($_POST['contrasena'])) {
    if ($_POST['usuario'] === $usuarioPermitido && $_POST['contrasena'] === $contrasenaPermitida) {
        $_SESSION['autenticado'] = true;
    } else {
        $error = "Usuario o clave incorrectos";
    }
}

if (empty($_SESSION['autenticado'])) {
    // Formulario de inicio de sesión
    echo '
    <form method="POST" style="max-width:320px;margin:60px auto;padding:25px;background:#fff;
    box-shadow:0 2px 10px rgba(0,0,0,0.1);border-radius:14px;font-family:sans-serif;">
      <h2 style="text-align:center;color:#f76918;">Panel de Anxo</h2>
      <label>Usuario</label>
      <input type="text" name="usuario" placeholder="Usuario" style="width:100%;padding:10px;margin-bottom:10px;" required>
      <label>Contraseña</label>
      <input type="password" name="contrasena" placeholder="Contraseña" style="width:100%;padding:10px;margin-bottom:20px;" required>
      <button type="submit" style="width:100%;padding:12px;background:#f76918;color:#fff;
      border:none;border-radius:8px;font-weight:bold;cursor:pointer;">Entrar</button>';
      
    if (!empty($error)) {
        echo '<div style="color:#c00;margin-top:15px;text-align:center;">'.$error.'</div>';
    }

    echo '
    </form>';
    exit();
}

// --- SI YA ESTÁ AUTENTICADO, MOSTRAMOS LA TABLA DE DATOS ---

// CONEXIÓN A LA BASE DE DATOS EN INFINITYFREE
$conn = new mysqli(
  'sql113.infinityfree.com',       // Host (servidor)
  'if0_39536488',                  // MySQL Username
  'Liki1223',                       // cambia esto por la contraseña que aparece oculta (MYSQL PASSWORD)
  'if0_39536488_asesoriasdb'   // sustituye XXX por el nombre completo real de tu base de datos
);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
$result = $conn->query("SELECT * FROM registros ORDER BY fecha DESC");

// ESTILOS Y TABLA DE RESPUESTAS

echo "
<style>
body {
  font-family: 'Segoe UI', sans-serif;
  background: #f5f6fa;
  padding: 40px;
}
h2 {
  text-align: center;
  color: #f76918;
  margin-bottom: 40px;
}
table {
  width: 95%;
  margin: 0 auto;
  border-collapse: collapse;
  background: #fff;
  box-shadow: 0 4px 14px rgba(0, 0, 0, 0.05);
}
th, td {
  padding: 12px 15px;
  border: 1px solid #eee;
  text-align: left;
  font-size: 0.94rem;
}
th {
  background-color: #f76918;
  color: #fff;
  font-weight: bold;
  text-transform: uppercase;
  font-size: 0.9rem;
}
tr:nth-child(even) {
  background-color: #fafafa;
}
</style>
";

echo "<h2>Respuestas recibidas</h2>";
echo "<table>";
echo "<tr>
<th>Nombre</th>
<th>Edad</th>
<th>Objetivo</th>
<th>Nivel</th>
<th>Frustración</th>
<th>Freno</th>
<th>Ayuda</th>
<th>Inversión</th>
<th>Teléfono</th>
<th>Fecha</th>
</tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>" . htmlspecialchars($row['nombre'] ?? '') . "</td>
        <td>" . htmlspecialchars($row['edad'] ?? '') . "</td>
        <td>" . htmlspecialchars($row['objetivo'] ?? '') . "</td>
        <td>" . htmlspecialchars($row['nivel'] ?? '') . "</td>
        <td>" . htmlspecialchars($row['frustracion'] ?? '') . "</td>
        <td>" . htmlspecialchars($row['freno'] ?? '') . "</td>
        <td>" . htmlspecialchars($row['ayuda'] ?? '') . "</td>
        <td>" . htmlspecialchars($row['inversion'] ?? '') . "</td>
        <td>" . htmlspecialchars($row['telefono'] ?? '') . "</td>
        <td>" . htmlspecialchars($row['fecha'] ?? '') . "</td>
    </tr>";
}

echo "</table>";


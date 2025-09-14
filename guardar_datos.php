<?php
// Mostrar errores (importante para detectar fallos en InfinityFree)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// 📌 CONEXIÓN A LA BASE DE DATOS (INFINITYFREE)
$conn = new mysqli(
    'sql113.infinityfree.com',     // 🔁 Tu host en InfinityFree
    'if0_39536488',                // 🔁 Tu usuario
    'Liki1223',                    // 🔁 Tu contraseña (segura y exacta)
    'if0_39536488_asesoriasdb'     // 🔁 Tu nombre real de base de datos
);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// 📝 RECOGER DATOS DEL FORMULARIO
$nombre    = $_POST['nombre'] ?? '';
$edad      = $_POST['edad'] ?? '';
$molestia  = $_POST['molestia'] ?? '';
$historial = $_POST['historial'] ?? '';
$impacto   = $_POST['impacto'] ?? '';
$razon     = $_POST['razon'] ?? '';
$gmail     = $_POST['gmail'] ?? '';
$instagram = $_POST['instagram'] ?? '';
$telefono  = $_POST['telefono'] ?? '';
$inversion = $_POST['inversion'] ?? '';
$contacto  = $_POST['contacto'] ?? '';
$fecha     = date("Y-m-d H:i:s"); // Nueva columna si quieres guardar la fecha

// CONSULTA PREPARADA
$sql = "INSERT INTO registros 
(nombre, edad, molestia, historial, impacto, razon, gmail, instagram, telefono, inversion, contacto, fecha) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Error al preparar consulta: " . $conn->error);
}

$stmt->bind_param(
    "ssssssssssss",
    $nombre, $edad, $molestia, $historial, $impacto,
    $razon, $gmail, $instagram, $telefono, $inversion, $contacto, $fecha
);

// Ejecutar y verificar
if (!$stmt->execute()) {
    die("Error al guardar los datos: " . $stmt->error);
}

// Cerrar conexiones
$stmt->close();
$conn->close();

// ✅ REDIRECCIONAR A GRACIAS
header("Location: gracias.html");
exit();
?>

<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// CONEXIÓN A BD
$conn = new mysqli(
    "sql113.infinityfree.com",
    "if0_39536488",
    "Liki1223",
    "if0_39536488_asesoriasdb"
);

if ($conn->connect_error) {
    die("Error conexión: " . $conn->connect_error);
}

// DATOS DEL FORMULARIO PREMIUM
$nombre = $_POST['nombre'] ?? null;
$edad = $_POST['edad'] ?? null;
$pais_ciudad = $_POST['pais_ciudad'] ?? null;
$instagram = $_POST['instagram'] ?? null;
$ocupacion = $_POST['ocupacion'] ?? null;
$meta = $_POST['meta'] ?? null;
$error = $_POST['error'] ?? null;
$porque_skyfit = $_POST['porque_skyfit'] ?? null;
$compromiso = $_POST['compromiso'] ?? null;
$situacion_financiera = $_POST['situacion_financiera'] ?? null;
$telefono = $_POST['telefono'] ?? null;
$fecha = date("Y-m-d H:i:s");

// INSERT PREMIUM
$sql = "INSERT INTO registros 
(nombre, edad, pais_ciudad, instagram_premium, ocupacion, meta, error_meta, porque_skyfit, compromiso, situacion_financiera, telefono, fecha)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Error SQL: " . $conn->error);
}

$stmt->bind_param(
    "sissssssisss",
    $nombre,
    $edad,
    $pais_ciudad,
    $instagram,
    $ocupacion,
    $meta,
    $error,
    $porque_skyfit,
    $compromiso,
    $situacion_financiera,
    $telefono,
    $fecha
);

if (!$stmt->execute()) {
    die("Error al guardar: " . $stmt->error);
}

$stmt->close();
$conn->close();

// REDIRECCIÓN WHATSAPP
header("Location: https://wa.me/34604002796/?text=Hey%20SKFITSS,%20acabo%20de%20enviar%20mi%20caso%20premium");
exit();
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Conexión a la base de datos
$conn = new mysqli(
    'sql113.infinityfree.com',
    'if0_39536488',
    'Liki1223',
    'if0_39536488_asesoriasdb'
);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Recoger datos del formulario (con nombres según HTML)
$nombre     = $_POST['nombre'] ?? '';
$edad       = $_POST['edad'] ?? '';
$objetivo   = $_POST['objetivo'] ?? '';
$nivel      = $_POST['nivel'] ?? '';
$frustracion= $_POST['frustracion'] ?? '';
$freno      = $_POST['freno'] ?? '';
$ayuda      = $_POST['ayuda'] ?? '';
$inversion  = $_POST['inversion'] ?? '';
$telefono   = $_POST['telefono'] ?? '';
$fecha      = date("Y-m-d H:i:s");

// Consulta preparada (ajusta los nombres de columnas en tu tabla si es necesario)
$sql = "INSERT INTO registros 
(nombre, edad, objetivo, nivel, frustracion, freno, ayuda, inversion, telefono, fecha)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Error al preparar consulta: " . $conn->error);
}

$stmt->bind_param(
    "sissssssss",
    $nombre, $edad, $objetivo, $nivel, $frustracion, $freno, $ayuda, $inversion, $telefono, $fecha
);

if (!$stmt->execute()) {
    die("Error al guardar los datos: " . $stmt->error);
}

$stmt->close();
$conn->close();

header("Location: https://wa.me/34604002796/?text=Hey%20sk%2C%20mi%20situaci%C3%B3n%20encaja%20para%20que%20me%20puedas%20ayudar%20a%20cambiar%20mi%20f%C3%ADsico%3F");
exit();

?>

<?php
include("connection.php");
$con = connection();

$name = trim($_POST['name']);
$description = trim($_POST['description']);
$price = $_POST['price'];
$quantity = $_POST['quantity'];

// Validar los datos del formulario
if (empty($name) || empty($description) || !is_numeric($price) || !is_numeric($quantity) || $price < 0 || $quantity < 0) {
    echo "Datos del formulario no válidos.";
    exit;
}

// Manejar la carga de la imagen
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Verificar si el archivo es una imagen real
$check = getimagesize($_FILES["image"]["tmp_name"]);
if($check !== false) {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        $image = $target_file;
    } else {
        echo "Error al subir la imagen.";
        exit;
    }
} else {
    echo "El archivo no es una imagen.";
    exit;
}

$sql = "INSERT INTO productos (name, description, price, quantity, image) VALUES (?, ?, ?, ?, ?)";
$stmt = $con->prepare($sql);
if ($stmt === false) {
    die("Error en la preparación de la consulta: " . $con->error);
}
$stmt->bind_param("ssdis", $name, $description, $price, $quantity, $image);

if ($stmt->execute()) {
    Header("Location: index.php");
} else {
    echo "Error en la ejecución de la consulta: " . $stmt->error;
}

$stmt->close();
$con->close();
?>
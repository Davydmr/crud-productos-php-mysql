<?php
include("connection.php");
$con = connection();

$sql = "SELECT * FROM productos";
$query = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="CSS/style.css" rel="stylesheet">
    <title>Productos CRUD</title>
</head>

<body>
    <div class="products-form">
        <h1>Registrar productos</h1>
        <form action="insert_product.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
            <input type="text" name="name" placeholder="Nombre" required>
            <input type="text" name="description" placeholder="Descripción" required>
            <input type="number" name="price" placeholder="Precio" required min="0" step="0.01">
            <input type="number" name="quantity" placeholder="Cantidad (stock)" required min="0">
            
            <label for="image" class="custom-file-upload">
                Seleccionar imagen
            </label>
            <input type="file" id="image" name="image" accept="image/*" required>
            <span id="file-name"></span>

            <input type="submit" value="Agregar">
        </form>
    </div>

    <div class="products-table">
        <h2>Productos registrados</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Imagen</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_array($query)): ?>
                    <tr>
                        <th><?= $row['id'] ?></th>
                        <th><?= $row['name'] ?></th>
                        <th><?= $row['description'] ?></th>
                        <th><?= $row['price'] ?></th>
                        <th><?= $row['quantity'] ?></th>
                        <th><?= $row['image'] ?></th>
                        <th><a href="update.php?id=<?= $row['id'] ?>" class="products-table--edit">Editar</a></th>
                        <th><a href="delete_product.php?id=<?= $row['id'] ?>" class="products-table--delete">Eliminar</a></th>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script>
        document.getElementById("image").onchange = function() {
            document.getElementById("file-name").textContent = this.files[0].name;
        };

        function validateForm() {
            const image = document.getElementById("image").files[0];
            if (!image) {
                alert("Por favor, selecciona una imagen.");
                return false;
            }
            return true;
        }
    </script>
</body>

</html>
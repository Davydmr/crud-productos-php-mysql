<?php 
    include("connection.php");
    $con=connection();

    $id=$_GET['id'];

    $sql="SELECT * FROM productos WHERE id='$id'";
    $query=mysqli_query($con, $sql);

    $row=mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
        <title>Editar productos</title>
        
    </head>
    <body>
        <div class="products-form">
            <form action="edit_product.php" method="POST">
                <input type="hidden" name="id" value="<?= $row['id']?>">
                <input type="text" name="name" placeholder="Nombre" value="<?= $row['name']?>">
                <input type="text" name="description" placeholder="Descripción" value="<?= $row['descriprion']?>">
                <input type="text" name="price" placeholder="Precio" value="<?= $row['price']?>">
                <input type="text" name="quantity" placeholder="Cantidad" value="<?= $row['quantity']?>">
                <input type="text" name="image" placeholder="Imagen" value="<?= $row['image']?>">

                <input type="submit" value="Actualizar">
            </form>
        </div>
    </body>
</html>
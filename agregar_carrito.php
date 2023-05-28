<?php
    include 'bd.php';
    session_start();
    $id_hotel = $_GET['id_hotel'];
    $id_usuario = $_SESSION['usuario'];

    $consulta=mysqli_query($conexion,"SELECT * FROM carrito WHERE id_usuario = '$id_usuario' and id_producto = '$id_hotel'");
    if(mysqli_num_rows($consulta) > 0){
        $cant = $conexion->prepare("UPDATE carrito SET cantidad = cantidad + 1 WHERE id_usuario = '$id_usuario' and id_producto = '$id_hotel'");
        $cant->execute();
        echo '
            <script>
                alert("Se agregó al carrito");
                window.location = "principal.php";
            </script>
        ';
        // falta sumarle 1 a la wea
        exit();
    } else {
        $sentenciaSQL = $conexion->prepare("INSERT INTO carrito(id_usuario, id_producto, cantidad)
        VALUES ('$id_usuario', '$id_hotel', '1')");
        $sentenciaSQL->execute();
        echo '
            <script>
                alert("Añadiste el hotel al carrito de compras");
                window.location = "principal.php";
            </script>
        ';
        exit();
    }

    mysqli_close($conexion);
?>
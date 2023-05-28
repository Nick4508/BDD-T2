<?php
    include 'bd.php';
    session_start();
    $id_usuario = $_SESSION['usuario'];
    $id_producto = $_GET['id_producto'];
    $agregar = $_GET['parametro'];
    $cantidad = $_GET['cantidad'];

    if($agregar == 1){
        //+1
        $cant = $conexion->prepare("UPDATE carrito SET cantidad = cantidad + 1 WHERE id_usuario = '$id_usuario' and id_producto = '$id_producto'");
        $cant->execute();
        echo '
            <script>
                alert("Se agregó 1 mas al carrito");
                window.location = "carrito.php";
            </script>
        ';
    }elseif($agregar == 0){
        if(($cantidad - 1) == 0){
            $cant = $conexion->prepare("DELETE FROM carrito WHERE id_usuario = '$id_usuario' and id_producto = '$id_producto'");
            $cant->execute();
            echo '
            <script>
                alert("Se eliminó el producto del carrito");
                window.location = "carrito.php";
            </script>
            ';
            //delete
        }
        else{
            $cant = $conexion->prepare("UPDATE carrito SET cantidad = cantidad - 1 WHERE id_usuario = '$id_usuario' and id_producto = '$id_producto'");
            $cant->execute();
            echo '
            <script>
                alert("Se eliminó 1 del carrito");
                window.location = "carrito.php";
            </script>
            ';
        }
    }
?>
<?php 
    include 'bd.php';
    session_start();
    $id_usuario = $_SESSION['usuario'];
    $id_producto = $_GET['id_producto'];

    $cant = $conexion->prepare("DELETE FROM carrito WHERE id_usuario = '$id_usuario' and id_producto = '$id_producto'");
    $cant->execute();
    echo '
        <script>
            alert("Se eliminó el producto del carrito");
            window.location = "carrito.php";
        </script>
    ';

?>
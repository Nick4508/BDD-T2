<?php
    include 'bd.php';
    session_start();
    $id = $_SESSION['usuario'];

    $data = mysqli_query($conexion,"SELECT id_producto,cantidad FROM carrito WHERE id_usuario = '$id'");
    if($data){
        while($row= mysqli_fetch_assoc($data)){
            $id_producto = $row['id_producto'];
            $cantidad = $row['cantidad'];
            $eliminar = $conexion->prepare("DELETE FROM carrito WHERE id_usuario = '$id' and id_producto = '$id_producto'");
            $eliminar->execute();
            $agregar = $conexion->prepare("INSERT INTO compras(id_usuario,id_producto,cantidad) VALUES('$id','$id_producto','$cantidad')");
            $agregar->execute();
        }
        echo '
        <script>
            alert("Haz comprado los elementos de tu carrito");
            window.location = "principal.php";
        </script>
        ';
    }

?>
<?php
    include 'bd.php';
    include 'header.php';
    $id = $_SESSION['id'];
    $data = mysqli_query($conexion,"SELECT * FROM usuarios WHERE id = '$id'");
    while($row = mysqli_fetch_assoc($data)){
        $nombre = $row['nombre'];
        $correo = $row['correo'];
        $fecha = $row['fecha_nacimiento'];
        echo $nombre.'<br>'.$correo.'<br>'.$fecha.'<br>'; 
    }
    echo '-----------wishlist--------------<br>';
    $whislist = mysqli_query($conexion,"SELECT * FROM wishlist WHERE id_usuario = '$id'");
    while($row = mysqli_fetch_assoc($whislist)){
        $promedio = $row['puntuacion_promedio'];
        $id_producto = $row['id_paquete'];
        $bolean = $row['paquete'];
        if(!$bolean){
            $datos_hotel = mysqli_query($conexion,"SELECT nombre FROM hoteles WHERE id = '$id_producto'");
            $nombre_producto = mysqli_fetch_assoc($datos_hotel)['nombre'];
            echo $nombre_producto.'<br>'.$promedio;
        }

    } 
    // echo 'si';
?>
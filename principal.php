<?php
    include 'bd.php';
    $actualizar = mysqli_query($conexion, "CALL actualizar_promedio");
    $hoteles_10 = mysqli_query($conexion, "CALL 10_hoteles");
    $paquetes_10 = mysqli_query($conexion, "CALL 10_paquetes");
    while($row = mysqli_fetch_assoc($hoteles_10)){
        $id_hotel = $row['id'];
        $nombre = $row['nombre'];
        $promedio = $row['calificacion_promedio'];
        echo 'Nombre del hotel :'.'<a href="hotelesYpaquetes.php?id=' . $id_hotel . '">' . $nombre . '</a><br> ' .'Promedio de calificaciones :'. $promedio . '<br>';
        
    }
    while($row = mysqli_fetch_assoc($paquetes_10)){
        $id_paquete = $row['id'];
        $nombre = $row['nombre'];
        $promedio = $row['calificacion_promedio'];
        echo 'Nombre del hotel :'.'<a href="hotelesYpaquetes.php?id=' . $id_paquete . '">' . $nombre . '</a><br> ' .'Promedio de calificaciones :'. $promedio . '<br>';
        
    }
?>

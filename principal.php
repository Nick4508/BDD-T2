<?php
    include 'bd.php';
    include 'header.php';
   
    $top4 = mysqli_query($conexion,"CALL 4mayores");
    if($top4){
        while($row = mysqli_fetch_assoc($top4)){
            $id = $row['id'];
            $nombre = $row['nombre'];
            $cantidad = $row['cantidad'];
            $tipo = $row['tipo'];
            if($tipo == 'hoteles'){$tipo = 'hotel';}
            echo 'Aun nos quedan '.$cantidad.' de este '.$tipo.'<br>';
            echo 'Nombre del hotel :'.'<a href="hotelesYpaquetes.php?id=' . $id . '">' . $nombre.'</a><br> ';
        }
        echo '<br>';
    }
    while (mysqli_next_result($conexion)) {
        if ($result = mysqli_store_result($conexion)) {
            mysqli_free_result($result);
        }
    }


    $actualizar = mysqli_query($conexion, "CALL actualizar_promedio");
    $hoteles_10 = mysqli_query($conexion, "CALL 10_hoteles");
    if($hoteles_10){

        while($row = mysqli_fetch_assoc($hoteles_10)){
            $id_hotel = $row['id'];
            $nombre = $row['nombre'];
            $promedio = $row['calificacion_promedio'];
            echo 'Nombre del hotel :'.'<a href="hotelesYpaquetes.php?id=' . $id_hotel . '">' . $nombre . '</a><br> ' .'Promedio de calificaciones :'. $promedio . '<br>';
            
        }
        while (mysqli_next_result($conexion)) {
            if ($result = mysqli_store_result($conexion)) {
                mysqli_free_result($result);
            }
        }
    
        $paquetes_10 = mysqli_query($conexion, "CALL 10_paquetes");
        if($paquetes_10){
            while($row = mysqli_fetch_assoc($paquetes_10)){
                $id_paquete = $row['id'];
                $nombre = $row['nombre'];
                $promedio = $row['calificacion_promedio'];
                echo 'Nombre del Paquete :'.'<a href="hotelesYpaquetes.php?id=' . $id_paquete . '">' . $nombre . '</a><br> ' .'Promedio de calificaciones :'. $promedio . '<br>';
                    
            }

        }
    }
?>
<div class="px-4">

<?php
    include 'bd.php';
    include 'header.php';
    if(isset($_SESSION['usuario'])){
        if(!isset($_SESSION['codigo'])){
            $num = rand(1,10);
            if($num <= 3){
                echo '<br>***************<br>
                Obtuviste un codigo de descuento quieres obtenerlo?'
                ?>
                <form action="descuento.php" method="GET">
                    <input type="hidden" name="descuento" value="<?php echo 1; ?>">
                    <button type="submit" name="boton2">SI</button>
                </form>
                <form action="descuento.php" method="GET">
                    <input type="hidden" name="descuento" value="<?php echo 0; ?>">
                    <button type="submit" name="boton2">NO</button>
                </form>
                <?php
                echo '<br>***************<br>';
                
            }
        }
    }
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
            $promedio = number_format($promedio,2);
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
                $promedio = number_format($promedio,2);
                echo 'Nombre del Paquete :'.'<a href="hotelesYpaquetes.php?id=' . $id_paquete . '">' . $nombre . '</a><br> ' .'Promedio de calificaciones :'. $promedio . '<br>';
                    
            }

        }
    }
?>
</div>
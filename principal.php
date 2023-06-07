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
    $top4 = mysqli_query($conexion,"SELECT * FROM  mayores");
    ?><h3>Nuestros productos con mayor disponibilidad </h3> <?php
    if($top4){
        ?> 
        <div class="row">
        
        <?php
        while($row = mysqli_fetch_assoc($top4)){
            $id = $row['id'];
            $nombre = $row['nombre'];
            $cantidad = $row['cantidad'];
            $tipo = $row['tipo'];
            if($tipo == 'hoteles'){$tipo = 'hotel';}else{$tipo = 'paquete';}
            
            ?>
            <div class="col-sm">    
            <div class="card border-dark">
                <div class="card-body ">
                <img src="imagenes/<?php echo $id?>.jpg" class="img-fluid rounded-start" alt="...">
                <!-- <img src="..." class="card-img-top" alt="..."> -->
                <h5 class="card-title "><?php echo $nombre  ?></h5>
                <p class="card-text"><?php echo 'Cantidad : '.$cantidad.''?> </p>
                <a href="hotelesYpaquetes.php?id=<?php echo $id; ?>" class="btn btn-primary">Ir a la página del <?php echo $tipo ?></a>

                </div>
            </div>
            </div>
        <?php   
        }
    }
    ?>
        </div>
    <?php
    while (mysqli_next_result($conexion)) {
        if ($result = mysqli_store_result($conexion)) {
            mysqli_free_result($result);
        }
    }


    $actualizar = mysqli_query($conexion, "CALL actualizar_promedio");
    $hoteles_10 = mysqli_query($conexion, "CALL 10_hoteles");
    if($hoteles_10){
        ?> <h3>Nuestros Hoteles mejor valorados</h3> <?php
        $data = [];
        $data2 = [];
        $contador = 0; 
        while($row = mysqli_fetch_assoc($hoteles_10)){
            $id_hotel = $row['id'];
            $nombre = $row['nombre'];
            $promedio = $row['calificacion_promedio'];
            $promedio = number_format($promedio,2);
            $filas = array('nombre' => $nombre,'promedio'=> $promedio,'id' => $id_hotel);
            if($contador<5){$data[] = $filas;}else{$data2[] = $filas;}
            $contador++;
        }
        ?>

        <div class="row">
        <?php
        foreach ($data as $contador => $filas) {
            $nombre = $filas['nombre'];
            $promedio = $filas['promedio'];
            $id_hotel = $filas['id'];
            ?>
            <div class="col-sm">    
            <div class="card border-dark">
                <div class="card-body">
                <img src="imagenes/<?php echo $id_hotel?>.jpg" class="img-fluid rounded-start" alt="...">

                <h5 class="card-title"><?php echo $nombre  ?></h5>
                <p class="card-text"><?php echo 'Promedio : '.$promedio.''?> </p>
                <a href="hotelesYpaquetes.php?id=<?php echo $id_hotel; ?>" class="btn btn-primary">Ir a la página del hotel</a>

                </div>
            </div>
            </div>
        <?php   
        }
        ?>
        </div>
        <div class="row">
        <?php
        foreach ($data2 as $contador => $filas) {
            $nombre = $filas['nombre'];
            $promedio = $filas['promedio'];
            $id_hotel = $filas['id'];
            ?>
            <div class="col-sm">    
            <div class="card border-dark">
                <div class="card-body">
                <img src="imagenes/<?php echo $id_hotel?>.jpg" class="img-fluid rounded-start" alt="...">
                <!-- <img src="..." class="card-img-top" alt="..."> -->
                <h5 class="card-title"><?php echo $nombre  ?></h5>
                <p class="card-text"><?php echo 'Promedio : '.$promedio.''?> </p>
                <a href="hotelesYpaquetes.php?id=<?php echo $id_hotel; ?>" class="btn btn-primary">Ir a la página del hotel</a>

                </div>
            </div>
            </div>
        <?php   
        }
        ?>
        </div>
        <?php














        
        while (mysqli_next_result($conexion)) {
            if ($result = mysqli_store_result($conexion)) {
                mysqli_free_result($result);
            }
        }
    
        $paquetes_10 = mysqli_query($conexion, "CALL 10_paquetes");
        ?> <h3>Nuestros Paquetes mejor valorados</h3> <?php
        if($paquetes_10){

        
        $data = [];
        $data2 = [];
        $contador = 0; 
        while($row = mysqli_fetch_assoc($paquetes_10)){
            $id_hotel = $row['id'];
            $nombre = $row['nombre'];
            $promedio = $row['calificacion_promedio'];
            $promedio = number_format($promedio,2);
            $filas = array('nombre' => $nombre,'promedio'=> $promedio,'id' => $id_hotel);
            if($contador<5){$data[] = $filas;}else{$data2[] = $filas;}
            $contador++;
        }
        ?>
        <div class="row">
        <?php
        foreach ($data as $contador => $filas) {
            $nombre = $filas['nombre'];
            $promedio = $filas['promedio'];
            $id_hotel = $filas['id'];
            ?>
            <div class="col-sm">    
            <div class="card border-dark">
                <div class="card-body">
                <img src="imagenes/<?php echo $id_hotel?>.jpg" class="img-fluid rounded-start" alt="...">

                <h5 class="card-title"><?php echo $nombre  ?></h5>
                <p class="card-text"><?php echo 'Promedio : '.$promedio.''?> </p>
                <a href="hotelesYpaquetes.php?id=<?php echo $id_hotel; ?>" class="btn btn-primary">Ir a la página del Paquete</a>

                </div>
            </div>
            </div>
        <?php   
        }
        ?>
        </div>
        <div class="row">
        <?php
        foreach ($data2 as $contador => $filas) {
            $nombre = $filas['nombre'];
            $promedio = $filas['promedio'];
            $id_hotel = $filas['id'];
            ?>
            <div class="col-sm">    
            <div class="card border-dark">
                <div class="card-body">
                <img src="imagenes/<?php echo $id_hotel?>.jpg" class="img-fluid rounded-start" alt="...">
                <!-- <img src="..." class="card-img-top" alt="..."> -->
                <h5 class="card-title"><?php echo $nombre  ?></h5>
                <p class="card-text"><?php echo 'Promedio : '.$promedio.''?> </p>
                <a href="hotelesYpaquetes.php?id=<?php echo $id_hotel; ?>" class="btn btn-primary">Ir a la página del Paquete</a>

                </div>
            </div>
            </div>
        <?php   
        }
        ?>
        </div>
        
        <?php
        }
    }
?>
</div>
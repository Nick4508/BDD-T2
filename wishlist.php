<div class="px-4">

<?php
    include 'bd.php';
    session_start();
    ?> <h3 > Wishlist de <?php echo $_SESSION['nombre'] ?></h3> <?php
    $id = $_SESSION['usuario'];
    $whislist = mysqli_query($conexion,"SELECT * FROM wishlist WHERE id_usuario = '$id'");
        if(mysqli_num_rows($whislist)> 0){
            ?>
            <?php
            while($row = mysqli_fetch_assoc($whislist)){
                $promedio = $row['puntuacion_promedio'];
                $id_producto = $row['id_paquete'];
                $bolean = $row['paquete'];
                ?>
                <div class="card mb-3" style="max-width: 540px;">
                 <div class="row g-0">
                    <div class="col-md-4">
                    <img src="imagenes/<?php echo $id_producto?>.jpg" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                    <div class="card-body">
                <?php
                if(!$bolean){
                    $datos_hotel = mysqli_query($conexion,"SELECT nombre FROM hoteles WHERE id = '$id_producto'");
                    $nombre_producto = mysqli_fetch_assoc($datos_hotel)['nombre'];
                    ?>
                        <p class="card-text">Nombre : <?php echo '<a href="hotelesYpaquetes.php?id='.$id_producto.'">'.$nombre_producto.'</a>'?></p>
                        <p class="card-text"><small >Promedio : <?php echo $promedio; ?></small></p>
                    <?php
                }else{
                    $datos_paquete = mysqli_query($conexion,"SELECT nombre FROM paquetes WHERE id = '$id_producto'");
                    $nombre_producto = mysqli_fetch_assoc($datos_paquete)['nombre'];
                    ?>
                        <p class="card-text">Nombre : <?php echo '<a href="hotelesYpaquetes.php?id='.$id_producto.'">'.$nombre_producto.'</a>'?></p>
                        <p class="card-text"><small >Promedio : <?php echo $promedio; ?></small></p>
                    <?php
                }
                ?>


                <form action="delete_wishlist.php" method="get" style="display: inline;">
                    <input type="hidden" name="id_producto" value="<?php echo $id_producto; ?>">
                    <button type="submit">Eliminar</button>
                </form>
                    </div>
                    </div>
                </div>
                </div>
        <?php
            }
            ?>
            <?php
        }else{
            ?>
            <img src="imagenes/noWishlist.jpg" >
            <?php
        }
        echo '<br>';
?>
<div class="button-group">    
        
        <button onclick="window.location.href='principal.php'">Volver</button>
        </div>
</div>
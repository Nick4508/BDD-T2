<div class="px-4">

<?php
    include 'bd.php';
    session_start();
    ?> <h3 > Wishlist de <?php echo $_SESSION['nombre'] ?></h3> <?php
    $id = $_SESSION['usuario'];
    $whislist = mysqli_query($conexion,"SELECT * FROM wishlist WHERE id_usuario = '$id'");
        if(mysqli_num_rows($whislist)> 0){

            while($row = mysqli_fetch_assoc($whislist)){
                $promedio = $row['puntuacion_promedio'];
                $id_producto = $row['id_paquete'];
                $bolean = $row['paquete'];
                if(!$bolean){
                    $datos_hotel = mysqli_query($conexion,"SELECT nombre FROM hoteles WHERE id = '$id_producto'");
                    $nombre_producto = mysqli_fetch_assoc($datos_hotel)['nombre'];
                    echo 'Nombre : '.'<a href="hotelesYpaquetes.php?id='.$id_producto.'">'.$nombre_producto.'</a><br>Puntuacion :'.$promedio.'<br>';
                }else{
                    $datos_paquete = mysqli_query($conexion,"SELECT nombre FROM paquetes WHERE id = '$id_producto'");
                    $nombre_producto = mysqli_fetch_assoc($datos_paquete)['nombre'];
                    echo 'Nombre : '.'<a href="hotelesYpaquetes.php?id='.$id_producto.'">'.$nombre_producto.'</a><br>Puntuacion :'.$promedio.'<br>';
                }
                ?>
                <form action="delete_wishlist.php" method="get" style="display: inline;">
                    <input type="hidden" name="id_producto" value="<?php echo $id_producto; ?>">
                    <button type="submit">☠</button>
                </form>
        <?php
                echo'<br>⛩⛩⛩⛩⛩⛩⛩⛩⛩⛩⛩⛩⛩⛩⛩⛩⛩⛩⛩ <br>';
            }
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
<div class="px-4">
  
  <?php
    include 'bd.php';
    include 'header.php';
    
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        if($id >=1000 && $id <2000){
            $data = mysqli_query($conexion,"SELECT * FROM hoteles WHERE id= '$id'");
            if($data){
                ?>
                <h3>Datos hotel</h3>
                <?php
                while($row = mysqli_fetch_assoc($data)){
                    $nombre = $row['Nombre'];
                    $estrellas = $row['cant_estrellas'];
                    $precio_noche = $row['precio_noche'];
                    $ciudad = $row['ciudad'];
                    $estacionamiento = $row['estacionamiento'];
                    $piscina = $row['piscina'];
                    $lavanderia = $row['lavanderia'];
                    $friendly = $row['pet_friendly'];
                    echo '
                    Hotel: '.$nombre.'<br>
                    Estrellas: '.$estrellas.'<br>
                    Precio por noche: $'.$precio_noche.'<br>
                    Ubicación: '.$ciudad.'<br>
                    Estacionamiento: '.($estacionamiento ? '✔' : '❌').'<br>
                    Piscina: '.($piscina ? '✔' : '❌').'<br>
                    Lavanderia: '.($lavanderia ? '✔' : '❌').'<br>
                    Pet Friendly: '.($friendly ? '✔' : '❌').'<br>';
                }
            }
        }elseif($id>=2000){
            $hotel = mysqli_query($conexion,"SELECT nombre,ciudad FROM hospedaje_paquetes WHERE id_paquete = '$id'");
            $paquetes = mysqli_query($conexion,"SELECT * FROM paquetes WHERE id = '$id'");
            if($paquetes){
                ?>
                <h3>Datos hotel</h3>
                <?php
                while($row = mysqli_fetch_assoc($paquetes)){
                    $nombre = $row['nombre'];
                    $ida = $row['aerolinea_ida'];
                    $vuelta = $row['aerolinea_vuelta'];
                    $precio = $row['precio_persona'];
                    $max_personas = $row['max_personas'];
                    echo'   
                    Nombre del paquete :'.$nombre.'<br>
                    Aerolinea de ida :'.$ida.'<br>
                    Aerolinea de vuelta :'.$vuelta.'<br>
                    Precio por persona : $'.$precio.'<br>
                    Maximo de personas en el paquete :'.$max_personas.'<br>';
                    if($hotel){
                        echo '<br>Hoteles asociados : <br>'; 
                        while($row = mysqli_fetch_assoc($hotel)){
                            $nombre2 = $row['nombre'];
                            $ciudad = $row['ciudad'];
                            echo' 
                            Nombre del hotel :'.$nombre2.'<br>
                            Ciudad del hotel :'.$ciudad.'<br>';
                        }
                    }
                }
            }
        }
    }
    if($_SERVER['REQUEST_METHOD']=='POST'){
        
        if(isset($_POST['boton2'])){
            
        }
    }
    ?>

<!DOCTYPE html>
<html>
    
    <body>
        <td>
            <form action="agregar_carrito.php" method="GET">
                <input type="hidden" name="id_hotel" value="<?php echo $_GET['id']; ?>">
                <button type="submit">🛒</button>
            </form>
        </td>
        <form action="wishlist.php" method="GET">
            <input type="hidden" name="id_hotel" value="<?php echo $_GET['id']; ?>">
            <button type="submit" name="boton2">Whishlist</button>
    </form>
</body>
</html>

<?php
    $id = $_GET['id'];
    if($id >=1000 && $id <2000){
        $query = mysqli_query($conexion,"SELECT * FROM resena_hotel WHERE id_hotel = '$id'");
        ?><h4>Reseñas y calificaciones:</h4><?php
        if(mysqli_num_rows($query)>0){
            while($row = mysqli_fetch_assoc($query)){
                $limpieza = $row['limpieza'];
                $servicio = $row['servicio'];
                $decoracion = $row['decoracion'];
                $camas = $row['camas'];
                $promedio = $row['promedio'];
                $opinion = $row['opinion'];
            ?>
                <div class="card border-dark mb-3" style="max-width: 18rem;">
                    <div class="card-body text-dark">
                        <h5 class="card-title">Promedio : <?php echo $promedio?></h5>
                        <p class="card-text">
                            <?php echo'
                        Limpieza: '.$limpieza.'<br>
                        Servicio: '.$servicio.'<br>
                        Decoracion: '.$decoracion.'<br>
                        Camas: '.$camas.'<br>
                        ';
                        if(!is_null($opinion)){echo $opinion;}?></p>
                </div>
                </div>
            <?php }

        }

    }elseif($id >=2000){
        $query = mysqli_query($conexion,"SELECT * FROM resena_paquete WHERE id_paquete = '$id'");
        ?><h4>Reseñas y calificaciones:</h4><?php
        if(mysqli_num_rows($query)>0){
            while($row = mysqli_fetch_assoc($query)){
                $calidad = $row['calidad'];
                $transporte = $row['transporte'];
                $servicio = $row['servicio'];
                $promedio =$row['promedio'];
                $calidad_precio = $row['calidad_precio'];
                $opinion = $row['opinion'];
            ?>
                <div class="card border-dark mb-3" style="max-width: 18rem;">
                    <div class="card-body text-dark">
                        <h5 class="card-title">Promedio : <?php echo $promedio?></h5>
                        <p class="card-text">
                            <?php echo'
                        Calidad: '.$calidad.'<br>
                        Transporte: '.$transporte.'<br>
                        Servicio: '.$servicio.'<br>
                        Calidad_precio: '.$calidad_precio.'<br>
                        ';
                        if(!is_null($opinion)){echo $opinion;}?></p>
                </div>
                </div>
            <?php }
        }    
    }
?>
</div>
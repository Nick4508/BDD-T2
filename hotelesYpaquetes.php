<?php
    include 'bd.php';
    include 'header.php';

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        if($id >=1000 && $id <2000){
            $data = mysqli_query($conexion,"SELECT * FROM hoteles WHERE id= '$id'");
            if($data){
                while($row = mysqli_fetch_assoc($data)){
                    $nombre = $row['Nombre'];
                    $estrellas = $row['cant_estrellas'];
                    $precio_noche = $row['precio_noche'];
                    $ciudad = $row['ciudad'];
                    $estacionamiento = $row['estacionamiento'];
                    $piscina = $row['piscina'];
                    $lavanderia = $row['lavanderia'];
                    $friendly = $row['pet_friendly'];
                    echo 'Hotel: '.$nombre.'<br>'
                    .'Estrellas: '.$estrellas.'<br>'.
                    'Precio por noche: $'.$precio_noche.'<br>'.
                    'Ubicación: '.$ciudad.'<br>'.
                    'Estacionamiento: '.($estacionamiento ? '✔' : '❌').'<br>'.
                    'Piscina: '.($piscina ? '✔' : '❌').'<br>'.
                    'Lavanderia: '.($lavanderia ? '✔' : '❌').'<br>'
                    .'Pet Friendly: '.($friendly ? '✔' : '❌').'<br>';
                }
            }
        }elseif($id>=2000){
            $hotel = mysqli_query($conexion,"SELECT nombre,ciudad FROM hospedaje_paquetes WHERE id_paquete = '$id'");
            $paquetes = mysqli_query($conexion,"SELECT * FROM paquetes WHERE id = '$id'");
            if($paquetes){
                while($row = mysqli_fetch_assoc($paquetes)){
                    $nombre = $row['nombre'];
                    $ida = $row['aerolinea_ida'];
                    $vuelta = $row['aerolinea_vuelta'];
                    $precio = $row['precio_persona'];
                    $max_personas = $row['max_personas'];
                    if($hotel){
                        while($row = mysqli_fetch_assoc($hotel)){
                            $nombre2 = $row['nombre'];
                            $ciudad = $row['ciudad'];
                            echo $nombre2.' '.$ciudad.'<br>';
                        }
                    }
                    echo $nombre.'<br>'.$ida.'<br>'.$vuelta.'<br>'.$precio.'<br>'.$max_personas.'<br>';
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
        <!-- Botón 1 -->
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

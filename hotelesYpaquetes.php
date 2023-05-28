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
                    echo 'Id: '.$id.'<br>'.'Hotel: '.$nombre.'<br>'.'Estrellas: '.$estrellas.'<br>'.'Precio por noche: '.$precio_noche.'<br>'.'Ubicación: '.$ciudad.'<br>'.'Número de estacionamientos: '.$estacionamiento.'<br>'.'Piscinas: '.$piscina.'<br>'.'Lavanderia: '.$lavanderia.'<br>'.'Pet Friendly: '.$friendly.'<br>';
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
        if(isset($_POST['boton1'])){
            
        }elseif(isset($_POST['boton2'])){

        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Simulando Botones con PHP</title>
</head>
<body>
        <!-- Botón 1 -->
        <td><a href="agregar_carrito.php?id_hotel=<?php echo $_GET['id']; ?>">Agregar al carrito </a></td>
        <!-- Botón 2 -->
        <button type="submit" name="boton2">Whishlist</button>
    </form>
</body>
</html>

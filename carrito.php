<?php
    include "bd.php";
    session_start();
    ?>
    <h2>Carrito de <?php echo $_SESSION['nombre']; ?></h2>
    <?php
    $descuento = 0.1;
    if (!$_SESSION['codigo']){
        $descuento = 0;
    }
    $id_usuario = $_SESSION['usuario'];
    $total = 0;
    $data = mysqli_query($conexion,"SELECT id_producto,cantidad FROM carrito WHERE id_usuario ='$id_usuario'");
    if(mysqli_num_rows($data)>0){
        while($row = mysqli_fetch_assoc($data)){
            $producto = $row['id_producto'];
            $cantidad = $row['cantidad'];
            if($producto >=1000 && $producto <2000){
                $hoteles = mysqli_query($conexion,"SELECT precio_noche,nombre FROM hoteles WHERE id = '$producto'");
                while($filas = mysqli_fetch_assoc($hoteles)){
                    $precio_noche = $filas['precio_noche'];
                    $nombre = $filas['nombre'];
                    $total = $total + ($precio_noche * $cantidad);
                    echo '
                    Nombre : '.$nombre.'<br>
                    Precio : $'.$precio_noche.'<br>
                    Cantidad : '. $cantidad.'<br>
                    ';
                }
                ?>
                    <form action="update_carrito.php" method="get" style="display: inline;">
                    <input type="hidden" name="id_producto" value="<?php echo $producto; ?>">
                    <input type="hidden" name="cantidad" value="<?php echo $cantidad;?>">
                    <input type="hidden" name="parametro" value="1">

                    <button type="submit">+1</button>
                    </form>

                    <form action="update_carrito.php" method="get" style="display: inline;">
                    <input type="hidden" name="id_producto" value="<?php echo $producto; ?>">
                    <input type="hidden" name="cantidad" value="<?php echo $cantidad;?>">
                    <input type="hidden" name="parametro" value="0">
                    <button type="submit">-1</button>
                    </form>

                    <form action="delete_carrito.php" method="get" style="display: inline;">
                    <input type="hidden" name="id_producto" value="<?php echo $producto; ?>">
                    <button type="submit">Eliminar</button>
                    </form>

                <?php
                echo '<br>-----------------<br>';
                //botones 
            }elseif($producto >= 2000){
                $paquetes = mysqli_query($conexion,"SELECT nombre,precio_persona,max_personas FROM paquetes WHERE id = '$producto'");
                while($filas = mysqli_fetch_assoc($paquetes)){
                    $nombre = $filas['nombre'];
                    $precio_persona = $filas['precio_persona'];
                    $personas = $filas['max_personas'];
                    $total_producto = $precio_persona*$personas;
                    $total = $total + ($total_producto)*$cantidad;
                    echo'
                    Nombre : '.$nombre.'<br>
                    Precio por persona : $'. $precio_persona.'<br>
                    Personas maximas por paquete : '.$personas.'<br>
                    Precio total : $'.$total_producto.'<br>
                    Cantidad : '. $cantidad.'<br>
                    ';
                }?>
                <form action="update_carrito.php" method="get" style="display: inline;">
                <input type="hidden" name="id_producto" value="<?php echo $producto; ?>">
                <input type="hidden" name="parametro" value="1">
                <input type="hidden" name="cantidad" value="<?php echo $cantidad;?>">
                <button type="submit">+1</button>
                </form>

                <form action="update_carrito.php" method="get" style="display: inline;">
                <input type="hidden" name="id_producto" value="<?php echo $producto; ?>">
                <input type="hidden" name="cantidad" value="<?php echo $cantidad;?>">
                <input type="hidden" name="parametro" value="0">
                <button type="submit">-1</button>
                </form>

                <form action="delete_carrito.php" method="get" style="display: inline;">
                <input type="hidden" name="id_producto" value="<?php echo $producto; ?>">
                <button type="submit">Eliminar</button>
                </form>
                <?php
                echo '<br>-----------------<br>';
            }
        }
        echo 'Total sin descuento : $'. $total.'<br>
            Total con descuento ('.$descuento* 100 .'%): $'. $total - ($total*$descuento).'<br>
        ';
    }
    else{
        echo '
            <script>
                alert("No tienes productos en tu carrito de compras, añade alguno para visualizarlos");
                window.location = "principal.php";
            </script>
        ';
        exit();
    }
?>

<!DOCTYPE html>
<html>
<body>
    <div class="button-group">    
        
    <button onclick="window.location.href='comprar.php'">Comprar</button>
    <button onclick="window.location.href='principal.php'">Volver</button>
    </div>
</body>
</html>
<?php
    include "bd.php";
    include "header.php";

    
    if(isset($_SESSION['usuario'])){
        $nombreUsuario = $_SESSION['nombre'];
        $usuarioAutenticado = true;
        $id_usuario = $_SESSION['usuario'];
    }

    $query = mysqli_query($conexion, "SELECT * FROM compras WHERE id_usuario = '$id_usuario'");


    if($query){
        while($row = mysqli_fetch_assoc($query)){
            $id_compra = $row['id_compra'];
            $id_producto = $row['id_producto'];
            $cantidad = $row['cantidad'];            
            if($id_producto >=1000 && $id_producto <2000){
                $query4 = mysqli_query($conexion, "SELECT Nombre FROM hoteles WHERE id = '$id_producto'");
                $name = mysqli_fetch_assoc($query4)['Nombre'];
                echo '<br>HOTEL: <br>';
                echo '<a href="hotelesYpaquetes.php?id='.$id_producto.'">'.$name.'</a><br>';
                // echo 'Numero de identificacion de la compra: '.$id_compra.'<br>'.'Nombre de identificacion del producto: '.'<a href="hotelesYpaquetes.php?id='.$id_producto.'">'.$name.'</a><br>';
                
                ?>
                <form action="resena.php" method="get" style="display: inline;">

                    <input type="hidden" name="id_producto" value="<?php echo $id_producto; ?>">
                    <button type="submit">RESEÑAR HOTEL</button>
                </form>
                <form action="calificar_hotel.php" method="get" style="display: inline;">
                    <input type="hidden" name="id_producto" value="<?php echo $id_producto; ?>">
                    <button type="submit">CALIFICAR HOTEL</button>
                </form>
            <?php
            }elseif($id_producto >= 2000){
                $query4 = mysqli_query($conexion, "SELECT nombre FROM paquetes WHERE id = '$id_producto'");
                $name = mysqli_fetch_assoc($query4)['nombre'];
                echo '<br>PAQUETE: <br>';
                echo '<a href="hotelesYpaquetes.php?id='.$id_producto.'">'.$name.'</a><br>';
                ?>
                <form action="resena_paquete.php" method="get" style="display: inline;">
                    <input type="hidden" name="id_producto" value="<?php echo $id_producto; ?>">
                    <button type="submit">RESEÑAR PAQUETE</button>
                </form>
                <form action="calificar_paquete.php" method="get" style="display: inline;">
                    <input type="hidden" name="id_producto" value="<?php echo $id_producto; ?>">
                    <button type="submit">CALIFICAR PAQUETE</button>
                </form>
                <?php echo '<br>';
            }
        }
    }
?>
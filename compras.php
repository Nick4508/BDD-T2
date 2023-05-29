<?php
    include "bd.php";
    session_start();
    
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

            echo 'Numero de identificacion de la compra: '.$id_compra.'<br>'.'Numero de identificacion del producto: '.$id_producto.'<br>'.'Cantidad de productos: '.$cantidad.'<br>';
        
        }
    }
    echo'chupa chupa'

?>
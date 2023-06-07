<?php 
    include 'bd.php';
    session_start();
    $id = $_SESSION['usuario'];
    $id_producto = $_POST['id_producto'];
    $limpieza = $_POST['limpieza'];
    $servicio = $_POST['servicio'];
    $decoracion = $_POST['decoracion'];
    $camas = $_POST['camas'];

    $query = $conexion->prepare("UPDATE resena_hotel SET limpieza=?,servicio=?,decoracion=?,camas=? WHERE id_usuario =? and id_hotel =?");
    $query->bind_param('iiiiii',$limpieza,$servicio,$decoracion,$camas,$id,$id_producto);
    if($query->execute()){
        echo '
        <script>
            alert("Se actualizó tu calificacion del hotel");
            window.location = "usuario.php";
        </script>
    ';
    }
?>
<?php 
    include 'bd.php';
    session_start();
    $id = $_SESSION['usuario'];
    $limpieza = $_POST['limpieza'];
    $servicio = $_POST['servicio'];
    $decoracion = $_POST['decoracion'];
    $camas = $_POST['camas'];

    $query = $conexion->prepare("UPDATE resena_hotel SET limpieza=?,servicio=?,decoracion=?,camas=? WHERE id_usuario =?");
    $query->bind_param('iiiii',$limpieza,$servicio,$decoracion,$camas,$id);
    if($query->execute()){
        echo '
        <script>
            alert("Se actualizó tu calificacion del hotel");
            window.location = "usuario.php";
        </script>
    ';
    }
?>
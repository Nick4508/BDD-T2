<?php 
    include 'bd.php';
    session_start();
    $id = $_SESSION['usuario'];
    $id_producto = $_POST['id_producto'];
    $calidad = $_POST['calidad'];
    $transporte = $_POST['transporte'];
    $servicio = $_POST['servicio'];
    $calidad_precio = $_POST['calidad_precio'];

    $query = $conexion->prepare("UPDATE resena_paquete SET calidad=?,transporte=?,servicio=?,calidad_precio=? WHERE id_usuario =? and id_paquete = ?");
    $query->bind_param('iiiiii',$calidad,$transporte,$servicio,$calidad_precio,$id,$id_producto);
    if($query->execute()){
        echo '
        <script>
            alert("Se actualizó tu calificacion del paquete");
            window.location = "usuario.php";
        </script>
    ';
    }
?>
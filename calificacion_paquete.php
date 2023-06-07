<?php 
    include 'bd.php';
    session_start();
    $id = $_SESSION['usuario'];
    $calidad = $_POST['calidad'];
    $transporte = $_POST['transporte'];
    $servicio = $_POST['servicio'];
    $calidad_precio = $_POST['calidad_precio'];

    $query = $conexion->prepare("UPDATE resena_paquete SET calidad=?,transporte=?,servicio=?,calidad_precio=? WHERE id_usuario =?");
    $query->bind_param('iiiii',$calidad,$transporte,$servicio,$calidad_precio,$id);
    if($query->execute()){
        echo '
        <script>
            alert("Se actualizó tu calificacion del paquete");
            window.location = "usuario.php";
        </script>
    ';
    }
?>
<?php 
    include 'bd.php';
    session_start();
    $id = $_SESSION['usuario'];
    $opinion = $_POST['opinion'];
    $id_producto = $_POST['id_producto'];
    $query = $conexion->prepare("UPDATE resena_paquete SET opinion = ? WHERE id_usuario =? and id_paquete =?");
    $query->bind_param('sii',$opinion,$id,$id_producto);
    if($query->execute()){
        echo '
        <script>
            alert("Se actualizó tu opinion del paquete");
            window.location = "usuario.php";
        </script>
    ';
    }
?>
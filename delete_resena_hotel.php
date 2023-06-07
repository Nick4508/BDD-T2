<div class="px-4">
<?php 
    include 'bd.php';
    session_start();
    $id_usuario = $_SESSION['usuario'];
    $id_producto = $_GET['id'];

    $query = $conexion->prepare("UPDATE resena_hotel SET opinion = '' WHERE id_usuario = $id_usuario and id_hotel = $id_producto");
    $query->execute();
    echo '
    <script>
        alert("Se eliminó tu opinion de este hotel");
        window.location = "usuario.php";
    </script>
';
?>
</div>
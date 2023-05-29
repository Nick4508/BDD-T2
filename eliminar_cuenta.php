<?php
    include 'bd.php';
    session_start();

    $id = $_SESSION['usuario'];
    $query = $conexion->prepare("DELETE FROM usuarios WHERE id = '$id'");
    $query->execute();
    session_destroy();
    echo '
        <script>
            alert("Se ha eliminado tu cuenta");
            window.location = "principal.php";
        </script>
    ';
?>
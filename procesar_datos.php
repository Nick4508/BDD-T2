<?php
    include 'bd.php';
    session_start();
    $id = $_SESSION['usuario'];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $contrasena = $_POST['contrasena'];
        $fecha = $_POST['fecha_nacimiento'];
        $query = $conexion->prepare("UPDATE usuarios SET nombre = '$nombre', 
        correo = '$email', fecha_nacimiento = '$fecha', contrasena = '$contrasena' WHERE id = '$id' ");
        $query->execute();
        echo '
                <script>
                    alert("Tus datos fueron actualizados");
                    window.location = "usuario.php";
                </script>
            ';

    }

?>
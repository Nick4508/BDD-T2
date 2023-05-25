<?php
    include '../bd.php'

    $mail = $_POST['mail'];
    $usuario = $_POST['usuario'];
    $fecha = $_POST['fecha'];
    $contrasena = $_POST['contrasena'];

    $consulta1 = "INSERT INTO usuarios(mail, usuario, fecha, contrasena) VALUES('mail','usuario','fecha','contrasena')";

    $verificacion_usr = mysqli_query($conexion, "SELECT * FROM usuarios WHERE usuario = '$usuario' ");
    if(mysqli_num_rows($verificacion_usr) > 0){
        echo '
            <script>
                alert("Este nombre de usuario no se encuentra disponible");
                windows.location = "index.php";
            </script>
        ';
        exit();
    }

    $verificacion_mail = mysqli_query($conexion, "SELECT * FROM usuarios WHERE mail = '$mail' ");
    if(mysqli_num_rows($verificacion_usr) > 0){
        echo '
            <script>
                alert("Esta dirección de mail electrónico no se encuentra disponible");
                windows.location = "index.php";
            </script>
        ';
        exit();
    }

    $proceso = mysqli_query($conexion, $consulta1);

    if($proceso){
        echo '
            <script>
                alert("El usuario fue registrado");
                windows.location = "index.php";
            </script>
        ';
    } else {
        echo '
            <script>
                alert("¡ERROR!, No se ha podido registrar el usuario, intentelo de nuevo");
                windows.location = "index.php";
            </script>
        ';
    }

    mysqli_close($conexion);
?>
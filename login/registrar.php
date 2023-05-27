<?php
    include '../bd.php';

    $mail = $_POST['correo'];
    $usuario = $_POST['nombre'];
    $fecha = $_POST['fecha_nacimiento'];
    $contrasena = $_POST['contrasena'];

    $consulta1 = "INSERT INTO usuarios(nombre, correo, fecha_nacimiento, contrasena) VALUES('$usuario','$mail','$fecha','$contrasena')";

    $verificacion_usr = mysqli_query($conexion, "SELECT * FROM usuarios WHERE nombre = '$usuario' ");
    if(mysqli_num_rows($verificacion_usr) > 0){
        echo '
            <script>
                alert("Este nombre de usuario no se encuentra disponible");
                window.location = "index.php";
            </script>
        ';
        exit();
    }

    $verificacion_mail = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo = '$mail' ");
    if(mysqli_num_rows($verificacion_mail) > 0){
        echo '
            <script>
                alert("Esta dirección de correo electrónico no se encuentra disponible");
                window.location = "index.php";
            </script>
        ';
        exit();
    }

    $proceso = mysqli_query($conexion, $consulta1);

    if($proceso){
        echo '
            <script>
                alert("El usuario fue registrado");
                window.location = "index.php";
            </script>
        ';
    } else {
        echo '
            <script>
                alert("¡ERROR!, No se ha podido registrar el usuario, intentelo de nuevo");
                window.location = "index.php";
            </script>
        ';
    }

    mysqli_close($conexion);
?>
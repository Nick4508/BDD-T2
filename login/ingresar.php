<?php
    session_start();
    include '../bd.php';

    $mail = $_POST['mail'];
    $contrasena = $_POST['contrasena'];

    $verificar_registro = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo = '$mail' and contrasena = '$contrasena'");
    if(mysqli_num_rows($verificar_registro) > 0){
        $fila mysqli_fetch_array($verificar_registro);
        $_SESSION['usuario'] = $fila['id'];
        header ("location: ../home.php")
    }else{
        echo '
            <script>
                alert("No hemos podido verificar el usuario, ingrese los datos correctamente");
                window.location = "index.php";
            </script>
        ';
    }
    mysqli_close($conexion);
?>
<?php
    session_start();
    include '../bd.php';

    $usuario = $_POST['nombre'];
    $contrasena = $_POST['contrasena'];

    $verificar_registro = mysqli_query($conexion, "SELECT * FROM usuarios WHERE nombre = '$usuario' and contrasena = '$contrasena'");
    if(mysqli_num_rows($verificar_registro) > 0){
        $fila = mysqli_fetch_array($verificar_registro);
        $_SESSION['nombre'] = $fila['nombre'];
        $_SESSION['id'] = $fila['id'];
        
        header ("location: ../principal.php");
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
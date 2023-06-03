<div class="px-4">

<?php
    include 'bd.php';
    include 'header.php';

    if(!isset($_SESSION['usuario'])){
        header("location: principal.php");

    }
    $id = $_SESSION['usuario'];
    $data = mysqli_query($conexion,"SELECT * FROM usuarios WHERE id = '$id'");
    ?>
    <title>USUARIO</title>
    <p> Tus Datos </p>
    <?php
    while($row = mysqli_fetch_assoc($data)){
        $nombre = $row['nombre'];
        $correo = $row['correo'];
        $fecha = $row['fecha_nacimiento'];
        echo 'Nombre : '.$nombre.'<br>'.'Correo : '.$correo.'<br>'.'Fecha de nacimiento : '.$fecha.'<br>'; 
    }
    if(isset($_SESSION['codigo'])){
        echo 'Codigo activo :'.($_SESSION['codigo'] ? '✔' : '❌').'<br>';
    }
   

    // echo 'si';
?>
<!DOCTYPE html>
<html>
<body>
    <div class="button-group">
    <button onclick="window.location.href='editar_cuenta.php'">Editar perfil</button>
    <button onclick="window.location.href='login/logout.php'">Cerrar Sesion</button>
    <button onclick="window.location.href='confirmacion.php'">Eliminar cuenta</button>
    </div>
</body>
</html>
</div>
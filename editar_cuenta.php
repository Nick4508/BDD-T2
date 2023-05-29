<?php
    include 'bd.php';
    session_start();
    $id = $_SESSION['usuario'];
    $query = mysqli_query($conexion,"SELECT * FROM usuarios WHERE id = '$id'");
    $data = mysqli_fetch_assoc($query);
    $nombre = $data['nombre'];
    $correo = $data['correo'];
    $contrasena = $data['contrasena'];
    $fecha = $data['fecha_nacimiento'];   
    ?>
    <form method="POST" action="procesar_datos.php">

        <?php echo 'Nombre anterior : '.$nombre.'<br>';?>
        <label for="nombre">Nuevo Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <?php echo '<br><br>';
    
        echo 'Correo anterior : '.$correo.'<br>';?>
        <label for="email">Nuevo Email:</label>
        <input type="email" id="email" name="email" required>
        <?php echo '<br><br>';

        echo 'Contraseña anterior : '.$contrasena.'<br>';?>
        <label for="email">Nueva contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" required>
        <?php echo '<br><br>';

        echo 'Fecha nacimiento anterior : '.$fecha.'<br>';?>
        <label for="fecha">Nueva fecha de nacimiento:</label>
        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>
        <?php echo '<br>'?>
        <input type="submit" value="Enviar">
        
        <button onclick="window.location.href='usuario.php'">Volver</button>


    </form>

 
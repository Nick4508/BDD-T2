<div class="px-4">
<?php 
    include 'bd.php';
    session_start();
    $id_usuario = $_SESSION['usuario'];
    $id_producto = $_GET['id'];
    $query = mysqli_query($conexion,"SELECT opinion FROM resena_paquete WHERE id_usuario = $id_usuario and id_paquete = $id_producto");
    $row = mysqli_fetch_assoc($query)['opinion'];
    echo 'Opinion anterior : '.$row.'<br>'; 
?>
<form action="send_resena_paquete.php" method="post">
<input type="hidden" name="id_producto" value="<?php echo $id_producto; ?>">
  <label for="nombre">Opinion nueva:</label>
  <?php echo '<br>' ?>
  <input type="text" id="nombre" name="opinion" required?>
  <?php echo '<br>' ?>
  <button type="submit">Actualizar</button>   
</form>
<button onclick="window.location.href='usuario.php'">Volver</button>
</div>
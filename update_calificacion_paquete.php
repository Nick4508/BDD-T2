<div class="px-4">

<?php
    include 'bd.php';
    session_start();
    $id = $_SESSION['usuario'];
    $id_producto = $_GET['id'];
    $query = mysqli_query($conexion,"SELECT * FROM resena_paquete WHERE id_usuario = $id");
    $data = mysqli_fetch_assoc($query);
    $calidad = $data['calidad'];
    $transporte = $data['transporte'];
    $servicio = $data['servicio'];
    $calidad_precio = $data['calidad_precio'];   
    echo 'Tus antiguas calificaciones: <br>
    Calidad : '.$calidad.'<br>
    Transporte : '.$transporte.'<br>
    Servicio : '.$servicio.'<br>
    Calidad precio : '.$calidad_precio.'<br>
    Escoge las nuevas calificaciones: 
    '
    ?>



    <form action="calificacion_paquete.php" method="post">
      <label for="atributo1">Calidad:</label>
      <input type="hidden" name="id_producto" value="<?php echo $id_producto; ?>">
  <input type="range" class="custom-range" min="1" max="5" step="1" id="atributo1" name="calidad">
    <?php echo '<br>'?>
  <label for="atributo2">Transporte:</label>
  <input type="range" class="custom-range" min="1" max="5" step="1" id="atributo2" name="transporte">
  <?php echo '<br>'?>

  <label for="atributo3">Servicio :</label>
  <input type="range" class="custom-range" min="1" max="5" step="1" id="atributo3" name="servicio">
  <?php echo '<br>'?>

  <label for="atributo4">Calidad precio:</label>
  <input type="range" class="custom-range" min="1" max="5" step="1" id="atributo4" name="calidad_precio">
  <?php echo '<br>'?>

  <button type="submit">Enviar calificaciones</button>
</form>
<button onclick="window.location.href='usuario.php'">Volver</button>

</div>
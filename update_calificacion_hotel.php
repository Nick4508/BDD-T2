<div class="px-4">

<?php
    include 'bd.php';
    session_start();
    $id = $_SESSION['usuario'];
    $id_producto = $_GET['id'];
    $query = mysqli_query($conexion,"SELECT * FROM resena_hotel WHERE id_usuario = $id");
    $data = mysqli_fetch_assoc($query);
    $limpieza = $data['limpieza'];
    $servicio = $data['servicio'];
    $decoracion = $data['decoracion'];
    $camas = $data['camas'];   
    echo 'Tus antiguas calificaciones: <br>
    Limpieza : '.$limpieza.'<br>
    Servicio : '.$servicio.'<br>
    Decoracion : '.$decoracion.'<br>
    Camas : '.$camas.'<br>
    Escoge las nuevas calificaciones: 
    '
    ?>


    <form action="calificacion_hotel.php" method="post">
    <label for="atributo1">Limpieza:</label>
    <input type="hidden" name="id_producto" value="<?php echo $id_producto; ?>">
  <input type="range" class="custom-range" min="1" max="5" step="1" id="atributo1" name="limpieza">
    <?php echo '<br>'?>
  <label for="atributo2">Servicio:</label>
  <input type="range" class="custom-range" min="1" max="5" step="1" id="atributo2" name="servicio">
  <?php echo '<br>'?>

  <label for="atributo3">Decoracion :</label>
  <input type="range" class="custom-range" min="1" max="5" step="1" id="atributo3" name="decoracion">
  <?php echo '<br>'?>

  <label for="atributo4">Camas:</label>
  <input type="range" class="custom-range" min="1" max="5" step="1" id="atributo4" name="camas">
  <?php echo '<br>'?>

  <button type="submit">Enviar calificaciones</button>
</form>
<button onclick="window.location.href='usuario.php'">Volver</button>


</div>
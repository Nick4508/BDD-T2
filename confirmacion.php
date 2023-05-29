<?php
    echo 'Estas seguro de eliminar tu cuenta?<br>
    Por favor escribe: Acepto para continuar
    '

?>

<form method="POST" action="eliminar_cuenta.php">
  <label for="confirmar"></label>
  <input type="text" id="confirmar" name="confirmar" required>
  
  <input type="submit" value="Enviar">
  <?php echo '<br><br>'?>
  <button onclick="window.location.href='usuario.php'">Volver</button>

</form>
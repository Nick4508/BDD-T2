<?php
    include 'bd.php';
    session_start();
    $usuarioAutenticado = false;
    
    if(isset($_SESSION['usuario'])){
        $nombreUsuario = $_SESSION['nombre'];
        $usuarioAutenticado = true;
      
    }
    // echo 'si';
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles.css">
    <script src="script.js"></script>
</head>
<style>
.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.button-group {
  display: flex;
  gap: 10px;
}

.search-bar {
  display: flex;
  gap: 10px;
}
</style>
<body>
    <header>
       
<nav class="navbar">
  <div class="button-group">
    <?php if ($usuarioAutenticado) { ?>
      <button onclick="window.location.href='principal.php'">Página Principal</button>
      <button onclick="window.location.href='carrito.php'">Carrito de Compras</button>
      <button onclick="window.location.href='usuario.php'"><?php echo $nombreUsuario; ?></button>
      <button onclick="window.location.href='wishlist.php'">Wishlist</button>
      <button onclick="window.location.href='compras.php'">Lista de Compras</button>
    <?php } else { ?>
      <button onclick="window.location.href='principal.php'">Página Principal</button>
      <button onclick="window.location.href='login/index.php'">Iniciar sesión</button>
      <button onclick="window.location.href='login/index.php'">Registrarse</button>
    <?php } ?>
  </div>
  
  <div class="search-bar">
    <form action="busqueda.php" method="GET">
      <input type="text" name="termino" placeholder="Buscar productos">
      <input type="submit" value="Buscar">
    </form>

  </div>
</nav>
    </header>
</body>
</html>

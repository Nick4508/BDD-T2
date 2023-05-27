<!-- header.php -->
<?php
    include 'bd.php';
    session_start();
    
    if(isset($_SESSION['usuario'])){
        $nombreUsuario = $_SESSION['nombre'];
        $usuarioAutenticado = true;
        $datos = mysqli_query($conexion,'SELECT * FROM usuarios WHERE id = "usuario"');
        if($datos){
            while($row = mysqli_fetch_assoc($datos)){
                $nombre = $row['nombre'];
                echo $nombre;
            }
        }

    }

    // echo 'si';
?>
<!DOCTYPE html>
<html>
<head>
    <!-- Aquí incluye tus etiquetas de estilo CSS y enlaces a archivos JS si es necesario -->
    <link rel="stylesheet" href="styles.css">
    <script src="script.js"></script>
</head>
<body>
    <header>
        <nav>
            <div class="button-group">
                
            <?php if ($usuarioAutenticado) { ?>
                    <button onclick="window.location.href='principal.php'">Página Principal</button>
                    <button onclick="window.location.href='carrito.php'">Carrito de Compras</button>
                    <button onclick="window.location.href='usuario.php'"> <?php echo $nombreUsuario; ?></button>
                <?php } else { ?>
                    <button onclick="window.location.href='login.php'">Iniciar sesión</button>
                    <button onclick="window.location.href='registro.php'">Registrarse</button>
                <?php } ?>
            </div>
        </nav>
        <div class="search-bar">
            <!-- Aquí coloca tu código HTML para el buscador -->
        </div>
    </header>
</body>
</html>

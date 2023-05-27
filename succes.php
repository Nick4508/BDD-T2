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
                <button onclick="window.location.href='principal.php'">Página Principal</button>
                <button onclick="window.location.href='carrito.php'">Carrito de Compras</button>
                <button onclick="window.location.href='usuario.php'"> <?php echo $nombreUsuario; ?></button>
              
            </div>
        </nav>
        <div class="search-bar">
            <!-- Aquí coloca tu código HTML para el buscador -->
        </div>
    </header>
</body>
</html>
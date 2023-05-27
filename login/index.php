<?php
    session_start();

    if(isset($_SESSION['nombre'])){
        header("location: ../principal.php");
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Slide Navbar</title>
	<link rel="stylesheet" type="text/css" href="../css/first.css">
<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>
<body>
	<div class="main">  	
		<input type="checkbox" id="chk" aria-hidden="true">

			<div class="signup">
				<form action="registrar.php" method="POST">
					<label for="chk" aria-hidden="true">Registrar</label>
					<input type="text" name="nombre" placeholder="Nombre de Usuario" required="">
					<input type="email" name="correo" placeholder="Correo electronico" required="">
					<input type="password" name="contrasena" placeholder="Contraseña" required="">
					<input type="date" name="fecha_nacimiento" placeholder="Fecha de nacimiento" required="">
					<button>Registrar</button>
				</form>
			</div>

			<div class="login">
				<form action="ingresar.php" method="POST">
					<label for="chk" aria-hidden="true">Ingresar</label>
					<input type="text" name="nombre" placeholder="Nombre de Usuario" required="">
					<input type="password" name="contrasena" placeholder="Password" required="">
					<button>Ingresar</button>
				</form>
			</div>
	</div>
</body>
</html>
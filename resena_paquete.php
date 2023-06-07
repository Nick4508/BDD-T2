
<?php
    include 'bd.php';
    session_start();
    $fechaHoy = date("Y-m-d");
    // $txtCaliCali=(isset($_POST['caliCali']))?$_POST['caliCali']:"";
    // $txtCaliTrans=(isset($_POST['caliTrans']))?$_POST['caliTrans']:"";
    // $txtCaliServ=(isset($_POST['caliServ']))?$_POST['caliServ']:"";
    // $txtCaliPrecio=(isset($_POST['caliPrecio']))?$_POST['caliPrecio']:"";

    $txtRese=(isset($_POST['rese']))?$_POST['rese']:"";
    $accion=(isset($_POST['action']))?$_POST['action']:"";

    if(isset($_GET['id_producto'])) {
        $id_producto = $_GET['id_producto'];}

    $id_usuario = $_SESSION['usuario'];



    switch($accion){
        case "Enviar":
            $query_res = mysqli_query($conexion, "SELECT * FROM resena_paquete WHERE id_paquete = $id_producto and id_usuario = $id_usuario");
            if (mysqli_num_rows($query_res) > 0) {
                $query = $conexion->prepare("UPDATE resena_paquete SET opinion = ?, calidad = ?, transporte = ?, servicio = ?, calidad_precio = ?, id_paquete = $id_producto, promedio = 0 WHERE id_paquete = $id_producto and id_usuario = $id_usuario");
                $query->bind_param("siiii", $txtRese, $txtCaliCali, $txtCaliTrans, $txtCaliServ, $txtCaliPrecio);
                $query->execute();

                // Primero, realiza la consulta para obtener el promedio
                $query_prom = mysqli_query($conexion, "SELECT SUM(calidad + transporte + servicio + calidad_precio)/4 AS promedio FROM resena_paquete WHERE id_paquete = $id_producto and id_usuario = $id_usuario");
                $row = mysqli_fetch_assoc($query_prom);
                $promedio = $row['promedio'];

                // Luego, realiza la actualización del valor promedio en la tabla
                $updateQuery = mysqli_query($conexion, "UPDATE resena_paquete SET promedio = $promedio WHERE id_paquete = $id_producto and id_usuario = $id_usuario");

                echo '
                <script>
                    alert("Reseña guardada correctamente");
                    window.location = "compras.php";
                </script>
                    ';
                    break;
            } else {
                $query3 = mysqli_prepare($conexion, "INSERT INTO resena_paquete (id_usuario, fecha, opinion, id_paquete) VALUES (?, ?, ?, ?)");
                $promedio = 0;
                mysqli_stmt_bind_param($query3, "issi", $id_usuario, $fechaHoy, $txtRese, $id_producto);
                mysqli_stmt_execute($query3);
                echo'
                <script>
                    alert("Hola funciono");
                    window.location = "compras.php";
                </script>
                ';
            }
        case "volver":
            echo'
            <script>
                window.location = "principal.php";
            </script>
            ';
        break;
    }
?>
<div style="margin: 13px;">
    <form class="form-edicion" method="POST" enctype="multipart/form-data">
        <h4>Escribe tu reseña: </h4>
        <h3>Reseña</h3>
        <input class="controls" type="text" name="rese" id="rese">
        <input class="botons" type="submit" name="action" value="Enviar">
        
        </br>
    </form>
    <button onclick="window.location.href='compras.php'">Volver</button>
</div>
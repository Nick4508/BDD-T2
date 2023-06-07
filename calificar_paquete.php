
<?php
    include 'bd.php';
    session_start();
    $fechaHoy = date("Y-m-d");
    $txtCaliCali=(isset($_POST['caliCali']))?$_POST['caliCali']:"";
    $txtCaliTrans=(isset($_POST['caliTrans']))?$_POST['caliTrans']:"";
    $txtCaliServ=(isset($_POST['caliServ']))?$_POST['caliServ']:"";
    $txtCaliPrecio=(isset($_POST['caliPrecio']))?$_POST['caliPrecio']:"";

    $accion=(isset($_POST['action']))?$_POST['action']:"";

    if(isset($_GET['id_producto'])) {
        $id_producto = $_GET['id_producto'];}

    $id_usuario = $_SESSION['usuario'];



    switch($accion){
        case "Enviar":
            $query_res = mysqli_query($conexion, "SELECT * FROM resena_paquete WHERE id_paquete = $id_producto and id_usuario = $id_usuario");
            if (mysqli_num_rows($query_res) > 0) {
                $query = $conexion->prepare("UPDATE resena_paquete SET  calidad = ?, transporte = ?, servicio = ?, calidad_precio = ?, id_paquete = $id_producto, promedio = 0 WHERE id_paquete = $id_producto and id_usuario = $id_usuario");
                $query->bind_param("iiii", $txtCaliCali, $txtCaliTrans, $txtCaliServ, $txtCaliPrecio);
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
                $query3 = mysqli_prepare($conexion, "INSERT INTO resena_paquete (id_usuario, fecha, calidad, transporte, servicio, calidad_precio, id_paquete, promedio) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $promedio = 0;
                mysqli_stmt_bind_param($query3, "isiiiiii", $id_usuario, $fechaHoy, $txtCaliCali, $txtCaliTrans, $txtCaliServ, $txtCaliPrecio, $id_producto, $promedio);
                mysqli_stmt_execute($query3);

                $query_prom = mysqli_query($conexion, "SELECT SUM(calidad + transporte + servicio + calidad_precio)/4 AS promedio FROM resena_paquete WHERE id_paquete = $id_producto and id_usuario = $id_usuario");
                $row = mysqli_fetch_assoc($query_prom);
                $promedio = $row['promedio'];

                $updateQuery = mysqli_query($conexion, "UPDATE resena_paquete SET promedio = $promedio WHERE id_paquete = $id_producto and id_usuario = $id_usuario");

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
                alert("funciono");
                window.location = "principal.php";
            </script>
            ';
        break;
    }
?>
<div style="margin: 13px;">
    <form class="form-edicion" method="POST" enctype="multipart/form-data">
        <h4>Asignar Calificación</h4>
        <h4>Siendo 5 la calificacion mas alta: </h4>
        <h3>Califica la calidad del paquete (1 a 5)</h3>
        <input class="controls" type="number" name="caliCali" id="caliCali">
        <h3>Califica el transporte ofrecido (1 a 5)</h3>
        <input class="controls" type="number" name="caliTrans" id="caliTrans">
        <h3>Califica el servicio (1 a 5)</h3>
        <input class="controls" type="number" name="caliServ" id="caliServ">
        <h3>Que tan de acuerdo estás con el precio del paquete ?(1 a 5)</h3>
        <input class="controls" type="number" name="caliPrecio" id="caliPrecio">
        <input class="botons" type="submit" name="action" value="Enviar">
        </br>
    </form>
    <button onclick="window.location.href='compras.php'">Volver</button>
</div>
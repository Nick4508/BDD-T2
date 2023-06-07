
<?php
    include 'bd.php';
    session_start();
    $fechaHoy = date("Y-m-d");
    $txtCaliLim=(isset($_POST['caliLim']))?$_POST['caliLim']:"";
    $txtCaliServ=(isset($_POST['caliServ']))?$_POST['caliServ']:"";
    $txtCaliDec=(isset($_POST['caliDec']))?$_POST['caliDec']:"";
    $txtCaliCama=(isset($_POST['caliCama']))?$_POST['caliCama']:"";

    $txtRese=(isset($_POST['rese']))?$_POST['rese']:"";
    $accion=(isset($_POST['action']))?$_POST['action']:"";
    
    if(isset($_GET['id_producto'])) {
        $id_producto = $_GET['id_producto'];}

    $id_usuario = $_SESSION['usuario'];



    switch($accion){
        case "Enviar":
            $query_res = mysqli_query($conexion, "SELECT * FROM resena_hotel WHERE id_hotel = $id_producto and id_usuario = $id_usuario");
            if (mysqli_num_rows($query_res) > 0) {
                $query = $conexion->prepare("UPDATE resena_hotel SET  limpieza = ?, servicio = ?, decoracion = ?, camas = ?, promedio = 0 WHERE id_hotel = $id_producto and id_usuario = $id_usuario");
                $query->bind_param("iiii", $txtCaliLim, $txtCaliServ, $txtCaliDec, $txtCaliCama);
                $query->execute();

                $query_prom = mysqli_query($conexion, "SELECT SUM(limpieza + servicio + decoracion + camas)/4 AS promedio FROM resena_hotel WHERE id_hotel = $id_producto and id_usuario = $id_usuario");
                $row = mysqli_fetch_assoc($query_prom);
                $promedio = $row['promedio'];

                $updateQuery = mysqli_query($conexion, "UPDATE resena_hotel SET promedio = $promedio WHERE id_hotel = $id_producto and id_usuario = $id_usuario");

                echo '
                <script>
                    alert("Calificación guardada correctamente");
                    window.location = "compras.php";
                </script>
                    ';
                    break;
            } else {
                $query3 = mysqli_prepare($conexion, "INSERT INTO resena_hotel (id_usuario, fecha, limpieza, servicio, decoracion, camas, id_hotel, promedio) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $promedio = 0;
                mysqli_stmt_bind_param($query3, "isiiiiii", $id_usuario, $fechaHoy, $txtCaliLim, $txtCaliServ, $txtCaliDec, $txtCaliCama, $id_producto, $promedio);
                mysqli_stmt_execute($query3);

                $query_prom = mysqli_query($conexion, "SELECT SUM(limpieza + servicio + decoracion + camas)/4 AS promedio FROM resena_hotel WHERE id_hotel = $id_producto and id_usuario = $id_usuario");
                $row = mysqli_fetch_assoc($query_prom);
                $promedio = $row['promedio'];

                $updateQuery = mysqli_query($conexion, "UPDATE resena_hotel SET promedio = $promedio WHERE id_hotel = $id_producto and id_usuario = $id_usuario");
                
                echo'
                <script>
                    alert("Calificación guardada correctamente");
                    window.location = "compras.php";
                </script>
                ';
            }
        case "volver":
            echo'
            <script>
                window.location = "compras.php";
            </script>
            ';
        break;
    }
?>
<div style="margin: 13px;">
    <form class="form-edicion" method="POST" enctype="multipart/form-data">
        <h4>Califica: </h4>
        <h3>Califica la limpieza (1 a 5)</h3>
        <input class="controls" type="number" name="caliLim" id="caliLim">
        <h3>Califica el servicio (1 a 5)</h3>
        <input class="controls" type="number" name="caliServ" id="caliServ">
        <h3>Califica la decoración (1 a 5)</h3>
        <input class="controls" type="number" name="caliDec" id="caliDec">
        <h3>Califica las camas (1 a 5)</h3>
        <input class="controls" type="number" name="caliCama" id="caliCama">
        <input class="botons" type="submit" name="action" value="Enviar">
        </br>
    </form>
    <button onclick="window.location.href='compras.php'">Volver</button>
</div>
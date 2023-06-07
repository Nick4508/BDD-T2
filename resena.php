
<?php
    include 'bd.php';
    session_start();
    $fechaHoy = date("Y-m-d");
    // $txtCaliLim=(isset($_POST['caliLim']))?$_POST['caliLim']:"";
    // $txtCaliServ=(isset($_POST['caliServ']))?$_POST['caliServ']:"";
    // $txtCaliDec=(isset($_POST['caliDec']))?$_POST['caliDec']:"";
    // $txtCaliCama=(isset($_POST['caliCama']))?$_POST['caliCama']:"";

    $txtRese=(isset($_POST['rese']))?$_POST['rese']:"";
    $accion=(isset($_POST['action']))?$_POST['action']:"";
    
    if(isset($_GET['id_producto'])) {
        $id_producto = $_GET['id_producto'];}


    $id_usuario = $_SESSION['usuario'];



    switch($accion){
        case "Enviar":
            $query_res = mysqli_query($conexion, "SELECT * FROM resena_hotel WHERE id_hotel = $id_producto and id_usuario = $id_usuario");
            if (mysqli_num_rows($query_res) > 0) {
                $query = $conexion->prepare("UPDATE resena_hotel SET opinion = ?, limpieza = ?, servicio = ?, decoracion = ?, camas = ?, promedio = 0 WHERE id_hotel = $id_producto and id_usuario = $id_usuario");
                $query->bind_param("siiii", $txtRese, $txtCaliLim, $txtCaliServ, $txtCaliDec, $txtCaliCama);
                $query->execute();

                // Primero, realiza la consulta para obtener el promedio
                $query_prom = mysqli_query($conexion, "SELECT SUM(limpieza + servicio + decoracion + camas)/4 AS promedio FROM resena_hotel WHERE id_hotel = $id_producto and id_usuario = $id_usuario");
                $row = mysqli_fetch_assoc($query_prom);
                $promedio = $row['promedio'];

                // Luego, realiza la actualización del valor promedio en la tabla
                $updateQuery = mysqli_query($conexion, "UPDATE resena_hotel SET promedio = $promedio WHERE id_hotel = $id_producto and id_usuario = $id_usuario");

                echo '
                <script>
                    alert("Reseña guardada correctamente");
                    window.location = "compras.php";
                </script>
                    ';
                    break;
            } else {
                #$prom = mysqli_query($conexion, "SELECT AVG(limpieza + servicio + decoracion + camas) AS promedio FROM resena_hotel WHERE id_hotel = $id_producto and id_usuario = $id_usuario");
                #$query3 = mysqli_query($conexion,"INSERT INTO resena_hotel('id_usuario','fecha','opinion','limpieza','servicio','decoracion','camas','id_hotel','promedio') VALUES($id_usuario,$fechaHoy,$txtRese,$txtCaliLim,$txtCaliServ,$txtCaliDec,$txtCaliCama,$id_producto,'0')");
                $query3 = mysqli_prepare($conexion, "INSERT INTO resena_hotel (id_usuario, fecha, opinion, id_hotel) VALUES (?, ?, ?, ?)");
                mysqli_stmt_bind_param($query3, "issi", $id_usuario, $fechaHoy, $txtRese, $id_producto);
                mysqli_stmt_execute($query3);
                
                // Primero, realiza la consulta para obtener el promedio
                $query_prom = mysqli_query($conexion, "SELECT SUM(limpieza + servicio + decoracion + camas)/4 AS promedio FROM resena_hotel WHERE id_hotel = $id_producto and id_usuario = $id_usuario");
                $row = mysqli_fetch_assoc($query_prom);
                $promedio = $row['promedio'];

                // Luego, realiza la actualización del valor promedio en la tabla
                $updateQuery = mysqli_query($conexion, "UPDATE resena_hotel SET promedio = $promedio WHERE id_hotel = $id_producto and id_usuario = $id_usuario");
                
                echo'
                <script>
                    alert("Reseña guardada correctamente");
                    window.location = "compras.php";
                </script>
                ';
            }
        case "Volver":
            echo'
            <script>
                window.location = "../resena.php";
            </script>
            ';
        break;
    }
?>
<div style="margin: 13px;">
    <form class="form-edicion" method="POST" enctype="multipart/form-data">
        <h4>Escribir reseña</h4>
        <h3>Reseña</h3>
        <input class="controls" type="text" name="rese" id="rese">
        <input class="botons" type="submit" name="action" value="Enviar">
        </br>
    </form>
    <button onclick="window.location.href='compras.php'">Volver</button>
</div>
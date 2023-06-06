
<?php
    include 'bd.php';
    session_start();
    $fechaHoy = date("Y-m-d");
    $txtCaliCali=(isset($_POST['caliCali']))?$_POST['caliCali']:"";
    $txtCaliTrans=(isset($_POST['caliTrans']))?$_POST['caliTrans']:"";
    $txtCaliServ=(isset($_POST['caliServ']))?$_POST['caliServ']:"";
    $txtCaliPrecio=(isset($_POST['caliPrecio']))?$_POST['caliPrecio']:"";

    $txtRese=(isset($_POST['rese']))?$_POST['rese']:"";
    $accion=(isset($_POST['action']))?$_POST['action']:"";

    if(isset($_GET['id_producto'])) {
        $id_producto = $_GET['id_producto'];}
        echo 'aaaaa: '.$id_producto;

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
                #$prom = mysqli_query($conexion, "SELECT AVG(limpieza + servicio + decoracion + camas) AS promedio FROM resena_hotel WHERE id_hotel = $id_producto and id_usuario = $id_usuario");
                #$query3 = mysqli_query($conexion,"INSERT INTO resena_hotel('id_usuario','fecha','opinion','limpieza','servicio','decoracion','camas','id_hotel','promedio') VALUES($id_usuario,$fechaHoy,$txtRese,$txtCaliLim,$txtCaliServ,$txtCaliDec,$txtCaliCama,$id_producto,'0')");
                $query3 = mysqli_prepare($conexion, "INSERT INTO resena_paquete (id_usuario, fecha, opinion, calidad, transporte, servicio, calidad_precio, id_paquete, promedio) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $promedio = 0; // Crear una variable para almacenar el valor 0
                mysqli_stmt_bind_param($query3, "issiiiiii", $id_usuario, $fechaHoy, $txtRese, $txtCaliCali, $txtCaliTrans, $txtCaliServ, $txtCaliPrecio, $id_producto, $promedio);
                mysqli_stmt_execute($query3);
                // Primero, realiza la consulta para obtener el promedio
                $query_prom = mysqli_query($conexion, "SELECT SUM(calidad + transporte + servicio + calidad_precio)/4 AS promedio FROM resena_paquete WHERE id_paquete = $id_producto and id_usuario = $id_usuario");
                $row = mysqli_fetch_assoc($query_prom);
                $promedio = $row['promedio'];

                // Luego, realiza la actualización del valor promedio en la tabla
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
                window.location = "principal.php";
            </script>
            ';
        break;
    }
?>

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
        <h3>Reseña</h3>
        <input class="controls" type="text" name="rese" id="rese">
        <input class="botons" type="submit" name="action" value="Enviar">
        <input class="botons" type="submit" name="action" value="Volver">
        
        </br>
    </form>
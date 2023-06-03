<?php
    include 'bd.php';
    session_start();
    $id_hotel = $_GET['id_hotel'];
    $id_usuario = $_SESSION['usuario'];

    $query = mysqli_query($conexion, "SELECT * FROM wishlist WHERE id_usuario = '$id_usuario' and id_paquete = '$id_hotel'");
    if(mysqli_num_rows($query) > 0){
        echo '
            <script>
                alert("Este producto ya pertenece a tu wishlist");
                window.location = "principal.php";
            </script>
        ';
        exit();
    }else{
        if($id_hotel >= 1000 && $id_hotel < 2000){ //hoteles
            $query3 = mysqli_query($conexion, "SELECT avg(promedio) AS promedio_final FROM resena_hotel WHERE id_hotel = '$id_hotel'");
            $cap = mysqli_fetch_assoc($query3)['promedio_final'];
            $query2 = $conexion->prepare("INSERT INTO wishlist(id_usuario, id_paquete, puntuacion_promedio, paquete) VALUES('$id_usuario','$id_hotel','$cap','0')");
            $query2->execute();
            echo '
                <script>
                    alert("El hotel se agregó a tu wishlist");
                    window.location = "principal.php";
                </script>
            ';
        exit();
        }elseif($id_hotel >= 2000){//paquetes
            $query3 = mysqli_query($conexion, "SELECT avg(promedio) AS promedio_final FROM resena_paquete WHERE id_paquete = '$id_hotel'");
            $cap = mysqli_fetch_assoc($query3)['promedio_final'];
            $query2 = $conexion->prepare("INSERT INTO wishlist(id_usuario, id_paquete, puntuacion_promedio, paquete) VALUES('$id_usuario','$id_hotel','$cap','1')");
            $query2->execute();
            echo '
                <script>
                    alert("El paquete se agregó a tu wishlist");
                    window.location = "principal.php";
                </script>
            ';
        exit();
        }
    }

    mysqli_close($conexion);
?>
<div class="px-4">

<?php
    include 'bd.php';
    include 'header.php';
    
    $busqueda = $_GET['termino'];
    ?>
    <h3> Busquedas similares a <?php echo '"' .$busqueda.'"' ?> </h3>  
    <?php
    $busqueda_aux = 'algo'.$busqueda;
    $busqueda_2 = '';
    

    if(strpos($busqueda_aux,'Paquete') != false || strpos($busqueda_aux, 'paquete')!= false){
        $busqueda_2 = $busqueda.'%';
    }elseif(strpos($busqueda_aux,'Paquete') == false || strpos($busqueda_aux, 'paquete')== false){
        $busqueda_2 = 'Paquete ' . $busqueda . '%';
    }
    
    $query = mysqli_prepare($conexion, "SELECT nombre,id, precio_persona FROM paquetes WHERE nombre LIKE ?");
    mysqli_stmt_bind_param($query, 's', $busqueda_2);
    mysqli_stmt_execute($query);
    
    $resultado = mysqli_stmt_get_result($query);

    while($row = mysqli_fetch_assoc($resultado)){
        $nombre = $row['nombre'];
        $precio = $row['precio_persona'];
        $id = $row['id'];
        $tipo = 'Paquete';
        // imagen
        echo'
        Tipo : '.$tipo.'<br>
        Nombre :'.'<a href="hotelesYpaquetes.php?id=' . $id . '">' . $nombre.'</a><br> 
        Precio por persona : $'.$precio.'<br>   
        ------------------------------<br>
        ';
    }

    $busqueda_3 = $busqueda.'%';
    $query = mysqli_prepare($conexion,"SELECT nombre, id, precio_noche FROM hoteles WHERE nombre LIKE ?");
    mysqli_stmt_bind_param($query, 's', $busqueda_3);
    mysqli_stmt_execute($query);
    $resultado = mysqli_stmt_get_result($query);
    while($row = mysqli_fetch_assoc($resultado)){
        $nombre = $row['nombre']; 
        $precio = $row['precio_noche'];
        $id = $row['id'];
        $tipo = 'Hotel';
        // imagen
        echo'
        Tipo : '.$tipo.'<br>
        Nombre :'.'<a href="hotelesYpaquetes.php?id=' . $id . '">' . $nombre.'</a><br> 
        Precio por noche : $'.$precio.'<br>   
        ------------------------------<br>
        ';
    }
?>
</div>
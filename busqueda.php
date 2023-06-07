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
        ?>
        <div class="card border-dark mb-3" style="max-width: 540px;">
            <div class="row g-0">
            <div class="col-md-4">
            <img src="imagenes/<?php echo $id?>.jpg" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
            <div class="card-body">
            <p class="card-text">Tipo : <?php echo $tipo?></p>
            <p class="card-text">Nombre : <?php echo '<a href="hotelesYpaquetes.php?id='.$id.'">'.$nombre.'</a>'?></p>
            <p class="card-text"><small >Precio por persona : <?php echo $precio; ?></small></p>
            </div>
            </div>
            </div>
        </div>
        <?php
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
        
        ?>
        <div class="card border-dark mb-3" style="max-width: 540px;">
            <div class="row g-0">
            <div class="col-md-4">
            <img src="imagenes/<?php echo $id?>.jpg" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
            <div class="card-body">
            <p class="card-text">Tipo : <?php echo $tipo?></p>
            <p class="card-text">Nombre : <?php echo '<a href="hotelesYpaquetes.php?id='.$id.'">'.$nombre.'</a>'?></p>
            <p class="card-text"><small >Precio por persona : <?php echo $precio; ?></small></p>
            </div>
            </div>
            </div>
        </div>
        <?php
    }
?>
</div>
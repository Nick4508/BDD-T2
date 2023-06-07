<h3>Tus calificaciones</h3>

<?php 
    include 'bd.php';
    
    $id_usuario = $_SESSION['usuario'];


    $query = mysqli_query($conexion, "SELECT * FROM resena_hotel JOIN hoteles 
        on resena_hotel.id_hotel = hoteles.id WHERE resena_hotel.id_usuario = $id_usuario ORDER BY resena_hotel.fecha");
    if($query){
        while($row = mysqli_fetch_assoc($query)){
            if(($row['limpieza']== 0) && ($row['opinion'] == null)){
                continue;
            }
            ?>
            <div class="card border-dark mb-3" style="width: 18rem;"> 
            <?php
            $fecha = $row['fecha'];
            ?>
            <h5 class="card-header"><?php echo 'Fecha :'.$fecha.'<br> Nombre : '.'<a href="hotelesYpaquetes.php?id='.$row['id_hotel'].'">'.$row['Nombre'].'</a>';  ?> </h5>
            <?php
            if($row['limpieza'] != 0){
            ?>
                <div class="card-body">
                    <?php 
                        echo '
                       
                        Calificacion: <br>
                        Limpieza : '.$row['limpieza'].'<br>
                        Servicio : '.$row['servicio'].'<br>
                        Decoracion : '.$row['decoracion'].'<br>
                        Camas : '.$row['camas'].'<br>
                        '
                    ?>
                    <a href="update_calificacion_hotel.php?id=<?php echo $row['id_hotel']; ?>" class="btn btn-primary">Editar</a>
                    <a href="delete_calificacion_hotel.php?id=<?php echo $row['id_hotel']; ?>" class="btn btn-primary">Eliminar</a>

                </div>

            <?php
            }
            if($row['opinion'] != null ){
                ?>
                <div class="card-body">
                    <?php 
                        echo 'Reseña: <br>
                        '.$row['opinion'].'<br>
                        '
                    ?>
                    <a href="update_resena_hotel.php?id=<?php echo $row['id_hotel']; ?>" class="btn btn-primary">Editar</a>
                    <a href="delete_resena_hotel.php?id=<?php echo $row['id_hotel']; ?>" class="btn btn-primary">Eliminar</a>

                </div>
                <?php
            }    
            ?>
        </div>
            
        <?php
        }
        }
        
    $query = mysqli_query($conexion, "SELECT * FROM resena_paquete JOIN paquetes 
    on resena_paquete.id_paquete = paquetes.id WHERE resena_paquete.id_usuario = $id_usuario ORDER BY resena_paquete.fecha");
    if($query){
        while($row = mysqli_fetch_assoc($query)){
            if(($row['calidad']== 0) && ($row['opinion'] == null)){
                continue;
            }
            ?>
            <div class="card border-dark mb-3" style="width: 18rem;"> 
            <?php
            $fecha = $row['fecha'];
            ?>
            <h5 class="card-header"><?php echo 'Fecha :'.$fecha.'<br> Nombre : '.'<a href="hotelesYpaquetes.php?id='.$row['id_paquete'].'">'.$row['nombre'].'</a>';  ?> </h5>

            <?php
            if($row['calidad'] != 0){
            ?>
                <div class="card-body">
                    <?php 
                        echo 'Calificacion: <br>
                        Calidad : '.$row['calidad'].'<br>
                        Transporte : '.$row['transporte'].'<br>
                        Servicio : '.$row['servicio'].'<br>
                        Calidad Precio : '.$row['calidad_precio'].'<br>
                        '
                    ?>
                    <a href="update_calificacion_paquete.php?id=<?php echo $row['id_paquete']; ?>" class="btn btn-primary">Editar</a>
                    <a href="delete_calificacion_paquete.php?id=<?php echo $row['id_paquete']; ?>" class="btn btn-primary">Eliminar</a>

                </div>

            <?php
            }
            if($row['opinion'] != null ){
                ?>
                <div class="card-body">
                    <?php 
                        echo 'Reseña: <br>
                        '.$row['opinion'].'<br>
                        '
                    ?>
                    <a href="update_resena_paquete.php?id=<?php echo $row['id_paquete']; ?>" class="btn btn-primary">Editar</a>
                    <a href="delete_resena_paquete.php?id=<?php echo $row['id_paquete']; ?>" class="btn btn-primary">Eliminar</a>


                </div>
                <?php
            }    
            ?>
        </div>
            
        <?php
        }
        }
?>
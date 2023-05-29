<?php
    include 'bd.php';
    session_start();
    $descuento = $_GET['descuento'];
    if($descuento==1){
        $_SESSION['codigo'] = true;
        echo '
            <script>
                alert("Tu descuento fue agregado");
                window.location = "principal.php";
            </script>
        ';
    }else{
        $_SESSION['codigo'] = false;
        echo '
        <script>
            alert("Tu descuento no fue agregado");
            window.location = "principal.php";
        </script>
    ';
    }
?>
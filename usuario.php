<?php
    session_start();
    if(!isset($_SESSION['usuario'])){
        echo '
            <script>
                alert("Debes iniciar sesión");
                window.location = "login/index.php";
            </script>
        ';
        session_destroy();
        die();
    }
?>
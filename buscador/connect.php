<?php
    $connect = new mysqli("localhost", "root", "", "manosdeangel");

    if($connect){
        ?>
        <script>
            console.log("carnal si hay conexion");
        </script>
        <?php
    }
?>
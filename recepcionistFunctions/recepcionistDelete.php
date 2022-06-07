<?php 
include("../DBConnection/connect.php");

?>
<script>
    console.log("0")
</script>
<?php

    ?>
    <script>
        console.log("1")
    </script>
    <?php
    if(strlen($_POST['txtIdDate']) >= 1){
        $delDate = trim($_POST['txtIdDate']);
        $consulta = "DELETE FROM citas where Id_Cita like $delDate";
        $resultado = mysqli_query($connect,$consulta);
        if($resultado){
            ?>
            <script>
                console.log("2")
            </script>
            <h3>Juego eliminado con exito</h3>
            <?php
        }else{
            ?>
            <script>
                console.log("3")
            </script>
            <h3>Error: no se pudo eliminar el juego</h3>
            <?php
        }
        }else{
            ?>
            <script>
                console.log("4")
            </script>
            <h3>Por favor de complete el campo</h3>
            <?php
        }
        
    

?>
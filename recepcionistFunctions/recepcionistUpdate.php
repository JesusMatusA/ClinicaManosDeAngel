<?php 
include("../DBConnection/connect.php");
    $idDate = trim($_POST['idDate']);
    $patientDateUpdate = trim($_POST['patientDateUpdate']);
    $patientTimeDateUpdate = trim($_POST['patientTimeDateUpdate']);
    $consulta = "UPDATE citas SET  fecha_Cita = '$patientDateUpdate', hora_Cita = '$patientTimeDateUpdate' WHERE Id_Cita = '$idDate'";
    $resultadoAdd = mysqli_query($connect,$consulta);
    if($resultadoAdd){
        ?>
        <script>
            alert("Se a actualizado la cita correctamente.")
        </script>
        <?php
    }else{
        ?>
        <script>
            alert("A ocurrido un error en la actualizacion de la cita.")
        </script>
        <?php
    }
?>
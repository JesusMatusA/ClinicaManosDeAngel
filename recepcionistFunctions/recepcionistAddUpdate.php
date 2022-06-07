<?php 
include("../DBConnection/connect.php");
    $idPatient = trim($_POST['idPatient']);
    $patientDate = trim($_POST['patientDate']);
    $patientTimeDate = trim($_POST['patientTimeDate']);
    $Diagnosis = trim($_POST['Diagnosis']);
    $consulta = "INSERT INTO citas (Id_Paciente, fecha_Cita, hora_Cita, diagnostico) 
    VALUES ('$idPatient', '$patientDate', '$patientTimeDate', '$Diagnosis')";
    $resultadoAdd = mysqli_query($connect,$consulta);
    if($resultadoAdd){
        ?>
        <script>
            alert("Se a creado la cita correctamente.")
        </script>
        <?php
    }else{
        ?>
        <script>
            alert("A ocurrido un error en la cita.")
        </script>
        <?php
    }
?>
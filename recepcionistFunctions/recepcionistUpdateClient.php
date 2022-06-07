<?php 
include("../DBConnection/connect.php");
    $IdPatient = trim($_POST['IdPatient']);
    $namePatient = trim($_POST['namePatient']);
    $firstLasNamePatient = trim($_POST['firstLastNamePatient']);
    $secondLastNamePatient = trim($_POST['secondLastNamePatient']);
    $emailPatient = trim($_POST['emailPatient']);
    $contactPatient = trim($_POST['contactPatient']);
    $consulta = "UPDATE pacientes SET  nombres = '$namePatient', aPaterno = '$firstLasNamePatient', aMaterno = '$secondLastNamePatient',correo = '$emailPatient', telefono = '$contactPatient' WHERE Id_Paciente = '$IdPatient'";
    $resultadoAdd = mysqli_query($connect,$consulta);
    if($resultadoAdd){
        ?>
        <script>
            alert("Se a actualizado el cliente correctamente.")
        </script>
        <?php
    }else{
        ?>
        <script>
            alert("A ocurrido un error al actualizar al cliente.")
        </script>
        <?php
    }
?>
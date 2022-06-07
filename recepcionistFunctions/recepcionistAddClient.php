<?php 
include("../DBConnection/connect.php");
    $namePatient = trim($_POST['namePatient']);
    $firstLasNamePatient = trim($_POST['firstLastNamePatient']);
    $secondLastNamePatient = trim($_POST['secondLastNamePatient']);
    $emailPatient = trim($_POST['emailPatient']);
    $contactPatient = trim($_POST['contactPatient']);
    $consulta = "INSERT INTO pacientes (nombres, aPaterno, aMaterno, correo, telefono) 
    VALUES ('$namePatient', '$firstLasNamePatient', '$secondLastNamePatient', '$emailPatient',
    '$contactPatient')";
    $resultadoAdd = mysqli_query($connection,$consulta);
    if($resultadoAdd){
        ?>
        <script>
            alert("Se a agregado el cliente correctamente.")
        </script>
        <?php
    }else{
        ?>
        <script>
            alert("A ocurrido un error al agregar al cliente.")
        </script>
        <?php
    }
?>
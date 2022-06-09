<?php 
include("../../DBConnection/connect.php");
if(!empty($_POST)){
    $idDate = $_POST['IdDate'];
    $idEmp = $_POST['IdEmp'];
    $notes = strtolower($_POST['Notes']);
    $idDoctor = "";

    $query = "SELECT Id_Doctor FROM doctores d INNER JOIN empleados e ON d.Id_Empleado=e.Id_Empleado";
    if($result = $connection->query($query)){
        if($result->fetchColumn() > 0){
            foreach($connection->query($query) as $row){
                $idDoctor = $row['Id_Doctor'];
            }
        }
    }

    $query = "INSERT INTO bitacoracita(Id_BitacoraCita, Id_Cita, Id_Doctor, nota) 
            VALUES(null, :date, :doctor, :note)";
    $stmt = $connection->prepare($query);
    $stmt->bindParam(':date', $idDate, PDO::PARAM_INT);
    $stmt->bindParam(':doctor', $idDoctor, PDO::PARAM_INT);
    $stmt->bindParam(':note', $notes, PDO::PARAM_STR);

    //comprobamos que se ejecuto la inserción y que se realizo con exito
    if($stmt->execute()){
      if($stmt->rowCount() > 0){
          ?>
            <script>
              //Alerta que avisa que la acción fue un exito y entonces devuelve a otra pantalla
              alert("Nota Agregada!");
              location.href = "../../Screens/doctorScreens/SeePatientScreen.php";
            </script>
          <?php
      }
    }
}
?>
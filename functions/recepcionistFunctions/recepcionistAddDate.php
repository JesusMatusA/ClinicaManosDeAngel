<?php
 include("../../DBConnection/connect.php");
 //comprobar que ocurrio un post
 if(!empty($_POST)){
     //obtener datos
    $idPatient = $_POST['idPatient'];
    $idDoctor = $_POST['idDoctor'];
    $date = $_POST['patientDate'];
    $hour = $_POST['patientTimeDate'];
    $diagnosis = ucfirst(strtolower($_POST['Diagnosis']));
      //insertar una cita con el paciente seleccionado usando su Id
      $query = "INSERT INTO citas(Id_Cita, Id_Paciente, Id_Doctor, fecha_Cita, hora_Cita, diagnostico) VALUES(null, :idPat, :idDoc, :date, :hour, :diagnosis)";
      $stmt = $connection->prepare($query);
      $stmt->bindParam(':idPat', $idPatient, PDO::PARAM_INT);
      $stmt->bindParam(':idDoc', $idDoctor, PDO::PARAM_INT);
      $stmt->bindParam(':date', $date, PDO::PARAM_STR);
      $stmt->bindParam(':hour', $hour, PDO::PARAM_STR);
      $stmt->bindParam(':diagnosis', $diagnosis, PDO::PARAM_STR);
      //comprobar que se ejecuto la inserción de la cita y que ocurrio con exito
      if($stmt->execute()){
          if($stmt->rowCount() > 0){
          ?>
            <script>
              //Alerta que avisa que la acción fue un exito y entonces devuelve a otra pantalla
              alert("¡Cita Agendada!");
              location.href = "../../Screens/recepcionistScreens/SeeClientScreen.php";
            </script>
          <?php
          }//end if
      }//end if
  }//end if
?>
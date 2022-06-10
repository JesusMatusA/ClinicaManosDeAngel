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

    $sql = "SELECT COUNT(*) as total FROM citas WHERE fecha_Cita=:date AND hora_Cita=:hour";
    $st = $connection->prepare($sql);
    $st->bindParam(":date", $date, PDO::PARAM_STR);
    $st->bindParam(":hour", $hour, PDO::PARAM_STR);
    if($st->execute()){
      $result = $st->fetch(PDO::FETCH_ASSOC);
      if($result['total'] > 0){
        ?>
          <script>
            alert("Error: La fecha y hora de la cita ya está agendada con otro paciente");
            location.href="../../Screens/recepcionistScreens/SeeClientScreen.php";
          </script>
        <?php
      }
    }
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
        }
    }
  }
?>
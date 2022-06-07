<?php 
  include("../../DBConnection/connect.php");
  if(!empty($_POST)){
    //obener los datos de la cita
    $idDate = $_POST['idDate'];
    $date = $_POST['patientDate'];
    $hour = $_POST['patientTime'];
    $query = "UPDATE citas SET fecha_Cita=:date, hora_Cita=:hour WHERE Id_Cita = :idDate";
    $stmt = $connection->prepare($query);
    $stmt->bindParam(":date", $date, PDO::PARAM_STR);
    $stmt->bindParam(":hour", $hour, PDO::PARAM_STR);
    $stmt->bindParam(":idDate", $idDate, PDO::PARAM_INT);
    //comprobar que se ejecuto el comando y se actualizo con exito la cita
    if($stmt->execute()){
      if($stmt->rowCount()>0){
        ?>
          <script>
            //Alerta que avisa que la acción fue un exito y entonces devuelve a la pantalla de agregar cita
            alert("¡Cita Reagendada con exito!");
            location.href = "../../Screens/recepcionistScreens/SeeDateScreen.php";
          </script>
        <?php
      }else{
        ?>
        <script>
          //Alerta que se debe cambiar algun dato para poder actualizar la cita
          alert("¡Debe cambiar algun dato para actualizar!");
          location.href = "../../Screens/recepcionistScreens/UpdateDateScreen.php?Id=<?php echo $idDate?>";
        </script>
      <?php
      }
    }
  }
?>
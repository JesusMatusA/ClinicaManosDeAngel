<?php 
  include("../../DBConnection/connect.php");
  if(!empty($_POST)){
    //obtener los datos del paciente no sensibles
    $idpatient = $_POST['IdPatient'];
    $name = $_POST['name'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    //preparar la consulta para actualizar la información del paciente
    $query = "UPDATE pacientes SET nombres=:name, aPaterno=:middlename, aMaterno=:lastname, correo=:email, telefono=:telephone WHERE Id_Paciente=:idpatient";
    $stmt = $connection->prepare($query);
    $stmt->bindParam(":name", $name, PDO::PARAM_STR);
    $stmt->bindParam(":middlename", $middlename, PDO::PARAM_STR);
    $stmt->bindParam(":lastname", $lastname, PDO::PARAM_STR);
    $stmt->bindParam(":email", $email, PDO::PARAM_STR);
    $stmt->bindParam(":telephone", $telephone, PDO::PARAM_INT);
    $stmt->bindParam(":idpatient", $idpatient, PDO::PARAM_INT);
    //comprobar que se ejecuto el comando y que la actualización fue un exito
    if($stmt->execute()){
      if($stmt->rowCount()>0){
        ?>
          <script>
            //Alerta que avisa que la acción fue un exito y entonces devuelve a la pantalla de agregar cita
            alert("¡Paciente actualizado con exito!");
            location.href = "../../Screens/recepcionistScreens/SeeClientScreen.php";
          </script>
        <?php
      }else{
        ?>
        <script>
          //Alerta que se debe cambiar algun dato para poder actualizar el paciente
          alert("¡Debe cambiar algun dato para actualizar!");
          location.href = "../../Screens/recepcionistScreens/UpdateClientScreen.php?Id=<?php echo $idpatient?>";
        </script>
      <?php
      }
    }
  }
?>
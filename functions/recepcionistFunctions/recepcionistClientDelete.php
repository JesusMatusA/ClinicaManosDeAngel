<?php 
  include("../../DBConnection/connect.php");
  //comrpobar que ocurrio un post
  if(!empty($_POST)){
    //obtener la id del paciente a eliminar
    $idPatient = $_POST['idPatient'];
    //crear la consulta para eliminar al paciente y ejecutarla
    $query = "DELETE FROM pacientes WHERE Id_Paciente = :idPatient";
    $stmt = $connection->prepare($query);
    $stmt->bindParam(':idPatient', $idPatient, PDO::PARAM_INT);
    //comprobar que se ejecuto el comando y se eliminó con exito el paciente
    if($stmt->execute()){
      if($stmt->rowCount() > 0){
        ?>
          <script>
            //altera que avisa que el paciente fue eliminado con exito y entonces envia a la pantalla de la lista de pacientes
            alert("¡Usuario eliminado con exito!");
            location.href = "../../Screens/recepcionistScreens/SeeClientScreen.php";
          </script>
        <?php
      }
    }
  }
?>
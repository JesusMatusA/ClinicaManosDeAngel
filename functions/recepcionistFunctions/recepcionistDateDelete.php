<?php 
  include("../../DBConnection/connect.php");
  //comrpobar que ocurrio un post
  if(!empty($_POST)){
    //obtener la id de la cita a eliminar
    $idDate = $_POST['idDate'];
    //crear la consulta para eliminar la cita y ejecutarla
    $query = "DELETE FROM citas WHERE Id_Cita = :idDate";
    $stmt = $connection->prepare($query);
    $stmt->bindParam(':idDate', $idDate, PDO::PARAM_INT);
    //comprobar que se ejecuto el comando
    if($stmt->execute()){
      //comprobar que el comando elimino con exito la cita
      if($stmt->rowCount() > 0){
        ?>
          <script>
            //altera que avisa que la cita fue eliminada con exito y entonces envia a la pantalla de la lista de citas
            alert("¡Cita eliminada con exito!");
            location.href = "../../Screens/recepcionistScreens/SeeDateScreen.php";
          </script>
        <?php
      }
    }
  }
?>
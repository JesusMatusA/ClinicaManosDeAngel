<?php 
include("../../DBConnection/connect.php");
if(!empty($_POST)){
    $name = ucfirst(strtolower($_POST['name']));
    $middlename = ucfirst(strtolower($_POST['middlename']));
    $lastname = ucfirst(strtolower($_POST['lastname']));
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    //preparamos la insercion del paciente
    $query = "INSERT INTO pacientes(Id_Paciente, nombres, aPaterno, aMaterno, correo, telefono) VALUES(null, :name, :middlename, :lastname, :email, :phone)";
    $stmt = $connection->prepare($query);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':middlename', $middlename, PDO::PARAM_STR);
    $stmt->bindParam(':lastname', $lastname, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':phone', $phone, PDO::PARAM_INT);
    //comprobamos que se ejecuto la inserción y que se realizo con exito
    if($stmt->execute()){
      if($stmt->rowCount() > 0){
          ?>
            <script>
              //Alerta que avisa que la acción fue un exito y entonces devuelve a otra pantalla
              alert("Paciente registrado con exito!");
              location.href = "../../Screens/recepcionistScreens/AddClientScreen.php";
            </script>
          <?php
      }
    }
}
?>
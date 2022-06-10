<?php 
include("../../DBConnection/connect.php");
if(!empty($_POST)){
    $name = ucfirst(strtolower($_POST['name']));
    $middlename = ucfirst(strtolower($_POST['middlename']));
    $lastname = ucfirst(strtolower($_POST['lastname']));
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $sql = "SELECT COUNT(*) FROM pacientes WHERE nombres=:name AND aPaterno=:middlename AND aMaterno=:lastname";
    $st = $connection->prepare($sql);
    $st->bindParam(":name", $name, PDO::PARAM_STR);
    $st->bindParam(":middlename", $middlename, PDO::PARAM_STR);
    $st->bindParam(":lastname", $lastname, PDO::PARAM_STR);
    if($st->execute()){
      $result = $st->fetch(PDO::FETCH_ASSOC);
      if($result['total'] > 0){
        ?>
          <script>
            alert("Error: Ya hay un paciente con ese nombre");
            location.href="../../Screens/recepcionistScreens/AddClientScreen.php";
          </script>
        <?php
      }
    }
    $sql = "SELECT COUNT(*) FROM pacientes WHERE correo =:email";
    $st = $connection->prepare($sql);
    $st->bindParam(":email", $email, PDO::PARAM_STR);
    if($st->execute()){
      $result = $st->fetch(PDO::FETCH_ASSOC);
      if($result['total'] > 0){
        ?>
          <script>
            alert("Error: El correo ya pertenece a un paciente");
            location.href="../../Screens/recepcionistScreens/AddClientScreen.php";
          </script>
        <?php
      }
    }
    $sql = "SELECT COUNT(*) FROM pacientes WHERE telefono=:phone";
    $st = $connection->prepare($sql);
    $st->bindParam(":phone", $phone, PDO::PARAM_INT);
    if($st->execute()){
      $result = $st->fetch(PDO::FETCH_ASSOC);
      if($result['total'] > 0){
        ?>
          <script>
            alert("Error: El teléfono ya pertenece a un paciente");
            location.href="../../Screens/recepcionistScreens/AddClientScreen.php";
          </script>
        <?php
      }
    }

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
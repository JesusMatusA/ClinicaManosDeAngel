<?php
  include("../../Components/requeriments.php");
  include("../../Components/recepcionistComponents/recepcionistStyles.php");
  include("../../Components/recepcionistComponents/nav-container.php");
  include("../../DBConnection/connect.php");

  if(empty($_GET['Id'])){
    header('Location: SeeClientScreen.php');
  } else{
    $idPatient = $_GET['Id'];
    $query = "SELECT nombres, aPaterno, aMaterno, correo, telefono FROM pacientes WHERE Id_Paciente = $idPatient";
    if($result = $connection->query($query)){
      if($result->fetchColumn() > 0){
        foreach($connection->query($query) as $fila){
          $name = $fila['nombres']." ".$fila['aPaterno']." ".$fila['aMaterno'];
          $email = $fila['correo'];
          $phone = $fila['telefono'];
        }
      }
    }
  }
?>
<div class="bodyContainer">
    <div class="optionsContainer">
        <?php
        include("../../Components/recepcionistComponents/barOptions-container.php");
      ?>
    </div>
    <div class="showsContainer">
        <div class="screenOptionContainer">
            <div class="nameOptionContainer">
                <div class="option">Eliminar Paciente</div>
            </div>
            <div class="formContainer">
                <div class="formAdd">
                    <form action="../../functions/recepcionistFunctions/recepcionistClientDelete.php" method="post" class="form">
                        <div class="form">
                            <input name="idPatient" value="<?php echo $idPatient ?>" hidden />
                            <input disabled value="<?php echo $name?>" class="inputTextDesign" />
                            <input disabled value="<?php echo $email?>" class="inputTextDesign" />
                            <input disabled value="<?php echo $phone?>" class="inputTextDesign" />
                            <input type="submit" name="submit" value="Eliminar" class="buttonAdd" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
  include("../../Components/footer-container.php");
  include("../../Components/endCode.php");
?>
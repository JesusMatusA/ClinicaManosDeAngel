<?php
  include("../../Components/requeriments.php");
  include("../../Components/doctorComponents/doctorStyles.php");
  include("../../Components/doctorComponents/nav-container.php");
  include("../../DBConnection/connect.php");

  session_start();
  if(!isset($_SESSION['user'])){
    header("Location:../../Login.php");
  } else{
    if(!(strcasecmp($_SESSION['user'][1], "doctor")==0)){
      header("Location:../../Login.php");
    }
  }

  if(empty($_GET['Id'])){
    header('Location: SeePatientScreen.php');
  }else{
    $idPatient = $_GET['Id'];
    $date = date("Y-m-d");
    $query = "SELECT nombres, aPaterno, aMaterno, correo, telefono FROM pacientes WHERE Id_Paciente = $idPatient";
    if($result = $connection->query($query)){
      if($result->fetchColumn() > 0){
        foreach($connection->query($query) as $fila){
          $name = $fila['nombres'];
          $middlename = $fila['aPaterno'];
          $lastname = $fila['aMaterno'];
          $email = $fila['correo'];
          $telephone = $fila['telefono'];
        }
      }
    }
  }
?>
<div class="bodyContainer">
    <div class="optionsContainer">
      <?php
        include("../../Components/doctorComponents/barOptions-container.php");
      ?>
    </div>
    <div class="showsContainer">
        <div class="screenOptionContainer">
            <div class="nameOptionContainer">
                <div class="option">Datos del Paciente</div>
            </div>
            <div class="formContainer">
                <div class="formAdd">
                    <form action="../../functions/recepcionistFunctions/recepcionistClientUpdate.php" method="post" class="form">
                        <div class="form">
                            <input value="<?php echo $name?>" class="inputTextDesign" disabled/>
                            <input value="<?php echo $middlename?>" class="inputTextDesign" disabled />
                            <input value="<?php echo $lastname?>" class="inputTextDesign" disabled />
                            <input value="<?php echo $email?>" class="inputTextDesign" disabled />
                            <input value="<?php echo $telephone ?>" class="inputTextDesign" disabled />
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
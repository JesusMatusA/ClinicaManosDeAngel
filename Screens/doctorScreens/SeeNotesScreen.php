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
  //comprobar que en la url tenemos el ID del paciente
  if(empty($_GET['IdPatient']) & empty($_GET['IdNote'])){
    //si no se encuentran los tres datos en la url entonces redirecciona a la pantalla de ver pacientes
    header('Location: SeePatientScreen.php');
  }else{
    $idPatient = $_GET['IdPatient'];
    $idRecord = $_GET['IdNote'];
    $query = "SELECT nombres, aPaterno, aMaterno  FROM pacientes WHERE Id_Paciente = $idPatient";
    if($result = $connection->query($query)){
      if($result->fetchColumn() > 0){
        foreach($connection->query($query) as $fila){
          $name = $fila['nombres'];
          $middlename = $fila['aPaterno'];
          $lastname = $fila['aMaterno'];
        }
      }
    }
    $query = "SELECT nota FROM bitacoracita WHERE Id_BitacoraCita = $idRecord";
    if($result = $connection->query($query)){
        if($result->fetchColumn() > 0){
          foreach($connection->query($query) as $fila){
            $nota = $fila['nota'];
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
                <div class="option">Nota del Paciente</div>
            </div>
            <div class="formContainer">
                <div class="formAdd">
                    <form action="../../functions/doctorFunctions/doctorAddNotePatient.php" method="post" class="form">
                        <div class="form">
                            <input type="text" placeholder="Nombres" value="<?php echo $name." ".$middlename." ".$lastname;?>" disabled class="inputTextDesign"/>
                            <textarea disabled placeholder="<?php echo $nota;?>" class="inputTextDesign txtarea" value="hola"></textarea>
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
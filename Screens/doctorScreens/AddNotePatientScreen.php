<?php
  include("../../Components/requeriments.php");
  include("../../Components/doctorComponents/doctorStyles.php");
  include("../../Components/doctorComponents/nav-container.php");
  include("../../DBConnection/connect.php");

  session_start();
  if(!isset($_SESSION['user'])){
    header("Location:../../Index.php");
  } else{
    if(!(strcasecmp($_SESSION['user'][1], "doctor")==0)){
      header("Location:../../Index.php");
    }
  }
  //comprobar que en la url tenemos el ID del paciente, el ID de la cita y el ID de empleado
  if(empty($_GET['IdPat']) & empty($_GET['IdDate']) & empty($_GET['IdEmp'])){
    //si no se encuentran los tres datos en la url entonces redirecciona a la pantalla de ver pacientes
    header('Location: SeePatientScreen.php');
  }else{
    $idPatient = $_GET['IdPat'];
    $idDate = $_GET['IdDate'];
    $idEmp = $_GET['IdEmp'];
    $date = date("Y-m-d");
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
                <div class="option">Añadir Nota Sobre El Paciente</div>
            </div>
            <div class="formContainer">
                <div class="formAdd">
                    <form action="../../functions/doctorFunctions/doctorAddNotePatient.php" method="post" class="form">
                      <input type="number" name="IdDate" value="<?php echo $idDate?>" hidden />
                      <input type="number" name="IdEmp" value="<?php echo $idEmp?>" hidden />
                      <input type="text" placeholder="Nombres" value="<?php echo $name." ".$middlename." ".$lastname?>" disabled class="inputTextDesign"/>
                      <textarea maxlength="500" placeholder="Nota sobre el paciente" name="Notes" class="inputTextDesign txtarea" required></textarea>
                      <input type="submit" name="submit" value="Actualizar" class="buttonAdd" />
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
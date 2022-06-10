<?php
  include("../../Components/requeriments.php");
  include("../../Components/recepcionistComponents/recepcionistStyles.php");
  include("../../Components/recepcionistComponents/nav-container.php");
  include("../../DBConnection/connect.php");
  //comprueba que haya una sesión
  session_start();
  if(!isset($_SESSION['user'])){
    header("Location:../../Index.php");
  } else{
    if(!(strcasecmp($_SESSION['user'][1], "recepcionista")==0)){
      header("Location:../../Index.php");
    }
  }
  if(empty($_GET['Id'])){
    header('Location: SeeClientScreen.php');
  }else{
    $idPatient = $_GET['Id'];
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
      include("../../Components/recepcionistComponents/barOptions-container.php");
    ?>
    </div>
    <div class="showsContainer">
        <div class="screenOptionContainer">
            <div class="nameOptionContainer">
                <div class="option">Actualizar Información del Cliente</div>
            </div>
            <div class="formContainer">
                <div class="formAdd">
                    <form action="../../functions/recepcionistFunctions/recepcionistClientUpdate.php" method="post" class="form">
                        <div class="form">
                            <input type="text" name="IdPatient" value="<?php echo $idPatient?>" hidden />
                            <input type="text" title="Sólo carácteres alfabeticos" pattern="[a-zA-ZÁ-ÿ]{1,}"  placeholder="Nombres" value="<?php echo $name?>" name="name"autocomplete="none" class="inputTextDesign" required />
                            <input type="text" title="Sólo carácteres alfabeticos" pattern="[a-zA-ZÁ-ÿ]{1,}"  placeholder="Apellido paterno" value="<?php echo $middlename?>"name="middlename" autocomplete="none" class="inputTextDesign" required />
                            <input type="text" title="Sólo carácteres alfabeticos" pattern="[a-zA-ZÁ-ÿ]{1,}"  placeholder="Apellido materno" value="<?php echo $lastname?>"name="lastname" autocomplete="none" class="inputTextDesign" required />
                            <input type="email" title="Debe seguir este formato: Nombre@ServidorDeCorreo.Dominio" pattern="([a-zA-Z]|[0-9]){1,}@[a-zA-Z]{1,}.[a-zA-Z]{1,}(\s|.)" placeholder="Correo electrónico" value="<?php echo $email?>"name="email" autocomplete="none" class="inputTextDesign" required />
                            <input type="tel" title="Sólo números" maxlength="10" pattern="[0-9]{1,}"  value="<?php echo $telephone ?>"name="telephone" autocomplete="none" class="inputTextDesign" required />
                            <input type="submit" name="submit" value="Actualizar" class="buttonAdd" />
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
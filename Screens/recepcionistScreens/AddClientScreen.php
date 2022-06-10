<?php
  include("../../Components/requeriments.php");
  include("../../Components/recepcionistComponents/recepcionistStyles.php");
  include("../../Components/recepcionistComponents/nav-container.php");
  //comprueba que haya una sesión
  session_start();
  if(!isset($_SESSION['user'])){
    header("Location:../../Login.php");
  } else{
    if(!(strcasecmp($_SESSION['user'][1], "recepcionista")==0)){
      header("Location:../../Login.php");
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
                <div class="option">Registrar Cliente</div>
            </div>
            <div class="formContainer">
                <div class="formAdd">
                    <form action="../../functions/recepcionistFunctions/recepcionistAddClient.php" method="post" class="form">
                        <div class="form">
                            <input type="text"  pattern="[a-zA-ZÁ-ÿ]{1,}" placeholder="Nombres" name="name" class="inputTextDesign" required autocomplete="none" maxlength="30" />
                            <input type="text"  pattern="[a-zA-ZÁ-ÿ]{1,}" placeholder="Apellido paterno" name="middlename" class="inputTextDesign" required autocomplete="none" maxlength="20" />
                            <input type="text"  pattern="[a-zA-ZÁ-ÿ]{1,}" placeholder="Apellido materno" name="lastname" class="inputTextDesign" required autocomplete="none" maxlength="20" />
                            <input type="email" pattern="([a-zA-Z]|[0-9]){1,}@[a-zA-Z]{1,}.[a-zA-Z]{1,}(\s|.)" placeholder="Correo electrónico" name="email" class="inputTextDesign" required autocomplete="none" maxlength="30" />
                            <input type="tel"   pattern="[0-9]{1,}" placeholder="Teléfono Celular" name="phone" class="inputTextDesign" required autocomplete="none" maxlength="10" />
                            <input type="submit" name="submit" value="Registrar" class="buttonAdd">
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
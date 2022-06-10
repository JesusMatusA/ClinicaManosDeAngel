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
                <div class="option">Bienvenid@</div>
            </div>
        </div>
    </div>
</div>
<?php
  include("../../Components/footer-container.php");
  include("../../Components/endCode.php");
?>
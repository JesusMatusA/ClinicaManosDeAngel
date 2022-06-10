<?php
  include("../../Components/requeriments.php ");
  include("../../Components/storageComponents/storageStyles.php");
  include("../../Components/storageComponents/nav-container.php");
  session_start();
  if(!isset($_SESSION['user'])){
    header("Location:../../Index.php");
  } else{
    if(!(strcasecmp($_SESSION['user'][1], "almacenista")==0)){
      header("Location:../../Index.php");
    }
  }
?>
<div class="bodyContainer">
    <div class="optionsContainer">
      <?php
        include("../../Components/storageComponents/barOptions-container.php");
      ?>
    </div>
    <div class="showsContainer">
        <div class="screenOptionContainer">
          <div class="nameOptionContainer">
            <div class="option">Bienvenid@</div>
          </div>
          <div class="formContainer">
            <div class="formAdd">
              <div class="form">
              </div>
            </div>
          </div>
        </div>
      </div>
</div>
<?php
  include("../../Components/footer-container.php");
  include("../../Components/endCode.php");
?>

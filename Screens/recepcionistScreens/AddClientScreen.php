<?php
  include("../../Components/requeriments.php");
  include("../../Components/recepcionistComponents/recepcionistStyles.php");
  include("../../Components/recepcionistComponents/nav-container.php");
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
                            <input type="text" placeholder="Nombres" name="name" class="inputTextDesign" required
                                autocomplete="none" maxlength="30"/>
                            <input type="text" placeholder="Apellido paterno" name="middlename" class="inputTextDesign"
                                required autocomplete="none" maxlength="20" />
                            <input type="text" placeholder="Apellido materno" name="lastname" class="inputTextDesign"
                                required autocomplete="none" maxlength="20" />
                            <input type="email" placeholder="Correo electrónico" name="email" class="inputTextDesign"
                                required autocomplete="none" maxlength="30" />
                            <input type="tel" placeholder="Teléfono o Celular" name="phone" class="inputTextDesign"
                                required autocomplete="none" maxlength="10" />
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
<?php
  include("../../Components/requeriments.php");
  include("../../Components/recepcionistComponents/recepcionistStyles.php");
  include("../../Components/recepcionistComponents/nav-container.php");
  include("../../DBConnection/connect.php");

  if(empty($_GET['Id'])){
    header('Location: firstScreen.php');
  }else{
    $idPatient = $_GET['Id'];
    $query = "SELECT nombres, aPaterno, aMaterno FROM pacientes WHERE Id_Paciente = $idPatient";
    if($result = $connection->query($query)){
      if($result->fetchColumn() > 0){
        foreach($connection->query($query) as $fila){
          $nameComplete = $fila['nombres']." ".$fila['aPaterno']." ".$fila['aMaterno'];
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
                <div class="option">Agendar una cita</div>
            </div>
            <div class="formContainer">
                <div class="formAdd">
                    <form action="../../functions/recepcionistFunctions/recepcionistAddDate.php" method="post" class="form">
                        <div class="form">
                            <input type="text" class="inputTextDesign" name="idPatient" value="<?php echo $idPatient?>" hidden/>
                            <input type="text" class="inputTextDesign" value="<?php echo $nameComplete?>" disabled/>
                            <select name="idDoctor" class="inputTextDesign notItemOne" required>
                            <?php
                              $sql = "SELECT d.Id_Doctor, nombres, aPaterno, aMaterno FROM empleados e INNER JOIN doctores d ON e.Id_Empleado = d.Id_Empleado";
                              echo "<option select>Doctor</option>";
                              if($res = $connection->query($sql)){
                                  if($res->fetchColumn() > 0){
                                    foreach($connection->query($sql) as $row){
                                      ?>
                                        <option value="<?php echo $row['Id_Doctor']?>"> <?php echo $row['nombres']." ".$row['aPaterno']." ".$row['aMaterno'];?> </option>
                                      <?php
                                  }
                                }
                              }
                            ?>
                            </select>
                            <input type="date" name="patientDate" class="inputTextDesign" required />
                            <input type="time" name="patientTimeDate" class="inputTextDesign" required/>
                            <textarea placeholder="Diagnóstico" name="Diagnosis"
                                class="inputTextDesign Diagnosis" required></textarea>
                            <input type="submit" name="submit" value="guardar" class="buttonAdd" />
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
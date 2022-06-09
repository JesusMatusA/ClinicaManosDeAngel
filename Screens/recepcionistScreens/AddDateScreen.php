<?php
  include("../../Components/requeriments.php");
  include("../../Components/recepcionistComponents/recepcionistStyles.php");
  include("../../Components/recepcionistComponents/nav-container.php");
  include("../../DBConnection/connect.php");
  //comprobar que recibimos la ID del paciente
  if(empty($_GET['Id'])){
    //si no hay ID, entonces redirecciona a la pantalla de inicio
    header('Location: firstScreen.php');
  }else{
    //si hay ID, entonces la guardamos en una variable llamada $idPatient
    $idPatient = $_GET['Id'];
    //creamos una consulta que nos traiga el nombre del paciente usando su ID
    $query = "SELECT nombres, aPaterno, aMaterno FROM pacientes WHERE Id_Paciente = $idPatient";
    //ejecutamos la consulta y guardamos el resultado en $result
    if($result = $connection->query($query)){
      //comprobamos que el resultado contenga datos
      if($result->fetchColumn() > 0){
        //ejecutamos otra vez el query para poder usar los datos
        foreach($connection->query($query) as $fila){
          //concatenamos el resultado y lo guardamos en la variable $nameComplete
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
                              echo "<option selected>Doctor</option>";
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
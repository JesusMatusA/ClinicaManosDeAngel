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
  if(empty($_GET['Id'])){
    header('Location: SeePatientScreen.php');
  }else{
    $idPatient = $_GET['Id'];
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
                <div class="option">Notas del Paciente</div>
            </div>
            <div class="formContainer">
                <table class="tableP">
                    <tr class="tableTRP">
                        <th class="tableTHP">Nombre</th>
                        <th class="tableTHP">Fecha</th>
                        <th class="tableTHPL">Acción</th>
                    </tr>
                    <?php
                        include("../../DBConnection/connect.php");
                        $idEmpleado = $_SESSION['user'][2];
                        //ver fecha actual
                        $date = date('Y-m-d');
                        //ver cuantos registros coinciden con la busqueda
                        $sql = "SELECT COUNT(*) as total FROM bitacoracita b 
                            INNER JOIN citas c ON b.Id_Cita=c.Id_Cita
                            INNER JOIN pacientes p ON c.Id_Paciente=p.Id_Paciente
                            WHERE p.Id_Paciente = $idPatient";
                        $total_register = null;
                        //obtener el numero de registros en la variable $total_register
                        foreach($connection->query($sql) as $row){
                            $total_register = $row['total'];
                        }
                        //numero de registros por pagina
                        $por_pagina=6;
                        //comprobar en que página se encuentra
                        if(empty($_GET['page'])){
                            $pagina = 1;
                        }else{
                            $pagina = $_GET['page'];
                        }
                        //calcular desde que registro se debe buscar
                        $desde = ($pagina-1) * $por_pagina;
                        //calcular el total de páginas que habrá
                        $total_paginas = ceil($total_register / $por_pagina);
                        //consulta que trae los datos de los registros desde la página $desde hasta $por_pagina
                        if($result = $connection->query($sql)){
                            if($result->fetchColumn() > 0){
                                //consulta que permite obtener del paciente que tenga asignado el doctor
                                $query = "SELECT c.fecha_Cita, p.Id_Paciente, nombres, aPaterno, aMaterno, b.Id_BitacoraCita FROM bitacoracita b 
                                    INNER JOIN citas c ON b.Id_Cita=c.Id_Cita
                                    INNER JOIN pacientes p ON c.Id_Paciente=p.Id_Paciente
                                    WHERE p.Id_Paciente = $idPatient 
                                    ORDER BY c.hora_cita ASC LIMIT $desde, $por_pagina";
                                //bucle que permite crear una tabla con los datos obtenidos de forma dinamica
                                foreach($connection->query($query) as $fila){
                                    ?>
                                    <tr class="tableTRP">
                                        <td class="tableTDP"><?php echo $fila['nombres']." ".$fila['aPaterno']." ".$fila['aMaterno'];?>
                                        </td>
                                        <td class="tableTDP"><?php echo $fila['fecha_Cita'];?></td>
                                        <td class="tableTDPL">
                                            <a class="link_a" href="SeeNotesScreen.php?IdPatient=<?php echo $fila['Id_Paciente'];?>&IdNote=<?php echo $fila['Id_BitacoraCita'];?>">Ver Notas</a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                        }
                    ?>
                </table>
            </div>
            <div class="paginador">
                <ul>
                    <?php
                        if($pagina != 1)
                        {
                    ?>
                    <li><a href="?Id=<?php echo $idPatient;?>&page=<?php echo 1;?>"> << </a></li>
                    <li><a href="?Id=<?php echo $idPatient;?>&page=<?php echo ($pagina-1);?>"> < </a></li>
                    <?php 
                        }
                        //coloca dinamicamente el numero de paginas en el paginador
                        for ($i=1; $i <= $total_paginas; $i++) { 
                            if($i == $pagina)
                            { 
                                echo '<li class="pageSelected">'.$i.'</a></li>';
                            }else{
                                echo '<li><a href="?Id='.$idPatient.'&page='.$i.'">'.$i.'</a></li>';
                            }
                        }
                        if($pagina != $total_paginas){
                    ?>
                    <li><a href="?Id=<?php echo $idPatient;?>&page=<?php echo ($pagina+1);?>"> > </a></li>
                    <li><a href="?Id=<?php echo $idPatient;?>&page=<?php echo $total_paginas;?>"> >> </a></li>
                    <?php
                        }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php
  include("../../Components/footer-container.php");
  include("../../Components/endCode.php");
?>
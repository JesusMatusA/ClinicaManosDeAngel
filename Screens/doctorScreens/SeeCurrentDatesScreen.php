<?php
  include("../../Components/requeriments.php");
  include("../../Components/doctorComponents/doctorStyles.php");
  include("../../Components/doctorComponents/nav-container.php");
  session_start();
  if(!isset($_SESSION['user'])){
    header("Location:../../Login.php");
  } else{
    if(!(strcasecmp($_SESSION['user'][1], "doctor")==0)){
      header("Location:../../Login.php");
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
                <div class="option">Citas del Día de Hoy</div>
            </div>
            <div class="formContainer">
                <table class="tableP">
                    <tr class="tableTRP">
                        <th class="tableTHP">Nombre</th>
                        <th class="tableTHP">Hora de la cita</th>
                        <th class="tableTHPL">Acción</th>
                    </tr>
                    <?php
                        include("../../DBConnection/connect.php");
                        $idEmpleado = $_SESSION['user'][2];
                        //ver fecha actual
                        $date = date('Y-m-d');
                        //ver cuantos registros coinciden con la busqueda
                        $sql = 'SELECT count(*) as total FROM pacientes p 
                            INNER JOIN citas c ON p.Id_Paciente=c.Id_Paciente
                            INNER JOIN doctores d ON c.Id_Doctor=d.Id_Doctor 
                            INNER JOIN empleados e ON d.Id_Empleado=e.Id_Empleado
                            WHERE e.Id_Empleado = "'.$idEmpleado.'" AND fecha_Cita = "'.$date.'"';
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
                                $query = 'SELECT p.Id_Paciente, p.nombres, p.aPaterno, p.aMaterno, c.Id_Cita, c.hora_Cita FROM pacientes p 
                                    INNER JOIN citas c ON p.Id_Paciente=c.Id_Paciente
                                    INNER JOIN doctores d ON c.Id_Doctor = d.Id_Doctor 
                                    INNER JOIN empleados e ON d.Id_Empleado = e.Id_Empleado
                                    WHERE e.Id_Empleado = '.$idEmpleado.' AND c.fecha_Cita="'.$date.'" 
                                    ORDER BY c.hora_cita ASC LIMIT '.$desde.','.$por_pagina;
                                //bucle que permite crear una tabla con los datos obtenidos de forma dinamica
                                foreach($connection->query($query) as $fila){
                                    ?>
                                    <tr class="tableTRP">
                                        <td class="tableTDP"><?php echo $fila['nombres']." ".$fila['aPaterno']." ".$fila['aMaterno'];?>
                                        </td>
                                        <td class="tableTDP"><?php echo $fila['hora_Cita']?></td>
                                        <td class="tableTDPL">
                                            <a class="link_a" href="AddNotePatientScreen.php?IdPat=<?php echo $fila['Id_Paciente'];?>
                                                &IdDate=<?php echo $fila['Id_Cita'];?>&IdEmp=<?php echo $idEmpleado;?>">Agregar Nota</a>
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
                    <li><a href="?page=<?php echo 1;?>"> << </a></li>
                    <li><a href="?page=<?php echo ($pagina-1);?>"> < </a></li>
                    <?php 
                        }
                        //coloca dinamicamente el numero de paginas en el paginador
                        for ($i=1; $i <= $total_paginas; $i++) { 
                            if($i == $pagina)
                            { 
                                echo '<li class="pageSelected">'.$i.'</a></li>';
                            }else{
                                echo '<li><a href="?page='.$i.'">'.$i.'</a></li>';
                            }
                        }
                        if($pagina != $total_paginas){
                    ?>
                    <li><a href="?page=<?php echo ($pagina+1);?>"> > </a></li>
                    <li><a href="?page=<?php echo $total_paginas;?>"> >> </a></li>
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
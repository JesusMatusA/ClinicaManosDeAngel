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
                <div class="option">Lista de Tus Pacientes</div>
            </div>
            <div class="formContainer">
                <table class="tableP">
                    <tr class="tableTRP">
                        <th class="tableTHP">Nombre</th>
                        <th class="tableTHPL">Acción</th>
                    </tr>
                    <?php
                        include("../../DBConnection/connect.php");
                        $idEmpleado = $_SESSION['user'][2];
                        //ver cuantos registros coinciden con la busqueda
                        $query = "SELECT COUNT(DISTINCT p.Id_Paciente) as total FROM pacientes p
                            INNER JOIN citas c on p.Id_Paciente=c.Id_Paciente
                            INNER JOIN doctores d ON c.Id_Doctor=d.Id_Doctor
                            WHERE d.Id_Empleado = $idEmpleado";
                        $total_register = null;
                        //obtener el numero de registros en la variable $total_register
                        foreach($connection->query($query) as $row){
                            $total_register = $row['total'];
                        }
                        //numero de registros por pagina
                        $por_pagina=6;
                        //comprobar en que página se encuetnra
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
                        if($result = $connection->query($query)){
                            if($result->fetchColumn() > 0){
                                //consulta que permite obtener el los datos del paciente del doctor que haya iniciado sesión
                                $query = "SELECT DISTINCT p.Id_Paciente, p.nombres, p.aPaterno, p.aMaterno FROM pacientes p
                                    INNER JOIN citas c on p.Id_Paciente=c.Id_Paciente
                                    INNER JOIN doctores d ON c.Id_Doctor=d.Id_Doctor
                                    WHERE d.Id_Empleado = $idEmpleado
                                    ORDER BY p.nombres, p.aPaterno, p.aMaterno ASC LIMIT $desde,$por_pagina";
                                foreach($connection->query($query) as $fila){
                                    ?>
                                    <tr class="tableTRP">
                                        <td class="tableTDP"><?php echo $fila['nombres']." ".$fila['aPaterno']." ".$fila['aMaterno'];?>
                                        </td>
                                        <td class="tableTDPL">
                                            <a class="link_a" href="SeePatientDataScreen.php?Id=<?php echo $fila['Id_Paciente'];?>">Ver datos</a>
                                            |
                                            <a class="link_a" href="SeePatientNotesScreen.php?Id=<?php echo $fila['Id_Paciente'];?>">Ver Notas</a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                        }else{
                            echo "<script>alert.('Error:')</script>";
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
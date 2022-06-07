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
                <div class="option">Lista de Citas</div>
            </div>
            <div class="listPatientDate">
                <?php
                    //comprobar que hay una busqueda
                    $busqueda = strtolower($_REQUEST['search']);
                    if(empty($busqueda)){
                        header("Location: seeDateScreen.php");
                    }
                ?>
                <form action="searchDateScreen.php" method="get">
                    <input type="search" name="search" placeholder="Buscar por nombre" value="<?php echo $busqueda; ?>">
                    <button type="submit" name="submit">Buscar</button>
                </form>
            </div>
            <div class="formContainer">
                <table class="tableD">
                    <tr class="tableTRD">
                        <th class="tableTHD">Paciente</th>
                        <th class="tableTHD">Doctor</th>
                        <th class="tableTHD">Fecha</th>
                        <th class="tableTHD">Hora</th>
                        <th class="tableTHD">Acción</th>
                    </tr>
                    <?php
                        include("../../DBConnection/connect.php");
                        //ver cuantos registros coinciden con la busqueda
                        $query = "SELECT COUNT(*) AS total FROM pacientes p INNER JOIN citas c on p.Id_Paciente = c.Id_Paciente 
                            WHERE p.nombres LIKE '%$busqueda%'";
                        $total_register = null;
                        //obtener el numero de registros en la variable $total_register
                        foreach($connection->query($query) as $row){
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
                        //calcular el total de paginas que habrá
                        $total_paginas = ceil($total_register / $por_pagina);
                        //consulta que trae los datos de los registros desde la página $desde hasta $por_pagina
                        //busca el los datos del paciente y doctor
                        $query = "SELECT c.Id_Cita, p.Id_Paciente, p.nombres as Pnombre, p.aPaterno as PaPaterno, p.aMaterno as PaMaterno, 
                            d.nombres as Dnombre, d.aPaterno as DaPaterno, d.aMaterno as DaMaterno, fecha_Cita, hora_Cita 
                            FROM pacientes p 
                            INNER JOIN citas c on p.Id_Paciente = c.Id_Paciente 
                            INNER JOIN doctores o ON c.Id_Doctor = o.Id_Doctor
                            INNER JOIN empleados d ON o.Id_Empleado = d.Id_Empleado
                            WHERE p.nombres LIKE '%$busqueda%' ORDER BY p.Id_Paciente ASC 
                            LIMIT $desde,$por_pagina";
                        //generar las filas de la tabla
                        foreach($connection->query($query) as $fila){
                            ?>
                                <tr class="tableTRD">
                                    <td class="tableTDD">
                                        <?php echo $fila['Pnombre']." ".$fila['PaPaterno']." ".$fila['PaMaterno'];?>
                                    </td>
                                    <td class="tableTDD">
                                        <?php echo $fila['Dnombre']." ".$fila['DaPaterno']." ".$fila['DaMaterno'];?>
                                    </td>
                                    <td class="tableTDD"><?php echo $fila['fecha_Cita']?></td>
                                    <td class="tableTDD"><?php echo $fila['hora_Cita']?></td>
                                    <td class="tableTDD">
                                        <a class="link_a" href="UpdateDateScreen.php?Id=<?php echo $fila['Id_Cita']?>">Reagendar</a>
                                        |
                                        <a class="link_a" href="DeleteDateScreen.php?Id=<?php echo $fila['Id_Cita']?>">Eliminar</a>
                                    </td>
                                </tr>
                            <?php
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
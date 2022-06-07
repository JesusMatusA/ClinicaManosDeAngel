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
                <div class="option">Lista de Pacientes</div>
            </div>
            <div class="listPatientDate">
                <form action="searchClientScreen.php" method="get">
                    <input type="search" name="search" placeholder="Buscar por nombre">
                    <button type="submit" name="submit">Buscar</button>
                </form>
            </div>
            <div class="formContainer">
                <table class="tableC">
                    <tr class="tableTRC">
                        <th class="tableTHC">Nombre</th>
                        <th class="tableTHC">Correo</th>
                        <th class="tableTHC">Teléfono</th>
                        <th class="tableTHCL">Acción</th>
                    </tr>
                    <?php
                        include("../../DBConnection/connect.php");
                        //ver cuantos registros coinciden con la busqueda
                        $query = "SELECT COUNT(*) AS total FROM pacientes";
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

                                $query = "SELECT Id_Paciente, nombres, aPaterno, aMaterno, correo, telefono FROM pacientes 
                                    ORDER BY Id_Paciente ASC LIMIT $desde,$por_pagina";
                                foreach($connection->query($query) as $fila){
                                    ?>
                                    <tr class="tableTRC">
                                        <td class="tableTDC"><?php echo $fila['nombres']." ".$fila['aPaterno']." ".$fila['aMaterno'];?>
                                        </td>
                                        <td class="tableTDC"><?php echo $fila['correo']?></td>
                                        <td class="tableTDC"><?php echo $fila['telefono']?></td>
                                        <td class="tableTDCL">
                                            <a class="link_a" href="AddDateScreen.php?Id=<?php echo $fila['Id_Paciente']?>">Agendar Cita</a>
                                            |
                                            <a class="link_a" href="UpdateClientScreen.php?Id=<?php echo $fila['Id_Paciente']?>">Editar</a>
                                            |
                                            <a class="link_a" href="DeleteClientScreen.php?Id=<?php echo $fila['Id_Paciente']?>">Eliminar</a>
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
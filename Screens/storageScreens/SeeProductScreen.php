<?php
  include("../../Components/requeriments.php ");
  include("../../Components/storageComponents/storageStyles.php");
  include("../../Components/storageComponents/nav-container.php");
  include("../../DBConnection/connect.php");
  session_start();
  if(!isset($_SESSION['user'])){
    header("Location:../../Login.php");
  } else{
    if(!(strcasecmp($_SESSION['user'][1], "almacenista")==0)){
      header("Location:../../Login.php");
    }
  }
  session_start();
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
                <div class="option">Notas del Paciente</div>
            </div>
            <div class="formContainer">
                <table class="table">
                    <tr class="tableTR">
                        <th class="tableTH">Código</th>
                        <th class="tableTH">Nombre</th>
                        <th class="tableTH">Stock Mínimo</th>
                        <th class="tableTH">Stock Máximo</th>
                        <th class="tableTH">Existencia</th>
                        <th class="tableTH">Acción</th>
                    </tr>
                    <?php
                        include("../../DBConnection/connect.php");
                        //ver cuantos registros coinciden con la busqueda
                        $sql = "SELECT COUNT(*) as total FROM productos";
                        $total_register = null;
                        //obtener el numero de registros en la variable $total_register
                        foreach($connection->query($sql) as $row){
                            $total_register = $row['total'];
                        }
                        //numero de registros por pagina
                        $por_pagina=10;
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
                                $query = "SELECT codigo_producto, nombre, stockMin, stockMax, existencias FROM productos
                                    ORDER BY nombre ASC LIMIT $desde, $por_pagina";
                                //bucle que permite crear una tabla con los datos obtenidos de forma dinamica
                                foreach($connection->query($query) as $fila){
                                    ?>
                                    <tr class="tableTR">
                                        <td class="tableTD"><?php echo $fila['codigo_producto'];?></td>
                                        <td class="tableTD"><?php echo $fila['nombre'];?></td>
                                        <td class="tableTD"><?php echo $fila['stockMin'];?></td>
                                        <td class="tableTD"><?php echo $fila['stockMax'];?></td>
                                        <td class="tableTD"><?php echo $fila['existencias'];?></td>
                                        <td class="tableTD">
                                            <a class="link_a" href="InputProductScreen.php?Code=<?php echo $fila['codigo_producto'];?>">Entrada</a>
                                            |
                                            <a class="link_a" href="OutputProductScreen.php?Code=<?php echo $fila['codigo_producto'];?>">Salida</a>
                                            |
                                            <a class="link_a" href="DeleteProductScreen.php?Code=<?php echo $fila['codigo_producto'];?>">Eliminar</a>
                                            |
                                            <a class="link_a" href="UpdateProductScreen.php?Code=<?php echo $fila['codigo_producto'];?>">Modificar</a>
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
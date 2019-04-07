<?php

include_once '../config/config.php';
include_once '../config/seguridad.php';
include_once '../config/variables.php';

seguridad(EMPLEADO);

if(isset($_GET['id'], $_GET['login'])){
    if($_GET['login']==$_SESSION['nombre']){
	$conexion=mysqli_connect($host,$user,$password,$db,$port) or die("Error en la conexión");
	$IDLimpio=mysqli_real_escape_string($conexion, $_GET['id']);
        $loginLimpio=mysqli_real_escape_string($conexion, $_SESSION['nombre']);
	$consulta="DELETE FROM comunicados WHERE id='$IDLimpio' and login='$loginLimpio';";
	mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));
	mysqli_close($conexion);
        header("Location: index");}
        else if($_SESSION['rol']>=2){
	$conexion=mysqli_connect($host,$user,$password,$db,$port) or die("Error en la conexión");
	$IDLimpio=mysqli_real_escape_string($conexion, $_GET['id']);
	$consulta="DELETE FROM comunicados WHERE id='$IDLimpio';";
	mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));
	mysqli_close($conexion);
        header("Location: index");}
    else{
        header("Location: index");
    }
	
}

?>

<html>
    
    <head>
        
       <title><?php echo $tituloWeb ?></title>
        
        <meta charset="utf-8"/>
        
        <link rel="stylesheet" type="text/css" href="lsmc_panel.css">
        
    </head>
    
    <body>

        <div class="banner">
            
            <a href="index">
            
            <table align="center"><tr><td><img src="<?php echo $banner ?>" align="center" /></td></tr></table>
            
            </a>
            
        </div>
        
        <div class="menu">
            
            <ul id="menu">
                <li><a href="">Inicio</a></li>
                
                <li><a href="datos">Datos</a><li>
                    
                <li><a href="mensajes">Mensajes</a></li>
                
                <li><a href="salir">Salir</a></li>

            </ul>
            
        </div>
        
        <?php  if($_SESSION['rol']>=1){
         echo "<div class='menu2'>";
            
         echo "<ul id='menu'>";
            
              if($_SESSION['rol']>=1){
                echo "<li><a href='gestionSolicitudes'>Solicitudes</a></li>";}
                    
                       if($_SESSION['rol']>=1){
               echo "<li><a href='gestionComunicados'>Comunicados</a></li>";}
                
                 if($_SESSION['rol']>=2){
               echo "<li><a href='gestionMiembros'>Miembros</a></li>";}  else {
                    echo "<li><a>Miembros</a></li>";
                } 
                
                if($_SESSION['rol']>=2){
               echo "<li><a href='configuracion'>Configuración</a></li>";}  else {
                    echo "<li><a>Configuracion</a></li>";
                } 
                
             echo "</ul>";
            
        echo "</div>";
        }else{
            echo "";
        }
        ?>
        <div class="seccion" style="background-color: <?php echo $colorBarra ?>;">
            
            <p>Bienvenido, <?php echo "".$_SESSION['nombreUsuario']." ".$_SESSION['apellidosUsuario'].""; ?><?php 
            
                $conexion=mysqli_connect($host,$user,$password,$db,$port) or die("Error en la conexión");
		$consultaSQL="SELECT * FROM mensajes WHERE receptor='".$_SESSION['nombre']."' AND leido='NO'";
		$datos=mysqli_query($conexion, $consultaSQL) or die(mysqli_error($conexion));
                
                if(mysqli_num_rows($datos)==1){
                    echo "<a style='color:white;text-decoration:none;' href='mensajes'> | Tienes 1 mensaje privado sin leer.</a>";
                } if(mysqli_num_rows($datos)>=2){
                    $totalMensajes = mysqli_num_rows($datos);
                    echo "<a style='color:white;text-decoration:none;' href='mensajes'> | Tienes $totalMensajes mensajes privados sin leer.</a>";
                }
            
            ?></p>
            
        </div>
        
        <div class="seccion2">
            
            <table align="center"><tr><td><img src="<?php echo $logo ?>" align="center" /></td></tr></table>
            
            <hr width="75%" />
            
             <?php
            
            $conexion=mysqli_connect($host,$user,$password,$db,$port) or die("Error en la conexión");
            
            $por_pagina = 3;
            
            if (isset($_GET['pagina'])){
                $pagina = $_GET['pagina'];
                
            }else{
                $pagina = 1;
            }
            
            $empieza = ($pagina-1) * $por_pagina;
            
            $query = "SELECT * FROM `comunicados` ORDER BY `comunicados`.`id` DESC LIMIT $empieza, $por_pagina";
            
            $resultado = mysqli_query($conexion, $query);
            
            ?>
                
                <?php
                
                    while($fila = mysqli_fetch_assoc($resultado)){
                        
                    echo "<div style='width: 910px;height: auto;margin: 0 auto;margin-bottom:5px;border: solid 1px black;overflow: auto;border-radius: 5px;'>";
                
                    echo "<p style='font-weight: bold;text-align:left;'>$fila[fecha]</p>";
                    
                    echo "<h2 align='center'>$fila[titulo]</h2>";
                    
                    echo "<h3 align='center' style='color:#808080;'>$fila[subtitulo]</h3>";
                    
                    if(!($fila[imagen]=='fotos/')){
                    echo "<p style='text-align:center'><img src='$fila[imagen]' width='700' height='250'></p>";
                    }else{
                        echo "";
                    }
                    echo "<p align='justify'>".nl2br(html_entity_decode($fila[cuerpoTexto]))."</p>";
                    
                    echo "<p style='font-style: italic;text-align:right;'>$fila[autor]</p>";
                
                    if($_SESSION['nombre']==$fila[login] || $_SESSION['rol']>=2){ echo "<table align='center'><tr><td align='center'><a class='boton' href='index?id=$fila[id]&login=$fila[login]'><b>Borrar Comunicado</b></a></td></tr></table>";}
                        else{
                            echo "";
                        }
                    
                    echo "</div>";
                
                        }
                        
                        ?>
            
            <?php 
            
            $query2 = "SELECT * FROM comunicados";
            
            $resultado2 = mysqli_query($conexion, $query2);
            
            $total_registros = mysqli_num_rows($resultado2);
            
            $total_paginas = ceil($total_registros / $por_pagina);
            
            if ($pagina==1){
            echo "<center>";
            }else{
                echo "<center><a href='index?pagina=1'>".'Primera'."</a>";
            }
                
            for($i=1; $i<=$total_paginas; $i++){
                if ($i==$pagina){
                     echo "<a style='text-decoration: none;'>".$i."</a>";
                }else{
                echo "<a href='index?pagina=".$i."'>".$i."</a>";
                }
            }
            if ($pagina==$total_paginas){
                echo "</center>";
            }
            
            if($total_registros==0){
                echo "<p style='text-align:center;'>No hay ningún comunicado disponible.</p>";
            }
            else if ($pagina==$total_paginas){
                echo "</center>";
            }else{
            echo "<a href='index?pagina=$total_paginas'>".'Última'."</a></center>";
            }
            ?>
            
            
            
            </div>
        
        <div class="inferior">
            
            <p><?php echo $copyright ?></p>
                        
        </div>
        
    </body>
    
    
</html>


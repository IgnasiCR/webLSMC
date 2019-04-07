<?php

include_once '../config/config.php';
include_once '../config/seguridad.php';
include_once '../config/variables.php';

seguridadInterior(EMPLEADO);

if(isset($_POST['eliminarMensajes'])){
    if($_POST['IDMensajes']==NULL){
        header("Location: mensajes");
    }
    
    $conexion=mysqli_connect($host,$user,$password,$db,$port) or die("Error en la conexión");
    $IDs=implode(",", $_POST['IDMensajes']);
    $consulta="SELECT * FROM mensajes WHERE receptor = '".$_SESSION['nombre']."' AND ID IN ($IDs)";
    $datos=mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));
    
     if(mysqli_num_rows($datos)>=1){
         $conexion=mysqli_connect($host,$user,$password,$db,$port) or die("Error en la conexión");
            $borrar=implode(",", $_POST['IDMensajes']);
            $consulta="DELETE FROM mensajes WHERE ID IN ($borrar);";
            mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));
            mysqli_close($conexion);
            header("Location: mensajes");
     }mysqli_close($conexion);
     header("Location: mensajes");
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
                <li><a href="index">Inicio</a></li>
                
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
		$consultaSQL="SELECT * FROM mensajes WHERE receptor='".$_SESSION['nombre']."'";
		$datos=mysqli_query($conexion, $consultaSQL) or die(mysqli_error($conexion));
                
                if(mysqli_num_rows($datos)==20){
                    echo " | Tienes la bandeja de mensajes completa.";
                }
            
            ?></p>
            
        </div>
        
        <div class="seccion2">
            
            <table align="center"><tr><td><img src="<?php echo $logo ?>" align="center" /></td></tr></table>
            
            <hr width="75%" />
            
            <form action="" method="POST">
            
                <p style="text-align:center;"><a href="mensajes">Ver Mensajes</a> | <a href="crearMensajes">Enviar Mensaje</a> | <input class="enlace" type="submit" name="eliminarMensajes" value="Eliminar Mensajes"/></p><br/>
            
            <?php
                    
                    $nombreUsuario=$_SESSION['nombre'];
                    $consulta="SELECT * FROM mensajes WHERE receptor='$nombreUsuario' ORDER BY fecha DESC";
                    $conexion=mysqli_connect($host,$user,$password,$db,$port) or die("Error en la conexión");
                    $datos=mysqli_query($conexion, $consulta) or die(mysql_error());
            ?>
                      
  <table width="800" border="0" align="center" cellpadding="1" cellspacing="1" style="margin-bottom:5px;">
    <tr>
      <td width="426" align="center" valign="top"><strong>Asunto</strong></td>
      <td width="321" align="center" valign="top"><strong>Emisor</strong></td>
	  <td width="321" align="center" valign="top"><strong>Fecha</strong></td>
    </tr>
    
    <?php
	
	while($fila = mysqli_fetch_assoc($datos)){ ?>
        <tr bgcolor="<?php if($fila['leido'] == "SI") { echo "#f38b97"; } else { echo "#8bf3b0"; } ?>">
        <td class="mensajes" align="center" valign="middle"><a href="leerMensajes?id=<?=$fila['ID']?>&receptor=<?=$fila['receptor']?>"><?=$fila['asunto']?></a></td>
        <td class="mensajes" align="center" valign="middle"><?=$fila['emisor']?></td>
	<td class="mensajes" align="center" valign="middle"><?=$fila['fecha']?></td>       
        <td bgcolor="white"><input type="checkbox" name="IDMensajes[]" value="<?php echo $fila['ID'];?>"/></td>
    </tr>
<?php  
} ?>
    
  </table>  </form>   
        
            
            </div>
        
        <div class="inferior">
            
           <p><?php echo $copyright ?></p>
                        
        </div>
        
    </body>
    
    
</html>


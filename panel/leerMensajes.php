<?php

include_once '../config/config.php';
include_once '../config/seguridad.php';
include_once '../config/variables.php';

seguridadInterior(EMPLEADO);



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
            
            <p>Bienvenido, <?php echo "".$_SESSION['nombreUsuario']." ".$_SESSION['apellidosUsuario'].""; ?></p>
            
        </div>
        
        <div class="seccion2">
            
            <table align="center"><tr><td><img src="<?php echo $logo ?>" align="center" /></td></tr></table>
            
            <hr width="75%" />
            
            <?php 

        $id = $_GET['id'];
        $receptor = $_GET['receptor'];
        if(!($receptor==$_SESSION['nombre'])){
            header("Location: mensajes");
        }
        $consulta = "SELECT * FROM mensajes WHERE receptor='".$_SESSION['nombre']."' and ID='".$id."'";
        $conexion=mysqli_connect($host,$user,$password,$db,$port) or die("Error en la conexión");
        $datos = mysqli_query($conexion, $consulta) or die(mysql_error());
        $fila = mysqli_fetch_assoc($datos);
?>
            
            <p style="text-align:center;"><a href="mensajes">Ver Mensajes</a> | <a href="crearMensajes">Enviar Mensaje</a> | <a href="borrarMensaje?ID=<?=$fila['ID']?>&receptor=<?=$fila['receptor']?>">Eliminar Mensaje</a> | <a href="crearMensajes?emisor=<?=$fila['emisor']?>&asunto=<?=$fila['asunto']?>">Responder Mensaje</a></p><br/>
            
          

            <table style="margin-bottom:5px;" width="800px" border="0px" align="center" cellpadding="1" cellspacing="1"><tr><td class="mensajes">      
<p><strong>De:</strong> <?=$fila['emisor']?><br />
<strong>Fecha:</strong> <?=$fila['fecha']?><br />
<strong>Asunto:</strong> <?=$fila['asunto']?><br /><br />
<strong>Mensaje:</strong><br />
        <?=nl2br(html_entity_decode($fila[cuerpoTexto]))?></p></td></tr></table>

<?php 
if($fila['leido'] != "si")
{
        $conexion=mysqli_connect($host,$user,$password,$db,$port) or die("Error en la conexión");
	$consulta="UPDATE mensajes SET leido='SI' WHERE ID='$id'";
	mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));
	mysqli_close($conexion);
}
?>  
        
            
            </div>
        
        <div class="inferior">
            
            <p><?php echo $copyright ?></p>
                        
        </div>
        
    </body>
    
    
</html>
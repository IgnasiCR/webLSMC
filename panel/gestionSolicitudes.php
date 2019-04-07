<?php

include_once '../config/config.php';
include_once '../config/seguridad.php';
include_once '../config/variables.php';

seguridadInterior(COORDINADOR);

if($_SESSION['rol']>=2){
if(isset($_GET['ID'])){
	$conexion=mysqli_connect($host,$user,$password,$db,$port) or die("Error en la conexión");
	$IDLimpio=mysqli_real_escape_string($conexion, $_GET['ID']);
	$consulta="DELETE FROM solicitudes WHERE ID='$IDLimpio';";
	mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));
	mysqli_close($conexion);
	header("Location: gestionSolicitudes");
	
}}

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
		
		// Crear la tabla con el listado de todas las filas 
		// de la tabla alumnos de la BD ejemplos.
		
		$conexion=mysqli_connect($host,$user,$password,$db,$port) or die("Error en la conexión");
		$consultaSQL="Select * from solicitudes;";
		$datos=mysqli_query($conexion, $consultaSQL) or die(mysqli_error($conexion));
                $total_registros = mysqli_num_rows($datos);
		
		// Ciclamos por todos las filas que me lleguen en $datos
                
                if($total_registros==0){
                     echo "<p style='text-align:center;'>No hay ninguna solicitud disponible.</p>";
                }else{
                
		while($fila=mysqli_fetch_array($datos,MYSQLI_ASSOC)){
			
                        echo "<h1 align='center' style='font-family: 'Open Sans', sans-serif; font-size: 12px; padding: 2px;>Solicitud #$fila[ID]:</h1>";
			echo "<table class='miTabla' border='1px' align='center'><tr><td align='left'><b>Identificador:</b></td><td>$fila[ID]</td></tr><tr><td align='left'><b>Nombre:</b></td><td>$fila[nombre]</td></tr><tr><td align='left'><b>Edad:</b></td><td>$fila[edad]</td></tr><tr><td align='left'><b>DNI:</b></td><td>$fila[dni]</td></tr><tr><td align='left'><b>Telefono:</b></td><td>$fila[telefono]</td></tr><tr><td align='left'><b>Empresa:</b></td><td>$fila[empresa]</td></tr><tr><td align='left'><b>Razón:</b></td><td>".nl2br($fila[razonSolicitud])."</td></tr><tr><td align='left'><b>Redacción:</b></td><td>".nl2br(html_entity_decode($fila[redaccion]))."</td></tr>";
                        if($_SESSION['rol']>=2){ echo "<tr><td align='left'><a class='boton' href='gestionSolicitudes?ID=$fila[ID]'><b>Borrar</b></a></td></tr></table>";}
                        else{
                            echo "</table>";
                        }
		}
                }
		mysqli_close($conexion);
                
                
                
?>
		
                
            </div>
        
        <div class="inferior">
            
          <p><?php echo $copyright ?></p>
                        
        </div>
        
    </body>
    
    
</html>
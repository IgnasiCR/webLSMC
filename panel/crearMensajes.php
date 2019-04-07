<?php

include_once '../config/config.php';
include_once '../config/seguridad.php';
include_once '../config/variables.php';

seguridadInterior(EMPLEADO);

  
if($_POST['enviarMensaje']){
    
                $conexion=mysqli_connect($host,$user,$password,$db,$port) or die("Error en la conexión");
		$consultaSQL="SELECT * FROM mensajes WHERE receptor='".$_POST['receptor']."'";
		$datos=mysqli_query($conexion, $consultaSQL) or die(mysqli_error($conexion));
                
                if(mysqli_num_rows($datos)==20){
                    $bandejaLlena="| El usuario ".$_POST['receptor']." tiene la bandeja de mensajes completa.";
                }else{
            
           
	if(!empty($_POST['receptor']) && !empty($_POST['asunto']) && !empty($_POST['mensaje']))
	{
                $textoEnvio=htmlentities(addslashes($_POST[mensaje]));
		$consulta = "INSERT INTO mensajes (receptor,emisor,asunto,cuerpoTexto) VALUES ('".$_POST['receptor']."','".$_SESSION['nombre']."','".$_POST['asunto']."','".$textoEnvio."')";
		$conexion=mysqli_connect($host,$user,$password,$db,$port) or die("Error en la conexión");
                mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));
	}
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
            
            <p>Bienvenido, <?php echo "".$_SESSION['nombreUsuario']." ".$_SESSION['apellidosUsuario'].""; ?> <?php echo $bandejaLlena ?></p>
            
        </div>
        
        <div class="seccion2">
            
            <table align="center"><tr><td><img src="<?php echo $logo ?>" align="center" /></td></tr></table>
            
            <hr width="75%" />
            
            <p style="text-align:center;"><a href="mensajes">Ver Mensajes</a> | <a href="crearMensajes">Enviar Mensaje</a></p><br/>
            
         

                    <script type="text/javascript" src="../editor/editor.js"></script> <script type="text/javascript">
  bkLib.onDomLoaded(function() {
        new nicEditor({buttonList : ['bold','italic','underline','strikeThrough','ol','ul','link','left','center','right','justify','html','image']}).panelInstance('areaTexto');
       
  });
  </script>
  
                      
  <form class="misComunicados" method="POST" action="" enctype="multipart/form-data"><table align="center" width="100%"><tr><td>
            
                            <label>Receptor:</label></td><td><select name="receptor">
                                    <?php
                                        $conexion=mysqli_connect($host,$user,$password,$db,$port) or die("Error en la conexión");
                                        $consultaSQL="Select login from usuarios ORDER BY login;";
                                        $datos=mysqli_query($conexion, $consultaSQL) or die(mysqli_error($conexion));
                                            while($fila=mysqli_fetch_array($datos,MYSQLI_ASSOC)){?>
			
                                                    <option value='<?=$fila['login']?>' <?php if($fila['login']==$_GET['emisor']){echo "selected";}?>><?=$fila['login'];?></option>
                                                    
		 <?php }
		mysqli_close($conexion);
                                                                        ?>
                                                              </select>
              </td></tr>
                        <tr><td><label>Asunto: </label></td><td><input type="text" name="asunto" <?php if(!($_GET['asunto']==NULL)){echo "value='RE: ".$_GET['asunto']."'";} ?> required></td></tr>
                         <tr><td><label>Mensaje: </label></td><td><textarea cols="50" name="mensaje" id="areaTexto" style="width:100%; height:300px" required>

                                                                    </textarea></td></tr>
                         <tr><td><label><input type="submit" name="enviarMensaje" value="Enviar" onclick="this.onclick=function(){this.disabled = true}"></label></td></tr>
                         
                          </table></form>
        
            
            </div>
        
        <div class="inferior">
            
           <p><?php echo $copyright ?></p>
                        
        </div>
        
    </body>
    
    
</html>
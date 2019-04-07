<?php

include_once '../config/config.php';
include_once '../config/seguridad.php';
include_once '../config/variables.php';

seguridadInterior(COORDINADOR);

if(isset($_POST['anadirComunicado'])){
        $foto= uniqid()."-".$_FILES["imagen"]["name"];
        $ruta=$_FILES["imagen"]["tmp_name"];
        $destino="../fotos/".$foto;
        copy($ruta,$destino);
	$textoEnvio=htmlentities(addslashes($_POST[comunicado]));
        $consulta="INSERT INTO `comunicados` (`id`, `titulo`, `subtitulo`, `cuerpoTexto`, `fecha`, `autor`, `imagen`, `login`) VALUES (NULL, '$_POST[titulo]', '$_POST[subtitulo]', '".$textoEnvio."', '$_POST[fecha]', '$_POST[autor]', '$destino', '$_SESSION[nombre]');";
	$conexion=mysqli_connect($host,$user,$password,$db,$port) or die("Error en la conexión");
	mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));
	mysqli_close($conexion);
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
            
            <p>Bienvenido, <?php echo "".$_SESSION['nombreUsuario']." ".$_SESSION['apellidosUsuario'].""; ?></p>
            
        </div>
        
        <div class="seccion2">
            
            <table align="center"><tr><td><img src="<?php echo $logo ?>" align="center" /></td></tr></table>
            
            <hr width="75%" />
            
            <script type="text/javascript" src="../editor/editor.js"></script> <script type="text/javascript">
  bkLib.onDomLoaded(function() {
        new nicEditor({buttonList : ['bold','italic','underline','strikeThrough','ol','ul','link','left','center','right','justify','html','image']}).panelInstance('areaTexto');
       
  });
  </script>
  
                      
  <form class="misComunicados" method="POST" action="" enctype="multipart/form-data"><table align="center" width="100%"><tr><td>
            
                            <label>Titulo:</label></td><td><input type="text" name="titulo" required></td></tr>
			<tr><td><label>Subtitulo: </label></td><td><input type="text" name="subtitulo" required></td></tr>
                        <tr><td><label>Imagen: </label></td><td><input type="file" name="imagen"></td></tr>
                        <tr><td><label>Comunicado: </label></td><td><textarea cols="50" name="comunicado" id="areaTexto" style="width:100%; height:300px">

                                                                    </textarea></td></tr>
                        <tr><td><label>Fecha: </label></td><td><input type="date" name="fecha"></td></tr>
                        <tr><td><label>Autor: </label></td><td><input type="text" name="autor" required></td></tr>
			
                        <tr><td><label><input type="submit" name="anadirComunicado" value="Añadir"></label></td></tr>
                        
      </table></form>
     
  
  
            </div>
        
        <div class="inferior">
            
            <p><?php echo $copyright ?></p>
                        
        </div>
        
    </body>
    
    
</html>
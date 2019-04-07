<?php

include_once '../config/config.php';
include_once '../config/seguridad.php';
include_once '../config/variables.php';

seguridadInterior(DIRECTOR);

if(isset($_POST['modificarConfiguracion'])){

        $fotobanner= $_FILES["banner"]["name"];
        $rutabanner=$_FILES["banner"]["tmp_name"];
        $destinobanner="../images/".banner.".".png;
        
        $fotologo= $_FILES["logo"]["name"];
        $rutalogo=$_FILES["logo"]["tmp_name"];
        $destinologo="../images/".logo.".".png;
        
        list($widthbanner, $heightbanner, $typebanner, $attrbanner) = getimagesize("$rutabanner");
        list($widthlogo, $heightlogo, $typelogo, $attrlogo) = getimagesize("$rutalogo");
        
        if($widthbanner<=950 && $heightbanner<=200){
            if($typebanner==2 || $typebanner==3){
                if($widthlogo<=500 && $heightlogo<=150){
                    if($typelogo==2 || $typelogo==3){
                
                        copy($rutabanner,$destinobanner);
                        copy($rutalogo,$destinologo);

                        $escritura='<?php '
                                . '$tituloWeb="'.$_POST['tituloWeb'].'";'
                                . '$colorBarra="'.$_POST['colorBarra'].'";'
                                . '$copyright="'.$_POST['copyright'].'";'
                                . '$banner="'.$urlBase.$destinobanner.'";'
                                . '$logo="'.$urlBase.$destinologo.'";';
                        $file= fopen("../config/variables.php","w");
                        fwrite($file, $escritura);
                        fclose($file);

                        $confirmar="| Configuración cambiada con éxito.";
                        
                    }
                    else{
                        $error2logo="| El logo no es JPG o PNG.";
                    }
                    
                }
                else{
                    $error1logo="| El logo no cumple con las medidas exigidas.";
                }
                
            }
            else{
                $error2banner="| El banner no es JPG o PNG.";
            }
            
        }else{
            $error1banner="| El banner no cumple con las medidas exigidas.";
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
            
            <p>Bienvenido, <?php echo "".$_SESSION['nombreUsuario']." ".$_SESSION['apellidosUsuario'].""; ?><?php echo $error1banner; echo $error2banner; echo $error1logo; echo $error2logo; echo $confirmar;?></p>
            
        </div>
        
        <div class="seccion2">
            
            <table align="center"><tr><td><img src="<?php echo $logo ?>" align="center" /></td></tr></table>
            
            <hr width="75%" />
            
            <form class="miConfiguracion" method="POST" action="" enctype="multipart/form-data"><table align="center" width="100%"><tr><td>
            
                            <label>Titulo Web:</label></td><td><input type="text" name="tituloWeb" required /></td></tr>
			<tr><td><label>Color Barra: </label></td><td><input name="colorBarra" type="color" value="#f3f3f3" required /></td></tr>
                        <tr><td><label>Copyright: </label></td><td><input type="text" name="copyright" required /></td></tr>
                        <tr><td><label>Banner: </label></td><td><input type="file" name="banner" required /></td></tr>
                        <tr><td><label>Logo: </label></td><td><input type="file" name="logo" required /></td></tr>
			
                        <tr><td><label><input type="submit" name="modificarConfiguracion" value="Configurar"></label></td></tr>
                        
      </table></form>
            
            </div>
        
        <div class="inferior">
            
            <p><?php echo $copyright ?></p>
                        
        </div>
        
    </body>
    
    
</html>


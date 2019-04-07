<?php

include_once '../config/config.php';
include_once '../config/seguridad.php';
include_once '../config/variables.php';

seguridadInterior(EMPLEADO);

if(isset($_POST['subirImagen'])){
        $foto= $_FILES["imagen"]["name"];
        $ruta=$_FILES["imagen"]["tmp_name"];
        $destino="../fotos/perfiles/".$_SESSION['nombre'].".".png;
        list($width, $height, $type, $attr) = getimagesize("$ruta");
        if($width<=200 && $height<=200){
            if($type==2 || $type==3){
                copy($ruta,$destino);
                $consulta="UPDATE usuarios SET avatar='$destino' WHERE login='$_SESSION[nombre]';";
                $conexion=mysqli_connect($host,$user,$password,$db,$port) or die("Error en la conexión");
                mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));
                mysqli_close($conexion);
                $confirmar="| Avatar cambiado con éxito.";
            }
            else{
                $error2="| La imagen no es JPG o PNG.";
            }
            
        }else{
            $error1="| La imagen no cumple con las medidas exigidas.";
        }
        
}

if(isset($_POST['cambiarContrasena'])){
    
        $conexionVerificar=mysqli_connect($host,$user,$password,$db,$port) or die("Error en la conexión");
        $contraVieja=mysqli_real_escape_string($conexionVerificar,$_POST['contrasenaVieja']);
        $contraNueva1=mysqli_real_escape_string($conexionVerificar,$_POST['contrasenaNueva1']);
        $contraNueva2=mysqli_real_escape_string($conexionVerificar,$_POST['contrasenaNueva2']);
        $consultaVerificar="SELECT * FROM usuarios WHERE login = '$_SESSION[nombre]' and password=password('$contraVieja');";
        $datosVerificar=mysqli_query($conexionVerificar, $consultaVerificar) or die(mysqli_error($conexionVerificar));
        if(mysqli_num_rows($datosVerificar)==1){
            if($contraNueva1==$contraNueva2){
                $consulta="UPDATE usuarios SET password=password('$contraNueva1') where login='$_SESSION[nombre]';";
                $conexion=mysqli_connect($host,$user,$password,$db,$port) or die("Error en la conexión");
                mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));
                mysqli_close($conexion);
                $confirmar="| Contraseña cambiada con éxito.";
            }
            else{
                mysqli_close($conexion);
                $error2="| Las nuevas contraseñas no son iguales.";
            }
            
        }else{
                mysqli_close($conexion);
                $error1="| La antigua contraseña es incorrecta.";
            }
}
?>

<html>
    
    <head>
        
        <title><?php echo $tituloWeb ?></title>
        
        <meta charset="utf-8"/>
        
        <link rel="stylesheet" type="text/css" href="lsmc_panel.css">
        
        <script type="text/javascript" src="validacionContrasena.js"></script>
        
        <script type="text/javascript" src="cargarContenido.js"></script>
        
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
            
            <p>Bienvenido, <?php echo "".$_SESSION['nombreUsuario']." ".$_SESSION['apellidosUsuario']." "; ?><?php echo $error1; echo $error2; echo $confirmar;?></p>
            
        </div>
        
        <div class="seccion2">
            
           <table align="center"><tr><td><img src="<?php echo $logo ?>" align="center" /></td></tr></table>
            
            <p style="text-align:center;"><input id="botonEnlace" type="submit" name="cambiarImagen" onclick="cargarImagen();" value="Cambiar Imagen"> | <input id="botonEnlace" type="submit" name="cambiarContrasena" onclick="cargarContrasena();" value="Cambiar Contraseña"></p>
            
            <hr width="75%" />
            
            <table width="100%"><tr><td width="25%">
            
            <?php
            
            $consulta = "SELECT * FROM usuarios WHERE login='".$_SESSION['nombre']."';";
            $conexion=mysqli_connect($host,$user,$password,$db,$port) or die("Error en la conexión");
            $datos = mysqli_query($conexion, $consulta) or die(mysql_error());
            $fila = mysqli_fetch_assoc($datos);
            
            echo "<p style='text-align:left'><img src=".$fila['avatar']." width='200' height='200'></p>"; ?></td>
            
                <td width="25%"><div id="editarImagen" style="visibility: hidden;"> <form method="POST" action="" enctype="multipart/form-data"><table width="100%">
                    
                    <tr><td><input type="file" name="imagen"></td></tr>
                    <tr><td style="font-size: 0.83em;font-weight: bold;text-align:justify;"><br/>El tamaño máximo de la imagen debe ser de 200x200px como máximo. Solo se aceptan imágenes .jpg o .png.</td></tr>
                    <tr><td><br/><input style="border-radius: 0px;" type="submit" name="subirImagen" value="Cambiar Avatar"></td></tr>
                            </table> </form></div></td>
                
                <td width="50%"><div id="editarContrasena" style="visibility: hidden;top: 50px;position: relative;"> <form class="modificarContrasena" method="POST" action="" enctype="multipart/form-data" onsubmit="return validarContrasena(this);"><table width="100%">
                    
                    <tr><td align="center"><label>Contraseña antigua: </label><input type="password" name="contrasenaVieja" onkeypress="this.style.backgroundColor='';" required/>
                            <label>Contraseña nueva: </label><input type="password" name="contrasenaNueva1" onkeypress="this.style.backgroundColor='';" required/>
                            <label>Confirmar contraseña: </label><input type="password" name="contrasenaNueva2" onkeypress="this.style.backgroundColor='';" required/></td></tr>
                    <tr><td style="font-size: 0.83em;font-weight: bold;text-align:justify;"><br/>La contraseña debe contener cómo mínimo 8 carácteres (1 mayúscula, 1 minúscula, 1 digito y 1 caracter especial) y máximo 16 carácteres.</td></tr>
                    <tr><td align="center"><br/><input style="border-radius: 0px;" type="submit" name="cambiarContrasena" value="Cambiar Contraseña"></td></tr>
                            </table></form>
                            
                </tr></table>
                        
            <?php echo "<p style='font-size: 25px; font-weight: bold; padding-left: 10px;'>".$fila['login']."</p>"; 
            echo "<p><b>Puesto en LSMC: ".$fila['puesto']."</b></p>";
            echo "<p><b>Salario semanal: ".$fila['salario']."</b></p>";

            ?>
             
                
                
            </div>
        
        <div class="inferior">
            
            <p><?php echo $copyright ?></p>
                        
        </div>
        
    </body>
    
    
</html>


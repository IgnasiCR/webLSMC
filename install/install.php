<?php

if(isset($_POST['install'])){
	$conexion=mysqli_connect($_POST[host],$_POST[user],$_POST[password],NULL,$_POST[port]) or die(mysqli_error($conexion));

    
    //Crear la infraestructura.
    
    $creacionInfraestructura[]="DROP DATABASE IF EXISTS db_lsmc;";
    $creacionInfraestructura[]="CREATE DATABASE db_lsmc;";
    
    $creacionInfraestructura[]="GRANT USAGE ON *.* TO 'usuarioadminLSMC'@'%' IDENTIFIED BY PASSWORD '*F2F160505BAF3D8D25165761A82C6FD01A478B78';";

    $creacionInfraestructura[]="GRANT ALL PRIVILEGES ON `db_lsmc`.* TO 'usuarioadminLSMC'@'%';";
    
   $creacionInfraestructura[]="USE db_lsmc;";
   $creacionInfraestructura[]="DROP TABLE IF EXISTS usuarios;";
   $creacionInfraestructura[]="CREATE TABLE `usuarios` (
  `login` varchar(50) NOT NULL,
  `password` varchar(512) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `rol` varchar(8) NOT NULL,
  `puesto` varchar(50) NOT NULL,
  `salario` int(20) NOT NULL,
  `avatar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
   $creacionInfraestructura[]="INSERT INTO `usuarios` (`login`, `password`, `rol`, `avatar`, `nombre`) VALUES ('admin_admin', PASSWORD('1234'), '2', '../fotos/perfiles/defecto.png', 'admin');";
    
   $creacionInfraestructura[]="USE db_lsmc;";
   $creacionInfraestructura[]="DROP TABLE IF EXISTS solicitudes;";
   $creacionInfraestructura[]="CREATE TABLE `solicitudes` (
  `ID` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `edad` int(3) NOT NULL,
  `dni` int(15) NOT NULL,
  `empresa` varchar(50) NOT NULL,
  `telefono` int(6) NOT NULL,
  `razonSolicitud` mediumtext NOT NULL,
  `redaccion` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8";
   
    $creacionInfraestructura[]="USE db_lsmc;";
    $creacionInfraestructura[]="DROP TABLE IF EXISTS comunicados;";
   
   $creacionInfraestructura[]="CREATE TABLE `comunicados` (
  `id` int(11) NOT NULL,
  `titulo` tinytext NOT NULL,
  `subtitulo` tinytext NOT NULL,
  `cuerpoTexto` longtext NOT NULL,
  `fecha` varchar(50) NOT NULL,
  `autor` varchar(50) NOT NULL,
  `imagen` text NOT NULL,
  `login` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
   
   $creacionInfraestructura[]="USE db_lsmc;";
   $creacionInfraestructura[]="DROP TABLE IF EXISTS mensajes;";
   
   $creacionInfraestructura[]="CREATE TABLE `mensajes` (
  `ID` int(11) NOT NULL,
  `receptor` varchar(150) NOT NULL,
  `emisor` varchar(150) NOT NULL,
  `leido` varchar(5) NOT NULL DEFAULT 'NO',
  `fecha` varchar(100) NOT NULL,
  `asunto` varchar(100) NOT NULL,
  `cuerpoTexto` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
   
   $creacionInfraestructura[]="ALTER TABLE `comunicados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `login` (`login`);";
   
   $creacionInfraestructura[]="ALTER TABLE `solicitudes`
  ADD PRIMARY KEY (`id`);";
   
    $creacionInfraestructura[]="ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `receptor` (`receptor`),
  ADD KEY `emisor` (`emisor`);";
   
   $creacionInfraestructura[]="
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`login`);";
   
   $creacionInfraestructura[]="ALTER TABLE `comunicados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;";
   
   $creacionInfraestructura[]="ALTER TABLE `solicitudes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;";
   
   $creacionInfraestructura[]="ALTER TABLE `mensajes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;";
   
   $creacionInfraestructura[]="ALTER TABLE `comunicados`
  ADD CONSTRAINT `comunicados_ibfk_1` FOREIGN KEY (`login`) REFERENCES `usuarios` (`login`) ON DELETE CASCADE ON UPDATE CASCADE;";
   
   $creacionInfraestructura[]="ALTER TABLE `mensajes`
  ADD CONSTRAINT `mensajes_ibfk_1` FOREIGN KEY (`receptor`) REFERENCES `usuarios` (`login`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mensajes_ibfk_2` FOREIGN KEY (`emisor`) REFERENCES `usuarios` (`login`) ON DELETE CASCADE ON UPDATE CASCADE;";
           
    echo "Creando infraestructura...</br></br>";
    
    foreach($creacionInfraestructura as $consulta){
        
        mysqli_query($conexion, $consulta) or die("Error: ".mysqli_error($conexion));
        echo "Ejecutado: $consulta <br></br>";
        
    }
    
    function getBaseUrl() 
        {
            $currentPath = $_SERVER['PHP_SELF']; 
            $pathInfo = pathinfo($currentPath); 
            $hostName = $_SERVER['HTTP_HOST']; 
            $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://';
            return $protocol.$hostName.$pathInfo['dirname']."/";
        }
    
    $escritura='<?php '
        . '$host="'.$_POST['host'].'";'
        . '$user="usuarioadminLSMC";'
        . '$password="usuarioadminLSMC";'
        . '$db="db_lsmc";'
        . '$urlBase="'.getBaseUrl().'";'
        . '$port="'.$_POST['port'].'";';
    $file= fopen("../config/config.php","w");
    fwrite($file, $escritura);
    fclose($file);
    
        $fotobanner= $_FILES["banner"]["name"];
        $rutabanner=$_FILES["banner"]["tmp_name"];
        $destinobanner="../images/".banner.".".png;
        
        $fotologo= $_FILES["logo"]["name"];
        $rutalogo=$_FILES["logo"]["tmp_name"];
        $destinologo="../images/".logo.".".png;
        
        list($widthbanner, $heightbanner, $typebanner, $attrbanner) = getimagesize("$rutabanner");
        list($widthlogo, $heightlogo, $typelogo, $attrlogo) = getimagesize("$rutalogo");
        
        if($widthbanner<=950 && $heightbanner<=200){
                if($widthlogo<=500 && $heightlogo<=150){
                    
                        copy($rutabanner,$destinobanner);
                        copy($rutalogo,$destinologo);

                        $escritura='<?php '
                                . '$tituloWeb="'.$_POST['tituloWeb'].'";'
                                . '$colorBarra="'.$_POST['colorBarra'].'";'
                                . '$copyright="'.$_POST['copyright'].'";'
                                . '$banner="'.getBaseUrl().$destinobanner.'";'
                                . '$logo="'.getBaseUrl().$destinologo.'";';
                        $file= fopen("../config/variables.php","w");
                        fwrite($file, $escritura);
                        fclose($file);
                    
                }else{
                    $error1logo="| El logo no cumple con las medidas exigidas.";
                }
                
        }else{
            $error1banner="| El banner no cumple con las medidas exigidas.";
        }
                
    
    echo "Instalación completada con éxito.</br> Borre la carpeta 'install' del raíz, y su contenido.</br></br>";
    
}
        



?>

<html>
    <head><title>Instalación AW</title>
    
    <meta charset="utf-8"/>
		
		<style>
			
			.miForm label{
				
                            display:block;
                            font-family: 'Open Sans', sans-serif;
                            font-size: 13px;
			}
                        
                        p{
                            font-family: 'Open Sans', sans-serif;
                            font-size: 13px;
                        }
			</style>
        
    </head>
    
    <body>
        
        <div class="form">
        
            <p align="center"><img src="../images/logo_default.png"/></p>
            
        <form class="miForm" method="POST" action="">
		
            <h2 align="center">Introduzca los datos del servidor MySQL dónde instalar la Aplicación Web</h2>
            
            <p align="center"><?php echo $error1banner; echo $error2banner; echo $error1logo; echo $error2logo; echo $confirmar;?></p>
            
            <table align="center"><tr><td><label>Usuario: </label><input type="text" name="user" required/>
                        <label>Contraseña: </label><input type="password" name="password" required/>
                        <label>Host: </label><input type="text" name="host" required/>
                        <label>Puerto: </label><input type="text" name="port" required/>
                        <label>Titulo Web:</label><input type="text" name="tituloWeb" required />
			<label>Color Barra: </label><input name="colorBarra" type="color" value="#f3f3f3" required />
                        <label>Copyright: </label><input type="text" name="copyright" required />
                        <label>Banner: </label><input type="file" name="banner" required />
                        <label>Logo: </label><input type="file" name="logo" required />
			
                    </td></tr><tr><td><label><input type="submit" name="install" value="Instalar"/></label></td></tr>
                        
      </table>
		
            <br/><p align="center">El usuario del servidor debe tener permisos total en la base de datos.</p>
                        
		</form>
        
        </div>
            
    </body>
</html>